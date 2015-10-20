var waves = [],
    inter = null,
    duration = null;

function initAudioPlayers() {
  $('.audio-player').each(function(i) {
    $(this).addClass('loading').find('.wave-container').attr('id', 'wave-' + i);
    var h = $(this).hasClass('bigger') ? 116 : 55;
    var wave = Object.create(WaveSurfer);

    // initialize wave sound
    wave.init({
      container: document.querySelector('#' + 'wave-' + i),
      waveColor: 'rgba(90, 90, 90, 0.5)',
      progressColor: '#c8a461',
      cursorWidth: 0,
      height: h
    });

    // load the url of the sound
    wave.load($(this).data('sound'));

    // once it's ready
    wave.on('ready', function() {
      $(wave.container).parents('.audio-player').removeClass('loading');
      if($(wave.container).parents('.audio-player').hasClass('popin-audio')) {
        $('.popin-audio .playpause').trigger('click');
      }
    });

    waves.push(wave);

    // on click on play/pause
    $(this).find('.playpause').on('click', function(e) {
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

      // set volume and play or pause
      wave.setVolume(0.75);
      wave.playPause();

      $audioplayer.toggleClass('pause');
    });
  });
}


// Player Audio
// =========================
$(document).ready(function() {

  function FShandler() {
    if (document.fullscreenEnabled && document.fullscreenElement == null) {
      $('.audio-player').removeClass("full");
      $('.audio-player .top, .audio-player .bottom').remove();
    }
    if (document.webkitFullscreenEnabled && document.webkitFullscreenElement == null) {
      $('.audio-player').removeClass("full");
      $('.audio-player .top, .audio-player .bottom').remove();
    }
    if (document.mozFullScreenEnabled && document.mozFullscreenElement == null) {
      $('.audio-player').removeClass("full");
      $('.audio-player .top, .audio-player .bottom').remove();
    }
    if (document.msFullscreenEnabled && document.msFullscreenElement == null) {
      $('.audio-player').removeClass("full");
      $('.audio-player .top, .audio-player .bottom').remove();
    }
  }

  // volume handler
  $('body').on('click', '.volume', function(e) {
    var newVolume = (e.offsetX * 2) / 100;

    $('.audio-player .volume span').css('width', newVolume * 100 + "%");

    for(var i = 0; i < waves.length; i++) {
      waves[i].setVolume(newVolume);
    }
  });

  if($('.audio-player').length) {
    initAudioPlayers();
  }

  // show audioplayer on fullscreen
  $('body').on('click', '.audio-player .fullscreen', function(e) {
    var i = $(this).parent().index('.audio-player'),
        wave = waves[i];

    e.preventDefault();
    var audioPlayer = $(this).parents('.audio-player')[0];

    if (document.fullscreenEnabled || document.webkitFullscreenEnabled || document.mozFullScreenEnabled || document.msFullscreenEnabled) {

      if($(this).parent().hasClass('full')) {
        if (document.exitFullscreen) {
          document.exitFullscreen();
        } else if (document.webkitExitFullscreen) {
          document.webkitExitFullscreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.msExitFullscreen) {
          document.msExitFullscreen();
        }
      }
      else {

        $(audioPlayer).addClass('full');

        var info = $(audioPlayer).find('.info').html();
        $(audioPlayer).append('<div class="top"><a href="#" class="channels"></a><div class="info"><div class="vCenter"><div class="vCenterKid">' + info + '</div></div></div></div>');
        $(audioPlayer).find('.top').append('<div class="buttons square"><a href="#" class="button facebook"></a><a href="#" class="button twitter"></a><a href="#" class="button link"></a><a href="#" class="button email"></a></div>')
        $(audioPlayer).append('<div class="bottom"><a href="#" class="playpause" data-action="play"></a></div>');

        if (audioPlayer.requestFullscreen) {
          audioPlayer.requestFullscreen();
        } else if (audioPlayer.webkitRequestFullscreen) {
          audioPlayer.webkitRequestFullscreen();
        } else if (audioPlayer.mozRequestFullScreen) {
          audioPlayer.mozRequestFullScreen();
        } else if (audioPlayer.msRequestFullscreen) {
          audioPlayer.msRequestFullscreen();
        }

        $('.playpause').on('click', function(e) {
          e.preventDefault();
          wave.playPause();
        });

        document.addEventListener("fullscreenchange", FShandler);
        document.addEventListener("webkitfullscreenchange", FShandler);
        document.addEventListener("mozfullscreenchange", FShandler);
        document.addEventListener("MSFullscreenChange", FShandler);
      }
    }
  });
});