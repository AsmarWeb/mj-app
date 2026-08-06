<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\DigitalProduct;
use App\Models\Order;
use App\Models\SupplierPayout;
use Illuminate\Http\Request;

class SupplierDashboardController extends Controller
{

    public function index(Request $request)
    {

        $user = auth()->user();


        /*
        |--------------------------------------------------------------------------
        | Supplier Profile
        |--------------------------------------------------------------------------
        */

        $supplier = Supplier::where('user_id', $user->id)
            ->firstOrFail();



        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        $products = DigitalProduct::where(
            'supplier_id',
            $supplier->id
        )->count();



        $recentProducts = DigitalProduct::where(
            'supplier_id',
            $supplier->id
        )
        ->latest()
        ->limit(10)
        ->get();




        /*
        |--------------------------------------------------------------------------
        | Orders
        |--------------------------------------------------------------------------
        */

        $recentOrders = Order::whereHas(
            'items.digitalProduct',
            function ($q) use ($supplier) {

                $q->where(
                    'supplier_id',
                    $supplier->id
                );

            }
        )
        ->with([
            'customer',
            'items.digitalProduct'
        ])
        ->latest()
        ->limit(10)
        ->get();




        $orders = $recentOrders->count();




        $pendingOrders = Order::whereHas(
            'items.digitalProduct',
            function ($q) use ($supplier) {

                $q->where(
                    'supplier_id',
                    $supplier->id
                );

            }
        )
        ->where(
            'status',
            'pending'
        )
        ->count();





        /*
        |--------------------------------------------------------------------------
        | Revenue
        |--------------------------------------------------------------------------
        */

        $revenue = SupplierPayout::where(
                'supplier_id',
                $supplier->id
            )
            ->where(
                'status',
                'paid'
            )
            ->sum('amount');





        /*
        |--------------------------------------------------------------------------
        | Wallet
        |--------------------------------------------------------------------------
        */

        $wallet = $supplier->wallet;


        if (!$wallet) {

            $wallet = $supplier->wallet()->create([

                'available_balance' => 0,

                'pending_balance' => 0,

                'total_earned' => 0,

            ]);

        }





        /*
        |--------------------------------------------------------------------------
        | Payouts
        |--------------------------------------------------------------------------
        */

        $payouts = SupplierPayout::where(
                'supplier_id',
                $supplier->id
            )
            ->latest()
            ->limit(10)
            ->get();






        /*
        |--------------------------------------------------------------------------
        | Notifications
        |--------------------------------------------------------------------------
        */

        $notifications = $user->notifications()
            ->latest()
            ->limit(10)
            ->get();



            $completedOrders = Order::whereHas('items', function($q) use($supplier){
    $q->where('supplier_id',$supplier->id);
})
->where('status','completed')
->count();



        return view(
            'supplier.dashboard',
            compact(
                'supplier',
                'products',
                'orders',
                'pendingOrders',
                'revenue',
                'wallet',
                'recentProducts',
                'recentOrders',
                'payouts',
                'notifications',
                'completedOrders'
            )
        );

    }

}