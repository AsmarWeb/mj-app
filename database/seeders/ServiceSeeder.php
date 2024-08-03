<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceRecords = [
            ['id' => 1,  'bg_color' => '#28a745', 'title' => 'Advertising', 'description' => 'Do you want a controlled niche audience & high reach? Display listing provides high exposure & enables you to boost your brand to customers.'],
        ];

        Service::insert($serviceRecords);
    }
}
