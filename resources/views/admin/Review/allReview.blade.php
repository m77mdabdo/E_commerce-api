@extends('admin.layout')

@section('body')
    <h2>Reviews</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Product</th>
                <th>Rating</th>
                <th>Comment</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reviews as $review)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $review->user->name ?? 'Guest' }}</td>
                    <td>{{ $review->product->name ?? 'N/A' }}</td>
                    <td>
                        <span class="text-warning">
                            @for ($i = 1; $i <= $review->rating; $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                        </span>
                    </td>
                    <td>{{ Str::limit($review->comment, 50) }}</td>
                    <td>{{ $review->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a class="btn btn-success" href="{{ route('showReviewAdmin', $review->id) }}">Show</a>
                        <a class="btn btn-info" href="{{ route('editReviewAdmin', $review->id) }}">Edit</a>
                        <form action="{{ route('deleteReviewAdmin', $review->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No reviews found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $reviews->links() }}
@endsection
