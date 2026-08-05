<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryRecords = [
            ['id' => 1, 'code' => '121', 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sales', 'bg_color' => '#28a745', 'category_name_ar' => 'إلكترونيات',           'category_name' => 'Electronics',              'slug' => 'electronics',                                       'image' => 'electronics.png',                       'status' => 'active'],
            ['id' => 2, 'code' => '122', 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sales', 'bg_color' => '#dc3545', 'category_name_ar' => 'أثاث المنزل والمعيشة', 'category_name' => 'Home & Living',            'slug' => 'home & living',                                     'image' => 'furniture.png',                       'status' => 'active'],
            ['id' => 3, 'code' => '123', 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sales', 'bg_color' => '#dc3545', 'category_name_ar' => 'الطبخ',                'category_name' => 'Cooking',                  'slug' => 'cooking',                                           'image' => 'food.png',                       'status' => 'active'],
            ['id' => 4, 'code' => '124', 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sales', 'bg_color' => '#28a745', 'category_name_ar' => 'الموضة',               'category_name' => 'Fashion',                  'slug' => 'fashion',                                           'image' => 'fashion.png',                       'status' => 'active'],
            ['id' => 5, 'code' => '125', 'parent_id' => 0, 'section_id' => 3, 'section_name' => 'Booking', 'bg_color' => '#28a745', 'category_name_ar' => 'السفر والسياحة',       'category_name' => 'Travel & Outdoor',         'slug' => 'travel & outdoor',                                'image' => '',                       'status' => 'active'],
            ['id' => 6, 'code' => '126', 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sales', 'bg_color' => '#28a745', 'category_name_ar' => 'الأحذية والجزم',        'category_name' => 'Shoes & Boots',            'slug' => 'shoes & boots',                                     'image' => '',                       'status' => 'active'],
            ['id' => 7, 'code' => '127', 'parent_id' => 0, 'section_id' => 3, 'section_name' => 'Real Estate', 'bg_color' => '#e69721', 'category_name_ar' => 'العقارات',             'category_name' => 'Properties',               'slug' => 'properties',                                       'image' => 'properties.png',                       'status' => 'active'],
            ['id' => 8, 'code' => '128', 'parent_id' => 0, 'section_id' => 2, 'section_name' => 'Rental', 'bg_color' => '#28a745', 'category_name_ar' => 'السيارات',             'category_name' => 'Automobile',               'slug' => 'automobile',                                       'image' => 'automobile.png',                       'status' => 'active'],
            ['id' => 9, 'code' => '129', 'parent_id' => 0, 'section_id' => 3, 'section_name' => 'Booking', 'bg_color' => '#28a745', 'category_name_ar' => 'الضيافة',              'category_name' => 'Hospitality',              'slug' => 'hospitality',                                     'image' => 'hospitality.png',                       'status' => 'active'],
            ['id' => 10, 'code' => '110', 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sales', 'bg_color' => '#28a745', 'category_name_ar' => 'التعليم',              'category_name' => 'Education',                'slug' => 'education',                                        'image' => 'education.png',                       'status' => 'active'],
            ['id' => 11, 'code' => '111', 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sales', 'bg_color' => '#982fd5', 'category_name_ar' => 'البرمجيات',            'category_name' => 'Software',                 'slug' => 'software',                                         'image' => 'software.png',                       'status' => 'active'],
            ['id' => 12, 'code' => '112', 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sales', 'bg_color' => '#28a745', 'category_name_ar' => 'الخدمات',              'category_name' => 'Services',                 'slug' => 'services',                                         'image' => 'services.png',                       'status' => 'active'],
            ['id' => 13, 'code' => '113', 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sales', 'bg_color' => '#982fd5', 'category_name_ar' => 'الملحقات',             'category_name' => 'Accessories',              'slug' => 'accessories',                                      'image' => 'jewellery.png',                       'status' => 'active'],
            ['id' => 14, 'code' => '114', 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sales', 'bg_color' => '#28a745', 'category_name_ar' => 'الفن والمقتنيات',      'category_name' => 'Art & Collectibles',       'slug' => 'art & collectibles',                               'image' => '',                       'status' => 'active'],
            ['id' => 15, 'code' => '115', 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sales', 'bg_color' => '#e69721', 'category_name_ar' => 'الهدايا',              'category_name' => 'Gifts',                    'slug' => 'gifts',                                            'image' => '',                       'status' => 'active'],
            ['id' => 16, 'code' => '116', 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sales', 'bg_color' => '#28a745', 'category_name_ar' => 'الكتب والأفلام والموسيقى', 'category_name' => 'Books, Movies & Music',    'slug' => 'books, movies & music',                          'image' => 'musics.png',                       'status' => 'active'],
            ['id' => 17, 'code' => '117', 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sales', 'bg_color' => '#982fd5', 'category_name_ar' => 'لوازم الورق والحفلات',  'category_name' => 'Paper & Party Supplies',   'slug' => 'paper & party supplies',                           'image' => '',                       'status' => 'active'],
        ];
        Category::insert($categoryRecords);
    }
}
