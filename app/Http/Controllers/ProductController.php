<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function all()
    {
        $products = Product::paginate(9);
        return view('admin.product.home', ["products" => $products]);
    }


    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('admin.product.showProduct', compact('product'));
    }

    public function create()
    {

        $categories = Category::all();
        return view('admin.product.createProduct', ["categories" => $categories]);
    }
}