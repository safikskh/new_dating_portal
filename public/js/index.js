// Options documentation at:
// https://github.com/alvarotrigo/fullPage.js

$(document).ready(function() {
    $('#fullpage').fullpage({
      navigation: true,
    });
});

$(function(){
  $('.bs-slider').each(function(){
		var images = $(this).data("img").split(';');
		fade = $(this).data("fade") ? $(this).data("fade") : 0 ;
		duration = $(this).data("duration") ? $(this).data("duration") : 5000 ;

		$(this).backstretch(images, {fade: fade, duration: duration});
    
	});

	$('.bs-slider').on("backstretch.after", function (e, instance, index) {
  		$(e.currentTarget).find('.bs-bullets>li.active').removeClass("active");
  		$(e.currentTarget).find('.bs-bullets>li:eq('+index+')').addClass("active");
	});
});





