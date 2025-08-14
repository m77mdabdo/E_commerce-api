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


}
