# Contributing to murwaj

Use a feature/fix branch and open a pull request. Describe the concrete problem, expected behavior, testing and rollout requirements.

Install dependencies from the lock files, run PHP tests, frontend tests, a clean Vite build and Composer validation. Add regression tests for security/behavior changes; use synthetic recipients and fake payment/delivery clients. Never charge a real customer to run tests.

Do not mutate existing migrations that have already run unless fixing an explicitly documented fresh-install problem. Use forward migrations for schema changes and preserve APP_KEY and encrypted data compatibility.

Payment confirmation must remain server-authoritative. Delivery retries must preserve the original reference, payload and idempotency key. Check ownership on every merchant/customer route. Keep digital downloads private and do not expose provider credentials in HTML, logs or queue payloads.

Report vulnerabilities privately to the repository owner rather than posting working credentials or customer data in a public issue. There is no dedicated security email configured in this repository.
