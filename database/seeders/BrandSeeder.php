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
            ['id' => 1, 'subcategory_id' => 9, 'subcategory_name' => 'Telephones & Handsets',  'brand_name'  => 'Apple',      'brand_name_ar' => 'أبل',  'slug' => 'apple',     'status' => 'active'],
            ['id' => 2, 'subcategory_id' => 6, 'subcategory_name' => 'Car Parts & Accessories', 'brand_name'   => 'BMW',       'brand_name_ar' => 'بي ام دبليو', 'slug' => 'bmw',      'status' => 'active'],
            ['id' => 3, 'subcategory_id' => 9, 'subcategory_name' => 'Telephones & Handsets', 'brand_name'   => 'Samsung',    'brand_name_ar' => 'سمسونج',  'slug' => 'samsung',     'status' => 'active'],
        ];
        Brand::insert($brandRecords);
    }
}
