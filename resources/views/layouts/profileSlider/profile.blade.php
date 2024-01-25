<div class="item">
    <a  href="{{url('profile?user_id='.$item->id)}}">
        <div class="avatar-link-online">

            @if(File::exists($item->portalInfo->profilePicture)) 
               <img src="{{asset($item->portalInfo->profilePicture)}}" class="center">
            @else
                <img src="{{ asset('img/logo.png') }}" class="center">
             @endif

            <div v-for="user in allOnlineUserList">
                <div title="Online" v-if="user.userObj.id === {{$item->id}}" class=" slider-corner-finder">
                </div>
            </div>
        </div>
        <div class="profile-desc">
            <span class="user-name {{$item->portalInfo->userNameColor}}">{{$item->portalInfo->userName}}</span>
            <span>{{$item->portalInfo->humanTime}} - {{ $item->portalInfo->regionName}}</span>
        </div>
    </a>
</div>