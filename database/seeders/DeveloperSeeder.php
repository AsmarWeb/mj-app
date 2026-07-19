<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();


        Developer::create([

            'user_id' => $user->id,

            'name' => 'murwaj Team',

            'role' => 'Founder / Lead Developer',

            'github' => 'https://github.com/AsmarWeb/murwaj',

            'linkedin' => null,

            'website' => 'https://murwaj.com',

            'bio' => 'The team behind murwaj.com. We build modern web solutions, marketplaces, and digital platforms with Laravel, PHP, JavaScript, and cloud technologies.',

            'avatar' => "developers/logo.png",

            'approved' => true,

        ]);
    }
}
