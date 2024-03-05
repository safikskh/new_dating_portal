<!-- Developed By CBS -->

    <!-- Profile Edit Modal -->
        <div class="modal" id="profile_edit_model">
            <div class="modal-dialog  modal-xl" role="document">

                <div class="modal-content modal-content-demo">
                    @if(auth()->user()->portalInfo->sex == App\Enums\Sex::getValue('Par'))
                        @include('layouts.coupleInfo.editModalCoupleInfo')
                    @else
                    <!-- Single Profile Form -->
                        <div class="modal-header">
                            <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Rediger Profil</h6><button
                                aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        {!! Form::open(['route' => ['profile.update', Auth::user()->id ], 'method' => 'PUT', 'enctype'=>'multipart/form-data', 'file'=>'true'])!!}
                            {{csrf_field()}}
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label>E-mail <span style="color:red">*</span></label>
                                            <input class="form-control" type="email" placeholder="mail@mailesen.mail" name="email"
                                                value="{{Auth::user()->email}}" required>
                                            @if ($errors->has('email'))
                                            <span class=" text-danger" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label>Brugernavn <span style="color:red">*</span></label>
                                            <input class="form-control" placeholder="Brugernavn" name="username"
                                                value="{{Auth::user()->portalInfo->userName}}">
                                            @if ($errors->has('username'))
                                            <span class=" text-danger" role="alert">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label>Fornavn <span style="color:red">*</span></label>
                                            <input class="form-control" placeholder="fornavn" name="firstName" id="Fornavn"
                                                value="{{Auth::user()->portalInfo->firstName}}" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label>Efternavn <span style="color:red">*</span></label>
                                            <input class="form-control" placeholder="efternavn" name="lastName" id="efternavn"
                                                value="{{Auth::user()->portalInfo->lastName}}" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label>Fødselsdag <span style="color:red">*</span></label>
                                            <input class="form-control" type="date" placeholder="dd/mm/yyyy" name="dob"
                                                value="{{Auth::user()->portalInfo->dob}}" required>
                                            @if ($errors->has('dob'))
                                            <span class=" text-danger" role="alert">
                                                <strong>{{ $errors->first('dob') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label>Køn <span style="color:red">*</span></label>
                                            <select style="width: 100%" name="sex" class="form-control select2">
                                                @if(Auth::user()->portalInfo->sex == null)
                                                <option value="" selected disabled>Vælg din mulighed</option>
                                                @endif
                                                @foreach (App\Enums\Sex::getValues() as $item)
                                                <option value="{{ $item }}"
                                                    {{ Auth::user()->portalInfo->sex == $item ? 'selected' : ''}}>{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Seksualitet <span style="color:red">*</span></label>
                                        <select name="sexualOrientation" class="form-control select2" required>
                                            @if(Auth::user()->portalInfo->sexualOrientation == null)
                                            <option value="" selected disabled>Vælg din mulighed</option>
                                            @endif
                                            @foreach (App\Enums\SexualOrientation::getValues() as $item)
                                            <option value="{{ $item }}"
                                                {{ Auth::user()->portalInfo->sexualOrientation == $item ? 'selected' : ''}}>{{ $item }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Civilstatus <span style="color:red">*</span></label>
                                        <select name="civilStatus" class="form-control select2" required>
                                            @if(Auth::user()->portalInfo->civilStatus == null)
                                            <option value="" selected disabled>Vælg din mulighed</option>
                                            @endif
                                            @foreach (App\Enums\CivilStatus::getValues() as $item)
                                            <option value="{{ $item }}"
                                                {{ Auth::user()->portalInfo->civilStatus == $item ? 'selected' : ''}}>{{ $item }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Kropsbygning <span style="color:red">*</span></label>
                                        <select name="bodyType" class="form-control select2" required>
                                            @if(Auth::user()->portalInfo->bodyType == null)
                                            <option value="" selected disabled>Vælg din mulighed</option>
                                            @endif
                                            @foreach (App\Enums\BodyType::getValues() as $item)
                                            <option value="{{ $item }}"
                                                {{ Auth::user()->portalInfo->bodyType == $item ? 'selected' : ''}}>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Højde <span style="color:red">*</span></label>
                                        <select name="height" class="form-control select2" required>
                                            @if(Auth::user()->portalInfo->height == null)
                                            <option value="" selected disabled>Vælg din mulighed</option>
                                            @endif
                                            @foreach (App\Enums\Height::getValues() as $item)
                                            <option value="{{ $item }}"
                                                {{ Auth::user()->portalInfo->height == $item ? 'selected' : ''}}>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Søger <span style="color:red">*</span></label>
                                        <select multiple="multiple" class="selectsum2" name="searching[]">
                                            @foreach (App\Enums\Searching::getValues() as $item)
                                                <option value="{{$item}}"
                                                @if(json_decode(Auth::user()->portalInfo->searching) != null)
                                                    @foreach(json_decode(Auth::user()->portalInfo->searching) as $p)
                                                        @if($item == $p)
                                                        selected="selected"
                                                        @endif
                                                    @endforeach
                                                @endif
                                                >{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-9">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label>Vægt <span style="color:red">*</span></label>
                                                <select name="weight" class="form-control select2" required>
                                                    @if(Auth::user()->portalInfo->weight == null)
                                                    <option value="" selected disabled>Vælg din mulighed</option>
                                                    @endif
                                                    @foreach (App\Enums\Weight::getValues() as $item)
                                                    <option value="{{ $item }}"
                                                        {{ Auth::user()->portalInfo->weight == $item ? 'selected' : ''}}>{{ $item }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Postnummer <span style="color:red">*</span></label>
                                                <input class="form-control" placeholder="Postnummer" name="zipCode" class="input-height"
                                                    value="{{Auth::user()->portalInfo->zipCode}}" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Øjenfarve <span style="color:red">*</span></label>
                                                <select name="eyeColor" class="form-control select2">
                                                    @if(Auth::user()->portalInfo->eyeColor == null)
                                                    <option value="" selected disabled>Vælg din mulighed</option>
                                                    @endif
                                                    @foreach (App\Enums\EyeColor::getValues() as $item)
                                                    <option value="{{ $item}}"
                                                        {{ Auth::user()->portalInfo->eyeColor == $item ? 'selected' : ''}}>{{ $item }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Hårfarve <span style="color:red">*</span></label>
                                                <select name="hairColor" class="form-control select2" required>
                                                    @if(Auth::user()->portalInfo->hairColor == null)
                                                    <option value="" selected disabled>Vælg din mulighed</option>
                                                    @endif
                                                    @foreach (App\Enums\HairColor::getValues() as $item)
                                                    <option value="{{ $item }}"
                                                        {{ Auth::user()->portalInfo->hairColor == $item ? 'selected' : ''}}>{{ $item }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Ryger <span style="color:red">*</span></label>
                                                <select name="smoking" id="" class="form-control select2-no-search" required>
                                                    @if(Auth::user()->portalInfo->smoking == null)
                                                    <option value="" selected disabled>Vælg din mulighed</option>
                                                    @endif
                                                    @foreach (App\Enums\Smoking::getValues() as $item)
                                                    <option value="{{ $item }}"
                                                        {{ Auth::user()->portalInfo->smoking == $item ? 'selected' : ''}}>{{ $item }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Piercinger <span style="color:red">*</span></label>
                                                <select name="piercing" class="form-control select2-no-search" required>
                                                    @if(Auth::user()->portalInfo->piercing == null)
                                                    <option value="" selected disabled>Vælg din mulighed</option>
                                                    @endif
                                                    @foreach (App\Enums\Piercing::getValues() as $item)
                                                    <option value="{{ $item }}"
                                                        {{ Auth::user()->portalInfo->piercing == $item ? 'selected' : ''}}>{{ $item }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Børn <span style="color:red">*</span></label>
                                                <select name="children" class="form-control select2" required>
                                                    @if(Auth::user()->portalInfo->children == null)
                                                    <option value="" selected disabled>Vælg din mulighed</option>
                                                    @endif
                                                    @foreach (App\Enums\Children::getValues() as $item)
                                                    <option value="{{ $item }}"
                                                        {{ Auth::user()->portalInfo->children == $item ? 'selected' : ''}}>{{ $item }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Tatoveringer <span style="color:red">*</span></label>
                                                <select name="tattoos" class="form-control select2-no-search" required>
                                                    @if(Auth::user()->portalInfo->tattoos == null)
                                                    <option value="" selected disabled>Vælg din mulighed</option>
                                                    @endif
                                                    @foreach (App\Enums\Tattoos::getValues() as $item)
                                                    <option value="{{ $item }}"
                                                        {{ Auth::user()->portalInfo->tattoos == $item ? 'selected' : ''}}>{{ $item }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>Lokation <span style="color:red">*</span></label>
                                                <select name="region" class="form-control select2" required>
                                                    @if(Auth::user()->portalInfo->region_id == null)
                                                    <option value="" selected disabled>Vælg din mulighed</option>
                                                    @endif
                                                    @foreach (App\Models\Region::all() as $item)
                                                    <option value="{{ $item->region_name }}"
                                                        {{ Auth::user()->portalInfo->region_id == $item->id ? 'selected' : ''}}>
                                                        {{ $item->region_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <div>
                                            <label>Billede <span style="color:red">*</span></label>
                                            <input type="file" class="dropify" name="profilePicture"
                                                data-default-file="{{ Auth::user()->portalInfo->profilePicture }}"
                                                accept=".png, .jpg, .jpeg" data-height="195">
                                        </div>
                                    </div>



                                    <div class="form-group col-md-6">
                                        <div><label>Matchord <span style="color:red">*</span></label></div>
                                        <input data-role="tagsinput" class="form-control" placeholder="Skriv Matchord" name="matchWords"
                                            value="{{Auth::user()->portalInfo->matchWords != null ? implode(", ",json_decode(Auth::user()->portalInfo->matchWords)) : ''}}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div><label>Negative Matchord <span style="color:red">*</span></label></div>
                                        <input data-role="tagsinput" class="form-control" placeholder="Skriv Negative Matchord"
                                            name="nMatchWords" class="input-height"
                                            value="{{Auth::user()->portalInfo->nMatchWords != null ? implode(", ",json_decode(Auth::user()->portalInfo->nMatchWords)) : ''}}">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>Profil Beskrivelse <span style="color:red">*</span></label>
                                        <!-- <input class="form-control" placeholder="Skriv Noget..." name="profile_detail" value="{{Auth::user()->portalInfo->profile_detail}}" required> -->
                                        <textarea type="textarea" rows="5" placeholder="Skriv Noget..." class="form-control"
                                            name="profile_detail"
                                            required>{{ isset(Auth::user()->portalInfo->profile_detail) ? Auth::user()->portalInfo->profile_detail : ''}}</textarea>
                                    </div>


                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn ripple btn-success" type="submit"
                                    style="font-weight: bold;text-transform: uppercase;">Opdatér</button>
                                <button class="btn ripple btn-danger" data-dismiss="modal" type="button"
                                    style="font-weight: bold;text-transform: uppercase;">Tæt</button>
                            </div>
                        {!! Form::close() !!}
                        @endif
                    <!-- Single Profile Form -->

                </div>

            </div>
        </div>
    <!-- ./Profile Edit Modal -->

    <!-- Change Password Modal -->
        <div class="modal" id="change_password_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Ændre Adgangskode</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="POST" action="{{ route('changePassword') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Nuværende Kodeord <span style="color:red">*</span></label>
                                        <input id="current-password" type="password"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="current-password" value="{{ $email ?? old('email') }}" required autofocus>
                                        @if ($errors->has('current-password'))
                                        <span
                                            class="help-block"><strong>{{ $errors->first('current-password') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Nyt Kodeord <span style="color:red">*</span></label>
                                        <input id="new-password" type="password" class="form-control" name="new-password"
                                            required>
                                        @if ($errors->has('new-password'))
                                        <span class="help-block"><strong>{{ $errors->first('new-password') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Bekræft Kodeord <span style="color:red">*</span></label>
                                        <input id="new-password-confirm" type="password" class="form-control"
                                            name="new-password_confirmation" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-success" type="submit"
                                style="font-weight: bold;text-transform: uppercase;">{{ __('Opdater Adgangskode') }}</button>
                            <button class="btn ripple btn-danger" data-dismiss="modal" type="button"
                                style="font-weight: bold;text-transform: uppercase;">Tæt</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- ./Change Password Modal -->

    <!-- Membership Modal -->
    <div class="modal" id="membership_model">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Medlemskaber</h6><button
                        aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- 1-Dating -->
                        <div class="col-sm-6 col-xl-6 col-lg-6">
                            <div class="card custom-card" style="background:#e3ecfb;">
                                <div class="card-body dash1">
                                    <form class="d-inline" method="POST" action="{{ route('portals.store')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="1">
                                        <button type="submit" class="btn ">
                                            <img src="{{ asset('dashlead/img/portal/dating.png')}}" alt="alt" />
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 1-Dating -->
                        <!-- 2-Sugar Dating -->
                        <div class="col-sm-6 col-xl-6 col-lg-6">
                            <div class="card custom-card" style="background:#e2e2e2;">
                                <div class="card-body dash1">
                                    <form class="d-inline" method="POST" action="{{ route('portals.store')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="2">
                                        <button type="submit" class="btn ">
                                            <img src="{{ asset('dashlead/img/portal/sugar-dating.png')}}" alt="alt" />
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 2-Sugar Dating -->
                        <!-- 3-Fræk dating -->
                        <div class="col-sm-6 col-xl-6 col-lg-6">
                            <div class="card custom-card" style="background:#ffe7ef;">
                                <div class="card-body dash1">
                                    <form class="d-inline" method="POST" action="{{ route('portals.store')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="3">
                                        <button type="submit" class="btn ">
                                            <img src="{{ asset('dashlead/img/portal/fraek-dating.png')}}" alt="alt" />
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 3-Fræk dating -->
                        <!-- 4-Badboy Dating -->
                        <!-- <div class="col-sm-6 col-xl-6 col-lg-6">
                                                        <div class="card custom-card">
                                                            <div class="card-body dash1">
                                                                <form class="d-inline" method="POST" action="{{ route('portals.store')}}">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="4">
                                                                    <button type="submit" class="btn ">
                                                                        <img src="{{ asset('dashlead/img/portal2/05.png')}}" alt="alt"/>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div> -->
                        <!-- 4-Badboy Dating -->
                        <!-- 5-Senior Dating -->
                        <!-- <div class="col-sm-6 col-xl-6 col-lg-6">
                                                        <div class="card custom-card">
                                                            <div class="card-body dash1">
                                                                <form class="d-inline" method="POST" action="{{ route('portals.store') }}">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="5">
                                                                    <button type="submit" class="btn ">
                                                                        <img src="{{ asset('dashlead/img/portal2/01.png')}}" alt="alt"/>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div> -->
                        <!-- 5-Senior Dating -->
                        <!-- 6-Regnbue Dating -->
                        <!-- <div class="col-sm-6 col-xl-6 col-lg-6">
                                                        <div class="card custom-card">
                                                            <div class="card-body dash1">
                                                                <form class="d-inline" method="POST" action="{{ route('portals.store')}}">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="6">
                                                                    <button type="submit" class="btn ">
                                                                        <img src="{{ asset('dashlead/img/portal2/04.png')}}" alt="alt"/>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div> -->
                        <!-- 6-Regnbue Dating -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./Membership Modal -->

    <!-- Change Portal Modal -->
    <div class="modal" id="change_portal_model">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Skift Portal</h6><button
                        aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- 1-Dating -->
                        <div class="col-sm-6 col-xl-6 col-lg-6">
                            <div class="card custom-card" style="background:#e3ecfb;">
                                <div class="card-body dash1">
                                    {!! Form::open(['route' => ['portals.update', 1 ], 'method' => 'PUT',
                                    'class'=>'d-inline' ])!!} {{csrf_field()}}
                                    <button type="submit" class="btn">
                                        <img data-toggle="modal" data-target="#portalHelpPopUp" src="{{ asset('dashlead/img/portal/dating.png')}}"/>
                                    </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <!-- 1-Dating -->
                        <!-- 2-Sugar Dating -->
                        <div class="col-sm-6 col-xl-6 col-lg-6">
                            <div class="card custom-card" style="background:#e2e2e2;">
                                <div class="card-body dash1">
                                    {!! Form::open(['route' => ['portals.update', 2 ], 'method' => 'PUT',
                                    'class'=>'d-inline' ])!!} {{csrf_field()}}
                                    <button type="submit" class="btn">
                                        <img data-toggle="modal" data-target="#portalHelpPopUp" src="{{ asset('dashlead/img/portal/sugar-dating.png')}}"/>
                                    </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <!-- 2-Sugar Dating -->
                        <!-- 3-Fræk dating -->
                        <div class="col-sm-6 col-xl-6 col-lg-6">
                            <div class="card custom-card" style="background:#ffe7ef;">
                                <div class="card-body dash1">
                                    {!! Form::open(['route' => ['portals.update', 3 ], 'method' => 'PUT',
                                    'class'=>'d-inline' ])!!} {{csrf_field()}}
                                    <button type="submit" class="btn">
                                        <img data-toggle="modal" data-target="#portalHelpPopUp" src="{{ asset('dashlead/img/portal/fraek-dating.png')}}"/>
                                    </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <!-- 3-Fræk dating -->
                        <!-- 4-Badboy Dating -->
                        <!-- <div class="col-sm-6 col-xl-6 col-lg-6">
                                                        <div class="card custom-card">
                                                            <div class="card-body dash1">
                                                                {{-- {!! Form::open(['route' => ['portals.update', 4 ], 'method' => 'PUT', 'class'=>'d-inline' ])!!} {{csrf_field()}}
                                                                <button type="submit" class="btn " {{!Auth::user()->isPortalUserByAuth(4) ? 'disabled' : ''}}>
                                                                    <img @if(!Auth::user()->isPortalUserByAuth(4)) data-toggle="modal" data-target="#portalHelpPopUp" @endif src="{{ asset('dashlead/img/portal/05.png')}}" alt="alt"/>
                                                                </button> 
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </div>
                                                    </div> -->
                        <!-- 4-Badboy Dating -->
                        <!-- 5-Senior Dating -->
                        <!-- <div class="col-sm-6 col-xl-6 col-lg-6">
                                                        <div class="card custom-card">
                                                            <div class="card-body dash1">
                                                                {!! Form::open(['route' => ['portals.update', 5 ], 'method' => 'PUT', 'class'=>'d-inline' ])!!} 
                                                                {{csrf_field()}}
                                                                <button  type="submit" class="btn " {{!Auth::user()->isPortalUserByAuth(5) ? 'disabled' : ''}}>
                                                                    <img @if(!Auth::user()->isPortalUserByAuth(5)) data-toggle="modal" data-target="#portalHelpPopUp" @endif src="{{ asset('dashlead/img/portal/01.png')}}" alt="alt"/>
                                                                </button> 
                                                                {!! Form::close() !!} --}}
                                                            </div>
                                                        </div>
                                                    </div> -->
                        <!-- 5-Senior Dating -->
                        <!-- 6-Regnbue Dating -->
                        <!-- <div class="col-sm-6 col-xl-6 col-lg-6">
                                                        <div class="card custom-card">
                                                            <div class="card-body dash1">
                                                                {!! Form::open(['route' => ['portals.update', 6 ], 'method' => 'PUT', 'class'=>'d-inline' ])!!} {{csrf_field()}}
                                                                <button type="submit" class="btn " {{!Auth::user()->isPortalUserByAuth(6) ? 'disabled' : ''}}>
                                                                    <img @if(!Auth::user()->isPortalUserByAuth(6)) data-toggle="modal" data-target="#portalHelpPopUp" @endif src="{{ asset('dashlead/img/portal/04.png')}}" alt="alt"/>
                                                                </button> 
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </div>
                                                    </div> -->
                        <!-- 6-Regnbue Dating -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./Change Portal Modal -->

    <!-- Promotion Modal -->
        <!-- <div class="modal" id="promotionModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Fremhæv Profil</h6><button
                            aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>

                    <form id="promotionCreateForm" action="{{route('image-crop')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <div class="row">

                                <div class="col-sm-6 col-md-12">
                                    <input type="file" class="dropify" name="file" accept=".png, .jpg, .jpeg" data-height="200"
                                        required>
                                </div>

                                <div class="col-sm-6 col-md-12">
                                    <div class="form-group">
                                        <textarea maxlength="140" type="text" class="form-control" id="promotionTitle"
                                            name="promotionTitle" placeholder="Skriv din tekst her(Maks. 160 tegn)"></textarea>
                                    </div>
                                </div>


                            </div>

                        </div>

                        <div class="modal-footer">
                            <button class="btn ripple btn-success" type="submit"
                                style="font-weight: bold;text-transform: uppercase;">Fremhæv</button>
                            <button class="btn ripple btn-danger" data-dismiss="modal" type="button"
                                style="font-weight: bold;text-transform: uppercase;">Tæt</button>
                        </div>
                    </form>

                </div>
            </div>
        </div> -->
    <!-- ./Promotion Modal -->

    <!-- Promotion Modal -->
    <div class="modal" id="promotionModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Fremhæv Profil</h6><button
                        aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <!-- Image Section -->
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div id="promotion_image_preview"></div>
                        </div><br>
                        <div class="col-sm-4 col-md-4">
                            <input title="Upload Dit Billede" type="file" class="dropify" id="promotion_image_upload"
                                accept=".png, .jpg, .jpeg" data-max-file-size="5M" data-height="95" data-width="95"
                                required>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <button class="btn btn-primary promotion_image_crop"
                                style="padding:32px; font-weight: bold;text-transform: uppercase;">Beskær Billede</button>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div id="promotion_image_display" align="center" style="background:#e1e1e1;padding:15px;">
                                <div style="text-align: center; margin-top: 20px; margin-bottom: 20px;">
                                    <h6 style="color:#737373;">STØRRELSE 500 x 500</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Image Section -->
                <!-- Form Data -->
                <form method="POST" action="{{ route('promotion.start') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- Image -->
                            <div id="promotion_img_data"></div>
                            <!-- Image -->
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <textarea maxlength="140" type="text" class="form-control" id="promotionTitle"
                                        name="title" placeholder="Skriv din tekst her(Maks. 160 tegn)" required></textarea>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-success" type="submit" id="promotion_image_form_submit"
                            style="font-weight: bold;text-transform: uppercase;">Fremhæv</button>
                        <button class="btn ripple btn-danger" data-dismiss="modal" type="button"
                            style="font-weight: bold;text-transform: uppercase;">Tæt</button>
                    </div>
                </form>
                <!-- Form Data -->
            </div>
        </div>
    </div>
    <!-- ./Promotion Modal -->

    <!-- Status Modal -->
    <div class="modal" id="statusModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Opslag På Væggen</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>

                <form method="POST" action="{{ action('frontEnd\StatusController@store') }}">
                    @csrf
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-sm-6 col-md-12">
                                <div class="form-group">
                                    <label for="name">Overskrift <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="title" value="{{old('title')}}"
                                        placeholder="Titel her" required>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-12">
                                <div class="form-group">
                                    <label for="name">Opslag <span style="color:red">*</span></label>
                                    <textarea maxlength="250" value="{{old('details')}}" placeholder="Skriv noget..."
                                        class="form-control" name="details" rows="3" required></textarea>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn ripple btn-success" type="submit"
                            style="font-weight: bold;text-transform: uppercase;">Læg Op</button>
                        <button class="btn ripple btn-danger" data-dismiss="modal" type="button"
                            style="font-weight: bold;text-transform: uppercase;">Tæt</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- ./Status Modal -->

    <!-- Subcription Modal -->
    <div class="modal" id="showPricesModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Abonnementstype</h6><button
                        aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        @foreach(App\Models\Membership::whereIn('slug',
                        ['free','md','ugo','weekend','day','kvartal','arllg','ar'])->get() as $plan)
                        <div class="col-sm-6 col-lg-6" style="padding-bottom: 20px;">
                            <div class="card overflow-hidden" style="background:#e3ecfb;">
                                <div class="text-center card-pricing pricing1">
                                    <div class="p-2 text-white bg-primary fs-20">{{ $plan->name }}</div>
                                    <h6 class="h6 font-weight-normal text-center mb-0" data-pricing-value="30">kr.
                                        <span class="price">{{ number_format($plan->cost, 2) }}</span>
                                        <span class="h6 text-muted ml-2">/
                                            @if ($plan->name == "Gratis")
                                            Free
                                            @else
                                            {{$plan->duration}}
                                            @endif
                                        </span>
                                    </h6>
                                    <div class="card-body text-center pt-0">
                                        <p>{{ $plan->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./Subcription Modal -->

    <!-- Create Blog Modal -->
    <div class="modal" id="createblogmodel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Opret Blog</h6><button
                        aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('blog.post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Titel <span style="color:red">*</span></label>
                                    <input id="blogTitle" type="text" class="form-control" name="title" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Undertitel <span style="color:red">*</span></label>
                                    <input id="blogSubTitle" type="text" class="form-control" name="sub_title" required>
                                </div>
                            </div>
                            <!-- <div class="col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Blog Indlæg <span style="color:red">*</span></label>
                                        <textarea style="min-height: 200px" class="form-control" id="description" name="details" placeholder="Blog indlæg"></textarea>
                                    </div>
                                    </div> -->
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Blog Indlæg <span style="color:red">*</span></label>
                                    <div class="ql-wrapper">
                                        <div id="createblog">
                                        </div>
                                    </div>
                                    <textarea type="textarea" style="display:none;" id="blogdetails"
                                        name="details"></textarea>
                                </div>
                            </div>
                            <!-- <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Blog Indlæg <span style="color:red">*</span></label>
                                            <div class="ql-wrapper">
                                                <textarea id="createblog" name="details"></textarea>
                                            </div>
                                        </div>
                                    </div> -->
                            <div class="col-sm-6 col-md-12">
                                <input type="file" class="dropify" name="image" accept=".png, .jpg, .jpeg" data-height="200"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-success" type="submit"
                            style="font-weight: bold;text-transform: uppercase;">Skab</button>
                        <button class="btn ripple btn-danger" data-dismiss="modal" type="button"
                            style="font-weight: bold;text-transform: uppercase;">Tæt</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ./Create Blog Modal -->

    <!-- Image Upload Modal -->
    <div class="modal" id="upload_image_model">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Upload Billede</h6><button
                        aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <!-- Image Section -->
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div id="upload_image_tc" style="color:red;">
                                @if(auth()->user()->portalInfo->portal_id == 1 || auth()->user()->portalInfo->portal_id ==
                                5)
                                <ul class="dot-style">
                                    <li>Ingen nøgenhed</li>
                                    <li>Ingen former for pornografi</li>
                                    <li>Ingen former for opfordring til ulovlig aktivitet, racistiske budskaber, vold eller
                                        lignende</li>
                                    <li>Ingen links til andre sider eller anden former for reklame eller budskaber med
                                        salgsøjemed</li>
                                    <li>Det er kun dig der må vises på dine billeder. Hvis andre mennesker forekommer skal
                                        disse, samt synlige kendetegn (tatoveringer
                                        og lign.), fjernes/sløres Dette er undtaget par profiler hvor begge parter gerne må
                                        figurere</li>
                                    <li>Pikante billeder, bikini billeder og lignende er tilladt, vi opfordrer dog til at
                                        du/I tænker over hvad der lægges op offentligt</li>
                                </ul>
                                @else
                                <ul class="dot-style">
                                    <li>Ingen former for opfordring til ulovlig aktivitet, racistiske budskaber, vold eller
                                        lignende</li>
                                    <li>Ingen links til andre sider eller anden former for reklame eller budskaber med
                                        salgsøjemed</li>
                                    <li>Det er kun dig der må vises på dine billeder. Hvis andre mennesker forekommer på
                                        dine billeder, skal disse, samt synlige
                                        kendetegn (tatoveringer og lign.), fjernes/sløres Dette er undtaget par profiler
                                        hvor begge parter gerne må figurere</li>
                                    <li>Frække billeder, pikante billeder, bikini billeder og lignende er tilladt, vi
                                        opfordrer dog til at du/I tænker over hvad
                                        der lægges op offentligt</li>
                                </ul>
                                @endif
                            </div>
                            <div id="upload_image_preview"></div>
                        </div><br>
                        <div class="col-sm-8 col-md-3">
                            <input title="Upload Dit Billede" type="file" class="dropify" id="upload_image_upload"
                                accept=".png, .jpg, .jpeg" data-max-file-size="5M" data-height="130" data-width="250"
                                required>
                        </div>
                        <div class="col-sm-4 col-md-3">
                            <button class="btn btn-primary upload_image_crop"
                                style="padding:50px; font-weight: bold;text-transform: uppercase;">Beskær Billede</button>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div id="upload_image_display" align="center" style="background:#e1e1e1;padding:18px;">
                                <div style="text-align: center; margin-top: 40px; margin-bottom: 40px;">
                                    <h4 style="color:#737373;">STØRRELSE 1920 x 1080</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Image Section -->
                <!-- Form Data -->
                <form method="POST" action="{{ route('imageUpload') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- Image -->
                            <div id="upload_img_data"></div>
                            <!-- Image -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-success" type="submit" id="upload_image_form_submit"
                            style="font-weight: bold;text-transform: uppercase;">Upload</button>
                        <button class="btn ripple btn-danger" data-dismiss="modal" type="button"
                            style="font-weight: bold;text-transform: uppercase;">Tæt</button>
                    </div>
                </form>
                <!-- Form Data -->
            </div>
        </div>
    </div>
    <!-- ./Image Upload Modal -->

    <!-- Video Upload Modal -->
    <div class="modal" id="upload_video_model">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Upload Video</h6><button
                        aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form class="align-middle" action="{{route('videoUpload')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-3">
                                <input title="Upload din video" type="file" name="video" class="dropify"
                                    id="video_upload_file" accept="video/mp4,video/x-m4v,video/*" data-max-file-size="30M"
                                    data-height="220" data-width="250" required>
                                <input type="hidden" name="route" value="{{Route::currentRouteName()}}">
                            </div>
                            <div class="col-sm-12 col-md-9">
                                <div id="upload_video_tc" style="color:red;">
                                    @if(auth()->user()->portalInfo->portal_id == 1 || auth()->user()->portalInfo->portal_id
                                    == 5)
                                    <ul class="dot-style">
                                        <li>Ingen nøgenhed</li>
                                        <li>Ingen former for pornografi</li>
                                        <li>Ingen former for opfordring til ulovlig aktivitet, racistiske budskaber, vold
                                            eller lignende</li>
                                        <li>Ingen links til andre sider eller anden former for reklame eller budskaber med
                                            salgsøjemed</li>
                                        <li>Det er kun dig der må vises på dine billeder. Hvis andre mennesker forekommer
                                            skal disse, samt synlige kendetegn (tatoveringer og lign.), fjernes/sløres Dette
                                            er undtaget par profilerhvor begge parter gerne må figurere</li>
                                        <li>Pikante billeder, bikini billeder og lignende er tilladt, vi opfordrer dog til
                                            at du/I tænkerover hvad der lægges op offentligt</li>
                                        <li>Videoformatet skal være .mp4, og den maksimale størrelse skal være 30 MB.</li>
                                    </ul>
                                    @else
                                    <ul class="dot-style">
                                        <li>Ingen former for opfordring til ulovlig aktivitet, racistiske budskaber, vold
                                            eller lignende</li>
                                        <li>Ingen links til andre sider eller anden former for reklame eller budskaber med
                                            salgsøjemed</li>
                                        <li>Det er kun dig der må vises på dine billeder. Hvis andre mennesker forekommer på
                                            dine billeder,skal disse, samt synlige kendetegn (tatoveringer og lign.),
                                            fjernes/sløres Dette er undtagetpar profiler hvor begge parter gerne må figurere
                                        </li>
                                        <li>Frække billeder, pikante billeder, bikini billeder og lignende er tilladt, vi
                                            opfordrer dog tilat du/I tænker over hvad der lægges op offentligt</li>
                                        <li>Videoformatet skal være .mp4, og den maksimale størrelse skal være 30 MB.</li>
                                    </ul>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="text-center" id="video_upload_display">
                                    <video width="750" controls>
                                        <source id="video_upload_source">Your browser does not support HTML5 video.</video>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-success" type="submit" id="upload_video_form_submit"
                            style="font-weight: bold;text-transform: uppercase;">Upload</button>
                        <button class="btn ripple btn-danger" data-dismiss="modal" type="button"
                            style="font-weight: bold;text-transform: uppercase;">Tæt</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ./Video Upload Modal -->

<!-- ./Developed By CBS -->
