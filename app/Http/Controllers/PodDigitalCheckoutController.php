<?php

namespace App\Http\Controllers;

use App\Mail\PodOrderReceived;
use App\Models\DigitalProduct;
use App\Models\Download;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shop;
use App\Models\SupplierPayout;
use App\Services\Checkout\AedAmount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Stripe\Checkout\Session;
use Stripe\Stripe;

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

        $request->validate([
            'product_id' => 'required|exists:digital_products,id',
            'quantity' => 'nullable|integer|min:1|max:99',
        ]);

        $product = DigitalProduct::findOrFail(
            $request->product_id
        );

        if ($product->status !== 'published') {
            abort(404);
        }

        $quantity = max(
            1,
            (int) $request->quantity
        );

        Stripe::setApiKey(
            config('services.stripe.secret')
        );

        $shop = Shop::where('user_id', $product->user_id)->first();

        if (! $shop) {
            abort(422, 'The product owner must configure their store before accepting payment.');
        }

        $order = Order::create([

            'order_number' => 'MW-'.strtoupper(Str::random(10)),

            'user_id' => auth()->id(),

            'shop_id' => $shop->id,

            'subtotal' => $product->price * $quantity,

            'total' => $product->price * $quantity,

            'checkout_token' => (string) Str::uuid(),
            'checkout_currency' => 'USD',
            'payment_method' => 'stripe',

            'payment_status' => 'pending',

            'status' => 'pending',

        ]);

        OrderItem::create([

            'order_id' => $order->id,

            'digital_product_id' => $product->id,

            'listing_name' => $product->title,

            'price' => $product->price,

            'quantity' => $quantity,

            'total' => $product->price * $quantity,

        ]);

        $session = Session::create([

            'mode' => 'payment',
            'client_reference_id' => $order->checkout_token,

            'customer_email' => auth()->user()->email,

            'line_items' => [

                [

                    'quantity' => $quantity,

                    'price_data' => [

                        'currency' => 'usd',

                        'unit_amount' => AedAmount::fils($product->price),

                        'product_data' => [

                            'name' => $product->title,

                            'description' => Str::limit(
                                strip_tags($product->description),
                                200
                            ),

                        ],

                    ],

                ],

            ],

            'metadata' => [

                'order_id' => $order->id,

                'product_id' => $product->id,

            ],

            'success_url' => route('pod.checkout.success')
                .'?session_id={CHECKOUT_SESSION_ID}',

            'cancel_url' => route('pod.checkout.cancel'),

        ]);

        $order->update(['stripe_checkout_session_id' => $session->id]);

        return redirect($session->url);

    }

    public function success(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $request->validate(['session_id' => ['required', 'string', 'max:255', 'regex:/^cs_[A-Za-z0-9_]+$/D']]);
        $session = Session::retrieve($request->session_id);
        $boundOrder = Order::findOrFail($session->metadata->order_id);
        abort_unless((int) $boundOrder->user_id === (int) auth()->id(), 403);
        abort_unless($boundOrder->stripe_checkout_session_id === $session->id
            && $boundOrder->checkout_token === $session->client_reference_id
            && $boundOrder->checkout_currency === 'USD'
            && $session->mode === 'payment' && $session->currency === 'usd'
            && $session->amount_total === AedAmount::fils($boundOrder->total), 409);

        if ($session->payment_status !== 'paid' || $session->status !== 'complete') {
            return redirect()
                ->route('home')
                ->with('error', 'Payment not completed.');
        }

        DB::transaction(function () use ($session) {

            $order = Order::with(['items', 'customer'])->lockForUpdate()
                ->findOrFail($session->metadata->order_id);

            if ($order->payment_status === 'paid') {
                return;
            }

            abort_unless($order->items()->where('digital_product_id', $session->metadata->product_id)->exists(), 409);

            $product = DigitalProduct::with('supplier')
                ->findOrFail($session->metadata->product_id);

            $order->update([
                'payment_status' => 'paid',
                'status' => 'processing',
                'paid_at' => now(),
            ]);

            /*
            |--------------------------------------------------------------------------
            | DIGITAL PRODUCT
            |--------------------------------------------------------------------------
            */

            if ($product->type === 'digital') {

                Download::updateOrCreate(
                    [
                        'user_id' => $order->user_id,
                        'digital_product_id' => $product->id,
                    ],
                    [
                        'token' => Str::random(64),
                        'paid' => true,
                        'paid_at' => now(),
                    ]
                );

                $product->increment('downloads');
            }

            /*
            |--------------------------------------------------------------------------
            | POD PRODUCT
            |--------------------------------------------------------------------------
            */

            if ($product->type === 'pod') {

                $item = $order->items()
                    ->where('digital_product_id', $product->id)
                    ->first();

                if (! $item) {
                    throw new \Exception('Order item not found.');
                }

                $supplierAmount = ((float) ($product->base_cost ?? 0)) * $item->quantity;

                if ($product->supplier && $supplierAmount > 0) {

                    SupplierPayout::create([
                        'supplier_id' => $product->supplier->id,
                        'order_id' => $order->id,
                        'amount' => $supplierAmount,
                        'status' => 'pending',
                    ]);

                    Mail::to($product->supplier->email)
                        ->send(new PodOrderReceived(
                            $order,
                            $item,
                            $product
                        ));
                }
            }
        });

        $order = Order::with('items')
            ->findOrFail($session->metadata->order_id);

        return view('pod.checkout.success', compact('order'));
    }

    public function cancel()
    {

        return redirect()
            ->back()
            ->with(
                'error',
                'Payment cancelled'
            );

    }
}
