<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::firstOrCreate(['slug' => 'free'], [
            'name' => 'Free',
            'price' => 0,

            'stripe_price' => null,

            'listing_limit' => 5,
            'listing_duration' => 30,
            'order_limit' => 5,
            'storage_limit' => 100,

            'custom_domain' => false,
            'mobile_app' => false,

            'is_active' => true,
            'is_free' => true,
            'billing_period' => 'monthly',
        ]);

        Plan::firstOrCreate(['slug' => 'basic'], [
            'name' => 'Basic',
            'price' => 9.99,

            'stripe_price' => config('membership.basic_price'),

            'listing_limit' => 50,
            'listing_duration' => 60,
            'order_limit' => 100,
            'storage_limit' => 5000,

            'custom_domain' => false,
            'mobile_app' => false,

            'is_active' => true,
            'is_free' => false,
            'billing_period' => 'monthly',
        ]);

        Plan::firstOrCreate(['slug' => 'pro'], [
            'name' => 'Pro',
            'price' => 29.99,

            'stripe_price' => config('membership.pro_price'),

            'listing_limit' => 500,
            'listing_duration' => 90,
            'order_limit' => 1000,
            'storage_limit' => 20000,

            'custom_domain' => true,
            'mobile_app' => true,

            'is_active' => true,
            'is_free' => false,
            'billing_period' => 'monthly',
        ]);

    }
}
