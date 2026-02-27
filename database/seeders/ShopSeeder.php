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
            'name' => "Murwaj",
            'slug' => "murwaj",
            'type' => "freelance",
            'phone' => "0555555555",
            'email' => "murwaj@example.com",
            'location' => "Dubai,UAE",
            'image' => "murwaj.jpg",
            'published_at' => "2024-07-17 12:36:30",
            'user_id' => "1",
        );
        DB::table('shops')->insert($data);
    }
}
