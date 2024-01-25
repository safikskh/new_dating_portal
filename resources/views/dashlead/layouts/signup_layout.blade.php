<!-- Developed By CBS -->
	<!DOCTYPE html>
	<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

		<head>
			<meta charset="utf-8">
			<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
			<meta name="description" content="Video and audio chat platform">
			<meta name="author" content="CBS">
			<meta name="keywords" content="DP, Datingportalen">
			<!-- Favicon -->
			<link rel="icon" href="{{ asset('dashlead/img/logo/favicon.png')}}" type="image/x-icon"/>

			<!-- Title -->
			<title>@yield('pageTitle') | Dating Portalen</title>

			<!-- CSS File -->
				<!---Fontawesome css-->
				<link href="{{ asset('dashlead/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">
				<!---Feather css-->
				<link href="{{ asset('dashlead/plugins/feather/feather.css') }}" rel="stylesheet">
				<!---Style css-->
				<link href="{{ asset('dashlead/css/style.css') }}" rel="stylesheet">
				<link href="{{ asset('dashlead/css/custom-style.css') }}" rel="stylesheet">
				<link href="{{ asset('dashlead/css/skins.css') }}" rel="stylesheet">
				<link href="{{ asset('dashlead/css/bootstrap-tagsinput.css') }}" rel="stylesheet">
				<!--Mutipleselect css-->
				<link rel="stylesheet" href="{{ asset('dashlead/plugins/multipleselect/multiple-select.css') }}">

				<!---Fileupload css-->
				<link href="{{ asset('dashlead/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet">

				<!---Select2 css-->
				<link href="{{ asset('dashlead/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
				@stack('style')
			<!-- ./CSS File -->
		</head>

		<body>
			<!-- Portal Colors -->
							@php
								$header_bg_color = "#1b4da6";
								$body_bg_color = "#e3ecfb";
								$footer_bg_color = "#cedcf5";
							@endphp
			<!-- ./Portal Colors -->

			<!-- Loader -->
				<div id="global-loader">
					<img src="{{ asset('dashlead/img/loader.svg') }}" class="loader-img" alt="Loader">
				</div>
			<!-- End Loader -->

			<!-- Page -->
				<div class="page" style="background:{{$body_bg_color}};">
					<!-- Topbar -->
						<div class="main-header hor-header" style="background:{{$header_bg_color}};">
							<div class="container">
								<!-- Left Header -->
									<div class="main-header-left">
										<a class="main-header-menu-icon d-lg-none" href="#" id="mainNavShow"><span></span></a>
										<a class="main-logo" href="{{ route('public.home')}}">
											<img src="{{ asset('dashlead/img/logo/logo-light.png')}}" class="header-brand-img desktop-logo">
											<img src="{{ asset('dashlead/img/logo/icon.png')}}" class="header-brand-img icon-logo" alt="logo">
											<img src="{{ asset('dashlead/img/logo/logo-light.png')}}" class="header-brand-img desktop-logo theme-logo" alt="logo">
											<img src="{{ asset('dashlead/img/logo/icon.png')}}" class="header-brand-img icon-logo theme-logo" alt="logo">
										</a>
									</div>
								<!-- ./Left Header -->

								<!-- Right Header -->
									<div class="main-header-right">
										@if(Auth::check())                          
										<form class="form-inline" method="POST" action="{{ route('logout') }}">
											@csrf
											<button type="submit" class="btn" style="color:#ff3300; padding: 0px;">
												<i style="border:2px solid white; border-radius:15%; padding: 7px; text-align: center;"class="fas fa-sign-out-alt fa-2x"></i>
											</button>
										</form>
										@else
										<a href="{{ route('public.home')}}" style="color:#39e600;">
											<i style="border:2px solid white; border-radius:15%; padding: 7px; text-align: center;"class="fas fa-sign-in-alt fa-2x"></i>
										</a>
										@endif  
									</div>
								<!-- ./Right Header -->
							</div>
						</div>
					<!-- Topbar -->

					<!-- Main Content-->
							@yield('content')
					<!-- End Main Content-->

					<!-- Main Footer-->
						<div class="main-footer text-center" style="background:{{$footer_bg_color}};">
							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<span>Copyright © {{ now()->year }} Dating Portalen. Alle Rettigheder Forbeholdes.</span>
									</div>
								</div>
							</div>
						</div>
					<!--End Footer-->
				</div>
			<!-- End Page -->

			<!-- Back-to-top -->
				<a href="#top" id="back-to-top" style="background:{{$header_bg_color}};"><i class="fe fe-arrow-up"></i></a>
			<!-- Back-to-top -->

			<!-- JS Script -->
				<!-- Jquery js-->
				<script src="{{ asset('dashlead/plugins/jquery/jquery.min.js') }}"></script>
				<!-- Bootstrap js-->
				<script src="{{ asset('dashlead/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
				<!-- Rating js-->
				<script src="{{ asset('dashlead/plugins/rating/jquery.rating-stars.js') }}"></script>
				<!-- Sticky js-->
				<script src="{{ asset('dashlead/js/sticky.js') }}"></script>
				<!-- Custom js-->
				<script src="{{ asset('dashlead/js/custom.js') }}"></script>

				<!--Fileuploads js-->
				<script src="{{ asset('dashlead/plugins/fileuploads/js/fileupload.js') }}"></script>
				<script src="{{ asset('dashlead/plugins/fileuploads/js/file-upload.js') }}"></script>

				<script src="{{ asset('dashlead/plugins/select2/js/select2.min.js') }}"></script>
				<!-- Form-layouts-->
				<script src="{{ asset('dashlead/js/form-layouts.js') }}"></script>

				<script src="{{ asset('dashlead/js/bootstrap-tagsinput.js') }}"></script>

				@stack('script')
			<!-- ./JS Script -->
		</body>

	</html>
<!-- Developed By CBS -->