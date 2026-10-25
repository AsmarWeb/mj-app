<?php

namespace Tests\Feature;

use App\Jobs\PollRasloShipment;
use App\Jobs\SendRasloShipment;
use App\Livewire\AddToCart;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Listing;
use App\Models\Order;
use App\Models\RasloConnection;
use App\Models\RasloShipment;
use App\Models\Shop;
use App\Models\User;
use App\Services\Checkout\AedAmount;
use App\Services\Checkout\PhysicalCheckoutService;
use App\Services\Checkout\StripeCheckoutGateway;
use App\Services\Raslo\RasloEndpoint;
use App\Services\Raslo\RasloWorker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Livewire;
use Mockery;
use Tests\TestCase;

class PhysicalCheckoutTest extends TestCase
{
    use RefreshDatabase;

    private User $buyer;

    private StripeCheckoutGateway $gateway;

    private array $sessions = [];

    private int $creates = 0;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        $this->buyer = User::factory()->create();
        $this->gateway = Mockery::mock(StripeCheckoutGateway::class);
        $this->gateway->shouldReceive('accountReady')->andReturn(true)->byDefault();
        $this->gateway->shouldReceive('create')->andReturnUsing(function ($payload, $key) {
            $this->creates++;

            return $this->sessions[$key] ??= [
                'id' => 'cs_test_'.$payload['metadata']['order_id'], 'mode' => 'payment', 'status' => 'open', 'payment_status' => 'unpaid',
                'metadata' => $payload['metadata'], 'client_reference_id' => $payload['client_reference_id'],
                'currency' => 'aed', 'amount_total' => array_sum(array_map(fn ($item) => $item['price_data']['unit_amount'] * $item['quantity'], $payload['line_items'])),
                'url' => 'https://checkout.stripe.com/c/pay/test', 'payment_intent' => null,
            ];
        })->byDefault();
        $this->gateway->shouldReceive('retrieve')->andReturnUsing(function ($id) {
            foreach ($this->sessions as $session) {
                if ($session['id'] === $id) {
                    return $session;
                }
            }
            throw new \RuntimeException('Missing fixture');
        })->byDefault();
        $this->app->instance(StripeCheckoutGateway::class, $this->gateway);
        \App\Models\Plan::firstOrCreate(['slug' => 'free'], ['name' => 'Free', 'price' => 0, 'is_free' => true,
            'is_active' => true, 'listing_limit' => 5, 'listing_duration' => 30, 'order_limit' => 5, 'storage_limit' => 100]);
        \Illuminate\Support\Facades\Event::listen('eloquent.created: '.Shop::class, function ($shop) {
            $shop->subscriptions()->create(['user_id' => $shop->user_id, 'plan_id' => \App\Models\Plan::where('slug', 'free')->value('id'),
                'type' => 'default', 'stripe_id' => 'free_'.$shop->id, 'stripe_status' => 'active', 'status' => 'active', 'payment_provider' => 'free']);
        });
    }

    private function listing(array $overrides = []): Listing
    {
        $owner = User::factory()->create();
        $shop = Shop::create(['name' => 'Test store', 'name_ar' => 'متجر تجريبي', 'user_id' => $owner->id, 'currency' => 'AED', 'is_active' => true, 'stripe_account_id' => 'acct_test_'.$owner->id]);

        return Listing::forceCreate($overrides + ['shop_id' => $shop->id, 'title' => 'Test product', 'title_ar' => 'منتج', 'slug' => 'product-'.$shop->id,
            'price' => '12.35', 'quantity' => 10, 'image' => 'image.jpg', 'price_condition' => 'fixed', 'condition' => 'new', 'status' => 'published', 'active' => true]);
    }

    private function cart(Listing $listing, int $quantity = 2)
    {
        return Cart::firstOrCreate(['user_id' => $this->buyer->id])->items()->create([
            'shop_id' => $listing->shop_id, 'listing_id' => $listing->id, 'quantity' => $quantity, 'price' => '0.01',
        ]);
    }

    private function address(): array
    {
        return ['recipient_name' => 'Test Recipient', 'recipient_phone' => '+971501234567', 'emirate' => 'dubai', 'city' => 'Dubai', 'area' => 'Al Barsha',
            'address_line' => 'Test street 1', 'building' => 'Test building', 'country' => 'AE'];
    }

    private function start(Listing $listing): Order
    {
        return app(PhysicalCheckoutService::class)->start($this->buyer, $listing->shop_id, $this->address())['order'];
    }

    private function paid(Order $order): array
    {
        $key = 'mj-physical-'.$order->checkout_token;

        return $this->sessions[$key] = array_replace($this->sessions[$key], ['status' => 'complete', 'payment_status' => 'paid', 'payment_intent' => 'pi_'.$order->id]);
    }

    public function test_address_page_is_read_only_and_requires_explicit_store_selection(): void
    {
        $listing = $this->listing();
        $this->cart($listing);
        $this->actingAs($this->buyer)->get('/checkout')->assertOk()->assertSee('recipient_phone')->assertSee('shop_id');
        $this->assertDatabaseCount('orders', 0);
        $this->assertSame(0, $this->creates);
    }

    public function test_checkout_requires_a_real_uae_recipient_address(): void
    {
        $listing = $this->listing();
        $this->cart($listing);
        $this->actingAs($this->buyer)->postJson('/checkout', ['shop_id' => $listing->shop_id])
            ->assertUnprocessable()->assertJsonValidationErrors(['recipient_name', 'recipient_phone', 'emirate', 'address_line', 'building']);
        $this->assertDatabaseCount('orders', 0);
    }

    public function test_checkout_uses_live_prices_and_persists_encrypted_address_and_exact_fils(): void
    {
        $listing = $this->listing();
        $this->cart($listing);
        $data = $this->address();
        unset($data['country']);
        $data['recipient_phone'] = '٠٥٠ ١٢٣ ٤٥٦٧';
        $this->actingAs($this->buyer)->post('/checkout', ['shop_id' => $listing->shop_id] + $data)->assertRedirect('https://checkout.stripe.com/c/pay/test');
        $order = Order::firstOrFail();
        $this->assertSame('24.70', $order->total);
        $this->assertSame('+971501234567', $order->shipping_address['recipient_phone']);
        $this->assertSame('dubai', $order->shipping_address['emirate']);
        $this->assertStringNotContainsString('Test Recipient', DB::table('orders')->value('shipping_address'));
        $this->assertSame(8, $listing->fresh()->quantity);
        $this->assertSame(1235, $order->checkout_payload['line_items'][0]['price_data']['unit_amount']);
    }

    public function test_repeat_checkout_reuses_order_session_and_stock_reservation(): void
    {
        $listing = $this->listing(['quantity' => 2]);
        $this->cart($listing);
        $first = $this->start($listing);
        $second = $this->start($listing);
        $this->assertSame($first->id, $second->id);
        $this->assertDatabaseCount('orders', 1);
        $this->assertSame(0, $listing->fresh()->quantity);
        $this->assertSame(1, $this->creates);
    }

    public function test_stock_is_reserved_across_buyers_and_incomplete_orders_roll_back(): void
    {
        $listing = $this->listing(['quantity' => 2]);
        $this->cart($listing);
        $this->start($listing);
        $this->buyer = User::factory()->create();
        $this->cart($listing);
        try {
            $this->start($listing);
            $this->fail('Sold-out stock accepted');
        } catch (ValidationException $error) {
            $this->assertArrayHasKey('cart', $error->errors());
        }
        $this->assertDatabaseCount('orders', 1);
        $this->assertSame(0, $listing->fresh()->quantity);
    }

    public function test_verified_payment_removes_only_purchased_units_and_never_other_stores(): void
    {
        $first = $this->listing();
        $second = $this->listing();
        $cartRow = $this->cart($first);
        $other = $this->cart($second);
        $order = $this->start($first);
        $cartRow->increment('quantity');
        $session = $this->paid($order);
        app(PhysicalCheckoutService::class)->synchronize($session);
        app(PhysicalCheckoutService::class)->synchronize($session);
        $this->assertSame('paid', $order->fresh()->payment_status);
        $this->assertSame(1, $cartRow->fresh()->quantity);
        $this->assertNotNull($other->fresh());
        $this->assertSame(8, $first->fresh()->quantity);
        $this->assertDatabaseCount('invoices', 1);
        $this->assertDatabaseCount('invoice_items', 1);
    }

    public function test_unpaid_and_mismatched_sessions_never_fulfil_orders(): void
    {
        $listing = $this->listing();
        $this->cart($listing);
        $order = $this->start($listing);
        $session = $this->sessions['mj-physical-'.$order->checkout_token];
        app(PhysicalCheckoutService::class)->synchronize(array_replace($session, ['status' => 'complete']));
        $this->assertSame('pending', $order->fresh()->payment_status);
        foreach ([['amount_total' => 1], ['currency' => 'usd'], ['client_reference_id' => 'different'], ['id' => 'cs_different']] as $bad) {
            try {
                app(PhysicalCheckoutService::class)->synchronize(array_replace($this->paid($order), $bad));
                $this->fail('Mismatch accepted');
            } catch (\RuntimeException $error) {
                $this->assertStringContainsString('mismatch', $error->getMessage());
            }
        }
        $this->assertDatabaseCount('invoices', 0);
        $this->assertSame('pending', $order->fresh()->payment_status);
    }

    public function test_return_page_cannot_be_used_by_another_customer(): void
    {
        $listing = $this->listing();
        $this->cart($listing);
        $order = $this->start($listing);
        $this->actingAs(User::factory()->create())->get('/checkout/success/'.$order->id.'?session_id='.$order->stripe_checkout_session_id)->assertForbidden();
        $this->assertSame('pending', $order->fresh()->payment_status);
    }

    public function test_signed_webhook_fulfils_without_return_page_and_duplicates_do_not_regress(): void
    {
        $listing = $this->listing();
        $this->cart($listing);
        $order = $this->start($listing);
        $session = $this->paid($order);
        $this->webhook('checkout.session.completed', $session)->assertOk();
        $this->webhook('checkout.session.completed', $session)->assertOk();
        $this->webhook('checkout.session.expired', array_replace($session, ['status' => 'expired', 'payment_status' => 'unpaid']))->assertOk();
        $this->assertSame('processing', $order->fresh()->status);
        $this->assertSame(8, $listing->fresh()->quantity);
        $this->assertDatabaseCount('invoices', 1);
    }

    public function test_expired_checkout_returns_stock_exactly_once(): void
    {
        $listing = $this->listing();
        $this->cart($listing);
        $order = $this->start($listing);
        $session = array_replace($this->sessions['mj-physical-'.$order->checkout_token], ['status' => 'expired']);
        $this->webhook('checkout.session.expired', $session)->assertOk();
        $this->webhook('checkout.session.expired', $session)->assertOk();
        $this->assertSame(10, $listing->fresh()->quantity);
        $this->assertSame('cancelled', $order->fresh()->status);
        $this->assertDatabaseCount('cart_items', 1);
    }

    public function test_unsigned_webhooks_and_missing_signing_configuration_are_rejected(): void
    {
        config(['cashier.webhook.secret' => 'whsec_testing']);
        $this->postJson('/stripe/webhook', ['type' => 'checkout.session.completed', 'data' => ['object' => []]])->assertForbidden();
    }

    public function test_missing_signing_configuration_is_rejected(): void
    {
        config(['cashier.webhook.secret' => null]);
        $this->postJson('/stripe/webhook', ['type' => 'checkout.session.completed', 'data' => ['object' => []]])->assertStatus(503);
    }

    public function test_reconciliation_recovers_missed_expiry_webhook(): void
    {
        $listing = $this->listing();
        $this->cart($listing);
        $order = $this->start($listing);
        $key = 'mj-physical-'.$order->checkout_token;
        $this->sessions[$key]['status'] = 'expired';
        $this->artisan('checkout:reconcile')->assertExitCode(0);
        $this->assertSame(10, $listing->fresh()->quantity);
    }

    public function test_api_and_livewire_reject_negative_or_excessive_cart_quantities(): void
    {
        $listing = $this->listing(['quantity' => 3]);
        $this->actingAs($this->buyer)->postJson('/cart/add/'.$listing->id, ['quantity' => -2])->assertUnprocessable();
        $this->postJson('/cart/add/'.$listing->id, ['quantity' => 4])->assertUnprocessable();
        Livewire::test(AddToCart::class, ['listing' => $listing])->set('quantity', -1)->call('add')->assertHasErrors('quantity');
        $this->assertDatabaseCount('cart_items', 0);
    }

    public function test_checkout_cannot_read_items_from_another_customers_cart(): void
    {
        $listing = $this->listing();
        $this->cart($listing);
        $this->buyer = User::factory()->create();
        $data = $this->address();
        unset($data['country']);
        $this->actingAs($this->buyer)->postJson('/checkout', ['shop_id' => $listing->shop_id] + $data)->assertUnprocessable()->assertJsonValidationErrors('cart');
        $this->assertDatabaseCount('orders', 0);
    }

    public function test_draft_products_cannot_be_added_or_purchased(): void
    {
        $listing = $this->listing(['status' => 'draft']);
        $this->actingAs($this->buyer)->postJson('/cart/add/'.$listing->id, ['quantity' => 1])->assertUnprocessable();
        $this->cart($listing);
        $this->expectException(ValidationException::class);
        $this->start($listing);
    }

    public function test_money_conversion_avoids_floating_point_truncation(): void
    {
        $this->assertSame(1999, AedAmount::fils('19.99'));
        $this->assertSame('19.99', AedAmount::decimal(1999));
        $this->expectException(ValidationException::class);
        AedAmount::fils('19.999');
    }

    public function test_network_retry_keeps_original_payload_and_reservation(): void
    {
        $listing = $this->listing();
        $this->cart($listing);
        $payloads = [];
        $this->gateway->shouldReceive('create')->andReturnUsing(function ($payload, $key) use (&$payloads) {
            $payloads[] = [$payload, $key];
            if (count($payloads) === 1) {
                throw new \RuntimeException('Simulated lost response');
            }

            return ['id' => 'cs_retry', 'mode' => 'payment', 'status' => 'open', 'payment_status' => 'unpaid',
                'currency' => 'aed', 'amount_total' => 2470, 'metadata' => $payload['metadata'],
                'client_reference_id' => $payload['client_reference_id'], 'url' => 'https://checkout.stripe.com/c/pay/retry'];
        });
        try {
            $this->start($listing);
            $this->fail('Expected simulated outage');
        } catch (\RuntimeException $error) {
            $this->assertSame('Simulated lost response', $error->getMessage());
        }
        $order = Order::firstOrFail();
        app(PhysicalCheckoutService::class)->resume($order);
        $this->assertSame($payloads[0], $payloads[1]);
        $this->assertDatabaseCount('orders', 1);
        $this->assertSame(8, $listing->fresh()->quantity);
    }

    public function test_an_open_checkout_must_be_cancelled_before_changing_address(): void
    {
        $listing = $this->listing();
        $this->cart($listing);
        $order = $this->start($listing);
        $address = $this->address();
        $address['building'] = 'Different building';
        try {
            app(PhysicalCheckoutService::class)->start($this->buyer, $listing->shop_id, $address);
            $this->fail('Second open checkout accepted');
        } catch (ValidationException $error) {
            $this->assertArrayHasKey('cart', $error->errors());
        }
        $this->gateway->shouldReceive('expire')->with($order->stripe_checkout_session_id)->once()->andReturn(
            array_replace($this->sessions['mj-physical-'.$order->checkout_token], ['status' => 'expired'])
        );
        $this->actingAs($this->buyer)->post('/checkout/'.$order->id.'/cancel')->assertRedirect('/checkout');
        $this->assertSame(10, $listing->fresh()->quantity);
        $this->assertSame('expired', $order->fresh()->checkout_state);
    }

    public function test_resume_and_cancel_cannot_target_another_buyers_order(): void
    {
        $listing = $this->listing();
        $this->cart($listing);
        $order = $this->start($listing);
        $this->actingAs(User::factory()->create())->post('/checkout/'.$order->id.'/resume')->assertForbidden();
        $this->post('/checkout/'.$order->id.'/cancel')->assertForbidden();
        $this->assertSame(8, $listing->fresh()->quantity);
    }

    public function test_invoice_failure_rolls_back_payment_and_cart_before_safe_retry(): void
    {
        $listing = $this->listing();
        $this->cart($listing);
        $order = $this->start($listing);
        $session = $this->paid($order);
        $fail = true;
        Event::listen('eloquent.creating: '.Invoice::class, function () use (&$fail) {
            if ($fail) {
                $fail = false;
                throw new \RuntimeException('Simulated invoice failure');
            }
        });
        try {
            app(PhysicalCheckoutService::class)->synchronize($session);
            $this->fail('Expected invoice failure');
        } catch (\RuntimeException $error) {
            $this->assertSame('Simulated invoice failure', $error->getMessage());
        }
        $this->assertSame('pending', $order->fresh()->payment_status);
        $this->assertDatabaseCount('cart_items', 1);
        app(PhysicalCheckoutService::class)->synchronize($session);
        $this->assertSame('paid', $order->fresh()->payment_status);
        $this->assertDatabaseCount('invoices', 1);
    }

    public function test_unknown_session_can_be_recovered_from_signed_provider_state(): void
    {
        $listing = $this->listing();
        $this->cart($listing);
        $order = $this->start($listing);
        $order->update(['stripe_checkout_session_id' => null]);
        $this->paid($order);
        $id = $this->sessions['mj-physical-'.$order->checkout_token]['id'];
        $this->artisan('checkout:reconcile', ['--session' => $id])->assertExitCode(0);
        $this->assertSame('paid', $order->fresh()->payment_status);
        $this->assertSame($id, $order->fresh()->stripe_checkout_session_id);
    }

    public function test_new_migration_rolls_back_and_reapplies_without_removing_legacy_orders(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            $this->markTestSkipped('DDL rollback is checked separately on SQLite; MySQL implicitly commits DDL.');
        }
        $listing = $this->listing();
        $order = Order::create(['order_number' => 'LEGACY-1', 'shop_id' => $listing->shop_id, 'user_id' => $this->buyer->id, 'total' => '10.00']);
        // Exercise these two migrations explicitly; unrelated newer migrations must not change the test target.
        $migrations = [
            require database_path('migrations/2026_10_25_120000_create_raslo_store_bridge.php'),
            require database_path('migrations/2026_10_24_160000_add_checkout_delivery_readiness.php'),
        ];
        foreach ($migrations as $migration) {
            $migration->down();
        }
        $this->assertFalse(Schema::hasColumn('orders', 'checkout_token'));
        $this->assertDatabaseHas('orders', ['id' => $order->id]);
        foreach (array_reverse($migrations) as $migration) {
            $migration->up();
        }
        $this->assertNull($order->fresh()->checkout_token);
    }

    public function test_enabled_raslo_connection_captures_before_payment_and_releases_outbox_only_when_paid(): void
    {
        $listing = $this->listing(['shipping_method' => 'Raslo']);
        $this->cart($listing);
        $connection = RasloConnection::create(['shop_id' => $listing->shop_id, 'public_id' => (string) Str::uuid(),
            'remote_id' => 71, 'enabled' => true, 'api_key' => 'raslo_delivery_'.str_repeat('a', 64), 'verified_at' => now()]);
        $order = $this->start($listing);
        $this->assertDatabaseHas('raslo_shipments', ['order_id' => $order->id, 'state' => 'awaiting_payment']);
        $shipment = RasloShipment::where('order_id', $order->id)->firstOrFail();
        $this->assertSame('dubai', $shipment->payload['recipient']['emirate']);
        app(PhysicalCheckoutService::class)->synchronize($this->paid($order));
        $this->assertSame('pending', $shipment->fresh()->state);
        app(PhysicalCheckoutService::class)->synchronize($this->paid($order));
        $this->assertDatabaseCount('raslo_shipments', 1);
    }

    public function test_invalid_raslo_snapshot_stops_checkout_before_any_payment_is_created(): void
    {
        $listing = $this->listing(['shipping_method' => 'Raslo']);
        $this->cart($listing);
        RasloConnection::create(['shop_id' => $listing->shop_id, 'public_id' => (string) Str::uuid(),
            'remote_id' => 72, 'enabled' => true, 'api_key' => 'raslo_delivery_'.str_repeat('a', 64), 'verified_at' => now()]);
        $address = $this->address();
        $address['address_line'] = 'x';
        try {
            app(PhysicalCheckoutService::class)->start($this->buyer, $listing->shop_id, $address);
            $this->fail('Invalid address accepted');
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('address_line', $e->errors());
        }
        $this->assertSame(0, $this->creates);
        $this->assertDatabaseCount('orders', 0);
        $this->assertDatabaseCount('raslo_shipments', 0);
        $this->assertSame(10, $listing->fresh()->quantity);
    }

    public function test_pickup_and_standard_shipping_are_not_forwarded_even_with_an_enabled_connection(): void
    {
        foreach (['Pickup', 'Standard Shipping', 'Free Shipping', 'Express Shipping'] as $method) {
            $listing = $this->listing(['shipping_method' => $method]);
            $this->cart($listing);
            RasloConnection::create(['shop_id' => $listing->shop_id, 'public_id' => (string) Str::uuid(),
                'remote_id' => $listing->shop_id, 'enabled' => true, 'api_key' => 'raslo_delivery_'.str_repeat('a', 64), 'verified_at' => now()]);
            $order = $this->start($listing);
            $this->assertSame('Merchant', $order->shipping_address['shipping_method']);
            app(PhysicalCheckoutService::class)->synchronize($this->paid($order));
        }
        $this->assertDatabaseCount('raslo_shipments', 0);
    }

    public function test_raslo_checkout_refuses_disabled_connection_before_reserving_stock_or_creating_payment(): void
    {
        $listing = $this->listing(['shipping_method' => 'Raslo']);
        $this->cart($listing);
        $this->actingAs($this->buyer)->postJson('/checkout', ['shop_id' => $listing->shop_id] + $this->address())
            ->assertUnprocessable()->assertJsonValidationErrors('cart');
        $this->assertDatabaseCount('orders', 0);
        $this->assertSame(0, $this->creates);
        $this->assertSame(10, $listing->fresh()->quantity);
    }

    public function test_mixed_raslo_and_pickup_checkout_is_rejected_without_charging(): void
    {
        $listing = $this->listing(['shipping_method' => 'Raslo']);
        $pickup = $this->listing(['shop_id' => $listing->shop_id, 'shipping_method' => 'Pickup']);
        $this->cart($listing);
        $this->cart($pickup);
        $this->actingAs($this->buyer)->postJson('/checkout', ['shop_id' => $listing->shop_id] + $this->address())
            ->assertUnprocessable()->assertJsonValidationErrors('cart');
        $this->assertDatabaseCount('orders', 0);
        $this->assertSame(0, $this->creates);
        $this->assertSame(10, $listing->fresh()->quantity);
    }

    public function test_paid_raslo_order_is_forwarded_and_polled_by_scheduled_jobs_without_manual_retry(): void
    {
        Queue::fake();
        config(['raslo.api_base_url' => 'https://raslo.example/api/integrations/v1']);
        $endpoint = Mockery::mock(RasloEndpoint::class)->makePartial();
        $endpoint->shouldReceive('options')->andReturn([]);
        $this->app->instance(RasloEndpoint::class, $endpoint);
        Http::preventStrayRequests();
        $listing = $this->listing(['shipping_method' => 'Raslo']);
        $this->cart($listing);
        RasloConnection::create(['shop_id' => $listing->shop_id, 'public_id' => (string) Str::uuid(),
            'remote_id' => 71, 'enabled' => true, 'api_key' => 'raslo_delivery_'.str_repeat('a', 64), 'verified_at' => now()]);
        $order = $this->start($listing);
        // A later listing change must not alter this checkout's frozen fulfillment.
        $listing->update(['shipping_method' => 'Pickup']);
        $session = $this->paid($order);
        $this->webhook('checkout.session.completed', $session)->assertOk();
        $shipment = $order->rasloShipment;
        $payload = ['id' => (string) Str::uuid(), 'external_order_id' => $shipment->external_order_id,
            'sequence' => 1, 'status' => 'priced', 'tracking_number' => 'RS-AUTO', 'delivery_fee' => '25.00', 'requires_price_approval' => true];
        Http::fake(function ($request) use ($payload) {
            return Http::response(['data' => $request->method() === 'POST'
                ? $payload : array_replace($payload, ['sequence' => 2, 'status' => 'completed', 'requires_price_approval' => false])], $request->method() === 'POST' ? 201 : 200);
        });
        $this->artisan('raslo:send-due')->assertExitCode(0);
        Queue::assertPushed(SendRasloShipment::class, function ($job) {
            $job->handle(app(RasloWorker::class));

            return true;
        });
        $this->assertSame('sent', $shipment->fresh()->state);
        $this->webhook('checkout.session.completed', $session)->assertOk();
        $this->assertDatabaseCount('raslo_shipments', 1);
        $this->travel(6)->minutes();
        $this->artisan('raslo:poll')->assertExitCode(0);
        Queue::assertPushed(PollRasloShipment::class, function ($job) {
            $job->handle(app(RasloWorker::class));

            return true;
        });
        $this->assertSame('completed', $shipment->fresh()->delivery_status);
        $this->assertSame('25.00', $shipment->fresh()->delivery_fee);
        $this->assertSame('paid', $order->fresh()->payment_status);
        $this->assertSame('processing', $order->fresh()->status);
        Http::assertSentCount(2);
    }

    public function test_address_validation_is_the_same_in_both_locales_and_preserves_input(): void
    {
        $listing = $this->listing();
        $this->cart($listing);
        foreach (['ar', 'en'] as $locale) {
            app()->setLocale($locale);
            $this->actingAs($this->buyer)->withSession(['locale' => $locale])->get('/checkout')->assertOk()->assertSee('autocomplete="shipping tel"', false)
                ->assertSee('for="address_line"', false)->assertSee($locale === 'ar' ? 'إلى أين نوصّل طلبك؟' : 'Where shall we deliver?');
        }
        $this->postJson('/checkout', ['shop_id' => $listing->shop_id, 'address_line' => 'x'] + $this->address())
            ->assertUnprocessable()->assertJsonValidationErrors('address_line');
        $this->assertDatabaseCount('orders', 0);
    }

    public function test_invalid_price_renders_unavailable_store_instead_of_breaking_address_page(): void
    {
        $listing = $this->listing(['price' => '-1.00']);
        $this->cart($listing);
        $this->actingAs($this->buyer)->get('/checkout')->assertOk()->assertSee('Checkout is unavailable for this store.');
        $this->assertDatabaseCount('orders', 0);
    }

    private function webhook(string $type, array $session)
    {
        config(['cashier.webhook.secret' => 'whsec_testing']);
        $json = json_encode(['id' => 'evt_testing', 'type' => $type, 'data' => ['object' => $session]]);
        $signature = 't='.time().',v1='.hash_hmac('sha256', time().'.'.$json, 'whsec_testing');

        return $this->call('POST', '/stripe/webhook', [], [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_STRIPE_SIGNATURE' => $signature], $json);
    }
    public function test_free_order_quota_counts_reserved_orders_and_expiry_releases_capacity(): void
    {
        $listing = $this->listing(['quantity' => 20]);
        $shop = $listing->shop;
        for ($i = 0; $i < 5; $i++) {
            Order::create(['user_id' => User::factory()->create()->id, 'shop_id' => $shop->id, 'order_number' => 'QUOTA-'.$i,
                'payment_status' => 'pending', 'status' => 'pending', 'inventory_reserved' => true, 'total' => '1.00']);
        }
        $this->cart($listing);
        $this->actingAs($this->buyer)->post(route('checkout.store'), $this->address()+['shop_id' => $shop->id])->assertSessionHasErrors('cart');
        $this->assertSame(0, $this->creates);
        $this->assertSame(20, $listing->fresh()->quantity);
        Order::where('order_number', 'QUOTA-0')->update(['inventory_reserved' => false, 'payment_status' => 'failed', 'status' => 'cancelled']);
        $this->start($listing);
        $this->assertSame(1, $this->creates);
    }

}
