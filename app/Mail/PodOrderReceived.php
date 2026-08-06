<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\DigitalProduct;
use Illuminate\Mail\Mailable;

class PodOrderReceived extends Mailable
{
    public $order;
    public $item;
    public $product;

    public function __construct(
        Order $order,
        OrderItem $item,
        DigitalProduct $product
    ) {
        $this->order = $order;
        $this->item = $item;
        $this->product = $product;
    }

    public function build()
    {
        return $this
            ->subject('New POD Fulfillment Order')
            ->markdown('emails.suppliers.pod-order');
    }
}