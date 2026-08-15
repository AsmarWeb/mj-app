<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Brands by SubCategory
        |--------------------------------------------------------------------------
        | Use the SUBCATEGORY SLUG as the key.
        | subcategory_id and subcategory_name come from the database.
        |--------------------------------------------------------------------------
        */

        $brandsBySubCategory = [

            // =========================================================
            // Electronics
            // =========================================================

            'audio' => [
                ['name' => 'Sony', 'name_ar' => 'سوني'],
                ['name' => 'JBL', 'name_ar' => 'جي بي إل'],
                ['name' => 'Bose', 'name_ar' => 'بوز'],
                ['name' => 'Sennheiser', 'name_ar' => 'سنهايزر'],
                ['name' => 'Audio-Technica', 'name_ar' => 'أوديو تكنيكا'],
                ['name' => 'Marshall', 'name_ar' => 'مارشال'],
            ],

            'tv & video' => [
                ['name' => 'Samsung', 'name_ar' => 'سامسونج'],
                ['name' => 'LG', 'name_ar' => 'إل جي'],
                ['name' => 'Sony', 'name_ar' => 'سوني'],
                ['name' => 'TCL', 'name_ar' => 'تي سي إل'],
                ['name' => 'Hisense', 'name_ar' => 'هايسنس'],
                ['name' => 'Philips', 'name_ar' => 'فيليبس'],
            ],

            'batteries & charging' => [
                ['name' => 'Anker', 'name_ar' => 'أنكر'],
                ['name' => 'Belkin', 'name_ar' => 'بيلكين'],
                ['name' => 'Baseus', 'name_ar' => 'بيسوس'],
                ['name' => 'UGREEN', 'name_ar' => 'يوجرين'],
                ['name' => 'Duracell', 'name_ar' => 'دوراسيل'],
                ['name' => 'Energizer', 'name_ar' => 'إنرجايزر'],
            ],

            'cables & cords' => [
                ['name' => 'Anker', 'name_ar' => 'أنكر'],
                ['name' => 'Belkin', 'name_ar' => 'بيلكين'],
                ['name' => 'Baseus', 'name_ar' => 'بيسوس'],
                ['name' => 'UGREEN', 'name_ar' => 'يوجرين'],
                ['name' => 'UGREEN', 'name_ar' => 'يوجرين'],
            ],

            'cameras & equipment' => [
                ['name' => 'Canon', 'name_ar' => 'كانون'],
                ['name' => 'Nikon', 'name_ar' => 'نيكون'],
                ['name' => 'Sony', 'name_ar' => 'سوني'],
                ['name' => 'Fujifilm', 'name_ar' => 'فوجي فيلم'],
                ['name' => 'Panasonic', 'name_ar' => 'باناسونيك'],
                ['name' => 'GoPro', 'name_ar' => 'جو برو'],
                ['name' => 'DJI', 'name_ar' => 'دي جي آي'],
            ],

            'car parts & accessories' => [
                ['name' => 'Bosch', 'name_ar' => 'بوش'],
                ['name' => 'Denso', 'name_ar' => 'دينسو'],
                ['name' => 'Brembo', 'name_ar' => 'بريمبو'],
                ['name' => 'NGK', 'name_ar' => 'إن جي كي'],
                ['name' => 'Mann-Filter', 'name_ar' => 'مان فلتر'],
            ],

            'cell phone accessories' => [
                ['name' => 'Apple', 'name_ar' => 'أبل'],
                ['name' => 'Samsung', 'name_ar' => 'سامسونج'],
                ['name' => 'Anker', 'name_ar' => 'أنكر'],
                ['name' => 'Belkin', 'name_ar' => 'بيلكين'],
                ['name' => 'Baseus', 'name_ar' => 'بيسوس'],
                ['name' => 'Spigen', 'name_ar' => 'سبايجن'],
                ['name' => 'UGREEN', 'name_ar' => 'يوجرين'],
            ],

            'computers & peripherals' => [
                ['name' => 'Apple', 'name_ar' => 'أبل'],
                ['name' => 'Dell', 'name_ar' => 'ديل'],
                ['name' => 'HP', 'name_ar' => 'إتش بي'],
                ['name' => 'Lenovo', 'name_ar' => 'لينوفو'],
                ['name' => 'ASUS', 'name_ar' => 'أسوس'],
                ['name' => 'Acer', 'name_ar' => 'أيسر'],
                ['name' => 'MSI', 'name_ar' => 'إم إس آي'],
                ['name' => 'Microsoft', 'name_ar' => 'مايكروسوفت'],
            ],

            'telephones & handsets' => [
                ['name' => 'Apple', 'name_ar' => 'أبل'],
                ['name' => 'Samsung', 'name_ar' => 'سامسونج'],
                ['name' => 'Google', 'name_ar' => 'جوجل'],
                ['name' => 'Xiaomi', 'name_ar' => 'شاومي'],
                ['name' => 'OnePlus', 'name_ar' => 'ون بلس'],
                ['name' => 'Huawei', 'name_ar' => 'هواوي'],
                ['name' => 'OPPO', 'name_ar' => 'أوبو'],
                ['name' => 'Vivo', 'name_ar' => 'فيفو'],
                ['name' => 'Honor', 'name_ar' => 'هونر'],
                ['name' => 'Nokia', 'name_ar' => 'نوكيا'],
            ],

            'gadgets' => [
                ['name' => 'Apple', 'name_ar' => 'أبل'],
                ['name' => 'Samsung', 'name_ar' => 'سامسونج'],
                ['name' => 'Xiaomi', 'name_ar' => 'شاومي'],
                ['name' => 'Anker', 'name_ar' => 'أنكر'],
                ['name' => 'Belkin', 'name_ar' => 'بيلكين'],
                ['name' => 'Garmin', 'name_ar' => 'جارمين'],
            ],

            // =========================================================
            // Home & Living
            // =========================================================

            'furniture' => [
                ['name' => 'IKEA', 'name_ar' => 'إيكيا'],
                ['name' => 'Ashley', 'name_ar' => 'أشلي'],
                ['name' => 'Home Centre', 'name_ar' => 'هوم سنتر'],
                ['name' => 'Danube Home', 'name_ar' => 'دانوب هوم'],
            ],

            'home appliances' => [
                ['name' => 'Samsung', 'name_ar' => 'سامسونج'],
                ['name' => 'LG', 'name_ar' => 'إل جي'],
                ['name' => 'Bosch', 'name_ar' => 'بوش'],
                ['name' => 'Whirlpool', 'name_ar' => 'ويرلبول'],
                ['name' => 'Philips', 'name_ar' => 'فيليبس'],
                ['name' => 'Panasonic', 'name_ar' => 'باناسونيك'],
            ],

            'lighting' => [
                ['name' => 'Philips', 'name_ar' => 'فيليبس'],
                ['name' => 'Osram', 'name_ar' => 'أوسرام'],
                ['name' => 'IKEA', 'name_ar' => 'إيكيا'],
            ],

            'kitchen & dining' => [
                ['name' => 'Tefal', 'name_ar' => 'تيفال'],
                ['name' => 'Pyrex', 'name_ar' => 'بايركس'],
                ['name' => 'IKEA', 'name_ar' => 'إيكيا'],
                ['name' => 'Zwilling', 'name_ar' => 'زويلينج'],
            ],

            // =========================================================
            // Cooking
            // =========================================================

            'cookware' => [
                ['name' => 'Tefal', 'name_ar' => 'تيفال'],
                ['name' => 'Moulinex', 'name_ar' => 'مولينكس'],
                ['name' => 'Zwilling', 'name_ar' => 'زويلينج'],
                ['name' => 'Le Creuset', 'name_ar' => 'لو كريوسيه'],
                ['name' => 'Pyrex', 'name_ar' => 'بايركس'],
            ],

            'bakeware' => [
                ['name' => 'Pyrex', 'name_ar' => 'بايركس'],
                ['name' => 'Wilton', 'name_ar' => 'ويلتون'],
                ['name' => 'Tefal', 'name_ar' => 'تيفال'],
            ],

            'kitchen appliances' => [
                ['name' => 'Philips', 'name_ar' => 'فيليبس'],
                ['name' => 'Kenwood', 'name_ar' => 'كينوود'],
                ['name' => 'KitchenAid', 'name_ar' => 'كيتشن إيد'],
                ['name' => 'Bosch', 'name_ar' => 'بوش'],
                ['name' => 'Moulinex', 'name_ar' => 'مولينكس'],
            ],

            // =========================================================
            // Fashion
            // =========================================================

            'men clothing' => [
                ['name' => 'Nike', 'name_ar' => 'نايكي'],
                ['name' => 'Adidas', 'name_ar' => 'أديداس'],
                ['name' => 'Puma', 'name_ar' => 'بوما'],
                ['name' => 'Zara', 'name_ar' => 'زارا'],
                ['name' => 'H&M', 'name_ar' => 'إتش آند إم'],
                ['name' => 'Levi\'s', 'name_ar' => 'ليفايز'],
            ],

            'women clothing' => [
                ['name' => 'Zara', 'name_ar' => 'زارا'],
                ['name' => 'H&M', 'name_ar' => 'إتش آند إم'],
                ['name' => 'Mango', 'name_ar' => 'مانجو'],
                ['name' => 'Nike', 'name_ar' => 'نايكي'],
                ['name' => 'Adidas', 'name_ar' => 'أديداس'],
            ],

            'kids clothing' => [
                ['name' => 'Nike', 'name_ar' => 'نايكي'],
                ['name' => 'Adidas', 'name_ar' => 'أديداس'],
                ['name' => 'Zara Kids', 'name_ar' => 'زارا كيدز'],
                ['name' => 'H&M', 'name_ar' => 'إتش آند إم'],
            ],

            'traditional clothing' => [
                ['name' => 'Al Yousuf', 'name_ar' => 'اليوسف'],
                ['name' => 'Al Motahajiba', 'name_ar' => 'المتحجبة'],
            ],

            'bags & wallets' => [
                ['name' => 'Louis Vuitton', 'name_ar' => 'لويس فويتون'],
                ['name' => 'Gucci', 'name_ar' => 'غوتشي'],
                ['name' => 'Coach', 'name_ar' => 'كوتش'],
                ['name' => 'Michael Kors', 'name_ar' => 'مايكل كورس'],
                ['name' => 'Samsonite', 'name_ar' => 'سامسونايت'],
            ],

            'watches' => [
                ['name' => 'Rolex', 'name_ar' => 'رولكس'],
                ['name' => 'Casio', 'name_ar' => 'كاسيو'],
                ['name' => 'Seiko', 'name_ar' => 'سيكو'],
                ['name' => 'Citizen', 'name_ar' => 'سيتزن'],
                ['name' => 'Omega', 'name_ar' => 'أوميغا'],
                ['name' => 'Tissot', 'name_ar' => 'تيسو'],
            ],

            'fashion accessories' => [
                ['name' => 'Gucci', 'name_ar' => 'غوتشي'],
                ['name' => 'Prada', 'name_ar' => 'برادا'],
                ['name' => 'Louis Vuitton', 'name_ar' => 'لويس فويتون'],
                ['name' => 'Coach', 'name_ar' => 'كوتش'],
            ],

            // =========================================================
            // Travel & Outdoor
            // =========================================================

            'camping & hiking' => [
                ['name' => 'The North Face', 'name_ar' => 'ذا نورث فيس'],
                ['name' => 'Columbia', 'name_ar' => 'كولومبيا'],
                ['name' => 'Quechua', 'name_ar' => 'كيتشوا'],
                ['name' => 'Coleman', 'name_ar' => 'كولمان'],
            ],

            'travel luggage' => [
                ['name' => 'Samsonite', 'name_ar' => 'سامسونايت'],
                ['name' => 'American Tourister', 'name_ar' => 'أمريكان توريستر'],
                ['name' => 'Delsey', 'name_ar' => 'ديلسي'],
                ['name' => 'Tumi', 'name_ar' => 'تومي'],
            ],

            'cycling' => [
                ['name' => 'Trek', 'name_ar' => 'تريك'],
                ['name' => 'Giant', 'name_ar' => 'جاينت'],
                ['name' => 'Specialized', 'name_ar' => 'سبيشلايزد'],
                ['name' => 'Cannondale', 'name_ar' => 'كانونديل'],
            ],

            'sports equipment' => [
                ['name' => 'Nike', 'name_ar' => 'نايكي'],
                ['name' => 'Adidas', 'name_ar' => 'أديداس'],
                ['name' => 'Puma', 'name_ar' => 'بوما'],
                ['name' => 'Under Armour', 'name_ar' => 'أندر آرمور'],
            ],

            // =========================================================
            // Shoes
            // =========================================================

            'men shoes' => [
                ['name' => 'Nike', 'name_ar' => 'نايكي'],
                ['name' => 'Adidas', 'name_ar' => 'أديداس'],
                ['name' => 'Puma', 'name_ar' => 'بوما'],
                ['name' => 'Clarks', 'name_ar' => 'كلاركس'],
                ['name' => 'Skechers', 'name_ar' => 'سكيتشرز'],
            ],

            'women shoes' => [
                ['name' => 'Nike', 'name_ar' => 'نايكي'],
                ['name' => 'Adidas', 'name_ar' => 'أديداس'],
                ['name' => 'Skechers', 'name_ar' => 'سكيتشرز'],
                ['name' => 'Aldo', 'name_ar' => 'ألدو'],
                ['name' => 'Clarks', 'name_ar' => 'كلاركس'],
            ],

            'kids shoes' => [
                ['name' => 'Nike', 'name_ar' => 'نايكي'],
                ['name' => 'Adidas', 'name_ar' => 'أديداس'],
                ['name' => 'Puma', 'name_ar' => 'بوما'],
                ['name' => 'Skechers', 'name_ar' => 'سكيتشرز'],
            ],

            'sneakers' => [
                ['name' => 'Nike', 'name_ar' => 'نايكي'],
                ['name' => 'Adidas', 'name_ar' => 'أديداس'],
                ['name' => 'New Balance', 'name_ar' => 'نيو بالانس'],
                ['name' => 'Puma', 'name_ar' => 'بوما'],
                ['name' => 'ASICS', 'name_ar' => 'أسكس'],
            ],

            // =========================================================
            // Automobile
            // =========================================================

            'cars' => [
                ['name' => 'Toyota', 'name_ar' => 'تويوتا'],
                ['name' => 'Nissan', 'name_ar' => 'نيسان'],
                ['name' => 'Honda', 'name_ar' => 'هوندا'],
                ['name' => 'BMW', 'name_ar' => 'بي إم دبليو'],
                ['name' => 'Mercedes-Benz', 'name_ar' => 'مرسيدس بنز'],
                ['name' => 'Ford', 'name_ar' => 'فورد'],
                ['name' => 'Hyundai', 'name_ar' => 'هيونداي'],
                ['name' => 'Kia', 'name_ar' => 'كيا'],
                ['name' => 'Lexus', 'name_ar' => 'لكزس'],
                ['name' => 'Chevrolet', 'name_ar' => 'شيفروليه'],
                ['name' => 'Land Rover', 'name_ar' => 'لاند روفر'],
                ['name' => 'Porsche', 'name_ar' => 'بورشه'],
            ],

            'suvs & 4x4' => [
                ['name' => 'Toyota', 'name_ar' => 'تويوتا'],
                ['name' => 'Nissan', 'name_ar' => 'نيسان'],
                ['name' => 'Land Rover', 'name_ar' => 'لاند روفر'],
                ['name' => 'Jeep', 'name_ar' => 'جيب'],
                ['name' => 'Ford', 'name_ar' => 'فورد'],
                ['name' => 'Lexus', 'name_ar' => 'لكزس'],
            ],

            'motorcycles' => [
                ['name' => 'Honda', 'name_ar' => 'هوندا'],
                ['name' => 'Yamaha', 'name_ar' => 'ياماها'],
                ['name' => 'Kawasaki', 'name_ar' => 'كاواساكي'],
                ['name' => 'Suzuki', 'name_ar' => 'سوزوكي'],
                ['name' => 'Harley-Davidson', 'name_ar' => 'هارلي ديفيدسون'],
                ['name' => 'BMW', 'name_ar' => 'بي إم دبليو'],
            ],

            'car parts' => [
                ['name' => 'Bosch', 'name_ar' => 'بوش'],
                ['name' => 'Denso', 'name_ar' => 'دينسو'],
                ['name' => 'Brembo', 'name_ar' => 'بريمبو'],
                ['name' => 'NGK', 'name_ar' => 'إن جي كي'],
                ['name' => 'Valeo', 'name_ar' => 'فاليو'],
            ],

            'tires & wheels' => [
                ['name' => 'Michelin', 'name_ar' => 'ميشلان'],
                ['name' => 'Bridgestone', 'name_ar' => 'بريدجستون'],
                ['name' => 'Goodyear', 'name_ar' => 'جوديير'],
                ['name' => 'Continental', 'name_ar' => 'كونتيننتال'],
                ['name' => 'Pirelli', 'name_ar' => 'بيريللي'],
                ['name' => 'Dunlop', 'name_ar' => 'دنلوب'],
            ],

            'car accessories' => [
                ['name' => 'Thule', 'name_ar' => 'ثول'],
                ['name' => '3M', 'name_ar' => 'ثري إم'],
                ['name' => 'Bosch', 'name_ar' => 'بوش'],
            ],

            // =========================================================
            // Software
            // =========================================================

            'business software' => [
                ['name' => 'Microsoft', 'name_ar' => 'مايكروسوفت'],
                ['name' => 'Oracle', 'name_ar' => 'أوراكل'],
                ['name' => 'SAP', 'name_ar' => 'ساب'],
                ['name' => 'Salesforce', 'name_ar' => 'سيلزفورس'],
            ],

            'accounting software' => [
                ['name' => 'QuickBooks', 'name_ar' => 'كويك بوكس'],
                ['name' => 'Xero', 'name_ar' => 'زيرو'],
                ['name' => 'Sage', 'name_ar' => 'سيج'],
                ['name' => 'Zoho', 'name_ar' => 'زوهو'],
            ],

            'design software' => [
                ['name' => 'Adobe', 'name_ar' => 'أدوبي'],
                ['name' => 'Autodesk', 'name_ar' => 'أوتوديسك'],
                ['name' => 'Corel', 'name_ar' => 'كوريل'],
                ['name' => 'Canva', 'name_ar' => 'كانفا'],
            ],

            'security software' => [
                ['name' => 'Norton', 'name_ar' => 'نورتون'],
                ['name' => 'McAfee', 'name_ar' => 'مكافي'],
                ['name' => 'Kaspersky', 'name_ar' => 'كاسبرسكي'],
                ['name' => 'Bitdefender', 'name_ar' => 'بت ديفندر'],
            ],

            'mobile apps' => [
                ['name' => 'Google', 'name_ar' => 'جوجل'],
                ['name' => 'Microsoft', 'name_ar' => 'مايكروسوفت'],
                ['name' => 'Adobe', 'name_ar' => 'أدوبي'],
                ['name' => 'Meta', 'name_ar' => 'ميتا'],
            ],

            // =========================================================
            // Books, Movies & Music
            // =========================================================

            'books' => [
                ['name' => 'Penguin Random House', 'name_ar' => 'بنغوين راندوم هاوس'],
                ['name' => 'HarperCollins', 'name_ar' => 'هاربر كولينز'],
                ['name' => 'Oxford University Press', 'name_ar' => 'مطبعة جامعة أكسفورد'],
            ],

            'textbooks' => [
                ['name' => 'Pearson', 'name_ar' => 'بيرسون'],
                ['name' => 'McGraw Hill', 'name_ar' => 'ماكجرو هيل'],
                ['name' => 'Oxford', 'name_ar' => 'أكسفورد'],
                ['name' => 'Cambridge', 'name_ar' => 'كامبريدج'],
            ],

            'musical instruments' => [
                ['name' => 'Yamaha', 'name_ar' => 'ياماها'],
                ['name' => 'Fender', 'name_ar' => 'فندر'],
                ['name' => 'Gibson', 'name_ar' => 'غيبسون'],
                ['name' => 'Roland', 'name_ar' => 'رولاند'],
                ['name' => 'Casio', 'name_ar' => 'كاسيو'],
            ],

            // =========================================================
            // Local & Traditional Products
            // =========================================================

            'dates & date products' => [
                ['name' => 'Bateel', 'name_ar' => 'بتيل'],
                ['name' => 'Al Foah', 'name_ar' => 'الفوعة'],
                ['name' => 'Al Barakah Dates', 'name_ar' => 'تمور البركة'],
            ],

            'honey & natural products' => [
                ['name' => 'Wadi Al Helo', 'name_ar' => 'وادي الحلو'],
                ['name' => 'Al Shifa', 'name_ar' => 'الشفاء'],
                ['name' => 'Manuka Health', 'name_ar' => 'مانوكا هيلث'],
            ],

            'arabic coffee & tea' => [
                ['name' => 'Ahmad Tea', 'name_ar' => 'أحمد تي'],
                ['name' => 'Al Ameed Coffee', 'name_ar' => 'قهوة العميد'],
                ['name' => 'Lipton', 'name_ar' => 'ليبتون'],
            ],

            'perfumes & oud' => [
                ['name' => 'Arabian Oud', 'name_ar' => 'العربية للعود'],
                ['name' => 'Ajmal', 'name_ar' => 'أجمل'],
                ['name' => 'Al Haramain', 'name_ar' => 'الحرمين'],
                ['name' => 'Amouage', 'name_ar' => 'أمواج'],
                ['name' => 'Swiss Arabian', 'name_ar' => 'السويس أربيان'],
            ],

            'bakhoor & incense' => [
                ['name' => 'Arabian Oud', 'name_ar' => 'العربية للعود'],
                ['name' => 'Ajmal', 'name_ar' => 'أجمل'],
                ['name' => 'Al Haramain', 'name_ar' => 'الحرمين'],
                ['name' => 'Abdul Samad Al Qurashi', 'name_ar' => 'عبد الصمد القرشي'],
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | Get ALL SubCategories from Database
        |--------------------------------------------------------------------------
        */

        $subcategories = SubCategory::query()
            ->where('status', 'active')
            ->get();

        $brandRecords = [];

        foreach ($subcategories as $subcategory) {

            /*
             * Find brands configured for this subcategory.
             *
             * IMPORTANT:
             * The subcategory itself comes from DB.
             */
            $brands = $brandsBySubCategory[$subcategory->slug] ?? [];

            /*
             |--------------------------------------------------------------------------
             | Add configured brands
             |--------------------------------------------------------------------------
             */

            foreach ($brands as $brand) {
                $brandRecords[] = [
                    'subcategory_id'   => $subcategory->id,
                    'subcategory_name' => $subcategory->subcategory_name,
                    'brand_name'       => $brand['name'],
                    'brand_name_ar'    => $brand['name_ar'],
                    'slug'             => Str::slug($brand['name']),
                    'status'           => 'active',
                ];
            }

            /*
             |--------------------------------------------------------------------------
             | ALWAYS ADD OTHER / UNBRANDED
             |--------------------------------------------------------------------------
             */

            $brandRecords[] = [
                'subcategory_id'   => $subcategory->id,
                'subcategory_name' => $subcategory->subcategory_name,
                'brand_name'       => 'Other / Unbranded',
                'brand_name_ar'    => 'أخرى / بدون علامة تجارية',
                'slug'             => 'other-unbranded-' . $subcategory->id,
                'status'           => 'active',
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Insert
        |--------------------------------------------------------------------------
        */

        Brand::insert($brandRecords);
    }
}
