<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'name' => 'Free',
            'slug' => 'free',
            'price' => 0,

            'stripe_price' => null,

            'listing_limit' => 1,
            'order_limit' => 5,
            'storage_limit' => 100,

            'custom_domain' => false,
            'mobile_app' => false,

            'is_active' => true,
            'is_free' => true,
            'billing_period' => 'monthly',
        ]);


        Plan::create([
            'name' => 'Basic',
            'slug' => 'basic',
            'price' => 9.99,

            'stripe_price' => 'price_1Ttm9sBPzsfZpB0FoJvMz9aK',

            'listing_limit' => 50,
            'order_limit' => 100,
            'storage_limit' => 5000,

            'custom_domain' => false,
            'mobile_app' => false,

            'is_active' => true,
            'is_free' => false,
            'billing_period' => 'monthly',
        ]);


        Plan::create([
            'name' => 'Pro',
            'slug' => 'pro',
            'price' => 29.99,

            'stripe_price' => 'price_1TtmBhBPzsfZpB0Ffxy6hi5c',

            'listing_limit' => 500,
            'order_limit' => 1000,
            'storage_limit' => 20000,

            'custom_domain' => true,
            'mobile_app' => true,

            'is_active' => true,
            'is_free' => false,
            'billing_period' => 'monthly',
        ]);


        // Plan::create([
        //     'name' => 'Business Yearly',
        //     'slug' => 'business-yearly',
        //     'price' => 299.99,

        //     'stripe_price' => 'price_BUSINESS_YEARLY_FROM_STRIPE',

        //     'listing_limit' => 2000,
        //     'order_limit' => 5000,
        //     'storage_limit' => 100000,

        //     'custom_domain' => true,
        //     'mobile_app' => true,

        //     'is_active' => true,
        //     'is_free' => false,
        //     'billing_period' => 'yearly',
        // ]);
    }
}
