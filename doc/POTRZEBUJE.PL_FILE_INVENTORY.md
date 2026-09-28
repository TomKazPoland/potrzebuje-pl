# POTRZEBUJE.PL FILE INVENTORY

Last Review Date: 24/09/2026

## 1. Classification

### CRITICAL

Required for production operation.

Backup/rollback required before risky modification.

### SECRET

Credentials, API keys, tokens and sensitive configuration.

Never expose or commit.

### SOURCE

Version-controlled product/documentation source.

### RUNTIME

Production-only operational state.

Do not assume it belongs in GitHub.

### GENERATED

Logs, counters, caches, previews and other generated state.

### ARCHIVE

Historical backup or restore material.

Do not use it as current Source of Truth without explicit verification.

## 2. Canonical repository

Repository:

`TomKazPoland/potrzebuje-pl`

Normal Source of Truth:

GitHub `main`.

Current accepted release:

`91139569ad0adab2c8b512ab37aeed724058de2a`

Production target:

`/home/potrzebuje/public_html`

Production is not a Git checkout.

## 3. Production language structure

Supported languages:

- PL
- EN
- DE
- FR
- ZH
- HI

Root/default:

PL.

Localized directories include:

- `/en`
- `/de`
- `/fr`
- `/zh`
- `/hi`

Shared architecture is preferred over independent full-page copies.

## 4. Main website shared source

Important SOURCE / CRITICAL areas include:

- root/language page wrappers,
- `inc/landing_template.php`,
- shared helpers/components,
- `inc/site_nav.php`,
- `assets/site-shell.css`,
- `contact.php`,
- `demo_api.php`,
- `.htaccess`,
- `robots.txt`,
- canonical/runtime i18n files.

Exact file names must be confirmed from current Git state before a release.

## 5. Canonical i18n

Canonical repository source:

`i18n/i18n_catalog_linguistically_reviewed.json`

Classification:

SOURCE / CRITICAL / I18N CANONICAL.

Generated/runtime master:

`inc/i18n_master.php`

Runtime translation layer:

`inc/i18n_runtime.php`

Current accepted baseline:

- 212 records,
- 1272 localized values,
- 6 languages.

Software Development subset:

- 99 `software.*` records,
- 594 localized values.

## 6. Software Development

Routes:

- `/software-development/`
- `/en/software-development/`
- `/de/software-development/`
- `/fr/software-development/`
- `/zh/software-development/`
- `/hi/software-development/`

Shared SOURCE / CRITICAL files include:

- `inc/software_development_template.php`
- `assets/software-development.css`
- canonical i18n
- generated/runtime i18n master
- six thin route wrappers.

Current browser CSS reference:

`/assets/software-development.css?v=ce0b45f07b18e542`

AP10.8 release-specific four-file manifest was:

- `assets/software-development.css`
- `i18n/i18n_catalog_linguistically_reviewed.json`
- `inc/i18n_master.php`
- `inc/software_development_template.php`

Important:

this is historical evidence for AP10.8, not a universal deployment manifest.

Future manifests must come from current diff + current architecture.

## 7. Canonical documentation

Canonical documentation is version-controlled under:

`doc/`

Important current documents:

- `doc/Methodologies_to_be_followed.txt`
- `doc/POTRZEBUJE.PL_OPERATIONS.md`
- `doc/PROJECT_STATUS.md`
- `doc/POTRZEBUJE_MASTER_CONTEXT.md`
- `doc/POTRZEBUJE.PL_FILE_INVENTORY.md`
- `doc/THREE_PILLARS_CURRENT_STATE.md`

Historical documentation belongs under:

`doc/history/`

Documentation in old backups/worktrees is not canonical unless it matches
current `main`.

## 8. Legacy public documentation copies

As of 24/09/2026 stale copies were present under:

`/home/potrzebuje/public_html/doc`

and returned HTTP 200 publicly.

These files are:

- non-canonical,
- stale relative to GitHub `main`,
- not required as public website content.

Do not update them as if they were the Source of Truth.

Blocking/removal belongs to a separate controlled hardening change.

## 9. Runtime / generated data — do not commit

Examples:

- `_counters/*`
- `demo_user_inputs.log`
- `error_log`
- operational/diagnostic logs
- generated previews
- caches
- runtime databases
- temporary deployment artifacts.

Runtime assets may be important for operation/recovery while still not
belonging in Git.

## 10. Secrets — never commit

Secret directories/files remain outside `public_html` and outside Git.

Do not:

- print them,
- copy them into public paths,
- include secret contents in diagnostics,
- add them to documentation,
- commit them.

## 11. Backups

Controlled production backups are stored outside the public product tree.

Current project convention includes:

`/home/potrzebuje/Projects/Server_Only/potrzebuje-pl/sure_backups`

Backups are recovery artifacts, not deployable canonical source.

Retain them until the relevant release is proven stable.

## 12. Worktrees / temporary artifacts

Examples:

`/home/potrzebuje/Projects/Worktrees`

`/home/potrzebuje/tmp`

These may contain:

- candidate releases,
- old branches,
- generated previews,
- diagnostics,
- bundles,
- historical copies.

Never select a file from these locations as canonical solely because it is
newer by filesystem mtime.

Validate against current Git commit/state.

## 13. Separate applications

Alpha Analyzer and Anonymous remain separate application projects.

Their source belongs to their own repositories/project areas.

Their databases, tokens, runtime logs, virtual environments and server-specific
mounts do not belong to the potrzebuje.pl website repository.

## 14. Release artifact classification

For each release distinguish:

SOURCE:

version-controlled files.

BUILD/CANDIDATE:

off-production generated/test candidate.

BACKUP:

pre-APPLY production snapshot.

RUNTIME:

production state.

LOG:

verification evidence.

PREVIEW:

non-production browser candidate.

Do not confuse preview or backup artifacts with deployable canonical source.

## 15. Inventory update rule

Update this inventory whenever:

- a critical source file is added/removed,
- canonical i18n location/contract changes,
- deployment strategy changes,
- language support changes,
- shared template architecture changes,
- secret/runtime classification changes,
- an application is added,
- restore strategy changes,
- major hosting architecture changes.

## 16. Current release evidence

Accepted Software Development production release:

`91139569ad0adab2c8b512ab37aeed724058de2a`

Final verification on 24/09/2026 confirmed:

- GitHub `main` alignment,
- production product hash parity,
- six language routes,
- six homepage Software Development links,
- versioned CSS,
- Contact,
- AI demo safe smoke,
- protected secret isolation,
- real-browser visual acceptance.
