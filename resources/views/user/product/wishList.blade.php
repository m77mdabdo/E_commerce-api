@extends('user.product.layout')

@section('content')

    <div class="product-details py-4">
        @if (!empty($wishlist) && is_array($wishlist))
            @foreach ($wishlist as $id => $product)
                <div class="container mb-4 p-4 border rounded shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-5 text-center">
                            <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}"
                                class="img-fluid rounded" style="max-height: 250px; object-fit: contain;">
                        </div>
                        <div class="col-md-7">
                            <h4 class="mb-3">{{ $product['name'] }}</h4>
                            <p class="mb-2"><strong>Price:</strong> ${{ number_format($product['price'], 2) }}</p>

                            <br>


                            <a href="{{ route('removeFromWishListUser', $id) }}" class="btn btn-danger">Remove</a>
                            <a href="{{ route('showProductUser', $id) }}" class="btn btn-danger">Show</a>


                            {{-- <a href="{{ route('showProductUser', $product->id) }}"> --}}

                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="container">

                <div class="alert alert-info text-center">
                    <br>
                    <br>
                    🛒 Your wishlist is currently empty.
                </div>
            </div>
        @endif


    </div>

@endsection
