var audioControlBar = 
        '<div class="vCenter">\
            <div class="vCenterKid">\
                <div class="control-bar">\
                    <div class="duration">\
                        <span class="curr">0:00</span>/<span class="total">0:00</span>\
                    </div>\
                    <div class="progress">\
                        <div class="progress-bar">\
                            <div class="buffer-bar"></div>\
                            <div class="current-bar"></div>\
                        </div>\
                    </div>\
                    <div class="sound">\
                        <button class="icon icon_son"></button>\
                        <div class="sound-bar">\
                            <div class="sound-seek"></div>\
                        </div>\
                    </div>\
                </div>\
            </div>\
        </div>';

function audioInit(id, cls, havePlaylist) {
    cls          = cls || 'audio-player-container';
    havePlaylist = havePlaylist || false;
    var tmp;

    if (id) {
        var audioPlayer = jwplayer(id);
        if(!$(audioPlayer).data('loaded')) {
            audioLoad($("#"+id)[0], audioPlayer, havePlaylist, function(aid) {
                $(aid).data('loaded', true);
                tmp = aid;
            });
        } else {
            tmp = audioPlayer
        }
        return tmp;
    } else {
        tmp = [];
        $("."+cls).each(function(i,v) {
            var audioPlayer  = jwplayer(this.id);
            if(!$(audioPlayer).data('loaded')) {
                audioLoad(this, audioPlayer, havePlaylist, function(aid) {
                    $(aid).data('loaded', true);
                    tmp[i] = aid;
                });
            } else {
                tmp[i] = audioPlayer;
            }
        });
        return tmp;
    }
};

function updateShareLink() {
    var $audio    = $('.audio-container');
    var fbHref = 'http://www.facebook.com/dialog/feed?app_id=1198653673492784' +
        '&link=CUSTOM_URL' +
        '&picture=CUSTOM_IMAGE' +
        '&name=CUSTOM_NAME' +
        '&caption=' +
        '&description=CUSTOM_DESC' +
        '&redirect_uri=http://www.festival-cannes.com/fr/sharing' +
        '&display=popup';
    twitterLink  = "//twitter.com/intent/tweet?text=CUSTOM_TEXT";
    $container       = $('.content-article');
    fbHref       = fbHref.replace('CUSTOM_URL', encodeURIComponent($audio.attr('data-link')));
    fbHref       = fbHref.replace('CUSTOM_IMAGE', encodeURIComponent($audio.attr('data-img')));
    fbHref       = fbHref.replace('CUSTOM_NAME', encodeURIComponent($audio.parent().find('.title-article').html()));
    fbHref       = fbHref.replace('CUSTOM_DESC', '');
    $container.find('.buttons .facebook').attr('href', fbHref);
    // CUSTOM LINK TWITTER
    var twHref   = twitterLink;
    twHref       = twHref.replace('CUSTOM_TEXT', encodeURIComponent($audio.parent().find('.title-article').html() + " " + $audio.attr('data-link')));
    $container.find('.buttons .twitter').attr('href', twHref);

}

function audioLoad(aid, playerInstance, havePlaylist, callback) {
    var $container    = $("#"+aid.id).closest('.audio-container');

    if($container.find('.control-bar').length <= 0) {
        $container.find('.on').append(audioControlBar);
    }

    var $stateBtn     = $container.find('.play-btn'),
        $infoBar      = $container.find('.off'),
        $controlBar   = $container.find('.on'),
        $durationTime = $container.find('.total'),
        $current      = $container.find('.curr'),
        $progressBar  = $container.find('.progress-bar'),
        $sound        = $container.find('.sound');

     playerInstance.setup({
        // file: $container.data('file'),
        sources: $container.data('file'),
        image: $container.data('img'),
        primary: 'html5',
        aspectratio: '16:9',
        width: $(aid).parent('div').width(),
        height: $(aid).parent('div').height(),
        controls: false
    });
     console.log({
        // file: $container.data('file'),
        sources: $container.data('file'),
        image: $container.data('img'),
        primary: 'html5',
        aspectratio: '16:9',
        width: $(aid).parent('div').width(),
        height: $(aid).parent('div').height(),
        controls: false
    });

    playerInstance.on('ready', function() {
        updateShareLink();
        this.setVolume(100);
    }).on('play', function() {
        $container.removeClass('state-init').removeClass('state-complete');
        $stateBtn.find('i').removeClass('icon_play').addClass('icon_pause');
        $infoBar.find('.picto').addClass('hide');
        $controlBar.addClass('show');
    }).on('pause', function() {
        $stateBtn.find('i').removeClass('icon_pause').addClass('icon_play');
    }).on('buffer', function() {
        // console.log("");
    }).on('complete', function () {
        this.stop();
        $stateBtn.find('i').removeClass('icon_pause').addClass('icon_play');
        $container.addClass('state-complete');
    }).on('firstFrame', function() {
        _duration = playerInstance.getDuration();
        duration_mins = Math.floor(_duration / 60);
        duration_secs = Math.floor(_duration - duration_mins * 60);
        $durationTime.html(duration_mins + ":" + (duration_secs < 10 ? '0'+ duration_secs : duration_secs));
    }).on('bufferChange', function(e) {
        var currentBuffer = e.bufferPercent;
        $progressBar.find('.buffer-bar').css('width', currentBuffer+'%');
    }).on('time', function(e) {
        if (typeof _duration === "undefined" || _duration == 0) {
            duration_mins = Math.floor(e.duration / 60);
            duration_secs = Math.floor(e.duration - duration_mins * 60);
            $durationTime.html(duration_mins + ":" + (duration_secs < 10 ? '0'+ duration_secs : duration_secs));
            _duration = e.duration;
         }

        var currentTime = e.position,
            currentMins = Math.floor(currentTime / 60),
            currentSecs = Math.floor(currentTime - currentMins * 60),
            percent = (currentTime / e.duration) * 100;

        if (currentSecs < 10) {
            currentSecs = "0" + currentSecs;
        }

        $current.html(currentMins + ":" + currentSecs);
        $progressBar.find('.current-bar').css('width', percent+'%');
    });

    $stateBtn.on('click', function() {
        playerInstance.play();
    });

    $progressBar.on('click', function(e) {
        var ratio = e.offsetX / $progressBar.outerWidth(),
            duration = playerInstance.getDuration(),
            current = duration * ratio;
        playerInstance.seek(current);
    });

    if(havePlaylist && havePlaylist === "grid") {
        var playlist = [];

        $.each($('#gridAudios .item'), function(i,p) {
            playlist.push({
                "sources"  : $(p).data('sound'),
                "image"    : $(p).find('img').attr('src'),
                "date"     : $(p).find('.info .date').text(),
                "hour"     : $(p).find('.info .hour').text(),
                "category" : $(p).find('.info .category').text(),
                "name"     : $(p).find('.info p').text()
            });
        });

        playerInstance.load(playlist);
    }

    function updateVolume(x, vol) {
        var volume = $sound.find('.sound-bar'),
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

        $sound.find('.sound-seek').css('width',percentage+'%');
        playerInstance.setVolume(percentage);
    };

    playerInstance.updateMute = function(force) {
        force = force || false;
        if (force) {
            playerInstance.setMute(true);
            $sound.find('.sound-seek').css('width','0%');
        } else {
            if (playerInstance.getMute()) {
                playerInstance.setMute(false);
                $sound.find('.sound-seek').css('width',playerInstance.getVolume()+'%');
            } else {
                playerInstance.setMute(true);
                $sound.find('.sound-seek').css('width','0%');
            }
        }
    }

    playerInstance.stopMute = function() {
        playerInstance.setMute(false);
        $sound.find('.sound-seek').css('width','100%');
    }

    $sound.on('click', '.icon_son', function() {
        playerInstance.updateMute();
    });

    var volumeDrag = false;
    $sound.find('.sound-bar').on('mousedown', function(e) {
        volumeDrag = true;
        playerInstance.setMute(false);
        updateVolume(e.pageX);
    });

    $(document).on('mouseup', function(e) {
        if(volumeDrag) {
            volumeDrag = false;
            updateVolume(e.pageX);
        }
    }).on('mousemove', function(e) {
        if(volumeDrag) {
            updateVolume(e.pageX);
        }
    });

    callback(playerInstance);
}

$(document).ready(function() {
    if($('.audio-player-container').length > 0) {
        audioPlayer = audioInit(false, 'audio-player-container', false);
    }
});