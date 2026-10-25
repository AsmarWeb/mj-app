<?php

namespace App\Http\Resources;

use App\Services\Catalog\PublicFields;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListingResource extends JsonResource
{
    private bool $includeShop = true;

    public function withoutShop(): static
    {
        $this->includeShop = false;

        return $this;
    }

    public function toArray(Request $request): array
    {
        $images = array_values(array_filter(array_map([PublicFields::class, 'path'], array_slice((array) $this->images, 0, 20))));

        return [
            'id' => $this->id, 'title' => $this->title, 'title_ar' => $this->title_ar, 'slug' => $this->slug, 'sku' => $this->sku,
            'price' => (string) $this->price, 'currency' => $this->currency, 'quantity' => (int) $this->quantity,
            'description' => mb_substr((string) $this->description, 0, 10000),
            'features' => PublicFields::strings($this->features, 50, 300), 'keywords' => PublicFields::strings($this->keywords, 50, 100),
            'image' => PublicFields::path($this->image), 'video' => PublicFields::path($this->video), 'images' => $images,
            'image_url' => PublicFields::media($this->image, 'products/'),
            'video_url' => PublicFields::media($this->video, 'products/videos/'),
            'image_urls' => array_map(fn ($image) => PublicFields::media($image, 'products/'), $images),
            'price_condition' => $this->price_condition, 'condition' => $this->condition,
            'shipping_method' => $this->shipping_method, 'delivery_days' => $this->delivery_days === null ? null : (int) $this->delivery_days,
            'featured' => (bool) $this->featured, 'featured_at' => $this->featured_at,
            // This aggregate is loaded with the catalog query, avoiding a query per resource.
            'rating' => $this->catalog_rating === null ? null : (float) $this->catalog_rating,
            'url' => $this->url, 'api_url' => route('api.v1.listings.show', ['slug' => $this->slug]),
            'shop' => $this->when($this->includeShop, fn () => new ShopResource($this->whenLoaded('shop'))),
            'category' => $this->whenLoaded('category', fn () => PublicFields::reference($this->category, 'category_name', 'category_name_ar')),
            'section' => $this->whenLoaded('section', fn () => PublicFields::reference($this->section)),
            'brand' => $this->whenLoaded('brand', fn () => PublicFields::reference($this->brand, 'brand_name', 'brand_name_ar')),
            'subcategory' => $this->whenLoaded('subcategory', fn () => PublicFields::reference($this->subcategory, 'subcategory_name', 'subcategory_name_ar')),
            'state' => $this->whenLoaded('shop', fn () => $this->shop?->state ? PublicFields::reference($this->shop->state) : null),
            'city' => $this->whenLoaded('shop', fn () => $this->shop?->city ? PublicFields::reference($this->shop->city) : null),
            'created_at' => $this->created_at, 'updated_at' => $this->updated_at,
        ];
    }
}
