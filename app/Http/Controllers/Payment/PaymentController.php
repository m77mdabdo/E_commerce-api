<?php

namespace App\Http\Controllers\Payment;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    //
    public function create(Order $order)
    {
        return view('payment.create', [
            'order' => $order
        ]);
    }

    public function createStripePaymentIntent(Order $order)
    {

        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $order->grand_total * 100, // Amount in cents
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);
        return [
            'clientSecret' => $paymentIntent->client_secret

        ];
    }

    public function confirm(Request $request, Order $order){
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $paymentIntent = $stripe->paymentIntents->retrieve($request->query('payment_intent'));
        if($paymentIntent->status === 'succeeded'){
            //create payment record
            $payment = new Payment ();
            $payment->forceFill([
                'order_id' => $order->id,
                'amount'=>$paymentIntent->amount / 100,
                'currency'=>$paymentIntent->currency,
                'status'=>$paymentIntent->status,
                'transaction_id'=>$paymentIntent->id,
                'payment_method'=>$paymentIntent->payment_method_types[0],
                'transaction_data'=>json_encode($paymentIntent),

            ])->save();

            // Update order status to paid
            $order->update(['status' => 'paid']);
            return redirect()->route('home')->with('success', 'Payment successful! Your order has been placed.');
        }else{

            return redirect()->route('createPayment', ['order' => $order->id])->with('error', 'Payment failed! Please try again.');

        }


    }
}



