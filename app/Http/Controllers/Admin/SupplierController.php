<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Mail\SupplierInvitationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SupplierController extends Controller
{

    public function index(Request $request)
    {

        $suppliers = Supplier::withCount('products')

            ->when($request->search, function ($query) use ($request) {

                $query->where(function($q) use($request){

                    $q->where('name','like','%'.$request->search.'%')
                    ->orWhere('company','like','%'.$request->search.'%')
                    ->orWhere('phone','like','%'.$request->search.'%');

                });

            })


            ->when($request->status, function ($query) use ($request) {

                $query->where('status',$request->status);

            })


            ->latest()
            ->paginate(20);


        return view(
            'admin.suppliers.index',
            compact('suppliers')
        );

    }





    public function create()
    {

        return view(
            'admin.suppliers.create'
        );

    }







    public function store(Request $request)
    {


        $validated = $request->validate([


            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */


            'name' => [
                'required',
                'string',
                'max:255'
            ],


            'company' => [
                'nullable',
                'string',
                'max:255'
            ],



            /*
            |--------------------------------------------------------------------------
            | UAE Contact
            |--------------------------------------------------------------------------
            */


            'email' => [
                'nullable',
                'email'
            ],


            'phone' => [
                'nullable',
                'string',
                'max:30'
            ],


            'whatsapp' => [
                'nullable',
                'string',
                'max:30'
            ],



            'address' => [
                'nullable',
                'string'
            ],



            'emirate' => [
                'nullable',
                'in:Dubai,Abu Dhabi,Sharjah,Ajman,Umm Al Quwain,Ras Al Khaimah,Fujairah'
            ],



            'country' => [
                'nullable',
                'string'
            ],



            /*
            |--------------------------------------------------------------------------
            | Business
            |--------------------------------------------------------------------------
            */


            'website' => [
                'nullable',
                'url'
            ],



            'vat_number' => [
                'nullable',
                'string',
                'max:100'
            ],



            'type' => [
                'required',
                'in:printful,printify,local,manufacturer,other'
            ],



            'api_key' => [
                'nullable',
                'string'
            ],



            'commission' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100'
            ],



            'status' => [
                'required',
                'in:active,inactive'
            ]


        ]);





        if(!empty($validated['api_key'])){

            $validated['api_key'] =
                Crypt::encryptString(
                    $validated['api_key']
                );

        }





        $supplier = Supplier::create([

    ...$validated,

    'supplier_type' => 'pod',

    'invite_token' => Str::uuid(),

]);



if ($supplier->email) {

    $url = route('supplier.invitation', [
        'token' => $supplier->invite_token
    ]);


    Mail::to($supplier->email)
        ->send(
            new SupplierInvitationMail(
                $supplier,
                $url
            )
        );

}






        return redirect()

            ->route('suppliers.index')

            ->with(
                'success',
                'Supplier created successfully'
            );

    }









    public function edit(Supplier $supplier)
    {

        return view(
            'admin.suppliers.edit',
            compact('supplier')
        );

    }









    public function update(
        Request $request,
        Supplier $supplier
    )
    {


        $validated = $request->validate([


            'name'=>'required|string|max:255',

            'company'=>'nullable|string|max:255',

            'email'=>'nullable|email',

            'phone'=>'nullable|string|max:30',

            'whatsapp'=>'nullable|string|max:30',

            'address'=>'nullable|string',

            'emirate'=>'nullable|string',

            'country'=>'nullable|string',


            'website'=>'nullable|url',


            'vat_number'=>'nullable|string|max:100',



            'type'=>[
                'required',
                'in:printful,printify,local,manufacturer,other'
            ],



            'api_key'=>'nullable|string',



            'commission'=>[
                'nullable',
                'numeric',
                'min:0',
                'max:100'
            ],



            'status'=>'required|in:active,inactive'


        ]);





        if(
            isset($validated['api_key']) &&
            $validated['api_key']
        ){

            $validated['api_key'] =
                Crypt::encryptString(
                    $validated['api_key']
                );

        }
        else{

            unset($validated['api_key']);

        }







        $supplier->update(
            $validated
        );




        return redirect()

            ->route('suppliers.index')

            ->with(
                'success',
                'Supplier updated successfully'
            );

    }









    public function destroy(Supplier $supplier)
    {

        if($supplier->products()->exists()){


            return back()

                ->with(
                    'error',
                    'Cannot delete supplier with products'
                );

        }



        $supplier->delete();



        return back()

            ->with(
                'success',
                'Supplier deleted'
            );

    }


}