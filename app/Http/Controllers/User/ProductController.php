<?php

namespace App\Http\Controllers\User;


use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use id;

class ProductController extends Controller
{
    //
    public function all()
    {
        $products = Product::paginate(2);

        // dd($products);
        return view('user.app.latestProducts', ["products" => $products]);
    }

    public function ourProducts()
    {
        $products = Product::paginate(2);
        $categories = Category::all();
        // dd($products);
        return view('user.product.ourProducts', ["products" => $products, "categories" => $categories]);
    }

    public function byCategory($id)
    {
        $products = Product::where('category_id', $id)->paginate(2);
        $categories = Category::all();
        // dd($products);
        return view('user.product.ourProducts', ["products" => $products, "categories" => $categories]);
    }




    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('user.product.show', compact('product'));
    }

    public function addToCart(Request $request, $id)
    {
        $quantity = $request->quantity;
        $product = Product::findOrFail($id);

        $cart = session()->get('cart');

        if (!$cart) {
            $cart = [
                $id => [
                    "name" => $product->name,
                    "price" => $product->price,
                    "quantity" => $quantity,
                    "image" => $product->image,
                    "total_price" => $product->price * $quantity,
                ]
            ];

            session()->put('cart', $cart);
            return redirect()->back();
        } else {
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $quantity;
                $cart[$id]['total_price'] = $cart[$id]['price'] * $cart[$id]['quantity'];

                session()->put('cart', $cart);
                return redirect()->back();
            }

            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => $quantity,
                "image" => $product->image,
                "total_price" => $product->price * $quantity,
            ];

            session()->put('cart', $cart);
            return redirect()->back();
        }
    }


    public function myCart()
    {
        $cart = session()->get('cart');
        // dd($cart);
        return view('user.product.myCart', compact('cart'));
    }



    public function removeFromCart($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart!');
    }


    public function addWishList($id)
    {
        $product = Product::findOrFail($id);
        $wishlist = session()->get('wishlist');

        if (!$wishlist) {
            $wishlist = [
                $id => [
                    "name" => $product->name,
                    "price" => $product->price,
                    "image" => $product->image,
                ]
            ];

            session()->put('wishlist', $wishlist);
            return redirect()->back()->with('success', 'Product added to wishlist!');
        } else {
            if (isset($wishlist[$id])) {
                return redirect()->back()->with('info', 'Product already in wishlist!');
            }

            $wishlist[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image,
            ];

            session()->put('wishlist', $wishlist);
            return redirect()->back()->with('success', 'Product added to wishlist!');
        }

        // Check if the product is already in the wishlist

    }

     public function wishList()
    {
        $wishlist= session()->get('wishlist');
        // dd($cart);
        return view('user.product.wishList', compact('wishlist'));
    }

    public function removeFromWishList($id)
    {
        $wishlist = session()->get('wishlist');

        if (isset($wishlist[$id])) {
            unset($wishlist[$id]);
            session()->put('wishlist', $wishlist);
        }

        return redirect()->back()->with('success', 'Product removed from wishlist!');
    }



    

}
