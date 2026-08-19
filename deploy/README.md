# Three Pillars deployment contract

Current deployment model:

GitHub is the development Source of Truth.

The s47 server retrieves the verified Git version and performs the controlled
deployment locally.

Production target during AP-09.4:

/home/potrzebuje/public_html/3pillars

Deploy only files listed in:

deploy/three_pillars_manifest.txt

Do not deploy or overwrite runtime state including:

- _counters
- logs
- demo_user_inputs.log
- error_log
- secrets
- backups

Before deployment:

1. verify Git commit and clean worktree;
2. verify product files against the manifest;
3. create exact manifest backup;
4. verify backup is readable/restorable.

After deployment:

1. verify exact file hashes;
2. PHP lint;
3. HTTP checks for all six languages;
4. verify no error/i18n markers.

Rollback restores only the exact manifest from the pre-deployment backup.

The /3pillars -> / cutover is NOT part of this deployment contract.
