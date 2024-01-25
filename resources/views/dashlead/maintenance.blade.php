<!-- Developed By CBS -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
      <meta charset="utf-8">
			<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
			<meta name="description" content="Video and audio chat platform">
			<meta name="author" content="CBS">
			<meta name="keywords" content="DP, Datingportalen">
      <meta name="csrf-token" content="{{ csrf_token() }}">
			<!-- Favicon -->
			<link rel="icon" href="{{ asset('dashlead/img/logo/favicon.png')}}" type="image/x-icon"/>

			<!-- Title -->
			<title>Under Vedligeholdelse | Dating Portalen</title>

      {{-- CSS File --}}
        <!---Fontawesome css-->
        <link href="{{ asset('dashlead/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">
        <!---Ionicons css-->
        <link href="{{ asset('dashlead/plugins/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
        <!---Typicons css-->
        <link href="{{ asset('dashlead/plugins/typicons.font/typicons.css')}}" rel="stylesheet">
        <!---Feather css-->
        <link href="{{ asset('dashlead/plugins/feather/feather.css')}}" rel="stylesheet">
        <!---Falg-icons css-->
        <link href="{{ asset('dashlead/plugins/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
        <!---Style css-->
        <link href="{{ asset('dashlead/css/style.css')}}" rel="stylesheet">
        <link href="{{ asset('dashlead/css/custom-style.css')}}" rel="stylesheet">
        <link href="{{ asset('dashlead/css/skins.css')}}" rel="stylesheet">
        <link href="{{ asset('dashlead/css/dark-style.css')}}" rel="stylesheet">
        <link href="{{ asset('dashlead/css/custom-dark-style.css')}}" rel="stylesheet">
        <!---Jquery.Coutdown css-->
        <link href="{{ asset('dashlead/plugins/jquery-countdown/jquery.countdown.css')}}" rel="stylesheet">
      {{-- CSS File --}}
	</head>

  <body class="main-body">

        <!-- Loader -->
				<div id="global-loader">
					<img src="{{ asset('dashlead/img/loader.svg') }}" class="loader-img" alt="Loader">
				</div>
			<!-- End Loader -->

        {{-- Page --}}

                  {{-- To Change countdown language go => public\dashlead\plugins\jquery-countdown\jquery.countdown.js => line 194 --}}
        
                  {{-- <div class="page main-signin-wrapper" style="background: #db1f00 url(../dashlead/startup-page/images/patterns/red_dot_pattern.gif); !important;"> --}}
                  <div class="page main-signin-wrapper" style="background: #000 !important;">
                    <div class="container">
                      <div class="construction1 text-center text-white">
                        <div class="">
                          <h4 class="text-center display-4 font-weight-bold "><img src="{{ asset('dashlead/img/logo/logo-light.png')}}" alt="Datingportalen"></h5>
                          {{-- <h4 class="text-center display-4 font-weight-bold ">Maintenance Mode</h4> --}}
                          <h5 class="text-center font-weight-bold ">Beklager, vi er nede for vedligeholdelse.</h5>
                          <div id="launch_date"></div>
                        </div>
                        <div class="text-center"><span>Du er velkommen til at kontakte os via support@datingportalen.com</span></div>
                      </div>
                    </div>
                  </div>
        {{-- End Page --}}
    
        {{-- JS File --}}
          <!-- Jquery js-->
          <script src="{{ asset('dashlead/plugins/jquery/jquery.min.js')}}"></script>
          <!-- Bootstrap js-->
          <script src="{{ asset('dashlead/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
          <!-- Ionicons js-->
          <script src="{{ asset('dashlead/plugins/ionicons/ionicons.js')}}"></script>
          <!-- Perfect-scrollbar js-->
          <script src="{{ asset('dashlead/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
          <!-- Rating js-->
          <script src="{{ asset('dashlead/plugins/rating/jquery.rating-stars.js')}}"></script>
          <!-- Jquery.Coutdown js-->
          <script src="{{ asset('dashlead/plugins/jquery-countdown/jquery.plugin.min.js')}}"></script>
          <script src="{{ asset('dashlead/plugins/jquery-countdown/jquery.countdown.js')}}"></script>
          {{-- <script src="{{ asset('dashlead/plugins/jquery-countdown/countdown.js')}}"></script> --}}
          <!-- Custom js-->
          <script src="{{ asset('dashlead/js/custom.js')}}"></script>
          <!-- Coutdown Date -->
            @php
              //$countdown_date = "March 15, 2021";
              $countdown_date = date('F j, Y', strtotime($data->maintenance_date));
            @endphp

            <script>  
              $(function () {
                var austDay = new Date("<?php echo $countdown_date; ?>");
                //var austDay = new Date("March 15, 2021");
                  $('#launch_date').countdown(
                {
                until: austDay,
                layout: '<ul class="countdown"><li><span class="number">{dn}<\/span><br/><span class="time">{dl}<\/span><\/li><li><span class="number">{hn}<\/span><br/><span class="time">{hl}<\/span><\/li><li><span class="number">{mn}<\/span><br/><span class="time">{ml}<\/span><\/li><li><span class="number">{sn}<\/span><br/><span class="time">{sl}<\/span><\/li><\/ul>'
                  });
                    $('#year').text(austDay.getFullYear());
              });
            </script>
				  <!-- Coutdown Date -->
        {{-- JS File --}}
  </body>
</html>
<!-- Developed By CBS -->