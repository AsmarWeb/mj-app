<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Listing;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Listing $listing)
{


$request->validate([

    'rating'=>'required|integer|min:1|max:5',

    'comment'=>'nullable|string|max:1000',

]);



Review::create([

    'user_id'=>auth()->id(),

    'listing_id'=>$listing->id,

    'rating'=>$request->rating,

    'comment'=>$request->comment,

]);



return back()->with(
    'success',
    'Review submitted successfully'
);

}
}
