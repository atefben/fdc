$(document).ready(function() {

	var creditsCount = $('.credits p').length;
	var middleCredits = Math.round(creditsCount/2)-1;
	$('.credits p').eq(middleCredits).addClass('middle');

	var castingCount = $('.casting p').length;
	var middleCasting = Math.round(castingCount/2)-1;
	$('.casting p').eq(middleCasting).addClass('middle');


	$('.press .title-section').click(function(){

		$('.press').toggleClass('open');
		$(this).find('.icon').toggleClass('icon_fleche-top');
	});	

	$('.contact .title-section').click(function(){

		$('.contact').toggleClass('open');
		$(this).find('.icon').toggleClass('icon_fleche-top');
	});	

	function setActiveThumbnail() {
      $('.thumbnails .owl-item').removeClass('center');

      $('.thumbnails .owl-item.active').first().addClass('center');

      if($('.thumbnails .owl-item.center').index() >= $('.thumbnails .owl-item').length - 4) {
        $('.thumbnails .owl-item').last().addClass('center');

      }
    }


	var sliderThumbPhotos = $(".photos .thumbnails").owlCarousel({ 
	      nav: false,
	      dots: false,
	      smartSpeed: 500,
	      fluidSpeed: 500,
	      loop: false,
	      margin: 25,
	      autoWidth: true,
	      dragEndSpeed: 600,
	      items:1,
	      onInitialized: function() {
	        var m = ($(window).width() - $('.container').width()) / 2;
	        $('.thumbnails .owl-stage').css({ 'margin-left': m });
	        setActiveThumbnail();
	      },
	      onResized: function() {
	        var m = ($(window).width() - $('.container').width()) / 2;
	        $('.thumbnails .owl-stage').css({ 'margin-left': m });
	      },
	      onTranslated: function() {
	        setActiveThumbnail();
	      }
	    });

	    sliderThumbPhotos.owlCarousel();

	    
	    $('.thumbnails .owl-item').on('click', function(e) {
		    e.preventDefault();

		    $(this).parents('.slideshow').find('.thumb').removeClass('active');
		    $(this).parents('.slideshow').find('.images .img').removeClass('active');

		    var i = $(this).index();

		    $(this).find('.thumb').addClass('active');
		    $(this).parents('.slideshow-img').find('.images .img').eq(i).addClass('active');
	});

	var sliderArticles = $(".articles .articles-carousel").owlCarousel({ 
	      nav: false,
	      dots: false,
	      smartSpeed: 500,
	      fluidSpeed: 500,
	      loop: false,
	      margin: 20,
	      autoWidth: true,
	      dragEndSpeed: 600,
	      items:1,
	      onInitialized: function() {
	        var m = ($(window).width() - $('.container').width()) / 2;
	        $('.articles-carousel .owl-stage').css({ 'margin-left': m });
	      },
	      onResized: function() {
	        var m = ($(window).width() - $('.container').width()) / 2;
	        $('.articles-carousel .owl-stage').css({ 'margin-left': m });
	      },
	      onTranslated: function() {
	      }
	    });

	    sliderArticles.owlCarousel();



});