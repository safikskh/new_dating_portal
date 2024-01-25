<!-- Developed By CBS -->
    @extends('cbs.backend.layouts.layout')
    @section('pageTitle', 'Chatroom')
    @push('style')
    	<!---DataTables css-->
        <link href="{{ asset('cbs/backend/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('cbs/backend/plugins/datatable/responsivebootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('cbs/backend/plugins/datatable/fileexport/buttons.bootstrap4.min.css') }}" rel="stylesheet">
        <!---Select2 css-->
        <link href="{{ asset('cbs/backend/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    @endpush
    @section('content')

        <!-- Page Content-->
            <div class="container-fluid">

                <!-- Page Header -->
					<div class="page-header">
						<div>
							<h2 class="main-content-title tx-24 mg-b-5">Chatroom</h2>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Chatroom</li>
							</ol>
						</div>
						<div class="btn btn-list">
                            <a class="btn ripple btn-primary" data-toggle="modal" data-target="#createDataModal" href="#"><i class="fe fe-plus"></i> Create Chatroom</a>
						</div>
					</div>
				<!-- End Page Header -->

                <!-- Row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card custom-card overflow-hidden">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table" id="example1">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-5p" style="text-align:center; font-weight: bold;">#</th>
                                                        <th class="wd-25p" style="text-align:center; font-weight: bold;">Name</th>
                                                        <th class="wd-20p" style="text-align:center; font-weight: bold;">Portal</th>
                                                        <th class="wd-25p" style="text-align:center; font-weight: bold;">Image</th>
                                                        <th class="wd-25p" style="text-align:center; font-weight: bold;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($chatrooms as $key => $data)
                                                        <tr>
                                                            <td style="text-align:center; font-weight: bold;">{{ $key+1 }}</td>
                                                            <td style="text-align:center">{{ $data->chatroom_name }}</td>
                                                            <td style="text-align:center"><span class="badge badge-primary">{{ App\Models\Portal::find($data->portal_id)->portalType }}</span></td>
                                                            <td style="text-align:center"><img src="{{ asset('/'. $data->chatroom_image) }}" width="35" height="35" class="rounded-circle"></td>
                                                            <td style="text-align:center;">
                                                                <button type="button" id="{{ $data->id }}" class="editdata btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                                                                <button class="btn btn-sm btn-danger" type="button" onclick="deactive({{ $data->id }})"><i class="fe fe-trash"></i></button>
                                                                <form id="delete-form-{{$data->id}}" action="{{ route('chatroom.destroy',$data->id) }}" method="POST" style="display: none;">@csrf</form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
				<!-- End Row -->

                <!-- Create Data Model -->
					<div class="modal" id="createDataModal">
						<div class="modal-dialog" role="document">
							<div class="modal-content modal-content-demo shadow">
								<div class="modal-header">
									<h6 class="modal-title" style="text-transform: uppercase;">Create Chatroom</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>

                                <!-- Image Section -->
                                    <div class="modal-body">
                                        @csrf
                                        <div class="row">

                                            <div class="col-sm-12 col-md-12">
                                              <div id="image-preview"></div>
                                            </div><br>

                                            <div class="col-sm-8 col-md-4">
                                                <input title="Upload Your Image" type="file" class="dropify" id="upload_image" accept=".png, .jpg, .jpeg" data-max-file-size="2M"  data-height="100" data-width="100" required>
                                            </div>

                                            <div class="col-sm-4 col-md-4">
                                              <button class="btn btn-primary crop_image" style="padding:35px; font-weight: bold;text-transform: uppercase;">CROP IMAGE</button>
                                            </div>
                                            

                                            <div class="col-sm-12 col-md-4">
                                              <div id="uploaded_image" align="center" style="background:#e1e1e1;padding:25px;">
                                                      <div style="text-align: center; margin-top: 10px; margin-bottom: 10px;">
                                                          <h6 style="color:#737373;">SIZE 100x100</h6>
                                                      </div>
                                              </div>
                                            </div>

                                        </div>
                                    </div>
                                <!-- Image Section -->

                            <form method="POST" action="{{ route('chatroom.store') }}">
                                @csrf
								<div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Name  <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="chatroom_name" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Portal <span style="color:red">*</span></label>
                                                <select style="width: 100%" name="portal_id" class="form-control select2">
                                                    <option value="" selected disabled>---Please Select---</option>
                                                    @foreach ($portals as $portal)
                                                        <option value="{{ $portal->id }}">{{ $portal->portalType }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Image -->
                                            <div id="img_data"></div>
                                        <!-- Image -->

                                    </div>
                                </div>

								<div class="modal-footer">
                                <button class="btn ripple btn-success" id="form_submit" type="submit" style="font-weight: bold;text-transform: uppercase;">{{ __('Create') }}</button>
                                    <button class="btn ripple btn-danger" data-dismiss="modal" type="button" style="font-weight: bold; text-transform: uppercase;">Close</button>
								</div>
                            </form>

							</div>
						</div>
					</div>
				<!-- Create Data Model -->

                <!-- Edit Data Model -->
					<div class="modal" id="editDataModal">
						<div class="modal-dialog" role="document">
							<div class="modal-content modal-content-demo shadow">
								<div class="modal-header">
									<h6 class="modal-title" style="text-transform: uppercase;">Create Chatroom</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>

                                <!-- Image Section -->
                                    <div class="modal-body">
                                        @csrf
                                        <div class="row">

                                            <div class="col-sm-12 col-md-12">
                                              <div id="edit_image-preview"></div>
                                            </div><br>

                                            <div class="col-sm-8 col-md-4">
                                                <input title="Upload Your Image" type="file" class="dropify" id="upload_edit_image" accept=".png, .jpg, .jpeg" data-max-file-size="2M"  data-height="100" data-width="100" required>
                                            </div>

                                            <div class="col-sm-4 col-md-4">
                                              <button class="btn btn-primary crop_edit_image" style="padding:35px; font-weight: bold;text-transform: uppercase;">CROP IMAGE</button>
                                            </div>
                                            

                                            <div class="col-sm-12 col-md-4">
                                              <div id="uploaded_edit_image" align="center" style="background:#e1e1e1;padding:20px;">
                                                      <div style="text-align: center; margin-top: 10px; margin-bottom: 10px;">
                                                          <!-- <h6 style="color:#737373;">SIZE 100x100</h6> -->
                                                          <div id="editimage"></div>
                                                      </div>
                                              </div>
                                            </div>

                                        </div>
                                    </div>
                                <!-- Image Section -->

                            <form method="POST" action="{{ route('chatroom.update') }}">
                                @csrf
								<div class="modal-body">
                                    <div class="row">

                                        <div id="editid"></div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Name  <span style="color:red">*</span></label>
                                                <div id="editname"></div>
                                            </div>
                                        </div>

                                        <!-- Image -->
                                            <div id="edit_image_data"></div>
                                        <!-- Image -->

                                    </div>
                                </div>

								<div class="modal-footer">
                                <button class="btn ripple btn-success" id="edit_form_submit" type="submit" style="font-weight: bold;text-transform: uppercase;">{{ __('Create') }}</button>
                                    <button class="btn ripple btn-danger" data-dismiss="modal" type="button" style="font-weight: bold; text-transform: uppercase;">Close</button>
								</div>
                            </form>

							</div>
						</div>
					</div>
				<!-- Edit Data Model -->


            </div>
        <!-- Page Content-->

    @endsection
    @push('script')
    	<!-- Data Table js -->
        <script src="{{ asset('cbs/backend/plugins/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('cbs/backend/js/table-data.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/fileexport/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/fileexport/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/fileexport/jszip.min.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/fileexport/pdfmake.min.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/fileexport/vfs_fonts.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/fileexport/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/fileexport/buttons.print.min.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/fileexport/buttons.colVis.min.js') }}"></script>

        <!-- Create Image Process -->
            <script>  
                $(document).ready(function(){
                
                // Image Preview  
                    $image_crop = $('#image-preview').croppie({
                        enableExif:true,
                        viewport:{
                        width:100,
                        height:100,
                        type:'square'
                        },
                        boundary:{
                        width:250,
                        height:125
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
                        size: { width: 100, height: 100 }
                    }).then(function(response){
                        var _token = $('input[name=_token]').val();
                        $.ajax({
                        url:'{{ route("image.process") }}',
                        type:'post',
                        data:{"image":response, _token:_token},
                        dataType:"json",
                        success:function(data)
                        {
                            var crop_image = '<img src="/'+data.temp_image+'" width="60" height="60" />';
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
        <!-- Create Image Process -->

        <!-- Edit Image Process -->
            <script>  
                $(document).ready(function(){
                
                // Image Preview  
                    $edit_image_crop = $('#edit_image-preview').croppie({
                        enableExif:true,
                        viewport:{
                        width:100,
                        height:100,
                        type:'square'
                        },
                        boundary:{
                        width:250,
                        height:125
                        },
                        showZoomer: true,
                    });

                // Image Preview

                // Image Upload
                    $('#upload_edit_image').change(function(){
                    var reader = new FileReader();

                    reader.onload = function(event){
                        $edit_image_crop.croppie('bind', {
                        url:event.target.result
                        }).then(function(){
                        console.log('jQuery bind complete');
                        });
                    }
                    reader.readAsDataURL(this.files[0]);
                    });
                // Image Upload

                // Crop & Form Button Hide
                    $('#upload_edit_image').change(function(){
                    // $('.crop_image').show();
                    $('#edit_image-preview').show();
                    $('.crop_edit_image').removeAttr('disabled', '');
                    });
                    
                    // $('.crop_image').hide();
                    $('.crop_edit_image').attr('disabled', '');
                    // $('#edit_form_submit').attr('disabled', '');
                    $('#edit_image-preview').hide();
                    // $('#form_submit').hide();
                // Crop & Form Button Hide

                // Image Crop , Data Send & Received
                    $('.crop_edit_image').click(function(event){
                    $edit_image_crop.croppie('result', {
                        type:'canvas',
                        size: { width: 100, height: 100 }
                    }).then(function(response){
                        var _token = $('input[name=_token]').val();
                        $.ajax({
                        url:'{{ route("image.process") }}',
                        type:'post',
                        data:{"image":response, _token:_token},
                        dataType:"json",
                        success:function(data)
                        {
                            var crop_edit_image = '<img src="/'+data.temp_image+'" width="60" height="60" />';
                            var edit_image_data = '<input value="'+data.temp_image+'" type="hidden" name="temp_image"> <input value="'+data.temp_image_name+'" type="hidden" name="temp_image_name"> <input value="'+data.temp_image_path+'" type="hidden" name="temp_image_path">';
                            $('#uploaded_edit_image').html(crop_edit_image);
                            $('#edit_image_data').html(edit_image_data);

                            // Form Button show If Image Croped
                            if(crop_edit_image != "") { $('#edit_form_submit').removeAttr('disabled', ''); }
                        }
                        });
                    });
                    });
                // Image Crop , Data Send & Received
                
                });  
            </script>
        <!-- Edit Image Process -->

        <!-- Model JS -->
            <script>
                $(document).ready(function(){


                    // User Data Model
                        $(document).on('click', '.editdata', function(){
                            var id = $(this).attr('id');
                            $.ajax({
                            url:"chatroom/edit/"+id+"",
                            dataType:"json",
                            success:function(html){
                                $('#editname').html(html.name);
                                $('#editid').html(html.id);
                                $('#editimage').html(html.image);
                                $('#editDataModal').modal('show');
                            }
                            })
                        });
                    // User Data Model
                });
            </script>
        <!-- Model JS -->

        <!-- Delete Sweet Alert -->
            <script type="text/javascript">
                function deactive(id) {

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
        <!-- Delete Sweet Alert -->

    @endpush
<!-- Developed By CBS -->