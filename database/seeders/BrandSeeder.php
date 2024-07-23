<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brandRecords = [
            ['id' => 1, 'brand_name'  => 'Apple',      'brand_name_ar' => 'أبل',  'slug' => 'apple',     'status' => 'active'],
            ['id' => 2, 'brand_name'   => 'BMW',       'brand_name_ar' => 'بي ام دبليو', 'slug' => 'bmw',      'status' => 'active'],
            ['id' => 3, 'brand_name'   => 'Samsung',    'brand_name_ar' => 'سمسونج',  'slug' => 'samsung',     'status' => 'active'],
        ];
        Brand::insert($brandRecords);
    }
}
