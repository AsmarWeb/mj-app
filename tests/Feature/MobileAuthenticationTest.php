<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;
use Laravel\Fortify\Fortify;
use Laravel\Sanctum\PersonalAccessToken;
use Mockery;
use Tests\TestCase;

class MobileAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Notification::fake();
        Cache::flush();
    }

    private function api(string $method, string $path, array $data = [], ?string $token = null)
    {
        Auth::forgetGuards();
        Auth::shouldUse('web');

        return $this->json($method, str_starts_with($path, '/api/') ? $path : '/api/v1/auth'.$path, $data,
            ['Authorization' => $token ? 'Bearer '.$token : '']);
    }

    private function credentials(User $user, array $extra = []): array
    {
        return $extra + ['email' => $user->email, 'password' => 'password', 'device_name' => 'Test phone'];
    }

    public function test_registration_creates_account_and_scoped_expiring_token_without_web_session(): void
    {
        $response = $this->api('POST', '/register', [
            'name' => 'Mobile Buyer', 'email' => ' MOBILE@example.test ', 'password' => 'password',
            'password_confirmation' => 'password', 'device_name' => 'Test iPhone', 'terms' => true,
            'role' => 'administrator', 'email_verified_at' => now()->toISOString(), 'phone_verified_at' => now()->toISOString(),
        ])->assertCreated()->assertJsonPath('data.user.email', 'mobile@example.test')
            ->assertJsonPath('data.user.email_verified', false)->assertJsonPath('data.user.phone_verified', false)
            ->assertHeader('Cache-Control', 'no-store, private');
        $user = User::where('email', 'mobile@example.test')->firstOrFail();
        $this->assertTrue(Hash::check('password', $user->password));
        $this->assertFalse($user->hasRole('administrator'));
        $this->assertTrue($user->hasRole('user'));
        $this->assertNull($user->phone_verified_at);
        Notification::assertSentTo($user, VerifyEmail::class);
        $plain = $response->json('data.access_token');
        $token = PersonalAccessToken::findToken($plain);
        $this->assertSame(['mobile:account'], $token->abilities);
        $this->assertNotSame($plain, $token->token);
        $this->assertSame(hash('sha256', explode('|', $plain, 2)[1]), $token->token);
        $this->assertTrue($token->expires_at->between(now()->addDays(29), now()->addDays(31)));
        $this->assertDatabaseCount('sessions', 0);
        $this->api('GET', '/me', token: $plain)->assertOk()->assertJsonPath('data.id', $user->id);
    }

    public function test_registration_enforces_web_password_confirmation_terms_and_uniqueness(): void
    {
        $data = ['name' => 'Mobile Buyer', 'email' => 'buyer@example.test', 'password' => 'short',
            'password_confirmation' => 'different', 'device_name' => 'Phone'];
        $this->api('POST', '/register', $data)->assertUnprocessable()->assertJsonValidationErrors(['password', 'terms']);
        $this->assertDatabaseCount('users', 0);
        $existing = User::factory()->create(['email' => 'buyer@example.test']);
        $this->api('POST', '/register', array_replace($data, ['password' => 'password', 'password_confirmation' => 'password', 'terms' => true]))
            ->assertUnprocessable()->assertJsonValidationErrors('email');
        $this->assertSame(0, $existing->tokens()->count());
    }

    public function test_registration_can_be_disabled_without_affecting_login(): void
    {
        config(['fortify.features' => []]);
        $this->api('POST', '/register', [])->assertNotFound();
        $user = User::factory()->create();
        $this->api('POST', '/login', $this->credentials($user))->assertOk();
    }

    public function test_login_accepts_existing_credentials_and_returns_safe_user_fields(): void
    {
        $user = User::factory()->create(['stripe_id' => 'cus_private', 'pm_last_four' => '4242', 'remember_token' => 'private-remember']);
        $response = $this->api('POST', '/login', $this->credentials($user, ['email' => strtoupper($user->email)]))
            ->assertOk()->assertJsonPath('data.user.id', $user->id)->assertJsonPath('data.token_type', 'Bearer')
            ->assertDontSee('cus_private')->assertDontSee('private-remember')->assertDontSee('4242');
        $this->assertSame(['id', 'name', 'username', 'email', 'phone', 'email_verified', 'phone_verified', 'two_factor_enabled', 'profile_photo_url'],
            array_keys($response->json('data.user')));
        $this->api('GET', '/api/user', token: $response->json('data.access_token'))->assertOk()
            ->assertJsonPath('id', $user->id)->assertDontSee('cus_private');
    }

    public function test_invalid_credentials_have_same_response_and_issue_no_tokens(): void
    {
        $user = User::factory()->create();
        $wrong = $this->api('POST', '/login', $this->credentials($user, ['password' => 'wrong']))->assertUnprocessable();
        $missing = $this->api('POST', '/login', $this->credentials($user, ['email' => 'absent@example.test']))->assertUnprocessable();
        $this->assertSame($wrong->json(), $missing->json());
        $this->assertDatabaseCount('personal_access_tokens', 0);
    }

    public function test_login_requires_valid_device_and_payload_types(): void
    {
        $user = User::factory()->create();
        $this->api('POST', '/login', ['email' => ['invalid'], 'password' => 'password'])
            ->assertUnprocessable()->assertJsonValidationErrors(['email', 'device_name']);
        $this->api('POST', '/login', $this->credentials($user, ['device_name' => str_repeat('x', 81)]))
            ->assertUnprocessable()->assertJsonValidationErrors('device_name');
    }

    public function test_me_rejects_missing_invalid_expired_and_wrong_scope_tokens(): void
    {
        $user = User::factory()->create();
        $this->api('GET', '/me')->assertUnauthorized();
        $this->api('GET', '/me', token: 'invalid')->assertUnauthorized();
        $expired = $user->createToken('mobile:old', ['mobile:account'], now()->subMinute())->plainTextToken;
        $this->api('GET', '/me', token: $expired)->assertUnauthorized();
        $read = $user->createToken('web', ['read'])->plainTextToken;
        $this->api('GET', '/me', token: $read)->assertForbidden();
        $wildcard = $user->createToken('legacy', ['*'])->plainTextToken;
        $this->api('GET', '/me', token: $wildcard)->assertForbidden();
    }

    public function test_web_session_is_not_a_mobile_token(): void
    {
        $this->actingAs(User::factory()->create())->getJson('/api/v1/auth/me')->assertUnauthorized();
    }

    public function test_logout_revokes_only_the_present_device(): void
    {
        $user = User::factory()->create();
        $first = $this->api('POST', '/login', $this->credentials($user))->json('data.access_token');
        $second = $this->api('POST', '/login', $this->credentials($user, ['device_name' => 'Second phone']))->json('data.access_token');
        $this->api('POST', '/logout', token: $first)->assertNoContent();
        $this->api('GET', '/me', token: $first)->assertUnauthorized();
        $this->api('GET', '/me', token: $second)->assertOk();
        $this->assertSame(1, $user->tokens()->count());
    }

    public function test_devices_are_private_and_only_own_mobile_tokens_can_be_revoked(): void
    {
        $user = User::factory()->create();
        $plain = $user->createToken('mobile:Phone', ['mobile:account'], now()->addDay())->plainTextToken;
        $legacy = $user->createToken('legacy', ['read']);
        $other = User::factory()->create()->createToken('mobile:Other', ['mobile:account'], now()->addDay());
        $response = $this->api('GET', '/devices', token: $plain)->assertOk()->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.current', true)->assertDontSee($plain)->assertDontSee($legacy->accessToken->token);
        $this->api('DELETE', '/devices/'.$other->accessToken->id, token: $plain)->assertNotFound();
        $this->api('DELETE', '/devices/'.$legacy->accessToken->id, token: $plain)->assertNotFound();
        $this->api('DELETE', '/devices/'.$response->json('data.0.id'), token: $plain)->assertNoContent();
        $this->api('GET', '/me', token: $plain)->assertUnauthorized();
        $this->assertNotNull(PersonalAccessToken::findToken($other->plainTextToken));
    }

    public function test_login_is_rate_limited_without_issuing_tokens(): void
    {
        $user = User::factory()->create();
        for ($i = 0; $i < 5; $i++) {
            $this->api('POST', '/login', $this->credentials($user, ['password' => 'wrong']))->assertUnprocessable();
        }
        $this->api('POST', '/login', $this->credentials($user))->assertStatus(429)->assertHeader('Retry-After');
        $this->assertDatabaseCount('personal_access_tokens', 0);
    }

    private function enableTwoFactor(User $user): void
    {
        $user->forceFill(['two_factor_secret' => Fortify::currentEncrypter()->encrypt('fixture-secret'),
            'two_factor_confirmed_at' => now(),
            'two_factor_recovery_codes' => Fortify::currentEncrypter()->encrypt(json_encode(['recovery-fixture']))])->save();
    }

    public function test_two_factor_cannot_be_bypassed_with_password_only(): void
    {
        $user = User::factory()->create();
        $this->enableTwoFactor($user);
        $this->api('POST', '/login', $this->credentials($user))->assertUnprocessable()->assertJsonValidationErrors('code');
        $this->assertDatabaseCount('personal_access_tokens', 0);
    }

    public function test_two_factor_uses_existing_provider_and_rejects_invalid_codes(): void
    {
        $user = User::factory()->create();
        $this->enableTwoFactor($user);
        $provider = Mockery::mock(TwoFactorAuthenticationProvider::class);
        $provider->shouldReceive('verify')->with('fixture-secret', '111111')->once()->andReturn(false);
        $provider->shouldReceive('verify')->with('fixture-secret', '123456')->once()->andReturn(true);
        $this->app->instance(TwoFactorAuthenticationProvider::class, $provider);
        $this->api('POST', '/login', $this->credentials($user, ['code' => '111111']))->assertUnprocessable();
        $this->api('POST', '/login', $this->credentials($user, ['code' => '123456']))->assertOk();
        $this->assertSame(1, $user->tokens()->count());
    }

    public function test_recovery_code_can_only_be_consumed_once(): void
    {
        $user = User::factory()->create();
        $this->enableTwoFactor($user);
        $data = $this->credentials($user, ['recovery_code' => 'recovery-fixture']);
        $this->api('POST', '/login', $data)->assertOk();
        $this->api('POST', '/login', $data)->assertUnprocessable()->assertJsonValidationErrors('code');
        $this->assertNotContains('recovery-fixture', $user->fresh()->recoveryCodes());
        $this->assertSame(1, $user->tokens()->count());
    }

    public function test_device_cap_does_not_delete_active_tokens_and_expired_slots_can_be_reused(): void
    {
        $user = User::factory()->create();
        for ($i = 0; $i < 20; $i++) {
            $user->createToken('mobile:Phone '.$i, ['mobile:account'], now()->addDay());
        }
        $this->api('POST', '/login', $this->credentials($user))->assertUnprocessable()->assertJsonValidationErrors('device_name');
        $this->assertSame(20, $user->tokens()->count());
        $user->tokens()->first()->update(['expires_at' => now()->subMinute()]);
        $this->api('POST', '/login', $this->credentials($user))->assertOk();
        $this->assertSame(20, $user->tokens()->count());
    }

    public function test_email_resend_is_authenticated_limited_and_does_not_mark_verified(): void
    {
        $user = User::factory()->unverified()->create();
        $plain = $user->createToken('mobile:Phone', ['mobile:account'], now()->addDay())->plainTextToken;
        $this->api('POST', '/email/verification-notification')->assertUnauthorized();
        $this->api('POST', '/email/verification-notification', token: $plain)->assertStatus(202);
        $this->api('POST', '/email/verification-notification', token: $plain)->assertStatus(429);
        $this->assertNull($user->fresh()->email_verified_at);
        Notification::assertSentTo($user, VerifyEmail::class);
    }

    public function test_mobile_token_cannot_authenticate_web_seller_routes(): void
    {
        $user = User::factory()->create();
        $plain = $user->createToken('mobile:Phone', ['mobile:account'], now()->addDay())->plainTextToken;
        $this->get('/shop/edit', ['Authorization' => 'Bearer '.$plain])->assertRedirect(route('login'));
    }
}
