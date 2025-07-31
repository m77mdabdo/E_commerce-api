<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function home()
    {

       

        if (Auth::user()->role == "admin") {

            $products = Product::paginate(9);
            return view('admin.product.home', ["products" => $products]);
        } else {
            $products = Product::all();
            $cart = session()->get('cart');
            // dd($cart);

            return view('user.home', compact('products'));
        }
    }
}
