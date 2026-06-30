<?php

namespace App\Http\Controllers;

use App\Models\BusinessCard;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BusinessCardController extends Controller
{

    public function create()
    {
        return view('cards.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
            'company'=>'nullable',
            'job_title'=>'nullable',
            'phone'=>'nullable',
            'email'=>'nullable',
            'website'=>'nullable',
            'address'=>'nullable',
            'color'=>'nullable'
        ]);


        $card = auth()->user()
            ->businessCards()
            ->create($data);


        return redirect()
            ->route('cards.pdf',$card->id);
    }



    public function pdf($id)
    {
        $card = BusinessCard::findOrFail($id);


        $pdf = Pdf::loadView(
            'cards.pdf',
            compact('card')
        );


        return $pdf->download(
            'business-card.pdf'
        );
    }
}
