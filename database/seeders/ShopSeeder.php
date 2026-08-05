<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => 'murwaj',
            'name_ar' => 'مُروَّج.كم',
            'slug' => 'murwaj',
            'description' => 'Official murwaj Marketplace Store.',
            'logo' => 'shop-suggest/logo.png',
            'banner' => 'shop-suggest/cover.jpg',
            'type' => 'freelance',
            'country_id' => '1',
            'state_id' => '1',
            'city_id' => '4',
            'location' => 'Dubai,UAE',
            'currency' => 'AED',
            'section_id' => '1',
            'rating' => '4.5',
            'published_at' => now(),
            'is_active' => true,
            // Verification
            'verified' => true,
            'verified_at' => now(),
            'verified_by' => 1,
            'user_id' => '1',
            'whatsapp' => '+971559650283',
        ];
        DB::table('shops')->insert($data);
    }
}
