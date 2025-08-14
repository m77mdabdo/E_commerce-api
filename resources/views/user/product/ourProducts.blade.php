@extends('user.product.layout')

@section('content')
    <div class="page-heading products-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>new arrivals</h4>
                        <h2>sixteen products</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="products py-5">
        <div class="container">
            <h2 class="mb-4">Our Products</h2>

            <div class="row">
                <div class="col-md-12">
                    <div class="filters">
                        <ul>
                            <!-- All Products -->
                            <li class="{{ request()->routeIs('ourProductsUser') ? 'active' : '' }}">
                                <a href="{{ route('ourProductsUser') }}">All Products</a>
                            </li>

                            <!-- Dynamic Categories -->
                            @foreach ($categories as $category)
                                <li class="{{ request()->is('products/category/' . $category->id) ? 'active' : '' }}">
                                    <a href="{{ route('products.byCategory', $category->id) }}">
                                        {{ strtoupper($category->name) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="filters-content">
                        <div class="row grid">
                            @foreach ($products as $product)
                                <div class="col-lg-4 col-md-4 all des">
                                    <div class="product-item">
                                        <a href="#">
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                        </a>

                                        @auth
                                            <form action="{{ route('addToFav', $product->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" style="border:none; background:none;">
                                                    @if ($product->isFavorite())
                                                        <div class="fa fa-heart" style="color:red"></div>
                                                    @else
                                                        <div class="fa fa-heart" style="color:gray"></div>
                                                    @endif
                                                </button>
                                            </form>
                                        @endauth

                                        <div class="down-content">
                                            <a href="{{ route('showProductUser', $product->id) }}">
                                                <h4>{{ $product->name }}</h4>
                                            </a>
                                            <h6>${{ number_format($product->price, 2) }}</h6>
                                            <p>{{ Str::limit($product->description, 100) }}</p>

                                            {{-- Reviews Count --}}
                                            <span class="d-block mb-2">
                                                Reviews:
                                                <a href="{{ route('allReviews') }}" style="color:#ff0000; text-decoration:none;">
                                                    ({{ $product->reviews->count() }})
                                                </a>
                                            </span>

                                            {{-- آخر الريفيوهات --}}
                                            @if ($product->reviews->count())
                                                <div class="mt-2 border-top pt-2">
                                                    @foreach ($product->reviews as $review)
                                                        <div class="mb-2">
                                                            <strong>{{ $review->user->name }}:</strong>
                                                            <div class="text-warning mb-1">
                                                                @for ($i = 1; $i <= $review->rating; $i++)
                                                                    <i class="fa fa-star"></i>
                                                                @endfor
                                                            </div>
                                                            <small>{{ $review->comment }}</small>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                            @auth
                                                {{-- عرض النجوم --}}
                                                <div class="rating mb-2 mt-2">
                                                    @for ($i = 5; $i >= 1; $i--)
                                                        <input type="radio" id="star{{ $i }}-{{ $product->id }}"
                                                            name="rating" value="{{ $i }}">
                                                        <label for="star{{ $i }}-{{ $product->id }}" title="{{ $i }} stars">
                                                            <i class="fa fa-star"></i>
                                                        </label>
                                                    @endfor
                                                </div>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- ✅ Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $products->links() }}
                        </div>
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

    .rating input:checked ~ label i {
        color: gold;
    }

    .rating label:hover i,
    .rating label:hover ~ label i {
        color: gold;
    }

    .text-warning i {
        margin-right: 2px;
    }
</style>
