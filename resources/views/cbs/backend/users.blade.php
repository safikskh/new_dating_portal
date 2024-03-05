<!-- Developed By CBS -->
    @extends('cbs.backend.layouts.layout')
    @section('pageTitle', 'Users')
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
							<h2 class="main-content-title tx-24 mg-b-5">Users</h2>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Users</li>
							</ol>
						</div>
						<!-- <div class="btn btn-list">
							<a class="btn ripple btn-primary" href="#"><i class="fe fe-plus"></i> Add User</a>
						</div> -->
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
                                                        <th class="wd-20p" style="text-align:left; font-weight: bold;">Name</th>
                                                        <th class="wd-20p" style="text-align:left; font-weight: bold;">Email</th>
                                                        <th class="wd-15p" style="text-align:center; font-weight: bold;">Type</th>
                                                        <th class="wd-20p" style="text-align:center; font-weight: bold;">Status</th>
                                                        <th class="wd-20p" style="text-align:center; font-weight: bold;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $key => $user)
                                                        <tr>
                                                            <td  style="text-align:center; font-weight: bold;">{{ $key+1 }}</td>
                                                            <td style="text-align:left">{{ $user->name }}</td>
                                                            <td style="text-align:left;">{{ $user->email }}</td>
                                                            <td style="text-align:center;"><span class="badge badge-danger">Not Found<span></td>
                                                            <td style="text-align:center;"><span class="badge badge-success">Active<span></td>
                                                            <td style="text-align:center;">
                                                                <button type="button" id="{{ $user->id }}" class="showdata btn btn-sm btn-success"><i class="fa fa-eye"></i></button>
                                                                <button type="button" id="{{ $user->id }}" class="editdata btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                                                                <button class="btn btn-sm btn-danger" type="button" onclick="deactive({{ $user->id }})"><i class="fe fe-trash"></i></button>
                                                                <form id="delete-form-{{$user->id}}" action="{{ route('admin.user.deactive',$user->id) }}" method="POST" style="display: none;">@csrf</form>
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

                <!-- User Show Model -->
					<div class="modal" id="userShowModal">
						<div class="modal-dialog" role="document">
							<div class="modal-content modal-content-demo shadow">
								<div class="modal-header">
									<h6 class="modal-title" style="text-transform: uppercase;">User Information</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>

								<div class="modal-body">
                                    <div id="data"></div>
                                </div>

								<div class="modal-footer">
                                    <button class="btn ripple btn-danger" data-dismiss="modal" type="button" style="font-weight: bold;text-transform: uppercase;">Close</button>
								</div>
							</div>
						</div>
					</div>
				<!-- User Show Model -->

                <!-- User Edit Model -->
					<div class="modal" id="userEditModal">
						<div class="modal-dialog" role="document">
							<div class="modal-content modal-content-demo shadow">
								<div class="modal-header">
									<h6 class="modal-title" style="text-transform: uppercase;">User Edit</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
                            <form method="POST" action="{{ route('admin.user.update') }}">
                                @csrf
								<div class="modal-body">
                                    <div class="row">
                                    <div id="editid"></div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="name">Name  <span style="color:red">*</span></label>
                                                <div id="editname"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="name">Email  <span style="color:red">*</span></label>
                                                <div id="editemail"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="name">Password  <span style="color:green">(if any)</span></label>
                                                <input type="password" class="form-control" name="password"> 
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="name">Confirm Password  <span style="color:green">(if any)</span></label>
                                                <input type="password" class="form-control" name="confirm-password"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

								<div class="modal-footer">
                                <button class="btn ripple btn-success" type="submit" style="font-weight: bold;text-transform: uppercase;">{{ __('Update') }}</button>
                                    <button class="btn ripple btn-danger" data-dismiss="modal" type="button" style="font-weight: bold;text-transform: uppercase;">Close</button>
								</div>
                            </form>

							</div>
						</div>
					</div>
				<!-- User Edit Model -->


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

        <!-- Model JS -->
            <script>
                $(document).ready(function(){

                    // User Data Model
                        $(document).on('click', '.showdata', function(){
                            var id = $(this).attr('id');
                            // $('#form_result').html('');
                            $.ajax({
                            url:"userShowModal/"+id+"",
                            dataType:"json",
                            success:function(html){
                                $('#data').html(html.data);
                                $('#userShowModal').modal('show');
                            }
                            })
                        });
                    // User Data Model

                    // User Data Model
                        $(document).on('click', '.editdata', function(){
                            var id = $(this).attr('id');
                            // $('#form_result').html('');
                            $.ajax({
                            url:"userEditModal/"+id+"",
                            dataType:"json",
                            success:function(html){
                                $('#editname').html(html.name);
                                $('#editemail').html(html.email);
                                $('#editid').html(html.id);
                                $('#userEditModal').modal('show');
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