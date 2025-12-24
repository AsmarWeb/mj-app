<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;

class ShopController extends Controller
{
    public function create()
    {
        return view('shop.create');
    }

    public function store(Request $request)
    {
        $request->all();

        if ($request->user()->shop) {
        return redirect()->back()
            ->withErrors('You already have a shop.');
        }

        $shop = Shop::create(array_merge($request->all(), ['user_id' => Auth::user()->id]));
        $shop->name = $request->name;
        $shop->location = $request->location;


        if ($request->hasFile('image')) {
            $uploadPath = 'public/shop-suggest';
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($uploadPath, $imageName);
            $shop['image'] = $imageName;
        }

        $shop->save();

        return redirect()->route('dashboard', $shop)->with('message', 'Shop Added Successfully');
    }
}
