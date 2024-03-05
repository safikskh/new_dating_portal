<!-- Developed By CBS -->
    @extends('dashlead.layouts.layout')
    @section('pageTitle', 'Betalingshistorik')

    @push('style')
        <!---DataTables css-->
        <link href="{{ asset('dashlead/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dashlead/plugins/datatable/responsivebootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dashlead/plugins/datatable/fileexport/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

    @section('content')
            <!-- Main Content-->
                <div class="main-content pt-0">
                    <div class="container">

                    <!-- Page Header -->
                    <div class="page-header">
                        </div>
                    <!-- End Page Header -->

                    <!-- Row -->
                        <div class="row">

                            <!-- Setting Sidebar -->
                                @include('frontEnd.settings.leftSidebar')
                            <!-- Setting Sidebar -->

                            <!-- Setting Body Part -->
                                <div class="col-lg-8 col-md-12">

                                    <!-- Card Info -->
                                        <div class="card custom-card">
                                            <div class="card-body">

                                                <div>
                                                    <h6 class="card-title mb-1">Kort Information</h6><hr>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    @if (auth()->user()->hasCardOnFile())
                                                    <h5> Dit gemte korts sidste 4 cifre er {{auth()->user()->defaultCard()->last4}}.</h5>                  
                                                    @else
                                                    <h5>Intet gemt kort fundet, tryk opdatér for at tilføje et nyt kort.</h5>                  
                                                    @endif
                                                    <div align="left">
                                                        <a href="card_update" class="btn ripple btn-success" type="button" style="color:white; font-weight: bold;text-transform: uppercase;">Tilføj Kort</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- Card Info -->

                                    <!-- Trx Table -->
                                        <div class="card custom-card">
                                            <div class="card-body">

                                                <div>
                                                    <h6 class="card-title mb-1">Deaktiver Min Profil</h6><hr>
                                                </div>


                                                <div class="table-responsive">
                                                    <table class="table" id="example1">
                                                        <thead>
                                                            <tr style="font-weight: bold;">
                                                                <th class="text-center wd-5p">#</th>
                                                                <th class="text-center wd-20p">Dato</th>
                                                                <th class="text-center wd-35p">Transkation</th>
                                                                <th class="text-right wd-10p">Beløb</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($subscriptions as $key => $item)

                                                                <tr>
                                                                    <td style="font-weight: bold;" class="text-center">{{ $key+1}}</td>
                                                                    <td>{{date('d F Y', strtotime($item->updated_at))}}</td>
                                                                    @if ($item->stripe_plan == 'monthly')
                                                                        <td>Månedsmedlemskab - {{App\Models\Portal::find($item->name)->portalType}}</td>
                                                                    @elseif($item->stripe_plan == 'weekly')
                                                                        <td>Ugemedlemskab - {{App\Models\Portal::find($item->name)->portalType}}</td>
                                                                    @elseif($item->stripe_plan == 'weekends')
                                                                        <td>Weekendmedlemskab - {{App\Models\Portal::find($item->name)->portalType}}</td>
                                                                    @elseif($item->stripe_plan == '24hr')
                                                                        <td>Dagsmedlemskab - {{App\Models\Portal::find($item->name)->portalType}}</td>
                                                                    @else
                                                                        <td>{{ucwords(App\Models\Membership::where('stripe_plan',$item->stripe_plan)->first()->name)}} - {{App\Models\Portal::find($item->name)->portalType}}</td>
                                                                    @endif
                                                                    <td style="font-weight: bold;" class="text-right">{{App\Models\Membership::where('stripe_plan',$item->stripe_plan)->first()->cost}} kr.</td>
                                                                </tr>

                                                            @endforeach 
                                                        </tbody>
                                                    </table>
                                                </div>


                                            </div>
                                        </div>
                                    <!-- Trx Table -->

                                    
                                </div>
                            <!-- Setting Body Part -->

                        </div>
                    <!-- End Row -->

                    </div>
                </div>
            <!-- End Main Content-->
    @endsection

    @push('script')        
        <!-- Data Table js -->
        <script src="{{ asset('dashlead/plugins/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('dashlead/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('dashlead/js/table-data.js') }}"></script>
        <script src="{{ asset('dashlead/plugins/datatable/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('dashlead/plugins/datatable/fileexport/dataTables.buttons.min.js') }}"></script>
    @endpush
<!-- Developed By CBS -->