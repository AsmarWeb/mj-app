<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\State;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function create()
    {
        return view('shop.create');
    }

    public function store(Request $request)
    {
        $name = Section::where('id', $request->section_id)->value('name');
        $countries = Country::orderBy('name')->get();

        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'section_id' => 'required|exists:sections,id',
            'type' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->user()->shop) {
        return redirect()->back()
            ->withErrors('You already have a shop.');
        }

        $shop = Shop::create(array_merge($request->all(), ['user_id' => Auth::user()->id]));
        $shop->name = $request->name;
        $shop->location = $request->location;
        $shop->type = $request->type;

        $shop->section_id = $request->section_id;
        $shop->country_id = $request->country_id;
        $shop->state_id = $request->state_id;
        $shop->city_id = $request->city_id;

        $shop->description = $request->description;

        if ($request->hasFile('logo')) {
            $shop->logo = $request->file('logo')->store('shop-suggest', 'public');
        }

        if ($request->hasFile('banner')) {
            $shop->banner = $request->file('banner')->store('shop-suggest', 'public');
        }

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

        return redirect()->route('shop', $shop)->with('message', 'Shop Added Successfully');
    }

    public function show(Shop $shop)
    {
        $title = $shop->name;
        $description = $shop->description;
        $keywords = "$shop->name, $shop->city->name, $shop->section->name";

        
        $bannerImage = Storage::url($shop->banner);
        $logoImage = Storage::url($shop->logo);

        return view('shop.show', compact('shop', 'title', 'description', 'keywords', 'bannerImage', 'logoImage'));
    }
}
