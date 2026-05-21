---
title: End-to-End Car Price Predictor - Od scrapování po LightGBM
date: 2025-05-01
description: Jak jsem postavil kompletní datový pipeline - od slušného web scraperu s checkpointem až po ensemble model, který předpovídá ceny ojetých aut s R² ~0.95 a MAE ~900 EUR.
tags: Python, Machine Learning, LightGBM, Data Engineering
---

## Cíl

Slovenské a české autoservery nenabízejí veřejná API. Pokud chceš strukturovaná data, musíš si je obstarat sám. Chtěl jsem postavit systém, který dokáže odpovědět na jednu otázku: **je tahle inzeráta férově oceněná?**

Projekt je rozdělený do dvou repozitářů: scraper ([car-listing-collector](https://github.com/matejbujnak/car-listing-collector)) a ML pipeline ([car-price-predictor](https://github.com/matejbujnak/car-price-predictor)), pokrývající celý životní cyklus od surového HTML po nasazený predikční model.

---

## Fáze 1 - Sběr dat

### Respektování pravidel serveru

Před prvním requestem scraper stáhne `robots.txt` přes `urllib.robotparser` a každou URL před přístupem zkontroluje:

```python
if not robots.can_fetch(USER_AGENT, url):
    logger.warning("robots.txt disallows %s", url)
    return None
```

User-Agent je popisný řetězec identifikující projekt: `car-listing-collector/1.0 (personal research; github.com; respects robots.txt)`. Žádná rotace - jedna poctivá identita, konzistentně používaná.

### HTTP a retry logika

Scraper používá synchronní knihovnu `requests` s `urllib3.Retry` adapterem:

```python
retry = Retry(
    total=5,
    backoff_factor=3,
    status_forcelist=[429, 500, 502, 503, 504],
    respect_retry_after_header=True,
)
```

Odpověď `429 Too Many Requests` je automaticky ošetřena backoffem. Session posílá `Accept-Language: sk-SK` pro lokalizovaná data.

### Autodiscovery značek

Místo hardcoded seznamu značek je scraper objevuje dynamicky. Stránka s výpisem inzerátů obsahuje Next.js blob `__NEXT_DATA__` s agregacemi - scraper ho parsuje:

```python
def parse_makes(html: str) -> list[dict]:
    data = _extract_next_data(html)
    agg_list = data["props"]["pageProps"]["aggregations"]["aggregations"]
    return [
        {"sef": a["sef"], "label": a["label"], "count": a["count"]}
        for a in agg_list if a.get("sef")
    ]
```

Vrátí ~100 značek s jejich URL slug. Žádný BeautifulSoup - čistý `re.search` + `json.loads` na script tagu.

### Crawl delay

Dvoustupňový delay systém udržuje zátěž na rozumné úrovni:

```python
MIN_DELAY = 2.5
MAX_DELAY = 6.0
LONG_BREAK_EVERY = 40    # requestů
LONG_BREAK_MIN   = 45    # sekund
LONG_BREAK_MAX   = 90    # sekund
```

Každý request čeká 2.5–6 s. Každý 40. request spustí pauzu 45–90 s. To udržuje zátěž serveru nízkou i při vícehodinových crawlech.

### Checkpoint a resume

Scraper segmentuje crawl podle `(make, year_from, year_to, price_from, price_to)`. Pokud má segment více než 1 000 inzerátů (50 stránek × 20), rekurzivně ho rozdělí:

1. Binární rozdělení roku: `mid = (year_from + year_to) // 2`
2. Pokud jeden rok stále přesahuje 1 000 → rozdělení do cenových pásem `[0, 3k, 6k, 10k, 15k, 20k, 30k, 50k, 100k, None]` EUR
3. Pořád příliš velké → přijat s varováním

Progress se zapisuje atomicky do `data/progress.json` přes `tempfile.mkstemp` + `os.replace` - žádné neúplné zápisy při pádu. Viděná ID se sledují v paměti a flushují každých 100 inzerátů, takže resume nikdy nevytvoří duplikáty.

---

## Fáze 2 - EDA

Sesbíraný dataset byl prozkoumán z několika pohledů před jakýmkoliv modelováním:

- **Distribuce cen** - silně pravostranná, potvrzující log-cenu jako správný target
- **Cena vs. rok** - silná závislost po log transformaci
- **Cena vs. nájezd** - hexbin scatter ukazuje jasnou negativní korelaci s výrazným šumem od značky/modelu
- **Typ paliva** - diesel dominuje; EV tvoří výrazný cluster s vysokými cenami
- **Geografie** - rozdělení SK/CZ, regionální cenová variace

Tato zjištění přímo ovlivnila kroky čištění a feature engineeringu.

---

## Fáze 3 - Čištění a Feature Engineering

Surové inzeráty vyžadovaly výraznou práci:

- **Deduplikace** - stejný inzerát je často znovu zveřejněn
- **Odstranění odlehlých hodnot** - cena pod 500 EUR nebo nad 150 000 EUR, nájezd nad 700 000 km
- **Normalizace** - typ paliva, převodovka a karoserie měly nekonzistentní řetězcové hodnoty
- **Dekódování stavu** - numerické kódy mapovány na `new / used / damaged / demo`
- **Binární příznaky** - `is_dealer`, `is_authorized_dealer` z metadat prodejce

Feature engineering:

```python
df["car_age"]          = (CURRENT_YEAR - df["year"]).clip(lower=0)
df["car_age_sq"]       = df["car_age"] ** 2           # nelineární křivka odpisu
df["log_mileage"]      = np.log1p(df["mileage_km"])
df["mileage_per_year"] = (df["mileage_km"] / df["car_age"].clip(lower=1)).clip(upper=200_000)
df["power_per_cc"]     = (df["power_kw"] / df["engine_cc"].replace(0, np.nan)).clip(upper=1.0)
df["log_power"]        = np.log1p(df["power_kw"])
```

`car_age_sq` zachycuje nelineární křivku odpisu (2leté auto ztrácí hodnotu mnohem rychleji než 12leté). `mileage_per_year` rozlišuje mladé auto s vysokým nájezdem od starého se stejným nájezdem - oba mají stejný stav tachometru, ale velmi odlišný kontext.

Po čištění: ~21 000 použitelných řádků, 10 numerických a 9 kategorických příznaků.

---

## Fáze 4 - Modelování

Target je **log(price_eur)** - predikce jsou zpět exponenciovány na EUR při vyhodnocení. Všechny modely běží uvnitř sklearn `Pipeline`:

- Mediánová imputace pro numerické sloupce
- `StandardScaler` pro numerické příznaky
- `OneHotEncoder` pro kategorické (kromě CatBoostu, který je zpracovává nativně)

Pětinásobná cross-validace přes čtyři modely:

| Model | Poznámky |
|---|---|
| Ridge | Lineární baseline |
| Random Forest | 300 stromů, max_depth=20 |
| XGBoost | 800 estimátorů, lr=0.02, depth=6 |
| LightGBM | 800 estimátorů, lr=0.02, depth=7 |

LightGBM měl nejlepší CV skóre, takže šel do `RandomizedSearchCV` se 100 iteracemi pro tuning `num_leaves`, `max_depth`, `learning_rate`, `n_estimators`, `min_child_samples` a `subsample`.

---

## Fáze 5 - CatBoost a Ensemble

CatBoost byl natrénován samostatně, protože zpracovává kategorické příznaky nativně - bez one-hot encodingu, což znamená, že `make` a `model` jsou předány tak jak jsou, bez ztráty informací u vzácných kategorií. Early stopping běžel až do 3 000 iterací.

Finální model blenduje tuned LightGBM a CatBoost v **log prostoru**:

```python
y_pred_ens_log = 0.5 * y_pred_lgb_log + 0.5 * y_pred_cb_log
y_pred_ensemble = np.expm1(y_pred_ens_log)
```

---

## Výsledky

| Metrika | Hodnota |
|---|---|
| R² | ~0.95 |
| MAE | ~900 EUR |
| V rozsahu ±20% | ~85% |

Nejdůležitější příznaky byly `car_age`, `log_mileage`, `make/model` a `power_kw`. `car_age_sq` se konzistentně umísťoval v top 5 - nelineární člen odpisu se vyplatilo přidat.

---

## Co jsem se naučil

**Sync je v pohodě.** Bottleneck byl crawl delay, ne I/O. Synchronní scraper na `requests` s dobrou retry logikou je jednodušší a stejně rychlý pro tento use case.

**Log transformace targetu není volitelná při predikci cen.** Práce v log prostoru stabilizuje rozptyl a dělá lineární baseline dostatečně rozumnou pro srovnání.

**Feature engineering porazil výběr modelu.** Rozdíl mezi surovými a engineerovanými příznaky byl větší než rozdíl mezi Ridge a LightGBM. `mileage_per_year` a `car_age_sq` samy o sobě stály více než přechod na jiný algoritmus.

**Checkpointovat od začátku.** Vícehodinový crawl se vždy někde přeruší. Atomické zápisy a sada ID pro deduplikaci znamenala, že resume bylo bezproblémové - žádné čištění, žádné opakování.
