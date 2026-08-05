<?php

namespace App\View\Components;

use App\Models\Listing;
use App\Models\Setting;
use App\Models\Shop;
use Closure;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainHero extends Component
{
    public function search(Request $request)
    {
        $q = $request->input('q');

        if (! $q) {
            return view('search');
        }

        $listings = Listing::where('title', 'like', "%$q%")
            ->orWhere('description', 'like', "%$q%")
            ->limit(10)
            ->get();

        $shops = Shop::where('name', 'like', "%$q%")
            ->orWhere('section', 'like', "%$q%")
            ->limit(10)
            ->get();

        return view('search.results', compact('listings', 'shops', 'q'));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $setting = Setting::find(1);

        $shops = Shop::with('user')->take(3)
            ->get();

        return view('components.main-hero', ['setting' => $setting, 'shops' => $shops]);
    }
}
