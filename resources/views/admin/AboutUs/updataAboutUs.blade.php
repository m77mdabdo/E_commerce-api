@extends('admin.layout')

@section('body')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Update About Us</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('updateAboutUs', $aboutUs->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- أو PATCH --}}

                <div class="mb-3">
                    <label for="name" class="form-label"><strong>Name</strong></label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', $aboutUs->name) }}" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label"><strong>Description</strong></label>
                    <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description', $aboutUs->description) }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Current Image</strong></label><br>
                    <img src="{{ asset('uploads/aboutus/' . $aboutUs->image) }}" alt="Current Image" style="max-width: 200px; border-radius: 6px;">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label"><strong>Change Image</strong></label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="facebook" class="form-label"><strong>Facebook URL</strong></label>
                    <input type="url" name="facebook" id="facebook" class="form-control"
                        value="{{ old('facebook', $aboutUs->facebook) }}">
                    @error('facebook')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="instagram" class="form-label"><strong>Instagram URL</strong></label>
                    <input type="url" name="instagram" id="instagram" class="form-control"
                        value="{{ old('instagram', $aboutUs->instagram) }}">
                    @error('instagram')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="whatsapp" class="form-label"><strong>WhatsApp Number</strong></label>
                    <input type="text" name="whatsapp" id="whatsapp" class="form-control"
                        value="{{ old('whatsapp', $aboutUs->whatsapp) }}">
                    @error('whatsapp')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('showAboutUs', $aboutUs->id) }}" class="btn btn-secondary ms-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
