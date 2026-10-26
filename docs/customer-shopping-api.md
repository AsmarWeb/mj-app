# Native customer basket, orders and delivery API

This patch adds eight endpoints under `/api/v1` for the Expo client's shopping/account screens. It does not create payments or deliveries. Use the existing native login token with explicit `mobile:account`, HTTPS, `Accept: application/json` and `Authorization: Bearer <token>`. Cookie-only sessions and other token scopes are not accepted. The existing 60 requests/minute/account budget is shared with account endpoints.

| Method/path | Result |
| --- | --- |
| GET /cart | Current server-priced basket; an empty read creates no cart |
| POST /cart/items | Add quantity of a visible physical listing; body: listing_id and quantity; 201 |
| PATCH /cart/items/{item} | Set an absolute quantity, not an increment; body: quantity; 200 |
| DELETE /cart/items/{item} | Remove own row, including unavailable products; 204 |
| DELETE /cart | Clear own basket; 204, including an already empty basket |
| GET /orders | Own orders, descending ID, paginated; data/links/meta |
| GET /orders/{order} | Own purchased item snapshots and allowlisted shipping address |
| GET /orders/{order}/delivery | Saved Raslo status/approved tracking link, or data:null when not connected |

## Basket behavior

The basket is the existing server cart shared with the website. Mutations reuse CartService and lock the user/cart/item/product as appropriate. Input user_id, shop_id, price, total and ownership values cannot override server data. POST is additive, so retrying it after an uncertain network result may add again: refresh GET /cart first. PATCH is an absolute quantity and is suitable for quantity controls.

Mobile adds/quantity updates require publicly visible listings/stores using the same scopes as the catalog API. Only AED products with positive prices and quantity 1–99 within current stock are eligible. The mobile basket is limited to 100 product lines; oversized legacy baskets return 422 and can be reduced with DELETE operations or managed on the website. Existing web add behavior is preserved by an opt-in public-validation argument in the shared service.

GET /cart uses current server prices rather than the stored cart-price snapshot. Hidden/deleted products are returned as product:null with available:false, without exposing their updated private title/price. Other unavailable conditions, such as insufficient stock, retain public product information. If any row is unavailable, subtotal is null and has_unavailable_items is true. Monetary values are decimal strings; the subtotal is an item-only AED amount, not an invoice or checkout quote. Multi-store grouping uses each item's public product.shop; payments remain separate per store.

Reading/editing a cart does not reserve/release stock, cancel an existing order, change a subscription or contact Stripe/Raslo. A cart item remaining from a pending checkout can appear unavailable due to reserved stock; use the existing website resume/cancel workflow. Payment creation, checkout readiness, fees, addresses and order cancellation APIs are separate work.

## Orders and privacy

Orders are always queried through the authenticated customer's orders relationship, including detail and delivery lookups. Another customer's order or cart row returns 404. Store owners/admins do not gain access through these customer routes; merchant/admin workflows remain separate.

GET /orders supports per_page 1–50 (default 20), page 1–10000, status and payment_status filters. Only validated filters are echoed in pagination links. Client-supplied user_id never broadens the query. Order totals/currency are the stored purchase values; legacy missing currency stays null rather than being guessed or mixed into an aggregate.

List rows omit shipping addresses and item collections. Details include the purchased item title/quantity/prices and a whitelist of the owner's recipient/address fields. Disabled/hidden stores are not returned as current public shop metadata. Never serialize checkout tokens/keys, Stripe session/payment IDs, provider payloads, internal notes, private download paths, supplier payouts, Raslo connections or credentials.

## Delivery

Delivery reads use saved local status only: no polling request, queue dispatch, delivery creation or status write occurs. Currency/fees and merchant pricing-approval operations are not exposed. Tracking links pass the existing RasloEndpoint host/HTTPS validator. Treat a returned URL as a private tracking link; responses are private/no-store and use no-referrer.

Accept-Language: ar (including ar-AE) returns Arabic status_label; en/default returns English. The status code is stable for UI logic. The header is Content-Language and Vary includes Accept-Language. Delivery completion does not change the marketplace order/payment state. data:null means no saved Raslo shipment, not an error and not proof of merchant-managed fulfillment progress.

## Client handling and scope

Use 401 to clear an invalid/expired token, 403 for missing explicit ability, 404 for unavailable/not-owned resources, 422 for validation/availability/oversized legacy carts and 429/Retry-After for rate limits. Authenticated unverified customers can read/manage their own cart and order history as on the website; future payment/merchant endpoints must enforce their own verification and ownership requirements.

The contract is in [customer-shopping-openapi.json](customer-shopping-openapi.json). Existing auth and public catalog contracts remain separate. This is a backend foundation; native checkout, the Expo UI, browser visual acceptance and production payment testing are not included.

The installer changes only source/tests/docs, with no migrations, .env/key edits, dependency install, runtime database operation, push or deployment. Refresh existing route caches during an authorized runtime update for new routes to appear. Runtime API calls intentionally mutate only the customer's cart for the documented write operations; authentication may update Sanctum's token last-used timestamp.
