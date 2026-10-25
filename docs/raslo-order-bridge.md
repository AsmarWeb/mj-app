# mj-app → Raslo delivery bridge

This update is for **mj-app only**, on top of `mj-raslo-readiness-update`. No Raslo server or mobile patch is required. It does not synchronize catalog products or modify Stripe payments, commission, refunds or checkout shipping charges.

## Eligibility and opt-in

Each active store owner configures **Seller dashboard / Profile → Raslo delivery integration** (`/seller/raslo`). The route requires a verified seller account/phone and owned active store. Each store has its own connection/key; the same remote Raslo connection ID cannot serve two stores. Its remote identity cannot be replaced after setup. Key rotation must target the same connection.

Saving/enabling verifies `GET /api/integrations/v1/delivery-connection`, including AED/pickup readiness. Raslo enforces paid Enterprise access, active merchant/connection and delivery opt-in. Delivery keys start with `raslo_delivery_`; catalog/Feed/Stripe keys are not delivery keys. Secrets are encrypted, hidden from serialization, never redisplayed, and not flashed on invalid form submission. Blank key/secret fields retain stored values.

Opt-in applies to **checkouts created after activation**. The checkout transaction captures an immutable encrypted recipient snapshot and one stable UUID Idempotency-Key, in state `awaiting_payment`. This validates the Raslo-compatible address **before** payment creation. The Stripe fulfillment transaction changes it to `pending` only after payment is confirmed. If checkout expires, the waiting snapshot is cancelled locally without a delivery API call. Turning forwarding on does not backfill old orders or pick up checkouts created before opt-in.

Eligible orders are physical listing-only orders, AED, a saved AE recipient address, and confirmed payment with source state `processing`. Digital/POD and legacy orders without a verified checkout/address snapshot are excluded. An old eligible paid order can be sent explicitly with the **Send this order to Raslo** button; this creates a real delivery and is not a harmless connectivity test. A store cannot send or retry another store's order.

## Installation

Commit the previous checkout update first. Apply only to mj-app, then:

```sh
php artisan optimize:clear
php artisan migrate
npm ci --include=optional
npm run build
php artisan view:cache
php artisan test
php artisan queue:restart
```

Use the project's Docker/Sail equivalents if appropriate; run npm consistently inside the same OS/container. The known Rollup native-package problem is not fixed by copying Mac `node_modules` into Linux. For Sail:

```sh
./vendor/bin/sail artisan optimize:clear
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm ci --include=optional
./vendor/bin/sail npm run build
./vendor/bin/sail artisan view:cache
./vendor/bin/sail artisan test
./vendor/bin/sail artisan queue:restart
```

The migration adds `raslo_connections` and `raslo_shipments`. Keep the existing APP_KEY; encrypted credentials, checkout addresses and request snapshots depend on it. No actual environment file is changed by the installer. Do not roll back/delete mappings after real shipments are created: losing them can lose deduplication/tracking history.

## Configure the operator-owned HTTPS endpoint

In **mj-app** `.env`:

```env
RASLO_API_BASE_URL=https://ACTUAL-RASLO-BACKEND/api/integrations/v1
RASLO_TRACKING_HOSTS=ACTUAL-RASLO-TRACKING-HOST
QUEUE_CONNECTION=database
```

The API base is a server/operator setting, not merchant input. It must be HTTPS on port 443 with a public hostname and end in `/api/integrations/v1`; no query, credentials, fragment or IP literal. DNS results must all be public; the chosen address is pinned to the request, environment proxies/redirects are disabled, certificate validation remains on, and response size/time is bounded. cURL is required. Tracking hosts are exact hostnames, comma-separated, without scheme/path. The API hostname is trusted for tracking by default; configure another hostname only when it is the actual Raslo tracking origin.

For the current Raslo Docker setup, start/reuse its tunnel in a dedicated terminal:

```sh
docker run --rm -it --network container:deliveryhub-nginx \
  cloudflare/cloudflared:latest tunnel --no-autoupdate --url http://127.0.0.1:80
```

Use its real URL, not a previous session's temporary hostname. In **Raslo** set `RASLO_INTEGRATION_PUBLIC_URL` to that HTTPS origin (without `/api`), clear config and restart its queue/scheduler as usual. Its Delivery API and tracking routes are already present. A hostname change requires updating the operator configuration and clearing/restarting workers in mj-app. Never point pending snapshots at an unrelated Raslo installation merely because connection IDs happen to match.

## Create a separate Raslo connection for each store

1. Sign in to the store's **paid, active Enterprise merchant** in Raslo.
2. In My stores & integrations, use/create a dedicated **API / Push** store connection for this mj-app store; an unused catalog key need not be configured in mj-app. No fake feed is needed. Keep the connection active.
3. Open Delivery-order integration, enable it and select the merchant-owned pickup address. Make sure the pickup has its correct emirate for existing automatic emirate pricing.
4. Save and copy the one-time **Delivery API key**. Initially leave callback URL empty if desired; polling works without it.
5. In mj-app's store dashboard open Raslo delivery integration. Paste that Delivery API key, enable forwarding and choose **Verify and save**. Do this before creating the test checkout.
6. For signed callbacks, copy the displayed callback path `/integrations/raslo/events/{public_id}`. Expose mj-app through its own HTTPS tunnel/domain. Put that full HTTPS URL into the **same** Raslo connection's delivery settings. Approve the exact mj-app hostname in Raslo's `CATALOG_FEED_HOSTS`, preserve existing allowed hosts, clear config and restart workers. This is the mj-app/store host, not the Raslo API host.
7. Copy the signing secret that Raslo issues into mj-app's signing-secret field and save. If the secret was lost, rotate credentials in the same Raslo connection and update both key/secret together in mj-app. Do not create a replacement connection to bypass an existing delivery reference.

For mj-app served locally on port 8093, a tunnel installed on the Mac can target `http://127.0.0.1:8093`. If using Docker, expose it by a tunnel/container appropriate to that web service; its internal port may be 80. Keep the separate Stripe CLI listener running for Stripe payment events. The Raslo callback is independent from `/stripe/webhook`.

## Runtime and recovery

Use a database/Redis queue, a continuously running queue worker and the Laravel scheduler. For example in separate local terminals:

```sh
php artisan queue:work --tries=1 --timeout=60
php artisan schedule:work
```

Sail equivalents use `./vendor/bin/sail artisan …`. Do not duplicate long-running workers if managed ones already exist. Queue retry_after must exceed the worker timeout (the project's database default is 90 seconds).

- `raslo:send-due` runs every minute and dispatches eligible outbox IDs. The queue contains IDs only; no key or recipient payload is serialized into jobs.
- Each send claims a row under a database lock and uses a per-attempt lease. The HTTP request runs outside the transaction. Timed-out/lost claims become recoverable after two minutes. A dead broker leaves the row durable; stale queued claims can be requeued.
- Every attempt uses the exact stored payload, external reference `mj:{shop_id}:{order_id}` and original UUID Idempotency-Key. It does not read a later-edited customer profile/address for retries. Network errors, 429 and 5xx back off with a limit of 12 attempts. Other 4xx and response mismatches stop in `review`; they are not silently retried forever.
- The explicit Retry forwarding action preserves the payload/key and never creates another local shipment row. A validation/reference conflict requires operator review; changing a frozen address/key to evade 409 is deliberately unsupported. Do not create a new order reference simply to bypass a potentially successful delivery request.
- `raslo:poll` runs every five minutes and queues state GETs for enabled, bound shipments. Queue errors are recoverable. Failed poll requests preserve the last known state. A successful authoritative GET can clear an expired tracking URL even at the same sequence.
- Disabling stops future dispatch/poll work without calling Raslo to cancel anything. An already in-flight HTTP request cannot be unsent. Signed callbacks for known existing deliveries may still update their state while forwarding is disabled.

Manual operator commands:

```sh
php artisan raslo:send-due
php artisan raslo:poll
php artisan queue:work --once --tries=1
```

Do not manually run the same scheduler/workers in parallel with managed production services just to force repeated calls. The dashboard shows forwarding state, error code, delivery state, price and tracking. A 401/403 generally requires checking keys, connection activation or Enterprise access; 409/422 require inspecting the original delivery/reference/address. No provider response body or recipient data is shown in error logs/messages by this module.

## Callback verification and state

The callback verifies the raw body (64 KiB limit), independent signing secret, five-minute timestamp window, header/body event ID, event type, delivery UUID and external order reference within the configured store. Duplicate/older sequences return 200 without regression. An early callback before the create response has bound the UUID returns 503, allowing Raslo to retry. Unknown/mismatched mapping returns non-2xx. No caller-supplied user/shop IDs can select another merchant's row.

Delivery status and the tracking capability are stored separately from marketplace payment/order state. Completing a delivery does not automatically mark a marketplace order completed, change payment, refund a customer or cancel a source order. Buyer Profile → My deliveries lists only owned shipments, with links to the buyer/merchant tracking page `/orders/{order}/delivery` requires ownership, is non-cacheable, and only exposes approved HTTPS tracking links. Treat a tracking link as private shareable order information.

Raslo's optional automatic pricing is reused: a shipment may enter `pending_pricing` or `priced`. The merchant must approve the Raslo fee in Raslo before assignment. This module does not approve that price automatically or change the existing 0.00 AED checkout shipping charge. It also does not add COD, refunds, automatic cancellations, returns or catalog import.

## Acceptance

1. Verify forwarding is enabled before starting a **new** physical AED checkout. Use Stripe Test mode, a complete UAE address and known inventory. Confirm the connection belongs to the correct merchant/pickup.
2. Complete payment. There should be one local paid order and one queued shipment. Run/inspect scheduler and worker. Confirm one Raslo delivery and a bound UUID in the store dashboard.
3. Retry/reload and simulate a network retry: confirm no second Raslo delivery for the same external reference/key.
4. Price/approve in Raslo, assign a pilot driver and complete the existing delivery workflow. Check signed callbacks or wait for the next poll. Confirm local delivery state advances while payment remains paid and the marketplace order remains in its original fulfillment state.
5. Repeat with a second merchant using a separate Raslo connection. Confirm isolation. Test disabled connection, rotated key, expired Enterprise, dead queue, replayed/older events and browser back/refresh.
6. Test on the actual MySQL setup with real queue workers and the two HTTPS endpoints before production use. Existing paid orders require explicit manual action; do not bulk-forward old completed/shipped orders.

Local tests use SQLite, mocked public DNS transport and fake outbound HTTP/queues. Real Raslo/Stripe credentials, a live MySQL daemon, a real phone and end-to-end HTTPS tunnels were not available in this execution environment. No real shipment/payment/price approval, GitHub push or deployment was performed.

Validation for this package: **78 passed, 6 skipped, 278 assertions**, plus Vite build, Blade cache and diff checks. Skips are existing optional-feature/alternate-registration cases. No tests used real credentials or created a real shipment.
