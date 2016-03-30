
$(document).ready(function() {
 
	$.initFilmsSliders = function(){

		var slider = $(".film-slider").owlCarousel({ 
	      nav: false,
	      dots: false,
	      smartSpeed: 500,
	      fluidSpeed: 500,
	      loop: false,
	      margin: 60,
	      autoWidth: true,
	      dragEndSpeed: 600,
	      items:1,
	      center:true
	    });

	    slider.owlCarousel();

	    var slider_all = $(".all-slider").owlCarousel({ 
	      nav: false,
	      dots: false,
	      smartSpeed: 500,
	      fluidSpeed: 500,
	      loop: false,
	      margin: 0,
	      autoWidth: true,
	      dragEndSpeed: 600,
	      items:1,
	      center:true
	    });

	    slider_all.owlCarousel();

	}

	$.initFilmsSliders();
	

});