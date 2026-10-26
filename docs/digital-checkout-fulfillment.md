# Digital/POD payment fulfillment

## Confirmation

`checkout.session.completed` and `checkout.session.async_payment_succeeded` use the same fulfillment service as the authenticated success page. The service requires a complete, paid Stripe session; a success URL alone never grants access. The webhook uses Cashier's signature verification and requires its existing signing secret. No customer session/login is required for the webhook.

The order/session binding checks the saved session ID, order ID, client reference token, payment mode, currency, exact integer amount, single digital-product order item and product ID. Paid fulfillment also requires a payment intent. New sessions have `checkout_kind=digital_v1`. Physical checkout and subscriptions keep their existing handlers.

## Frozen purchase terms and idempotency

New checkout stores its fulfillment snapshot in the existing encrypted `orders.checkout_payload` field. It freezes product type, supplier ID, supplier base cost and base-product description. Order items hold the purchased title, unit price and quantity. Later product edits do not redirect an already purchased POD item to a different supplier or change the payable base cost.

Order row locks prevent duplicate webhooks or simultaneous success-page callbacks from creating repeated entitlement/payout records. Digital entitlement tokens are retained; buying is not counted as downloading a file. Product and entitlement row locks serialize entitlement creation across different orders for the same product. An old expiry/failure event cannot regress an already paid order. A refunded order is never reactivated by an old paid event. Refund processing and entitlement revocation remain separate work.

The Stripe create call uses a stable key for its persisted order. Each new checkout request still creates a distinct order: this is not a cross-request duplicate-purchase prevention feature. A provider timeout must be reviewed in Stripe before another purchase is attempted.

## Existing sessions

Legacy digital sessions without `checkout_kind` are supported only when the saved order/session ID, token, product, USD currency and exact amount match. For these older orders, fulfillment terms must be read from the current product because no historical snapshot exists. Review legacy POD terms before replaying such events if product supplier/cost/type changed. Unbound legacy sessions are rejected; do not manually mark them paid.

For new orders, a verified event or retrieved session can recover a missed session-ID save by matching the persisted checkout token and frozen order terms. Recovery never creates another Stripe payment.

## POD notices and currencies

Payment, payout obligation and the pending-notification marker commit before email delivery. Failed notices retain `paid_notice_pending`; later webhook retries or reconciliation retry them. Successful notices are checkpointed, so ordinary duplicate events send one notice. Mail delivery is at least once: a crash after the mail server accepts an email but before its checkpoint commits can produce a duplicate notice. Supplier operations should identify work by order number.

The digital/POD sale remains **USD**, preserving the existing checkout contract. Supplier base cost remains **AED**, preserving the pre-existing supplier email convention; the encrypted snapshot labels this explicitly. No currency conversion, Stripe transfer or automatic supplier payout is performed. `SupplierPayout` records are pending internal obligations. Confirm the intended supplier settlement currency before production; this change does not solve the older module's mixed-currency accounting.

POD checkout now requires a configured supplier with an email. Recipient shipping addresses, variants, shipping fees, production workflow and refunds are not made production-ready by this patch. Raslo forwarding remains limited to the separate physical-product flow.

## Recovery

The scheduler runs `digital:reconcile` every five minutes alongside the existing checkout/Raslo tasks. It checks pending USD digital orders with saved sessions and retries paid POD notices. It reads Stripe's authoritative state and performs the same binding checks as webhooks. A missing saved session is reported for operator review, without creating or charging another payment. It returns a nonzero exit code when automatic recovery or notice retry fails.

For one known session:

```sh
php artisan digital:reconcile --session=cs_...
```

This command changes order state when verified payment is found; run only during an explicitly authorized operational recovery. Installing this code does not run it. Existing scheduler processes must pick up the new source when you deliberately activate the update. Keep the existing signing secret and APP_KEY. Configure Stripe to deliver these events to the existing webhook:

- `checkout.session.completed`
- `checkout.session.async_payment_succeeded`
- `checkout.session.async_payment_failed`
- `checkout.session.expired`

Private digital-file migration, stable HTTPS and a tested staging payment remain prerequisites before production use. No schema migration is required for this patch.
