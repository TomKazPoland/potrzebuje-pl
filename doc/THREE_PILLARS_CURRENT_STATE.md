# THREE PILLARS — CURRENT STATE

Last reconciled: 18 August 2026

## Status

Current verified production baseline:

`/home/potrzebuje/public_html/3pillars`

AP-08 Final QA: CLOSED 100%.

AP-09:
- AP9.1 repository/deployment current-state DIAG: CLOSED.
- AP9.2 production-first GitHub reconciliation: content reconciliation PASS.
- AP9.3 documentation/canonical durability: candidate BUILD in progress.
- AP9.4 GitHub main + deployment/rollback contract: NOT YET APPLIED.
- AP9.5 release readiness and `/3pillars/ → /` decision: NOT STARTED.

`/3pillars/ → /` cutover has NOT been performed.

## Languages

Six live language variants:

- PL — `/3pillars/`
- EN — `/3pillars/en/`
- DE — `/3pillars/de/`
- FR — `/3pillars/fr/`
- ZH — `/3pillars/zh/`
- HI — `/3pillars/hi/`

## Architecture

The deterministic page architecture is:

thin language wrappers
→ shared `inc/landing_template.php`
→ central i18n runtime
→ frontend / JS / generator / API / Contact / SEO / CTA / footer

Language wrappers contain only language selection and shared-template
loading.

Independent full language copies are obsolete.

## Canonical i18n

Canonical catalog:

`i18n/i18n_catalog_linguistically_reviewed.json`

Verified baseline:
- records: 113
- languages: 6
- values: 678
- SHA-256:
  `2338406b8680de493c1a905ccdf0f60b7aa8dc60e83933e84af1260c32f544f2`

Deterministic user-visible text must come from the canonical i18n
architecture wherever technically predictable.

Genuinely dynamic LLM free-form responses are the principal exception.

## Current shared product files

- `inc/landing_template.php`
- `inc/landing_texts.php`
- `inc/landing_helpers.php`
- `inc/i18n_master.php`
- `inc/i18n_runtime.php`
- `contact.php`
- `demo_api.php`

Legacy:

`inc/landing_translations.php`

is intentionally removed and must not be restored.

## Generator

Current generator behavior includes:
- shared frontend implementation,
- backend word-limit enforcement,
- backend daily-limit enforcement,
- language passed with request,
- six-language normalization,
- canonical deterministic errors,
- LLM answer language matching current page language.

## Contact

Current Contact preserves:
- sender email,
- subject,
- message,
- required-field validation,
- email validation,
- send logic,
- WhatsApp contact,
- canonical multilingual deterministic messages.

## GitHub reconciliation result

The August 2026 AP-09 reconciliation treated current production as the
authoritative product baseline.

Older GitHub product behavior was compared semantically, including:
Contact, wrappers/template, generator limits, API error handling, routing
and six-language behavior.

Result:

`OLD_GITHUB_PRODUCT_BEHAVIOR_STATUS=
FUNCTIONALLY_ACCOUNTED_FOR_BY_CURRENT_ARCHITECTURE`

Old product code must not be restored merely because it existed in the
previous GitHub state.

Useful GitHub operational knowledge and project history are retained and
updated separately.

## Deployment state

Previous GitHub workflow used push-to-main SFTP deployment with a broad
repository source.

During AP-09 synchronization automatic deployment is intentionally locked.

AP9.4 must verify:
- exact target path,
- explicit deployment source,
- exclusions,
- rollback procedure,
- deployment verification,
before automatic deployment is re-enabled.

## Source-of-truth transition

Until the reconciled repository is committed and verified:

CURRENT production `/3pillars` remains the authoritative product baseline.

After successful AP9.4/AP9.5 completion, GitHub `main` becomes the normal
development Source of Truth again.
