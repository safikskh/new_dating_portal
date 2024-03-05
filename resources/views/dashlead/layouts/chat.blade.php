<!-- Developed By CBS -->
	<!DOCTYPE html>
	<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

		<head>
			<meta charset="utf-8">
			<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
			<meta name="description" content="Video and audio chat platform">
			<meta name="author" content="CBS">
			<meta name="keywords" content="DP, Datingportalen">
			<meta name="userId" content="{{ Auth::check() ? Auth::user()->id : '' }}">
            <meta name="csrf-token" content="{{ csrf_token() }}">
			<!-- Favicon -->
			<link rel="icon" href="{{ asset('dashlead/img/logo/favicon.png')}}" type="image/x-icon"/>

			<!-- Title -->
			<title>@yield('pageTitle') | Dating Portalen</title>

			<link href="{{ mix('css/app.css') }}" rel="stylesheet">

			<!-- CSS File -->
				<!---Fontawesome css-->
				<link href="{{ asset('dashlead/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">
				<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
				<!---Ionicons css-->
				<link href="{{ asset('dashlead/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
				<!---Typicons css-->
				<link href="{{ asset('dashlead/plugins/typicons.font/typicons.css') }}" rel="stylesheet">
				<!---Feather css-->
				<link href="{{ asset('dashlead/plugins/feather/feather.css') }}" rel="stylesheet">
				<!---Falg-icons css-->
				<link href="{{ asset('dashlead/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
				<!---Style css-->
				<link href="{{ asset('dashlead/css/style.css') }}" rel="stylesheet">
				<link href="{{ asset('dashlead/css/custom-style.css') }}" rel="stylesheet">
				<link href="{{ asset('dashlead/css/skins.css') }}" rel="stylesheet">
				<!---Jquery.mCustomScrollbar css-->
				<link href="{{ asset('dashlead/plugins/jquery.mCustomScrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
				<!---Sweet-Alert css-->
				<link href="{{ asset('dashlead/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">
				<!---Toastr css-->
				<link href="{{ asset('dashlead/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
				<!-- magnific-popup css -->
        		<link href="{{ asset('dashlead/plugins/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
				@stack('style')

			<!-- ./CSS File -->
		</head>

		<body>

					<!-- Portal Colors -->
							@php
								if(auth()->check())
									{
										//1-Dating
										if((Auth::user()->getCurrentPortalbyAuth()->id) == 1)
											{
												$header_bg_color = "#1b4da6";
												$body_bg_color = "#e3ecfb";
												$footer_bg_color = "#cedcf5";
											}
										//2-Sugar Dating
										elseif((Auth::user()->getCurrentPortalbyAuth()->id) == 2)
											{
												$header_bg_color = "#67737d";
												$body_bg_color = "#e2e2e2";
												$footer_bg_color = "#d4d4d4";
											}
										//3-Fræk dating
										elseif((Auth::user()->getCurrentPortalbyAuth()->id) == 3)
											{
												$header_bg_color = "#8f133e";
												$body_bg_color = "#ffe7ef";
												$footer_bg_color = "#f9d3e0";
											}
										//4-Badboy Dating
										elseif((Auth::user()->getCurrentPortalbyAuth()->id) == 4)
											{
												$header_bg_color = "#c10808";
												$body_bg_color = "#ffa1a1";
												$footer_bg_color = "#ea8181";
											}
										//5-Senior Dating
										elseif((Auth::user()->getCurrentPortalbyAuth()->id) == 5)
											{
												$header_bg_color = "#6a2d10";
												$body_bg_color = "#ffd2c0";
												$footer_bg_color = "#edb198";
											}
										//6-Regnbue Dating
										elseif((Auth::user()->getCurrentPortalbyAuth()->id) == 6)
											{
												$header_bg_color = "#7d2c95";
												$body_bg_color = "#dcb2ea";
												$footer_bg_color = "#d09ce2";
											}
									}
								else
									{
										$header_bg_color = "#1b4da6";
										$body_bg_color = "#e3ecfb";
										$footer_bg_color = "#cedcf5";
									}
							@endphp
					<!-- ./Portal Colors -->

			<!-- Loader -->
				<div id="global-loader">
					<img src="{{ asset('dashlead/img/loader.svg') }}" class="loader-img">
				</div>
			<!-- End Loader -->

			<!-- Page -->
				<div class="page" style="background:{{$body_bg_color}};" id="app">

					<!-- Topbar -->
						@include('dashlead.layouts.topbar-chat')
					<!-- Topbar -->

					<!-- Header Menu -->
						@include('dashlead.layouts.headermenu-chat')
					<!-- Header Menu -->

					<!-- Main Content-->
							@yield('content')
					<!-- End Main Content-->

					<!-- Main Footer-->
						<div class="main-footer text-center" style="background:{{$footer_bg_color}};">
							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<span>Copyright © {{ now()->year }} Datingportalen. Alle Rettigheder Forbeholdes.</span>
									</div>
								</div>
							</div>
						</div>
					<!--End Footer-->

					<!-- Models -->
						@include('dashlead.layouts.models')
					<!-- Models -->

				</div>
			<!-- End Page -->

			<!-- Back-to-top -->
				<a href="#top" id="back-to-top" style="background:{{$header_bg_color}};"><i class="fe fe-arrow-up"></i></a>
			<!-- Back-to-top -->

			<!-- JS Script -->



				<!-- Jquery js-->
				<script src="{{ asset('dashlead/plugins/jquery/jquery.min.js') }}"></script>

				<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

				<script src="{{ mix('js/app.js') }}" defer></script>
				<!-- Bootstrap js-->
				<script src="{{ asset('dashlead/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
				<script src="{{ asset('dashlead/js/bootstrap-tagsinput.js') }}"></script>
				<!-- Ionicons js-->
				<script src="{{ asset('dashlead/plugins/ionicons/ionicons.js') }}"></script>
				<!-- Rating js-->
				<script src="{{ asset('dashlead/plugins/rating/jquery.rating-stars.js') }}"></script>
				<!-- Sticky js-->
				<script src="{{ asset('dashlead/js/sticky.js') }}"></script>
				<!-- Perfect-scrollbar js-->
				<script src="{{ asset('dashlead/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
				<!-- <script src="{{ asset('dashlead/plugins/simplebar/simplebar.min.js') }}"></script> -->
		        <script src="{{ asset('dashlead/plugins/node-waves/waves.min.js') }}"></script>
		        <!-- Magnific Popup-->
		        <script src="{{ asset('dashlead/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
				<!-- Custom js-->
				<script src="{{ asset('dashlead/js/custom-chat.js') }}"></script>
				@stack('script')
				<!-- Sweet-Alert js-->
				<script src="{{ asset('dashlead/plugins/sweet-alert/sweetalert.min.js') }}"></script>
				<!-- Toastr js-->
					<script src="{{ asset('dashlead/plugins/toastr/toastr.min.js') }}"></script>
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
			<!-- ./JS Script -->
		</body>

	</html>
<!-- Developed By CBS -->
