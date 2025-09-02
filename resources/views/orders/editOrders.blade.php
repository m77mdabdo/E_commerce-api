@extends('admin.layout')

@section('body')
<h2>Edit Order #{{ $order->id }}</h2>

<form action="{{ route('updateOrder', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Name:</label>
        <input type="text" name="name" value="{{ old('name', $order->user->name) }}">
    </div>

    <div>
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email', $order->user->email) }}">
    </div>

    <div>
        <label>Phone:</label>
        <input type="text" name="phone" value="{{ old('phone', $order->user->phone) }}">
    </div>

    <hr>
    <h3>Current Products</h3>
    @foreach ($order->orderDetails as $detail)
        <div>
            <strong>{{ $detail->product->name }}</strong>
            <input type="number" name="orderDetails[{{ $detail->id }}][quantity]"
                   value="{{ $detail->quantity }}" min="1">
        </div>
    @endforeach

    <hr>
    <h3>Add New Products</h3>
    <div id="new-products">
        <div class="new-product-row">
            <select name="new_products[0][product_id]">
                <option value="">-- Select Product --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} - {{ $product->price }} EGP</option>
                @endforeach
            </select>
            <input type="number" name="new_products[0][quantity]" min="1" placeholder="Quantity">
        </div>
    </div>
    <button type="button" onclick="addProductRow()">+ Add Another Product</button>

    <br><br>
    <button type="submit" class="btn btn-success" >Save Changes</button>
</form>

<script>
let productIndex = 1;
function addProductRow() {
    const container = document.getElementById('new-products');
    const row = document.createElement('div');
    row.classList.add('new-product-row');
    row.innerHTML = `
        <select name="new_products[${productIndex}][product_id]">
            <option value="">-- Select Product --</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }} - {{ $product->price }} EGP</option>
            @endforeach
        </select>
        <input type="number" name="new_products[${productIndex}][quantity]" min="1" placeholder="Quantity">
    `;
    container.appendChild(row);
    productIndex++;
}
</script>
@endsection
