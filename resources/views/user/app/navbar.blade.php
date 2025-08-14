<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <h2>Sixteen <em>Clothing</em></h2>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">

                    {{-- Links --}}
                    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('userHome') }}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ourProductsUser') }}">Our Products</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('aboutUs') }}">About Us</a>
                    </li>





                    {{-- Auth Links --}}
                    @guest
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                {{-- <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li> --}}
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>




                                </li>


                            </ul>
                        </li>
                    @endguest

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('userWishList') }}" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="My WishList">

                            <i class="fa fa-bookmark"></i>
                        </a>
                    </li>

                    {{-- Cart --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('userCart') }}" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="My Cart">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('userFav') }}" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="My Favorites">
                            <i class="fa fa-heart"></i>
                        </a>
                    </li>





                </ul>
            </div>
        </div>
    </nav>
</header>
