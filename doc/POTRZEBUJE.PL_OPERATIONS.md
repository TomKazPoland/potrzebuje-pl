# POTRZEBUJE.PL OPERATIONS GUIDE

Last Review Date: 24/09/2026

## 1. Purpose

Operational guide for deployment, backup, restore, maintenance and recovery
of potrzebuje.pl.

`POTRZEBUJE_MASTER_CONTEXT.md` describes what the project is.

`POTRZEBUJE.PL_OPERATIONS.md` describes how it is operated.

`RUNBOOK.md` provides the short execution checklist.

For implementation methodology use:

`doc/Methodologies_to_be_followed.txt`

## 2. Environment

Production root:

`/home/potrzebuje/public_html`

Main GitHub repository:

`TomKazPoland/potrzebuje-pl`

Local repository/worktrees are maintained below:

`/home/potrzebuje/Projects`

Operational logs:

`/home/potrzebuje/public_html/logs`

Server-only backups/recovery material:

`/home/potrzebuje/Projects/Server_Only`

Secrets are stored outside the public web tree.

Production is not a Git checkout.

## 3. Hosting

Environment:

- WEBMEDIA EUROPE LTD shared hosting,
- cPanel,
- Apache/LiteSpeed-compatible PHP hosting,
- Passenger available for supported Python applications,
- no root-level infrastructure management,
- no Docker/systemd-level production control.

All operational scripts must respect current shared-hosting capabilities.

Known shell constraint:

do not depend on `/dev/fd` or Bash process substitution on s47.

## 4. Source of Truth

Normal product Source of Truth:

GitHub repository `TomKazPoland/potrzebuje-pl`, branch `main`.

Current accepted production release:

`91139569ad0adab2c8b512ab37aeed724058de2a`

Canonical project documentation:

`doc/`

Production files under `public_html` are deployment targets, not the canonical
repository.

Current code + current diagnostics + current system state override historical
documentation when inconsistency is detected.

## 5. Current controlled deployment model

The active deployment contract is:

1. start from current verified GitHub `main`;
2. create an isolated release branch/worktree;
3. BUILD and VERIFY off production;
4. publish the verified release branch;
5. verify remote `main` and release commit immediately before APPLY;
6. back up the exact production manifest;
7. APPLY only the explicit release manifest to `/home/potrzebuje/public_html`;
8. verify hashes, permissions, lint/runtime and unrelated-file guards;
9. verify all affected language routes;
10. perform real browser visual acceptance where presentation is affected;
11. promote GitHub `main` to the accepted release using fast-forward only;
12. run final production regression.

During the short controlled interval between production APPLY and final
`main` promotion, the verified release branch identifies the exact candidate
running in production.

No force-push/reset is part of the normal release flow.

Automatic GitHub-to-production deployment is not the current operating
contract.

## 6. Release manifests

A release manifest is change-specific.

Do not reuse an old manifest automatically.

Determine it from:

- current Git diff,
- actual architecture,
- affected shared components,
- runtime contract.

AP10.8 Software Development v4.2 used exactly:

- `assets/software-development.css`
- `i18n/i18n_catalog_linguistically_reviewed.json`
- `inc/i18n_master.php`
- `inc/software_development_template.php`

That four-file manifest belongs to that release only.

## 7. Multilingual architecture

Production languages:

- PL
- EN
- DE
- FR
- ZH
- HI

Shared-page principle:

thin language wrappers
→ shared template
→ canonical i18n
→ shared CSS/helpers/runtime.

Do not maintain six independent full-page copies when the structure is shared.

For Chinese HTML/SEO language contracts use the verified `zh-Hans` behavior
where required by the existing runtime.

## 8. Canonical i18n

Canonical source:

`i18n/i18n_catalog_linguistically_reviewed.json`

Generated/runtime master:

`inc/i18n_master.php`

Runtime translation layer:

`inc/i18n_runtime.php`

Current accepted canonical state after AP10.8:

- 212 records,
- 1272 localized values,
- 6 languages,
- 99 `software.*` records,
- 594 localized Software Development values.

Deterministic site text belongs in canonical i18n unless a specifically
documented exception applies.

## 9. Software Development architecture

Routes:

- `/software-development/`
- `/en/software-development/`
- `/de/software-development/`
- `/fr/software-development/`
- `/zh/software-development/`
- `/hi/software-development/`

Shared implementation includes:

- `inc/software_development_template.php`
- `assets/software-development.css`
- canonical/runtime i18n
- thin route wrappers.

Current accepted CSS content hash:

`ce0b45f07b18e542459d8194aaa35024f3117c086c1c6e42c470540de8814689`

Current browser reference is versioned:

`/assets/software-development.css?v=ce0b45f07b18e542`

Reason:

the hosting sends long-lived cache headers for this asset. Template/CSS
releases must therefore use cache-safe asset versioning whenever incompatible
markup/style changes could otherwise reuse stale browser CSS.

## 10. Verification minimum

For relevant website releases verify as applicable:

- PHP lint,
- exact release hashes,
- file modes,
- PL/EN/DE/FR/ZH/HI routes,
- HTTP status,
- HTML language,
- canonical/hreflang,
- canonical i18n/runtime parity,
- shared-template markers,
- navigation/routing,
- homepage service links,
- Contact,
- AI demo/API smoke,
- SEO/meta,
- responsive/browser behavior,
- raw-key leaks,
- runtime errors,
- protected paths,
- hashes for unrelated files.

HTTP 200 alone is not visual acceptance.

## 11. Browser gate

For presentation changes:

1. verify an off-production candidate;
2. visually inspect representative desktop/mobile output;
3. after production APPLY, inspect the real production URL;
4. only then close the release/promote final Source of Truth.

A cache-busted diagnostic request is not a substitute for the URL actually
used by the browser.

## 12. Backup and rollback

Before risky APPLY:

1. identify exact affected files;
2. create exact backup;
3. record hashes/state;
4. verify rollback path;
5. APPLY minimal scope;
6. VERIFY;
7. rollback immediately on critical failure.

Two release rollbacks require deployment stop and root-cause analysis before
another production attempt.

## 13. SURE / change management

Use:

DIAG
→ ROOT CAUSE
→ BUILD
→ checkpoint
→ backup
→ APPLY
→ VERIFY
→ acceptance.

Rules:

- no guessing,
- current runtime is authoritative,
- exact patch only,
- smallest sufficient scope,
- verify side effects,
- preserve rollback evidence,
- separate product changes from cleanup.

## 14. Security

Never expose or commit:

- API keys,
- passwords,
- tokens,
- private SSH material,
- runtime databases,
- user-input logs,
- secret files.

Production OpenAI secrets remain outside `public_html`.

Do not print secret contents or include them in documentation hashes/logs.

## 15. Documentation exposure

Canonical documentation belongs in GitHub under `doc/`.

It does not need to be publicly served by the website.

On 24/09/2026 legacy copies under `/public_html/doc/` were detected as
publicly reachable and stale relative to GitHub canonical documents.

AP10.10 removed these copies from the public web root on 28/09/2026.
All four former document URLs returned 404 in the final server checks and
independent browser check. The controlled backup remains outside the web root.
GitHub `main:doc/` remains the canonical documentation location.

## 16. Emergency recovery

If production fails:

1. stop further deployment;
2. determine current code/runtime state;
3. inspect logs without exposing secrets;
4. identify the last verified release;
5. restore the controlled backup if required;
6. verify affected language routes;
7. verify shared components and Contact;
8. verify dependent API/demo behavior where affected;
9. verify unrelated hashes;
10. document direct cause, root cause and non-detection cause.

## 17. Current release evidence

AP10.8 Software Development v4.2 closed 24/09/2026.

Final release:

`91139569ad0adab2c8b512ab37aeed724058de2a`

Final gates:

- production hashes PASS,
- 6/6 Software Development routes PASS,
- 6/6 homepage links PASS,
- versioned CSS PASS,
- Contact PASS,
- AI demo safe smoke PASS,
- protected secret path PASS,
- manual production visual acceptance PASS,
- GitHub `main` / production alignment PASS.
