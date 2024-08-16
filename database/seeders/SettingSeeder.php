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
            'description' => "Platform to Buy and sell everything from used cars to mobile phones and computers.",
            'description_ar' => "منصة حيث يمكنك شراء وبيع كل شيء من السيارات المستعملة إلى الهواتف المحمولة وأجهزة الكمبيوتر",
            'short_des'   => "Notify me when App is launched :)",
            'short_des_ar'   => " (: أعلمني عندما يكون التطبيق جاهزا",
            'logo' => "logo.png",
            'favicon' => "favicon.png",
            'address' => "NO. 342 - London Oxford Street, 012 United Kingdom",
            'email'   => "murwajcom@gmail.com",
            'phone'   => "+060 (800) 801-582",
            'phone2'  => '+971 50 555 55',
            'map' => "",
            'facebook' => "",
            'instagram' => "",
            'telegram' => "",
            'tiktok' => "",
        );
        DB::table('settings')->insert($data);
    }
}
