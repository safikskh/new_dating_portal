<!-- Developed By CBS -->
@if($item->portalInfo->sex == 'Par') 
    <div class="item">
        <a  href="{{url('profile?user_id='.$item->id)}}">
            <div class="card" style="background:#eeffeb;">
                <div class="card-body main-profile-overview widget-user-image text-center">
                        {{-- <div style="overflow: hidden;justify-content:space-around;"> --}}
                            <div style="max-width: 27%;max-height: 27%;display: inline-block;">
                                @if(File::exists($item->portalInfo->coupleMale()->profilePicture)) 
                                    <img src="{{asset($item->portalInfo->coupleMale()->profilePicture)}}" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;">
                                @else
                                    <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle">
                                @endif
                            </div>
                            <div style="max-width: 27%;max-height: 27%;display: inline-block;">
                                @if(File::exists($item->portalInfo->coupleFemale()->profilePicture)) 
                                    <img src="{{asset($item->portalInfo->coupleFemale()->profilePicture)}}" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;">
                                @else
                                    <img style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; margin:5px;" src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle">
                                @endif
                            </div>
                        {{-- </div> --}}
                    <div  class="mt-2" style="padding-top: 12px;">
                        <p class="mb-1"><span style="font-weight: bold;" class="badge badge-primary">{{  str_limit($item->portalInfo->userName, 30) }}</span></p>
                        <span class="text-muted">{{  str_limit($item->portalInfo->regionName, 25) }}</span><br>
                        <span class="text-muted">Age {{  $item->portalInfo->humanTime }}</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
@else
    <div class="item">
        <a  href="{{url('profile?user_id='.$item->id)}}">
            <div class="card {{$item->portalInfo->userNameColor}}">
                <div class="card-body user-card text-center">
                    <div class="main-img-user avatar-lg online text-center">
                        @if(File::exists($item->portalInfo->profilePicture)) 
                            <img src="{{asset($item->portalInfo->profilePicture)}}" class="rounded-circle" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;">
                        @else
                            <img src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;">
                        @endif
                    </div>
                    <div  class="mt-2" style="padding-top: 12px;">
                        {{-- <p class="mb-1"><span style="font-weight: bold;" class="badge badge-primary">{{  str_limit($item->portalInfo->userName, 30) }}</span></p>
                        <span class="text-muted">{{  str_limit($item->portalInfo->regionName, 25) }}</span><br> --}}
                        <span class="text-muted">Age {{  $item->portalInfo->humanTime }}</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endif
<!-- Developed By CBS -->