<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AIController extends Controller
{
    public function shopDescription(Request $request)
    {
        $request->validate([
            'section' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
        ]);

        $description =
            "Welcome to our {$request->section} shop in {$request->city}, {$request->state}, {$request->country}. "
            .'We provide quality products, competitive prices, reliable service, and a great shopping experience. '
            .'Contact us today to find the products you need.';

        return response()->json([
            'description' => $description,
        ]);
    }
}
