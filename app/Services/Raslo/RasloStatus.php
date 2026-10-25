<?php

namespace App\Services\Raslo;

use App\Models\RasloShipment;
use Illuminate\Support\Str;
use RuntimeException;

class RasloStatus
{
    public function apply(RasloShipment $row, array $data, bool $poll = false): void
    {
        if (! is_string($data['id'] ?? null) || ! Str::isUuid($data['id']) || ($row->remote_id && $row->remote_id !== $data['id'])
            || ($data['external_order_id'] ?? null) !== $row->external_order_id || ! is_int($data['sequence'] ?? null) || $data['sequence'] < 1
            || ! is_string($data['status'] ?? null) || ! preg_match('/^[a-z_]{1,60}$/D', $data['status'])
            || (isset($data['tracking_number']) && (! is_string($data['tracking_number']) || strlen($data['tracking_number']) > 255))) {
            throw new RuntimeException('RASLO_RESPONSE_MISMATCH');
        }
        if (isset($data['requires_price_approval']) && ! is_bool($data['requires_price_approval'])) {
            throw new RuntimeException('RASLO_RESPONSE_MISMATCH');
        }
        if ($data['sequence'] < $row->sequence) {
            return;
        }
        if ($data['sequence'] === $row->sequence) {
            if ($poll && array_key_exists('tracking_url', $data)) {
                $row->tracking_url = app(RasloEndpoint::class)->tracking($data['tracking_url']);
            }

            return;
        }
        $row->remote_id = $data['id'];
        $row->sequence = $data['sequence'];
        $row->delivery_status = $data['status'];
        $row->tracking_number = $data['tracking_number'] ?? $row->tracking_number;
        $row->tracking_url = app(RasloEndpoint::class)->tracking($data['tracking_url'] ?? null);
        if (array_key_exists('delivery_fee', $data)) {
            $fee = $data['delivery_fee'];
            if ($fee !== null && (! is_string($fee) || ! preg_match('/^[0-9]{1,8}(\.[0-9]{1,2})?$/D', $fee))) {
                throw new RuntimeException('RASLO_RESPONSE_MISMATCH');
            }
            $row->delivery_fee = $fee;
        }
        $row->requires_price_approval = $data['requires_price_approval'] ?? ($data['status'] === 'priced');
    }
}
