<?php

namespace App\Http\Controllers;

use App\Models\Category;

class ListingCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 'active')
            ->withCount(['listings' => fn ($q) => $q->active()])
            ->orderBy('category_name')
            ->get();

        return view('categories.index', compact('categories'));
    }
}
