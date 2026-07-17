<?php

namespace App\Livewire\Seller;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Listing;
use App\Models\Section;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateListing extends Component
{
    use WithFileUploads;

    public $title;
    public $title_ar;
    public $description;
    public $price;
    public $quantity = 1;

    public $brand_id;
    public $section_id;
    public $category_id;
    public $subcategory_id;

    public $condition = 'new';
    public $price_condition = 'fixed';

    public $keywords = [];

    public $keyword = '';

    public $shipping_method;
    public $delivery_days;

    public $status = 'draft';

    public $features = [];

    public $feature = '';

    public $image;

    public $images = [];

    public $subscription;
    public $plan;
    public $usedListings = 0;
    public $canCreate = true;

    public function mount()
    {
        $shop = auth()->user()->shop;

        if (! $shop) {
            abort(403, 'Please create a shop first.');
        }

        $this->subscription = $shop->subscriptions()
            ->where('status', 'active')
            ->with('plan')
            ->latest()
            ->first();

        if (! $this->subscription) {
            $this->canCreate = false;
            return;
        }

        $this->plan = $this->subscription->plan;

        // Count published listings
        $this->usedListings = $shop->listings()
        ->where('status', 'published')
        ->where(function ($query) {
        $query->whereNull('expires_at')
              ->orWhere('expires_at', '>', now());
              })
              ->count();

        // Check plan limit
        $this->canCreate = $this->usedListings < $this->plan->listing_limit;
    }

    protected function rules()
    {
        return [

            'title' => 'required|max:255',

            'title_ar' => 'required|max:255',

            'description' => 'required',

            'price' => 'required|numeric|min:1',

            'quantity' => 'required|integer|min:1',

            'brand_id' => 'required',

            'section_id' => 'required',

            'category_id' => 'required',

            'subcategory_id' => 'required',

            'condition' => 'required',

            'price_condition' => 'required',

            'image' => 'required|image|max:2048',

            'images.*' => 'image|max:2048',

        ];
    }

    public function addFeature()
    {
        if ($this->feature) {

            $this->features[] = $this->feature;

            $this->feature = '';
        }
    }

    public function removeFeature($index)
    {
        unset($this->features[$index]);

        $this->features = array_values($this->features);
    }


    public function addKeyword()
    {
    if($this->keyword){

        $this->keywords[] = $this->keyword;

        $this->keyword = '';

    }
    }
    
    public function removeKeyword($index)
    {
    unset($this->keywords[$index]);

    $this->keywords = array_values($this->keywords);
    }

    public function save($status = 'published')
    {
        // Double-check on the server
        if (! $this->canCreate) {
            session()->flash('error', 'You have reached your plan limit. Please upgrade your subscription.');
            return;
        }

        $this->validate();

        $user = Auth::user();

        $shop = $user->shop;

        if (!$shop) {

            session()->flash('error', 'Please create a shop first.');

            return;
        }

        $subscription = $shop->subscriptions()
            ->where('status', 'active')
            ->with('plan')
            ->latest()
            ->first();

        if (!$subscription) {

            session()->flash('error', 'Please subscribe first.');

            return;
        }

        $plan = $subscription->plan;

        if ($shop->listings()->count() >= $plan->listing_limit) {

            session()->flash('error', 'Listing limit reached.');

            return;
        }

        $listing = new Listing();

        $listing->sku = now()->format('YmdHis');

        $listing->title = $this->title;

        $listing->title_ar = $this->title_ar;

        $listing->description = $this->description;

        $listing->price = $this->price;

        $listing->quantity = $this->quantity;

        $listing->brand_id = $this->brand_id;

        $listing->section_id = $this->section_id;

        $listing->category_id = $this->category_id;

        $listing->subcategory_id = $this->subcategory_id;

        $listing->condition = $this->condition;

        $listing->price_condition = $this->price_condition;

        $listing->keywords = $this->keywords;

        $listing->features = $this->features;

        $listing->shop_id = $shop->id;

        $listing->user_id = $user->id;

        $listing->active = true;

        $listing->keywords = $this->keywords;
        
        $listing->shipping_method = $this->shipping_method;

        $listing->delivery_days = $this->delivery_days;

        $listing->status = 'published';

        $listing->published_at = now();

        $listing->expires_at = $plan->listing_duration
            ? now()->addDays($plan->listing_duration)
            : null;

        // Upload main image
        if ($this->image) {
            $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
            $this->image->storeAs('products', $imageName, 'public');
            $listing->image = $imageName;
            }
            
        // Upload gallery images
        $gallery = [];
        if ($this->images) {
            foreach ($this->images as $key => $image) {
                $imgName = Carbon::now()->timestamp . '_' . $key . '.' . $image->extension();
                $image->storeAs('products', $imgName, 'public');
                $gallery[] = $imgName;}
                $listing->images = $gallery;
            }

        $listing->save();

        session()->flash('success', 'Product published successfully.');

        return redirect()->route('profile');
    }

    public function render()
    {
        return view('livewire.seller.create-listing', [

            'sections' => Section::all(),

            'categories' => Category::all(),

            'subcategories' => Subcategory::all(),

            'brands' => Brand::all(),

        ]);
    }

    public function updated($property)
    {
    $this->dispatch('previewUpdated', [

        'title' => $this->title,

        'description' => $this->description,

        'price' => $this->price,

        'image' => $this->image 
            ? $this->image->temporaryUrl()
            : null,

    ]);
    }
} 
