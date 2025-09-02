@extends('admin.layout')

@section('body')
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif

    <div class="card shadow-lg border-0 mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Order #{{ $order->id }}</h4>
        </div>
        <div class="card-body bg-dark text-light">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h6 class="fw-bold">Customer Info</h6>
                    <p><strong>Name:</strong> {{ $order->user->name ?? 'Guest' }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email ?? 'Guest' }}</p>
                    <p><strong>Phone:</strong> {{ $order->user->phone ?? 'No phone' }}</p>
                    <p><strong>Address:</strong> {{ $order->address ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold">Order Info</h6>
                    <p><strong>Full Name:</strong> {{ $order->full_name ?? 'N/A' }}</p>
                    <p><strong>Note:</strong> {{ $order->note ?? 'None' }}</p>
                    <p><strong>Total Price:</strong>
                        <span class="badge bg-success fs-6">{{ $order->orderDetails->sum('price') }} EGP</span>
                    </p>
                </div>
            </div>

            <hr class="border-secondary">

            <h6 class="fw-bold">Products</h6>
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderDetails as $detail)
                            <tr>
                                <td>{{ $detail->product->name ?? 'N/A' }}</td>
                                <td>{{ $detail->quantity ?? '0' }}</td>
                                <td>
                                    @if ($detail->product && $detail->product->image)
                                        <img src="{{ asset('storage/' . $detail->product->image) }}"
                                            class="rounded shadow-sm"
                                            width="60" style="cursor:pointer"
                                            onclick="openFullImage('{{ asset('storage/' . $detail->product->image) }}')">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <a class="btn btn-purple text-white" href="{{ route('editOrder', $order->id) }}">Edit Order</a>

                <form action="{{ url("orders/delete/$order->id") }}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                </form>

                <a href="{{ route('allOrders') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>

    <!-- Modal for full image -->
    <div id="imageModal"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
        background:rgba(0,0,0,0.9); justify-content:center; align-items:center;">
        <span onclick="closeFullImage()"
            style="position:absolute; top:20px; right:30px; font-size:30px; color:white; cursor:pointer;">&times;</span>
        <img id="fullImage" src="" style="max-width:90%; max-height:90%;">
    </div>

    <script>
        function openFullImage(src) {
            document.getElementById('imageModal').style.display = 'flex';
            document.getElementById('fullImage').src = src;
        }
        function closeFullImage() {
            document.getElementById('imageModal').style.display = 'none';
        }
    </script>
@endsection
