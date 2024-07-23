<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sectionRecords = [
            ['id' => 1, 'code' => '122',  'name'   => 'Sale',       'name_ar' => 'مبيعات',       'status' => 'active'],
            ['id' => 2, 'code' => '133',  'name'   => 'Rent',       'name_ar' => 'للايجار',       'status' => 'active'],
            ['id' => 3, 'code' => '144',  'name'   => 'Booking',    'name_ar' => 'حجوزات',       'status' => 'active'],
        ];
        Section::insert($sectionRecords);
    }
}
