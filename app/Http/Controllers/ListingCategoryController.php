<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ListingCategoryController extends Controller
{
    public function index()
    {
    $categories = Category::where('status', 'active')
        ->withCount('listings')
        ->orderBy('name')
        ->get();

    return view('categories.index', compact('categories'));
    }
} 
