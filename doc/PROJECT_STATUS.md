# PROJECT STATUS

Last Review Date: 18/08/2026

## 1. Overall

Project: potrzebuje.pl

Business stage:
operational / customer-acquisition stage.

Primary objective:
acquire paying customers.

Secondary objective:
obtain customer references.

## 2. Website

Current verified release candidate is live at `/3pillars/`.

Languages:
PL / EN / DE / FR / ZH / HI.

Architecture:
shared template + thin wrappers + canonical i18n.

AP-08 Final QA:
CLOSED 100%.

## 3. Multilingual/i18n

AP-07:
CLOSED 100%.

Canonical:
113 records × 6 languages.

Legacy translation layer:
removed from active product.

## 4. GitHub synchronization

AP-09 is ACTIVE.

Current production has been selected as the authoritative product
baseline because it is newer than the old GitHub main state.

GitHub content reconciliation:
PASS.

Old GitHub product behavior requiring restoration:
NONE identified.

Useful documentation/history:
retained and updated in the new Source-of-Truth candidate.

## 5. Deployment

Automatic deployment:
intentionally LOCKED during synchronization.

AP9.4 must verify the correct deployment target and rollback contract
before push-to-main deployment is re-enabled.

## 6. Cutover

`/3pillars/ → /`:
NOT PERFORMED.

No cutover decision may be made until AP-09 release readiness completes.

## 7. Additional applications

Alpha Analyzer:
separate project/application.

Anonymous:
separate project/application.

They are not part of the `/3pillars` website source tree.
