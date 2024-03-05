<!-- Developed By CBS -->
  @extends('dashlead.layouts.layout')
  @section('pageTitle', 'Grupper')
  @push('style')
      <!---Gallery css-->
    <link href="{{ asset('dashlead/plugins/gallery/gallery.css') }}" rel="stylesheet">
  @endpush
  @section('content')
      <!-- Main Content-->
        <div class="main-content pt-0">
          <div class="container">
            <!-- Page Header -->
              <div class="page-header"></div>
            <!-- End Page Header -->
            
            <!-- Row -->
              <div class="row">
                
              <!-- Sidebar Section   -->  
                <div class="col-md-3 col-lg-3">

                  <!-- Group Owner -->
                    <div class="card custom-card">
                        <div class="card-body text-center">
                              <div style="margin-bottom: 10px;">
                                  <h5 class="card-title mb-1" style="font-weight: bold; text-transform:uppercase;">Gruppe Ejer</h5><hr>
                              </div>
                            <div class="main-profile-overview widget-user-image text-center">
                            <a href="{{url('profile?user_id='.$data->user->id)}}">
                                @if($data->user->portalInfo->sex == App\Enums\Sex::getValue('Par'))
                                  <div style="overflow: hidden;justify-content:space-around;">
                                      <div style="max-width: 40%;max-height: 40%;display: inline-block;">
                                          @if(File::exists($data->user->portalInfo->coupleMale()->profilePicture)) 
                                              <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{asset($data->user->portalInfo->coupleMale()->profilePicture)}}">
                                          @else
                                              <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle">
                                          @endif
                                      </div>
                                      <div style="max-width: 40%;max-height: 40%;display: inline-block;">
                                          @if(File::exists($data->user->portalInfo->coupleFemale()->profilePicture)) 
                                              <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{asset($data->user->portalInfo->coupleFemale()->profilePicture)}}">
                                          @else
                                              <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle">
                                          @endif
                                      </div>
                                  </div>
                                @else
                                  <div class="main-img-user">
                                      @if(File::exists($data->user->portalInfo->profilePicture)) 
                                          <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;" src="{{asset($data->user->portalInfo->profilePicture)}}">
                                      @else
                                          <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;" src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle">
                                      @endif
                                  </div>
                                @endif
                              </a>
                                
                            </div>
                            <div class="item-user pro-user">
                                <h4 class="pro-user-username text-dark mt-2 mb-0">{{$data->user->portalInfo->userName}}</h4>
                                <p class="pro-user-desc text-muted mb-1" style="font-weight: bold;">{{$data->user->portalInfo->regions ? $data->user->portalInfo->regions->region_name : ''}}</p>
                                <p class="pro-user-desc text-muted mb-1" style="font-weight: bold;">{{$data->user->portalInfo->humanTime}} År Gammel</p>
                            </div>
                        </div>
                    </div>
                  <!-- Group Owner -->
                
                  <!-- Group Participants Slider -->
                      <div class="card custom-card">
                          <div class="card-body h-100" style="margin-bottom: 10px;">
                              <div style="margin-bottom: 10px;">
                                  <h5 class="card-title mb-1" style="font-weight: bold; text-transform:uppercase;">Deltagere</h5><hr>
                              </div>
                              @if(sizeof($groupMember)>0)
                              <div id="owl-demo2" class="owl-carousel owl-carousel-icons2">
                                  @foreach($groupMember as $em)
                                    <div class="item">
                                      <a  href="{{url('profile?user_id='.$em->user_id)}}">
                                          
                                                  @if($em->user->portalInfo->sex == 'Par')
                                                    <div class="card" style="background:#eeffeb;">
                                                        <div class="card-body user-card text-center">
                                                            <div style="max-width: 27%;max-height: 27%;display: inline-block;">
                                                                @if(File::exists($em->user->portalInfo->coupleMale()->profilePicture)) 
                                                                    <img src="{{asset($em->user->portalInfo->coupleMale()->profilePicture)}}" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;">
                                                                @else
                                                                    <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle">
                                                                @endif
                                                            </div>
                                                            <div style="max-width: 27%;max-height: 27%;display: inline-block;">
                                                                @if(File::exists($em->user->portalInfo->coupleFemale()->profilePicture)) 
                                                                    <img src="{{asset($em->user->portalInfo->coupleFemale()->profilePicture)}}" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;">
                                                                @else
                                                                    <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle">
                                                                @endif
                                                            </div>
                                                            <div  class="mt-2" style="padding-top: 12px;">
                                                                <p class="mb-1"><span style="font-weight: bold;" class="badge badge-primary">{{  str_limit(App\User::find($em->user_id)->portalInfo->userName, 30) }}</span></p>
                                                                <span class="text-muted">{{$em->user->portalInfo->regions ? $em->user->portalInfo->regions->region_name : ''}}</span><br>
                                                                <span class="text-muted">Age {{  $em->user->portalInfo->humanTime }}</span>
                                                            </div>
                                                      </div>
                                                  </div>
                                                  @else
                                                    <div class="card {{$em->user->portalInfo->userNameColor}}">
                                                        <div class="card-body user-card text-center">
                                                            <div class="main-img-user avatar-lg online text-center">
                                                                @if(File::exists($em->user->portalInfo->profilePicture)) 
                                                                    <img src="{{asset($em->user->portalInfo->profilePicture)}}" class="rounded-circle" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;">
                                                                @else
                                                                    <img src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;">
                                                                @endif
                                                            </div>
                                                            <div  class="mt-2" style="padding-top: 12px;">
                                                              <p class="mb-1"><span style="font-weight: bold;" class="badge badge-primary">{{  str_limit(App\User::find($em->user_id)->portalInfo->userName, 30) }}</span></p>
                                                              <span class="text-muted">{{$em->user->portalInfo->regions ? $em->user->portalInfo->regions->region_name : ''}}</span><br>
                                                              <span class="text-muted">Age {{  $em->user->portalInfo->humanTime }}</span>
                                                          </div>
                                                      </div>
                                                    </div>
                                                  @endif
                                      </a>
                                  </div>
                                  @endforeach
                              </div>
                              @else
                                  <div style="text-align: center; margin-top: 40px; margin-bottom: 40px;">
                                      <h5 style="color:red;">Ingen Deltagere Deltager Endnu.</h5>
                                  </div>
                              @endif
                          </div>
                      </div>
                  <!-- Group Participants Slider -->


                  <!-- Similiar Group -->    
                    <div class="card custom-card">
                      <div class="card-header custom-card-header">
                        <h6 class="card-title mb-0" style="font-weight: bold; text-transform:uppercase;">Lignende gruppe</h6>
                      </div>
                        @if(sizeof($similarGroup)>0)  
                          @foreach($similarGroup as $key => $sm)
                              <div class="list d-flex align-items-center p-3 border-top">
                                <span style="font-weight: bold; border:2px solid #1b4da6; border-radius:0%; padding: 5px; text-align: center; color:white; background:#1b4da6;">{{ $key+1 }}</span>
                                <div class="wrappe ml-3">
                                  <a href="{{route('eventDetails',$sm->id)}}" style="color:black;">
                                    <h6 class="mb-1">{{ str_limit($sm->title, $limit = 40, $end = ' . . .') }}</h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                        <span class="mb-0 text-muted"><i class="fas fa-clock mr-2"></i>{{date('d m Y', strtotime($sm->updated_at))}} , {{date('H:i', strtotime($sm->updated_at))}}</span>
                                      </div>
                                    </div>
                                  </a>
                                </div>
                              </div>
                            @endforeach
                        @else
                            <div style="text-align: center; margin-top: 200px; margin-bottom: 200px;">
                                <h5 style="color:red;">Ingen Tilgængelig Data</h5>
                            </div>
                        @endif
                    </div>
                  <!-- Similiar Group -->

                </div>
              <!-- Sidebar Section   -->

              <!-- Main Section   -->
                <div class="col-md-6 col-lg-6">

                  <!-- Body Section -->
                    <div class="card custom-card main-content-body-profile">

                        <div class="card-header">
                            <div style="text-align: center; margin-bottom: 10px;">
                                @if(File::exists($data->image)) 
                                    <img src="{{asset('/'.$data->image)}}" class="img-fluid" style="height:185px; width:555px;">
                                @else
                                    <img src="{{ asset('dashlead/img/default/404-image.png') }}" class="img-fluid" style="height:185px;">
                                @endif
                            </div>
                            <div style="text-align: center;">
                              <h4>{{$data->title}}</h4>
                            </div>
                        </div>

                        <nav class="nav main-nav-line" style="font-weight: bold;">
                            <a class="nav-link active" data-toggle="tab" href="#tab1over">DEBAT</a>
                            <a class="nav-link" data-toggle="tab" href="#tab2rev">OM GRUPPE</a>
                            <a class="nav-link" data-toggle="tab" href="#tab3rev">MEDLEMMER</a>
                            <a class="nav-link" data-toggle="tab" href="#tab4rev">BILLEDER</a>
                            <a class="nav-link" data-target="#group_image_upload_model" style="color:#1b4da6;" data-toggle="modal" href="#"><i class="fas fa-upload"></i> UPLOAD BILLEDER</a>
                        </nav>
                        <div class="card-body tab-content h-100">
                            <!-- DEBAT -->
                                <div class="tab-pane active" id="tab1over">
                                    <div class="main-content-label tx-13 mg-b-20">
                                        <div class="card-body">

                                          <!-- DEBAT Form -->
                                            <form action="{{route('postongroup')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="type" value="0">
                                                <input type="hidden" name="group_id" value="{{$data->id}}">
                                                <div class="form-group">
                                                  <br>
                                                  <textarea name="data" class="form-control" rows="3" id="comment" placeholder="Skriv her..." style="background-color:#dee7f7;" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn ripple btn-primary" style="margin-top: 0px; margin-bottom: 0px; font-weight: bold;text-transform: uppercase;" {{auth()->user()->isPaid() ? '' : 'disabled'}}>Læg Op</button>
                                                </div>
                                            </form>
                                          <!-- DEBAT Form -->

                                          @foreach ($posts as $post)
                                            <div class="container">
                                                <div class="card">
                                                  <div class="card-body">

                                                    <div class="row">

                                                    <div class="media mb-4">
                                                      <div class="main-img-user mr-3">
                                                        <a href="{{url('profile?user_id='.$post->user->id)}}">
                                                              @if($post->user->portalInfo->sex == 'Par')
                                                                  @if(File::exists($post->user->portalInfo->coupleFemale()->profilePicture)) 
                                                                    <img style="border:2px solid #1b4da6; border-radius:50%; padding: 2px; text-align: center;" src="{{asset($post->user->portalInfo->coupleFemale()->profilePicture)}}">
                                                                  @else
                                                                    <img src="{{ asset('dashlead/img/default/404-dp.png') }}" style="border:2px solid #1b4da6; border-radius:50%; padding: 2px; text-align: center;" />
                                                                  @endif
                                                              @else
                                                                  @if(File::exists($post->user->portalInfo->profilePicture)) 
                                                                    <img style="border:2px solid #1b4da6; border-radius:50%; padding: 2px; text-align: center;" src="{{asset($post->user->portalInfo->profilePicture)}}">
                                                                  @else
                                                                    <img src="{{ asset('dashlead/img/default/404-dp.png') }}" style="border:2px solid #1b4da6; border-radius:50%; padding: 2px; text-align: center;" />
                                                                  @endif
                                                              @endif
                                                          </a>
                                                        
                                                      </div>
                                                      <div class="media-body">
                                                        <div class="media-contact-name mb-1">
                                                          <h6 class="mb-0" style="color:#1b4da6; font-weight: bold;">
                                                          <a style="color:#1b4da6;" href="{{url('profile?user_id='.$post->user->id)}}">{{$post->user->portalInfo->userName}}</a>,
                                                            {{$post->user->portalInfo->humanTime}}, {{$post->user->portalInfo->regions ? $post->user->portalInfo->regions->region_name :''}}
                                                            </h6>
                                                        </div>
                                                        <p class="mb-2" style="margin-top:5px; text-transform: capitalize; color:#1b4da6;">{{$post->data}}</p>
                                                        <ul class="reviewnavs" style="color:#6a98ea; font-weight: bold;">
                                                          <li class="mr-2"><i class="fas fa-comment"></i> {{App\Models\UserCommentsOnGroupPost::getTotalComments($data->id,$post->id)}}</li>

                                                          <a class="like-btn" @if(auth()->user()->isPaid()) href="{{url('likeGroupPost?group_id='.$data->id.'&post_id='.$post->id)}}"
                                                            @endif
                                                            <li class="mr-2"><i class="far fa-thumbs-up"></i> {{App\Models\UserLikesOnGroupPost::getTotalLikes($data->id,$post->id)}}</li>
                                                          </a> &nbsp;
                                                          <li class="mr-2"><i class="far fa-calendar"></i> {{date('d F Y, H:i', strtotime($post->updated_at))}}</li>
                                                        </ul>

                                                        @foreach(App\Models\UserCommentsOnGroupPost::getComments($data->id,$post->id) as $comment)
                                                        <div class="media">
                                                          <div class="main-img-user mr-3">
                                                              <a href="{{url('profile?user_id='.$comment->user->id)}}">
                                                                   @if($comment->user->portalInfo->sex == 'Par')
                                                                        @if(File::exists($comment->user->portalInfo->coupleFemale()->profilePicture)) 
                                                                          <img style="border:2px solid #1b4da6; border-radius:50%; padding: 2px; text-align: center;" src="{{asset($comment->user->portalInfo->coupleFemale()->profilePicture)}}">
                                                                        @else
                                                                          <img src="{{ asset('dashlead/img/default/404-dp.png') }}" style="border:2px solid #1b4da6; border-radius:50%; padding: 2px; text-align: center;" />
                                                                        @endif
                                                                    @else
                                                                        @if(File::exists($comment->user->portalInfo->profilePicture)) 
                                                                          <img style="border:2px solid #1b4da6; border-radius:50%; padding: 2px; text-align: center;" src="{{asset($comment->user->portalInfo->profilePicture)}}">
                                                                        @else
                                                                          <img src="{{ asset('dashlead/img/default/404-dp.png') }}" style="border:2px solid #1b4da6; border-radius:50%; padding: 2px; text-align: center;" />
                                                                        @endif
                                                                    @endif
                                                              </a>
                                                            
                                                          </div>
                                                          <div class="media-body">
                                                            <div class="media-contact-name mb-1">
                                                              <h6 class="mb-0" style="color:#ff473d; font-weight: bold;">
                                                              <a style="color:#ff473d;" href="{{url('profile?user_id='.$comment->user->id)}}">{{$comment->user->portalInfo->userName}}</a>,
                                                              {{$comment->user->portalInfo->humanTime}}, {{$comment->user->portalInfo->regions ? $comment->user->portalInfo->regions->region_name :''}}
                                                              </h6>
                                                            </div>
                                                            <p class="mb-2" style="margin-top:5px; text-transform: capitalize; color:#ff473d;">{{$comment->comment}}</p>
                                                            <ul class="reviewnavs" style="color:#f37b74; font-weight: bold;">
                                                              <li class="mr-2"><i class="far fa-clock"></i> {{$comment->updated_at->diffForHumans()}}</li>
                                                              <li class="mr-2"><i class="far fa-calendar"></i> {{date('d F Y, H:i', strtotime($comment->updated_at))}}</li>
                                                            </ul>
                                                          </div>
                                                        </div>
                                                        @endforeach

                                                        <!-- Comment Form -->
                                                          <form action="{{route('postcommentonthispost')}}" method="post" style="margin-left: 12%;">
                                                            @csrf
                                                            <input type="hidden" name="group_id" value="{{$data->id}}">
                                                            <input type="hidden" name="post_id" value="{{$post->id}}">
                                                            <div class="form-group">
                                                              <br>
                                                              <textarea name="comment" class="form-control" rows="2" id="comment" placeholder="Skriv Din Kommentar Her..." style="float: right; background-color:#f9e2e1;" required></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn ripple btn-danger" style="float:right; margin-top: 10px; margin-bottom: 0px; font-weight: bold;text-transform: uppercase;" {{auth()->user()->isPaid() ? '' : 'disabled'}}>Kommentér</button>
                                                            </div>
                                                          </form>
                                                      <!-- Comment Form -->

                                                      </div>
                                                    </div>

                                              
                                                  </div>
                                                  </div>
                                                </div>
                                              </div>
                                          @endforeach

                                          <!-- Pagination -->
                                            <nav style="margin-top:10px;">
                                              <ul class="pagination justify-content-center" style="font-weight: bold;">
                                                {{ $posts->links() }}
                                              </ul>
                                            </nav>
                                          <!-- Pagination -->

                                          

                                        </div>
                                    </div>
                                </div>
                            <!-- DEBAT -->
                            <!-- OM GRUPPE -->
                                <div class="tab-pane" id="tab2rev">
                                    <div>{!! $data->details !!}</div>
                                </div>
                            <!-- OM GRUPPE -->
                            <!-- MEDLEMMER -->
                                <div class="tab-pane" id="tab3rev">
                                    @if(sizeof($groupMember) > 0)
                                      <div class="row">
                                        @foreach($groupMember as $gm)   
                                          <div class="col-sm-12 col-md-4 col-lg-4">
                                            <a  href="{{url('profile?user_id='.$gm->user->portalInfo->user_id)}}">
                                                  @if($gm->user->portalInfo->sex == 'Par')
                                                      <div class="card custom-card" style="background:#eeffeb;">
                                                        <div class="card-body text-center">
                                                          <div style="max-width: 45%;max-height: 45%; display: inline-block;">
                                                            @if(File::exists($gm->user->portalInfo->coupleMale()->profilePicture)) 
                                                                <img src="{{asset($gm->user->portalInfo->coupleMale()->profilePicture)}}" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;">
                                                            @else
                                                                <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle">
                                                            @endif
                                                        </div>
                                                        <div style="max-width: 45%;max-height: 45%;display: inline-block;">
                                                            @if(File::exists($gm->user->portalInfo->coupleFemale()->profilePicture)) 
                                                                <img src="{{asset($gm->user->portalInfo->coupleFemale()->profilePicture)}}" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;">
                                                            @else
                                                                <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle">
                                                            @endif
                                                        </div>
                                                          <p class="mb-2 mt-1 tx-inverse" style="font-weight: bold; text-transform: uppercase;">{{ str_limit($gm->user->portalInfo->userName, 10) }}</p>
                                                          <p class="mb-2 mt-1 tx-inverse">{{ str_limit($gm->user->portalInfo->regionName, 10) }}</p>
                                                      </div>
                                                    </div>
                                                  @else
                                                    <div class="card custom-card {{ $gm->user->portalInfo->userNameColor }}">
                                                      <div class="card-body text-center">
                                                        <div class="user-lock text-center">
                                                              @if(File::exists($gm->user->portalInfo->profilePicture)) 
                                                                  <img class="rounded-circle" src="{{ asset('/'.$gm->user->portalInfo->profilePicture)}}" style="max-width: 60px; max-height: 60px; border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;">
                                                              @else
                                                                  <img src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle" style="max-width: 60px; max-height: 60px; border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;">
                                                              @endif
                                                        </div>
                                                        <p class="mb-2 mt-1 tx-inverse" style="font-weight: bold; text-transform: uppercase;">{{ str_limit($gm->user->portalInfo->userName, 10) }}</p>
                                                        <p class="mb-2 mt-1 tx-inverse">{{ str_limit($gm->user->portalInfo->regionName, 10) }}</p>
                                                      </div>
                                                    </div>
                                                  @endif
                                            </a>
                                          </div>
                                        @endforeach
                                      </div>
                                    @else
                                        <div style="text-align: center; margin-top: 155px; margin-bottom: 155px;">
                                            <h5 style="color:red;">Intet Gruppemedlem Tilgængeligt</h5>
                                        </div>
                                      
                                    @endif 
                                </div>
                            <!-- MEDLEMMER -->
                            <!-- BILLEDER -->
                                <div class="tab-pane" id="tab4rev">
                                     <div class="main-content-label tx-13 mg-b-20">
                                        <div class="card-body">


                                          @if(sizeof($mediaposts)>0)
                                            @foreach ($mediaposts as $p)
                                                <div class="container">
                                                  <div class="card">
                                                    <div class="card-body">
                                                    <div class="row">
                                                      <div class="media mb-4">
                                                        <div class="main-img-user mr-3">
                                                          <a href="{{url('profile?user_id='.$p->user->id)}}">
                                                                
                                                                @if($p->user->portalInfo->sex == 'Par')
                                                                    @if(File::exists($p->user->portalInfo->coupleFemale()->profilePicture)) 
                                                                      <img style="border:2px solid #1b4da6; border-radius:50%; padding: 2px; text-align: center;" src="{{asset($p->user->portalInfo->coupleFemale()->profilePicture)}}">
                                                                    @else
                                                                      <img src="{{ asset('dashlead/img/default/404-dp.png') }}" style="border:2px solid #1b4da6; border-radius:50%; padding: 2px; text-align: center;" />
                                                                    @endif
                                                                @else
                                                                    @if(File::exists($p->user->portalInfo->profilePicture)) 
                                                                      <img style="border:2px solid #1b4da6; border-radius:50%; padding: 2px; text-align: center;" src="{{asset($p->user->portalInfo->profilePicture)}}">
                                                                    @else
                                                                      <img src="{{ asset('dashlead/img/default/404-dp.png') }}" style="border:2px solid #1b4da6; border-radius:50%; padding: 2px; text-align: center;" />
                                                                    @endif
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                          <div class="media-contact-name mb-1">
                                                            <h6 class="mb-0" style="color:#1b4da6; font-weight: bold;">
                                                            <a style="color:#1b4da6;" href="{{url('profile?user_id='.$p->user->id)}}">{{$p->user->portalInfo->userName}}</a>,
                                                              {{$p->user->portalInfo->humanTime}}, {{$p->user->portalInfo->regions ? $p->user->portalInfo->regions->region_name :''}}
                                                              </h6>
                                                          </div>
                                                          <div>
                                                            <ul id="lightgallery" class="list-unstyled row mb-0">
                                                              <li class="col-sm-6 col-md-4 col-xl-4 mb-3 pl-sm-2 pr-sm-2" data-responsive="{{asset('/'.$p->data)}}" data-src="{{asset('/'.$p->data)}}" data-sub-html="<h4><a href='{{url('profile?user_id='.$p->user->id)}}'>{{$p->user->portalInfo->userName}}</a></h4><p> {{$p->user->portalInfo->humanTime}}, {{$p->user->portalInfo->regions ? $p->user->portalInfo->regions->region_name :''}}</p>">

                                                                <div>
                                                                    <div style="text-align: center; cursor: pointer; width:400px;">
                                                                      <img src="{{asset('/'.$p->data)}}" class="thumbimg">
                                                                    </div>
                                                                </div>

                                                                </li>
                                                              </ul>

                                                          </div>
                                                          <div style="margin-top:0px;">
                                                            <ul class="reviewnavs" style="color:#6a98ea; font-weight: bold;">
                                                              <li class="mr-2"><i class="fas fa-comment"></i> {{App\Models\UserCommentsOnGroupPost::getTotalComments($data->id,$p->id)}}</li>

                                                              <a class="like-btn" @if(auth()->user()->isPaid()) href="{{url('likeGroupPost?group_id='.$data->id.'&post_id='.$p->id)}}" @endif
                                                                <li class="mr-2"><i class="far fa-thumbs-up"></i> {{App\Models\UserLikesOnGroupPost::getTotalLikes($data->id,$p->id)}}</li>
                                                              </a> &nbsp;
                                                                <li class="mr-2"><i class="far fa-calendar"></i> {{date('d F Y, H:i', strtotime($p->updated_at))}}</li>
                                                            </ul>
                                                          </div>

                                                          @if(sizeof(App\Models\UserCommentsOnGroupPost::getComments($data->id,$p->id))) 
                                                            @foreach(App\Models\UserCommentsOnGroupPost::getComments($data->id,$p->id) as $c)
                                                            <div class="media">
                                                              <div class="main-img-user mr-3">
                                                                  <a href="{{url('profile?user_id='.$c->user->id)}}">
                                                                      @if($c->user->portalInfo->sex == 'Par')
                                                                          @if(File::exists($c->user->portalInfo->coupleFemale()->profilePicture)) 
                                                                            <img style="border:2px solid #1b4da6; border-radius:50%; padding: 2px; text-align: center;" src="{{asset($c->user->portalInfo->coupleFemale()->profilePicture)}}">
                                                                          @else
                                                                            <img src="{{ asset('dashlead/img/default/404-dp.png') }}" style="border:2px solid #1b4da6; border-radius:50%; padding: 2px; text-align: center;" />
                                                                          @endif
                                                                      @else
                                                                          @if(File::exists($c->user->portalInfo->profilePicture)) 
                                                                            <img style="border:2px solid #1b4da6; border-radius:50%; padding: 2px; text-align: center;" src="{{asset($c->user->portalInfo->profilePicture)}}">
                                                                          @else
                                                                            <img src="{{ asset('dashlead/img/default/404-dp.png') }}" style="border:2px solid #1b4da6; border-radius:50%; padding: 2px; text-align: center;" />
                                                                          @endif
                                                                      @endif
                                                                  </a>
                                                                
                                                              </div>
                                                              <div class="media-body">
                                                                <div class="media-contact-name mb-1">
                                                                  <h6 class="mb-0" style="color:#ff473d; font-weight: bold;">
                                                                  <a style="color:#ff473d;" href="{{url('profile?user_id='.$c->user->id)}}">{{$c->user->portalInfo->userName}}</a>,
                                                                  {{$c->user->portalInfo->humanTime}}, {{$c->user->portalInfo->regions ? $c->user->portalInfo->regions->region_name :''}}
                                                                  </h6>
                                                                </div>
                                                                <p class="mb-2" style="margin-top:5px; text-transform: capitalize; color:#ff473d;">{{$c->comment}}</p>
                                                                <ul class="reviewnavs" style="color:#f37b74; font-weight: bold;">
                                                                  <li class="mr-2"><i class="far fa-clock"></i> {{$c->updated_at->diffForHumans()}}</li>
                                                                  <li class="mr-2"><i class="far fa-calendar"></i> {{date('d F Y, H:i', strtotime($c->updated_at))}}</li>
                                                                </ul>
                                                              </div>
                                                            </div>
                                                            @endforeach

                                                            

                                                          @endif

                                                          @if(Auth::check())
                                                              <!-- Comment Form -->
                                                              <!-- <img style="border:2px solid #ff473d; border-radius:50%; padding: 2px; text-align: center; width:50px;" src="{{asset(Auth::user()->profilePicture)}}"> -->
                                                                <form action="{{route('postcommentonthispost')}}" method="post" style="margin-left: 12%;">
                                                                  @csrf
                                                                  <input type="hidden" name="group_id" value="{{$data->id}}">
                                                                  <input type="hidden" name="post_id" value="{{$p->id}}">
                                                                  <div class="form-group">
                                                                    <br>
                                                                    <textarea name="comment" class="form-control" rows="2" id="comment" placeholder="Skriv Din Kommentar Her..." style="float: right; background-color:#f9e2e1;" required></textarea>
                                                                  </div>
                                                                  <div class="form-group">
                                                                      <button type="submit" class="btn ripple btn-danger" style="float:right; margin-top: 10px; margin-bottom: 0px; font-weight: bold;text-transform: uppercase;" {{auth()->user()->isPaid() ? '' : 'disabled'}}>Kommentér</button>
                                                                  </div>
                                                                </form>
                                                  
                                                              <!-- Comment Form -->
                                                            @endif
                                                        </div>
                                                      </div>

                                                
                                                    </div>
                                                    </div>
                                                  </div>
                                                </div>

                                            @endforeach
                                            
                                          @endif

                                          <!-- Pagination -->
                                            <nav style="margin-top:10px;">
                                              <ul class="pagination justify-content-center" style="font-weight: bold;">
                                                {{ $mediaposts->links() }}
                                              </ul>
                                            </nav>
                                          <!-- Pagination -->

                                          

                                        </div>
                                    </div>
                                </div>
                            <!-- BILLEDER -->
                        </div>
                    </div>
                  <!-- Body Section -->
                </div>
              <!-- Main Section   -->

              <!-- Promotion Section -->
                <div class="col-md-3 col-lg-3">

                  <!-- Group Info -->
                    <div class="card custom-card">
                          <div class="card-body text-center">
                                <div style="margin-bottom: 10px;">
                                    <h5 class="card-title mb-1" style="font-weight: bold; text-transform:uppercase;">Grupper Info</h5><hr>
                                </div>
                              <div class="item-user pro-user">
                                  <p class="pro-user-desc text-muted mb-1" style="font-weight: bold;">
                                    Type : @if($data->group_type == 1)Paid @else Free @endif
                                  </p>
                                  <p class="pro-user-desc text-muted mb-1" style="font-weight: bold;">Skabt : {{ date('d F Y', strtotime($data->updated_at)) }}</p>
                              </div>
                          </div>
                      </div>
                  <!-- Group Info -->

                  <!-- Deactive Group -->
                    @if(Auth::user()->id == $data->user_id) 
                      <div class="card custom-card">
                          <div class="card-body h-100">
                              <div class="text-center">
                                      <button class="btn ripple btn-danger" type="button" style="margin-top: 5px; margin-bottom: 5px; font-weight: bold;text-transform: uppercase;" onclick="deactivegroup({{ $data->id }})" {{ auth()->user()->isPaid() ? '' : 'disabled' }}>
                                          Deaktiver Grupper
                                      </button>
                                      <form id="delete-form-{{$data->id}}" action="{{ route('group.groupdeactive',$data->id) }}" method="POST" style="display: none;">
                                          @csrf
                                      </form>
                              </div>
                          </div>
                      </div>
                      @endif
                  <!-- Deactive Group -->

                  <!-- Join & Leave Group -->
                    @if(Auth::user()->id != $data->user_id) 
                      <div class="card custom-card">
                          <div class="card-body h-100">
                              <div class="text-center">
                                @if(App\Models\Groups::checkThisMemberAreInThisGroup(Auth::user()->id,$data->id) || App\Models\Groups::checkThisMemberAreInThisGroupPending(Auth::user()->id,$data->id))
                                  
                                    @if(App\Models\Groups::checkThisMemberAreInThisGroupPending(Auth::user()->id,$data->id))
                                      <a href="{{route('joinGroup',$data->id)}}" type="button" class="btn ripple btn-warning" style="margin-top: 5px; margin-bottom: 5px; font-weight: bold;text-transform: uppercase;">Afventer Godkendelse</a> 
                                    @else
                                      <a href="{{route('joinGroup',$data->id)}}" type="button" class="btn ripple btn-danger" style="margin-top: 5px; margin-bottom: 5px; font-weight: bold;text-transform: uppercase;" >Forlad Gruppe</a> 
                                    @endif

                                @else
                                  <a @if(auth()->user()->isPaid()) href="{{route('joinGroup',$data->id)}}" @endif type="button" class="btn ripple btn-success" style="@if(!auth()->user()->isPaid()) cursor: not-allowed; @endif" margin-top: 5px; margin-bottom: 5px; font-weight: bold;text-transform: uppercase;">Tilmeld Gruppe</a>
                                @endif
                              </div>
                          </div>
                      </div>
                      @endif
                  <!-- Join & Leave Group -->

                  @include('dashlead.layouts.promotationsection')
                </div>
              <!-- Promotion Section -->

              </div>
            <!-- End Row -->

              <!-- Group Image Upload Modal -->
                <div class="modal" id="group_image_upload_model">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Upload GRUPPE Billede</h6><button
                                    aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <!-- Image Section -->
                              <div class="modal-body">
                                  @csrf
                                  <div class="row">
                                      <div class="col-sm-12 col-md-12">
                                          <div id="upload_gp_image_preview"></div>
                                      </div><br>
                                      <div class="col-sm-8 col-md-3">
                                          <input title="Upload Dit Billede" type="file" class="dropify" id="upload_gp_image_upload"
                                              accept=".png, .jpg, .jpeg" data-max-file-size="5M" data-height="130" data-width="250"
                                              required>
                                      </div>
                                      <div class="col-sm-4 col-md-3">
                                          <button class="btn btn-primary upload_gp_image_crop"
                                              style="padding:50px; font-weight: bold;text-transform: uppercase;">Beskær Billede</button>
                                      </div>
                                      <div class="col-sm-12 col-md-6">
                                          <div id="upload_gp_image_display" align="center" style="background:#e1e1e1;padding:18px;">
                                              <div style="text-align: center; margin-top: 40px; margin-bottom: 40px;">
                                                  <h4 style="color:#737373;">STØRRELSE 1920 x 1080</h4>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            <!-- Image Section -->
                            <!-- Form Data -->
                              <form method="POST" action="{{ route('postongroup') }}">
                                  @csrf
                                  <div class="modal-body">
                                      <input type="hidden" name="type" value="1">
                                      <input type="hidden" name="group_id" value="{{$data->id}}">
                                      <div class="row">
                                          <!-- Image -->
                                          <div id="upload_gp_image_data"></div>
                                          <!-- Image -->
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button class="btn ripple btn-success" type="submit" id="upload_gp_image_form_submit"
                                          style="font-weight: bold;text-transform: uppercase;">Upload</button>
                                      <button class="btn ripple btn-danger" data-dismiss="modal" type="button"
                                          style="font-weight: bold;text-transform: uppercase;">Tæt</button>
                                  </div>
                              </form>
                            <!-- Form Data -->
                        </div>
                    </div>
                </div>
              <!-- ./Group Image Upload Modal -->

          
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

  <!-- Event Delete Sweet Alert -->
      <script type="text/javascript">
          function deactivegroup(id) {

              swal({
              title: "Are you sure ?",
              text: "You will not be able to recover this imaginary file !",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes, Delete It !",
              cancelButtonText: "No, Cancel Please !",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm) {
              if (isConfirm) {
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
              // swal("Deleted!", "Your imaginary file has been deleted.", "success");
              } else {
              swal("Cancelled", "Your imaginary file is safe :)", "error");
              }
            });

        }
    </script>
  <!-- Event Delete Sweet Alert -->

  <!-- Upload Group Image Process -->
				<script>  
						$(document).ready(function(){
							
						// Image Preview  
							$upload_gp_image_crop_process = $('#upload_gp_image_preview').croppie({
								enableExif:true,
								viewport:{
									width:480,
									height:270,
									type:'square'
								},
								boundary:{
									width:530,
									height:320
								},
								showZoomer: true,
							});
						// Image Preview

						// Image Upload
							$('#upload_gp_image_upload').change(function(){
								var reader = new FileReader();

								reader.onload = function(event){
								$upload_gp_image_crop_process.croppie('bind', {
									url:event.target.result
								}).then(function(){
									console.log('jQuery bind complete');
								});
								}
								reader.readAsDataURL(this.files[0]);
							});
						// Image Upload

						// Crop & Form Button Hide
							$('#upload_gp_image_upload').change(function(){
								$('#upload_gp_image_preview').show();
								$('#upload_gp_image_tc').hide();
								$('.upload_gp_image_crop').removeAttr('disabled', '');
							});
							
							$('.upload_gp_image_crop').attr('disabled', '');
							$('#upload_gp_image_form_submit').attr('disabled', '');
							$('#upload_gp_image_preview').hide();
							// $('#upload_image_form_submit').hide();
						// Crop & Form Button Hide

						// Image Crop , Data Send & Received
							$('.upload_gp_image_crop').click(function(event){
								$upload_gp_image_crop_process.croppie('result', {
								type:'canvas',
								size: { width: 1920, height: 1080 }
								}).then(function(response){
								var _token = $('input[name=_token]').val();
								$.ajax({
									url:'{{ route("image.process") }}',
									type:'post',
									data:{"image":response, _token:_token},
									dataType:"json",
									success:function(data)
									{
									var gp_image_display = '<img src="/'+data.temp_image+'" style="width:192px;height:108px;"" />';
									var gp_image_data = '<input value="'+data.temp_image+'" type="hidden" name="temp_image"> <input value="'+data.temp_image_name+'" type="hidden" name="temp_image_name"> <input value="'+data.temp_image_path+'" type="hidden" name="temp_image_path">';
									$('#upload_gp_image_display').html(gp_image_display);
									$('#upload_gp_image_data').html(gp_image_data);

									// Form Button show If Image Croped
									if(gp_image_display != "") { $('#upload_gp_image_form_submit').removeAttr('disabled', ''); }
									}
								});
								});
							});
						// Image Crop , Data Send & Received
							
						});  
				</script>
	<!-- Upload Group Image Process -->


  @endpush
<!-- Developed By CBS -->