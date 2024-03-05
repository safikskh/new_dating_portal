(function($) {
	
	// ______________Owl-carousel-icons2
	var owl = $('.owl-carousel-icons2');
	owl.owlCarousel({
		loop: false,
		rewind: true,
		margin: 25,
		animateIn: 'fadeInDowm',
		animateOut: 'fadeOutDown',
		autoplay: true,
		autoplayTimeout: 5000, // set value to change speed
		autoplayHoverPause: true,
		dots: false,
		nav: true,
		autoplay: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1,
				nav: true
			},
			300: {
				items: 1,
				nav: true
			}
		}
	});
	// ______________group_slider
	var owl = $('.owl-group-slider');
	owl.owlCarousel({
		loop: false,
		rewind: true,
		margin: 25,
		animateIn: 'fadeInDowm',
		animateOut: 'fadeOutDown',
		autoplay: true,
		autoplayTimeout: 5000, // set value to change speed
		autoplayHoverPause: true,
		dots: false,
		nav: true,
		autoplay: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1,
				nav: true
			},
		}
	})
	
	// ______________Multislider
	$('#basicSlider').multislider({
		continuous: true,
		duration: 2000
	});
	
	
})(jQuery);

