<!-- Developed By CBS -->
  @extends('dashlead.layouts.layout')
  @section('pageTitle', 'Fremhævninger')
  @push('style')
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

            <!-- Main Section -->  
              <div class="col-lg-12 col-md-12">
                <div class="card custom-card">
                  <div class="card-header custom-card-header">
                      <h6 class="card-title mb-0" style="font-weight: bold; text-transform:uppercase;">Fremhævninger</h6>
                  </div>

                  @if(sizeof($promotonList) > 0)
                    <div class="row">  
                      @foreach($promotonList as $item) 
                        <div class="col-sm-12 col-md-3 col-lg-3">
                          @if($item->user->portalInfo->sex == 'Par')
                            <div class="card custom-card" style="background:#eeffeb; margin:20px;">
                          @else
                            <div class="card custom-card {{$item->user->portalInfo->userNameColor}}" style="margin:20px;">
                          @endif
                                <p style="text-center; margin:10px; font-weight: bold;">{{  str_limit($item->promotionTitle, 160) }}</p>
                                <img class="card-img-top" src="{{asset($item->image)}}" alt="Card image" style="width:100%">
                                <div class="card-body" style="padding:0px;">
                                    <div class="row">
                                    
                                        <div class="col-4" style="padding:15px 0px 0px 20px;">
                                            <a href="{{url('profile?user_id='.$item->user_id)}}">
                                                @if($item->user->portalInfo->sex == 'Par')
                                                    @if(File::exists($item->user->portalInfo->coupleFemale()->profilePicture)) 
                                                        <img src="{{asset($item->user->portalInfo->coupleFemale()->profilePicture)}}" style="width:40px; height:40px; border-radius: 50%;">
                                                    @else
                                                        <img src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle" style="width:40px; height:40px; border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;">
                                                    @endif
                                                @else
                                                    @if(File::exists($item->user->portalInfo->profilePicture)) 
                                                      <img src="{{asset($item->user->portalInfo->profilePicture)}}" style="width:40px; height:40px; border-radius: 50%;">
                                                    @else
                                                        <img src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle" style="width:40px; height:40px; border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;">
                                                    @endif
                                                @endif
                                            </a>
                                        </div>
                                        <div  class="col-8 text-left" style="padding:15px 0px 0px 0px;">
                                            <p>
                                                <a href="{{url('profile?user_id='.$item->user_id)}}">
                                                    <span style="font-weight: bold; text-transform:uppercase;">{{  str_limit($item->user->portalInfo->userName, 30) }} - {{$item->user->portalInfo->humanTime}} Y</span></a><br>
                                                <span style="font-weight: bold; text-transform:uppercase;">{{  str_limit($item->user->portalInfo->regionName, 30) }}</span><br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      @endforeach
                    </div> 
                  @else
                      <div style="text-align: center; margin-top: 355px; margin-bottom: 355px;">
                          <h5 style="color:red;">Intet chatrum tilgængeligt i din portal !</h5>
                      </div>
                  @endif
                </div>
              </div>
            <!-- Main Section -->

            </div>
          <!-- End Row -->

          </div>
        </div>
      <!-- End Main Content-->
  @endsection
  @push('script')
  @endpush
<!-- ./Developed By CBS -->