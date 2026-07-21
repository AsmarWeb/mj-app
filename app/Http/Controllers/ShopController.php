<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\BusinessCard;
use App\Models\City;
use App\Models\Country;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\State;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Barryvdh\DomPDF\Facade\Pdf;
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
                DB::transaction(function () use ($shop) {
                $shop->update([
                'step' => 4,
                'is_completed' => true,
                ]);
                
                $user = auth()->user();
                
                if (! $user->hasRole('seller')) {
                    $user->addRole('seller');
                }

                // Create a free subscription if one doesn't exist
                if (! $shop->subscriptions()->exists()) {
                
                $freePlan = Plan::where('price', 0)->first();
                
                if ($freePlan) {

                $shop->subscriptions()->create([
                    'plan_id' => $freePlan->id,
                    'user_id' => auth()->id(),
                    'status' => 'active',
                    'payment_provider' => 'free',
                    'payment_id' => null,
                    'type' => 'default', 
                    'stripe_id' => 'free_' . Str::uuid(),
                    'stripe_status' => 'active',
                    'stripe_price' => null,
                    'quantity' => 1,
                    'trial_ends_at' => null,
                    'ends_at' => null,
                ]);
                }

                BusinessCard::firstOrCreate(
                    ['shop_id' => $shop->id],
                    [
        
                    'title' => $shop->name,
        
                    'phone' => auth()->user()->phone,
        
                    'email' => auth()->user()->email,
        
                    'website' => route('shop', $shop->slug),
                    ]
                );
                }
            
            });

                return redirect()->route('shop', ['slug' => $shop->slug,])->with('success', 'Congratulations! Your shop is now live.');

            default:

                return redirect('/dashboard');
        }
    }

    public function show($slug)
    {
        $shop = Shop::where('slug', $slug)
            ->with('listings')
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
        $user = auth()->user();

        $shop = $user->shop;

        if (! $shop) {
            return redirect()->route('shop.create', 1);
        }

        $subscription = $shop->subscriptions()
            ->where('status', 'active')
            ->latest()
            ->with('plan')
            ->first();

        $plan = $subscription?->plan;

        $listings = $shop->listings();

        $publishedListings = (clone $listings)
            ->where('status', 'published')
            ->count();

        $draftListings = (clone $listings)
            ->where('status', 'draft')
            ->count();

        $expiredListings = (clone $listings)
            ->where('status', 'expired')
            ->count();

        $outOfStock = (clone $listings)
            ->where('quantity', 0)
            ->count();

        $recentListings = $shop->listings()
            ->latest()
            ->take(5)
            ->get();

        // Replace with your actual orders relationship/table
        $ordersCount = Order::where('shop_id', $shop->id)->count();

        $pendingOrders = Order::where('shop_id', $shop->id)
            ->where('status', 'pending')
            ->count();

        $completedOrders = Order::where('shop_id', $shop->id)
            ->where('status', 'completed')
            ->count();

        $revenue = Order::where('shop_id', $shop->id)
            ->where('status', 'completed')
            ->sum('total');

        $expiringListings = $shop->listings()
            ->where('status', 'published')
            ->whereNotNull('expires_at')
            ->whereBetween('expires_at', [now(), now()->addDays(7)])
            ->orderBy('expires_at')
            ->get();

        return view('shop.dashboard', compact(
            'shop',
            'subscription',
            'plan',
            'publishedListings',
            'draftListings',
            'expiredListings',
            'outOfStock',
            'recentListings',
            'ordersCount',
            'pendingOrders',
            'completedOrders',
            'revenue',
            'expiringListings'
        ));
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

    public function downloadBusinessCard($slug)
    {
    $shop = Shop::with([
        'businessCard',
        'city',
        'country'
    ])
    ->where('slug',$slug)
    ->firstOrFail();


    $writer = new \Endroid\QrCode\Writer\PngWriter();


    $qr = new \Endroid\QrCode\QrCode(
        data: route('shop.public',$shop->slug),
        size:200,
        margin:10
    );


    $result = $writer->write($qr);


    $qrCode = base64_encode($result->getString());


    $pdf = Pdf::loadView(
        'shop.pdf.business-card',
        compact('shop','qrCode')
    )
    ->setPaper('a4');


    return $pdf->download(
        $shop->slug.'-business-card.pdf'
    );
    }

    public function businessCard($slug)
{
    $shop = Shop::with([
        'businessCard',
        'city',
        'country'
    ])
    ->where('slug',$slug)
    ->firstOrFail();


    $writer = new \Endroid\QrCode\Writer\PngWriter();


    $qr = new \Endroid\QrCode\QrCode(
        data: route('shop.public',$shop->slug),
        size:200,
        margin:10
    );


    $result = $writer->write($qr);


    $qrCode = base64_encode($result->getString());


    return view(
        'shop.public',
        compact('shop','qrCode')
    );
}


}
