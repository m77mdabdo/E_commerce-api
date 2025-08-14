@extends('admin.layout')

@section('bady')
<div class="container py-5">
    <h2>Edit Review</h2>

    <form action="{{ route('updateReview', $review->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="product_id">Product</label>
            <select name="product_id" class="form-control">
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $product->id == $review->product_id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

        <div class="mb-3">
            <label for="rating">Rating</label>
            <select name="rating" class="form-control">
                @for($i=1; $i<=5; $i++)
                    <option value="{{ $i }}" {{ $i == $review->rating ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="comment">Comment</label>
            <textarea name="comment" class="form-control" rows="4">{{ $review->comment }}</textarea>
        </div>

        <button class="btn btn-primary" style="background:#ff0000; border:none;">Update</button>
    </form>
</div>
@endsection
