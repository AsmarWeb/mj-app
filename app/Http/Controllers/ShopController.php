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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function create($step = 1)
    {
        $shop = Auth::user()?->shop;

        $countries = Country::orderBy('name')->get();
        $states = State::orderBy('name')->get();
        $cities = City::orderBy('name')->get();

        if (!$shop) {
        return redirect()->route('shop.setup.step', 1);
        }

        return view("shop.create", [
        'shop' => $shop,
        'step' => (int) $step,
        'countries' => $countries,
        'states' => $states,
        'cities' => $cities,
        'sections' => Section::orderBy('name')->get(),
    ]);
    }

    public function store(Request $request, $step)
    {
        $shop = Auth::user()?->shop ?? Shop::create([
            'user_id' => Auth::id(),
            'slug' => Str::uuid(),
            'name' => '',
            'type' => '',
            'description' => '',
            'section_id' => null,
            'country_id' => null,
            'state_id' => null,
            'city_id' => null,
            'logo' => null,
            'banner' => null,
        ]);

        switch ($step) {

            case 1:
                $request->validate([
                    'name' => 'required|min:3|max:50'
                ]);

                $shop->update([
                    'name' => $request->name,
                    'type' => $request->type,
                ]);
                return redirect('/shop/create/2');

            case 2:
                $request->validate([
                    'description' => 'required|min:10|max:500',
                    'section_id' => 'required|exists:sections,id',
                    'location' => 'required',
                    'country_id' => 'required|exists:countries,id',
                    'state_id' => 'required|exists:states,id',
                    'city_id' => 'required|exists:cities,id',
                ]);

                $shop->update([
                    'description' => $request->description,
                    'section_id' => $request->section_id,
                    'country_id' => $request->country_id,
                    'state_id' => $request->state_id,
                    'city_id' => $request->city_id,
                    'location' => $request->location,
                ]);
                return redirect('/shop/create/3');

            case 3:
                $request->validate([
                    'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                if ($request->hasFile('logo')) {
                    $logoPath = $request->file('logo')->store('public/shop-suggest');
                    $shop->update(['logo' => $logoPath]);
                }
                if ($request->hasFile('banner')) {
                    $bannerPath = $request->file('banner')->store('public/shop-suggest');
                    $shop->update(['banner' => $bannerPath]);
                }
                return redirect('/shop/create/4');

            default:

                return redirect('/dashboard');
        }
    }

    public function show(Shop $shop, $slug)
    {
        $title = $shop->name;
        $description = $shop->description;
        $keywords = trim("$shop->name, " . optional($shop->city)->name . ", " . optional($shop->section)->name);

        $bannerImage = $shop->banner ? Storage::url($shop->banner) : null;
        $logoImage = $shop->logo ? Storage::url($shop->logo) : null;

        return view('shop.show', compact('shop', 'slug', 'title', 'description', 'keywords', 'bannerImage', 'logoImage'));
    }

    public function index()
    {
        $shop = Auth::user()?->shop;

        $title = $shop ? $shop->name : 'Create your shop';
        $description = $shop ? $shop->description : 'Create a polished shop on Murwaj and start selling your products.';
        $keywords = $shop
            ? trim("$shop->name, " . optional($shop->city)->name . ", " . optional($shop->section)->name)
            : 'shop, murwaj, create online shop';

        $bannerImage = $shop && $shop->banner ? Storage::url($shop->banner) : null;
        $logoImage = $shop && $shop->logo ? Storage::url($shop->logo) : null;

        return view('shop.show', compact('shop', 'title', 'description', 'keywords', 'bannerImage', 'logoImage'));
    }
}
