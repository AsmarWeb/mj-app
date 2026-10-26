# Native physical checkout

This adds AED/UAE physical checkout for the Expo client using the existing PhysicalCheckoutService, Stripe hosted Checkout, inventory reservations, membership limits and Raslo bridge. It is not a second payment engine and does not enable digital/POD purchases in the native app.

## Native API

All endpoints require an unexpired bearer token with explicit mobile:account, plus a verified email. Phone/account verification is not bypassed or auto-approved; this flow validates the recipient's UAE address/phone separately. It shares the account budget and adds a 10 requests/minute/customer checkout budget.

| Method/path | Behavior |
| --- | --- |
| POST /api/v1/checkout | Start or recover a keyed purchase from the caller's own cart, one store at a time |
| POST /api/v1/checkout/{order}/resume | Return the same frozen Stripe session URL when open |
| POST /api/v1/checkout/{order}/refresh | Retrieve the saved Stripe session and reconcile server state |
| POST /api/v1/checkout/{order}/cancel | Ask Stripe to expire an open session; release stock only after confirmed expiry |

New checkout requires Idempotency-Key: a fresh UUID per intended purchase. Retain it on the device until the attempt is resolved and reuse it after uncertain network results. Send shop_id, recipient_name, recipient_phone, emirate, city, area, address_line and building; unit, landmark and delivery_notes are optional. Parent web address validation/Arabic-digit normalization is reused. Recipient country is forced to AE. Client totals, prices, user IDs, session IDs and return URLs cannot override server values.

Responses use data with order_id, order_number, status, payment_status, checkout_state, currency, total, checkout_url and expires_at. An open checkout_url is a private HTTPS Stripe link. Closed attempts can return checkout_url:null. Do not put access tokens into URLs or logs.

## Retry and inventory guarantees

The mobile request UUID is namespaced by customer into a stable checkout identity using the existing checkout_token field. The normalized store/address input hash is persisted in encrypted checkout metadata. Retry with the same key and normalized address/store reuses the original order and payment, including after the order was paid or expired. Changed store/address with the same key returns 409. Cart contents are frozen at the first attempt; changing the cart does not change a repeated keyed purchase. Use a new key for a genuinely new purchase after resolving an existing attempt.

Concurrent creation checks again while holding the customer row lock. A different request key cannot bypass an existing stock-reserving checkout for the same store. Prices, quantities, membership limits and mixed Raslo/non-Raslo restrictions are enforced by the existing service; native creation additionally requires public store/product scopes. Unit prices and totals use integer fils. Retries preserve the stored Stripe payload and provider idempotency key.

Stripe connectivity errors return 503 PAYMENT_PROVIDER_UNAVAILABLE with a recoverable own order_id when known. Recover that order using resume/refresh or repeat the same keyed POST; never start another payment on a timeout. A missing saved session during refresh returns 409 CHECKOUT_RECOVERY_REQUIRED. Identity/total/provider-destination mismatches return 409 CHECKOUT_REVIEW_REQUIRED. Inspect/reconcile those cases rather than accepting client payment claims.

Cancellation is checkout expiry, not a refund or cancellation of a paid delivery. Paid/refunded orders are not downgraded by these endpoints. If Stripe already reports paid when cancellation is requested, paid fulfillment wins. Expiry releases stock once; a failed Stripe request leaves it held. Unknown attempts past the existing creation window require operator reconciliation and are never silently recreated.

Native mutation endpoints accept only the owner's mobile-channel physical orders. Existing website/digital checkouts are not converted or rerouted. Use their existing web flows. Public web checkout return URLs and behavior remain unchanged.

## Return to Expo

New mobile Stripe sessions use short-lived signed HTTPS success/cancel navigation URLs:

`/api/mobile/checkout/return/{order}/{returned|closed}?expires=...&signature=...`

The signature expires after two hours. The stateless bridge renders a small bilingual page with a button to the fixed destination:

`murwaj://checkout/result?order_id=123&outcome=returned`

No caller-controlled destination is accepted. No bearer token, client reference, Stripe session ID, address or payment data is forwarded. The bridge is read-only, does not even query the order, and never claims payment succeeded. It uses no-store/private, no-referrer, noindex and restrictive CSP headers. Altered or expired signed links fail; users may open the app manually and inspect their own order instead.

Configure the Expo development/production build with scheme murwaj and implement the checkout/result route. Custom schemes require a new native build and do not work as that scheme in Expo Go. The button requires the app to be installed. Domain-verified universal/app links are future hardening; custom-scheme interception exposes only the navigation hint, never authority to read or pay an order.

Suggested client sequence:

1. Persist a new UUID, then POST the selected store and address with Idempotency-Key.
2. Persist returned order_id and open the HTTPS Stripe checkout_url in the system browser.
3. On app return/resume, ignore any asserted outcome or paid flag in the incoming link.
4. Authenticate and POST refresh for the owned order, or read its latest order details. Display paid only when the server says paid.
5. If still pending, retry a bounded refresh with backoff. Webhooks remain responsible when the app is closed.

Use the existing signed Stripe webhook and scheduler. Do not mark an order paid because the bridge or browser reports success. Ensure APP_URL already points to the intended stable HTTPS server before a real native checkout; signed URLs bind that origin. No environment change is made by this patch.

## Activation and remaining scope

Installing this source does not create sessions, charge cards, reserve stock, send deliveries, migrate or change .env/keys. Runtime POSTs intentionally perform those authorized checkout actions; the signed bridge does not. Refresh route caches during an authorized local/deployed update. Preserve APP_KEY, webhooks, queue/scheduler processes and pending checkout identities.

Stripe test-mode staging, actual iOS/Android deep links/browser return and real-device acceptance remain required before deployment. Physical Raslo fees retain the existing policy: they are not added to customer checkout by this patch. Native digital purchases, in-app billing, refunds, shipment cancellation and the Expo UI are separate work.

Contract: [mobile-checkout-openapi.json](mobile-checkout-openapi.json).
