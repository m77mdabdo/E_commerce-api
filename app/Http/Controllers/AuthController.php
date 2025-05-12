<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function redirect()
    {

        if (Auth::user()->role == "admin") {

            $products = Product::paginate(9);
            return view('admin.product.home', ["products" => $products]);
        } else {
            return view('user.home');
        }
    }
}