---
title: End-to-End Car Price Predictor - From Scraping to LightGBM
date: 2025-05-01
description: How I built a complete data pipeline - from a polite web scraper with checkpoint/resume to an ensemble model that predicts used car prices with R² ~0.95 and MAE ~900 EUR.
tags: Python, Machine Learning, LightGBM, Data Engineering
---

## The Goal

Slovak and Czech used-car portals don't offer public APIs. If you want structured data, you have to collect it yourself. I wanted to build a system that could answer one question: **is this listing fairly priced?**

The project is split into two repos: a scraper ([car-listing-collector](https://github.com/matejbujnak/car-listing-collector)) and the ML pipeline ([car-price-predictor](https://github.com/matejbujnak/car-price-predictor)), covering the full lifecycle from raw HTML to a deployed prediction model.

---

## Phase 1 - Data Collection

### Respecting the site

Before making a single request, the scraper fetches `robots.txt` via `urllib.robotparser` and checks every URL before accessing it:

```python
if not robots.can_fetch(USER_AGENT, url):
    logger.warning("robots.txt disallows %s", url)
    return None
```

The User-Agent is a descriptive string identifying the project: `car-listing-collector/1.0 (personal research; github.com; respects robots.txt)`. There is no rotation - one honest identity, consistently used.

### HTTP and retries

The scraper uses the synchronous `requests` library with a `urllib3.Retry` adapter:

```python
retry = Retry(
    total=5,
    backoff_factor=3,
    status_forcelist=[429, 500, 502, 503, 504],
    respect_retry_after_header=True,
)
```

A `429 Too Many Requests` response is handled automatically with backoff. The session sends `Accept-Language: sk-SK` to get localised listing data.

### Make discovery

Instead of hardcoding a list of car makes, the scraper discovers them dynamically. The listing page embeds a Next.js `__NEXT_DATA__` JSON blob with aggregations - the scraper parses that:

```python
def parse_makes(html: str) -> list[dict]:
    data = _extract_next_data(html)
    agg_list = data["props"]["pageProps"]["aggregations"]["aggregations"]
    return [
        {"sef": a["sef"], "label": a["label"], "count": a["count"]}
        for a in agg_list if a.get("sef")
    ]
```

This returns ~100 makes with their URL slugs. No BeautifulSoup needed - pure `re.search` + `json.loads` on the script tag.

### Crawl delay

A two-tier delay system keeps the load reasonable:

```python
MIN_DELAY = 2.5
MAX_DELAY = 6.0
LONG_BREAK_EVERY = 40    # requests
LONG_BREAK_MIN   = 45    # seconds
LONG_BREAK_MAX   = 90    # seconds
```

Every request waits 2.5–6 s. Every 40th request triggers a 45–90 s break. This keeps the server load low even across multi-hour crawls.

### Checkpoint and resume

The scraper segments the crawl by `(make, year_from, year_to, price_from, price_to)`. If a segment has more than 1,000 listings (50 pages × 20), it splits recursively:

1. Binary split on year range: `mid = (year_from + year_to) // 2`
2. If a single year still exceeds 1,000 → split into price bands `[0, 3k, 6k, 10k, 15k, 20k, 30k, 50k, 100k, None]` EUR
3. Still too large → accept truncation with a warning

Progress is written atomically to `data/progress.json` via `tempfile.mkstemp` + `os.replace` - no partial writes on crash. Seen listing IDs are tracked in memory and flushed every 100 listings, so resuming never creates duplicates.

---

## Phase 2 - EDA

The collected dataset was explored across several dimensions before any modelling:

- **Price distribution** - heavily right-skewed, confirming log-price as the right target
- **Price vs. year** - strong relationship after log transform
- **Price vs. mileage** - hexbin scatter shows clear negative correlation with significant make/model noise
- **Fuel type** - diesel dominates; EVs form a distinct high-price cluster
- **Geography** - SK/CZ split, regional price variation

These findings directly shaped the cleaning and feature engineering steps.

---

## Phase 3 - Cleaning and Feature Engineering

Raw listings required significant work:

- **Deduplication** - the same listing often gets reposted
- **Outlier removal** - price below 500 EUR or above 150,000 EUR, mileage above 700,000 km
- **Normalisation** - fuel type, transmission, and body type had inconsistent string values
- **Condition decoding** - numeric codes mapped to `new / used / damaged / demo`
- **Binary flags** - `is_dealer`, `is_authorized_dealer` from seller metadata

Feature engineering:

```python
df["car_age"]          = (CURRENT_YEAR - df["year"]).clip(lower=0)
df["car_age_sq"]       = df["car_age"] ** 2           # non-linear depreciation curve
df["log_mileage"]      = np.log1p(df["mileage_km"])
df["mileage_per_year"] = (df["mileage_km"] / df["car_age"].clip(lower=1)).clip(upper=200_000)
df["power_per_cc"]     = (df["power_kw"] / df["engine_cc"].replace(0, np.nan)).clip(upper=1.0)
df["log_power"]        = np.log1p(df["power_kw"])
```

`car_age_sq` captures the non-linear depreciation curve (a 2-year-old car loses value much faster than a 12-year-old one). `mileage_per_year` distinguishes a high-mileage young car from a high-mileage old one - both have the same odometer reading but very different contexts.

After cleaning: ~21,000 usable rows, 10 numeric features and 9 categorical features.

---

## Phase 4 - Modelling

The target is **log(price_eur)** - predictions are exponentiated back to EUR at evaluation time. All models run inside a sklearn `Pipeline`:

- Median imputation for numerical columns
- `StandardScaler` for numericals
- `OneHotEncoder` for categoricals (except CatBoost which handles them natively)

Five-fold cross-validation across four models:

| Model | Notes |
|---|---|
| Ridge | Baseline linear model |
| Random Forest | 300 trees, max_depth=20 |
| XGBoost | 800 estimators, lr=0.02, depth=6 |
| LightGBM | 800 estimators, lr=0.02, depth=7 |

LightGBM had the best CV score, so it went into `RandomizedSearchCV` with 100 iterations tuning `num_leaves`, `max_depth`, `learning_rate`, `n_estimators`, `min_child_samples`, and `subsample`.

---

## Phase 5 - CatBoost and Ensemble

CatBoost was trained separately because it handles categorical features natively - no one-hot encoding, which means `make` and `model` are fed as-is with no information loss from rare categories. Early stopping ran up to 3,000 iterations.

The final model blends tuned LightGBM and CatBoost in **log space**:

```python
y_pred_ens_log = 0.5 * y_pred_lgb_log + 0.5 * y_pred_cb_log
y_pred_ensemble = np.expm1(y_pred_ens_log)
```

Blending in log space means the two models are averaged on the same scale as training, before the exponent amplifies differences.

---

## Results

| Metric | Value |
|---|---|
| R² | ~0.95 |
| MAE | ~900 EUR |
| Within ±20% | ~85% |

The most important features were `car_age`, `log_mileage`, `make/model`, and `power_kw`. `car_age_sq` consistently ranked in the top 5 - the non-linear depreciation term was worth adding.

---

## What I Learned

**Sync is fine.** The bottleneck was crawl delay, not I/O. A synchronous `requests`-based scraper with good retry logic is simpler and just as fast for this use case.

**Log-transforming the target is not optional for price prediction.** Working in log space stabilises variance and makes the linear baseline reasonable enough to be a useful reference point.

**Feature engineering beat model selection.** The gap from raw features to engineered ones was larger than the gap from Ridge to LightGBM. `mileage_per_year` and `car_age_sq` alone were worth more than switching algorithms.

**Checkpointing from the start.** A multi-hour crawl will eventually get interrupted. Atomic writes and an ID deduplication set meant resuming was seamless - no cleanup, no re-scraping.
