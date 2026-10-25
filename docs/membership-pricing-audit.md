# Membership pricing and subscription repair

Baseline reviewed: `ac37b20` on `fix/raslo-checkout-readiness` (25 October 2026). These are murwaj merchant memberships, not Raslo's Enterprise subscription plans.

## Plan defaults retained

| Plan | Amount per month | Published listings | Listing duration | Calendar-month orders | Storage MB |
| --- | --- | --- | --- | --- | --- |
| Free | 0 | 5 | 30 days | 5 | 100 |
| Basic | 9.99 | 50 | 60 days | 100 | 5000 |
| Pro | 29.99 | 500 | 90 days | 1000 | 20000 |

Amounts are in the operator's `CASHIER_CURRENCY`; its previous fallback is USD and this update keeps that default. They are not automatically AED. No live database, Stripe account, amount, existing price ID or billing currency was changed. A currency change requires matching recurring Stripe prices and an explicit commercial decision. Checkout validates the price ID, amount, currency, recurring interval and interval count before opening a subscription session. The decimal amount validation supports ordinary two-decimal pricing (such as USD/AED).

Free remains free with the same limits. Existing overrides of any plan are preserved on re-seeding. New Basic/Pro rows use `MEMBERSHIP_BASIC_STRIPE_PRICE` and `MEMBERSHIP_PRO_STRIPE_PRICE`; missing IDs disable checkout rather than using someone else's hard-coded Stripe prices. Environment seed values initialize missing rows only: they do not replace existing DB values.

## Confirmed defects repaired

- `/pricing` ordered by nonexistent `is_popular`, failing on a fresh schema. The paid list now sorts by actual price.
- Free pricing/storage/duration used fixed text instead of configured DB limits. Both languages now read those values. The original translations already said five products; no reduction or increase was required.
- Paid cards promised unlimited featured listings from a nonexistent `featured_limit` column. Unsupported featured/video promises are removed from paid cards.
- Webhook synchronization marked any mapped subscription `active`, including unpaid/cancelled states, while merchant components trusted that stale local flag. A shared entitlement scope checks actual Stripe status, price mapping, plan activation and end date.
- The custom Cashier subscription model was not registered. It is now registered consistently.
- Legacy webhooks expired the Free row, leaving no fallback when payment ended. Existing Free rows remain usable as the baseline; only eligible Stripe rows take priority. No paid row is created by a redirect or browser session plan ID.
- The success route used a static success view. It now verifies a saved checkout's customer, token and session against Stripe, then refreshes the authoritative subscription. A forged return cannot activate a plan.
- Repeated/new checkouts could create a second subscription while the previous one was incomplete/past due. A persisted encrypted attempt freezes the payload and idempotency token. Non-terminal remote subscriptions require billing management instead of a second subscription.
- Direct plan swaps could update the local plan before payment was resolved. Existing subscriptions now use Stripe Billing Portal for payment details, cancellation and configured price changes. Its account configuration controls which products/prices and proration policies are offered; no proration policy is imposed by this update.
- Delayed subscription events could restore old access. Subscription create/update/delete events now read current provider state under a per-user database lock. Provider failure returns a retryable webhook failure. `membership:sync` recovers known subscriptions/known checkout sessions every five minutes.
- The plan seeder used non-repeatable inserts and embedded account-specific price IDs. It now creates only missing plans and retains operator settings.
- The order quota helper used stale `shops.plan_id` and was not called during physical checkout. Checkout now reads the effective subscription, serializes store reservations and counts paid orders plus pending stock reservations within the calendar month. Confirmed expiry releases the slot. A store without an eligible membership cannot start a new physical checkout.
- Free advertised no video, but seller creation accepted video uploads. Its server validation now prohibits new Free video uploads and hides that upload section. Existing files/products are retained.
- `User::storageUsed()` called a nonexistent `listings()` relation and used an aggregate incorrectly. It now sums unique public product/gallery/video files through the actual `listing()` relation; new listing storage checks reuse it.
- Incorrect `Subcategory` class capitalization broke seller creation on Linux. Seller/admin imports and listing relations now match `SubCategory.php`.

## Apply and operate

Apply on a clean development branch on top of the baseline (or its merge into main), review the staged diff, then use your existing Sail stack:

```sh
./vendor/bin/sail artisan optimize:clear
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed --class=PlanSeeder
npm run build
./vendor/bin/sail artisan view:cache
./vendor/bin/sail artisan test
```

The migration adds only `plan_checkout_attempts`. Keep the existing APP_KEY: the persisted checkout payload is encrypted. Do not regenerate keys or use migrate:fresh. There are no new dependencies or lockfile changes.

In Stripe, configure Billing Portal in the same test/live account and enable the intended subscription products/prices, payment updates and cancellation options. Retain your current signing secret and subscription create/update/delete events. Checkout session completion provides another recovery path. Keep the existing scheduler, queue and Stripe listener running for local acceptance.

After migration, run `membership:sync` to reconcile existing real Stripe subscriptions (including legacy rows whose provider metadata was missing). Restart long-lived workers and the scheduler using the existing Compose project:

```sh
./vendor/bin/sail artisan membership:sync
docker compose -f docker-compose.yml -f docker-compose.raslo.yml restart raslo-queue raslo-scheduler
```

`membership:sync` makes provider reads and local updates, not charges. It reports a failure count; repeated failures need investigation of credentials/network/IDs. An unknown mapped price fails closed for paid access; correct the plan's actual DB Stripe price mapping first.

If a session-create response was lost and local expiry has passed, the code deliberately does not create a fresh uncertain payment. Find the original Checkout session in Stripe and run:

```sh
./vendor/bin/sail artisan membership:recover cs_test_ORIGINAL_SESSION_ID
```

This retrieves an existing session and binds it only if its customer and reference match a saved attempt. It does not create a session or payment. Never manually delete the uncertain attempt to bypass reconciliation. A verified expired session can be replaced during the next checkout.

## Acceptance and boundaries

Use Stripe test mode: Free display and product limits; first paid subscription without returning to the site; repeated button clicks; decline/3DS/past_due; plan change through the configured portal; cancellation now/at period end; missed/delayed/duplicate events; return to Free; and the monthly order quota. Confirm a different customer cannot use a checkout return. Free video uploads must fail on the server.

Automated tests use SQLite and mocked Stripe boundaries, including signed webhook requests. No real charge, live Stripe API mutation, deployment, native-device test or MySQL concurrency test was performed for this package. CI after applying must verify MySQL as well. Vite and frontend tests are checked independently.

## Other work still needed

- Publish/storage limits during simultaneous listing creation and image replacement still need a complete transaction and file-lifecycle policy. New listing checks are present, but this is not a claim that every upload route shares a global quota. Existing paid content above a downgraded plan's limits is retained, not silently deleted; define a visibility/archive policy before enforcing a destructive downgrade.
- `custom_domain` and `mobile_app` in the plan table are configuration flags, not proof of complete automated provisioning. Do not advertise those services as automatically delivered until their implementation is verified.
- Existing Stripe customer history exceeding one page fails closed for new checkout and requires support review. Subscriptions in another product on the same Stripe customer also prevent a new membership checkout until reviewed.
- Digital/POD fulfillment, refunds/cancellations and the previously recorded moderate frontend dependency advisories remain separate work. This repair is not a whole-marketplace audit.
