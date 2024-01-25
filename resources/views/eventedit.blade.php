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
      <link href="{{ asset('dashlead/css/croppie.css') }}" rel="stylesheet">
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
                            <div style="text-align: center; margin-top: 210px; margin-bottom: 210px;">
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
                                  <a href="{{route('eventDetails',$po->id)}}" style="color:black;">
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
                            <div style="text-align: center; margin-top: 210px; margin-bottom: 210px;">
                                <h5 style="color:red;">Ingen Tilgængelig Data</h5>
                            </div>
                        @endif
                    </div>
                  <!-- Populer Event -->

                </div>
              <!-- Sidebar Section   -->

              <!-- Main Section   -->
                <div class="col-md-6 col-lg-6">

                              <div class="card item-card custom-card">
                                <div class="card-body h-100">
                                  <div class="modal-header">
                                      <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Rediger Begivenhed</h6>
                                  </div>
                                  <!-- Image Section -->
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4">
                                                <input title="Upload Dit Billede" type="file" class="dropify" id="upload_image" accept=".png, .jpg, .jpeg" data-max-file-size="2M"  data-height="130" data-width="250" required>
                                            </div>
                                            <div class="col-sm-12 col-md-8">
                                              <div class="card">
                                                <div class="card-body" style="width:300px; height:145px; padding:30px 20px 30px 20px;">
                                                  <div id="uploaded_image" align="center">
                                                      <img src="{{ isset($data->image) ? asset('/'.$data->image) : ''}}">
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                  <!-- Image Section -->
                                  <!-- Event Data -->  
                                    <form method="POST" action="{{route('event.eventupdate',$data->id)}}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12">
                                                  <div class="form-group">
                                                      <label style="font-weight: bold;">Titel <span style="color:red">*</span></label>
                                                      <input type="text" class="form-control" name="title" value="{{ $data->title }}" required> 
                                                  </div>
                                                </div>
                                                {{-- <div class="col-sm-12 col-md-6">
                                                  <div class="form-group">
                                                      <label style="font-weight: bold;">Lokation <span style="color:red">*</span></label>
                                                      <input type="text" class="form-control" name="location" value="{{ $data->location }}" required> 
                                                  </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                  <div class="form-group">
                                                      <label style="font-weight: bold;">Type <span style="color:red">*</span></label>
                                                      <select style="width: 100%" name="event_type" class="form-control select2" required>
                                                            <option value="0" {{ $data->event_type == "0" ? 'selected' : ''}}>Gratis</option>
                                                            <option value="1" {{ $data->event_type == "1" ? 'selected' : ''}}>Betalt</option>
                                                      </select>
                                                  </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-weight: bold;">Beløb <span style="color:red">*</span></label>
                                                        <input type="number" class="form-control" name="amount" value="{{ $data->amount }}" required> 
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-weight: bold;">Dato <span style="color:red">*</span></label>
                                                        <input type="date" class="form-control" name="event_date"value="{{ $data->event_date }}" required> 
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-weight: bold;">Tidspunkt <span style="color:red">*</span></label>
                                                        <input type="time" class="form-control" name="event_time" value="{{ $data->event_time }}" required> 
                                                    </div>
                                                </div> --}}
                                                <!-- Text Editor -->
                                                  @if( (env('TEXT_EDITOR') == true) && (env('TEXT_EDITOR_EXPIRE') >= date('Y-m-d')) )
                                                  <div class="col-sm-12 col-md-12">
                                                      <div class="form-group">
                                                          <label style="font-weight: bold;">Detaljer <span style="color:red">*</span></label>
                                                          <div class="ql-wrapper">
                                                              <div id="createdata" style="height:200px;">{!! $data->details !!}</div>
                                                          </div>
                                                          <textarea type="textarea" style="display:none;"  id="details" name="details" required>{{ isset($data->details) ? $data->details : ''}}</textarea>
                                                      </div>
                                                  </div>
                                                <!-- Text Editor -->

                                                <!-- Text Area -->
                                                  @else
                                                    <div class="col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <label style="font-weight: bold;">Detaljer <span style="color:red">*</span></label>
                                                            <textarea type="textarea" rows="12" class="form-control" name="details" required>{{ isset($data->details) ? $data->details : ''}}</textarea>
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
                                            <button class="btn ripple btn-success" type="submit" id="form_submit" style="font-weight: bold;text-transform: uppercase;">Opdatering</button>
                                        </div>
                                    </form>
                                  <!-- Event Data -->
                                </div>
                              </div>

                </div>
              <!-- Main Section   -->

              <!-- Promotion Section -->  
                <div class="col-md-3 col-lg-3">
                  @include('dashlead.layouts.promotationsection')
                </div>
              <!-- Promotion Section -->

              </div>
            <!-- End Row -->

            <!-- Image Crop Modal -->
              <div class="modal" id="image_crop_model">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Billedbeskæring</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                      <div class="modal-body">
                                          @csrf
                                          <div class="row">
                                              <div class="col-sm-12 col-md-12">
                                                <div id="image-preview"></div>
                                              </div><br>

                                              <div class="col-sm-12 col-md-12" style="text-align: center;">
                                                <button class="btn btn-primary crop_image" style="padding:10px; font-weight: bold;text-transform: uppercase;">Beskær Billede</button>
                                              </div>
                                          </div>
                                      </div>
                                </div>
                            </div>
                        </div>
            <!-- Image Crop Modal -->
          


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
              
              var quill = new Quill('#createdata', {
                  modules: {
                      toolbar: toolbarOptions
                  },
                  theme: 'snow'
              });

              // Send Data Quill to Text Area
              quill.on('text-change', function(delta, oldDelta, source) {
                  $('#details').text($(".ql-editor").html());
              });

          });
      </script>
      @endif
    <!-- Text  Editor -->

    <!-- Croppie JS For Image Crop -->
    <script src="{{ asset('dashlead/js/croppie.js') }}"></script>

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
              $('#image_crop_model').modal('show');
            });
          // Image Upload

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

                    $('#image_crop_model').modal('hide');
                  }
                });
              });
            });
          // Image Crop , Data Send & Received
          
        });  
      </script>
    <!-- Image Process -->
  @endpush
<!-- Developed By CBS -->