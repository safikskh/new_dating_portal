<div data-toggle="modal" data-target="#showPromotionModal" class="messages-profile-image">
            @if(File::exists($item->image)) 
               <img src="{{asset($item->image)}}"  style="width:200px;height:200px;">
            @else
                <img src="{{ asset('img/logo.png') }}" style="width:200px;height:200px;">
            @endif
    <div class="messages-profile-header">
        <div onclick="openPromotionImage('{{$item->image}}','{{ $item->promotionTitle}}')" class="content">
            <p>{{$item->promotionTitle}}</p>
            <a href="{{url('profile?user_id='.$item->user_id)}}"
                class="promotion-username {{$item->user->portalInfo->userNameColor}}">
                {{$item->user->portalInfo->userName}}, {{$item->user->portalInfo->humanTime}}, 
                {{$item->user->portalInfo->regionName}}
            </a>
        </div>
    </div>
</div>
