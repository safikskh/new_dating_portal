<!-- Developed By CBS -->
    <!DOCTYPE html>
    <html lang="{{ app()->getLocale() }}">
        <head>
            <meta charset="utf-8">
			      <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
            <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
			      <meta name="description" content="Video and audio chat platform">
			      <meta name="author" content="CBS">
			      <meta name="keywords" content="DP, Datingportalen">
            
            <!-- Favicon -->
            <link rel="icon" href="{{ asset('cbs/backend/img/logo/favicon.png') }}" type="image/x-icon"/>
            <!-- Title -->
            <title>@yield('pageTitle') | DP Administration</title>

            <!-- CSS File -->
                <!---Fontawesome css-->
                <link href="{{ asset('cbs/backend/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">
                <!---Ionicons css-->
                <link href="{{ asset('cbs/backend/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
                <!---Typicons css-->
                <link href="{{ asset('cbs/backend/plugins/typicons.font/typicons.css') }}" rel="stylesheet">
                <!---Feather css-->
                <link href="{{ asset('cbs/backend/plugins/feather/feather.css') }}" rel="stylesheet">
                <!---Falg-icons css-->
                <link href="{{ asset('cbs/backend/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
                <!---Style css-->
                <link href="{{ asset('cbs/backend/css/style.css') }}" rel="stylesheet">
                <link href="{{ asset('cbs/backend/css/custom-style.css') }}" rel="stylesheet">
                <link href="{{ asset('cbs/backend/css/skins.css') }}" rel="stylesheet">
                <link href="{{ asset('cbs/backend/css/dark-style.css') }}" rel="stylesheet">
                <link href="{{ asset('cbs/backend/css/custom-dark-style.css') }}" rel="stylesheet">
                <!---Select2 css-->
                <link href="{{ asset('cbs/backend/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
                <!--Mutipleselect css-->
                <link rel="stylesheet" href="{{ asset('cbs/backend/plugins/multipleselect/multiple-select.css') }}">
                <!---Jquery.mCustomScrollbar css-->
                <link href="{{ asset('cbs/backend/plugins/jquery.mCustomScrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
                <!---Sidemenu css-->
                <link href="{{ asset('cbs/backend/plugins/sidemenu/sidemenu.css') }}" rel="stylesheet">

                 <!---Daterangepicker css-->
				<link href="{{ asset('cbs/backend/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
                <!--Sumoselect css-->
				<link href="{{ asset('cbs/backend/plugins/sumoselect/sumoselect.css') }}" rel="stylesheet">
				<!---Fileupload css-->
				<link href="{{ asset('cbs/backend/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet">
				<!---Fancy uploader css-->
				<link href="{{ asset('cbs/backend/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet">
				<!--Mutipleselect css-->
				<link rel="stylesheet" href="{{ asset('cbs/backend/plugins/multipleselect/multiple-select.css') }}">
				<!---Jquery.mCustomScrollbar css-->
				<link href="{{ asset('cbs/backend/plugins/jquery.mCustomScrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
				<!-- Croppie JS For Image Crop -->
				<link href="{{ asset('cbs/backend/css/croppie.css') }}" rel="stylesheet">



                <!---Sweet-Alert css-->
                <link href="{{ asset('cbs/backend/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">

                <!---Toastr css-->
                <link href="{{ asset('cbs/backend/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
                @stack('style')
            <!-- CSS File -->
        </head>

        <body class="main-body dark-theme">

            <!-- Body File -->
                
                <!-- Loader -->
                  <div id="global-loader">
                      <img src="{{ asset('cbs/backend/img/loader.svg') }}" class="loader-img" alt="Loader">
                  </div>
                <!-- End Loader -->

                <!-- Page -->
                    <div class="page">

                        <!-- Sidemenu -->
                            @include('cbs.backend.layouts.sidebar')
                        <!-- End Sidemenu -->

                        <!-- Main Content-->
                        <div class="main-content side-content pt-0">

                            <!-- Main Header-->
                                @include('cbs.backend.layouts.topbar')
                            <!-- End Main Header-->

                            <!-- Page Content-->
                                @yield('content')
                            <!-- Page Content-->

                        </div>
                        <!-- End Main Content-->

                        <!-- Main Footer-->
                            <div class="main-footer text-center">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span>Copyright © {{ now()->year }} Datingportalen. All Rights Reserved.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!--End Footer-->
                    </div>
                <!-- End Page -->

                <!-- Back-to-top -->
                    <a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>
                <!-- Back-to-top -->
            <!-- Body File -->

            <!-- JS File -->
                <!-- Jquery js-->
                <script src="{{ asset('cbs/backend/plugins/jquery/jquery.min.js') }}"></script>
                <!-- Bootstrap js-->
                <script src="{{ asset('cbs/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
                <!-- Ionicons js-->
                <script src="{{ asset('cbs/backend/plugins/ionicons/ionicons.js') }}"></script>
                <!-- Rating js-->
                <script src="{{ asset('cbs/backend/plugins/rating/jquery.rating-stars.js') }}"></script>
                <!-- Flot Chart js-->
                <script src="{{ asset('cbs/backend/plugins/jquery.flot/jquery.flot.js') }}"></script>
                <script src="{{ asset('cbs/backend/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
                <script src="{{ asset('cbs/backend/js/chart.flot.sampledata.js') }}"></script>
                <!-- Chart.Bundle js-->
                <script src="{{ asset('cbs/backend/plugins/chart.js/Chart.bundle.min.js') }}"></script>
                <!-- Peity js-->
                <script src="{{ asset('cbs/backend/plugins/peity/jquery.peity.min.js') }}"></script>
                <!-- Jquery-Ui js-->
                <script src="{{ asset('cbs/backend/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
                <!-- Form-elements js-->
				<!-- <script src="{{ asset('cbs/backend/js/advanced-form-elements.js') }}"></script> -->

                <!--Fileuploads js-->
				<script src="{{ asset('cbs/backend/plugins/fileuploads/js/fileupload.js') }}"></script>
				<script src="{{ asset('cbs/backend/plugins/fileuploads/js/file-upload.js') }}"></script>
                <!--Sumoselect js-->
				<script src="{{ asset('cbs/backend/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
                <!-- Select2 js-->
                <script src="{{ asset('cbs/backend/plugins/select2/js/select2.min.js') }}"></script>
                <script src="{{ asset('cbs/backend/js/select2.js') }}"></script>
                <!--MutipleSelect js-->
                <script src="{{ asset('cbs/backend/plugins/multipleselect/multiple-select.js') }}"></script>
                <script src="{{ asset('cbs/backend/plugins/multipleselect/multi-select.js') }}"></script>
                <!-- Jquery.mCustomScrollbar js-->
                <script src="{{ asset('cbs/backend/plugins/jquery.mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
                <!-- Perfect-scrollbar js-->
                <script src="{{ asset('cbs/backend/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
                <!-- Sidemenu js-->
                <script src="{{ asset('cbs/backend/plugins/sidemenu/sidemenu.js') }}"></script>
                <!-- Sticky js-->
                <script src="{{ asset('cbs/backend/js/sticky.js') }}"></script>
                <!-- Custom js-->
                <script src="{{ asset('cbs/backend/js/custom.js') }}"></script>


				<!--MutipleSelect js-->
				<script src="{{ asset('cbs/backend/plugins/multipleselect/multiple-select.js') }}"></script>
				<script src="{{ asset('cbs/backend/plugins/multipleselect/multi-select.js') }}"></script>
				<!-- Jquery.mCustomScrollbar js-->
				<script src="{{ asset('cbs/backend/plugins/jquery.mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
				<!-- Perfect-scrollbar js-->
				<script src="{{ asset('cbs/backend/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
				<!-- Croppie JS For Image Crop -->
				<script src="{{ asset('cbs/backend/js/croppie.js') }}"></script>


               

                @stack('script')

                <!-- Sweet-Alert js-->
				        <script src="{{ asset('cbs/backend/plugins/sweet-alert/sweetalert.min.js') }}"></script>
				
                <!-- Toastr js-->
                  <script src="{{ asset('cbs/backend/plugins/toastr/toastr.min.js') }}"></script>
                  {!! Toastr::message() !!}
                  <script>
                    @if($errors->any())
                      @foreach($errors->all() as $error)
                        toastr.error('{{ $error }}','Error',{
                          closeButton:true,
                          progressBar:true,
                        });
                      @endforeach
                    @endif
                  </script>
                <!-- Toastr js-->

                


				


            <!-- JS File -->

        </body>

    </html>
<!-- Developed By CBS -->
