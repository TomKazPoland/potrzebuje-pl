# POTRZEBUJE.PL MASTER CONTEXT

Last Review Date: 24/09/2026

## 1. Project identity

Project:

potrzebuje.pl

Purpose:

practical AI consulting, training, transformation/process improvement and
software-development services.

Primary business objective:

acquire paying customers and build credible customer references.

Current stage:

operational website / pre-commercial customer-acquisition stage.

## 2. Three strategic pillars

### Pillar A — AI Education & Training

Practical AI adoption, AI fundamentals, prompt engineering, AI tools and
role/industry-specific training.

### Pillar B — AI Transformation & Process Improvement

Process discovery, analysis, redesign, automation identification,
AI integration and implementation planning.

### Pillar C — Software Development

Custom applications, AI-assisted development, internal tools,
automation solutions and software supporting transformation projects.

Clients may enter through any pillar.

No mandatory sequence exists between the three pillars.

## 3. Current production website

Production root:

`/home/potrzebuje/public_html`

Current accepted release:

`91139569ad0adab2c8b512ab37aeed724058de2a`

Languages:

PL / EN / DE / FR / ZH / HI.

Language directories:

- `/en`
- `/de`
- `/fr`
- `/zh`
- `/hi`

Polish remains the root/default language.

Production is not a Git checkout.

## 4. Shared website architecture

Core principle:

thin language wrappers
→ shared templates/components
→ canonical i18n
→ shared frontend/backend behavior.

Important shared areas include:

- homepage/shared landing architecture,
- shared site navigation/shell,
- Contact,
- AI demo,
- canonical/runtime i18n,
- Software Development shared template.

Do not create separate full copies of structurally identical multilingual
pages when shared architecture can represent the difference as content/data.

## 5. Canonical i18n

Canonical source:

`i18n/i18n_catalog_linguistically_reviewed.json`

Generated master:

`inc/i18n_master.php`

Runtime layer:

`inc/i18n_runtime.php`

Current accepted state:

- 212 canonical records,
- 1272 localized values,
- six languages,
- 99 `software.*` records,
- 594 localized Software Development values.

Deterministic user-facing text is centralized unless a documented exception
requires otherwise.

Free-form model output remains dynamic.

## 6. Software Development

Public routes:

- `/software-development/`
- `/en/software-development/`
- `/de/software-development/`
- `/fr/software-development/`
- `/zh/software-development/`
- `/hi/software-development/`

Shared implementation:

- thin route wrappers,
- `inc/software_development_template.php`,
- `assets/software-development.css`,
- canonical/runtime i18n,
- shared site shell/navigation.

AP10.8 final release:

`91139569ad0adab2c8b512ab37aeed724058de2a`

Current cache-safe stylesheet reference:

`/assets/software-development.css?v=ce0b45f07b18e542`

Reason:

the hosting returns long-lived cache headers, therefore incompatible
template/CSS releases require versioned asset URLs.

## 7. Hosting

Provider:

WEBMEDIA EUROPE LTD.

Environment:

shared cPanel hosting.

Important constraints:

- no root access,
- no Docker/systemd-level infrastructure control,
- no full production observability stack,
- production is not a Git checkout,
- shell tooling differs from a normal VPS,
- operational scripts must be compatible with the actual s47 environment.

Do not assume `/dev/fd` or Bash process substitution is available.

Current hosting remains appropriate for the public business website and
lightweight demos, not for complex agentic/SaaS infrastructure.

## 8. GitHub and Source of Truth

Main repository:

`TomKazPoland/potrzebuje-pl`

Normal Source of Truth:

GitHub `main`.

Canonical project documentation:

`doc/`

Current `main`:

`91139569ad0adab2c8b512ab37aeed724058de2a`

Current production and `main` are aligned to the accepted release.

Historical worktrees, backups, preview directories and `/public_html/doc`
copies are not canonical Source of Truth.

## 9. Deployment architecture

Current controlled release flow:

verified branch/worktree
→ off-production BUILD/VERIFY
→ publish verified release
→ exact production backup
→ explicit release manifest
→ controlled APPLY
→ technical/runtime verification
→ real-browser visual acceptance where applicable
→ fast-forward `main`
→ final regression.

Do not infer a release manifest from an old release.

No force-push/reset is part of the normal production workflow.

## 10. Security

Preserve:

- secrets outside public web roots,
- secrets outside Git,
- application/repository separation,
- no secret contents in diagnostics,
- no private credentials in logs/documentation.

Runtime databases, tokens, logs and counters are not normal website repository
source.

The known production secret area remains outside `public_html`.

## 11. AI demo

The AI demo is part of the website capability showcase.

Its runtime contract must be determined from current backend/configuration,
not stale copied documentation values.

AP10.8 final regression confirmed the safe API smoke behavior remained
unchanged.

## 12. Additional applications

Alpha Analyzer and Anonymous are separate demonstration/application projects.

Their:

- source,
- databases,
- runtime state,
- application-specific operations

are managed separately from the potrzebuje.pl website repository.

Do not mix their application changes into website releases.

## 13. Recovery philosophy

Recovery planning covers:

- domain,
- hosting,
- Git repositories,
- secrets/configuration,
- email,
- databases,
- documentation,
- backups.

Before risky changes preserve exact evidence of:

- previous state,
- hashes,
- manifest,
- backup location,
- rollback path.

## 14. Architectural principles

Preserve unless strong current evidence justifies change:

1. secrets outside public web roots;
2. GitHub `main` as normal Source of Truth;
3. production separated from repositories;
4. one shared template for structurally identical language pages;
5. canonical i18n for deterministic text;
6. thin language wrappers;
7. explicit change-specific release manifests;
8. backup and rollback before risky APPLY;
9. browser visual gate for presentation changes;
10. cache-safe asset versioning for incompatible cached assets;
11. current code + diagnostics + runtime state before historical assumptions.

## 15. Current project state

AP07 canonical i18n:

CLOSED.

AP08 multilingual QA framework:

CLOSED.

AP09 GitHub Source-of-Truth / controlled deployment:

CLOSED.

AP10.8 Software Development v4.2:

CLOSED 100%.

AP10.9 documentation synchronization:

ACTIVE.

## 16. Quick start for future work

Before changing potrzebuje.pl:

1. read `README.md`;
2. read `doc/POTRZEBUJE_MASTER_CONTEXT.md`;
3. read `doc/POTRZEBUJE.PL_OPERATIONS.md`;
4. read `doc/PROJECT_STATUS.md`;
5. read `RUNBOOK.md`;
6. read `doc/Methodologies_to_be_followed.txt`;
7. inspect current GitHub `main`;
8. inspect current runtime where relevant;
9. preserve secrets isolation;
10. use SURE;
11. do not trust historical worktrees/backups as current state;
12. do not treat `/public_html/doc/` as canonical documentation.
