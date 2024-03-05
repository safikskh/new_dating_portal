<!-- Developed By CBS -->
    <!-- Promotion Slider -->
        <div class="card custom-card">

            <div class="card-header custom-card-header">
                <a href="{{route('promotion.list')}}">
                    <h6 class="card-title mb-0" style="font-weight: bold; text-transform:uppercase;">Fremhævninger</h6>
                </a>
            </div>

            <!-- Slider 1 -->
                <div class="card-body">
                    <div id="owl-demo2" class="owl-carousel owl-carousel-icons2">
                        @if(auth()->user()->totalShowPromotion(0) != 0)
                            @foreach(auth()->user()->promotionInfo
                            ->slice(0, auth()->user()->totalShowPromotion(0)) as $item)
                                @include('dashlead.layouts.promotion.imageSection',['item' => $item])
                            @endforeach
                        @else
                            @include('dashlead.layouts.promotion.emptySection')
                        @endif
                    </div>
                </div>
            <!-- Slider 1 -->

            <!-- Slider 2 -->
                <div class="card-body">
                    <div id="owl-demo2" class="owl-carousel owl-carousel-icons2">
                        @if(auth()->user()->totalShowPromotion(1) != 0)
                            @foreach(auth()->user()->promotionInfo
                                ->slice(auth()->user()->totalShowPromotion(0) , 
                                    auth()->user()->totalShowPromotion(1)) as $item)
                                @include('dashlead.layouts.promotion.imageSection',['item' => $item])
                                {{-- add empty logo when slider 1 have 1+ picture --}}
                                @if(auth()->user()->totalShowPromotion(1) == 1 && auth()->user()->totalShowPromotion(0) == 2)
                                @include('dashlead.layouts.promotion.emptySection')
                                @endif
                            @endforeach
                        @else
                            @include('dashlead.layouts.promotion.emptySection')
                        @endif
                    </div>
                </div>
            <!-- Slider 2 -->

            <!-- Slider 3 -->
                <div class="card-body">
                    <div id="owl-demo2" class="owl-carousel owl-carousel-icons2">
                      @if(auth()->user()->totalShowPromotion(2) != 0)
                            @foreach(auth()->user()->promotionInfo
                                ->slice(auth()->user()->totalShowPromotion(0) + auth()->user()->totalShowPromotion(1), 
                                    auth()->user()->totalShowPromotion(2)) as $item)
                                @include('dashlead.layouts.promotion.imageSection',['item' => $item])
                                {{-- add empty logo when slider 1(must) or 2(optional)   have 1+ picture --}}
                                @if(auth()->user()->totalShowPromotion(2) == 1 && auth()->user()->totalShowPromotion(0) == 2)
                                @include('dashlead.layouts.promotion.emptySection')
                                @endif
                            @endforeach
                        @else

                        @include('dashlead.layouts.promotion.emptySection')

                        @endif
                    </div>
                </div>
            <!-- Slider 3 -->

            <!-- Slider 4 -->
                <div class="card-body">
                    <div id="owl-demo2" class="owl-carousel owl-carousel-icons2">
             
                        @if(auth()->user()->totalShowPromotion(3) != 0)
                            @foreach(auth()->user()->promotionInfo
                                ->slice(auth()->user()->totalShowPromotion(0) + auth()->user()->totalShowPromotion(1) +
                                    auth()->user()->totalShowPromotion(2), auth()->user()->totalShowPromotion(3)) as $item)
                                @include('dashlead.layouts.promotion.imageSection',['item' => $item])
                                {{-- add empty logo when slider 1(must) , 2(optional) or 3(optional)  have 1+ picture --}}
                                @if(auth()->user()->totalShowPromotion(3) == 1 && auth()->user()->totalShowPromotion(0) == 2)
                                    @include('dashlead.layouts.promotion.emptySection')
                                @endif
                            @endforeach 
                        @else
                            @include('dashlead.layouts.promotion.emptySection')
                        @endif


                    </div>
                </div>
            <!-- Slider 4 -->

        </div>
    <!-- ./Promotion Slider -->
<!-- Developed By CBS -->