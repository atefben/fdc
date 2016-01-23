var playerInstance = jwplayer("player1");
        playerInstance.setup({
        file: "/videos/sample.mp4",
        width: "100%",
        aspectratio: "16:9",
        displaytitle: false
        });


$(document).ready(function() {
	$('.list .item').on("click",function(){
		console.log('coucou',$(this).data('video'));
		$('.fullscreenplayer').addClass('show');
		setTimeout(function() {
	      
$('body').addClass('allow-landscape');
	      
	    }, 900);
		
		var playerInstance = jwplayer("player1");
        playerInstance.setup({
        file: $(this).data('video'),
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