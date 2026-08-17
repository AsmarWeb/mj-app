<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [

            // =========================================================
            // UAE - DUBAI (state_id: 1)
            // =========================================================

            ['id' => 1, 'state_id' => 1, 'name' => 'Abu Hail', 'name_ar' => 'أبو هيل'],
            ['id' => 2, 'state_id' => 1, 'name' => 'Al Quoz', 'name_ar' => 'القوز'],
            ['id' => 3, 'state_id' => 1, 'name' => 'Al Qusais', 'name_ar' => 'القصيص'],
            ['id' => 4, 'state_id' => 1, 'name' => 'Downtown Dubai', 'name_ar' => 'وسط مدينة دبي'],
            ['id' => 5, 'state_id' => 1, 'name' => 'Deira', 'name_ar' => 'ديرة'],
            ['id' => 6, 'state_id' => 1, 'name' => 'Bur Dubai', 'name_ar' => 'بر دبي'],
            ['id' => 7, 'state_id' => 1, 'name' => 'Jumeirah', 'name_ar' => 'جميرا'],
            ['id' => 8, 'state_id' => 1, 'name' => 'Business Bay', 'name_ar' => 'الخليج التجاري'],
            ['id' => 9, 'state_id' => 1, 'name' => 'Dubai Marina', 'name_ar' => 'مرسى دبي'],
            ['id' => 10, 'state_id' => 1, 'name' => 'Jebel Ali', 'name_ar' => 'جبل علي'],

            // =========================================================
            // UAE - ABU DHABI (state_id: 2)
            // =========================================================

            ['id' => 11, 'state_id' => 2, 'name' => 'Abu Dhabi City', 'name_ar' => 'مدينة أبوظبي'],
            ['id' => 12, 'state_id' => 2, 'name' => 'Al Ain', 'name_ar' => 'العين'],
            ['id' => 13, 'state_id' => 2, 'name' => 'Madinat Zayed', 'name_ar' => 'مدينة زايد'],
            ['id' => 14, 'state_id' => 2, 'name' => 'Ghayathi', 'name_ar' => 'غياثي'],
            ['id' => 15, 'state_id' => 2, 'name' => 'Ruwais', 'name_ar' => 'الرويس'],
            ['id' => 16, 'state_id' => 2, 'name' => 'Liwa', 'name_ar' => 'ليوا'],
            ['id' => 17, 'state_id' => 2, 'name' => 'Al Dhannah', 'name_ar' => 'الظنة'],
            ['id' => 18, 'state_id' => 2, 'name' => 'Sir Bani Yas', 'name_ar' => 'صير بني ياس'],

            // =========================================================
            // UAE - SHARJAH (state_id: 3)
            // =========================================================

            ['id' => 19, 'state_id' => 3, 'name' => 'Sharjah City', 'name_ar' => 'مدينة الشارقة'],
            ['id' => 20, 'state_id' => 3, 'name' => 'Al Nahda', 'name_ar' => 'النهدة'],
            ['id' => 21, 'state_id' => 3, 'name' => 'Al Majaz', 'name_ar' => 'المجاز'],
            ['id' => 22, 'state_id' => 3, 'name' => 'Al Qasimia', 'name_ar' => 'القاسمية'],
            ['id' => 23, 'state_id' => 3, 'name' => 'Muwaileh', 'name_ar' => 'مويلح'],
            ['id' => 24, 'state_id' => 3, 'name' => 'Al Khan', 'name_ar' => 'الخان'],
            ['id' => 25, 'state_id' => 3, 'name' => 'Khor Fakkan', 'name_ar' => 'خورفكان'],
            ['id' => 26, 'state_id' => 3, 'name' => 'Kalba', 'name_ar' => 'كلباء'],

            // =========================================================
            // UAE - AJMAN (state_id: 4)
            // =========================================================

            ['id' => 27, 'state_id' => 4, 'name' => 'Ajman City', 'name_ar' => 'مدينة عجمان'],
            ['id' => 28, 'state_id' => 4, 'name' => 'Al Nuaimiya', 'name_ar' => 'النعيمية'],
            ['id' => 29, 'state_id' => 4, 'name' => 'Al Rashidiya', 'name_ar' => 'الراشدية'],
            ['id' => 30, 'state_id' => 4, 'name' => 'Al Jurf', 'name_ar' => 'الجرف'],
            ['id' => 31, 'state_id' => 4, 'name' => 'Al Rawda', 'name_ar' => 'الروضة'],
            ['id' => 32, 'state_id' => 4, 'name' => 'Masfout', 'name_ar' => 'مصفوت'],

            // =========================================================
            // UAE - FUJAIRAH (state_id: 5)
            // =========================================================

            ['id' => 33, 'state_id' => 5, 'name' => 'Fujairah City', 'name_ar' => 'مدينة الفجيرة'],
            ['id' => 34, 'state_id' => 5, 'name' => 'Dibba Al Fujairah', 'name_ar' => 'دبا الفجيرة'],
            ['id' => 35, 'state_id' => 5, 'name' => 'Al Aqah', 'name_ar' => 'العقة'],
            ['id' => 36, 'state_id' => 5, 'name' => 'Masafi', 'name_ar' => 'مسافي'],
            ['id' => 37, 'state_id' => 5, 'name' => 'Sakamkam', 'name_ar' => 'سكمكم'],

            // =========================================================
            // UAE - UMM AL QUWAIN (state_id: 6)
            // =========================================================

            ['id' => 38, 'state_id' => 6, 'name' => 'Umm Al Quwain City', 'name_ar' => 'مدينة أم القيوين'],
            ['id' => 39, 'state_id' => 6, 'name' => 'Al Salamah', 'name_ar' => 'السلامة'],
            ['id' => 40, 'state_id' => 6, 'name' => 'Al Ras', 'name_ar' => 'الراس'],
            ['id' => 41, 'state_id' => 6, 'name' => 'Falaj Al Mualla', 'name_ar' => 'فلج المعلا'],

            // =========================================================
            // UAE - RAS AL KHAIMAH (state_id: 7)
            // =========================================================

            ['id' => 42, 'state_id' => 7, 'name' => 'Ras Al Khaimah City', 'name_ar' => 'مدينة رأس الخيمة'],
            ['id' => 43, 'state_id' => 7, 'name' => 'Al Hamra Village', 'name_ar' => 'قرية الحمراء'],
            ['id' => 44, 'state_id' => 7, 'name' => 'Al Nakheel', 'name_ar' => 'النخيل'],
            ['id' => 45, 'state_id' => 7, 'name' => 'Al Dhait', 'name_ar' => 'الظيت'],
            ['id' => 46, 'state_id' => 7, 'name' => 'Khuzam', 'name_ar' => 'خزام'],
            ['id' => 47, 'state_id' => 7, 'name' => 'Digdaga', 'name_ar' => 'دقداقة'],

            // =========================================================
            // SAUDI ARABIA - RIYADH (state_id: 8)
            // =========================================================

            ['id' => 48, 'state_id' => 8, 'name' => 'Riyadh City', 'name_ar' => 'مدينة الرياض'],
            ['id' => 49, 'state_id' => 8, 'name' => 'Al Kharj', 'name_ar' => 'الخرج'],
            ['id' => 50, 'state_id' => 8, 'name' => 'Al Majmaah', 'name_ar' => 'المجمعة'],
            ['id' => 51, 'state_id' => 8, 'name' => 'Wadi Al Dawasir', 'name_ar' => 'وادي الدواسر'],
            ['id' => 52, 'state_id' => 8, 'name' => 'Ad Dawadimi', 'name_ar' => 'الدوادمي'],

            // =========================================================
            // SAUDI ARABIA - MAKKAH (state_id: 9)
            // =========================================================

            ['id' => 53, 'state_id' => 9, 'name' => 'Makkah City', 'name_ar' => 'مكة المكرمة'],
            ['id' => 54, 'state_id' => 9, 'name' => 'Jeddah', 'name_ar' => 'جدة'],
            ['id' => 55, 'state_id' => 9, 'name' => 'Taif', 'name_ar' => 'الطائف'],
            ['id' => 56, 'state_id' => 9, 'name' => 'Rabigh', 'name_ar' => 'رابغ'],
            ['id' => 57, 'state_id' => 9, 'name' => 'Al Lith', 'name_ar' => 'الليث'],

            // =========================================================
            // SAUDI ARABIA - MADINAH (state_id: 10)
            // =========================================================

            ['id' => 58, 'state_id' => 10, 'name' => 'Madinah City', 'name_ar' => 'المدينة المنورة'],
            ['id' => 59, 'state_id' => 10, 'name' => 'Yanbu', 'name_ar' => 'ينبع'],
            ['id' => 60, 'state_id' => 10, 'name' => 'Al Ula', 'name_ar' => 'العلا'],
            ['id' => 61, 'state_id' => 10, 'name' => 'Badr', 'name_ar' => 'بدر'],

            // =========================================================
            // SAUDI ARABIA - EASTERN PROVINCE (state_id: 11)
            // =========================================================

            ['id' => 62, 'state_id' => 11, 'name' => 'Dammam', 'name_ar' => 'الدمام'],
            ['id' => 63, 'state_id' => 11, 'name' => 'Al Khobar', 'name_ar' => 'الخبر'],
            ['id' => 64, 'state_id' => 11, 'name' => 'Dhahran', 'name_ar' => 'الظهران'],
            ['id' => 65, 'state_id' => 11, 'name' => 'Al Ahsa', 'name_ar' => 'الأحساء'],
            ['id' => 66, 'state_id' => 11, 'name' => 'Jubail', 'name_ar' => 'الجبيل'],
            ['id' => 67, 'state_id' => 11, 'name' => 'Qatif', 'name_ar' => 'القطيف'],

            // =========================================================
            // QATAR - DOHA (state_id: 21)
            // =========================================================

            ['id' => 68, 'state_id' => 21, 'name' => 'Doha City', 'name_ar' => 'مدينة الدوحة'],
            ['id' => 69, 'state_id' => 21, 'name' => 'Al Sadd', 'name_ar' => 'السد'],
            ['id' => 70, 'state_id' => 21, 'name' => 'West Bay', 'name_ar' => 'الخليج الغربي'],
            ['id' => 71, 'state_id' => 21, 'name' => 'Old Airport', 'name_ar' => 'المطار القديم'],

            // =========================================================
            // QATAR - AL RAYYAN (state_id: 22)
            // =========================================================

            ['id' => 72, 'state_id' => 22, 'name' => 'Al Rayyan City', 'name_ar' => 'مدينة الريان'],
            ['id' => 73, 'state_id' => 22, 'name' => 'Education City', 'name_ar' => 'المدينة التعليمية'],
            ['id' => 74, 'state_id' => 22, 'name' => 'Al Waab', 'name_ar' => 'الوعب'],

            // =========================================================
            // QATAR - AL WAKRAH (state_id: 23)
            // =========================================================

            ['id' => 75, 'state_id' => 23, 'name' => 'Al Wakrah City', 'name_ar' => 'مدينة الوكرة'],
            ['id' => 76, 'state_id' => 23, 'name' => 'Mesaieed', 'name_ar' => 'مسيعيد'],

            // =========================================================
            // KUWAIT - KUWAIT CITY (state_id: 28)
            // =========================================================

            ['id' => 77, 'state_id' => 28, 'name' => 'Kuwait City', 'name_ar' => 'مدينة الكويت'],
            ['id' => 78, 'state_id' => 28, 'name' => 'Sharq', 'name_ar' => 'شرق'],
            ['id' => 79, 'state_id' => 28, 'name' => 'Dasman', 'name_ar' => 'دسمان'],
            ['id' => 80, 'state_id' => 28, 'name' => 'Qibla', 'name_ar' => 'القبلة'],

            // =========================================================
            // KUWAIT - HAWALLI (state_id: 29)
            // =========================================================

            ['id' => 81, 'state_id' => 29, 'name' => 'Hawalli City', 'name_ar' => 'مدينة حولي'],
            ['id' => 82, 'state_id' => 29, 'name' => 'Salmiya', 'name_ar' => 'السالمية'],
            ['id' => 83, 'state_id' => 29, 'name' => 'Jabriya', 'name_ar' => 'الجابرية'],
            ['id' => 84, 'state_id' => 29, 'name' => 'Bayan', 'name_ar' => 'بيان'],

            // =========================================================
            // KUWAIT - FARWANIYA (state_id: 30)
            // =========================================================

            ['id' => 85, 'state_id' => 30, 'name' => 'Farwaniya City', 'name_ar' => 'مدينة الفروانية'],
            ['id' => 86, 'state_id' => 30, 'name' => 'Khaitan', 'name_ar' => 'خيطان'],
            ['id' => 87, 'state_id' => 30, 'name' => 'Jleeb Al-Shuyoukh', 'name_ar' => 'جليب الشيوخ'],

            // =========================================================
            // BAHRAIN - MANAMA (state_id: 34)
            // =========================================================

            ['id' => 88, 'state_id' => 34, 'name' => 'Manama City', 'name_ar' => 'مدينة المنامة'],
            ['id' => 89, 'state_id' => 34, 'name' => 'Juffair', 'name_ar' => 'الجفير'],
            ['id' => 90, 'state_id' => 34, 'name' => 'Adliya', 'name_ar' => 'العدلية'],
            ['id' => 91, 'state_id' => 34, 'name' => 'Seef', 'name_ar' => 'السيف'],

            // =========================================================
            // BAHRAIN - MUHARRAQ (state_id: 35)
            // =========================================================

            ['id' => 92, 'state_id' => 35, 'name' => 'Muharraq City', 'name_ar' => 'مدينة المحرق'],
            ['id' => 93, 'state_id' => 35, 'name' => 'Arad', 'name_ar' => 'عراد'],
            ['id' => 94, 'state_id' => 35, 'name' => 'Busaiteen', 'name_ar' => 'البسيتين'],

            // =========================================================
            // OMAN - MUSCAT (state_id: 38)
            // =========================================================

            ['id' => 95, 'state_id' => 38, 'name' => 'Muscat City', 'name_ar' => 'مدينة مسقط'],
            ['id' => 96, 'state_id' => 38, 'name' => 'Muttrah', 'name_ar' => 'مطرح'],
            ['id' => 97, 'state_id' => 38, 'name' => 'Seeb', 'name_ar' => 'السيب'],
            ['id' => 98, 'state_id' => 38, 'name' => 'Bawshar', 'name_ar' => 'بوشر'],
            ['id' => 99, 'state_id' => 38, 'name' => 'Al Amerat', 'name_ar' => 'العامرات'],
            ['id' => 100, 'state_id' => 38, 'name' => 'Qurayyat', 'name_ar' => 'قريات'],

            // =========================================================
            // OMAN - DHOFAR (state_id: 39)
            // =========================================================

            ['id' => 101, 'state_id' => 39, 'name' => 'Salalah', 'name_ar' => 'صلالة'],
            ['id' => 102, 'state_id' => 39, 'name' => 'Mirbat', 'name_ar' => 'مرباط'],
            ['id' => 103, 'state_id' => 39, 'name' => 'Taqah', 'name_ar' => 'طاقة'],
            ['id' => 104, 'state_id' => 39, 'name' => 'Thumrait', 'name_ar' => 'ثمريت'],

            // =========================================================
            // OMAN - NORTH AL BATINAH (state_id: 40)
            // =========================================================

            ['id' => 105, 'state_id' => 40, 'name' => 'Sohar', 'name_ar' => 'صحار'],
            ['id' => 106, 'state_id' => 40, 'name' => 'Shinas', 'name_ar' => 'شناص'],
            ['id' => 107, 'state_id' => 40, 'name' => 'Liwa', 'name_ar' => 'لوى'],
            ['id' => 108, 'state_id' => 40, 'name' => 'Saham', 'name_ar' => 'صحم'],

        ];

        DB::table('cities')->insert($cities);
    }
}
