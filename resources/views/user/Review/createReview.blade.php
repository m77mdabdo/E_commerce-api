@extends('user.product.layout')

@section('content')
<div class="container">

    {{-- عرض تفاصيل المنتج --}}
    <div class="card mb-4">
        <div class="card-body">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->description }}</p>
            <p><strong>Price:</strong> ${{ $product->price }}</p>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 200px;">
            @endif
        </div>
    </div>

    {{-- عنوان --}}
    <h2>Add Review for {{ $product->name }}</h2>

    {{-- الفورم --}}
    <form action="{{ route('storeReview') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        {{-- اختيار النجوم --}}
        <div class="mb-3">
            <label class="form-label">Rating</label>
            <div class="star-rating">
                @for ($i = 5; $i >= 1; $i--)
                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required/>
                    <label for="star{{ $i }}" title="{{ $i }} stars">&#9733;</label>
                @endfor
            </div>
        </div>

        {{-- التعليق --}}
        <div class="mb-3">
            <label for="comment" class="form-label">Comment</label>
            <textarea name="comment" id="comment" rows="4" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-danger">Submit Review</button>
    </form>
</div>

{{-- CSS للنجوم الحمراء --}}
<style>
.star-rating {
    direction: rtl;
    display: inline-flex;
}
.star-rating input {
    display: none;
}
.star-rating label {
    font-size: 2rem;
    color: #ccc;
    cursor: pointer;
    transition: color 0.2s;
}
.star-rating input:checked ~ label,
.star-rating label:hover,
.star-rating label:hover ~ label {
    color: red;
}
</style>
@endsection
