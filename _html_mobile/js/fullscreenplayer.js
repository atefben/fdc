


$(document).ready(function() {
	$('.item-video').on("click",function(){
		$('.fullscreenplayer').addClass('show');
		setTimeout(function() {
	      
			$('body').addClass('allow-landscape');
	      
	    }, 900);
		
		var playerInstance = jwplayer("player1");
        playerInstance.setup({
        file: $(this).data('video'),
        image: './img/playervideo.jpg',
        width: "100%",
        aspectratio: "16:9",
        displaytitle: false,
        mediaid: '123456',
        skin: {
		  name: "five"
		 }
        });
		
	});

	$('body').on('click', '.close-button', function(e){
    $('body').removeClass('allow-landscape');
    //document.body.removeEventListener('touchmove', listener,false);
    

    setTimeout(function() {
      $('.fullscreenplayer').removeClass('show');

      
    }, 900);
  });

	
});