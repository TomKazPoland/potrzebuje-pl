# RUNBOOK — potrzebuje.pl

## Read first

- `README.md`
- `doc/THREE_PILLARS_CURRENT_STATE.md`
- `doc/POTRZEBUJE.PL_OPERATIONS.md`

## Development

1. Start from current Git source after AP-09 completion.
2. Use isolated branch/worktree.
3. DIAG before patch.
4. BUILD.
5. Verify.
6. Create checkpoint.
7. Backup before APPLY.
8. APPLY.
9. Verify production.
10. Roll back on failure.

## Minimum website tests

- PHP lint;
- 6 language URLs;
- shared-template rendering;
- i18n marker/canonical checks;
- generator;
- Contact;
- routing/navigation;
- runtime error check.

## Deployment

Automatic deployment is LOCKED during AP-09.

Do not enable push-to-main deployment until AP9.4 confirms:
- exact remote target;
- exact source paths;
- exclusions;
- rollback;
- post-deploy verification.

## Rollback

Before deployment record:
- Git commit SHA;
- production file hashes;
- backup artifact location.

On failed deployment:
1. stop further deploys;
2. restore previous verified state;
3. verify PHP/HTTP/logic;
4. inspect logs;
5. perform RCA before retrying.

## Secrets

Never display, copy, hash or commit secret contents.

## Cutover

`/3pillars/ → /` requires explicit release approval and is not part of a
normal synchronization or documentation update.
