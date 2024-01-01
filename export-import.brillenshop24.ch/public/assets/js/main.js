
;

(function ($) {
	'use strict';
	
	var win = $(window);

	/* Menu */
	$('#mobile-menu').meanmenu({
		meanMenuContainer: '.mobile-menu-area',
		meanScreenWidth: "991"
	});
	
	/* scrollToTop */
	$(".scroll-to-top").scrollToTop(1000);

	/*==========Smooth scrolling using jQuery easing=============*/
	$('a.scroll[href*="#"]:not([href="#"])').on(function() {

		$("li").removeClass("active");
		$(this.parentNode).addClass("active");
	
		if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
		  var target = $(this.hash);
		  target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
		  
		  if (target.length) {
			$('html, body').animate({
				
			  scrollTop: (target.offset().top - 70)
			}, 1000, "easeInOutExpo");
			return false;
		  }
		}
	  });	
	  
	// Activate scrollspy to add active class to navbar items on scroll
	$('body').scrollspy({
		target: '.main-menu',
		offset: 80
	});	
		
	/* Top Menu Stick  */
	win.on('scroll',function() {
	if ($(this).scrollTop() > 100){
		$('#sticky-header').removeClass("slideIn animated");
		$('#sticky-header').addClass("sticky slideInDown animated");
	  }
	  else{
		$('#sticky-header').removeClass("sticky slideInDown animated");
		$('#sticky-header').addClass("slideIn animated");
	  }
	});
	
}(jQuery));