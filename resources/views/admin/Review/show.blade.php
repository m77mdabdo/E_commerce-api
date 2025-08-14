@extends('admin.layout')

@section('body')
<div class="container py-5">
    <h2>Review Details</h2>
    <div class="card">
        <div class="card-body">
            {{-- اسم المستخدم --}}
            <h4>User: {{ $review->user->name }}</h4>

            {{-- بيانات المنتج --}}
            <h5>Product: {{ $review->product->name }}</h5>
            @if($review->product->image)
                <img src="{{ asset('storage/' . $review->product->image) }}"
                     alt="{{ $review->product->name }}"
                     class="img-fluid mb-3"
                     style="max-width: 200px; border-radius: 5px;">
            @endif

            {{-- التقييم --}}
            <p>
                Rating: {{ $review->rating }} / 5
                <br>
                @for($i = 1; $i <= $review->rating; $i++)
                    <i class="fa fa-star text-warning"></i>
                @endfor
                @for($i = $review->rating + 1; $i <= 5; $i++)
                    <i class="fa fa-star text-secondary"></i>
                @endfor
            </p>

            {{-- الكومنت --}}
            <p>Comment: {{ $review->comment }}</p>
        </div>
    </div>

    <a href="{{ route('allReviews') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
