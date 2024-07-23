<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = array(
            ['id' => 1, 'state_id' => 1, 'name' => 'Abu Hayl', 'name_ar' => 'أبو هيل'],
            ['id' => 2, 'state_id' => 1, 'name' => 'Al Quoz', 'name_ar' => 'القوز'],
            ['id' => 3, 'state_id' => 1, 'name' => 'Al Qusays', 'name_ar' => 'القصيص'],
            ['id' => 4, 'state_id' => 1, 'name' => 'Downtown Dubai', 'name_ar' => 'مركز المدينة'],
        );

        DB::table('cities')->insert($cities);
    }
}
