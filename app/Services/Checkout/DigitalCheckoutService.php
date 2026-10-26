<?php

namespace App\Services\Checkout;

use App\Mail\PodOrderReceived;
use App\Models\DigitalProduct;
use App\Models\Download;
use App\Models\Order;
use App\Models\Shop;
use App\Models\Supplier;
use App\Models\SupplierPayout;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class DigitalCheckoutService
{
    public function start(User $buyer, DigitalProduct $product, int $quantity): array
    {
        $order = DB::transaction(function () use ($buyer, $product, $quantity) {
            $product = DigitalProduct::whereKey($product->id)->lockForUpdate()->firstOrFail();
            abort_unless($product->status === 'published' && in_array($product->type, ['digital', 'pod'], true), 422);
            abort_unless($quantity >= 1 && $quantity <= 99, 422);
            $shop = Shop::where('user_id', $product->user_id)->firstOrFail();
            // Existing digital/POD checkout is USD. Use integer minor units, never floats.
            $unit = AedAmount::fils($product->price);
            abort_unless($unit > 0 && $unit * $quantity <= 999999999, 422);
            $supplierUnit = $product->type === 'pod' ? AedAmount::fils($product->base_cost ?? '0') : 0;
            abort_unless($supplierUnit * $quantity <= 999999999, 422);
            if ($product->type === 'pod') {
                abort_unless($product->supplier && filled($product->supplier->email), 422, 'POD supplier configuration is required.');
            }
            $order = Order::create([
                'order_number' => 'MW-'.Str::upper(Str::random(12)), 'user_id' => $buyer->id, 'shop_id' => $shop->id,
                'subtotal' => AedAmount::decimal($unit * $quantity), 'total' => AedAmount::decimal($unit * $quantity),
                'checkout_token' => (string) Str::uuid(), 'checkout_currency' => 'USD', 'payment_method' => 'stripe',
                'payment_status' => 'pending', 'status' => 'pending', 'checkout_state' => 'creating',
                'checkout_payload' => ['kind' => 'digital_v1', 'product_id' => $product->id, 'type' => $product->type,
                    'supplier_id' => $product->supplier_id, 'supplier_unit' => $supplierUnit,
                    'base_product' => $product->base_product, 'supplier_currency' => 'AED'],
            ]);
            $order->items()->create(['digital_product_id' => $product->id, 'listing_name' => $product->title,
                'price' => AedAmount::decimal($unit), 'quantity' => $quantity, 'total' => $order->total]);

            return $order;
        }, 3);

        $item = $order->items()->firstOrFail();
        $session = app(DigitalCheckoutGateway::class)->create([
            'mode' => 'payment', 'client_reference_id' => $order->checkout_token, 'customer_email' => $buyer->email,
            'line_items' => [['quantity' => $item->quantity, 'price_data' => ['currency' => 'usd',
                'unit_amount' => AedAmount::fils($item->price), 'product_data' => ['name' => $item->listing_name]]]],
            'metadata' => ['checkout_kind' => 'digital_v1', 'order_id' => (string) $order->id, 'product_id' => (string) $item->digital_product_id],
            'success_url' => route('pod.checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('pod.checkout.cancel'),
        ], 'digital-'.$order->checkout_token);

        DB::transaction(function () use ($order, $session) {
            $order = Order::whereKey($order->id)->lockForUpdate()->firstOrFail();
            $this->assertIdentity($order, $session);
            $order->stripe_checkout_session_id = $session['id'];
            if ($order->payment_status === 'pending') {
                $order->checkout_state = 'open';
            }
            $order->save();
        });

        return $session;
    }

    public function accepts(array $session): bool
    {
        $kind = $session['metadata']['checkout_kind'] ?? null;

        return $kind === 'digital_v1' || ($kind === null && isset($session['metadata']['product_id'], $session['metadata']['order_id']));
    }

    public function assertIdentity(Order $order, array $session): void
    {
        $id = $session['id'] ?? null;
        $snapshot = $order->checkout_payload;
        $new = ($snapshot['kind'] ?? null) === 'digital_v1';
        abort_unless(is_string($id) && preg_match('/^cs_[A-Za-z0-9_]+$/D', $id)
            && $this->accepts($session)
            && (string) ($session['metadata']['order_id'] ?? '') === (string) $order->id
            && filled($order->checkout_token) && $order->checkout_token === ($session['client_reference_id'] ?? null)
            && $order->checkout_currency === 'USD' && ($session['currency'] ?? null) === 'usd'
            && ($session['mode'] ?? null) === 'payment'
            && ($session['amount_total'] ?? null) === AedAmount::fils($order->total)
            && (($order->stripe_checkout_session_id === $id) || ($new && $order->stripe_checkout_session_id === null)), 409);
        $items = $order->items()->get();
        abort_unless($items->count() === 1 && $items->first()->digital_product_id
            && $items->first()->listing_id === null
            && (string) $items->first()->digital_product_id === (string) ($session['metadata']['product_id'] ?? ''), 409);
        if ($new) {
            abort_unless((string) $snapshot['product_id'] === (string) $items->first()->digital_product_id, 409);
        }
    }

    public function synchronize(array $session, ?string $event = null): void
    {
        if (! $this->accepts($session)) {
            return;
        }
        $orderId = $session['metadata']['order_id'];
        DB::transaction(function () use ($session, $event, $orderId) {
            $order = Order::whereKey($orderId)->lockForUpdate()->firstOrFail();
            $this->assertIdentity($order, $session);
            if ($order->isPaid() || $order->payment_status === 'refunded') {
                return;
            }
            $order->stripe_checkout_session_id = $session['id'];
            if (($session['status'] ?? null) === 'expired' || $event === 'checkout.session.async_payment_failed') {
                $order->fill(['payment_status' => 'failed', 'status' => 'cancelled', 'checkout_state' => 'failed'])->save();

                return;
            }
            if (($session['status'] ?? null) !== 'complete' || ($session['payment_status'] ?? null) !== 'paid') {
                $order->save();

                return;
            }
            abort_unless(is_string($session['payment_intent'] ?? null) && str_starts_with($session['payment_intent'], 'pi_'), 409);
            $item = $order->items()->firstOrFail();
            // Product locks also serialize entitlement creation across separate orders for the same product.
            $product = DigitalProduct::whereKey($item->digital_product_id)->lockForUpdate()->firstOrFail();
            $snapshot = $order->checkout_payload;
            if (($snapshot['kind'] ?? null) !== 'digital_v1') {
                // Legacy sessions must already be bound by saved session ID (checked above).
                $snapshot = ['kind' => 'digital_v1', 'product_id' => $product->id, 'type' => $product->type,
                    'supplier_id' => $product->supplier_id, 'supplier_unit' => AedAmount::fils($product->base_cost ?? '0'),
                    'base_product' => $product->base_product, 'supplier_currency' => 'AED'];
            }
            abort_unless(in_array($snapshot['type'], ['digital', 'pod'], true), 409);
            if ($snapshot['type'] === 'digital') {
                $download = Download::where('user_id', $order->user_id)->where('digital_product_id', $product->id)
                    ->lockForUpdate()->first() ?? new Download(['user_id' => $order->user_id, 'digital_product_id' => $product->id]);
                $download->token = $download->token ?: Str::random(64);
                $download->fill(['paid' => true, 'paid_at' => $download->paid_at ?? now()])->save();
            } else {
                abort_unless(Supplier::whereKey($snapshot['supplier_id'])->exists(), 409, 'POD supplier needs review.');
                SupplierPayout::firstOrCreate(['order_id' => $order->id, 'order_item_id' => $item->id], [
                    'supplier_id' => $snapshot['supplier_id'], 'digital_product_id' => $product->id,
                    'amount' => AedAmount::decimal($snapshot['supplier_unit'] * $item->quantity),
                    'supplier_amount' => AedAmount::decimal($snapshot['supplier_unit'] * $item->quantity),
                    'status' => 'pending',
                ]);
                $snapshot['notification'] = 'pending';
            }
            $order->fill(['payment_status' => 'paid', 'status' => 'processing', 'paid_at' => now(),
                'stripe_payment_intent_id' => $session['payment_intent'], 'checkout_payload' => $snapshot,
                'checkout_state' => $snapshot['type'] === 'pod' ? 'paid_notice_pending' : 'paid'])->save();
        }, 3);

        // Notification failure never rolls back a verified payment or its entitlement/payout.
        $this->notifySupplier((int) $orderId);
    }

    public function notifySupplier(int $orderId): void
    {
        try {
            DB::transaction(function () use ($orderId) {
                $order = Order::with('items', 'customer')->whereKey($orderId)->lockForUpdate()->firstOrFail();
                $snapshot = $order->checkout_payload;
                if (! $order->isPaid() || ($snapshot['notification'] ?? null) !== 'pending') {
                    return;
                }
                $supplier = Supplier::findOrFail($snapshot['supplier_id']);
                abort_unless(filled($supplier->email), 409);
                $item = $order->items->first();
                $product = DigitalProduct::findOrFail($snapshot['product_id']);
                // Render from checkout terms, not a possibly changed product supplier/cost/title.
                $product->setRelation('supplier', $supplier);
                $product->title = $item->listing_name;
                $product->base_cost = AedAmount::decimal($snapshot['supplier_unit']);
                $product->base_product = $snapshot['base_product'];
                Mail::to($supplier->email)->send(new PodOrderReceived($order, $item, $product));
                $snapshot['notification'] = 'sent';
                $order->fill(['checkout_payload' => $snapshot, 'checkout_state' => 'paid'])->save();
            });
        } catch (\Throwable $error) {
            Log::warning('POD notification pending retry.', ['order_id' => $orderId, 'exception_type' => get_class($error)]);
        }
    }
}
