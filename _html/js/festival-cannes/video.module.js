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
                <a href="//www.facebook.com/sharer.php?u=CUSTOM_URL" rel="nofollow" class="button facebook ajax"><i class="icon icon_facebook"></i></a>\
                <a href="//twitter.com/intent/tweet?text=CUSTOM_TEXT" class="button twitter"><i class="icon icon_twitter"></i></a>\
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
        </div>',
    facebookLink = "//www.facebook.com/sharer.php?u=CUSTOM_URL",
    twitterLink  = "//twitter.com/intent/tweet?text=CUSTOM_TEXT";

function playerInit(id, cls, havePlaylist, live) {
    cls          = cls || 'video-player';
    havePlaylist = havePlaylist || false;
    live         = live || false;
    var tmp;

    if (id) {
        var videoPlayer = jwplayer(id);
        if(!$(videoPlayer).data('loaded')) {
            playerLoad($("#"+id)[0], videoPlayer, havePlaylist, live, function(vid) {
                $(vid).data('loaded', true);
                tmp = vid;
            });
        } else {
            tmp = videoPlayer
        }
        return tmp;
    } else {
        tmp = [];
        $("."+cls).each(function(i,v) {
            // k.log("",this);
            // k.log("",this.className);
            // k.log("",this.id);
            var videoPlayer  = jwplayer(this.id);
            if(!$(videoPlayer).data('loaded')) {
                playerLoad(this, videoPlayer, havePlaylist, live, function(vid) {
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

function playerLoad(vid, playerInstance, havePlaylist, live, callback) {
    var $container    = $("#"+vid.id).closest('.video-container');
    if($container.find('.control-bar').length <= 0) {
        $container.append(controlBar);
    }
    if($container.find('.top-bar').length <= 0) {
        $(topBar).insertAfter($container.find('#'+vid.id));
    }

    var $infoBar      = $container.find('.infos-bar'),
        $stateBtn     = $container.find('.play-btn'),
        $durationTime = $container.find('.duration-time'),
        $current      = $container.find('.current-time'),
        $progressBar  = $container.find('.progress-bar'),
        $fullscreen   = $container.find('.fs button'),
        $sound        = $container.find('.sound'),
        $topBar       = $container.find('.top-bar'),
        $playlist     = [];

    $topBar.find('.info').append($infoBar.find('.info').html());
    // CUSTOM LINK FACEBOOK
    var fbHref = $topBar.find('.buttons .facebook').attr('href');
    fbHref = fbHref.replace('CUSTOM_URL', encodeURI(GLOBALS.urls.videosUrl+'#'+$container.data('vid')));
    $topBar.find('.buttons .facebook').attr('href', fbHref);
    // CUSTOM LINK TWITTER
    var twHref = $topBar.find('.buttons .twitter').attr('href');
    if(typeof $container.data('name') != 'undefined' && $container.data('name').length > 0) {
        twHref = twHref.replace('CUSTOM_TEXT', encodeURI($container.data('name')+" "+GLOBALS.urls.videosUrl+"#"+$container.data('vid')));
    } else {
        twHref = twHref.replace('CUSTOM_TEXT', encodeURI($topBar.find('.info p').text()+" "+GLOBALS.urls.videosUrl+"#"+$container.data('vid')));
    }
    $topBar.find('.buttons .twitter').attr('href', twHref);
    // CUSTOM LINK COPY
    $topBar.find('.buttons .link').attr('href', encodeURI(GLOBALS.urls.videosUrl+'#'+$container.data('vid')));
    $topBar.find('.buttons .link').attr('data-clipboard-text', encodeURI(GLOBALS.urls.videosUrl+'#'+$container.data('vid')));
    // CUSTOM LINK MAIL
    $topBar.find('.buttons .email').attr('href', $container.data('email'));
    linkPopinInit(encodeURI(GLOBALS.urls.videosUrl+'#'+$container.data('vid')));

    $topBar.find('.buttons .twitter').on('click', function(){
        window.open(this.href,'','width=700,height=500');
        return false;
    });
    $topBar.find('.buttons .facebook').on('click',function(){
        window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');
        return false;
    });

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
                // k.log('mousemove');
                $container.removeClass('control-hide');
                clearTimeout(thread);
                thread = setTimeout(function() {
                    // k.log('mouse stopped');
                    $container.addClass('control-hide');
                }, timeout);
            });
        } else {
            clearTimeout(thread);
            $container.off('mousemove');
            $container.removeClass('control-hide');
        }
    }

    function updateShareLink(index) {
        index = index || 0;

        // CUSTOM LINK FACEBOOK
        var fbHref = facebookLink;
        fbHref = fbHref.replace('CUSTOM_URL', encodeURI(GLOBALS.urls.videosUrl+'#'+$playlist[index].vid));
        $topBar.find('.buttons .facebook').attr('href', fbHref);
        // CUSTOM LINK TWITTER
        var twHref = twitterLink;
        twHref = twHref.replace('CUSTOM_TEXT', encodeURI($playlist[index].name+" "+GLOBALS.urls.videosUrl+"#"+$playlist[index].vid));
        $topBar.find('.buttons .twitter').attr('href', twHref);
        // CUSTOM LINK COPY
        $topBar.find('.buttons .link').attr('href', encodeURI(GLOBALS.urls.videosUrl+'#'+$playlist[index].vid));
        $topBar.find('.buttons .link').attr('data-clipboard-text', encodeURI(GLOBALS.urls.videosUrl+'#'+$playlist[index].vid));
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
        sliderChannelsVideo.on('click', '.owl-item', function() {
            var index = $(this).index();
            playerInstance.playlistItem(index);
            updateShareLink(index);

            var infos = $.parseJSON($(this).find('.channel.video').data('json'));
            $topBar.find('.info .category').text(infos.category);
            $topBar.find('.info p').text(infos.name);

            $container.find('.channels-video').removeClass('active');
            $container.find('.jwplayer').removeClass('overlay-channels');

            sliderChannelsVideo.trigger('to.owl.carousel',[index,1,true]);
            if($('#slider-trailer').length > 0) {
                sliderTrailerVideo = $('#slider-trailer').owlCarousel();
                sliderTrailerVideo.trigger('to.owl.carousel',[index,1000,true]);
            }
            if($('#slider-movie-videos').length > 0) {
                sliderMovieVideo = $('#slider-movie-videos').owlCarousel();
                sliderMovieVideo.trigger('to.owl.carousel',[index,1000,true]);
            }

            if($('#gridVideos')) {
                var item = $('#gridVideos .item')[index];
                var vid  = $(item).data('vid');

                var newURL = window.location.href.split('#')[0] + '#vid=' + vid;
                history.replaceState('', document.title, newURL);
            }
        });

        if($('#slider-trailer').length > 0) {
            $('body').on('click', '#slider-trailer .owl-item', function(e) {
                var index = $(this).index();
                playerInstance.playlistItem(index);
                updateShareLink(index);

                var infos = $.parseJSON($(sliderChannelsVideo.find('.channel.video')[index]).data('json'));
                $topBar.find('.info .category').text(infos.category);
                $topBar.find('.info .date').text(infos.date);
                $topBar.find('.info .hour').text(infos.hour);
                $topBar.find('.info p').text(infos.name);

                if($('.infos-videos').length > 0) {
                    $('.infos-videos strong').text(infos.category);
                    $('.infos-videos .time').text(infos.date+" . "+infos.hour);
                    $('.infos-videos p').text(infos.name);
                }

                $container.find('.channels-video').removeClass('active');
                $container.find('.jwplayer').removeClass('overlay-channels');

                sliderChannelsVideo.trigger('to.owl.carousel',[index,1000,true]);
            });
        }

        if($('#slider-movie-videos').length > 0) {
            $('body').on('click', '#slider-movie-videos .owl-item', function(e) {
                var index = $(this).index();
                playerInstance.playlistItem(index);
                updateShareLink(index);

                var infos = $.parseJSON($(sliderChannelsVideo.find('.channel.video')[index]).data('json'));
                $topBar.find('.info .category').text(infos.category);
                $topBar.find('.info .date').text(infos.date);
                $topBar.find('.info .hour').text(infos.hour);
                $topBar.find('.info p').text(infos.name);

                $container.find('.channels-video').removeClass('active');
                $container.find('.jwplayer').removeClass('overlay-channels');

                sliderChannelsVideo.trigger('to.owl.carousel',[index,1000,true]);
            });
        }
    }

    playerInstance.setup({
        // file: $container.data('file'),
        sources: $container.data('file'),
        image: $container.data('img'),
        primary: 'html5',
        aspectratio: '16:9',
        width: $(vid).parent('div').width(),
        height: $(vid).parent('div').height(),
        controls: false
    });

    if (havePlaylist) {
        var tempSlider = $(slider),
            playlist   = [];

        if (havePlaylist === "grid") {
            $.each($('#gridVideos .item'), function(i,p) {
                var tempList = {
                    "sources"  : $(p).data('file'),
                    "image"    : $(p).data('img'),
                    "name"     : $(p).find('.info .category').text(),
                    "category" : $(p).find('.info p').text()
                }
                playlist.push(tempList);
            });
        } else if (typeof $container.data('playlist') != "undefined") {
            playlist = $container.data('playlist');
        }

        $.each(playlist, function(i,p) {
            var tempSlide = $(slide);
            tempSlide.find('.image-wrapper img').attr('src',p.image);
            tempSlide.find('.info-container .category').text(p.category);
            tempSlide.find('.info-container p').text(p.name)
            tempSlide.data('json', JSON.stringify(p));
            tempSlider.find('.slider-channels-video').append(tempSlide);
        });
        $playlist = playlist;
        tempSlider.insertAfter($topBar);
        initChannel();
        updateShareLink();
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
        this.setVolume(100);
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
        var currentBuffer = e.bufferPercent;
        $progressBar.find('.buffer-bar').css('width', currentBuffer+'%');
    }).on('time', function(e) {
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

    $sound.on('click', '.icon_son', function() {
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
                $container.find('.channels-video').removeClass('active');
                $container.find('.jwplayer').removeClass('overlay-channels');

                fullScreenApi.cancelFullScreen();
                $fullscreen.removeClass('icon_reverseFullScreen').addClass('icon_fullscreen');
                playerInstance.resize('100%','100%');
                mouseMoving(false);
            }
        }, true);

        document.addEventListener(fullScreenApi.fullScreenEventName, function(e) {
            if (!fullScreenApi.isFullScreen()) {
                $container.find('.channels-video').removeClass('active');
                $container.find('.jwplayer').removeClass('overlay-channels');
                $fullscreen.removeClass('icon_fullscreen').addClass('icon_reverseFullScreen');
            }
        }, true);
    }

    callback(playerInstance);
};

$(d).ready(function() {
    if($('#video-player-pl').length > 0) {
        videoPlayer = playerInit('video-player-pl', false, true);
    }

    if($('#video-player-ba').length > 0) {
        videoMovieBa = playerInit('video-player-ba', false, true)
    }

    if($('.video-player').length > 0) {
        videoPlayer = playerInit(false, 'video-player', false);
    }

    if($('.video-player-pl').length > 0) {
        videoPlayer = playerInit(false, 'video-player-pl', true);
    }
});
