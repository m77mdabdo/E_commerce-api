@extends('admin.layout')

@section('body')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card shadow-lg rounded">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Create New Product</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('updateProduct',$product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    @method('put')
                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label"><i class="mdi mdi-tag-outline"></i> Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" value="{{ $product->name}}">
                        @error('name') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label"><i class="mdi mdi-text"></i> Description</label>
                        <textarea class="form-control" id="description" name="desc"  rows="3" placeholder="Enter description">{{ $product->desc }}</textarea>
                        @error('desc') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Image --}}
                    <div class="mb-3">
                        <label for="image" class="form-label"><i class="mdi mdi-image"></i> Image</label>
                        <input type="file" class="form-control" id="image" name="image" value="{{ $product->image}}" >
                        @error('image') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Price --}}
                    <div class="mb-3">
                        <label for="price" class="form-label"><i class="mdi mdi-cash"></i> Price</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" step="0.01" value="{{ $product->price }}">
                        @error('price') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Quantity --}}
                    <div class="mb-3">
                        <label for="quantity" class="form-label"><i class="mdi mdi-cube"></i> Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity" value="{{$product->quantity  }}">
                        @error('quantity') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Category --}}
                    <div class="mb-3">
                        <label for="category_id" class="form-label"><i class="mdi mdi-tag-outline"></i> Category</label>
                        <select class="form-select" id="category_id" name="category_id" value="{{ $product->category->name }}">
                            <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-success w-100">
                        <i class="mdi mdi-content-save"></i> Save Product
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
