$(document).ready(function() {


	$( ".content-selection" ).addClass('show');
	$("#banner-top").addClass('show');
	$("#banner-bottom").addClass('show');

	
	var menu = $("#horizontal-menu").owlCarousel({
		  nav: false,
		  dots: false,
		  smartSpeed: 500,
		  margin: 40,
		  autoWidth: true,
		  loop: false,
		  items:1,
		  onInitialized: function() {
		    var m = ($(window).width() - $('.container').width()) / 2;
		    $('#horizontal-menu .owl-stage').css({ 'margin-left': m });
		  },
		  onResized: function() {
		    var m = ($(window).width() - $('.container').width()) / 2;
		    $('#horizontal-menu .owl-stage').css({ 'margin-left': m });
		  }
		});
		menu.owlCarousel();


	// NO AJAX FOR FAQ

	if($('.faq-page').length !== 0){

		$('#horizontal-menu a').on('click',function(e){
	      	e.preventDefault();
  			$('#horizontal-menu a').removeClass('active');
	        $(this).addClass('active');

	        $(".faq-section-container").removeClass('active');
	        $("."+$(this).data('section')).addClass('active');
	    });
	}

	else

	{
		console.log("coucou");

	// AJAX CALL

	    $('#horizontal-menu a').on('click',function(e){
	      e.preventDefault();
	      $( ".content-selection" ).removeClass('show');
		  $("#banner-top").removeClass('show');
	      $("#banner-bottom").removeClass('show');

	      if($(this).is(':not(.active)')) {
	        var urlPath = $(this).attr('data-url');
	        $.get(urlPath, function(data){
	          $( ".content-selection" ).html( $(data).find('.content-selection').html() );

	           setTimeout(function() {
	      			$( ".content-selection" ).addClass('show');
	      			$("#banner-top").addClass('show');
	      			$("#banner-bottom").addClass('show');
	    		}, 300);


	          if($("#banner-top").length !== 0){
	          	$("#banner-top" ).html( $(data).find('#banner-top').html() );
	          }
	          if($("#banner-bottom").length !== 0){
	          	$("#banner-bottom" ).html( $(data).find('#banner-bottom').html() );
	          }
	   //        // refresh isotope
	   //         if($('.grid').length !== 0){
				//     $('.grid').isotope();
				// }


	           history.pushState('',GLOBALS.texts.url.title, urlPath);
	          


	        });

	        $('#horizontal-menu a').removeClass('active');
	        $(this).addClass('active');
	      }
	    });

	}


	// FIX HORIZONTAL MENU
	$(window).on('scroll', function() {
	    var s = $(this).scrollTop();
	    console.log("s", s, $(".header-container").height() + $('.banner-img').height());
	    if(s > $(".header-container").height() + $('.banner-img').height()){
	    	$("#horizontal-menu").css('position','fixed');
	    	$("#horizontal-menu").css('top',$(".header-container").height());
	    	$(".selection-container").css('margin-top',$(".header-container").height());
	    	$(".content-selection").css('margin-top',$(".header-container").height());
	    	
	    	if($(".palmares-container").length !== 0){
	    		$(".palmares-container").css('margin-top',$(".header-container").height());
	    	}

	    }
	    else{
	    	$("#horizontal-menu").css('position','relative');
	    	$("#horizontal-menu").css('top','inherit');	
	    	$(".selection-container").css('margin-top',0);
	    	$(".content-selection").css('margin-top',0);
	    	if($(".palmares-container").length !== 0){
	    		$(".palmares-container").css('margin-top',0);
	    	}
	    }
	 });





});