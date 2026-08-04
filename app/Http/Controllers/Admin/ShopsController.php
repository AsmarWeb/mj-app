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
        $shop->load([
        'user',
        'listings']);

        return view('admin.shops.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        return view('admin.shops.edit', compact('shop'));
    } 

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreShopRequest $request, Shop $shop)
{
    $validated = $request->validated();


    // Contact permissions
    $validated['allow_phone'] = $request->boolean('allow_phone');
    $validated['allow_whatsapp'] = $request->boolean('allow_whatsapp');


    // Verification
    $verified = $request->boolean('verified');

    $validated['verified'] = $verified;


    if ($verified && !$shop->verified) {

        $validated['verified_at'] = now();
        $validated['verified_by'] = auth()->id();

    } elseif (!$verified) {

        $validated['verified_at'] = null;
        $validated['verified_by'] = null;

    }



    // Keep original owner
    $validated['user_id'] = $shop->user_id;



    // Update Logo
    if ($request->hasFile('logo')) {


        if ($shop->logo && Storage::disk('public')->exists($shop->logo)) {
            Storage::disk('public')->delete($shop->logo);
        }


        $validated['logo'] = 
            $request->file('logo')->store('shops', 'public');

    }



    // Update Banner
    if ($request->hasFile('banner')) {


        if ($shop->banner && Storage::disk('public')->exists($shop->banner)) {
            Storage::disk('public')->delete($shop->banner);
        }


        $validated['banner'] =
            $request->file('banner')->store('shops', 'public');

    }



    $shop->update($validated);



    return redirect()
        ->route('shops.index')
        ->with('message', 'Shop updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route('shops.index')->with('message', 'Shop deleted Successfully');
    }

    public function verify(Shop $shop)
    {
    $shop->update([
        'verified' => true,
        'verified_at' => now(),
        'verified_by' => auth()->id(),
    ]);

    return back()->with('success', 'Shop verified successfully.');
    }

    public function unverify(Shop $shop)
    {
        $shop->verified = false;
        $shop->verified_at = null;
        $shop->verified_by = null;
        
        $shop->save();
        
        return back()->with('success', 'Shop unverified successfully.');
    }
}
