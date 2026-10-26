<?php

namespace App\Http\Controllers\Raslo;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\RasloConnection;
use App\Models\Shop;
use App\Services\Raslo\RasloBridge;
use App\Services\Raslo\RasloClient;
use App\Services\Raslo\RasloEndpoint;
use App\Services\Raslo\RasloStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RasloSettingsController extends Controller
{
    private function shop(Request $request)
    {
        $shop = $request->user()->shop;
        abort_unless($shop && $shop->is_active, 403);

        return $shop;
    }

    public function show(Request $request)
    {
        $shop = $this->shop($request);
        $connection = RasloConnection::where('shop_id', $shop->id)->first();
        $orders = Order::where('shop_id', $shop->id)->with('rasloShipment')->latest()->paginate(20);

        return response()->view('raslo.settings', compact('shop', 'connection', 'orders'))->header('Cache-Control', 'no-store')->header('Referrer-Policy', 'no-referrer');
    }

    public function update(Request $request)
    {
        $shop = $this->shop($request);
        $old = RasloConnection::where('shop_id', $shop->id)->first();
        $validator = Validator::make($request->only('enabled', 'api_key', 'webhook_secret'), [
            'enabled' => 'required|boolean', 'api_key' => ['nullable', 'regex:/^raslo_delivery_[a-f0-9]{64}$/D'],
            'webhook_secret' => ['nullable', 'regex:/^[a-f0-9]{64}$/D'],
        ]);
        // Never flash credentials back into session or HTML on validation failure.
        if ($validator->fails()) {
            return back()->withErrors(['raslo' => 'Review the enabled setting and use a valid Delivery API key/signing secret.']);
        }
        $enabled = $request->boolean('enabled');
        if (! $enabled && $old && ! $request->filled('api_key') && ! $request->filled('webhook_secret')) {
            $old->update(['enabled' => false]);

            return back()->with('success', 'تم إيقاف إرسال الطلبات الجديدة / Forwarding disabled.');
        }
        $key = $request->input('api_key') ?: $old?->api_key;
        $secret = $request->input('webhook_secret') ?: $old?->webhook_secret;
        if (! $key) {
            return back()->withErrors(['raslo' => 'Enter the dedicated Raslo Delivery API key.']);
        }
        try {
            $response = app(RasloClient::class)->request($key, 'GET', '/delivery-connection');
            $data = $response->json('data');
            if (! $response->ok() || ! is_array($data) || ! is_int($data['id'] ?? null) || $data['id'] < 1 || ($data['currency'] ?? '') !== 'AED' || ($data['pickup_configured'] ?? false) !== true) {
                return back()->withErrors(['raslo' => 'Connection is not ready. Check paid Enterprise access, activation and pickup address in Raslo.']);
            }
        } catch (\Throwable $e) {
            return back()->withErrors(['raslo' => 'Cannot verify Raslo now. Check the server HTTPS address and retry.']);
        }
        if ($old && (int) $old->remote_id !== $data['id']) {
            return back()->withErrors(['raslo' => 'This store is bound to another Raslo connection. Rotate its existing key instead of changing its identity.']);
        }
        if (RasloConnection::where('remote_id', $data['id'])->when($old, fn ($q) => $q->whereKeyNot($old->id))->exists()) {
            return back()->withErrors(['raslo' => 'Use a separate Raslo connection for each store.']);
        }
        DB::transaction(function () use ($shop, $data, $enabled, $key, $secret) {
            Shop::whereKey($shop->id)->lockForUpdate()->firstOrFail();
            $row = RasloConnection::where('shop_id', $shop->id)->lockForUpdate()->first();
            abort_if($row && (int) $row->remote_id !== $data['id'], 409);
            RasloConnection::updateOrCreate(['shop_id' => $shop->id], [
                'public_id' => $row?->public_id ?? (string) Str::uuid(), 'remote_id' => $data['id'], 'enabled' => $enabled,
                'api_key' => $key, 'webhook_secret' => $secret, 'verified_at' => now(),
            ]);
        }, 3);

        return back()->with('success', 'تم حفظ الربط والتحقق منه / Connection verified and saved.');
    }

    public function retry(Request $request, Order $order, RasloBridge $bridge)
    {
        abort_unless((int) $order->shop_id === (int) $this->shop($request)->id, 404);
        $bridge->retry($order);

        return back()->with('success', 'تمت جدولة الإرسال بالمعلومات المحفوظة / Queued with the original delivery snapshot.');
    }

    public function deliveries(Request $request)
    {
        $orders = $request->user()->orders()->whereHas('rasloShipment')->with('rasloShipment')->latest()->paginate(20);

        return response()->view('raslo.orders', compact('orders'))->header('Cache-Control', 'no-store')->header('Referrer-Policy', 'no-referrer');
    }

    public function tracking(Request $request, Order $order)
    {
        abort_unless((int) $order->user_id === (int) $request->user()->id || (int) $order->shop?->user_id === (int) $request->user()->id, 404);

        $order->load('rasloShipment');
        if ($request->expectsJson()) {
            $shipment = $order->rasloShipment;

            return response()->json([
                'status_label' => RasloStatus::label($shipment?->delivery_status ?: $shipment?->state),
                'tracking_number' => $shipment?->tracking_number,
                'tracking_url' => app(RasloEndpoint::class)->tracking($shipment?->tracking_url),
                'updated_at' => $shipment?->updated_at?->timezone('Asia/Dubai')->format('Y-m-d H:i'),
            ])->header('Cache-Control', 'no-store')->header('Referrer-Policy', 'no-referrer');
        }

        return response()->view('raslo.tracking', ['order' => $order])->header('Cache-Control', 'no-store')->header('Referrer-Policy', 'no-referrer');
    }
}
