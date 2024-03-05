<!-- Developed By CBS -->
    @extends('dashlead.layouts.layout')
    @section('pageTitle', '| Forside')
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
                            @if(auth()->user()->portalInfo->sex == App\Enums\Sex::getValue('Par'))
                                @include('dashlead.layouts.coupleInfo.editCoupleInfo')                
                            @else
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
                                                    <label>Billede</label>
                                                    <input type="file" class="dropify" name="profilePicture"
                                                        data-default-file="{{ Auth::user()->portalInfo->profilePicture }}"
                                                        accept=".png, .jpg, .jpeg" data-height="195">
                                                </div>
                                            </div>



                                            <div class="form-group col-md-6">
                                                <div><label>Matchord</label></div>
                                                <input data-role="tagsinput" class="form-control" placeholder="Skriv Matchord" name="matchWords"
                                                    value="{{Auth::user()->portalInfo->matchWords != null ? implode(", ",json_decode(Auth::user()->portalInfo->matchWords)) : ''}}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div><label>Negative Matchord</label></div>
                                                <input data-role="tagsinput" class="form-control" placeholder="Skriv Negative Matchord"
                                                    name="nMatchWords" class="input-height"
                                                    value="{{Auth::user()->portalInfo->nMatchWords != null ? implode(", ",json_decode(Auth::user()->portalInfo->nMatchWords)) : ''}}">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn ripple btn-success" type="submit"
                                            style="font-weight: bold;text-transform: uppercase;">Opdatér</button>
                                    </div>
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
    <!-- Main Content-->

    {{-- welcom modal --}}
        @if (empty($errors->first()))
        <!-- onloadWelcomeModal-->
			<div class="modal" id="onloadWelcomeModal">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Velkommen</h6>
							<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
									aria-hidden="true">&times;</span></button>
						</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-12 col-md-12">
										<p>
											Velkommen til din nye portal her på Datingportalen.com. <br> Såfremt du ønsker at være anonym på din nye portal, har du mulighed
											for at ændre dine oplysninger såsom profilnavn og profilbillede, hvis du ønsker at være anonym i forhold til dine andre profiler
											her på siden. Bemærk at ingen billeder eller videoer bliver trukket med over i din nye portal. <br> <br>
											Med venlig hilsen <br> Datingportalen.com
										</p>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button class="btn ripple btn-danger" data-dismiss="modal" type="button"
									style="font-weight: bold;text-transform: uppercase;">Tæt</button>
							</div>
					</div>
				</div>
			</div>
		<!-- onloadWelcomeModal-->
        @endif
        
    @endsection

    @push('script')

        <!-- onloadWelcomeModal show-->
			<script>
				$(document).ready(function(){
					$("#onloadWelcomeModal").modal('show');
				});
			</script>
		<!-- onloadWelcomeModal show-->

    @endpush
<!-- Developed By CBS -->

