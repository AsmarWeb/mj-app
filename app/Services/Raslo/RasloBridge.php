<?php

namespace App\Services\Raslo;

use App\Models\Order;
use App\Models\RasloConnection;
use App\Models\RasloShipment;
use App\Services\Checkout\ShippingMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RasloBridge
{
    public function capture(Order $order, bool $manual = false): ?RasloShipment
    {
        if ($existing = RasloShipment::where('order_id', $order->id)->first()) {
            return $existing;
        }
        $method = $order->shipping_address['shipping_method'] ?? null;
        if ($method !== ShippingMethod::RASLO) {
            if ($manual && $method !== null) {
                throw ValidationException::withMessages(['raslo' => 'This order uses merchant shipping or pickup, not Raslo.']);
            }
            if (! $manual) {
                return null;
            }
        }
        $connection = RasloConnection::where('shop_id', $order->shop_id)->where('enabled', true)->whereNotNull('verified_at')->lockForUpdate()->first();
        if (! $connection) {
            if ($manual || $method === ShippingMethod::RASLO) {
                throw ValidationException::withMessages(['raslo' => 'Enable the store connection first.']);
            }

            return null;
        }
        $a = $order->shipping_address;
        if ($order->checkout_currency !== 'AED' || ! $order->checkout_token || ! is_array($a) || ($a['country'] ?? null) !== 'AE'
            || ! $order->items()->exists() || $order->items()->whereNull('listing_id')->exists()) {
            throw ValidationException::withMessages(['raslo' => 'Only physical AED orders with a saved UAE shipping address can be sent.']);
        }
        $recipient = ['contact_name' => $a['recipient_name'] ?? null, 'contact_phone' => $a['recipient_phone'] ?? null, 'city' => $a['city'] ?? null,
            'emirate' => $a['emirate'] ?? null, 'address_line' => $a['address_line'] ?? null];
        foreach (['area', 'building', 'unit', 'landmark'] as $field) {
            if (filled($a[$field] ?? null)) {
                $recipient[$field] = $a[$field];
            }
        }
        Validator::make($recipient, [
            'contact_name' => 'required|string|max:200', 'contact_phone' => ['required', 'regex:/^\+971[0-9]{8,9}$/D'],
            'city' => 'required|string|max:120', 'emirate' => 'required|in:abu_dhabi,dubai,sharjah,ajman,umm_al_quwain,ras_al_khaimah,fujairah',
            'address_line' => 'required|string|min:5|max:1000', 'area' => 'nullable|string|max:120', 'building' => 'nullable|string|max:120',
            'unit' => 'nullable|string|max:80', 'landmark' => 'nullable|string|max:200',
        ])->validate();

        return RasloShipment::create(['order_id' => $order->id, 'raslo_connection_id' => $connection->id,
            'external_order_id' => 'mj:'.$order->shop_id.':'.$order->id, 'idempotency_key' => (string) Str::uuid(),
            'payload' => ['external_order_id' => 'mj:'.$order->shop_id.':'.$order->id, 'currency' => 'AED', 'payment_status' => 'paid',
                'recipient' => $recipient, 'package_description' => 'Physical order '.$order->order_number,
                'instructions' => mb_substr((string) ($a['delivery_notes'] ?? ''), 0, 1000)],
            'state' => 'awaiting_payment']);
    }

    public function paid(Order $order): void
    {
        if (! $order->isPaid()) {
            return;
        }
        RasloShipment::where('order_id', $order->id)->where('state', 'awaiting_payment')->update(['state' => 'pending', 'next_attempt_at' => now()]);
    }

    public function expired(Order $order): void
    {
        RasloShipment::where('order_id', $order->id)->where('state', 'awaiting_payment')->update(['state' => 'cancelled']);
    }

    public function retry(Order $order): void
    {
        DB::transaction(function () use ($order) {
            $order = Order::whereKey($order->id)->lockForUpdate()->firstOrFail();
            if (! $order->isPaid() || $order->status !== 'processing') {
                throw ValidationException::withMessages(['raslo' => 'Only confirmed paid orders awaiting fulfillment can be sent.']);
            }
            $shipment = $this->capture($order, true);
            $shipment = RasloShipment::whereKey($shipment->id)->lockForUpdate()->firstOrFail();
            if (! $shipment->connection->enabled) {
                throw ValidationException::withMessages(['raslo' => 'Enable the connection before retrying.']);
            }
            if ($shipment->remote_id || $shipment->state === 'processing') {
                return;
            }
            $shipment->update(['state' => 'pending', 'attempts' => 0, 'error_code' => null, 'next_attempt_at' => now(), 'queued_at' => null]);
        }, 3);
    }
}
