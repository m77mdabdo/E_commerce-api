@extends('admin.layout')

@section('body')

<table class="table">
    <thead>

        <tr>
            <th>id</th>
            <th>name</th>
            <th>desc</th>
            <th>image</th>





        </tr>

    </thead>
    <tbody>
        @foreach ($categories as $category )


            <tr>
        <td>
        {{ $loop->iteration }}
        </td>
        <td>{{ $category->name }}</td>
        <td class="text-right"> {{ $category->desc }} </td>
        <td class="text-right font-weight-medium">

            <img src="{{ asset('storage/' .$category->image) }}" alt="">

        </td>
        {{-- <td class="text-right font-weight-medium"> {{ $category->status }} </td> --}}







         <td>  <a class="nav-link btn w-50 btn-success create-new-button" href="{{ route('showCategory',$category->id) }}">Show</a></td>

            </tr>

      @endforeach
    </tbody>
  </table>
  {{ $categories->links() }}

  <a class="nav-link btn w-10 btn-success create-new-button" href="{{ route('createCategory') }}">+ New Category</a>

@endsection
