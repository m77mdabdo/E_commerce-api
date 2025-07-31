@extends('user.product.layout')

@section('content')
    <div class="product-details py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center mb-4 mb-md-0">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded"
                        style="max-height: 400px; object-fit: contain;">
                </div>
                <div class="col-md-6">
                    <div class="right-content">
                        <h3 class="mb-3">{{ $product->name }}</h3>
                        <h5 class="text-primary mb-3">${{ number_format($product->price, 2) }}</h5>
                        <p class="mb-3">{{ $product->desc }}</p>
                        <p><strong>Available Quantity:</strong> {{ $product->quantity }}</p>
                        <p><strong>Category:</strong> {{ $product->category->name }}</p>
                        <form action="{{ route('addToCartUser', $product->id) }}" method="POST">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" class="form-control mb-2">
                            <button type="submit" class="btn filled-button section-heading">Add to Cart</button>
                        </form>
                        <span>Reviews (24)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
