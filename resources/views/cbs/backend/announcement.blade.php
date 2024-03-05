<!-- Developed By CBS -->
    @extends('cbs.backend.layouts.layout')
    @section('pageTitle', 'Announcements')
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
							<h2 class="main-content-title tx-24 mg-b-5">Announcements</h2>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Announcements</li>
							</ol>
						</div>
						<div class="btn btn-list">
                            <a class="btn ripple btn-primary" data-toggle="modal" data-target="#createDataModal" href="#"><i class="fe fe-plus"></i> Make Announcements</a>
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
                                                        <th class="wd-25p" style="text-align:center; font-weight: bold;">Title</th>
                                                        <th class="wd-10p" style="text-align:center; font-weight: bold;">Portal</th>
                                                        <th class="wd-20p" style="text-align:center; font-weight: bold;">Created At</th>
                                                        <th class="wd-20p" style="text-align:center; font-weight: bold;">Updated At</th>
                                                        <th class="wd-20p" style="text-align:center; font-weight: bold;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($announcements as $key => $data)
                                                        <tr>
                                                            <td style="text-align:center; font-weight: bold;">{{ $key+1 }}</td>
                                                            <td style="text-align:center">{{ $data->title }}</td>
                                                            <td style="text-align:center"><span class="badge badge-primary">{{ App\Models\Portal::find($data->portal_id)->portalType }}</span></td>
                                                            <td style="text-align:center;">{{date('d-m-Y, h:i A', strtotime($data->created_at))}}</td>
                                                            <td style="text-align:center;">{{date('d-m-Y, h:i A', strtotime($data->updated_at))}}</td>
                                                            <td style="text-align:center;">
                                                                <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#viewDataModal-{{$data->id}}" href="#"><i class="fe fe-eye"></i></a>
                                                                <!-- View Data Model -->
                                                                    <div class="modal" id="viewDataModal-{{$data->id}}">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content modal-content-demo shadow">
                                                                                <div class="modal-header">
                                                                                    <h6 class="modal-title" style="text-transform: uppercase;">Announcement  Details</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                                                </div>
                                
                                                                                <div class="modal-body text-left">
                                                                                    <h6><strong>Title :</strong> {{ $data->title }}</h6>
                                                                                    <h6><strong>Portal :</strong> <span class="badge badge-primary">{{ App\Models\Portal::find($data->portal_id)->portalType }}</span></h6>
                                                                                    <h6><strong>Created At :</strong> {{date('d-m-Y, h:i A', strtotime($data->created_at))}}</h6>
                                                                                    <h6><strong>Updated At :</strong> {{date('d-m-Y, h:i A', strtotime($data->updated_at))}}</h6>
                                                                                    <div>{!! $data->detail !!}</div>
                                                                                </div>
                                                                                
                                                                                

                                                                                <div class="modal-footer">
                                                                                    <button class="btn ripple btn-danger" data-dismiss="modal" type="button" style="font-weight: bold;text-transform: uppercase;">Close</button>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <!-- View Data Model -->
                                                                <a class="btn btn-sm btn-warning" href="{{ route('announcement.edit',$data->id) }}"><i class="fa fa-edit"></i></a>
                                                                <button class="btn btn-sm btn-danger" type="button" onclick="deactive({{ $data->id }})"><i class="fe fe-trash"></i></button>
                                                                <form id="delete-form-{{$data->id}}" action="{{ route('announcement.destroy',$data->id) }}" method="POST" style="display: none;">@csrf</form>
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
									<h6 class="modal-title" style="text-transform: uppercase;">Make Announcements</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
                            <form method="POST" action="{{ route('announcement.store') }}">
                                @csrf
								<div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Title  <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="title" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Details <span style="color:red">*</span></label>
                                                <textarea type="textarea" rows="10" placeholder="Write Something..." class="form-control" name="detail" required></textarea>
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

                                    </div>
                                </div>

								<div class="modal-footer">
                                <button class="btn ripple btn-success" type="submit" style="font-weight: bold;text-transform: uppercase;">{{ __('Create') }}</button>
                                    <button class="btn ripple btn-danger" data-dismiss="modal" type="button" style="font-weight: bold; text-transform: uppercase;">Close</button>
								</div>
                            </form>

							</div>
						</div>
					</div>
				<!-- Create Data Model -->


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