$(document).ready(function() {
  // VIDEO PLAYER
  $('.item-video').on("click",function(e) {
    e.preventDefault();
    setTimeout(function() {
          $('.fullscreenplayer').addClass('show');
      $('body').addClass('allow-landscape');
    }, 200);
    
    if($("#player1").length !== 0) {
      
      playerInstance = jwplayer("player1");
      playerInstance.setup({
        file         : $(this).data('video'),
        image        : $(this).data('poster'),
        width        : "100%",
        aspectratio  : "16:9",
        displaytitle : false,
        mediaid      : '123456',
        skin         : {
          name : "five"
        }
      });
    }

    $('.fullscreenplayer').find('.category').html($(this).find('.category').html());
    $('.fullscreenplayer').find('.title-video').html($(this).find('.titleLink').html());
    $('.fullscreenplayer').find('.date').html($(this).find('.titleLink').attr('data-date'));
  });

  // AUDIO PLAYER
  $('#list-audios .item').on("click",function(e) {
    e.preventDefault();
    $('.fullscreenplayer .category').html($(this).find('.category').html());
    $('.fullscreenplayer .title-audio').html($(this).find('.infos p').html());
    $('.fullscreenplayer .date').html($(e.target).find('.date').text());
    $('.fullscreenplayer .hour').html($(e.target).find('.hour').text());
    $('.fullscreenplayer .img').attr('style',$(this).find('.img').attr('style'));

    if($('wave').length == 0) {
      $('.audio-player').attr('data-sound',$(this).data('sound'));
      initAudioPlayers(true);

    } else {
      loadSound($(this).data('sound'));
    }
    
    setTimeout(function() {
      $('.fullscreenplayer').addClass('show');

      //add time
      var curr = waves[0].getDuration();

      var minutes = parseInt(Math.floor(curr / 60));
      var seconds = parseInt(curr - minutes * 60);

       $('.duration .total').html(minutes+":"+seconds);
    }, 200);
  });

  // CLOSE FULLSCREEN PLAYER
  $('body').on('click', '.fullscreenplayer .close-button', function(e) {
    $('body').removeClass('allow-landscape');
  
    setTimeout(function() {

      $('.fullscreenplayer').removeClass('show');

      if($('.audios').length !==0) {
        $('.playpause').find(".icon").removeClass("icon_play");
        stopSound();

        playerInstance.setMute(true);
        playerInstance.setVolume(0);

      }
    }, 200);


    if($('.jwplayer').length > 0) {
      playerInstance.stop();
    }

  });
});