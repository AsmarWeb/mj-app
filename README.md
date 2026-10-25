# murwaj | مُروَّج

A UAE-focused marketplace for merchant storefronts, physical products and digital content, with secure AED checkout and an opt-in **Raslo / رسلو** delivery bridge.

**Current stage: development pilot.** Physical checkout and Raslo flows have automated coverage and have been exercised locally. This is not a production-readiness certification; see the [audit and remaining work](docs/audit-2026-10-25.md).

## What works

- Merchant storefronts, product listings, baskets, subscriptions and customer accounts.
- Physical checkout per store using current server-side prices, integer fils, stock reservations and signed Stripe payment confirmation.
- UAE recipient address fields, Arabic phone digits, Arabic/English address UI and separate payment for each store.
- Dedicated, encrypted Raslo credentials per merchant; explicit **Raslo** product shipping; automatic forwarding of eligible paid AED/UAE orders.
- Frozen delivery requests, stable idempotency keys, bounded retries, signed status events and periodic recovery polling.
- Workspace → Quick Actions → **Raslo delivery integration**; Profile → **My deliveries** beside Edit Profile.
- Digital-file downloads through authenticated entitlement checks and **private storage**. Existing public files require the migration command below.

Raslo delivery state is independent of the marketplace order/payment state. A `completed` delivery does not automatically change a `processing` marketplace order. Raslo pricing still needs the merchant's approval. **Raslo delivery fees are not added to customer Stripe checkout in this release.**

## Stack and requirements

Laravel 12, PHP 8.2+, Livewire 3, Jetstream/Fortify, Sanctum, Laratrust, MySQL or SQLite, Redis/database queues, Vue 3, Tailwind 3 and Vite 6. Use **Node 22 or 24** and Composer 2. Dependencies are pinned by both lock files; use `composer install` and `npm ci --include=optional`.

Sail runs PHP 8.3. CI tests PHP against SQLite/MySQL and clean frontend builds on Linux/macOS Intel. Composer resolves against PHP 8.2 to keep its lock compatible with supported local PHP versions.

## Local setup

The GitHub repository may still be named `mj-app` until its owner renames it. The product/package name is **murwaj**.

```sh
git clone https://github.com/AsmarWeb/mj-app.git murwaj
cd murwaj
composer install
cp .env.example .env
php artisan key:generate
```

For a fresh local SQLite installation, set the following values in `.env`:

```env
APP_NAME=murwaj
APP_URL=http://localhost
DB_CONNECTION=sqlite
QUEUE_CONNECTION=database
```

Create `database/database.sqlite` if absent, then:

```sh
php artisan migrate
php artisan storage:link
npm ci --include=optional
npm run build
php artisan serve
```

`storage:link` exposes product images, not the private digital disk. Never place private downloads inside `public/` or `storage/app/public/`.

For Sail, start your existing stack with `./vendor/bin/sail up -d`; use `./vendor/bin/sail artisan ...` for PHP commands. MySQL installations must set real `DB_HOST=mysql`, `DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD`. SQLite does not use MySQL credentials; Compose warnings about them do not prove an application database error.

### Existing installations and renaming

Back up the database and storage before updating. Keep `.env`, `APP_KEY`, database paths/volumes, payment keys, Raslo keys, order references and callback identities. Do **not** run `migrate:fresh` on an existing installation.

Changing the GitHub name does not require renaming your local folder. Keep the current folder/Compose project during rollout: renaming it can select different Docker volumes. If changing `APP_NAME` on an existing installation, preserve the existing `SESSION_COOKIE`/cache prefix where needed or expect users to sign in again. Never regenerate `APP_KEY` to rename the platform.

## Stripe test checkout

Set your own Stripe test credentials and webhook signing secret; never commit them. Forward Stripe events to the application's actual URL and port:

```sh
stripe listen --forward-to http://localhost/stripe/webhook
```

Use the `whsec_…` printed by that listener in `STRIPE_WEBHOOK_SECRET`, then clear configuration and restart workers. A paid event must reach the application; returning from Checkout is not the payment authority. See [checkout readiness](docs/raslo-readiness.md) for recovery and boundaries. Do not use test keys or temporary tunnels for production.

## Raslo delivery integration

1. Configure `RASLO_API_BASE_URL` with the Raslo backend's HTTPS origin plus `/api/integrations/v1`; configure `RASLO_TRACKING_HOSTS` with approved tracking hostnames.
2. In Raslo, create a dedicated paid Enterprise delivery connection and select its UAE pickup address.
3. In murwaj's merchant Workspace, open **Raslo delivery integration**, enter the dedicated Delivery API key, verify and enable the connection.
4. Create/edit products and explicitly choose **Raslo** under Shipping Method. Existing products retain their current shipping method. Mixed Raslo/non-Raslo products from the same store must be separated into checkouts.
5. Keep the Stripe webhook, queue and scheduler running. Only confirmed paid, eligible new orders are forwarded. No backfill occurs just because the connection is enabled.

For local Sail workers:

```sh
./vendor/bin/sail artisan raslo:check
docker compose -f docker-compose.yml -f docker-compose.raslo.yml up -d --no-deps raslo-queue raslo-scheduler
```

Stop equivalent manually running workers/schedulers before switching. These services require the existing Sail image/network and configured queue backend; `--no-deps` does not start Redis or MySQL if your configuration needs them. Docker must remain running.

The scheduler queues forwarding every minute and status checks every five minutes. The delivery detail page refreshes locally saved status every 30 seconds while visible. For faster status updates configure the signed Raslo webhook on a stable HTTPS murwaj domain, retaining polling for recovery. A temporary tunnel's hostname changes when recreated: update configuration, clear caches and restart **all** application worker services.

See [bridge contract and recovery](docs/raslo-order-bridge.md) and [shipping UX and acceptance test](docs/raslo-checkout-experience.md). Shopify is not a ready-made connector in this project.

## Secure existing digital files

New digital uploads use `storage/app/private/digital`. The application never falls back to public storage for downloads. If you have existing digital files, back up storage and run:

```sh
php artisan digital:secure-files
php artisan digital:secure-files --apply
```

The first command is a dry run. `--apply` copies only referenced digital-product files, verifies SHA-256 equality, then removes the public copy. A conflicting private file or missing source produces an error and preserves existing bytes. Do not enable paid digital downloads before this migration succeeds. Clear CDN caches and remove separately published copies if you previously distributed their public URLs. See [security rollout](docs/murwaj-rollout.md).

## Tests and builds

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
```

Do not share `node_modules` between macOS and Linux/Sail. Each platform needs its own optional Rollup binary. The lock includes native dependencies for both platforms; keep both lock files under version control.

## GitHub Actions and deployment

**Tests** runs on pushes, pull requests and manual requests. **Deploy** is manual, restricted to `main`, and depends on Tests. It never runs on an ordinary push.

The latest historical deployment failed SSH authentication; source changes cannot repair the host's `authorized_keys` or a wrong private key. Configure the `production` environment as described in [deployment setup](docs/murwaj-rollout.md). The workflow validates required values, uses a supplied known-hosts entry, deploys the checked commit and stops on command failures. It is not an atomic release/rollback system; back up and stage-test before a production deployment.

## Next priorities

- Stable HTTPS staging, verified webhooks, backups and a full browser/device acceptance test.
- Resolve remaining moderate Tailwind/PostCSS build-tool advisories through a reviewed Tailwind 4 migration.
- Complete digital/POD payment fulfillment via webhooks, refund/cancellation operations and automated monitoring before launching those modules.
- Add merchant delivery quotes/checkout-fee policy only after defining who pays; add Shopify after the current bridge is stable.

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md). Never include `.env`, private keys, payment credentials, customer exports or uploaded documents in commits or issue reports.
