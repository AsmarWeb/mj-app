<?php

namespace Database\Seeders;

use App\Models\Section;
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
            ['id' => 3, 'name_ar' => 'عقارات', 'name' => 'Real Estate',   'slug' => 'real-estate',  'image' => 'rental.png',  'status' => 'active'],
            ['id' => 4, 'name_ar' => 'مزاد', 'name' => 'Auction',   'slug' => 'auction',  'image' => 'auction.png',  'status' => 'active'],
            ['id' => 5, 'name_ar' => 'فعاليات', 'name' => 'Events',   'slug' => 'events',  'image' => 'events.png',  'status' => 'active'],
        ];

        Section::insert($sectionRecords);
    }
}
