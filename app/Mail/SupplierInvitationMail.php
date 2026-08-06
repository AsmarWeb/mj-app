<?php

namespace App\Mail;

use App\Models\Supplier;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupplierInvitationMail extends Mailable
{
    use Queueable, SerializesModels;


    public Supplier $supplier;

    public string $url;



    public function __construct(
        Supplier $supplier,
        string $url
    ) {

        $this->supplier = $supplier;
        $this->url = $url;

    }



    public function build()
    { 

        return $this
            ->subject('You are invited as a Supplier')
            ->view('emails.supplier.invitation')
            ->with([

                'supplier' => $this->supplier,

                'url' => $this->url,

            ]);

    }
}