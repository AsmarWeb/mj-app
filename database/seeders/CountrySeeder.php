<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [

            [
                'name' => 'United Arab Emirates',
                'name_ar' => 'الإمارات العربية المتحدة',
                'slug' => 'united-arab-emirates',
                'code' => 'AE',
                'phone_code' => '+971',
                'flag' => '🇦🇪',
            ],

            [
                'name' => 'Saudi Arabia',
                'name_ar' => 'المملكة العربية السعودية',
                'slug' => 'saudi-arabia',
                'code' => 'SA',
                'phone_code' => '+966',
                'flag' => '🇸🇦',
            ],

            [
                'name' => 'Qatar',
                'name_ar' => 'قطر',
                'slug' => 'qatar',
                'code' => 'QA',
                'phone_code' => '+974',
                'flag' => '🇶🇦',
            ],

            [
                'name' => 'Kuwait',
                'name_ar' => 'الكويت',
                'slug' => 'kuwait',
                'code' => 'KW',
                'phone_code' => '+965',
                'flag' => '🇰🇼',
            ],

            [
                'name' => 'Bahrain',
                'name_ar' => 'البحرين',
                'slug' => 'bahrain',
                'code' => 'BH',
                'phone_code' => '+973',
                'flag' => '🇧🇭',
            ],

            [
                'name' => 'Oman',
                'name_ar' => 'سلطنة عُمان',
                'slug' => 'oman',
                'code' => 'OM',
                'phone_code' => '+968',
                'flag' => '🇴🇲',
            ],

        ];

        DB::table('countries')->insert($countries);
    }
}
