<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            'name' => "murwaj",
            'slug' => "murwaj",
            'description' => "Murwaj Shop",
            'logo' => "shop-suggest/logo.png",
            'banner' => "shop-suggest/cover.jpg",
            'type' => "freelance",
            'country_id' => "1",
            'state_id' => "1",
            'city_id' => "1",
            'location' => "Dubai,UAE",
            'currency' => "AED",
            'section_id' => "1",
            'rating' => "4.5",
            'published_at' => "2024-07-17 12:36:30",
            'user_id' => "1",
        );
        DB::table('shops')->insert($data);
    }
}
