<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCheckoutRequest;
use App\Models\Order;
use App\Services\Checkout\PhysicalCheckoutService;
use App\Services\Checkout\StripeCheckoutGateway;
use Illuminate\Http\Request;
use Stripe\Exception\ApiErrorException;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = $request->user()->cart()->with('items.listing.shop')->first();
        $shops = $cart?->items->filter(fn ($item) => $item->listing && $item->listing->shop)->groupBy('shop_id') ?? collect();
        if ($shops->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout.address', ['shops' => $shops, 'selectedShop' => $request->integer('shop_id'),
            'pendingOrders' => $request->user()->orders()->where('inventory_reserved', true)->get()]);
    }

    public function store(StoreCheckoutRequest $request, PhysicalCheckoutService $checkout)
    {
        $data = $request->validated();
        $address = array_diff_key($data, ['shop_id' => true]);
        $address['country'] = 'AE';
        try {
            $result = $checkout->start($request->user(), (int) $data['shop_id'], $address);
        } catch (ApiErrorException $error) {
            // No provider payload or recipient details are logged or exposed.
            return back()->withInput()->withErrors(['cart' => 'Payment provider unavailable. Retry the same checkout; do not start another payment.']);
        }

        return redirect()->away($result['url']);
    }

    public function resume(Order $order, Request $request, PhysicalCheckoutService $checkout)
    {
        $this->authorizeCheckout($order, $request);
        try {
            $result = $checkout->resume($order);
        } catch (ApiErrorException $error) {
            return back()->withErrors(['cart' => 'Payment provider unavailable. Retry this checkout later.']);
        }

        return redirect()->away($result['url']);
    }

    public function cancel(Order $order, Request $request, PhysicalCheckoutService $checkout)
    {
        $this->authorizeCheckout($order, $request);
        try {
            $checkout->cancel($order);
        } catch (ApiErrorException $error) {
            return back()->withErrors(['cart' => 'Could not confirm cancellation. Stock remains held until Stripe confirms expiry.']);
        }

        return redirect()->route('checkout')->with('success', 'Checkout status refreshed. Paid orders remain valid; expired checkouts release their stock.');
    }

    private function authorizeCheckout(Order $order, Request $request): void
    {
        abort_unless((int) $order->user_id === (int) $request->user()->id, 403);
        abort_unless($order->checkout_token && $order->checkout_currency === 'AED' && $order->checkout_payload, 404);
    }

    public function success(Order $order, Request $request, PhysicalCheckoutService $checkout, StripeCheckoutGateway $gateway)
    {
        abort_unless((int) $order->user_id === (int) $request->user()->id, 403);
        $request->validate(['session_id' => ['required', 'string', 'max:255', 'regex:/^cs_[A-Za-z0-9_]+$/D']]);
        $session = $gateway->retrieve($request->string('session_id')->toString());
        $checkout->assertIdentity($order, $session);
        $checkout->synchronize($session);
        $order->refresh();
        if (! $order->isPaid()) {
            return redirect()->route('cart.index')->with('error', 'Payment has not been confirmed.');
        }

        return view('checkout.success', ['orders' => collect([$order->load('shop', 'items')])]);
    }
}
