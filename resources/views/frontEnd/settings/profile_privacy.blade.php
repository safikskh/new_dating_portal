<!-- Developed By CBS -->
    @extends('dashlead.layouts.layout')
    @section('pageTitle', 'Privatliv')
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
                                                <h6 class="card-title mb-1">Privatliv</h6><hr>
                                            </div>

                                            <form action="{{url('profileprivacy')}}" method="POST">
                                                @csrf
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="custom-switch">
                                                            <input {{auth()->user()->isPaid() ? '' : 'disabled'}}  class="custom-switch-input" name="isvisible" type="checkbox" {{$isVisible == 1 ? 'checked' : ''}}/>
                                                            <span class="custom-switch-indicator"></span>
                                                            <span class="custom-switch-description">Vis Profil For Ikke-Medlemmer</span>
                                                        </label>
                                                    </div>
                                                    <div align="right">
                                                        <!-- <button class="btn ripple btn-danger" data-dismiss="modal" type="button" style="font-weight: bold;text-transform: uppercase;">Annuller</button> -->
                                                        <!-- <a class="btn ripple btn-danger" type="button" style="color:white; font-weight: bold;text-transform: uppercase;">Annuller</a> -->
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