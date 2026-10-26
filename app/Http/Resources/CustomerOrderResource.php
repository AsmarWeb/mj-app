<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerOrderResource extends JsonResource
{
    private bool $details = false;

    public function withDetails(): static
    {
        $this->details = true;

        return $this;
    }

    public function toArray(Request $request): array
    {
        $address = $this->details ? $this->shipping_address : null;

        return ['id' => $this->id, 'order_number' => $this->order_number,
            'status' => $this->status, 'payment_status' => $this->payment_status,
            'currency' => $this->checkout_currency ?: null, 'subtotal' => (string) $this->subtotal,
            'shipping' => (string) $this->shipping, 'tax' => (string) $this->tax,
            'discount' => (string) $this->discount, 'total' => (string) $this->total,
            'created_at' => $this->created_at?->toISOString(), 'paid_at' => $this->paid_at?->toISOString(),
            'shop' => $this->whenLoaded('shop', fn () => $this->shop ? [
                'id' => $this->shop->id, 'name' => $this->shop->name, 'slug' => $this->shop->slug] : null),
            'delivery' => $this->whenLoaded('rasloShipment', fn () => $this->rasloShipment ? new CustomerDeliveryResource($this->rasloShipment) : null),
            'items' => $this->whenLoaded('items', fn () => $this->items->map(fn ($item) => [
                'id' => $item->id, 'listing_id' => $item->listing_id, 'digital_product_id' => $item->digital_product_id,
                'title' => $item->listing_name, 'quantity' => (int) $item->quantity,
                'unit_price' => (string) $item->price, 'total' => (string) $item->total])),
            'shipping_address' => $this->when($this->details, fn () => is_array($address) ? array_intersect_key($address, array_flip([
                'recipient_name', 'recipient_phone', 'country', 'emirate', 'city', 'area', 'address_line',
                'building', 'unit', 'landmark', 'delivery_notes', 'shipping_method'])) : null),
        ];
    }
}
