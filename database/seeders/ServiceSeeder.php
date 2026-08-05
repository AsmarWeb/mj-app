<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceRecords = [
            [
                'id' => 1,
                'shop_id' => '1',
                'bg_color' => '#28a745',
                'title' => 'Digital Products',
                'title_ar' => 'المنتجات الرقمية',
                'description' => 'We help you sell your digital products online by connecting you with customers worldwide. Whether you sell eBooks, templates, courses, software, planners, or downloadable resources, our platform makes it easy to showcase and grow your business.',
                'description_ar' => 'نساعدك على بيع منتجاتك الرقمية عبر الإنترنت من خلال ربطك بالعملاء حول العالم. سواء كنت تبيع كتبًا إلكترونية أو قوالب أو دورات تدريبية أو برامج أو مخططات أو ملفات قابلة للتنزيل، فإن منصتنا تجعل عرض منتجاتك وتنمية أعمالك أمرًا سهلاً.',
                'delivery_days' => 2,
            ],
            [
                'id' => 2,
                'shop_id' => '1',
                'bg_color' => '#007bff',
                'title' => 'Graphic Design',
                'title_ar' => 'التصميم الجرافيكي',
                'description' => 'We Offer logo design, branding kits, social media posts, business cards, flyers, UI/UX designs, and other creative services.',
                'description_ar' => 'نقدّم خدمات تصميم الشعارات، والهويات التجارية، ومنشورات وسائل التواصل الاجتماعي، وبطاقات الأعمال، والمنشورات الدعائية، وتصاميم واجهات المستخدم وغيرها.',
                'delivery_days' => 4,
            ],
            [
                'id' => 3,
                'shop_id' => '1',
                'bg_color' => '#ffc107',
                'title' => 'Website & Store Setup',
                'title_ar' => 'إنشاء المواقع والمتاجر',
                'description' => 'We help you build professional websites and online stores tailored to your business. From custom websites to fully functional eCommerce platforms, we provide everything you need to establish and grow your online presence.',
                'description_ar' => 'نساعدك في إنشاء مواقع إلكترونية ومتاجر احترافية مصممة خصيصًا لعملك. بدءًا من المواقع المخصصة وحتى منصات التجارة الإلكترونية المتكاملة، نوفر لك كل ما تحتاجه لإطلاق وتنمية حضورك الرقمي.',
                'delivery_days' => 7,
            ],
            [
                'id' => 4,
                'shop_id' => '1',
                'bg_color' => '#dc3545',
                'title' => 'Marketing & Promotion',
                'title_ar' => 'التسويق والترويج',
                'description' => 'We help you promote your products and grow your online sales through social media marketing, SEO, paid advertising, email campaigns, and content marketing. Our team creates effective marketing strategies tailored to your business.',
                'description_ar' => 'نساعدك على الترويج لمنتجاتك وزيادة مبيعاتك عبر الإنترنت من خلال التسويق عبر وسائل التواصل الاجتماعي، وتحسين محركات البحث (SEO)، والإعلانات المدفوعة، وحملات البريد الإلكتروني، وتسويق المحتوى. يعمل فريقنا على إعداد استراتيجيات تسويقية فعّالة تناسب احتياجات عملك.',
                'delivery_days' => 5,
            ],
            [
                'id' => 5,
                'shop_id' => '1',
                'bg_color' => '#6f42c1',
                'title' => 'Content Creation',
                'title_ar' => 'إنشاء المحتوى',
                'description' => 'We help you create high-quality product descriptions, blog posts, videos, social media content, and persuasive copywriting that attracts customers, strengthens your brand, and increases sales.',
                'description_ar' => 'نساعدك في إنشاء أوصاف احترافية للمنتجات، ومقالات، وفيديوهات، ومحتوى لوسائل التواصل الاجتماعي، ونصوص تسويقية مؤثرة تجذب العملاء، وتعزز علامتك التجارية، وتزيد من مبيعاتك.',
                'delivery_days' => 3,
            ],
            [
                'id' => 6,
                'shop_id' => '1',
                'bg_color' => '#17a2b8',
                'title' => 'Business Consulting',
                'title_ar' => 'استشارات التجارة الإلكترونية',
                'description' => 'Help entrepreneurs choose profitable products, improve their online stores, optimize pricing, and grow their eCommerce business.',
                'description_ar' => 'مساعدة رواد الأعمال في اختيار المنتجات المربحة، وتحسين متاجرهم الإلكترونية، وتطوير استراتيجيات التسعير، وتنمية أعمالهم عبر الإنترنت.',
                'delivery_days' => 6,
            ],
        ];

        Service::insert($serviceRecords);
    }
}
