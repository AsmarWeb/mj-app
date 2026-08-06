<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierWallet extends Model
{
     protected $fillable = [

        'supplier_id',
        'available_balance',
        'pending_balance',
        'total_earned',

    ];



    public function supplier()
    {
        return $this->belongsTo(
            Supplier::class
        );
    }
}
