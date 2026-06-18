# Backup Points

## PRE_REDESIGN_3_PILLARS_20260618_141025

Date:
18/06/26 14:10:25 CEST

Fixed:
18/06/26 14:12:17 CEST

Git branch:
backup/pre-redesign-3-pillars-20260618_141025

Git tag:
pre-redesign-3-pillars-20260618_141025

Purpose:
This backup point preserves the current production version of potrzebuje.pl before redesign.

Business meaning:
This is the version where potrzebuje.pl existed as the original website before being extended with two additional service segments:
1. AI Transformation / process transformation based on existing AI tools and custom tools where needed.
2. Software Hub / Software House delivery capability.

Technical meaning:
This branch contains a sanitized snapshot of the current production public_html source files under:

snapshots/PRE_REDESIGN_3_PILLARS_20260618_141025/public_html_source_snapshot

Excluded from GitHub snapshot:
- secrets
- logs
- runtime counters
- public application mounts
- temporary diagnostic phpinfo file
- generated archives
- databases
- admin tokens

Important:
Initial push from server failed because GitHub rejected HTTPS password authentication.
If this branch is not visible on GitHub yet, use the transfer bundle created on the server.

Restore note:
Use this point as the rollback/reference state before implementing the extended three-pillar website.
