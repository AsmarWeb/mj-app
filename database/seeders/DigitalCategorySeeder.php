<?php

namespace Database\Seeders;

use App\Models\DigitalCategory;
use Illuminate\Database\Seeder;

class DigitalCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $digitalCategoryRecords = [

            [
                'id' => 1,
                'code' => 'D101',
                'bg_color' => '#6366F1',
                'category_name_ar' => 'الخطوط',
                'category_name' => 'Fonts',
                'slug' => 'fonts',
                'image' => 'fonts.png',
                'status' => 'active',
            ],

            [
                'id' => 2,
                'code' => 'D102',
                'bg_color' => '#8B5CF6',
                'category_name_ar' => 'القوالب',
                'category_name' => 'Templates',
                'slug' => 'templates',
                'image' => 'templates.png',
                'status' => 'active',
            ],

            [
                'id' => 3,
                'code' => 'D103',
                'bg_color' => '#EC4899',
                'category_name_ar' => 'الرسومات',
                'category_name' => 'Graphics',
                'slug' => 'graphics',
                'image' => 'graphics.png',
                'status' => 'active',
            ],

            [
                'id' => 4,
                'code' => 'D104',
                'bg_color' => '#F97316',
                'category_name_ar' => 'الأيقونات',
                'category_name' => 'Icons',
                'slug' => 'icons',
                'image' => 'icons.png',
                'status' => 'active',
            ],

            [
                'id' => 5,
                'code' => 'D105',
                'bg_color' => '#14B8A6',
                'category_name_ar' => 'النماذج',
                'category_name' => 'Mockups',
                'slug' => 'mockups',
                'image' => 'mockups.png',
                'status' => 'active',
            ],

            [
                'id' => 6,
                'code' => 'D106',
                'bg_color' => '#0EA5E9',
                'category_name_ar' => 'واجهات المستخدم',
                'category_name' => 'UI Kits',
                'slug' => 'ui-kits',
                'image' => 'ui-kits.png',
                'status' => 'active',
            ],

            [
                'id' => 7,
                'code' => 'D107',
                'bg_color' => '#10B981',
                'category_name_ar' => 'تصاميم الويب',
                'category_name' => 'Website Themes',
                'slug' => 'website-themes',
                'image' => 'website-themes.png',
                'status' => 'active',
            ],

            [
                'id' => 8,
                'code' => 'D108',
                'bg_color' => '#F59E0B',
                'category_name_ar' => 'قوالب العرض',
                'category_name' => 'Presentations',
                'slug' => 'presentations',
                'image' => 'presentations.png',
                'status' => 'active',
            ],

            [
                'id' => 9,
                'code' => 'D109',
                'bg_color' => '#EF4444',
                'category_name_ar' => 'الصور',
                'category_name' => 'Photos',
                'slug' => 'photos',
                'image' => 'photos.png',
                'status' => 'active',
            ],

            [
                'id' => 10,
                'code' => 'D110',
                'bg_color' => '#3B82F6',
                'category_name_ar' => 'الرسوم التوضيحية',
                'category_name' => 'Illustrations',
                'slug' => 'illustrations',
                'image' => 'illustrations.png',
                'status' => 'active',
            ],

            [
                'id' => 11,
                'code' => 'D111',
                'bg_color' => '#7C3AED',
                'category_name_ar' => 'النماذج ثلاثية الأبعاد',
                'category_name' => '3D Assets',
                'slug' => '3d-assets',
                'image' => '3d-assets.png',
                'status' => 'active',
            ],

            [
                'id' => 12,
                'code' => 'D112',
                'bg_color' => '#06B6D4',
                'category_name_ar' => 'الفيديو',
                'category_name' => 'Video',
                'slug' => 'video',
                'image' => 'video.png',
                'status' => 'active',
            ],

            [
                'id' => 13,
                'code' => 'D113',
                'bg_color' => '#22C55E',
                'category_name_ar' => 'الصوت',
                'category_name' => 'Audio',
                'slug' => 'audio',
                'image' => 'audio.png',
                'status' => 'active',
            ],

            [
                'id' => 14,
                'code' => 'D114',
                'bg_color' => '#F43F5E',
                'category_name_ar' => 'الكتب الإلكترونية',
                'category_name' => 'eBooks',
                'slug' => 'ebooks',
                'image' => 'ebooks.png',
                'status' => 'active',
            ],

            [
                'id' => 15,
                'code' => 'D115',
                'bg_color' => '#0F766E',
                'category_name_ar' => 'فريمر',
                'category_name' => 'Framer Templates',
                'slug' => 'framer-templates',
                'image' => 'framer.png',
                'status' => 'active',
            ],

            [
                'id' => 16,
                'code' => 'D116',
                'bg_color' => '#EA580C',
                'category_name_ar' => 'فيجما',
                'category_name' => 'Figma UI Kits',
                'slug' => 'figma-ui-kits',
                'image' => 'figma.png',
                'status' => 'active',
            ],

            [
                'id' => 17,
                'code' => 'D117',
                'bg_color' => '#2563EB',
                'category_name_ar' => 'كانفا',
                'category_name' => 'Canva Templates',
                'slug' => 'canva-templates',
                'image' => 'canva.png',
                'status' => 'active',
            ],

        ];

        DigitalCategory::insert($digitalCategoryRecords);
    }
}
