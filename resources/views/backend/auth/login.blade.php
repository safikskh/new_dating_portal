<!-- Developed By CBS -->
  <!DOCTYPE html>
  <html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
        <meta name="description" content="Video and audio chat platform">
        <meta name="author" content="CBS">
        <meta name="keywords" content="DP, Datingportalen">

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('dashlead/img/logo/favicon.png')}}" type="image/x-icon"/>

        <!-- Title -->
        <title>Admin Login | Dating Portalen</title>

        <!---Fontawesome css-->
        <link href="{{ asset('dashlead/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">

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
        <link href="{{ asset('dashlead/css/dark-style.css') }}" rel="stylesheet">
        <link href="{{ asset('dashlead/css/custom-dark-style.css') }}" rel="stylesheet">
    </head>

    <body class="main-body dark-theme">
      <!-- Loader -->
      <div id="global-loader">
        <img src="{{ asset('dashlead/img/loader.svg') }}" class="loader-img" alt="Loader">
      </div>
      <!-- End Loader -->


                <!-- Page -->
      <div class="page main-signin-wrapper">

        <!-- Row -->
        <div class="row text-center pl-0 pr-0 ml-0 mr-0">
          <div class="col-lg-3 d-block mx-auto">
            <div class="text-center mb-2">
              <img src="{{ asset('dashlead/img/logo/icon.png')}}" class="header-brand-img" style="width:100px;height:100px;">
              <img src="{{ asset('dashlead/img/logo/icon.png')}}" class="header-brand-img theme-logos" style="margin-bottom:20px; border:3px solid #DBD4D3; border-radius:8%; padding: 2px; text-align: center; width:100px;height:100px;">
            </div>
            <div class="card custom-card">
              <div class="card-body">
                <h4 class="text-center" style="font-weight: bold; text-transform:uppercase;">Admin Login</h4>

                <form method="POST" action="{{ route('admin.login.submit') }}" aria-label="{{ __('Login') }}">
                  @csrf
                  <div class="form-group text-left">
                    <label>Email</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email address">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group text-left">
                    <label>Password</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
                      @if ($errors->has('password'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>
                  <button type="submit" class="btn ripple btn-main-primary btn-block" style="font-weight: bold; text-transform:uppercase;">Sign In</button>
                </form>

              </div>
            </div>
          </div>
        </div>
        <!-- End Row -->

      </div>
      <!-- End Page -->

      
      <!-- End Page -->
      <!-- Jquery js-->
      <script src="{{ asset('dashlead/plugins/jquery/jquery.min.js') }}"></script>

      <!-- Bootstrap js-->
      <script src="{{ asset('dashlead/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

      <!-- Ionicons js-->
      <script src="{{ asset('dashlead/plugins/ionicons/ionicons.js') }}"></script>

      <!-- Perfect-scrollbar js-->
      <script src="{{ asset('dashlead/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
      
      <!-- Rating js-->
      <script src="{{ asset('dashlead/plugins/rating/jquery.rating-stars.js') }}"></script>

      
      <!-- Custom js-->
      <script src="{{ asset('dashlead/js/custom.js') }}"></script>
  
    </body>
  </html>
<!-- Developed By CBS -->