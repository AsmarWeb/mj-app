<?php

namespace Tests\Feature;

use App\Mail\PodOrderReceived;
use App\Models\DigitalProduct;
use App\Models\Download;
use App\Models\Order;
use App\Models\Shop;
use App\Models\Supplier;
use App\Models\User;
use App\Services\Checkout\DigitalCheckoutGateway;
use App\Services\Checkout\DigitalCheckoutService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Mail\MailManager;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Testing\Fakes\MailFake;
use Mockery;
use Tests\TestCase;

class DigitalCheckoutWebhookTest extends TestCase
{
    use RefreshDatabase;

    private function purchase(string $type = 'digital'): array
    {
        Mail::fake();
        $owner = User::factory()->create();
        $buyer = User::factory()->create();
        Shop::create(['name' => 'File store', 'name_ar' => 'متجر', 'user_id' => $owner->id, 'currency' => 'AED']);
        $supplier = Supplier::create(['name' => 'Print supplier', 'email' => 'supplier@example.test']);
        $product = DigitalProduct::create(['user_id' => $owner->id, 'type' => $type, 'title' => 'Test purchase',
            'description' => 'Fixture', 'price' => '19.99', 'image' => 'cover.png', 'file' => 'private.zip',
            'supplier_id' => $supplier->id, 'base_cost' => '4.25', 'base_product' => 'Mug']);
        $gateway = Mockery::mock(DigitalCheckoutGateway::class);
        $gateway->shouldReceive('create')->once()->andReturnUsing(function ($payload, $key) {
            $this->assertSame('digital-'.$payload['client_reference_id'], $key);

            return ['id' => 'cs_digital_'.$payload['metadata']['order_id'], 'object' => 'checkout.session',
                'metadata' => $payload['metadata'], 'client_reference_id' => $payload['client_reference_id'],
                'mode' => 'payment', 'status' => 'open', 'payment_status' => 'unpaid', 'currency' => 'usd',
                'amount_total' => 3998, 'url' => 'https://checkout.stripe.com/test'];
        });
        $this->app->instance(DigitalCheckoutGateway::class, $gateway);
        $session = app(DigitalCheckoutService::class)->start($buyer, $product, 2);
        $order = Order::findOrFail($session['metadata']['order_id']);
        $session = array_replace($session, ['status' => 'complete', 'payment_status' => 'paid', 'payment_intent' => 'pi_digital_'.$order->id]);

        return [$order, $product, $session, $gateway, $supplier];
    }

    private function webhook(array $session, string $type = 'checkout.session.completed', bool $signed = true)
    {
        config(['cashier.webhook.secret' => 'whsec_fixture']);
        $json = json_encode(['id' => 'evt_fixture', 'type' => $type, 'data' => ['object' => $session]]);
        $time = time();
        $signature = 't='.$time.',v1='.hash_hmac('sha256', $time.'.'.$json, 'whsec_fixture');

        return $this->call('POST', '/stripe/webhook', [], [], [], ['CONTENT_TYPE' => 'application/json',
            'HTTP_STRIPE_SIGNATURE' => $signed ? $signature : 'invalid'], $json);
    }

    public function test_signed_webhook_grants_digital_purchase_without_browser_return(): void
    {
        [$order, $product, $session] = $this->purchase();
        $this->webhook($session)->assertOk();
        $this->assertTrue($order->fresh()->isPaid());
        $this->assertSame('pi_digital_'.$order->id, $order->fresh()->stripe_payment_intent_id);
        $this->assertDatabaseHas('downloads', ['user_id' => $order->user_id, 'digital_product_id' => $product->id, 'paid' => true]);
        // Purchases are not counted as file downloads.
        $this->assertSame(0, $product->fresh()->downloads);
        $this->assertDatabaseCount('supplier_payouts', 0);
    }

    public function test_duplicates_and_late_expiry_do_not_duplicate_or_revoke_entitlement(): void
    {
        [$order, $product, $session, $gateway] = $this->purchase();
        $this->webhook($session)->assertOk();
        $token = Download::firstOrFail()->token;
        $this->webhook($session)->assertOk();
        $gateway->shouldReceive('retrieve')->with($session['id'])->once()->andReturn($session);
        $this->actingAs($order->customer)->get(route('pod.checkout.success', ['session_id' => $session['id']]))->assertOk();
        $this->webhook(array_replace($session, ['status' => 'expired', 'payment_status' => 'unpaid']), 'checkout.session.expired')->assertOk();
        $this->assertTrue($order->fresh()->isPaid());
        $this->assertDatabaseCount('downloads', 1);
        $this->assertSame($token, Download::firstOrFail()->token);
    }

    public function test_unpaid_completion_waits_for_async_success(): void
    {
        [$order, $product, $session] = $this->purchase();
        $this->webhook(array_replace($session, ['payment_status' => 'unpaid']))->assertOk();
        $this->assertFalse($order->fresh()->isPaid());
        $this->assertDatabaseCount('downloads', 0);
        $this->webhook($session, 'checkout.session.async_payment_succeeded')->assertOk();
        $this->assertTrue($order->fresh()->isPaid());
    }

    public function test_async_failure_and_expiry_do_not_grant_downloads(): void
    {
        [$order, $product, $session] = $this->purchase();
        $this->webhook(array_replace($session, ['payment_status' => 'unpaid']), 'checkout.session.async_payment_failed')->assertOk();
        $this->assertSame('failed', $order->fresh()->payment_status);
        $this->webhook(array_replace($session, ['status' => 'expired', 'payment_status' => 'unpaid']), 'checkout.session.expired')->assertOk();
        $this->assertDatabaseCount('downloads', 0);
    }

    public function test_mismatched_session_identity_is_rejected_before_fulfillment(): void
    {
        [$order, $product, $session] = $this->purchase();
        foreach ([['amount_total' => 1], ['currency' => 'aed'], ['id' => 'cs_wrong'],
            ['client_reference_id' => 'wrong'], ['payment_intent' => null],
            ['metadata' => array_replace($session['metadata'], ['product_id' => '999999'])]] as $override) {
            $this->webhook(array_replace($session, $override))->assertStatus(409);
        }
        $this->assertFalse($order->fresh()->isPaid());
        $this->assertDatabaseCount('downloads', 0);
    }

    public function test_invalid_signature_cannot_fulfill(): void
    {
        [$order, $product, $session] = $this->purchase();
        $this->webhook($session, signed: false)->assertForbidden();
        $this->assertFalse($order->fresh()->isPaid());
        $this->assertDatabaseCount('downloads', 0);
    }

    public function test_pod_uses_frozen_supplier_and_cost_once_despite_product_edits(): void
    {
        [$order, $product, $session, $gateway, $supplier] = $this->purchase('pod');
        $product->update(['price' => '99.99', 'base_cost' => '20.00', 'type' => 'digital', 'supplier_id' => null]);
        $this->webhook($session)->assertOk();
        $this->webhook($session)->assertOk();
        $this->assertDatabaseCount('supplier_payouts', 1);
        $this->assertDatabaseHas('supplier_payouts', ['order_id' => $order->id, 'supplier_id' => $supplier->id,
            'amount' => '8.50', 'supplier_amount' => '8.50']);
        $this->assertDatabaseCount('downloads', 0);
        Mail::assertSent(PodOrderReceived::class, 1);
        Mail::assertSent(PodOrderReceived::class, fn ($mail) => $mail->hasTo($supplier->email) && $mail->product->base_cost === '4.25');
        Mail::assertSent(PodOrderReceived::class, function ($mail) {
            $html = $mail->render();
            $this->assertStringContainsString('Test purchase', $html);
            $this->assertStringContainsString('8.50', $html);

            return true;
        });
    }

    public function test_email_failure_preserves_payment_and_can_be_retried(): void
    {
        [$order, $product, $session] = $this->purchase('pod');
        $pending = Mockery::mock();
        $pending->shouldReceive('send')->once()->andThrow(new \RuntimeException('mail unavailable'));
        Mail::shouldReceive('to')->once()->andReturn($pending);
        $this->webhook($session)->assertOk();
        $this->assertTrue($order->fresh()->isPaid());
        $this->assertSame('paid_notice_pending', $order->fresh()->checkout_state);
        $this->assertDatabaseCount('supplier_payouts', 1);
        Mail::swap(new MailFake(new MailManager($this->app)));
        $this->artisan('digital:reconcile')->assertExitCode(0);
        $this->assertSame('paid', $order->fresh()->checkout_state);
        Mail::assertSent(PodOrderReceived::class, 1);
    }

    public function test_reconciliation_recovers_a_missed_webhook(): void
    {
        [$order, $product, $session, $gateway] = $this->purchase();
        $gateway->shouldReceive('retrieve')->with($session['id'])->once()->andReturn($session);
        $this->artisan('digital:reconcile')->assertExitCode(0);
        $this->assertTrue($order->fresh()->isPaid());
        $this->assertDatabaseCount('downloads', 1);
    }

    public function test_early_webhook_binds_new_order_if_session_save_was_missed(): void
    {
        [$order, $product, $session] = $this->purchase();
        $order->update(['stripe_checkout_session_id' => null]);
        $this->webhook($session)->assertOk();
        $this->assertSame($session['id'], $order->fresh()->stripe_checkout_session_id);
        $this->assertTrue($order->fresh()->isPaid());
    }

    public function test_legacy_session_with_saved_binding_is_supported(): void
    {
        [$order, $product, $session] = $this->purchase();
        $order->update(['checkout_payload' => null]);
        unset($session['metadata']['checkout_kind']);
        $this->webhook($session)->assertOk();
        $this->assertTrue($order->fresh()->isPaid());
    }

    public function test_unbound_legacy_session_cannot_claim_an_order(): void
    {
        [$order, $product, $session] = $this->purchase();
        $order->update(['checkout_payload' => null, 'stripe_checkout_session_id' => null]);
        unset($session['metadata']['checkout_kind']);
        $this->webhook($session)->assertStatus(409);
        $this->assertFalse($order->fresh()->isPaid());
    }

    public function test_return_page_cannot_be_used_by_another_customer(): void
    {
        [$order, $product, $session, $gateway] = $this->purchase();
        $gateway->shouldReceive('retrieve')->once()->andReturn($session);
        $this->actingAs(User::factory()->create())
            ->get(route('pod.checkout.success', ['session_id' => $session['id']]))->assertForbidden();
        $this->assertFalse($order->fresh()->isPaid());
    }

    public function test_refunded_order_is_not_reactivated_by_old_paid_event(): void
    {
        [$order, $product, $session] = $this->purchase();
        $order->update(['payment_status' => 'refunded']);
        $this->webhook($session)->assertOk();
        $this->assertSame('refunded', $order->fresh()->payment_status);
        $this->assertDatabaseCount('downloads', 0);
    }
}
