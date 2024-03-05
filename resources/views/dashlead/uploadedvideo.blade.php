<!-- Developed By CBS -->
  @extends('dashlead.layouts.layout')
  @section('pageTitle', 'Videoer')
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

              <!-- Video Section -->
                <div class="col-lg-9 col-md-9">
                  <div class="card custom-card">

                    @if(auth()->user()->isPaid())
                      <div class="card-body">
                        @if(sizeof($data)>0)
                          <ul class="list-unstyled row mb-0">
                            @foreach($data as $d)
                              @if(File::exists($d->file))

                                <li class="col-sm-6 col-md-4 col-lg-4 mb-3 pl-sm-2 pr-sm-2">
                                    <video width="260" height="150" controls>
                                      <source src="{{asset('/'.$d->file)}}" type="video/mp4">
                                      <source src="{{asset('/'.$d->file)}}" type="video/ogg">
                                      <source src="{{asset('/'.$d->file)}}" type="video/webm">
                                      <source src="{{asset('/'.$d->file)}}" type="video/3gp">
                                      Your browser does not support the video tag.
                                    </video>
                                    <div style="padding-top: 5px;">
                                        <h6 style="text-align: left;">
                                          <a href="{{url('profile?user_id='.$d->user->id)}}">{{$d->user->portalInfo->userName}}</a>
                                          <span style="float:right">
                                            {{App\Models\Events::getAge($d->user->portalInfo->dob,date('Y-m-d'))}}, {{App\Models\Events::getLocation($d->user->portalInfo->region_id)}}
                                          </span>
                                        </h4>
                                    </div>
                                </li>
                                
                                @else
                                  <li class="col-sm-6 col-md-4 col-lg-4 mb-3 pl-sm-2 pr-sm-2">
                                    <div style="text-align: center;">
                                      <img src="{{ asset('dashlead/img/default/404-video.png') }}" class="thumbimg" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; height:150px;">
                                    </div>
                                    <div style="padding-top: 5px;">
                                        <h6 style="text-align: left;">
                                          <a href="{{url('profile?user_id='.$d->user->id)}}">{{$d->user->portalInfo->userName}}</a>
                                          <span style="float:right">
                                            {{App\Models\Events::getAge($d->user->portalInfo->dob,date('Y-m-d'))}}, {{App\Models\Events::getLocation($d->user->portalInfo->region_id)}}
                                          </span>
                                        </h4>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                          </ul>
                        @else
                          <div style="text-align: center; margin-top: 100px; margin-bottom: 100px;">
                            <h5 style="color:red;">Der Er Ingen Videoer.</h5>
                          </div>
                        @endif
                        <!-- Pagination ==== -->
                          <nav>
                              <ul class="pagination justify-content-center">
                                {{ $data->links() }}
                              </ul>
                          </nav>
                        <!-- Pagination ==== -->
                      </div>
                    @else
                      <div style="text-align: center; margin-top: 100px; margin-bottom: 100px;">
                        <h5 style="color:red;">Kun Et Betalt Medlem Kan Se Videoer.</h5>
                      </div>
                    @endif

                  </div>
                </div>
              <!-- Video Section -->

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

