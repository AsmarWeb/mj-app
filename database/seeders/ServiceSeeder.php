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
            ['id' => 1,  'bg_color' => '#28a745', 'title' => 'Advertising', 'title_ar' => 'الإعلان', 'description' => 'Do you want a controlled niche audience & high reach? Display listing provides high exposure & enables you to boost your brand to customers.', 'description_ar' => '.هل تريد جمهورًا متخصصًا يمكن التحكم فيه ووصولاً عاليًا؟ توفر قائمة العرض عرضًا عاليًا وتمكنك من تعزيز علامتك التجارية للعملاء'],
        ];

        Service::insert($serviceRecords);
    }
}
