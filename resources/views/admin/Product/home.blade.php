@extends('admin.layout')

@section('body')
    <table class="table">
        <thead>

            <tr>
                <th>id</th>
                <th>name</th>
                <th>desc</th>
                <th>image</th>
                <th>price</th>
                <th>quantity</th>
                <th>CategoryName</th>



            </tr>

        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>{{ $product->name }}</td>
                    <td class="text-right"> {{ $product->desc }} </td>
                    <td class="text-right font-weight-medium">

                        <img src="{{ asset('storage/' . $product->image) }}" alt="">

                    </td>
                    <td class="text-right font-weight-medium"> {{ $product->price }} </td>
                    <td class="text-right font-weight-medium"> {{ $product->quantity }} </td>

                    {{-- //add link in category  --}}
                    <td class="text-right font-weight-medium"> {{ $product->category->name }} </td>

                    <td> <a class="nav-link btn  btn-success create-new-button"
                            href="{{ route('showProduct', $product->id) }}">Show</a></td>

                   <td> <a class="btn btn-info" href="{{ route('editProduct', $product->id) }}">Edite Product</a> </td>


                  <td>   <form action="{{ url("products/delete/$product->id") }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">delete</button>
                    </form> </td>



                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}

    <a class="nav-link btn w-10 btn-success create-new-button" href="{{ route('createProduct') }}">+ New Product</a>
@endsection
