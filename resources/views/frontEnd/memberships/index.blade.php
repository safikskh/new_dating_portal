@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Abonnementstype</div>
                <div class="card-body">
                    <ul class="list-group">
                        <div class="row">
                            <div class="col">
                                @foreach($plans->slice(0, 3) as $plan)
                                   @include('frontEnd.memberships.plan')
                                @endforeach
                            </div>
                            <div class="col">
                                @foreach($plans->slice(3, 2) as $plan)
                                   @include('frontEnd.memberships.plan')
                                @endforeach
                            </div>
                            <div class="col">
                                @foreach($plans->slice(5, 3) as $plan)
                                    @include('frontEnd.memberships.plan')
                                @endforeach
                            </div>
                            <div class="container text-center">
                                <p>Fortrydelsesret: <br>
                                    Dit køb er ikke omfattet af fortrydelsesret, i det varen leveres straks ved betaling. <br>
                                    For yderligere information, se §18, stk. 2, litra 13 i forbrugeraftaleloven.</p>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection