<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
    'parent_id' => null,

    'name' => 'About Us',
    'slug' => 'about',

    'title' => 'About murwaj.com',
    'title_ar' => 'نبذة عن مُروَّج.كم',

    'subtitle' => 'Our mission',
    'subtitle_ar' => 'مهمتنا',

    'short_des' => 'murwaj.com For Online Selling, to help your business grow through digital marketing.',

    'short_des_ar' => 'مروج.كوم للبيع عبر الإنترنت
، لمساعدة أعمالك على النمو من خلال التسويق الرقمي.',

    'content' => 'Our mission is to provide the most effective digital marketing solutions in the industry, focusing on a high-touch customer experience that delivers results so we can use our profits to reinvest in the success of our clients, our team, and our community.',

    'content_ar' => 'نحن نقدم حلول التسويق الرقمي الأكثر فعالية في هذا المجال، مع التركيز على تجربة العملاء عالية اللمس التي تحقق النتائج حتى نتمكن من استخدام أرباحنا لإعادة الاستثمار في نجاح عملائنا وفريقنا ومجتمعنا.',


    // Page settings
    'template' => 'default',

    'status' => 'published',

    'published_at' => Carbon::now(),

    'sort_order' => 1,


    // Image
    'image' => null,

    'image_alt' => 'About murwaj.com',


    // URL
    'url' => '/about',


    // SEO
    'meta_title' => 'About Us | murwaj',

    'meta_keywords' => 'murwaj.com, digital marketing, advertising, online marketing, business growth',

    'meta_description' => 'murwaj is an advertising group helping businesses grow through digital marketing.',


    // Audit
    'created_by' => 'murwaj is lovingly made possible',

    'created_by_ar' => 'لقد أصبح مُروَّج.كم ممكنًا بكل محبة',

    'developer' => 'murwaj dev',


    'created_at' => Carbon::now(),

    'updated_at' => Carbon::now(),
];
        DB::table('pages')->insert($data);
    }
}
