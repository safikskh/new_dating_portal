<!-- Developed By CBS -->
    @extends('dashlead.layouts.layout')
    @section('pageTitle', 'Avanceret Søgning')
    @section('content')    

    <!-- Main Content-->
        <div class="main-content pt-0">
            <div class="container">

            <!-- Page Header -->
                    <div class="page-header">
                        </div>
                    <!-- End Page Header -->

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">

                            <div style="font-weight: bold; margin-bottom: 20px; text-transform:uppercase;">
                                <h4>Avanceret Søgning</h4><hr>
                            </div>

                            <form method="POST" action="{{route('post.advancesearch')}}">
                                @csrf
                                <div class="row">
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                                <label style="font-weight: bold; font-size: 20px;">Brugernavn</label>
                                                <input type="text"  placeholder="Søg I Brugernavn" name="username" class="form-control">
                                            </div>
                                            <div class="form-group ">
                                                <p style="font-weight: bold; font-size: 20px;" class="mb-2">Køn</p>
                                                <div class="selectgroup selectgroup-pills">
                                                    <label class="selectgroup-item ">
                                                        <input type="checkbox" name="man" value="{{App\Enums\Sex::getValue('Mand')}}" class="selectgroup-input">
                                                        <span class="selectgroup-button rounded-0">Mænd</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="checkbox" name="woman" value="{{App\Enums\Sex::getValue('Mand')}}" class="selectgroup-input">
                                                        <span class="selectgroup-button rounded-0">Kvinder</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="checkbox" name="couple" value="{{App\Enums\Sex::getValue('Par')}}" class="selectgroup-input">
                                                        <span class="selectgroup-button rounded-0">Par</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label style="font-weight: bold; font-size: 20px;">Område</label>
                                                <select name="area[]" class="form-control select2" multiple="multiple"  title="Vælg Valgmulighed">
                                                    @foreach (App\Models\Region::all() as $item)
                                                    <option value="{{ $item->id }} ">{{ $item->region_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group ">
                                                <p style="font-weight: bold; font-size: 20px;" class="mb-2">Type</p>
                                                <div class="selectgroup selectgroup-pills">
                                                    <label class="selectgroup-item ">
                                                        <input type="checkbox" name="havepictre" value="havepictre" class="selectgroup-input">
                                                        <span class="selectgroup-button rounded-0">Har Billeder</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="checkbox" name="havevideo" value="havevideo" class="selectgroup-input">
                                                        <span class="selectgroup-button rounded-0">Har Videoer</span>
                                                    </label>
                                                    <!-- <label class="selectgroup-item">
                                                        <input type="checkbox" name="userType" value="newUser" class="selectgroup-input">
                                                        <span class="selectgroup-button rounded-0">NEM-ID Valideret</span>
                                                    </label> -->
                                                    <label class="selectgroup-item">
                                                        <input type="checkbox" name="inarelationship" value="i et forhold" class="selectgroup-input">
                                                        <span class="selectgroup-button rounded-0">I Forhold</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label style="font-weight: bold; font-size: 20px;">Sidst Online</label>
                                                <select name="onlinePresence" class="form-control select2-no-search" title="Vælg Valgmulighed">
                                                    <option value="anyTime">Når Som Helst</option>
                                                    <option value="online">Online Nu</option>
                                                    <option value="lastDay">Seneste Uge</option>
                                                    <option value="lastWeek">Seneste Uge</option>
                                                    <option value="lastMonth">Seneste Måned</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label style="font-weight: bold; font-size: 20px;">Søger</label>
                                                <select name="searching[]" class="form-control select2" multiple="multiple"  title="Vælg Valgmulighed">
                                                    @foreach (App\Enums\Searching::getValues() as $item)
                                                    <option value="{{$item}}"> {{$item}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label style="font-weight: bold; font-size: 20px;">Matchord</label>
                                                <input data-role="tagsinput"  placeholder="Vælg Valgmulighed" name="matchword" class="form-control">
                                            </div>
                                            <div class="form-group ">
                                                <label style="font-weight: bold; font-size: 20px;">Alder</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <select name="minAge" class="form-control select2">
                                                            <option disabled selected>---Vælg Minimums Alder---</option>
                                                            @for($age = 18; $age <= 100; $age++)
                                                                <option value="{{$age}}">{{$age}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="maxAge" class="form-control select2">
                                                            <option disabled selected>---Vælg Maksimal Alder---</option>
                                                            @for($age = 18; $age <= 100; $age++)
                                                                <option value="{{$age}}">{{$age}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label style="font-weight: bold; font-size: 20px;">Vægt</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <select name="minWeight" class="form-control select2">
                                                            <option disabled selected>---Vælg Minimums Vægt---</option>
                                                            @foreach (App\Enums\Weight::getValues() as $item)
                                                                <option value="{{ $item }}">{{ $item }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="maxWeight" class="form-control select2">
                                                            <option disabled selected>---Vælg Maksimal Vægt---</option>
                                                            @foreach (App\Enums\Weight::getValues() as $item)
                                                                <option value="{{ $item }}">{{ $item }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label style="font-weight: bold; font-size: 20px;">Højde</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <select name="minHeight" class="form-control select2">
                                                            <option disabled selected>---Vælg Minimums Højde---</option>
                                                            @foreach (App\Enums\Height::getValues() as $item)
                                                                <option value="{{ $item }}">{{ $item }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="maxHeight" class="form-control select2">
                                                            <option disabled selected>---Vælg Maksimal Højde---</option>
                                                            @foreach (App\Enums\Height::getValues() as $item)
                                                                <option value="{{ $item }}">{{ $item }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label style="font-weight: bold; font-size: 20px;">Seksualitet</label>
                                                <select name="sexualOrientation" class="form-control select2">
                                                    <option disabled selected>---Vælg Valgmulighed---</option>
                                                    @foreach (App\Enums\SexualOrientation::getValues() as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group ">
                                                <label style="font-weight: bold; font-size: 20px;">Kropsbygning</label>
                                                <select name="bodyType" class="form-control select2">
                                                    <option disabled selected>---Vælg Valgmulighed---</option>
                                                    @foreach (App\Enums\BodyType::getValues() as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group ">
                                                <label style="font-weight: bold; font-size: 20px;">Tatoveringer</label>
                                                <select name="tattoos" class="form-control select2-no-search">
                                                    <option disabled selected>---Vælg Valgmulighed---</option>
                                                    @foreach (App\Enums\Tattoos::getValues() as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group ">
                                                <label style="font-weight: bold; font-size: 20px;">Piercinger</label>
                                                <select name="piercing" class="form-control select2-no-search">
                                                    <option disabled selected>---Vælg Valgmulighed---</option>
                                                    @foreach (App\Enums\Piercing::getValues() as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group ">
                                                <label style="font-weight: bold; font-size: 20px;">Ryger</label>
                                                <select name="smoking" class="form-control select2-no-search">
                                                    <option disabled selected>---Vælg Valgmulighed---</option>
                                                    @foreach (App\Enums\Smoking::getValues() as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group ">
                                                <label style="font-weight: bold; font-size: 20px;">Børn</label>
                                                <select name="children" class="form-control select2">
                                                    <option disabled selected>---Vælg Valgmulighed---</option>
                                                    @foreach (App\Enums\Children::getValues() as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group ">
                                                <label style="font-weight: bold; font-size: 20px;">Øjenfarve</label>
                                                <select name="eyeColor" class="form-control select2">
                                                    <option disabled selected>---Vælg Valgmulighed---</option>
                                                    @foreach (App\Enums\EyeColor::getValues() as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group ">
                                                <label style="font-weight: bold; font-size: 20px;">Hårfarve</label>
                                                <select name="hairColor" class="form-control select2">
                                                    <option disabled selected>---Vælg Valgmulighed---</option>
                                                    @foreach (App\Enums\HairColor::getValues() as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn ripple btn-success" type="submit" style="font-weight: bold;text-transform: uppercase;">Søg</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
    <!-- Main Content-->
        
    @endsection
<!-- Developed By CBS -->
