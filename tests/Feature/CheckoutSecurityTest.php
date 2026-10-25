<?php

namespace Tests\Feature;

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\DigitalProduct;
use App\Models\Download;
use App\Models\Order;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Stripe\ApiRequestor;
use Stripe\HttpClient\ClientInterface;
use Stripe\HttpClient\CurlClient;
use Tests\TestCase;

class CheckoutSecurityTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        ApiRequestor::setHttpClient(CurlClient::instance());
        parent::tearDown();
    }

    private function product(): DigitalProduct
    {
        return DigitalProduct::create(['title' => 'Paid file', 'description' => 'Paid downloadable file', 'price' => '19.99',
            'image' => 'cover.png', 'file' => 'paid.zip', 'status' => 'published', 'type' => 'digital', 'is_free' => false]);
    }

    public function test_paid_file_routes_require_ownership_and_paid_entitlement(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('paid.zip', 'fixture');
        $buyer = User::factory()->create();
        $other = User::factory()->create();
        $product = $this->product();
        $download = Download::create(['user_id' => $buyer->id, 'digital_product_id' => $product->id, 'token' => 'secret-token', 'paid' => false]);
        $this->actingAs($buyer)->get('/digital-products/'.$product->slug.'/download')->assertForbidden();
        $this->get('/downloads/secret-token')->assertForbidden();
        $download->update(['paid' => true]);
        $this->get('/digital-products/'.$product->slug.'/download')->assertDownload('paid.zip');
        $this->actingAs($other)->get('/downloads/secret-token')->assertForbidden();
        $this->get('/digital-products/'.$product->slug.'/download')->assertForbidden();
    }

    public function test_digital_payment_return_cannot_grant_another_users_purchase(): void
    {
        $buyer = User::factory()->create();
        $other = User::factory()->create();
        $product = $this->product();
        $shop = Shop::create(['name' => 'Owner store', 'name_ar' => 'متجر', 'user_id' => $buyer->id]);
        $order = Order::create(['order_number' => 'DIGITAL-1', 'user_id' => $buyer->id, 'shop_id' => $shop->id, 'total' => '19.99',
            'checkout_token' => 'test-token', 'checkout_currency' => 'USD', 'stripe_checkout_session_id' => 'cs_digital']);
        $order->items()->create(['digital_product_id' => $product->id, 'listing_name' => $product->title, 'price' => '19.99', 'quantity' => 1, 'total' => '19.99']);
        $session = ['object' => 'checkout.session', 'id' => 'cs_digital', 'client_reference_id' => 'test-token', 'mode' => 'payment',
            'status' => 'complete', 'payment_status' => 'paid', 'currency' => 'usd', 'amount_total' => 1999,
            'metadata' => ['order_id' => $order->id, 'product_id' => $product->id]];
        $this->fakeStripe($session);
        $this->actingAs($other)->get('/checkout/pod-digital/success?session_id=cs_digital')->assertForbidden();
        $this->assertSame('pending', $order->fresh()->payment_status);
        $this->assertDatabaseCount('downloads', 0);
        $session['amount_total'] = 1;
        $this->fakeStripe($session);
        $this->actingAs($buyer)->get('/checkout/pod-digital/success?session_id=cs_digital')->assertStatus(409);
        $session['amount_total'] = 1999;
        $this->fakeStripe($session);
        $this->get('/checkout/pod-digital/success?session_id=cs_digital')->assertOk();
        $this->get('/checkout/pod-digital/success?session_id=cs_digital')->assertOk();
        $this->assertDatabaseHas('downloads', ['user_id' => $buyer->id, 'digital_product_id' => $product->id, 'paid' => true]);
        $this->assertDatabaseCount('downloads', 1);
    }

    public function test_phone_verification_is_reset_only_when_phone_changes(): void
    {
        $user = User::factory()->create(['name' => 'Contact Buyer', 'username' => 'contact-buyer', 'phone' => '+971501234567', 'phone_verified_at' => now()]);
        $update = app(UpdateUserProfileInformation::class);
        $update->update($user, ['name' => $user->name, 'email' => 'changed@example.com', 'username' => $user->username, 'phone' => $user->phone]);
        $this->assertNotNull($user->fresh()->phone_verified_at);
        $update->update($user, ['name' => $user->name, 'email' => $user->email, 'username' => $user->username, 'phone' => '+971509876543']);
        $this->assertNull($user->fresh()->phone_verified_at);
    }

    private function fakeStripe(array $session): void
    {
        config(['services.stripe.secret' => 'sk_test_fixture']);
        ApiRequestor::setHttpClient(new class($session) implements ClientInterface
        {
            public function __construct(private array $session) {}

            public function request($method, $absUrl, $headers, $params, $hasFile, $apiMode = 'v1', $maxNetworkRetries = null)
            {
                return [json_encode($this->session), 200, []];
            }
        });
    }
}
