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
        $shop = auth()->user()->shop;

        $countries = Country::orderBy('name')->get();
        $states = State::orderBy('name')->get();
        $cities = City::orderBy('name')->get();


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
        $shop = auth()->user()->shop ?? Shop::create([
            'user_id' => auth()->id(),
            'slug' => Str::uuid(),
            'name' => '',
            'type' => null,
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
                    'name' => 'required|min:3|max:50',
                    'type' => 'required|in:freelance,local',
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
                    $logo = $request->file('logo');
                    $fileName = $logo->getClientOriginalName();
                    $path = $logo->storeAs('shop-suggest', $fileName, 'public');
                    $shop->update(['logo' => $path,]);
                }
                if ($request->hasFile('banner')) {
                    $banner = $request->file('banner');
                    $fileName = $banner->getClientOriginalName();
                    $path = $banner->storeAs('shop-suggest', $fileName, 'public');
                    $shop->update(['banner' => $path,]);
                } 
                return redirect('/shop/create/4');

            case 4:
                $shop->update([
                    'step' => 4,
                    'is_completed' => true,
                ]);

                return redirect()->route('shop');

            default:

                return redirect('/dashboard');
        }
    }

    public function show($slug)
    {
        $shop = Shop::where('slug', $slug)
            ->with('listing')
            ->firstOrFail();

        $title = $shop ? $shop->name : 'Create your shop';
        $description = $shop ? $shop->description : 'Create a polished shop on Murwaj and start selling your products.';
        $keywords = $shop
            ? trim("$shop->name, " . optional($shop->city)->name . ", " . optional($shop->section)->name)
            : 'shop, murwaj, create online shop';

        $bannerImage = $shop && $shop->banner ? Storage::url($shop->banner) : null;
        $logoImage = $shop && $shop->logo ? Storage::url($shop->logo) : null;

        return view('shop.show', compact('shop', 'title', 'description', 'keywords', 'bannerImage', 'logoImage'));
    } 

    public function index()
    {
        //
    }

    public function creators(Request $request)
    {
        $shops = Shop::with('user')
        ->withCount('listing')->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('slug', 'like', '%'.$request->search.'%');
        })
        ->latest()
        ->paginate(12);
        
        return view('shop.creators', compact('shops'));
    }
}
