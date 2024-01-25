<div class="right-sidebar-area
@if(auth()->check())
@if((Auth::user()->getCurrentPortalbyAuth()->id) == 1)
date-background
@elseif((Auth::user()->getCurrentPortalbyAuth()->id) == 2)
sugar-background
@elseif((Auth::user()->getCurrentPortalbyAuth()->id) == 3)
fræk-background @elseif((Auth::user()->getCurrentPortalbyAuth()->id) == 4)
Affære-background
@elseif((Auth::user()->getCurrentPortalbyAuth()->id) == 5)
senior-background @elseif((Auth::user()->getCurrentPortalbyAuth()->id) == 6)
regnbue-background
@endif
@else
date-background
@endif
">

    <aside class="full-sidebar-area">
        <div class="logo-area">
            <h4>
                @if(auth()->check())
                {{ Auth::user()->portalType(Auth::user()->portalJoinUser_id) }}
                @else
                Dating
                @endif
            </h4>
            <a href="/home" title="title">
                    <img src="{{ asset('/img/logo.png')}}" alt="alt"/>

            </a>

        </div>
        <ul class="accordion" id="vertical-menu">
            <li><a data-toggle="modal" class="icon-popup-up" href="#skiftPortalModal">Skift portal</a></li>
            @if(auth()->check())
                <inbox-notification :user="{{auth()->user()}}" :inboxunreads="{{auth()->user()->inboxUnreadNotifications()}}"
                :favoriteunreads="{{auth()->user()->favoriteUnreadNotifications()}}"></inbox-notification>
                <notification :userid="{{auth()->id()}}" :inboxunreads="{{auth()->user()->inboxUnreadNotifications()}}"
                :favoriteunreads="{{auth()->user()->favoriteUnreadNotifications()}}"
                :othersunreads="{{auth()->user()->othersUnreadNotifications()}}"></notification>

            @endif
            <li><a href="{{route('show.advancesearch')}}">Søg</a></li>
            <li><a href="{{ url('chat-rooms')}}">Chatrum</a></li>
            <li>
                <div class="vertical-menu-link"><span><i class="zmdi zmdi-plus"></i><i
                                class="zmdi zmdi-minus"></i></span>
                    <p class="nav-link2">Community</p>
                </div>
                <ul class="vertical-menu-sub">
                    <li class="group-li-item">
                        @if(auth()->check() && sizeof(App\Models\Groups::getTotalRequest(Auth::user()->id)) >0)
                        <a class="notify-group" href="#notification-popup">{{sizeof(App\Models\Groups::getTotalRequest(Auth::user()->id))}}</a>
                        @endif
                        <a href="{{route('groups')}}">Grupper</a>
                    </li>

                    <li><a href="{{route('blogs')}}">Blogs</a></li>
                    <li><a href="{{route('events')}}">Events</a></li>
                </ul>
            </li>
            <li>
                <div class="vertical-menu-link"><span><i class="zmdi zmdi-plus"></i><i
                                class="zmdi zmdi-minus"></i></span>
                    <p class="nav-link2">Billeder</p>
                </div>
                <ul class="vertical-menu-sub">
                    <li><a href="{{route('showUploadImageAll')}}">Alle</a></li>
                    <li><a href="{{route('showUploadImageMen')}}">Mænd</a></li>
                    <li><a href="{{route('showUploadImageWomen')}}">Kvinder</a></li>
                    <li><a href="{{route('showUploadImageCouple')}}">Par</a></li>
                    @if(auth()->check())
                    <li><a class="@if(!auth()->user()->isPaid()) btn-disabled @endif" @if(auth()->user()->isPaid()) data-toggle="modal" href="#uploadimageModal" @endif>Upload</a></li>
                    @endif
                </ul>
            </li>
            <li>
                <div class="vertical-menu-link"><span><i class="zmdi zmdi-plus"></i><i
                                class="zmdi zmdi-minus"></i></span>
                    <p class="nav-link2">Videoer</p>
                </div>
                <ul class="vertical-menu-sub">
                    <li><a href="{{route('showUploadVideoAll')}}">Alle</a></li>
                    <li><a href="{{route('showUploadVideoMen')}}">Mænd</a></li>
                    <li><a href="{{route('showUploadVideoWomen')}}">Kvinder</a></li>
                    <li><a href="{{route('showUploadVideoCouple')}}">Par</a></li>
                    @if(auth()->check())
                    <li><a class="@if(!auth()->user()->isPaid()) btn-disabled @endif" @if(auth()->user()->isPaid()) data-toggle="modal" href="#uploadVideoModal" @endif>Upload</a></li>
                    @endif
                </ul>
            </li>
            <li>
                <div class="vertical-menu-link"><span><i class="zmdi zmdi-plus"></i><i
                                class="zmdi zmdi-minus"></i></span>
                    <p class="nav-link2">Min profil</p>
                </div>
                <ul class="vertical-menu-sub">
                    <li><a href="{{url('profile')}}">Vis min profil</a></li>
                    <li><a data-toggle="modal" href="#editProfileModal">Rediger profil</a></li>
                    <li><a data-toggle="modal" href="#changepassword">Ændre adgangskode</a></li>
                    <li><a data-toggle="modal" class="icon-popup-up" href="#icon-popup">Medlemskaber</a></li>
                    <li><a href="{{url('profileprivacy')}}">Indstillinger</a></li>
                    <li><a href="{{ url('blockList')}}">Blokerede profiler</a></li>

                </ul>
            </li>
            <li><a href="{{route('faq')}}">FAQ</a></li>
            {{-- logout --}}
            <li>
                <form  action="{{ route('logout') }}" method="POST" >
                    @csrf
                    <a  href="#">
                        <button type="submit" style="background: transparent; color: white;">Log ud</button>
                    </a>
                </form>

                <a  href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                    {{ __('Log ud') }}
                </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
            </form>
            {{-- logout end --}}
        </ul>
    </aside>
</div>

@if(auth()->check())
{{--upload image modal--}}
<div class="modal fade bd-example-modal-lg" id="uploadimageModal" tabindex="-1" role="dialog" aria-labelledby="imageGalleryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload billede</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('img/icon/cancel.svg')}}" alt="" srcset="">
                </button>
            </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <br>
                        <form class="" action="{{route('imageUpload')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="route" value="{{Route::currentRouteName()}}">
                            <div class="container">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' id="galleryImageUpload" name="image" accept=".png, .jpg, .jpeg" required/>
                                        <label for="galleryImageUpload"> :</label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="galleryImagePreview" style="background-image: url(/img/logo.png);">
                                        </div>
                                    </div>
                                </div>
                            </div> <br>
                            <button class="btn btn-radiaus" type="submit">Upload</button>
                        </form>
                    </div>
                    <div class="col">
                        @if(auth()->user()->portalInfo->portal_id == 1 || auth()->user()->portalInfo->portal_id == 5)
                        <ul class="dot-style">
                            <li>Ingen nøgenhed</li>
                            <li>Ingen former for pornografi</li>
                            <li>Ingen former for opfordring til ulovlig aktivitet, racistiske budskaber, vold eller lignende</li>
                            <li>Ingen links til andre sider eller anden former for reklame eller budskaber med salgsøjemed</li>
                            <li>Det er kun dig der må vises på dine billeder. Hvis andre mennesker forekommer skal disse, samt synlige kendetegn (tatoveringer
                            og lign.), fjernes/sløres Dette er undtaget par profiler hvor begge parter gerne må figurere</li>
                            <li>Pikante billeder, bikini billeder og lignende er tilladt, vi opfordrer dog til at du/I tænker over hvad der lægges op offentligt</li>
                        </ul>
                        @else
                        <ul class="dot-style">
                            <li>Ingen former for opfordring til ulovlig aktivitet, racistiske budskaber, vold eller lignende</li>
                            <li>Ingen links til andre sider eller anden former for reklame eller budskaber med salgsøjemed</li>
                            <li>Det er kun dig der må vises på dine billeder. Hvis andre mennesker forekommer på dine billeder, skal disse, samt synlige
                            kendetegn (tatoveringer og lign.), fjernes/sløres Dette er undtaget par profiler hvor begge parter gerne må figurere</li>
                            <li>Frække billeder, pikante billeder, bikini billeder og lignende er tilladt, vi opfordrer dog til at du/I tænker over hvad
                            der lægges op offentligt</li>
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--upload video modal--}}
<div class="modal fade bd-example-modal-lg" id="uploadVideoModal" tabindex="-1" role="dialog" aria-labelledby="imageGalleryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('img/icon/cancel.svg')}}" alt="" srcset="">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <br>
                        <form class="align-middle" action="{{route('videoUpload')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="route" value="{{Route::currentRouteName()}}">
                            <div class="container file-block">
                                <label class="btn-select-file">Vælg video</label>
                                <p class="btn-selected-file"></p>
                                <input type="file" name="image" accept="video/mp4,video/x-m4v,video/*" required>
                            </div><br>
                            <button class="btn-radiaus small" type="submit">Upload</button>
                        </form>
                    </div>
                    <div class="col">
                        @if(auth()->user()->portalInfo->portal_id == 1 || auth()->user()->portalInfo->portal_id == 5)
                        <ul class="dot-style">
                            <li>Ingen nøgenhed</li>
                            <li>Ingen former for pornografi</li>
                            <li>Ingen former for opfordring til ulovlig aktivitet, racistiske budskaber, vold eller lignende</li>
                            <li>Ingen links til andre sider eller anden former for reklame eller budskaber med salgsøjemed</li>
                            <li>Det er kun dig der må vises på dine billeder. Hvis andre mennesker forekommer skal disse, samt
                                synlige kendetegn (tatoveringer og lign.), fjernes/sløres Dette er undtaget par profiler
                                hvor begge parter gerne må figurere</li>
                            <li>Pikante billeder, bikini billeder og lignende er tilladt, vi opfordrer dog til at du/I tænker
                                over hvad der lægges op offentligt</li>
                        </ul>
                        @else
                        <ul class="dot-style">
                            <li>Ingen former for opfordring til ulovlig aktivitet, racistiske budskaber, vold eller lignende</li>
                            <li>Ingen links til andre sider eller anden former for reklame eller budskaber med salgsøjemed</li>
                            <li>Det er kun dig der må vises på dine billeder. Hvis andre mennesker forekommer på dine billeder,
                                skal disse, samt synlige kendetegn (tatoveringer og lign.), fjernes/sløres Dette er undtaget
                                par profiler hvor begge parter gerne må figurere</li>
                            <li>Frække billeder, pikante billeder, bikini billeder og lignende er tilladt, vi opfordrer dog til
                                at du/I tænker over hvad der lægges op offentligt</li>
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- membership modal -->
<div class="modal fade bd-example-modal-lg" id="icon-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Medlemskaber</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('img/icon/cancel.svg')}}" alt="" srcset="">
                </button>
            </div>
            <div class="modal-body pro-la-icon">
                <form class="d-inline" method="POST" action="{{ route('portals.store')}}">
                    @csrf
                    <input type="hidden" name="id" value="1">
                    <button type="submit" class="btn ">
                        <img src="{{ asset('/img/portal2/06.png')}}" alt="alt"/>
                        {{-- Dating --}}
                    </button>
                </form>
                <form class="d-inline" method="POST" action="{{ route('portals.store')}}">
                    @csrf
                    <input type="hidden" name="id" value="3">
                    <button type="submit" class="btn ">
                        <img src="{{ asset('/img/portal2/03.png')}}" alt="alt"/>
                        {{-- Fræk dating --}}
                    </button>
                </form>
                <form class="d-inline" method="POST" action="{{ route('portals.store')}}">
                    @csrf
                    <input type="hidden" name="id" value="2">
                    <button type="submit" class="btn ">
                        <img src="{{ asset('/img/portal2/02.png')}}" alt="alt"/>
                        <!-- Sugar Dating -->
                    </button>
                </form>
               {{-- <form class="d-inline" method="POST" action="{{ route('portals.store')}}">
                    @csrf
                    <input type="hidden" name="id" value="4">
                    <button type="submit" class="btn ">
                        <img src="{{ asset('/img/portal2/05.png')}}" alt="alt"/>
                        <!-- Badboy dating -->
                    </button>
                </form>
                <form class="d-inline" method="POST" action="{{ route('portals.store')}}">
                    @csrf
                    <input type="hidden" name="id" value="6">
                    <button type="submit" class="btn ">
                        <img src="{{ asset('/img/portal2/04.png')}}" alt="alt"/>
                        <!-- Regnbue dating -->
                    </button>
                </form>
                <form class="d-inline" method="POST" action="{{ route('portals.store') }}">
                    @csrf
                    <input type="hidden" name="id" value="5">
                    <button type="submit" class="btn ">
                        <img src="{{ asset('/img/portal2/01.png')}}" alt="alt"/>
                        <!-- Senior dating -->
                    </button>
                </form> --}}
            </div>
        </div>
    </div>
</div>

<!-- skift portal -->
<div class="modal fade bd-example-modal-lg" id="skiftPortalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Skift portal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img  src="{{asset('img/icon/cancel.svg')}}" alt="" srcset="">
                </button>
            </div>
            <div class="modal-body ">
                {!! Form::open(['route' => ['portals.update', 1 ], 'method' => 'PUT', 'class'=>'d-inline' ])!!} {{csrf_field()}}
                <button type="submit" class="btn " {{!Auth::user()->isPortalUserByAuth(1) ? 'disabled' : ''}}>
                    <img @if(!Auth::user()->isPortalUserByAuth(1)) data-toggle="modal" data-target="#portalHelpPopUp" @endif  src="{{ asset('/img/portal2/06.png')}}" alt="alt"/>
                </button>
                {!! Form::close() !!}
                {!! Form::open(['route' => ['portals.update', 3 ], 'method' => 'PUT', 'class'=>'d-inline' ])!!} {{csrf_field()}}
                <button type="submit" class="btn " {{!Auth::user()->isPortalUserByAuth(3) ?  'disabled' : ''}}>
                    <img @if(!Auth::user()->isPortalUserByAuth(3)) data-toggle="modal" data-target="#portalHelpPopUp" @endif src="{{ asset('/img/portal2/03.png')}}" alt="alt"/>
                </button>
                {!! Form::close() !!}
                {!! Form::open(['route' => ['portals.update', 2 ], 'method' => 'PUT', 'class'=>'d-inline' ])!!} {{csrf_field()}}
                <button type="submit" class="btn " {{!Auth::user()->isPortalUserByAuth(2) ? 'disabled' : ''}}>
                    <img @if(!Auth::user()->isPortalUserByAuth(2)) data-toggle="modal" data-target="#portalHelpPopUp" @endif src="{{ asset('/img/portal2/02.png')}}" alt="alt"/>
                </button>
                {!! Form::close() !!}
                {{-- {!! Form::open(['route' => ['portals.update', 4 ], 'method' => 'PUT', 'class'=>'d-inline' ])!!} {{csrf_field()}}
                <button type="submit" class="btn " {{!Auth::user()->isPortalUserByAuth(4) ? 'disabled' : ''}}>
                    <img @if(!Auth::user()->isPortalUserByAuth(4)) data-toggle="modal" data-target="#portalHelpPopUp" @endif src="{{ asset('/img/portal2/05.png')}}" alt="alt"/>
                </button>
                {!! Form::close() !!}
                {!! Form::open(['route' => ['portals.update', 6 ], 'method' => 'PUT', 'class'=>'d-inline' ])!!} {{csrf_field()}}
                <button type="submit" class="btn " {{!Auth::user()->isPortalUserByAuth(6) ? 'disabled' : ''}}>
                    <img @if(!Auth::user()->isPortalUserByAuth(6)) data-toggle="modal" data-target="#portalHelpPopUp" @endif src="{{ asset('/img/portal2/04.png')}}" alt="alt"/>
                </button>
                {!! Form::close() !!}
                {!! Form::open(['route' => ['portals.update', 5 ], 'method' => 'PUT', 'class'=>'d-inline' ])!!}
                {{csrf_field()}}
                <button  type="submit" class="btn " {{!Auth::user()->isPortalUserByAuth(5) ? 'disabled' : ''}}>
                    <img @if(!Auth::user()->isPortalUserByAuth(5)) data-toggle="modal" data-target="#portalHelpPopUp" @endif src="{{ asset('/img/portal2/01.png')}}" alt="alt"/>
                </button>
                {!! Form::close() !!} --}}
            </div>
        </div>
    </div>
</div>
<!-- password change modal-->
<div class="modal fade bd-example-modal-lg" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ændre adgangskode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('img/icon/cancel.svg')}}" alt="" srcset="">
                </button>
            </div>
            <div class="modal-body pro-la-icon">
              <div class="card-body">
                <form method="POST" action="{{ route('changePassword') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Nuværende kodeord :') }} </label>

                        <div class="col-md-6">
                            <input id="current-password" type="password" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="current-password" value="{{ $email ?? old('email') }}"
                                required autofocus>
                                @if ($errors->has('current-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current-password') }}</strong>
                                </span>
                                @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="new-password" class="col-md-4 col-form-label text-md-right">{{ __('Nyt kodeord :') }} </label>

                        <div class="col-md-6">
                            <input id="new-password" type="password" class="form-control" name="new-password" required>
                           @if ($errors->has('new-password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('new-password') }}</strong>
                            </span> @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="new-password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Bekræft kodeord :') }} </label>

                        <div class="col-md-6">
                            <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                                {{ __('Opdater adgangskode') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

{{-- user edit Models --}}
<div class="modal fade bs-example-modal-lg" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        @if(auth()->user()->portalInfo->sex == App\Enums\Sex::getValue('Par'))
            @include('layouts.coupleInfo.editModalCoupleInfo')
        @else
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rediger profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('img/icon/cancel.svg')}}" alt="" srcset="">
                </button>
            </div>
            {!! Form::open(['route' => ['profile.update', Auth::user()->id ], 'method' => 'PUT', 'enctype'=>'multipart/form-data', 'file'=>'true'
            ])!!} {{csrf_field()}}
            <div class="modal-body bg-light">
                <div class="mainthird">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">E-mail :</label>
                            <input class="form-control" type="email" placeholder="mail@mailesen.mail" name="email" value="{{Auth::user()->email}}" required>
                            @if ($errors->has('email'))
                                <span class=" text-danger" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Brugernavn :</label>
                            <input class="form-control" placeholder="Brugernavn" name="username" value="{{Auth::user()->portalInfo->userName}}" >
                            @if ($errors->has('username'))
                                <span class=" text-danger" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Fornavn :</label>
                            <input class="form-control" placeholder="fornavn" name="firstName" id="Fornavn" value="{{Auth::user()->portalInfo->firstName}}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Efternavn :</label>
                            <input class="form-control" placeholder="efternavn" name="lastName" id="efternavn" value="{{Auth::user()->portalInfo->lastName}}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Fødselsdag :</label>
                            <input class="form-control" type="date" placeholder="dd/mm/yyyy" name="dob" value="{{Auth::user()->portalInfo->dob}}" required>
                            @if ($errors->has('dob'))
                                <span class=" text-danger" role="alert">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Køn :</label>
                            <select name="sex" class="form-control">
                                @if(Auth::user()->portalInfo->sex == null)
                                <option value="" selected disabled>Vælg din mulighed</option>
                                @endif
                                @foreach (App\Enums\Sex::getValues() as $item)
                                    <option value="{{ $item }}" {{ Auth::user()->portalInfo->sex == $item ? 'selected' : ''}}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Seksualitet :</label>
                            <select name="sexualOrientation" class="form-control" required>
                                @if(Auth::user()->portalInfo->sexualOrientation == null)
                                <option value="" selected disabled>Vælg din mulighed</option>
                                @endif
                                @foreach (App\Enums\SexualOrientation::getValues() as $item)
                                    <option value="{{ $item }}" {{ Auth::user()->portalInfo->sexualOrientation == $item ? 'selected' : ''}}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Søger :</label>
                            <select name="searching[]" class="selectpicker form-control" multiple  title="Vælg din mulighed" required>
                                @foreach (App\Enums\Searching::getValues() as $item)
                                <option value="{{$item}}"
                                    @if(json_decode(Auth::user()->portalInfo->searching) != null)
                                    @foreach(json_decode(Auth::user()->portalInfo->searching) as $p)
                                        @if($item == $p)
                                        selected="selected"
                                        @endif
                                    @endforeach
                                    @endif
                                    >
                                    {{$item}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Civilstatus :</label>
                            <select name="civilStatus" class="form-control" required>
                                @if(Auth::user()->portalInfo->civilStatus == null)
                                <option value="" selected disabled>Vælg din mulighed</option>
                                @endif
                                @foreach (App\Enums\CivilStatus::getValues() as $item)
                                    <option value="{{ $item }}" {{ Auth::user()->portalInfo->civilStatus == $item ? 'selected' : ''}}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Kropsbygning :</label>
                            <select name="bodyType" class="form-control" required>
                                @if(Auth::user()->portalInfo->bodyType == null)
                                <option value="" selected disabled>Vælg din mulighed</option>
                                @endif
                                @foreach (App\Enums\BodyType::getValues() as $item)
                                    <option value="{{ $item }}" {{ Auth::user()->portalInfo->bodyType == $item ? 'selected' : ''}}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Højde :</label>
                            <select name="height" class="form-control" required>
                                @if(Auth::user()->portalInfo->height == null)
                                <option value="" selected disabled>Vælg din mulighed</option>
                                @endif
                                @foreach (App\Enums\Height::getValues() as $item)
                                    <option value="{{ $item }}" {{ Auth::user()->portalInfo->height == $item ? 'selected' : ''}}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Vægt :</label>
                            <select name="weight" class="form-control" required>
                                @if(Auth::user()->portalInfo->weight == null)
                                <option value="" selected disabled>Vælg din mulighed</option>
                                @endif
                                @foreach (App\Enums\Weight::getValues() as $item)
                                    <option value="{{ $item }}" {{ Auth::user()->portalInfo->weight == $item ? 'selected' : ''}}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Postnummer :</label>
                            <input class="form-control" placeholder="Postnummer" name="zipCode" class="input-height" value="{{Auth::user()->portalInfo->zipCode}}"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Øjenfarve :</label>
                            <select name="eyeColor" class="form-control">
                                @if(Auth::user()->portalInfo->eyeColor == null)
                                <option value="" selected disabled>Vælg din mulighed</option>
                                @endif
                                @foreach (App\Enums\EyeColor::getValues() as $item)
                                    <option value="{{ $item}}" {{ Auth::user()->portalInfo->eyeColor == $item ? 'selected' : ''}}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Hårfarve :</label>
                            <select name="hairColor" class="form-control" required>
                                @if(Auth::user()->portalInfo->hairColor == null)
                                <option value="" selected disabled>Vælg din mulighed</option>
                                @endif
                                @foreach (App\Enums\HairColor::getValues() as $item)
                                    <option value="{{ $item }}" {{ Auth::user()->portalInfo->hairColor == $item ? 'selected' : ''}}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Ryger :</label>
                            <select name="smoking" id="" class="form-control" required>
                                @if(Auth::user()->portalInfo->smoking == null)
                                <option value="" selected disabled>Vælg din mulighed</option>
                                @endif
                                @foreach (App\Enums\Smoking::getValues() as $item)
                                    <option value="{{ $item }}" {{ Auth::user()->portalInfo->smoking == $item ? 'selected' : ''}}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Piercinger :</label>
                            <select name="piercing" class="form-control" required>
                                @if(Auth::user()->portalInfo->piercing == null)
                                <option value="" selected disabled>Vælg din mulighed</option>
                                @endif
                                @foreach (App\Enums\Piercing::getValues() as $item)
                                    <option value="{{ $item }}" {{ Auth::user()->portalInfo->piercing == $item ? 'selected' : ''}}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Børn :</label>
                            <select name="children" class="form-control" required>
                                @if(Auth::user()->portalInfo->children == null)
                                <option value="" selected disabled>Vælg din mulighed</option>
                                @endif
                                @foreach (App\Enums\Children::getValues() as $item)
                                    <option value="{{ $item }}" {{ Auth::user()->portalInfo->children == $item ? 'selected' : ''}}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Tatoveringer :</label>
                            <select name="tattoos" class="form-control" required>
                                @if(Auth::user()->portalInfo->tattoos == null)
                                <option value="" selected disabled>Vælg din mulighed</option>
                                @endif
                                @foreach (App\Enums\Tattoos::getValues() as $item)
                                    <option value="{{ $item }}" {{ Auth::user()->portalInfo->tattoos == $item ? 'selected' : ''}}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Lokation :</label>
                            <select name="region" class="form-control" required>
                                @if(Auth::user()->portalInfo->region_id == null)
                                <option value="" selected disabled>Vælg din mulighed</option>
                                @endif
                                @foreach (App\Models\Region::all() as $item)
                                    <option value="{{ $item->region_name }}" {{ Auth::user()->portalInfo->region_id == $item->id ? 'selected' : ''}}>{{ $item->region_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Matchord :</label>
                            <input  data-role="tagsinput" class="form-control" placeholder="Matchord"
                            name="matchWords" class="input-height"
                            value="{{Auth::user()->portalInfo->matchWords != null ?
                            implode(", ",json_decode(Auth::user()->portalInfo->matchWords)) : ''}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Negative Matchord :</label>
                            <input data-role="tagsinput" class="form-control" placeholder="Matchord" name="nMatchWords"
                            class="input-height"
                            value="{{
                            Auth::user()->portalInfo->nMatchWords != null ?
                            implode(", ",json_decode(Auth::user()->portalInfo->nMatchWords)) : ''}}">
                        </div>

                        <div class="form-group col-md-6" style=" margin-top: 16px; ">
                            <label for="inputPassword4">Billede :</label>
                            <label class="btn-select-file">Vælg billede</label>
                            <p class="btn-selected-file"></p>
                            <input type="file" id="profileImageUpload" class="form-control-file" accept=".png, .jpg, .jpeg" value="{{Auth::user()->portalInfo->profilePicture}}" name="profilePicture">
                        </div>
                        <div class="form-group col-md-6">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <label for="profileImageUpload"></label>
                                </div>
                                <div class="avatar-preview editProfile-avatar-preview">
                                    <div id="profileImagePreview" style="background-image: url({{ Auth::user()->portalInfo->profilePicture }});">
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
            <div class="modal-footer single-submit">
                <button type="submit" class="btn-radiaus">Opdatér</button>
            </div>
            {!! Form::close() !!}
        </div>
        @endif
    </div>
</div>

<!-- show myProfile galary Modal -->
<div class="modal fade" id="showMyProfileImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-header image-modal-header">
            <button type="button" class="close image-modal-close-btn" data-dismiss="modal" aria-label="Close">
                <img src="{{asset('img/icon/cancel.svg')}}" alt="" srcset="">
            </button>
        </div>
        <div class="modal-content">

            <div class="modal-body">
                <img id="profile-img-my" src="" alt="" srcset="">
            </div>

        </div>
    </div>
</div>

<!-- show othersProfile galary Modal -->
<div class="modal fade" id="showOthersProfileImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-header image-modal-header">
            <button type="button" class="close image-modal-close-btn" data-dismiss="modal" aria-label="Close">
                <img src="{{asset('img/icon/cancel.svg')}}" alt="" srcset="">
            </button>
        </div>
        <div class="modal-content">

            <div class="modal-body">
                @if(!auth()->user()->isPaid())
                    <img id="profile-img-others" src="" alt="" srcset="" class="blur-item-view">
                @else
                    <img id="profile-img-others" src="" alt="" srcset="">
                @endif
            </div>

        </div>
    </div>
</div>

<!-- show image galary Modal -->
<div class="modal fade" id="imageGalleryModal" tabindex="-1" role="dialog" aria-labelledby="imageGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-header image-modal-header">
            <button type="button" class="close image-modal-close-btn" data-dismiss="modal" aria-label="Close">
                <img src="{{asset('img/icon/cancel.svg')}}" alt="" srcset="">
            </button>
        </div>
        <div class="modal-content">
            <div class="modal-body">
                <img id="gallery-img" src="" alt="" srcset="">
            </div>

        </div>
    </div>
</div>

<!-- show promotion image Modal -->
<div  class="modal fade bd-example-modal-lg" id="showPromotionModal" tabindex="-1" role="dialog" aria-labelledby="imageGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-header image-modal-header">
            <button type="button" class="close image-modal-close-btn" data-dismiss="modal" aria-label="Close">
                <img src="{{asset('img/icon/cancel.svg')}}" alt="" srcset="">
            </button>
        </div>
        <div class="modal-content" style="display: block;">
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <img class="show-promotion-image" id="promotion-img" src="" alt="" srcset="">
                    </div>
                    <div class="col">
                        <p id="promotion-title"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- show profile slider image Modal -->
<div class="modal fade" id="profileSliderModal" tabindex="-1" role="dialog" aria-labelledby="imageGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-header image-modal-header">
            <button type="button" class="close image-modal-close-btn" data-dismiss="modal" aria-label="Close">
                <img src="{{asset('img/icon/cancel.svg')}}" alt="" srcset="">
            </button>
        </div>
        <div class="modal-content">
            <div class="modal-body">
                <img id="profile-slider-img" src="" alt="" srcset="">
            </div>

        </div>
    </div>
</div>

<!-- show prices Modal -->
<div class="modal fade bd-example-modal-lg" id="showPricesModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Abonnementstype</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <img src="{{asset('img/icon/cancel.svg')}}" alt="" srcset="">
                </button>
            </div>
            <div class="card-body">
                <ul class="list-group">


                    <div class="row">
                        <div class="col">
                            @foreach(App\Models\Membership::whereIn('slug', ['free','md','ugo','weekend','day','kvartal','arllg','ar'])->get()->slice(0
                            , 4) as $plan)
                            <li class="list-group-item clearfix">
                                <div class="pull-left">
                                    <h5>{{ $plan->name }}</h5>
                                    <h5>{{ number_format($plan->cost, 2) }} Kr./ @if ($plan->name == "Gratis profil") md @else
                                        {{lcfirst($plan->name)}} @endif
                                    </h5>
                                    <h5>{{ $plan->description }}</h5>
                                </div>
                            </li>
                            @endforeach
                        </div>
                        <div class="col">
                            @foreach(App\Models\Membership::whereIn('slug', ['free','md','ugo','weekend','day','kvartal','arllg','ar'])->get()->slice(4,
                            8) as $plan)
                            <li class="list-group-item clearfix">
                                <div class="pull-left">
                                    <h5>{{ $plan->name }}</h5>
                                    <h5>{{ number_format($plan->cost, 2) }} Kr./ @if ($plan->name == "1 år") år @else {{lcfirst($plan->name)}}
                                        @endif
                                    </h5>
                                    <h5>{{ $plan->description }}</h5>
                                </div>
                            </li>
                            @endforeach
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="portalHelpPopUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="exampleModalLabel">Skift portal</h5> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('img/icon/cancel.svg')}}" alt="" srcset="">
                </button>
            </div>
            <div class="modal-body">
                Du er endnu ikke medlem af denne portal. Gå til “Min profil” og vælg “Medlemskaber” for at oprette profil i andre
                portaler.
            </div>

        </div>
    </div>
</div>
@endif

