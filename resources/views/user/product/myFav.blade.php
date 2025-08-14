@extends('user.product.layout')

@section('content')


    <br>
    <h2>My Favorite Products</h2>

    @if($favorites->count())
        <div class="row">
            @foreach($favorites as $fav)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($fav->product && $fav->product->image)
                            <img src="{{ asset('storage/' . $fav->product->image) }}" class="card-img-top" alt="{{ $fav->product->name }}">
                        @endif
                        <div class="card-body">
                            <a href="{{ route('showProductUser', $fav->product->id) }}" class="text-decoration-none">
                            <h5>{{ $fav->product->name ?? 'Product Deleted' }}</h5>
                            <p>{{ Str::limit($fav->product->description ?? '', 100) }}</p>
                            <p><strong>Price:</strong> ${{ $fav->product->price ?? 'N/A' }}</p>

                            <form action="{{ route('removeFromFavorites', $fav->product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>You have no favorite products yet.</p>
    @endif
@endsection
