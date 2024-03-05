@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Abonnementstype</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($plans as $plan)
                        <li class="list-group-item clearfix">
                            <div class="pull-left">
                                <h5>{{ $plan->name }}</h5>
                                <h5>{{ number_format($plan->cost, 2) }} kr.</h5>
                                <a href="{{ route('chatplan.show', $plan->slug) }}" class="btn btn-outline-dark pull-right">Vælg</a>
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
@endsection