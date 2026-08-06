<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class SupplierInvitationController extends Controller
{


    public function accept($token)
    {

        $supplier = Supplier::where(
            'invite_token',
            $token
        )
        ->whereNull('user_id')
        ->firstOrFail();



        return view(
            'supplier.auth.invitation',
            compact('supplier')
        );

    }





    public function store(
        Request $request,
        $token
    )
    {


        $supplier = Supplier::where(
            'invite_token',
            $token
        )
        ->whereNull('user_id')
        ->firstOrFail();





        $request->validate([

            'password'=>[
                'required',
                'min:8',
                'confirmed'
            ]

        ]);






        DB::transaction(function() use(
            $supplier,
            $request
        ){



            /*
            |--------------------------------------------------------------------------
            | Check Existing User
            |--------------------------------------------------------------------------
            */


            $user = User::where(
                'email',
                $supplier->email
            )
            ->first();



            if(!$user){


                $user = User::create([

                    'name'=>$supplier->name,

                    'email'=>$supplier->email,

                    'password'=>Hash::make(
                        $request->password
                    ),

                ]);


            }






            /*
            |--------------------------------------------------------------------------
            | Assign Supplier Role
            |--------------------------------------------------------------------------
            */


            if(
                ! $user->hasRole('supplier')
            ){

                $user->addRole('supplier');

            }





            /*
            |--------------------------------------------------------------------------
            | Connect Supplier Account
            |--------------------------------------------------------------------------
            */


            $supplier->update([

                'user_id'=>$user->id,

                'invite_token'=>null,

                'invited_at'=>now(),

            ]);




            auth()->login($user);



        });






        return redirect()
            ->route(
                'supplier.dashboard'
            );


    }


}