<?php

namespace App\Http\Controllers\Orders;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //

    public function index()
    {
        $orders = Order::with('user', 'orderDetails.product')
            ->paginate(3);

        return view('admin.orders.allOrders', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('user', 'orderDetails.product')->where('user_id', Auth::id())->findOrFail($id);
        return view('admin.orders.showOrders', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::with('user', 'orderDetails.product')->where('user_id', Auth::id())->findOrFail($id);

        $products = Product::all();
        return view('admin.orders.editOrders', compact('order', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([


            'name'   => 'required|string|max:255',
            'email'  => 'required|email',
            'phone'  => 'required|string|max:20',
            // 'requireDate' => 'required|date',
            'orderDetails.*.quantity' => 'required|integer|min:1',
            'new_products.*.product_id' => 'nullable|exists:products,id',
            'new_products.*.quantity'   => 'nullable|integer|min:1',



        ]);

        $order = Order::with('orderDetails')->findOrFail($id);
        $order->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,

            // 'requireDate' => $request->requireDate ?? now(),
        ]);


        if ($request->has('orderDetails')) {
            foreach ($request->orderDetails as $detailId => $detailData) {
                $orderDetail = $order->orderDetails->find($detailId);
                if ($orderDetail && isset($detailData['quantity'])) {
                    $orderDetail->update([
                        'quantity' => $detailData['quantity'],
                    ]);
                }
            }
        }

        if ($request->has('new_products')) {
            foreach ($request->new_products as $newProduct) {
                if (!empty($newProduct['product_id']) && !empty($newProduct['quantity'])) {
                    $order->orderDetails()->create([
                        'product_id' => $newProduct['product_id'],
                        'quantity'   => $newProduct['quantity'],
                        'price'      => Product::find($newProduct['product_id'])->price,
                    ]);
                }
            }
        }

        return redirect()->route('showOrder', $order->id)->with('success', 'Order updated successfully.');
    }


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


            $productDB = Product::find($id);
            if ($productDB->quantity >= $product['quantity']) {
                $productDB->quantity -= $product['quantity'];
                $productDB->save();
            } else {

                return redirect()->back()->with('error', 'Quantity not available in stock.');
            }
        }

        session()->forget('cart');

        return redirect()->route('userCart')->with('success', 'Order placed successfully!');
        // Clear the cart after placing the order



    }


    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('allOrders')->with('success', 'Order deleted successfully.');
    }
}
