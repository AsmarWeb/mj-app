<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategoryRecords = [
            ['id' => 1,  'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name' => 'Audio',                   'subcategory_name_ar' => 'الصوتيات',       'slug' => 'audio', 'status' => 'active'],
            ['id' => 2,  'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name' => 'TV & Video',              'subcategory_name_ar' => 'التلفزيون والفيديو',       'slug' => 'tv & video', 'status' => 'active'],
            ['id' => 3,  'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name' => 'Batteries & Charging',    'subcategory_name_ar' => 'البطاريات والشحن',       'slug' => 'batteries & charging', 'status' => 'active'],
            ['id' => 4,  'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name' => 'Cables & Cords',          'subcategory_name_ar' => 'الكابلات والأسلاك',       'slug' => 'cables & cords', 'status' => 'active'],
            ['id' => 5,  'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name' => 'Cameras & Equipment',     'subcategory_name_ar' => 'الكاميرات والمعدات',       'slug' => 'cameras & equipment', 'status' => 'active'],
            ['id' => 6,  'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name' => 'Car Parts & Accessories', 'subcategory_name_ar' => 'قطع غيار السيارات وملحقاتها',       'slug' => 'car parts & accessories', 'status' => 'active'],
            ['id' => 7,  'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name' => 'Cell Phone Accessories',  'subcategory_name_ar' => 'ملحقات الهاتف الخليوي',       'slug' => 'cell phone accessories', 'status' => 'active'],
            ['id' => 8,  'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name' => 'Computers & Peripherals', 'subcategory_name_ar' => 'أجهزة الكمبيوتر والأجهزة الطرفية',       'slug' => 'computers & peripherals', 'status' => 'active'],
            ['id' => 9,  'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name' => 'Telephones & Handsets',   'subcategory_name_ar' => 'الهواتف',       'slug' => 'telephones & handsets', 'status' => 'active'],
            ['id' => 10, 'category_id' => 1, 'category_name' => 'Electronics',  'subcategory_name' => 'Gadgets',                 'subcategory_name_ar' => 'الأدوات',       'slug' => 'gadgets', 'status' => 'active'],

            // Local & Traditional Products in UAE
            ['id' => 11, 'category_id' => 2, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Dates & Date Products', 'subcategory_name_ar' => 'التمور ومنتجاتها', 'slug' => 'dates-date-products', 'status' => 'active'],
            ['id' => 12, 'category_id' => 2, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Arabic Sweets & Desserts', 'subcategory_name_ar' => 'الحلويات العربية', 'slug' => 'arabic-sweets-desserts', 'status' => 'active'],
            ['id' => 13, 'category_id' => 2, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Honey & Natural Products', 'subcategory_name_ar' => 'العسل والمنتجات الطبيعية', 'slug' => 'honey-natural-products', 'status' => 'active'],
            ['id' => 14, 'category_id' => 2, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Spices & Traditional Ingredients', 'subcategory_name_ar' => 'التوابل والمكونات التقليدية', 'slug' => 'spices-traditional-ingredients', 'status' => 'active'],
            ['id' => 15, 'category_id' => 2, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Arabic Coffee & Tea', 'subcategory_name_ar' => 'القهوة والشاي العربي', 'slug' => 'arabic-coffee-tea', 'status' => 'active'],
            ['id' => 16, 'category_id' => 2, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Traditional Clothing', 'subcategory_name_ar' => 'الملابس التقليدية', 'slug' => 'traditional-clothing', 'status' => 'active'],
            ['id' => 17, 'category_id' => 2, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Perfumes & Oud', 'subcategory_name_ar' => 'العطور والعود', 'slug' => 'perfumes-oud', 'status' => 'active'],
            ['id' => 18, 'category_id' => 2, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Bakhoor & Incense', 'subcategory_name_ar' => 'البخور والعود المعطر', 'slug' => 'bakhoor-incense', 'status' => 'active'],
            ['id' => 19, 'category_id' => 2, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Traditional Handicrafts', 'subcategory_name_ar' => 'الحرف اليدوية التقليدية', 'slug' => 'traditional-handicrafts', 'status' => 'active'],
            ['id' => 20, 'category_id' => 2, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Pottery & Ceramics', 'subcategory_name_ar' => 'الفخار والسيراميك', 'slug' => 'pottery-ceramics', 'status' => 'active'],
            ['id' => 21, 'category_id' => 2, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Palm & Date Palm Products', 'subcategory_name_ar' => 'منتجات النخيل وسعف النخيل', 'slug' => 'palm-date-palm-products', 'status' => 'active'],
            ['id' => 22, 'category_id' => 2, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Traditional Home Décor', 'subcategory_name_ar' => 'الديكور المنزلي التقليدي', 'slug' => 'traditional-home-decor', 'status' => 'active'],
            ['id' => 23, 'category_id' => 2, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'UAE Souvenirs & Gifts', 'subcategory_name_ar' => 'الهدايا والتذكارات الإماراتية', 'slug' => 'uae-souvenirs-gifts', 'status' => 'active'],
            ['id' => 24, 'category_id' => 2, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Traditional Accessories & Jewelry', 'subcategory_name_ar' => 'الإكسسوارات والمجوهرات التقليدية', 'slug' => 'traditional-accessories-jewelry', 'status' => 'active'],
         ];
        SubCategory::insert($subcategoryRecords);
    }
}
