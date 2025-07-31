@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Order Details #{{ $order->id }}</h2>
    <p><strong>Order Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
    <p><strong>Requested Delivery Date:</strong> {{ $order->requireDate }}</p>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Product</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderDetails as $detail)
                <tr>
                    <td>{{ $detail->product->name ?? 'Name not available' }}</td>
                    <td>{{ number_format($detail->price / $detail->quantity, 2) }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
