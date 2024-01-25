<nav class="navbar navbar-expand-lg navbar-dark fixed-top
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
<a class="navbar-brand" href="{{route("home")}}">
        <img src="{{ asset('/img/logo.png')}}" width="30" height="30" class="d-inline-block align-top" alt="">
        @if(auth()->check())
        {{ Auth::user()->portalType(Auth::user()->portalJoinUser_id) }}
        @else
        Dating
        @endif
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
            <li class="nav-item">
            <a  class="nav-link nav-link2" href="{{url('home')}}">Forside</a>
            </li>
            <li class="nav-item">
                <a data-toggle="modal" class="nav-link nav-link2 icon-popup-up" href="#skiftPortalModal">Skift portal</a>
            </li>
            @if(auth()->check())
            <inbox-notification :user="{{auth()->user()}}" :inboxunreads="{{auth()->user()->inboxUnreadNotifications()}}" :favoriteunreads="{{auth()->user()->favoriteUnreadNotifications()}}"
                ></inbox-notification>
            <notification :userid="{{auth()->id()}}" :inboxunreads="{{auth()->user()->inboxUnreadNotifications()}}" :favoriteunreads="{{auth()->user()->favoriteUnreadNotifications()}}"
                    :othersunreads="{{auth()->user()->othersUnreadNotifications()}}"></notification>
            @endif
            <li class="nav-item">
                <a class="nav-link nav-link2" href="{{route('show.advancesearch')}}">Søg</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link2" href="{{ url('chat-rooms')}}">Chatrum</a>
            </li>
          <li class="nav-item dropdown">
                <a class="nav-link nav-link2 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"> Community </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('groups')}}">Grupper</a>
                    <a class="dropdown-item" href="{{route('blogs')}}">Blogs</a>
                    <a class="dropdown-item" href="{{route('events')}}">Events</a>
                </div>
          </li>
          <li class="nav-item dropdown">
                <a class="nav-link nav-link2 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"> Billeder </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('showUploadImageAll')}}">Alle</a>
                    <a class="dropdown-item" href="{{route('showUploadImageMen')}}">Mænd</a>
                    <a class="dropdown-item" href="{{route('showUploadImageWomen')}}">Kvinder</a>
                    <a  class="dropdown-item" href="{{route('showUploadImageCouple')}}">Par</a>
                    @if(auth()->check())
                    <a class="dropdown-item @if(!auth()->user()->isPaid()) btn-disabled @endif" @if(auth()->user()->isPaid()) data-toggle="modal" href="#uploadimageModal" @endif>Upload</a>
                    @endif
                </div>
          </li>
          <li class="nav-item dropdown">
                <a class="nav-link nav-link2 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"> Videoer </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('showUploadVideoAll')}}">Alle</a>
                    <a class="dropdown-item" href="{{route('showUploadVideoMen')}}">Mænd</a>
                    <a class="dropdown-item" href="{{route('showUploadVideoWomen')}}">Kvinder</a>
                    <a  class="dropdown-item" href="{{route('showUploadVideoCouple')}}">Par</a>
                    @if(auth()->check())
                    <a class="dropdown-item @if(!auth()->user()->isPaid()) btn-disabled @endif" @if(auth()->user()->isPaid()) data-toggle="modal" href="#uploadVideoModal" @endif>Upload</a>
                    @endif
                </div>
          </li>
          <li class="nav-item dropdown">
                <a class="nav-link nav-link2 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"> Min profil </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{url('profile')}}">Vis min profil</a>
                    <a class="dropdown-item" data-toggle="modal" href="#editProfileModal">Rediger profil</a>
                    <a class="dropdown-item" data-toggle="modal" href="#changepassword">Ændre adgangskode</a>
                    <a  class="dropdown-item" data-toggle="modal" class="icon-popup-up" href="#icon-popup">Medlemskaber</a>
                    <a  class="dropdown-item" href="{{url('profileprivacy')}}">Indstillinger</a>
                    <a class="dropdown-item" href="{{ url('blockList')}}">Blokerede profiler</a>
                </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link nav-link2" href="{{route('faq')}}">FAQ</a>
        </li>
          <li class="nav-item ">
            <a class="nav-link nav-link2" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                                {{ __('Log ud') }}
            </a>
        </li>



        </ul>
    </div>
</nav>

