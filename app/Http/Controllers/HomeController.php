<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use App\Models\Page;
use App\Models\Shop;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {

        $title = 'murwaj';
        $description = 'murwaj is an advertising group, to help your business grow through digital marketing.';
        $keywords = 'murwaj.com. buy electronics, computers, apparel, fashion accessories, shoes, watches, furniture, home and kitchen goods, beauty, personal care, grocery, gourmet food.';

        return view('pages.home')->with(compact('title', 'description', 'keywords'));
    }

    public function about()
    {
        $getPage = Page::getSlug('about');
        $data['getPage'] = $getPage;

        // $data['meta_title'] = $getPage->meta_title;
        // $data['meta_description'] = $getPage->meta_description;
        // $data['meta_keywords'] = $getPage->meta_keywords;

        return view('pages.about', $data);
    }
}
