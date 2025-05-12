@extends('admin.layout')

@section('body')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card shadow-lg rounded">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Update Category</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('updateCategory', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Error for Name --}}
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror

                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="mdi mdi-tag-outline"></i> Name
                        </label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" placeholder="Enter category name">
                    </div>

                    {{-- Error for Description --}}
                    @error('desc')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror

                    {{-- Description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <i class="mdi mdi-text"></i> Description
                        </label>
                        <textarea class="form-control" id="description" name="desc" rows="3">{{ $category->desc }}</textarea>
                    </div>

                    {{-- Error for Image --}}
                    @error('image')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror

                    {{-- Current Image --}}
                    <div class="mb-3">
                        <label class="form-label d-block">
                            <strong>Current Image:</strong>
                        </label>
                        <img src="{{ asset('storage/categories/' . $category->image) }}" width="100" class="mb-2" alt="Category Image">
                    </div>

                    {{-- New Image --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">
                            <i class="mdi mdi-image"></i> Upload New Image
                        </label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>

                    {{-- Error for Status --}}
                    @error('status')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror

                    {{-- Status --}}
                    <div class="mb-3">
                        <label for="status" class="form-label">
                            <i class="mdi mdi-toggle-switch"></i> Status
                        </label>
                        <select class="form-select" id="status" name="status">
                            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-success w-100">
                        <i class="mdi mdi-content-save"></i> Update Category
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
