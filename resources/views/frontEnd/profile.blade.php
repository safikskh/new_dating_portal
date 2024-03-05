@extends('layouts.layout')
<title>Datingportalen | {{Auth::user()->portalInfo->userName}}</title>
{{-- @section('pageTitle', ' | Min profil') --}}
@section('content')

    <div class="row">
        <div class="col-lg-8">
            @if(auth()->user()->portalInfo->sex == App\Enums\Sex::getValue('Par'))
            @include('layouts.coupleInfo.myCouple')
            @else
            <div class="profile-header-detail-area">
                @include('layouts.profileInfo',['profileItem' => auth()->user()->portalInfo])
            </div>
            @endif
            <div class="profile-header-detail-area latest-single-messages-profile">
                <form action="#" method="post">
                    @csrf
                    <div class="content">
                        <div class="form-group">
                            <div id="status"></div>
                            <textarea class="form-control" name="profileDetails" id="commentBox"
                                      rows="3">{{Auth::user()->getPortalDetail(Auth::id(),Auth::user()->getPortal(Auth::user()->portalJoinUser_id))}}</textarea>
                        </div>
                    </div>
                    <button type="button" class="btn-radiaus" style="padding:12px 31px;">Gem</button>
                </form>
            </div>

            <div class="main-glarry-area ">
                <div class="profile-setting-area {{auth()->user()->chatSidebarColor}}">
                    <div class="profile-setting-single" onclick="galleryTabSwitcher(event, 'one')" id="defaultOpen">
                        <a class="tablinkspro" ><span>Billeder</span></a>
                    </div>
                    <div class="profile-setting-single" onclick="galleryTabSwitcher(event, 'two')">
                        <a class="tablinkspro" ><span>Video</span></a>
                    </div>
                </div>
                <div class="glarry-content-are-tab">
                    <div id="one" class="tabcontent">
                        <div id="aniimated-thumbnials">
                            @if(App\Models\FileUpload::where([['user_id', Auth::id()],['file_type',0],['user_type', Auth::user()->portalInfo->portal_id]])->count() > 0) 
                                @foreach(App\Models\FileUpload::where([['user_id', Auth::id()],['file_type',0],['user_type', Auth::user()->portalInfo->portal_id]])->get() as $item)
                                    <a onclick="openProfileGalleryImageMy('{{$item->file}}')" class="profile-image" >
                                        <img data-toggle="modal" data-target="#showMyProfileImageModal" src="{{asset($item->file)}}"/>
                                        <form action="#" method="post">
                                            @csrf
                                            <input type="hidden" name="id" id="imageId" value="{{$item->id}}">
                                            <div class="hover-image">
                                                <button id="deleteImage" type="submit"><i class="fa fa-remove"></i></button>
                                            </div>
                                        </form>
                                    </a> 
                                @endforeach 
                                
                            @endif
                           
                        </div>
                        
                    </div>

                    <div id="two" class="tabcontent">
                        <div class="demo-gallery">
                            <ul>
                                @if(App\Models\FileUpload::where([['user_id', Auth::id()],['file_type',1],['user_type', Auth::user()->portalInfo->portal_id]])->count() > 0)
                                 @foreach(App\Models\FileUpload::where([['user_id', Auth::id()],['file_type',1],['user_type', Auth::user()->portalInfo->portal_id]])->get() as $item)
                                <li class="profile-video">
                                    <video width="170" height="100" controls>
                                        <source src="{{asset($item->file)}}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <form action="#" method="post">
                                        @csrf
                                        <input type="hidden" name="id" id="imageId" value="{{$item->id}}">
                                        <div class="hover-video">
                                            <button  type="submit"><i class="fa fa-remove"></i></button>
                                        </div>
                                    </form>
                                      
                                </li>
                                @endforeach @endif
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        @include('layouts.promotationsectionsip')
    </div>
@endsection


