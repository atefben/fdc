$(document).ready(function() {

	var creditsCount = $('.credits p').length;
	var middleCredits = Math.round(creditsCount/2)-1;
	$('.credits p').eq(middleCredits).addClass('middle');

	var castingCount = $('.casting p').length;
	var middleCasting = Math.round(castingCount/2)-1;
	$('.casting p').eq(middleCasting).addClass('middle');



	// CONTACT AND PRESS SECTION OPENING
	$('.press .title-section').click(function(){

		$('.press').toggleClass('open');
		$(this).find('.icon').toggleClass('icon_fleche-top');
	});	

	$('.contact .title-section').click(function(){

		$('.contact').toggleClass('open');
		$(this).find('.icon').toggleClass('icon_fleche-top');
	});	


	// STOP PICTOS FIXED BEFORE NEWSLETTER BLOCK
	$(window).on('scroll', function() {
	    var s = $(this).scrollTop();
	    if( s + document.documentElement.clientHeight > $('#main').height() + 150 ) {

	    	$('.pictos-nav').css('position','absolute');
	    	$('.pictos-nav').css('bottom','50px');
	    }
	    else{

	    	$('.pictos-nav').css('position','fixed');
	    	$('.pictos-nav').css('bottom','160px');
	    }
	 });


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

	var sliderCompetition = $(".competition .competition-carousel").owlCarousel({ 
	      nav: false,
	      dots: false,
	      smartSpeed: 500,
	      fluidSpeed: 500,
	      loop: false,
	      margin: 55,
	      autoWidth: true,
	      dragEndSpeed: 600,
	      items:1,
	      center:true
	    });

	    sliderCompetition.owlCarousel();








	// PLAYERS AUDIO

	initAudioPlayers()




	// function redraw() {
	//   for(var i=0; i<waves.length; i++) {
	//     waves[i].drawBuffer();
	//   }
	// }

	function initAudioPlayers() {

		var waves = [],
	    inter = null,
	    duration = null;

	  $('.audio-player').each(function(i) {
	    $(this).addClass('loading').find('.wave-container').attr('id', 'wave-' + i);
	    var wave = Object.create(WaveSurfer);

	    // initialize wave sound
	    wave.init({
	      container: document.querySelector('#' + 'wave-' + i),
	      waveColor: 'rgba(90, 90, 90, 0.5)',
	      progressColor: '#c8a461',
	      cursorWidth: 0,
	      height: 50
	    });

	    // load the url of the sound
	    wave.load($(this).data('sound'));

	    // once it's ready
	    wave.on('ready', function() {
	      $(wave.container).parents('.audio-player').removeClass('loading');

	    });

	    wave.on('finish', function() {
	    	$(wave.container).parents('.audio-player').find(".playpause .icon").toggleClass("icon_play");
	    	wave.stop();
	    });

	    waves.push(wave);

	    // on click on play/pause
	    $(this).find('.playpause').on('click', function(e) {

	    	if ($(this).find(".icon").hasClass('icon_audio')){
	    		$(this).find(".icon").removeClass('icon_audio');
	    		$(this).find(".icon").addClass('icon_pause');
	    	}
	    	else{
	    		$(this).find(".icon").toggleClass("icon_play");
	    	}
	    	

	      e.preventDefault();

	      if(inter) {
	        clearInterval(inter);
	      }

	      $audioplayer = $(e.currentTarget).parents('.audio-player');

	      // get duration
	      if(!$audioplayer.hasClass('on')) {
	        $audioplayer.addClass('on');

	        duration = wave.getDuration();
	        var minutes = parseInt(Math.floor(duration / 60));
	        var seconds = parseInt(duration - minutes * 60);

	        if(seconds < 10) {
	          seconds = '0' + seconds;
	        }
	        $audioplayer.find('.duration .total').text(minutes + ':' + seconds);
	      }
	      
	      // update current time
	      inter = setInterval(function() {
	        var curr = wave.getCurrentTime();

	        var minutes = parseInt(Math.floor(curr / 60));
	        var seconds = parseInt(curr - minutes * 60);

	        if(seconds < 10) {
	          seconds = '0' + seconds;
	        }

	        $audioplayer.find('.duration .curr').text(minutes + ':' + seconds);
	      }, 1000);

	      
	      if(!$audioplayer.hasClass('pause')) {
	        for(var i = 0; i<waves.length; i++) {
	          if(waves[i].isPlaying() && waves[i].container.id != wave.container.id) {
	            waves[i].pause();
	          }
	        }
	      }
	      $('.audio-player').not($audioplayer).removeClass('pause');
	      $('.audio-player').not($audioplayer).removeClass('on');
	      $('.audio-player').not($audioplayer).find(".playpause .icon").addClass('icon_audio');
	      $('.audio-player').not($audioplayer).find(".playpause .icon").removeClass('icon_pause icon_play');

	      // set volume and play or pause
	      wave.setVolume(0.75);
	      wave.playPause();

	      $audioplayer.toggleClass('pause');
	    });
	  });
	}


});