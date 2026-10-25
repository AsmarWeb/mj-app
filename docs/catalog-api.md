# murwaj public catalog API v1

This update builds on `779b921` (`fix/pricing-subscriptions`). It fixes catalog visibility and establishes a versioned read-only contract. It does not enable mobile login, product mutations, payment initiation, order creation, token issuance or extra subscription entitlements. Free/Basic/Pro and the Raslo delivery bridge keep their current behavior.

## Endpoints

No authentication is required to read **publicly visible** catalog records:

| Method | Path | Result |
| --- | --- | --- |
| GET | `/api/v1/shops` | Paginated public shops |
| GET | `/api/v1/shops/{slug}` | Safe shop details, up to ten public listing previews, and `listings_url` |
| GET | `/api/v1/shops/{slug}/listings` | Paginated public products from that store only |
| GET | `/api/v1/listings` | Paginated public products |
| GET | `/api/v1/listings/{slug}` | Safe product detail |
| GET | `/api/v1/openapi.json` | OpenAPI 3.0.3 contract |

Examples for your existing Sail port:

```sh
curl -H 'Accept: application/json' 'http://localhost/api/v1/shops?per_page=10'
curl -H 'Accept: application/json' 'http://localhost/api/v1/listings?currency=AED&min_price=10&max_price=100&in_stock=1&sort=price_asc'
curl -G -H 'Accept: application/json' --data-urlencode 'q=قميص' 'http://localhost/api/v1/listings'
```

Use your actual domain/port. `api_url` is a JSON API link; the retained product `url` points to the existing website page and may require website login. Media links use the configured public disk URL (normally APP_URL/storage). Configure the real HTTPS origin and trusted proxy correctly when serving external clients; do not assume localhost media URLs work on another device.

## Visibility and serialization

A shop must be active, completed, not deleted, and have a publication timestamp no later than now. A listing must also be active, `published`, not soft-deleted, have a due publication timestamp, and have no expiry or a future expiry. Its store must pass the same shop rules. Stock zero does not hide a published product unless `in_stock=1` is requested. Missing and hidden slugs both return 404, including for an authenticated owner using these public endpoints.

All paths, including legacy aliases, share these rules. The old `status = 1` enum comparison has been replaced with explicit publication rules. Shop publication updates now preserve a requested future date/null instead of silently replacing it with now. No existing publication dates are rewritten.

Responses explicitly allowlist product/store/reference fields. They do not expose raw related models, owner/audit IDs, publication status fields, Stripe IDs/keys, wallet contents or private delivery data. Phone and WhatsApp are omitted when their respective shop visibility flags are false. Business location and coordinates remain public shop metadata as before; this API does not expose driver location or recipient addresses.

Taxonomy and location references contain only `id`, `name`, `name_ar`, and `slug`. Listing city/state values and location filters come from the shop, because listings have no such columns. Ratings use only approved reviews in the catalog query, avoiding separate rating queries for every product. The shop preview omits nested shop objects to prevent recursive/unbounded expansion.

Media filename fields are retained and URL fields are added. Unsafe absolute/traversal/control/encoded paths are omitted; external media URLs are not automatically trusted. At most 20 gallery paths and 50 features/keywords are returned. Description lengths are bounded. Text is user-generated JSON content, not a promise of sanitized HTML: render it as text or apply an appropriate HTML sanitizer before any HTML rendering.

## Pagination and filters

Collections always return `data`, `links`, and `meta`, including `meta.current_page`, `meta.per_page`, and `meta.total`. Default page size is 20; `per_page` accepts 1–50 and `page` accepts 1–10000. Invalid query values return 422. Newest/oldest ordering uses IDs; price sorting is numeric despite the legacy string price column and uses ID as a tie breaker. Offset pagination is not a synchronization snapshot: concurrent changes can move records between pages.

| Query | Shops | Listings |
| --- | --- | --- |
| `q` | English/Arabic shop names | English/Arabic product titles |
| `sort` | `newest`, `oldest` | `newest`, `oldest`, `price_asc`, `price_desc` |
| `section_id`, `state_id`, `city_id` | Yes | Yes; state/city use the store's location |
| `country_id` | Yes | No |
| `shop_id`, `category_id` | No | Yes |
| `currency` | No | Uppercase three-letter shop currency |
| `verified=1` | Verified shops only | No |
| `in_stock=1` | No | Positive quantity only |
| `min_price`, `max_price` | No | Inclusive bounds, up to eight integer digits and two decimals |

Search treats `%`, `_` and `!` literally and binds values rather than interpolating SQL. Empty `q` means no search. Booleans accept `0`/`1`; `0` disables the optional filter. Missing filter IDs yield an empty page. The store-specific listing route always uses its URL store, so a caller-supplied `shop_id` cannot redirect it to another store. Unknown query keys are ignored and not echoed in pagination links.

Always restrict `currency` or `shop_id` when comparing prices: amounts from different currencies are not converted. Catalog prices/quantity are informational; checkout still validates actual price, availability and membership and reserves inventory through the existing services. Reading a product never creates an order or reserves stock.

## Rate limits and errors

All catalog routes, including the OpenAPI file and legacy paths, share a per-client-IP budget. The default is 60 requests per minute. `CATALOG_API_RATE_LIMIT` can tune it; effective values are bounded to 1–1000. Use a shared production cache store for coordinated limits across workers, configure trusted proxies so the observed client IP is correct, and tune for customers behind shared networks. Do not bypass the limit by alternating legacy and v1 URLs.

Rate-limited requests return 429 with Retry-After. API errors are JSON even when Accept is absent; expected errors include 404 (hidden/missing record), 422 (query validation), 429 (rate limit), and 405 (unsupported method). `/api/user` remains authenticated and returns JSON 401 to guests; token/login features are not added in this package. Keep APP_DEBUG=false in production so exception responses do not contain debug traces.

Successful catalog responses use no-store and nosniff headers. No shared response cache is introduced; previously cached responses must be purged separately if an external cache was configured before the fix.

## Legacy migration

`/api/shops`, `/api/shops/{slug}`, `/api/listings` and `/api/listings/{slug}` remain available with the same safe controllers, rate budget and pagination. Legacy responses add `X-API-Deprecated: true`; successful catalog responses expose `X-API-Version: 1`. No removal date is imposed.

Important compatibility changes: lists are paginated rather than complete dumps; shop detail contains at most ten sanitized product previews rather than all raw listings; related model fields are narrowed; incomplete/hidden stores and their products are excluded. Existing consumers must follow pagination links and use `listings_url` for full store results. Repository inspection found no frontend consumer of the old catalog URLs, but separately deployed clients must be checked by the operator.

The existing website routes, authenticated customer/merchant operations and Stripe/Raslo webhook URLs remain in place. No route from the delivery integration is renamed. There is no new database migration, dependency or credential requirement.

## Apply and verify

Apply on a clean branch containing the baseline or its merge, then:

```sh
./vendor/bin/sail artisan optimize:clear
./vendor/bin/sail artisan test
./vendor/bin/sail artisan view:cache
./vendor/bin/sail artisan route:cache
```

Restart the existing long-lived worker/scheduler services after updating shared model code. The installer stages files only; it does not migrate, modify .env, commit, push, merge or deploy.

Tests cover hidden products/stores across direct, nested and legacy paths; bounded previews; explicit fields/contact privacy; pagination/search/numeric price and location filters; input errors; shared rate limits; query count; safe media URLs; and future publication dates. The OpenAPI document is structurally validated and representative 200/404/422 responses are checked against its schemas.

Local verification: 133 PHP tests passed, 6 feature-dependent tests skipped, 711 assertions; Blade and route compilation passed. The OpenAPI 3.0.3 structure and representative 200/404/422 response schemas were validated separately. Verification uses PHP 8.3 and SQLite with fake product/store data. It does not establish MySQL behavior, real device UI or production performance. Run the existing MySQL CI before merging and verify the public HTTPS deployment separately.

## Next work

Add versioned authentication with device token expiry/revocation and existing 2FA rules, then customer order/delivery reads and merchant mutations with completed ownership policies. Reuse the established checkout/Raslo services instead of introducing alternative payment or delivery logic. A signed, incremental product export feed for Raslo can follow; this read API is not a deletion-tombstone synchronization protocol.
