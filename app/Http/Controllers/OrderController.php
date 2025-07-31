<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
     public function makeOrder(Request $request)
    {

        $cart = session()->get('cart');

        $user_id = Auth::user()->id;

        $order = Order::create([
            "requireDate" => $request->requireDate,
            "user_id" => $user_id,

        ]);

        foreach ($cart as $id => $product) {
            OrderDetails::create([
                "order_id" => $order->id,
                "product_id" => $id,
                "price" => $product['total_price'],
                "quantity" => $product['quantity'],
            ]);

            // تقليل الكمية من المخزون
            $productDB = Product::find($id);
            if ($productDB->quantity >= $product['quantity']) {
                $productDB->quantity -= $product['quantity'];
                $productDB->save();
            } else {
                // لو الكمية غير كافية، تقدر تتصرف مثلاً:
                return redirect()->back()->with('error', 'Quantity not available in stock.');
            }
        }

        session()->forget('cart');

        return redirect()->route('userCart')->with('success', 'Order placed successfully!');
        // Clear the cart after placing the order



    }

}
