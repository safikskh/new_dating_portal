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
							<h2 class="main-content-title tx-24 mg-b-5">Announcement Edit</h2>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('announcement.index') }}">Announcements</a></li>
								<li class="breadcrumb-item active" aria-current="page">Announcement Edit</li>
							</ol>
						</div>
						<div class="btn btn-list">
                            <a class="btn ripple btn-primary" href="{{ route('announcement.index') }}"><i class="fa fa-undo"></i> Return</a>
						</div>
					</div>
				<!-- End Page Header -->

                <!-- Row -->
                        <div class="row justify-content-md-center">
                            <div class="col-lg-6">
                                <div class="card custom-card overflow-hidden">
                                    <div class="card-body">

                                        <form method="POST" action="{{ route('announcement.update',$announcement->id) }}">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                <div id="pp"></div>
                                                <div id="editid"></div>
                                                    <div class="col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Title  <span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" name="title" value="{{$announcement->title}}" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Details <span style="color:red">*</span></label>
                                                            <textarea type="textarea" rows="10" placeholder="Write Something..." class="form-control" name="detail" required>{{ isset($announcement->detail) ? $announcement->detail : ''}}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Portal <span style="color:red">*</span></label>
                                                            <select style="width: 100%" name="portal_id" class="form-control select2">
                                                                <option value="" selected disabled>---Please Select---</option>
                                                                @foreach ($portals as $portal)
                                                                    <option value="{{ $portal->id }}" {{ $portal->id == $announcement->portal_id ? 'selected' : ''}}>{{ $portal->portalType }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn ripple btn-success" type="submit" style="font-weight: bold;text-transform: uppercase;">{{ __('Update') }}</button>
                                            </div>
                                        </form>

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