$(document).ready(function() {


	// INIT SLIDERS
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
	      }
	    });

	    sliderArticles.owlCarousel();

	// var sliderCompetition = $(".competition .competition-carousel").owlCarousel({ 
	//       nav: false,
	//       dots: false,
	//       smartSpeed: 500,
	//       fluidSpeed: 500,
	//       loop: false,
	//       margin: 55,
	//       autoWidth: true,
	//       dragEndSpeed: 600,
	//       items:1,
	//       center:true
	//     });

	//     sliderCompetition.owlCarousel();


	// INIT VIDEO PLAYER

	var playerInstance = jwplayer("player");
    playerInstance.setup({
	    file: $("#player").data('video'),
	    image: $("#player").data('poster'),
	    width: "100%",
	    aspectratio: "16:9",
	    displaytitle: false,
	    skin: {
		  name: "five"
		}
    });


	// PLAYERS AUDIO

	initAudioPlayers()



	


});