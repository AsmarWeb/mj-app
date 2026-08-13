<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShopRequest;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShopsController extends Controller
{
    /**
     * Display a listing of shops.
     */
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));
        $verified = $request->input('verified');

        $shops = Shop::query()
            ->with([
                'user',
                'city',
                'state',
                'plan',
            ])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery
                                ->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                        });
                });
            })
            ->when(
                $verified !== null && $verified !== '',
                function ($query) use ($verified) {
                    $query->where('verified', (int) $verified);
                }
            )
            ->latest('published_at')
            ->paginate(10)
            ->withQueryString();

        $shopCount = Shop::count();

        return view('admin.shops.index', compact(
            'shops',
            'shopCount',
            'search',
            'verified'
        ));
    }

    /**
     * Show the form for creating a new shop.
     */
    public function create()
    {
        return view('admin.shops.create');
    }

    /**
     * Store a newly created shop.
     */
    public function store(StoreShopRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')
                ->store('shops', 'public');
        }

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')
                ->store('shops', 'public');
        }

        Shop::create($validated);

        return redirect()
            ->route('shops.index')
            ->with('message', 'Shop Added Successfully');
    }

    /**
     * Display the specified shop.
     */
    public function show(Shop $shop)
    {
        $shop->load([
            'user',
            'city',
            'state',
            'activeSubscription.plan',
            'listings',
        ]);

        return view('admin.shops.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified shop.
     */
    public function edit(Shop $shop)
    {
        $shop->load('activeSubscription.plan');

        return view('admin.shops.edit', compact('shop'));
    }

    /**
     * Update the specified shop.
     */
    public function update(StoreShopRequest $request, Shop $shop)
    {
        $validated = $request->validated();

        $validated['allow_phone'] = $request->boolean('allow_phone');
        $validated['allow_whatsapp'] = $request->boolean('allow_whatsapp');

        /*
        |--------------------------------------------------------------------------
        | Verification
        |--------------------------------------------------------------------------
        */

        $verified = $request->boolean('verified');

        $validated['verified'] = $verified;

        if ($verified && ! $shop->verified) {
            $validated['verified_at'] = now();
            $validated['verified_by'] = auth()->id();
        }

        if (! $verified) {
            $validated['verified_at'] = null;
            $validated['verified_by'] = null;
        }

        /*
        |--------------------------------------------------------------------------
        | Keep original owner
        |--------------------------------------------------------------------------
        */

        $validated['user_id'] = $shop->user_id;

        /*
        |--------------------------------------------------------------------------
        | Logo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('logo')) {

            if (
                $shop->logo &&
                Storage::disk('public')->exists($shop->logo)
            ) {
                Storage::disk('public')->delete($shop->logo);
            }

            $validated['logo'] = $request->file('logo')
                ->store('shops', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Banner
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('banner')) {

            if (
                $shop->banner &&
                Storage::disk('public')->exists($shop->banner)
            ) {
                Storage::disk('public')->delete($shop->banner);
            }

            $validated['banner'] = $request->file('banner')
                ->store('shops', 'public');
        }

        $shop->update($validated);

        return redirect()
            ->route('shops.index')
            ->with('message', 'Shop updated successfully.');
    }

    /**
     * Delete shop.
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();

        return redirect()
            ->route('shops.index')
            ->with('message', 'Shop deleted successfully');
    }

    /**
     * Verify shop.
     */
    public function verify(Shop $shop)
    {
        $shop->update([
            'verified' => true,
            'verified_at' => now(),
            'verified_by' => auth()->id(),
        ]);

        return back()->with(
            'success',
            'Shop verified successfully.'
        );
    }

    /**
     * Unverify shop.
     */
    public function unverify(Shop $shop)
    {
        $shop->update([
            'verified' => false,
            'verified_at' => null,
            'verified_by' => null,
        ]);

        return back()->with(
            'success',
            'Shop unverified successfully.'
        );
    }
}