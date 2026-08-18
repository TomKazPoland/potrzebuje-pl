# POTRZEBUJE.PL FILE INVENTORY

Last Review Date: 18/08/2026

## 1. Classification

### CRITICAL

Required for production operation.

Backup/rollback required before risky modification.

### SECRET

Credentials, API keys, tokens and sensitive configuration.

Never expose or commit.

### SOURCE

Version-controlled product source.

### RUNTIME

Production-only operational state.

Do not assume it belongs in GitHub.

### GENERATED

Logs, counters, caches and other generated state.

### ARCHIVE

Historical backup or restore material.

## 2. Current `/3pillars` source

Production root:

`/home/potrzebuje/public_html/3pillars`

Critical source includes:
- language wrappers: PL/EN/DE/FR/ZH/HI;
- `inc/landing_template.php`;
- `inc/landing_texts.php`;
- `inc/landing_helpers.php`;
- `inc/i18n_master.php`;
- `inc/i18n_runtime.php`;
- `contact.php`;
- `demo_api.php`;
- static assets;
- `.htaccess`/`robots.txt` where present.

## 3. Canonical i18n

Repository source:

`i18n/i18n_catalog_linguistically_reviewed.json`

Type:
SOURCE / CRITICAL / I18N CANONICAL.

Current verified baseline:
113 records × 6 languages.

## 4. Repository-only operational source

GitHub should contain:
- `.github/workflows/*`;
- `README.md`;
- `RUNBOOK.md`;
- `BRANCH_STRATEGY.md`;
- `doc/*`;
- canonical i18n.

These files do not need to be publicly served by the website.

## 5. Runtime / generated data — do not commit

Examples:
- `_counters/*`;
- `demo_user_inputs.log`;
- `error_log`;
- diagnostic logs;
- generated caches;
- runtime databases.

## 6. Secrets — do not commit

Secret directories/files remain outside public_html and outside Git.

Never copy, print, hash or expose their contents during project scripts.

## 7. Backups and archives

Product backup copies, `.bak`, `.backup_*`, `.bad_apply_*` and server-only
archives are not normal repository source.

Preserve appropriate recovery copies outside the deployable source tree.

## 8. Legacy three-pillars source

`inc/landing_translations.php` is obsolete.

It was replaced by the central canonical i18n architecture.

Do not restore it.

## 9. Separate applications

Alpha Analyzer and Anonymous remain separate application projects.

Their source belongs to their own repositories.

Their databases, tokens, runtime logs and server-specific mounts do not
belong to this website repository.

## 10. Inventory update rule

Update this inventory whenever:
- a critical file is added/removed,
- canonical i18n location changes,
- deployment changes,
- secret/runtime classification changes,
- an application is added,
- restore strategy changes,
- major hosting architecture changes.
