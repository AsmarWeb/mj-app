<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_step_four_marks_the_shop_as_completed_and_redirects_to_the_shop_preview(): void
    {
        $user = User::factory()->create();

        $user->forceFill(['phone_verified_at' => now()])->save();
        Role::firstOrCreate(['name' => 'seller'], ['display_name' => 'Seller']);
        $this->actingAs($user);

        $response = $this->post(route('shop.store', 4), []);

        $response->assertRedirect(route('shop', $user->fresh()->shop->slug));

        $shop = $user->fresh()->shop;
        $this->assertNotNull($shop);
        $this->assertTrue((bool) $shop->is_completed);
        $this->assertSame(1, $shop->wallet()->count());
    }
}
