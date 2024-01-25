<!-- Developed By CBS -->
  @extends('dashlead.layouts.layout')
  @section('pageTitle', 'Blokerede Profiler')
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
                    <h6 class="card-title mb-0" style="font-weight: bold; text-transform:uppercase;">Blocked Profiles</h6>
                </div>

                @if(sizeof($blockTo) > 0)
                  <div class="row">
                    @foreach($blockTo as $block)   
                      <div class="col-sm-12 col-md-4 col-lg-4">
                        
                            @if($block->userblockto->portalInfo->sex == 'Par')
                                <div class="card custom-card" style="background:#eeffeb; margin:20px;">
                                    <div class="card-body text-center">
                                      <div style="max-width: 27%;max-height: 27%;display: inline-block;">
                                        @if(File::exists($block->userblockto->portalInfo->coupleMale()->profilePicture)) 
                                            <img src="{{asset($block->userblockto->portalInfo->coupleMale()->profilePicture)}}" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;">
                                        @else
                                            <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle">
                                        @endif
                                      </div>
                                      <div style="max-width: 27%;max-height: 27%;display: inline-block;">
                                          @if(File::exists($block->userblockto->portalInfo->coupleFemale()->profilePicture)) 
                                              <img src="{{asset($block->userblockto->portalInfo->coupleFemale()->profilePicture)}}" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;">
                                          @else
                                              <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle">
                                          @endif
                                      </div>
                                      <h5 class=" mb-1 mt-3" style="text-transform: uppercase;">{{ $block->userblockto->portalInfo->userName }}</h5>
                                      <p class="mb-2 mt-1 tx-inverse" style="font-weight: bold;">{{  str_limit($block->userblockto->portalInfo->regionName, 25) }}</p>
                                      <div class="mt-2 user-info btn-list">
                                        <form action="{{ route('userBlockDelete') }}" method="POST">
                                          {{ csrf_field() }}
                                          <input type="hidden" name="block_by" value="{{ Auth::user()->id }}">
                                          <input type="hidden" name="block_to" value="{{ $block->block_to }}">
                                          <input type="hidden" name="block_status" value="1">
                                          <button type="submit" class="btn ripple btn-primary"  style="margin-top: 10px; margin-bottom: 10px; font-weight: bold; text-transform: uppercase;">Fjern Blokering</button>
                                        </form>
                                      </div>
                                  </div>
                              </div>
                            @else
                              <div class="card custom-card {{ $block->userblockto->portalInfo->userNameColor }}" style="margin:20px;">
                                  <div class="card-body text-center">
                                      <div class="user-lock text-center">
                                          @if(File::exists($block->userblockto->profilePicture)) 
                                              <img class="rounded-circle" src="{{ asset('/'.$block->userblockto->profilePicture)}}" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;">
                                          @else
                                              <img src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;">
                                          @endif
                                      </div>
                                      <h5 class=" mb-1 mt-3" style="text-transform: uppercase;">{{ $block->userblockto->portalInfo->userName }}</h5>
                                      <p class="mb-2 mt-1 tx-inverse" style="font-weight: bold;">{{  str_limit($block->userblockto->portalInfo->regionName, 25) }}</p>
                                      <div class="mt-2 user-info btn-list">
                                        <form action="{{ route('userBlockDelete') }}" method="POST">
                                          {{ csrf_field() }}
                                          <input type="hidden" name="block_by" value="{{ Auth::user()->id }}">
                                          <input type="hidden" name="block_to" value="{{ $block->block_to }}">
                                          <input type="hidden" name="block_status" value="1">
                                          <button type="submit" class="btn ripple btn-primary"  style="margin-top: 10px; margin-bottom: 10px; font-weight: bold; text-transform: uppercase;">Fjern Blokering</button>
                                        </form>
                                      </div>
                                  </div>
                              </div>
                            @endif
                            
                      </div>
                    @endforeach
                  </div>
                @else
                    <div style="text-align: center; margin-top: 355px; margin-bottom: 355px;">
                        <h5 style="color:red;">Endnu Ingen Blokerede Profiler.</h5>
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