<!-- Developed By CBS -->
        <!-- Quick Search -->
            <div class="card custom-card">
                <div class="card-body h-100" style="margin-bottom: 0px;">
                    <div style="margin-bottom: 10px;">
                          <h5 class="card-title mb-1" style="font-weight: bold;">HURTIG SØGNING</h5><hr>
                    </div>
                    <form method="POST" action="{{ route('profile.search') }}">
                        @csrf
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <select id="qsfrom" style="width: 100%" name="fromAge" class="form-control" required>
                                            <option value="" disabled selected>---Vælg Til Fra---</option>
                                            @for ($i=18; $i<=100; $i++)
                                            <option value="{{$i}}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <select id="qsto" style="width: 100%" name="toAge" class="form-control" required>
                                            <option value="" disabled selected>---Vælg Alder---</option>
                                            @for ($i=18; $i<=100; $i++)
                                            <option value="{{$i}}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-12">
                                    <div class="form-group">
                                        <select id="qssex" style="width: 100%" name="gender" class="form-control" required>
                                            <option value="" disabled selected>---Vælg Køn---</option>
                                            @foreach (App\Enums\Sex::getValues() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-12">
                                    <div class="form-group">
                                        <select id="qslocation" style="width: 100%" name="location" class="form-control select2" required>
                                            <option value="" disabled selected>---Beliggenhed---</option>
                                            @foreach (App\Models\Region::all() as $item)
                                            <option value="{{ $item->id }}">{{ $item->region_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: right;"><button class="btn ripple btn-primary" type="submit" style="font-weight: bold;">SØG</button></div>
                    </form>
                </div>
            </div>
        <!-- ./Quick Search -->

        <!-- Visited User Slider -->
            <div class="card custom-card">
                <div class="card-body h-100" style="margin-bottom: 10px;">
                    <div style="margin-bottom: 10px;">
                        <a @if(auth()->user()->isPaid()) href="{{route('visited.all')}}" @endif>
                            <h5 class="card-title mb-1" style="font-weight: bold;">SENESTE BESØG</h5><hr>
                        </a>
                    </div>
                    @if(sizeof($visitedProfiles)>0)
                    <div id="owl-demo2" class="owl-carousel owl-carousel-icons2">
                        @foreach($visitedProfiles as $visitedUser) 
                            @if(!auth()->user()->isPaid()) 
                                @if(auth()->user()->isVisible($visitedUser->visited_id))
                                    @include('dashlead.layouts.profileSlider.profile',['item' => $visitedUser->visitor])
                                @endif 
                             @else
                                @include('dashlead.layouts.profileSlider.profile',['item' => $visitedUser->visitor])
                            @endif 
                        @endforeach
                    </div>
                    @else
                        <div style="text-align: center; margin-top: 94px; margin-bottom: 94px;">
                            <h5 style="color:red;">Ingen Seneste Besøgende.</h5>
                        </div>
                    @endif
                </div>
            </div>
        <!-- ./Visited User Slider -->

        <!-- Favorite User Slider -->
            <div class="card custom-card">
                <div class="card-body h-100" style="margin-bottom: 10px;">
                    <div style="margin-bottom: 10px;">
                        <a @if(auth()->user()->isPaid()) href="{{route('favorite.all')}}" @endif>
                            <h5 class="card-title mb-1" style="font-weight: bold;">FORETRUKNE</h5><hr>
                        </a>
                    </div>
                    @if(sizeof($favourities)>0)
                    <div id="owl-demo2" class="owl-carousel owl-carousel-icons2">
                        @foreach($favourities as $favourite) 
                            @if(!auth()->user()->isPaid()) 
                                @if(auth()->user()->isVisible($favourite->favourite_to))
                                    @include('dashlead.layouts.profileSlider.profile',['item' => $favourite->userFavourite])
                                @endif 
                            @else
                                @include('dashlead.layouts.profileSlider.profile',['item' => $favourite->userFavourite])
                            @endif 
                        @endforeach
                    </div>
                    @else
                    <div style="text-align: center; margin-top: 94px; margin-bottom: 94px;">
                            <h5 style="color:red;">Ingen Favoritter.</h5>
                        </div>
                        
                    @endif
                </div>
            </div>
        <!-- ./Favorite User Slider -->

        <!-- Latest User Slider -->
            <div class="card custom-card">
                <div class="card-body h-100" style="margin-bottom: 10px;">
                    <div style="margin-bottom: 10px;">
                        <a @if(auth()->user()->isPaid()) href="{{route('latest.all')}}" @endif>
                            <h5 class="card-title mb-1" style="font-weight: bold;">NYESTE PROFILER</h5><hr>
                        </a>
                    </div>
                    @if(sizeof($latestProfiles) > 0)
                    <div id="owl-demo2" class="owl-carousel owl-carousel-icons2">
                        @foreach($latestProfiles as $item) 
                            @if(!auth()->user()->isPaid()) 
                                @if(auth()->user()->isVisible($item->id))
                                    @include('dashlead.layouts.profileSlider.profile',['item' => $item])
                                @endif 
                            @else
                                @include('dashlead.layouts.profileSlider.profile',['item' => $item])
                            @endif 
                        @endforeach
                    </div>
                    @else
                        <div style="text-align: center; margin-top: 94px; margin-bottom: 94px;">
                            <h5 style="color:red;">Ingen Nye Brugere.</h5>
                        </div>
                    @endif
                </div>
            </div>
        <!-- ./Latest User Slider -->

        <!-- Latest Group -->
            <div class="card custom-card">
                <div class="card-body h-100">
                    <div style="margin-bottom: 10px;">
                        <a href="{{route('groups')}}">
                            <h5 class="card-title mb-1" style="font-weight:bold; text-transform:uppercase;">Nyeste Gruppe</h5><hr>
                        </a>
                    </div>
                    @if(sizeof($latestGroup) > 0)
                    <div class="owl-carousel owl-group-slider">
                        @foreach($latestGroup as $group)
                        <div class="item">
                            <a  href="{{route('groupDetails',$group->id)}}">
                                <div class="card">
                                    <div class="card-body user-card text-center">
                                        <div class="row">
                                            <div class="col text-center">
                                                    <h6><span style="font-weight: bold; text-transform:uppercase;" class="badge badge-primary">{{  str_limit($group->title, 60) }}</span></h6>
                                                    @if(File::exists($group->image))
                                                        <img src="{{asset($group->image)}}" width="210" height="70">
                                                    @else
                                                        <img src="{{ asset('dashlead/img/default/404-image.png') }}" class="rounded-circle" height="70">
                                                     @endif
                                            </div>
                                            <div class="col text-left">
                                                    <p><span class="text-muted">{{  str_limit($group->details, 65) }}</span> <a href="{{route('groupDetails',$group->id)}}" style="font-style: italic; "> Læs mere</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @else
                        <div style="text-align: center; margin-top: 99px; margin-bottom: 99px;">
                            <h5 style="color:red;">Ingen Nyeste Gruppe.</h5>
                        </div>
                    @endif
                </div>
            </div>
        <!-- ./Latest Group -->

<!-- Developed By CBS -->
