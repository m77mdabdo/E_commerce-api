<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function all()
    {
        $products = Product::paginate(2);
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

    public function store(Request $request)
    {
        $data =  $request->validate([
            "name" => 'required|string|max:255',
            "desc" => "required|string",
            "price" => "required|numeric",
            "image" => "nullable|image|mimes:png,jpg,gif,jpeg",
            "quantity" => "required|numeric",
            "category_id" => "required|numeric|exists:categories,id",
        ]);

        // $imagePath = null;
        // if ($request->hasFile('image')) {
        //     $imageName = time() . '_' . $request->image->getClientOriginalName();
        //     $imagePath = $request->image->storeAs('products', $imageName, 'public');
        // }
        $data['image'] = Storage::putFile("products", $request->image);

        // dd($request->all());
        Product::create([
            "name" => $request->name,
            "desc" => $request->desc,
            "price" => $request->price,
            "image" => $data['image'],
            "quantity" => $request->quantity,
            "category_id" => $request->category_id,
        ]);

        session()->flash("success", "create proute ");
        return redirect(route('allProducts'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.Product.update', ['product' => $product, 'categories' => $categories]);
    }

    public function update($id, Request $request)
    {

        $data =  $request->validate([
            "name" => 'required|string|max:255',
            "desc" => "required|string",
            "price" => "required|numeric",
            "image" => "nullable|image|mimes:png,jpg,gif,jpeg",
            "quantity" => "required|numeric",
            "category_id" => "required|numeric|exists:categories,id",
        ]);

        $product = Product::findOrFail($id);

        $path = $product->image;

        if ($request->hasFile("image")) {

            Storage::disk('public')->delete($product->image);


            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $path = $request->image->storeAs('products', $imageName, 'public');
        }




        $product->update([
            "name" => $request->name,
            "desc" => $request->desc,
            "price" => $request->price,
            "image" => $path,
            "quantity" => $request->quantity,
            "category_id" => $request->category_id,
        ]);

        session()->flash("success", "Data updated successfully");

        return view('admin.product.showProduct', compact("product"));
    }


    public function delete($id)
    {
        $product = Product::findOrFail($id);

        Storage::delete($product->image);
        $product->delete();

        session()->flash("success", "data delete  successfuly");

        return  redirect(route("allProducts"));
        
        
    }
}