<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    //
    public function all()
    {
        $categories = Category::paginate(3);
        return view('admin.category.homeCategory', ["categories" => $categories]);
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('admin.category.showCategory', compact('category'));
    }

    public function create()
    {
        return view('admin.category.createCategory');
    }

    public function store(Request $request)
    {

        $request->validate([
            "name" => 'required|string|max:255',
            "desc" => "required|string",
            "image" => "required|image |mimes:png,jpg,gif,jpeg",
            'status' => 'required|in:0,1',


        ]);
        $imageName = time() . '_' . $request->image->getClientOriginalName();
        $path = $request->image->storeAs('categories', $imageName, 'public');

        Category::create([
            "name" => $request->name,
            "desc" => $request->desc,
            "image" => $path,
            'status' => $request->status,



        ]);
        session()->flash("success", "data insert successfuly"); //-> unset in sesssion

        return redirect(route('allCategory'));
    }

    public function edite($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.updateCategory', ["category" => $category]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            "name" => 'required|string|max:255',
            "desc" => "required|string",
            "image" => "nullable|image|mimes:png,jpg,gif,jpeg",
            'status' => 'required|in:0,1',
        ]);

        $category = Category::findOrFail($id);
        $path = $category->image;

        if ($request->hasFile("image")) {

            Storage::disk('public')->delete($category->image);


            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $path = $request->image->storeAs('categories', $imageName, 'public');
        }

        $category->update([
            "name" => $request->name,
            "desc" => $request->desc,
            "image" => $path,
            'status' => $request->status,
        ]);

        session()->flash("success", "Data updated successfully");

        return view('admin.category.showCategory', compact("category"));
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        Storage::delete($category->image);
        $category->delete();
        // $categories = Category::all();

        //  session()->put("success", "data delete  successfuly ");
        session()->flash("success", "data delete  successfuly");

        // return view("Category.all", ["categories" => $categories]);
        return  redirect(route("allCategory"));
    }
}
