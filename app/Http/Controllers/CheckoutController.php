<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
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


    $orders = [];


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



        $subtotal = 0;



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



        $orders[]=$order;



        foreach($items as $item)
        {

            OrderItem::create([

                'order_id'=>$order->id,

                'listing_id'=>$item->listing_id,

                'listing_name'=>$item->listing->title,

                'price'=>$item->price,

                'quantity'=>$item->quantity,

                'total'=>$item->price*$item->quantity

            ]);

        }



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


                // Your commission
                'application_fee_amount'=>
                    intval($commission*100),



                // Seller receives balance
                'transfer_data'=>[

                    'destination'=>
                        $shop->stripe_account_id

                ]

            ],



            'metadata'=>[

                'order_id'=>$order->id,

                'shop_id'=>$shop->id

            ],



            'success_url'=>

                route('checkout.success',
                $order->id)
                .'?session_id={CHECKOUT_SESSION_ID}',



            'cancel_url'=>

                route('cart.index')


        ]);



        return redirect($session->url);

    }


}







    public function success(Order $order,Request $request)
    {

        Stripe::setApiKey(config('cashier.secret'));



        $session = Session::retrieve(
            $request->session_id
        );



        $orderIds = explode(
            ',',
            $session->metadata->orders
        );



        $orders = Order::with([
        'shop',
        'items'
        ])
        ->whereIn('id',$orderIds)
        ->get();



        foreach($orders as $order){


            if($order->payment_status=='paid'){
                continue;
            }



            $order->update([

                'payment_status'=>'paid',

                'status'=>'processing',

                'paid_at'=>now(),

            ]);



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