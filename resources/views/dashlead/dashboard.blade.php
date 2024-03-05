<!-- Developed By CBS -->
@extends('dashlead.layouts.layout')
@section('pageTitle', 'Hjem')


@push('style')
@endpush
@section('content')
		<!-- Main Content-->
			<div class="main-content pt-0">
				<div class="container">
				<!-- Page Header -->
					<div class="page-header"></div>
				<!-- End Page Header -->
                    @if(session('isProfileComplete') == 0)
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="card custom-card">
                                    <div class="card-body h-100" style="margin-bottom: 10px;">
                                        <div style="margin-bottom: 10px;">
                                            <h5>Det ser ud til, at din profil er ufuldstændig.. ! </h5><hr>
                                             <h4 class="card-title mb-1 " style="font-weight: bold;"> <a data-target="#profile_edit_model" data-toggle="modal" data-effect="effect-sign" href="#" class="text-danger"> Gå til din profil </a>  og opdatere din profil </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
					<!-- Row -->
						<div class="row">
							<!-- Sidebar Section -->
								<div class="col-md-3 col-lg-3">
									@include('dashlead.layouts.sectionOne')
								</div>
							<!-- Sidebar Section -->

							<!-- Sidebar Section -->
								<div class="col-md-6 col-lg-6">
									@include('dashlead.layouts.sectionTwo')
								</div>
							<!-- Sidebar Section -->

							<!-- Promotion Section -->
								<div class="col-md-3 col-lg-3">
									@include('dashlead.layouts.promotationsection')
								</div>
							<!-- Promotion Section -->

						</div>
                        @endif
					<!-- End Row -->
				</div>
			</div>

		<!-- End Main Content-->
@endsection

@push('script')

		<!-- Select2 JS -->
					<script type="text/javascript" language="javascript" >
							$(document).ready(function() {
							$('.seclect2').select2();
							$('#qslocation').select2();
							$('#qssex').select2();
							$('#qsto').select2();
							$('#qsfrom').select2();
							});
					</script>
		<!-- Select2 JS -->

		<!-- Announcement Slider JS -->
			<script>
			var swiper = new Swiper('.swiper-container', {
				spaceBetween: 30,
				centeredSlides: true,
				autoplay: {
					delay: 10000,
					disableOnInteraction: false,
				},
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				});
			</script>
		<!-- Announcement Slider JS -->

		<!-- Wall Slider JS -->
			<script>
			var swiper = new Swiper('.wall-container', {
				spaceBetween: 30,
				centeredSlides: true,
				autoplay: {
					delay: 10000,
					disableOnInteraction: false,
				},
				pagination: {
					el: '.wall-pagination',
					clickable: true,
				},
				navigation: {
					nextEl: '.wall-button-next',
					prevEl: '.wall-button-prev',
				},
				});
			</script>
		<!-- Wall Slider JS -->
@endpush
<!-- Developed By CBS -->
