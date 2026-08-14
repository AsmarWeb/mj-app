<?php

namespace App\Livewire\Seller;

use App\Models\Listing;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductPreview extends Component
{
    public ?Listing $listing = null;

    public string $title = '';

    public string $description = '';

    public $price = 0;

    public $quantity = 1;

    public string $condition = 'new';

    public string $price_condition = 'fixed';

    public array $features = [];

    public array $keywords = [];

    /*
    |--------------------------------------------------------------------------
    | IMPORTANT
    |--------------------------------------------------------------------------
    |
    | This can contain:
    |
    | 1. Temporary Livewire URL:
    |    http://localhost/livewire/preview-file/...
    |
    | 2. Existing filename:
    |    123456789.jpg
    |
    */
    public ?string $image = null;


    /*
    |--------------------------------------------------------------------------
    | Mount
    |--------------------------------------------------------------------------
    */
    public function mount(?Listing $listing = null): void
    {
        if (!$listing || !$listing->exists) {
            return;
        }

        $this->listing = $listing;

        $this->title = $listing->title ?? '';

        $this->description = $listing->description ?? '';

        $this->price = $listing->price ?? 0;

        $this->quantity = $listing->quantity ?? 1;

        $this->condition = $listing->condition ?? 'new';

        $this->price_condition = $listing->price_condition ?? 'fixed';

        $this->features = is_array($listing->features)
            ? $listing->features
            : [];

        $this->keywords = is_array($listing->keywords)
            ? $listing->keywords
            : [];

        /*
        |--------------------------------------------------------------------------
        | Existing listing image
        |--------------------------------------------------------------------------
        |
        | Database contains:
        |
        | products.jpg
        |
        | File exists at:
        |
        | storage/app/public/products/products.jpg
        |
        */
        $this->image = $listing->image;
    }


    /*
    |--------------------------------------------------------------------------
    | Image URL
    |--------------------------------------------------------------------------
    */
    #[Computed]
    public function imageUrl(): ?string
    {
        /*
        |--------------------------------------------------------------------------
        | No image
        |--------------------------------------------------------------------------
        */
        if (!$this->image) {
            return $this->getListingImageUrl();
        }


        /*
        |--------------------------------------------------------------------------
        | Temporary Livewire image
        |--------------------------------------------------------------------------
        |
        | CreateListing sends:
        |
        | $this->image->temporaryUrl()
        |
        | Therefore this is already a browser-ready URL.
        |--------------------------------------------------------------------------
        */
        if (
            is_string($this->image) &&
            (
                str_starts_with($this->image, 'http://') ||
                str_starts_with($this->image, 'https://') ||
                str_starts_with($this->image, '/livewire/')
            )
        ) {
            return $this->image;
        }


        /*
        |--------------------------------------------------------------------------
        | Existing stored image
        |--------------------------------------------------------------------------
        |
        | Database value:
        |
        | abc123.jpg
        |
        | Actual file:
        |
        | storage/app/public/products/abc123.jpg
        |--------------------------------------------------------------------------
        */
        if (is_string($this->image)) {

            $filename = ltrim($this->image, '/');

            /*
            | Prevent:
            | products/products/image.jpg
            */
            if (str_starts_with($filename, 'products/')) {
                $path = $filename;
            } else {
                $path = 'products/' . $filename;
            }

            /*
            |--------------------------------------------------------------------------
            | Verify the file actually exists
            |--------------------------------------------------------------------------
            */
            $fullPath = storage_path('app/public/' . $path);

            if (file_exists($fullPath)) {
                return Storage::url($path);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Fallback to listing image
        |--------------------------------------------------------------------------
        */
        return $this->getListingImageUrl();
    }


    /*
    |--------------------------------------------------------------------------
    | Existing Listing Image
    |--------------------------------------------------------------------------
    */
    private function getListingImageUrl(): ?string
    {
        if (!$this->listing?->image) {
            return null;
        }

        $filename = ltrim($this->listing->image, '/');

        /*
        |--------------------------------------------------------------------------
        | Prevent duplicate products/ directory
        |--------------------------------------------------------------------------
        */
        if (str_starts_with($filename, 'products/')) {
            $path = $filename;
        } else {
            $path = 'products/' . $filename;
        }

        /*
        |--------------------------------------------------------------------------
        | Check physical file
        |--------------------------------------------------------------------------
        */
        $fullPath = storage_path('app/public/' . $path);

        if (!file_exists($fullPath)) {
            return null;
        }

        return Storage::url($path);
    }


    /*
    |--------------------------------------------------------------------------
    | Preview Updates
    |--------------------------------------------------------------------------
    */
    #[On('previewUpdated')]
    public function previewUpdated(array $data): void
    {
        /*
        |--------------------------------------------------------------------------
        | Text
        |--------------------------------------------------------------------------
        */
        if (array_key_exists('title', $data)) {
            $this->title = (string) $data['title'];
        }

        if (array_key_exists('description', $data)) {
            $this->description = (string) $data['description'];
        }


        /*
        |--------------------------------------------------------------------------
        | Price
        |--------------------------------------------------------------------------
        */
        if (array_key_exists('price', $data)) {
            $this->price = $data['price'];
        }

        if (array_key_exists('quantity', $data)) {
            $this->quantity = $data['quantity'];
        }


        /*
        |--------------------------------------------------------------------------
        | Product settings
        |--------------------------------------------------------------------------
        */
        if (array_key_exists('condition', $data)) {
            $this->condition = (string) $data['condition'];
        }

        if (array_key_exists('price_condition', $data)) {
            $this->price_condition = (string) $data['price_condition'];
        }


        /*
        |--------------------------------------------------------------------------
        | Features
        |--------------------------------------------------------------------------
        */
        if (array_key_exists('features', $data)) {
            $this->features = is_array($data['features'])
                ? $data['features']
                : [];
        }


        /*
        |--------------------------------------------------------------------------
        | Keywords
        |--------------------------------------------------------------------------
        */
        if (array_key_exists('keywords', $data)) {
            $this->keywords = is_array($data['keywords'])
                ? $data['keywords']
                : [];
        }


        /*
        |--------------------------------------------------------------------------
        | Image
        |--------------------------------------------------------------------------
        |
        | CreateListing sends the temporaryUrl().
        |
        | Example:
        |
        | https://example.com/livewire/preview-file/...
        |
        |--------------------------------------------------------------------------
        */
        if (
            array_key_exists('image', $data) &&
            !empty($data['image'])
        ) {
            $this->image = (string) $data['image'];
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Render
    |--------------------------------------------------------------------------
    */
    public function render()
    {
        return view('livewire.seller.product-preview');
    }
}