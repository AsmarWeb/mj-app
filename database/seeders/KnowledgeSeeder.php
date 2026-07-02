<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KnowledgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('knowledge')->insert([
            [
            'question'=>'hi',
            'answer'=>'Hello'
            ],
            [
                'question'=>'what is your name',
                'answer'=>'My name is Knowledge Base.'
            ],
            [
                'question'=>'what is murwaj',
                'answer'=>'murwaj is an advertising group, to help your business grow through digital marketing.'
            ],
            [
                'question'=>'what is the purpose of this application',
                'answer'=>'The purpose of this application is to provide a knowledge base for frequently asked questions.'
            ],
            [
                'question'=>'how to use this application',
                'answer'=>'You can use this application by searching for your question in the search bar or browsing through the categories.'
            ],
            [
                'question'=>'what is this application about',
                'answer'=>'This application is a knowledge base for frequently asked questions.'
            ],
            [
                'question'=>'how to login',
                'answer'=>'Click on the login button and enter your credentials.'
            ],
            [
                'question'=>'how to create an account',
                'answer'=>'Click on the sign up button and fill in the required details.'
            ],
        [
            'question'=>'how to reset password',
            'answer'=>'Go to settings and click reset password.'
           ],
           [
            'question'=>'how to contact support',
            'answer'=>'Email support from the contact page.'
           ],
              [
                'question'=>'how to change profile picture',
                'answer'=>'Go to settings and click change profile picture.'
              ],
              [
                'question'=>'how to delete account',
                'answer'=>'Go to settings and click delete account.'
              ],
              [
                'question'=>'how to update account information',
                'answer'=>'Go to settings and click update account information.'
              ],
              [
                'question'=>'how to view account information',
                'answer'=>'Go to settings and click view account information.'
              ],
              [
                'question'=>'how to view privacy policy',
                'answer'=>'click view privacy policy.'
              ],
              [
                'question'=>'how to view terms and conditions',
                'answer'=>'click view terms and conditions.'
              ],
              [
                'question'=>'how to view about us',
                'answer'=>'click view about us.'
              ],
              [
                'question'=>'how to view contact us',
                'answer'=>'click view contact us.'
              ],
              [
                'question'=>'how to view faq',
                'answer'=>'click view faq.'
              ],
              [
                'question'=>'how to view knowledge base',
                'answer'=>'click view knowledge base.'
              ],
              [
                'question'=>'how to view blog',
                'answer'=>'click view blog.'
              ],
              [
                'question'=>'how to view news',
                'answer'=>'click view news.'
              ],
              [
                'question'=>'how to view events',
                'answer'=>'click view events.'
              ],
              ['question'=>'how to create shop',
                'answer'=>'click start selling and fill in the required details.'
              ],
              [
                'question'=>'how to view shop',
                'answer'=>'click view shop.'
              ],
              [
                'question'=>'how to view products',
                'answer'=>'click view products.'
              ],
              [
                'question'=>'how to add product',
                'answer'=>'click add product and fill in the required details.'
              ],
              [
                'question'=>'how to edit product',
                'answer'=>'click edit product and fill in the required details.'
              ],
              [
                'question'=>'how to delete product',
                'answer'=>'click delete product.'
              ]
         ]);
    }
} 
