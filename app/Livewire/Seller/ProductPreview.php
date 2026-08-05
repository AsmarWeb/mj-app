<?php

namespace App\Livewire\Seller;

use App\Models\Listing;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductPreview extends Component
{
    public ?Listing $listing = null;

    public $title = '';

    public $description = '';

    public $price = 0;

    public $quantity = 1;

    public $condition = 'new';

    public $price_condition = 'fixed';

    public $features = [];

    public $keywords = [];

    public $image = null;

    public function mount(?Listing $listing = null): void
    {
        if ($listing && $listing->exists) {

            $this->listing = $listing;

            $this->title = $listing->title;
            $this->description = $listing->description;
            $this->price = $listing->price;
            $this->quantity = $listing->quantity;

            $this->condition = $listing->condition;
            $this->price_condition = $listing->price_condition;

            $this->features = $listing->features ?? [];
            $this->keywords = $listing->keywords ?? [];

            $this->image = $listing->image;
        }
    }

    #[On('previewUpdated')]
    public function previewUpdated(array $data): void
    {
        $this->title = $data['title'] ?? $this->title;
        $this->description = $data['description'] ?? $this->description;
        $this->price = $data['price'] ?? $this->price;
        $this->quantity = $data['quantity'] ?? $this->quantity;

        $this->condition = $data['condition'] ?? $this->condition;
        $this->price_condition = $data['price_condition'] ?? $this->price_condition;

        $this->features = $data['features'] ?? $this->features;
        $this->keywords = $data['keywords'] ?? $this->keywords;

        $this->image = $data['image'] ?? $this->image;
    }

    public function render()
    {
        return view('livewire.seller.product-preview');
    }
}
