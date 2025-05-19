@extends('admin.layout')

@section('body')

@if(session()->has("success"))
<alert class="alert success">{{ session()->get("success") }}</alert> <br>

@endif
<strong>Category Name:</strong>
<p><a href="{{ route('showCategory',$product->category->id) }}"> {{ $product->category->name ?? 'No Category' }}</a></p>

<p><strong>Name:</strong> {{ $product->name }}</p>
<p><strong>Description:</strong> {{ $product->desc }}</p>

<p><strong>Image:</strong><br>
   <img src="{{ asset('storage/' . $product->image) }}"
        alt="{{ $product->name }}"
        width="200">
</p>

<p><strong>Price:</strong> {{ number_format($product->price, 2) }} EGP</p>
<p><strong>Quantity:</strong> {{ $product->quantity }}</p>

<br>
<a class="btn btn-info" href="{{ route("editProduct",$product->id) }}">Edite Product</a>

<br>
<form action="{{ url("products/delete/$product->id")}}" method="post">
    @csrf
    @method("DELETE")
    <button type="submit" class="btn btn-danger">delete</button>
</form>

<br>
<a href="{{ route('allProducts') }}" class="btn btn-primary">Back to List </a>


@endsection
