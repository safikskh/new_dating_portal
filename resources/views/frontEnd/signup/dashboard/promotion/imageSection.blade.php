<div data-toggle="modal" data-target="#showPromotionModal" class="messages-profile-image">
    <img src="{{ asset($item->image)}}" alt="" />
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
