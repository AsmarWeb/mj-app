<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Listing;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Shop;
use App\Models\User;
use App\Services\Checkout\PhysicalCheckoutService;
use App\Services\Checkout\StripeCheckoutGateway;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Mockery;
use Stripe\Exception\ApiConnectionException;
use Tests\TestCase;

class MobileCheckoutApiTest extends TestCase
{
    use RefreshDatabase;

    private User $buyer;

    private string $token;

    private array $sessions = [];

    private bool $loseResponse = false;

    private bool $retrieveUnavailable = false;

    private StripeCheckoutGateway $gateway;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
        Queue::fake();
        $this->buyer = User::factory()->create();
        $this->token = $this->buyer->createToken('mobile:Phone', ['mobile:account'], now()->addDay())->plainTextToken;
        $this->gateway = Mockery::mock(StripeCheckoutGateway::class);
        $this->gateway->shouldReceive('accountReady')->andReturn(true)->byDefault();
        $this->gateway->shouldReceive('create')->andReturnUsing(function ($payload, $key) {
            $this->sessions[$key] ??= ['id' => 'cs_mobile_'.$payload['metadata']['order_id'],
                'mode' => 'payment', 'status' => 'open', 'payment_status' => 'unpaid', 'currency' => 'aed',
                'metadata' => $payload['metadata'], 'client_reference_id' => $payload['client_reference_id'],
                'amount_total' => array_sum(array_map(fn ($line) => $line['price_data']['unit_amount'] * $line['quantity'], $payload['line_items'])),
                'url' => 'https://checkout.stripe.com/c/pay/fixture', 'payment_intent' => null];
            if ($this->loseResponse) {
                $this->loseResponse = false;
                throw ApiConnectionException::factory('PRIVATE_PROVIDER_DETAIL');
            }

            return $this->sessions[$key];
        });
        $this->gateway->shouldReceive('retrieve')->andReturnUsing(function ($id) {
            if ($this->retrieveUnavailable) {
                throw ApiConnectionException::factory('PRIVATE_PROVIDER_DETAIL');
            }
            foreach ($this->sessions as $row) {
                if ($row['id'] === $id) {
                    return $row;
                }
            }
            throw new \RuntimeException('Missing fixture');
        });
        $this->gateway->shouldReceive('expire')->andReturnUsing(function ($id) {
            foreach ($this->sessions as $key => $row) {
                if ($row['id'] === $id) {
                    return $this->sessions[$key] = array_replace($row, ['status' => 'expired', 'payment_status' => 'unpaid']);
                }
            }
            throw new \RuntimeException('Missing fixture');
        });
        $this->app->instance(StripeCheckoutGateway::class, $this->gateway);
    }

    private function product(array $values = []): Listing
    {
        $shop = Shop::create(['name' => 'Mobile shop', 'name_ar' => 'متجر', 'user_id' => User::factory()->create()->id,
            'currency' => 'AED', 'is_active' => true, 'is_completed' => true, 'published_at' => now()->subDay(),
            'stripe_account_id' => 'acct_fixture']);
        $plan = Plan::firstOrCreate(['slug' => 'free'], ['name' => 'Free', 'price' => 0, 'is_free' => true, 'is_active' => true,
            'listing_limit' => 5, 'listing_duration' => 30, 'order_limit' => 5, 'storage_limit' => 100]);
        $shop->subscriptions()->create(['user_id' => $shop->user_id, 'plan_id' => $plan->id, 'type' => 'default',
            'stripe_id' => 'free_'.$shop->id, 'stripe_status' => 'active', 'status' => 'active', 'payment_provider' => 'free']);

        return Listing::forceCreate($values + ['shop_id' => $shop->id, 'title' => 'Mobile product', 'title_ar' => 'منتج',
            'slug' => 'mobile-product-'.$shop->id, 'price' => '12.35', 'quantity' => 10, 'image' => 'test.jpg',
            'price_condition' => 'fixed', 'condition' => 'new', 'active' => true, 'status' => 'published',
            'published_at' => now()->subDay(), 'expires_at' => now()->addDay()]);
    }

    private function basket(Listing $product): void
    {
        Cart::firstOrCreate(['user_id' => $this->buyer->id])->items()->create([
            'shop_id' => $product->shop_id, 'listing_id' => $product->id, 'quantity' => 2, 'price' => '0.01']);
    }

    private function address(Listing $product): array
    {
        return ['shop_id' => $product->shop_id, 'recipient_name' => 'Test Recipient', 'recipient_phone' => '٠٥٠ ١٢٣ ٤٥٦٧',
            'emirate' => 'dubai', 'city' => 'Dubai', 'area' => 'Test area', 'address_line' => 'Test street', 'building' => 'Test building'];
    }

    private function api(string $path, array $data = [], ?string $key = null, ?string $token = null)
    {
        Auth::forgetGuards();
        Auth::shouldUse('web');
        $headers = ['Authorization' => 'Bearer '.($token ?? $this->token)];
        if ($key !== null) {
            $headers['Idempotency-Key'] = $key;
        }

        return $this->postJson('/api/v1'.$path, $data, $headers);
    }

    private function paid(Order $order): array
    {
        $key = 'mj-physical-'.$order->checkout_token;

        return $this->sessions[$key] = array_replace($this->sessions[$key], ['status' => 'complete', 'payment_status' => 'paid', 'payment_intent' => 'pi_mobile_'.$order->id]);
    }

    public function test_native_checkout_freezes_prices_reserves_stock_and_uses_signed_return_urls(): void
    {
        $product = $this->product();
        $this->basket($product);
        $response = $this->api('/checkout', $this->address($product) + ['total' => '0.01', 'return_url' => 'https://evil.example', 'user_id' => 999], (string) Str::uuid())
            ->assertOk()->assertJsonPath('data.total', '24.70')->assertJsonPath('data.payment_status', 'pending')
            ->assertJsonPath('data.checkout_url', 'https://checkout.stripe.com/c/pay/fixture')->assertDontSee('acct_fixture');
        $order = Order::findOrFail($response->json('data.order_id'));
        $this->assertSame(8, $product->fresh()->quantity);
        $this->assertSame('+971501234567', $order->shipping_address['recipient_phone']);
        $payload = $order->checkout_payload;
        $this->assertSame('mobile_v1', $payload['metadata']['client_channel']);
        $this->assertStringContainsString('/mobile/checkout/return/'.$order->id.'/returned', $payload['success_url']);
        $this->assertStringContainsString('signature=', $payload['success_url']);
        $this->assertStringNotContainsString('evil.example', json_encode($payload));
    }

    public function test_idempotency_retries_reuse_order_session_and_reservation_even_after_paid(): void
    {
        $product = $this->product();
        $this->basket($product);
        $key = (string) Str::uuid();
        $first = $this->api('/checkout', $this->address($product), $key)->assertOk();
        $this->api('/checkout', $this->address($product), $key)->assertOk()->assertJsonPath('data.order_id', $first->json('data.order_id'));
        $order = Order::firstOrFail();
        app(PhysicalCheckoutService::class)->synchronize($this->paid($order));
        $this->api('/checkout', $this->address($product), $key)->assertOk()->assertJsonPath('data.payment_status', 'paid')->assertJsonPath('data.checkout_url', null);
        $this->assertDatabaseCount('orders', 1);
        $this->assertCount(1, $this->sessions);
        $this->assertSame(8, $product->fresh()->quantity);
        $this->assertDatabaseCount('invoices', 1);
    }

    public function test_same_key_with_changed_address_is_rejected_and_new_key_cannot_bypass_pending_checkout(): void
    {
        $product = $this->product();
        $this->basket($product);
        $key = (string) Str::uuid();
        $this->api('/checkout', $this->address($product), $key)->assertOk();
        $data = $this->address($product);
        $data['building'] = 'Changed building';
        $this->api('/checkout', $data, $key)->assertStatus(409);
        $this->api('/checkout', $this->address($product), (string) Str::uuid())->assertUnprocessable();
        $this->assertDatabaseCount('orders', 1);
        $this->assertSame(8, $product->fresh()->quantity);
    }

    public function test_uncertain_create_response_recovers_same_stripe_attempt(): void
    {
        $product = $this->product();
        $this->basket($product);
        $key = (string) Str::uuid();
        $this->loseResponse = true;
        $response = $this->api('/checkout', $this->address($product), $key)->assertStatus(503)->assertDontSee('PRIVATE_PROVIDER_DETAIL');
        $order = Order::firstOrFail();
        $this->assertSame($order->id, $response->json('order_id'));
        $this->api('/checkout/'.$order->id.'/refresh')->assertStatus(409);
        $this->api('/checkout', $this->address($product), $key)->assertOk();
        $this->assertCount(1, $this->sessions);
        $this->assertDatabaseCount('orders', 1);
        $this->assertSame(8, $product->fresh()->quantity);
    }

    public function test_verified_email_and_valid_idempotency_header_are_required(): void
    {
        $product = $this->product();
        $this->basket($product);
        $this->api('/checkout', $this->address($product))->assertUnprocessable()->assertJsonValidationErrors('request_key');
        $this->api('/checkout', $this->address($product), 'invalid')->assertUnprocessable();
        $this->buyer->forceFill(['email_verified_at' => null])->save();
        $this->api('/checkout', $this->address($product), (string) Str::uuid())->assertForbidden();
        $this->assertDatabaseCount('orders', 0);
    }

    public function test_missing_malformed_recipient_or_stock_failure_creates_no_order(): void
    {
        $product = $this->product(['quantity' => 1]);
        $this->basket($product);
        $this->api('/checkout', ['shop_id' => $product->shop_id, 'recipient_phone' => ['invalid']], (string) Str::uuid())
            ->assertUnprocessable()->assertJsonValidationErrors(['recipient_phone', 'recipient_name', 'address_line']);
        $this->api('/checkout', $this->address($product), (string) Str::uuid())->assertUnprocessable();
        $this->assertDatabaseCount('orders', 0);
        $this->assertSame(1, $product->fresh()->quantity);
    }

    public function test_hidden_store_and_unpublished_products_cannot_start_native_checkout(): void
    {
        $product = $this->product(['published_at' => null]);
        $this->basket($product);
        $this->api('/checkout', $this->address($product), (string) Str::uuid())->assertUnprocessable();
        $product->shop->update(['is_active' => false]);
        $this->api('/checkout', $this->address($product), (string) Str::uuid())->assertNotFound();
        $this->assertDatabaseCount('orders', 0);
    }

    public function test_foreign_customer_cannot_refresh_resume_or_cancel(): void
    {
        $product = $this->product();
        $this->basket($product);
        $id = $this->api('/checkout', $this->address($product), (string) Str::uuid())->json('data.order_id');
        $other = User::factory()->create()->createToken('mobile:Other', ['mobile:account'], now()->addDay())->plainTextToken;
        foreach (['refresh', 'resume', 'cancel'] as $action) {
            $this->api('/checkout/'.$id.'/'.$action, token: $other)->assertNotFound();
        }
        $this->assertTrue(Order::findOrFail($id)->inventory_reserved);
    }

    public function test_cancel_releases_inventory_once_only_after_provider_confirms_expiry(): void
    {
        $product = $this->product();
        $this->basket($product);
        $id = $this->api('/checkout', $this->address($product), (string) Str::uuid())->json('data.order_id');
        $this->retrieveUnavailable = true;
        $this->api('/checkout/'.$id.'/cancel')->assertStatus(503);
        $this->assertSame(8, $product->fresh()->quantity);
        $this->retrieveUnavailable = false;
        $this->api('/checkout/'.$id.'/cancel')->assertOk()->assertJsonPath('data.checkout_state', 'expired');
        $this->api('/checkout/'.$id.'/cancel')->assertOk();
        $this->assertSame(10, $product->fresh()->quantity);
    }

    public function test_paid_refresh_and_duplicate_webhook_fulfill_once_and_cannot_be_cancelled(): void
    {
        $product = $this->product();
        $this->basket($product);
        $this->api('/checkout', $this->address($product), (string) Str::uuid())->assertOk();
        $order = Order::firstOrFail();
        $session = $this->paid($order);
        $this->api('/checkout/'.$order->id.'/refresh')->assertOk()->assertJsonPath('data.payment_status', 'paid');
        app(PhysicalCheckoutService::class)->synchronize($session);
        $this->api('/checkout/'.$order->id.'/cancel')->assertOk()->assertJsonPath('data.payment_status', 'paid');
        $this->assertDatabaseCount('invoices', 1);
        $this->assertSame(8, $product->fresh()->quantity);
        $this->assertDatabaseCount('cart_items', 0);
    }

    public function test_refresh_ignores_client_session_ids_and_rejects_provider_identity_mismatch(): void
    {
        $product = $this->product();
        $this->basket($product);
        $this->api('/checkout', $this->address($product), (string) Str::uuid())->assertOk();
        $order = Order::firstOrFail();
        $key = 'mj-physical-'.$order->checkout_token;
        $this->api('/checkout/'.$order->id.'/refresh', ['session_id' => 'cs_attacker', 'payment_status' => 'paid'])
            ->assertOk()->assertJsonPath('data.payment_status', 'pending');
        $this->sessions[$key]['amount_total'] = 1;
        $this->api('/checkout/'.$order->id.'/refresh', ['session_id' => 'cs_attacker', 'payment_status' => 'paid'])->assertStatus(409);
        $this->assertSame('pending', $order->fresh()->payment_status);
        $this->assertDatabaseCount('invoices', 0);
    }

    public function test_signed_bridge_is_a_read_only_hint_with_fixed_destination_and_no_payment_claim(): void
    {
        $product = $this->product();
        $this->basket($product);
        $this->api('/checkout', $this->address($product), (string) Str::uuid())->assertOk();
        $order = Order::firstOrFail();
        $url = $order->checkout_payload['success_url'];
        Auth::forgetGuards();
        Auth::shouldUse('web');
        $this->get($url)->assertOk()->assertSee('murwaj://checkout/result?order_id='.$order->id, false)
            ->assertDontSee('Payment Successful')->assertDontSee($order->checkout_token)
            ->assertHeader('Referrer-Policy', 'no-referrer');
        $this->assertSame('pending', $order->fresh()->payment_status);
        $this->assertSame(8, $product->fresh()->quantity);
        $this->get($url.'&redirect=https://evil.example')->assertForbidden();
        $this->get('/api/mobile/checkout/return/'.$order->id.'/returned')->assertForbidden();
        $expired = URL::temporarySignedRoute('mobile.checkout.return', now()->subMinute(), ['order' => $order->id, 'outcome' => 'closed']);
        $this->get($expired)->assertForbidden();
    }

    public function test_checkout_routes_reject_missing_or_wrong_scope_tokens(): void
    {
        foreach (['/checkout', '/checkout/1/resume', '/checkout/1/cancel', '/checkout/1/refresh'] as $path) {
            $this->api($path, token: 'invalid')->assertUnauthorized();
        }
        $wrong = $this->buyer->createToken('read', ['read'])->plainTextToken;
        $this->api('/checkout/1/refresh', token: $wrong)->assertForbidden();
    }

    public function test_website_checkouts_keep_original_return_flow_and_are_not_mobile_mutation_targets(): void
    {
        $product = $this->product();
        $this->basket($product);
        $address = $this->address($product);
        unset($address['shop_id']);
        $address['recipient_phone'] = '+971501234567';
        $address['country'] = 'AE';
        $order = app(PhysicalCheckoutService::class)->start($this->buyer, $product->shop_id, $address)['order'];
        $this->assertStringContainsString('/checkout/success/', $order->checkout_payload['success_url']);
        $this->api('/checkout/'.$order->id.'/resume')->assertNotFound();
    }

    public function test_paid_provider_state_wins_over_cancel_request(): void
    {
        $product = $this->product();
        $this->basket($product);
        $this->api('/checkout', $this->address($product), (string) Str::uuid())->assertOk();
        $order = Order::firstOrFail();
        $this->paid($order);
        $this->api('/checkout/'.$order->id.'/cancel')->assertOk()->assertJsonPath('data.payment_status', 'paid');
        $this->assertSame(8, $product->fresh()->quantity);
        $this->assertDatabaseCount('invoices', 1);
    }

    public function test_native_purchase_is_fulfilled_by_signed_webhook_without_app_return(): void
    {
        $product = $this->product();
        $this->basket($product);
        $this->api('/checkout', $this->address($product), (string) Str::uuid())->assertOk();
        $order = Order::firstOrFail();
        $session = $this->paid($order);
        config(['cashier.webhook.secret' => 'whsec_mobile_fixture']);
        $json = json_encode(['type' => 'checkout.session.completed', 'data' => ['object' => $session]]);
        $timestamp = time();
        $signature = 't='.$timestamp.',v1='.hash_hmac('sha256', $timestamp.'.'.$json, 'whsec_mobile_fixture');
        for ($i = 0; $i < 2; $i++) {
            $this->call('POST', '/stripe/webhook', [], [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_STRIPE_SIGNATURE' => $signature], $json)->assertOk();
        }
        $this->assertTrue($order->fresh()->isPaid());
        $this->assertDatabaseCount('invoices', 1);
        $this->assertSame(8, $product->fresh()->quantity);
    }

    public function test_checkout_requires_the_buyers_own_cart_items(): void
    {
        $product = $this->product();
        $other = User::factory()->create();
        Cart::create(['user_id' => $other->id])->items()->create(['shop_id' => $product->shop_id,
            'listing_id' => $product->id, 'quantity' => 2, 'price' => '12.35']);
        $this->api('/checkout', $this->address($product), (string) Str::uuid())->assertUnprocessable();
        $this->assertDatabaseCount('orders', 0);
        $this->assertSame(10, $product->fresh()->quantity);
    }

    public function test_old_events_and_mobile_actions_do_not_downgrade_refunded_orders(): void
    {
        $product = $this->product();
        $this->basket($product);
        $this->api('/checkout', $this->address($product), (string) Str::uuid())->assertOk();
        $order = Order::firstOrFail();
        $session = $this->paid($order);
        app(PhysicalCheckoutService::class)->synchronize($session);
        $order->update(['payment_status' => 'refunded']);
        app(PhysicalCheckoutService::class)->synchronize(array_replace($session, ['status' => 'expired', 'payment_status' => 'unpaid']));
        $this->api('/checkout/'.$order->id.'/refresh')->assertOk()->assertJsonPath('data.payment_status', 'refunded');
        $this->api('/checkout/'.$order->id.'/cancel')->assertOk()->assertJsonPath('data.payment_status', 'refunded');
        $this->assertSame(8, $product->fresh()->quantity);
        $this->assertDatabaseCount('invoices', 1);
    }
}
