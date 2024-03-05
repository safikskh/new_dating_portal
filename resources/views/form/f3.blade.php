<!-- Developed By CBS -->
    @extends('dashlead.layouts.signup_layout') 
    @section('pageTitle', 'Trin 3')
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
                                <h5 class="card-title mb-1" style="font-weight:bold; text-transform:uppercase;">Tilmelding : Trin 3</h5><hr>
                            </div>
                            <form class="d-inline" method="POST" action="{{ route('signup.fort')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <input title="Upload Dit Billede" type="file" class="dropify" id="profileImageUpload" accept=".png, .jpg, .jpeg" data-max-file-size="5M" data-height="130" data-width="250" name="profilePicture" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-8 col-xl-8">
                                        <div class="form-group">
                                            <label>Profil Beskrivelse <span style="color:red">*</span></label>
                                            <textarea type="textarea" rows="4" placeholder="Skriv Noget..." class="form-control" name="profile_detail" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <button style="font-weight: bold;text-transform: uppercase;" class="btn ripple btn-main-primary btn-block">Gem</button>
                                    </div>
                                </div>
                            </form>


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




