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
            'description' => "Platform where you can Buy and sell everything from used cars to mobile phones and computers.",
            'description_ar' => "منصة حيث يمكنك شراء وبيع كل شيء من السيارات المستعملة إلى الهواتف المحمولة وأجهزة الكمبيوتر",
            'short_des'   => "Notify me when App is launched :)",
            'short_des_ar'   => " (: أعلمني عندما يكون التطبيق جاهزا",
            'logo' => "logo.png",
            'favicon' => "favicon.png",
            'address' => "NO. 1 Deira - Dubai, UAE",
            'email'   => "info@murwaj.com",
            'phone'   => "+971 (56) 721-7510",
            'phone2'  => '+971 55 965 0283',
            'map' => "",
            'facebook' => "https://www.facebook.com/murwajcom",
            'instagram' => "https://www.instagram.com/murwajcom/",
            'telegram' => "https://t.me/+BGRZagAZaIZmY2Zk",
            'tiktok' => "https://www.tiktok.com/@murwajcom?is_from_webapp=1&sender_device=pc",
        );
        DB::table('settings')->insert($data);
    }
}
