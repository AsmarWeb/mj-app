<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [

            // =========================================================
            // UNITED ARAB EMIRATES
            // =========================================================

            [
                'id' => 1,
                'country_id' => 1,
                'name' => 'Dubai',
                'name_ar' => 'دبي',
                'image' => '',
            ],
            [
                'id' => 2,
                'country_id' => 1,
                'name' => 'Abu Dhabi',
                'name_ar' => 'أبوظبي',
                'image' => '',
            ],
            [
                'id' => 3,
                'country_id' => 1,
                'name' => 'Sharjah',
                'name_ar' => 'الشارقة',
                'image' => '',
            ],
            [
                'id' => 4,
                'country_id' => 1,
                'name' => 'Ajman',
                'name_ar' => 'عجمان',
                'image' => '',
            ],
            [
                'id' => 5,
                'country_id' => 1,
                'name' => 'Fujairah',
                'name_ar' => 'الفجيرة',
                'image' => '',
            ],
            [
                'id' => 6,
                'country_id' => 1,
                'name' => 'Umm Al Quwain',
                'name_ar' => 'أم القيوين',
                'image' => '',
            ],
            [
                'id' => 7,
                'country_id' => 1,
                'name' => 'Ras Al Khaimah',
                'name_ar' => 'رأس الخيمة',
                'image' => '',
            ],


            // =========================================================
            // SAUDI ARABIA
            // =========================================================

            [
                'id' => 8,
                'country_id' => 2,
                'name' => 'Riyadh',
                'name_ar' => 'الرياض',
                'image' => '',
            ],
            [
                'id' => 9,
                'country_id' => 2,
                'name' => 'Makkah',
                'name_ar' => 'مكة المكرمة',
                'image' => '',
            ],
            [
                'id' => 10,
                'country_id' => 2,
                'name' => 'Madinah',
                'name_ar' => 'المدينة المنورة',
                'image' => '',
            ],
            [
                'id' => 11,
                'country_id' => 2,
                'name' => 'Eastern Province',
                'name_ar' => 'المنطقة الشرقية',
                'image' => '',
            ],
            [
                'id' => 12,
                'country_id' => 2,
                'name' => 'Asir',
                'name_ar' => 'عسير',
                'image' => '',
            ],
            [
                'id' => 13,
                'country_id' => 2,
                'name' => 'Tabuk',
                'name_ar' => 'تبوك',
                'image' => '',
            ],
            [
                'id' => 14,
                'country_id' => 2,
                'name' => 'Qassim',
                'name_ar' => 'القصيم',
                'image' => '',
            ],
            [
                'id' => 15,
                'country_id' => 2,
                'name' => 'Hail',
                'name_ar' => 'حائل',
                'image' => '',
            ],
            [
                'id' => 16,
                'country_id' => 2,
                'name' => 'Jazan',
                'name_ar' => 'جازان',
                'image' => '',
            ],
            [
                'id' => 17,
                'country_id' => 2,
                'name' => 'Najran',
                'name_ar' => 'نجران',
                'image' => '',
            ],
            [
                'id' => 18,
                'country_id' => 2,
                'name' => 'Al Bahah',
                'name_ar' => 'الباحة',
                'image' => '',
            ],
            [
                'id' => 19,
                'country_id' => 2,
                'name' => 'Al Jawf',
                'name_ar' => 'الجوف',
                'image' => '',
            ],
            [
                'id' => 20,
                'country_id' => 2,
                'name' => 'Northern Borders',
                'name_ar' => 'الحدود الشمالية',
                'image' => '',
            ],


            // =========================================================
            // QATAR
            // =========================================================

            [
                'id' => 21,
                'country_id' => 3,
                'name' => 'Doha',
                'name_ar' => 'الدوحة',
                'image' => '',
            ],
            [
                'id' => 22,
                'country_id' => 3,
                'name' => 'Al Rayyan',
                'name_ar' => 'الريان',
                'image' => '',
            ],
            [
                'id' => 23,
                'country_id' => 3,
                'name' => 'Al Wakrah',
                'name_ar' => 'الوكرة',
                'image' => '',
            ],
            [
                'id' => 24,
                'country_id' => 3,
                'name' => 'Al Khor',
                'name_ar' => 'الخور',
                'image' => '',
            ],
            [
                'id' => 25,
                'country_id' => 3,
                'name' => 'Al Shamal',
                'name_ar' => 'الشمال',
                'image' => '',
            ],
            [
                'id' => 26,
                'country_id' => 3,
                'name' => 'Umm Salal',
                'name_ar' => 'أم صلال',
                'image' => '',
            ],
            [
                'id' => 27,
                'country_id' => 3,
                'name' => 'Al Daayen',
                'name_ar' => 'الظعاين',
                'image' => '',
            ],


            // =========================================================
            // KUWAIT
            // =========================================================

            [
                'id' => 28,
                'country_id' => 4,
                'name' => 'Kuwait City',
                'name_ar' => 'مدينة الكويت',
                'image' => '',
            ],
            [
                'id' => 29,
                'country_id' => 4,
                'name' => 'Hawalli',
                'name_ar' => 'حولي',
                'image' => '',
            ],
            [
                'id' => 30,
                'country_id' => 4,
                'name' => 'Farwaniya',
                'name_ar' => 'الفروانية',
                'image' => '',
            ],
            [
                'id' => 31,
                'country_id' => 4,
                'name' => 'Ahmadi',
                'name_ar' => 'الأحمدي',
                'image' => '',
            ],
            [
                'id' => 32,
                'country_id' => 4,
                'name' => 'Jahra',
                'name_ar' => 'الجهراء',
                'image' => '',
            ],
            [
                'id' => 33,
                'country_id' => 4,
                'name' => 'Mubarak Al-Kabeer',
                'name_ar' => 'مبارك الكبير',
                'image' => '',
            ],


            // =========================================================
            // BAHRAIN
            // =========================================================

            [
                'id' => 34,
                'country_id' => 5,
                'name' => 'Manama',
                'name_ar' => 'المنامة',
                'image' => '',
            ],
            [
                'id' => 35,
                'country_id' => 5,
                'name' => 'Muharraq',
                'name_ar' => 'المحرق',
                'image' => '',
            ],
            [
                'id' => 36,
                'country_id' => 5,
                'name' => 'Northern Governorate',
                'name_ar' => 'المحافظة الشمالية',
                'image' => '',
            ],
            [
                'id' => 37,
                'country_id' => 5,
                'name' => 'Southern Governorate',
                'name_ar' => 'المحافظة الجنوبية',
                'image' => '',
            ],


            // =========================================================
            // OMAN
            // =========================================================

            [
                'id' => 38,
                'country_id' => 6,
                'name' => 'Muscat',
                'name_ar' => 'مسقط',
                'image' => '',
            ],
            [
                'id' => 39,
                'country_id' => 6,
                'name' => 'Dhofar',
                'name_ar' => 'ظفار',
                'image' => '',
            ],
            [
                'id' => 40,
                'country_id' => 6,
                'name' => 'North Al Batinah',
                'name_ar' => 'شمال الباطنة',
                'image' => '',
            ],
            [
                'id' => 41,
                'country_id' => 6,
                'name' => 'South Al Batinah',
                'name_ar' => 'جنوب الباطنة',
                'image' => '',
            ],
            [
                'id' => 42,
                'country_id' => 6,
                'name' => 'Ad Dakhiliyah',
                'name_ar' => 'الداخلية',
                'image' => '',
            ],
            [
                'id' => 43,
                'country_id' => 6,
                'name' => 'North Ash Sharqiyah',
                'name_ar' => 'شمال الشرقية',
                'image' => '',
            ],
            [
                'id' => 44,
                'country_id' => 6,
                'name' => 'South Ash Sharqiyah',
                'name_ar' => 'جنوب الشرقية',
                'image' => '',
            ],
            [
                'id' => 45,
                'country_id' => 6,
                'name' => 'Al Buraimi',
                'name_ar' => 'البريمي',
                'image' => '',
            ],
            [
                'id' => 46,
                'country_id' => 6,
                'name' => 'Musandam',
                'name_ar' => 'مسندم',
                'image' => '',
            ],
            [
                'id' => 47,
                'country_id' => 6,
                'name' => 'Al Wusta',
                'name_ar' => 'الوسطى',
                'image' => '',
            ],
        ];

        DB::table('states')->insert($states);
    }
}
