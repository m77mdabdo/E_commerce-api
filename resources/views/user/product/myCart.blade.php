@extends('user.product.layout')

@section('content')

    <div class="product-details py-4">
        @if (!empty($cart) && is_array($cart))
            @foreach ($cart as $id => $product)
                <div class="container mb-4 p-4 border rounded shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-5 text-center">
                            <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}"
                                class="img-fluid rounded" style="max-height: 250px; object-fit: contain;">
                        </div>
                        <div class="col-md-7">
                            <h4 class="mb-3">{{ $product['name'] }}</h4>
                            <p class="mb-2"><strong>Price:</strong> ${{ number_format($product['price'], 2) }}</p>
                            <p class="mb-2"><strong>Quantity:</strong> {{ $product['quantity'] }}</p>
                            <br>
                            @if (isset($product['total_price']))
                                <p><strong>Total:</strong> ${{ number_format($product['total_price'], 2) }}</p>
                            @else
                                <p><strong>Total:</strong> ${{ number_format($product['price'] * $product['quantity'], 2) }}
                                </p>
                            @endif

                            <a href="{{ route('removeFromCartUser', $id) }}" class="btn btn-danger">Remove</a>



                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="container">

                <div class="alert alert-info text-center">
                    <br>
                    <br>
                    🛒 Your cart is currently empty.
                </div>
            </div>
        @endif
        <form action="{{ route('userMakeOrder') }}" method="POST" class="p-4 border rounded shadow-sm bg-light"
            style="max-width: 400px; margin: auto;">
            @csrf

            <div class="mb-3">
                <label for="requireDate" class="form-label fw-bold">Select a delivery date</label>
                <input type="date" name="requireDate" id="requireDate" class="form-control" required
                    min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}">

            </div>

            <button type="submit" class="btn btn-primary w-100">Place Order</button>
        </form>

    </div>

@endsection
