@extends('layouts.app_old')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Abonnementstype</div>
                <div class="row">
                
                    <div class="col">
                        @include('frontEnd.memberships.signup.plansItem',['plans' => $plans->slice(0,2)])
                    </div>
                    <div class="col">
                        @include('frontEnd.memberships.signup.plansItem',['plans' => $plans->slice(2,2)])
                       
                    </div>
                    <div class="col">
                        @include('frontEnd.memberships.signup.plansItem',['plans' => $plans->slice(4,2)])
                    </div>
                    <div class="container text-center">
                        <div class="form-check" id="aggrement-section">
                            <input id="aggrement-checkbox" type="checkbox" class="form-check-input" id="exampleCheck1" required>
                            <label class="form-check-label" for="exampleCheck1">Accepter <a target="_blank" href="/terms_of_services">handelsbetingelser</a></label>
                        </div>
                    </div>
                    
                </div>
                
                @if (! session()->has('coupon'))
                <div class="container">
                    <label>Har du en rabatkode?</label>
                    <form action="{{ route('coupon.store') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3 coupon-section">
                            <input required name="coupon_code" id="coupon_code" type="text" class="form-control" placeholder="Indtast kode"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                           
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-secondary" type="button">Vælg</button>
                            </div>
                            @if ($message = Session::get('error'))
                            <span class=" text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @endif
                        </div>
                    </form>
                </div>
                @endif
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