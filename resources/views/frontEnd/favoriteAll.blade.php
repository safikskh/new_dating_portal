<!-- Developed By CBS -->
  @extends('dashlead.layouts.layout')
  @section('pageTitle', 'Favoritter Profiler')
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
              <div class="col-lg-9 col-md-9">
                <div class="card custom-card">

                <div class="card-header custom-card-header">
                    <h6 class="card-title mb-0" style="font-weight: bold; text-transform:uppercase;">Favoritter Profiler</h6>
                </div>

                @if(sizeof($favouritieList) > 0)
                  <div class="row">
                    @foreach($favouritieList as $item)   
                      <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="card custom-card {{ $item->userFavourite->portalInfo->userNameColor }}" style="margin:20px;">
                          <a href="{{url('profile?user_id='.$item->userFavourite->id)}}" target="_blank">
                            <div class="card-body text-center">
                                <div class="user-lock text-center">
                                      @if(File::exists($item->userFavourite->profilePicture)) 
                                          <img class="rounded-circle" src="{{ asset('/'.$item->userFavourite->profilePicture)}}" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;">
                                      @else
                                          <img src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;">
                                      @endif
                                </div>
                              <h5 class=" mb-1 mt-3" style="text-transform: uppercase;">{{ $item->userFavourite->portalInfo->userName }}</h5>
                              <p class="mb-2 mt-1 tx-inverse" style="font-weight: bold;">{{  str_limit($item->userFavourite->portalInfo->regionName, 25) }}</p>
                            </div>
                          </a>
                        </div>
                      </div>
                    @endforeach
                  </div>
                @else
                    <div style="text-align: center; margin-top: 355px; margin-bottom: 355px;">
                        <h5 style="color:red;">Ingen Profiler Fundet.</h5>
                    </div>
                  
                @endif  

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
  @endpush
<!-- ./Developed By CBS -->