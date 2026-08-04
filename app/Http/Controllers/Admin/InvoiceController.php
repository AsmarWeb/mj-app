<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Shop;
use Illuminate\Support\Facades\Schema;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class InvoiceController extends Controller
{
    public function index()
    {

    if (!Schema::hasTable('invoices')) {

        return view('admin.invoices.index', [
            'invoices'=>collect()
        ]);

    }



    $invoices = Invoice::with('shop')
        ->latest()
        ->paginate(20);



    return view(
        'admin.invoices.index',
        compact('invoices')
    );
    }

    public function create()
    {

    $shops = Shop::all();


    return view(
        'admin.invoices.create',
        compact('shops')
    );
    }

    public function store(Request $request)
{
    $request->validate([

        'customer_name' => 'required|string|max:255',

        'customer_email' => 'nullable|email',

        'customer_phone' => 'nullable|string',


        'items' => 'required|array|min:1',


        'items.*.title' => 'required|string',

        'items.*.quantity' => 'required|integer|min:1',

        'items.*.price' => 'required|numeric|min:0',

    ]);



    $subtotal = 0;


    foreach ($request->items as $item) {

        $subtotal += 
            $item['quantity'] *
            $item['price'];

    }



    $invoice = Invoice::create([


        'invoice_number' =>
            'INV-' . strtoupper(Str::random(8)),


        'customer_name' =>
            $request->customer_name,


        'customer_email' =>
            $request->customer_email,


        'customer_phone' =>
            $request->customer_phone,


        'subtotal' =>
            $subtotal,


        'tax' =>
            0,


        'total' =>
            $subtotal,


        'status' =>
            'paid'

    ]);





    foreach ($request->items as $item) {


        InvoiceItem::create([


            'invoice_id' =>
                $invoice->id,


            'title' =>
                $item['title'],


            'quantity' =>
                $item['quantity'],


            'price' =>
                $item['price'],


            'total' =>
                $item['quantity'] * $item['price']


        ]);

    }



    return redirect()

        ->route(
            'invoices.show',
            $invoice
        )

        ->with(
            'success',
            'Invoice created successfully'
        );
}

    public function show(Invoice $invoice)
    {

    $invoice->load([
        'shop',
        'user',
        'items'
    ]);


    return view(
        'admin.invoices.show',
        compact('invoice')
    );
    }

    public function download(Invoice $invoice)
    {


    $invoice->load([
        'shop',
        'user',
        'items'
    ]);


    $pdf = Pdf::loadView(
        'admin.invoices.pdf',
        compact('invoice')
    );


    return $pdf->download(
        $invoice->invoice_number.'.pdf'
    );
    }

    public function updateStatus(Request $request,Invoice $invoice)
    {

    $invoice->update([

        'status'=>$request->status

    ]);


    return back()
        ->with(
            'success',
            'Invoice status updated'
        );
    }
}
