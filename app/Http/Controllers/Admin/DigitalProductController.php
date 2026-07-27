<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DigitalCategory;
use App\Models\DigitalProduct;
use App\Models\Download;
use Illuminate\Http\Request;
use App\Mail\DigitalProductPurchased;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class DigitalProductController extends Controller
{
    public function index(Request $request)
    {
        $products = DigitalProduct::with('digitalCategory')
        ->when($request->search, function ($query) use ($request) {

            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('title_ar', 'like', '%' . $request->search . '%');

        })
        ->when($request->status, function ($query) use ($request) {

            $query->where('status', $request->status);

        })
        ->latest()
        ->paginate(20);



    return view(
        'admin.digital-products.index',
        compact('products')
    );
    }

    public function create()
    {
        $categories = DigitalCategory::where('status', 'active')
            ->orderBy('category_name')
            ->get();

        return view(
            'admin.digital-products.create',
            compact('categories')
        );
    } 



    public function store(Request $request)
    {

        $request->validate([

            'digital_category_id' => 'required|exists:digital_categories,id',

            'title' => 'required|string|max:255',
            'title_ar' => 'nullable|string|max:255',

            'description' => 'required|string',
            'description_ar' => 'nullable|string',

            'price' => 'required|numeric|min:0',

            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'file' => 'required|file|max:102400',


            // Optional fields
            'version' => 'nullable|string|max:50',

            'compatible_with' => 'nullable|string',

            'file_size' => 'nullable|string',

            'included_files' => 'nullable|string',

            'license' => 'nullable|in:personal,commercial,extended',

            'preview_url' => 'nullable|url',

            'video_url' => 'nullable|url',

            'requirements' => 'nullable|string',

            'installation' => 'nullable|string',

            'changelog' => 'nullable|string',

        ]);



        /*
        |--------------------------------------------------------------------------
        | Upload Cover Image
        |--------------------------------------------------------------------------
        */

        $image = $request->file('image')
            ->store(
                'digital-products/images',
                'public'
            );



        /*
        |--------------------------------------------------------------------------
        | Upload Product File
        |--------------------------------------------------------------------------
        */

        $file = $request->file('file')
            ->store(
                'digital-products/files',
                'public'
            );



        /*
        |--------------------------------------------------------------------------
        | Gallery Upload
        |--------------------------------------------------------------------------
        */

        $gallery = [];


        if($request->hasFile('gallery')){

            foreach($request->file('gallery') as $photo){

                $gallery[] = $photo->store(
                    'digital-products/gallery',
                    'public'
                );

            }

        }



        /*
        |--------------------------------------------------------------------------
        | Create Product
        |--------------------------------------------------------------------------
        */

        DigitalProduct::create([


            'digital_category_id' =>
                $request->digital_category_id,


            'title' =>
                $request->title,


            'title_ar' =>
                $request->title_ar ?? $request->title,



            'description' =>
                $request->description,


            'description_ar' =>
                $request->description_ar ?? $request->description,



            'slug' =>
                Str::slug($request->title),



            'price' =>
                $request->price,



            'image' =>
                $image,


            'file' =>
                $file,



            'version' =>
                $request->version,



            'compatible_with' =>
                $request->compatible_with,



            'file_size' =>
                $request->file_size,



            'included_files' =>
                $request->included_files,



            'license' =>
                $request->license ?? 'personal',



            'preview_url' =>
                $request->preview_url,



            'video_url' =>
                $request->video_url,



            'requirements' =>
                $request->requirements,



            'installation' =>
                $request->installation,



            'changelog' =>
                $request->changelog,



            'gallery' =>
                $gallery,



            'downloads' =>
                0,



            'featured' =>
                $request->boolean('featured'),



            'is_free' =>
                $request->price == 0,


            'status' =>
                'published',


        ]);



        return redirect()

            ->route('digital-products.create')

            ->with(
                'success',
                'Digital product created successfully.'
            );

    }

    public function show($slug)
    {
    $product = DigitalProduct::with('digitalCategory')
        ->where('slug', $slug)
        ->where('status', 'published')
        ->firstOrFail();


    return view('admin.digital-products.show', compact('product'));
    }

    public function checkout($slug)
{
    $product = DigitalProduct::whereSlug($slug)
        ->where('status', 'published')
        ->firstOrFail();

    if ($product->is_free) {

        return redirect()->route(
            'digital-products.download',
            $product->slug
        );
    }

    Stripe::setApiKey(config('services.stripe.secret'));

    $session = Session::create([

        'mode' => 'payment',

        'success_url' => route('digital-products.success', [
    'slug' => $product->slug,
]) . '?session_id={CHECKOUT_SESSION_ID}',

'cancel_url' => route('digital-products.show', $product->slug),

        'customer_email' => auth()->user()->email,

        'line_items' => [[

            'quantity' => 1,

            'price_data' => [

                'currency' => 'usd',

                'unit_amount' => $product->price * 100,

                'product_data' => [

                    'name' => $product->title,

                    'description' => $product->description,

                ],

            ],

        ]],

        'metadata' => [

            'user_id' => auth()->id(),

            'product_id' => $product->id,

        ],

    ]);

    return redirect($session->url);
}

public function success(Request $request, $slug)
{
    $product = DigitalProduct::whereSlug($slug)
        ->firstOrFail();

    Stripe::setApiKey(config('services.stripe.secret'));

    $session = Session::retrieve(
        $request->session_id
    );

    if ($session->payment_status !== 'paid') {
        abort(403);
    }

    $download = Download::firstOrCreate(

        [
            'user_id' => auth()->id(),
            'digital_product_id' => $product->id,
        ],

        [
            'token' => Str::random(64),
            'paid' => true,
            'paid_at' => now(),
        ]

    );

    Mail::to(auth()->user()->email)
    ->send(new DigitalProductPurchased($download));

    return view(
        'admin.digital-products.success',
        compact('product', 'download')
    );
}

public function download($slug)
{
    $product = DigitalProduct::whereSlug($slug)
        ->firstOrFail();

    $download = Download::where([
        'user_id' => auth()->id(),
        'digital_product_id' => $product->id,
    ])->first();

    // Free product
    if ($product->is_free) {

        if (!$download) {

            $download = Download::create([

                'user_id' => auth()->id(),

                'digital_product_id' => $product->id,

                'token' => Str::random(64),

                'paid' => true,

                'paid_at' => now(),

            ]);

        }

    } else {

        if (!$download || !$download->paid) {

            return redirect()
                ->route('digital-products.checkout', $product->slug);

        }

    }

    $product->increment('downloads');

    return Storage::disk('public')->download(

        $product->file,

        basename($product->file)

    );
}

}