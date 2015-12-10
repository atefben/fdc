var jw = jw || {},
    d  = document,
    w  = window,
    k  = k || new Konsole('fdc.2016', true),
    timeout = 1000,
    thread;


jw.playerInit = function() {
    if($('#video-player').length) {
        jw.$videoPlayer  = jwplayer('video-player');
        jw.$container    = $('#video-container');
        jw.$stateBtn     = $('.play-btn');
        jw.$durationTime = $('.duration-time');
        jw.$current      = $('.current-time');
        jw.$progressBar  = $('.progress-bar');
        jw.$fullscreen   = $('.fs-icon');
        jw.$sound        = $('.sound');
        jw.$topBar       = $('.top-bar');

        jw.player();
    }
};

jw.player = function() {
    jw.$videoPlayer.setup({
        primary: 'html5',
        aspectratio: '16:9',
        width: $('#video-player').parent('div').width(),
        height: $('#video-player').parent('div').height(),
        controls: false,
        playlist: [ //TODO change all link//
            {
                file: './files/mov_bbb.mp4',
                image: '//dummyimage.com/960x540/c8a461/000.png'
            }, {
                file: 'https://www.youtube.com/watch?v=_eaIurlPB7w?t=1m2s',
            }, {
                file: 'https://www.youtube.com/watch?v=NtDG-Cnj-pw',
                title: 'Video 1'
            }, {
                file:'https://www.youtube.com/watch?v=4QmpYuVEwIU',
                title:'Video 2'
            }, {
                file:'https://www.youtube.com/watch?v=YvjBXpmwhmk',
                title:'Video 3'
            }
        ]
    }).on('ready', function() {
        jw.$videoPlayer.setVolume(100);
        jw.initChannel();
        jw.externeControl();
    }).on('play', function() {
        jw.$container.find('.infos-bar .info, .infos-bar .picto').addClass('hide');
        jw.$container.removeClass('state-init');
        jw.$stateBtn.removeClass('play').addClass('pause');
        fullScreenApi.isFullScreen() ? jw.mouseMoving(true) : jw.mouseMoving(false);
    }).on('pause', function() {
        jw.$stateBtn.removeClass('pause').addClass('play');
        jw.mouseMoving(false);
    }).on('complete', function () {
        jw.$videoPlayer.stop();
        jw.$stateBtn.removeClass('pause').addClass('play');
        jw.$container.addClass('state-complete');
        jw.mouseMoving(false);
    }).on('firstFrame', function() {
        _duration = jw.$videoPlayer.getDuration();
        duration_mins = Math.floor(_duration / 60);
        duration_secs = Math.floor(_duration - duration_mins * 60);
        jw.$durationTime.html(duration_mins + ":" + duration_secs);
    }).on('bufferChange', function(e) {
        // k.log("buffer", e);
        var currentBuffer = e.bufferPercent;
        jw.$progressBar.find('.buffer-bar').css('width', currentBuffer+'%');
    }).on('time', function(e) {
        // k.log("time progress", e);
        if (_duration == 0) {
            duration_mins = Math.floor(e.duration / 60);
            duration_secs = Math.floor(e.duration - duration_mins * 60);
            jw.$durationTime.html(duration_mins + ":" + duration_secs);
            _duration = e.duration;
         }

        var currentTime = e.position,
            currentMins = Math.floor(currentTime / 60),
            currentSecs = Math.floor(currentTime - currentMins * 60),
            percent = (currentTime / e.duration) * 100;

        if (currentSecs < 10) {
            currentSecs = "0" + currentSecs;
        }

        jw.$current.html(currentMins + ":" + currentSecs);
        jw.$progressBar.find('.current-bar').css('width', percent+'%');
    }).on('mute', function() {
        // jw.updateVolume(0,0);
    }).on('fullScreen', function() {
        jw$videoPlayer.resize('100%','100%');
    });

    jw.$stateBtn.on('click', function() {
        jw.$videoPlayer.play();
    });

    jw.$progressBar.on('click', function(e) {
        var ratio = e.offsetX / jw.$progressBar.outerWidth(),
            duration = jw.$videoPlayer.getDuration(),
            current = duration * ratio;
        jw.$videoPlayer.seek(current);
    });

    jw.$container.find('#video-player, .infos-bar .picto').on('click', function(e) {
        jw.$container.find('.infos-bar .info, .infos-bar .picto').addClass('hide');
        jw.$container.removeClass('state-init');
        jw.$videoPlayer.play();
        // $(this).off('click');
    });

    jw.$sound.on('click', '.sound-btn', function() {
        jw.updateMute();
    });

    var volumeDrag = false;
    $('.sound-bar').on('mousedown', function(e) {
        volumeDrag = true;
        jw.$videoPlayer.setMute(false);
        // jw.$sound.find('.sound-btn').removeClass('muted');
        jw.updateVolume(e.pageX);
    });

    $(document).on('mouseup', function(e) {
        if(volumeDrag) {
            volumeDrag = false;
            jw.updateVolume(e.pageX);
        }
    }).on('mousemove', function(e) {
        if(volumeDrag) {
            jw.updateVolume(e.pageX);
        }
    });

    if (fullScreenApi.supportsFullScreen) {
        jw.$fullscreen[0].addEventListener('click', function() {
            if(!fullScreenApi.isFullScreen()) {
                fullScreenApi.requestFullScreen(jw.$container[0]);
                jw.$videoPlayer.resize('100%','100%');
                jw.mouseMoving(true);
            } else {
                fullScreenApi.cancelFullScreen();
                jw.$videoPlayer.resize('100%','100%');
                jw.mouseMoving(false);
            }
        }, true);
    }
};

jw.updateVolume = function(x, vol) {
    var volume = jw.$sound.find('.sound-bar'),
        percentage;
    if (vol) {
        percentage = vol;
    } else {
        var position = x - volume.offset().left;
        percentage = 100 * position / volume.width();
    }
    
    if (percentage > 100) {
        percentage = 100;
    } else if (percentage < 0) {
        percentage = 0;
    }
    
    jw.$sound.find('.sound-seek').css('width',percentage+'%');
    jw.$videoPlayer.setVolume(percentage);
};

jw.updateMute = function() {
    if (jw.$videoPlayer.getMute()) {
        jw.$videoPlayer.setMute(false);
        jw.$sound.find('.sound-seek').css('width',jw.$videoPlayer.getVolume()+'%');
    } else {
        jw.$videoPlayer.setMute(true);
        jw.$sound.find('.sound-seek').css('width','0%');
    }
}

jw.initChannel = function() {
    jw.sliderChannelsVideo = $(".slider-channels-video").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 500,
      center: true,
      loop: false,
      margin: 80,
      autoWidth: true,
      onInitialized: function() {
        // $('.slider-channels-video .owl-stage').css({ 'margin-left': "-343px" });
      }
    });

    jw.sliderChannelsVideo.owlCarousel();

    jw.sliderChannelsVideo.on('click', '.linkVid', function() {
        k.log('', $(this).closest('.owl-item').index());

        jw.$videoPlayer.playlistItem($(this).closest('.owl-item').index());
        jw.$container.find('.channels-video').removeClass('active');
        jw.$container.find('#video-player').removeClass('overlay-channels');
    });
}

jw.externeControl = function() {
    jw.$topBar.on('click', '.channels', function() {
        jw.$container.find('.channels-video').toggleClass('active');
        jw.$container.find('#video-player').toggleClass('overlay-channels');
    });
}

jw.mouseMoving = function(listen) {
    if(listen) {
        jw.$container.on('mousemove', function(event) {
            k.log('mousemove');
            jw.$container.removeClass('control-hide');
            clearTimeout(thread);
            thread = setTimeout(function() {
                k.log('mouse stopped');
                jw.$container.addClass('control-hide');
            }, timeout);
        });
    } else {
        clearTimeout(thread);
        jw.$container.off('mousemove');
        jw.$container.removeClass('control-hide');
    }
}

$(d).ready(jw.playerInit);