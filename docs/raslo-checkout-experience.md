# Store shipping and checkout experience

This update follows the delivery bridge on `fix/raslo-checkout-readiness`. It adds no migration and does not change live keys, fees, subscriptions or existing shipments.

## Merchant setup

1. Workspace → Quick Actions → **Raslo delivery integration**. Verify the dedicated delivery connection and enable forwarding. The source Raslo account still needs paid Enterprise access and a pickup address.
2. Create or edit a physical product. Under **Delivery & Shipping → Shipping Method**, choose **Raslo · UAE delivery**. This requires an active AED shop and an enabled, verified connection. Validation runs on the server as well as in the form.
3. Existing products keep their shipping method. To forward future orders for one of them, explicitly edit it and choose Raslo. Standard, express, free-shipping and pickup products remain merchant fulfilled.
4. All products from one store in a checkout must either use Raslo or use merchant shipping. Mixed Raslo/non-Raslo baskets must be separated. The server checks this again before reserving stock or creating a payment.
5. Only confirmed paid orders enter the send queue. A frozen fulfillment marker and recipient snapshot prevent later product edits from rerouting an existing order. Existing shipments remain unchanged. Legacy paid orders without this marker retain the existing explicit manual send action; newly merchant-fulfilled orders cannot be manually rerouted.

## Customer experience

Checkout groups the store, recipient and UAE address into separate sections. Required fields, field-level errors, browser autofill, emirate selection and Arabic phone digits are supported. Phone examples use UAE formats. Invalid-price, mixed-shipping or locally disabled Raslo stores are unavailable in the address form; server-side checks remain authoritative.

The displayed product total is what this checkout charges. **No Raslo shipping fee is added to Stripe checkout in this release.** Customers must confirm delivery fees and arrangements with the merchant before payment. Raslo's delivery quote is handled separately by the merchant; this update does not collect it from the customer or driver.

Profile → **My deliveries**, beside **Edit Profile**, lists the customer's linked orders. A tracking page reads owned status from this application's database every 30 seconds while visible. Webhook updates or the server's five-minute Raslo polling populate that database. It preserves the previous status during failures, stops polling on navigation, and does not expose API credentials or recipient data in its refresh response. Payment and fulfillment remain separate.

## Run automation locally with Sail

Keep the existing Stripe listener running. In `.env`, use `QUEUE_CONNECTION=database` or `redis`; retain existing database, APP_KEY and Raslo API settings. Do not regenerate APP_KEY.

After applying and testing:

```sh
./vendor/bin/sail artisan optimize:clear
./vendor/bin/sail artisan raslo:check
```

`raslo:check` only checks local URL/queue configuration. It cannot prove that the services are running or that external credentials are valid. Verify the connection in the merchant screen.

If you currently run `queue:work` or `schedule:work` manually for this application, stop those manual processes before switching to these persistent optional services:

```sh
docker compose -f docker-compose.yml -f docker-compose.raslo.yml up -d raslo-queue raslo-scheduler
docker compose -f docker-compose.yml -f docker-compose.raslo.yml logs --tail=50 raslo-queue raslo-scheduler
```

These use the existing Sail `sail-8.3/app` image, mounted application, network and database, with no new public ports. They restart while Docker is running. Build/start the normal Sail application first if that image is absent. After future code changes restart the two worker services with the same Compose file pair. Never run a second scheduler on a production host already managed by cron/Supervisor.

The scheduler dispatches eligible shipments every minute and queues Raslo polling every five minutes. The queue worker executes these jobs. Network retries reuse the frozen request and idempotency key. Unpaid orders are not sent; missing connection, rejected credentials, invalid recipient details or exhausted retries require review. Automatic forwarding does not bypass Raslo pricing approval or assign a driver without the existing Raslo workflow.

## Acceptance test

- Enable/verify the connection. Edit a test product to Raslo shipping.
- Use a new AED physical order with a complete UAE address and Stripe **test mode**. Confirm the Stripe event receives 200; do not manually press Send.
- With workers and scheduler running, check the integration page after the next minute. One shipment should appear in Raslo.
- Price/approve and complete the delivery using the existing Raslo workflow. Within the next five-minute poll, My deliveries should show the new status. The open detail page refreshes from local saved status automatically.
- Repeat the Stripe event or retry a lost delivery response: verify one shipment/reference remains.
- Disable the connection and verify a new Raslo checkout is blocked before payment. Standard/pickup orders must never create Raslo shipments.
- Check Arabic/English and narrow/mobile layouts on your devices before release.

## Validation and boundaries

Automated tests use SQLite, fake Stripe/Raslo HTTP responses and queued job execution. They cover paid-event forwarding through completion, deduplication, frozen fulfillment, mixed shipping, disabled connection, merchant pickup exclusion, ownership, local status privacy, translated address rendering and empty-subscription dashboard rendering. Frontend tests cover status refresh, safe links, background/navigation cleanup and failure recovery. CI now includes `fix/**` pushes and frontend tests.

No Docker daemon, real MySQL/HPOS, production Stripe charge or real device/browser acceptance run was available here. This is a focused checkout/shipping repair, not a certification that every unrelated marketplace module is production ready. Digital/POD payments and private storage for paid digital files remain separate release work documented in the readiness notes. HTTPS tunnels must remain running for local external integrations.
