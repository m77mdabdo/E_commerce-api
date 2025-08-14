@extends('user.product.layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Review Details</h2>

    <div class="card">
        <div class="card-body">
            <div class="row">

                {{-- صورة المنتج --}}
                <div class="col-md-4">
                    @if($review->product->image ?? false)
                        <img src="{{ asset('storage/' . $review->product->image) }}"
                             alt="{{ $review->product->name }}"
                             class="img-fluid rounded">
                    @else
                        <img src="{{ asset('images/no-image.png') }}"
                             alt="No Image"
                             class="img-fluid rounded">
                    @endif
                </div>

                {{-- بيانات المنتج والمراجعة --}}
                <div class="col-md-8">
                    <h4>{{ $review->product->name ?? 'Unknown Product' }}</h4>
                    <p>{{ $review->product->description ?? 'No description available.' }}</p>
                    <p><strong>Price:</strong> ${{ $review->product->price ?? 'N/A' }}</p>

                    <hr>

                    <p><strong>User:</strong> {{ $review->user->name ?? 'Guest' }}</p>
                    <p><strong>Rating:</strong>
                        @for ($i = 1; $i <= $review->rating; $i++)
                            <span style="color:red;">&#9733;</span>
                        @endfor
                    </p>
                    <p><strong>Comment:</strong> {{ $review->comment }}</p>
                    <small class="text-muted">
                        {{ $review->created_at->format('Y-m-d H:i') }}
                        ({{ $review->created_at->diffForHumans() }})
                    </small>
                </div>

            </div>
        </div>
    </div>

    <a href="{{ route('allReviews') }}" class="btn btn-secondary mt-3">Back to All Reviews</a>
</div>
@endsection
