<?php

namespace Tests\Feature;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_step_four_marks_the_shop_as_completed_and_redirects_to_the_shop_preview(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('shop.store', 4), []);

        $response->assertRedirect(route('shop'));

        $shop = $user->fresh()->shop;
        $this->assertNotNull($shop);
        $this->assertTrue($shop->is_completed);
    }
}
