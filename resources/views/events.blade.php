<!-- Developed By CBS -->
  @extends('dashlead.layouts.layout')
  @section('pageTitle', 'Events')
  @push('style')

    <!---Text Editor-->
      @if( (env('TEXT_EDITOR') == true) && (env('TEXT_EDITOR_EXPIRE') >= date('Y-m-d')) )
        <link href="{{ asset('dashlead/plugins/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('dashlead/plugins/quill/quill.bubble.css') }}" rel="stylesheet">
      @endif
    <!---Text Editor-->
    <!-- Croppie JS For Image Crop -->
      <!-- <link href="{{ asset('dashlead/css/croppie.css') }}" rel="stylesheet"> -->
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

                  <!-- Create Event -->
                      <div class="card custom-card">
                          <div class="card-body h-100">
                              <div class="text-center">
                                @if(auth()->user()->isPaid())
                                  <button data-toggle="modal" class="btn ripple btn-primary" href="#create_event_model" style="margin-top: 5px; margin-bottom: 5px; font-weight: bold;text-transform: uppercase;">Opret Begivenhed</button>
                                @else
                                  <button data-toggle="modal" class="btn ripple btn-primary" href="#create_event_model" style="margin-top: 5px; margin-bottom: 5px; font-weight: bold;text-transform: uppercase;" disabled>Opret Begivenhed</button>
                                @endif
                              </div>
                          </div>
                      </div>
                  <!-- Create Event --> 
                
                  <!-- Latest Event -->    
                    <div class="card custom-card">
                      <div class="card-header custom-card-header">
                        <h6 class="card-title mb-0" style="font-weight: bold; text-transform:uppercase;">Nyeste Event</h6>
                      </div>
                        @if(sizeof($latestEvents)>0)  
                          @foreach($latestEvents as $key => $le)
                              <div class="list d-flex align-items-center p-3 border-top">
                                <span style="font-weight: bold; border:2px solid #1b4da6; border-radius:0%; padding: 5px; text-align: center; color:white; background:#1b4da6;">{{ $key+1 }}</span>
                                <div class="wrappe ml-3">
                                  <a href="{{route('eventDetails',$le->id)}}" style="color:black;">
                                    <h6 class="mb-1">{{ str_limit($le->title, $limit = 40, $end = ' . . .') }}</h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                        <span class="mb-0 text-muted"><i class="fas fa-clock mr-2"></i>{{date('d m Y', strtotime($le->event_date))}} , {{date('H:i', strtotime($le->event_time))}}</span>
                                      </div>
                                    </div>
                                  </a>
                                </div>
                              </div>
                            @endforeach
                            <!-- <div class="card-footer">
                              <a href="#" class="btn ripple btn-primary btn-block">Se Mere</a>
                            </div> -->
                        @else
                          <div style="text-align: center; margin-top: 150px; margin-bottom: 150px;">
                                <h5 style="color:red;">Ingen Tilgængelig Data</h5>
                            </div>
                        @endif
                    </div>
                  <!-- Latest Event -->

                  <!-- Populer Event -->    
                    <div class="card custom-card">
                      <div class="card-header custom-card-header">
                        <h6 class="card-title mb-0" style="font-weight: bold; text-transform:uppercase;">Populær Event</h6>
                      </div>
                        @if(sizeof($populerEvents)>0)  
                          @foreach($populerEvents as $key => $po)
                              <div class="list d-flex align-items-center p-3 border-top">
                                <span style="font-weight: bold; border:2px solid #1b4da6; border-radius:0%; padding: 5px; text-align: center; color:white; background:#1b4da6;">{{ $key+1 }}</span>
                                <div class="wrappe ml-3">
                                  <a href="{{route('eventDetails',$le->id)}}" style="color:black;">
                                    <h6 class="mb-1">{{ str_limit($po->title, $limit = 40, $end = ' . . .') }}</h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                        <span class="mb-0 text-muted"><i class="fas fa-clock mr-2"></i>{{date('d m Y', strtotime($po->event_date))}} , {{date('H:i', strtotime($po->event_time))}}</span>
                                      </div>
                                    </div>
                                  </a>
                                </div>
                              </div>
                            @endforeach
                            <!-- <div class="card-footer">
                              <a href="#" class="btn ripple btn-primary btn-block">Se Mere</a>
                            </div> -->
                        @else
                            <div style="text-align: center; margin-top: 150px; margin-bottom: 150px;">
                                <h5 style="color:red;">Ingen Tilgængelig Data</h5>
                            </div>
                        @endif
                    </div>
                  <!-- Populer Event -->

                </div>
              <!-- Sidebar Section   -->

              <!-- Main Section   -->
                <div class="col-md-6 col-lg-6">
                  <!-- Search Option -->  
                    <div class="row">
                    <div class="col-sm-12 col-lg-12">
                      <div class="card custom-card">
                          <div class="card-body h-100">
                            <div class="row">

                              <div class="col-sm-9 col-lg-9">
                                  <form method="POST" action="{{route('eventsearch')}}">
                                      @csrf
                                      <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Søg her ..." required>
                                        <span class="input-group-append">
                                          <button type="submit" class="btn ripple btn-primary" style="font-weight: bold;text-transform: uppercase;">Søg</button>
                                          <!-- <button type="submit" class="btn ripple btn-danger" style="font-weight: bold;text-transform: uppercase;">Nulstil</button> -->
                                        </span>
                                      </div>
                                  </form>
                                </div>
                                <div class="col-sm-3 col-lg-3">
                                  <form method="POST" action="{{route('eventsearch')}}">
                                      @csrf
                                      <button type="submit" class="btn ripple btn-danger" style="font-weight: bold;text-transform: uppercase;">Nulstil</button>
                                  </form>
                              </div>

                            </div>
                          </div>
                        </div>
                    </div>
                    </div>
                  <!-- Search Option -->

                  <!-- Body Section -->
                    <div class="row">  
                      @if(sizeof($events)>0)
                          @foreach($events as $key=>$d)
                              <div class="col-sm-6 col-lg-6">
                                <div class="card item-card custom-card">
                                  <div class="card-body h-100">
                                    <div class="product h-100">
                                      <!-- Item Body -->
                                        <div class="text-center product-img mb-0">
                                          <a href="{{route('eventDetails',$d->id)}}" >
                                            @if(File::exists($d->image)) 
                                              <img src="{{asset('/'.$d->image)}}" class="img-fluid" width="210" height="70">
                                            @else
                                                <img src="{{ asset('dashlead/img/default/404-image.png') }}" class="img-fluid" width="210" height="70">
                                            @endif
                                          </a>
                                        </div>
                                        <div class="text-center mt-0">
                                        <a href="{{route('eventDetails',$d->id)}}">
                                          <h6 class="mb-0 mt-2" style="font-weight: bold; color:black;">{{ str_limit($d->title, $limit = 60, $end = ' . . .') }}</h6>
                                        </a>
                                          <div class="price mt-2 h5 mb-0">

                                          <h5>
                                            <span class="badge badge-light" style="margin-bottom: 0px; font-weight: bold; float: center;">
                                              {{date('d F Y', strtotime($d->date))}} , {{date('H:i', strtotime($d->time))}}
                                            </span>
                                          </h5>

                                          <h5>
                                            <span class="badge badge-primary" style="margin-bottom: 0px; font-weight: bold; float: center;">
                                                @if($d->type == 1)
                                                  Type : Paid [ {{ $d->amount }} kr.]
                                                @else
                                                  Type : Free
                                                @endif
                                            </span>
                                          </h5>

                                          <h5>
                                            <span class="badge badge-primary" style="margin-bottom: 0px; font-weight: bold; float: center;">
                                                Lokation : {{ $d->location }}
                                            </span>
                                          </h5>

                                          </div>
                                        </div>
                                      <!-- Item Body -->
                                      <!-- Action Link -->
                                        <div class="product-info">
                                          <a href="{{route('eventDetails',$d->id)}}" class="btn ripple  btn-primary btn-sm mt-1 mb-1 text-sm text-white"  data-toggle="tooltip" data-placement="bottom" title="Udsigt">
                                            <i class="fe fe-eye"></i>
                                          </a>
                                          @if( (auth()->user()->isPaid()) && (Auth::user()->id != $d->user_id) )
                                          <a href="{{route('joinEvent',$d->id)}}" class="btn ripple  btn-sm btn-secondary mt-1 text-sm  mb-1 text-white" data-toggle="tooltip" data-placement="bottom" title="Tilslutte">
                                            <i class="fe fe-plus-square"></i>
                                          </a>
                                          @endif
                                          @if( (auth()->user()->isPaid()) && (Auth::user()->id == $d->user_id) )
                                          <a href="{{route('event.eventedit',$d->id)}}" class="btn ripple  btn-info btn-sm mt-1 mb-1 text-sm  text-white"  data-toggle="tooltip" data-placement="bottom" title="Redigere">
                                            <i class="fe fe-edit"></i>
                                          </a>
                                          @endif
                                          @if( (auth()->user()->isPaid()) && (Auth::user()->id == $d->user_id) )
                                                <button class="btn ripple  btn-sm btn-danger mt-1 text-sm  mb-1 text-white" type="button" onclick="deactiveevent({{ $d->id }})">
                                                    <i class="fe fe-trash"></i>
                                                </button>
                                                <form id="delete-form-{{$d->id}}" action="{{ route('event.eventdeactive',$d->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    <!-- @method('DELETE') -->
                                                </form>

                                          @endif
                                        </div>
                                      <!-- Action Link -->
                                    </div>
                                  </div>
                                </div>
                              </div>
                          @endforeach
                      @else
                        <div class="col-sm-12 col-lg-12">
                              <div class="card">
                                <div class="card-body">

                                  <div style="text-align: center; margin-top: 355px; margin-bottom: 355px;">
                                    <h5 style="color:red;">Ingen Tilgængelig Data</h5>
                                  </div>

                                </div>
                              </div>
                          </div>
                      @endif
                    </div>

                    <!-- Pagination -->
                      <nav>
                        <ul class="pagination justify-content-center" style="font-weight: bold;">
                          {{ $events->links() }}
                        </ul>
                      </nav>
                    <!-- Pagination -->
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

            <!-- Create Event Modal -->
                      <div class="modal" id="create_event_model">
                          <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content modal-content-demo">
                                  <div class="modal-header">
                                      <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Opret Begivenhed</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                  </div>


                                  <!-- Image Section -->
                                    <div class="modal-body">
                                        @csrf
                                        <div class="row">

                                            <div class="col-sm-12 col-md-12">
                                              <div id="image-preview"></div>
                                            </div><br>

                                            <div class="col-sm-8 col-md-3">
                                                <input title="Upload Dit Billede" type="file" class="dropify" id="upload_image" accept=".png, .jpg, .jpeg" data-max-file-size="2M"  data-height="130" data-width="250" required>
                                            </div>

                                            <div class="col-sm-4 col-md-3">
                                              <button class="btn btn-primary crop_image" style="padding:50px; font-weight: bold;text-transform: uppercase;">Beskær Billede</button>
                                            </div>
                                            
                                            <!-- <div class="col-sm-12 col-md-6">
                                              <div id="uploaded_image" align="center" style="background:#e1e1e1;width:360px;height:145px; padding:20px;"></div>
                                            </div> -->

                                            <div class="col-sm-12 col-md-6">
                                              <div id="uploaded_image" align="center" style="background:#e1e1e1;padding:18px;">
                                                      <div style="text-align: center; margin-top: 40px; margin-bottom: 40px;">
                                                          <h4 style="color:#737373;">STØRRELSE 900 x 300</h4>
                                                      </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                  <!-- Image Section -->

                                  <!-- Event Data -->  
                                    <form id="form_event_create" method="POST" action="{{ route('event.eventstore') }}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                  <div class="form-group">
                                                      <label style="font-weight: bold;">Titel <span style="color:red">*</span></label>
                                                      <input type="text" class="form-control" name="title" required> 
                                                  </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                  <div class="form-group">
                                                      <label style="font-weight: bold;">Lokation <span style="color:red">*</span></label>
                                                      <input type="text" class="form-control" name="location" required> 
                                                  </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                  <div class="form-group">
                                                      <label style="font-weight: bold;">Type <span style="color:red">*</span></label>
                                                      <select style="width: 100%" name="event_type" class="form-control select2" required>
                                                            <option value="0">Gratis</option>
                                                            <option value="1">Betalt</option>
                                                      </select>
                                                  </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-weight: bold;">Beløb <span style="color:red">*</span></label>
                                                        <input type="number" class="form-control" name="amount" required> 
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-weight: bold;">Dato <span style="color:red">*</span></label>
                                                        <input type="date" class="form-control" name="event_date" required> 
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-weight: bold;">Tidspunkt <span style="color:red">*</span></label>
                                                        <input type="time" class="form-control" name="event_time" required> 
                                                    </div>
                                                </div>
                                                <!-- Text Editor -->
                                                  @if( (env('TEXT_EDITOR') == true) && (env('TEXT_EDITOR_EXPIRE') >= date('Y-m-d')) )
                                                  <div class="col-sm-12 col-md-12">
                                                      <div class="form-group">
                                                          <label style="font-weight: bold;">Detaljer <span style="color:red">*</span></label>
                                                          <div class="ql-wrapper">
                                                              <div id="createdata" style="height:200px;"></div>
                                                          </div>
                                                          <textarea type="textarea" style="display:none;"  id="details" name="details" required></textarea>
                                                      </div>
                                                  </div>
                                                <!-- Text Editor -->
                                                <!-- Text Area -->
                                                  @else
                                                    <div class="col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <label style="font-weight: bold;">Detaljer <span style="color:red">*</span></label>
                                                            <textarea type="textarea" rows="10" class="form-control" name="details" required></textarea>
                                                        </div>
                                                    </div>
                                                  @endif
                                                <!-- Text Area -->
                                                <!-- Image -->
                                                  <div id="img_data"></div>
                                                <!-- Image -->
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn ripple btn-success" type="submit" id="form_submit" style="font-weight: bold;text-transform: uppercase;">Opret</button>
                                            <button class="btn ripple btn-danger" data-dismiss="modal" type="button" style="font-weight: bold;text-transform: uppercase;">Luk</button>
                                        </div>
                                    </form>
                                  <!-- Event Data -->

                              </div>
                          </div>
                      </div>
            <!-- ./Create Event Modal -->
          
          </div>
        </div>
      <!-- End Main Content-->
  @endsection

  @push('script')

    <!-- Text  Editor -->
      @if( (env('TEXT_EDITOR') == true) && (env('TEXT_EDITOR_EXPIRE') >= date('Y-m-d')) )
        <script src="{{ asset('dashlead/plugins/quill/quill.min.js') }}"></script>
        <script type="text/javascript" language="javascript" >
            $(function() {
                'use strict'
                var icons = Quill.import('ui/icons');
                // icons['bold'] = '<i class="fas fa-bold" aria-hidden="true"><\/i>';
                // icons['italic'] = '<i class="fas fa-italic" aria-hidden="true"><\/i>';
                // icons['underline'] = '<i class="fas fa-underline" aria-hidden="true"><\/i>';
                // icons['strike'] = '<i class="fas fa-strikethrough" aria-hidden="true"><\/i>';
                // icons['list']['ordered'] = '<i class="fas fa-list-ol" aria-hidden="true"><\/i>';
                // icons['list']['bullet'] = '<i class="fas fa-list-ul" aria-hidden="true"><\/i>';
                // icons['link'] = '<i class="fas fa-link" aria-hidden="true"><\/i>';
                // icons['image'] = '<i class="fas fa-image" aria-hidden="true"><\/i>';
                // icons['video'] = '<i class="fas fa-film" aria-hidden="true"><\/i>';
                // icons['code-block'] = '<i class="fas fa-code" aria-hidden="true"><\/i>';

                var toolbarOptions = [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'script': 'sub'}, { 'script': 'super' }],

                    [   
                        { 'list': 'ordered'}, { 'list': 'bullet'},
                        {'indent': '-1'}, { 'indent': '+1' }
                    ],

                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'direction': 'rtl' },{ 'align': [] }],

                    ['link', 'image', 'video']

                    // ['blockquote', 'code-block'],

                    // ['clean']
                ];
                
                var quillModal = new Quill('#createdata', {
                    modules: {
                        toolbar: toolbarOptions
                    },
                    theme: 'snow'
                });

                // Send Data Quill to Text Area
                quillModal.on('text-change', function(delta, oldDelta, source) {
                    $('#details').text($(".ql-editor").html());
                });

            });
        </script>
      @endif
    <!-- Text  Editor -->

    <!-- Croppie JS For Image Crop -->
    {{-- <script src="{{ asset('dashlead/js/croppie.js') }}"></script> --}}

    <!-- Image Process -->
      <script>  
        $(document).ready(function(){
          
          // Image Preview  
            $image_crop = $('#image-preview').croppie({
                enableExif:true,
                viewport:{
                  width:450,
                  height:150,
                  type:'square'
                },
                boundary:{
                  width:550,
                  height:250
                },
                showZoomer: true,
            });

          // Image Preview

          // Image Upload
            $('#upload_image').change(function(){
              var reader = new FileReader();

              reader.onload = function(event){
                $image_crop.croppie('bind', {
                  url:event.target.result
                }).then(function(){
                  console.log('jQuery bind complete');
                });
              }
              reader.readAsDataURL(this.files[0]);
            });
          // Image Upload

          // Crop & Form Button Hide
            $('#upload_image').change(function(){
              // $('.crop_image').show();
              $('#image-preview').show();
              $('.crop_image').removeAttr('disabled', '');
            });
            
            // $('.crop_image').hide();
            $('.crop_image').attr('disabled', '');
            $('#form_submit').attr('disabled', '');
            $('#image-preview').hide();
            // $('#form_submit').hide();
          // Crop & Form Button Hide

          // Image Crop , Data Send & Received
            $('.crop_image').click(function(event){
              $image_crop.croppie('result', {
                type:'canvas',
                size: { width: 900, height: 300 }
              }).then(function(response){
                var _token = $('input[name=_token]').val();
                $.ajax({
                  url:'{{ route("image.process") }}',
                  type:'post',
                  data:{"image":response, _token:_token},
                  dataType:"json",
                  success:function(data)
                  {
                    var crop_image = '<img src="/'+data.temp_image+'" />';
                    var img_data = '<input value="'+data.temp_image+'" type="hidden" name="temp_image"> <input value="'+data.temp_image_name+'" type="hidden" name="temp_image_name"> <input value="'+data.temp_image_path+'" type="hidden" name="temp_image_path">';
                    $('#uploaded_image').html(crop_image);
                    $('#img_data').html(img_data);

                    // Form Button show If Image Croped
                    if(crop_image != "") { $('#form_submit').removeAttr('disabled', ''); }
                  }
                });
              });
            });
          // Image Crop , Data Send & Received
          
        });  
      </script>
    <!-- Image Process -->

    <!-- Event Delete Sweet Alert -->
      <script type="text/javascript">
          function deactiveevent(id) {

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