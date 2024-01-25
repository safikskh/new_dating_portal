@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Abonnementstype</div>
                <div class="row">
                    <div class="col">
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($plans->slice(0, 3) as $plan)
                                    @include('frontEnd.memberships.switchPortal.plan')
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($plans->slice(3, 3) as $plan)
                                    @include('frontEnd.memberships.switchPortal.plan')
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($plans->slice(6, 3) as $plan)
                                    @include('frontEnd.memberships.switchPortal.plan')
                                @endforeach
                            </ul>
                        </div>
                        @if (! session()->has('coupon'))
                        <div class="container">
                            <label>Har du en rabatkode?</label>
                            <form action="{{ route('portal_coupon.store') }}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <input required name="coupon_code" id="coupon_code" type="text" class="form-control"
                                        placeholder="Indtast kode" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                   
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
@endsection