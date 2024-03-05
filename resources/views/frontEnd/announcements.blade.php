<!-- Developed By CBS -->
  @extends('dashlead.layouts.layout')
  @section('pageTitle', 'Nyheder')
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
                      <h6 class="card-title mb-0" style="font-weight: bold; text-transform:uppercase;">Nyheder</h6>
                  </div>

                  @if(sizeof($announcements) > 0)
                    <div class="row">  
                        @foreach($announcements as $item)
                            <div class="col-xl-4 col-md-4">
                                <div class="card custom-card" style="min-height: 350px; margin:20px;">
                                    <div class="card-body">
                                        <h4 class="card-title">{{$item->title}}</h4>
                                        <h6><span class="badge badge-dark" style="font-weight: bold;"><i class="far fa-clock"></i>  {{date('l, d F Y, H:i', strtotime($item->updated_at))}}</span></h6>
                                            @if (strlen($item->detail) >= 300)
                                                <p class="card-text">{!! nl2br(str_limit($item->detail, 300)) !!}</p>
                                            @else
                                                <p class="card-text">{!! nl2br($item->detail) !!}</p>
                                            @endif
                                    </div>
                                    <div class="card-footer">
                                        <a class="btn ripple btn-primary" href="#" data-toggle="modal" data-target="#announcement-{{ $item->id }}">Læs Mere<i class="fe fe-arrow-right ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- Details Modal -->
                                <div class="modal" id="announcement-{{ $item->id }}">
                                    <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title" style="font-weight: bold;">{{ $item->title }}</h6>
                                                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        {!! nl2br($item->detail) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn ripple btn-danger" data-dismiss="modal" type="button" style="font-weight: bold;text-transform: uppercase;">Tæt</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- ./Details Modal -->
                        @endforeach
                    </div>
                    <!-- Pagination -->
                      <nav>
                        <ul class="pagination justify-content-center" style="font-weight: bold;">
                          {{ $announcements->links() }}
                        </ul>
                      </nav>
                    <!-- Pagination -->
                  @else
                      <div style="text-align: center; margin-top: 350px; margin-bottom: 350px;">
                          <h5 style="color:red;">Ingen meddelelser fundet !</h5>
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
