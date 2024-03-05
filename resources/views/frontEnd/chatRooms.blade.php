<!-- Developed By CBS -->
  @extends('dashlead.layouts.chat')
  @section('pageTitle', 'Chatrum')
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
                      <h6 class="card-title mb-0" style="font-weight: bold; text-transform:uppercase;">Chatrum</h6>
                  </div>

                  @if(sizeof($chatrooms) > 0)
                    <div class="row">  
                      @foreach($chatrooms as $chatroom) 
                        <div class="col-sm-12 col-md-4 col-lg-4">
                          <div class="card custom-card" style="margin:20px;">
                            <div class="card-body text-center">
                              <div class="user-lock text-center" title="{{$chatroom->chatroom_name}}">
                                    @if(File::exists($chatroom->chatroom_image)) 
                                        <img class="rounded-circle" src="{{ asset($chatroom->chatroom_image) }}" alt="555" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;">
                                    @else
                                        <img src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;">
                                    @endif
                              </div>
                              <h6 title="{{$chatroom->chatroom_name}}" class="mb-1 mt-3" style="text-transform: uppercase;">{{str_limit($chatroom->chatroom_name, $limit = 30, $end = '. . .')}}</h6>
                              {{-- <p class="mb-2 mt-1 tx-inverse" style="font-weight: bold;">
                                <online-by-chatroom :chatroom="{{$chatroom->id}}"></online-by-chatroom>
                              </p> --}}
                              <div class="mt-2 user-info btn-list">
                                  <a target="_blank" class="btn ripple btn-primary" style="margin-top: 10px; margin-bottom: 10px; font-weight: bold; text-transform: uppercase;" href="{{"chat-rooms/". $chatroom->id}}" class="btn btn-radiaus">Deltag</a>
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