# potrzebuje.pl Branch Strategy

Updated: 18/08/2026

## Purpose

Preserve a clean distinction between:
- historical restore states,
- active development,
- verified release states,
- production deployment.

## Current transition

The former GitHub main baseline is older than the verified August 2026
`/3pillars` production version.

During AP-09, current production is used as the authoritative baseline for
constructing the next complete repository state.

Old GitHub content is reconciled semantically; useful documentation and
history are preserved, obsolete product code is not restored.

## Main

`main` is intended to become the official Source of Truth only after the
reconciled candidate has been committed, verified and its deployment
contract has passed AP9.4.

## Historical branches

Existing stable/backup/redesign branches remain historical recovery and
development references unless explicitly reclassified.

Do not force them into current production merely because they contain old
code.

## Operational rule

Normal future flow after AP-09:

branch/worktree
→ BUILD/VERIFY
→ reviewed merge to main
→ verified deployment workflow
→ production verification.

Production must not be edited casually.

Emergency production fixes must be reconciled back into Git immediately
after verification.

## Cutover

`/3pillars/ → /` is a separate release decision.

A GitHub synchronization must not implicitly perform that cutover.
