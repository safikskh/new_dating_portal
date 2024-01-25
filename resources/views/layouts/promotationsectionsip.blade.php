<div class="col-lg-4 ">

    @include('layouts.promotion.promotion')
    {{-- user rating section --}}
    <div class="profile-header-detail-area latest-single-messages-profile">
        <div class="div-title">
            <h3>Rating</h3>
        </div>
        <div class="messages-profile-header-area">
                @foreach(range(1,5) as $i) 
                    @if($ratings > 0) 
                        @if($ratings >= 1)
                            <i class="fa fa-star fa-lg" aria-hidden="true" style="color: #f87d53"></i>
                        @else
                            <i class="fa fa-star-half-o fa-lg" aria-hidden="true" style="color: #f87d53"></i> 
                        @endif 
                    @else
                        <i class="fa  fa-star-o fa-lg" aria-hidden="true"></i> 
                    @endif
                    <?php $ratings --; ?> 
                @endforeach 
                @if($rate != 0) &nbsp;
                <div class="self-rating">
                    <h5><span style="color: #f87d53">{{ $rate }}</span>&nbsp; {{ 'ud af 5' }}</h5>
                    <h5><span style="color: #f87d53">{{ $viewers }}</span>&nbsp; brugere</h5>

                </div>
                @else &nbsp;
                <div class="self-rating">
                    <h5><span style="color: #38c172">0</span>&nbsp; ud af 5</h5>
                    <h5><span style="color: #f87d53">{{ $viewers }}</span>&nbsp; brugere</h5>
                </div>
                @endif
        </div>
    </div>

    <div class="profile-high-light-area">
        <div class="left-area">
            <div class="title">
                <h3><span>Matchord: </span> {{
                    Auth::user()->portalInfo->matchWords != null ?
                    implode(", ",json_decode(Auth::user()->portalInfo->matchWords)) : ''}}</h3>
            </div>
        </div>
    </div>

    {{-- latest message section --}}
    <div>
        <latest-chat @clicked="latestMessage"></latest-chat>
    </div>

</div>
