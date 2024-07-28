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
            ['id' => 1, 'name_ar' => 'مبيعات', 'name' => 'Sales',   'slug' => 'sales',  'image' => 'sales.png',  'status' => 'active'],
            ['id' => 2, 'name_ar' => 'تأجير', 'name' => 'Rental',   'slug' => 'rental',  'image' => 'booking.png',  'status' => 'active'],
            ['id' => 3, 'name_ar' => 'الحجز', 'name' => 'Booking',   'slug' => 'booking',  'image' => 'rental.png',  'status' => 'active'],
        ];


        Section::insert($sectionRecords);
    }
}
