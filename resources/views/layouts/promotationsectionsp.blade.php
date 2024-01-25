<div class="col-lg-4">
    @include('layouts.promotion.promotion')
    <div class="profile-header-detail-area latest-single-messages-profile">
        <div class="div-title">
            <h3>Rating</h3>
        </div>
        <div class="messages-profile-header-area">
           
            <form action="{{ route('rating') }}" method="POST">
                {{ csrf_field() }}  
                @if(auth()->user()->isEligibleForRating($singleProfileID))                  
                <input type="hidden" name="from_user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="to_user_id" value="{{ $singleProfileID }}">
                <div class="rating">
                    <label>
                        <input type="radio" name="rating_value" value="1"/>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="rating_value" value="2"/>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="rating_value" value="3"/>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="rating_value" value="4"/>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="rating_value" value="5"/>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                </div>
                @else
                @foreach(range(1,5) as $i)
                @if($ratings > 0)
                @if($ratings >= 1)
                <i class="fa fa-star fa-lg" aria-hidden="true" style="color: #f87d53;font-size: 30px;"></i>
                @else
                <i class="fa fa-star-half-o fa-lg" aria-hidden="true" style="color: #f87d53; font-size: 30px;"></i>
                @endif
                @else
                <i style="font-size: 30px;" class="fa  fa-star-o fa-lg" aria-hidden="true"></i>
                @endif
                <?php $ratings --; ?>
                @endforeach
                <br><br>
                
                @endif

                <div>
                    <button  type="submit" class="btn-radiaus small 
                    @if(!auth()->user()->isEligibleForRating($singleProfileID)) 
                    btn-disabled 
                    @endif
                    " {{auth()->user()->isEligibleForRating($singleProfileID) ? '' : 'disabled'}}>Bedøm</button>
                </div>
            </form>
            <div class="rating-details">              
                <h5><span style="color: #38c172">{{ $rating }}</span> ud af 5</h5>
                <h5><span style="color: #38c172">{{ $viewer }}</span> brugere</h5>
            </div>
        </div>
    </div>
    <div>
        <latest-chat @clicked="latestMessage"></latest-chat>
    </div>
</div>
