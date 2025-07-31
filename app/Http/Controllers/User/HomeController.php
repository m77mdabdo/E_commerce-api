<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    public function home(){
       $products = Product::all();
            // $cart = session()->get('cart');
            // dd($cart);

            return view('user.home', compact('products'));

    }




}
