<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        SEOMeta::setTitle('Home');
        // $data['meta_title'] = 'Murwaj';
        // $data['meta_description'] = '';
        // $data['meta_keywords'] = '';

        return view('pages.home');
    }

    public function about()
    {
        $getPage = Page::getSlug('about');
        $data['getPage'] = $getPage;

        SEOMeta::setTitle($getPage->meta_title);
        SEOMeta::setDescription($getPage->meta_description);
        SEOMeta::setKeywords($getPage->meta_keywords);

        // $data['meta_title'] = $getPage->meta_title;
        // $data['meta_description'] = $getPage->meta_description;
        // $data['meta_keywords'] = $getPage->meta_keywords;

        return view('pages.about', $data);
    }
}
