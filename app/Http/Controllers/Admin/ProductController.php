<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
        //  dd($product);
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


        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath; // Store the path in the data array
        }
        // dd($data['image']);

        // dd($request->all());
        Product::create($data);

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
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Upload the new image
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        } else {
            // Keep the old image if no new one uploaded
            $data['image'] = $product->image;
        }




        $product->update($data);

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
