<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerDeliveryResource;
use App\Http\Resources\CustomerOrderResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerOrderController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate(['per_page' => ['sometimes', 'integer', 'min:1', 'max:50'],
            'page' => ['sometimes', 'integer', 'min:1', 'max:10000'],
            'status' => ['sometimes', Rule::in(['pending', 'processing', 'shipped', 'delivered', 'cancelled'])],
            'payment_status' => ['sometimes', Rule::in(['pending', 'paid', 'failed', 'refunded'])]]);
        $query = $this->orders($request);
        foreach (['status', 'payment_status'] as $key) {
            if (isset($data[$key])) {
                $query->where($key, $data[$key]);
            }
        }

        return CustomerOrderResource::collection($query->orderByDesc('id')->paginate($data['per_page'] ?? 20)
            ->appends(array_intersect_key($data, array_flip(['per_page', 'status', 'payment_status']))));
    }

    public function show(Request $request, string $order)
    {
        return (new CustomerOrderResource($this->orders($request)->with('items')->whereKey($order)->firstOrFail()))->withDetails();
    }

    public function delivery(Request $request, string $order)
    {
        $row = $request->user()->orders()->with('rasloShipment')->whereKey($order)->firstOrFail();

        return response()->json(['data' => $row->rasloShipment ? (new CustomerDeliveryResource($row->rasloShipment))->resolve($request) : null])
            ->header('Referrer-Policy', 'no-referrer');
    }

    private function orders(Request $request)
    {
        return $request->user()->orders()->with(['shop' => fn ($q) => $q->publicCatalog(), 'rasloShipment']);
    }
}
