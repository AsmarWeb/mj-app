<?php

use App\Models\Order;
use App\Services\Checkout\PhysicalCheckoutService;
use App\Services\Checkout\StripeCheckoutGateway;
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
