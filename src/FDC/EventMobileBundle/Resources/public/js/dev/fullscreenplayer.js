


$(document).ready(function() {

	// VIDEO PLAYER
	$('.item-video').on("click",function(e){
		e.preventDefault();
		
		setTimeout(function() {
	      	$('.fullscreenplayer').addClass('show');
			$('body').addClass('allow-landscape');
	      
	    }, 200);
		
		var playerInstance = jwplayer("player1");
        playerInstance.setup({
        file: $(this).data('video'),
        image: $(this).data('poster'),
        width: "100%",
        aspectratio: "16:9",
        displaytitle: false,
        mediaid: '123456',
        skin: {
		  name: "five"
		 }
        });
		$('.fullscreenplayer').find('.category').html($(this).find('.category').html());
	    $('.fullscreenplayer').find('.title-video').html($(this).find('.titleLink').html());
	});




	// AUDIO PLAYER
	$('#list-audios .item').on("click",function(e){
		e.preventDefault();
		$('.fullscreenplayer .category').html($(this).find('.category').html());
		$('.fullscreenplayer .title-audio').html($(this).data('title'));
		$('.fullscreenplayer .date').html($(this).data('date'));
		$('.fullscreenplayer .hour').html($(this).data('hour'));
		$('.fullscreenplayer .img').attr('style',$(this).find('.img').attr('style'));


		if($('wave').length == 0){
			$('.audio-player').attr('data-sound',$(this).data('sound'));
			$.initAudioPlayers(true);
		}else{
			$.loadSound($(this).data('sound'));
		}
		
		setTimeout(function() {
	      
			$('.fullscreenplayer').addClass('show');
	      
	    }, 200);

	});


	// CLOSE FULLSCREEN PLAYER
	$('body').on('click', '.fullscreenplayer .close-button', function(e){
		
    	$('body').removeClass('allow-landscape');
		
	    setTimeout(function() {
	      $('.fullscreenplayer').removeClass('show');
	      if(('.audios').length !==0){
	      	$('.playpause').find(".icon").removeClass("icon_play");
	      	$.stopSound();
	      }
	
	    }, 200);

 	});

});