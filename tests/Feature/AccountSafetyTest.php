<?php

namespace Tests\Feature;

use App\Models\Shop;
use App\Models\User;
use App\Services\PhoneVerification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mockery;
use Tests\TestCase;

class AccountSafetyTest extends TestCase
{
    use RefreshDatabase;

    private function user(): User
    {
        $user = User::factory()->create();
        $user->forceFill(['phone' => '+971501234567', 'phone_verified_at' => now()])->save();

        return $user;
    }

    public function test_guests_are_redirected_before_reading_notifications(): void
    {
        $this->get('/notifications/'.Str::uuid())->assertRedirect(route('login'));
    }

    public function test_only_the_owner_can_read_a_notification(): void
    {
        $owner = $this->user();
        $other = User::factory()->create();
        $id = (string) Str::uuid();
        DB::table('notifications')->insert([
            'id' => $id, 'type' => 'test', 'notifiable_type' => $owner->getMorphClass(),
            'notifiable_id' => $owner->id, 'data' => json_encode(['url' => '/profile']),
            'created_at' => now(), 'updated_at' => now(),
        ]);

        $this->actingAs($other)->get('/notifications/'.$id)->assertNotFound();
        $this->assertNull(DB::table('notifications')->where('id', $id)->value('read_at'));
        $this->actingAs($owner)->get('/notifications/'.$id)->assertRedirect('/profile');
        $this->assertNotNull(DB::table('notifications')->where('id', $id)->value('read_at'));
    }

    private function shop(User $user): Shop
    {
        Storage::fake('public');
        Storage::disk('public')->put('shop-suggest/old.png', 'old logo');

        return Shop::create([
            'user_id' => $user->id, 'name' => 'Test shop', 'name_ar' => 'متجر تجريبي', 'currency' => 'AED',
            'type' => 'local', 'logo' => 'shop-suggest/old.png',
        ]);
    }

    private function shopInput(): array
    {
        return ['name' => 'Updated shop', 'type' => 'local', 'currency' => 'AED'];
    }

    public function test_replacing_logo_persists_new_path_before_deleting_old_image(): void
    {
        $user = $this->user();
        $shop = $this->shop($user);
        $this->actingAs($user)->put(route('shop.update'), $this->shopInput() + [
            'logo' => UploadedFile::fake()->image('replacement.png'),
        ])->assertRedirect(route('shop.edit'))->assertSessionHasNoErrors();

        $path = $shop->fresh()->logo;
        $this->assertNotSame('shop-suggest/old.png', $path);
        Storage::disk('public')->assertExists($path);
        Storage::disk('public')->assertMissing('shop-suggest/old.png');
    }

    public function test_updating_shop_without_upload_preserves_existing_logo(): void
    {
        $user = $this->user();
        $shop = $this->shop($user);
        $this->actingAs($user)->put(route('shop.update'), $this->shopInput())
            ->assertRedirect(route('shop.edit'))->assertSessionHasNoErrors();
        $this->assertSame('shop-suggest/old.png', $shop->fresh()->logo);
        Storage::disk('public')->assertExists('shop-suggest/old.png');
    }

    public function test_invalid_logo_does_not_delete_existing_image(): void
    {
        $user = $this->user();
        $shop = $this->shop($user);
        $this->actingAs($user)->put(route('shop.update'), $this->shopInput() + [
            'logo' => UploadedFile::fake()->create('document.pdf', 10, 'application/pdf'),
        ])->assertSessionHasErrors('logo');
        $this->assertSame('shop-suggest/old.png', $shop->fresh()->logo);
        Storage::disk('public')->assertExists('shop-suggest/old.png');
    }

    private function verification(): PhoneVerification
    {
        Cache::flush();
        $mock = Mockery::mock(PhoneVerification::class);
        $this->app->instance(PhoneVerification::class, $mock);

        return $mock;
    }

    public function test_sms_send_is_limited_per_account(): void
    {
        $mock = $this->verification();
        $mock->shouldReceive('send')->with('+971509876543')->times(3);
        $this->actingAs($this->user());
        for ($i = 0; $i < 3; $i++) {
            $this->post(route('phone.send'), ['phone' => '+971509876543'])->assertRedirect();
        }
        $this->post(route('phone.send'), ['phone' => '+971509876543'])
            ->assertStatus(429)->assertHeader('Retry-After');
    }

    public function test_verification_attempts_are_limited_per_account(): void
    {
        $mock = $this->verification();
        $mock->shouldReceive('approved')->with('+971501234567', '123456')->times(5)->andReturn(false);
        $this->actingAs($this->user());
        for ($i = 0; $i < 5; $i++) {
            $this->post(route('phone.check'), ['code' => '123456'])->assertSessionHasErrors('code');
        }
        $this->post(route('phone.check'), ['code' => '123456'])->assertStatus(429);
    }

    public function test_send_failure_exposes_no_provider_details_and_preserves_verified_phone(): void
    {
        $mock = $this->verification();
        $mock->shouldReceive('send')->once()->andThrow(new \RuntimeException('private-provider-details'));
        Log::shouldReceive('error')->once()->with('Phone verification send failed.', [
            'exception_type' => \RuntimeException::class,
        ]);
        $user = $this->user();
        $this->actingAs($user)->post(route('phone.send'), ['phone' => '+971509876543'])
            ->assertSessionHasErrors(['phone' => 'Unable to send a verification code. Please try again later.']);
        $this->assertSame('+971501234567', $user->fresh()->phone);
        $this->assertNotNull($user->fresh()->phone_verified_at);
    }

    public function test_successful_verification_marks_phone_verified(): void
    {
        $mock = $this->verification();
        $mock->shouldReceive('approved')->with('+971501234567', '123456')->once()->andReturn(true);
        $user = $this->user();
        $user->forceFill(['phone_verified_at' => null])->save();
        $this->actingAs($user)->post(route('phone.check'), ['code' => '123456'])
            ->assertRedirect(route('profile.show'));
        $this->assertNotNull($user->fresh()->phone_verified_at);
    }

    public function test_check_failure_exposes_no_provider_details(): void
    {
        $mock = $this->verification();
        $mock->shouldReceive('approved')->once()->andThrow(new \RuntimeException('private-provider-details'));
        Log::shouldReceive('error')->once()->with('Phone verification check failed.', [
            'exception_type' => \RuntimeException::class,
        ]);
        $this->actingAs($this->user())->post(route('phone.check'), ['code' => '123456'])
            ->assertSessionHasErrors(['code' => 'Verification failed. Please try again.']);
    }
}
