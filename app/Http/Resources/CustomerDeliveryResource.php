<?php

namespace App\Http\Resources;

use App\Services\Raslo\RasloEndpoint;
use App\Services\Raslo\RasloStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerDeliveryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $status = $this->delivery_status ?: $this->state;

        return ['status' => $status, 'status_label' => RasloStatus::label($status),
            'tracking_number' => $this->tracking_number,
            'tracking_url' => app(RasloEndpoint::class)->tracking($this->tracking_url),
            'updated_at' => $this->updated_at?->toISOString()];
    }
}
