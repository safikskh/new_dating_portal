<div class="col-lg-6">

    {{-- Announcement --}}
    @if (announcements()->count() > 0)
    <div class="latest-news-bar-area">
        <div class="title-area">
            <a href="{{route('announcement.list')}}">
                <h3>Nyheder</h3>
            </a>
        </div>
        <div class="swiper-container status-slider">
            <div class="swiper-wrapper">
                @foreach (announcements() as $announcement)
                <div class="swiper-slide">
                    <div class="media-area">
                        <div class="media-title">
                            <h3>{{$announcement->title}}</h3>
                        </div>
                        <span>
                            <time class="comment-date" datetime="16-12-2014 01:05">
                                <i class="fa fa-clock-o"></i>
                                {{date('d-m-Y, H:i:s', strtotime($announcement->updated_at))}}</time>
                        </span>
                        <div class="media-content">
                            {!! $announcement->detail !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    @endif
    {{-- vaggen --}}
    <div class="latest-news-bar-area">
        <div class="title-area">
            <a href="statuses">
                <h3>Væggen</h3>
            </a>
        </div>
        <div class="swiper-container status-slider">
            @if (sizeof(statuses()) > 0)
            <div class="swiper-wrapper">
                @foreach (statuses() as $status)
                <div class="swiper-slide">
                    <div class="media-area">

                        <span style="display:flex; align-items:center;">
                            <img class="staus-image" src="{{asset($status->user->portalInfo->profilePicture)}}" alt=""
                                srcset="">
                            <a href="{{ url('profile?user_id='.$status->user_id) }}"
                                class="username {{$status->user->portalInfo->userNameColor}}">
                                {{$status->user->portalInfo->userName}}
                            </a>
                        </span>
                        <div class="media-title">
                            <a href="{{ url('profile?user_id='.$status->user_id) }}">
                                <h3>{{$status->title}}</h3>
                            </a>
                        </div>
                        <div class="media-content">
                            <p>{{$status->details}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            @else
            Der er ingen beskeder på væggen.
            @endif
        </div>
    </div>


    <div class="main-media-area blog-post-list">
        <div class="title-area">
            <a class="section-title" href="{{route('blogs')}}">Nyeste blogs</a>
        </div>
        <div class="media-area">
            @if(sizeof(latestBlogs()) > 0)
            @foreach(latestBlogs() as $blog)
            <div class="single-media-area">
                <div class="img"><a href="{{route('blogDetails',$blog->id)}}">
                        <img src="{{ asset('/'.$blog->image)}}" alt="" /></a></div>
                <div class="title-content time-date">
                    <a href="{{route('blogDetails',$blog->id)}}">
                        <h2>{{$blog->title}}
                            {{-- <span>{{$blog->created_at}}</span> --}}
                        </h2>
                    </a>
                    <p>{!! str_limit($blog->details, $limit = 60, $end = '..') !!}</p>
                </div>
            </div>
            @endforeach
            @else
            <div class="container">
                Ingen nyeste blogs.
            </div>
            @endif
        </div>
    </div>

    {{-- event section --}}
    <div class="latest-news-bar-area">
        <div class="title-area">
            <a class="section-title" href="{{route('events')}}">Nyeste event</a>
        </div>
        @if(sizeof(latestEvent()) > 0)
        @foreach(latestEvent() as $event)
        <div class="media-area">
            <div class="img-area">
                <a href="{{route('eventDetails',$event->id)}}">
                    <img src="{{ asset('/'.$event->image)}}" alt="" />
                </a>
            </div>
            <div class="media-title">
                <a href="{{route('eventDetails',$event->id)}}">
                    <h3>{{$event->title}}<span>{{date('d-m-Y', strtotime($event->event_date))}},
                            {{$event->event_time}}</span></h3>
                </a>
            </div>
            <div class="media-content">
                <p>{!! str_limit($event->details, $limit = 120, $end = '..') !!}<a
                        href="{{route('eventDetails',$event->id)}}" style=" font-style: italic; "> Læs mere</a></p>
            </div>
        </div>
        @endforeach
        @else
        Ingen nyeste event.
        @endif
    </div>
</div>
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}