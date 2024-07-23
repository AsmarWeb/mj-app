<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryRecords = [
            ['id' => 1, 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sale', 'bg_color' => '#28a745', 'category_name_ar' => 'إلكترونيات', 'category_name' => 'Electronics',              'slug' => 'electronics',                                       'image' => '', 'cover' => '', 'status' => 'active'],
            ['id' => 2, 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sale', 'bg_color' => '#dc3545', 'category_name_ar' => 'أثاث المنزل والمعيشة', 'category_name' => 'Home & Living',            'slug' => 'home & living',                           'image' => '', 'cover' => '', 'status' => 'active'],
            ['id' => 3, 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sale', 'bg_color' => '#dc3545', 'category_name_ar' => 'الطبخ', 'category_name' => 'Cooking',                  'slug' => 'cooking',                                                'image' => '', 'cover' => '', 'status' => 'active'],
            ['id' => 4, 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sale', 'bg_color' => '#28a745', 'category_name_ar' => 'الموضة', 'category_name' => 'Fashion',                  'slug' => 'fashion',                                               'image' => '', 'cover' => '', 'status' => 'active'],
            ['id' => 5, 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sale', 'bg_color' => '#28a745', 'category_name_ar' => 'السفر والسياحة', 'category_name' => 'Travel & Outdoor',         'slug' => 'travel & outdoor',                              'image' => '', 'cover' => '', 'status' => 'active'],
            ['id' => 6, 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sale', 'bg_color' => '#28a745', 'category_name_ar' => 'الأحذية والجزم', 'category_name' => 'Shoes & Boots',            'slug' => 'shoes & boots',                                  'image' => '', 'cover' => '', 'status' => 'active'],
            ['id' => 7, 'parent_id' => 0, 'section_id' => 2, 'section_name' => 'Rent', 'bg_color' => '#e69721', 'category_name_ar' => 'العقارات', 'category_name' => 'Properties',               'slug' => 'properties',                                          'image' => '', 'cover' => '', 'status' => 'active'],
            ['id' => 8, 'parent_id' => 0, 'section_id' => 2, 'section_name' => 'Rent', 'bg_color' => '#28a745', 'category_name_ar' => 'السيارات', 'category_name' => 'Automobile',               'slug' => 'automobile',                                          'image' => '', 'cover' => '', 'status' => 'active'],
            ['id' => 9, 'parent_id' => 0, 'section_id' => 3, 'section_name' => 'Booking', 'bg_color' => '#28a745', 'category_name_ar' => 'الضيافة', 'category_name' => 'Hospitality',              'slug' => 'hospitality',                                          'image' => '', 'cover' => '', 'status' => 'active'],
            ['id' => 10, 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sale', 'bg_color' => '#28a745', 'category_name_ar' => 'التعليم', 'category_name' => 'Education',                'slug' => 'education',                                            'image' => '', 'cover' => '', 'status' => 'active'],
            ['id' => 11, 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sale', 'bg_color' => '#982fd5', 'category_name_ar' => 'البرمجيات', 'category_name' => 'Software',                 'slug' => 'software',                                           'image' => '', 'cover' => '', 'status' => 'active'],
            ['id' => 12, 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sale', 'bg_color' => '#28a745', 'category_name_ar' => 'الخدمات', 'category_name' => 'Services',                 'slug' => 'services',                                             'image' => '', 'cover' => '', 'status' => 'active'],
            ['id' => 13, 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sale', 'bg_color' => '#982fd5', 'category_name_ar' => 'الملحقات', 'category_name' => 'Accessories',              'slug' => 'accessories',                                         'image' => '', 'cover' => '', 'status' => 'active'],
            ['id' => 14, 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sale', 'bg_color' => '#28a745', 'category_name_ar' => 'الفن والمقتنيات', 'category_name' => 'Art & Collectibles',       'slug' => 'art & collectibles',                           'image' => '', 'cover' => '', 'status' => 'active'],
            ['id' => 15, 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sale', 'bg_color' => '#e69721', 'category_name_ar' => 'الهدايا', 'category_name' => 'Gifts',                    'slug' => 'gifts',                                                'image' => '', 'cover' => '', 'status' => 'active'],
            ['id' => 16, 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sale', 'bg_color' => '#28a745', 'category_name_ar' => 'الكتب والأفلام والموسيقى', 'category_name' => 'Books, Movies & Music',    'slug' => 'books, movies & music',                 'image' => '', 'cover' => '', 'status' => 'active'],
            ['id' => 17, 'parent_id' => 0, 'section_id' => 1, 'section_name' => 'Sale', 'bg_color' => '#982fd5', 'category_name_ar' => 'لوازم الورق والحفلات', 'category_name' => 'Paper & Party Supplies',   'slug' => 'paper & party supplies',                   'image' => '', 'cover' => '', 'status' => 'active'],
        ];


        Category::insert($categoryRecords);
    }
}
