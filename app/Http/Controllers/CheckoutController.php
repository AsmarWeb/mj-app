<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Account;

class CheckoutController extends Controller
{


public function checkout()
{
    $user = auth()->user();

    $cart = $user->cart;


    if (!$cart || $cart->items->isEmpty()) {

        return redirect()
            ->route('cart.index')
            ->with('error','Your cart is empty');

    }


    Stripe::setApiKey(config('cashier.secret'));


    $shopItems = $cart->items->groupBy('shop_id');


    $orderIds = [];



    foreach($shopItems as $shopId => $items)
    {


        $shop = Shop::findOrFail($shopId);



        if(!$shop->stripe_account_id){

            return back()->with(
                'error',
                "{$shop->name} has not connected Stripe."
            );

        }



        $account = Account::retrieve(
            $shop->stripe_account_id
        );



        if(
            !$account->charges_enabled ||
            !$account->payouts_enabled
        ){

            return back()->with(
                'error',
                "{$shop->name} must complete Stripe onboarding."
            );

        }



        $lineItems=[];

        $subtotal=0;



        foreach($items as $item)
        {


            $subtotal += 
                $item->price * $item->quantity;



            $lineItems[]=[

                'price_data'=>[

                    'currency'=>'aed',

                    'product_data'=>[
                        'name'=>$item->listing->title
                    ],


                    'unit_amount'=>
                    intval($item->price * 100)

                ],


                'quantity'=>$item->quantity

            ];


        }




        /*
        |--------------------------------------------------------------------------
        | Create Order
        |--------------------------------------------------------------------------
        */


        $order = Order::create([

            'order_number'=>
                'MW-'.strtoupper(Str::random(10)),

            'user_id'=>$user->id,

            'shop_id'=>$shop->id,

            'subtotal'=>$subtotal,

            'total'=>$subtotal,

            'payment_method'=>'stripe',

            'payment_status'=>'pending',

        ]);



        $orderIds[]=$order->id;




        foreach($items as $item)
        {


            OrderItem::create([

                'order_id'=>$order->id,

                'listing_id'=>$item->listing_id,

                'listing_name'=>$item->listing->title,

                'price'=>$item->price,

                'quantity'=>$item->quantity,

                'total'=>
                $item->price*$item->quantity

            ]);


        }




        /*
        |--------------------------------------------------------------------------
        | Stripe Checkout
        |--------------------------------------------------------------------------
        */


        $commission =
            $subtotal *
            config('revenue.commission')
            /100;



        $session = Session::create([


            'payment_method_types'=>[
                'card'
            ],



            'line_items'=>$lineItems,


            'mode'=>'payment',



            'payment_intent_data'=>[


                'application_fee_amount'=>
                    intval($commission*100),



                'transfer_data'=>[

                    'destination'=>
                    $shop->stripe_account_id

                ]

            ],



            'metadata'=>[

                'order_ids'=>
                    implode(',',$orderIds)

            ],



            'success_url'=>

                route(
                    'checkout.success',
                    $order->id
                )
                .'?session_id={CHECKOUT_SESSION_ID}',



            'cancel_url'=>
                route('cart.index')


        ]);



        return redirect($session->url);


    }

}






public function success(Order $order, Request $request)
{

    Stripe::setApiKey(config('cashier.secret'));



    $session = Session::retrieve(
        $request->session_id
    );



    $orderIds = explode(
        ',',
        $session->metadata->order_ids
    );



    $orders = Order::with([
        'shop',
        'items'
    ])
    ->whereIn('id',$orderIds)
    ->get();





    foreach($orders as $order)
    {


        if($order->payment_status === 'paid'){
            continue;
        }



        $order->update([

            'payment_status'=>'paid',

            'status'=>'processing',

            'paid_at'=>now(),

        ]);





        /*
        |--------------------------------------------------------------------------
        | Create Invoice
        |--------------------------------------------------------------------------
        */


        $invoice = Invoice::create([

    'shop_id'=>$order->shop_id,

    'order_id'=>$order->id,


    'invoice_number'=>
        'INV-'.strtoupper(Str::random(8)),


    'customer_name'=>
        $order->user->name,


    'customer_email'=>
        $order->user->email,


    'customer_phone'=>
        $order->user->phone ?? null,


    'subtotal'=>$order->subtotal,


    'tax'=>0,


    'total'=>$order->total,


    'status'=>'paid'

]);





foreach($order->items as $item)
{

    InvoiceItem::create([

        'invoice_id'=>$invoice->id,

        'title'=>$item->listing_name,

        'quantity'=>$item->quantity,

        'price'=>$item->price,

        'total'=>$item->total

    ]);

}



    }





    auth()->user()
        ->cart
        ->items()
        ->delete();




    return view(
        'checkout.success',
        compact('orders')
    );


}

}