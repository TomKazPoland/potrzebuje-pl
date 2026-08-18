# potrzebuje.pl

This repository is the version-controlled Source of Truth for the
potrzebuje.pl website and its operational documentation after completion
of AP-09 synchronization.

## Current website version

The current verified product baseline originates from:

`/home/potrzebuje/public_html/3pillars`

Supported languages:

- PL
- EN
- DE
- FR
- ZH
- HI

Architecture:

`thin language wrappers`
→ `inc/landing_template.php`
→ `central canonical i18n`
→ frontend / generator / API / Contact / SEO / CTA / footer

## Important files

- `index.php`, `en/index.php`, `de/index.php`, `fr/index.php`,
  `zh/index.php`, `hi/index.php` — thin language entry points.
- `inc/landing_template.php` — shared page/layout and frontend behavior.
- `inc/i18n_master.php` — runtime translation data.
- `inc/i18n_runtime.php` — translation helper/runtime interface.
- `demo_api.php` — AI demo backend.
- `contact.php` — multilingual contact form.
- `i18n/i18n_catalog_linguistically_reviewed.json` — durable canonical
  language catalog.
- `doc/THREE_PILLARS_CURRENT_STATE.md` — precise current website state.
- `doc/POTRZEBUJE.PL_OPERATIONS.md` — ecosystem operations.
- `RUNBOOK.md` — concise deploy/test/rollback procedure.

## Safety

Do not commit runtime counters, user input logs, databases, credentials,
API keys, private SSH material or server-side backups.

Production is not a Git checkout.

## Deployment status

Automatic deployment is intentionally LOCKED while AP-09.4 verifies the
correct `/3pillars` deployment target and rollback contract.

A push to `main` must not cause an accidental root-site cutover.

See `RUNBOOK.md`.
