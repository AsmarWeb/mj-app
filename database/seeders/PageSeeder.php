<?php

namespace Database\Seeders;

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
        $data = array(
            'name' => "About Us",
            'title' => "About murwaj.com",
            'title_ar' => "نبذة عن مُروَّج.كم",
            'subtitle' => "Our mission",
            'subtitle_ar' => "مهمتنا",
            'slug' => "about",
            'short_des' => "murwaj is an advertising group, to help your
                            business grow through digital marketing.",
            'short_des_ar' => ".مُروَّج.كم هي مجموعة إعلانية، لمساعدة أعمالك على النمو من خلال التسويق الرقمي",
            'content' => "Is to provide the most effective digital marketing solutions in the industry,
                            focusing on a high-touch customer experience that delivers results so we can use our profits
                            to reinvest in the success of our clients, our team, and our community.",
            'content_ar' => ".نحن نقدم حلول التسويق الرقمي الأكثر فعالية في هذا المجال، مع التركيز على تجربة العملاء عالية اللمس التي تحقق النتائج حتى نتمكن من استخدام أرباحنا لإعادة الاستثمار في نجاح عملائنا وفريقنا ومجتمعنا",
            'created_by' => "murwaj is lovingly made possible",
            'created_by_ar' => "لقد أصبح مُروَّج.كم ممكنًا بكل محبة",
            'developer' => "murwaj dev",
            'image' => "",
            'url' => "#",
            'meta_title' => "About Us",
            'meta_keywords' => "murwaj.com. buy electronics, computers, apparel, fashion accessories, shoes, watches, furniture, home and kitchen goods, beauty, personal care, grocery, gourmet food.",
            'meta_description' => "murwaj is an advertising group, to help your business grow through digital marketing.",
        );
        DB::table('pages')->insert($data);
    }
}
