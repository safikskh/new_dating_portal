<!-- Developed By CBS -->
    @extends('cbs.backend.layouts.layout')
    @section('pageTitle', 'Promo Code')
    @push('style')
    	<!---DataTables css-->
        <link href="{{ asset('cbs/backend/plugins/datatable/dataTables.bootstrap4.css') }}" rel="stylesheet">
        <link href="{{ asset('cbs/backend/plugins/datatable/responsivebootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('cbs/backend/plugins/datatable/fileexport/buttons.bootstrap4.min.css') }}" rel="stylesheet">

        <!-- Datatables Export -->
		<!-- <link rel="stylesheet" type="text/css" href="{{ asset('cbs/backend/plugins/datatable/jquery.dataTables.css') }}"/> -->
		<!-- <link rel="stylesheet" type="text/css" href="{{ asset('cbs/backend/plugins/datatable/buttons.dataTables.css') }}"/> -->

        <!---Select2 css-->
        <link href="{{ asset('cbs/backend/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    @endpush
    @section('content')

        <!-- Page Content-->
            <div class="container-fluid">

                <!-- Page Header -->
					<div class="page-header">
						<div>
							<h2 class="main-content-title tx-24 mg-b-5">Promo Code</h2>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Promo Code</li>
							</ol>
						</div>
						<div class="btn btn-list">
                            <a class="btn ripple btn-primary" data-toggle="modal" data-target="#createcustompc" href="#"><i class="fe fe-plus"></i> Custom</a>
                            <a class="btn ripple btn-primary" data-toggle="modal" data-target="#createrandompc" href="#"><i class="fe fe-plus"></i> Random</a>
                            <a class="btn ripple btn-primary" data-toggle="modal" data-target="#createcsvpc" href="#"><i class="fe fe-upload"></i> CSV</a>
						</div>
					</div>
				<!-- End Page Header -->

                <!-- Row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card custom-card overflow-hidden">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="data_table" class="table" id="example1">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-5p" style="text-align:center; font-weight: bold;">#</th>
                                                        <th class="wd-15p" style="text-align:center; font-weight: bold;">Promo Code</th>
                                                        <th class="wd-20p" style="text-align:center; font-weight: bold;">Type</th>
                                                        <th class="wd-20p" style="text-align:center; font-weight: bold;">Discount</th>
                                                        <th class="wd-20p" style="text-align:center; font-weight: bold;">Duration</th>
                                                        <th class="wd-20p" style="text-align:center; font-weight: bold;">Expire at</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
				<!-- End Row -->


                <!-- Create Random Model -->
					<div class="modal" id="createrandompc">
						<div class="modal-dialog" role="document">
							<div class="modal-content modal-content-demo shadow">
								<div class="modal-header">
									<h6 class="modal-title" style="text-transform: uppercase;">Random Generate Promocode</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
                            <form method="POST" action="{{ route('promocode.store') }}">
                                @csrf
								<div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Quantity  <span style="color:red">*</span></label>
                                                <input type="number" name="quantity" class="form-control" placeholder="Quantity of promocode" required/>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Type  <span style="color:red">*</span></label>
                                                <select name="type" class="form-control select2-no-search" required>
                                                    <option value="" selected disabled>---Please Select---</option>                       
                                                    <option value="0">Percentage</option>
                                                    <option value="1">Fixed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Discount  <span style="color:red">*</span></label>
                                                <input name="discount" placeholder="Discount value" type="number" class="form-control" aria-label="Amount (to the nearest dollar)" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Expaire Date  <span style="color:red">*</span></label>
                                                <input name="edate" placeholder="Discount value" type="date" class="form-control" aria-label="Amount (to the nearest dollar)" required>
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
				<!-- Create Random Model -->

                <!-- Create Custom Model -->
					<div class="modal" id="createcustompc">
						<div class="modal-dialog" role="document">
							<div class="modal-content modal-content-demo shadow">
								<div class="modal-header">
									<h6 class="modal-title" style="text-transform: uppercase;">Custom Generate Promocode</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
                            <form method="POST" action="{{ route('custom') }}">
                                @csrf
								<div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Promo Code  <span style="color:red">*</span></label>
                                                <input type="text" name="pcode" class="form-control" placeholder="Promo Code..." required/>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Type  <span style="color:red">*</span></label>
                                                <select name="type" class="form-control select2-no-search" required>
                                                    <option value="" selected disabled>---Please Select---</option>                       
                                                    <option value="0">Percentage</option>
                                                    <option value="1">Fixed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Discount  <span style="color:red">*</span></label>
                                                <input name="discount" placeholder="Discount value" type="number" class="form-control" aria-label="Amount (to the nearest dollar)" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Expaire Date  <span style="color:red">*</span></label>
                                                <input name="edate" placeholder="Discount value" type="date" class="form-control" aria-label="Amount (to the nearest dollar)" required>
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
				<!-- Create Custom Model -->

                <!-- Create CSV Model -->
					<div class="modal" id="createcsvpc">
						<div class="modal-dialog" role="document">
							<div class="modal-content modal-content-demo shadow">
								<div class="modal-header">
									<h6 class="modal-title" style="text-transform: uppercase;">Upload CSV File</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
                            <form method="POST" action="{{action('Backend\PromoCodeController@uploadFile')}}" enctype="multipart/form-data">
                                @csrf
								<div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <input title="Upload Your File" type="file" class="dropify" name="file" accept=".csv" data-max-file-size="2M"  data-height="100" data-width="100" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

								<div class="modal-footer">
                                <button class="btn ripple btn-success" type="submit" style="font-weight: bold;text-transform: uppercase;">{{ __('Upload') }}</button>
                                    <button class="btn ripple btn-danger" data-dismiss="modal" type="button" style="font-weight: bold; text-transform: uppercase;">Close</button>
								</div>
                            </form>

							</div>
						</div>
					</div>
				<!-- Create CSV Model -->


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

        <!-- Datatables JS -->
            <script>
                $(document).ready(function(){

                    var dataTable = $('#data_table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax:{
                            url: "{{ route('promocode.index') }}",
                        },

                        // dom: 'B<"pull-right" f><t>ip',
                        dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-3'i><'col-sm-12 col-md-4'p>>",

                        lengthMenu: [10, 50, 100, 200],
                        language: {
                                search: "_INPUT_",
                                searchPlaceholder: "Search..."
                            },
                        buttons: [
                            {
                                extend: 'copyHtml5',
                                text:      '<i class="fas fa-copy"></i>',
                                titleAttr: 'Copy',
                                exportOptions: {
                                    columns: '0,1,2,3,4,5'
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                text:      '<i class="far fa-file-excel"></i>',
                                titleAttr: 'Excel',
                                exportOptions: {
                                    columns: '0,1,2,3,4,5'
                                },
                                customize: function( xlsx ) {
                                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                    $('row c', sheet).attr( 's', '51' );
                                },
                            },

                            {
                                extend: 'csvHtml5',
                                text:      '<i class="fas fa-file-csv"></i>',
                                titleAttr: 'CSV',
                                exportOptions: {
                                    columns: '0,1,2,3,4,5'
                                },
                            },
                        ],

                        columns:[
                            {
                            "data": "id",
                            render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1;},
                            searchable: false,
                            className: 'dt-body-center'
                            },
                            {
                                data: 'promoCode',
                                name: 'promoCode',
                                className: 'dt-body-center'
                            },
                            {
                                data: 'type',
                                name: 'type',
                                className: 'dt-body-center'
                            },
                            {
                                data: 'discount',
                                name: 'discount',
                                className: 'dt-body-center'
                            },
                            {
                                data: 'duration',
                                name: 'duration',
                                className: 'dt-body-center'
                            },
                            {
                                data: 'edate',
                                name: 'edate',
                                className: 'dt-body-center'
                            }
                        ]
                    });
                });
            </script>
        <!-- Datatables JS -->


    @endpush
<!-- Developed By CBS -->