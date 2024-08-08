<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $data['meta_title'] = 'Murwaj';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('pages.home', $data);
    }

    public function about()
    {
        $getPage = Page::getSlug('about');
        $data['getPage'] = $getPage;

        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('pages.about', $data);
    }
}
