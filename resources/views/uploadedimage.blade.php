@extends('layouts.layout')
@section('pageTitle', ' | Billeder')
@section('content')
<!-- pageContent area-->
<div class="row">
  <div class="col-lg-12">
    <div class="gallery">
      @if(auth()->user()->isPaid())
        @if(sizeof($data)>0)
          @foreach($data as $d)
            <div onclick="openGalleryImage('{{$d->file}}')">
              <img   data-toggle="modal" data-target="#imageGalleryModal" class="gal-img camview " src="{{asset('/'.$d->file)}}"  alt="">
              <div class="gallery_creator_details">
                <a class="username {{$d->user->portalInfo->userNameColor}}" href="{{url('profile?user_id='.$d->user->id)}}">
                  {{$d->user->portalInfo->userName}}
                </a>
                <span>{{App\Models\Events::getAge($d->user->portalInfo->dob,date('Y-m-d'))}}, {{App\Models\Events::getLocation($d->user->portalInfo->region_id)}}</span>
              </div>
            </div>
          @endforeach 
        @else
          Der er ingen billeder
      @endif
      <div class="gallery-pagination">
        {{$data->links() }}   
      </div>
      @else
        Kun et betalt medlem kan se billeder
      @endif
    </div>
  </div>
</div>
<!-- end pageContent area-->
@endsection
 
@section('script')
@endsection