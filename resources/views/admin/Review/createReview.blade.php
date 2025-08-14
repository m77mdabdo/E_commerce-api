@extends('admin.layout')

@section('bady')
<div class="container py-5">
    <h2>Add Review</h2>

    <form action="{{ route('storeReview') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="product_id">Product</label>
            <select name="product_id" class="form-control">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

        <div class="mb-3">
            <label for="rating">Rating</label>
            <select name="rating" class="form-control">
                @for($i=1; $i<=5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="comment">Comment</label>
            <textarea name="comment" class="form-control" rows="4"></textarea>
        </div>

        <button class="btn btn-primary" style="background:#ff0000; border:none;">Submit</button>
    </form>
</div>
@endsection
