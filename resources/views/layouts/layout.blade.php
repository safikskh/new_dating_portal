<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="57x57" href="img/fav/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/fav/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/fav/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/fav/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/fav/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/fav/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/fav/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/fav/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/fav/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="img/fav/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/fav/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/fav/favicon-16x16.png">
    
    <link rel="apple-touch-icon" sizes="57x57" href="img/fav/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/fav/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/fav/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/fav/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/fav/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/fav/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/fav/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/fav/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/fav/apple-icon-180x180.png">
    
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('/img/fav/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/img/fav/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/img/fav/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/img/fav/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ asset('img/fav/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/fav/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.css" />

    <link rel="stylesheet" href="{{ asset('css/material-design-iconic-font.min.css')}}"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link rel="stylesheet" href="https://sachinchoolur.github.io/lightGallery/lightgallery/css/lightgallery.css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/material-design-iconic-font.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/emoji.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/profile.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-grid.min.css')}}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboardslider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tagsinput.css')}}" />
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/qki6kic.css"> 
    @yield('style')
    <script>
      // "fix" to prevent pusher error on reload
      window.Pusher = undefined;
    </script>
    <title>Datingportalen @yield('pageTitle')</title>
</head>

<body id="renum-menu" class="body
@if(auth()->check())
  @if((Auth::user()->getportal(Auth::user()->portalJoinUser_id)) == 1)
        date-body-background
@elseif((Auth::user()->getportal(Auth::user()->portalJoinUser_id)) == 2)
        sugar-body-background
@elseif((Auth::user()->getportal(Auth::user()->portalJoinUser_id)) == 3)
        fræk-body-background
@elseif((Auth::user()->getportal(Auth::user()->portalJoinUser_id)) == 4)
        Affære-body-background
@elseif((Auth::user()->getportal(Auth::user()->portalJoinUser_id)) == 5)
        senior-body-background
@elseif((Auth::user()->getportal(Auth::user()->portalJoinUser_id)) == 6)
        regnbue-body-background
@endif
@else
date-body-background
@endif
        ">
    <header class="main-header-mobile">
        <div class="left-mobile-header">
            <div class="content"><a href="{{url('chat')}}">
            <img src="{{asset('img/header/user.png')}}" alt="alt"/>
        </a></div>
        </div>
        <div class="mdl-mobile-header">
            <div class="content"><a href="{{url('home')}}">
            <img src="{{asset('img/header/logo.png')}}" alt="alt"/>
        </a></div>
        </div>
        <div class="right-mobile-header">
            <div class="content"><a onclick="tamMenu()" href="javascript:void(0)">
            <img src="{{asset('img/header/bar.png')}}" alt="alt"/>
        </a>
            </div>
        </div>
    </header>
    <p class="responsive-gap-menu" style="margin-bottom: 0">
    </p>
    <div id="app" class="main-body">
        @include('layouts.navbar')
        <section class="main-content-area" >
            <div class="container-fluid" >
                    {{-- @if ($message = Session::get('successs'))
                    <div class="alert alert-success" role="alert">
                        <p>
                            <strong>Success! </strong>{{ $message }}
                        </p>
                    </div>
                    @endif 
                    @foreach ($errors->all() as $error) 
                        <div class="alert alert-danger">
                        <p> {!! $error !!} </p>
                        </div>
                    @endforeach --}}
                    @yield('content')
                </div>
                @include('layouts.sidebar')
        </section>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
    <script src="{{asset('js/rotate.js')}}"></script>
    {{-- <script src="{{asset('js/jquery.scrollify.js')}}"></script> --}}
    <script src="{{asset('js/onloadModal.js')}}"></script>
    <script src="{{asset('js/swiper.min.js')}}"></script>    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/bootstrap-select.js')}}"></script>    
    <script src="{{asset('js/image-crop-jquery.js')}}"></script>
    <script src="{{asset('js/notificationmenue.js')}}"></script>    
    <script src="{{asset('js/image-crop-croppie.js')}}"></script>
    <script src="{{asset('js/tagsinput.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://dimsemenov.com/plugins/magnific-popup/dist/jquery.magnific-popup.min.js?v=1.1.0"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
    crossorigin="anonymous"></script>
    <script src="{{ asset('js/image-crop.js')}}"></script>
    <script src="{{asset('js/timepicker.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>    
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('js/main.js')}}"></script>
    <script src="{{asset('js/promotion-slider.js')}}"></script>
    <script src="{{asset('js/customInputFile.js')}}"></script>
    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    @yield('script')
</body>

</html>