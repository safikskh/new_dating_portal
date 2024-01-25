<div class="item">
    <a href="#">
        <div class="avatar-link-online">
            <img src="{{asset($item->portalInfo->profilePicture)}}" class="center">
            <div v-for="user in allOnlineUserList">
                <div title="Online" v-if="user.userObj.id === {{$item->id}}" class=" slider-corner-finder">
                </div>
            </div>
        </div>
        <div class="profile-desc">
            <span class="user-name {{$item->portalInfo->userNameColor}}">{{$item->portalInfo->userName}}</span>
            <span>{{$item->portalInfo->humanTime}} - {{ $item->portalInfo->regionName}}</span>
            <div v-for="user in allOnlineUserList">
                <div data-toggle="tooltip" data-placement="top" title="Online" v-if="user.userObj.id === {{$item->id}}"
                    class="corner-finder-home-slider"></div>
            </div>
        </div>
    </a>
</div>