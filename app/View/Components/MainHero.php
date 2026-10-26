<?php

namespace App\View\Components;

use App\Models\Listing;
use App\Models\Setting;
use App\Models\Shop;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class MainHero extends Component
{
    public function search(Request $request)
    {
        $q = $request->input('q');

        if (! $q) {
            return view('search');
        }

        $listings = Listing::active()->where(function ($query) use ($q) {
            $query->where('title', 'like', "%$q%")
                ->orWhere('description', 'like', "%$q%");
        })->limit(10)->get();

        $shops = Shop::publicCatalog()->where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%")
                ->orWhere('name_ar', 'like', "%$q%");
        })->limit(10)->get();

        return view('search.results', compact('listings', 'shops', 'q'));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $setting = Setting::find(1) ?? new Setting;

        $shops = Shop::publicCatalog()->with('user')->take(3)
            ->get();

        return view('components.main-hero', ['setting' => $setting, 'shops' => $shops]);
    }
}
