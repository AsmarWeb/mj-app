<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use Livewire\Attributes\On;

class ProductPreview extends Component
{
    public $title;
    public $description;
    public $price;
    public $image;


    protected $listeners = [
    'previewUpdated'
    ];
    
    #[On('previewUpdated')]
    public function previewUpdated($data)
    {
    $this->title = $data['title'];
    $this->description = $data['description'];
    $this->price = $data['price'];
    $this->image = $data['image'];
    }



    public function render()
    {
        return view('livewire.seller.product-preview');
    }
}
