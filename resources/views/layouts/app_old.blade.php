<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="msapplication-TileImage" content="img/fav/ms-icon-144x144.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" sizes="16x16" href="img/fav/favicon-16x16.png">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css')}}" />
</head>
<body>
    <div >
       <nav class="navbar navbar-expand-lg static-top" style="background-color: #db1f00;">
            <div class="container">
                <a class="navbar-brand" href="/">
                  <img style="height: 50px; width: 50px;" class="logo" src="{{asset('img/logo.png')}}" alt="logo">
                </a>
                <div class="nav-mensuss" id="navbarResponsive">
                    <div> 
                        @if(Auth::check())                          
                        <form class="form-inline" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn login-btn">Log ud</button>
                        </form>
                        @else
                            <a href="/" class="btn login-btn">Log på</a>
                        @endif                           
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
   <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    {{-- <script src="{{asset('js/jquery.scrollify.js')}}"></script> --}}
    <script src="{{asset('js/onloadModal.js')}}"></script>
    <script src="{{asset('js/swiper.min.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://dimsemenov.com/plugins/magnific-popup/dist/jquery.magnific-popup.min.js?v=1.1.0"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/image-crop.js')}}"></script>
    <script src="{{asset('js/timepicker.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('js/main.js')}}"></script>
    <script src="{{asset('js/promotion-slider.js')}}"></script>
    <script src="{{asset('js/customInputFile.js')}}"></script>
    <script>
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);
</script>
    @yield('scripts')
</body>
</html>