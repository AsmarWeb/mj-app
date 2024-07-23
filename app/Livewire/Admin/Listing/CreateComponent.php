<?php

namespace App\Livewire\Admin\Listing;

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

class CreateComponent extends Component
{
    use WithFileUploads;

    public $title;
    public $title_ar;
    public $slug;
    public $description;
    public $keywords;
    public $price;
    public $quantity;
    public $featured;
    public $image;
    public $images;

    public $price_condition = [];
    public $condition = [];

    public $name;
    public $email;
    public $phone_number;
    public $location;

    public $country_id;
    public $state_id;
    public $city_id;


    public $shop_id;
    public $brand_id;

    public $sectionID;
    public $categoryID;
    public $subcategoryID;

    public $listing;

    public $selectedSection = '';
    public $selectedCategory = '';
    public $selectedSubCategory = '';

    public function updatedSelectedSection()
    {
        dd('ok');
    }

    protected $rules = [
        'listing.code'              => 'required|string|max:255',
        'country_id'                => 'required',
        'state_id'                  => 'required',
        'city_id'                   => 'nullable',
    ];

    public function mount(): void
    {
        $this->featured = 0;
        $user = User::find(Auth::user()->id);
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->title, '-');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'slug' => 'required|unique:listings',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'image' => [
                'required',
                'image',
                'mimes:jpg,png,jpeg,gif,svg',
            ],
            'price_condition' => 'required',
            'condition' => 'required',
            'sectionId' => 'required',
            'categoryId' => 'required'
        ]);
    }

    public function createlisting()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required|unique:listings',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'image' => [
                'required',
                'image',
                'mimes:jpg,png,jpeg,gif,svg',
            ],
            'price_condition' => 'required',
            'condition' => 'required',
            'sectionId' => 'required',
            'categoryId' => 'required'
        ]);

        $listing = new Listing();
        $user = Auth::user();
        $shop = Shop::shop();
        $listing->user_id = $user->id;
        $listing->shop_id = $shop->id;
        $listing->title = $this->title;
        $listing->title_ar = $this->title_ar;
        $listing->slug = $this->slug;
        $listing->description = $this->description;
        $listing->keywords = $this->keywords;
        $listing->price = $this->price;
        $listing->featured = $this->featured;
        $listing->quantity = $this->quantity;
        $listing->brand_id = $this->brand_id;
        $listing->price_condition = implode('', $this->price_condition);
        $listing->condition = implode('', $this->condition);
        $listing->name = $this->name;
        $listing->email = $this->email;

        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('product', $imageName);
        $listing->image = $imageName;

        if ($this->images) {
            $imagesname = '';
            foreach ($this->images as $key => $image) {
                $imgName = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $image->storeAs('product', $imgName);
                $imagesname = $imagesname . ',' . $imgName;
            }
            $listing->images = $imagesname;
        }


        $listing->country_id = $this->country_id;
        $listing->state_id = $this->state_id;
        $listing->city_id = $this->city_id;

        $listing->sectionID = $this->sectionID;
        $listing->categoryID = $this->categoryID;
        if ($this->subcategoryID) {
            $listing->subcategoryID = $this->subcategoryID;
        }

        $listing->save();
        session()->flash('message', 'Listing created successfully!');
    }

    #[Computed()]
    public function sections()
    {
        return Section::all();
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('section_id', $this->sectionID)->get();
    }

    #[Computed()]
    public function subcategories()
    {
        return SubCategory::where('category_id', $this->categoryID)->get();
    }

    public function render()
    {
        $countries = Country::all();
        $states =  State::where('country_id', $this->country_id)->get();
        $cities = City::where('state_id', $this->state_id)->get();

        return view('livewire.admin.listing.create-component', [
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities
        ])->layout('layouts.admin');
    }
}
