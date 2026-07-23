<?php

namespace App\Livewire\Admin\Listing;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Listing;
use App\Models\Section;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateComponent extends Component
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

    public $keyword;


    public $shipping_method;

    public $delivery_days;



    public $features = [];

    public $feature;



    public $image;

    public $images = [];



    protected function rules()
    {
        return [

            'title' => 'required|max:255',

            'title_ar' => 'nullable|max:255',

            'description' => 'required',


            'price' => 'required|numeric|min:0',

            'quantity' => 'required|integer|min:1',


            'brand_id' => 'nullable',

            'section_id' => 'required',

            'category_id' => 'required',

            'subcategory_id' => 'nullable',


            'condition' => 'required',

            'price_condition' => 'required',


            'shipping_method' => 'nullable|string',

            'delivery_days' => 'nullable|integer',


            'image' =>
                'nullable|image|max:5120',


            'images.*' =>
                'nullable|image|max:5120',

        ];
    }





    public function addFeature()
    {
        if($this->feature){

            $this->features[] = $this->feature;

            $this->feature = '';

        }
    }



    public function removeFeature($index)
    {
        unset($this->features[$index]);

        $this->features =
            array_values($this->features);
    }




    public function addKeyword()
    {
        if($this->keyword){

            $this->keywords[] =
                $this->keyword;


            $this->keyword = '';

        }
    }




    public function removeKeyword($index)
    {
        unset($this->keywords[$index]);

        $this->keywords =
            array_values($this->keywords);
    }





    public function save()
    {

        $this->validate();



        $listing = new Listing();



        $listing->sku =
            now()->format('YmdHis');



        $listing->title =
            $this->title;


        $listing->title_ar =
            $this->title_ar;



        $listing->description =
            $this->description;



        $listing->price =
            $this->price;


        $listing->quantity =
            $this->quantity;



        $listing->brand_id =
            $this->brand_id;


        $listing->section_id =
            $this->section_id;


        $listing->category_id =
            $this->category_id;


        $listing->subcategory_id =
            $this->subcategory_id;




        $listing->condition =
            $this->condition;



        $listing->price_condition =
            $this->price_condition;



        $listing->keywords =
            json_encode($this->keywords);



        $listing->features =
            json_encode($this->features);




        $listing->shipping_method =
            $this->shipping_method;



        $listing->delivery_days =
            $this->delivery_days;



        // Admin created

        $listing->user_id =
            Auth::id();



        $listing->status =
            'published';


        $listing->active =
            true;


        $listing->published_at =
            now();




        /*
        |--------------------------------------------------------------------------
        | Main Image
        |--------------------------------------------------------------------------
        */

        if($this->image){

            $imageName =
                Carbon::now()->timestamp
                .'.'
                .$this->image->extension();



            $this->image->storeAs(
                'products',
                $imageName,
                'public'
            );


            $listing->image =
                $imageName;

        }





        /*
        |--------------------------------------------------------------------------
        | Gallery Images
        |--------------------------------------------------------------------------
        */


        $gallery = [];


        foreach($this->images as $key=>$image){


            $name =
                Carbon::now()->timestamp
                .'_'.$key
                .'.'
                .$image->extension();



            $image->storeAs(
                'products',
                $name,
                'public'
            );


            $gallery[] =
                $name;


        }



        $listing->images =
            json_encode($gallery);




        $listing->save();



        session()->flash(
            'success',
            'Listing created successfully.'
        );



        return redirect()
            ->route('admin.listings.index');

    }





    public function updatedSectionId()
    {
        $this->category_id = null;
        $this->subcategory_id = null;
        $this->brand_id = null;
    }




    public function updatedCategoryId()
    {
        $this->subcategory_id = null;
        $this->brand_id = null;
    }




    public function render()
    {

        return view(
            'livewire.admin.listing.create-component',
            [

                'sections'=>
                    Section::all(),


                'categories'=>
                    Category::where(
                        'section_id',
                        $this->section_id
                    )->get(),



                'subcategories'=>
                    Subcategory::where(
                        'category_id',
                        $this->category_id
                    )->get(),



                'brands'=>
                    Brand::where(
                        'subcategory_id',
                        $this->subcategory_id
                    )->get(),

            ]
        );

    }
}
