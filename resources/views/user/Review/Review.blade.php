@extends('user.product.layout')

@section('content')
<div class="container">
    <h2 class="mb-4">All Reviews</h2>

    @foreach ($reviews as $review)
        <div class="card mb-4">
            <div class="card-body">

                {{-- بيانات المنتج --}}
                <div class="row">
                    <div class="col-md-3">
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

                    <div class="col-md-9">
                        <h4>{{ $review->product->name ?? 'Unknown Product' }}</h4>
                        <p>{{ $review->product->description ?? 'No description available.' }}</p>
                        <p><strong>Price:</strong> ${{ $review->product->price ?? 'N/A' }}</p>

                        {{-- بيانات المراجعة --}}
                        <p class="mb-1">
                            <strong>Reviewed by:</strong> {{ $review->user->name ?? 'Guest' }}
                        </p>
                        <p class="mb-1">
                            <strong>Rating:</strong>
                            @for ($i = 1; $i <= $review->rating; $i++)
                                <span style="color:red;">&#9733;</span>
                            @endfor
                        </p>
                        <p>{{ $review->comment }}</p>
                        <small class="text-muted">
                            {{ $review->created_at->format('Y-m-d H:i') }}
                            ({{ $review->created_at->diffForHumans() }})
                        </small>

                        {{-- زر عرض الريفيو --}}
                        <div class="mt-2">
                            <a href="{{ route('showReview', $review->id) }}" class="btn btn-sm btn-primary">
                                View Review
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endforeach

    {{-- روابط الصفحات --}}
    {{ $reviews->links() }}
</div>
@endsection
