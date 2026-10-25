<?php

namespace App\Http\Controllers\Raslo;

use App\Http\Controllers\Controller;
use App\Models\RasloConnection;
use App\Models\RasloShipment;
use App\Services\Raslo\RasloStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RasloWebhookController extends Controller
{
    public function __invoke(Request $request, string $connection)
    {
        abort_if(strlen($request->getContent()) > 65536, 413);
        $row = RasloConnection::where('public_id', $connection)->firstOrFail();
        $stamp = $request->header('X-Raslo-Timestamp', '');
        $signature = $request->header('X-Raslo-Signature', '');
        abort_unless($row->webhook_secret && preg_match('/^[0-9]{10}$/D', $stamp) && abs(time() - (int) $stamp) <= 300, 401);
        $expected = 'v1='.hash_hmac('sha256', $stamp.'.'.$request->getContent(), $row->webhook_secret);
        abort_unless(hash_equals($expected, $signature), 401);
        $body = json_decode($request->getContent(), true);
        abort_unless(is_array($body) && ($body['type'] ?? null) === 'delivery.status_changed'
            && is_string($body['data']['external_order_id'] ?? null) && is_string($body['id'] ?? null) && $body['id'] === $request->header('X-Raslo-Event-Id') && is_array($body['data'] ?? null), 422);
        DB::transaction(function () use ($row, $body) {
            $shipment = RasloShipment::where('raslo_connection_id', $row->id)->where('external_order_id', $body['data']['external_order_id'] ?? '')->lockForUpdate()->first();
            abort_unless($shipment, 409);
            abort_unless($shipment->remote_id, 503, 'Delivery is not bound yet; retry.');
            try {
                app(RasloStatus::class)->apply($shipment, $body['data']);
            } catch (\RuntimeException $e) {
                abort(409, 'Delivery identity mismatch.');
            }
            $shipment->save();
        }, 3);

        return response()->json(['received' => true])->header('Cache-Control','no-store');
    }
}
