<?php

namespace App\Http\Controllers;

use App\Models\Country;

class ShopCountryController extends Controller
{
    public function index()
    {
        $countries = Country::withCount([
            'shops' => fn ($q) => $q->publicCatalog(),
            'shops as verified_shops_count' => function ($q) {
                $q->publicCatalog()->where('verified', true);
            },
        ])
            ->with([
                'shops' => function ($q) {
                    $q->publicCatalog()->latest()->take(4);
                },
            ])
            ->orderBy('name')
            ->get();

        return view('countries.index', compact('countries'));
    }
}
