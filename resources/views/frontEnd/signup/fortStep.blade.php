<!-- Developed By CBS -->
    @extends('dashlead.layouts.signup_layout')
    @section('pageTitle', 'Fuldfør din profil')
    @section('content')
    <!-- pageContent area-->
    <div class="main-content pt-0">
        <div class="container">

            <!-- Row -->
            <div class="row row-sm">

                <!-- Page Header -->
                <div class="page-header"></div>
                <!-- End Page Header -->

                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">

                            <div>
                                <h5 class="card-title mb-1" style="font-weight:bold; text-transform:uppercase;">Fuldfør din profil </h5><hr>
                            </div>
                            {!! Form::open(['route' => ['signup.submit'], 'method' => 'POST'])!!}
                            {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <label>Brugernavn <span style="color:red">*</span></label>
                                            <input class="form-control" placeholder="Brugernavn" name="username" value="{{old('username')}}" required>
                                            @if ($errors->has('username'))
                                            <span class=" text-danger" role="alert">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <label>Lokation <span style="color:red">*</span></label>
                                            <select name="region_id" class="form-control select select2" required>
                                                @if(old('region_id') == null)
                                                    <option value="" selected disabled>Vælg din mulighed</option>
                                                @endif
                                                @foreach (App\Models\Region::all() as $item)
                                                <option value="{{$item->id}}" {{$item == old('region_id') ? 'selected' : ''}}>{{ $item->region_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <label>Seksualitet <span style="color:red">*</span></label>
                                            <select name="sexualOrientation" class="form-control select select2" required>
                                                @if(old('sexualOrientation') == null)
                                                    <option value="" selected disabled>Vælg din mulighed</option>
                                                @endif
                                                @foreach (App\Enums\SexualOrientation::getValues() as $item)
                                                    <option value="{{$item}}" {{$item == old('sexualOrientation') ? 'selected' : ''}}>{{$item}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                        <label>Søger <span style="color:red">*</span></label>
                                        <select name="searching[]" class="form-control select select2" multiple title="Vælg din mulighed" required>
                                            @foreach (App\Enums\Searching::getValues() as $item)
                                            <option value="{{$item}}"
                                                @if(old('searching') !=null)
                                                    @foreach(old('searching') as $p)
                                                        @if($item==$p) selected="selected"
                                                        @endif
                                                    @endforeach
                                                @endif>
                                                    {{$item}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <label>Civilstatus <span style="color:red">*</span></label>
                                            <select name="civilStatus" class="form-control select select2" required>
                                                @if(old('civilStatus') == null)
                                                    <option value="" selected disabled>Vælg din mulighed</option>
                                                    @endif
                                                    @foreach (App\Enums\CivilStatus::getValues() as $item)
                                                    <option value="{{ $item }}" {{ old('civilStatus') == $item ? 'selected' : ''}}>
                                                        {{ $item }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <label>Kropsbygning <span style="color:red">*</span></label>
                                            <select name="bodyType" class="form-control select select2" required>
                                                @if(old('bodyType') == null)
                                                <option value="" selected disabled>Vælg din mulighed</option>
                                                @endif
                                                @foreach (App\Enums\BodyType::getValues() as $item)
                                                <option value="{{ $item }}" {{ old('bodyType') == $item ? 'selected' : ''}}>
                                                    {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <label>Højde <span style="color:red">*</span></label>
                                            <select name="height" class="form-control select select2" required>
                                                @if(old('height') == null)
                                                <option value="" selected disabled>Vælg din mulighed</option>
                                                @endif
                                                @foreach (App\Enums\Height::getValues() as $item)
                                                <option value="{{ $item }}" {{ old('height') == $item ? 'selected' : ''}}>
                                                    {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <label>Vægt <span style="color:red">*</span></label>
                                            <select name="weight" class="form-control select select2" required>
                                                @if(old('weight') == null)
                                                <option value="" selected disabled>Vælg din mulighed</option>
                                                @endif
                                                @foreach (App\Enums\Weight::getValues() as $item)
                                                <option value="{{ $item }}" {{ old('weight') == $item ? 'selected' : ''}}>
                                                    {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <label>Postnummer <span style="color:red">*</span></label>
                                            <input class="form-control" placeholder="Postnummer" name="zipCode" class="input-height" value="{{old('zipCode')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <label>Øjenfarve <span style="color:red">*</span></label>
                                            <select name="eyeColor" class="form-control select select2" required>
                                                @if(old('eyeColor') == null)
                                                <option value="" selected disabled>Vælg din mulighed</option>
                                                @endif
                                                @foreach (App\Enums\EyeColor::getValues() as $item)
                                                <option value="{{ $item}}" {{ old('eyeColor') == $item ? 'selected' : ''}}>
                                                    {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <label>Hårfarve <span style="color:red">*</span></label>
                                            <select name="hairColor" class="form-control select select2" required>
                                                @if(old('hairColor') == null)
                                                <option value="" selected disabled>Vælg din mulighed</option>
                                                @endif
                                                @foreach (App\Enums\HairColor::getValues() as $item)
                                                <option value="{{ $item }}" {{ old('hairColor') == $item ? 'selected' : ''}}>
                                                    {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <label>Ryger <span style="color:red">*</span></label>
                                            <select name="smoking" id="" class="form-control select select2" required>
                                                @if(old('smoking') == null)
                                                <option value="" selected disabled>Vælg din mulighed</option>
                                                @endif
                                                @foreach (App\Enums\Smoking::getValues() as $item)
                                                <option value="{{ $item }}" {{ old('smoking') == $item ? 'selected' : ''}}>
                                                    {{ $item }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <label>Piercinger <span style="color:red">*</span></label>
                                            <select name="piercing" class="form-control select select2" required>
                                                @if(old('piercing') == null)
                                                    <option value="" selected disabled>Vælg din mulighed</option>
                                                @endif
                                                @foreach (App\Enums\Piercing::getValues() as $item)
                                                <option value="{{ $item }}" {{ old('piercing') == $item ? 'selected' : ''}}>
                                                    {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <label>Børn <span style="color:red">*</span></label>
                                            <select name="children" class="form-control select select2" required>
                                                @if(old('children') == null)
                                                <option value="" selected disabled>Vælg din mulighed</option>
                                                @endif
                                                @foreach (App\Enums\Children::getValues() as $item)
                                                <option value="{{ $item }}" {{ old('children') == $item ? 'selected' : ''}}>
                                                    {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <label>Tatoveringer <span style="color:red">*</span></label>
                                            <select name="tattoos" class="form-control select select2" required>
                                                @if(old('tattoos') == null)
                                                <option value="" selected disabled>Vælg din mulighed</option>
                                                @endif
                                                @foreach (App\Enums\Tattoos::getValues() as $item)
                                                <option value="{{ $item }}" {{ old('tattoos') == $item ? 'selected' : ''}}>
                                                    {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <div><label>Matchord <span style="color:red">*</span></label></div>
                                            <input data-role="tagsinput" class="form-control" placeholder="Skriv Matchord" name="matchWords" value="{{old('matchWords')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <div><label>Negative Matchord <span style="color:blue">(Hvis Nogen)</span></label></div>
                                            <input data-role="tagsinput" class="form-control" placeholder="Skriv Negative Matchord"
                                            name="nMatchWords" class="input-height" value="{{old('nMatchWords')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <input title="Upload Dit Billede" type="file" class="dropify" id="profileImageUpload" accept=".png, .jpg, .jpeg" data-max-file-size="5M" data-height="130" data-width="250" name="profilePicture" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-8 col-xl-8">
                                        <div class="form-group">
                                            <label>Profil Beskrivelse <span style="color:red">*</span></label>
                                            <textarea type="textarea" rows="4" placeholder="Skriv Noget..." class="form-control" name="profile_detail" required></textarea>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-12 col-lg-12 col-xl-12">
                                        <button style="font-weight: bold;text-transform: uppercase;" class="btn ripple btn-main-primary btn-block">Gem</button>
                                    </div> -->
                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <button style="font-weight: bold;text-transform: uppercase;" class="btn ripple btn-main-primary btn-block">Gem</button>
                                    </div>


                                </div>

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>

            </div>
            <!-- End Row -->

        </div>
    </div>
     <!-- end pageContent area-->
    @endsection
<!-- Developed By CBS -->




