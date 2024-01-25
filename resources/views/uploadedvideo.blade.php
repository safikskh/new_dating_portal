@extends('layouts.layout')
@section('pageTitle', ' | Videoer')
@section('content')

<!-- pageContent area-->
<div class="row">
  <div class="col-lg-12">

    <div class="video-gallery">
      <ul>

        @if(auth()->user()->isPaid())
          @if(sizeof($data)>0)
            @foreach($data as $key=>$d)

            <li>
              <video width="300" height="150" controls>
                <source src="{{asset('/'.$d->file)}}" type="video/mp4">
                <source src="{{asset('/'.$d->file)}}" type="video/ogg">
                <source src="{{asset('/'.$d->file)}}" type="video/webm">
                <source src="{{asset('/'.$d->file)}}" type="video/3gp">
                Your browser does not support the video tag.
              </video>
              <div class="gallery_creator_details">
              <a class="username {{$d->user->portalInfo->userNameColor}}" href="{{url('profile?user_id='.$d->user->id)}}">
                {{$d->user->portalInfo->userName}}
              </a>
              <span>{{App\Models\Events::getAge($d->user->portalInfo->dob,date('Y-m-d'))}}, {{App\Models\Events::getLocation($d->user->portalInfo->region_id)}}</span>
            </div>
            </li>
            @endforeach 
          @endif
        @else
        Kun et betalt medlem kan se videoer
        @endif
      </ul>
    </div>
    <div class="gallery-pagination">
          {{$data->links() }}
    </div>

  </div>
</div>

<!-- end pageContent area-->
@endsection

@section('script')
@endsection
