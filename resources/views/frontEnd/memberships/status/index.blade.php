@extends('layouts.app')
@section('pageTitle', 'Abonnementstype')
@section('content')
<!-- Main Content-->
    <div class="main-content pt-0"> 
        <div class="container">
            <!-- Page Header -->
                <div class="page-header"></div>
            <!-- End Page Header -->
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card custom-card">
                        <div class="card-header" style="margin-bottom: 10px;">
                            <h5 class="card-title mb-1" style="font-weight: bold; text-transform:uppercase;">Abonnementstype</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($plans as $plan)
                                <li class="list-group-item clearfix">
                                    <div class="pull-left">
                                        <h5>{{ $plan->name }}</h5>
                                        <h5>{{ number_format($plan->cost, 2) }} kr. for 24 timer</h5>
                                        <h5>{{ $plan->description }}</h5>
                                            <a href="{{ route('statusplan.show', $plan->slug) }}" class="btn btn-outline-dark pull-right">Vælg</a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="container text-center">
                            <p>Fortrydelsesret: <br>
                                Dit køb er ikke omfattet af fortrydelsesret, i det varen leveres straks ved betaling. <br>
                                For yderligere information, se §18, stk. 2, litra 13 i forbrugeraftaleloven.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End Main Content-->
@endsection