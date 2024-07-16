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
            'location' => "Dubai,UAE",
            'user_id' => "1",
        );
        DB::table('shops')->insert($data);
    }
}
