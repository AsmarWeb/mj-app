<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategoryRecords = [
            // =========================================================
            // 1. Electronics
            // =========================================================
            ['id' => 1,  'category_id' => 1, 'category_name' => 'Electronics', 'subcategory_name' => 'Audio', 'subcategory_name_ar' => 'الصوتيات', 'slug' => 'audio', 'status' => 'active'],
            ['id' => 2,  'category_id' => 1, 'category_name' => 'Electronics', 'subcategory_name' => 'TV & Video', 'subcategory_name_ar' => 'التلفزيون والفيديو', 'slug' => 'tv & video', 'status' => 'active'],
            ['id' => 3,  'category_id' => 1, 'category_name' => 'Electronics', 'subcategory_name' => 'Batteries & Charging', 'subcategory_name_ar' => 'البطاريات والشحن', 'slug' => 'batteries & charging', 'status' => 'active'],
            ['id' => 4,  'category_id' => 1, 'category_name' => 'Electronics', 'subcategory_name' => 'Cables & Cords', 'subcategory_name_ar' => 'الكابلات والأسلاك', 'slug' => 'cables & cords', 'status' => 'active'],
            ['id' => 5,  'category_id' => 1, 'category_name' => 'Electronics', 'subcategory_name' => 'Cameras & Equipment', 'subcategory_name_ar' => 'الكاميرات والمعدات', 'slug' => 'cameras & equipment', 'status' => 'active'],
            ['id' => 6,  'category_id' => 1, 'category_name' => 'Electronics', 'subcategory_name' => 'Car Parts & Accessories', 'subcategory_name_ar' => 'قطع غيار السيارات وملحقاتها', 'slug' => 'car parts & accessories', 'status' => 'active'],
            ['id' => 7,  'category_id' => 1, 'category_name' => 'Electronics', 'subcategory_name' => 'Cell Phone Accessories', 'subcategory_name_ar' => 'ملحقات الهاتف الخليوي', 'slug' => 'cell phone accessories', 'status' => 'active'],
            ['id' => 8,  'category_id' => 1, 'category_name' => 'Electronics', 'subcategory_name' => 'Computers & Peripherals', 'subcategory_name_ar' => 'أجهزة الكمبيوتر والأجهزة الطرفية', 'slug' => 'computers & peripherals', 'status' => 'active'],
            ['id' => 9,  'category_id' => 1, 'category_name' => 'Electronics', 'subcategory_name' => 'Telephones & Handsets', 'subcategory_name_ar' => 'الهواتف', 'slug' => 'telephones & handsets', 'status' => 'active'],
            ['id' => 10, 'category_id' => 1, 'category_name' => 'Electronics', 'subcategory_name' => 'Gadgets', 'subcategory_name_ar' => 'الأدوات', 'slug' => 'gadgets', 'status' => 'active'],

            // =========================================================
            // 2. Home & Living
            // =========================================================
            ['id' => 11, 'category_id' => 2, 'category_name' => 'Home & Living', 'subcategory_name' => 'Furniture', 'subcategory_name_ar' => 'الأثاث', 'slug' => 'furniture', 'status' => 'active'],
            ['id' => 12, 'category_id' => 2, 'category_name' => 'Home & Living', 'subcategory_name' => 'Home Decor', 'subcategory_name_ar' => 'ديكور المنزل', 'slug' => 'home-decor', 'status' => 'active'],
            ['id' => 13, 'category_id' => 2, 'category_name' => 'Home & Living', 'subcategory_name' => 'Kitchen & Dining', 'subcategory_name_ar' => 'المطبخ وتناول الطعام', 'slug' => 'kitchen-dining', 'status' => 'active'],
            ['id' => 14, 'category_id' => 2, 'category_name' => 'Home & Living', 'subcategory_name' => 'Bedroom', 'subcategory_name_ar' => 'غرفة النوم', 'slug' => 'bedroom', 'status' => 'active'],
            ['id' => 15, 'category_id' => 2, 'category_name' => 'Home & Living', 'subcategory_name' => 'Living Room', 'subcategory_name_ar' => 'غرفة المعيشة', 'slug' => 'living-room', 'status' => 'active'],
            ['id' => 16, 'category_id' => 2, 'category_name' => 'Home & Living', 'subcategory_name' => 'Bathroom', 'subcategory_name_ar' => 'الحمام', 'slug' => 'bathroom', 'status' => 'active'],
            ['id' => 17, 'category_id' => 2, 'category_name' => 'Home & Living', 'subcategory_name' => 'Lighting', 'subcategory_name_ar' => 'الإضاءة', 'slug' => 'lighting', 'status' => 'active'],
            ['id' => 18, 'category_id' => 2, 'category_name' => 'Home & Living', 'subcategory_name' => 'Garden & Outdoor', 'subcategory_name_ar' => 'الحديقة والمساحات الخارجية', 'slug' => 'garden-outdoor', 'status' => 'active'],
            ['id' => 19, 'category_id' => 2, 'category_name' => 'Home & Living', 'subcategory_name' => 'Home Appliances', 'subcategory_name_ar' => 'الأجهزة المنزلية', 'slug' => 'home-appliances', 'status' => 'active'],
            ['id' => 20, 'category_id' => 2, 'category_name' => 'Home & Living', 'subcategory_name' => 'Storage & Organization', 'subcategory_name_ar' => 'التخزين والتنظيم', 'slug' => 'storage-organization', 'status' => 'active'],
            ['id' => 21, 'category_id' => 2, 'category_name' => 'Home & Living', 'subcategory_name' => 'Curtains & Carpets', 'subcategory_name_ar' => 'الستائر والسجاد', 'slug' => 'curtains-carpets', 'status' => 'active'],
            ['id' => 22, 'category_id' => 2, 'category_name' => 'Home & Living', 'subcategory_name' => 'Cleaning & Household Supplies', 'subcategory_name_ar' => 'مستلزمات التنظيف والمنزل', 'slug' => 'cleaning-household-supplies', 'status' => 'active'],
            ['id' => 23, 'category_id' => 2, 'category_name' => 'Home & Living', 'subcategory_name' => 'Wall Art & Mirrors', 'subcategory_name_ar' => 'لوحات الحائط والمرايا', 'slug' => 'wall-art-mirrors', 'status' => 'active'],
            ['id' => 24, 'category_id' => 2, 'category_name' => 'Home & Living', 'subcategory_name' => 'Traditional Home Items', 'subcategory_name_ar' => 'الأدوات المنزلية التقليدية', 'slug' => 'traditional-home-items', 'status' => 'active'],

            // =========================================================
            // 3. Cooking
            // =========================================================
            ['id' => 25, 'category_id' => 3, 'category_name' => 'Cooking', 'subcategory_name' => 'Cookware', 'subcategory_name_ar' => 'أواني الطبخ', 'slug' => 'cookware', 'status' => 'active'],
            ['id' => 26, 'category_id' => 3, 'category_name' => 'Cooking', 'subcategory_name' => 'Bakeware', 'subcategory_name_ar' => 'أدوات الخَبز', 'slug' => 'bakeware', 'status' => 'active'],
            ['id' => 27, 'category_id' => 3, 'category_name' => 'Cooking', 'subcategory_name' => 'Kitchen Appliances', 'subcategory_name_ar' => 'أجهزة المطبخ', 'slug' => 'kitchen-appliances', 'status' => 'active'],
            ['id' => 28, 'category_id' => 3, 'category_name' => 'Cooking', 'subcategory_name' => 'Knives & Cutlery', 'subcategory_name_ar' => 'السكاكين وأدوات المائدة', 'slug' => 'knives-cutlery', 'status' => 'active'],
            ['id' => 29, 'category_id' => 3, 'category_name' => 'Cooking', 'subcategory_name' => 'Kitchen Utensils', 'subcategory_name_ar' => 'أدوات المطبخ', 'slug' => 'kitchen-utensils', 'status' => 'active'],
            ['id' => 30, 'category_id' => 3, 'category_name' => 'Cooking', 'subcategory_name' => 'Food Storage', 'subcategory_name_ar' => 'حفظ وتخزين الطعام', 'slug' => 'food-storage', 'status' => 'active'],
            ['id' => 31, 'category_id' => 3, 'category_name' => 'Cooking', 'subcategory_name' => 'Traditional Cooking', 'subcategory_name_ar' => 'الطبخ التقليدي', 'slug' => 'traditional-cooking', 'status' => 'active'],

            // =========================================================
            // 4. Fashion
            // =========================================================
            ['id' => 32, 'category_id' => 4, 'category_name' => 'Fashion', 'subcategory_name' => 'Men Clothing', 'subcategory_name_ar' => 'ملابس رجالية', 'slug' => 'men-clothing', 'status' => 'active'],
            ['id' => 33, 'category_id' => 4, 'category_name' => 'Fashion', 'subcategory_name' => 'Women Clothing', 'subcategory_name_ar' => 'ملابس نسائية', 'slug' => 'women-clothing', 'status' => 'active'],
            ['id' => 34, 'category_id' => 4, 'category_name' => 'Fashion', 'subcategory_name' => 'Kids Clothing', 'subcategory_name_ar' => 'ملابس الأطفال', 'slug' => 'kids-clothing', 'status' => 'active'],
            ['id' => 35, 'category_id' => 4, 'category_name' => 'Fashion', 'subcategory_name' => 'Traditional Clothing', 'subcategory_name_ar' => 'الملابس التقليدية', 'slug' => 'traditional-clothing', 'status' => 'active'],
            ['id' => 36, 'category_id' => 4, 'category_name' => 'Fashion', 'subcategory_name' => 'Bags & Wallets', 'subcategory_name_ar' => 'الحقائب والمحافظ', 'slug' => 'bags-wallets', 'status' => 'active'],
            ['id' => 37, 'category_id' => 4, 'category_name' => 'Fashion', 'subcategory_name' => 'Watches', 'subcategory_name_ar' => 'الساعات', 'slug' => 'watches', 'status' => 'active'],
            ['id' => 38, 'category_id' => 4, 'category_name' => 'Fashion', 'subcategory_name' => 'Fashion Accessories', 'subcategory_name_ar' => 'إكسسوارات الموضة', 'slug' => 'fashion-accessories', 'status' => 'active'],

            // =========================================================
            // 5. Travel & Outdoor
            // =========================================================
            ['id' => 39, 'category_id' => 5, 'category_name' => 'Travel & Outdoor', 'subcategory_name' => 'Camping & Hiking', 'subcategory_name_ar' => 'التخييم والمشي الجبلي', 'slug' => 'camping-hiking', 'status' => 'active'],
            ['id' => 40, 'category_id' => 5, 'category_name' => 'Travel & Outdoor', 'subcategory_name' => 'Travel Luggage', 'subcategory_name_ar' => 'حقائب السفر', 'slug' => 'travel-luggage', 'status' => 'active'],
            ['id' => 41, 'category_id' => 5, 'category_name' => 'Travel & Outdoor', 'subcategory_name' => 'Outdoor Activities', 'subcategory_name_ar' => 'الأنشطة الخارجية', 'slug' => 'outdoor-activities', 'status' => 'active'],
            ['id' => 42, 'category_id' => 5, 'category_name' => 'Travel & Outdoor', 'subcategory_name' => 'Beach & Water Sports', 'subcategory_name_ar' => 'الشاطئ والرياضات المائية', 'slug' => 'beach-water-sports', 'status' => 'active'],
            ['id' => 43, 'category_id' => 5, 'category_name' => 'Travel & Outdoor', 'subcategory_name' => 'Cycling', 'subcategory_name_ar' => 'ركوب الدراجات', 'slug' => 'cycling', 'status' => 'active'],
            ['id' => 44, 'category_id' => 5, 'category_name' => 'Travel & Outdoor', 'subcategory_name' => 'Sports Equipment', 'subcategory_name_ar' => 'المعدات الرياضية', 'slug' => 'sports-equipment', 'status' => 'active'],

            // =========================================================
            // 6. Shoes & Boots
            // =========================================================
            ['id' => 45, 'category_id' => 6, 'category_name' => 'Shoes & Boots', 'subcategory_name' => 'Men Shoes', 'subcategory_name_ar' => 'أحذية رجالية', 'slug' => 'men-shoes', 'status' => 'active'],
            ['id' => 46, 'category_id' => 6, 'category_name' => 'Shoes & Boots', 'subcategory_name' => 'Women Shoes', 'subcategory_name_ar' => 'أحذية نسائية', 'slug' => 'women-shoes', 'status' => 'active'],
            ['id' => 47, 'category_id' => 6, 'category_name' => 'Shoes & Boots', 'subcategory_name' => 'Kids Shoes', 'subcategory_name_ar' => 'أحذية الأطفال', 'slug' => 'kids-shoes', 'status' => 'active'],
            ['id' => 48, 'category_id' => 6, 'category_name' => 'Shoes & Boots', 'subcategory_name' => 'Sneakers', 'subcategory_name_ar' => 'أحذية رياضية', 'slug' => 'sneakers', 'status' => 'active'],
            ['id' => 49, 'category_id' => 6, 'category_name' => 'Shoes & Boots', 'subcategory_name' => 'Boots', 'subcategory_name_ar' => 'الجزم', 'slug' => 'boots', 'status' => 'active'],
            ['id' => 50, 'category_id' => 6, 'category_name' => 'Shoes & Boots', 'subcategory_name' => 'Sandals & Slippers', 'subcategory_name_ar' => 'الصنادل والشباشب', 'slug' => 'sandals-slippers', 'status' => 'active'],

            // =========================================================
            // 7. Properties
            // =========================================================
            ['id' => 51, 'category_id' => 7, 'category_name' => 'Properties', 'subcategory_name' => 'Apartments', 'subcategory_name_ar' => 'الشقق', 'slug' => 'apartments', 'status' => 'active'],
            ['id' => 52, 'category_id' => 7, 'category_name' => 'Properties', 'subcategory_name' => 'Villas & Houses', 'subcategory_name_ar' => 'الفلل والمنازل', 'slug' => 'villas-houses', 'status' => 'active'],
            ['id' => 53, 'category_id' => 7, 'category_name' => 'Properties', 'subcategory_name' => 'Rooms', 'subcategory_name_ar' => 'الغرف', 'slug' => 'rooms', 'status' => 'active'],
            ['id' => 54, 'category_id' => 7, 'category_name' => 'Properties', 'subcategory_name' => 'Commercial Properties', 'subcategory_name_ar' => 'العقارات التجارية', 'slug' => 'commercial-properties', 'status' => 'active'],
            ['id' => 55, 'category_id' => 7, 'category_name' => 'Properties', 'subcategory_name' => 'Land', 'subcategory_name_ar' => 'الأراضي', 'slug' => 'land', 'status' => 'active'],
            ['id' => 56, 'category_id' => 7, 'category_name' => 'Properties', 'subcategory_name' => 'Buildings', 'subcategory_name_ar' => 'المباني', 'slug' => 'buildings', 'status' => 'active'],
            ['id' => 57, 'category_id' => 7, 'category_name' => 'Properties', 'subcategory_name' => 'Offices', 'subcategory_name_ar' => 'المكاتب', 'slug' => 'offices', 'status' => 'active'],

            // =========================================================
            // 8. Automobile
            // =========================================================
            ['id' => 58, 'category_id' => 8, 'category_name' => 'Automobile', 'subcategory_name' => 'Cars', 'subcategory_name_ar' => 'السيارات', 'slug' => 'cars', 'status' => 'active'],
            ['id' => 59, 'category_id' => 8, 'category_name' => 'Automobile', 'subcategory_name' => 'SUVs & 4x4', 'subcategory_name_ar' => 'سيارات الدفع الرباعي', 'slug' => 'suvs-4x4', 'status' => 'active'],
            ['id' => 60, 'category_id' => 8, 'category_name' => 'Automobile', 'subcategory_name' => 'Motorcycles', 'subcategory_name_ar' => 'الدراجات النارية', 'slug' => 'motorcycles', 'status' => 'active'],
            ['id' => 61, 'category_id' => 8, 'category_name' => 'Automobile', 'subcategory_name' => 'Car Parts', 'subcategory_name_ar' => 'قطع غيار السيارات', 'slug' => 'car-parts', 'status' => 'active'],
            ['id' => 62, 'category_id' => 8, 'category_name' => 'Automobile', 'subcategory_name' => 'Car Accessories', 'subcategory_name_ar' => 'إكسسوارات السيارات', 'slug' => 'car-accessories', 'status' => 'active'],
            ['id' => 63, 'category_id' => 8, 'category_name' => 'Automobile', 'subcategory_name' => 'Tires & Wheels', 'subcategory_name_ar' => 'الإطارات والعجلات', 'slug' => 'tires-wheels', 'status' => 'active'],
            ['id' => 64, 'category_id' => 8, 'category_name' => 'Automobile', 'subcategory_name' => 'Car Care & Tools', 'subcategory_name_ar' => 'العناية بالسيارات والأدوات', 'slug' => 'car-care-tools', 'status' => 'active'],

            // =========================================================
            // 9. Hospitality
            // =========================================================
            ['id' => 65, 'category_id' => 9, 'category_name' => 'Hospitality', 'subcategory_name' => 'Hotels', 'subcategory_name_ar' => 'الفنادق', 'slug' => 'hotels', 'status' => 'active'],
            ['id' => 66, 'category_id' => 9, 'category_name' => 'Hospitality', 'subcategory_name' => 'Resorts', 'subcategory_name_ar' => 'المنتجعات', 'slug' => 'resorts', 'status' => 'active'],
            ['id' => 67, 'category_id' => 9, 'category_name' => 'Hospitality', 'subcategory_name' => 'Guest Houses', 'subcategory_name_ar' => 'بيوت الضيافة', 'slug' => 'guest-houses', 'status' => 'active'],
            ['id' => 68, 'category_id' => 9, 'category_name' => 'Hospitality', 'subcategory_name' => 'Holiday Homes', 'subcategory_name_ar' => 'بيوت العطلات', 'slug' => 'holiday-homes', 'status' => 'active'],
            ['id' => 69, 'category_id' => 9, 'category_name' => 'Hospitality', 'subcategory_name' => 'Restaurants', 'subcategory_name_ar' => 'المطاعم', 'slug' => 'restaurants', 'status' => 'active'],
            ['id' => 70, 'category_id' => 9, 'category_name' => 'Hospitality', 'subcategory_name' => 'Cafes', 'subcategory_name_ar' => 'المقاهي', 'slug' => 'cafes', 'status' => 'active'],
            ['id' => 71, 'category_id' => 9, 'category_name' => 'Hospitality', 'subcategory_name' => 'Event Venues', 'subcategory_name_ar' => 'أماكن الفعاليات', 'slug' => 'event-venues', 'status' => 'active'],

            // =========================================================
            // 10. Education
            // =========================================================
            ['id' => 72, 'category_id' => 10, 'category_name' => 'Education', 'subcategory_name' => 'Schools', 'subcategory_name_ar' => 'المدارس', 'slug' => 'schools', 'status' => 'active'],
            ['id' => 73, 'category_id' => 10, 'category_name' => 'Education', 'subcategory_name' => 'Tutoring', 'subcategory_name_ar' => 'الدروس الخصوصية', 'slug' => 'tutoring', 'status' => 'active'],
            ['id' => 74, 'category_id' => 10, 'category_name' => 'Education', 'subcategory_name' => 'Courses & Training', 'subcategory_name_ar' => 'الدورات والتدريب', 'slug' => 'courses-training', 'status' => 'active'],
            ['id' => 75, 'category_id' => 10, 'category_name' => 'Education', 'subcategory_name' => 'Language Learning', 'subcategory_name_ar' => 'تعلم اللغات', 'slug' => 'language-learning', 'status' => 'active'],
            ['id' => 76, 'category_id' => 10, 'category_name' => 'Education', 'subcategory_name' => 'Professional Training', 'subcategory_name_ar' => 'التدريب المهني', 'slug' => 'professional-training', 'status' => 'active'],
            ['id' => 77, 'category_id' => 10, 'category_name' => 'Education', 'subcategory_name' => 'Educational Supplies', 'subcategory_name_ar' => 'المستلزمات التعليمية', 'slug' => 'educational-supplies', 'status' => 'active'],

            // =========================================================
            // 11. Software
            // =========================================================
            ['id' => 78, 'category_id' => 11, 'category_name' => 'Software', 'subcategory_name' => 'Business Software', 'subcategory_name_ar' => 'برامج الأعمال', 'slug' => 'business-software', 'status' => 'active'],
            ['id' => 79, 'category_id' => 11, 'category_name' => 'Software', 'subcategory_name' => 'Accounting Software', 'subcategory_name_ar' => 'برامج المحاسبة', 'slug' => 'accounting-software', 'status' => 'active'],
            ['id' => 80, 'category_id' => 11, 'category_name' => 'Software', 'subcategory_name' => 'Design Software', 'subcategory_name_ar' => 'برامج التصميم', 'slug' => 'design-software', 'status' => 'active'],
            ['id' => 81, 'category_id' => 11, 'category_name' => 'Software', 'subcategory_name' => 'Security Software', 'subcategory_name_ar' => 'برامج الحماية والأمان', 'slug' => 'security-software', 'status' => 'active'],
            ['id' => 82, 'category_id' => 11, 'category_name' => 'Software', 'subcategory_name' => 'Mobile Apps', 'subcategory_name_ar' => 'تطبيقات الهاتف', 'slug' => 'mobile-apps', 'status' => 'active'],
            ['id' => 83, 'category_id' => 11, 'category_name' => 'Software', 'subcategory_name' => 'Web & Cloud Software', 'subcategory_name_ar' => 'برامج الويب والسحابة', 'slug' => 'web-cloud-software', 'status' => 'active'],
            ['id' => 84, 'category_id' => 11, 'category_name' => 'Software', 'subcategory_name' => 'Games & Entertainment Software', 'subcategory_name_ar' => 'برامج الألعاب والترفيه', 'slug' => 'games-entertainment-software', 'status' => 'active'],

            // =========================================================
            // 12. Services
            // =========================================================
            ['id' => 85, 'category_id' => 12, 'category_name' => 'Services', 'subcategory_name' => 'Cleaning Services', 'subcategory_name_ar' => 'خدمات التنظيف', 'slug' => 'cleaning-services', 'status' => 'active'],
            ['id' => 86, 'category_id' => 12, 'category_name' => 'Services', 'subcategory_name' => 'Maintenance & Repair', 'subcategory_name_ar' => 'الصيانة والإصلاح', 'slug' => 'maintenance-repair', 'status' => 'active'],
            ['id' => 87, 'category_id' => 12, 'category_name' => 'Services', 'subcategory_name' => 'Moving & Relocation', 'subcategory_name_ar' => 'النقل ونقل الأثاث', 'slug' => 'moving-relocation', 'status' => 'active'],
            ['id' => 88, 'category_id' => 12, 'category_name' => 'Services', 'subcategory_name' => 'Beauty & Salon', 'subcategory_name_ar' => 'التجميل والصالونات', 'slug' => 'beauty-salon', 'status' => 'active'],
            ['id' => 89, 'category_id' => 12, 'category_name' => 'Services', 'subcategory_name' => 'Photography & Video', 'subcategory_name_ar' => 'التصوير والفيديو', 'slug' => 'photography-video', 'status' => 'active'],
            ['id' => 90, 'category_id' => 12, 'category_name' => 'Services', 'subcategory_name' => 'Business Services', 'subcategory_name_ar' => 'خدمات الأعمال', 'slug' => 'business-services', 'status' => 'active'],
            ['id' => 91, 'category_id' => 12, 'category_name' => 'Services', 'subcategory_name' => 'Home Services', 'subcategory_name_ar' => 'الخدمات المنزلية', 'slug' => 'home-services', 'status' => 'active'],
            ['id' => 92, 'category_id' => 12, 'category_name' => 'Services', 'subcategory_name' => 'Delivery & Logistics', 'subcategory_name_ar' => 'التوصيل والخدمات اللوجستية', 'slug' => 'delivery-logistics', 'status' => 'active'],

            // =========================================================
            // 13. Accessories
            // =========================================================
            ['id' => 93, 'category_id' => 13, 'category_name' => 'Accessories', 'subcategory_name' => 'Jewelry', 'subcategory_name_ar' => 'المجوهرات', 'slug' => 'jewelry', 'status' => 'active'],
            ['id' => 94, 'category_id' => 13, 'category_name' => 'Accessories', 'subcategory_name' => 'Watches', 'subcategory_name_ar' => 'الساعات', 'slug' => 'watches', 'status' => 'active'],
            ['id' => 95, 'category_id' => 13, 'category_name' => 'Accessories', 'subcategory_name' => 'Handbags & Wallets', 'subcategory_name_ar' => 'حقائب اليد والمحافظ', 'slug' => 'handbags-wallets', 'status' => 'active'],
            ['id' => 96, 'category_id' => 13, 'category_name' => 'Accessories', 'subcategory_name' => 'Sunglasses', 'subcategory_name_ar' => 'النظارات الشمسية', 'slug' => 'sunglasses', 'status' => 'active'],
            ['id' => 97, 'category_id' => 13, 'category_name' => 'Accessories', 'subcategory_name' => 'Belts', 'subcategory_name_ar' => 'الأحزمة', 'slug' => 'belts', 'status' => 'active'],
            ['id' => 98, 'category_id' => 13, 'category_name' => 'Accessories', 'subcategory_name' => 'Hats & Caps', 'subcategory_name_ar' => 'القبعات', 'slug' => 'hats-caps', 'status' => 'active'],
            ['id' => 99, 'category_id' => 13, 'category_name' => 'Accessories', 'subcategory_name' => 'Phone Accessories', 'subcategory_name_ar' => 'ملحقات الهاتف', 'slug' => 'phone-accessories', 'status' => 'active'],

            // =========================================================
            // 14. Art & Collectibles
            // =========================================================
            ['id' => 100, 'category_id' => 14, 'category_name' => 'Art & Collectibles', 'subcategory_name' => 'Paintings', 'subcategory_name_ar' => 'اللوحات الفنية', 'slug' => 'paintings', 'status' => 'active'],
            ['id' => 101, 'category_id' => 14, 'category_name' => 'Art & Collectibles', 'subcategory_name' => 'Photography', 'subcategory_name_ar' => 'التصوير الفوتوغرافي', 'slug' => 'photography', 'status' => 'active'],
            ['id' => 102, 'category_id' => 14, 'category_name' => 'Art & Collectibles', 'subcategory_name' => 'Sculptures', 'subcategory_name_ar' => 'المنحوتات', 'slug' => 'sculptures', 'status' => 'active'],
            ['id' => 103, 'category_id' => 14, 'category_name' => 'Art & Collectibles', 'subcategory_name' => 'Antiques', 'subcategory_name_ar' => 'التحف', 'slug' => 'antiques', 'status' => 'active'],
            ['id' => 104, 'category_id' => 14, 'category_name' => 'Art & Collectibles', 'subcategory_name' => 'Coins & Currency', 'subcategory_name_ar' => 'العملات والمقتنيات النقدية', 'slug' => 'coins-currency', 'status' => 'active'],
            ['id' => 105, 'category_id' => 14, 'category_name' => 'Art & Collectibles', 'subcategory_name' => 'Stamps & Memorabilia', 'subcategory_name_ar' => 'الطوابع والمقتنيات التذكارية', 'slug' => 'stamps-memorabilia', 'status' => 'active'],
            ['id' => 106, 'category_id' => 14, 'category_name' => 'Art & Collectibles', 'subcategory_name' => 'Handmade Art', 'subcategory_name_ar' => 'الفنون اليدوية', 'slug' => 'handmade-art', 'status' => 'active'],

            // =========================================================
            // 15. Gifts
            // =========================================================
            ['id' => 107, 'category_id' => 15, 'category_name' => 'Gifts', 'subcategory_name' => 'Gift Baskets', 'subcategory_name_ar' => 'سلال الهدايا', 'slug' => 'gift-baskets', 'status' => 'active'],
            ['id' => 108, 'category_id' => 15, 'category_name' => 'Gifts', 'subcategory_name' => 'Flowers & Plants', 'subcategory_name_ar' => 'الزهور والنباتات', 'slug' => 'flowers-plants', 'status' => 'active'],
            ['id' => 109, 'category_id' => 15, 'category_name' => 'Gifts', 'subcategory_name' => 'Personalized Gifts', 'subcategory_name_ar' => 'الهدايا الشخصية', 'slug' => 'personalized-gifts', 'status' => 'active'],
            ['id' => 110, 'category_id' => 15, 'category_name' => 'Gifts', 'subcategory_name' => 'Corporate Gifts', 'subcategory_name_ar' => 'هدايا الشركات', 'slug' => 'corporate-gifts', 'status' => 'active'],
            ['id' => 111, 'category_id' => 15, 'category_name' => 'Gifts', 'subcategory_name' => 'Wedding Gifts', 'subcategory_name_ar' => 'هدايا الزفاف', 'slug' => 'wedding-gifts', 'status' => 'active'],
            ['id' => 112, 'category_id' => 15, 'category_name' => 'Gifts', 'subcategory_name' => 'Birthday Gifts', 'subcategory_name_ar' => 'هدايا أعياد الميلاد', 'slug' => 'birthday-gifts', 'status' => 'active'],
            ['id' => 113, 'category_id' => 15, 'category_name' => 'Gifts', 'subcategory_name' => 'UAE Souvenirs', 'subcategory_name_ar' => 'التذكارات الإماراتية', 'slug' => 'uae-souvenirs', 'status' => 'active'],

            // =========================================================
            // 16. Books, Movies & Music
            // =========================================================
            ['id' => 114, 'category_id' => 16, 'category_name' => 'Books, Movies & Music', 'subcategory_name' => 'Books', 'subcategory_name_ar' => 'الكتب', 'slug' => 'books', 'status' => 'active'],
            ['id' => 115, 'category_id' => 16, 'category_name' => 'Books, Movies & Music', 'subcategory_name' => 'Textbooks', 'subcategory_name_ar' => 'الكتب الدراسية', 'slug' => 'textbooks', 'status' => 'active'],
            ['id' => 116, 'category_id' => 16, 'category_name' => 'Books, Movies & Music', 'subcategory_name' => 'Comics & Manga', 'subcategory_name_ar' => 'القصص المصورة والمانجا', 'slug' => 'comics-manga', 'status' => 'active'],
            ['id' => 117, 'category_id' => 16, 'category_name' => 'Books, Movies & Music', 'subcategory_name' => 'Movies & DVDs', 'subcategory_name_ar' => 'الأفلام وأقراص DVD', 'slug' => 'movies-dvds', 'status' => 'active'],
            ['id' => 118, 'category_id' => 16, 'category_name' => 'Books, Movies & Music', 'subcategory_name' => 'Music & CDs', 'subcategory_name_ar' => 'الموسيقى والأقراص المدمجة', 'slug' => 'music-cds', 'status' => 'active'],
            ['id' => 119, 'category_id' => 16, 'category_name' => 'Books, Movies & Music', 'subcategory_name' => 'Musical Instruments', 'subcategory_name_ar' => 'الآلات الموسيقية', 'slug' => 'musical-instruments', 'status' => 'active'],
            ['id' => 120, 'category_id' => 16, 'category_name' => 'Books, Movies & Music', 'subcategory_name' => 'Vinyl & Records', 'subcategory_name_ar' => 'أسطوانات الفينيل والتسجيلات', 'slug' => 'vinyl-records', 'status' => 'active'],

            // =========================================================
            // 17. Paper & Party Supplies
            // =========================================================
            ['id' => 121, 'category_id' => 17, 'category_name' => 'Paper & Party Supplies', 'subcategory_name' => 'Stationery', 'subcategory_name_ar' => 'القرطاسية', 'slug' => 'stationery', 'status' => 'active'],
            ['id' => 122, 'category_id' => 17, 'category_name' => 'Paper & Party Supplies', 'subcategory_name' => 'School Supplies', 'subcategory_name_ar' => 'مستلزمات المدرسة', 'slug' => 'school-supplies', 'status' => 'active'],
            ['id' => 123, 'category_id' => 17, 'category_name' => 'Paper & Party Supplies', 'subcategory_name' => 'Office Supplies', 'subcategory_name_ar' => 'مستلزمات المكتب', 'slug' => 'office-supplies', 'status' => 'active'],
            ['id' => 124, 'category_id' => 17, 'category_name' => 'Paper & Party Supplies', 'subcategory_name' => 'Party Decorations', 'subcategory_name_ar' => 'زينة الحفلات', 'slug' => 'party-decorations', 'status' => 'active'],
            ['id' => 125, 'category_id' => 17, 'category_name' => 'Paper & Party Supplies', 'subcategory_name' => 'Balloons', 'subcategory_name_ar' => 'البالونات', 'slug' => 'balloons', 'status' => 'active'],
            ['id' => 126, 'category_id' => 17, 'category_name' => 'Paper & Party Supplies', 'subcategory_name' => 'Party Tableware', 'subcategory_name_ar' => 'مستلزمات مائدة الحفلات', 'slug' => 'party-tableware', 'status' => 'active'],
            ['id' => 127, 'category_id' => 17, 'category_name' => 'Paper & Party Supplies', 'subcategory_name' => 'Invitations & Cards', 'subcategory_name_ar' => 'الدعوات والبطاقات', 'slug' => 'invitations-cards', 'status' => 'active'],
            ['id' => 128, 'category_id' => 17, 'category_name' => 'Paper & Party Supplies', 'subcategory_name' => 'Wrapping & Gift Packaging', 'subcategory_name_ar' => 'التغليف وتعبئة الهدايا', 'slug' => 'wrapping-gift-packaging', 'status' => 'active'],

            // =========================================================
            // 18. Local & Traditional Products
            // =========================================================
            ['id' => 129, 'category_id' => 18, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Dates & Date Products', 'subcategory_name_ar' => 'التمور ومنتجاتها', 'slug' => 'dates-date-products', 'status' => 'active'],

            ['id' => 130, 'category_id' => 18, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Arabic Sweets & Desserts', 'subcategory_name_ar' => 'الحلويات العربية', 'slug' => 'arabic-sweets-desserts', 'status' => 'active'],

            ['id' => 131, 'category_id' => 18, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Honey & Natural Products', 'subcategory_name_ar' => 'العسل والمنتجات الطبيعية', 'slug' => 'honey-natural-products', 'status' => 'active'],

            ['id' => 132, 'category_id' => 18, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Spices & Traditional Ingredients', 'subcategory_name_ar' => 'التوابل والمكونات التقليدية', 'slug' => 'spices-traditional-ingredients', 'status' => 'active'],

            ['id' => 133, 'category_id' => 18, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Arabic Coffee & Tea', 'subcategory_name_ar' => 'القهوة والشاي العربي', 'slug' => 'arabic-coffee-tea', 'status' => 'active'],

            ['id' => 134, 'category_id' => 18, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Traditional Clothing', 'subcategory_name_ar' => 'الملابس التقليدية', 'slug' => 'traditional-clothing', 'status' => 'active'],

            ['id' => 135, 'category_id' => 18, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Perfumes & Oud', 'subcategory_name_ar' => 'العطور والعود', 'slug' => 'perfumes-oud', 'status' => 'active'],

            ['id' => 136, 'category_id' => 18, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Bakhoor & Incense', 'subcategory_name_ar' => 'البخور والعود المعطر', 'slug' => 'bakhoor-incense', 'status' => 'active'],

            ['id' => 137, 'category_id' => 18, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Traditional Handicrafts', 'subcategory_name_ar' => 'الحرف اليدوية التقليدية', 'slug' => 'traditional-handicrafts', 'status' => 'active'],

            ['id' => 138, 'category_id' => 18, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Pottery & Ceramics', 'subcategory_name_ar' => 'الفخار والسيراميك', 'slug' => 'pottery-ceramics', 'status' => 'active'],

            ['id' => 139, 'category_id' => 18, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Palm & Date Palm Products', 'subcategory_name_ar' => 'منتجات النخيل وسعف النخيل', 'slug' => 'palm-date-palm-products', 'status' => 'active'],

            ['id' => 140, 'category_id' => 18, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Traditional Home Décor', 'subcategory_name_ar' => 'الديكور المنزلي التقليدي', 'slug' => 'traditional-home-decor', 'status' => 'active'],

            ['id' => 141, 'category_id' => 18, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'UAE Souvenirs & Gifts', 'subcategory_name_ar' => 'الهدايا والتذكارات الإماراتية', 'slug' => 'uae-souvenirs-gifts', 'status' => 'active'],

            ['id' => 142, 'category_id' => 18, 'category_name' => 'Local & Traditional Products', 'subcategory_name' => 'Traditional Accessories & Jewelry', 'subcategory_name_ar' => 'الإكسسوارات والمجوهرات التقليدية', 'slug' => 'traditional-accessories-jewelry', 'status' => 'active'],
        ];
        SubCategory::insert($subcategoryRecords);
    }
}
