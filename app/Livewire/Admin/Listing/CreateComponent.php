<?php

namespace App\Livewire\Admin\Listing;

use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Listing;
use App\Models\Section;
use App\Models\Shop;
use App\Models\State;
use App\Models\SubCategory;
use App\Models\User; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;

class CreateComponent extends Component
{
    use WithFileUploads;

    public $title,
        $description,
        $features = [],
        $title_ar,
        $price,
        $quantity,
        $keywords,
        $image,
        $images,
        $price_condition = [],
        $condition = [],
        $brand_id,
        $shop_id,
        $section_id,
        $category_id,
        $subcategory_id,
        $addListing = false;

    public function addFeature()
    {
        $this->features[] = '';
    }

    public function removeFeature($index)
    {
        unset($this->features[$index]);

        $this->features = array_values($this->features);
    }

    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'listing.sku'              => 'required|string|max:255',
        'title' => 'required',
        'description' => 'required'
    ];

    public function mount(): void
    {
        //
    }

    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields()
    {
        $this->title = '';
        $this->title_ar = '';
        $this->price = '';
        $this->quantity = '';
        $this->description = '';
        $this->keywords = '';
        $this->image = '';
        $this->images = '';
        $this->price_condition = '';
        $this->condition = '';
        $this->brand_id = '';
        $this->section_id = '';
        $this->category_id = '';
        $this->subcategory_id = '';
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'description' => 'required',
            'features.*' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'image' => [
                'required',
                'image',
                'mimes:jpg,png,jpeg,gif,svg',
            ],
            'price_condition' => 'required',
            'condition' => 'required',
            'section_id' => 'required',
            'category_id' => 'required'
        ]);
    }

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'features.*' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'image' => [
                'required',
                'image',
                'mimes:jpg,png,jpeg,gif,svg',
            ],
            'price_condition' => 'required',
            'condition' => 'required',
            'section_id' => 'required',
            'category_id' => 'required'
        ]);

        $listing = new Listing();
        $user = Auth::user();
        $shop = $user->shop;
        $subscription = $shop->subscriptions()
        ->where('status', 'active')
        ->with('plan')
        ->latest()
        ->first();
        if (! $subscription) {
        session()->flash('error', 'You do not have an active subscription.');
        return;
        }
        $plan = $subscription->plan;

        // Publish immediately
        $listing->status = 'published';
        $listing->active = true;
        $listing->published_at = now();
        
        $listing->expires_at = $plan->listing_duration
        ? now()->addDays($plan->listing_duration)
        : null;

        $listing->user_id = $user->id;
        $listing->shop_id = $user->id;
        $listing->title = $this->title;
        $listing->title_ar = $this->title_ar;
        $listing->description = $this->description;
        $listing->features = $this->features;
        $listing->keywords = $this->keywords;
        $listing->price = $this->price;
        $listing->quantity = $this->quantity;
        $listing->price_condition = implode('', $this->price_condition);
        $listing->condition = implode('', $this->condition);

        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('products', $imageName, 'public');
        $listing->image = $imageName;

        if ($this->images) {
            $imagesname = '';
            foreach ($this->images as $key => $image) {
                $imgName = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $image->storeAs('products', $imgName, 'public');
                $imagesname = $imagesname . ',' . $imgName;
            }
            $listing->images = $imagesname;
        }

        $listing->brand_id = $this->brand_id;
        $listing->section_id = $this->section_id;
        $listing->category_id = $this->category_id;
        if ($this->subcategory_id) {
            $listing->subcategory_id = $this->subcategory_id;
        }

        $listing->save();
        session()->flash('success', 'Listing Created Successfully!!');
        $this->resetFields();
        $this->addListing = false;
    }

    public function changeSubCategory()
    {
        $this->subcategory_id = 0;
    }

    public function changeCategory()
    {
        $this->category_id = 0;
    }

    public function changeBrand()
    {
        $this->brand_id = 0;
    }


    public function render()
    {
        $sections = Section::all();
        $categories = Category::where('section_id', $this->section_id)->get();
        $subcategories = SubCategory::where('category_id', $this->category_id)->get();
        $brands = Brand::where('subcategory_id', $this->subcategory_id)->get();

        return view('livewire.admin.listing.create-component', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'sections' => $sections,
            'brands' => $brands,
        ])->layout('components.layouts.app');
    }

    /**
     * Open Add Post form
     * @return void
     */
    public function addListing()
    {
        $this->resetFields();
        $this->addListing = true;
    }

    /**
     * Cancel Add/Edit form and redirect to post listing page
     * @return void
     */
    public function cancelListing()
    {
        $this->addListing = false;
        $this->resetFields();
    }
}
