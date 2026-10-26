# Roadmap | خارطة الطريق

This is a direction for development, not a release promise or delivery schedule. Track implementation and acceptance in issues and pull requests.

## Current integration work

At preparation on 2026-10-26, these changes are in open pull requests and are not assumed to be merged into main:

1. [#1 — Store checkout and Raslo readiness](https://github.com/AsmarWeb/murwaj/pull/1)
2. [#3 — Membership plans, pricing and quotas](https://github.com/AsmarWeb/murwaj/pull/3)
3. [#2 — Secure, versioned public catalog API](https://github.com/AsmarWeb/murwaj/pull/2)

The branches are stacked. Review and integrate in the order above, then validate the combined result.

## Priority 1: reliable commerce

- Validate merchant/customer journeys on staging, including Arabic/English and RTL.
- Exercise payment confirmation, expired checkout and stock recovery.
- Validate plan upgrades, entitlement reconciliation and quota boundaries.
- Test failed Raslo requests, retries, signatures and recovery polling.
- Define refund/cancellation behavior and who pays delivery fees.

## Priority 2: safe operations

- Configure stable HTTPS staging, backups and recovery procedures.
- Require the actual CI check names in main's active ruleset.
- Enable a private security reporting channel.
- Verify deployment configuration and a recovery procedure before authorizing a release.
- Address dependency advisories through reviewed upgrades.

## Priority 3: discovery and growth

- Improve product discovery, store presentation and search experience.
- Define measurable digital-marketing workflows with merchants.
- Explore analytics and campaign tools with clear consent and data boundaries.
- Improve accessibility and mobile usability.

## Later exploration

Additional commerce connectors, including Shopify, remain future work unless explicitly implemented and documented. Marketing, analytics and automation ideas here are proposals rather than available product features.

## بالعربية

الأولوية هي استقرار البيع والدفع والاشتراكات وربط رسلو، ثم التشغيل الآمن، ثم تطوير اكتشاف المنتجات وأدوات النمو والتسويق. هذه خارطة تطوير وليست وعدًا بمواعيد إطلاق أو اكتمال الميزات.
