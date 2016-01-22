// var playerInstance = jwplayer("player1");
//         playerInstance.setup({
//         file: "/videos/sample.mp4",
//         width: "100%",
//         aspectratio: "16:9",
//         displaytitle: false
//         });


$(document).ready(function() {
	$('.list .item').on("click",function(){
		console.log("coucou ", $(this).data("data-video"));
		var playerInstance = jwplayer("player1");
        playerInstance.setup({
        file: "/videos/sample.mp4",
        width: "100%",
        aspectratio: "16:9",
        displaytitle: false,
        mediaid: '123456'
        });
		playerInstance.getContainer().querySelector('video').setAttribute('id','videoPlayer');
        var player = $('#player1').find('video');
			player.addEventListener('webkitendfullscreen', function() {
		   //desired "done button" behavior defined here
		   console.log('coucou');
		}, false);
	});
	
});