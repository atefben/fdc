
$(document).ready(function() {
 
	function setActiveVideos(e) {
		$(e).find('.owl-item').removeClass('center');
		$(e).find('.owl-item.active').first().addClass('center');
		if($(e).find('.owl-item.center').index() >= $(e).find('.owl-item').length - 1) {
		    $(e).find('.owl-item').last().addClass('center');
		}
	}
	if($('.home').length || $('.webtv').length) {

		// Slider Videos
		// =========================


		var sliderVideos = $("#slider-videos").owlCarousel({
		  nav: false,
		  dots: false,
		  smartSpeed: 1300,
		  margin: 20,
		  autoWidth: true,
		  loop: false,
		  items:1,
		  onInitialized: function() {
		    var m = ($(window).width() - $('.container').width()) / 2;
		    $('#slider-videos .owl-stage').css({ 'margin-left': m });
		    setActiveVideos("#slider-videos");
		  },
		  onResized: function() {
		    var m = ($(window).width() - $('.container').width()) / 2;
		    $('#slider-videos .owl-stage').css({ 'margin-left': m });
		  },
		  onTranslated: function() {
		    setActiveVideos("#slider-videos");
		  }
		});

		sliderVideos.owlCarousel();

		$('body').on('click', '#slider-videos .owl-item', function() {
		  sliderVideos.trigger('to.owl.carousel', [$(this).index(), 500, true]);
		});

		if($('.webtv').length) {
			var sliderTrailer = $("#slider-trailer").owlCarousel({
			  nav: false,
			  dots: false,
			  smartSpeed: 1300,
			  margin: 20,
			  autoWidth: true,
			  loop: false,
			  items:1,
			  onInitialized: function() {
			    var m = ($(window).width() - $('.container').width()) / 2;
			    $('#slider-trailer .owl-stage').css({ 'margin-left': m });
			    setActiveVideos("#slider-trailer");
			  },
			  onResized: function() {
			    var m = ($(window).width() - $('.container').width()) / 2;
			    $('#slider-trailer .owl-stage').css({ 'margin-left': m });
			  },
			  onTranslated: function() {
			    setActiveVideos("#slider-trailer");
			  }
			});

			sliderTrailer.owlCarousel();

			$('body').on('click', '#slider-trailer .owl-item', function() {
			  sliderTrailer.trigger('to.owl.carousel', [$(this).index(), 500, true]);
			});
			var sliderLastVideos = $("#slider-last-videos").owlCarousel({
			  nav: false,
			  dots: false,
			  smartSpeed: 1300,
			  margin: 20,
			  autoWidth: true,
			  loop: false,
			  items:1,
			  onInitialized: function() {
			    var m = ($(window).width() - $('.container').width()) / 2;
			    $('#slider-last-videos .owl-stage').css({ 'margin-left': m });
			    setActiveVideos("#slider-last-videos");
			  },
			  onResized: function() {
			    var m = ($(window).width() - $('.container').width()) / 2;
			    $('#slider-last-videos .owl-stage').css({ 'margin-left': m });
			  },
			  onTranslated: function() {
			    setActiveVideos("#slider-last-videos");
			  }
			});

			sliderLastVideos.owlCarousel();

			$('body').on('click', '#slider-last-videos .owl-item', function() {
			  sliderLastVideos.trigger('to.owl.carousel', [$(this).index(), 500, true]);
			});
		}
	}
	function setActiveThumbnail() {
      $('.thumbnails .owl-item').removeClass('center');

      $('.thumbnails .owl-item.active').first().addClass('center');

      if($('.thumbnails .owl-item.center').index() >= $('.thumbnails .owl-item').length - 4) {
        $('.thumbnails .owl-item').last().addClass('center');

      }
    }
    if($('.ba').length || $('.channel').length){

    	var playerInstance = jwplayer("player1");
        playerInstance.setup({
        file: './videos/sample.mp4',
        image: './img/playervideo.jpg',
        width: "100%",
        aspectratio: "16:9",
        displaytitle: false,
        mediaid: '123456',
        skin: {
		  name: "five"
		 }
        });

		var sliderThumb = $(".thumbnails").owlCarousel({ 
	      nav: false,
	      dots: false,
	      smartSpeed: 500,
	      fluidSpeed: 500,
	      loop: false,
	      margin: 36,
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

	    sliderThumb.owlCarousel();

	    
	    $('.thumbnails .owl-item').on('click', function(e) {
	    	e.preventDefault();

	    	$(this).parents('.slideshow').find('.thumb').removeClass('active');
	   
	    // HERE CHANGE SOURCE OF PLAYER VIDEO
	    // $(this).parents('.slideshow').find('.images .img').removeClass('active');

	    var i = $(this).index(),
	        vid = $(this).find('.thumb').data('video'), image = './img/playervideo.jpg';
	        jwplayer().load({
                file: vid,
                image: (typeof image != 'undefined') ? image : ""

            });
	    $(this).find('.thumb').addClass('active');
	    $(this).parents('.slideshow').find('.title-video').html($(this).find('.thumb').find('.category').html());
	    $(this).parents('.slideshow').find('.caption').html($(this).find('.thumb').find('.titleLink').html());
	    $(this).parents('.slideshow-img').find('.images .img').eq(i).addClass('active');
	  });

	    if($('.channel').length){

	    	var sliderLastVideos = $("#slider-last-videos").owlCarousel({
			  nav: false,
			  dots: false,
			  smartSpeed: 1300,
			  margin: 20,
			  autoWidth: true,
			  loop: false,
			  items:1,
			  onInitialized: function() {
			    var m = ($(window).width() - $('.container').width()) / 2;
			    $('#slider-last-videos .owl-stage').css({ 'margin-left': m });
			    setActiveVideos("#slider-last-videos");
			  },
			  onResized: function() {
			    var m = ($(window).width() - $('.container').width()) / 2;
			    $('#slider-last-videos .owl-stage').css({ 'margin-left': m });
			  },
			  onTranslated: function() {
			    setActiveVideos("#slider-last-videos");
			  }
			});

			sliderLastVideos.owlCarousel();

			$('body').on('click', '#slider-last-videos .owl-item', function() {
			  sliderLastVideos.trigger('to.owl.carousel', [$(this).index(), 500, true]);
			});
	    }
	}

    if($('.movie').length) {

		var sliderThumbMovie = $(".videos .thumbnails").owlCarousel({ 
	      nav: false,
	      dots: false,
	      smartSpeed: 500,
	      fluidSpeed: 500,
	      loop: false,
	      margin: 36,
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

	    sliderThumbMovie.owlCarousel();

	    
	    $('.videos .thumbnails .owl-item').on('click', function(e) {
		    e.preventDefault();

		    $(this).parents('.slideshow').find('.thumb').removeClass('active');
		    $(this).find('.thumb').addClass('active');

		    var title = $(this).find('.thumb').data('title');
		    var img = $(this).find('.thumb').data('img');
		    var category = $(this).find('.thumb').data('category');
		    var date = $(this).find('.thumb').data('date');
		    var hour = $(this).find('.thumb').data('hour');

		    $(this).parents('.slideshow').find('.video .category').html(category);
		    $(this).parents('.slideshow').find('.video .titleLink').html(title);
		    $(this).parents('.slideshow').find('.video .date').html(date);
		    $(this).parents('.slideshow').find('.video .hour').html(hour);
		    $(this).parents('.slideshow').find('.video img').attr('src',img);

	  });
	}

});