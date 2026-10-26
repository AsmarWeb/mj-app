<?php

namespace Tests\Feature;

use App\Models\Plan;
use App\Models\PlanCheckoutAttempt;
use App\Models\Shop;
use App\Models\Subscription;
use App\Models\User;
use App\Services\Billing\SubscriptionGateway;
use App\Services\Billing\SubscriptionSync;
use Database\Seeders\PlanSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Cashier\Cashier;
use Mockery;
use Tests\TestCase;

class MembershipBillingTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private Shop $shop;

    private Plan $free;

    private Plan $basic;

    private SubscriptionGateway $gateway;

    protected function setUp(): void
    {
        parent::setUp();
        config(['cashier.currency' => 'usd']);
        $this->seed(PlanSeeder::class);
        $this->free = Plan::where('slug', 'free')->firstOrFail();
        $this->basic = Plan::where('slug', 'basic')->firstOrFail();
        $this->basic->update(['stripe_price' => 'price_basic']);
        $this->user = User::factory()->create();
        $this->user->forceFill(['stripe_id' => 'cus_member'])->save();
        $this->shop = Shop::create(['name' => 'Membership store', 'name_ar' => 'متجر الاشتراكات', 'user_id' => $this->user->id, 'currency' => 'AED', 'is_active' => true]);
        $this->freeSubscription();
        $this->gateway = Mockery::mock(SubscriptionGateway::class);
        $this->app->instance(SubscriptionGateway::class, $this->gateway);
    }

    private function freeSubscription(): Subscription
    {
        return Subscription::firstOrCreate(['stripe_id' => 'free_'.$this->user->id], [
            'shop_id' => $this->shop->id, 'user_id' => $this->user->id, 'plan_id' => $this->free->id,
            'payment_provider' => 'free', 'stripe_status' => 'active', 'status' => 'active', 'type' => 'default',
        ]);
    }

    private function snapshot(string $status = 'active', string $price = 'price_basic'): array
    {
        return ['id' => 'sub_member', 'customer' => 'cus_member', 'status' => $status,
            'items' => ['data' => [['id' => 'si_member', 'quantity' => 1, 'price' => ['id' => $price, 'product' => 'prod_member']]]]];
    }

    private function checkoutGateway(): void
    {
        $this->gateway->shouldReceive('price')->with('price_basic')->andReturn([
            'id' => 'price_basic', 'active' => true, 'type' => 'recurring', 'currency' => 'usd',
            'unit_amount' => 999, 'recurring' => ['interval' => 'month', 'interval_count' => 1],
        ]);
        $this->gateway->shouldReceive('customer')->andReturn('cus_member');
        $this->gateway->shouldReceive('subscriptions')->with('cus_member')->andReturn([]);
    }

    private function openSession(array $payload): array
    {
        return ['id' => 'cs_member', 'mode' => 'subscription', 'customer' => $payload['customer'],
            'client_reference_id' => $payload['client_reference_id'], 'status' => 'open', 'url' => 'https://checkout.stripe.com/c/pay/member'];
    }

    public function test_pricing_renders_on_fresh_schema_and_reads_actual_free_limits_in_both_languages(): void
    {
        $this->free->update(['listing_limit' => 7, 'storage_limit' => 120]);
        foreach (['en', 'ar'] as $lang) {
            $this->actingAs($this->user)->withSession(['locale' => $lang])->get('/pricing')->assertOk()
                ->assertSee('7')->assertSee('120')->assertSee('USD')
                ->assertDontSee('Unlimited');
        }
    }

    public function test_seeder_is_repeatable_and_preserves_operator_prices_and_free_limits(): void
    {
        $this->basic->update(['price' => '18.50', 'stripe_price' => 'price_operator']);
        $this->free->update(['listing_limit' => 8]);
        $this->seed(PlanSeeder::class);
        $this->seed(PlanSeeder::class);
        $this->assertSame(3, Plan::count());
        $this->assertSame('18.50', $this->basic->fresh()->price);
        $this->assertSame('price_operator', $this->basic->fresh()->stripe_price);
        $this->assertSame(8, $this->free->fresh()->listing_limit);
    }

    public function test_cashier_uses_the_application_subscription_model(): void
    {
        $this->assertSame(Subscription::class, Cashier::$subscriptionModel);
        $this->assertInstanceOf(Subscription::class, $this->user->subscriptions()->first());
    }

    public function test_current_provider_state_updates_plan_without_returning_to_checkout(): void
    {
        $this->gateway->shouldReceive('subscription')->with('sub_member')->andReturn($this->snapshot());
        $row = app(SubscriptionSync::class)->sync('sub_member', 'cus_member');
        $this->assertSame($this->basic->id, $row->plan_id);
        $this->assertSame('active', $row->status);
        $this->assertSame($row->id, $this->shop->fresh()->activeSubscription->id);
        $this->assertDatabaseHas('subscription_items', ['subscription_id' => $row->id, 'stripe_price' => 'price_basic']);
        $this->assertSame('active', $this->freeSubscription()->fresh()->status);
    }

    public function test_unpaid_cancelled_expired_and_unknown_prices_never_grant_paid_limits(): void
    {
        foreach (['past_due', 'incomplete', 'unpaid', 'canceled', 'incomplete_expired', 'paused'] as $status) {
            $this->gateway->shouldReceive('subscription')->once()->andReturn($this->snapshot($status));
            app(SubscriptionSync::class)->sync('sub_member', 'cus_member');
            $this->assertSame($this->free->id, $this->shop->fresh()->activeSubscription->plan_id, $status);
        }
        $this->gateway->shouldReceive('subscription')->once()->andReturn($this->snapshot('active', 'price_unknown'));
        app(SubscriptionSync::class)->sync('sub_member', 'cus_member');
        $this->assertSame($this->free->id, $this->shop->fresh()->activeSubscription->plan_id);
    }

    public function test_stale_local_active_and_expired_grace_cannot_keep_paid_access(): void
    {
        $paid = Subscription::create(['user_id' => $this->user->id, 'shop_id' => $this->shop->id,
            'plan_id' => $this->basic->id, 'type' => 'default', 'stripe_id' => 'sub_member',
            'stripe_status' => 'past_due', 'status' => 'active', 'payment_provider' => 'stripe', 'stripe_price' => 'price_basic']);
        $this->assertSame($this->free->id, $this->shop->fresh()->activeSubscription->plan_id);
        $paid->update(['stripe_status' => 'active', 'ends_at' => now()->subSecond()]);
        $this->assertSame($this->free->id, $this->shop->fresh()->activeSubscription->plan_id);
        $paid->update(['ends_at' => now()->addDay()]);
        $this->assertSame($this->basic->id, $this->shop->fresh()->activeSubscription->plan_id);
    }

    public function test_legacy_expired_free_row_is_a_fallback_without_changing_free_prices(): void
    {
        $this->freeSubscription()->update(['status' => 'expired']);
        $this->assertSame($this->free->id, $this->shop->fresh()->activeSubscription->plan_id);
        $this->assertSame('0.00', $this->free->fresh()->price);
        $this->assertSame(5, $this->free->listing_limit);
    }

    public function test_success_redirect_does_not_activate_from_session_plan_id(): void
    {
        $this->actingAs($this->user)->withSession(['selected_plan_id' => $this->basic->id])
            ->get('/subscription/success')->assertRedirect('/pricing');
        $this->assertDatabaseMissing('subscriptions', ['payment_provider' => 'stripe']);
        $this->assertSame($this->free->id, $this->shop->fresh()->activeSubscription->plan_id);
    }

    public function test_checkout_requires_a_matching_recurring_price_before_any_charge_attempt(): void
    {
        $this->gateway->shouldReceive('price')->andReturn(['id' => 'price_basic', 'active' => true,
            'type' => 'recurring', 'currency' => 'aed', 'unit_amount' => 999, 'recurring' => ['interval' => 'month', 'interval_count' => 1]]);
        $this->actingAs($this->user)->from('/pricing')->post('/subscription/checkout/'.$this->basic->id)
            ->assertRedirect('/pricing')->assertSessionHasErrors('billing');
        $this->assertSame(0, PlanCheckoutAttempt::count());
    }

    public function test_network_retry_keeps_original_payload_key_and_one_checkout(): void
    {
        $this->checkoutGateway();
        $keys = [];
        $this->gateway->shouldReceive('create')->twice()->andReturnUsing(function ($payload, $key) use (&$keys) {
            $keys[] = [$payload, $key];
            if (count($keys) === 1) {
                throw new \RuntimeException('Simulated lost response');
            }

            return $this->openSession($payload);
        });
        $this->actingAs($this->user)->from('/pricing')->post('/subscription/checkout/'.$this->basic->id)->assertSessionHasErrors('billing');
        $this->actingAs($this->user)->post('/subscription/checkout/'.$this->basic->id)->assertRedirect('https://checkout.stripe.com/c/pay/member');
        $this->assertSame($keys[0], $keys[1]);
        $this->assertSame(1, PlanCheckoutAttempt::count());
        $this->assertDatabaseMissing('subscriptions', ['payment_provider' => 'stripe']);
    }

    public function test_existing_unpaid_subscription_blocks_duplicate_checkout_and_offers_portal(): void
    {
        $this->gateway->shouldReceive('price')->andReturn(['id' => 'price_basic', 'active' => true,
            'type' => 'recurring', 'currency' => 'usd', 'unit_amount' => 999, 'recurring' => ['interval' => 'month', 'interval_count' => 1]]);
        $this->gateway->shouldReceive('customer')->andReturn('cus_member');
        $this->gateway->shouldReceive('subscriptions')->andReturn([$this->snapshot('past_due')]);
        $this->actingAs($this->user)->from('/pricing')->post('/subscription/checkout/'.$this->basic->id)->assertSessionHasErrors('billing');
        $this->assertSame(0, PlanCheckoutAttempt::count());
        $this->gateway->shouldReceive('portal')->with('cus_member', route('plans.index'))->andReturn('https://billing.stripe.com/p/session/test');
        $this->actingAs($this->user)->post('/subscription/portal')->assertRedirect('https://billing.stripe.com/p/session/test');
    }

    public function test_signed_delayed_event_reads_current_cancelled_state_instead_of_reactivating(): void
    {
        config(['cashier.webhook.secret' => 'whsec_membership']);
        $this->gateway->shouldReceive('subscription')->twice()->with('sub_member')->andReturn($this->snapshot('canceled'));
        foreach (['customer.subscription.deleted', 'customer.subscription.created'] as $type) {
            $payload = json_encode(['id' => 'evt_'.Str::random(12), 'type' => $type, 'data' => ['object' => $this->snapshot()]]);
            $stamp = time();
            $sig = hash_hmac('sha256', $stamp.'.'.$payload, 'whsec_membership');
            $this->call('POST', '/stripe/webhook', [], [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_STRIPE_SIGNATURE' => "t=$stamp,v1=$sig"], $payload)->assertOk();
        }
        $this->assertDatabaseHas('subscriptions', ['stripe_id' => 'sub_member', 'stripe_status' => 'canceled', 'status' => 'cancelled']);
        $this->assertSame($this->free->id, $this->shop->fresh()->activeSubscription->plan_id);
    }

    public function test_checkout_return_rejects_another_customers_session(): void
    {
        $this->checkoutGateway();
        $this->gateway->shouldReceive('create')->andReturnUsing(fn ($payload) => $this->openSession($payload));
        $this->actingAs($this->user)->post('/subscription/checkout/'.$this->basic->id)->assertRedirect();
        $other = $this->openSession(PlanCheckoutAttempt::first()->payload);
        $other['customer'] = 'cus_someone_else';
        $other['status'] = 'complete';
        $other['subscription'] = 'sub_other';
        $this->gateway->shouldReceive('session')->with('cs_other')->andReturn($other);
        $this->actingAs($this->user)->get('/subscription/success?session_id=cs_other')->assertSessionHasErrors('billing');
        $this->assertDatabaseMissing('subscriptions', ['payment_provider' => 'stripe']);
    }

    public function test_verified_return_can_recover_without_a_webhook_but_uses_provider_state(): void
    {
        $this->checkoutGateway();
        $this->gateway->shouldReceive('create')->andReturnUsing(fn ($payload) => $this->openSession($payload));
        $this->actingAs($this->user)->post('/subscription/checkout/'.$this->basic->id)->assertRedirect();
        $complete = $this->openSession(PlanCheckoutAttempt::first()->payload);
        $complete['status'] = 'complete';
        $complete['subscription'] = 'sub_member';
        $this->gateway->shouldReceive('session')->with('cs_member')->andReturn($complete);
        $this->gateway->shouldReceive('subscription')->with('sub_member')->andReturn($this->snapshot('past_due'));
        $this->actingAs($this->user)->get('/subscription/success?session_id=cs_member')->assertRedirect('/pricing');
        $this->assertSame($this->free->id, $this->shop->fresh()->activeSubscription->plan_id);
    }

    public function test_scheduler_recovers_subscription_from_known_checkout_when_all_events_are_missed(): void
    {
        $this->checkoutGateway();
        $this->gateway->shouldReceive('create')->andReturnUsing(fn ($payload) => $this->openSession($payload));
        $this->actingAs($this->user)->post('/subscription/checkout/'.$this->basic->id)->assertRedirect();
        $complete = $this->openSession(PlanCheckoutAttempt::first()->payload);
        $complete['status'] = 'complete';
        $complete['subscription'] = 'sub_member';
        $this->gateway->shouldReceive('session')->with('cs_member')->andReturn($complete);
        $this->gateway->shouldReceive('subscription')->with('sub_member')->andReturn($this->snapshot());
        $this->artisan('membership:sync')->assertExitCode(0);
        $this->assertSame($this->basic->id, $this->shop->fresh()->activeSubscription->plan_id);
    }

    public function test_unsigned_subscription_event_cannot_activate_a_plan(): void
    {
        config(['cashier.webhook.secret' => 'whsec_membership']);
        $this->postJson('/stripe/webhook', ['type' => 'customer.subscription.created', 'data' => ['object' => $this->snapshot()]])->assertStatus(403);
        $this->assertDatabaseMissing('subscriptions', ['payment_provider' => 'stripe']);
    }

    public function test_missing_price_and_free_plan_never_reach_the_provider(): void
    {
        foreach ([$this->free, Plan::where('slug', 'pro')->first()] as $plan) {
            $this->actingAs($this->user)->from('/pricing')->post('/subscription/checkout/'.$plan->id)->assertSessionHasErrors('billing');
        }
        $this->assertSame(0, PlanCheckoutAttempt::count());
    }

    public function test_billing_portal_rejects_non_stripe_destinations(): void
    {
        $this->gateway->shouldReceive('portal')->andReturn('https://attacker.example/checkout');
        $this->actingAs($this->user)->from('/pricing')->post('/subscription/portal')->assertRedirect('/pricing')->assertSessionHasErrors('billing');
    }
    public function test_free_video_restriction_is_enforced_on_the_server(): void
    {
        \Livewire\Livewire::actingAs($this->user)->test(\App\Livewire\Seller\CreateListing::class)
            ->set('video', \Illuminate\Http\UploadedFile::fake()->create('clip.mp4', 20, 'video/mp4'))
            ->call('save')
            ->assertHasErrors(['video' => 'prohibited']);
    }

    public function test_manual_checkout_recovery_checks_saved_identity_before_binding(): void
    {
        $this->checkoutGateway();
        $this->gateway->shouldReceive('create')->once()->andThrow(new \RuntimeException('Lost response'));
        $this->actingAs($this->user)->from('/pricing')->post('/subscription/checkout/'.$this->basic->id)->assertSessionHasErrors('billing');
        $attempt = PlanCheckoutAttempt::firstOrFail();
        $session = $this->openSession($attempt->payload);
        $session['status'] = 'expired';
        $this->gateway->shouldReceive('session')->with('cs_member')->andReturn($session);
        $this->artisan('membership:recover', ['session' => 'cs_member'])->assertExitCode(0);
        $this->assertSame('cs_member', $attempt->fresh()->stripe_session_id);
    }

    public function test_storage_usage_uses_the_real_listing_relation_and_includes_video(): void
    {
        \Illuminate\Support\Facades\Storage::fake('public');
        $this->actingAs($this->user);
        \App\Models\Listing::forceCreate(['shop_id' => $this->shop->id, 'title' => 'Storage', 'title_ar' => 'تخزين',
            'slug' => 'storage-test', 'price' => '10.00', 'quantity' => 1, 'image' => 'main.jpg',
            'images' => ['main.jpg', 'extra.jpg'], 'video' => 'clip.mp4', 'price_condition' => 'fixed', 'condition' => 'new']);
        $disk = \Illuminate\Support\Facades\Storage::disk('public');
        $disk->put('products/main.jpg', str_repeat('a', 1024));
        $disk->put('products/extra.jpg', str_repeat('b', 2048));
        $disk->put('products/videos/clip.mp4', str_repeat('c', 4096));
        $this->assertSame(7168, $this->user->storageUsed());
    }

}
