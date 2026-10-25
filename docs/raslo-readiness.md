# mj-app: checkout repairs before Raslo integration

Historical preparation stage. The subsequent opt-in bridge is now described in [raslo-order-bridge.md](raslo-order-bridge.md).

This update prepares **physical listing orders** for a Raslo adapter. It does not send any order to Raslo, store a Raslo key, or claim production readiness for every marketplace module.

## Changes

- GET `/checkout` displays stores and collects an AE recipient address; payment creation requires an authenticated CSRF-protected POST. Each store has a separate payment. The buyer explicitly selects the store; items from other stores remain in the basket.
- Checkout uses current published, active listing prices, integer fils and stock checks. Quantities must be 1–99. Card payments retain the existing platform commission/Stripe destination-charge arrangement. This does not add Stripe Connect to Raslo.
- A database transaction reserves stock and saves an immutable order, cart-row snapshot, address and Stripe request. Repeat requests reuse the same order/request/idempotency key. Only one reserved checkout per customer/store may be open. Resume/cancel controls handle unfinished payment.
- Reservations last until Stripe confirms payment or expiry. Sessions are configured to expire after one hour. Cancel expires the Stripe session before releasing stock. A local timeout or network error alone never releases stock. Sold inventory is consumed once; expired sessions return it once.
- Payment settlement checks the exact session, customer/order reference, mode, amount and AED currency. The signed webhook can settle physical orders without the return page. Invoice, order and basket updates share a transaction; duplicate and older events do not regress a paid order.
- Recipient/address and the frozen request are encrypted using the existing `APP_KEY`. They are hidden from automatic model serialization. Do not regenerate an existing application's key.
- Digital return-page checks now bind a saved session to its actual buyer/order/product and USD amount. The arbitrary `Shop::first()` attribution is removed: the product owner must have a store. Protected download routes require a paid entitlement. Legacy digital route handlers no longer reference missing methods.
- Profile phone changes invalidate phone verification; an email-only change preserves verified phone status. Default user registration can establish its nonprivileged `user` role. New stores no longer receive duplicate wallets. Public components tolerate a missing settings record.
- Five foreign keys previously referenced tables created later in migration order. Their definitions are deferred until the referenced tables exist, allowing fresh MySQL installation. Historical migration edits do not rerun on existing installations.
- Added pull-request CI for SQLite/MySQL and frontend build. The existing Hostinger deployment now runs the SQLite suite before its SSH deployment steps.

## Install on a local/staging copy

Save current work in a commit first. The package installer only applies and stages a patch, never stashes work, changes `.env`, migrates, commits, pushes or deploys.

```sh
sh "$HOME/Downloads/mj-raslo-readiness-update/apply.sh" /actual/path/to/mj-app
cd /actual/path/to/mj-app
composer install
php artisan optimize:clear
php artisan migrate
npm ci
npm run build
php artisan view:cache
php artisan test
```

Use your existing PHP/Docker/Sail invocation if PHP runs in a container. There are no new dependency versions. `phpunit.xml` defaults to an in-memory SQLite test database; use a separate disposable database when overriding it for MySQL. Never run test migrations against production data.

**The repository already deploys pushes to `main` through `hostinger.yml`.** Review and test this change on a branch/staging environment before merging. No live Stripe calls, live payments or deployment were performed while developing this update.

## Stripe webhook and recovery

Existing physical checkout uses `STRIPE_SECRET` (`cashier.secret`). Preserve existing keys and subscription events. Configure `STRIPE_WEBHOOK_SECRET` and add:

- `checkout.session.completed`
- `checkout.session.async_payment_succeeded`
- `checkout.session.expired`

The webhook is `/stripe/webhook`. Missing signing configuration returns 503; invalid signatures are rejected. For a local test:

```sh
stripe listen --forward-to http://localhost:YOUR_PORT/stripe/webhook
```

Put that listener's signing secret in your **local** environment, clear configuration, and use a Stripe test account/store. Do not replace the production signing secret with a CLI listener secret.

Run a scheduler continuously, or the normal Laravel cron once per minute:

```sh
php artisan schedule:work
php artisan checkout:reconcile
```

Reconciliation retrieves saved session IDs from Stripe every five minutes. A crash after Stripe receives the request but before its ID is saved is recovered by retrying/resuming the same checkout with the same persisted payload/key. If no ID was saved and its one-hour window has elapsed, it is held for operator reconciliation; the application does **not** guess that no payment occurred or create a replacement charge. Find the session using the order's `client_reference_id` in Stripe, then:

```sh
php artisan checkout:reconcile --session=cs_ACTUAL_SESSION_ID
```

This fetches the session from Stripe and validates its order reference/amount before applying it. If Stripe confirms **no session was ever created**, release that unresolved reservation only through a separately reviewed support procedure; this update deliberately provides no blind “mark paid/release stock” shortcut. Orders created before this migration have no trusted saved session/address: reconcile any pending legacy payments with Stripe manually before rollout.

## Acceptance before connecting Raslo

1. Create two active AED stores with Stripe test accounts fully onboarded. Publish physical listings with known stock. Add products from both stores as a customer.
2. Open checkout: no order/charge is created on GET. Select one store and enter a UAE phone, emirate, city, area, full street address and building/unit.
3. Complete payment in Stripe test mode. Confirm exactly one paid order/invoice for that store, correct amount/stock and the other store still in the basket. Close the payment tab before returning and confirm the webhook still settles it.
4. Refresh/retry the same checkout and deliver duplicate webhook events: no duplicate order/invoice/stock decrement. Resume then cancel an unpaid session: stock returns only after confirmed Stripe expiry.
5. Repeat on the actual MySQL installation with two customers contending for the last units. Confirm scheduler reconciliation, payment-provider outage recovery, and unauthorized access rejection. MySQL concurrency and a live Stripe sandbox were not executed in this development environment.

## Raslo adapter contract to implement next

Each independent store needs its own approved, paid Enterprise connection and encrypted Delivery API key; the catalog feed token is separate. A key belonging to one merchant must not ship another store's order.

Map the persisted snapshot, never request data from a browser or a changing customer profile:

| mj-app snapshot | Raslo request |
| --- | --- |
| `mj:{shop_id}:{order_id}` | `external_order_id` |
| confirmed `payment_status=paid` | `payment_status=paid` |
| order checkout currency `AED` | `currency=AED` |
| `shipping_address.recipient_name` | `recipient.contact_name` |
| normalized `shipping_address.recipient_phone` | `recipient.contact_phone` |
| `city`, `emirate`, `area`, `address_line`, `building`, `unit`, `landmark` | same fields under `recipient` |

Persist an outbox record, frozen Raslo request and stable Idempotency-Key before sending `POST /api/integrations/v1/deliveries`. Store the resulting delivery UUID separately from the marketplace payment/order status. Add signed status webhooks and periodic reconciliation with sequence checks. Only send eligible physical paid AE/AED orders after merchant opt-in.

Shipping remains **AED 0.00** in the current marketplace checkout, as before this repair. It is not a quote from Raslo and does not approve a merchant delivery fee. Before enabling customer-paid delivery, implement a quote/fee policy and merchant price approval using Raslo's existing pricing flow. No rate or geographic coverage was invented here.

## Remaining scope and release limits

- A real Raslo adapter, merchant connection settings, catalog synchronization and delivery tracking UI are the next phase.
- The legacy POD/digital checkout still relies on its return page for fulfillment, uses USD, and lacks the physical address/reservation/recovery flow. POD must not be treated as eligible for Raslo until it has its own shipping flow. Legacy orders and refunds require separate reconciliation; cancelling Checkout is not a refund or delivery cancellation.
- Digital binary uploads currently remain on the public storage disk. Route entitlement checks do not protect a previously known static storage URL. Move binaries to private storage and migrate/remove public originals before relying on paid digital-file protection. This update does not move/delete existing customer files.
- Fresh MySQL CI and true concurrent inventory testing must complete on GitHub/staging. Local automated verification uses SQLite and fake Stripe responses; it neither tests a real payment account nor certifies every marketplace feature.

References used for payment behavior: [Stripe fulfillment](https://docs.stripe.com/checkout/fulfillment), [limited inventory](https://docs.stripe.com/payments/checkout/managing-limited-inventory).

Local validation: **53 passed, 6 skipped, 166 assertions**. Skips correspond to disabled optional API/account-deletion features and the alternate registration-disabled condition. Composer validation, Vite build and full Blade compilation passed. GitHub write access returned 403, so no branch/PR/commit/push/deployment was created.
