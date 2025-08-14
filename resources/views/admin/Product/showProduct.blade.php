@extends('admin.layout')

@section('body')
    @if (session()->has('success'))
        <alert class="alert success">{{ session()->get('success') }}</alert> <br>
    @endif

    {{-- بيانات الكاتيجوري --}}
    <strong>Category Name:</strong>
    <p>
        <a href="{{ route('showCategory', $product->category->id) }}">
            {{ $product->category->name ?? 'No Category' }}
        </a>
    </p>

    {{-- بيانات المنتج --}}
    <p><strong>Name:</strong> {{ $product->name }}</p>
    <p><strong>Description:</strong> {{ $product->desc }}</p>

    <p><strong>Image:</strong><br>
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" style="max-width:200px; border-radius:5px;">
        @else
            <p class="text-muted">No image available.</p>
        @endif
    </p>

    <p><strong>Price:</strong> {{ number_format($product->price, 2) }} EGP</p>
    <p><strong>Quantity:</strong> {{ $product->quantity }}</p>

    <br>
    <a class="btn btn-info" href="{{ route('editProduct', $product->id) }}">Edit Product</a>

    <br>
    <form action="{{ url("products/delete/$product->id") }}" method="post" class="mt-2">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>

    <br>
    <a href="{{ route('allProducts') }}" class="btn btn-primary">Back to List</a>

    <hr>

    {{-- عرض الريفيوهات --}}
    <h3>Product Reviews ({{ $product->reviews->count() }})</h3>
    @if ($product->reviews->count())
        @foreach ($product->reviews as $review)
            <div class="card mb-3">
                <div class="card-body">
                    <strong>User:</strong> {{ $review->user->name ?? 'Guest' }} <br>
                    <strong>Rating:</strong>
                    @for ($i = 1; $i <= $review->rating; $i++)
                        <i class="fa fa-star text-warning"></i>
                    @endfor
                    @for ($i = $review->rating + 1; $i <= 5; $i++)
                        <i class="fa fa-star text-secondary"></i>
                    @endfor
                    <br>
                    <strong>Comment:</strong> {{ $review->comment }}
                    <br>
                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-muted">No reviews for this product yet.</p>
    @endif
@endsection
