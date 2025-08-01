<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        {{-- <a class="sidebar-brand brand-logo" href="index.html"><img src="{{asset("admin/assets")}}/images/logo.svg" alt="logo" /></a> --}}
        <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg"
                alt="logo" /></a>
    </div>
    <ul class="nav">



        {{-- <li class="nav-item menu-items">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-icon">
            <i class="mdi mdi-laptop"></i>
          </span>
          <span class="menu-title">Basic UI Elements</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
          </ul>
        </div>
      </li> --}}




        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-icon">
                    <i class="mdi mdi-security"></i>
                </span>
                <span class="menu-title">Admin</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('allCategory') }}"> @lang('massages.categories')</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('allProducts') }}">@lang('massages.products')</a></li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('/dashboard') }}"> Logout</a></li> --}}
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> </a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#language" aria-expanded="false"
                aria-controls="language">
                <span class="menu-icon">
                    <i class="mdi mdi-translate"></i>
                </span>
                <span class="menu-title">{{__('massages.language')}}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="language">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('change/en')}}">@lang('massages.english')  </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('change/ar')}}"> @lang('massages.arabic') </a>
                    </li>
                </ul>
            </div>
        </li>




        <li class="nav-item menu-items">
            {{-- <a class="nav-link" href="http://www.bootstrapdash.com/demo/corona-free/jquery/documentation/documentation.html">
          <span class="menu-icon">
            <i class="mdi mdi-file-document-box"></i>
          </span>

        </a> --}}
        </li>
    </ul>
</nav>
