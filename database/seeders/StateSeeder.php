<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['id' => 1, 'country_id' => 1,  'name' => 'Dubai',           'name_ar' => 'دبي',             'image' => ''],
            ['id' => 2, 'country_id' => 1,  'name' => 'Abu Dhabi',       'name_ar' => 'أبوظبي',          'image' => ''],
            ['id' => 3, 'country_id' => 1,  'name' => 'Al Sharjah',      'name_ar' => 'الشارقة',         'image' => ''],
            ['id' => 4, 'country_id' => 1,  'name' => 'Ajman',           'name_ar' => 'عجمان',           'image' => ''],
            ['id' => 5, 'country_id' => 1,  'name' => 'Al Fujairah',     'name_ar' => 'الفجيرة',         'image' => ''],
            ['id' => 6, 'country_id' => 1,  'name' => 'Umm Al Quwain',   'name_ar' => 'ام القيوين',      'image' => ''],
            ['id' => 7, 'country_id' => 1,  'name' => 'Ras Al Khaimah',  'name_ar' => 'راس الخيمة',      'image' => ''],
        ];

        DB::table('states')->insert($states);
    }
}
