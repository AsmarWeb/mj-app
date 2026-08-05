<?php

namespace App\Http\Controllers;

use App\Models\Shop;

class ShopFollowController extends Controller
{
    public function toggle(Shop $shop)
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        // Prevent following your own shop
        if ($shop->user_id == auth()->id()) {
            return back()->with('error', 'You cannot follow your own shop.');
        }

        $user = auth()->user();

        if ($user->followedShops()->where('shop_id', $shop->id)->exists()) {

            $user->followedShops()->detach($shop->id);

            return back()->with('success', 'Shop unfollowed.');

        }

        $user->followedShops()->attach($shop->id);

        return back()->with('success', 'Shop followed.');
    }
}
