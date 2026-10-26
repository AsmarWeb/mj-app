<?php

namespace App\Services\Checkout;

use App\Models\Invoice;
use App\Models\Listing;
use App\Models\Order;
use App\Models\Shop;
use App\Models\User;
use App\Services\Raslo\RasloBridge;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Ramsey\Uuid\Uuid;
use RuntimeException;

class PhysicalCheckoutService
{
    public function __construct(private StripeCheckoutGateway $gateway) {}

    public function start(User $user, int $shopId, array $address, ?string $mobileKey = null): array
    {
        $mobileToken = $mobileKey === null ? null : Uuid::uuid5(Uuid::NAMESPACE_URL, 'murwaj:mobile:'.$user->id.':'.$mobileKey)->toString();
        $requestAddress = $address;
        ksort($requestAddress);
        $requestHash = hash('sha256', json_encode([$shopId, $requestAddress], JSON_THROW_ON_ERROR));
        if ($mobileToken && ($existing = $user->orders()->where('checkout_token', $mobileToken)->first())) {
            $this->assertMobileRequest($existing, $requestHash);

            return $this->mobileResult($existing);
        }
        $shop = Shop::when($mobileToken !== null, fn ($q) => $q->publicCatalog())->findOrFail($shopId);
        if (! $shop->is_active || $shop->currency !== 'AED' || ! $shop->stripe_account_id) {
            throw ValidationException::withMessages(['shop_id' => 'Choose an active AED store with Stripe connected.']);
        }
        if (! $this->gateway->accountReady($shop->stripe_account_id)) {
            throw ValidationException::withMessages(['shop_id' => 'This store must complete Stripe onboarding.']);
        }
        $order = DB::transaction(function () use ($user, $shop, $address, $mobileToken, $requestHash) {
            User::whereKey($user->id)->lockForUpdate()->firstOrFail();
            if ($mobileToken && ($existing = $user->orders()->where('checkout_token', $mobileToken)->lockForUpdate()->first())) {
                $this->assertMobileRequest($existing, $requestHash);

                return $existing;
            }
            // Serialize quota reservations across different buyers of this store.
            $shop = Shop::when($mobileToken !== null, fn ($q) => $q->publicCatalog())->whereKey($shop->id)->lockForUpdate()->firstOrFail();
            $cart = $user->cart()->lockForUpdate()->first();
            $items = $cart?->items()->where('shop_id', $shop->id)->orderBy('listing_id')->lockForUpdate()->get();
            if (! $items || $items->isEmpty()) {
                throw ValidationException::withMessages(['cart' => 'No items from this store remain in your basket.']);
            }
            if ($items->count() > 100) {
                throw ValidationException::withMessages(['cart' => 'A checkout can contain up to 100 product lines.']);
            }
            $snapshots = [];
            $total = 0;
            foreach ($items as $item) {
                $listing = Listing::when($mobileToken !== null, fn ($q) => $q->active())->whereKey($item->listing_id)->lockForUpdate()->first();
                if (! $listing || (int) $listing->shop_id !== $shop->id || ! $listing->active || $listing->status !== 'published'
                    || ($listing->expires_at && $listing->expires_at->isPast()) || ($listing->published_at && $listing->published_at->isFuture())
                    || $item->quantity < 1 || $item->quantity > 99) {
                    throw ValidationException::withMessages(['cart' => 'A basket item is no longer available.']);
                }
                $fils = AedAmount::fils($listing->getRawOriginal('price'));
                if ($fils < 1) {
                    throw ValidationException::withMessages(['cart' => 'Checkout requires a positive product price.']);
                }
                $snapshots[] = ['item' => $item, 'listing' => $listing, 'fils' => $fils];
                $total += $fils * $item->quantity;
            }
            // Freeze fulfillment with the order; later product edits cannot reroute a paid order.
            $rasloCount = count(array_filter($snapshots, fn ($row) => $row['listing']->shipping_method === ShippingMethod::RASLO));
            if ($rasloCount && $rasloCount !== count($snapshots)) {
                throw ValidationException::withMessages(['cart' => app()->getLocale() === 'ar'
                    ? 'لا يمكن جمع منتجات رسلو وطرق الشحن الأخرى في طلب واحد. افصلها في السلة.'
                    : 'Raslo and other shipping methods cannot share one checkout. Separate these items in your basket.']);
            }
            if ($rasloCount && ! ShippingMethod::ready($shop)) {
                throw ValidationException::withMessages(['cart' => app()->getLocale() === 'ar'
                    ? 'توصيل رسلو غير متاح لهذا المتجر حاليًا. تواصل مع المتجر قبل الدفع.'
                    : 'Raslo delivery is unavailable for this store. Contact the store before paying.']);
            }
            $address['shipping_method'] = $rasloCount ? ShippingMethod::RASLO : 'Merchant';
            if ($total > 99999999) {
                throw ValidationException::withMessages(['cart' => 'Order total exceeds the checkout limit.']);
            }
            $fingerprint = hash('sha256', json_encode([$user->id, $shop->id, $address,
                array_map(fn ($row) => [$row['item']->id, $row['item']->quantity, $row['listing']->id, $row['fils']], $snapshots),
            ], JSON_THROW_ON_ERROR));
            if ($mobileToken) {
                $fingerprint = hash('sha256', $fingerprint.'|mobile|'.$mobileToken);
            }
            if ($existing = Order::where('checkout_key', $fingerprint)->lockForUpdate()->first()) {
                return $existing;
            }
            if (Order::where('user_id', $user->id)->where('shop_id', $shop->id)->where('inventory_reserved', true)->lockForUpdate()->exists()) {
                throw ValidationException::withMessages(['cart' => 'Resume or cancel the existing checkout for this store before creating another.']);
            }
            if (! $shop->canReceiveOrder()) {
                throw ValidationException::withMessages(['cart' => app()->getLocale() === 'ar'
                    ? 'وصل المتجر إلى حد الطلبات في خطته أو لا توجد عضوية سارية. تواصل مع المتجر.'
                    : 'This store has reached its plan order limit or has no valid membership. Contact the store.']);
            }
            $order = Order::create([
                'order_number' => 'MW-'.Str::upper(Str::random(12)), 'user_id' => $user->id, 'shop_id' => $shop->id,
                'subtotal' => AedAmount::decimal($total), 'total' => AedAmount::decimal($total),
                'payment_method' => 'stripe', 'payment_status' => 'pending', 'status' => 'pending',
                'checkout_token' => $mobileToken ?? (string) Str::uuid(), 'checkout_key' => $fingerprint,
                'checkout_state' => 'creating', 'checkout_expires_at' => now()->addHour(),
                'inventory_reserved' => true, 'shipping_address' => $address, 'checkout_currency' => 'AED',
            ]);
            $lineItems = [];
            foreach ($snapshots as $row) {
                $listing = $row['listing'];
                $item = $row['item'];
                if ($listing->quantity < $item->quantity) {
                    throw ValidationException::withMessages(['cart' => "Insufficient stock: {$listing->title}"]);
                }
                $listing->decrement('quantity', $item->quantity);
                $order->items()->create([
                    'listing_id' => $listing->id, 'source_cart_item_id' => $item->id, 'listing_name' => $listing->title,
                    'price' => AedAmount::decimal($row['fils']), 'quantity' => $item->quantity,
                    'total' => AedAmount::decimal($row['fils'] * $item->quantity),
                ]);
                $lineItems[] = ['price_data' => ['currency' => 'aed', 'unit_amount' => $row['fils'], 'product_data' => ['name' => $listing->title]], 'quantity' => $item->quantity];
            }
            $rate = (float) config('revenue.commission', 0);
            if ($rate < 0 || $rate > 100) {
                throw new RuntimeException('Invalid platform commission configuration.');
            }
            $order->update(['checkout_payload' => [
                'mode' => 'payment', 'payment_method_types' => ['card'], 'customer_email' => $user->email,
                'client_reference_id' => $order->checkout_token, 'line_items' => $lineItems,
                'payment_intent_data' => ['application_fee_amount' => (int) round($total * $rate / 100), 'transfer_data' => ['destination' => $shop->stripe_account_id]],
                'metadata' => ['checkout_kind' => 'physical_v1', 'order_id' => (string) $order->id, 'user_id' => (string) $user->id]
                    + ($mobileToken ? ['client_channel' => 'mobile_v1', 'mobile_request_hash' => $requestHash] : []),
                'expires_at' => $order->checkout_expires_at->timestamp,
                'success_url' => $mobileToken
                    ? URL::temporarySignedRoute('mobile.checkout.return', now()->addHours(2), ['order' => $order->id, 'outcome' => 'returned'])
                    : route('checkout.success', $order->id).'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => $mobileToken
                    ? URL::temporarySignedRoute('mobile.checkout.return', now()->addHours(2), ['order' => $order->id, 'outcome' => 'closed'])
                    : route('checkout', ['shop_id' => $shop->id]),
            ]]);

            app(RasloBridge::class)->capture($order);

            return $order;
        }, 3);

        return $mobileToken ? $this->mobileResult($order) : $this->resume($order);
    }

    private function assertMobileRequest(Order $order, string $hash): void
    {
        abort_unless(($order->checkout_payload['metadata']['client_channel'] ?? null) === 'mobile_v1'
            && hash_equals((string) ($order->checkout_payload['metadata']['mobile_request_hash'] ?? ''), $hash), 409, 'Idempotency key already belongs to a different checkout request.');
    }

    private function mobileResult(Order $order): array
    {
        if (in_array($order->payment_status, ['paid', 'refunded'], true) || $order->checkout_state === 'expired') {
            return ['order' => $order->fresh(), 'url' => null];
        }

        return $this->resume($order);
    }

    public function resume(Order $order): array
    {
        if (in_array($order->payment_status, ['paid', 'refunded'], true) || $order->checkout_state === 'expired') {
            throw ValidationException::withMessages(['cart' => 'This checkout is closed. Refresh your basket.']);
        }
        // A lost response reuses the persisted payload and Stripe idempotency key.
        // Never silently replace an uncertain attempt with a second payment.
        if (! $order->stripe_checkout_session_id && $order->checkout_expires_at->isPast()) {
            throw ValidationException::withMessages(['cart' => 'This payment attempt needs support reconciliation. Do not submit another payment.']);
        }
        $session = $order->stripe_checkout_session_id
            ? $this->gateway->retrieve($order->stripe_checkout_session_id)
            : $this->gateway->create($order->checkout_payload, 'mj-physical-'.$order->checkout_token);
        $this->acceptSession($order, $session);
        $this->synchronize($session);
        if (($session['status'] ?? null) !== 'open' || empty($session['url'])) {
            throw ValidationException::withMessages(['cart' => 'Checkout is no longer open. Refresh your basket to see its current status.']);
        }
        if (! str_starts_with($session['url'], 'https://checkout.stripe.com/')) {
            throw new CheckoutIdentityException('Unexpected payment destination.');
        }

        return ['order' => $order->fresh(), 'url' => $session['url']];
    }

    public function cancel(Order $order): void
    {
        if (! $order->stripe_checkout_session_id) {
            // Recover a potentially lost create response using the same payload and key.
            $this->resume($order);
            $order->refresh();
        }
        $session = $this->gateway->retrieve($order->stripe_checkout_session_id);
        $this->assertIdentity($order, $session);
        if (($session['status'] ?? null) === 'open') {
            $session = $this->gateway->expire($order->stripe_checkout_session_id);
        }
        $this->synchronize($session);
    }

    public function assertIdentity(Order $order, array $session): void
    {
        if (! str_starts_with((string) ($session['id'] ?? ''), 'cs_')
            || ($session['mode'] ?? null) !== 'payment'
            || ($session['metadata']['checkout_kind'] ?? null) !== 'physical_v1'
            || (string) ($session['metadata']['order_id'] ?? '') !== (string) $order->id
            || (string) ($session['metadata']['user_id'] ?? '') !== (string) $order->user_id
            || ($session['client_reference_id'] ?? null) !== $order->checkout_token
            || strtolower((string) ($session['currency'] ?? '')) !== 'aed'
            || ($session['amount_total'] ?? null) !== AedAmount::fils($order->total)
            || ($order->stripe_checkout_session_id && $order->stripe_checkout_session_id !== ($session['id'] ?? null))) {
            throw new CheckoutIdentityException('Checkout identity, currency or total mismatch.');
        }
    }

    private function acceptSession(Order $order, array $session): void
    {
        DB::transaction(function () use ($order, $session) {
            $locked = Order::whereKey($order->id)->lockForUpdate()->firstOrFail();
            $this->assertIdentity($locked, $session);
            $locked->update(['stripe_checkout_session_id' => $session['id']]);
        }, 3);
    }

    public function synchronize(array $session): void
    {
        if (($session['metadata']['checkout_kind'] ?? null) !== 'physical_v1') {
            return;
        }
        DB::transaction(function () use ($session) {
            $order = Order::whereKey($session['metadata']['order_id'] ?? 0)->lockForUpdate()->firstOrFail();
            $this->assertIdentity($order, $session);
            if (in_array($order->payment_status, ['paid', 'refunded'], true)) {
                return;
            }
            $order->stripe_checkout_session_id = $session['id'];
            if (($session['status'] ?? null) === 'expired') {
                if ($order->inventory_reserved) {
                    foreach ($order->items()->orderBy('listing_id')->get() as $item) {
                        Listing::withTrashed()->whereKey($item->listing_id)->increment('quantity', $item->quantity);
                    }
                }
                $order->fill(['checkout_state' => 'expired', 'checkout_key' => null, 'inventory_reserved' => false,
                    'payment_status' => 'failed', 'status' => 'cancelled'])->save();
                app(RasloBridge::class)->expired($order);

                return;
            }
            if (($session['status'] ?? null) !== 'complete' || ($session['payment_status'] ?? null) !== 'paid') {
                if (($session['status'] ?? null) === 'open' && $order->checkout_state !== 'expired') {
                    $order->checkout_state = 'open';
                }
                $order->save();

                return;
            }
            if (! $order->inventory_reserved || $order->checkout_state === 'expired' || empty($session['payment_intent'])) {
                throw new CheckoutIdentityException('Paid checkout requires inventory reconciliation.');
            }
            $order->fill(['payment_status' => 'paid', 'status' => 'processing', 'paid_at' => now(),
                'checkout_state' => 'paid', 'checkout_key' => null, 'stripe_payment_intent_id' => $session['payment_intent'],
                'inventory_reserved' => false])->save();
            $customer = $order->customer;
            $invoice = Invoice::create([
                'shop_id' => $order->shop_id, 'order_id' => $order->id, 'invoice_number' => 'INV-'.Str::upper(Str::random(12)),
                'customer_name' => $customer->name, 'customer_email' => $customer->email,
                'customer_phone' => $order->shipping_address['recipient_phone'],
                'subtotal' => $order->subtotal, 'tax' => $order->tax, 'total' => $order->total, 'status' => 'paid',
            ]);
            $cart = $customer->cart()->lockForUpdate()->first();
            foreach ($order->items as $item) {
                $invoice->items()->create(['listing_id' => $item->listing_id, 'title' => $item->listing_name,
                    'quantity' => $item->quantity, 'price' => $item->price, 'total' => $item->total]);
                $row = $cart?->items()->whereKey($item->source_cart_item_id)->lockForUpdate()->first();
                if ($row && (int) $row->listing_id === (int) $item->listing_id) {
                    if ($row->quantity <= $item->quantity) {
                        $row->delete();
                    } else {
                        $row->decrement('quantity', $item->quantity);
                    }
                }
            }
            app(RasloBridge::class)->paid($order);
        }, 3);
    }
}
