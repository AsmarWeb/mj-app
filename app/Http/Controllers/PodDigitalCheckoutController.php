<?php

namespace App\Http\Controllers;

use App\Models\DigitalProduct;
use App\Models\Order;
use App\Services\Checkout\DigitalCheckoutGateway;
use App\Services\Checkout\DigitalCheckoutService;
use Illuminate\Http\Request;
use Stripe\Exception\ApiErrorException;

class PodDigitalCheckoutController extends Controller
{
    public function checkoutProduct(Request $request, string $slug)
    {
        $product = DigitalProduct::where('slug', $slug)->where('status', 'published')->firstOrFail();
        $request->merge(['product_id' => $product->id]);

        return $this->checkout($request);
    }

    public function successProduct(Request $request, string $slug)
    {
        $request->validate(['session_id' => ['required', 'string', 'max:255', 'regex:/^cs_[A-Za-z0-9_]+$/D']]);

        return redirect()->route('pod.checkout.success', ['session_id' => $request->string('session_id')->toString()]);
    }

    public function checkout(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:digital_products,id'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:99'],
        ]);
        $product = DigitalProduct::whereKey($data['product_id'])->where('status', 'published')->firstOrFail();
        try {
            $session = app(DigitalCheckoutService::class)->start($request->user(), $product, (int) ($data['quantity'] ?? 1));
        } catch (ApiErrorException $error) {
            return back()->withErrors(['payment' => 'Payment provider unavailable. Check your orders before trying another purchase.']);
        }

        return redirect()->away($session['url']);
    }

    public function success(Request $request)
    {
        $request->validate(['session_id' => ['required', 'string', 'max:255', 'regex:/^cs_[A-Za-z0-9_]+$/D']]);
        try {
            $session = app(DigitalCheckoutGateway::class)->retrieve($request->string('session_id')->toString());
        } catch (ApiErrorException $error) {
            return redirect()->route('home')->with('error', 'Payment confirmation is temporarily unavailable. Your payment will be checked by the server.');
        }
        $order = Order::findOrFail($session['metadata']['order_id'] ?? 0);
        abort_unless((int) $order->user_id === (int) $request->user()->id, 403);
        $checkout = app(DigitalCheckoutService::class);
        $checkout->assertIdentity($order, $session);
        $checkout->synchronize($session);
        $order->refresh();
        if (! $order->isPaid()) {
            return redirect()->route('home')->with('error', 'Payment has not been confirmed.');
        }

        return view('pod.checkout.success', ['order' => $order->load('items')]);
    }

    public function cancel()
    {
        return redirect()->route('home')->with('error', 'Checkout closed. Payment status is checked by the server.');
    }
}
