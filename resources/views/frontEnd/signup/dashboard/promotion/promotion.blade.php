{{-- profile promotion section --}}
<div class="latest-news-bar-area">
    <div class="title-area">
        <a href="{{route('promotion.list')}}">
            <h3>Fremhævninger</h3>
        </a>
    </div>
    <div class="profile-list-few-area slideshow-container" id="promotionSlider">

        {{-- promotion slider 1 --}}
        @if(totalShowPromotion(0) != 0)
        @foreach(getAllPromotionImageByPortalId(1)
        ->slice(0, totalShowPromotion(0)) as $item)
        <div class="single-profile-list-few promotion-section1 mySlides1">
            @include('layouts.promotion.imageSection',['item' => $item])
        </div>
        <span class="dot1"></span>
        @endforeach
        @else
        <div class="single-profile-list-few promotion-section2 mySlides1">
            @include('layouts.promotion.emptySection')
        </div>
        <span class="dot1"></span>
        @endif

        {{-- promotion slider 2 --}}
        @if(totalShowPromotion(1) != 0)
        @foreach(getAllPromotionImageByPortalId(1)
        ->slice(totalShowPromotion(0) ,
        totalShowPromotion(1)
        ) as $item)
        <div class="single-profile-list-few promotion-section1 mySlides2">
            @include('layouts.promotion.imageSection',['item' => $item])
        </div>
        <span class="dot2"></span>
        {{-- add empty logo when slider 1 have 1+ picture --}}
        @if(totalShowPromotion(1) == 1 && totalShowPromotion(0) == 2)
        <div class="single-profile-list-few promotion-section1 mySlides2">
            @include('layouts.promotion.emptySection')
        </div>
        <span class="dot2"></span>
        @endif
        @endforeach
        @else
        <div class="single-profile-list-few promotion-section2 mySlides2">
            @include('layouts.promotion.emptySection')
        </div>
        <span class="dot2"></span>
        @endif


        {{-- promotion slider 3 --}}
        @if(totalShowPromotion(2) != 0)
        @foreach(getAllPromotionImageByPortalId(1)
        ->slice(totalShowPromotion(0) + totalShowPromotion(1),
        totalShowPromotion(2)) as $item)
        <div class="single-profile-list-few promotion-section1 mySlides3">
            @include('layouts.promotion.imageSection',['item' => $item])
        </div>
        <span class="dot3"></span>
        {{-- add empty logo when slider 1(must) or 2(optional)   have 1+ picture --}}
        @if(totalShowPromotion(2) == 1 && totalShowPromotion(0) == 2)
        <div class="single-profile-list-few promotion-section1 mySlides3">
            @include('layouts.promotion.emptySection')
        </div>
        <span class="dot3"></span>
        @endif
        @endforeach
        @else
        <div class="single-profile-list-few promotion-section2 mySlides3">
            @include('layouts.promotion.emptySection')
        </div>
        <span class="dot3"></span>
        @endif

        {{-- promotion slider 4 --}}
        @if(totalShowPromotion(3) != 0)
        @foreach(getAllPromotionImageByPortalId(1)
        ->slice(totalShowPromotion(0) + totalShowPromotion(1) +
        totalShowPromotion(2), totalShowPromotion(3)) as $item)
        <div class="single-profile-list-few promotion-section1 mySlides4">
            @include('layouts.promotion.imageSection',['item' => $item])
        </div>
        <span class="dot4"></span>
        {{-- add empty logo when slider 1(must) , 2(optional) or 3(optional)  have 1+ picture --}}
        @if(totalShowPromotion(3) == 1 && totalShowPromotion(0) == 2)
        <div class="single-profile-list-few promotion-section1 mySlides4">
            @include('layouts.promotion.emptySection')
        </div>
        <span class="dot4"></span>
        @endif
        @endforeach
        @else
        <div class="single-profile-list-few promotion-section2 mySlides4">
            @include('layouts.promotion.emptySection')
        </div>
        <span class="dot4"></span>
        @endif
    </div>
</div>

{{-- promotion and status button --}}
<div class="link-hightlight-bar text-center">
    <a data-toggle="modal" class="btn-radiaus small" href="#promotionModal">Fremhæv din proﬁl</a>
    <a data-toggle="modal" class="btn-radiaus small status-promotion-btn" href="#statusModal">Væggen</a>
</div>


{{-- promotationImage Model --}}
<div class="modal fade " id="promotionModal" tabindex="-1" role="dialog" aria-labelledby="statusModalTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Fremhæv profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('img/icon/cancel.svg')}}" alt="" srcset="">
                </button>
            </div>
            <form id="promotionCreateForm" action="{{route('image-crop')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="panel-body">

                        <div class="row">
                            <div class="avatar-upload">
                                <div class="col-md-4 text-center">
                                    <div id="promotionShow"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group file-block">
                        <label class="btn-select-file">Vælg billede</label>
                        <p class="btn-selected-file"></p>
                        <input type="file" id="promotionInput" required name="file" accept=".png, .jpg, .jpeg"
                            class="form-control-file">
                    </div>

                    <div class="form-group row">
                        <div class="col-md-9">

                            <textarea maxlength="140" type="text" class="form-control" id="promotionTitle"
                                name="promotionTitle" placeholder="Skriv din tekst her(Maks. 160 tegn)"></textarea>
                        </div>
                        <div class="col-md-2">

                            <button class="btn-radiaus small promotionSubmit" type="submit">Fremhæv</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Status Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form id="statusForms" method="POST" action="{{ action('frontEnd\StatusController@store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Opslag på væggen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{asset('img/icon/cancel.svg')}}" alt="" srcset="">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Overskrift</label>
                        <input type="text" class="form-control" name="title" value="{{old('title')}}"
                            placeholder="Titel her" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Opslag</label>
                        <textarea maxlength="250" value="{{old('details')}}" placeholder="Skriv noget..."
                            class="form-control" name="details" rows="3" required>
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-radiaus">Læg op</button>
                </div>
            </form>
        </div>
    </div>
</div>