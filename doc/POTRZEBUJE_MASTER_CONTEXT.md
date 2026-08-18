# POTRZEBUJE.PL MASTER CONTEXT

Last Review Date: 18/08/2026

## 1. Project identity

Project: potrzebuje.pl

Purpose:
practical AI consulting, training, transformation/process improvement and
software-development services.

Primary business objective:
acquire paying customers and build customer references.

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

Clients may enter through any pillar. No mandatory sequence exists.

## 3. Current website

Current verified version:

`/home/potrzebuje/public_html/3pillars`

Languages:

PL / EN / DE / FR / ZH / HI.

Architecture:

thin language wrappers
→ shared template
→ canonical i18n
→ shared frontend/backend behavior.

See `THREE_PILLARS_CURRENT_STATE.md`.

## 4. Hosting

Shared cPanel hosting.

Web server: LiteSpeed.

Important constraints:
- no root access,
- no Docker/systemd-level infrastructure control,
- production is not a Git checkout,
- diagnostics must respect cPanel/shared-hosting limitations.

## 5. GitHub and deployment

Main website repository:

`TomKazPoland/potrzebuje-pl`

Local clone:

`/home/potrzebuje/Projects/GitHub_Repos/potrzebuje-pl`

Architectural principle:
production and repositories remain separated.

During AP-09 reconciliation CURRENT `/3pillars` is the authoritative
product baseline.

After successful repository synchronization and deployment-contract
verification, GitHub `main` becomes the normal Source of Truth again.

## 6. Security

Secrets remain outside `public_html`.

Never commit:
- API keys,
- passwords,
- tokens,
- private SSH material,
- runtime databases,
- runtime logs,
- user-input logs,
- counters.

Never expose secret contents in diagnostics or documentation.

## 7. AI demo

The AI demo is part of the main website capability showcase.

Deterministic UI/API text is centralized through i18n.

Free-form LLM answers remain dynamic.

Limits are enforced by current backend/runtime code and must be verified
from CURRENT code rather than stale documentation values.

## 8. Additional applications

Alpha Analyzer and Anonymous are separate demonstration/application
projects with dedicated repositories/runtime assets.

They are not part of the main `/3pillars` source tree.

Their production databases and runtime files are not committed to this
repository.

## 9. Recovery philosophy

Recovery planning covers:
- domain,
- hosting,
- Git repositories,
- secrets/configuration,
- email,
- databases,
- documentation,
- backups.

## 10. Architectural principles

Preserve unless strong evidence justifies change:

1. secrets outside public web roots;
2. application/repository separation;
3. one shared template for structurally identical language pages;
4. canonical i18n for deterministic text;
5. thin language wrappers;
6. deployment through a verified version-controlled workflow;
7. backup and rollback before risky changes;
8. current code + diagnostics + state before historical assumptions.

## 11. Quick start for future work

Before changing the project:
- read `README.md`;
- read `doc/THREE_PILLARS_CURRENT_STATE.md`;
- read `doc/POTRZEBUJE.PL_OPERATIONS.md`;
- read `RUNBOOK.md`;
- use `doc/Methodologies_to_be_followed.txt`;
- verify CURRENT runtime;
- preserve secrets isolation;
- do not perform `/3pillars/ → /` cutover without an explicit release AP.
