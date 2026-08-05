<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Listing;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request, Listing $listing)
    {

        Lead::create([

            'shop_id' => $listing->shop_id,

            'listing_id' => $listing->id,

            'user_id' => auth()->id(),

            'type' => $request->type,

        ]);

        return response()->json([
            'success' => true,
        ]);

    }
}
