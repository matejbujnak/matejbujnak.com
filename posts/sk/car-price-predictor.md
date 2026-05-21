---
title: End-to-End Car Price Predictor - Od scrapingu po LightGBM
date: 2025-05-01
description: Ako som postavil kompletný dátový pipeline - od slušného web scrapera s checkpointom až po ensemble model, ktorý predikuje ceny ojazdených áut s R² ~0.95 a MAE ~900 EUR.
tags: Python, Machine Learning, LightGBM, Data Engineering
---

## Cieľ

Slovenské a české autoportály neponúkajú verejné API. Ak chceš štruktúrované dáta, musíš si ich obstarať sám. Chcel som postaviť systém, ktorý dokáže odpovedať na jednu otázku: **je tento inzerát férovo ocenený?**

Projekt je rozdelený do dvoch repozitárov: scraper ([car-listing-collector](https://github.com/matejbujnak/car-listing-collector)) a ML pipeline ([car-price-predictor](https://github.com/matejbujnak/car-price-predictor)), pokrývajúci celý životný cyklus od surového HTML po nasadený predikčný model.

---

## Fáza 1 - Zber dát

### Rešpektovanie pravidiel servera

Pred prvým requestom scraper stiahne `robots.txt` cez `urllib.robotparser` a každú URL pred prístupom skontroluje:

```python
if not robots.can_fetch(USER_AGENT, url):
    logger.warning("robots.txt disallows %s", url)
    return None
```

User-Agent je popisný reťazec identifikujúci projekt: `car-listing-collector/1.0 (personal research; github.com; respects robots.txt)`. Žiadna rotácia - jedna poctivá identita, konzistentne používaná.

### HTTP a retry logika

Scraper používa synchrónnu knižnicu `requests` s `urllib3.Retry` adapterom:

```python
retry = Retry(
    total=5,
    backoff_factor=3,
    status_forcelist=[429, 500, 502, 503, 504],
    respect_retry_after_header=True,
)
```

Odpoveď `429 Too Many Requests` je automaticky ošetrená backoffom. Session posiela `Accept-Language: sk-SK` pre lokalizované dáta.

### Autodiscovery značiek

Namiesto hardcoded zoznamu značiek ich scraper objavuje dynamicky. Stránka s výpisom inzerátov obsahuje Next.js blob `__NEXT_DATA__` s agregáciami - scraper ho parsuje:

```python
def parse_makes(html: str) -> list[dict]:
    data = _extract_next_data(html)
    agg_list = data["props"]["pageProps"]["aggregations"]["aggregations"]
    return [
        {"sef": a["sef"], "label": a["label"], "count": a["count"]}
        for a in agg_list if a.get("sef")
    ]
```

Vráti ~100 značiek s ich URL slug. Žiadny BeautifulSoup - čistý `re.search` + `json.loads` na script tagu.

### Crawl delay

Dvojstupňový delay systém udržuje záťaž na rozumnej úrovni:

```python
MIN_DELAY = 2.5
MAX_DELAY = 6.0
LONG_BREAK_EVERY = 40    # requestov
LONG_BREAK_MIN   = 45    # sekúnd
LONG_BREAK_MAX   = 90    # sekúnd
```

Každý request čaká 2.5–6 s. Každý 40. request spustí pauzu 45–90 s. To udržuje záťaž servera nízku aj pri viachodinových crawloch.

### Checkpoint a resume

Scraper segmentuje crawl podľa `(make, year_from, year_to, price_from, price_to)`. Ak má segment viac ako 1 000 inzerátov (50 strán × 20), rekurzívne ho rozdelí:

1. Binárne rozdelenie roka: `mid = (year_from + year_to) // 2`
2. Ak jeden rok stále presahuje 1 000 → rozdelenie do cenových pásiem `[0, 3k, 6k, 10k, 15k, 20k, 30k, 50k, 100k, None]` EUR
3. Stále príliš veľké → akceptované s varovaním

Progress sa zapisuje atomicky do `data/progress.json` cez `tempfile.mkstemp` + `os.replace` - žiadne neúplné zápisy pri páde. Videné ID sú sledované v pamäti a flushované každých 100 inzerátov, takže resume nikdy nevytvorí duplikáty.

---

## Fáza 2 - EDA

Zozbieraný dataset bol preskúmaný z niekoľkých pohľadov pred akýmkoľvek modelovaním:

- **Distribúcia cien** - silne pravostranná, potvrdzujúca log-cenu ako správny target
- **Cena vs. rok** - silná závislosť po log transformácii
- **Cena vs. najazdené km** - hexbin scatter ukazuje jasnú negatívnu koreláciu s výrazným šumom od značky/modelu
- **Typ paliva** - diesel dominuje; EV tvorí výrazný cluster s vysokými cenami
- **Geografia** - rozdelenie SK/CZ, regionálna cenová variácia

Tieto zistenia priamo ovplyvnili kroky čistenia a feature engineeringu.

---

## Fáza 3 - Čistenie a Feature Engineering

Surové inzeráty vyžadovali výraznú prácu:

- **Deduplikácia** - ten istý inzerát je často znovu zverejnený
- **Odstránenie odľahlých hodnôt** - cena pod 500 EUR alebo nad 150 000 EUR, najazdené nad 700 000 km
- **Normalizácia** - typ paliva, prevodovka a karoséria mali nekonzistentné reťazcové hodnoty
- **Dekódovanie stavu** - numerické kódy mapované na `new / used / damaged / demo`
- **Binárne príznaky** - `is_dealer`, `is_authorized_dealer` z metadát predajcu

Feature engineering:

```python
df["car_age"]          = (CURRENT_YEAR - df["year"]).clip(lower=0)
df["car_age_sq"]       = df["car_age"] ** 2           # nelineárna krivka odpisu
df["log_mileage"]      = np.log1p(df["mileage_km"])
df["mileage_per_year"] = (df["mileage_km"] / df["car_age"].clip(lower=1)).clip(upper=200_000)
df["power_per_cc"]     = (df["power_kw"] / df["engine_cc"].replace(0, np.nan)).clip(upper=1.0)
df["log_power"]        = np.log1p(df["power_kw"])
```

`car_age_sq` zachytáva nelineárnu krivku odpisu (2-ročné auto stráca hodnotu oveľa rýchlejšie ako 12-ročné). `mileage_per_year` rozlišuje mladé auto s vysokým nájazdom od starého s rovnakým nájazdom - obe majú rovnaký stav tachometra, ale veľmi odlišný kontext.

Po čistení: ~21 000 použiteľných riadkov, 10 numerických a 9 kategorických príznakov.

---

## Fáza 4 - Modelovanie

Target je **log(price_eur)** - predikcie sú späť exponenciované na EUR pri vyhodnotení. Všetky modely bežia vnútri sklearn `Pipeline`:

- Mediánová imputácia pre numerické stĺpce
- `StandardScaler` pre numerické príznaky
- `OneHotEncoder` pre kategorické (okrem CatBoostu, ktorý ich spracováva natívne)

Päťnásobná cross-validácia cez štyri modely:

| Model | Poznámky |
|---|---|
| Ridge | Lineárny baseline |
| Random Forest | 300 stromov, max_depth=20 |
| XGBoost | 800 estimátorov, lr=0.02, depth=6 |
| LightGBM | 800 estimátorov, lr=0.02, depth=7 |

LightGBM mal najlepšie CV skóre, takže šiel do `RandomizedSearchCV` so 100 iteráciami pre tuning `num_leaves`, `max_depth`, `learning_rate`, `n_estimators`, `min_child_samples` a `subsample`.

---

## Fáza 5 - CatBoost a Ensemble

CatBoost bol natrénovaný samostatne, pretože spracováva kategorické príznaky natívne - bez one-hot encodingu, čo znamená, že `make` a `model` sú predané tak ako sú, bez straty informácií pri vzácnych kategóriách. Early stopping bežal až do 3 000 iterácií.

Finálny model blenduje tuned LightGBM a CatBoost v **log priestore**:

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

Najdôležitejšie príznaky boli `car_age`, `log_mileage`, `make/model` a `power_kw`. `car_age_sq` sa konzistentne umiestňoval v top 5 - nelineárny člen odpisu sa oplatilo pridať.

---

## Čo som sa naučil

**Sync je v pohode.** Bottleneck bol crawl delay, nie I/O. Synchrónny scraper na `requests` s dobrou retry logikou je jednoduchší a rovnako rýchly pre tento use case.

**Log transformácia targetu nie je voliteľná pri predikcii cien.** Práca v log priestore stabilizuje rozptyl a robí lineárny baseline dostatočne rozumným pre porovnanie.

**Feature engineering porazil výber modelu.** Rozdiel medzi surovými a engineerovanými príznakmi bol väčší ako rozdiel medzi Ridge a LightGBM. `mileage_per_year` a `car_age_sq` samé osebe stáli viac ako prechod na iný algoritmus.

**Checkpointovať od začiatku.** Viachodinový crawl sa vždy niekde preruší. Atomické zápisy a množina ID pre deduplikáciu znamenala, že resume bolo bezproblémové - žiadne čistenie, žiadne opakovanie.
