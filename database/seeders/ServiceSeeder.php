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
            ['id' => 1, 'shop_id' => "1",  'bg_color' => '#28a745', 'title' => 'Advertising', 'title_ar' => 'الإعلان', 'description' => 'Do you want a controlled niche audience & high reach? Display listing provides high exposure & enables you to boost your brand to customers.', 'description_ar' => '.هل تريد جمهورًا متخصصًا يمكن التحكم فيه ووصولاً عاليًا؟ توفر قائمة العرض عرضًا عاليًا وتمكنك من تعزيز علامتك التجارية للعملاء', 'delivery_days' => 3],
            ['id' => 2,  'shop_id' => "1",  'bg_color' => '#007bff', 'title' => 'Design', 'title_ar' => 'التصميم', 'description' => 'Do you want to create a unique identity for your business? Our design services can help you create a logo, business card, and other marketing materials that will make your brand stand out.', 'description_ar' => '.هل تريد إنشاء هوية فريدة لعملك؟ يمكن أن تساعدك خدمات التصميم لدينا في إنشاء شعار وبطاقة عمل ومواد تسويقية أخرى ستجعل علامتك التجارية تبرز', 'delivery_days' => 5],
            ['id' => 3,  'shop_id' => "1",  'bg_color' => '#ffc107', 'title' => 'Development', 'title_ar' => 'التطوير', 'description' => 'Do you want to build a website or mobile app for your business? Our development services can help you create a custom solution that meets your specific needs.', 'description_ar' => '.هل تريد بناء موقع ويب أو تطبيق جوال لعملك؟ يمكن أن تساعدك خدمات التطوير لدينا في إنشاء حل مخصص يلبي احتياجاتك المحددة', 'delivery_days' => 10],
            ['id' => 4,  'shop_id' => "1",  'bg_color' => '#dc3545', 'title' => 'Consulting', 'title_ar' => 'الاستشارات', 'description' => 'Do you want to improve your business operations? Our consulting services can help you identify areas for improvement and develop strategies to increase efficiency and profitability.', 'description_ar' => '.هل تريد تحسين عمليات عملك؟ يمكن أن تساعدك خدمات الاستشارات لدينا في تحديد المجالات التي تحتاج إلى تحسين وتطوير استراتيجيات لزيادة الكفاءة والربحية', 'delivery_days' => 7],
        ];

        Service::insert($serviceRecords);
    }
}
