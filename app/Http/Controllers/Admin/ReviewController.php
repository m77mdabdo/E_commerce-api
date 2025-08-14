<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    //
     public function index()
    {
        $reviews = Review::with('user', 'product')->paginate(10);
        return view('admin.review.allReview', compact('reviews'));
    }
    public function show($id)
    {
        $review = Review::with('user', 'product')->findOrFail($id);
        return view('admin.review.show', compact('review'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.review.createReview', compact('products'));
    }
    public function store(){
        $data = request()->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        Review::create($data);
        return redirect()->route('allReviews')->with('success', 'Review created successfully.');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $products = Product::all();
        return view('admin.review.editReview', compact('review', 'products'));
    }
    public function update($id)
    {
        $data = request()->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $review = Review::findOrFail($id);
        $review->update($data);
        return redirect()->route('allReviews')->with('success', 'Review updated successfully.');
    }

    public function destroy(){
        $id = request()->route('id');
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->route('allReviews')->with('success', 'Review deleted successfully.');
    }

}
