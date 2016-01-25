var waves = [],
    inter = null,
    duration = null;

function redraw() {
  for(var i=0; i<waves.length; i++) {
    waves[i].drawBuffer();
  }
}

function initAudioPlayers() {
  $('.audio-player').each(function(i) {
    $(this).addClass('loading').find('.wave-container').attr('id', 'wave-' + i);
    var h = $(this).hasClass('bigger') ? 55 : 55;
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

    wave.on('finish', function() {
      wave.stop();
      $(wave.container).parents('.audio-player').removeClass('pause');
      $(wave.container).parents('.audio-player').find('.playpause').html('<i class="icon icon_video"></i>');
    });

    waves.push(wave);

    // on click on play/pause

    var $playpause = $('.playpause');
    var $fullscreen = $('.fullscreen');
    var $volume = $('.volume');


    $playpause.html('<i class="icon icon_video"></i>');
    $fullscreen.html('<i class="icon icon_fullscreen"></i>');
    if($volume.find('.icon_son').length == 0) $volume.append('<i class="icon icon_son"></i>');


    $(this).find('.playpause').on('click', function(e) {
      e.preventDefault();

      $('.playpause').not($(this)).html('<i class="icon icon_video"></i>');
      if($(this).find('i').hasClass('icon_video')){
        $(this).html('<i class="icon icon_pause"></i>');
      }else{
        $(this).html('<i class="icon icon_video"></i>');
      }

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
      wave.setVolume(1);
      wave.playPause();

      $audioplayer.toggleClass('pause');
    });
  });
}


// Player Audio
// =========================
$(document).ready(function() {

  function FShandler() {

    setTimeout(function() {
      redraw();
    }, 200);
    if (document.fullscreenEnabled && document.fullscreenElement == null) {
      $('.audio-player').removeClass("full overlay-channels");
      $('.audio-player .top, .audio-player .bottom, .audio-player #channels-audio').remove();
    }
    if (document.webkitFullscreenEnabled && document.webkitFullscreenElement == null) {
      $('.audio-player').removeClass("full overlay-channels");
      $('.audio-player .top, .audio-player .bottom, .audio-player #channels-audio').remove();
    }
    if (document.mozFullScreenEnabled && document.mozFullScreenElement == null) {
      $('.audio-player').removeClass("full overlay-channels");
      $('.audio-player .top, .audio-player .bottom, .audio-player #channels-audio').remove();
    }
    if (document.msFullscreenEnabled && document.msFullscreenElement == null) {
      $('.audio-player').removeClass("full overlay-channels");
      $('.audio-player .top, .audio-player .bottom, .audio-player #channels-audio').remove();
    }
  }

  $('body').on('click', '.volume', function(e) {

    if($(this).parents('.audio-player').hasClass('full')) {
      if((e.offsetX/100) < 0.15) {
        for(var i = 0; i < waves.length; i++) {
          waves[i].toggleMute();
        }

        if(!$(this).hasClass('mute')) {
          $('.audio-player .volume span').css('width',  '0%');
        } else {
          $('.audio-player .volume span').css('width',  '100%');
        }

        $(this).toggleClass('mute');
      } else {

        var newVolume = e.offsetX / 100;

        $('.audio-player .volume span').css('width', newVolume * 100 + "%");

        for(var i = 0; i < waves.length; i++) {
          waves[i].setVolume(newVolume);
        }
      }
    } else {
      for(var i = 0; i < waves.length; i++) {
        waves[i].toggleMute();
      }

      if(!$(this).hasClass('mute')) {
        $(this).find('span').css('width',  '0%');
      } else {
        $(this).find('span').css('width',  '100%');
      }

      $(this).toggleClass('mute');
    }
  });

  $('body').on('click', '.audio-player.full .channels', function(e) {
    e.preventDefault();

    $(this).toggleClass('active');

    $('.audio-player.full').toggleClass('overlay-channels');
    $('#channels-audio').toggleClass('active');
  });

  function closeChannels() {
    $('.audio-player.full').removeClass('overlay-channels');
    $('.audio-player.full .channels').removeClass('active');
    $('#channels-audio').removeClass('active');
  }

  $('body').on('click', '.audio-player.full.overlay-channels', function(e) {
    closeChannels();
  });

  if($('.audio-player').length) {
    initAudioPlayers();
  }

  $('body').on('click', '#slider-channels-audio .channel .linkVid', function(e) {
    closeChannels();
    var ind = 0;

    if($('.audio-player').length > 1) {
      ind = $('.audio-player.full').index('.audio-player');
    }

    e.preventDefault();

    var $audioPlayer = $('.audio-player.full'),
        $newAudio = $(e.target).parent();

    var s = $newAudio.data('sound'),
        img = $newAudio.find('img').attr('src'),
        info = $newAudio.find('.info').html();

    $audioPlayer.find('.image').css('background-image', 'url(' + img + ')');
    $audioPlayer.children('.info .vCenterKid').html(info);

    waves[ind].load(s);

    // update duration
    waves[ind].on('ready', function() {
      var duration = waves[ind].getDuration();
      var minutes = parseInt(Math.floor(duration / 60));
      var seconds = parseInt(duration - minutes * 60);

      if(seconds < 10) {
        seconds = '0' + seconds;
      }
      $audioPlayer.find('.duration .total').text(minutes + ':' + seconds);
    });

  });

  // show audioplayer on fullscreen
  $('body').on('click', '.audio-player .fullscreen', function(e) {
    var i = $(this).parent().index('.audio-player'),
        wave = waves[i];

    e.preventDefault();
    var audioPlayer = $(this).parents('.audio-player')[0];

    $('.fullscreen .icon').removeClass('icon_fullscreen').addClass('icon_reverseFullScreen');
    if (document.fullscreenEnabled || document.webkitFullscreenEnabled || document.mozFullScreenEnabled || document.msFullscreenEnabled) {


      if($(this).parents('.audio-player').hasClass('full')) {

        $('.fullscreen .icon').removeClass('icon_reverseFullScreen').addClass('icon_fullscreen');

        setTimeout(function() {
          redraw();
        }, 200);
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
        $(audioPlayer).append('<div class="top"><a href="#" class="channels"><i class="icon icon_Micro"></i></a><div class="info"><div class="vCenter"><div class="vCenterKid">' + info + '</div></div></div></div>');
        $(audioPlayer).find('.top').append('<div class="buttons square"><a href="//www.facebook.com/sharer.php?u=html.festival-cannes-2016.com.ohwee.fr&t=le%20titre" rel="nofollow" class="button facebook ajax"><i class="icon icon_facebook"></i></a><a href="//twitter.com/intent/tweet?text=Enrages%20Polar%20Hybride" class="button twitter"><i class="icon icon_twitter"></i></a><a href="#" class="button link"><i class="icon icon_link"></i></a><a href="#" class="button email"><i class="icon icon_lettre"></i></a></div>')
        $(audioPlayer).append('<div id="channels-audio"></div>');

        if (audioPlayer.requestFullscreen) {
          audioPlayer.requestFullscreen();
        } else if (audioPlayer.webkitRequestFullscreen) {
          audioPlayer.webkitRequestFullscreen();
        } else if (audioPlayer.mozRequestFullScreen) {
          audioPlayer.mozRequestFullScreen();
        } else if (audioPlayer.msRequestFullscreen) {
          audioPlayer.msRequestFullscreen();
        }

        $.ajax({
          type: "GET",
          dataType: "html",
          cache: false,
          url: 'channels.html' ,
          success: function(data) {
            $('#channels-audio').append(data);
            var sliderChannelsAudio = $("#slider-channels-audio").owlCarousel({
              nav: false,
              dots: false,
              smartSpeed: 500,
              center: true,
              loop: false,
              margin: 80,
              autoWidth: true,
              onInitialized: function() {
                $('#slider-channels-audio .owl-stage').css({ 'margin-left': "-343px" });

                setTimeout(function() {
                  redraw();
                }, 200);
              }
            });

            sliderChannelsAudio.owlCarousel();

          }
        });

        document.addEventListener("fullscreenchange", FShandler);
        document.addEventListener("webkitfullscreenchange", FShandler);
        document.addEventListener("mozfullscreenchange", FShandler);
        document.addEventListener("MSFullscreenChange", FShandler);
      }
    }
  });
});
