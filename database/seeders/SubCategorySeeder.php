<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategoryRecords = [
            ['id' => 1, 'subcategory_name'  => 'Telephones & Handsets',      'subcategory_name_ar' => 'تليفون',         'slug' => 'telephones & handsets',    'category_id' => '1', 'category_name' => 'Electronics',    'status' => 'active'],
            ['id' => 2, 'subcategory_name'   => 'Cleaning Supplies',       'subcategory_name_ar' => ' منظفات ',         'slug' => 'cleaning supplies',        'category_id' => '8', 'category_name' => 'Automobile', 'status' => 'active'],
            ['id' => 3, 'subcategory_name'   => 'Girls Room',   'subcategory_name_ar' => 'غرفة فتيات',                  'slug' => 'girls room',               'category_id' => '7',  'category_name' => 'Properties', 'status' => 'active'],
        ];
        SubCategory::insert($subcategoryRecords);
    }
}
