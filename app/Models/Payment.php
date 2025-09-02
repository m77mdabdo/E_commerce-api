<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = [
        'order_id',
        'amount',
        'payment_method',
        'status',
        'transaction_id',
        'transaction_details',
        'transaction_data',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
