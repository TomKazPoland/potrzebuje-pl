# POTRZEBUJE.PL FILE INVENTORY

Last Review Date:
18/06/2026

Document Purpose:

This document lists the most important files and directories in the potrzebuje.pl ecosystem.

It explains:

* where important files are located,
* what role they play,
* whether they are safe to modify,
* whether they belong in GitHub,
* whether they must be backed up,
* which files are secrets, runtime-only assets, logs, databases or deployment files.

This document complements:

* POTRZEBUJE.PL_MASTER_CONTEXT.md
* POTRZEBUJE.PL_OPERATIONS.md
* PROJECT_STATUS.md

---

# 1. INVENTORY CLASSIFICATION

## CRITICAL

Files or directories required for production operation.

Modification rule:

Backup before change.

## SECRET

Files containing credentials, tokens, API keys or sensitive configuration.

Modification rule:

Never expose.
Never commit.
Backup securely.

## SOURCE

Application source code.

Modification rule:

Modify through GitHub when possible.

## RUNTIME

Files existing only on production server.

Modification rule:

Do not assume they exist in GitHub.

## GENERATED

Logs, counters, cache, temporary files.

Modification rule:

Usually do not commit.
Usually do not manually edit.

## ARCHIVE

Backup or restore material.

Modification rule:

Do not delete unless replacement backup exists.

---

# 2. MAIN WEBSITE — PRODUCTION FILES

Production Root:

/home/potrzebuje/public_html

## /home/potrzebuje/public_html/index.php

Type:

SOURCE / CRITICAL

Role:

Main Polish landing page for potrzebuje.pl.

Contains:

* main website content
* business presentation
* AI service messaging
* frontend sections
* AI demo frontend integration

GitHub:

YES

Safe to modify:

YES, but through GitHub workflow.

Backup required before direct production edit:

YES

---

## /home/potrzebuje/public_html/nav.php

Type:

SOURCE / CRITICAL

Role:

Shared navigation component.

Used by:

* Polish site
* English site
* German site, if included by localized pages

GitHub:

YES

Safe to modify:

YES, but verify all language versions after change.

Risk:

Navigation changes can affect multiple pages.

---

## /home/potrzebuje/public_html/nav-mobile.css

Type:

SOURCE

Role:

Mobile navigation styling.

GitHub:

YES

Safe to modify:

YES

Verification required:

Mobile browser view.

---

## /home/potrzebuje/public_html/contact.php

Type:

SOURCE / CRITICAL

Role:

Contact page and contact form logic.

Contains:

* contact form handling
* business contact channel
* possible WhatsApp integration
* email sending logic

GitHub:

YES

Safe to modify:

YES, but verify contact form after change.

Verification:

* form submission
* email delivery
* page rendering
* spam protection behavior, if present

---

## /home/potrzebuje/public_html/config.php

Type:

SOURCE / CRITICAL

Role:

Central PHP configuration for potrzebuje.pl.

Contains:

* AI demo limits
* language settings
* localized UI strings
* OpenAI-related constants/fallbacks
* safety constraints

GitHub:

YES

Safe to modify:

CAREFULLY

Backup required:

YES

Important Notes:

This file may contain legacy fallback logic for older secret locations.

Current production OpenAI secret source of truth is:

/home/potrzebuje/Projects/Secrets/chatgpt.php

Do not add real secrets to config.php.

---

## /home/potrzebuje/public_html/demo_api.php

Type:

SOURCE / CRITICAL

Role:

Backend endpoint for Mini-demo AI widget.

Flow:

Frontend request
→ demo_api.php
→ config.php
→ chatgpt.php
→ OpenAI API
→ JSON response

Contains:

* JSON request handling
* input validation
* language handling
* rate limiting
* OpenAI call
* logging
* output length enforcement

GitHub:

YES

Safe to modify:

CAREFULLY

Backup required:

YES

Verification after change:

* AI demo returns JSON
* invalid input handled correctly
* daily counters work
* no secrets exposed
* logs created correctly

---

# 3. LANGUAGE DIRECTORIES

## /home/potrzebuje/public_html/en

Type:

SOURCE

Role:

English version of website.

Important files:

/home/potrzebuje/public_html/en/index.php
/home/potrzebuje/public_html/en/contact.php

GitHub:

YES

Safe to modify:

YES

Verification:

English website rendering and contact flow.

---

## /home/potrzebuje/public_html/de

Type:

SOURCE

Role:

German version of website.

Important files:

/home/potrzebuje/public_html/de/index.php
/home/potrzebuje/public_html/de/contact.php

GitHub:

YES

Safe to modify:

YES

Verification:

German website rendering and contact flow.

---

# 4. IMAGES AND STATIC ASSETS

## /home/potrzebuje/public_html/Images

Type:

SOURCE / STATIC

Role:

Website images and logo files.

Known files include:

* logo.svg
* logo_25_12_2025.svg
* logo_27_01_2026.svg
* logo (2).svg

GitHub:

YES

Safe to modify:

YES

Risk:

Logo/image changes affect branding.

---

## /home/potrzebuje/public_html/216C11B3-B3D4-4FC6-8B88-82A039F6BF37.PNG

Type:

SOURCE / STATIC

Role:

Static image asset.

GitHub:

YES

Safe to modify:

YES, but verify whether it is still used before deletion.

---

# 5. DEPLOYMENT FILES

## /home/potrzebuje/public_html/.github/workflows/deploy.yml

Type:

SOURCE / DEPLOYMENT / CRITICAL

Role:

GitHub Actions workflow for deployment.

Current model:

GitHub push to main
→ GitHub Actions
→ SFTP upload
→ production public_html

Uses:

appleboy/scp-action

GitHub:

YES

Safe to modify:

CAREFULLY

Risk:

Wrong change can break automatic deployment.

Do not expose:

GitHub Secrets values.

---

## /home/potrzebuje/public_html/.cpanel.yml

Type:

SOURCE / DEPLOYMENT / LEGACY-RISK

Role:

cPanel deployment configuration.

Important Note:

Current active deployment appears to be GitHub Actions via SFTP.

Known Risk:

.cpanel.yml contains a likely stale or incorrect path:

/home/potrzebu/public_html/

This should not be trusted as active deployment source without verification.

GitHub:

YES

Safe to modify:

ONLY after deployment strategy review.

---

## /home/potrzebuje/public_html/.gitignore

Type:

SOURCE / GIT CONFIG

Role:

Defines files excluded from Git.

Important:

Should exclude logs, counters, runtime data, secrets and generated files.

GitHub:

YES

Safe to modify:

YES, but verify that no sensitive files become tracked.

---

# 6. SECRETS

## /home/potrzebuje/Projects/Secrets

Type:

SECRET / CRITICAL / RUNTIME

Role:

Directory containing secrets outside public_html.

GitHub:

NO

Expose publicly:

NO

Backup:

YES, securely.

---

## /home/potrzebuje/Projects/Secrets/chatgpt.php

Type:

SECRET / CRITICAL

Role:

Production OpenAI secret source of truth.

Contains:

* OpenAI API key
* OpenAI model constants / compatibility constants

Known constants:

CHATGPT_API_KEY
OPENAI_API_KEY
OPENAI_MODEL

Current model:

gpt-4o-mini

GitHub:

NO

Expose to ChatGPT:

NO

Expose in logs:

NO

Backup:

YES, securely.

Modification rule:

Only modify deliberately.
Never paste contents publicly.
Never move into public_html.

---

# 7. LOGS

## /home/potrzebuje/public_html/logs

Type:

GENERATED / RUNTIME

Role:

Main diagnostic and inventory logs for potrzebuje.pl.

GitHub:

NO

Backup:

OPTIONAL, depending on diagnostic value.

Safe to delete:

Only old logs after confirming no active investigation depends on them.

---

## /home/potrzebuje/public_html/demo_user_inputs.log

Type:

GENERATED / RUNTIME / USER INPUT LOG

Role:

Stores user inputs submitted through the AI demo.

GitHub:

NO

Sensitive:

POTENTIALLY

Reason:

May contain real user-entered text.

Backup:

OPTIONAL / CAREFULLY

Expose publicly:

NO

---

## /home/potrzebuje/public_html/error_log

Type:

GENERATED / RUNTIME

Role:

PHP/server error log.

GitHub:

NO

Safe to modify:

NO

Safe to clear:

Only after backup if needed.

---

# 8. RATE LIMITING / COUNTERS

## /home/potrzebuje/public_html/_counters

Type:

GENERATED / RUNTIME

Role:

File-based per-IP daily counters for AI demo.

Used by:

demo_api.php

GitHub:

NO

Safe to delete:

Only if intentionally resetting rate limits.

Backup:

Usually NO

---

# 9. PUBLIC APPLICATION MOUNTS

## /home/potrzebuje/public_html/apps

Type:

PUBLIC MOUNT DIRECTORY

Role:

Public URL mount for additional hosted applications.

Known subdirectories:

/home/potrzebuje/public_html/apps/alpha-analyzer
/home/potrzebuje/public_html/apps/anonymous

Important:

These are public mounts only.

Real application code is under:

/home/potrzebuje/Projects

---

## /home/potrzebuje/public_html/apps/alpha-analyzer/.htaccess

Type:

RUNTIME / PASSENGER CONFIG / CRITICAL

Role:

Passenger / LiteSpeed mount configuration for Alpha Analyzer.

Points to:

/home/potrzebuje/Projects/alpha_analyzer

GitHub:

NO or application-specific repository only.

Safe to modify:

CAREFULLY

Verification:

Alpha Analyzer URL and health endpoint.

---

## /home/potrzebuje/public_html/apps/anonymous/.htaccess

Type:

RUNTIME / PASSENGER CONFIG / CRITICAL

Role:

Passenger / LiteSpeed mount configuration for Anonymous app.

Points to:

/home/potrzebuje/Projects/anonymous_app

GitHub:

NO or application-specific repository only.

Safe to modify:

CAREFULLY

Verification:

Anonymous application URL.

---

# 10. ALPHA ANALYZER APPLICATION

Project Root:

/home/potrzebuje/Projects/alpha_analyzer

Public Mount:

/home/potrzebuje/public_html/apps/alpha-analyzer

Repository:

TomKazPoland/alpha_analyzer

Branch observed:

feature/llm-feedback

Runtime Python:

/home/potrzebuje/virtualenv/Projects/alpha_analyzer/3.11/bin/python

Database:

/home/potrzebuje/Projects/alpha_analyzer/data/alpha_analyzer.db

---

## /home/potrzebuje/Projects/alpha_analyzer/README.md

Type:

DOCUMENTATION

Role:

Main Alpha Analyzer documentation.

GitHub:

YES, application repository.

---

## /home/potrzebuje/Projects/alpha_analyzer/RUNBOOK.md

Type:

DOCUMENTATION / OPERATIONS

Role:

Operational guide for Alpha Analyzer.

GitHub:

YES, application repository.

---

## /home/potrzebuje/Projects/alpha_analyzer/AGENTS.md

Type:

DOCUMENTATION / AGENT RULES

Role:

Rules for AI agents and developers working on Alpha Analyzer.

GitHub:

YES, application repository.

---

## /home/potrzebuje/Projects/alpha_analyzer/docs/ARCHITECTURE.md

Type:

DOCUMENTATION / ARCHITECTURE

Role:

Architecture description for Alpha Analyzer.

GitHub:

YES, application repository.

---

## /home/potrzebuje/Projects/alpha_analyzer/wsgi.py

Type:

SOURCE / RUNTIME ENTRYPOINT / CRITICAL

Role:

Passenger WSGI entrypoint.

GitHub:

YES, application repository.

Safe to modify:

CAREFULLY

---

## /home/potrzebuje/Projects/alpha_analyzer/passenger_wsgi.py

Type:

SOURCE / RUNTIME ENTRYPOINT

Role:

Passenger compatibility entrypoint.

GitHub:

YES, application repository.

Safe to modify:

CAREFULLY

---

## /home/potrzebuje/Projects/alpha_analyzer/app/main.py

Type:

SOURCE / CRITICAL

Role:

Main Flask application routes and backend logic.

GitHub:

YES, application repository.

Safe to modify:

CAREFULLY

---

## /home/potrzebuje/Projects/alpha_analyzer/app/db.py

Type:

SOURCE / CRITICAL

Role:

Database access layer.

GitHub:

YES, application repository.

Safe to modify:

CAREFULLY

---

## /home/potrzebuje/Projects/alpha_analyzer/app/config.py

Type:

SOURCE / CONFIG

Role:

Application configuration.

GitHub:

YES, application repository.

Safe to modify:

CAREFULLY

---

## /home/potrzebuje/Projects/alpha_analyzer/app/llm/openai_client.py

Type:

SOURCE / LLM

Role:

OpenAI client integration.

GitHub:

YES, application repository.

Safe to modify:

CAREFULLY

---

## /home/potrzebuje/Projects/alpha_analyzer/app/llm/prompt_builder.py

Type:

SOURCE / LLM

Role:

Prompt construction for LLM analysis.

GitHub:

YES, application repository.

Safe to modify:

YES, with output verification.

---

## /home/potrzebuje/Projects/alpha_analyzer/app/llm/source_fetcher.py

Type:

SOURCE / LLM / CONTEXT

Role:

Source/context extraction for LLM prompts.

GitHub:

YES, application repository.

Safe to modify:

YES, with LLM flow verification.

---

## /home/potrzebuje/Projects/alpha_analyzer/templates/instrument.html

Type:

SOURCE / FRONTEND TEMPLATE

Role:

Instrument detail page template.

GitHub:

YES, application repository.

Safe to modify:

YES, with UI verification.

---

## /home/potrzebuje/Projects/alpha_analyzer/static/js/chart.js

Type:

SOURCE / FRONTEND / CRITICAL

Role:

Chart frontend logic.

Responsible for:

* chart canvas
* price line
* trend line
* technical indicators rendering
* market state summary
* LLM form handling

Safe to modify:

CAREFULLY

Verification required:

PATCH_OK
→ file grep OK
→ live HTML OK
→ browser visible OK
→ console no errors

---

## /home/potrzebuje/Projects/alpha_analyzer/data/alpha_analyzer.db

Type:

DATABASE / RUNTIME / CRITICAL

Role:

SQLite production database for Alpha Analyzer.

GitHub:

NO

Backup:

YES

Modify directly:

NO, unless using controlled database procedure.

---

## /home/potrzebuje/Projects/alpha_analyzer/data/admin_update_token.txt

Type:

SECRET / TOKEN / CRITICAL

Role:

Admin update token for local data import endpoint.

GitHub:

NO

Expose:

NO

Backup:

YES, securely.

---

# 11. ANONYMOUS APPLICATION

Project Root:

/home/potrzebuje/Projects/anonymous_app

Public Mount:

/home/potrzebuje/public_html/apps/anonymous

Repository:

TomKazPoland/app_anonymous

Branch observed:

main

Database:

/home/potrzebuje/Projects/anonymous_app/data/mapping.db

Purpose:

Anonymization benchmark and quality analysis.

---

## /home/potrzebuje/Projects/anonymous_app/README.md

Type:

DOCUMENTATION

Role:

Main Anonymous app documentation.

GitHub:

YES, application repository.

---

## /home/potrzebuje/Projects/anonymous_app/RUNBOOK.md

Type:

DOCUMENTATION / OPERATIONS

Role:

Operational instructions for Anonymous app.

GitHub:

YES, application repository.

---

## /home/potrzebuje/Projects/anonymous_app/AGENTS.md

Type:

DOCUMENTATION / AGENT RULES

Role:

Agent and developer rules for Anonymous app.

GitHub:

YES, application repository.

---

## /home/potrzebuje/Projects/anonymous_app/SETUP_FOR_NEW_SERVER.md

Type:

DOCUMENTATION / RESTORE / SETUP

Role:

Setup guide for new server.

GitHub:

YES, application repository.

---

## /home/potrzebuje/Projects/anonymous_app/wsgi.py

Type:

SOURCE / RUNTIME ENTRYPOINT / CRITICAL

Role:

Passenger WSGI entrypoint.

GitHub:

YES, application repository.

Safe to modify:

CAREFULLY

---

## /home/potrzebuje/Projects/anonymous_app/requirements.txt

Type:

SOURCE / DEPENDENCIES

Role:

Python dependency list.

GitHub:

YES, application repository.

Safe to modify:

YES, but verify runtime compatibility.

---

## /home/potrzebuje/Projects/anonymous_app/run_local.sh

Type:

SOURCE / LOCAL RUN SCRIPT

Role:

Local execution helper.

GitHub:

YES, application repository.

Safe to modify:

YES

---

## /home/potrzebuje/Projects/anonymous_app/install.sh

Type:

SOURCE / SETUP SCRIPT

Role:

Installation helper.

GitHub:

YES, application repository.

Safe to modify:

CAREFULLY

---

## /home/potrzebuje/Projects/anonymous_app/data/mapping.db

Type:

DATABASE / RUNTIME / CRITICAL

Role:

SQLite production database for Anonymous app.

GitHub:

NO

Backup:

YES

Modify directly:

NO, unless using controlled database procedure.

---

## /home/potrzebuje/Projects/anonymous_app/logs

Type:

GENERATED / RUNTIME

Role:

Anonymous app operational logs.

GitHub:

NO

Backup:

OPTIONAL

---

## /home/potrzebuje/Projects/anonymous_app/backups

Type:

ARCHIVE / BACKUP

Role:

Patch-level and checkpoint backups.

GitHub:

NO, unless specific documentation or manifest is intended for repo.

Delete:

NO, unless replacement backup exists.

---

## /home/potrzebuje/Projects/anonymous_app/archive

Type:

ARCHIVE / RESTORE MATERIAL

Role:

Historical restore points and archived application states.

GitHub:

NO

Delete:

NO, unless replacement backup exists.

---

# 12. LOCAL REPOSITORIES AND SERVER-ONLY MATERIAL

## /home/potrzebuje/Projects/GitHub_Repos

Type:

LOCAL GIT CLONES

Role:

Server-side local clones of GitHub repositories.

Known repository:

/home/potrzebuje/Projects/GitHub_Repos/potrzebuje-pl

GitHub:

YES, as origin remote.

Important:

This is not the same as production public_html.

---

## /home/potrzebuje/Projects/GitHub_Repos/potrzebuje-pl

Type:

LOCAL GIT CLONE / SOURCE

Role:

Local clone of main potrzebuje.pl GitHub repository.

Remote:

https://github.com/TomKazPoland/potrzebuje-pl.git

Branch:

main

Contains:

* main PHP site
* deployment files
* language directories
* static assets

Important:

No README was found during inventory.

---

## /home/potrzebuje/Projects/Server_Only

Type:

SERVER-ONLY / ARCHIVE / BACKUP

Role:

Server-side files and backups not intended for GitHub.

Known directory:

/home/potrzebuje/Projects/Server_Only/potrzebuje-pl

GitHub:

NO

Backup:

YES

Delete:

NO, unless replacement backup exists.

---

# 13. ARCHIVES AND BACKUPS

## /home/potrzebuje/public_html/potrzebuje.pl_11_02_2026.zip

Type:

ARCHIVE / BACKUP

Role:

Historical archive of potrzebuje.pl.

GitHub:

Possibly present in main repo/local clone.

Keep:

YES

---

## /home/potrzebuje/Projects/Server_Only/potrzebuje-pl/sure_backups

Type:

ARCHIVE / RESTORE MATERIAL

Role:

Historical SURE backups for main website.

Contains:

* public_html backup tarballs
* config.php backup
* demo_api.php backup
* sync backup archives

GitHub:

NO

Keep:

YES

---

## /home/potrzebuje/Projects/alpha_analyzer/archive

Type:

ARCHIVE / RESTORE MATERIAL

Role:

Alpha Analyzer restore points and safety snapshots.

GitHub:

NO

Keep:

YES

---

## /home/potrzebuje/Projects/anonymous_app/archive

Type:

ARCHIVE / RESTORE MATERIAL

Role:

Anonymous app restore points and historical application states.

GitHub:

NO

Keep:

YES

---

# 14. FILES THAT MUST NOT BE COMMITTED

Never commit:

* /home/potrzebuje/Projects/Secrets/*
* /home/potrzebuje/Projects/alpha_analyzer/data/*.db
* /home/potrzebuje/Projects/anonymous_app/data/*.db
* /home/potrzebuje/public_html/logs/*
* /home/potrzebuje/public_html/_counters/*
* /home/potrzebuje/public_html/demo_user_inputs.log
* runtime logs
* admin tokens
* API keys
* generated cache
* private SSH keys
* cPanel credentials
* OpenAI credentials

---

# 15. FILES SAFE TO MODIFY THROUGH NORMAL WORKFLOW

Normally safe to modify through GitHub workflow:

* index.php
* nav.php
* nav-mobile.css
* contact.php
* en/index.php
* en/contact.php
* de/index.php
* de/contact.php
* Images/*
* documentation files in /doc
* GitHub workflow files, only with deployment awareness

---

# 16. FILES REQUIRING EXTRA CARE

Modify only with backup and verification:

* config.php
* demo_api.php
* .github/workflows/deploy.yml
* .cpanel.yml
* public_html/apps/*/.htaccess
* Alpha Analyzer WSGI files
* Anonymous WSGI files
* database files
* secret files
* admin token files

---

# 17. FILES TO VERIFY BEFORE DELETION

Do not delete without verification:

* old backup files
* archive directories
* historical restore logs
* old demo_api.php backups
* contact.php_old before whatsup
* potrzebuje.pl_11_02_2026.zip
* Server_Only files
* application archive directories

Reason:

They may contain recovery history or old working states.

---

# 18. RECOMMENDED INVENTORY UPDATE RULE

Update this document whenever:

* new application is added
* hosting changes
* secret location changes
* deployment flow changes
* database location changes
* major file is added or removed
* restore strategy changes

Recommended review frequency:

Monthly or before major migration.

Document Owner:

Project Owner — Tomasz

