<?php

namespace App\Http\Controllers\Review;

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
        return view('user.review.Review', compact('reviews'));
    }
    public function show($id)
    {
        $review = Review::with('user', 'product')->findOrFail($id);
        return view('user.review.showReview', compact('review'));
    }

    public function create($id)
    {
        $product = Product::findOrFail($id);
        return view('user.review.createReview', compact('product'));
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




}
