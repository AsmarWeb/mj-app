<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use App\Models\Page;
use Illuminate\Http\Request;

class DiscoverController extends Controller
{
    public function discover()
    {

        $title = 'murwaj';
        $description = 'murwaj is an online marketplace that connects buyers and sellers of a wide range of products, including electronics, fashion, home goods, and more. With a user-friendly interface and secure payment options, Murwaj makes it easy for customers to find and purchase the products they need while providing sellers with a platform to reach a large audience.';
        $keywords = 'murwaj.com. buy electronics, computers, apparel, fashion accessories, shoes, watches, furniture, home and kitchen goods, beauty, personal care, grocery, gourmet food.';

        return view('pages.discover')->with(compact('title', 'description', 'keywords'));
    }
}
