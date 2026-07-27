<?php

namespace App\Mail;

use App\Models\Download;
use Illuminate\Mail\Mailable;

class DigitalProductPurchased extends Mailable
{
    public $download;

    public function __construct(Download $download)
    {
        $this->download = $download;
    }

    public function build()
    {
        return $this->subject('Your Digital Product is Ready')
            ->view('emails.digital-product');
    }
}
