<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiProductController extends Controller
{
    //
    public function all()
    {
        $products = Product::all();
        if ($products !== null) {
            return ProductResource::collection($products);
        } else {
            return response()->json([
                "msg" => "data not found"

            ], 404);
        }
    }

    public function show($id)
    {
        $product = Product::find($id);

        if ($product !== null) {
            return new ProductResource($product);
        } else {
            return response()->json([
                "msg" => "data not found"

            ], 404);
        }
    }

    public function store(Request $request)
    {

        //validation
        $error =  Validator::make($request->all(), [

            "name" => 'required|string|max:255',
            "desc" => "required|string",
            "price" => "required|numeric",
            "image" => "nullable|image|mimes:png,jpg,gif,jpeg",
            "quantity" => "required|numeric",
            "category_id" => "required|numeric|exists:categories,id",

        ]);

        if ($error->fails()) {
            return response()->json([
                "error" => $error->errors()
            ], 301);
        }


        //image
        $image = Storage::putFile("Products", $request->image);

        //create
        Product::create([
            "name" => $request->name,
            "desc" => $request->desc,
            "price" => $request->price,
            "image" => $image,
            "quantity" => $request->quantity,
            "category_id" => $request->category_id,
        ]);
        //msg
        return response()->json([
            "msg" => "Product created successfuly"
        ], 201);
    }

    public function update($id, Request $request)
    {
        //product id
        $product = Product::find($id);

        if ($product === null) {
            return response()->json([
                "msg" => "data not found"

            ], 404);
        }

        //validation
        $errors = Validator::make($request->all(), [

            "name" => 'required|string|max:255',
            "desc" => "required|string",
            "price" => "required|numeric",
            "image" => "nullable|image|mimes:png,jpg,gif,jpeg",
            "quantity" => "required|numeric",
            "category_id" => "required|numeric|exists:categories,id",
        ]);

        if ($errors->fails()) {
            return response()->json([
                "error" => $errors->errors()
            ], 422);
        }

        //image processing

        if ($request->hasFile("image")) {
            if (Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            $image = $request->file('image')->store("Products");
        }

        //update product

        $product->update([
            "name" => $request->name,
            "desc" => $request->desc,
            "price" => $request->price,
            "image" => $image,
            "quantity" => $request->quantity,
            "category_id" => $request->category_id,


        ]);

        return response()->json([
            "msg" => "Product updated successfully",
            "Product" => new ProductResource($product)
        ], 201);
    }

    public function delete($id)
    {
        //find

        $product = Product::find($id);
        if ($product === null) {



            return response()->json([
                "msg" => "data not found"

            ], 404);
        }

        //delete image
        if ($product !== null) {
            Storage::delete($product->image);
        }



        //delete row
        $product->delete();
        //msg

        return response()->json([
            "msg" => "Product delete successfully",
            "product" => new ProductResource($product)
        ], 201);
    }
}