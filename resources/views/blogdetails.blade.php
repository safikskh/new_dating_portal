<!-- Developed By CBS -->
  @extends('dashlead.layouts.layout')
  @section('pageTitle', 'Blogs')
  @push('style')
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

                  <!-- Post Owner -->
                    <div class="card custom-card">
                        <div class="card-body text-center">
                              <div style="margin-bottom: 10px;">
                                  <h5 class="card-title mb-1" style="font-weight: bold; text-transform:uppercase;">Blog Ejer</h5><hr>
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
                  <!-- Post Owner -->

                  <!-- Deactive Post -->
                    @if(Auth::user()->id == $data->user_id) 
                      <div class="card custom-card">
                          <div class="card-body h-100">
                              <div class="text-center">
                                      <button class="btn ripple btn-danger" type="button" style="margin-top: 5px; margin-bottom: 5px; font-weight: bold;text-transform: uppercase;" onclick="deactiveblog({{ $data->id }})" {{ auth()->user()->isPaid() ? '' : 'disabled' }}>
                                          Deaktiver Post
                                      </button>
                                      <form id="delete-form-{{$data->id}}" action="{{ route('event.eventdeactive',$data->id) }}" method="POST" style="display: none;">
                                          @csrf
                                      </form>
                              </div>
                          </div>
                      </div>
                      @endif
                  <!-- Deactive Post -->
                

                  <!-- Similiar Post -->    
                    <div class="card custom-card">
                      <div class="card-header custom-card-header">
                        <h6 class="card-title mb-0" style="font-weight: bold; text-transform:uppercase;">Lignende Begivenhed</h6>
                      </div>
                        @if(sizeof($similarBlog)>0)  
                          @foreach($similarBlog as $key => $sm)
                              <div class="list d-flex align-items-center p-3 border-top">
                                <span style="font-weight: bold; border:2px solid #1b4da6; border-radius:0%; padding: 5px; text-align: center; color:white; background:#1b4da6;">{{ $key+1 }}</span>
                                <div class="wrappe ml-3">
                                  <a href="{{route('blogDetails',$sm->id)}}" style="color:black;">
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
                  <!-- Similiar Post -->

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
                              <P>{{$data->sub_title}}</P>
                            </div>
                        </div>

                        <nav class="nav main-nav-line">
                            <a class="nav-link active" data-toggle="tab" href="#tab1over">POST</a>
                            <a class="nav-link" data-toggle="tab" href="#tab2rev">KOMMENTARER ({{count($blogComment)}})</a>
                        </nav>
                        <div class="card-body tab-content h-100">
                            <!-- POST -->
                                <div class="tab-pane active" id="tab1over">
                                    <div>{!! $data->details !!}</div>
                                </div>
                            <!-- POST -->
                            <!-- kommenter -->
                                <div class="tab-pane" id="tab2rev">
                                    <div class="main-content-label tx-13 mg-b-20">
                                        <div class="card-body">

                                          <!-- kommenter Form -->
                                            <form action="{{route('blog.comment')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="blog_id" value="{{$data->id}}">
                                                <div class="form-group">
                                                  <br>
                                                  <textarea name="comment" class="form-control" rows="3" id="comment" placeholder="Start Din Kommenter....." style="background-color:#dee7f7;" required></textarea>
                                                </div>
                                                <div class="form-group text-right">
                                                    <button type="submit" class="btn ripple btn-primary" style="margin-top: 0px; margin-bottom: 0px; font-weight: bold;text-transform: uppercase;" {{auth()->user()->isPaid() ? '' : 'disabled'}}>kommenter</button>
                                                </div>
                                            </form>
                                          <!-- kommenter Form -->

                                          @foreach ($blogComment as $comment)
                                            <div class="container">
                                                <div class="card">
                                                  <div class="card-body">

                                                    <div class="row">

                                                    <div class="media mb-0">
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
                                                          <h6 class="mb-0" style="color:#1b4da6; font-weight: bold;">
                                                          <a style="color:#1b4da6;" href="{{url('profile?user_id='.$comment->user->id)}}">{{$comment->user->portalInfo->userName}}</a>,
                                                            {{$comment->user->portalInfo->humanTime}}, {{$comment->user->portalInfo->regions ? $comment->user->portalInfo->regions->region_name :''}}
                                                            </h6>
                                                        </div>
                                                        <p class="mb-2" style="margin-top:5px; text-transform: capitalize; color:#1b4da6;">{{$comment->comment}}</p>
                                                        <ul class="reviewnavs" style="color:#6a98ea; font-weight: bold;">
                                                          <li class="mr-2"><i class="far fa-clock"></i> {{$comment->updated_at->diffForHumans()}}</li>
                                                          <li class="mr-2"><i class="far fa-calendar"></i> {{date('d F Y, H:i', strtotime($comment->updated_at))}}</li>
                                                        </ul>
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
                                                {{ $blogComment->links() }}
                                              </ul>
                                            </nav>
                                          <!-- Pagination -->

                                          

                                        </div>
                                    </div>
                                </div>
                            <!-- kommenter -->
                        </div>
                    </div>
                  <!-- Body Section -->
                </div>
              <!-- Main Section   -->

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

  <!-- Event Delete Sweet Alert -->
      <script type="text/javascript">
          function deactiveblog(id) {

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

  @endpush
<!-- Developed By CBS -->