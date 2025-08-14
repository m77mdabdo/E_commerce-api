@extends('admin.layout')

@section('body')
    @if (session()->has('success'))
        <alert class="alert success">{{ session()->get('success') }}</alert> <br>
    @endif
    <strong>Order:</strong>
    {{-- <p><a href="{{ route('showOrder', $order->id) }}"> {{ $order->id ?? 'No Category' }}</a></p> --}}

    <p><strong>NameProduct:</strong>
        @foreach ($order->orderDetails as $detail)
            <li>{{ $detail->product->name ?? 'N/A' }}</li>
        @endforeach
    </p>

    <p><strong>Quantity:</strong></p>
    <ul>
        @foreach ($order->orderDetails as $detail)
            <li>{{ $detail->quantity ?? 'N/A' }}</li>
        @endforeach
    </ul>


    <p><strong>Image:</strong><br>
        @foreach ($order->orderDetails as $detail)
            @if ($detail->product && $detail->product->image)
                <img src="{{ asset('storage/' . $detail->product->image) }}" width="80" style="cursor:pointer"
                    onclick="openFullImage('{{ asset('storage/' . $detail->product->image) }}')">
            @else
                <span class="text-muted">No image</span>
            @endif
        @endforeach
    </p>

    <!-- نافذة العرض الكامل -->
    <div id="imageModal"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
     background:rgba(0,0,0,0.9); justify-content:center; align-items:center;">
        <span onclick="closeFullImage()"
            style="position:absolute; top:20px; right:30px; font-size:30px; color:white; cursor:pointer;">&times;</span>
        <img id="fullImage" src="" style="max-width:90%; max-height:90%;">
    </div>

    <p><strong>Price:</strong> {{ $order->orderDetails->sum('price') }} EGP</p>
    <p><strong>Name:</strong> {{ $order->user->name ?? 'Guest' }}</p>
    <p><strong>Email:</strong> {{ $order->user->email ?? 'Guest' }}</p>
    <p><strong>phone:</strong> {{ $order->user->phone ?? 'Guest' }}</p>



    <br>
    <a class="btn btn-info" href="{{ route('editOrder', $order->id) }}">Edite Order</a>

    <br>
    <form action="{{ url("orders/delete/$order->id") }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">delete</button>
    </form>

    <br>
    <a href="{{ route('allOrders') }}" class="btn btn-primary">Back to List </a>
@endsection
