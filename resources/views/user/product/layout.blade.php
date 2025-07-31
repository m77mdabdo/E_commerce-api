
@include('user.app.heder')

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->

    @include('user.app.navbar')

    <!-- Page Content -->
    <!-- Banner Starts Here -->

     <br>

      @yield('content')
      






    @include('user.app.foter')
