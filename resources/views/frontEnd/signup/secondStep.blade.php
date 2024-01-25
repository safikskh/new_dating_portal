<!-- Developed By CBS -->
    @extends('dashlead.layouts.signup_layout') 
    @section('pageTitle', 'Trin 2')
    @section('content')
    <!-- pageContent area-->
    <div class="main-content pt-0">
        <div class="container">
 
            <!-- Row -->
            <div class="row row-sm">

                <!-- Page Header -->
                <div class="page-header"></div>
                <!-- End Page Header -->

                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">

                            <div>
                                <h5 class="card-title mb-1" style="font-weight:bold; text-transform:uppercase;">Tilmelding : Trin 2</h5><hr>
                            </div>
                            <div class="row">
                                    <!-- 1-Dating -->
                                        <div class="col-md-4 col-lg-4 col-xl-4">
                                            <div class="card custom-card" style="background:#e3ecfb;">
                                                <div class="card-body dash1">
                                                    <form class="d-inline" method="POST" action="{{ route('signup.third')}}">
                                                    @csrf
                                                    <input type="hidden" name="portal_id" value="1">
                                                    <button type="submit" class="btn">
                                                        <img data-toggle="modal" data-target="#portalHelpPopUp" src="{{ asset('dashlead/img/portal/dating.png')}}" alt="alt"/>
                                                    </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- 1-Dating -->
                        

                                     <!-- 2-Sugar Dating -->
                                        <div class="col-md-4 col-lg-4 col-xl-4">
                                            <div class="card custom-card" style="background:#e3ecfb;">
                                                <div class="card-body dash1">
                                                    <form class="d-inline" method="POST" action="{{ route('signup.third')}}">
                                                    @csrf
                                                    <input type="hidden" name="portal_id" value="2">
                                                    <button type="submit" class="btn">
                                                        <img data-toggle="modal" data-target="#portalHelpPopUp" src="{{ asset('dashlead/img/portal/sugar-dating.png')}}" alt="alt"/>
                                                    </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- 2-Sugar Dating -->

                                     <!--3-Freak Dating -->
                                        <div class="col-md-4 col-lg-4 col-xl-4">
                                            <div class="card custom-card" style="background:#e3ecfb;">
                                                <div class="card-body dash1">
                                                    <form class="d-inline" method="POST" action="{{ route('signup.third')}}">
                                                    @csrf
                                                    <input type="hidden" name="portal_id" value="3">
                                                    <button type="submit" class="btn">
                                                        <img data-toggle="modal" data-target="#portalHelpPopUp" src="{{ asset('dashlead/img/portal/fraek-dating.png')}}" alt="alt"/>
                                                    </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- 3-Freak Dating -->

                                    <!--Random User -->
                                        <!-- <div class="col-md-12 col-lg-12 col-xl-12">
                                            <div class="card custom-card" style="background:#e3ecfb;">
                                                <div class="card-body dash1">
                        
                                                </div>
                                            </div>
                                        </div> -->
                                    <!--Random User -->

                            </div>


                        </div>
                    </div>
                </div>
                    
            </div>
            <!-- End Row -->

        </div>
    </div>
     <!-- end pageContent area-->
    @endsection
<!-- Developed By CBS -->




