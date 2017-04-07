var timeout = 1000,
    thread,
    time,
    controlBar =
        '<div class="control-bar">\
            <div class="playstate">\
                <button class="play-btn play icon icon-play"></button>\
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
                <button class="icon icon-sound"></button>\
                <div class="sound-bar">\
                    <div class="sound-seek"></div>\
                </div>\
            </div>\
            <div class="fs">\
                <button class="icon icon-fullscreen"></button>\
            </div>\
        </div>',
    topBar =
        '<div class="top-bar">\
            <a href="#" class="channels"><i class="icon icon-playlist"></i></a>\
            <div class="info"></div>\
            <div class="buttons square">\
                <a href="//www.facebook.com/sharer.php?u=CUSTOM_URL" rel="nofollow" class="button facebook ajax"><i class="icon icon-facebook"></i></a>\
                <a href="//twitter.com/intent/tweet?text=CUSTOM_TEXT" class="button twitter"><i class="icon icon-twitter"></i></a>\
                <a href="#" class="button link"><i class="icon icon-link"></i></a>\
                <a href="#" class="button email"><i class="icon icon-lettre"></i></a>\
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
                <div class="picto"><i class="icon icon-playlist"></i></div>\
                    <div class="info-container">\
                        <div class="vCenter">\
                            <div class="vCenterKid">\
                            <a href="#" class="category"></a>\
                            <span></span>\
                            <p></p>\
                        </div>\
                    </div>\
                </div>\
            </div>\
        </div>',
    facebookLink = 'http://www.facebook.com/dialog/feed?app_id=1198653673492784' +
        '&link=CUSTOM_URL' +
        '&picture=CUSTOM_IMAGE' +
        '&name=CUSTOM_NAME' +
        '&caption=' +
        '&description=CUSTOM_DESC' +
        '&redirect_uri=http://www.festival-cannes.com/fr/sharing' +
        '&display=popup',
    $topBar = '',
    twitterLink = "//twitter.com/intent/tweet?text=CUSTOM_TEXT";

function playerInit(id, cls, havePlaylist, live) {
    cls = cls || 'video-player';
    havePlaylist = havePlaylist || false;
    live = live || false;
    var tmp;


    if (id) {
        var videoPlayer = jwplayer(id);
        if (!$(videoPlayer).data('loaded')) {
            playerLoad($("#" + id)[0], videoPlayer, havePlaylist, live, function (vid) {
                $(vid).data('loaded', true);
                tmp = vid;
            });
        } else {
            tmp = videoPlayer;
        }
        return tmp;
    } else {
        tmp = [];
        $("." + cls).each(function (i, v) {
            if(this.firstElementChild !== null) {
            var videoPlayer = jwplayer(this.firstElementChild.id);
            if (!$(videoPlayer).data('loaded')) {
                playerLoad(this.firstElementChild, videoPlayer, havePlaylist, live, function (vid) {
                    $(vid).data('loaded', true);
                    tmp[i] = vid;
                });
            } else {
                tmp[i] = videoPlayer;
            }
            }
        });
        return tmp;
    }
};

function playerLoad(vid, playerInstance, havePlaylist, live, callback) {
    var $container = $("#" + vid.id).parent();

    console.log("cont", $container);
    if ($container.find('.control-bar').length <= 0) {
        $container.append(controlBar);
    }
    if ($container.find('.top-bar').length <= 0) {
        $(topBar).insertAfter($container.find('#' + vid.id));
    }

    var $infoBar = $container.find('.infos-bar'),
        $stateBtn = $container.find('.play-btn'),
        $durationTime = $container.find('.duration-time'),
        $current = $container.find('.current-time'),
        $progressBar = $container.find('.progress-bar'),
        $fullscreen = $container.find('.fs button'),
        $sound = $container.find('.sound'),
        $topBar = $container.find('.top-bar'),
        $playlist = [];

    $topBar.find('.info').append($infoBar.find('.info').html());

    if ($('.container-webtv-ba-video').length > 0) {
        var shareUrl = $('.video .video-container').attr('data-link');
    } else if ($('.audio-container').length > 0) {
        var shareUrl = GLOBALS.urls.audiosUrl + '#vid=' + $container.data('vid');
    } else {
        var shareUrl = GLOBALS.urls.videosUrl + '#vid=' + $container.data('vid');
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

        $sound.find('.sound-seek').css('width', percentage + '%');
        playerInstance.setVolume(percentage);
    };

    playerInstance.updateMute = function (force) {
        force = force || false;
        if (force) {
            playerInstance.setMute(true);
            playerInstance.setVolume(0);
            $sound.find('.sound-seek').css('width', '0%');
        } else {
            if (playerInstance.getMute()) {
                playerInstance.setMute(false);
                $sound.find('.sound-seek').css('width', playerInstance.getVolume() + '%');
            } else {
                playerInstance.setMute(true);
                $sound.find('.sound-seek').css('width', '0%');
            }
        }
    }

    playerInstance.stopMute = function () {
        playerInstance.setMute(false);
        playerInstance.setVolume(100);
        $sound.find('.sound-seek').css('width', '100%');
    }

    playerInstance.removeFullscreen = function () {
        $container.find('.channels-video').removeClass('active');
        $container.find('.jwplayer').removeClass('overlay-channels');
        fullScreenApi.cancelFullScreen();
        $fullscreen.removeClass('icon_reverseFullScreen').addClass('icon_fullscreen');
        playerInstance.resize('100%', '100%');
        mouseMoving(false);
    }

    function externeControl() {
        $topBar.on('click', '.channels', function () {
            $container.find('.channels-video').toggleClass('active');
            $container.find('.jwplayer').toggleClass('overlay-channels');
        });
    }

    function mouseMoving(listen) {
        if (listen) {
            $container.on('mousemove', function (event) {
                $container.removeClass('control-hide');
                clearTimeout(thread);
                thread = setTimeout(function () {
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
            margin: 81,
            autoWidth: true,
        });

        sliderChannelsVideo.owlCarousel();
        sliderChannelsVideo.on('click', '.owl-item', function () {
            var index = $(this).index();
            playerInstance.playlistItem(index);

            var infos = $.parseJSON($(this).find('.channel.video').data('json'));
            $topBar.find('.info .category').text(infos.category);
            $topBar.find('.info .date').text(infos.date);
            $topBar.find('.info .hour').text(infos.hour);
            $topBar.find('.info p').text(infos.name);

            $container.find('.channels-video').removeClass('active');
            $container.find('.jwplayer').removeClass('overlay-channels');

            sliderChannelsVideo.trigger('to.owl.carousel', [index, 1, true]);
            if ($('#slider-trailer').length > 0) {
                sliderTrailerVideo = $('#slider-trailer').owlCarousel();
                sliderTrailerVideo.trigger('to.owl.carousel', [index, 1000, true]);

                if ($('.infos-videos').length > 0) {
                    $('.infos-videos strong').text(infos.category);
                    $('.infos-videos .time').text(infos.date + " . " + infos.hour);
                    $('.infos-videos p').text(infos.name);
                }
            }

            if ($('#slider-movie-videos').length > 0) {
                sliderMovieVideo = $('#slider-movie-videos').owlCarousel();
                sliderMovieVideo.trigger('to.owl.carousel', [index, 1000, true]);
            }

            if ($('.infos-videos .buttons').length > 0) {
                updateShareLink(index, '.infos-videos');
            } else if ($('.informations-video .buttons').length > 0) {
                updateShareLink(index, '.informations-video');
            } else {
                updateShareLink(index);
            }

            if ($('#gridVideos')) {
                var item = $('#gridVideos .item')[index];
                var vid = $(item).data('vid');
                var newURL = window.location.href.split('#')[0] + '#vid=' + vid;
                history.replaceState('', document.title, newURL);
            }
        });

        if ($('#slider-trailer').length > 0) {

            //ici
            var hash = window.location.hash;

            if(hash.indexOf('vid') > -1) {

                setTimeout(function(){

                    var n = 0;
                    var index = hash.substring(5);
                    index = Number(index);

                    if($('.video-container').length > 0){
                        data = $('.video-container');
                    }else{
                        data = $('.html5-video-container');
                    }

                    data = data.data('playlist');

                    data.forEach(function(value, i){

                        if(value.vid == index) {
                            playerInstance.playlistItem(i);
                            $topBar.find('.info .category').text(value.category);
                            $topBar.find('.info .date').text(value.date);
                            $topBar.find('.info .hour').text(value.hour);
                            $topBar.find('.info p').text(value.name);

                            if ($('.infos-videos').length > 0) {
                                $('.infos-videos strong').text(value.category);
                                $('.infos-videos .time').text(value.date + " . " + value.hour);
                                $('.infos-videos p').text(value.name);
                            }

                            if ($('.infos-videos .buttons').length > 0) {
                                updateShareLink(i, '.infos-videos');
                            } else if ($('.informations-video .buttons').length > 0) {
                                updateShareLink(i, '.informations-video');
                            } else {
                                updateShareLink(i);
                            }

                            $container.find('.channels-video').removeClass('active');
                            $container.find('.jwplayer').removeClass('overlay-channels');

                            $('#slider-trailer').trigger('to.owl.carousel', [i, 1000, true]);

                        }
                    });
                }, 1000);


            }

            $('body').on('click', '#slider-trailer .owl-item', function (e) {
                var index = $(this).index();
                playerInstance.playlistItem(index);

                var infos = $.parseJSON($(sliderChannelsVideo.find('.channel.video')[index]).data('json'));
                $topBar.find('.info .category').text(infos.category);
                $topBar.find('.info .date').text(infos.date);
                $topBar.find('.info .hour').text(infos.hour);
                $topBar.find('.info p').text(infos.name);

                if ($('.infos-videos').length > 0) {
                    $('.infos-videos strong').text(infos.category);
                    $('.infos-videos .time').text(infos.date + " . " + infos.hour);
                    $('.infos-videos p').text(infos.name);
                }

                if ($('.infos-videos .buttons').length > 0) {
                    updateShareLink(index, '.infos-videos');
                } else if ($('.informations-video .buttons').length > 0) {
                    updateShareLink(index, '.informations-video');
                } else {
                    updateShareLink(index);
                }

                $container.find('.channels-video').removeClass('active');
                $container.find('.jwplayer').removeClass('overlay-channels');

                sliderChannelsVideo.trigger('to.owl.carousel', [index, 1000, true]);
            });
        }

        if ($('#slider-movie-videos').length > 0) {
            $('body').on('click', '#slider-movie-videos .owl-item', function (e) {
                var index = $(this).index();
                playerInstance.playlistItem(index);
                updateShareLink(index);

                var infos = $.parseJSON($(sliderChannelsVideo.find('.channel.video')[index]).data('json'));
                $topBar.find('.info .category').text(infos.category);
                $topBar.find('.info .date').text(infos.date);
                $topBar.find('.info .hour').text(infos.hour);
                $topBar.find('.info p').text(infos.name);
                $container.find('.owl-stage .owl-item').removeClass('active');
                $container.find('.channels-video').removeClass('active');
                $(this).addClass('active');
                $container.find('.jwplayer').removeClass('overlay-channels');
                sliderChannelsVideo.trigger('to.owl.carousel', [index, 1000, true]);
            });
        }
    }

    var playerHeight = $('.home').length ? 550 : $container.height();

    console.log('setup',{
        sources: $container.data('file'),
        image: $container.data('img'),
        primary: 'html5',
        aspectratio: '16:9',
        width: $(vid).closest('div').width(),
        skin: 'seven',
        height: playerHeight,
        controls: ($('body').hasClass('tablet')) ? true : false
    })
    playerInstance.setup({
        sources: $container.data('file'),
        image: $container.data('img'),
        primary: 'html5',
        aspectratio: '16:9',
        width: $(vid).closest('div').width(),
        skin: 'seven',
        height: playerHeight,
        controls: ($('body').hasClass('tablet')) ? true : false
    });


    if (havePlaylist) {
        var tempSlider = $(slider),
            playlist = [];

        if (havePlaylist === "grid") {
            $.each($('#gridVideos .item'), function (i, p) {
                var tempList = {
                    "sources": $(p).data('file'),
                    "image": $(p).data('img'),
                    "date": $(p).data('date'),
                    "hour": $(p).data('hour'),
                    "category": $(p).find('.info .category').text(),
                    "name": $(p).find('.info p').text()
                }
                playlist.push(tempList);
            });

        } else if (typeof $container.data('playlist') != "undefined") {
            playlist = $container.data('playlist');
        }

        $.each(playlist, function (i, p) {
            var tempSlide = $(slide);
            tempSlide.find('.image-wrapper img').attr('src', p.image);
            tempSlide.find('.info-container .category').text(p.category);
            tempSlide.find('.info-container p').text(p.name.trunc(30, true))
            tempSlide.data('json', JSON.stringify(p));
            tempSlider.find('.slider-channels-video').append(tempSlide);
        });
        $playlist = playlist;
        tempSlider.insertAfter($topBar);
        initChannel();
        playerInstance.load(playlist);

        if(typeof playlist[0] !== 'undefined'){
            $topBar.find('.info .category').text(playlist[0].category);
            $topBar.find('.info .date').text(playlist[0].date);
            $topBar.find('.info .hour').text(playlist[0].hour);
            $topBar.find('.info p').text(playlist[0].name);
        }

        if ($('.infos-videos .buttons').length > 0) {
            linkPopinInit(0, '.infos-videos .buttons .link');
            updateShareLink(0, '.infos-videos');

            $('.infos-videos .buttons .email').on('click', function (e) {
                e.preventDefault();
                launchPopinMedia({}, playerInstance);
            });
        } else if ($('.informations-video .buttons').length > 0) {
            linkPopinInit(0, '.informations-video .buttons .link');
            updateShareLink(0, '.informations-video');

            $('.informations-video .buttons .email').on('click', function (e) {
                e.preventDefault();
                launchPopinMedia({}, playerInstance);
            });
        } else {
            updateShareLink();
        }
    } else {
        $topBar.find('.channels').remove();
    }

    if (live) {
        $container.find('.time').addClass('hide');
        $container.find('.progress').addClass('hide');
        $topBar.find('.channels').remove();
    }

    function updateShareLink(index, secondaryContainer) {
        index = index || 0;
        sc = secondaryContainer || 0;

        if(typeof $playlist[index] !== 'undefined'){
            // CUSTOM LINK FACEBOOK
            if ($('.container-webtv-ba-video').length > 0) {
                /*var shareUrl = $('.video .video-container').attr('data-link');*/

                hash = window.location.hash;
                var url = window.location.href.split('#')[0];
                shareUrl = url + "#vid=" + $playlist[index].vid;

            } else if (window.location.href.indexOf('web-tv/channel') != -1 || window.location.href.indexOf('_html/channel.php') != -1 ) {

                hash = window.location.hash;
                var url = window.location.href.split('#')[0];
                shareUrl = url + "#vid=" + $playlist[index].vid;

            } else if ($('.audio-container').length > 0) {
                var shareUrl = GLOBALS.urls.audiosUrl + '#vid=' + $playlist[index].vid;
            } else {
                var shareUrl = GLOBALS.urls.videosUrl + '#vid=' + $playlist[index].vid;
            }

            var fbHref = facebookLink;
            fbHref = fbHref.replace('CUSTOM_URL', encodeURIComponent(shareUrl));
            fbHref = fbHref.replace('CUSTOM_IMAGE', encodeURIComponent($playlist[index].image));
            fbHref = fbHref.replace('CUSTOM_NAME', encodeURIComponent($playlist[index].category));
            fbHref = fbHref.replace('CUSTOM_DESC', encodeURIComponent($playlist[index].name));
            $topBar.find('.buttons .facebook').attr('href', fbHref);

            // CUSTOM LINK TWITTER
            var twHref = twitterLink;
            twHref = twHref.replace('CUSTOM_TEXT', encodeURIComponent($playlist[index].name + " " + shareUrl));
            $topBar.find('.buttons .twitter').attr('href', twHref);

            // CUSTOM LINK COPY
            $topBar.find('.buttons .link').attr('href', shareUrl);
            $topBar.find('.buttons .link').attr('data-clipboard-text', shareUrl);
            function updatePopinMedia(data) {
                data['url'] = data['url'] || document.location.href;

                if ($('.popin-mail').length) {
                    if(typeof data['category'] !== 'undefined'){
                        $('.popin-mail').find('.contain-popin .theme-article').text(data['category']);
                    }
                    if(typeof data['date'] !== 'undefined'){
                        $('.popin-mail').find('.contain-popin .date-article').text(data['date']);
                    }
                    if(typeof data['title'] !== 'undefined'){
                        $('.popin-mail').find('.contain-popin .title-article').text($(data['title']).text());
                    }
                    if(typeof data['category'] !== 'undefined'){
                        $('.popin-mail').find('form #contact_section').val(data['category']);
                    }
                    if(typeof data['date'] !== 'undefined'){
                        $('.popin-mail').find('form #contact_detail').val(data['date']);
                    }
                    if(typeof data['title'] !== 'undefined'){
                        $('.popin-mail').find('form #contact_title').val(data['title']);
                    }
                    if(typeof data['url'] !== 'undefined'){
                        $('.popin-mail').find('form #contact_url').val(data['url']);
                    }
                    $('.popin-mail').find('.chap-article').html('');

                }
            }
            updatePopinMedia({
                'type': "video",
                'category': $playlist[index].category,
                'date': $playlist[index].date,
                'title': $playlist[index].name,
                'url': shareUrl
            });
        }

        if (sc) {
            $(sc).find('.buttons .facebook').attr('data-href', fbHref);
            $(sc).find('.buttons .facebook').attr('href', fbHref);
            $(sc).find('.buttons .twitter').attr('href', twHref);
            $(sc).find('.buttons .link').attr('href', shareUrl);
            $(sc).find('.buttons .link').attr('data-clipboard-text', shareUrl);
        }
    }


    playerInstance.on('ready', function () {
        this.setVolume(100);
        externeControl();
    }).on('play', function () {
        $container.removeClass('state-init').removeClass('state-complete');
        $container.find('.infos-bar .info, .infos-bar .picto').addClass('hide');
        $container.find('.channels-video').removeClass('active');
        $container.find('.jwplayer').removeClass('overlay-channels');
        $stateBtn.removeClass('icon-play').addClass('icon-pause');
        fullScreenApi.isFullScreen() ? mouseMoving(true) : mouseMoving(false);
    }).on('pause', function () {
        $stateBtn.removeClass('icon-pause').addClass('icon-play');
        mouseMoving(false);
    }).on('buffer', function () {
    }).on('complete', function () {
        this.stop();
        $stateBtn.removeClass('icon-pause').addClass('icon-play');
        $container.addClass('state-complete');
        mouseMoving(false);
    }).on('firstFrame', function () {
        _duration = playerInstance.getDuration();
        duration_mins = Math.floor(_duration / 60);
        duration_secs = Math.floor(_duration - duration_mins * 60);
        $durationTime.html(duration_mins + ":" + duration_secs);
    }).on('bufferChange', function (e) {
        var currentBuffer = e.bufferPercent;
        $progressBar.find('.buffer-bar').css('width', currentBuffer + '%');
    }).on('time', function (e) {
        if (typeof _duration === "undefined" || _duration == 0) {
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
        $progressBar.find('.current-bar').css('width', percent + '%');
    }).on('fullScreen', function () {
        this.resize('100%', '100%');
    });

    $stateBtn.on('click', function () {
        playerInstance.play();
    });

    $progressBar.on('click', function (e) {
        var ratio = e.offsetX / $progressBar.outerWidth(),
            duration = playerInstance.getDuration(),
            current = duration * ratio;
        playerInstance.seek(current);
    });

    $container.find('.video-player, .infos-bar .picto').on('click', function (e) {
        $container.find('.infos-bar .info, .infos-bar .picto').addClass('hide');
        $container.removeClass('state-init');
        playerInstance.play();
        // $(this).off('click');
    });

    $sound.on('click', '.icon-sound', function () {
        playerInstance.updateMute();
    });

    var volumeDrag = false;
    $sound.find('.sound-bar').on('mousedown', function (e) {
        volumeDrag = true;
        playerInstance.setMute(false);
        updateVolume(e.pageX);
    });

    $(document).on('mouseup', function (e) {
        if (volumeDrag) {
            volumeDrag = false;
            updateVolume(e.pageX);
        }
    }).on('mousemove', function (e) {
        if (volumeDrag) {
            updateVolume(e.pageX);
        }
    });

    if (fullScreenApi.supportsFullScreen) {
        $fullscreen[0].addEventListener('click', function () {
            if (!fullScreenApi.isFullScreen()) {
                fullScreenApi.requestFullScreen($container[0]);
                $fullscreen.removeClass('icon_fullscreen').addClass('icon_reverseFullScreen');
                playerInstance.resize('100%', '100%');
                mouseMoving(true);
            } else {
                $container.find('.channels-video').removeClass('active');
                $container.find('.jwplayer').removeClass('overlay-channels');
                fullScreenApi.cancelFullScreen();
                $fullscreen.removeClass('icon_reverseFullScreen').addClass('icon_fullscreen');
                playerInstance.resize('100%', '100%');
                mouseMoving(false);
            }
        }, true);

        document.addEventListener(fullScreenApi.fullScreenEventName, function (e) {
            if (!fullScreenApi.isFullScreen()) {
                $container.find('.channels-video').removeClass('active');
                $container.find('.jwplayer').removeClass('overlay-channels');
                $fullscreen.removeClass('icon_reverseFullScreen').addClass('icon_fullscreen');
            }
        }, true);
    }

    callback(playerInstance);
};

$(document).ready(function () {

    //hotfix thomon, trigger click on hidden layers to enlarge click zone
    var playerLoadInterval = window.setInterval(function(){
        if($('.video-data-layer .state-init .playstate').length){
            $('.video-data-layer .state-init .playstate').on('click',function(){
                if($(this).closest('.state-init').length){
                    $(this).closest('.state-init').removeClass('state-init');
                }
                $(this).find('.play-btn').trigger('click');
            });
            window.clearInterval(playerLoadInterval);
        }
    },300);

    if ($('#video-player-ba').length > 0) {
        videoMovieBa = playerInit('video-player-ba', false, true);
    }

    if ($('.video-player').length > 0) {
        var dataFile = $('.video-player').data('file');
        var isPlaylist = false;
        if(typeof dataFile !== 'undefined'){
            if(typeof dataFile === 'string'){
                dataFile = JSON.parse(dataFile);
            }
            if(dataFile.length > 2){
                isPlaylist = true;
            }
        }
        videoPlayer = playerInit(false, 'video-player', isPlaylist);
    }

    if ($('.video-player-pl').length > 0) {
        videoPlayer = playerInit(false, 'video-player-pl', true);
    }
});