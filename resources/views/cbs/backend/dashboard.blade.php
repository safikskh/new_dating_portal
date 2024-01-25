<!-- Developed By CBS -->
    @extends('cbs.backend.layouts.layout')
    @section('pageTitle', 'Dashboard')
    @push('style')
    @endpush
    @section('content')

                            <!-- Page Content-->
                                <div class="container-fluid">
                                    <!-- Page Header -->
                                        <div class="page-header"></div>
                                    <!-- End Page Header -->

                                    <!--End  Row -->
                                        <div class="row row-sm">
                                            <div class="col-sm-6 col-xl-3 col-lg-6">
                                                <div class="card custom-card">
                                                    <div class="card-body dash1">
                                                        <div class="d-flex">
                                                            <p class="mb-1 tx-success" style="font-weight: bold; text-transform: uppercase;">Active User</p>
                                                            <div class="ml-auto">
                                                                <i class="fas fa-user fs-20 text-success"></i>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h3 class="dash-25">{{ $user_stat['active'] }}</h3>
                                                        </div>
                                                        <div class="progress mb-1">
                                                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" class="progress-bar progress-bar-xs wd-100p bg-success" role="progressbar"></div>
                                                        </div>
                                                        <div class="expansion-label d-flex">
                                                            <span class="text-muted">All Active User</span>
                                                            <span class="ml-auto"><i class="far fa-clock mr-1 text-muted"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-3 col-lg-6">
                                                <div class="card custom-card">
                                                    <div class="card-body dash1">
                                                        <div class="d-flex">
                                                            <p class="mb-1 tx-primary" style="font-weight: bold; text-transform: uppercase;">Paid User</p>
                                                            <div class="ml-auto">
                                                                <i class="fas fa-user fs-20 text-primary"></i>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h3 class="dash-25">{{ $user_stat['paid'] }}</h3>
                                                        </div>
                                                        <div class="progress mb-1">
                                                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" class="progress-bar progress-bar-xs wd-100p bg-primary" role="progressbar"></div>
                                                        </div>
                                                        <div class="expansion-label d-flex">
                                                            <span class="text-muted">All Paid User</span>
                                                            <span class="ml-auto"><i class="far fa-clock mr-1 text-muted"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6 col-xl-3 col-lg-6">
                                                <div class="card custom-card">
                                                    <div class="card-body dash1">
                                                        <div class="d-flex">
                                                            <p class="mb-1 text-secondary" style="font-weight: bold; text-transform: uppercase;">Unpaid User</p>
                                                            <div class="ml-auto">
                                                                <i class="fas fa-user fs-20 text-secondary"></i>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h3 class="dash-25">{{ $user_stat['unpaid'] }}</h3>
                                                        </div>
                                                        <div class="progress mb-1">
                                                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" class="progress-bar progress-bar-xs wd-100p bg-secondary" role="progressbar"></div>
                                                        </div>
                                                        <div class="expansion-label d-flex text-muted">
                                                            <span class="text-muted">All Unpaid User</span>
                                                            <span class="ml-auto"><i class="far fa-clock mr-1 text-muted"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-3 col-lg-6">
                                                <div class="card custom-card">
                                                    <div class="card-body dash1">
                                                        <div class="d-flex">
                                                            <p class="mb-1 tx-danger" style="font-weight: bold; text-transform: uppercase;">Deactive User</p>
                                                            <div class="ml-auto">
                                                                <i class="fas fa-user fs-20 text-danger"></i>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h3 class="dash-25">{{ $user_stat['deactive'] }}</h3>
                                                        </div>
                                                        <div class="progress mb-1">
                                                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" class="progress-bar progress-bar-xs wd-100p bg-danger" role="progressbar"></div>
                                                        </div>
                                                        <div class="expansion-label d-flex text-muted">
                                                            <span class="text-muted">All Deactived User</span>
                                                            <span class="ml-auto"><i class="far fa-clock mr-1 text-muted"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!--End  Row -->

                                    <!-- 2nd Row -->
                                        <div class="row row-sm">
                                            <div class="col-sm-12 col-xl-8 col-lg-8">
                                                <div class="card custom-card overflow-hidden">
                                                    <div class="card-body">
                                                        <div class="card-option d-flex">
                                                            <div>
                                                                <h5 style="padding-bottom: 0px; font-weight: bold; text-transform: uppercase;" class="card-title"><span class="badge badge-light">Annual Income Chart</span></h5>
                                                            </div>
                                                            <div class="card-option-title ml-auto">
                                                                <div class="btn-group p-0">
                                                                    <h5 style="font-weight: bold; text-transform: uppercase;"><span class="badge badge-light"><i class="fa fa-random"></i> Current Year</span></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <canvas id="income"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xl-4 col-lg-4">
                                                 <div class="card custom-card">
                                                    <div class="card-body dash1">
                                                        <div class="d-flex">
                                                            <p class="mb-1 tx-info" style="font-weight: bold; text-transform: uppercase;">Monthly Income</p>
                                                            <div class="ml-auto">
                                                                <i class="fas fa-money-bill-alt fs-20 text-info"></i>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h3 class="dash-25">{{ number_format($income_stat['monthly'], 2) }} kr.</h3>
                                                        </div>
                                                        <div class="progress mb-1">
                                                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" class="progress-bar progress-bar-xs wd-100p bg-info" role="progressbar"></div>
                                                        </div>
                                                        <div class="expansion-label d-flex text-muted">
                                                            <span class="text-muted">Current Month</span>
                                                            <span class="ml-auto"><i class="far fa-clock mr-1 text-muted"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="card custom-card">
                                                    <div class="card-body dash1">
                                                        <div class="d-flex">
                                                            <p class="mb-1 tx-info" style="font-weight: bold; text-transform: uppercase;">Annual Income</p>
                                                            <div class="ml-auto">
                                                                <i class="fas fa-money-bill-alt fs-20 text-info"></i>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h3 class="dash-25">{{ number_format($income_stat['yearly'], 2) }} kr.</h3>
                                                        </div>
                                                        <div class="progress mb-1">
                                                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" class="progress-bar progress-bar-xs wd-100p bg-info" role="progressbar"></div>
                                                        </div>
                                                        <div class="expansion-label d-flex text-muted">
                                                            <span class="text-muted">Current Year</span>
                                                            <span class="ml-auto"><i class="far fa-clock mr-1 text-muted"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="card custom-card">
                                                    <div class="card-body dash1">
                                                        <div class="d-flex">
                                                            <p class="mb-1 tx-info" style="font-weight: bold; text-transform: uppercase;">Total Income</p>
                                                            <div class="ml-auto">
                                                                <i class="fas fa-money-bill-alt fs-20 text-info"></i>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h3 class="dash-25">{{ number_format($income_stat['total'], 2) }} kr.</h3>
                                                        </div>
                                                        <div class="progress mb-1">
                                                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" class="progress-bar progress-bar-xs wd-100p bg-info" role="progressbar"></div>
                                                        </div>
                                                        <div class="expansion-label d-flex text-muted">
                                                            <span class="text-muted">Life Time Income</span>
                                                            <span class="ml-auto"><i class="far fa-clock mr-1 text-muted"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- End 2nd Row -->

                                    <!-- 3rd Row -->
                                        <div class="row row-sm">
                                            <!-- Latest Paid User -->
                                                <div class="col-sm-12 col-xl-4 col-lg-4">
                                                    <div class="card custom-card">
                                                        <div class="card-body">
                                                            <div>
                                                                <h5 style="font-weight: bold; text-transform: uppercase;">
                                                                    <span class="badge badge-light" style="float:left;">Paid User's</span> 
                                                                    <span class="badge badge-light" style="float:right;"><i class="fa fa-random"></i> Latest 10</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="user-manager scroll-widget border-top">
                                                            <div class="table-responsive">
                                                                <table class="table mg-b-0">
                                                                    <tbody>
                                                                        @foreach ($latest_paid_user as $key => $lpu)
                                                                            <tr>
                                                                                <td class="bd-t-0">
                                                                                    @if(File::exists($lpu->image)) 
                                                                                        <div class="main-img-user"><img alt="avatar" src="{{asset($lpu->image)}}"></div>
                                                                                    @else
                                                                                        <div class="main-img-user"><img alt="avatar" src="{{ asset('dashlead/img/default/404-dp.png') }}"></div>
                                                                                    @endif
                                                                                </td>
                                                                                <td class="bd-t-0">
                                                                                    <h6 class="mg-b-0">{{ $lpu->firstname.' '.$lpu->lastname  }}</h6><small class="tx-11 tx-gray-500">{{ $lpu->email}}</small>
                                                                                </td>
                                                                                <td class="bd-t-0">
                                                                                    <h6 class="mg-b-0 font-weight-bold">User Join {{ date('d-m-Y', strtotime($lpu->join_date)) }}</h6><small class="tx-11 tx-gray-500">Membership Expire {{ date('d-m-Y', strtotime($lpu->membership_ends)) }}</small>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- Latest Paid User -->

                                            <!-- Latest Unpaid/Free User -->
                                                <div class="col-sm-12 col-xl-4 col-lg-4">
                                                    <div class="card custom-card">
                                                        <div class="card-body">
                                                            <div>
                                                                <h5 style="font-weight: bold; text-transform: uppercase;">
                                                                    <span class="badge badge-light" style="float:left;">Unpaid/Free User's</span> 
                                                                    <span class="badge badge-light" style="float:right;"><i class="fa fa-random"></i> Latest 10</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="user-manager scroll-widget border-top">
                                                            <div class="table-responsive">
                                                                <table class="table mg-b-0">
                                                                    <tbody>
                                                                        @foreach ($latest_unpaid_user as $key => $luu)
                                                                            <tr>
                                                                                <td class="bd-t-0">
                                                                                    @if(File::exists($luu->image)) 
                                                                                        <div class="main-img-user"><img alt="avatar" src="{{asset($luu->image)}}"></div>
                                                                                    @else
                                                                                        <div class="main-img-user"><img alt="avatar" src="{{ asset('dashlead/img/default/404-dp.png') }}"></div>
                                                                                    @endif
                                                                                </td>
                                                                                <td class="bd-t-0">
                                                                                    <h6 class="mg-b-0">{{ $luu->firstname.' '.$luu->lastname  }}</h6><small class="tx-11 tx-gray-500">{{ $luu->email}}</small>
                                                                                </td>
                                                                                <td class="bd-t-0">
                                                                                    <h6 class="mg-b-0 font-weight-bold">User Join {{ date('d-m-Y', strtotime($luu->join_date)) }}</h6><small class="tx-11 tx-gray-500">Membership Expire {{ date('d-m-Y', strtotime($luu->membership_ends)) }}</small>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- Latest Unpaid/Free User -->

                                            <!-- Expire Soon User -->
                                                <div class="col-sm-12 col-xl-4 col-lg-4">
                                                    <div class="card custom-card">
                                                        <div class="card-body">
                                                            <div>
                                                                <h5 style="font-weight: bold; text-transform: uppercase;">
                                                                    <span class="badge badge-light" style="float:left;">Expire Soon</span> 
                                                                    <span class="badge badge-light" style="float:right;"><i class="fa fa-random"></i> Recent 10</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="user-manager scroll-widget border-top">
                                                            <div class="table-responsive">
                                                                <table class="table mg-b-0">
                                                                    <tbody>
                                                                        @foreach ($expire_soon_user as $key => $esu)
                                                                            <tr>
                                                                                <td class="bd-t-0">
                                                                                    @if(File::exists($esu->image)) 
                                                                                        <div class="main-img-user"><img alt="avatar" src="{{asset($esu->image)}}"></div>
                                                                                    @else
                                                                                        <div class="main-img-user"><img alt="avatar" src="{{ asset('dashlead/img/default/404-dp.png') }}"></div>
                                                                                    @endif
                                                                                </td>
                                                                                <td class="bd-t-0">
                                                                                    <h6 class="mg-b-0">{{ $esu->firstname.' '.$esu->lastname  }}</h6><small class="tx-11 tx-gray-500">{{ $esu->email}}</small>
                                                                                </td>
                                                                                <td class="bd-t-0">
                                                                                    <h6 class="mg-b-0 font-weight-bold">{{ $esu->membership_name}}</h6><small class="tx-11 tx-gray-500">Expire {{ date('d-m-Y', strtotime($esu->membership_ends)) }}</small>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- Expire Soon User -->

                                        </div>
                                    <!-- End 3rd Row -->

                                    <!-- 4th Row-->
                                        <div class="row">
                                            <!-- Latest Subscriptions -->
                                                <div class="col-sm-12 col-xl-12 col-lg-12">
                                                    <div class="card custom-card">
                                                        <div class="card-body">
                                                            <div>
                                                                <h5 style="padding-bottom: 25px; font-weight: bold; text-transform: uppercase;">
                                                                    <span class="badge badge-light" style="float:left;">Subscriptions</span> 
                                                                    <span class="badge badge-light" style="float:right;"><i class="fa fa-random"></i> Latest 10</span>
                                                                </h5>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered text-nowrap mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="text-align:center">#</th>
                                                                            <th>Date</th>
                                                                            <th>User</th>
                                                                            <th>Plan</th>
                                                                            <th style="text-align:center">Stripe ID</th>
                                                                            <th style="text-align:center">Quantity</th>
                                                                            <th style="text-align:center">Amount</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($subscriptions as $key => $sub)
                                                                            <tr>
                                                                                <td style="text-align:center">{{ $key+1 }}</td>
                                                                                <td>{{ date('d-m-Y, h:i A', strtotime($sub->updated_at)) }}</td>
                                                                                <td>{{ $sub->firstname.' '.$sub->lastname  }}</td>
                                                                                @if ($sub->stripe_plan == 'monthly')
                                                                                    <td>Månedsmedlemskab - {{App\Models\Portal::find($sub->name)->portalType}}</td>
                                                                                @elseif($sub->stripe_plan == 'weekly')
                                                                                    <td>Ugemedlemskab - {{App\Models\Portal::find($sub->name)->portalType}}</td>
                                                                                @elseif($sub->stripe_plan == 'weekends')
                                                                                    <td>Weekendmedlemskab - {{App\Models\Portal::find($sub->name)->portalType}}</td>
                                                                                @elseif($sub->stripe_plan == '24hr')
                                                                                    <td>Dagsmedlemskab - {{App\Models\Portal::find($sub->name)->portalType}}</td>
                                                                                @else
                                                                                    <td>{{ucwords(App\Models\Membership::where('stripe_plan',$sub->stripe_plan)->first()->name)}} - {{App\Models\Portal::find($sub->name)->portalType}}</td>
                                                                                @endif
                                                                                <td style="text-align:center"><span class="badge badge-success">{{ $sub->stripe_id }}</span></td>
                                                                                <td style="text-align:center">{{ $sub->quantity }}</td>
                                                                                <td style="text-align:center"><span class="badge badge-light">{{App\Models\Membership::where('stripe_plan',$sub->stripe_plan)->first()->cost}} kr.</span></td>
                                                                            </tr>
                                                                        @endforeach
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- Latest Subscriptions -->
                                        </div>
                                    <!-- End 4th Row -->
                                </div>
                            <!-- Page Content-->

    @endsection
    @push('script')

      
            <script type="text/javascript" language="javascript" >

        
                    /* chartjs (#income) */
                        var myCanvas = document.getElementById("income");
                        myCanvas.height = "370";
                        
                        var myCanvasContext = myCanvas.getContext("2d");
                        var gradientStroke1 = myCanvasContext.createLinearGradient(0, 80, 0, 280);
                        gradientStroke1.addColorStop(0, 'rgba(85, 56, 171, 0.8)');
                        gradientStroke1.addColorStop(1, 'rgba(85, 56, 171, 0.2) ');
                        
                        var gradientStroke2 = myCanvasContext.createLinearGradient(0, 80, 0, 280);
                        gradientStroke2.addColorStop(0, 'rgba(1, 184, 255, 0.8)');
                        gradientStroke2.addColorStop(1, 'rgba(1, 184, 255, 0.2) ');

                        var url = "{{ route('admin.dashboard.chart') }}";
                        var Month = new Array();
                        var Income = new Array();

                        $(document).ready(function(){

                            $.get(url, function(response){
                            response.forEach(function(data){
                                Month.push(data.month);
                                Income.push(data.income);
                            });

                            var myChart = new Chart( myCanvas, {
                                type: 'line',
                                data: {
                                    // labels: ["Jan","Feb","Mar", "Apr", "May", "June","July", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                    labels: Month,
                                    type: 'line',
                                    datasets: [ {
                                        label: 'Monthly Income (kr)',
                                        // data: [61, 27, 54, 143, 119, 46,47, 45, 54, 138, 56, 24, 165, 31, 37, 39, 62, 51, 35, 41],
                                        data: Income,
                                        backgroundColor: gradientStroke2,
                                        borderColor: '#01b8ff',
                                        pointBackgroundColor:'#fff',
                                        pointHoverBackgroundColor:gradientStroke2,
                                        pointBorderColor :'#01b8ff',
                                        pointHoverBorderColor :gradientStroke2,
                                        pointBorderWidth :0,
                                        pointRadius :0,
                                        pointHoverRadius :0,
                                        lineTension: 0.2,
                                        borderWidth: 2,
                                            fill: 'origin'
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    tooltips: {
                                        mode: 'index',
                                        titleFontSize: 12,
                                        titleFontColor: '#000',
                                        bodyFontColor: '#000',
                                        backgroundColor: '#fff',
                                        cornerRadius: 3,
                                        intersect: false,
                                    },
                                    stepsize: 200,
                                        min: 0,
                                        max: 400,
                                    legend: {
                                        display: true,
                                        labels: {
                                            usePointStyle: false,
                                        },
                                    },
                                    scales: {
                                        xAxes: [{
                                            
                                            display: true,

                                            gridLines: {
                                                display: true,
                                                drawBorder: false,
                                                color:'rgba(119, 119, 142, 0.08)'
                                            },
                                            ticks: {
                                                    fontColor: '#b0bac9',
                                                    autoSkip: true,
                                                    maxTicksLimit: 9,
                                                    maxRotation: 0,
                                                    labelOffset: 10
                                                },
                                            scaleLabel: {
                                                display: false,
                                                labelString: 'Month',
                                                fontColor: 'transparent'
                                            }
                                        }],
                                        yAxes: [{
                                            ticks: {
                                                fontColor: "#b0bac9",
                                            },
                                            display: true,
                                            gridLines: {
                                                display: true,
                                                drawBorder: false,
                                                color:'rgba(119, 119, 142, 0.08)'
                                            },
                                            scaleLabel: {
                                                display: false,
                                                labelString: 'income',
                                                fontColor: 'transparent'
                                            }
                                        }]
                                    },
                                    title: {
                                        display:false,
                                        text: 'Normal Legend'
                                    }
                                }
                            });

                        });
                    /* chartjs (#income) closed */
        
                    /* Table Scroll*/
                        $(".scroll-widget").mCustomScrollbar({
                            theme: "minimal",
                            autoHideScrollbar: true,
                            scrollbarPosition: "outside"
                        });
                    /* Table Scroll*/

                });
            </script>
  

    @endpush
<!-- Developed By CBS -->