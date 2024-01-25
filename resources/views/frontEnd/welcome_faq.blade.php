@extends('layouts.app') 
@section('content')
<div class="container">
    @include('layouts.faq')
</div>
<!-- show prices Modal -->
<div class="modal fade bd-example-modal-lg" id="showPricesModal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Abonnementstype</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('img/icon/cancel.svg')}}" alt="" srcset="">
                </button>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @include('layouts.pricessModalContent')
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection