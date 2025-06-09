<?php

// app/Http/Controllers/Api/ApiCategoryController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiCategoryController extends Controller
{
    public function all()
    {
        $categories = Category::all();
        if ($categories !== null) {
            return CategoryResource::collection($categories);
        } else {
            return response()->json([
                "msg" => "data not found"

            ], 404);
        }
    }

    public function show($id)
    {
        $category = Category::find($id);
        // return view('admin.category.showCategory', compact('category'));
        if ($category !== null) {
            return new CategoryResource($category);
        } else {

            return response()->json([
                "msg" => "data not found"

            ], 404);
        }
    }

    public function store(Request $request)
    {

        //validation

        $errors = Validator::make($request->all(), [
            "name" => 'required|string|max:255',
            "desc" => "required|string",
            "image" => "required|image |mimes:png,jpg,gif,jpeg",
            'status' => 'required|in:0,1',


        ]);
        if ($errors->fails()) {
            return response()->json([
                "erorr" => $errors->errors()

            ], 301);
        }
        //imge
        $image = Storage::putFile("Categories", $request->image);
        //create
        Category::create([
            "name" => $request->name,
            "desc" => $request->desc,
            "image" => $image,
            'status' => $request->status,

        ]);
        //msg
        return response()->json([
            "msg" => "category created successfuly"
        ], 201);
    }

    public function update($id, Request $request)
    {
        $category = Category::find($id);

        if ($category === null) {
            return response()->json([
                "msg" => "data not found"
            ], 404);
        }

        // Validation
        $errors = Validator::make($request->all(), [
            "name" => 'required|string|max:255',
            "desc" => "required|string",
            "image" => "image|mimes:png,jpg,gif,jpeg",
            'status' => 'required|in:0,1',
        ]);

        if ($errors->fails()) {
            return response()->json([
                "error" => $errors->errors()
            ], 422); // Use 422 for validation errors
        }

        // Image processing
        $image = $category->image;

        if ($request->hasFile("image")) {
            if (Storage::exists($category->image)) {
                Storage::delete($category->image);
            }

            $image = $request->file('image')->store("Categories");
        }

        // Update category
        $category->update([
            "name" => $request->name,
            "desc" => $request->desc,
            "image" => $image,
            "status" => $request->status,
        ]);

        return response()->json([
            "msg" => "Category updated successfully",
            "category" => new CategoryResource($category)
        ], 201);
    }

    public function delete($id)
    {
        //find

        $category = Category::find($id);
        if ($category === null) {



            return response()->json([
                "msg" => "data not found"

            ], 404);
        }

        //delete image
        if ($category !== null) {
            Storage::delete($category->image);
        }



        //delete row
        $category->delete();
        //msg

        return response()->json([
            "msg" => "Category delete successfully",
            "category" => new CategoryResource($category)
        ], 201);
    }
}
