<!-- Developed By CBS -->
    @extends('dashlead.layouts.layout')
    @section('pageTitle', 'Email Notifikationer')
    @section('content')
            <!-- Main Content-->
                <div class="main-content pt-0">
                    <div class="container">

                    <!-- Page Header -->
                        <div class="page-header"></div>
                    <!-- End Page Header -->

                    <!-- Row -->
                        <div class="row">

                            <!-- Setting Sidebar -->
                                @include('frontEnd.settings.leftSidebar')
                            <!-- Setting Sidebar -->

                            <!-- Setting Body Part -->
                                <div class="col-lg-8 col-md-12">
                                    <div class="card custom-card">
                                        <div class="card-body">

                                            <div>
                                                <h6 class="card-title mb-1">Email Notifikationer</h6><hr>
                                            </div>

                                            <form action="{{route('email.setting.update')}}" method="POST">
                                                @csrf
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="custom-switch">
                                                            <input class="custom-switch-input" name="isDisableEmailNotif" type="checkbox" {{$isDisableEmailNotif == 0 ? 'checked' : ''}}/>
                                                            <span class="custom-switch-indicator"></span>
                                                            <span class="custom-switch-description">Tillad Email Notifikationer</span>
                                                        </label>
                                                    </div>
                                                    <div align="right">
                                                        <button class="btn ripple btn-success" type="submit" style="font-weight: bold;text-transform: uppercase;">Gem ændring</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            <!-- Setting Body Part -->

                        </div>
                    <!-- End Row -->

                    </div>
                </div>
            <!-- End Main Content-->
    @endsection
<!-- Developed By CBS -->