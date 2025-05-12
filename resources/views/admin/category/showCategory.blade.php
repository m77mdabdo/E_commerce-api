@extends('admin.layout')

@section('body')

@if(session()->has("success"))
<alert class="alert success">{{ session()->get("success") }}</alert> <br>

@endif

<p><strong>Category Name:</strong> {{ $category->name ?? 'No Category' }}</p>


<p><strong>Description:</strong> {{$category->desc }}</p>

<p><strong>Image:</strong><br>
    <img src="{{ asset("storage/categories/$category->image") }}" alt="">

</p>


<p><strong>status:</strong> {{$category->status }}</p>


Products : <br>
@foreach ($category->products as $product)
{{ $loop->iteration  }} - <a href="{{ route("showProduct",$product->id) }}"> {{$product->name }} </a> <br>



  @endforeach
  <br>
<a class="btn btn-info" href="{{ route("editeCategory",$category->id) }}">Edite Category</a>

<br>
<form action="{{ url("categories/delete/$category->id") }}" method="POST">
    @csrf
    @method("DELETE")
    <button type="submit" class="btn btn-danger">delete</button>

    </form>



@endsection
