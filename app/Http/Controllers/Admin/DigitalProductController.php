<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DigitalCategory;
use App\Models\DigitalProduct;
use App\Models\Download;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DigitalProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Products
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {

        $products = DigitalProduct::with([
            'digitalCategory',
            'supplier',
        ])
            ->when($request->search, function ($query) use ($request) {

                $query->where('title', 'like', '%'.$request->search.'%')
                    ->orWhere('title_ar', 'like', '%'.$request->search.'%');

            })
            ->when($request->type, function ($query) use ($request) {

                $query->where('type', $request->type);

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

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create()
    {

        $categories = DigitalCategory::where(
            'status',
            'active'
        )
            ->orderBy('category_name')
            ->get();

        $suppliers = Supplier::where(
            'status',
            'active'
        )
            ->orderBy('name')
            ->get();

        return view(
            'admin.digital-products.create',
            compact(
                'categories',
                'suppliers'
            )
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Store Product
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        $request->validate([

            'type' => 'required|in:digital,pod,service',

            'digital_category_id' => 'nullable|exists:digital_categories,id',

            'title' => 'required|string|max:255',

            'title_ar' => 'nullable|string|max:255',

            'description' => 'required|string',

            'description_ar' => 'nullable|string',

            'price' => 'required|numeric|min:0',

            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            /*
            Digital only
            */

            'file' => [
                'nullable',
                'file',
                'max:102400',
                'required_if:type,digital',
            ],

            /*
            POD only
            */

            'supplier_id' => 'required_if:type,pod|nullable|exists:suppliers,id',

            'base_product' => 'required_if:type,pod|nullable|string',

            'base_cost' => 'required_if:type,pod|nullable|numeric',

            'sizes' => 'nullable|array',

            'colors' => 'nullable|array',

            /*
            Common
            */

            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'license' => 'nullable|in:personal,commercial,extended',

            'status' => 'required|in:draft,published,archived',

        ]);

        /*
        |--------------------------------------------------------------------------
        | Image
        |--------------------------------------------------------------------------
        */

        $image = $request->file('image')
            ->store(
                'digital-products/images',
                'public'
            );

        /*
        |--------------------------------------------------------------------------
        | Digital File
        |--------------------------------------------------------------------------
        */

        $file = null;

        if (
            $request->type === 'digital'
            &&
            $request->hasFile('file')
        ) {

            $file =
            $request->file('file')
                ->store(
                    'digital-products/files',
                    'public'
                );

        }

        /*
        |--------------------------------------------------------------------------
        | Gallery
        |--------------------------------------------------------------------------
        */

        $gallery = [];

        if ($request->hasFile('gallery')) {

            foreach ($request->file('gallery') as $photo) {

                $gallery[] =
                $photo->store(
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

            'type' => $request->type,

            'digital_category_id' => $request->digital_category_id,

            'title' => $request->title,

            'title_ar' => $request->title_ar,

            'description' => $request->description,

            'description_ar' => $request->description_ar,

            'slug' => Str::slug($request->title)
            .'-'
            .Str::random(6),

            'price' => $request->price,

            'is_free' => $request->price <= 0,

            'image' => $image,

            'file' => $file,

            /*
            Digital
            */

            'version' => $request->version,

            'compatible_with' => $request->compatible_with,

            'file_size' => $request->file_size,

            'included_files' => $request->included_files,

            'license' => $request->license ?? 'personal',

            /*
            POD
            */

            'supplier_id' => $request->type === 'pod'
            ? $request->supplier_id
            : null,

            'base_product' => $request->type === 'pod'
            ? $request->base_product
            : null,

            'base_cost' => $request->type === 'pod'
            ? $request->base_cost
            : null,

            'sizes' => $request->type === 'pod'
            ? $request->sizes
            : null,

            'colors' => $request->type === 'pod'
            ? $request->colors
            : null,

            'preview_url' => $request->preview_url,

            'video_url' => $request->video_url,

            'requirements' => $request->requirements,

            'installation' => $request->installation,

            'changelog' => $request->changelog,

            'gallery' => $gallery,

            /*
            Marketplace
            */

            'downloads' => 0,

            'favorites' => 0,

            'rating' => 0,

            'reviews' => 0,

            /*
            Admin owner
            */

            'user_id' => auth()->id(),

            'owner_type' => 'admin',

            'commission' => 0,

            'requires_approval' => false,

            'featured' => $request->boolean('featured'),

            'status' => $request->status,

        ]);

        return redirect()
            ->route('digital-products.index')
            ->with(
                'success',
                'Product created successfully.'
            );

    }

    /*
    |--------------------------------------------------------------------------
    | Show
    |--------------------------------------------------------------------------
    */

    public function show($slug)
    {

        $product =
        DigitalProduct::with([
            'digitalCategory',
            'supplier',
        ])
            ->whereSlug($slug)
            ->where(
                'status',
                'published'
            )
            ->firstOrFail();

        return view(
            'admin.digital-products.show',
            compact('product')
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Download
    |--------------------------------------------------------------------------
    */

    public function download($slug)
    {

        $product =
        DigitalProduct::whereSlug($slug)
            ->firstOrFail();

        if ($product->type !== 'digital') {

            abort(404);

        }

        abort_unless($product->is_free || auth()->user()->downloads()->where('digital_product_id', $product->id)->where('paid', true)->exists(), 403);

        return Storage::disk('public')
            ->download(
                $product->file,
                basename($product->file)
            );

    }
}
