@extends('admin.layout')

@section('body')
    <h2>Orders</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Product</th>
                <th>Total Price</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->user->name ?? 'Guest' }}</td>

                    <td>
                        <ul>
                            @foreach ($order->orderDetails as $detail)
                                <li>{{ $detail->product->name ?? 'N/A' }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $order->orderDetails->sum('price') }}</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a class="btn btn-success" href="{{ route('showOrder', $order->id) }}">Show</a>
                        <a class="btn btn-info" href="{{ route('editOrder', $order->id) }}">Edit</a>
                        <form action="{{ route('deleteOrder', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
@endsection
