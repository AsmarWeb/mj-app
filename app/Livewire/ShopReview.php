<?php

namespace App\Livewire;

use App\Models\Shop;
use App\Models\ShopRating;
use Livewire\Component;

class ShopReview extends Component
{
    public Shop $shop;

    public $rating = 5;

    public $review = '';

    public function mount(Shop $shop)
    {
        $this->shop = $shop;

        if(auth()->check()){

            $myReview = ShopRating::where([
                'shop_id'=>$shop->id,
                'user_id'=>auth()->id()
            ])->first();

            if($myReview){

                $this->rating = $myReview->rating;
                $this->review = $myReview->review;

            }

        }
    }

    public function save()
    {
        abort_if(!auth()->check(),403);

        $this->validate([
            'rating'=>'required|min:1|max:5',
            'review'=>'nullable|max:1000'
        ]);

        ShopRating::updateOrCreate(

            [
                'shop_id'=>$this->shop->id,
                'user_id'=>auth()->id()
            ],

            [
                'rating'=>$this->rating,
                'review'=>$this->review
            ]

        );

        $this->shop->update([

            'rating'=>round(
                $this->shop->ratings()->avg('rating'),
                2
            ),

            'ratings_count'=>$this->shop->ratings()->count(),

        ]);

        $this->dispatch('reviewSaved');
    }

    public function render()
    {
        return view('livewire.shop-review',[

            'reviews'=>$this->shop
                ->ratings()
                ->with('user')
                ->latest()
                ->paginate(10)

        ]);
    }
}
