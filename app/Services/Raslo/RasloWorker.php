<?php

namespace App\Services\Raslo;

use App\Jobs\SendRasloShipment;
use App\Models\RasloShipment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class RasloWorker
{
    public function due(): int
    {
        RasloShipment::where('state', 'processing')->where('processing_at', '<', now()->subMinutes(2))
            ->update(['state' => 'retry', 'queued_at' => null, 'lease' => null, 'next_attempt_at' => now(), 'error_code' => 'WORKER_INTERRUPTED']);
        $count = 0;
        RasloShipment::whereIn('state', ['pending', 'retry'])->where('next_attempt_at', '<=', now())->orderBy('id')->chunkById(100, function ($rows) use (&$count) {
            foreach ($rows as $row) {
                $claim = RasloShipment::whereKey($row->id)->whereIn('state', ['pending', 'retry'])
                    ->where(fn ($q) => $q->whereNull('queued_at')->orWhere('queued_at', '<', now()->subMinutes(2)))
                    ->update(['queued_at' => now()]);
                if (! $claim) {
                    continue;
                }
                try {
                    SendRasloShipment::dispatch($row->id);
                    $count++;
                } catch (Throwable $e) {
                    RasloShipment::whereKey($row->id)->update(['queued_at' => null, 'error_code' => 'QUEUE_UNAVAILABLE']);
                }
            }
        });

        return $count;
    }

    public function send(int $id): void
    {
        $claim = DB::transaction(function () use ($id) {
            $row = RasloShipment::with('connection', 'order')->lockForUpdate()->find($id);
            if (! $row || ! in_array($row->state, ['pending', 'retry'], true) || $row->next_attempt_at?->isFuture()) {
                return null;
            }
            if (! $row->connection->enabled || ! $row->order->isPaid() || $row->order->status !== 'processing') {
                $row->update(['state' => 'review', 'error_code' => 'FORWARDING_DISABLED', 'queued_at' => null]);

                return null;
            }
            $row->update(['state' => 'processing', 'processing_at' => now(), 'lease' => (string) Str::uuid(), 'attempts' => $row->attempts + 1]);

            return $row;
        }, 3);
        if (! $claim) {
            return;
        }
        $response = null;
        $error = null;
        try {
            $response = app(RasloClient::class)->request($claim->connection->api_key, 'POST', '/deliveries', $claim->payload, $claim->idempotency_key);
        } catch (Throwable $e) {
            $error = 'NETWORK_OR_ENDPOINT';
        }
        DB::transaction(function () use ($claim, $response, $error) {
            $row = RasloShipment::whereKey($claim->id)->lockForUpdate()->firstOrFail();
            if ($row->lease !== $claim->lease || $row->state !== 'processing') {
                return;
            }
            $status = $response?->status();
            if (in_array($status, [200, 201], true)) {
                try {
                    if (strlen($response->body()) > 65536 || ! is_array($response->json('data'))) {
                        throw new \RuntimeException;
                    }
                    app(RasloStatus::class)->apply($row, $response->json('data'), true);
                    $row->state = 'sent';
                    $row->error_code = null;
                    $row->last_polled_at = now();
                } catch (Throwable $e) {
                    $row->refresh();
                    $row->state = 'review';
                    $row->error_code = 'RESPONSE_MISMATCH';
                }
            } else {
                $retry = $status === null || $status === 429 || $status >= 500;
                $row->state = $retry && $row->attempts < 12 ? 'retry' : 'review';
                $row->error_code = $error ?? 'HTTP_'.$status;
                $row->next_attempt_at = now()->addSeconds(min(3600, 30 * (2 ** min(7, $row->attempts - 1))));
            }
            $row->lease = null;
            $row->processing_at = null;
            $row->queued_at = null;
            $row->save();
        }, 3);
    }

    public function poll(int $id): void
    {
        $row = RasloShipment::with('connection')->findOrFail($id);
        if (! $row->remote_id || ! $row->connection->enabled) {
            return;
        }
        try {
            $response = app(RasloClient::class)->request($row->connection->api_key, 'GET', '/deliveries/'.$row->remote_id);
            if (! $response->ok() || strlen($response->body()) > 65536 || ! is_array($response->json('data'))) {
                RasloShipment::whereKey($row->id)->update(['last_polled_at' => now(), 'error_code' => 'POLL_HTTP_'.$response->status()]);

                return;
            }
            DB::transaction(function () use ($row, $response) {
                $locked = RasloShipment::whereKey($row->id)->lockForUpdate()->firstOrFail();
                app(RasloStatus::class)->apply($locked, $response->json('data'), true);
                $locked->last_polled_at = now();
                $locked->error_code = null;
                $locked->save();
            }, 3);
        } catch (Throwable $e) {
            RasloShipment::whereKey($id)->update(['last_polled_at' => now(), 'error_code' => 'POLL_UNAVAILABLE']);
        }
    }
}
