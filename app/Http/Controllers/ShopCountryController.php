<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class ShopCountryController extends Controller
{
    public function index()
{
    $countries = Country::withCount([
        'shops',
        'shops as verified_shops_count' => function ($q) {
            $q->where('verified', true);
        }
    ])
    ->with([
        'shops' => function ($q) {
            $q->latest()->take(4);
        }
    ])
    ->orderBy('name')
    ->get();

    return view('countries.index', compact('countries'));
}
}
