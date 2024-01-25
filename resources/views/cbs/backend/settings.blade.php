<!-- Developed By CBS -->
    @extends('cbs.backend.layouts.layout')
    @section('pageTitle', 'Settings')
    @push('style')
        <!---Select2 css-->
        <link href="{{ asset('cbs/backend/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    @endpush
    @section('content')

        <!-- Page Content-->
            <div class="container-fluid">

                <!-- Page Header -->
					<div class="page-header">
						<div>
							<h2 class="main-content-title tx-24 mg-b-5">Settings</h2>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Settings</li>
							</ol>
						</div>
					</div>
				<!-- End Page Header -->

                {{-- Row --}}
                        <div class="row justify-content-md-center">
                            <div class="col-lg-6">
                                <div class="card custom-card overflow-hidden">
                                    <div class="card-body">

                                        <div class="modal-header">
                                            <h3 style="text-transform: uppercase; font-weight: bold;">Settings</h3>
                                        </div>

                                        <form method="POST" action="{{ route('admin.settings.update') }}">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-4">
                                                        <div class="form-group">
                                                            <label style="font-weight: bold;">Maintenance Mode <span style="color:red">*</span></label>
                                                            <select style="width: 100%" name="maintenance_status" class="form-control select2" required>
                                                                <option value="0" {{$data->maintenance_status == '0'  ? 'selected' : ''}}>Disable</option>
                                                                <option value="1" {{$data->maintenance_status == '1'  ? 'selected' : ''}}>Enable</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-8">
                                                        <div class="form-group">
                                                            <label>Maintenance Till  <span style="color:red">(If Maintenance Mode Enable)</span></label>
                                                            <input type="date" class="form-control" name="maintenance_date" value="{{$data->maintenance_date}}">
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
				{{-- End Row --}}
            </div>
        <!-- Page Content-->

    @endsection
    @push('script')

    @endpush
<!-- Developed By CBS -->