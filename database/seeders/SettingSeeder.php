<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            'description' => "Platform where you can Get Found. Sell Smarter. Scale Your Creativity and Productivity.",
            'description_ar' => ".منصة تتيح لك الظهور والبيع بذكاء، وتنمية إبداعك وإنتاجيتك",
            'short_des'   => "Notify me when App is launched :)",
            'short_des_ar'   => " (: أعلمني عندما يكون التطبيق جاهزا",
            'logo' => "logo.png",
            'favicon' => "favicon.png",
            'address' => "NO. 1 Trade Center - Dubai, UAE",
            'email'   => "support@murwaj.com",
            'phone'   => "+971 (56) 721-7510",
            'phone2'  => '+971 55 965 0283',
            'map' => "",
            'facebook' => "https://www.facebook.com/murwajcom",
            'instagram' => "https://www.instagram.com/murwajcom/",
            'telegram' => "https://t.me/murwaj",
            'tiktok' => "https://www.tiktok.com/@murwajcom",
            'copyright' => "murwaj - Crafted with love and coffee in Dubai.",
            'copyright_ar' => "مُروَّج.كم - صُنع بحب وقهوة في دبي"
        ); 
        DB::table('settings')->insert($data);
    }
}
