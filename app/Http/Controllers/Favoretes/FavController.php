<?php

namespace App\Http\Controllers\Favoretes;

use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavController extends Controller
{
    //
    public function addToFav($id){

        $product = Product::findOrFail($id);
        $user = Auth::id();
        // Logic to add product to user's favorites

        //class fav (userr, product );

        $isFav = Favorite::where('user_id', $user)->where('product_id', $id)->first();

        // dd($isFav);
        if ($isFav) {
            // If already favorited, remove it
            $isFav->delete();
            return redirect()->back()->with('success', 'Product removed from favorites!');
        } else {
            // If not favorited, add it
            Favorite::create([
                'user_id' => $user,
                'product_id' => $id,
            ]);
            return redirect()->back()->with('success', 'Product added to favorites!');
        }


    }

    public function myFav()
{
    $user = Auth::user();


    $favorites = Favorite::where('user_id', $user->id)
        ->with('product')
        ->get();
    return view('user.product.myFav', compact('favorites'));
}
    public function removeFromFavorites($id)
    {
        $user = Auth::id();
        $favorite = Favorite::where('user_id', $user)->where('product_id', $id)->first();

        if ($favorite) {
            $favorite->delete();
            return redirect()->back()->with('success', 'Product removed from favorites!');
        } else {
            return redirect()->back()->with('error', 'Product not found in favorites!');
        }
    }
}
