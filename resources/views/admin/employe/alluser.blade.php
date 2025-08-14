@extends('admin.layout')

@section('body')
<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
                <th>Phone</th>
                <th>Role</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->image)
                            <img src="{{ asset('storage/' . $user->image) }}"
                                 alt="User Image"
                                 class="img-thumbnail"
                                 style="width: 60px; height: 60px; object-fit: cover;">
                        @else
                            <span class="text-muted">No image</span>
                        @endif
                    </td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        @if ($user->role === 'admin')
                            <span class="badge bg-success">Admin</span>
                        @else
                            <span class="badge bg-secondary">User</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('showUser', $user->id) }}" class="btn btn-sm btn-primary">Show</a>
                        <a href="{{ route('editUser', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ url("users/delete/$user->id") }}"
                              method="POST"
                              style="display:inline-block;"
                              onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-3">
    {{ $users->links() }}
</div>

<!-- New Product Button -->
<div class="mt-4">
    <a href="{{ route('createUser') }}" class="btn btn-success">+ New User</a>
</div>
@endsection
