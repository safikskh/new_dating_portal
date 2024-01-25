@extends('dashlead.layouts.layout')
{{-- @section('pageTitle', 'Min profil') --}}
<title>{{$othersUser->portalInfo->userName}} | Dating Portalen</title>
@push('style')
  <!---Gallery css-->
  <link href="{{ asset('dashlead/plugins/gallery/gallery.css') }}" rel="stylesheet">
@endpush
@section('content')

    <!-- Main Content-->
            <div class="main-content pt-0">
                <div class="container">

                <!-- Page Header -->
				  <div class="page-header">
					</div>
				<!-- End Page Header -->

                <!-- Row -->
                    <div class="row">

                        <!-- Sidebar Section -->
                            <div class="col-lg-3 col-md-3">

                                <div class="card custom-card">
                                    <div class="card-body text-center">
                                        <div class="main-profile-overview widget-user-image text-center">

                                            @if($othersUser->portalInfo->sex == App\Enums\Sex::getValue('Par'))

                                                    <div style="overflow: hidden;justify-content:space-around;">
                                                        <div style="max-width: 40%;max-height: 40%;display: inline-block;">
                                                            @if(File::exists($othersUser->portalInfo->coupleMale()->profilePicture)) 
                                                                <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{asset($othersUser->portalInfo->coupleMale()->profilePicture)}}">
                                                            @else
                                                                <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle">
                                                            @endif
                                                        </div>
                                                        <div style="max-width: 40%;max-height: 40%;display: inline-block;">
                                                            @if(File::exists($othersUser->portalInfo->coupleFemale()->profilePicture)) 
                                                                <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{asset($othersUser->portalInfo->coupleFemale()->profilePicture)}}">
                                                            @else
                                                                <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle">
                                                            @endif
                                                        </div>
                                                    </div>

                                            @else
                                            <div class="main-img-user">
                                                @if(File::exists($othersUser->portalInfo->profilePicture)) 
                                                    <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{asset($othersUser->portalInfo->profilePicture)}}">
                                                @else
                                                    <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle">
                                                @endif
                                            </div>
                                            @endif

                                        </div>

                                        <div class="text-center">
                                            <h4 class="pro-user-username text-dark mt-2 mb-2" style="font-weight: bold; text-transform:uppercase;">{{$othersUser->portalInfo->userName}}</h4>

                                            @if($othersUser->isPaid())
                                                    <h5><span style="font-weight:bold; text-transform:uppercase;" class="badge badge-success">Medlem</span></h5>
                                            @else
                                                    <h5><span style="font-weight:bold; text-transform:uppercase;" class="badge badge-danger">Ikke Medlem</span></h5>
                                            @endif
                                            

                                            <div class="btn-icon-list text-center">
                                                <a class="btn ripple btn-primary btn-icon" style="margin-left:25px;" data-target="#profile_reportModal" data-toggle="modal" href="#"><i class="fas fa-flag"></i></a>
                                                <a class="btn ripple btn-info btn-icon" data-target="#profile_chatModal" data-toggle="modal" href="#"><i class="fas fa-comments"></i></a>
                                                <form action="{{ route('favourite') }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="favourite_by" value="{{ $userID }}">
                                                    <input type="hidden" name="favourite_to" value="{{ $singleProfileID }}">
                                                    @if($checkFavourite == null)
                                                        <button type="submit" class="btn ripple btn-light btn-icon" style="margin-top:15px; margin-left:5px;"><i class="fas fa-heart"></i></button>
                                                    @else
                                                        <button type="submit" class="btn ripple btn-success btn-icon" style="margin-top:15px; margin-left:5px;"><i class="fas fa-heart"></i></button>
                                                    @endif
                                                </form>
                                                <form action="{{ route('userBlock') }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="block_by" value="{{ $userID }}">
                                                    <input type="hidden" name="block_to" value="{{ $singleProfileID }}">
                                                    <button type="submit" class="btn ripple btn-danger btn-icon" style="margin-top:15px; margin-left:5px;" {{auth()->user()->isPaid() ? '' : 'disabled'}}><i class="fas fa-ban"></i></button>
                                                </form>
                                            </div>


                                        </div>
                                    </div>
                                    
                                </div>

                                @if( ($othersUser->portalInfo->matchWords != '[""]') && ($othersUser->portalInfo->matchWords != null) )                
                                    <div class="card custom-card">
                                        <div class="card-header custom-card-header">
                                            <div>
                                                <h6 class="card-title mb-0" style="font-weight:bold; text-transform:uppercase;">Matchord</h6>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="skill-tags">
                                                <ul class="list-unstyled mb-0">
                                                    @foreach(json_decode($othersUser->portalInfo->matchWords) as $matchWord) 
                                                        <li style="font-weight:bold; text-transform:uppercase;"><a href="#">{{$matchWord}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="card custom-card">
                                    <div class="card-header custom-card-header">
                                        <div>
                                            <h6 class="card-title mb-0" style="font-weight:bold; text-transform:uppercase;">Rating</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                    <div class="messages-profile-header-area">
                                        <form action="{{ route('rating') }}" method="POST">
                                            {{ csrf_field() }}  

                                            @if(auth()->user()->isEligibleForRating($singleProfileID))                  
                                            <input type="hidden" name="from_user_id" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="to_user_id" value="{{ $singleProfileID }}">

                                            <div class="rating-stars block" id="rating">
                                                <input type="number" readonly="readonly" class="rating-value" name="rating_value" id="rating-stars-value">
                                                <div class="rating-stars-container">
                                                    <div class="rating-star">
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div class="rating-star">
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div class="rating-star">
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div class="rating-star">
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div class="rating-star">
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            @else
                                                <div class="text-center">
                                                    @foreach(range(1,5) as $i)
                                                    @if($ratings > 0)
                                                    @if($ratings >= 1)
                                                    <i class="fa fa-star fa-lg" aria-hidden="true" style="color: #f87d53;font-size: 30px;"></i>
                                                    @else
                                                    <i class="fa fa-star-half-o fa-lg" aria-hidden="true" style="color: #f87d53; font-size: 30px;"></i>
                                                    @endif
                                                    @else
                                                    <i style="font-size: 30px;" class="fa  fa-star-o fa-lg" aria-hidden="true"></i>
                                                    @endif
                                                    <?php $ratings --; ?>
                                                    @endforeach
                                                </div><br>
                                            @endif

                                            <div class="text-center">
                                                <button  type="submit" class="btn ripple btn-main-primary" {{auth()->user()->isEligibleForRating($singleProfileID) ? '' : 'disabled'}}>Bedøm</button>
                                            </div>
                                        </form>
                                        <div class="rating-details text-center" style="font-weight:bold; text-transform:uppercase;">              
                                            <h5><span style="color: #38c172">{{ $rating }}</span> Ud af 5 [ <span style="color: #38c172">{{ $viewer }}</span> brugere ]</h5>
                                        </div>
                                    </div>

                                    </div>
                                </div>

                            </div>
                        <!-- Sidebar Section -->

                        <!-- Main Section -->
                            <div class="col-lg-6 col-md-6">
                                <div class="card custom-card main-content-body-profile">
                                    <nav class="nav main-nav-line">
                                        <a class="nav-link active" data-toggle="tab" href="#tab1over">OVERSIGT</a>
                                        <a class="nav-link" data-toggle="tab" href="#tab2rev">BILLEDER</a>
                                        <a class="nav-link" data-toggle="tab" href="#tab3rev">VIDEOER</a>
                                    </nav>
                                    <div class="card-body tab-content h-100">

                                        <!-- Overview -->
                                            <div class="tab-pane active" id="tab1over">

                                                    @if($othersUser->portalInfo->profile_detail != null)
                                                        <div class="main-content-label tx-13 mg-b-20">
                                                            Profil Beskrivelse
                                                        </div>
                                                        <p>{{$othersUser->portalInfo->profile_detail }}</p>
                                                    @endif

                                                    <div class="main-content-label tx-13 mg-b-20">
                                                        Personlig Information
                                                    </div>

                                                    @if($othersUser->portalInfo->sex == App\Enums\Sex::getValue('Par'))
                                                        @include('layouts.coupleInfo.othersCouple') 
                                                    @else
                                                        @include('layouts.profileInfo',['profileItem' => $othersUser->portalInfo])            
                                                    @endif

                                                    
                                            </div>
                                        <!-- Overview -->

                                        <!-- Picture -->
                                            <div class="tab-pane" id="tab2rev">
                                                <div class="main-content-label tx-13 mg-b-0">
                                                    <div class="card-body">
                                                        @if(App\Models\FileUpload::where([['user_id', $othersUser->id],['file_type',0],['user_type', Auth::user()->portalInfo->portal_id]])->count() > 0)
                                                            <ul id="lightgallery" class="list-unstyled row mb-0">
                                                                @foreach(App\Models\FileUpload::where([['user_id', $othersUser->id],['file_type',0],['user_type', Auth::user()->portalInfo->portal_id]])->get() as $item)
                                                                    @if(File::exists($item->file))
                                                                        <li class="col-sm-12 col-md-6 col-lg-6 mb-3 pl-sm-2 pr-sm-2" data-responsive="{{asset($item->file)}}" data-src="{{asset($item->file)}}">
                                                                            <div class="img-thumbnail">
                                                                            <div style="text-align: center;"><a href="#"><img src="{{asset($item->file)}}" class="thumbimg" style="width:250px;"></a></div>
                                                                            </div>
                                                                        </li>
                                                                    @else
                                                                        <li class="col-sm-12 col-md-6 col-lg-6 mb-3 pl-sm-2 pr-sm-2" data-responsive="{{ asset('dashlead/img/default/404-image.png') }}" data-src="{{ asset('dashlead/img/default/404-image.png') }}">
                                                                            <div class="img-thumbnail">
                                                                            <div style="text-align: center;"><a href="#"><img src="{{ asset('dashlead/img/default/404-image.png') }}" class="thumbimg" style="height:150px; width:250px;"></a></div>
                                                                            </div>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <div style="text-align: center; margin-top: 260px; margin-bottom: 260px;">
                                                                <h5 style="color:red;">Der Er Ingen Billeder.</h5>
                                                            </div>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        <!-- Picture -->

                                        <!-- Video -->
                                            <div class="tab-pane" id="tab3rev">
                                                <div class="main-content-label tx-13 mg-b-20">

                                                    <div class="card-body">
                                                        @if(App\Models\FileUpload::where([['user_id', $othersUser->id],['file_type',1],['user_type', Auth::user()->portalInfo->portal_id]])->count() > 0)
                                                            <ul id="lightgallery" class="list-unstyled row mb-0">
                                                                @foreach(App\Models\FileUpload::where([['user_id',$othersUser->id],['file_type',1],['user_type', Auth::user()->portalInfo->portal_id]])->get() as $item)
                                                                    @if(File::exists($item->file))
                                                                        <li class="col-sm-12 col-md-6 col-lg-6 mb-3 pl-sm-2 pr-sm-2">
                                                                            <video width="235" height="140" controls>
                                                                            <source src="{{asset('/'.$item->file)}}" type="video/mp4">
                                                                            <source src="{{asset('/'.$item->file)}}" type="video/ogg">
                                                                            <source src="{{asset('/'.$item->file)}}" type="video/webm">
                                                                            <source src="{{asset('/'.$item->file)}}" type="video/3gp">
                                                                            Your browser does not support the video tag.
                                                                            </video>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <div style="text-align: center; margin-top: 260px; margin-bottom: 260px;">
                                                                <h5 style="color:red;">Der Er Ingen Videoer.</h5>
                                                            </div>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        <!-- Video -->

                                    </div>
                                </div>
                            </div>
                        <!-- Main Section -->

                        <!-- Promotion Section -->  
                            <div class="col-md-3 col-lg-3">
                                @include('dashlead.layouts.promotationsection')
                            </div>
                        <!-- Promotion Section -->

                    </div>
                    <!-- End Row -->

                    <!-- Profile Report Modal -->
                        <div class="modal" id="profile_reportModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Report</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>

                                    <form method="POST" action="{{ route('profile.report') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">

                                            <input type="hidden" name="to_user_id" require value="{{ Request::get('user_id') }}">

                                            <div class="row">

                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">Emne <span style="color:red">*</span></label>
                                                        <input id="reportTitle" value="{{old('message')}}" require placeholder="Skriv her ..." class="form-control" name="title" required>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">Detaljer <span style="color:red">*</span></label>
                                                        <textarea id="reportDetails" value="{{old('message')}}" require placeholder="Hvad vil du gerne anmelde?" class="form-control" name="details" rows="3" required></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">Vælg Skærmbillede <span style="color:red">*</span></label>
                                                        <input title="Upload Din Fil" type="file" class="dropify" name="files[]" data-max-file-size="5M"  data-height="130" data-width="250" required multiple accept="image/*">
                                                    </div>
                                                </div>

                                                <!-- <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">Vælg Skærmbillede <span style="color:red">*</span></label>
                                                        <input id="demo" type="file" name="files[]" accept=".jpg, .png, image/jpeg, image/png, html, zip, css,js" required multiple>
                                                    </div>
                                                </div> -->

                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn ripple btn-success" type="submit" style="font-weight: bold;text-transform: uppercase;">Send</button>
                                            <button class="btn ripple btn-danger" data-dismiss="modal" type="button" style="font-weight: bold;text-transform: uppercase;">Tæt</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    <!-- Profile Report Modal -->

                    <!-- Profile Chat Modal -->
                        <div class="modal" id="profile_chatModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Skriv Besked</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>

                                    <form  method="POST" action="{{ route('user.chat') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">

                                            <input type="hidden" name="user_id" require value="{{ Request::get('user_id') }}">

                                            <div class="row">

                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <textarea value="{{old('message')}}" require placeholder="Skriv Noget..." class="form-control" name="message" rows="5" required></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">Vælg Billede <span style="color:red">*</span></label>
                                                        <input title="Upload Din Fil" type="file" class="dropify" name="file" data-max-file-size="5M"  data-height="100" data-width="250" accept="image/*">
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn ripple btn-dark" type="submit" name="send" value="paid" style="font-weight: bold;text-transform: uppercase;">Top placering i indbakken</button>
                                            <button class="btn ripple btn-success" type="submit" name="send" value="free" style="font-weight: bold;text-transform: uppercase;" {{auth()->user()->isPaid() ? '' : 'disabled'}}>Send</button>
                                            <button class="btn ripple btn-danger" data-dismiss="modal" type="button" style="font-weight: bold;text-transform: uppercase;">Tæt</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    <!-- Profile Chat Modal -->


                </div>
            </div>
            <!-- End Main Content-->
@endsection

@push('script')
    <!-- Gallery js-->
    <script src="{{ asset('dashlead/plugins/gallery/picturefill.js') }}"></script>
    <script src="{{ asset('dashlead/plugins/gallery/lightgallery.js') }}"></script>
    <script src="{{ asset('dashlead/plugins/gallery/lightgallery-1.js') }}"></script>
    <script src="{{ asset('dashlead/plugins/gallery/lg-pager.js') }}"></script>
    <script src="{{ asset('dashlead/plugins/gallery/lg-autoplay.js') }}"></script>
    <script src="{{ asset('dashlead/plugins/gallery/lg-fullscreen.js') }}"></script>
    <script src="{{ asset('dashlead/plugins/gallery/lg-zoom.js') }}"></script>
    <script src="{{ asset('dashlead/plugins/gallery/lg-hash.js') }}"></script>
    <!-- <script src="{{ asset('dashlead/plugins/gallery/lg-share.js') }}"></script> -->
@endpush


