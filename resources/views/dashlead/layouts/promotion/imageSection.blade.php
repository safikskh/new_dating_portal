<!-- Developed By CBS -->
    <!-- Paid Promo Section -->
        <div class="item">
            <a  href="{{url('profile?user_id='.$item->user_id)}}">
                    @if($item->user->portalInfo->sex == 'Par')
                        <div class="card" style="background:#eeffeb;">
                    @else
                        <div class="card {{$item->user->portalInfo->userNameColor}}">
                    @endif
                        <p style="text-center; margin:10px; font-weight: bold;">{{  str_limit($item->promotionTitle, 160) }}</p>
                        <img class="card-img-top" src="{{asset($item->image)}}" alt="Card image" style="width:100%">
                        <div class="card-body" style="padding:0px;">
                            <div class="row">
                                <div class="col-4" style="padding:15px 0px 0px 20px;">
                                    @if($item->user->portalInfo->sex == 'Par')
                                        @if(File::exists($item->user->portalInfo->coupleFemale()->profilePicture)) 
                                            <img src="{{asset($item->user->portalInfo->coupleFemale()->profilePicture)}}" style="width:40px; height:40px; border-radius: 50%;">
                                        @else
                                            <img src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle" style="width:40px; height:40px; border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;">
                                        @endif
                                    @else
                                        @if(File::exists($item->user->portalInfo->profilePicture)) 
                                            <img src="{{asset($item->user->portalInfo->profilePicture)}}" style="width:40px; height:40px; border-radius: 50%;">
                                        @else
                                            <img src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle" style="width:40px; height:40px; border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center;">
                                        @endif
                                    @endif
                                </div>
                                <div  class="col-8 text-left" style="padding:15px 0px 0px 0px;">
                                    <p>
                                        <span style="font-weight: bold; text-transform:uppercase;">{{  str_limit($item->user->portalInfo->userName, 30) }} - {{$item->user->portalInfo->humanTime}} Y</span><br>
                                        <span style="font-weight: bold; text-transform:uppercase;">{{  str_limit($item->user->portalInfo->regionName, 30) }}</span><br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

            </a>
        </div>
    <!-- Paid Promo Section -->
<!-- Developed By CBS -->