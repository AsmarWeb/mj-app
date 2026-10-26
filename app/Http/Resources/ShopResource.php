<?php

namespace App\Http\Resources;

use App\Services\Catalog\PublicFields;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, 'name' => $this->name, 'name_ar' => $this->name_ar, 'slug' => $this->slug,
            'logo' => PublicFields::path($this->logo), 'banner' => PublicFields::path($this->banner),
            'logo_url' => PublicFields::media($this->logo), 'banner_url' => PublicFields::media($this->banner),
            'type' => $this->type, 'description' => mb_substr((string) $this->description, 0, 4000),
            'currency' => $this->currency, 'location' => $this->location, 'latitude' => $this->latitude === null ? null : (float) $this->latitude, 'longitude' => $this->longitude === null ? null : (float) $this->longitude,
            'rating' => $this->rating, 'phone' => $this->when((bool) $this->allow_phone, $this->phone),
            'whatsapp' => $this->when((bool) $this->allow_whatsapp, $this->whatsapp), 'verified' => (bool) $this->verified,
            'section' => $this->whenLoaded('section', fn () => PublicFields::reference($this->section)),
            'country' => $this->whenLoaded('country', fn () => PublicFields::reference($this->country)),
            'state' => $this->whenLoaded('state', fn () => PublicFields::reference($this->state)),
            'city' => $this->whenLoaded('city', fn () => PublicFields::reference($this->city)),
            // Only the detail controller loads a public, bounded preview. Never serialize raw models.
            'listings' => $this->whenLoaded('listings', fn () => $this->listings->map(fn ($listing) => (new ListingResource($listing))->withoutShop())),
            'api_url' => route('api.v1.shops.show', ['slug' => $this->slug]),
            'listings_url' => route('api.v1.shops.listings', ['slug' => $this->slug]),
            'created_at' => $this->created_at, 'updated_at' => $this->updated_at,
        ];
    }
}
