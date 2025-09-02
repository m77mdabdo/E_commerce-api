<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'orderDate',
        'requireDate',
        'user_id',
        'full_name',
        'phone',
        'address',
        'note',
    ];
    // You can define relationships here if needed, e.g., user, products, etc.
    public function userData()
    {
        //relation one to many

        return $this->belongsTo(User::class, 'user_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

public function product(){
    return $this->belongsTo(Product::class);
}

   public function getGrandTotalAttribute()
{
    return $this->orderDetails->sum(function($detail) {
        return $detail->price * $detail->quantity;
    });
}

public function payments()
{
    return $this->hasMany(Payment::class);


}
}
