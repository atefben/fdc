// Todo generate structure à la volée
// playlist à la volée

var play1, play2, play3;

var d = document,
    w = window,
    k = k || new Konsole('fdc.2016', true),
    timeout = 1000,
    thread,
    controlBar =
        '<div class="control-bar">\
            <div class="playstate">\
                <button class="play-btn play icon icon_play"></button>\
            </div>\
            <div class="time">\
                <p class="time-info">\
                    <span class="current-time">0:00</span> / <span class="duration-time">0:00</span>\
                </p>\
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
            <div class="fs">\
                <button class="icon icon_fullscreen"></button>\
            </div>\
        </div>',
    topBar =
        '<div class="top-bar">\
            <a href="#" class="channels"><i class="icon icon_playlist"></i></a>\
            <div class="info"></div>\
            <div class="buttons square">\
            <a href="//www.facebook.com/sharer.php?u=html.festival-cannes-2016.com.ohwee.fr&t=le%20titre" onclick="javascript:window.open(this.href,\'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700\');return false;" rel="nofollow" class="button facebook ajax"><i class="icon icon_facebook"></i></a>\
                <a href="#" onclick="window.open(\'https://twitter.com/intent/tweet?text=Enrages%20Polar%20Hybride\',\'\',\'width=600,height=400\')" class="button twitter"><i class="icon icon_twitter"></i></a>\
                <a href="#" class="button link"><i class="icon icon_link"></i></a>\
                <a href="#" class="button email"><i class="icon icon_lettre"></i></a>\
            </div>\
        </div>',
    slider =
        '<div class="channels-video">\
            <div class="slider-channels-video owl-carousel sliderDrag">\
            </div>\
        </div>',
    slide = 
        '<div class="channel video shadow-bottom">\
            <div class="image-wrapper">\
                <img src="" alt="" width="293" height="185">\
            </div>\
            <a class="linkVid" href="#"></a>\
            <div class="info">\
                <div class="picto"><i class="icon icon_playlist"></i></div>\
                    <div class="info-container">\
                        <div class="vCenter">\
                            <div class="vCenterKid">\
                            <a href="#" class="category"></a>\
                            <span></span>\
                            <p>Sils Maria</p>\
                        </div>\
                    </div>\
                </div>\
            </div>\
        </div>';

function playerInit(id, cls, havePlaylist, live) {
    cls          = cls || '.video-player';
    havePlaylist = havePlaylist || false;
    live         = live || false;
    var tmp;

    if (id) {
        var videoPlayer = jwplayer(id);
        if(!$(videoPlayer).data('loaded')) {
            player($("#"+id)[0], videoPlayer, cls, havePlaylist, live, function(vid){
                $(vid).data('loaded', true);
                tmp = vid;
            });
        }
        return tmp;
    } else {
        tmp = [];
        $(cls).each(function(i,v) {
            // k.log("",this);
            // k.log("",this.className);
            // k.log("",this.id);
            var videoPlayer  = jwplayer(this.id);
            if(!$(videoPlayer).data('loaded')) {
                player(this, videoPlayer, cls, havePlaylist, live, function(vid){
                    $(vid).data('loaded', true);
                    tmp[i] = vid;
                });
            } else {
                tmp[i] = videoPlayer;
            }
        });
        return tmp;
    }
};

function player(vid, playerInstance, cls, havePlaylist, live, callback) {
    var $container    = $("#"+vid.id).closest('.video-container');
    $container.append(controlBar);
    $(topBar).insertAfter($container.find('#'+vid.id));

    var $infoBar      = $container.find('.infos-bar'),
        $stateBtn     = $container.find('.play-btn'),
        $durationTime = $container.find('.duration-time'),
        $current      = $container.find('.current-time'),
        $progressBar  = $container.find('.progress-bar'),
        $fullscreen   = $container.find('.fs button'),
        $sound        = $container.find('.sound'),
        $topBar       = $container.find('.top-bar');

    $topBar.find('.info').append($infoBar.find('.info').html());
    $topBar.find('.buttons .facebook').attr('href', $container.data('facebook'));
    $topBar.find('.buttons .twitter').attr('href', $container.data('twitter'));
    $topBar.find('.buttons .link').attr('href', $container.data('link'));
    $topBar.find('.buttons .email').attr('href', $container.data('email'));

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

    function updateMute() {
        if (playerInstance.getMute()) {
            playerInstance.setMute(false);
            $sound.find('.sound-seek').css('width',playerInstance.getVolume()+'%');
        } else {
            playerInstance.setMute(true);
            $sound.find('.sound-seek').css('width','0%');
        }
    }

    function externeControl() {
        $topBar.on('click', '.channels', function() {
            $container.find('.channels-video').toggleClass('active');
            $container.find('.jwplayer').toggleClass('overlay-channels');
        });
    }

    function mouseMoving(listen) {
        if(listen) {
            $container.on('mousemove', function(event) {
                k.log('mousemove');
                $container.removeClass('control-hide');
                clearTimeout(thread);
                thread = setTimeout(function() {
                    k.log('mouse stopped');
                    $container.addClass('control-hide');
                }, timeout);
            });
        } else {
            clearTimeout(thread);
            $container.off('mousemove');
            $container.removeClass('control-hide');
        }
    }

    function initChannel() {
        sliderChannelsVideo = $container.find(".slider-channels-video").owlCarousel({
          nav: false,
          dots: false,
          smartSpeed: 500,
          center: true,
          loop: false,
          margin: 80,
          autoWidth: true,
        });

        sliderChannelsVideo.owlCarousel();
        sliderChannelsVideo.on('click', '.linkVid', function() {
            k.log('', $(this).closest('.owl-item'));

            playerInstance.playlistItem($(this).closest('.owl-item').index());
            
            console.log($(this).closest('.channel.video'));
            var infos = $.parseJSON($(this).closest('.channel.video').data('json'));
            k.log('', infos);
            $topBar.find('.info .category').text(infos.category);
            $topBar.find('.info p').text(infos.name);
            
            $container.find('.channels-video').removeClass('active');
            $container.find('.jwplayer').removeClass('overlay-channels');
        });
    }

    playerInstance.setup({
        file: $container.data('file'),
        image: $container.data('image'), 
        primary: 'html5',
        aspectratio: '16:9',
        width: $(vid).parent('div').width(),
        height: $(vid).parent('div').height(),
        controls: false
    });

    if (havePlaylist) {
        var tempSlider = $(slider),
            playlist   = $.parseJSON($container.data('playlist'));
        $.each(playlist, function(i,p) {
            var tempSlide = $(slide);
            tempSlide.find('.image-wrapper img').attr('src',p.image);
            tempSlide.find('.info-container .category').text(p.category);
            tempSlide.find('.info-container p').text(p.name)
            tempSlide.data('json', JSON.stringify(p));
            tempSlider.find('.slider-channels-video').append(tempSlide);
        });
        tempSlider.insertAfter($topBar);
        initChannel();
        playerInstance.load(playlist);
    } else {
        $topBar.find('.channels').remove();
    }

    if (live) {
        $container.find('.time').addClass('hide');
        $container.find('.progress').addClass('hide');
        $topBar.find('.channels').remove();
    }


    playerInstance.on('ready', function() {
        this.setVolume(100)
        // initChannel();
        externeControl();
    }).on('play', function() {
        $container.removeClass('state-init').removeClass('state-complete');
        $container.find('.infos-bar .info, .infos-bar .picto').addClass('hide');
        $container.find('.channels-video').removeClass('active');
        $container.find('.jwplayer').removeClass('overlay-channels');
        $stateBtn.removeClass('icon_play').addClass('icon_pause');
        fullScreenApi.isFullScreen() ? mouseMoving(true) : mouseMoving(false);
    }).on('pause', function() {
        $stateBtn.removeClass('icon_pause').addClass('icon_play');
        mouseMoving(false);
    }).on('complete', function () {
        this.stop();
        $stateBtn.removeClass('icon_pause').addClass('icon_play');
        $container.addClass('state-complete');
        mouseMoving(false);
    }).on('firstFrame', function() {
        _duration = playerInstance.getDuration();
        duration_mins = Math.floor(_duration / 60);
        duration_secs = Math.floor(_duration - duration_mins * 60);
        $durationTime.html(duration_mins + ":" + duration_secs);
    }).on('bufferChange', function(e) {
        // k.log("buffer", e);
        var currentBuffer = e.bufferPercent;
        $progressBar.find('.buffer-bar').css('width', currentBuffer+'%');
    }).on('time', function(e) {
        // k.log("time progress", e);
        if (_duration == 0) {
            duration_mins = Math.floor(e.duration / 60);
            duration_secs = Math.floor(e.duration - duration_mins * 60);
            $durationTime.html(duration_mins + ":" + duration_secs);
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
    }).on('fullScreen', function() {
        this.resize('100%','100%');
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

    $container.find('.video-player, .infos-bar .picto').on('click', function(e) {
        $container.find('.infos-bar .info, .infos-bar .picto').addClass('hide');
        $container.removeClass('state-init');
        playerInstance.play();
        // $(this).off('click');
    });

    $sound.on('click', '.sound-btn', function() {
        updateMute();
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

    if (fullScreenApi.supportsFullScreen) {
        $fullscreen[0].addEventListener('click', function() {
            if(!fullScreenApi.isFullScreen()) {
                fullScreenApi.requestFullScreen($container[0]);
                $fullscreen.removeClass('icon_fullscreen').addClass('icon_reverseFullScreen');
                playerInstance.resize('100%','100%');
                mouseMoving(true);
            } else {
                fullScreenApi.cancelFullScreen();
                $fullscreen.removeClass('icon_reverseFullScreen').addClass('icon_fullscreen');
                playerInstance.resize('100%','100%');
                mouseMoving(false);
            }
        }, true);
    }

    // return playerInstance;
    callback(playerInstance);
};

$(d).ready(function() {
    play1 = playerInit('video-player', false, true, false);
    // play1 = playerInit('video-player', false, $('#video-player').data('playlist'), false);
    // play2 = playerInit(false, '.video-player', true, false);
    // play3 = playerInit(false, 'video-live', false, true);
});
