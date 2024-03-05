<!-- Developed By CBS -->
    @extends('cbs.backend.layouts.layout')
    @section('pageTitle', 'Reported Statuses')
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
							<h2 class="main-content-title tx-24 mg-b-5">Reported Statuses</h2>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Reported Statuses</li>
							</ol>
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
                                                        <th class="wd-15p" style="text-align:center; font-weight: bold;">User Name</th>
                                                        <th class="wd-30p" style="text-align:center; font-weight: bold;">Status</th>
                                                        <th class="wd-25p" style="text-align:center; font-weight: bold;">Report</th>
                                                        <th class="wd-15p" style="text-align:center; font-weight: bold;">Reported At</th>
                                                        <th class="wd-10p" style="text-align:center; font-weight: bold;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($all_statuses as $key => $status)
                                                        <tr>
                                                            <td style="text-align:center; font-weight: bold;">{{ $key+1 }}</td>
                                                            <td style="text-align:center">{{ $status->user->portalInfo->firstName }} {{ $status->user->portalInfo->lastName }}</td>
                                                            <td style="text-align:center;">{{ str_limit($status->status->title, $limit = 60, $end = ' . . .') }}</td>
                                                            <td style="text-align:center;">{{ str_limit($status->description, $limit = 50, $end = ' . . .') }}</td>
                                                            <td style="text-align:center;">{{date('d-m-Y, h:i A', strtotime($status->created_at))}}</td>
                                                            <td style="text-align:center;">
                                                                <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#viewDataModal-{{$status->id}}" href="#"><i class="fe fe-eye"></i></a>
                                                                <!-- View Data Model -->
                                                                    <div class="modal" id="viewDataModal-{{$status->id}}">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content modal-content-demo shadow">
                                                                                <div class="modal-header">
                                                                                    <h6 class="modal-title" style="text-transform: uppercase;">Report Details</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                                                </div>
                                
                                                                                <div class="modal-body text-left">
                                                                              
                                                                                    <h6><strong>Status :</strong> {{ $status->status->title }}</h6>
                                                                                    <h6><strong>Status Details :</strong> {{ $status->status->details }}</h6>
                                                                                    <h6><strong>Report By :</strong> {{ $status->user->portalInfo->firstName }} {{ $status->user->portalInfo->lastName }}</h6>
                                                                                    <h6><strong>Report :</strong> {{ $status->description }}</h6>
                                                                                    <h6><strong>Reported At :</strong> {{date('d-m-Y, h:i A', strtotime($status->created_at))}}</h6>
                            
                                                                          
                                                                                </div>

                                                                                <div class="modal-footer">
                                                                                    <button class="btn ripple btn-danger" data-dismiss="modal" type="button" style="font-weight: bold;text-transform: uppercase;">Close</button>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <!-- View Data Model -->
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

    @endpush
<!-- Developed By CBS -->