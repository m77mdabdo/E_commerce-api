@extends('admin.layout')

@section('body')
<div class="card shadow p-4">
    <h2 class="mb-4">User Details</h2>

    <div class="row">
      
        <div class="col-md-4 text-center">
            @if ($user->image)
                <img src="{{ asset('storage/' . $user->image) }}"
                     alt="{{ $user->name }}"
                     class="img-fluid rounded"
                     style="max-width: 250px; height: auto; object-fit: cover;">
            @else
                <p class="text-muted">No image available</p>
            @endif
        </div>


        <div class="col-md-8">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
            <p>
                <strong>Role:</strong>
                @if ($user->role === 'admin')
                    <span class="badge bg-success">Admin</span>
                @else
                    <span class="badge bg-secondary">User</span>
                @endif
            </p>
        </div>
    </div>

    <hr>


    <div class="d-flex gap-2">
        <a href="{{ route('editUser', $user->id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ url("users/delete/$user->id") }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this user?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>

        <a href="{{ route('allUsers') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
