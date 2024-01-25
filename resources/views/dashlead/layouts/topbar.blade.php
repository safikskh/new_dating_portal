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

                            @if(session('isProfileComplete'))
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
                            @endif
                            <!-- Inbox Tab -->
                                @if(auth()->check())

                                    @php
                                        $ninboxcount = auth()->user()->inboxUnreadNotifications()->count();
                                        $finboxcount = auth()->user()->favoriteUnreadNotifications()->count();
                                        $totalinbox = $ninboxcount+$finboxcount;
                                    @endphp
                                    @if(session('isProfileComplete') == 1)
                                    <div class="dropdown main-header-notification">
                                        <a class="nav-link icon" href="#">
                                            <i class="fe fe-mail" style="color:white;"></i>
                                            @if($totalinbox > 0) <span class="pulse bg-danger"></span> @endif
                                        </a>
                                        <div class="dropdown-menu">
                                            <div class="header-navheading">
                                                <div aria-multiselectable="true" class="accordion" id="accordion" role="tablist">
                                                    <div class="card">
                                                        <div class="card-header" id="headingOne" role="tab">
                                                            <a aria-controls="collapseOne" aria-expanded="false" data-toggle="collapse" href="#collapseOne">Beskeder ({{$ninboxcount}})</a>
                                                        </div>
                                                        <div aria-labelledby="headingOne" class="collapse" data-parent="#accordion" id="collapseOne" role="tabpanel">
                                                            <div class="card-body" style="text-align:left;">
                                                                @if($ninboxcount > 0)
                                                                    <div class="main-notification-list" style="padding-bottom:10px">
                                                                        @foreach(auth()->user()->inboxUnreadNotifications() as $normsg)
                                                                            <a href="{{ route('read.messageshome', ['type'=>'normsg','id'=>$normsg->data['user']['id']]) }}">
                                                                                <div class="media new">
                                                                                    <div class="main-img-user online"><img alt="avatar" src="{{asset($normsg->data['user']['portalInfo']['profilePicture'])}}"></div>
                                                                                    <div class="media-body">
                                                                                        <p>{{$normsg->data['thread']['detail']}}</p>
                                                                                        <span>{{ $normsg->data['user']['portalInfo']['userName'] }} @ {{$normsg->updated_at}}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        @endforeach
                                                                    </div>
                                                                @else
                                                                    <div style="text-align: center;">
                                                                        <h6 style="color:red;">Ingen Tilgængelig Data</h6>
                                                                    </div>
                                                                @endif
                                                                <div style="text-align: center;">
                                                                    <a class="btn btn-dark btn-sm" href="/chat" style="font-size:10px; text-transform: uppercase; font-weight: bold;" >
                                                                        Se Alle Chat
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" id="headingTwo" role="tab">
                                                            <a aria-controls="collapseTwo" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapseTwo">Favorit Beskeder ({{$finboxcount}})</a>
                                                        </div>
                                                        <div aria-labelledby="headingTwo" class="collapse" data-parent="#accordion" id="collapseTwo" role="tabpanel">
                                                            <div class="card-body" style="text-align:left;">
                                                                @if($finboxcount > 0)
                                                                    <div class="main-notification-list" style="padding-bottom:10px">
                                                                        @foreach(auth()->user()->favoriteUnreadNotifications() as $favmsg)
                                                                            <a href="{{ route('read.messageshome', ['type'=>'favmsg','id'=>$favmsg->data['user']['id']]) }}">
                                                                                <div class="media new">
                                                                                    <div class="main-img-user online"><img alt="avatar" src="{{asset($favmsg->data['user']['portalInfo']['profilePicture'])}}"></div>
                                                                                    <div class="media-body">
                                                                                        <p>{{$favmsg->data['thread']['detail']}}</p>
                                                                                        <span>{{ $favmsg->data['user']['portalInfo']['userName'] }} @ {{$favmsg->updated_at}}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        @endforeach
                                                                    </div>
                                                                @else
                                                                    <div style="text-align: center;">
                                                                        <h6 style="color:red;">Ingen Tilgængelig Data</h6>
                                                                    </div>
                                                                @endif
                                                                <div style="text-align: center;">
                                                                    <a class="btn btn-dark btn-sm" href="/favchat" style="font-size:10px; text-transform: uppercase; font-weight: bold;" >
                                                                        Se Alle Favorit Chat
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endif

                            <!-- ./Inbox Tab -->

                            <!-- Notification Tab -->
                                {{-- @if(auth()->check())
                                    <div class="dropdown main-header-notification">
                                        <a class="nav-link icon" href="#">
                                            <i class="fe fe-bell" style="color:white;"></i>
                                            <span class="pulse bg-danger"></span>
                                        </a>
                                        <notification :userid="{{auth()->id()}}" :othersunreads="{{auth()->user()->othersUnreadNotifications()}}"></notification>
                                    </div>
                                @endif --}}
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
                                        @if(session('isProfileComplete') == 1)
                                        <a class="dropdown-item border-top" href="{{url('profile')}}" style="font-weight: bold;">
                                            <i class="fe fe-user"></i> Vis Min Profil
                                        </a>
                                        @endif
                                        <a class="dropdown-item" data-target="#profile_edit_model" data-toggle="modal" data-effect="effect-sign" href="#" style="font-weight: bold;">
                                            <i class="fe fe-edit"></i> Rediger Profil
                                        </a>
                                        @if(session('isProfileComplete') == 1)
                                        <a class="dropdown-item" data-target="#change_password_model" data-toggle="modal" href="#" style="font-weight: bold;">
                                            <i class="fe fe-lock"></i> Ændre Adgangskode
                                        </a>
                                        <a class="dropdown-item" data-target="#membership_model" data-toggle="modal" href="#" style="font-weight: bold;">
                                            <i class="fa fa-cubes"></i> Medlemskaber
                                        </a>
                                        <a class="dropdown-item" href="{{url('profileprivacy')}}" style="font-weight: bold;">
                                            <i class="fe fe-settings"></i> Indstillinger
                                        </a>
                                        @if( (auth()->check()) && (auth()->user()->isPaid()) )
                                        <a class="dropdown-item" data-target="#upload_image_model" data-toggle="modal" href="#" style="font-weight: bold;">
                                            <i class="fas fa-images"></i> Upload Billede
                                        </a>
                                        <a class="dropdown-item" data-target="#upload_video_model" data-toggle="modal" href="#" style="font-weight: bold;">
                                            <i class="fas fa-film"></i> Upload Video
                                        </a>
                                        @endif
                                        <a class="dropdown-item" href="{{ url('blockList')}}" style="font-weight: bold;">
                                            <i class="fa fa-ban"></i> Blokerede Profiler
                                        </a>
                                        @endif
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
