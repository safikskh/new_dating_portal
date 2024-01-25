@extends('layouts.layout')
@section('pageTitle', ' | Forside')
@section('content')
<div>
    <div class="row">

        <div class="col-lg-8">
            <div class="row">
                {{-- first section on user dashboard --}}
                @include('frontEnd.signup.dashboard.sectionOne')
                {{-- second section on user dashboard --}}
                @include('frontEnd.signup.dashboard.sectionTwo')
            </div>
        </div>
        {{-- promotion section --}}
        @include('frontEnd.signup.dashboard.promotion.promotionSection')
    </div>
</div>


<!-- portalSelectionModal -->
<div class="modal fade bd-example-modal-lg" id="portalSelectionModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Vælg portal</h5>
            </div>
            <div class="modal-body pro-la-icon" style="text-align: center;">
                <form class="d-inline" method="POST" action="{{ route('signup.submit.fbPortals')}}">
                    @csrf
                    <input type="hidden" name="portal_id" value="1">
                    <button type="submit" class="btn ">
                        <img src="{{ asset('/img/portal2/06.png')}}" alt="alt" />
                        {{-- Dating --}}
                    </button>
                </form>
                <form class="d-inline" method="POST" action="{{ route('signup.submit.fbPortals')}}">
                    @csrf
                    <input type="hidden" name="portal_id" value="3">
                    <button type="submit" class="btn ">
                        <img src="{{ asset('/img/portal2/03.png')}}" alt="alt" />
                        {{-- Fræk dating --}}
                    </button>
                </form>
                <form class="d-inline" method="POST" action="{{ route('signup.submit.fbPortals')}}">
                    @csrf
                    <input type="hidden" name="portal_id" value="2">
                    <button type="submit" class="btn ">
                        <img src="{{ asset('/img/portal2/02.png')}}" alt="alt" />
                        <!-- Sugar Dating -->
                    </button>
                </form>

                @foreach(getRandomUserBySex($sex) as $item)
                <form class="d-inline" action="">
                <button type="button" class="btn ">
                    <img src="{{asset($item->portalInfo->profilePicture)}}" class="signup-modal-img">
                    <p class="user-name {{$item->portalInfo->userNameColor}}">{{$item->portalInfo->userName}}</p>
                </button>
                </form>
                @endforeach
              
            </div>
        </div>
    </div>
</div>
@endsection

