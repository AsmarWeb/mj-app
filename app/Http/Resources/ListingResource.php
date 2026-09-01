<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'title' => $this->title,
            'title_ar' => $this->title_ar,
            'slug' => $this->slug,

            'sku' => $this->sku,

            'price' => $this->price,
            'currency' => $this->currency,

            'quantity' => $this->quantity,

            'description' => $this->description,

            'features' => $this->features,
            'keywords' => $this->keywords,

            'image' => $this->image,
            'video' => $this->video,
            'images' => $this->images,

            'price_condition' => $this->price_condition,
            'condition' => $this->condition,

            'shipping_method' => $this->shipping_method,
            'delivery_days' => $this->delivery_days,

            'featured' => $this->featured,
            'featured_at' => $this->featured_at,

            'rating' => $this->rating,

            'url' => $this->url,

            'shop' => new ShopResource($this->whenLoaded('shop')),

            'category' => $this->whenLoaded('category'),
            'section' => $this->whenLoaded('section'),
            'brand' => $this->whenLoaded('brand'),
            'subcategory' => $this->whenLoaded('subcategory'),

            'state' => $this->whenLoaded('state'),
            'city' => $this->whenLoaded('city'),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
