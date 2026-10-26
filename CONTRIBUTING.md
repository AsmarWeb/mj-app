# Contributing to murwaj | المساهمة في مروج

Thank you for helping build murwaj. Contributions can include bug fixes, tests, documentation, Arabic/English translations, accessibility improvements and product ideas.

## Before you start

- Read [README.md](README.md), [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md) and [SECURITY.md](SECURITY.md).
- Search existing issues and pull requests before opening a duplicate.
- Discuss major architecture, dependency, payment or schema changes in an issue first.
- Keep contributions focused. Do not combine unrelated refactoring with a bug fix.

## Development workflow

1. Fork the repository or create a feature branch if you have write access.
2. Install dependencies from the committed lock files using the README instructions.
3. Implement the change and add meaningful regression tests for behavior or security changes.
4. Run the relevant checks below.
5. Open a pull request describing the problem, resulting behavior, validation and rollout needs.

Use a branch such as `fix/cart-total`, `feat/store-search` or `docs/readme`. Target the appropriate integration branch when working on stacked pull requests; otherwise target `main`.

## Validation

```sh
composer validate --strict
php artisan test
npm ci --include=optional
npm run test:frontend
npm run build
php artisan view:cache
php artisan route:cache
composer audit
npm audit
git diff --check
```

Run tests only against a dedicated test database. Never point test commands at development data you need to keep or at production. Use synthetic customers and fake payment/delivery clients. Never charge a real customer or dispatch a real delivery to validate a contribution.

For documentation-only changes, check Markdown, links and accuracy; application tests are unnecessary unless behavior or configuration changes.

## Engineering expectations

- Check ownership and authorization for every merchant/customer operation.
- Preserve server-authoritative pricing, integer fils and verified payment confirmation.
- Preserve delivery references, frozen payloads and idempotency keys during retries.
- Keep digital downloads private and enforce purchase entitlements.
- Use additive forward migrations for existing installations; do not rewrite applied migrations without a documented fresh-install repair.
- Preserve APP_KEY and encrypted-data compatibility.
- Support Arabic/English, RTL, accessible labels and UAE address/phone formats where relevant.
- Use npm and keep dependency lock files under version control.

## Secrets and personal data

Never commit `.env`, private keys, tokens, credentials, customer exports, real recipient addresses or uploaded documents. Redact logs and screenshots. Report vulnerabilities privately under [SECURITY.md](SECURITY.md).

## Pull requests

Use the pull request template, link related issues and explain any compatibility or migration requirements. Passing CI is necessary but does not constitute production acceptance. Merging code does not authorize deployment.

## Licensing

By submitting a contribution, you agree that your contribution is provided under this project's MIT license. Only contribute material you have the right to share. Preserve existing third-party notices.

## بالعربية

نرحّب بالمساهمة في البرمجة والاختبارات والتوثيق والترجمة وإمكانية الوصول. افتح فرعًا مستقلًا، واشرح المشكلة وطريقة التحقق من الحل، واحفظ بيانات العملاء والمفاتيح خارج GitHub. أبلغ عن الثغرات بشكل خاص، ولا تنشرها في Issues عامة.
