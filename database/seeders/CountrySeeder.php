<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = array(
            array('code' => '971', 'name' => 'United Arab Emirates', 'name_ar' => 'الإمارات العربية المتحدة'),
        );

        DB::table('countries')->insert($countries);
    }
}
