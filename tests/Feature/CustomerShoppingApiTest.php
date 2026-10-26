<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Listing;
use App\Models\Order;
use App\Models\RasloConnection;
use App\Models\RasloShipment;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Tests\TestCase;

class CustomerShoppingApiTest extends TestCase
{
    use RefreshDatabase;

    private User $buyer;

    private string $token;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
        Http::preventStrayRequests();
        Queue::fake();
        $this->buyer = User::factory()->create();
        $this->token = $this->buyer->createToken('mobile:Buyer', ['mobile:account'], now()->addDay())->plainTextToken;
    }

    private function api(string $method, string $path, array $data = [], ?string $token = null, array $headers = [])
    {
        Auth::forgetGuards();
        Auth::shouldUse('web');

        return $this->json($method, '/api/v1'.$path, $data, $headers + ['Authorization' => 'Bearer '.($token ?? $this->token)]);
    }

    private function shop(array $values = []): Shop
    {
        return Shop::create($values + ['name' => 'Shop '.Str::random(8), 'name_ar' => 'متجر',
            'user_id' => User::factory()->create()->id, 'is_active' => true, 'is_completed' => true,
            'currency' => 'AED', 'published_at' => now()->subDay(), 'stripe_account_id' => 'acct_PRIVATE']);
    }

    private function listing(?Shop $shop = null, array $values = []): Listing
    {
        $shop ??= $this->shop();

        return Listing::forceCreate($values + ['shop_id' => $shop->id, 'title' => 'Product '.Str::random(8),
            'title_ar' => 'منتج', 'slug' => 'product-'.Str::random(12), 'price' => '12.35', 'quantity' => 10,
            'image' => 'test.jpg', 'price_condition' => 'fixed', 'condition' => 'new', 'active' => true,
            'status' => 'published', 'published_at' => now()->subDay(), 'expires_at' => now()->addDay()]);
    }

    private function cartItem(User $buyer, Listing $product, int $quantity = 2)
    {
        return Cart::firstOrCreate(['user_id' => $buyer->id])->items()->create([
            'shop_id' => $product->shop_id, 'listing_id' => $product->id, 'quantity' => $quantity, 'price' => '0.01']);
    }

    private function order(?User $buyer = null, ?Shop $shop = null, array $values = []): Order
    {
        $buyer ??= $this->buyer;
        $shop ??= $this->shop();
        $order = Order::create($values + ['user_id' => $buyer->id, 'shop_id' => $shop->id,
            'order_number' => 'MW-'.Str::random(10), 'total' => '24.70', 'subtotal' => '24.70',
            'checkout_currency' => 'AED', 'payment_status' => 'paid', 'status' => 'processing',
            'checkout_token' => 'PRIVATE_CHECKOUT_TOKEN_'.Str::random(10), 'checkout_key' => Str::random(64),
            'stripe_checkout_session_id' => 'cs_PRIVATE_'.Str::random(10), 'stripe_payment_intent_id' => 'pi_PRIVATE_'.Str::random(10),
            'checkout_payload' => ['provider_secret' => 'PRIVATE_PAYLOAD'], 'notes' => 'PRIVATE_ADMIN_NOTE',
            'shipping_address' => ['recipient_name' => 'Test Recipient', 'recipient_phone' => '+971501234567',
                'address_line' => 'Test street', 'provider_secret' => 'PRIVATE_ADDRESS_EXTRA']]);
        $order->items()->create(['listing_name' => 'Purchased title', 'quantity' => 2, 'price' => '12.35', 'total' => '24.70']);

        return $order;
    }

    public function test_all_customer_routes_require_real_mobile_bearer_tokens(): void
    {
        foreach ([['GET', '/cart'], ['POST', '/cart/items'], ['PATCH', '/cart/items/1'],
            ['DELETE', '/cart/items/1'], ['DELETE', '/cart'], ['GET', '/orders'],
            ['GET', '/orders/1'], ['GET', '/orders/1/delivery']] as [$method, $path]) {
            $this->api($method, $path, token: 'invalid')->assertUnauthorized();
        }
        $wrong = $this->buyer->createToken('read', ['read'])->plainTextToken;
        $this->api('GET', '/cart', token: $wrong)->assertForbidden();
        $expired = $this->buyer->createToken('mobile:Old', ['mobile:account'], now()->subMinute())->plainTextToken;
        $this->api('GET', '/orders', token: $expired)->assertUnauthorized();
    }

    public function test_empty_cart_read_and_clear_do_not_create_a_cart(): void
    {
        $this->api('GET', '/cart')->assertOk()->assertJsonCount(0, 'data.items')->assertJsonPath('data.subtotal', '0.00')
            ->assertHeader('Cache-Control', 'no-store, private');
        $this->api('DELETE', '/cart')->assertNoContent();
        $this->assertDatabaseCount('carts', 0);
    }

    public function test_cart_uses_server_prices_and_does_not_accept_ownership_or_price_overrides(): void
    {
        $product = $this->listing();
        $this->api('POST', '/cart/items', ['listing_id' => $product->id, 'quantity' => 2,
            'price' => '0.01', 'shop_id' => 999999, 'user_id' => 999999])->assertCreated()
            ->assertJsonPath('data.subtotal', '24.70')->assertJsonPath('data.items.0.unit_price', '12.35')
            ->assertJsonPath('data.items.0.product.shop.id', $product->shop_id)->assertDontSee('acct_PRIVATE');
        $this->assertSame(10, $product->fresh()->quantity);
        $this->assertSame($this->buyer->id, Cart::firstOrFail()->user_id);
        $product->update(['price' => '13.10']);
        $this->api('GET', '/cart')->assertJsonPath('data.subtotal', '26.20')->assertJsonPath('data.items.0.unit_price', '13.10');
    }

    public function test_post_adds_quantity_but_patch_sets_an_absolute_quantity(): void
    {
        $product = $this->listing();
        $this->api('POST', '/cart/items', ['listing_id' => $product->id, 'quantity' => 1])->assertCreated();
        $id = $this->api('POST', '/cart/items', ['listing_id' => $product->id, 'quantity' => 2])->assertCreated()
            ->assertJsonPath('data.items.0.quantity', 3)->json('data.items.0.id');
        for ($i = 0; $i < 2; $i++) {
            $this->api('PATCH', '/cart/items/'.$id, ['quantity' => 2])->assertOk()->assertJsonPath('data.items.0.quantity', 2);
        }
        $this->assertDatabaseCount('cart_items', 1);
    }

    public function test_quantity_validation_and_insufficient_stock_leave_cart_unchanged(): void
    {
        $product = $this->listing();
        foreach ([0, -1, 100, 1.5, 'bad'] as $quantity) {
            $this->api('POST', '/cart/items', ['listing_id' => $product->id, 'quantity' => $quantity])->assertUnprocessable();
        }
        $item = $this->cartItem($this->buyer, $product);
        $this->api('PATCH', '/cart/items/'.$item->id, ['quantity' => 11])->assertUnprocessable();
        $this->assertSame(2, $item->fresh()->quantity);
        $this->assertSame(10, $product->fresh()->quantity);
    }

    public function test_hidden_products_and_stores_cannot_be_added_or_exposed_via_cart(): void
    {
        foreach ([['status' => 'draft'], ['published_at' => null], ['published_at' => now()->addDay()],
            ['expires_at' => now()], ['active' => false]] as $values) {
            $product = $this->listing(values: $values);
            $this->api('POST', '/cart/items', ['listing_id' => $product->id, 'quantity' => 1])->assertNotFound();
        }
        $product = $this->listing($this->shop(['is_completed' => false]));
        $item = $this->cartItem($this->buyer, $product);
        $this->api('POST', '/cart/items', ['listing_id' => $product->id, 'quantity' => 1])->assertNotFound();
        $this->api('GET', '/cart')->assertOk()->assertJsonPath('data.items.0.product', null)
            ->assertJsonPath('data.items.0.available', false)->assertJsonPath('data.subtotal', null)->assertDontSee($product->title);
        $this->api('DELETE', '/cart/items/'.$item->id)->assertNoContent();
    }

    public function test_cart_row_ownership_is_enforced_on_update_delete_and_read(): void
    {
        $other = User::factory()->create();
        $item = $this->cartItem($other, $this->listing());
        $this->api('PATCH', '/cart/items/'.$item->id, ['quantity' => 3])->assertNotFound();
        $this->api('DELETE', '/cart/items/'.$item->id)->assertNotFound();
        $this->api('GET', '/cart')->assertJsonCount(0, 'data.items');
        $this->assertSame(2, $item->fresh()->quantity);
    }

    public function test_unavailable_stock_and_non_aed_products_do_not_produce_a_payable_subtotal(): void
    {
        $product = $this->listing(values: ['quantity' => 1]);
        $this->cartItem($this->buyer, $product);
        $this->api('GET', '/cart')->assertJsonPath('data.has_unavailable_items', true)->assertJsonPath('data.subtotal', null);
        $this->api('DELETE', '/cart')->assertNoContent();
        $usd = $this->listing($this->shop(['currency' => 'USD']));
        $this->api('POST', '/cart/items', ['listing_id' => $usd->id, 'quantity' => 1])->assertUnprocessable();
        $free = $this->listing(values: ['price' => '0.00']);
        $this->api('POST', '/cart/items', ['listing_id' => $free->id, 'quantity' => 1])->assertUnprocessable();
    }

    public function test_clearing_cart_does_not_cancel_or_release_a_pending_order(): void
    {
        $product = $this->listing();
        $this->cartItem($this->buyer, $product);
        $order = $this->order(values: ['payment_status' => 'pending', 'status' => 'pending', 'inventory_reserved' => true]);
        $this->api('DELETE', '/cart')->assertNoContent();
        $this->assertDatabaseCount('cart_items', 0);
        $this->assertTrue($order->fresh()->inventory_reserved);
        $this->assertSame('pending', $order->fresh()->status);
        $this->assertSame(10, $product->fresh()->quantity);
    }

    public function test_order_list_is_owned_paginated_filtered_and_does_not_echo_unknown_inputs(): void
    {
        $first = $this->order();
        $second = $this->order();
        $third = $this->order(values: ['status' => 'cancelled', 'payment_status' => 'failed']);
        $other = $this->order(User::factory()->create());
        $this->api('GET', '/orders?per_page=2&secret=PRIVATE_QUERY&user_id='.$other->user_id)->assertOk()
            ->assertJsonCount(2, 'data')->assertJsonPath('meta.total', 3)->assertJsonPath('data.0.id', $third->id)
            ->assertDontSee($other->order_number)->assertDontSee('PRIVATE_QUERY')->assertJsonMissingPath('data.0.shipping_address');
        $this->api('GET', '/orders?status=processing&payment_status=paid')->assertJsonCount(2, 'data');
        $this->api('GET', '/orders?per_page=51')->assertUnprocessable();
        $this->api('GET', '/orders?status=invalid')->assertUnprocessable();
    }

    public function test_order_detail_has_purchased_snapshot_and_safe_owner_address_only(): void
    {
        $order = $this->order();
        $response = $this->api('GET', '/orders/'.$order->id)->assertOk()->assertJsonPath('data.items.0.title', 'Purchased title')
            ->assertJsonPath('data.shipping_address.recipient_name', 'Test Recipient')->assertJsonPath('data.currency', 'AED');
        foreach (['PRIVATE_CHECKOUT_TOKEN', 'PRIVATE_PAYLOAD', 'PRIVATE_ADMIN_NOTE', 'PRIVATE_ADDRESS_EXTRA', 'cs_PRIVATE', 'pi_PRIVATE', 'acct_PRIVATE'] as $secret) {
            $response->assertDontSee($secret);
        }
    }

    public function test_other_customers_and_store_owner_cannot_read_customer_order_or_delivery(): void
    {
        $shop = $this->shop();
        $order = $this->order(shop: $shop);
        foreach ([User::factory()->create(), $shop->user] as $other) {
            $token = $other->createToken('mobile:Other', ['mobile:account'], now()->addDay())->plainTextToken;
            $this->api('GET', '/orders/'.$order->id, token: $token)->assertNotFound();
            $this->api('GET', '/orders/'.$order->id.'/delivery', token: $token)->assertNotFound();
        }
    }

    public function test_orders_without_raslo_return_null_delivery_and_unknown_legacy_currency_stays_unknown(): void
    {
        $order = $this->order(values: ['checkout_currency' => null]);
        $this->api('GET', '/orders/'.$order->id.'/delivery')->assertOk()->assertJsonPath('data', null);
        $this->api('GET', '/orders/'.$order->id)->assertJsonPath('data.currency', null)->assertJsonPath('data.delivery', null);
    }

    private function shipment(Order $order): RasloShipment
    {
        $connection = RasloConnection::create(['shop_id' => $order->shop_id, 'public_id' => (string) Str::uuid(),
            'remote_id' => random_int(1, 999999), 'enabled' => true, 'api_key' => 'PRIVATE_RASLO_KEY',
            'webhook_secret' => 'PRIVATE_WEBHOOK_SECRET', 'verified_at' => now()]);

        return RasloShipment::create(['order_id' => $order->id, 'raslo_connection_id' => $connection->id,
            'external_order_id' => 'external-'.$order->id, 'idempotency_key' => (string) Str::uuid(),
            'payload' => ['api_key' => 'PRIVATE_SHIPMENT_PAYLOAD'], 'state' => 'sent', 'delivery_status' => 'in_transit',
            'tracking_number' => 'TEST_TRACKING', 'tracking_url' => 'https://track.example.test/order/token',
            'error_code' => 'PRIVATE_INTERNAL_ERROR', 'delivery_fee' => '22.00']);
    }

    public function test_delivery_is_local_sanitized_localized_and_independent_of_order_status(): void
    {
        config(['raslo.tracking_hosts' => ['track.example.test']]);
        $order = $this->order();
        $shipment = $this->shipment($order);
        $this->api('GET', '/orders/'.$order->id.'/delivery', headers: ['Accept-Language' => 'ar-AE'])->assertOk()
            ->assertJsonPath('data.status_label', 'في الطريق')->assertJsonPath('data.tracking_number', 'TEST_TRACKING')
            ->assertJsonPath('data.tracking_url', 'https://track.example.test/order/token')->assertHeader('Referrer-Policy', 'no-referrer');
        $response = $this->api('GET', '/orders/'.$order->id)->assertOk()->assertJsonPath('data.delivery.status_label', 'In transit');
        foreach (['PRIVATE_RASLO_KEY', 'PRIVATE_WEBHOOK_SECRET', 'PRIVATE_SHIPMENT_PAYLOAD', 'PRIVATE_INTERNAL_ERROR', '22.00'] as $secret) {
            $response->assertDontSee($secret);
        }
        $shipment->update(['tracking_url' => 'https://untrusted.example.test/token', 'delivery_status' => 'delivered']);
        $this->api('GET', '/orders/'.$order->id.'/delivery')->assertJsonPath('data.tracking_url', null)->assertJsonPath('data.status', 'delivered');
        $this->assertSame('processing', $order->fresh()->status);
        Http::assertNothingSent();
        Queue::assertNothingPushed();
    }

    public function test_mobile_line_limit_is_enforced_without_mutating_an_oversized_cart(): void
    {
        $product = $this->listing();
        $cart = Cart::create(['user_id' => $this->buyer->id]);
        $values = ['cart_id' => $cart->id, 'shop_id' => $product->shop_id, 'listing_id' => $product->id,
            'price' => '12.35', 'quantity' => 1];
        DB::table('cart_items')->insert(array_fill(0, 100, $values));
        $new = $this->listing();
        $this->api('POST', '/cart/items', ['listing_id' => $new->id, 'quantity' => 1])->assertUnprocessable();
        $this->assertSame(100, $cart->items()->count());
        $extra = $cart->items()->create($values);
        $this->api('GET', '/cart')->assertUnprocessable();
        $this->api('PATCH', '/cart/items/'.$extra->id, ['quantity' => 2])->assertUnprocessable();
        $this->assertSame(1, $extra->fresh()->quantity);
        $this->api('DELETE', '/cart/items/'.$extra->id)->assertNoContent();
        $this->api('GET', '/cart')->assertOk()->assertJsonPath('data.lines_count', 100);
    }

    public function test_order_currency_is_preserved_and_hidden_store_metadata_is_not_exposed(): void
    {
        $shop = $this->shop(['is_active' => false]);
        $order = $this->order(shop: $shop, values: ['checkout_currency' => 'USD']);
        $this->api('GET', '/orders/'.$order->id)->assertOk()->assertJsonPath('data.currency', 'USD')
            ->assertJsonPath('data.shop', null)->assertJsonPath('data.items.0.title', 'Purchased title')->assertDontSee($shop->name);
    }
}
