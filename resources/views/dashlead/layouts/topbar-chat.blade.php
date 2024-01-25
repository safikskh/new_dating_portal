<!-- Developed By CBS -->
    <!-- Main Header-->
                    <div class="main-header hor-header" style="background:{{$header_bg_color}};">
                        <div class="container">
                            <!-- Left Header -->
                                <div class="main-header-left">

                                    <a class="main-header-menu-icon d-lg-none" href="#" id="mainNavShow"><span></span></a>
                                    <a class="main-logo" href="{{url('home')}}">
                                        <img src="{{ asset('dashlead/img/logo/logo-light.png')}}" class="header-brand-img desktop-logo">
                                        <img src="{{ asset('dashlead/img/logo/icon.png')}}" class="header-brand-img icon-logo" alt="logo">
                                        <img src="{{ asset('dashlead/img/logo/logo-light.png')}}" class="header-brand-img desktop-logo theme-logo" alt="logo">
                                        <img src="{{ asset('dashlead/img/logo/icon.png')}}" class="header-brand-img icon-logo theme-logo" alt="logo">
                                    </a>
                                    
                                </div>
                            <!-- ./Left Header -->

                            <!-- Right Header -->
                                <div class="main-header-right">
                                    <!-- Search Tab -->

                                        <div class="d-md-flex">
                                            <a class="nav-link icon header-search" href="{{route('show.advancesearch')}}">
                                                <i class="fas fa-search" style="color:white;"></i>
                                            </a>
                                        </div>

                                    <!-- ./Search Tab -->

                                    <!-- Full Screen Tab -->
                                        <div class="dropdown d-md-flex">
                                            <a class="nav-link icon full-screen-link">
                                                <i class="fe fe-maximize fullscreen-button" style="color:white;"></i>
                                            </a>
                                        </div>
                                    <!-- ./Full Screen Tab -->

                                    <!-- Inbox Tab -->
                                        @if(auth()->check())
                                            <inbox-notification :user="{{auth()->user()}}" :inboxunreads="{{auth()->user()->inboxUnreadNotifications()}}" :favoriteunreads="{{auth()->user()->favoriteUnreadNotifications()}}"></inbox-notification>
                                        @endif
                                    <!-- ./Inbox Tab -->

                                    <!-- Notification Tab -->
                                        @if(auth()->check())
                                            <notification :userid="{{auth()->id()}}" :inboxunreads="{{auth()->user()->inboxUnreadNotifications()}}" :favoriteunreads="{{auth()->user()->favoriteUnreadNotifications()}}":othersunreads="{{auth()->user()->othersUnreadNotifications()}}"></notification>
                                        @endif
                                    <!-- ./Notification Tab -->

                                    <!-- User Profile Tab -->
                                        <div class="dropdown main-profile-menu">
                                            @if(Auth::user()->portalInfo->sex == 'Par')
                                                <a href="#" class="main-img-user" style="display: inline-block;">
                                                    @if(File::exists(Auth::user()->portalInfo->coupleMale()->profilePicture)) 
                                                        <img src="{{asset(Auth::user()->portalInfo->coupleMale()->profilePicture)}}">
                                                    @else
                                                        <img src="{{ asset('dashlead/img/default/404-dp-sm.png') }}">
                                                    @endif
                                                </a>
                                                <a href="#" class="main-img-user" style="display: inline-block;">
                                                    @if(File::exists(Auth::user()->portalInfo->coupleFemale()->profilePicture)) 
                                                        <img src="{{asset(Auth::user()->portalInfo->coupleFemale()->profilePicture)}}">
                                                    @else
                                                        <img src="{{ asset('dashlead/img/default/404-dp-sm.png') }}">
                                                    @endif
                                                </a>
                                            @else
                                                @if(File::exists(Auth::user()->portalInfo->profilePicture))
                                                    <a class="main-img-user" href="#"><img src="{{asset(Auth::user()->portalInfo->profilePicture)}}"></a>
                                                @else
                                                    <a class="main-img-user" href="#"><img src="{{ asset('dashlead/img/default/404-dp-sm.png') }}"></a>
                                                @endif
                                            @endif
                                            <div class="dropdown-menu">
                                                <div class="header-navheading">
                                                    @if(Auth::user()->portalInfo->sex == 'Par')
                                                        <a href="{{url('profile')}}" style="display: inline-block; padding-bottom:10px;">
                                                            @if(File::exists(Auth::user()->portalInfo->coupleMale()->profilePicture)) 
                                                                <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;" class="rounded-circle avatar-lg margin-bottom: 10px;"  src="{{asset(Auth::user()->portalInfo->coupleMale()->profilePicture)}}">
                                                            @else
                                                                <a href="{{url('profile')}}"><img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;" class="rounded-circle avatar-lg margin-bottom: 10px;" src="{{ asset('dashlead/img/default/404-dp-sm.png') }}"></a>
                                                            @endif
                                                        </a>
                                                        <a href="{{url('profile')}}" style="display: inline-block; padding-bottom:10px;">
                                                            @if(File::exists(Auth::user()->portalInfo->coupleFemale()->profilePicture)) 
                                                                <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;" class="rounded-circle avatar-lg margin-bottom: 10px;"  src="{{asset(Auth::user()->portalInfo->coupleFemale()->profilePicture)}}">
                                                            @else
                                                                <a href="{{url('profile')}}"><img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;" class="rounded-circle avatar-lg margin-bottom: 10px;" src="{{ asset('dashlead/img/default/404-dp-sm.png') }}"></a>
                                                            @endif
                                                        </a>
                                                    @else
                                                        @if(File::exists(Auth::user()->portalInfo->profilePicture))
                                                            <a style="padding-bottom:10px;" href="{{url('profile')}}"><img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;" class="rounded-circle avatar-lg margin-bottom: 10px;" src="{{asset(Auth::user()->portalInfo->profilePicture)}}"></a>
                                                        @else
                                                            <a style="padding-bottom:10px;" href="{{url('profile')}}"><img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;" class="rounded-circle avatar-lg margin-bottom: 10px;" src="{{ asset('dashlead/img/default/404-dp-sm.png') }}"></a>
                                                        @endif
                                                    @endif
                                                    <h6 class="main-notification-title" style="font-weight: bold;">{{ Auth::user()->portalInfo->firstName.' '.Auth::user()->portalInfo->lastName }}</h6>
                                                    <p class="main-notification-text"><span style="font-weight: bold;" class="badge badge-light">{{Auth::user()->portalInfo->regionName}}</span></p>
                                                </div>
                                                <a class="dropdown-item border-top" href="{{url('profile')}}" style="font-weight: bold;">
                                                    <i class="fe fe-user"></i> Vis Min Profil
                                                </a>
                                                <a class="dropdown-item" href="{{url('profileprivacy')}}" style="font-weight: bold;">
                                                    <i class="fe fe-settings"></i> Indstillinger
                                                </a>
                                                <a class="dropdown-item" href="{{ url('blockList')}}" style="font-weight: bold;">
                                                    <i class="fa fa-ban"></i> Blokerede Profiler
                                                </a>

                                                <!-- Logout -->
                                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form2').submit();" style="font-weight: bold;">
                                                        <i class="fe fe-power"></i> {{ __('Logout') }}
                                                    </a>

                                                    <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                                <!-- ./Logout -->
                                            </div>
                                        </div>
                                    <!-- ./User Profile Tab -->
                                </div>
                            <!-- ./Right Header -->
                        </div>
                    </div>
                <!-- End Main Header-->
<!-- Developed By CBS -->