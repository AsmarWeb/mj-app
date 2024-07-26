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
            ['id' => 1,  'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name'   => 'Audio',                   'subcategory_name_ar' => 'الصوتيات',       'slug' => 'audio', 'status' => 'active'],
            ['id' => 2,  'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name'   => 'TV & Video',              'subcategory_name_ar' => 'التلفزيون والفيديو',       'slug' => 'tv & video', 'status' => 'active'],
            ['id' => 3,  'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name'   => 'Batteries & Charging',    'subcategory_name_ar' => 'البطاريات والشحن',       'slug' => 'batteries & charging', 'status' => 'active'],
            ['id' => 4,  'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name'   => 'Cables & Cords',          'subcategory_name_ar' => 'الكابلات والأسلاك',       'slug' => 'cables & cords', 'status' => 'active'],
            ['id' => 5,  'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name'   => 'Cameras & Equipment',     'subcategory_name_ar' => 'الكاميرات والمعدات',       'slug' => 'cameras & equipment', 'status' => 'active'],
            ['id' => 6,  'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name'   => 'Car Parts & Accessories', 'subcategory_name_ar' => 'قطع غيار السيارات وملحقاتها',       'slug' => 'car parts & accessories', 'status' => 'active'],
            ['id' => 7,  'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name'   => 'Cell Phone Accessories',  'subcategory_name_ar' => 'ملحقات الهاتف الخليوي',       'slug' => 'cell phone accessories', 'status' => 'active'],
            ['id' => 8,  'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name'   => 'Computers & Peripherals', 'subcategory_name_ar' => 'أجهزة الكمبيوتر والأجهزة الطرفية',       'slug' => 'computers & peripherals', 'status' => 'active'],
            ['id' => 9,  'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name'   => 'Telephones & Handsets',   'subcategory_name_ar' => 'الهواتف',       'slug' => 'telephones & handsets', 'status' => 'active'],
            ['id' => 10,  'category_id' => 1, 'category_name' => 'Electronics', 'subcategory_name'   => 'Gadgets',                 'subcategory_name_ar' => 'الأدوات',       'slug' => 'gadgets', 'status' => 'active'],
        ];
        SubCategory::insert($subcategoryRecords);
    }
}
