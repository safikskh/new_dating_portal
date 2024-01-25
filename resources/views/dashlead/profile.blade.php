<!-- Developed By CBS -->
    @extends('dashlead.layouts.layout')
    @section('pageTitle', 'Min profil')
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

                                                @if(auth()->user()->portalInfo->sex == App\Enums\Sex::getValue('Par'))
                                                    <div style="overflow: hidden;justify-content:space-around;">
                                                        <div style="max-width: 40%;max-height: 40%;display: inline-block;">
                                                            @if(File::exists(Auth::user()->portalInfo->coupleMale()->profilePicture))
                                                                <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{asset(Auth::user()->portalInfo->coupleMale()->profilePicture)}}">
                                                            @else
                                                                <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle">
                                                            @endif
                                                        </div>
                                                        <div style="max-width: 40%;max-height: 40%;display: inline-block;">
                                                            @if(File::exists(Auth::user()->portalInfo->coupleFemale()->profilePicture))
                                                                <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{asset(Auth::user()->portalInfo->coupleFemale()->profilePicture)}}">
                                                            @else
                                                                <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle">
                                                            @endif
                                                        </div>
                                                    </div>

                                                @else
                                                    <div class="main-img-user">
                                                        @if(File::exists(Auth::user()->portalInfo->profilePicture))
                                                            <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;" src="{{asset(Auth::user()->portalInfo->profilePicture)}}">
                                                        @else
                                                            <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;" src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle">
                                                        @endif
                                                    </div>
                                                @endif


                                            </div>
                                            <div class="item-user pro-user">
                                                <h4 class="pro-user-username text-dark mt-2 mb-0" style="font-weight: bold;">{{Auth::user()->portalInfo->firstName}} {{Auth::user()->portalInfo->lastName}}</h4>
                                                <h5>
                                                    <span style="font-weight:bold; text-transform:uppercase;" class="badge badge-primary">
                                                        {{ Auth::user()->portalInfo->username }}
                                                    </span>
                                                </h5>
                                                <p class="user-info-rating">
                                                    @foreach(range(1,5) as $i)
                                                        @if($ratings > 0)
                                                            @if($ratings >= 1)
                                                                <i class="fa fa-star fa-lg" aria-hidden="true" style="color: #f87d53"></i>
                                                            @else
                                                                <i class="fa fa-star-half-o fa-lg" aria-hidden="true" style="color: #f87d53"></i>
                                                            @endif
                                                        @else
                                                            <i class="fa  fa-star-o fa-lg" aria-hidden="true"></i>
                                                        @endif
                                                        <?php $ratings --; ?>
                                                    @endforeach
                                                </p>
                                            </div>
                                            <div class="text-center" style="font-weight:bold; text-transform:uppercase;">
                                                @if($rate != 0)
                                                    <h5><span style="color: #38c172">{{ $rate }}</span> Ud af 5 [ <span style="color: #38c172">{{ $viewers }}</span> brugere ]</h5>
                                                @else
                                                    <h5><span style="color: #38c172">0</span> Ud af 5 [ <span style="color: #38c172">{{ $viewers }}</span> brugere ]</h5>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if( (Auth::user()->portalInfo->matchWords != '[""]') && (Auth::user()->portalInfo->matchWords != null) )
                                        <div class="card custom-card">
                                            <div class="card-header custom-card-header">
                                                <div>
                                                    <h6 class="card-title mb-0" style="font-weight:bold; text-transform:uppercase;">Matchord</h6>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="skill-tags">
                                                    <ul class="list-unstyled mb-0">
                                                        @foreach(json_decode(Auth::user()->portalInfo->matchWords) as $matchWord)
                                                            <li style="font-weight:bold; text-transform:uppercase;"><a href="#">{{$matchWord}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if( (Auth::user()->portalInfo->nMatchWords != '[""]') && (Auth::user()->portalInfo->nMatchWords != null) )
                                        <div class="card custom-card">
                                            <div class="card-header custom-card-header">
                                                <div>
                                                    <h6 class="card-title mb-0" style="font-weight:bold; text-transform:uppercase;">Negative Matchord</h6>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="skill-tags">
                                                    <ul class="list-unstyled mb-0">
                                                        @foreach(json_decode(Auth::user()->portalInfo->nMatchWords) as $nMatchWord)
                                                            <li style="font-weight:bold; text-transform:uppercase;"><a href="#">{{$nMatchWord}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Current Paid Member -->
                                        @if( auth()->user()->isStatus() == 1)
                                        <div class="card custom-card">
                                            <div class="card-header custom-card-header">
                                                <div>
                                                    <h6 class="card-title mb-0" style="font-weight: bold;">Nuværende Medlemskab</h6>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="card overflow-hidden" style="background:#e3ecfb;">
                                                    <div class="text-center card-pricing pricing1">
                                                        <div class="p-2 text-white bg-primary fs-20" style="font-weight: bold;">{{ Auth::user()->portalInfo->memberships->name }}</div>
                                                        <div class="p-3 font-weight-normal mb-0">
                                                            <h6 class="text-center mb-0">kr.
                                                                    <span class="h4">{{ number_format(Auth::user()->portalInfo->memberships->cost, 2) }}</span>
                                                                    <span class="h6 text-muted ml-2">/
                                                                        @if (Auth::user()->portalInfo->memberships->name == "Gratis")
                                                                            Free
                                                                        @else
                                                                            {{Auth::user()->portalInfo->memberships->duration}}
                                                                        @endif
                                                                    </span>
                                                            </h6>
                                                        </div>
                                                        <div class="card-body text-center pt-0">
                                                            <ul class="list-unstyled mb-0">
                                                                <li><i class="fe fe-star mr-2 text-success"></i>{{ Auth::user()->portalInfo->memberships->description }}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="card-footer text-center">
                                                            <h4>
                                                                <span class="badge badge-primary"> Udløber Kl</span><br>
                                                                <span class="badge badge-primary"> {{date('d F Y', strtotime(Auth::user()->portalInfo->membership_ends_at))}}</span>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- Current Paid Member -->

                                    <!-- Previous Paid Member -->
                                        @elseif( auth()->user()->isStatus() == 2)
                                        <div class="card custom-card">
                                            <div class="card-header custom-card-header">
                                                <div>
                                                    <h6 class="card-title mb-0" style="font-weight: bold;">Nuværende Medlemskab</h6>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="card overflow-hidden" style="background:#dcdfe6;">
                                                    <div class="text-center card-pricing pricing1">
                                                        <div class="p-2 text-white bg-dark fs-20" style="font-weight: bold;">{{ Auth::user()->portalInfo->memberships->name }}</div>
                                                        <div class="p-3 font-weight-normal mb-0">
                                                            <h6 class="text-center mb-0">kr.
                                                                    <span class="price">{{ number_format(Auth::user()->portalInfo->memberships->cost, 2) }}</span>
                                                                    <span class="h6 text-muted ml-2">/
                                                                        @if (Auth::user()->portalInfo->memberships->name == "Gratis")
                                                                            Free
                                                                        @else
                                                                            {{Auth::user()->portalInfo->memberships->duration}}
                                                                        @endif
                                                                    </span>
                                                                </h6>
                                                        </div>
                                                        <div class="card-body text-center pt-0">
                                                            <ul class="list-unstyled mb-0">
                                                                <li><i class="fe fe-star mr-2 text-success"></i>{{ Auth::user()->portalInfo->memberships->description }}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="card-footer text-center">
                                                            <h4>
                                                                <span class="badge badge-primary"> Udløber Kl</span><br>
                                                                <span class="badge badge-primary"> {{date('d F Y', strtotime(Auth::user()->portalInfo->membership_ends_at))}}</span>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- Previous Paid Member -->

                                    <!-- For Free Member -->
                                        @else
                                        <div class="card custom-card">
                                            <div class="card-header custom-card-header">
                                                <div>
                                                    <h6 class="card-title mb-0" style="font-weight: bold;">Nuværende Medlemskab</h6>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="card overflow-hidden" style="background:#dcdfe6;">
                                                    <div class="text-center card-pricing pricing1">
                                                        <div class="p-2 text-white bg-dark fs-20" style="font-weight: bold;">{{ Auth::user()->portalInfo->memberships->name }}</div>
                                                        <div class="p-3 font-weight-normal mb-0">
                                                            <h6 class="text-center mb-0">kr.
                                                                    <span class="price">{{ number_format(Auth::user()->portalInfo->memberships->cost, 2) }}</span>
                                                                    <span class="h6 text-muted ml-2">/
                                                                        @if (Auth::user()->portalInfo->memberships->name == "Gratis")
                                                                            Free
                                                                        @else
                                                                            {{Auth::user()->portalInfo->memberships->duration}}
                                                                        @endif
                                                                    </span>
                                                                </h6>
                                                        </div>
                                                        <div class="card-body text-center pt-0">
                                                            <ul class="list-unstyled mb-0">
                                                                <li><i class="fe fe-star mr-2 text-success"></i>{{ Auth::user()->portalInfo->memberships->description }}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="card-footer text-center">
                                                            <h4>
                                                                <span class="badge badge-dark"> Udløber Kl</span><br>
                                                                <span class="badge badge-dark"> {{date('d F Y', strtotime(Auth::user()->portalInfo->membership_ends_at))}}</span>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    <!-- For Free Member -->

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

                                                    @if(Auth::user()->portalInfo->profile_detail != null)
                                                        <div class="main-content-label tx-13 mg-b-20">
                                                            Profil Beskrivelse
                                                        </div>
                                                        <p align="justify">{{ Auth::user()->portalInfo->profile_detail }}</p>
                                                    @endif
                                                    <div class="main-content-label tx-13 mg-b-20">
                                                        Profil Beskrivelse
                                                    </div>
                                                    @if(auth()->user()->portalInfo->sex == App\Enums\Sex::getValue('Par'))
                                                        @include('layouts.coupleInfo.myCouple')
                                                    @else
                                                        <div class="table-responsive ">
                                                            <table class="table row table-borderless">
                                                                <tbody class="col-lg-12 col-xl-6 p-0">

                                                                    <tr>
                                                                        <td><strong>Beliggenhed :</strong> {{ Auth::user()->portalInfo->regionName }}</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><strong>Postnummer :</strong> {{ Auth::user()->portalInfo->zipCode }}</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><strong>Køn :</strong> {{ Auth::user()->portalInfo->sex }}</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><strong>Alder :</strong> {{Auth::user()->portalInfo->humanTime}} Years</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Højde :</strong> {{Auth::user()->portalInfo->height}} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Vægt :</strong> {{Auth::user()->portalInfo->weight}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Civil Status :</strong> {{Auth::user()->portalInfo->civilStatus}}</td>
                                                                    </tr>

                                                                </tbody>
                                                                <tbody class="col-lg-12 col-xl-6 p-0">

                                                                    <tr>
                                                                        <td><strong>Hårfarve :</strong> {{Auth::user()->portalInfo->hairColor}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Øjenfarve :</strong> {{Auth::user()->portalInfo->eyeColor}} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Seksualitet :</strong> {{Auth::user()->portalInfo->sexualOrientation}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Kropsbygning :</strong> {{Auth::user()->portalInfo->bodyType}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Piercinger :</strong> {{Auth::user()->portalInfo->piercing}} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Tatoveringer :</strong> {{Auth::user()->portalInfo->tattoos}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Ryger :</strong> {{Auth::user()->portalInfo->smoking}}</td>
                                                                    </tr>
                                                                </tbody>
                                                                <tbody class="col-lg-12 col-xl-12 p-0">
                                                                    @if( (Auth::user()->portalInfo->searching != '[""]') && (Auth::user()->portalInfo->searching != 'null') )
                                                                    <tr>
                                                                        <td><strong>Søger :</strong>
                                                                            @foreach(json_decode(Auth::user()->portalInfo->searching) as $s)
                                                                                <span style="margin:3px; font-size: 12px; font-weight: bold;" class="badge badge-pill badge-dark">{{$s}}</span>
                                                                            @endforeach
                                                                        </td>
                                                                    </tr>
                                                                    @endif

                                                                </tbody>
                                                            </table>
                                                            </table>
                                                        </div>
                                                    @endif

                                                </div>
                                            <!-- Overview -->

                                            <!-- Picture -->
                                                <div class="tab-pane" id="tab2rev">
                                                    <div class="main-content-label tx-13 mg-b-0">
                                                        <div class="card-body">
                                                            @if(App\Models\FileUpload::where([['user_id', Auth::id()],['file_type',0],['user_type', Auth::user()->portalInfo->portal_id]])->count() > 0)
                                                                <ul id="lightgallery" class="list-unstyled row mb-0">
                                                                    @foreach(App\Models\FileUpload::where([['user_id', Auth::id()],['file_type',0],['user_type', Auth::user()->portalInfo->portal_id]])->get() as $item)
                                                                        @if(File::exists($item->file))
                                                                            <li class="col-sm-12 col-md-6 col-lg-6 mb-3 pl-sm-2 pr-sm-2" data-responsive="{{asset($item->file)}}" data-src="{{asset($item->file)}}" data-sub-html="<h4><a href='{{route('destroy.image',$item->id)}}'><i style='color:red;' class='far fa-trash-alt fa-3x'></i></a></h4>">
                                                                                <div class="img-thumbnail">
                                                                                <div style="text-align: center;"><a href="#"><img src="{{asset($item->file)}}" class="thumbimg" style="width:250px;"></a></div>
                                                                                </div>
                                                                            </li>
                                                                        @else
                                                                            <li class="col-sm-12 col-md-6 col-lg-6 mb-3 pl-sm-2 pr-sm-2" data-responsive="{{ asset('dashlead/img/default/404-image.png') }}" data-src="{{ asset('dashlead/img/default/404-image.png') }}" data-sub-html="<h4><a href='{{route('destroy.image',$item->id)}}'><i style='color:red;' class='far fa-trash-alt fa-3x'></i></a></h4>">
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
                                                            @if(App\Models\FileUpload::where([['user_id', Auth::id()],['file_type',1],['user_type', Auth::user()->portalInfo->portal_id]])->count() > 0)
                                                                <ul id="lightgallery" class="list-unstyled row mb-0">
                                                                    @foreach(App\Models\FileUpload::where([['user_id', Auth::id()],['file_type',1],['user_type', Auth::user()->portalInfo->portal_id]])->get() as $item)
                                                                        @if(File::exists($item->file))
                                                                            <li class="col-sm-12 col-md-6 col-lg-6 mb-3 pl-sm-2 pr-sm-2">
                                                                                <video width="235" height="140" controls>
                                                                                <source src="{{asset('/'.$item->file)}}" type="video/mp4">
                                                                                <source src="{{asset('/'.$item->file)}}" type="video/ogg">
                                                                                <source src="{{asset('/'.$item->file)}}" type="video/webm">
                                                                                <source src="{{asset('/'.$item->file)}}" type="video/3gp">
                                                                                Your browser does not support the video tag.
                                                                                </video>
                                                                                <div style="padding-top: 10px;">
                                                                                    <h6 style="text-align: center;">
                                                                                        <!-- <a href="{{route('destroy.image',$item->id)}}"><i style='color:red;' class='far fa-trash-alt fa-2x'></i></a> -->
                                                                                        <button type="button" onclick="location.href='{{route('destroy.image',$item->id)}}'" class="btn ripple btn-danger btn-sm btn-block"><i class='far fa-trash-alt'></i> SLET</button>
                                                                                    </h4>
                                                                                </div>
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
<!-- Developed By CBS -->


