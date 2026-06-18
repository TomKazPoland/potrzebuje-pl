# potrzebuje.pl Branch Strategy

Generated: 18/06/26 15:11:34 CEST

## Purpose

This repository now separates backup, current production baseline, and future product variants.

## Branch roles

- main
  - Official source branch.
  - Aligned to the current working production website source files before three-pillar redesign.

- stable/original-site-before-three-pillars-20260618_151127
  - Product variant A.
  - Current/original website direction without the new three service pillars.

- redesign/three-pillars-20260618_151127
  - Product variant B.
  - Working branch for the planned three-pillar version:
    1. AI Education & Training
    2. AI Transformation & Process Improvement
    3. Software Hub / Software House delivery

- backup/pre-redesign-3-pillars-20260618_141025
  - Frozen backup branch.
  - Do not use for active development.
  - Restore/reference point from before redesign work.

- pre-redesign-3-pillars-20260618_141025
  - Permanent tag marking the pre-redesign backup point.

## Operational rule

Do not edit production directly. Make changes in Git branches, verify, then deploy.

