@extends('layouts.layout') 
@section('pageTitle', ' | Profile') 
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="latest-news-bar-area">
            <div class="title-area">
                <h3>Nyeste profiler</h3>
            </div>
            <div class="row">
                @foreach ($latestList as $item)
                <div class="col-md-2 ">
                    <div class="thumbnail single-page-user-details" style="text-align: center;">
                        <a href="{{url('profile?user_id='.$item->id)}}" target="_blank">
                            <img class="single-page-img" src="{{ asset($item->profilePicture)}}" alt=""/>
                            <div class="caption">
                            <a data-placement="top" title="{{$item->portalInfo->userName}}" class="username {{$item->portalInfo->userNameColor}}" @if(auth()->user()->isPaid())
                                    href="{{url('profile?user_id='.$item->id)}}" @endif>
                                    {{str_limit($item->portalInfo->userName, $limit = 20, $end = '..')}}
                                </a> <br>
                                <span>{{$item->portalInfo->humanTime}}, {{$item->portalInfo->regionName}}</span>
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