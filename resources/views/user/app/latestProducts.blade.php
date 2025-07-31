 <div class="latest-products">
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <div class="section-heading">
                     <h2>Latest Products</h2>
                     <a href="products.html">view all products <i class="fa fa-angle-right"></i></a>
                 </div>
             </div>
             @if (isset($products) && count($products))
                 @foreach ($products as $product)
                     <div class="col-md-4">
                         <div class="product-item">
                             <a href="#"><img src="{{ asset('storage') }}/{{ $product->image }}"
                                     alt=""></a>

                                     @auth


                             <form action="{{ route('addToFav', $product->id) }}" method="POST">
                                 @csrf



                                 <button type="submit" style="border:none; background:none; color: #ff0000;">
                                    @if ($product->isFavorite())

                                     <div class="fa fa-heart" style="color:red"></div>
                                     @else
                                     <div class="fa fa-heart"
                                         style="color:gray "></div>

                                    @endif


                                     

                                 </button>
                             </form>
                              @endauth


                             {{-- <img src="{{ asset('storage') }}/{{$product->image}}" alt=""> --}}
                             <div class="down-content">
                                 <a href="{{ route('showProductUser', $product->id) }}">
                                     <h4>{{ $product->name }}</h4>
                                 </a>
                                 <h6>{{ $product->price }}</h6>
                                 <p>{{ $product->desc }}</p>
                                 <p>{{ $product->created_at }}</p>

                                 <p> {{ $product->quantity }}</p>
                                 @auth
                                     <form action="{{ route('addToCartUser', $product->id) }}" method="POST">
                                         @csrf
                                         <input type="number" name="quantity" value="1" min="1"
                                             class="form-control mb-2">
                                         <input type="hidden" name="total_price" id="total_price">


                                         <button type="submit" class="btn filled-button section-heading">Add to
                                             Cart</button>
                                     </form>
                                 @endauth
                                 <form action="{{ route('addWishListUser', $product->id) }}" method="POST">
                                     @csrf

                                     <input type="hidden" name="total_price" id="total_price">


                                     <button type="submit" class="btn filled-button section-heading">Add to
                                         WishListUser</button>
                                 </form>
                                 <span>Reviews (24)</span>

                             </div>
                         </div>
                     </div>
                 @endforeach
             @endif

         </div>
     </div>
 </div>
