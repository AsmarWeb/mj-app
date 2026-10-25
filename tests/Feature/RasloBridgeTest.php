<?php

namespace Tests\Feature;

use App\Jobs\PollRasloShipment;
use App\Jobs\SendRasloShipment;
use App\Livewire\Seller\CreateListing;
use App\Models\Listing;
use App\Models\Order;
use App\Models\RasloConnection;
use App\Models\RasloShipment;
use App\Models\Role;
use App\Models\Shop;
use App\Models\User;
use App\Services\Raslo\RasloBridge;
use App\Services\Raslo\RasloEndpoint;
use App\Services\Raslo\RasloWorker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Mockery;
use Tests\TestCase;

class RasloBridgeTest extends TestCase
{
    use RefreshDatabase;

    private User $seller;

    private Shop $shop;

    protected function setUp(): void
    {
        parent::setUp();
        config(['raslo.api_base_url' => 'https://raslo.example/api/integrations/v1']);
        $endpoint = Mockery::mock(RasloEndpoint::class)->makePartial();
        $endpoint->shouldReceive('options')->andReturn([]);
        $this->app->instance(RasloEndpoint::class, $endpoint);
        Http::preventStrayRequests();
        Queue::fake();
        Role::firstOrCreate(['name' => 'seller'], ['display_name' => 'Seller']);
        $this->seller = User::factory()->create(['phone_verified_at' => now()]);
        $this->seller->addRole('seller');
        $this->shop = Shop::create(['name' => 'Pilot store', 'name_ar' => 'متجر', 'user_id' => $this->seller->id, 'is_active' => true, 'currency' => 'AED']);
    }

    private function connection(): RasloConnection
    {
        return RasloConnection::create(['shop_id' => $this->shop->id, 'public_id' => (string) Str::uuid(), 'remote_id' => 71, 'enabled' => true,
            'api_key' => 'raslo_delivery_'.str_repeat('a', 64), 'webhook_secret' => str_repeat('b', 64), 'verified_at' => now()]);
    }

    private function order(): Order
    {
        $order = Order::create(['user_id' => User::factory()->create()->id, 'shop_id' => $this->shop->id, 'order_number' => 'TEST-'.Str::random(8),
            'total' => '24.70', 'payment_status' => 'paid', 'status' => 'processing', 'checkout_token' => (string) Str::uuid(), 'checkout_currency' => 'AED',
            'shipping_address' => ['shipping_method' => 'Raslo', 'country' => 'AE', 'recipient_name' => 'Test Recipient', 'recipient_phone' => '+971501234567', 'city' => 'Dubai',
                'emirate' => 'dubai', 'area' => 'Al Barsha', 'address_line' => 'Test street 1', 'building' => 'Building 2', 'unit' => '12']]);
        $listing = Listing::forceCreate(['shop_id' => $this->shop->id, 'title' => 'Parcel', 'title_ar' => 'طرد', 'price' => '12.35', 'quantity' => 3, 'image' => 'x.png',
            'slug' => 'parcel-'.Str::random(5), 'price_condition' => 'fixed', 'condition' => 'new', 'status' => 'published']);
        $order->items()->create(['listing_id' => $listing->id, 'listing_name' => 'Parcel', 'quantity' => 2, 'price' => '12.35', 'total' => '24.70']);

        return $order;
    }

    private function shipment(): RasloShipment
    {
        $this->connection();
        $order = $this->order();

        return DB::transaction(function () use ($order) {
            $row = app(RasloBridge::class)->capture($order);
            app(RasloBridge::class)->paid($order);

            return $row->fresh();
        });
    }

    private function data(RasloShipment $row, int $sequence = 2, string $status = 'priced'): array
    {
        return ['id' => $row->remote_id ?? '12345678-1234-4234-8234-123456789012', 'external_order_id' => $row->external_order_id,
            'sequence' => $sequence, 'status' => $status, 'tracking_number' => 'RS-123', 'tracking_url' => 'https://raslo.example/track/test',
            'delivery_fee' => '15.00', 'requires_price_approval' => true];
    }

    private function bind(RasloShipment $row): RasloShipment
    {
        $this->fakeHttp(['*' => Http::response(['data' => $this->data($row)], 201)]);
        app(RasloWorker::class)->send($row->id);

        return $row->fresh();
    }

    public function test_settings_verify_enterprise_connection_and_never_echo_or_flash_credentials(): void
    {
        $this->fakeHttp(['*' => Http::response(['data' => ['id' => 71, 'currency' => 'AED', 'pickup_configured' => true]])]);
        $key = 'raslo_delivery_'.str_repeat('a', 64);
        $this->actingAs($this->seller)->post('/seller/raslo', ['enabled' => 1, 'api_key' => $key, 'webhook_secret' => str_repeat('b', 64)])->assertRedirect();
        $row = RasloConnection::firstOrFail();
        $this->assertTrue($row->enabled);
        $this->assertNotSame($key, DB::table('raslo_connections')->value('api_key'));
        $this->get('/seller/raslo')->assertOk()->assertDontSee($key)->assertDontSee(str_repeat('b', 64));
        $this->post('/seller/raslo', ['enabled' => 1, 'api_key' => 'bad-secret'])->assertSessionHasErrors('raslo')->assertSessionMissing('_old_input.api_key');
        $this->assertSame($key, $row->fresh()->api_key);
    }

    public function test_connection_requires_authenticated_store_owner_and_cannot_change_remote_identity(): void
    {
        $row = $this->connection();
        $this->fakeHttp(['*' => Http::response(['data' => ['id' => 99, 'currency' => 'AED', 'pickup_configured' => true]])]);
        $this->actingAs($this->seller)->post('/seller/raslo', ['enabled' => 1])->assertSessionHasErrors('raslo');
        $this->assertSame(71, (int) $row->fresh()->remote_id);
        $this->actingAs(User::factory()->create(['phone_verified_at' => now()]))->get('/seller/raslo')->assertForbidden();
    }

    public function test_one_remote_connection_cannot_be_shared_between_stores(): void
    {
        $this->connection();
        $other = User::factory()->create(['phone_verified_at' => now()]);
        $other->addRole('seller');
        Shop::create(['name' => 'Other', 'name_ar' => 'آخر', 'user_id' => $other->id, 'is_active' => true]);
        $this->fakeHttp(['*' => Http::response(['data' => ['id' => 71, 'currency' => 'AED', 'pickup_configured' => true]])]);
        $this->actingAs($other)->post('/seller/raslo', ['enabled' => 1, 'api_key' => 'raslo_delivery_'.str_repeat('c', 64)])->assertSessionHasErrors('raslo');
        $this->assertDatabaseCount('raslo_connections', 1);
    }

    public function test_no_backfill_occurs_on_enable_and_unpaid_cannot_be_manually_sent(): void
    {
        $order = $this->order();
        $order->update(['shipping_address' => array_diff_key($order->shipping_address, ['shipping_method' => true])]);
        $this->assertNull(app(RasloBridge::class)->capture($order));
        $this->connection();
        app(RasloBridge::class)->paid($order);
        $this->assertDatabaseCount('raslo_shipments', 0);
        $order->update(['payment_status' => 'pending']);
        $this->actingAs($this->seller)->post('/seller/raslo/orders/'.$order->id.'/retry')->assertSessionHasErrors('raslo');
    }

    public function test_confirmed_paid_order_can_be_manually_queued_with_encrypted_snapshot(): void
    {
        $this->connection();
        $order = $this->order();
        $this->actingAs($this->seller)->post('/seller/raslo/orders/'.$order->id.'/retry')->assertRedirect();
        $row = RasloShipment::firstOrFail();
        $this->assertSame('pending', $row->state);
        $this->assertSame('+971501234567', $row->payload['recipient']['contact_phone']);
        $this->assertStringNotContainsString('Test Recipient', DB::table('raslo_shipments')->value('payload'));
        $this->post('/seller/raslo/orders/'.$order->id.'/retry');
        $this->assertDatabaseCount('raslo_shipments', 1);
    }

    public function test_scheduler_recovers_queue_failure_and_stale_claims(): void
    {
        $row = $this->shipment();
        app(RasloWorker::class)->due();
        Queue::assertPushed(SendRasloShipment::class, 1);
        app(RasloWorker::class)->due();
        Queue::assertPushed(SendRasloShipment::class, 1);
        $row->refresh()->update(['queued_at' => now()->subMinutes(3)]);
        app(RasloWorker::class)->due();
        Queue::assertPushed(SendRasloShipment::class, 2);
        $row->refresh()->update(['state' => 'processing', 'processing_at' => now()->subMinutes(3), 'lease' => (string) Str::uuid()]);
        app(RasloWorker::class)->due();
        $this->assertSame('retry', $row->fresh()->state);
    }

    public function test_timeouts_retry_the_identical_payload_reference_and_idempotency_key(): void
    {
        $row = $this->shipment();
        $payload = $row->payload;
        $key = $row->idempotency_key;
        $this->fakeHttp(['*' => Http::failedConnection()]);
        app(RasloWorker::class)->send($row->id);
        $this->assertSame('retry', $row->fresh()->state);
        $row->order->update(['shipping_address' => ['shipping_method' => 'Raslo', 'country' => 'AE', 'recipient_name' => 'Changed after send']]);
        $row->refresh()->update(['next_attempt_at' => now()->subSecond()]);
        $this->fakeHttp(['*' => Http::response(['data' => $this->data($row)], 201)]);
        app(RasloWorker::class)->send($row->id);
        Http::assertSent(fn ($r) => $r->method() === 'POST' && $r->hasHeader('Idempotency-Key', $key) && $r->data() === $payload);
        $this->assertSame('sent', $row->fresh()->state);
    }

    public function test_terminal_rejections_stop_blind_retry_and_manual_retry_preserves_key(): void
    {
        $row = $this->shipment();
        $key = $row->idempotency_key;
        $this->fakeHttp(['*' => Http::response([], 403)]);
        app(RasloWorker::class)->send($row->id);
        $this->assertSame('review', $row->fresh()->state);
        $this->actingAs($this->seller)->post('/seller/raslo/orders/'.$row->order_id.'/retry')->assertRedirect();
        $this->assertSame($key, $row->fresh()->idempotency_key);
        $this->assertSame('pending', $row->fresh()->state);
    }

    public function test_disabled_forwarding_never_posts_and_disabling_needs_no_network(): void
    {
        $row = $this->shipment();
        $this->fakeHttp(['*' => Http::failedConnection()]);
        $this->actingAs($this->seller)->post('/seller/raslo', ['enabled' => 0])->assertRedirect();
        app(RasloWorker::class)->send($row->id);
        Http::assertNothingSent();
        $this->assertSame('review', $row->fresh()->state);
    }

    public function test_cross_store_and_wrong_response_references_are_rejected(): void
    {
        $row = $this->shipment();
        $data = $this->data($row);
        $data['external_order_id'] = 'mj:another:1';
        $this->fakeHttp(['*' => Http::response(['data' => $data], 201)]);
        app(RasloWorker::class)->send($row->id);
        $this->assertSame('review', $row->fresh()->state);
        $this->assertNull($row->fresh()->remote_id);
    }

    public function test_signed_duplicate_and_old_events_do_not_regress_or_change_payment(): void
    {
        $row = $this->bind($this->shipment());
        $this->event($row, $this->data($row, 5, 'completed'))->assertOk();
        $this->event($row, $this->data($row, 5, 'completed'))->assertOk();
        $this->event($row, $this->data($row, 3, 'in_transit'))->assertOk();
        $this->assertSame('completed', $row->fresh()->delivery_status);
        $this->assertSame('processing', $row->order->fresh()->status);
        $this->assertSame('paid', $row->order->fresh()->payment_status);
    }

    public function test_invalid_signature_old_timestamp_and_early_events_are_retryable(): void
    {
        $row = $this->shipment();
        $this->event($row, $this->data($row), time() - 600)->assertUnauthorized();
        $this->postJson('/integrations/raslo/events/'.$row->connection->public_id, [])->assertUnauthorized();
        $this->event($row, $this->data($row))->assertStatus(503);
        $row = $this->bind($row);
        $bad = $this->data($row);
        $bad['id'] = (string) Str::uuid();
        $this->event($row, $bad)->assertStatus(409);
    }

    public function test_polling_recovers_missed_webhooks_and_removes_expired_tracking_url(): void
    {
        $row = $this->bind($this->shipment());
        $data = $this->data($row, 6, 'completed');
        $this->fakeHttp(['*' => Http::response(['data' => $data])]);
        app(RasloWorker::class)->poll($row->id);
        $this->assertSame('completed', $row->fresh()->delivery_status);
        $data['tracking_url'] = null;
        $this->fakeHttp(['*' => Http::response(['data' => $data])]);
        app(RasloWorker::class)->poll($row->id);
        $this->assertNull($row->fresh()->tracking_url);
    }

    public function test_tracking_page_is_private_and_rejects_unapproved_links(): void
    {
        $row = $this->bind($this->shipment());
        $row->refresh()->update(['tracking_url' => 'https://evil.example/track']);
        $this->actingAs($row->order->customer)->get('/orders/'.$row->order_id.'/delivery')->assertOk()->assertDontSee('evil.example');
        $this->actingAs(User::factory()->create())->get('/orders/'.$row->order_id.'/delivery')->assertNotFound();
    }

    public function test_private_or_non_https_operator_endpoints_are_rejected(): void
    {
        $endpoint = new RasloEndpoint;
        foreach (['http://localhost/api/integrations/v1', 'https://127.0.0.1/api/integrations/v1', 'https://user:pass@raslo.example/api/integrations/v1', 'https://raslo.example/api/integrations/v1?x=1'] as $url) {
            config(['raslo.api_base_url' => $url]);
            try {
                $endpoint->base();
                $this->fail('Unsafe URL accepted');
            } catch (\RuntimeException $e) {
                $this->assertSame('RASLO_ENDPOINT_INVALID', $e->getMessage());
            }
        }
    }

    public function test_broker_failure_leaves_durable_outbox_recoverable(): void
    {
        $row = $this->shipment();
        Queue::shouldReceive('connection')->andThrow(new \RuntimeException('broker unavailable'));
        app(RasloWorker::class)->due();
        $this->assertSame('pending', $row->fresh()->state);
        $this->assertSame('QUEUE_UNAVAILABLE', $row->fresh()->error_code);
        $this->assertNull($row->fresh()->queued_at);
    }

    public function test_retries_are_bounded_and_all_terminal_http_rejections_stop(): void
    {
        $row = $this->shipment();
        foreach ([401, 403, 404, 409, 422] as $status) {
            $row->refresh()->update(['state' => 'pending', 'attempts' => 0, 'next_attempt_at' => now()]);
            $this->fakeHttp(['*' => Http::response([], $status)]);
            app(RasloWorker::class)->send($row->id);
            $this->assertSame('review', $row->fresh()->state);
        }
        $row->refresh()->update(['state' => 'pending', 'attempts' => 0, 'next_attempt_at' => now()]);
        $this->fakeHttp(['*' => Http::response([], 503)]);
        for ($i = 1; $i <= 12; $i++) {
            $row->refresh()->update(['next_attempt_at' => now()->subSecond()]);
            app(RasloWorker::class)->send($row->id);
        }
        $this->assertSame(12, $row->fresh()->attempts);
        $this->assertSame('review', $row->fresh()->state);
    }

    public function test_ineligible_source_and_missing_address_do_not_queue(): void
    {
        $this->connection();
        $order = $this->order();
        $order->update(['checkout_currency' => 'USD']);
        try {
            app(RasloBridge::class)->capture($order);
            $this->fail('USD accepted');
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('raslo', $e->errors());
        }
        $order->update(['checkout_currency' => 'AED', 'status' => 'delivered']);
        $this->actingAs($this->seller)->post('/seller/raslo/orders/'.$order->id.'/retry')->assertSessionHasErrors('raslo');
        $this->assertDatabaseCount('raslo_shipments', 0);
    }

    public function test_awaiting_payment_expiry_cancels_outbox_without_sending(): void
    {
        $this->connection();
        $order = $this->order();
        $order->update(['payment_status' => 'pending']);
        $row = app(RasloBridge::class)->capture($order);
        app(RasloBridge::class)->expired($order);
        $this->assertSame('cancelled', $row->fresh()->state);
        app(RasloWorker::class)->due();
        Queue::assertNothingPushed();
    }

    public function test_poll_scheduler_queues_only_enabled_bound_shipments(): void
    {
        $row = $this->bind($this->shipment());
        $row->refresh()->update(['last_polled_at' => now()->subMinutes(6)]);
        $this->artisan('raslo:poll')->assertExitCode(0);
        Queue::assertPushed(PollRasloShipment::class, 1);
        $this->artisan('raslo:poll')->assertExitCode(0);
        Queue::assertPushed(PollRasloShipment::class, 1);
    }

    public function test_private_mapped_and_shared_addresses_are_blocked(): void
    {
        $endpoint = new RasloEndpoint;
        foreach (['127.0.0.1', '10.1.2.3', '169.254.169.254', '100.64.0.1', '198.18.1.1', '224.0.0.1', '::1', '::ffff:127.0.0.1', 'fe80::1', 'fc00::1'] as $ip) {
            $this->assertFalse($endpoint->isPublicAddress($ip), $ip);
        }
        $this->assertTrue($endpoint->isPublicAddress('1.1.1.1'));
        $this->assertTrue($endpoint->isPublicAddress('2606:4700:4700::1111'));
    }

    public function test_status_page_renders_in_arabic_and_english_without_exposing_credentials(): void
    {
        $row = $this->bind($this->shipment());
        foreach (['ar', 'en'] as $lang) {
            $this->actingAs($this->seller)->withSession(['locale' => $lang])->get('/seller/raslo')
                ->assertOk()->assertSee($lang === 'ar' ? 'توصيل رسلو' : 'Raslo delivery')->assertDontSee($row->connection->api_key);
        }
    }

    public function test_buyer_delivery_list_only_contains_owned_orders(): void
    {
        $row = $this->bind($this->shipment());
        $this->actingAs($row->order->customer)->get('/my-deliveries')->assertOk()->assertSee($row->order->order_number);
        $this->actingAs(User::factory()->create())->get('/my-deliveries')->assertOk()->assertDontSee($row->order->order_number);
    }

    public function test_local_status_refresh_is_owned_and_never_returns_recipient_or_credentials(): void
    {
        $row = $this->bind($this->shipment());
        $this->actingAs($row->order->customer)->getJson('/orders/'.$row->order_id.'/delivery')
            ->assertOk()->assertHeader('Cache-Control', 'no-store, private')
            ->assertJsonPath('status_label', 'Awaiting price approval')
            ->assertDontSee('Test Recipient')->assertDontSee('+971501234567')->assertDontSee('raslo_delivery_');
        $this->actingAs(User::factory()->create())->getJson('/orders/'.$row->order_id.'/delivery')->assertNotFound();
    }

    public function test_merchant_fulfilled_order_cannot_be_manually_rerouted_to_raslo(): void
    {
        $this->connection();
        $order = $this->order();
        $order->update(['shipping_address' => array_replace($order->shipping_address, ['shipping_method' => 'Merchant'])]);
        $this->actingAs($this->seller)->post('/seller/raslo/orders/'.$order->id.'/retry')->assertSessionHasErrors('raslo');
        $this->assertDatabaseCount('raslo_shipments', 0);
    }

    public function test_seller_shipping_validation_enforces_own_verified_connection_and_known_methods(): void
    {
        $this->actingAs($this->seller);
        $rules = (new CreateListing)->getRules()['shipping_method'];
        $validate = fn ($value) => Validator::make(['shipping_method' => $value], ['shipping_method' => $rules]);
        $this->assertTrue($validate('Raslo')->fails());
        $this->assertTrue($validate('Untrusted shipping')->fails());
        $this->assertFalse($validate('Pickup')->fails());
        $connection = $this->connection();
        $this->assertFalse($validate('Raslo')->fails());
        $connection->update(['enabled' => false]);
        $this->assertTrue($validate('Raslo')->fails());
    }

    public function test_workspace_and_profile_links_render_in_their_existing_action_groups(): void
    {
        $this->withoutVite();
        $this->actingAs($this->seller)->get('/dashboard')->assertOk()
            ->assertSeeInOrder(['Quick Actions', 'Raslo delivery integration', 'Add Product']);
        $this->get('/profile')->assertOk()->assertSeeInOrder(['My deliveries', 'Edit Profile']);
    }

    public function test_automation_check_fails_for_sync_queue_and_accepts_durable_configuration(): void
    {
        config(['queue.default' => 'sync']);
        $this->artisan('raslo:check')->assertExitCode(1);
        config(['queue.default' => 'database']);
        $this->artisan('raslo:check')->assertExitCode(0);
    }

    public function test_edit_product_validates_raslo_readiness_on_server_before_saving(): void
    {
        $this->actingAs($this->seller);
        $order = $this->order();
        $listing = $order->items()->first()->listing;
        $input = ['title' => 'Parcel', 'description' => 'Physical parcel', 'price' => '12.35',
            'quantity' => 3, 'condition' => 'new', 'price_condition' => 'fixed', 'shipping_method' => 'Raslo', 'delivery_days' => 2];
        $this->put('/seller/listing/'.$listing->id, $input)->assertSessionHasErrors('shipping_method');
        $this->connection();
        $this->put('/seller/listing/'.$listing->id, $input)->assertRedirect(route('profile'));
        $this->assertSame('Raslo', $listing->fresh()->shipping_method);
        $this->put('/seller/listing/'.$listing->id, array_replace($input, ['shipping_method' => 'Untrusted']))
            ->assertSessionHasErrors('shipping_method');
        $this->assertSame('Raslo', $listing->fresh()->shipping_method);
    }

    public function test_raslo_capture_fails_closed_if_connection_is_removed_after_readiness_check(): void
    {
        $order = $this->order();
        $this->expectException(ValidationException::class);
        app(RasloBridge::class)->capture($order);
    }

    private function fakeHttp(array $responses): void
    {
        Http::swap(new Factory);
        Http::preventStrayRequests();
        Http::fake($responses);
    }

    private function event(RasloShipment $row, array $data, ?int $stamp = null)
    {
        $stamp ??= time();
        $id = (string) Str::uuid();
        $body = json_encode(['id' => $id, 'type' => 'delivery.status_changed', 'data' => $data]);

        return $this->call('POST', '/integrations/raslo/events/'.$row->connection->public_id, [], [], [], [
            'CONTENT_TYPE' => 'application/json', 'HTTP_X_RASLO_EVENT_ID' => $id, 'HTTP_X_RASLO_TIMESTAMP' => (string) $stamp,
            'HTTP_X_RASLO_SIGNATURE' => 'v1='.hash_hmac('sha256', $stamp.'.'.$body, $row->connection->webhook_secret)], $body);
    }
}
