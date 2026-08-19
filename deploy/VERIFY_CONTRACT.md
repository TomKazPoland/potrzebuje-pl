# Deployment verification contract

Deployment verification must reuse the verified AP-08 product contract rather
than inventing simplified language assumptions.

Expected HTML language values:

- PL: `pl`
- EN: `en`
- DE: `de`
- FR: `fr`
- ZH: `zh-Hans`
- HI: `hi`

Important:

`zh-Hans` is the expected value for the Simplified Chinese page. A verifier
must not require the shortened value `zh`.

Deployment verification requires:

1. exact deployment manifest;
2. product file equality;
3. PHP lint;
4. HTTP 200 for all six languages;
5. expected HTML language contract;
6. no PHP/i18n fatal error markers;
7. backup before deployment;
8. verified rollback path.

The current s47 deployment model is server-pull/local controlled deployment.
The previous GitHub Actions -> SFTP deployment remains disabled.

The `/3pillars/ -> /` cutover is a separate AP-09.5 release decision.
