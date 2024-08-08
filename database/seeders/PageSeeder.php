<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            'name' => "About Us",
            'title' => "About Murwaj",
            'subtitle' => "Our mission",
            'slug' => "about",
            'short_des' => "Murooj is an advertising group, to help your
                            business grow through digital marketing.",
            'content' => "Is to provide the most effective digital marketing solutions in the industry,
                            focusing on a high-touch customer experience that delivers results so we can use our profits
                            to reinvest in the success of our clients, our team, and our community.",
            'created_by' => "Murwaj is lovingly made possible",
            'developer' => "AsmarTechniq",
            'image' => "",
            'url' => "https://asmartechniq.vercel.app/",
            'meta_title' => "",
            'meta_keywords' => "",
            'meta_description' => "",
        );
        DB::table('pages')->insert($data);
    }
}
