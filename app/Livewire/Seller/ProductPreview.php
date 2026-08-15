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

    // =========================================================
    // BASIC
    // =========================================================

    public string $title = '';

    public string $title_ar = '';

    public string $description = '';

    public $price = 0;

    public $quantity = 1;

    // =========================================================
    // PRODUCT
    // =========================================================

    public string $condition = 'new';

    public string $price_condition = 'fixed';

    public array $features = [];

    public array $keywords = [];

    // =========================================================
    // BRAND
    // =========================================================

    public $brand_id = null;

    public string $local_brand_name = '';

    public string $local_brand_name_ar = '';

    // =========================================================
    // CATEGORY
    // =========================================================

    public $section_id = null;

    public $category_id = null;

    public $subcategory_id = null;

    // =========================================================
    // IMAGE
    // =========================================================

    public ?string $image = null;

    // =========================================================
    // MOUNT
    // =========================================================

    public function mount(?Listing $listing = null): void
    {
        if (! $listing || ! $listing->exists) {
            return;
        }

        $this->listing = $listing;

        $this->title =
            $listing->title ?? '';

        $this->title_ar =
            $listing->title_ar ?? '';

        $this->description =
            $listing->description ?? '';

        $this->price =
            $listing->price ?? 0;

        $this->quantity =
            $listing->quantity ?? 1;

        $this->condition =
            $listing->condition ?? 'new';

        $this->price_condition =
            $listing->price_condition ?? 'fixed';

        $this->features =
            is_array($listing->features)
            ? $listing->features
            : [];

        $this->keywords =
            is_array($listing->keywords)
            ? $listing->keywords
            : [];

        $this->brand_id =
            $listing->brand_id;

        $this->local_brand_name =
            $listing->local_brand_name ?? '';

        $this->local_brand_name_ar =
            $listing->local_brand_name_ar ?? '';

        $this->section_id =
            $listing->section_id;

        $this->category_id =
            $listing->category_id;

        $this->subcategory_id =
            $listing->subcategory_id;

        $this->image =
            $listing->image;
    }

    // =========================================================
    // IMAGE URL
    // =========================================================

    #[Computed]
    public function imageUrl(): ?string
    {
        if ($this->image) {

            /*
            |--------------------------------------------------------------------------
            | Temporary URL
            |--------------------------------------------------------------------------
            */

            if (
                str_starts_with(
                    $this->image,
                    'http://'
                ) ||
                str_starts_with(
                    $this->image,
                    'https://'
                ) ||
                str_starts_with(
                    $this->image,
                    '/livewire/'
                )
            ) {
                return $this->image;
            }

            /*
            |--------------------------------------------------------------------------
            | Stored image
            |--------------------------------------------------------------------------
            */

            $filename =
                ltrim($this->image, '/');

            $path =
                str_starts_with(
                    $filename,
                    'products/'
                )
                ? $filename
                : 'products/' . $filename;

            if (
                Storage::disk('public')
                ->exists($path)
            ) {
                return Storage::disk('public')
                    ->url($path);
            }
        }

        return $this->getListingImageUrl();
    }

    // =========================================================
    // LISTING IMAGE
    // =========================================================

    private function getListingImageUrl(): ?string
    {
        if (! $this->listing?->image) {
            return null;
        }

        $filename =
            ltrim(
                $this->listing->image,
                '/'
            );

        $path =
            str_starts_with(
                $filename,
                'products/'
            )
            ? $filename
            : 'products/' . $filename;

        if (
            ! Storage::disk('public')
                ->exists($path)
        ) {
            return null;
        }

        return Storage::disk('public')
            ->url($path);
    }

    // =========================================================
    // PREVIEW EVENT
    // =========================================================

    #[On('previewUpdated')]
    public function previewUpdated(
        $title = null,
        $title_ar = null,
        $description = null,
        $price = null,
        $quantity = null,
        $condition = null,
        $price_condition = null,
        $features = null,
        $keywords = null,
        $image = null,
        $local_brand_name = null,
        $local_brand_name_ar = null,
        $brand_id = null,
        $section_id = null,
        $category_id = null,
        $subcategory_id = null
    ): void {

        // -----------------------------------------------------
        // Basic
        // -----------------------------------------------------

        if ($title !== null) {
            $this->title = (string) $title;
        }

        if ($title_ar !== null) {
            $this->title_ar = (string) $title_ar;
        }

        if ($description !== null) {
            $this->description =
                (string) $description;
        }

        if ($price !== null) {
            $this->price = $price;
        }

        if ($quantity !== null) {
            $this->quantity = $quantity;
        }

        // -----------------------------------------------------
        // Product
        // -----------------------------------------------------

        if ($condition !== null) {
            $this->condition =
                (string) $condition;
        }

        if ($price_condition !== null) {
            $this->price_condition =
                (string) $price_condition;
        }

        if ($features !== null) {
            $this->features =
                is_array($features)
                ? $features
                : [];
        }

        if ($keywords !== null) {
            $this->keywords =
                is_array($keywords)
                ? $keywords
                : [];
        }

        // -----------------------------------------------------
        // Image
        // -----------------------------------------------------

        if (
            $image !== null &&
            $image !== ''
        ) {
            $this->image =
                (string) $image;
        }

        // -----------------------------------------------------
        // Brand
        // -----------------------------------------------------

        if ($local_brand_name !== null) {

            $this->local_brand_name =
                (string) $local_brand_name;
        }

        if ($local_brand_name_ar !== null) {

            $this->local_brand_name_ar =
                (string) $local_brand_name_ar;
        }

        if ($brand_id !== null) {
            $this->brand_id = $brand_id;
        } elseif (
            $this->local_brand_name !== '' ||
            $this->local_brand_name_ar !== ''
        ) {
            $this->brand_id = null;
        }

        // -----------------------------------------------------
        // Category
        // -----------------------------------------------------

        if ($section_id !== null) {
            $this->section_id = $section_id;
        }

        if ($category_id !== null) {
            $this->category_id = $category_id;
        }

        if ($subcategory_id !== null) {
            $this->subcategory_id =
                $subcategory_id;
        }
    }

    // =========================================================
    // RENDER
    // =========================================================

    public function render()
    {
        return view(
            'livewire.seller.product-preview'
        );
    }
}
