<div class="latest-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading d-flex justify-content-between align-items-center">
                    <h2>Latest Products</h2>
                    <a href="{{ route('ourProductsUser') }}">
                        View All Products <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>

            @if(isset($products) && count($products))
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="product-item card shadow-sm">
                            <a href="{{ route('showProductUser', $product->id) }}">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top">
                            </a>

                            <div class="card-body">
                                {{-- زر المفضلة --}}
                                @auth
                                    <form action="{{ route('addToFav', $product->id) }}" method="POST" class="mb-2">
                                        @csrf
                                        <button type="submit" class="btn btn-sm p-0 border-0 bg-transparent">
                                            <i class="fa fa-heart" style="color:{{ $product->isFavorite() ? 'red' : 'gray' }}"></i>
                                        </button>
                                    </form>
                                @endauth

                                {{-- اسم المنتج --}}
                                <h5 class="card-title">
                                    <a href="{{ route('showProductUser', $product->id) }}" class="text-dark">{{ $product->name }}</a>
                                </h5>

                                <h6 class="text-danger">${{ $product->price }}</h6>
                                <p class="text-muted">{{ Str::limit($product->desc, 50) }}</p>
                                <p><strong>Stock:</strong> {{ $product->quantity }}</p>

                                {{-- زرار الإضافة للسلة --}}
                                @auth
                                    <form action="{{ route('addToCartUser', $product->id) }}" method="POST" class="mb-2">
                                        @csrf
                                        <input type="number" name="quantity" value="1" min="1" class="form-control mb-2" style="width:80px;">
                                        <button type="submit" class="btn btn-sm btn-primary">Add to Cart</button>
                                    </form>
                                @endauth

                                {{-- زرار الإضافة لقائمة الأمنيات --}}
                                <form action="{{ route('addWishListUser', $product->id) }}" method="POST" class="mb-2">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Add to WishList</button>
                                </form>

                                {{-- عرض عدد الريفيوهات --}}
                                <span>
                                    Reviews:
                                    <a href="{{ route('allReviews') }}" style="color:#ff0000;">
                                        ({{ $product->reviews->count() }})
                                    </a>
                                </span>

                                {{-- آخر 3 ريفيوهات --}}
                                @if ($product->reviews->count())
                                    <div class="mt-2 border-top pt-2">
                                        @foreach ($product->reviews->take(3) as $review)
                                            <p class="mb-1">
                                                <strong>{{ $review->user->name }}:</strong>
                                                <span class="text-danger">
                                                    @for ($i = 1; $i <= $review->rating; $i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                                </span>
                                                <br>
                                                <small>{{ $review->comment }}</small>
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

{{-- CSS النجوم --}}
<style>
    .rating {
        direction: rtl;
        display: inline-flex;
    }
    .rating input { display: none; }
    .rating label {
        font-size: 1.5rem;
        color: #ccc;
        cursor: pointer;
    }
    .rating input:checked ~ label i,
    .rating label:hover i,
    .rating label:hover ~ label i {
        color: red; /* لون النجوم عند التحديد */
    }
</style>
