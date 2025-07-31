<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    //
    protected $fillable = [
        'product_id',
        'order_id',
        'quantity',
        'price',
    ];
    // You can define relationships here if needed, e.g., product, order, etc.
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
