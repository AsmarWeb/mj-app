<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'name_ar' => $this->name_ar,
            'slug' => $this->slug,

            'logo' => $this->logo,
            'banner' => $this->banner,

            'type' => $this->type,
            'description' => $this->description,

            'currency' => $this->currency,
            'location' => $this->location,

            'latitude' => $this->latitude,
            'longitude' => $this->longitude,

            'rating' => $this->rating,

            'phone' => $this->when(
                $this->allow_phone,
                $this->phone
            ),

            'whatsapp' => $this->when(
                $this->allow_whatsapp,
                $this->whatsapp
            ),

            'verified' => $this->verified,

            'section' => $this->whenLoaded('section'),
            'country' => $this->whenLoaded('country'),
            'state' => $this->whenLoaded('state'),
            'city' => $this->whenLoaded('city'),

            'listings' => $this->whenLoaded('listings'),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
