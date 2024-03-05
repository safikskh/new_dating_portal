<!-- Developed By CBS -->
  @extends('dashlead.layouts.layout')
  @section('pageTitle', 'Blogs')
  @push('style')
    <!---Text Editor-->
      @if( (env('TEXT_EDITOR') == true) && (env('TEXT_EDITOR_EXPIRE') >= date('Y-m-d')) )
        <link href="{{ asset('dashlead/plugins/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('dashlead/plugins/quill/quill.bubble.css') }}" rel="stylesheet">
      @endif
    <!---Text Editor-->
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

                  <!-- Create Blog -->
                      <div class="card custom-card">
                          <div class="card-body h-100">
                              <div class="text-center">
                                @if(auth()->user()->isPaid())
                                  <button data-toggle="modal" class="btn ripple btn-primary" href="#create_blog_model" style="margin-top: 5px; margin-bottom: 5px; font-weight: bold;text-transform: uppercase;">Opret Blog</button>
                                @else
                                  <button data-toggle="modal" class="btn ripple btn-primary" href="#create_blog_model" style="margin-top: 5px; margin-bottom: 5px; font-weight: bold;text-transform: uppercase;" disabled>Opret Blog</button>
                                @endif
                              </div>
                          </div>
                      </div>
                  <!-- Create Blog --> 
                
                  <!-- Latest Blog -->    
                    <div class="card custom-card">
                      <div class="card-header custom-card-header">
                        <h6 class="card-title mb-0" style="font-weight: bold; text-transform:uppercase;">Nyeste Blog</h6>
                      </div>
                        @if(sizeof($latestBlogs)>0)  
                          @foreach($latestBlogs as $key => $le)
                              <div class="list d-flex align-items-center p-3 border-top">
                                <span style="font-weight: bold; border:2px solid #1b4da6; border-radius:0%; padding: 5px; text-align: center; color:white; background:#1b4da6;">{{ $key+1 }}</span>
                                <div class="wrappe ml-3">
                                  <a href="{{route('blogDetails',$le->id)}}" style="color:black;">
                                    <h6 class="mb-1">{{ str_limit($le->title, $limit = 40, $end = ' . . .') }}</h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                        <span class="mb-0 text-muted"><i class="fas fa-clock mr-2"></i>{{date('d m Y', strtotime($le->updated_at))}} , {{date('H:i', strtotime($le->updated_at))}}</span>
                                      </div>
                                    </div>
                                  </a>
                                </div>
                              </div>
                            @endforeach
                        @else
                          <div style="text-align: center; margin-top: 150px; margin-bottom: 150px;">
                                <h5 style="color:red;">Ingen Tilgængelig Data</h5>
                            </div>
                        @endif
                    </div>
                  <!-- Latest Blog -->

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
                                  <form method="POST" action="{{route('blogsearch')}}">
                                      @csrf
                                      <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Søg her ..." required>
                                        <span class="input-group-append">
                                          <button type="submit" class="btn ripple btn-primary" style="font-weight: bold;text-transform: uppercase;">Søg</button>
                                        </span>
                                      </div>
                                  </form>
                                </div>
                                <div class="col-sm-3 col-lg-3">
                                  <form method="POST" action="{{route('blogsearch')}}">
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
                      @if(sizeof($blogs)>0)
                          @foreach($blogs as $key=>$d)
                              <div class="col-sm-6 col-lg-6">
                                <div class="card item-card custom-card">
                                  <div class="card-body h-100">
                                    <div class="product h-100">
                                      <!-- Item Body -->
                                        <div class="text-center product-img mb-0">
                                          <a href="{{route('blogDetails',$d->id)}}" >
                                            @if(File::exists($d->image)) 
                                              <img src="{{asset('/'.$d->image)}}" class="img-fluid" width="210" height="70">
                                            @else
                                                <img src="{{ asset('dashlead/img/default/404-image.png') }}" class="img-fluid" width="210" height="70">
                                            @endif
                                          </a>
                                        </div>
                                        <div class="text-center mt-0">
                                        <a href="{{route('blogDetails',$d->id)}}">
                                          <h6 class="mb-0 mt-2" style="font-weight: bold; color:black;">{{ str_limit($d->title, $limit = 60, $end = ' . . .') }}</h6>
                                        </a>
                                          <div class="price mt-2 h5 mb-0">

                                          <h5>
                                            <span class="badge badge-light" style="margin-bottom: 0px; font-weight: bold; float: center;">
                                              {{date('d F Y', strtotime($d->updated_at))}} , {{date('H:i', strtotime($d->updated_at))}}
                                            </span>
                                          </h5>
                                          <h6>{{ str_limit($d->sub_title, $limit = 60, $end = ' . . .') }}</h6>

                                          </div>
                                        </div>
                                      <!-- Item Body -->
                                      <!-- Action Link -->
                                        <div class="product-info">
                                          <a href="{{route('blogDetails',$d->id)}}" class="btn ripple  btn-primary btn-sm mt-1 mb-1 text-sm text-white"  data-toggle="tooltip" data-placement="bottom" title="Udsigt">
                                            <i class="fe fe-eye"></i>
                                          </a>
                                          @if( (auth()->user()->isPaid()) && (Auth::user()->id == $d->user_id) )
                                          <a href="{{route('blog.blogedit',$d->id)}}" class="btn ripple  btn-info btn-sm mt-1 mb-1 text-sm  text-white"  data-toggle="tooltip" data-placement="bottom" title="Redigere">
                                            <i class="fe fe-edit"></i>
                                          </a>
                                          @endif
                                          @if( (auth()->user()->isPaid()) && (Auth::user()->id == $d->user_id) )
                                                <button class="btn ripple  btn-sm btn-danger mt-1 text-sm  mb-1 text-white" type="button" onclick="deactiveblog({{ $d->id }})">
                                                    <i class="fe fe-trash"></i>
                                                </button>
                                                <form id="delete-form-{{$d->id}}" action="{{ route('blog.blogdeactive',$d->id) }}" method="POST" style="display: none;">
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
                          {{ $blogs->links() }}
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

            <!-- Create Blog Modal -->
                      <div class="modal" id="create_blog_model">
                          <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content modal-content-demo">
                                  <div class="modal-header">
                                      <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Opret Blog</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
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

                                  <!-- Blog Data -->  
                                    <form id="form_blog_create" method="POST" action="{{ route('blog.blogstore') }}">
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
                                                      <label style="font-weight: bold;">Kategori <span style="color:red">*</span></label>
                                                      <select style="width: 100%" name="category_id" class="form-control select2" required>
                                                            @foreach($categories as $key => $category)
                                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                      </select>
                                                  </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12">
                                                  <div class="form-group">
                                                      <label style="font-weight: bold;">Undertitel <span style="color:red">*</span></label>
                                                      <input type="text" class="form-control" name="sub_title" required> 
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
                                  <!-- Blog Data -->

                              </div>
                          </div>
                      </div>
            <!-- ./Create Blog Modal -->
          
          </div>
        </div>
      <!-- End Main Content-->
  @endsection

  @push('script')

    <!-- Text Editor -->
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
    <!-- Text Editor -->

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

    <!-- blog Delete Sweet Alert -->
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
    <!-- blog Delete Sweet Alert -->

  @endpush
<!-- Developed By CBS -->