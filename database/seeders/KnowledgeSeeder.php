<?php

namespace Database\Seeders;

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

            // General Marketplace
            [
                'question' => 'what is murwaj marketplace',
                'answer' => 'Murwaj Marketplace is an online platform where users can discover products, create shops, sell items, and connect with buyers.',
            ],
            [
                'question' => 'how does murwaj work',
                'answer' => 'Users can browse products, follow shops, contact sellers, purchase items, and sellers can create shops to list products.',
            ],
            [
                'question' => 'is murwaj free',
                'answer' => 'Creating an account and browsing products is free. Some seller features or promotions may have additional costs.',
            ],
            [
                'question' => 'what can i sell on murwaj',
                'answer' => 'You can sell approved products including electronics, fashion, vehicles, real estate, digital products, services, and other marketplace categories.',
            ],
            [
                'question' => 'what products are allowed',
                'answer' => 'Only legal and approved products that follow Murwaj marketplace policies can be listed.',
            ],
            [
                'question' => 'how do i search for products',
                'answer' => 'Use the search bar and filters to find products by name, category, price, location, or shop.',
            ],
            [
                'question' => 'how do i find a shop',
                'answer' => 'Search for the shop name or open a product and click the shop profile.',
            ],

            // Account
            [
                'question' => 'how to register',
                'answer' => 'Click the sign up button, enter your information, verify your account, and start using Murwaj.',
            ],
            [
                'question' => 'how to login',
                'answer' => 'Click login and enter your registered email and password.',
            ],
            [
                'question' => 'i forgot my password',
                'answer' => 'Click forgot password on the login page and follow the instructions to reset it.',
            ],
            [
                'question' => 'how to change my email',
                'answer' => 'Go to account settings and update your email information.',
            ],
            [
                'question' => 'how to change phone number',
                'answer' => 'Go to profile settings and update your phone number.',
            ],
            [
                'question' => 'how to verify my account',
                'answer' => 'Complete your profile information and follow the verification steps provided by Murwaj.',
            ],

            // Buying
            [
                'question' => 'how to buy a product',
                'answer' => 'Open the product page, review the details, click buy now or contact the seller, then complete the purchase process.',
            ],
            [
                'question' => 'how can i contact seller',
                'answer' => 'Open the product page and use the contact seller option to communicate with the shop owner.',
            ],
            [
                'question' => 'how to save a product',
                'answer' => 'Click the save or bookmark button on any product to keep it for later.',
            ],
            [
                'question' => 'how to follow a shop',
                'answer' => 'Open the shop profile and click follow to receive updates from that seller.',
            ],
            [
                'question' => 'how to compare products',
                'answer' => 'Use product details and compare prices, features, ratings, and seller information.',
            ],
            [
                'question' => 'how do i know if a seller is trusted',
                'answer' => 'Check the seller profile, shop information, ratings, reviews, and product history.',
            ],

            // Selling
            [
                'question' => 'how to start selling',
                'answer' => 'Create an account, click start selling, create your shop, and add your products.',
            ],
            [
                'question' => 'how to create a shop',
                'answer' => 'Go to seller dashboard, choose create shop, add shop information, logo, and details.',
            ],
            [
                'question' => 'how to add product',
                'answer' => 'Open your seller dashboard, click add product, upload images or video, add description, price, category, and publish.',
            ],
            [
                'question' => 'how to upload product video',
                'answer' => 'When adding a product, upload a supported video file to create a video listing.',
            ],
            [
                'question' => 'how many products can i add',
                'answer' => 'The number of products depends on your seller account limits and marketplace rules.',
            ],
            [
                'question' => 'how to edit product',
                'answer' => 'Go to your seller dashboard, select the product, and click edit.',
            ],
            [
                'question' => 'how to delete product',
                'answer' => 'Go to your products dashboard and choose delete product.',
            ],
            [
                'question' => 'how to feature my product',
                'answer' => 'You can promote your product using Murwaj featured listings or advertising options.',
            ],

            // Shop
            [
                'question' => 'how to edit my shop',
                'answer' => 'Open your shop dashboard and update your shop name, logo, description, and settings.',
            ],
            [
                'question' => 'how to add shop logo',
                'answer' => 'Go to shop settings and upload your logo image.',
            ],
            [
                'question' => 'how to close my shop',
                'answer' => 'Contact support or use shop settings to request shop closure.',
            ],
            [
                'question' => 'how to view my shop',
                'answer' => 'Open your seller dashboard and click view shop.',
            ],

            // Orders
            [
                'question' => 'where is my order',
                'answer' => 'Open your account orders page to check order status and tracking information.',
            ],
            [
                'question' => 'how to cancel order',
                'answer' => 'Orders can be cancelled depending on the seller status and order processing stage.',
            ],
            [
                'question' => 'how to track order',
                'answer' => 'Use the order tracking page to view delivery updates.',
            ],
            [
                'question' => 'what if my order does not arrive',
                'answer' => 'Contact the seller or Murwaj support for assistance.',
            ],

            // Payments
            [
                'question' => 'how can i pay',
                'answer' => 'Payment methods depend on available options provided during checkout.',
            ],
            [
                'question' => 'is payment secure',
                'answer' => 'Murwaj uses secure systems to help protect user transactions and information.',
            ],
            [
                'question' => 'can i get refund',
                'answer' => 'Refund availability depends on the product, seller policy, and marketplace rules.',
            ],
            [
                'question' => 'how to request refund',
                'answer' => 'Contact the seller or support team with your order details.',
            ],

            // Shipping
            [
                'question' => 'does murwaj provide delivery',
                'answer' => 'Delivery options depend on the seller and shipping method selected.',
            ],
            [
                'question' => 'how much is shipping',
                'answer' => 'Shipping costs depend on product size, location, and seller shipping settings.',
            ],
            [
                'question' => 'can i change delivery address',
                'answer' => 'Contact the seller as soon as possible to update delivery details.',
            ],

            // Safety
            [
                'question' => 'how to report a product',
                'answer' => 'Open the product page and use the report option.',
            ],
            [
                'question' => 'how to report a seller',
                'answer' => 'Open the seller profile and submit a report with details.',
            ],
            [
                'question' => 'how to avoid scams',
                'answer' => 'Use verified shops, check product details, avoid suspicious offers, and communicate through Murwaj.',
            ],
            [
                'question' => 'how to contact support',
                'answer' => 'Visit the support page or contact Murwaj customer service.',
            ],

        ]);
    }
}
