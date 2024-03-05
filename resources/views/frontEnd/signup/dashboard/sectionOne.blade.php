<div class="col-lg-6">

    {{-- quick search --}}
    <div class="search-filter-area">
        <div class="title-area">
            <h3>Hurtig søgning</h3>
        </div>
        <form method="POST" action="{{ route('profile.search') }}">
            @csrf
            <div class="search-filter">
                <div class="single-input small">
                    <input min="18" type="number" placeholder="..." name="fromAge" required />
                </div>
                <div class="single-text">
                    <small>to</small>
                </div>
                <div class="single-input small">
                    <input min="18" type="number" name="toAge" placeholder="..." required />
                </div>
                <div class="single-input">
                    <select name="gender" class="form-control small" required>
                        <option value="" disabled selected>Køn</option>
                        @foreach (App\Enums\Sex::getValues() as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="single-input">
                    <select name="location" class="form-control small">
                        <option value="" disabled selected>Lokation</option>
                        @foreach (App\Models\Region::all() as $item)
                        <option value="{{ $item->id }}">{{ $item->region_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="single-submit">
                    <button class="btn-radiaus small" type="submit">Søg</button>
                </div>
            </div>
        </form>
    </div>

    {{-- visited user slider  --}}
    <div class="latest-profile-list-area fav-people-area">
        <div class="title-area">
            <a href="#">
                <h3>Seneste besøg</h3>
            </a>
        </div>
        @if(sizeof(visitedProfiles())>0)
        <div id="profileVisitor" class="owl-carousel owl-theme">
            @foreach(visitedProfiles() as $visitedUser)
                @include('frontEnd.signup.dashboard.sliderProfile',['item' => $visitedUser->visitor])
            @endforeach
        </div>
        @else
        Ingen seneste besøgende
        @endif
    </div>

    {{-- favorite user slider --}}
    <div class="latest-profile-list-area fav-people-area">
        <div class="title-area">
            <a href="#">
                <h3>Favoritter</h3>
            </a>
            <span><i class="zmdi zmdi-favorite-outline"></i></span>
        </div>
        @if(sizeof(favoriteProfiles())>0)
        <div id="favoriteUser" class="owl-carousel owl-theme">
            @foreach(favoriteProfiles() as $favourite)
                @include('frontEnd.signup.dashboard.sliderProfile',['item' => $favourite->userFavourite])
            @endforeach
        </div>
        @else
        Ingen favoritter
        @endif
    </div>

    {{-- latest user slider --}}
    <div class="latest-profile-list-area fav-people-area">
        <div class="title-area">
            <a href="#">
                <h3>Nyeste profiler</h3>
            </a>
        </div>
        @if(sizeof(latestProfiles()) > 0)
        <div id="latestUser" class="owl-carousel owl-theme">
            @foreach(latestProfiles() as $item)
                @include('frontEnd.signup.dashboard.sliderProfile',['item' => $item])
            @endforeach
        </div>
        @else
        Ingen nye brugere
        @endif
    </div>

    
    {{-- latest group --}}
    <div class="popular-group-area">
        <div class="title-area">
            <a class="section-title" href="{{route('groups')}}">Nyeste gruppe</a>
        </div>
        @if(sizeof(latestGroup()) > 0)
        @foreach(latestGroup() as $group)
        <div class="media-area">
            <div class="img-area">
                <a href="{{route('groupDetails',$group->id)}}">
                    <img src="{{asset('/'.$group->image)}}" alt="" />
                </a>
            </div>
            <div class="media-title-content">
                <h3>{{$group->title}}</h3>
                <p>{!! str_limit($group->details, $limit = 60, $end = '..') !!} <br><a
                        href="{{route('groupDetails',$group->id)}}" style=" font-style: italic; "> Læs mere</a></p>
            </div>
        </div>
        @endforeach
        @else
        Ingen nyeste gruppe
        @endif
    </div>
</div>