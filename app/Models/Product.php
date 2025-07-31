<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    //
    protected $fillable = [
        "name",
        "desc",
        "price",
        "image",
        "quantity",
        "category_id"
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'product_id');
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'product_id');
    }

    public function isFavorite(){
        return $this->favorites()->where('user_id', Auth::id())->exists();

    }

}
