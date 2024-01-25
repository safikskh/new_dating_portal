<!-- Developed By CBS -->
  @extends('dashlead.layouts.layout')
  @section('pageTitle', 'Search')
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
                    <h6 class="card-title mb-0" style="font-weight: bold; text-transform:uppercase;">Søgeresultater</h6>
                </div>

                @if(sizeof($newMatchUserList)>0)
                  <div class="row">
                    @foreach($newMatchUserList as $item)  
                      <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="card custom-card {{ $item->userNameColor }}" style="margin:20px;">

                          <div class="card-body text-center">
                              <div class="user-lock text-center">
                                    <a href="{{ url('profile?user_id='.$item->user_id) }}">
                                        @if(File::exists($item->profilePicture)) 
                                            <img class="rounded-circle" src="{{ asset('/'.$item->profilePicture)}}" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;">
                                        @else
                                            <img src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;">
                                        @endif
                                    </a>
                              </div>
                                <a href="{{ url('profile?user_id='.$item->user_id) }}">
                                    <h5 class=" mb-1 mt-3" style="text-transform: uppercase;">{{ $item->userName }}</h5>
                                </a>
                            <p class="mb-2 mt-1 tx-inverse" style="font-weight: bold;">Alder {{  $item->humanTime }}</p>
                          </div>

                        </div>
                      </div>
                    @endforeach
                  </div>
                @else
                    <div style="text-align: center; margin-top: 355px; margin-bottom: 355px;">
                        <h5 style="color:red;">Desværre ingen resultater på din søgning</h5>
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