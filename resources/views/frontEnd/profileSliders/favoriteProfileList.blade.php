@extends('layouts.layout') 
@section('pageTitle', ' | Profile') 
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="latest-news-bar-area">
            <div class="title-area">
                <h3>Favoritter</h3>
            </div>
            <div class="row">
                @foreach ($favouritieList as $item)
                <div class="col-md-2">
                    <div class="thumbnail single-page-user-details" style="text-align: center;">
                        <a href="{{url('profile?user_id='.$item->userFavourite->id)}}" target="_blank">
                            <img class="single-page-img" src="{{asset($item->userFavourite->profilePicture)}}" alt="" />
                            <div class="caption">
                                <a data-placement="top" title="{{$item->userFavourite->portalInfo->userName}}"
                                    class="username {{$item->userFavourite->portalInfo->userNameColor}}" @if(auth()->user()->isPaid())
                                    href="{{url('profile?user_id='.$item->userFavourite->id)}}" @endif>
                                    {{str_limit($item->userFavourite->portalInfo->userName, $limit = 20, $end = '..')}}
                                </a> <br>
                                <span>{{$item->userFavourite->portalInfo->humanTime}},
                                    {{$item->userFavourite->portalInfo->regionName}}</span>
                            </div>
                        </a>
                    </div>
                </div>
               
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection