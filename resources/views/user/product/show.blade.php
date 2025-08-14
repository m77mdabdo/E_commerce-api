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
                        <form action="{{ route('addWishListUser', $product->id) }}" method="POST">
                            @csrf

                            <input type="hidden" name="total_price" id="total_price">


                            <button type="submit" class="btn filled-button section-heading">Add to
                                WishListUser</button>
                        </form>
                        <span>
                            Reviews
                            <a href="{{ route('allReviews') }}" style="color:#ff0000; text-decoration:none;">
                                ({{ $product->reviews->count() }})
                            </a>
                        </span>


                        {{-- عرض آخر الريفيوهات --}}
                        @if ($product->reviews->count())
                            <div class="mt-2">
                                @foreach ($product->reviews as $review)
                                    <p style="margin-bottom: 5px;">
                                        <strong>{{ $review->user->name }}:</strong>
                                        <span class="text-warning">
                                            @for ($i = 1; $i <= $review->rating; $i++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                        </span>
                                        <br>
                                        {{ $review->comment }}
                                    </p>
                                @endforeach
                            </div>
                        @endif

                        @auth
                            {{-- عرض النجوم --}}
                            <div class="rating mb-2">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}-{{ $product->id }}" name="rating"
                                        value="{{ $i }}">
                                    <label for="star{{ $i }}-{{ $product->id }}"
                                        title="{{ $i }} stars">
                                        <i class="fa fa-star"></i>
                                    </label>
                                @endfor
                            </div>
                            <br>

                            {{-- زرار الكومنت --}}
                            <a href="{{ route('createReview', $product->id) }}" class="btn filled-button"
                                style="background-color:#ff0000; border:none;">
                                Add Comment
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .rating {
        direction: rtl;
        display: inline-flex;
    }

    .rating input {
        display: none;
    }

    .rating label {
        font-size: 1.5rem;
        color: #ccc;
        cursor: pointer;
    }

    .rating input:checked~label i {
        color: gold;
    }

    .rating label:hover i,
    .rating label:hover~label i {
        color: gold;
    }
</style>
