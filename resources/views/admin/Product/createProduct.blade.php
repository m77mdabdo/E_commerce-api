@extends('admin.layout')

@section('body')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card shadow-lg rounded">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Create New Product</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('storeProduct') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Name of error --}}
                    @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror

                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="mdi mdi-tag-outline"></i> Name
                        </label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name">
                    </div>

                    @error('desc')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror

                    {{-- Description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <i class="mdi mdi-text"></i> Description
                        </label>
                        <textarea class="form-control" id="description" name="desc" rows="3" placeholder="Enter description"></textarea>
                    </div>

                    @error('image')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror

                    {{-- Image --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">
                            <i class="mdi mdi-image"></i> Image
                        </label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>

                    {{-- Price --}}
                    <div class="mb-3">
                        <label for="price" class="form-label">
                            <i class="mdi mdi-cash"></i> Price
                        </label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" step="0.01">
                    </div>

                    {{-- Quantity --}}
                    <div class="mb-3">
                        <label for="quantity" class="form-label">
                            <i class="mdi mdi-cube"></i> Quantity
                        </label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity">
                    </div>

                    {{-- Category --}}
                    <div class="mb-3">
                        <label for="category_id" class="form-label">
                            <i class="mdi mdi-tag-outline"></i> Category
                        </label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option value="" disabled selected>Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
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
