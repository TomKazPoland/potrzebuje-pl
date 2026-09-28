# PROJECT STATUS

Last Review Date: 24/09/2026

## 1. Overall

Project:

potrzebuje.pl

Business stage:

operational / customer-acquisition stage.

Primary objective:

acquire the first paying customers.

Secondary objective:

obtain credible customer references.

Business model:

three equal service pillars:

1. AI Education & Training
2. AI Transformation & Process Improvement
3. Software Development

## 2. Production website

Production root:

`/home/potrzebuje/public_html`

Status:

operational.

Production languages:

PL / EN / DE / FR / ZH / HI.

Current accepted release:

`91139569ad0adab2c8b512ab37aeed724058de2a`

GitHub `main`:

`91139569ad0adab2c8b512ab37aeed724058de2a`

Source-of-Truth alignment:

PASS.

## 3. Architecture

Current website architecture uses:

- thin language wrappers,
- shared PHP templates,
- shared CSS/helpers,
- canonical i18n,
- runtime i18n,
- shared navigation/site shell.

Production is a deployment target and is not a Git checkout.

## 4. Multilingual / i18n

AP07:

CLOSED 100%.

Current canonical:

- 212 records,
- 1272 localized values,
- 6 languages.

Software Development scope:

- 99 `software.*` records,
- 594 localized values.

Canonical source:

`i18n/i18n_catalog_linguistically_reviewed.json`

Generated master:

`inc/i18n_master.php`

## 5. QA framework

AP08:

CLOSED 100%.

Required QA includes:

- syntax/lint,
- HTTP/runtime,
- language contract,
- canonical/hreflang,
- i18n parity,
- routing/navigation,
- Contact,
- API/demo smoke where relevant,
- responsive/browser checks,
- unrelated-file guards,
- rollback evidence.

Technical HTTP PASS does not replace browser visual acceptance.

## 6. GitHub / deployment

AP09:

CLOSED.

GitHub `main` is the normal Source of Truth.

Current controlled release model:

verified branch/worktree
→ backup
→ explicit manifest
→ production APPLY
→ technical VERIFY
→ browser acceptance
→ fast-forward `main`
→ final regression.

Automatic GitHub Actions/SFTP deployment is not the current operating
contract.

## 7. Software Development

AP10.8:

CLOSED 100%.

Production routes:

- `/software-development/`
- `/en/software-development/`
- `/de/software-development/`
- `/fr/software-development/`
- `/zh/software-development/`
- `/hi/software-development/`

Architecture:

thin wrappers
→ `inc/software_development_template.php`
→ canonical i18n
→ `assets/software-development.css`.

Current cache-safe CSS reference:

`/assets/software-development.css?v=ce0b45f07b18e542`

Final AP10.8 regression:

- product hashes: PASS 4/4,
- Software Development routes: PASS 6/6,
- homepage Software Development links: PASS 6/6,
- versioned CSS HTTP/hash: PASS,
- Contact: PASS,
- AI demo safe smoke: PASS,
- protected secret path: PASS,
- manual production visual acceptance: PASS.

## 8. Documentation

AP10.9:

ACTIVE.

Canonical documentation location:

GitHub `main` → `doc/`.

Current objective:

synchronize operational documentation with completed AP09/AP10.8 state.

Legacy copies under `/public_html/doc/` are stale and were observed publicly
reachable on 24/09/2026.

They are not canonical.

Follow-up hardening action:

remove or block public access to legacy documentation after canonical sync,
using a separate controlled change.

## 9. Additional applications

Alpha Analyzer:

separate application/project; maintained outside the main website source tree.

Anonymous:

separate application/project; maintained outside the main website source tree.

Their runtime databases/secrets/logs do not belong in the potrzebuje.pl
website repository.

## 10. Current risks

Operational:

- shared-hosting limitations,
- no root-level server control,
- manual controlled release workflow requires careful verification.

Release/browser:

- long-lived browser caching can break presentation if incompatible assets are
  deployed under unchanged URLs.

Mitigation:

cache-safe asset versioning plus real-browser production acceptance.

Documentation/security:

legacy `/public_html/doc/` copies are publicly reachable and should be removed
or blocked in a separate hardening change.

## 11. Next milestone

Business milestone:

first paying customer and first customer reference.

Technical/documentation milestone:

complete AP10.9 documentation synchronization and documentation-exposure
hardening without changing the accepted production product release.
