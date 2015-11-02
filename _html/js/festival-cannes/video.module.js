var jw = jw || {},
    d  = document,
    w  = window;

jw.playerInit = function() {
    if($('#video-player').length) {
        jw.$videoPlayer  = jwplayer('video-player');
        jw.$stateBtn     = $('.play-btn');
        jw.$durationTime = $('.duration-time');
        jw.$current      = $('.current-time');
        jw.$progressBar  = $('.progress-bar');
        jw.$fullscreen   = $('.fs-icon');
        jw.$container    = $('#video-container');
        jw.$sound        = $('.sound');
        jw.$picto        = $('.video-player .picto');

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
        playlist: [
            {
                file: './files/mov_bbb.mp4',
                title: 'Video 0',
                image: $('#video-player').parent('div').data('img')
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
    }).on('ready', function(){
        jw.$videoPlayer.setVolume(100);
    }).on('play', function(){
        jw.$stateBtn.removeClass('play');
        jw.$stateBtn.addClass('pause');
    }).on('pause', function(){
        jw.$stateBtn.removeClass('pause');
        jw.$stateBtn.addClass('play');
    }).on('firstFrame', function() {
        _duration = jw.$videoPlayer.getDuration();
        duration_mins = Math.floor(_duration / 60);
        duration_secs = Math.floor(_duration - duration_mins * 60);
        jw.$durationTime.html(duration_mins + ":" + duration_secs);
    }).on('time', function(e) {
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
        $('.current-bar').css('width', percent+'%');
    }).on('mute', function() {
        // jw.updateVolume(0,0);
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

    jw.$picto.on('click', function(e) {
        var $player = $(this).parents('.video-player');
        
        $player.find('.info, .picto').addClass('hide');

        $player.removeClass('state-pause');
        jw.$videoPlayer.play();
    });

    jw.$sound.on('click', '.sound-btn', function() {
        // console.log(jw.$videoPlayer.getVolume());
        // jw.$videoPlayer.setMute(true);
        // console.log(jw.$videoPlayer.getVolume());

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
            } else {
                fullScreenApi.cancelFullScreen();
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

$(d).ready(jw.playerInit);