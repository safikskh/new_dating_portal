
<!-- Developed By CBS -->
		<!-- Announcements Slider -->
    		@if ($announcements->count() > 0)
            <div class="card custom-card">
                <div class="card-body h-100">
                    <div style="margin-bottom: 10px;">
                       <a href="{{route('frontend.announcement.list')}}">
                            <h5 class="card-title mb-1" style="font-weight: bold;">NYHEDER</h5><hr>
                        </a>
                    </div>

					<div class="swiper-container">
						   <div class="swiper-wrapper">
						    @foreach ($announcements as $announcement)
						      <div class="swiper-slide">
						      	<h6 style="font-weight: bold;">{{$announcement->title}}</h6>
						      	  <span class="badge badge-primary" style="font-weight: bold;"><i class="far fa-clock"></i>  {{date('l, d F Y, H:i', strtotime($announcement->updated_at))}}</span>
						      	<div style="height:468px;overflow:auto;scrollbar-base-color:gold;font-family:sans-serif;padding:10px;">{!! $announcement->detail !!}</div>
						      </div>
						      @endforeach
						  </div>
							<div class="swiper-pagination"></div>
						    <div class="swiper-button-next"></div>
						    <div class="swiper-button-prev"></div>
					</div>
				</div>
			</div>
			@endif
        <!-- ./Announcements Slider -->

        <!-- Wall Slider -->
            <div class="card custom-card">
                <div class="card-body h-100">
						<div style="margin-bottom: 10px;">
							<h5 class="card-title" style="margin-bottom: 10px;">
								<span style="font-weight: bold; text-transform:uppercase;">
									<a href="{{route('frontend.post.list')}}" style="color:black;">
										Væggen
									</a>
								<span>
								<span style="float:right"> <button data-toggle="modal" class="btn btn-primary btn-sm" href="#statusModal" style="font-weight: bold; text-transform:uppercase;">lav et indlæg</button><span>
							</h5><hr>
						</div>

					@if (sizeof($statuses) > 0)
					<div class="swiper-container">
						<div class="swiper-wrapper">
						    @foreach ($statuses as $status)
						      <div class="swiper-slide">
						      	<div class="row">
						      		<div class="col-9" style="text-align: left;">
						      			<h6 style="font-weight: bold;">{!! str_limit($status->title, $limit = 65, $end = '..') !!}</h6>
						      			<a href="{{ url('profile?user_id='.$status->user_id) }}"><span class="badge badge-primary" style="font-weight: bold;"><i class="fas fa-user-circle"></i>  {{$status->user->portalInfo->userName}}</span></a>
						      			<a href="#" data-toggle="modal" data-target="#reportModal{{$status->id}}"><span class="badge badge-danger" style="font-weight: bold;"><i class="fas fa-flag"></i></span></a>
						      		</div>
						      		<div class="col-3" style="text-align: right;">
						      			<a href="{{ url('profile?user_id='.$status->user_id) }}">
						      				@if(File::exists($status->user->portalInfo->profilePicture)) 
						                        <img src="{{asset($status->user->portalInfo->profilePicture)}}" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; height:50px; width:50px;" class="rounded-circle">
						                    @else
						                        <img src="{{ asset('dashlead/img/default/404-dp.png') }}" class="rounded-circle" style="border:2px solid #DBD4D3; border-radius:50%; padding: 2px; text-align: center; height:50px; width:50px;">
						                     @endif
						      			</a>
						      		</div>
						      	</div>
						      	<div style="height:145px;overflow:auto;scrollbar-base-color:gold;font-family:sans-serif;padding:10px;">
						      		{{ $status->details }}
						      	</div>

						      </div>
						    @endforeach
						</div>
						<div class="swiper-pagination"></div>
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					</div>
					@else
		                <div style="text-align: center; margin-top: 99px; margin-bottom: 99px;">
			                <h5 style="color:red;">Der Er Ingen Beskeder På Væggen.</h5>
			            </div>
		            @endif
				</div>
			</div>
        <!-- Wall Slider -->

        <!-- Report modal For Wallet Slider -->
	        @if (sizeof($statuses) > 0)
		        @foreach ($statuses as $status)
		        <div class="modal" id="reportModal{{ $status->id }}">
	                <div class="modal-dialog" role="document">
	                    <div class="modal-content modal-content-demo">
	                        <div class="modal-header">
	                            <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Rapport</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
	                        </div>
	                        <form method="POST" action="{{ route('status.report', $status->id) }}">
	                            @csrf
	                            <div class="modal-body">
	                                <div class="row">
	                                    <div class="col-sm-6 col-md-12">
	                                      <div class="form-group">
	                                          <label for="name">Beskrivelse <span style="color:red">*</span></label>
	                                           <textarea maxlength="250" value="{{old('description')}}" placeholder="Skriv noget..." class="form-control" name="description" rows="3" required></textarea>
	                                      </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="modal-footer">
	                                <button class="btn ripple btn-success" type="submit" style="font-weight: bold;text-transform: uppercase;">Indsend</button>
	                                <button class="btn ripple btn-danger" data-dismiss="modal" type="button" style="font-weight: bold;text-transform: uppercase;">Tæt</button>
	                            </div>
	                        </form>
	                    </div>
	                </div>
	            </div>
		        @endforeach
		    @endif
        <!-- Report modal For Wallet Slider -->

		
		<!-- Blog Slider -->
			<div class="card custom-card">
                <div class="card-body h-100">
                    <div style="margin-bottom: 10px;">
                       <a href="{{route('blogs')}}">
                            <h5 class="card-title mb-1" style="font-weight: bold; text-transform:uppercase;">NYESTE BLOGS</h5><hr>
                        </a>
                    </div>
			        @if(sizeof($latestBlogs) > 0)
			        <div class="owl-carousel owl-group-slider">
			            @foreach($latestBlogs as $blog)
			            <div class="card">
                            <div style="padding-top: 10px; padding-bottom: 0px;" class="card-body user-card text-center">
				            	<div style="text-align: center; margin-bottom: 8px;">
				            	    <a href="{{route('blogDetails',$blog->id)}}">
				            	        @if(Storage::disk('public')->exists($blog->image)) 
				            	           <img src="{{ Storage::disk('public')->url($blog->image) }}" style="height:125px; width:495px;">
				            	        @else
				            	            <img src="{{ asset('dashlead/img/default/404-image.png') }}" style="height:125px;">
				            	         @endif
				            	    </a>
				            	</div>
				            	<div style="text-align: left;">
				            	    <a href="{{route('blogDetails',$blog->id)}}" style="color:black;">
				            	    	<h5 style="margin-bottom: 7px; font-weight: bold;">{{ str_limit($blog->title, $limit = 55, $end = '..') }}</h5>
									</a>
									<h5>
					            	    <span class="badge badge-primary" style="margin-bottom: 6px; font-weight: bold; float: left;">
											Date : {{date('l, d F Y', strtotime($blog->updated_at))}}
										</span>
										<span class="badge badge-primary" style="margin-bottom: 6px; font-weight: bold; float: right;">
											Category : {{ $blog->category->name }}
										</span>
									</h5>
				            	</div>
			            	</div>
			            </div>
			            @endforeach
			        </div>
			        @else
			            <div style="text-align: center; margin-top: 99px; margin-bottom: 99px;">
			                <h5 style="color:red;">Ingen Nyeste Blogs.</h5>
			            </div>
			        @endif
				</div>
            </div>
        <!-- ./Blog Slider -->

        <!-- Event Slider -->
            <div class="card custom-card">
                <div class="card-body h-100">
                    <div style="margin-bottom: 10px;">
                       <a href="{{route('events')}}">
                            <h5 class="card-title mb-1" style="font-weight: bold; text-transform:uppercase;">NYESTE EVENT</h5><hr>
                        </a>
                    </div>
			        @if(sizeof($latestEvent) > 0)
			        <div class="owl-carousel owl-group-slider">
			            @foreach($latestEvent as $event)
			            <div class="card">
                            <div style="padding-top: 10px; padding-bottom: 0px;" class="card-body user-card text-center">
				            	<div style="text-align: right; margin-bottom: 8px;">
				            	    <a href="{{route('eventDetails',$event->id)}}">
				            	        @if(File::exists($event->image)) 
				            	           <img src="{{asset($event->image)}}" style="height:145px; width:495px;">
				            	        @else
				            	            <img src="{{ asset('dashlead/img/default/404-image.png') }}" style="height:145px;">
				            	         @endif
				            	    </a>
				            	</div>
				            	<div style="text-align: left;">
				            	    <a href="{{route('eventDetails',$event->id)}}" style="color:black;">
				            	    	<h5 style="margin-bottom: 7px; font-weight: bold;">{{ str_limit($event->title, $limit = 55, $end = '..') }}</h5>
				            	    </a>
				            	    <h5>
					            	    <span class="badge badge-primary" style="margin-bottom: 6px; font-weight: bold; float: left;">
											Date : {{date('l, d F Y', strtotime($event->event_date))}}
					            	    </span>
					            	    <span class="badge badge-primary" style="margin-bottom: 6px; font-weight: bold; float: right;">
											Time : {{date('H:i', strtotime($event->event_time))}}
					            	    </span>
									</h5>
				            	</div>
			            	</div>
			            </div>
			            @endforeach
			        </div>
			        @else
			            <div style="text-align: center; margin-top: 99px; margin-bottom: 99px;">
			                <h5 style="color:red;">Ingen Nyeste Event.</h5>
			            </div>
			        @endif
				</div>
            </div>
		<!-- ./Event Slider -->
		
<!-- Developed By CBS -->


