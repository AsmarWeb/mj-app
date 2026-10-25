<?php

use App\Jobs\PollRasloShipment;
use App\Models\Order;
use App\Models\RasloShipment;
use App\Services\Checkout\PhysicalCheckoutService;
use App\Services\Checkout\StripeCheckoutGateway;
use App\Services\Raslo\RasloWorker;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Retrieve Stripe's authoritative state; never release stock on a local timeout alone.
Artisan::command('checkout:reconcile {--session= : Recover a verified physical checkout session}', function () {
    if ($id = $this->option('session')) {
        $session = app(StripeCheckoutGateway::class)->retrieve($id);
        if (($session['metadata']['checkout_kind'] ?? null) !== 'physical_v1') {
            $this->error('Not a physical checkout session.');

            return 1;
        }
        app(PhysicalCheckoutService::class)->synchronize($session);
        $this->info('Session reconciled.');

        return 0;
    }
    $failed = 0;
    Order::whereNotNull('checkout_token')->where('checkout_currency', 'AED')->where('payment_status', 'pending')
        ->orderBy('id')->chunkById(100, function ($orders) use (&$failed) {
            foreach ($orders as $order) {
                if (! $order->stripe_checkout_session_id) {
                    $this->warn("Order {$order->id}: no saved session; retry the original checkout or reconcile in Stripe using client_reference_id. Stock remains held.");
                    $failed++;

                    continue;
                }
                try {
                    $session = app(StripeCheckoutGateway::class)->retrieve($order->stripe_checkout_session_id);
                    app(PhysicalCheckoutService::class)->synchronize($session);
                    $this->info("Order {$order->id}: reconciled.");
                } catch (Throwable $error) {
                    $failed++;
                    $this->error("Order {$order->id}: reconciliation failed; inspect Stripe before retrying.");
                }
            }
        });

    return $failed ? 1 : 0;
});
Schedule::command('checkout:reconcile')->everyFiveMinutes()->withoutOverlapping();

Artisan::command('raslo:send-due', function () {
    $this->info('Queued: '.app(RasloWorker::class)->due());
});
Artisan::command('raslo:poll', function () {
    RasloShipment::whereNotNull('remote_id')->where('state', 'sent')
        ->where(fn ($q) => $q->whereNull('last_polled_at')->orWhere('last_polled_at', '<=', now()->subMinutes(5)))
        ->orderBy('id')->chunkById(100, function ($rows) {
            foreach ($rows as $row) {
                if (! $row->connection->enabled) {
                    continue;
                }
                if (! RasloShipment::whereKey($row->id)->where(fn ($q) => $q->whereNull('last_polled_at')->orWhere('last_polled_at', '<=', now()->subMinutes(5)))->update(['last_polled_at' => now()])) {
                    continue;
                }
                try {
                    PollRasloShipment::dispatch($row->id);
                } catch (Throwable $e) {
                    RasloShipment::whereKey($row->id)->update(['last_polled_at' => null, 'error_code' => 'QUEUE_UNAVAILABLE']);
                }
            }
        });
    $this->info('Polling finished.');
});
Schedule::command('raslo:send-due')->everyMinute()->withoutOverlapping();
Schedule::command('raslo:poll')->everyFiveMinutes()->withoutOverlapping();
