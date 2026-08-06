<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [

    'name',
    'company',
    'email',
    'phone',
    'whatsapp',
    'address',
    'emirate',
    'country',
    'website',
    'vat_number',
    'type',
    'api_key',
    'commission',
    'status',
    'supplier_type',
    'invite_token',
    'user_id',
    'invited_at',

];

    protected $guarded = [];

    public function products()
    {
    return $this->hasMany(DigitalProduct::class)->where('type','pod');
    }

    public function payouts()
    {
    return $this->hasMany(SupplierPayout::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }

    public function wallet()
    {
    return $this->hasOne(
        SupplierWallet::class
    );
    }
}
