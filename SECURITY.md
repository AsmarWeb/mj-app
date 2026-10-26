# Security Policy | سياسة الأمان

## Supported versions

murwaj is under active development. Security fixes target the latest maintained development code. No long-term support or older-release security coverage is currently promised. Unmerged pull requests are not supported releases.

## Report privately

**Do not report exploitable vulnerabilities in public issues, pull requests or discussions.**

Use [GitHub private vulnerability reporting](https://github.com/AsmarWeb/murwaj/security/advisories/new) if enabled for the repository. This channel's availability depends on repository settings; this file does not enable it.

If the private-report option is unavailable, use a private contact method explicitly listed by the maintainer on [AsmarWeb's profile](https://github.com/AsmarWeb). No dedicated security email is declared here. If neither route is available, do not post exploit details publicly; wait for a private channel.

Include:

- Affected component, branch or commit.
- A clear description and potential impact.
- Minimal reproduction steps using test accounts and synthetic data.
- Expected and observed behavior.
- Redacted logs or a safe proof of concept.

Never include real credentials, payment details, customer records, private files or live recipient addresses. Do not access another user's data, disrupt services, make real purchases or dispatch deliveries to demonstrate a vulnerability.

## Areas of particular concern

- Cross-merchant or cross-customer authorization.
- Checkout totals, stock reservations and payment-webhook verification.
- Subscription entitlement and quota enforcement.
- Raslo credentials, webhook signatures and retry/idempotency behavior.
- Private digital downloads and file access.
- Catalog visibility, rate limiting, injection and unsafe rendering.

## Handling reports

Maintainers aim to acknowledge reports, assess impact and coordinate a fix and disclosure. No guaranteed response time, bounty program or service-level agreement is offered. Please allow time for remediation and agree on disclosure before publishing technical details.

Operators remain responsible for secure configuration, access control, backups and dependency updates. See [deployment and security rollout](docs/murwaj-rollout.md).

## بالعربية

أبلغ عن الثغرات بشكل خاص عبر خيار GitHub المخصّص إن كان مفعّلًا، أو وسيلة تواصل خاصة معلنة من المسؤول. لا تنشر خطوات الاستغلال أو المفاتيح أو بيانات العملاء في البلاغات العامة. اختبر بحسابات وبيانات تجريبية فقط، ولا تنفّذ دفعًا أو توصيلًا حقيقيًا لإثبات المشكلة.
