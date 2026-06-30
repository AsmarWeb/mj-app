<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShopRequest;
use App\Models\Listing;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\SlugOptions;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shops = Shop::latest('published_at')->published()->paginate(5);
        $shopCount = Shop::count();
        return view('admin.shops.index', compact('shops', 'shopCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $shops = Shop::all();
        return view('admin.shops.create', compact('shops'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShopRequest $request)
    {
        $request->all();

        $shop = Shop::create(array_merge($request->all(), ['user_id' => Auth::user()->id]));
        $shop->name = $request->name;
        $shop->location = $request->location;


         if ($request->hasFile('logo')) {
            $uploadPath = 'public/shop-suggest';
            $logo = $request->file('logo');
            $logoImage = $logo->getClientOriginalName();
            $path = $request->file('logo')->storeAs($uploadPath, $logoImage);
            $shop['logo'] = $logoImage;
        }

        if ($request->hasFile('banner')) {
            $uploadPath = 'public/shop-suggest';
            $banner = $request->file('banner');
            $bannerImage = $banner->getClientOriginalName();
            $path = $request->file('banner')->storeAs($uploadPath, $bannerImage);
            $shop['banner'] = $bannerImage;
        } 

        $shop->save();

        return redirect()->route('shops.index')->with('message', 'Shop Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        return view('admin.shops.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        return view('admin.shops.edit');
    } 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route('shops.index')->with('message', 'Shop deleted Successfully');
    }
}
