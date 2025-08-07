@extends('admin.layout')

@section('body')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">About Us Details</h4>
        </div>
        <div class="card-body">
            @if($aboutUs)
                <div class="row align-items-center">
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        <img src="{{ asset('storage/' . $aboutUs->image) }}" alt="{{ $aboutUs->name }}">
                    </div>
                    <div class="col-md-8">
                        <h5 class="mb-3"><strong>Name:</strong> {{ $aboutUs->name }}</h5>
                        <p class="text-justify"><strong>Description:</strong> {{ $aboutUs->description }}</p>

                        <div class="mt-4">
                            <h6>Contact Links:</h6>
                            <ul class="list-unstyled">
                                @if($aboutUs->facebook)
                                <li>
                                    <i class="mdi mdi-facebook-box-outline"></i>
                                    <a href="{{ $aboutUs->facebook }}" target="_blank" rel="noopener noreferrer">
                                        Facebook Profile
                                    </a>
                                </li>
                                @endif
                                @if($aboutUs->instagram)
                                <li>
                                    <i class="mdi mdi-instagram"></i>
                                    <a href="{{ $aboutUs->instagram }}" target="_blank" rel="noopener noreferrer">
                                        Instagram Profile
                                    </a>
                                </li>
                                @endif
                                @if($aboutUs->whatsapp)
                                <li>
                                    <i class="mdi mdi-whatsapp"></i>
                                    <a href="https://wa.me/{{ $aboutUs->whatsapp }}" target="_blank" rel="noopener noreferrer">
                                        WhatsApp Chat
                                    </a>
                                </li>
                                @endif
                            </ul>
                             <a class="btn btn-info" href="{{ route('editAboutUs', $aboutUs->id) }}">Edite Product</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-warning text-center" role="alert">
                    No About Us information available.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
