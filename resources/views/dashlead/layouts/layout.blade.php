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
				<link href="{{ asset('dashlead/css/dark-style.css') }}" rel="stylesheet">
				<link href="{{ asset('dashlead/css/custom-style.css') }}" rel="stylesheet">
				<link href="{{ asset('dashlead/css/custom-dark-style.css') }}" rel="stylesheet">
				<link href="{{ asset('dashlead/css/skins.css') }}" rel="stylesheet">
				<link href="{{ asset('dashlead/css/bootstrap-tagsinput.css') }}" rel="stylesheet">

				<!---Daterangepicker css-->
				<link href="{{ asset('dashlead/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

				<!---Datetimepicker css-->
				{{-- <link href="{{ asset('dashlead/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}" rel="stylesheet">
				<link href="{{ asset('dashlead/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}" rel="stylesheet">
				<link href="{{ asset('dashlead/plugins/pickerjs/picker.min.css') }}" rel="stylesheet"> --}}

				<!--Sumoselect css-->
				<link href="{{ asset('dashlead/plugins/sumoselect/sumoselect.css') }}" rel="stylesheet">
				<!---Fileupload css-->
				<link href="{{ asset('dashlead/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet">
				<!---Fancy uploader css-->
				<link href="{{ asset('dashlead/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet">
				<!--Mutipleselect css-->
				<link rel="stylesheet" href="{{ asset('dashlead/plugins/multipleselect/multiple-select.css') }}">
				<!---Jquery.mCustomScrollbar css-->
				<link href="{{ asset('dashlead/plugins/jquery.mCustomScrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet">

				<!---Owl Carousel css-->
				<link href="{{ asset('dashlead/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
				<link rel="stylesheet" href="{{ asset('dashlead/plugins/swiper/swiper.css') }}" />
				<!---Multislider css-->
				<link href="{{ asset('dashlead/plugins/multislider/multislider.css') }}" rel="stylesheet">

				<!-- Croppie JS For Image Crop -->
				<link href="{{ asset('dashlead/css/croppie.css') }}" rel="stylesheet">

				<!---Sweet-Alert css-->
				<link href="{{ asset('dashlead/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">

				<!---Toastr css-->
				<link href="{{ asset('dashlead/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

				<!---Select2 css-->
				<link href="{{ asset('dashlead/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
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
					<img src="{{ asset('dashlead/img/loader.svg') }}" class="loader-img" alt="Loader">
				</div>
			<!-- End Loader -->

			<!-- Page -->
				<div class="page" style="background:{{$body_bg_color}};"  id="app">

					<!-- Topbar -->
						@include('dashlead.layouts.topbar')
					<!-- Topbar -->

					<!-- Header Menu -->
                    @if(session('isProfileComplete') == 1)
						@include('dashlead.layouts.headermenu')
                    @endif
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



				<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

				<!-- Jquery js-->
				<script src="{{ asset('dashlead/plugins/jquery/jquery.min.js') }}"></script>

				<!-- Bootstrap js-->
				<script src="{{ asset('dashlead/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


				<script src="{{ asset('dashlead/js/bootstrap-tagsinput.js') }}"></script>

				<!-- Ionicons js-->
				<script src="{{ asset('dashlead/plugins/ionicons/ionicons.js') }}"></script>

				<!-- Rating js-->
				<script src="{{ asset('dashlead/plugins/rating/jquery.rating-stars.js') }}"></script>

				<!-- Jquery-Ui js-->
				<script src="{{ asset('dashlead/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>

				<!-- Select2 js-->
				<script src="{{ asset('dashlead/plugins/select2/js/select2.min.js') }}"></script>
				{{-- <script src="{{ asset('dashlead/js/select2.js') }}"></script> --}}

				<!-- Form-elements js-->
				<script src="{{ asset('dashlead/js/advanced-form-elements.js') }}"></script>
				{{-- <script src="{{ asset('dashlead/js/form-elements.js') }}"></script> --}}

				<!-- Jquery-Ui js-->
				<script src="{{ asset('dashlead/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>

				<!-- Daternagepicker js-->
				<script src="{{ asset('dashlead/plugins/bootstrap-daterangepicker/moment.min.js') }}"></script>
				<script src="{{ asset('dashlead/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

				<!-- Datetimepicker js-->
				{{-- <script src="{{ asset('dashlead/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script> --}}
				<!-- Simple-Datepicker js-->
				{{-- <script src="{{ asset('dashlead/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script> --}}
				{{-- <script src="{{ asset('dashlead/plugins/pickerjs/picker.min.js') }}"></script> --}}
				<!--Fileuploads js-->
				<script src="{{ asset('dashlead/plugins/fileuploads/js/fileupload.js') }}"></script>
				<script src="{{ asset('dashlead/plugins/fileuploads/js/file-upload.js') }}"></script>
				<!--Fancy uploader js-->
				<script src="{{ asset('dashlead/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
				<script src="{{ asset('dashlead/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
				<script src="{{ asset('dashlead/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
				<script src="{{ asset('dashlead/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
				<script src="{{ asset('dashlead/plugins/fancyuploder/fancy-uploader.js') }}"></script>


				<script src="{{ asset('dashlead/plugins/swiper/swiper.js')}}"></script>

				<!--Sumoselect js-->
				<script src="{{ asset('dashlead/plugins/sumoselect/jquery.sumoselect.js') }}"></script>

				<!--MutipleSelect js-->
				<script src="{{ asset('dashlead/plugins/multipleselect/multiple-select.js') }}"></script>
				<script src="{{ asset('dashlead/plugins/multipleselect/multi-select.js') }}"></script>
				<!-- Jquery.mCustomScrollbar js-->
				<script src="{{ asset('dashlead/plugins/jquery.mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>

				<!-- Perfect-scrollbar js-->
				<script src="{{ asset('dashlead/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

				<!-- <script src="{{asset('js/promotion-slider.js')}}"></script> -->

				<!-- Sticky js-->
				<script src="{{ asset('dashlead/js/sticky.js') }}"></script>

				<!-- Custom js-->
				<script src="{{ asset('dashlead/js/custom.js') }}"></script>

				<!-- Croppie JS For Image Crop -->
				<script src="{{ asset('dashlead/js/croppie.js') }}"></script>

				<!-- Owl Carousel js-->
				<script src="{{ asset('dashlead/plugins/owl-carousel/owl.carousel.js') }}"></script>
				<script src="{{ asset('dashlead/plugins/multislider/multislider.js') }}"></script>
				<script src="{{ asset('dashlead/js/carousel.js') }}"></script>

				<!-- Upload Image Process -->
					<script>
						$(document).ready(function(){

						// Image Preview
							$upload_image_crop_process = $('#upload_image_preview').croppie({
								enableExif:true,
								viewport:{
									width:480,
									height:270,
									type:'square'
								},
								boundary:{
									width:530,
									height:320
								},
								showZoomer: true,
							});
						// Image Preview

						// Image Upload
							$('#upload_image_upload').change(function(){
								var reader = new FileReader();

								reader.onload = function(event){
								$upload_image_crop_process.croppie('bind', {
									url:event.target.result
								}).then(function(){
									console.log('jQuery bind complete');
								});
								}
								reader.readAsDataURL(this.files[0]);
							});
						// Image Upload

						// Crop & Form Button Hide
							$('#upload_image_upload').change(function(){
								// $('.upload_image_crop').show();
								$('#upload_image_preview').show();
								$('#upload_image_tc').hide();
								$('.upload_image_crop').removeAttr('disabled', '');
							});

							// $('.upload_image_crop').hide();
							$('.upload_image_crop').attr('disabled', '');
							$('#upload_image_form_submit').attr('disabled', '');
							$('#upload_image_preview').hide();
							// $('#upload_image_form_submit').hide();
						// Crop & Form Button Hide

						// Image Crop , Data Send & Received
							$('.upload_image_crop').click(function(event){
								$upload_image_crop_process.croppie('result', {
								type:'canvas',
								size: { width: 1920, height: 1080 }
								}).then(function(response){
								var _token = $('input[name=_token]').val();
								$.ajax({
									url:'{{ route("image.process") }}',
									type:'post',
									data:{"image":response, _token:_token},
									dataType:"json",
									success:function(data)
									{
									var image_display = '<img src="/'+data.temp_image+'" style="width:192px;height:108px;"" />';
									var img_data = '<input value="'+data.temp_image+'" type="hidden" name="temp_image"> <input value="'+data.temp_image_name+'" type="hidden" name="temp_image_name"> <input value="'+data.temp_image_path+'" type="hidden" name="temp_image_path">';
									$('#upload_image_display').html(image_display);
									$('#upload_img_data').html(img_data);

									// Form Button show If Image Croped
									if(image_display != "") { $('#upload_image_form_submit').removeAttr('disabled', ''); }
									}
								});
								});
							});
						// Image Crop , Data Send & Received

						});
					</script>
				<!-- Upload Image Process -->

				<!-- Promotion Image Process -->
					<script>
						$(document).ready(function(){

						// Image Preview
							$promotion_image_crop_process = $('#promotion_image_preview').croppie({
								enableExif:true,
								viewport:{
									width:200,
									height:200,
									type:'square'
								},
								boundary:{
									width:400,
									height:250
								},
								showZoomer: true,
							});
						// Image Preview

						// Image Upload
							$('#promotion_image_upload').change(function(){
								var reader = new FileReader();

								reader.onload = function(event){
								$promotion_image_crop_process.croppie('bind', {
									url:event.target.result
								}).then(function(){
									console.log('jQuery bind complete');
								});
								}
								reader.readAsDataURL(this.files[0]);
							});
						// Image Upload

						// Crop & Form Button Hide
							$('#promotion_image_upload').change(function(){
								$('#promotion_image_preview').show();
								$('#promotion_image_tc').hide();
								$('.promotion_image_crop').removeAttr('disabled', '');
							});

							$('.promotion_image_crop').attr('disabled', '');
							$('#promotion_image_form_submit').attr('disabled', '');
							$('#promotion_image_preview').hide();
						// Crop & Form Button Hide

						// Image Crop , Data Send & Received
							$('.promotion_image_crop').click(function(event){
								$promotion_image_crop_process.croppie('result', {
								type:'canvas',
								size: { width: 500, height: 500 }
								}).then(function(response){
								var _token = $('input[name=_token]').val();
								$.ajax({
									url:'{{ route("image.process") }}',
									type:'post',
									data:{"image":response, _token:_token},
									dataType:"json",
									success:function(data)
									{
									var promotion_image_display = '<img src="/'+data.temp_image+'" style="width:80px;height:80px;"" />';
									var promotion_img_data = '<input value="'+data.temp_image+'" type="hidden" name="temp_image"> <input value="'+data.temp_image_name+'" type="hidden" name="temp_image_name"> <input value="'+data.temp_image_path+'" type="hidden" name="temp_image_path">';
									$('#promotion_image_display').html(promotion_image_display);
									$('#promotion_img_data').html(promotion_img_data);

									// Form Button show If Image Croped
									if(promotion_image_display != "") { $('#promotion_image_form_submit').removeAttr('disabled', ''); }
									}
								});
								});
							});
						// Image Crop , Data Send & Received

						});
					</script>
				<!-- Promotion Image Process -->

				<!-- Upload Video Process -->
					<script>
						$(document).ready(function(){
							$(document).on("change", "#video_upload_file", function(evt) {
							var $source = $('#video_upload_source');
							$source[0].src = URL.createObjectURL(this.files[0]);
							$source.parent()[0].load();
							$('#video_upload_display').show();
							});

							$('#video_upload_display').hide();
						});
					</script>

				<!-- Upload Video Process -->

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
					<script>
						$('#profile_edit_model .save').click(function (e) {
							e.preventDefault();
							addImage(5);
							$('#profile_edit_model').modal('hide');
							//$(this).tab('show')
							return false;
						})
					</script>
				<!-- Toastr js-->

				{{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}

			<!-- ./JS Script -->
		</body>

	</html>
<!-- Developed By CBS -->
