<!-- Developed By CBS -->
    <div class="row">
        <input type="hidden" name="coupleId" value="{{$editItem->id}}">
        <div class="col-sm-6 col-md-3">
            <div class="form-group">
                <label>E-mail <span style="color:red">*</span></label>
                <input class="form-control" type="email" placeholder="mail@mailesen.mail" name="email"
                    value="{{Auth::user()->email}}" required> @if ($errors->has('email'))
                <span class=" text-danger" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span> @endif
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group">
                <label>Brugernavn <span style="color:red">*</span></label>
                <input class="form-control" placeholder="Brugernavn" name="username"
                    value="{{Auth::user()->portalInfo->userName}}"> @if ($errors->has('username'))
                <span class=" text-danger" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                </span> @endif
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group">
                <label>Fornavn <span style="color:red">*</span></label>
                <input class="form-control" placeholder="fornavn" name="firstName" id="Fornavn" value="{{$editItem->firstName}}" required>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group">
                <label>Efternavn <span style="color:red">*</span></label>
                <input class="form-control" placeholder="efternavn" name="lastName" id="efternavn" value="{{$editItem->lastName}}" required>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group">
                <label>Fødselsdag <span style="color:red">*</span></label>
                <input class="form-control" type="date" placeholder="dd/mm/yyyy" name="dob"
                    value="{{$editItem->dob}}" required> @if ($errors->has('dob'))
                <span class=" text-danger" role="alert">
                    <strong>{{ $errors->first('dob') }}</strong>
                </span> @endif
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group">
                <label>Køn <span style="color:red">*</span></label>
                <select style="width: 100%" name="sex" class="form-control select2">
                    @if($editItem->sex == null)
                    <option value="" selected disabled>Vælg din mulighed</option>
                    @endif
                    @foreach ([App\Enums\Sex::getValue('Mand'),App\Enums\Sex::getValue('Kvinde')] as $item)
                    <option value="{{ $item }}" {{ $editItem->sex == $item ? 'selected' : ''}}>
                        {{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group col-md-3">
            <label>Seksualitet <span style="color:red">*</span></label>
                <select name="sexualOrientation" class="form-control select2" required>
                    @if($editItem->sexualOrientation == null)
                    <option value="" selected disabled>Vælg din mulighed</option>
                    @endif
                    @foreach (App\Enums\SexualOrientation::getValues() as $item)
                    <option value="{{ $item }}"
                        {{ $editItem->sexualOrientation == $item ? 'selected' : ''}}>
                        {{ $item }}</option>
                    @endforeach
                </select>
        </div>
        <div class="form-group col-md-3">
            <label>Civilstatus <span style="color:red">*</span></label>
                <select name="civilStatus" class="form-control select2" required>
                    @if($editItem->civilStatus == null)
                    <option value="" selected disabled>Vælg din mulighed</option>
                    @endif
                    @foreach (App\Enums\CivilStatus::getValues() as $item)
                    <option value="{{ $item }}"
                        {{ $editItem->civilStatus == $item ? 'selected' : ''}}>{{ $item }}
                    </option>
                    @endforeach
                </select>
        </div>
        <div class="form-group col-md-3">
            <label>Kropsbygning <span style="color:red">*</span></label>
                <select name="bodyType" class="form-control select2" required>
                    @if($editItem->bodyType == null)
                    <option value="" selected disabled>Vælg din mulighed</option>
                    @endif
                    @foreach (App\Enums\BodyType::getValues() as $item)
                    <option value="{{ $item }}"
                        {{ $editItem->bodyType == $item ? 'selected' : ''}}>{{ $item }}
                    </option>
                    @endforeach
                </select>
        </div>
        <div class="form-group col-md-3">
            <label>Højde <span style="color:red">*</span></label>
                <select name="height" class="form-control select2" required>
                    @if($editItem->height == null)
                    <option value="" selected disabled>Vælg din mulighed</option>
                    @endif
                    @foreach (App\Enums\Height::getValues() as $item)
                    <option value="{{ $item }}"
                        {{ $editItem->height == $item ? 'selected' : ''}}>{{ $item }}</option>
                    @endforeach
                </select>
        </div>
        <div class="form-group col-md-6">
            <label>Søger <span style="color:red">*</span></label>
            <select multiple="multiple" class="selectsum2" name="searching[]">
                @foreach (App\Enums\Searching::getValues() as $item)
                    <option value="{{$item}}"
                    @if(json_decode($editItem->searching) != null)
                        @foreach(json_decode($editItem->searching) as $p)
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
                        @if($editItem->weight == null)
                        <option value="" selected disabled>Vælg din mulighed</option>
                        @endif
                        @foreach (App\Enums\Weight::getValues() as $item)
                        <option value="{{ $item }}"
                            {{ $editItem->weight == $item ? 'selected' : ''}}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Postnummer <span style="color:red">*</span></label>
                    <input class="form-control" placeholder="Postnummer" name="zipCode" class="input-height" value="{{Auth::user()->portalInfo->zipCode}}" required>
                </div>
                <div class="form-group col-md-4">
                    <label>Øjenfarve <span style="color:red">*</span></label>
                    <select name="eyeColor" class="form-control select2" required>
                        @if($editItem->eyeColor == null)
                        <option value="" selected disabled>Vælg din mulighed</option>
                        @endif
                        @foreach (App\Enums\EyeColor::getValues() as $item)
                        <option value="{{ $item}}"
                            {{ $editItem->eyeColor == $item ? 'selected' : ''}}>{{ $item }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Hårfarve <span style="color:red">*</span></label>
                        <select name="hairColor" class="form-control select2" required>
                        @if($editItem->hairColor == null)
                        <option value="" selected disabled>Vælg din mulighed</option>
                        @endif
                        @foreach (App\Enums\HairColor::getValues() as $item)
                        <option value="{{ $item }}"
                            {{ $editItem->hairColor == $item ? 'selected' : ''}}>{{ $item }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Ryger <span style="color:red">*</span></label>
                    <select name="smoking" id="" class="form-control select2-no-search" required>
                        @if($editItem->smoking == null)
                        <option value="" selected disabled>Vælg din mulighed</option>
                        @endif
                        @foreach (App\Enums\Smoking::getValues() as $item)
                        <option value="{{ $item }}"
                            {{ $editItem->smoking == $item ? 'selected' : ''}}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Piercinger <span style="color:red">*</span></label>
                    <select name="piercing" class="form-control select2-no-search" required>
                        @if($editItem->piercing == null)
                        <option value="" selected disabled>Vælg din mulighed</option>
                        @endif
                        @foreach (App\Enums\Piercing::getValues() as $item)
                        <option value="{{ $item }}"
                            {{ $editItem->piercing == $item ? 'selected' : ''}}>{{ $item }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Børn <span style="color:red">*</span></label>
                    <select name="children" class="form-control select2" required>
                        @if($editItem->children == null)
                        <option value="" selected disabled>Vælg din mulighed</option>
                        @endif
                        @foreach (App\Enums\Children::getValues() as $item)
                        <option value="{{ $item }}"
                            {{ $editItem->children == $item ? 'selected' : ''}}>{{ $item }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Tatoveringer <span style="color:red">*</span></label>
                    <select name="tattoos" class="form-control select2-no-search" required>
                        @if($editItem->tattoos == null)
                        <option value="" selected disabled>Vælg din mulighed</option>
                        @endif
                        @foreach (App\Enums\Tattoos::getValues() as $item)
                        <option value="{{ $item }}"
                            {{ $editItem->tattoos == $item ? 'selected' : ''}}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Lokation <span style="color:red">*</span></label>
                    <select name="region" class="form-control" required select2>
                        @if($editItem->region_id == null)
                        <option value="" selected disabled>Vælg din mulighed</option>
                        @endif
                        @foreach (App\Models\Region::all() as $item)
                        <option value="{{ $item->region_name }}"
                            {{ Auth::user()->portalInfo->region_id == $item->id ? 'selected' : ''}}>{{ $item->region_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group col-md-3">
            <div>
                <label>Billede <span style="color:red">*</span></label>
                <input type="file" class="dropify" name="profilePicture" data-default-file="{{ $editItem->profilePicture }}" accept=".png, .jpg, .jpeg" data-height="195">
            </div>
        </div>
        <div class="form-group col-md-6">
            <div><label>Matchord <span style="color:red">*</span></label></div>
            <input  data-role="tagsinput" class="form-control" placeholder="Skriv Matchord" 
            name="matchWords" value="{{Auth::user()->portalInfo->matchWords != null ? implode(", ",json_decode(Auth::user()->portalInfo->matchWords)) : ''}}">
        </div>
        <div class="form-group col-md-6">
            <div><label>Negative Matchord <span style="color:red">*</span></label></div>
            <input data-role="tagsinput" class="form-control" placeholder="Skriv Negative Matchord" name="nMatchWords" 
            class="input-height" value="{{Auth::user()->portalInfo->nMatchWords != null ? implode(", ",json_decode(Auth::user()->portalInfo->nMatchWords)) : ''}}">
        </div>
         <div class="form-group col-md-12">
            <label>Profil Beskrivelse <span style="color:red">*</span></label>
            <textarea type="textarea" rows="5" placeholder="Skriv Noget..." class="form-control" name="profile_detail" required>{{ isset(Auth::user()->portalInfo->profile_detail) ? Auth::user()->portalInfo->profile_detail : ''}}</textarea>
        </div>
    </div>
<!-- ./Developed By CBS -->