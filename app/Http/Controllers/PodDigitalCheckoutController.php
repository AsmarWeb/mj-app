<?php

namespace App\Http\Controllers;

use App\Models\DigitalProduct;
use App\Models\Download;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shop;
use App\Models\SupplierPayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PodOrderReceived;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Stripe\Checkout\Session;
use Stripe\Stripe;


class PodDigitalCheckoutController extends Controller
{

    public function checkout(Request $request)
    {

        $request->validate([
            'product_id'=>'required|exists:digital_products,id',
            'quantity'=>'nullable|integer|min:1'
        ]);


        $product = DigitalProduct::findOrFail(
            $request->product_id
        );


        if($product->status !== 'published'){
            abort(404);
        }


        $quantity = max(
            1,
            (int)$request->quantity
        );


        Stripe::setApiKey(
            config('services.stripe.secret')
        );


        $shop = Shop::first();


        if(!$shop){
            abort(500,'Marketplace shop missing');
        }



        $order = Order::create([

            'order_number'=>
                'MW-'.strtoupper(Str::random(10)),

            'user_id'=>
                auth()->id(),

            'shop_id'=>
                $shop->id,


            'subtotal'=>
                $product->price * $quantity,


            'total'=>
                $product->price * $quantity,


            'payment_method'=>
                'stripe',


            'payment_status'=>
                'pending',


            'status'=>
                'pending',

        ]);




        OrderItem::create([

            'order_id'=>
                $order->id,


            'digital_product_id'=>
                $product->id,


            'listing_name'=>
                $product->title,


            'price'=>
                $product->price,


            'quantity'=>
                $quantity,


            'total'=>
                $product->price * $quantity,

        ]);





        $session = Session::create([


            'mode'=>'payment',


            'customer_email'=>
                auth()->user()->email,



            'line_items'=>[

                [

                    'quantity'=>$quantity,


                    'price_data'=>[

                        'currency'=>'usd',


                        'unit_amount'=>
                            intval($product->price * 100),


                        'product_data'=>[

                            'name'=>
                                $product->title,


                            'description'=>
                                Str::limit(
                                    strip_tags($product->description),
                                    200
                                ),

                        ],

                    ],

                ]

            ],



            'metadata'=>[

                'order_id'=>
                    $order->id,


                'product_id'=>
                    $product->id,

            ],



            'success_url'=>
                route('pod.checkout.success')
                .'?session_id={CHECKOUT_SESSION_ID}',


            'cancel_url'=>
                route('pod.checkout.cancel'),

        ]);



        return redirect($session->url);

    }







    public function success(Request $request)
{
    Stripe::setApiKey(config('services.stripe.secret'));

    $session = Session::retrieve($request->session_id);

    if ($session->payment_status !== 'paid') {
        return redirect()
            ->route('home')
            ->with('error', 'Payment not completed.');
    }

    DB::transaction(function () use ($session) {

        $order = Order::with(['items', 'customer'])
            ->findOrFail($session->metadata->order_id);

        if ($order->payment_status === 'paid') {
            return;
        }

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

            Download::firstOrCreate(
                [
                    'user_id' => auth()->id(),
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
                    'order_id'    => $order->id,
                    'amount'      => $supplierAmount,
                    'status'      => 'pending',
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