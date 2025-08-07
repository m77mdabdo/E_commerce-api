@extends('user.product.layout')

@section('content')
    <div class="page-heading products-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>About Us</h4>
                        <h2>{{ $aboutUs->name ?? 'Who We Are' }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="best-features about-features">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Our Background</h2>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="right-image">
                        <img src="{{ asset('storage/' . $aboutUs->image) }}" alt="{{ $aboutUs->name }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="left-content">
                        <h4>{{ $aboutUs->name }}</h4>
                        <p>{{ $aboutUs->description }}</p>

                        <ul class="social-icons">
                            @if($aboutUs->facebook)
                                <li><a href="{{ $aboutUs->facebook }}"><i class="fa fa-facebook"></i></a></li>
                            @endif
                            @if($aboutUs->instagram)
                                <li><a href="{{ $aboutUs->instagram }}"><i class="fa fa-instagram"></i></a></li>
                            @endif
                            @if($aboutUs->whatsapp)
                                <li><a href="https://wa.me/{{ $aboutUs->whatsapp }}"><i class="fa fa-whatsapp"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
