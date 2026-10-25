<?php

use App\Jobs\PollRasloShipment;
use App\Models\DigitalProduct;
use App\Models\Order;
use App\Models\RasloShipment;
use App\Services\Checkout\PhysicalCheckoutService;
use App\Services\Checkout\StripeCheckoutGateway;
use App\Services\Digital\DigitalFiles;
use App\Services\Raslo\RasloEndpoint;
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

// Local diagnostics only: no credential output, payments or delivery requests.
Artisan::command('raslo:check', function () {
    $checks = [];
    try {
        app(RasloEndpoint::class)->base();
        $checks['Raslo HTTPS API address'] = true;
    } catch (Throwable $error) {
        $checks['Raslo HTTPS API address'] = false;
    }
    $connection = config('queue.default');
    $checks['Durable queue (database or Redis)'] = in_array($connection, ['database', 'redis'], true);
    $checks['Queue lease exceeds job timeout'] = (int) config('queue.connections.'.$connection.'.retry_after', 0) > 60;
    foreach ($checks as $name => $ok) {
        $this->line(($ok ? 'OK: ' : 'CHECK: ').$name);
    }
    $this->line('Local configuration only. Confirm that queue workers, scheduler and Stripe webhook are running.');

    return in_array(false, $checks, true) ? 1 : 0;
})->purpose('Check local Raslo automation configuration without sending requests');

Artisan::command('digital:secure-files {--apply : Move referenced downloads to private storage after hash verification}', function () {
    $failed = 0;
    DigitalProduct::whereNotNull('file')->where('type', 'digital')->orderBy('id')->chunkById(50, function ($products) use (&$failed) {
        foreach ($products as $product) {
            if (! $this->option('apply')) {
                $this->line('Review product '.$product->id.': use --apply to secure its referenced file.');

                continue;
            }
            try {
                app(DigitalFiles::class)->secure($product);
                $this->info('Secured product '.$product->id);
            } catch (Throwable $error) {
                $failed++;
                $this->error('Product '.$product->id.': migration failed; inspect storage permissions, missing files or conflicting copies.');
            }
        }
    });

    return $failed ? 1 : 0;
})->purpose('Privatize existing digital downloads; dry run unless --apply is supplied');
