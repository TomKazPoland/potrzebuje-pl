# POTRZEBUJE.PL OPERATIONS GUIDE

Last Review Date: 18/08/2026

## 1. Purpose

Operational guide for deployment, backup, restore, maintenance and
recovery of potrzebuje.pl.

MASTER_CONTEXT describes what the project is.

OPERATIONS describes how it is operated.

RUNBOOK provides the short execution checklist.

## 2. Environment

Current three-pillars production:

`/home/potrzebuje/public_html/3pillars`

Local Git repository:

`/home/potrzebuje/Projects/GitHub_Repos/potrzebuje-pl`

Logs:

`/home/potrzebuje/public_html/logs`

Secrets are stored outside the public web tree.

## 3. Hosting

Environment:
- shared hosting,
- cPanel,
- LiteSpeed,
- Passenger available for supported Python applications,
- no root-level infrastructure management.

## 4. Deployment model

Desired normal model after AP-09:

Developer
→ GitHub
→ verified GitHub Actions deployment
→ SFTP
→ production.

Production is a deployment target, not a Git checkout.

Important transition state:

during AP-09, current `/3pillars` is newer than the old GitHub baseline
and is therefore the authoritative product source until synchronization
completes.

Automatic deployment remains locked until AP9.4 verifies exact target,
source scope and rollback.

## 5. GitHub structure

Main website repository:
`TomKazPoland/potrzebuje-pl`

Dedicated application repositories remain separate.

Documentation belongs in GitHub.

Runtime assets do not.

## 6. OpenAI operations

OpenAI credentials/configuration remain outside public_html and outside
GitHub.

Never print, copy, hash or expose secret contents during diagnostics.

## 7. Logging

Operational/diagnostic logs are runtime data.

They do not belong in the Git repository.

User-input logs may contain user-provided content and must not be exposed.

Never log credentials.

## 8. Backup strategy

Before risky changes:
1. identify affected product files;
2. create exact backup/snapshot;
3. record hashes/state;
4. confirm rollback path;
5. apply minimal change;
6. verify;
7. retain recovery evidence until release is stable.

Critical ecosystem assets include:
domain, hosting, Git repositories, secrets/configuration, email,
databases, documentation and backups.

## 9. Restore strategy

Typical full-environment order:

1. recover hosting access;
2. recover domain configuration;
3. recover repositories;
4. recover secret/configuration assets securely;
5. recover production databases;
6. deploy applications;
7. validate website/application behavior;
8. validate AI integrations;
9. validate Contact;
10. validate logs/monitoring.

## 10. Change management

Use:

DIAG
→ root cause
→ isolated BUILD where applicable
→ checkpoint
→ backup
→ APPLY
→ VERIFY
→ rollback on failure.

Do not patch historical symptoms when current architecture already
provides the function centrally.

## 11. Three-pillars verification minimum

For relevant website changes verify:
- PHP lint,
- PL/EN/DE/FR/ZH/HI,
- HTTP,
- canonical i18n markers/parity,
- shared-template behavior,
- navigation/routing,
- generator,
- Contact,
- SEO/meta where affected,
- responsive behavior where affected,
- runtime errors,
- hashes for files expected to remain unchanged.

## 12. Emergency recovery

If production fails:
1. stop further deployment;
2. determine CURRENT state;
3. inspect runtime logs without exposing secrets;
4. identify last verified source state;
5. restore from controlled backup if required;
6. verify six languages;
7. verify generator;
8. verify Contact;
9. verify dependent applications;
10. document root cause and non-detection cause.

## 13. Deployment lock during AP-09

A push to main must not automatically overwrite current production until
AP9.4 deployment scope is proven.

The repository therefore contains a non-deploying lock workflow during
this transition.

Old workflow evidence is retained under `doc/history/`.
