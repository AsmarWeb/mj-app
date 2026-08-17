<?php

namespace App\Http\Controllers;

use App\Models\BusinessCard;
use App\Models\City;
use App\Models\Country;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Section;
use App\Models\Shop;
use App\Models\State;
use App\Notifications\ShopCreatedNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    public function create($step = 1)
    {
        $shop = auth()->user()->shop;

        $countries = Country::orderBy('name')->get();
        $states = State::orderBy('name')->get();
        $cities = City::orderBy('name')->get();

        return view('shop.create', [
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
            'name_ar' => '',
            'type' => null,
            'description' => '',
            'section_id' => null,
            'country_id' => null,
            'state_id' => null,
            'city_id' => null,
            'logo' => null,
            'banner' => null,
            'published_at' => now(),
            'is_active' => true,
        ]);

        switch ($step) {

            case 1:
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'name_ar' => ['nullable', 'string', 'max:255'],
                    'type' => ['required', 'in:freelance,local'],
                ]);

                $shop->update([
                    'name' => $request->name,
                    'name_ar' => $request->name_ar,
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
                    // Optional if reverse geocoding fills them
                    'country_id' => $request->country_id,
                    'state_id' => $request->state_id,
                    'city_id' => $request->city_id,

                    'location' => $request->location,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
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
                    $shop->update(['logo' => $path]);
                }
                if ($request->hasFile('banner')) {
                    $banner = $request->file('banner');
                    $fileName = $banner->getClientOriginalName();
                    $path = $banner->storeAs('shop-suggest', $fileName, 'public');
                    $shop->update(['banner' => $path]);
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

                    $user->notify(new ShopCreatedNotification($shop));
                });

                return redirect()->route('shop', ['slug' => $shop->slug])->with('success', 'Congratulations! Your shop is now live.');

            default:

                return redirect('/dashboard');
        }
    }

    public function edit()
    {
        $shop = Auth::user()->shop;

        return view('shop.edit', compact('shop'));
    }

    public function update(Request $request)
    {
        $shop = Auth::user()->shop;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_ar' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:freelance,local'],
            'description' => ['nullable', 'string', 'max:1000'],
            'logo' => ['nullable', 'image', 'max:2048'],

            'phone' => ['nullable', 'string', 'max:20'],
            'whatsapp' => ['nullable', 'string', 'max:20'],
            'currency' => ['required', 'in:AED,USD,EUR,GBP,SAR,KWD,QAR,BHD,OMR'],

            'allow_phone' => ['nullable', 'boolean'],
            'allow_whatsapp' => ['nullable', 'boolean'],
        ]);

        // Prevent currency changes after products exist.
        if (
            $shop->currency !== $validated['currency'] &&
            $shop->listings()->exists()
        ) {
            return back()
                ->withErrors([
                    'currency' => 'Currency cannot be changed after products have been added.',
                ])
                ->withInput();
        }

        if ($request->hasFile('logo')) {

            if ($shop->logo) {
                Storage::disk('public')->delete($shop->logo);
            }

            $validated['logo'] = $request->file('logo')
                ->store('shop-suggest', 'public');
        }

        $shop->update([
            'name' => $validated['name'],
            'name_ar' => $validated['name_ar'],
            'description' => $validated['description'],

            'phone' => Auth::user()->phone,
            'whatsapp' => $validated['whatsapp'] ?? Auth::user()->phone,
            'currency' => $request->currency,

            'allow_phone' => $request->boolean('allow_phone'),
            'allow_whatsapp' => $request->boolean('allow_whatsapp'),
        ]);

        return redirect()
            ->route('shop.edit')
            ->with('success', 'Shop updated successfully.');
    }

    public function show($slug)
    {
        $shop = Shop::where('slug', $slug)
            ->with([
                'section',
                'city',
                'state',
            ])
            ->firstOrFail();

        $products = $shop->listings()
            ->where('status', 'published')
            ->latest()
            ->paginate(12);

        $categories = $shop->listings()
            ->where('status', 'published')
            ->with('category')
            ->get()
            ->pluck('category')
            ->unique('id');

        $title = $shop ? $shop->name : 'Create your shop';
        $description = $shop ? $shop->description : 'Create a polished shop on Murwaj and start selling your products.';
        $keywords = $shop
            ? trim("$shop->name, " . optional($shop->city)->name . ', ' . optional($shop->section)->name)
            : 'shop, murwaj, create online shop';

        $bannerImage = $shop && $shop->banner ? Storage::url($shop->banner) : null;
        $logoImage = $shop && $shop->logo ? Storage::url($shop->logo) : null;

        $shop->loadCount('followers');

        return view('shop.show', compact('shop', 'title', 'description', 'keywords', 'bannerImage', 'logoImage', 'products', 'categories'));
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
        $ordersCount = $shop->orders()
            ->whereMonth(
                'created_at',
                now()->month
            )
            ->count();

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

        $notifications = auth()->user()->notifications()->latest()->take(5)->get();

        $wallet = $shop->wallet;

        return view('shop.dashboard', compact(
            'shop',
            'wallet',
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
            'expiringListings',
            'notifications'
        ));
    }

    public function creators(Request $request)
    {
        $search = trim($request->input('q', ''));

        $shops = Shop::query()
            ->with([
                'user',
            ])
            ->withCount('listings')
            ->when($search !== '', function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('name_ar', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery
                                ->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // SEO

        $title = 'murwaj';

        $description = 'murwaj is an advertising group, to help your business grow through digital marketing.';

        $keywords = 'murwaj.com, buy electronics, computers, apparel, fashion accessories, shoes, watches, furniture, home and kitchen goods, beauty, personal care, grocery, gourmet food.';

        return view('shop.creators', compact('shops', 'title', 'description', 'keywords'));
    }

    public function downloadBusinessCard($slug)
    {
        $shop = Shop::with([
            'businessCard',
            'city',
            'country',
        ])
            ->where('slug', $slug)
            ->firstOrFail();

        $writer = new PngWriter;

        $qr = new QrCode(
            data: route('shop.public', $shop->slug),
            size: 200,
            margin: 10
        );

        $result = $writer->write($qr);

        $qrCode = base64_encode($result->getString());

        $pdf = Pdf::loadView(
            'shop.pdf.business-card',
            compact('shop', 'qrCode')
        )
            ->setPaper('a4');

        return $pdf->download(
            $shop->slug . '-business-card.pdf'
        );
    }

    public function businessCard($slug)
    {
        $shop = Shop::with([
            'businessCard',
            'city',
            'country',
        ])
            ->where('slug', $slug)
            ->firstOrFail();

        $writer = new PngWriter;

        $qr = new QrCode(
            data: route('shop.public', $shop->slug),
            size: 200,
            margin: 10
        );

        $result = $writer->write($qr);

        $qrCode = base64_encode($result->getString());

        return view(
            'shop.public',
            compact('shop', 'qrCode')
        );
    }
}
