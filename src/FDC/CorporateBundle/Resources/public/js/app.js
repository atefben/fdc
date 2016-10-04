var videoNews;

var initVideo = function(hash) {
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
                <div class="buttons square img-slideshow-share rs-slideshow">\
                    <a class="facebook button" href="http://www.facebook.com/dialog/feed?app_id=1198653673492784&link=http://www.festival-cannes.com/fr/films/bacalaureat&picture=http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/film_poster/0001/02/thumb_1458_film_poster_293x397.jpeg&name=BACALAUREAT%20-%20Festival%20de%20Cannes&caption=&description=Romeo%2C%20m%C3%A9decin%20dans%20une%20petite%20ville%20de%20Transylvanie%2C%20a%20tout%20mis%20en%20%C5%93uvre%20pour%20que%20sa%20fille%2C%20Eliza%2C%20soit%20accept%C3%A9e%20dans%20une%20universit%C3%A9%20anglaise.%20%0D%0AIl%20ne%20reste%20plus%20%C3%A0%20la%20jeune%20fille%2C%20tr%C3%A8s%20bonne%20%C3%A9l%C3%A8ve%2C%20qu%E2%80%99une%20formalit%C3%A9%20qui%20ne%20devrait%20pas%20poser%20de%20probl%C3%A8me%20%3A%20obtenir%20son%20baccalaur%C3%A9at.%20%0D%0AMais%20Eliza%20se%20fait%20agresser%20et%20le%20pr%C3%A9cieux%20s%C3%A9same%20semble%20brutalement%20hors%20de%20port%C3%A9e.%20Avec%20lui%2C%20c%E2%80%99est%20toute%20la%20vie%20de%20Romeo%20qui%20est%20remise%20en%20question%20quand%20il%20oublie%20alors%20tous%20les%20principes%20qu%E2%80%99il%20a%20inculqu%C3%A9s%20%C3%A0%20sa%20fille%2C%20entre%20%20compromis%20et%20compromissions%E2%80%A6&redirect_uri=http://www.festival-cannes.com/fr/sharing&display=popup"><i class="icon icon-facebook"></i></a>\
                    <a class="twitter button" href="https://twitter.com/intent/tweet?text=BACALAUREAT%20http://www.festival-cannes.com/fr/films/bacalaureat"><i class="icon icon-twitter"></i></a>\
                    <a href="#" rel="nofollow" class="link self button" data-clipboard-text="http://www.festival-cannes.com/fr/films/bacalaureat"><i class="icon icon-link"></i></a>\
                    <a href="#" class="popin-mail-open button"><i class="icon icon-letter"></i></a>\
                </div>\
                <div class="texts-clipboard"></div>\
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
        twitterLink  = "//twitter.com/intent/tweet?text=CUSTOM_TEXT";

    function playerInit(id, cls, havePlaylist, live) {
        cls          = cls || 'video-player';
        havePlaylist = havePlaylist || false;
        live         = live || false;
        var tmp;

        if (id) {
            var videoPlayer = jwplayer(id);

            if(!$(videoPlayer).data('loaded') || $('.activeVideo').length > 0 ) {
                console.log('loaded');
                playerLoad($("#"+id)[0], videoPlayer, havePlaylist, live, function(vid) {
                    $(vid).data('loaded', true);
                    tmp = vid;
                });
            } else {
                console.log('else');
                tmp = videoPlayer
            }
            return tmp;
        } else {
            tmp = [];
            $("."+cls).each(function(i,v) {
                // console.log("",this);
                // console.log("",this.className);
                // console.log("",this.id);
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
            $fullscreen   = $container.find('.icon-fullscreen'),
            $sound        = $container.find('.sound'),
            $topBar       = $container.find('.top-bar'),
            $playlist     = [];

        $topBar.find('.info').append($infoBar.find('.info').html());

        if($('.container-webtv-ba-video').length > 0) {
            var shareUrl = $('.video .video-container').attr('data-link');
        } else {
            var shareUrl = GLOBALS.urls.videosUrl+'#vid='+$container.data('vid');
        }

        // CUSTOM LINK FACEBOOK
        var fbHref = $topBar.find('.buttons .facebook').attr('href');
        fbHref = fbHref.replace('CUSTOM_URL', encodeURIComponent(shareUrl));
        $topBar.find('.buttons .facebook').attr('href', fbHref);
        // CUSTOM LINK TWITTER
        var twHref = $topBar.find('.buttons .twitter').attr('href');
        if(typeof $container.data('name') != 'undefined' && $container.data('name').length > 0) {
            twHref = twHref.replace('CUSTOM_TEXT', encodeURIComponent($container.data('name')+" "+shareUrl));
        } else {
            twHref = twHref.replace('CUSTOM_TEXT', encodeURIComponent($topBar.find('.info p').text()+" "+shareUrl));
        }
        $topBar.find('.buttons .twitter').attr('href', twHref);

        // CUSTOM LINK COPY
        $topBar.find('.buttons .link').attr('href', shareUrl);
        $topBar.find('.buttons .link').attr('data-clipboard-text', shareUrl);
        /*
         linkPopinInit(shareUrl, '#'+vid.id+' + .'+$topBar[0].className.replace(' ','.')+' .buttons .link');
         */

        $topBar.find('.buttons .facebook').on('click',function() {
            window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=700,height=500');
            return false;
        });
        $topBar.find('.buttons .twitter').on('click', function() {
            window.open(this.href,'','width=700,height=500');
            return false;
        });

        // CUSTOM LINK MAIL
        $topBar.find('.buttons .popin-mail-open').attr('href', $container.data('email'));
        $topBar.find('.buttons .popin-mail-open').on('click', function(e) {
            fullScreenApi.cancelFullScreen();
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

        playerInstance.updateMute = function(force) {
            force = force || false;
            if (force) {
                playerInstance.setMute(true);
                playerInstance.setVolume(0);
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
            playerInstance.setVolume(100);
            $sound.find('.sound-seek').css('width','100%');
        }

        playerInstance.removeFullscreen = function() {
            $container.find('.channels-video').removeClass('active');
            $container.find('.jwplayer').removeClass('overlay-channels');
            fullScreenApi.cancelFullScreen();
            $fullscreen.removeClass('icon-reverseFullscreen').addClass('icon-fullscreen');
            playerInstance.resize('100%','100%');
            mouseMoving(false);
        }

        function externeControl() {

        }

        function mouseMoving(listen) {
            if(listen) {
                $container.on('mousemove', function(event) {
                    $container.removeClass('control-hide');
                    clearTimeout(thread);
                    thread = setTimeout(function() {
                        $container.addClass('control-hide');
                    }, timeout);
                });
            } else {
                clearTimeout(thread);
                $container.off('mousemove');
                $container.removeClass('control-hide');
            }
        }

        function updateShareLink(index, secondaryContainer) {
            index = index || 0;
            sc    = secondaryContainer || 0;

            // CUSTOM LINK FACEBOOK
            if($('.container-webtv-ba-video').length > 0) {
                var shareUrl = $('.video .video-container').attr('data-link');
            } else {
                var shareUrl = GLOBALS.urls.videosUrl+'#vid='+$playlist[index].vid;
            }

            var fbHref   = facebookLink;
            fbHref       = fbHref.replace('CUSTOM_URL', encodeURIComponent(shareUrl));
            fbHref       = fbHref.replace('CUSTOM_IMAGE', encodeURIComponent($playlist[index].image));
            fbHref       = fbHref.replace('CUSTOM_NAME', encodeURIComponent($playlist[index].category));
            fbHref       = fbHref.replace('CUSTOM_DESC', encodeURIComponent($playlist[index].name));
            $topBar.find('.buttons .facebook').attr('href', fbHref);

            // CUSTOM LINK TWITTER
            var twHref   = twitterLink;
            twHref       = twHref.replace('CUSTOM_TEXT', encodeURIComponent($playlist[index].name+" "+shareUrl));
            $topBar.find('.buttons .twitter').attr('href', twHref);

            // CUSTOM LINK COPY
            $topBar.find('.buttons .link').attr('href', shareUrl);
            $topBar.find('.buttons .link').attr('data-clipboard-text', shareUrl);

//         updatePopinMedia({
//             'type'     : "video",
//             'category' : $playlist[index].category,
//             'date'     : $playlist[index].date,
//             'title'    : $playlist[index].name,
//             'url'      : shareUrl
//         });

            if (sc) {
                $(sc).find('.buttons .facebook').attr('data-href', fbHref);
                $(sc).find('.buttons .facebook').attr('href', fbHref);
                $(sc).find('.buttons .twitter').attr('href', twHref);
                $(sc).find('.buttons .link').attr('href', shareUrl);
                $(sc).find('.buttons .link').attr('data-clipboard-text', shareUrl);
            }
        }

        function initChannel() {

            var sliderChannelsVideo = $('.slider-02').owlCarousel({
                navigation          : false,
                items               : 1,
                autoWidth           : true,
                smartSpeed          : 700,
                center              : true,
                margin              : 27.5
            });

            // Custom Navigation Events
            $(document).on('click', '.slider-02 .owl-item', function(){
                var index = $(this).index();
                $('.slider-02 .center').removeClass('center');
                $(this).addClass('center');
                sliderChannelsVideo.trigger('to.owl.carousel', index);
                changeVideo(index,playerInstance,$(this));
            });

            sliderChannelsVideo.on('translated.owl.carousel', function () {
                index = $('.slider-02 .center').index();
                changeVideo(index,playerInstance,$('.slider-02 .center'));
            })

            var changeVideo = function (index, playerInstance, exThis) {

                sliderChannelsVideo.trigger('to.owl.carousel', index);

                playerInstance.playlistItem(index);

                var infos = $.parseJSON(exThis.find('.channel.video').data('json'));
                $topBar.find('.info .category').text(infos.category);
                $topBar.find('.info .date').text(infos.date);
                $topBar.find('.info .hour').text(infos.hour);
                $topBar.find('.info p').text(infos.name);

                $container.find('.channels-video').removeClass('active');
                $container.find('.jwplayer').removeClass('overlay-channels');

                sliderChannelsVideo.trigger('to.owl.carousel',[index,1,true]);
            }
        }

        if($('.activeVideo').length > 0) {
            var videoFile =  $('.activeVideo').data('file');
            var videoImage =  $('.activeVideo').data('img');
        }

        console.log(videoFile);

        playerInstance.setup({
            // file: $container.data('file'),
            sources: $('.activeVideo').length > 0 ? videoFile : $container.data('file'),
            image: $('.activeVideo').length > 0 ? videoImage :  $container.data('img'),
            primary: 'html5',
            aspectratio: '16:9',
            width: $(vid).parent('div').width(),
            height: $(vid).parent('div').height(),
            controls: ($('body').hasClass('mobile')) ? true : false
        });

        if(havePlaylist) {
            var tempSlider = $(slider),
                playlist   = [];

            if(havePlaylist === "grid") {
                $.each($('.grid-01 .item.video'), function(i,p) {
                    var tempList = {
                        "sources"  : $(p).data('file'),
                        "image"    : $(p).data('img'),
                        "date"     : $(p).data('date'),
                        "hour"     : $(p).data('hour'),
                        "category" : $(p).find('.info .category').text(),
                        "name"     : $(p).find('.info p').text()
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
                tempSlide.data('json', JSON.stringify(p));
                tempSlider.find('.slider-channels-video').append(tempSlide);
            });
            $playlist = playlist;

            console.log(playlist)

            initChannel();
            playerInstance.load(playlist);


            if($('.infos-videos .buttons').length > 0) {
                linkPopinInit(0, '.infos-videos .buttons .link');
                updateShareLink(0, '.infos-videos');

                $('.infos-videos .buttons .email').on('click', function(e) {
                    e.preventDefault();
                    launchPopinMedia({}, playerInstance);
                });
            } else if($('.informations-video .buttons').length > 0) {
                linkPopinInit(0, '.informations-video .buttons .link');
                updateShareLink(0, '.informations-video');

                $('.informations-video .buttons .email').on('click', function(e) {
                    e.preventDefault();
                    launchPopinMedia({}, playerInstance);
                });
            } else {
                updateShareLink();
            }
        }else{
            $('.channels').css('display', 'none');
        }



        playerInstance.on('ready', function() {
            this.setVolume(100);
            externeControl();
        }).on('play', function() {
            $container.removeClass('state-init').removeClass('state-complete');
            $container.find('.infos-bar .info, .infos-bar .picto').addClass('hide');
            $container.find('.channels-video').removeClass('active');
            $container.find('.jwplayer').removeClass('overlay-channels');
            $stateBtn.removeClass('icon-play').addClass('icon-pause');

        }).on('pause', function() {
            $stateBtn.removeClass('icon-pause').addClass('icon-play');
            mouseMoving(false);
        }).on('buffer', function() {
            // console.log("");
        }).on('complete', function () {
            this.stop();
            $stateBtn.removeClass('icon-pause').addClass('icon-play');
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

        $sound.on('click', '.icon-sound', function() {
            playerInstance.updateMute();
        });

        if (fullScreenApi.supportsFullScreen) {
            $fullscreen[0].addEventListener('click', function() {
                if(!fullScreenApi.isFullScreen()) {
                    fullScreenApi.requestFullScreen($container[0]);
                    $fullscreen.removeClass('icon-fullscreen').addClass('icon-reverseFullscreen');
                    playerInstance.resize('100%','100%');
                    mouseMoving(true);
                } else {
                    $container.find('.channels-video').removeClass('active');
                    $container.find('.jwplayer').removeClass('overlay-channels');
                    fullScreenApi.cancelFullScreen();
                    $fullscreen.removeClass('icon-reverseFullscreen').addClass('icon-fullscreen');
                    playerInstance.resize('100%','100%');
                    mouseMoving(false);
                }
            }, true);

            document.addEventListener(fullScreenApi.fullScreenEventName, function(e) {
                if (!fullScreenApi.isFullScreen()) {
                    $container.find('.channels-video').removeClass('active');
                    $container.find('.jwplayer').removeClass('overlay-channels');
                    $fullscreen.removeClass('icon-reverseFullscreen').addClass('icon-fullscreen');
                }
            }, true);
        }

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
    };


    var initPopinVideo = function(hash) {

        if(hash != undefined) {

            $this = $('.item.video[data-vid="'+hash+'"');

            $('.activeVideo').removeClass('activeVideo');
            $this.addClass('activeVideo');

            var $popinVideo = $('.popin-video'),
                vid = $this.data('vid'),
                source = $this.data('file'),
                img = $this.data('img'),
                category = $this.find('.category').text(),
                date = $this.find('.date').text(),
                hour = $this.find('.hour').text(),
                name = $this.data('title');

            videoNews = playerInit('video-player-popin', false, false);

            var hashPush = '#vid='+vid;
            history.pushState(null, null, hashPush);

            setTimeout(function(){
                videoNews.play();
            }, 800);


            // CUSTOM LINK FACEBOOK
            if ($('.container-webtv-ba-video').length > 0) {
                var shareUrl = $('.video .video-container').attr('data-link');
            } else {
                var shareUrl = GLOBALS.urls.videosUrl + '#vid=' + vid;
            }

            var fbHref = facebookLink;


            fbHref = fbHref.replace('CUSTOM_URL', encodeURIComponent(shareUrl));
            fbHref = fbHref.replace('CUSTOM_IMAGE', encodeURIComponent(img));
            fbHref = fbHref.replace('CUSTOM_NAME', encodeURIComponent(category));
            fbHref = fbHref.replace('CUSTOM_DESC', encodeURIComponent(name));

            $('#video-player-popin + .top-bar').find('.buttons .facebook').attr('href', fbHref);
            // CUSTOM LINK TWITTER
            var twHref = twitterLink;
            twHref = twHref.replace('CUSTOM_TEXT', encodeURIComponent(name + " " + shareUrl));
            $('#video-player-popin + .top-bar').find('.buttons .twitter').attr('href', twHref);
            // CUSTOM LINK COPY
            $('#video-player-popin + .top-bar').find('.buttons .link').attr('href', shareUrl);
            $('#video-player-popin + .top-bar').find('.buttons .link').attr('data-clipboard-text', shareUrl);

            $('.popin-video').find('.popin-buttons.buttons .facebook').attr('data-href', fbHref);
            $('.popin-video').find('.popin-buttons.buttons .facebook').attr('href', fbHref);
            $('.popin-video').find('.popin-buttons.buttons .twitter').attr('href', twHref);
            $('.popin-video').find('.popin-buttons.buttons .link').attr('href', shareUrl);
            $('.popin-video').find('.popin-buttons.buttons .link').attr('data-clipboard-text', shareUrl);

            updatePopinMedia({
                'type': "video",
                'category': category,
                'date': date,
                'title': name,
                'url': shareUrl
            });

            $popinVideo.find('.popin-info .category').text(category);
            $popinVideo.find('.popin-info .date').text(date);
            $popinVideo.find('.popin-info .hour').text(hour);
            $popinVideo.find('.popin-info p').text(name);
            $popinVideo.addClass('video-player show loading');
            $('.ov').addClass('show');

            $('#main').addClass('overlay');

            setTimeout(function(){
                $('div.vFlexAlign, #main, footer, #logo-wrapper, #navigation').on('click', function(e){

                    videoNews.stop();
                    videoNews.setMute(true);

                    videoNews = 0;

                    $popinVideo.removeClass('show');
                    $popinVideo.removeClass('video-player');
                    $popinVideo.removeClass('loading');
                    $popinVideo.css('display','none');
                    $('#main').removeClass('overlay');
                    $('.activeVideo').removeClass('activeVideo');
                    $(videoNews).data('loaded', false);

                    $('div.vFlexAlign, #main, footer, #logo-wrapper, #navigation').off('click');
                });
            }, 1000);


            initRs();
        }


        $('.item.video').on('click', function (e) {

            e.preventDefault();

            $('.activeVideo').removeClass('activeVideo');
            $(this).addClass('activeVideo');

            var $popinVideo = $('.popin-video'),
                vid = $(e.target).closest('.video').data('vid'),
                source = $(e.target).closest('.video').data('file'),
                img = $(e.target).closest('.video').data('img'),
                category = $(e.target).closest('.video').find('.category').text(),
                date = $(e.target).closest('.video').find('.date').text(),
                hour = $(e.target).closest('.video').find('.hour').text(),
                name = $(e.target).closest('.video').data('title');

            videoNews = playerInit('video-player-popin', false, false);

            var hashPush = '#vid='+vid;
            history.pushState(null, null, hashPush);

            $popinVideo.css('display','block');

            setTimeout(function(){
                videoNews.play();
            }, 800);


            // CUSTOM LINK FACEBOOK
            if ($('.container-webtv-ba-video').length > 0) {
                var shareUrl = $('.video .video-container').attr('data-link');
            } else {
                var shareUrl = GLOBALS.urls.videosUrl + '#vid=' + vid;
            }

            var fbHref = facebookLink;


            fbHref = fbHref.replace('CUSTOM_URL', encodeURIComponent(shareUrl));
            fbHref = fbHref.replace('CUSTOM_IMAGE', encodeURIComponent(img));
            fbHref = fbHref.replace('CUSTOM_NAME', encodeURIComponent(category));
            fbHref = fbHref.replace('CUSTOM_DESC', encodeURIComponent(name));

            $('#video-player-popin + .top-bar').find('.buttons .facebook').attr('href', fbHref);
            // CUSTOM LINK TWITTER
            var twHref = twitterLink;
            twHref = twHref.replace('CUSTOM_TEXT', encodeURIComponent(name + " " + shareUrl));
            $('#video-player-popin + .top-bar').find('.buttons .twitter').attr('href', twHref);
            // CUSTOM LINK COPY
            $('#video-player-popin + .top-bar').find('.buttons .link').attr('href', shareUrl);
            $('#video-player-popin + .top-bar').find('.buttons .link').attr('data-clipboard-text', shareUrl);

            $('.popin-video').find('.popin-buttons.buttons .facebook').attr('data-href', fbHref);
            $('.popin-video').find('.popin-buttons.buttons .facebook').attr('href', fbHref);
            $('.popin-video').find('.popin-buttons.buttons .twitter').attr('href', twHref);
            $('.popin-video').find('.popin-buttons.buttons .link').attr('href', shareUrl);
            $('.popin-video').find('.popin-buttons.buttons .link').attr('data-clipboard-text', shareUrl);

            updatePopinMedia({
                'type': "video",
                'category': category,
                'date': date,
                'title': name,
                'url': shareUrl
            });

            $popinVideo.find('.popin-info .category').text(category);
            $popinVideo.find('.popin-info .date').text(date);
            $popinVideo.find('.popin-info .hour').text(hour);
            $popinVideo.find('.popin-info p').text(name);
            $popinVideo.addClass('video-player show loading');
            $('.ov').addClass('show');

            $('#main').addClass('overlay');

            setTimeout(function(){
                $('div.vFlexAlign, #main, footer, #logo-wrapper, #navigation').on('click', function(e){

                    videoNews.stop();
                    videoNews.setMute(true);

                    videoNews = 0;

                    $popinVideo.removeClass('show');
                    $popinVideo.removeClass('video-player');
                    $popinVideo.removeClass('loading');
                    $popinVideo.css('display','none');
                    $('#main').removeClass('overlay');
                    $('.activeVideo').removeClass('activeVideo');
                    $(videoNews).data('loaded', false);

                    $('div.vFlexAlign, #main, footer, #logo-wrapper, #navigation').off('click');
                });
            }, 1000);


            initRs();


        });

    }

    function updatePopinMedia(data) {
        data['url'] = data['url'] || document.location.href;

        if($('.popin-mail.media').length) {
            $('.popin-mail.media').find('.contain-popin .theme-article').text(data['category']);
            $('.popin-mail.media').find('.contain-popin .date-article').text(data['date']);
            $('.popin-mail.media').find('.contain-popin .title-article').text(data['title']);
            $('.popin-mail.media').find('form #contact_section').val(data['category']);
            $('.popin-mail.media').find('form #contact_detail').val(data['date']);
            $('.popin-mail.media').find('form #contact_title').val(data['title']);
            $('.popin-mail.media').find('form #contact_url').val(data['url']);
        }
    }

    if($('#video-movie-trailer').length > 0) {
        videoMovie = playerInit('video-movie-trailer');
        videoMovie.resize('100%','100%');
        // show and play trailer
        $('body').on('click', '.poster .picto', function(e) {
            e.preventDefault();

            $('html, body').animate({
                scrollTop: 377
            }, 300, function() {
                $('.main-image, .poster, .info-film, .palmares, .nav').addClass('trailer');
                $('.main-image').data('height', $('.main-image').height()).height($(window).height() - 91).css('padding-top', '91px');
                $('#video-movie-trailer').closest('.video-container').css({
                    'margin-top': '91px',
                    'height' : 'calc(100% - 91px)'
                });
                setTimeout(function() {
                    $('header').addClass('sticky');
                    $('body').css('padding-top', 0);
                }, 800);
            });

            setTimeout(function() {
                videoMovie.play();
            }, 500);

        });
    }else if($('.video-player').length > 0) {
        videoPlayer = playerInit('video-player', 'video-player', false, false);
    }

    if($('.video-playlist').length > 0) {
        videoPlayer = playerInit('video-playlist', 'video-playlist', true, false);
    }

    if ($('#video-player-ba').length > 0) {
        videoMovieBa = playerInit('video-player-ba', false, true)
    }

    if($('.medias').length > 0) {
        initPopinVideo(hash);
    }


}

var owInitAccordion = function(id) {

    if(id == "block-accordion") {

        var $accordion = $('.block-accordion');
        var $title = $('.block-accordion .title-contain');

        $title.on('click', function() {
            $parent = $(this).closest('.item');
            $this = $(this);
            $icon = $(this).find('.icon-nav-accordion');

            if($parent.hasClass('active')) {

                $parent.removeClass('active');
                $icon.removeClass('icon-minus').addClass('icon-create');

            }else{
                $parent.addClass('active');
                $icon.removeClass('icon-create').addClass('icon-minus');

            }
        });
    }

    if(id = "more-search") {
        var $title = $('.more-search .sub-tab .title-cont');

        $title.on('click',function(){
            var $this = $(this).closest('.sub-tab');

            if($this.hasClass('active')){
                $this.find('.icon').removeClass('icon-minus').addClass('icon-create');
            }else{
                $this.find('.icon').addClass('icon-minus').removeClass('icon-create');
            }

            $this.toggleClass('active');
            b
        });
    }
};

var owInitAjax = function() {

    $('.ajax-section nav a').on('click', function(e){
        e.preventDefault;

        var url = $(this).attr('href');

        $.get( url, function( data ) {
            $data = $(data);
            console.log($data);
            contain = $data.find('.contain-ajax')[0];

            test = $data.filter('#breadcrumb').children()[0];

            $( ".ajax-section" ).html(contain);

            $( "#breadcrumb" ).html(test);

            if($('.navigation-sticky-02').length) {
                owInitNavSticky(2);
            }else if($('.navigation-sticky').length) {
                owInitNavSticky(1);
            }

            if($('.isotope-01').length) {
                owInitGrid('isotope-01');
            }

            if($('.medias').length > 0) {

                var hash = window.location.hash;
                hash = hash.substring(1, hash.length);

                verif = hash.slice(0, 3);
                number = hash.slice(4);

                if (hash.length > 0 && verif == "pid") {
                    var slider = $('.grid-01');
                    owinitSlideShow(slider,hash);
                }else{
                    var slider = $('.grid-01');
                    owinitSlideShow(slider);
                }

                if (hash.length > 0 && verif == "vid") {
                    console.log(number);

                    initVideo(number);
                }else{
                    initVideo();
                }

                if (hash.length > 0 && verif == "aid") {
                    initAudio(number);
                }else{
                    initAudio();
                }


            }

            if($('.isotope-02').length) {
                owInitGrid('isotope-02');
            }

            if($('.grid-01').length) {
                var grid = owInitGrid('isotope-01');
                owsetGridBigImg(grid, $('.grid-01'), true);

                $( window ).resize(function() {
                    owsetGridBigImg(grid, $('.grid-01'), false);
                });
            }

            if($('.filters').length) {
                owInitFilter();
            }

            if($('.block-accordion').length) {
                owInitAccordion("block-accordion");
            }

            if($('.block-social-network').length) {
                initRs();

                if($('#share-article').length) {
                    $('#share-article').on('click', function(e) {
                        e.preventDefault();

                        $('html, body').animate({
                            scrollTop: $(".block-social-network").offset().top - $('header').height() - $('.block-social-network').height() - 300
                        }, 500);
                    });
                }
            }

            window.history.pushState('','',url);

            owInitAjax();
        });

        return false;
    });
}


var ajaxMedialib = function() {
    $('.block-search .button-submit').on('click', function(e) {
        e.preventDefault();

        //on récupère les informations

        var url = $('.block-search form').attr('action');
        var keyword = $('.block-search input[name="search"]').val();
        var checked = [];
        var date = [];

        date[1] = $('.block-search #slider-snap-value-lower').html();
        date[2] = $('.block-search #slider-snap-value-upper').html();

        $.each($('.choice'), function(i,v) {
            if($(v).is(":checked")) {
                checked.push($(v).attr('name'));
            }
        })


        //TODO back data

        $.ajax({
            url: url,
            type : 'GET',
        }).done(function(data) {

            grid = $(data);
            $('.grid-01').html(grid);

            //on mets à jour la nouvelle grille

            var grid = $('.isotope-03').isotope({
                itemSelector    : '.item',
                percentPosition : true,
                sortBy          : 'original-order',
                layoutMode      : 'packery',
                packery         : {
                    columnWidth : '.grid-sizer'
                }
            });


            owInitAleaGrid(grid, $('.grid-01'), true);


        });


    })
}


var owInitReadMore = function() {
    var number = 0;

    $('.read-more.ajax-request').on('click', function(e){
        e.preventDefault();

        var url = $(this).attr('href');

        if(number%2 == 0){
            $.get( url, function( data ) {
                data = $(data);
                $('.add-ajax-request').append(data);
            });
        }else{
            url = $(this).data('reverse');

            $.get( url, function( data ) {
                data = $(data);
                $('.add-ajax-request').append(data);
            });
        }

        number++;


    });
}
var initAudio = function (hash) {

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
                            <button class="icon icon-sound"></button>\
                            <div class="sound-bar">\
                                <div class="sound-seek"></div>\
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
        twitterLink = "//twitter.com/intent/tweet?text=CUSTOM_TEXT";

    function audioInit(id, cls, havePlaylist) {
        cls = cls || 'audio-player-container';
        havePlaylist = havePlaylist || false;
        var tmp;

        if (id) {
            var audioPlayer = jwplayer(id);
            if (!$(audioPlayer).data('loaded')) {
                audioLoad($("#" + id)[0], audioPlayer, havePlaylist, function (aid) {
                    $(aid).data('loaded', true);
                    tmp = aid;
                });
            } else {
                tmp = audioPlayer
            }
            return tmp;
        } else {
            tmp = [];
            $("." + cls).each(function (i, v) {
                var audioPlayer = jwplayer(this.id);
                if (!$(audioPlayer).data('loaded')) {
                    audioLoad(this, audioPlayer, havePlaylist, function (aid) {
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
        var $audio = $('.audio-container');
        var fbHref = 'http://www.facebook.com/dialog/feed?app_id=1198653673492784' +
            '&link=CUSTOM_URL' +
            '&picture=CUSTOM_IMAGE' +
            '&name=CUSTOM_NAME' +
            '&caption=' +
            '&description=CUSTOM_DESC' +
            '&redirect_uri=http://www.festival-cannes.com/fr/sharing' +
            '&display=popup';
        twitterLink = "//twitter.com/intent/tweet?text=CUSTOM_TEXT";
        $container = $('.content-article');
        fbHref = fbHref.replace('CUSTOM_URL', encodeURIComponent($audio.attr('data-link')));
        fbHref = fbHref.replace('CUSTOM_IMAGE', encodeURIComponent($audio.attr('data-img')));
        fbHref = fbHref.replace('CUSTOM_NAME', encodeURIComponent($audio.parent().find('.title-article').html()));
        fbHref = fbHref.replace('CUSTOM_DESC', '');
        $container.find('.buttons .facebook').attr('href', fbHref);
        // CUSTOM LINK TWITTER
        var twHref = twitterLink;
        twHref = twHref.replace('CUSTOM_TEXT', encodeURIComponent($audio.parent().find('.title-article').html() + " " + $audio.attr('data-link')));
        $container.find('.buttons .twitter').attr('href', twHref);

    }

    function audioLoad(aid, playerInstance, havePlaylist, callback) {
        var $container = $("#" + aid.id).closest('.audio-container');

        if ($container.find('.control-bar').length <= 0) {
            $container.find('.on').append(audioControlBar);
        }

        var $stateBtn = $container.find('.play-btn'),
            $infoBar = $container.find('.off'),
            $controlBar = $container.find('.on'),
            $durationTime = $container.find('.total'),
            $current = $container.find('.curr'),
            $progressBar = $container.find('.progress-bar'),
            $sound = $container.find('.sound');


        if ($('.activeAudio').length > 0) {
            var audioFile = $('.activeAudio').data('file');
            var audioImage = $('.activeAudio').data('img');
        }


        playerInstance.setup({
            // file: $container.data('file'),
            sources: $('.activeAudio').length > 0 ? audioFile : $container.data('file'),
            image: $('.activeAudio').length > 0 ? audioImage : $container.data('img'),
            primary: 'html5',
            aspectratio: '16:9',
            width: $(aid).parent('div').width(),
            height: $(aid).parent('div').height(),
            controls: false
        });

        playerInstance.on('ready', function () {
            updateShareLink();
            this.setVolume(100);
        }).on('play', function () {
            $container.removeClass('state-init').removeClass('state-complete');
            $stateBtn.find('i').removeClass('icon-play').addClass('icon-pause');
            $infoBar.find('.picto').addClass('hide');
            $controlBar.addClass('show');
        }).on('pause', function () {
            $stateBtn.find('i').removeClass('icon-pause').addClass('icon-play');
        }).on('buffer', function () {
            // console.log("");
        }).on('complete', function () {
            this.stop();
            $stateBtn.find('i').removeClass('icon-pause').addClass('icon-play');
            $container.addClass('state-complete');
        }).on('firstFrame', function () {
            _duration = playerInstance.getDuration();
            duration_mins = Math.floor(_duration / 60);
            duration_secs = Math.floor(_duration - duration_mins * 60);
            $durationTime.html(duration_mins + ":" + (duration_secs < 10 ? '0' + duration_secs : duration_secs));
        }).on('bufferChange', function (e) {
            var currentBuffer = e.bufferPercent;
            $progressBar.find('.buffer-bar').css('width', currentBuffer + '%');
        }).on('time', function (e) {
            if (typeof _duration === "undefined" || _duration == 0) {
                duration_mins = Math.floor(e.duration / 60);
                duration_secs = Math.floor(e.duration - duration_mins * 60);
                $durationTime.html(duration_mins + ":" + (duration_secs < 10 ? '0' + duration_secs : duration_secs));
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

        if (havePlaylist && havePlaylist === "grid") {
            var playlist = [];

            $.each($('#gridAudios .item'), function (i, p) {
                playlist.push({
                    "sources": $(p).data('sound'),
                    "image": $(p).find('img').attr('src'),
                    "date": $(p).find('.info .date').text(),
                    "hour": $(p).find('.info .hour').text(),
                    "category": $(p).find('.info .category').text(),
                    "name": $(p).find('.info p').text()
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

            $sound.find('.sound-seek').css('width', percentage + '%');
            playerInstance.setVolume(percentage);
        };

        playerInstance.updateMute = function (force) {
            force = force || false;
            if (force) {
                playerInstance.setMute(true);
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
            $sound.find('.sound-seek').css('width', '100%');
        }

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

        callback(playerInstance);

    }


    if ($('.audio-player-container').length > 0 && !$('.medias').length > 0) {
        audioPlayer = audioInit(false, 'audio-player-container', false);
    }

    var audioPopin;

    if ($('#audio-player-popin').length > 0) {

        function updatePopinMedia(data) {
            data['url'] = data['url'] || document.location.href;

            if ($('.popin-mail.media').length) {
                $('.popin-mail.media').find('.contain-popin .theme-article').text(data['category']);
                $('.popin-mail.media').find('.contain-popin .date-article').text(data['date']);
                $('.popin-mail.media').find('.contain-popin .title-article').text(data['title']);
                $('.popin-mail.media').find('form #contact_section').val(data['category']);
                $('.popin-mail.media').find('form #contact_detail').val(data['date']);
                $('.popin-mail.media').find('form #contact_title').val(data['title']);
                $('.popin-mail.media').find('form #contact_url').val(data['url']);
            }
        }


        if(hash != undefined) {

            $this = $('.item.audio[data-aid="' + hash + '"');

            $this.addClass('activeAudio');

            var $popinAudio = $('.popin-audio'),
                aid = $this.data('aid'),
                source = $this.data('file'),
                img = $this.data('img'),
                category = $this.find('.category').text(),
                date = $this.find('.date').text(),
                hour = $this.find('.hour').text(),
                name = $this.data('title');

            audioPopin = audioInit('audio-player-popin', false, false);
            audioPopin.playlistItem($this.index() - 1);

            setTimeout(function(){
                var hashPush = '#aid='+aid;
                history.pushState(null, null, hashPush);

                audioPopin.play();
                audioPopin.play();
            }, 900);


            // CUSTOM LINK FACEBOOK
            var shareUrl = GLOBALS.urls.videosUrl + '#aid=' + aid;
            var fbHref = facebookLink;
            fbHref = fbHref.replace('CUSTOM_URL', encodeURIComponent(shareUrl));
            fbHref = fbHref.replace('CUSTOM_IMAGE', encodeURIComponent(img));
            fbHref = fbHref.replace('CUSTOM_NAME', encodeURIComponent(category));
            fbHref = fbHref.replace('CUSTOM_DESC', encodeURIComponent(name));
            // CUSTOM LINK TWITTER
            var twHref = twitterLink;
            twHref = twHref.replace('CUSTOM_TEXT', encodeURIComponent(name + " " + shareUrl));

            $('.popin-audio').find('.buttons .facebook').attr('data-href', fbHref);
            $('.popin-audio').find('.buttons .facebook').attr('href', fbHref);
            $('.popin-audio').find('.buttons .twitter').attr('href', twHref);
            $('.popin-audio').find('.buttons .link').attr('href', shareUrl);
            $('.popin-audio').find('.buttons .link').attr('data-clipboard-text', shareUrl);

            updatePopinMedia({
                'type': "audio",
                'category': category,
                'date': date,
                'title': name,
                'url': shareUrl
            });

            $popinAudio.find('.info .category').text(category);
            $popinAudio.find('.info .date').text(date);
            $popinAudio.find('.info .hour').text(hour);
            $popinAudio.find('.info p').text(name);
            $popinAudio.find('.audio-player .image').css('backgroundImage', 'url(' + img + ')');
            $popinAudio.addClass('show');

            $('.ov').addClass('show');

            $('#main').addClass('overlay');

            setTimeout(function () {
                $('div.vFlexAlign, #main, footer, #logo-wrapper, #navigation').on('click', function (e) {

                    audioPopin.stop();
                    audioPopin.setMute(true);

                    $popinAudio.removeClass('show');
                    $('#main').removeClass('overlay');
                    $('.activeAudio').removeClass('activeAudio');

                    $('div.vFlexAlign, #main, footer, #logo-wrapper, #navigation').off('click');
                });
            }, 1000);


            initRs();

        }

        $('.item.audio').on('click', function (e) {

            $(this).addClass('activeAudio')

            var $popinAudio = $('.popin-audio'),
                aid = $(e.target).closest('.audio').data('aid'),
                source = $(e.target).closest('.audio').data('file'),
                img = $(e.target).closest('.audio').data('img'),
                category = $(e.target).closest('.audio').find('.category').text(),
                date = $(e.target).closest('.audio').find('.date').text(),
                hour = $(e.target).closest('.audio').find('.hour').text(),
                name = $(e.target).closest('.audio').data('title');

            audioPopin = audioInit('audio-player-popin', false, false);
            audioPopin.playlistItem($(this).index() - 1);

            setTimeout(function(){
                var hashPush = '#aid='+aid;
                history.pushState(null, null, hashPush);

                audioPopin.play();
                audioPopin.play();
            }, 900);

            // CUSTOM LINK FACEBOOK
            var shareUrl = GLOBALS.urls.videosUrl + '#aid=' + aid;
            var fbHref = facebookLink;
            fbHref = fbHref.replace('CUSTOM_URL', encodeURIComponent(shareUrl));
            fbHref = fbHref.replace('CUSTOM_IMAGE', encodeURIComponent(img));
            fbHref = fbHref.replace('CUSTOM_NAME', encodeURIComponent(category));
            fbHref = fbHref.replace('CUSTOM_DESC', encodeURIComponent(name));
            // CUSTOM LINK TWITTER
            var twHref = twitterLink;
            twHref = twHref.replace('CUSTOM_TEXT', encodeURIComponent(name + " " + shareUrl));

            $('.popin-audio').find('.buttons .facebook').attr('data-href', fbHref);
            $('.popin-audio').find('.buttons .facebook').attr('href', fbHref);
            $('.popin-audio').find('.buttons .twitter').attr('href', twHref);
            $('.popin-audio').find('.buttons .link').attr('href', shareUrl);
            $('.popin-audio').find('.buttons .link').attr('data-clipboard-text', shareUrl);

            updatePopinMedia({
                'type': "audio",
                'category': category,
                'date': date,
                'title': name,
                'url': shareUrl
            });

            $popinAudio.find('.info .category').text(category);
            $popinAudio.find('.info .date').text(date);
            $popinAudio.find('.info .hour').text(hour);
            $popinAudio.find('.info p').text(name);
            $popinAudio.find('.audio-player .image').css('backgroundImage', 'url(' + img + ')');
            $popinAudio.addClass('show');

            $('.ov').addClass('show');

            $('#main').addClass('overlay');

            setTimeout(function () {
                $('div.vFlexAlign, #main, footer, #logo-wrapper, #navigation').on('click', function (e) {

                    audioPopin.stop();
                    audioPopin.setMute(true);

                    $popinAudio.removeClass('show');
                    $('#main').removeClass('overlay');
                    $('.activeAudio').removeClass('activeAudio');

                    $('div.vFlexAlign, #main, footer, #logo-wrapper, #navigation').off('click');
                });
            }, 1000);

            initRs();
        });
    }
}
// Filters
// =========================

var owInitFilter = function (isTabSelection) {

    isTabSelection = isTabSelection || false;

    // on click on a filter
    if (isTabSelection) {

        $('.tab-selection .selection').on('click', function(e){

            e.preventDefault();

            var block = $(this).parent().attr('id');
            var h = $(this).parent().find('.select-span').html();
            $('#filters').remove();
            $('body').append('<div id="filters"><div class="vCenter"><div class="vCenterKid"></div></div><div class="close-button"><i class="icon icon-close"></i></div></div>');
            $('#filters .vCenterKid').html(h);
            $('#filters .vCenterKid').find(':not(span)').remove();
            $('#filters .vCenterKid').find('span.disabled').remove();
            $('#filters').attr('data-id', $(this).parents('.filter').attr('id'));

            setTimeout(function () {
                $('#filters').addClass('show');
            }, 100);

            setTimeout(function () {
                $('#filters span').addClass('show');
            }, 400);

            $('#filters span').on('click', function () {
                var data = $(this).data('select');
                var selected = $('#'+block+' .select option[value="'+data+'"]');
                selected.attr('selected','selected');
            });

        });

        // close filters
        $('body').on('click', '#filters', function () {
            $('#filters').removeClass('show');
            setTimeout(function () {
                $('#filters').remove();
            }, 700);
        });


    } else {
        $('body').on('click', '.filters .select span', function () {
            var h = $(this).parent().html();

            $('#filters').remove();
            $('body').append('<div id="filters"><div class="vCenter"><div class="vCenterKid"></div></div><div class="close-button"><i class="icon icon-close"></i></div></div>');
            $('#filters .vCenterKid').html(h);
            $('#filters .vCenterKid').find(':not(span)').remove();
            $('#filters .vCenterKid').find('span.disabled').remove();
            $('#filters').attr('data-id', $(this).parents('.filter').attr('id'));

            setTimeout(function () {
                $('#filters').addClass('show');
            }, 100);

            setTimeout(function () {
                $('#filters span').addClass('show');
            }, 400);

            $('#filters span').on('click', function () {
                var id = $('#filters').data('id'),
                    f = $(this).data('filter');

                $('#' + id + ' .select span').removeClass('active');
                $('#' + id + ' .select span[data-filter="' + f + '"]').addClass('active');

                owInitGrid('filter');
            });

        });

        // close filters
        $('body').on('click', '#filters', function () {
            $('#filters').removeClass('show');
            setTimeout(function () {
                $('#filters').remove();
            }, 700);
        });

    }
};


var owRemoveElementListe = function () {
    $('.filters-02 li .icon-close').on('click', function () {
        $(this).parent().remove();


        if (!$('.new-filter ul li').length) {
            $('.new-filter').parent().remove();
        }

    });
}

var addNextFilters = function () {
    $('.filters-02 li.more').on('click', function (e) {
        e.preventDefault();

        $(this).remove();

        var url = $(this).attr("data-url");

        $.get(url, function (data) {
            $('.c-filters').append(data);

            $('.filters-02 li.more').off('click');
            $('.filters-02 li .icon-close').off('click');

            owRemoveElementListe();
            addNextFilters();
            owInitNavSticky(3);
        });
    });
}


var owInitFilterSearch = function () {
    var block = $('.block-searh-more');

    $('.result-more').on('click', function (e) {
        e.preventDefault();

        block.toggleClass('visible');
    })
}
var owFixMobile = function() {

    $('header .hasSubNav').on('click', function(){
        var element = $(this).find('ul');
        element.toggleClass('visible');
    });

    $('#logo-wrapper, section').on('click', function(){
        if($('header .hasSubNav ul').hasClass('visible')){
            var element = $('header').find('ul.visible');
            element.removeClass('visible');
        }
    });

}

var owInitGrid = function (id) {

    String.prototype.trunc = function (n, useWordBoundary) {
        var isTooLong = this.length > n,
            s_ = isTooLong ? this.substr(0, n - 1) : this;
        s_ = (useWordBoundary && isTooLong) ? s_.substr(0, s_.lastIndexOf(' ')) : s_;
        return isTooLong ? s_ + '...' : s_;
    };

    if (id == 'isotope-01') {


        var $grid = $('.isotope-01').imagesLoaded(function () {
            $grid.isotope({
                itemSelector: '.item',
                percentPosition: true,
                sortBy: 'original-order',
                layoutMode: 'packery',
                packery: {
                    columnWidth: '.grid-sizer'
                }
            });
        });


        if ($('.jury').length) {

            var resize = function () {
                var w = $('.isotope-01 .contain-img').first().width();
                $('.isotope-01 .contain-img').each(function () {
                    $(this).css('height', (w / 0.75));
                    var $container = $(this), imgUrl = $container.find('img').prop('src');
                    if (imgUrl) {
                        $container.css('backgroundImage', 'url(' + imgUrl + ')').addClass('compat-object-fit');
                        img = $container.find('img');
                        img.css('display', 'none');
                    }
                });
            }

            resize();

            $(window).resize(function () {
                resize();
            });

        }

        var trunTitle = function() {
            $.each($('.card.item'), function (i, e) {
                var title = $(e).find('.info strong a');

                if (!title.hasClass('init')) {
                    var text = $(e).find('.info strong a').text();
                    title.addClass('init');
                    title.attr('data-title', text);
                } else {
                    var text = title.attr('data-title');
                }


                if($('.medias').length > 0) {

                    if (window.matchMedia("(max-width: 1405px)").matches) {
                        title.html(text.trunc(25, true));
                    }else{
                        title.html(text.trunc(40, true));
                    }

                } else {
                    title.html(text.trunc(60, true));
                }
            });
        }


        trunTitle();


        $(window).resize(function () {
            trunTitle();
        });

        var title = $('.info strong a').text();

        return $grid;
    }

    if (id == 'isotope-02') {


        var $grid = $('.isotope-02').imagesLoaded(function () {
            $grid.isotope({
                itemSelector: '.item',
                percentPosition: true,
                sortBy: 'original-order',
                layoutMode: 'packery',
                packery: {
                    gutter: 39
                }
            });
        });

        return $grid;
    }

    if (id == 'isotope-03') {

        var $grid = $('.isotope-03').imagesLoaded(function () {
            $grid.isotope({
                itemSelector: '.item',
                percentPosition: true,
                sortBy: 'original-order',
                layoutMode: 'packery',
                packery: {
                    columnWidth: '.grid-sizer'
                }
            });
        });

        return $grid;
    }

    if (id == 'filter') {

        if ($('.isotope-01').length) {

            var filterDate = '',
                filterTheme = '',
                filterFormat = '';

            if ($('.filters #date').length > 0) {
                filterDate = $('.filters #date .select span.active').data('filter');
                filterDate = "." + filterDate;
            }

            if ($('.filters #theme').length > 0) {
                filterTheme = $('.filters #theme .select span.active').data('filter');
                filterTheme = "." + filterTheme;
            }

            if ($('.filters #format').length > 0) {
                filterFormat = $('.filters #format .select span.active').data('filter');
                filterFormat = "." + filterFormat;
            }

            var filters = filterDate + filterTheme + filterFormat;

            var $grid = $('.isotope-01').isotope({filter: filters});
        }

        if ($('.isotope-02').length) {

            var filterStaff = $('.filters #staff .select span.active').data('filter');
            filterStaff = "." + filterStaff;


            var $grid = $('.isotope-02').isotope({filter: filterStaff});
        }
    }


};


var owsetGridBigImg = function (grid, dom, init) {

    var $img = $(dom).find('.card img'),
        pourcentage = 0.30,
        nbImgAAgrandir = $img.length * pourcentage,
        i = 0,
        nbRamdom = [],
        x = 1,
        j = 0,
        max = 0,
        min = 0,
        nbImage = $img.length;

    $($img).closest('article.card').removeClass('double w2');

    if (window.matchMedia("(max-width: 1279px)").matches) {

        while (i < $img.length) {
            if (j < 15) {
                if (j == 0 || j == 5 || j == 11) {
                    $($img[i]).closest('article.card').addClass('double w2');
                }
                j++;
            }
            if (j == 14) {
                j = 0;
            }
            i++;
        }


    } else if (window.matchMedia("(max-width: 1599px)").matches) {

        while (i < $img.length) {
            if (j < 10) {
                if (j == 0 || j == 3) {
                    $($img[i]).closest('article.card').addClass('double w2');
                }
                j++;
            }
            if (j == 9) {
                j = 0;
            }
            i++;
        }


    } else if (window.matchMedia("(max-width: 1919px)").matches) {
        while (i < $img.length) {
            if (j < 30) {
                if (j == 0 || j == 3 || j == 12 || j == 17 || j == 25) {
                    $($img[i]).closest('article.card').addClass('double w2');
                }
                j++;
            }
            if (j == 29) {
                j = 0;
            }
            i++;
        }


    } else if (window.matchMedia("(min-width: 1920px)").matches) {

        while (i < $img.length) {
            if (j < 15) {
                if (j == 0 || j == 5 || j == 14) {
                    $($img[i]).closest('article.card').addClass('double w2');
                }
                j++;
            }
            if (j == 14) {
                j = 0;
            }
            i++;
        }
    }
};

var owInitAleaGrid = function (grid, dom, init) {
    var $img = $(dom).find('.item:not(.portrait) img'),
        pourcentage = 0.50,
        nbImgAAgrandir = $img.length * pourcentage,
        i = 0,
        nbRamdom = [],
        x = 1,
        max = 0,
        min = 0,
        nbImage = $img.length;

    while (x < nbImgAAgrandir) {
        while (nbImgAAgrandir > nbRamdom.length) {
            max = nbImage * pourcentage * x;
            min = nbImage * pourcentage * (x - 1);
            nbAlea = Math.floor(Math.random() * (max - min) + min);
            nbRamdom[i] = nbAlea;
            $($img[nbRamdom[i]]).closest('article.item').addClass('double w2');
            i++;
            x++;
        }
    }

    $('.item').addClass('visible');

    grid.isotope({
        itemSelector: '.item',
        percentPosition: true,
        sortBy: 'original-order',
        layoutMode: 'packery',
        packery: {
            columnWidth: '.grid-sizer'
        }
    });

    grid.isotope('layout');
};

var owInitLinkChangeEffect = function() {

    $('header a, footer a, .cards a, .block-push a, .block-infos a, .small-push a, .texte-01 a, .item a, .link').on('click', function(e) {

        e.preventDefault();

        var url = $(this).attr('href');

        $('.overlay').addClass('animated fadeIn visible');

        setTimeout(function(){
            window.history.pushState('','',url);
            window.location.reload();

        }, 1000);

        return false;
    });
}

var videoMovie;

// Single Movie
// =========================
$(document).ready(function() {

    //fix tatiana
    if($('.single-movie').length) {
        var h = $('.press[data-section]').height();
        $('.contacts').css('min-height',h);
    }

    if($('.single-movie').length) {

        var cl = new CanvasLoader('canvasloader');
        cl.setColor('#ceb06e');
        cl.setDiameter(20);
        cl.setDensity(34);
        cl.setRange(0.8);
        cl.setSpeed(1);
        cl.setFPS(60);

        function setActiveMovieVideos() {
            $('#slider-movie-videos .owl-item').removeClass('center');
            $('#slider-movie-videos .owl-item.active').first().addClass('center');
        }

        // gallery slideshow
        $('.gallery .img img').each(function() {
            var w = $(this).width(),
                h = $(this).height();

            if(w/h > 0.8179 && !jQuery('#main').hasClass('single-movie')) {
                $(this).addClass('landscape');
            }
        })

        $('body').on('click', '.gallery .thumbs a', function(e) {
            e.preventDefault();
            var i = $(this).index(),
                cap = $(this).data('caption');

            $('.gallery .img img').removeClass('active');
            $('.gallery .img img').eq(i).addClass('active');

            $('.gallery .thumbs a').removeClass('active');
            $(this).addClass('active');

            $('.gallery .caption').text(cap);
        });


        // anchors menu
        $('body').on('click', '#nav-movie ul a', function (e) {
            e.preventDefault();

            $('#nav-movie ul a').removeClass('active');
            $(this).addClass('active');

            var $el = $(this)
                , id = $el.attr('href').substr(1);

            var posT = $('*[data-section="' + id + '"]').offset().top - $('#nav-movie').height() - $('header').height();

            if(!$('#nav-movie').hasClass('sticky')) {
                posT -= 32;
            }

            $('html, body').animate({
                scrollTop: posT
            }, 500);
        });

        $('body').on('click', '#slider-competition .owl-item', function(e) {
            sliderCompetition.trigger('to.owl.carousel', [$(this).index(), 400, true]);
        });



        // previous and next over
        $('body').on('mouseover', '.single-movie .nav', function(e) {
            if($(this).hasClass('prev')) {
                $('.prevmovie').addClass('show');
            } else {
                $('.nextmovie').addClass('show');
            }
        });

        $('body').on('click', '.single-movie .prevmovie', function(e) {
            $('.single-movie .nav.prev').trigger('click');
        });

        $('body').on('click', '.single-movie .nextmovie', function(e) {
            $('.single-movie .nav.next').trigger('click');
        });

        // previous and next over
        $('body').on('mouseover', '.single-movie .prevmovie', function(e) {
            $('.single-movie .nav.prev').addClass('over');
        });
        $('body').on('mouseover', '.single-movie .nextmovie', function(e) {
            $('.single-movie .nav.next').addClass('over');
        });

        $('body').on('mouseover', '.main-image, .container, .videos, div.press, .competition', function(e) {
            $('.prevmovie, .nextmovie').removeClass('show');
            $('.single-movie .nav').removeClass('over');
        });

        // previous and next
        /*$('body').on('click', '.single-movie .nav', function(e) {
         e.preventDefault();

         var $that = $(this);

         if($that.hasClass('next')) {
         $('.anim').addClass('next');
         } else {
         $('.anim').removeClass('next');
         }

         $('.anim').addClass('show');
         setTimeout(function() {
         cl.show();
         $('#canvasloader').addClass('show');
         }, 800);

         var urlPath = $that.attr('href');

         // remove timeout once on server. only for animation.

         /*setTimeout(function() {
         $('html, body').animate({
         scrollTop: 0
         }, 0);
         $.get(urlPath, function(data){
         var matches = data.match(/<title>(.*?)<\/title>/);
         var spUrlTitle = matches[1];

         document.title = spUrlTitle;
         $(".content-movie").html( $(data).find('.content-movie') );
         history.pushState('',GLOBALS.texts.url.title, urlPath);

         $('#canvasloader').removeClass('show');

         setTimeout(function() {
         if($that.hasClass('next')) {
         $('.anim').removeClass('next show');
         }
         else {
         $('.anim').addClass('next').removeClass('show');
         }
         cl.hide();
         initSliders();
         initSlideshows();
         initAudioPlayers();
         }, 800);
         });
         }, 2000);
         });*/

    }

});

var owInitPopin = function(id) {


    if(id == 'popin-landing-e') {


        var $popin = $('.popin-landing-e');

        var visiblePopin = function() {
            var dateFestival = $('.compteur').data("date");

            var dateToday = new Date();
            dateFestival = new Date(dateFestival);


            var timeLanding = (dateFestival - dateToday) / 1000; //en seconde

            var jours = Math.floor(timeLanding / (60 * 60 * 24));
            var heures = Math.floor((timeLanding - (jours * 60 * 60 * 24)) / (60 * 60));
            var minutes = Math.floor((timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60))) / 60);
            var secondes = Math.floor(timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60 + minutes * 60)));


            if(timeLanding < 0){
                //pas de compteur ?

            }else if(timeLanding > 0){


                var $day = $('.day').html(jours);
                var $hour = $('.hour').html(heures);
                var $minutes = $('.minutes').html(minutes);
                var $secondes = $('.secondes').html(secondes);

            }else{

                //compteur terminé ! on ferme la popin
                $popin.addClass('animated fadeOut').removeClass('visible');
            }

            actualisation = setInterval(function() {

                var dateToday = new Date();
                dateFestival = new Date(dateFestival);

                var timeLanding = (dateFestival - dateToday) / 1000; //en seconde

                var jours = Math.floor(timeLanding / (60 * 60 * 24));
                var heures = Math.floor((timeLanding - (jours * 60 * 60 * 24)) / (60 * 60));
                var minutes = Math.floor((timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60))) / 60);
                var secondes = Math.floor(timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60 + minutes * 60)));

                if(timeLanding < 0){
                    //pas de compteur ?
                    Cookies.set('popin-landing-e','1', { expires: 365 });

                }else if(timeLanding > 0){

                    var $day = $('.day').html(jours);
                    var $hour = $('.hour').html(heures);
                    var $minutes = $('.minutes').html(minutes);
                    var $secondes = $('.secondes').html(secondes);

                }else{
                    //compteur terminé ! on ferme la popin
                    $popin.addClass('animated fadeOut').removeClass('visible');
                    Cookies.set('popin-landing-e','1', { expires: 365 });
                }
            }, 1000);

        };

        var fClosePopin = function() {


            $('.popin-landing-e').on('click', function(){


                $popin.addClass('animated fadeOut');
                Cookies.set('popin-landing-e','1', { expires: 365 });

                setTimeout(function(){   $popin.removeClass('visible'); }, 500);
            });
        }

        // Verifier si les cookies existent
        if(typeof Cookies.get('popin-landing-e') === "undefined") {
            Cookies.set('popin-landing-e','0', { expires: 365 });
        }

        var closePopin = Cookies.get('popin-landing-e');

        if(closePopin == 0) {
            $popin.addClass('animated fadeIn').addClass('visible');
            visiblePopin();
            fClosePopin();
        }else {
            Cookies.set('popin-landing-e','1', { expires: 365 });
        }
    }

    if(id == 'popin-timer-banner') {

        var $popin = $('.b-timer');

        var visiblePopinB = function() {
            var dateFestival = $('.time').data("date");

            var dateToday = new Date();
            dateFestival = new Date(dateFestival);

            var timeLanding = (dateFestival - dateToday) / 1000; //en seconde

            var jours = Math.floor(timeLanding / (60 * 60 * 24));
            var heures = Math.floor((timeLanding - (jours * 60 * 60 * 24)) / (60 * 60));
            var minutes = Math.floor((timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60))) / 60);
            var secondes = Math.floor(timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60 + minutes * 60)));

            if(timeLanding < 0){
                //pas de compteur ?
            }else if(timeLanding > 0){

                var $day = $('.day').html(jours);
                var $hour = $('.hour').html(heures);
                var $minutes = $('.minutes').html(minutes);
                var $secondes = $('.secondes').html(secondes);

            }else{
                //compteur terminé ! on ferme la popin
                $popin.addClass('animated fadeOut').removeClass('visible');
            }

            actualisation = setInterval(function() {

                var dateToday = new Date();
                dateFestival = new Date(dateFestival);

                var timeLanding = (dateFestival - dateToday) / 1000; //en seconde

                var jours = Math.floor(timeLanding / (60 * 60 * 24));
                var heures = Math.floor((timeLanding - (jours * 60 * 60 * 24)) / (60 * 60));
                var minutes = Math.floor((timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60))) / 60);
                var secondes = Math.floor(timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60 + minutes * 60)));

                if(timeLanding < 0){
                    //pas de compteur ?
                    Cookies.set('popin-banner','1', { expires: 365 });

                }else if(timeLanding > 0){

                    var $timer = $('.time').html(jours+' : '+heures+' : '+minutes+' : '+secondes);

                }else{
                    //compteur terminé ! on ferme la popin
                    $popin.addClass('animated fadeOut').removeClass('visible');
                    Cookies.set('popin-banner','1', { expires: 365 });
                }
            }, 1000);

            setTimeout(function(){
                /*
                 fClosePopinB('force');
                 */
            }, 5000);

        };

        var fClosePopinB = function(force) {

            if(force == 'force'){
                $popin.addClass('animated fadeOut');

                setTimeout(function(){   $popin.removeClass('visible'); }, 500);

            }

            $('.c-icon').on('click', function(){
                $popin.addClass('animated fadeOut');
                Cookies.set('popin-banner','1', { expires: 365 });

                setTimeout(function(){   $popin.removeClass('visible'); }, 500);
            });
        }

        // Verifier si les cookies existent
        if(typeof Cookies.get('popin-banner') === "undefined") {
            Cookies.set('popin-banner','0', { expires: 365 });
        }

        var closePopin = Cookies.get('popin-banner');

        console.log(closePopin);

        if(closePopin == 0) {
            $popin.addClass('animated fadeIn').addClass('visible');
            visiblePopinB();
            fClosePopinB();

        }else {
            Cookies.set('popin-banner','1', { expires: 365 });
        }

    }

};

var initHeaderSticky = function () {

    $(window).on('scroll', function () {
        var $header = $('header');
        var lastScrollTop = 0;
        var s = $(this).scrollTop();
        scrollTarget = s;

        // STICKY HEADER
        if (s > lastScrollTop) {
            if (($('#prehome-container').length == 0 && s > 30)) {
                $header.addClass('sticky');
                $('body').css('margin-top', '91px');
            }
        } else {
            if (($('#prehome-container').length == 0 && s < 30)) {
                $header.removeClass('sticky');
                $('body').css('margin-top', '0');
            }
        }
    });
};

var owInitNavSticky = function (number) {

    if (number == 1) {
        var $header = $('.navigation-sticky');
    } else if (number == 2) {
        var $header = $('.navigation-sticky-02');
    } else if (number == 3) {
        var $header = $('.filters-02');
    }

    $(window).on('scroll', function () {

        var pushHeight = $('.block-push-top').height();
        var s = $(this).scrollTop();

        if (s > pushHeight) {
            $header.addClass('sticky');
        } else {
            $header.removeClass('sticky');
        }

        if ($('header').hasClass('sticky') && number == 3) {
            $header.addClass('sticky');
        }
    });
};

var owArrowDisplay = function () {

    var blockPushHeight = $('.block-push-top').height() - 180;
    var s = $(this).scrollTop();
    var footer = $('#breadcrumb').offset().top - 700;
    var $btnsArrow = $('.arrows');


    if (s > blockPushHeight && s < footer) {
        $btnsArrow.addClass('visible')
    } else {
        $btnsArrow.removeClass('visible')
    }

    $(window).on('scroll', function () {
        var s = $(this).scrollTop();

        if (s > blockPushHeight && s < footer) {
            $btnsArrow.addClass('visible')
        } else {
            $btnsArrow.removeClass('visible')
        }
    });
};

var onInitParallax = function () {

    if (!$('body').hasClass('mobile')) {

        $(window).on('scroll', function () {

            if ($('header.sticky').length) {
                var s = $(this).scrollTop() - 0;
                $('.block-push').css('background-position', '0px ' + s + 'px');
            } else {
                $('.block-push').css('background-position', '0px ' + '0px');
            }

        });
    }

};


var owInitFooterScroll = function () {
    if ($('#breadcrumb').length) {
        $('#breadcrumb .goTop').on('click', function () {
            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
        });
    }
}


var scrollSingleMovie = function () {
    var lastScrollTop = 0,
        $header = $('header'),
        $timeline = $('#timeline'),
        $navMovie = $('#nav-movie'),
        $faqmenu = $(".faq-menu");

    console.log('oc');

    // SINGLE MOVIE
    $(window).on('scroll', function () {
        var s = $(this).scrollTop();
        scrollTarget = s;

        console.log(s);
        console.log($navMovie.next('div').length > 0);
        console.log($navMovie.next('div').offset().top - $navMovie.height() - 100);

        if ($('.single-movie').length) {
            // NAV
            if ($navMovie.next('div').length > 0 && (s > ($navMovie.next('div').offset().top - $navMovie.height() - 100))) {

                $navMovie.addClass('sticky');


                if ($('div.press').length > 0 && (s > $('div.press').offset().top + 1 - $navMovie.height())) {

                    $navMovie.css('top', 0);

                } else {

                    $navMovie.css('top', '91px');
                }
            } else {
                $navMovie.removeClass('sticky');
            }

            if ($('.competition').length > 0 && (s > $('.competition').offset().top - ($(window).height() - $header.height() - 200))) {
                $('.nav').addClass('hide');
            } else {
                $('.nav').removeClass('hide');
            }

            if ($('div.press').length > 0 && (s > 50 && s < $('div.press').offset().top - $('div.press').height())) {
                $('.nav, .prevmovie, .nextmovie').addClass('black');
            } else {
                $('.nav, .prevmovie, .nextmovie').removeClass('black');
            }

            if ($('.main-image').length > 0 && (s > 100 && $('.main-image').hasClass('trailer'))) {

                if ($('body').hasClass('tablet')) {
                    $('.main-image').height('360px').css('padding-top', 0);
                } else {
                    $('.main-image').height($('.main-image').data('height')).css('padding-top', 0);
                }

                $('.main-image, .poster, .info-film, .nav, .palmares').removeClass('trailer');
                if (videoMovie.getState() === "playing") {
                    videoMovie.pause();
                }
            }

            var sections = $('*[data-section]'),
                nav = $('#nav-movie'),
                nav_height = nav.outerHeight() + $header.height();

            sections.each(function () {
                var top = $(this).offset().top - nav_height,
                    bottom = top + $(this).outerHeight();

                if (s >= top && s <= bottom) {
                    nav.find('ul a').removeClass('active');
                    nav.find('a[href="#' + $(this).data('section') + '"]').addClass('active');
                }
            });
        }
    });
}
var owInitSliderSelect = function(id) {

    if(id == "timelapse"){
        var slider = document.getElementById('timelapse');
        var snapValues = [
            document.getElementById('slider-snap-value-lower'),
            document.getElementById('slider-snap-value-upper')
        ];


        noUiSlider.create(slider, {
            start: [1946, GLOBALS.year],//todo script
            connect: true,
            range: {
                'min': 1946,
                'max': GLOBALS.year
            }
        });

        slider.noUiSlider.on('update', function( values, handle ) {

            snapValues[handle].innerHTML = parseInt(values[handle]);
        });
    }

    if(id == 'tab-selection') {
        var $tab = $('.icon-s');

        $tab.on('click', function(){
            var input = $(this).find('input');

            if(input[0].checked){
                input[0].checked = false;
                $(this).removeClass('active');
            }else{
                $('.more-search').addClass('active');
                input[0].checked = true;
                $(this).addClass('active');
            }

            if(!$('.tabs-two .icon-s').hasClass('active')){
                $('.more-search').removeClass('active');
            }

        });
    }
}

//setup twitter

window.twttr = (function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
    if (d.getElementById(id)) return t;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js, fjs);

    t._e = [];
    t.ready = function (f) {
        t._e.push(f);
    };

    return t;
}(document, "script", "twitter-wjs"));


var initRs = function () {

    console.log('init RS');

    $('.print').on('click', function(e){
        e.preventDefault();
    })

    //POPIN facebook SHARE
    $('.block-social-network .facebook, .rs-slideshow .facebook, .button.facebook').on('click', function (e) {
        e.preventDefault();
        window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');
        return false;
    });


    $('.block-social-network .twitter, .rs-slideshow .twitter').on('click', function (e) {
        window.open(this.href, '', 'width=600,height=400');
        return false;
    });

    function initPopinMail(cls) {
        // check that fields are not empty
        $(cls + ' input[type="text"]', cls + ' textarea').on('input', function () {
            var input = $(this);
            var is_name = input.val();

            if (typeof $(this).attr('required') != undefined && $(this).attr('required') && is_name.length > 0) {
                input.removeClass("invalid").addClass("valid");
                $('.errors .' + input.attr('name')).remove();
            } else {
                input.removeClass("valid").addClass("invalid");
                $('.errors .' + input.attr('name')).remove();
                $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + '</li>');
            }

            if ($('.invalid').length) {
                $('.errors').addClass('show');
            } else {
                $('.errors').removeClass('show');
            }
        });

        $('body').on('click', '.selectOptions span', function () {
            var i = parseInt($(this).index()) + 1;
            $('select option').eq(i).prop('selected', 'selected');
            $('.select').removeClass('invalid');
        });

        // check valid email address
        $(cls + ' input[type="email"]').on('input', function () {
            var input = $(this);
            var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            var is_email = re.test(input.val());
            var is_email_name = input.val();

            if (!is_email_name) {
                input.removeClass("valid").addClass("invalid");
                $('.errors .' + input.attr('name')).remove();
                $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.empty + '</li>');

            } else if (is_email) {
                input.removeClass("invalid").addClass("valid");
                $('.errors .' + input.attr('name')).remove();

            } else {
                input.removeClass("valid").addClass("invalid");
                $('.errors .' + input.attr('name')).remove();
                $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.error + '</li>');
                // TODO remove string //
            }

            if ($('.invalid').length) {
                $('.errors').addClass('show');
            } else {
                $('.errors').removeClass('show');
            }
        });

        // check valid email address
        $('#contact_email').on('input', function () {
            var input = $(this);
            var re = /^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},?)+$/i;
            var is_email = re.test(input.val());
            var is_email_name = input.val();

            if (!is_email_name) {
                input.removeClass("valid").addClass("invalid");
                $('.errors .' + input.attr('name')).remove();
                $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.empty + '</li>');

            } else if (is_email) {
                input.removeClass("invalid").addClass("valid");
                $('.errors .' + input.attr('name')).remove();

            } else {
                input.removeClass("valid").addClass("invalid");
                $('.errors .' + input.attr('name')).remove();
                $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.error + '</li>');
                // TODO remove string //
            }

            if ($('.invalid').length) {
                $('.errors').addClass('show');
            } else {
                $('.errors').removeClass('show');
            }
        });

        // on submit : check if there are errors in the form
        $(cls + ' form').on('submit', function (e) {
            e.preventDefault();
            var $that = $(this);
            var empty = false;

            if ($('select').val() == 'default') {
                $('.select').addClass('invalid');
            } else {
                $('.select').removeClass('invalid');
            }

            $(cls + ' input[type="text"], ' + cls + ' input[type="email"], ' + cls + ' textarea').each(function () {
                if (typeof $(this).attr('required') != undefined && $(this).attr('required') == true && $(this).val() == '') {
                    empty = true;
                }
            });

            if (empty) {
                $(cls + ' input[type="email"], ' + cls + ' input[type="text"], ' + cls + ' textarea').trigger('input');
            }

            if ($('.invalid').length || empty) {
                return false;
            } else {
                // TODO envoie du mail //
                var u = $(cls).hasClass('media') ? GLOBALS.urls.shareEmailMediaUrl : GLOBALS.urls.shareEmailUrl;

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    cache: false,
                    url: u,
                    data: $(cls).find('form#form').serialize(),
                    success: function (data) {
                        if (data.success == false) {

                        }
                        else {
                            // TODO envoie du mail //
                            $(cls).find('#form').remove();
                            $(cls).find('.info-popin').remove();
                            $(cls).find('#msg').append('<div class="valid">' + GLOBALS.texts.popin.valid + '</div>');
                            $(cls).css('height', '31%');
                            return false;
                        }
                    }
                });
            }
        });
    }


    if ($('.popin-mail').length > 0) {
        initPopinMail('.popin-mail');

        $('.popin-mail-open').on('click touchstart', function (e) {
            e.preventDefault();

            $('.overlay-popin').addClass('visible-popin');

            $('.overlay-popin').on('click', function (e) {

                if (!$(e.target).hasClass('popin')) {
                    $(this).removeClass('visible-popin');
                }
            });
        });
    }

    //LINK POPIN//
    function linkPopinInit(link, cls) {
        var link = link || document.location.href;
        var cls = cls || '.link.self';


        new Clipboard(cls);

        $(cls).attr('data-clipboard-text', link);

        $(cls).on('click touchstart', function (e) {
            e.preventDefault();

            console.log('ici');

            var that = $(this);

            if (!$('#share-box').length) {

                $('.texts-clipboard').append('<div id="share-box"><div class="bubble"><a href="#">' + GLOBALS.texts.popin.copy + '</a></div></div>');

                $('#share-box').animate({'opacity': '1'}, 400, function () {
                    $('#share-box').addClass('show');
                    setTimeout(function () {
                        $('#share-box .bubble').html('<a href="#">' + that.attr('data-clipboard-text') + '</a>');
                    }, 1000);
                });
            } else if ($('#share-box').hasClass('show')) {
                $('#share-box').removeClass('show');
                $('#share-box').remove();
            }

            setTimeout(function () {
                $('#share-box').remove();
                $('#share-box').remove();
                //two time because first don't work...
            }, 3000);

            return false;
        });

    }

    linkPopinInit();
}

/*------------------------------------------------------------------------------
 JS Document (https://developer.mozilla.org/en/JavaScript)

 project:    Festival de Cannes
 Author:     OHWEE
 created:    2016-24-03

 summary:    SLIDER HOME
 ----------------------------------------------------------------------------- */


var owInitSlider = function (sliderName) {
    /* SLIDER HOME
     ----------------------------------------------------------------------------- */
    if (sliderName == 'home') {

        var slide = $('.slider-carousel').owlCarousel({
            navigation: true,
            items: 1,
            autoWidth: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            loop: true,
            smartSpeed: 700
        });

        slide.on('changed.owl.carousel', function (event) {
            setTimeout(function () {
                var $item = $('.owl-item.active').find('.item');
                var number = $item.data('item');
                var $active = $(".container-images .item.active");

                $active.removeClass("fadeInRight").addClass('fadeOut');

                setTimeout(function () {
                    $(".container-images .item[data-item=" + number + "]").removeClass('fadeOut').addClass('active fadeInRight');
                    $active.removeClass('active');
                }, 500);
            }, 200);
        });
    }


    /* SLIDER 01
     ----------------------------------------------------------------------------- */
    if (sliderName == 'slider-01') {
        var slide01 = $('.slider-01').owlCarousel({
            navigation: false,
            items: 1,
            autoWidth: true,
            smartSpeed: 700,
            center: true
        });

        // Custom Navigation Events
        $(document).on('click', '.slider-01 .owl-item', function () {
            var number = $(this).index();

            $('.slider-01 .center').removeClass('center');
            $(this).addClass('center');
            slide01.trigger('to.owl.carousel', number);
        });
    }

    /* SLIDER 02
     ----------------------------------------------------------------------------- */
    if (sliderName == 'slider-02' && !$('.s-video-playlist').length) {

        var slide01 = $('.slider-02').owlCarousel({
            navigation: false,
            items: 1,
            autoWidth: true,
            smartSpeed: 700,
            center: true,
            margin: 27.5
        });

        // Custom Navigation Events
        $(document).on('click', '.slider-02 .owl-item', function () {
            var number = $(this).index();

            $('.slider-02 .center').removeClass('center');
            $(this).addClass('center');
            slide01.trigger('to.owl.carousel', number);

        });
    }

    /* SLIDER 03
     ----------------------------------------------------------------------------- */
    if (sliderName == 'slider-03') {


        var slide01 = $('.slider-03').owlCarousel({
            navigation: false,
            items: 1,
            autoWidth: true,
            smartSpeed: 700,
            center: true,
            margin: 27.5
        });

        // Custom Navigation Events
        $(document).on('click', '.slider-03 .owl-item', function () {
            var number = $(this).index();

            $('.slider-02 .center').removeClass('center');
            $(this).addClass('center');
            slide01.trigger('to.owl.carousel', number);

        });
    }


    if (sliderName == "timelapse-01") {

        //Init var
        var slider = document.getElementById('timelapse-01');
        var $slide = $('.slides');
        var $slideCalc1 = $('.slides-calc1');
        var $slideCalc1Slide = $('.slides-calc1 .slide');
        var $slideCalc2 = $('.slides-calc2');

        var numberSlide = $('.slider-restropective').size();
        var sizeSlide = $('.slider-restropective').width();
        var finalSizeSlider = numberSlide * sizeSlide + 1000;

        var initOpenAjax = function () { //ajax
            $('.discover').on('click', function (e) {

                e.preventDefault();
                var url = $(this).data('url');

                $.get(url, function (data) {

                    $('.slider-restropective').addClass('isOpen block-push block-push-top background-effet');
                    $('.timelapse').css('display', 'none');
                    $('.discover').css('display', 'none');
                    $('.slides-calc2').css('display', 'none');
                    $('.title-big-date').addClass('title-2').removeClass('title-big-date');
                    $('.title-edition').addClass('title-4').removeClass('title-edition');

                    var imgurl = $('.block-push-top.big .container img').attr('src');
                    $('.block-push-top.big .container img').css('display', 'none');

                    $('.block-push-top.big').css('background-image', 'url(' + imgurl + ')');

                    var data = $(data).find('.contain-ajax');

                    $('.ajax-section').html(data);
                    owInitNavSticky(1);

                    window.history.pushState('', '', url);

                    setTimeout(function () {
                        if ($('.isotope-01').length) {
                            owInitGrid('isotope-01');
                            console.log('init grid');
                        }
                    }, 1000);

                });

                return false;
            });
        }

        // init slider
        $slide.css('width', finalSizeSlider); // change size slider

        var test = '418%';
        $slideCalc1.css('width', test); // change size slider

        var maxDate = $('.timelapse .date-last').data('lastdate');

        //init width of slide
        noUiSlider.create(slider, {
            start: [1945],//todo script
            range: {
                'min': 1945,
                'max': maxDate
            }
        });

        var initDrag = 1;

        slider.noUiSlider.on('update', function (values, handle) {

            //drag
            var w = $(window).width() + 4;
            var number = 0;


            valuesFloat = parseFloat(values[handle]);
            valuesInt = parseInt(values[handle]);
            values = Math.round(valuesFloat);
            number = values - 1945;

            $('.slides-calc1 .date').html(values);

            $('.big img').removeClass('open');
            $('.slider-restropective .calc3').css('display', 'block');
            $('.slider-restropective .calc4').css('display', 'block');

            if (initDrag) {
                initDrag = 0;
            }

            if (values > 1945) {
                $('.slides-calc1').css('display', 'block');
                $('.slides-calc2.navigation').removeClass('begin');
            } else {
                $('.slides-calc1').css('display', 'none');
                $('.slides-calc2.navigation').addClass('begin');
            }

            if (number > 0.7 && initDrag == 0) {
                $('.slider-restropective[data-slide="0"]').removeClass('animated fadeIn').addClass('animated fadeOut');
                $('.slides-calc1').removeClass('animated fadeOut').addClass('animated fadeIn');
            } else if (number < 0.9) {
                $('.slider-restropective[data-slide="0"]').removeClass('animated fadeOut').addClass('animated fadeIn');
                $('.slides-calc1').removeClass('animated fadeIn').addClass('animated fadeOut');
            }

            //paralax calc 3

            var val2 = -(valuesFloat - 1945 - number) * 380; //todo script ?
            $('.slider-restropective[data-slide=' + number + '] .calc3').css('transform', 'translate(' + val2 + 'px)');

            //paralax cal 4

            var val3 = -(valuesFloat - 1945 - number) * 80; //todo script ?
            $('.slider-restropective[data-slide=' + number + '] .calc4').css('transform', 'translate(' + val3 + 'px)');

            var val = -w * (values - 1945); //todo script ?

            $slide.css('transform', 'translate(' + val + 'px)');

            $('.slider-restropective').removeClass('big').addClass('small');
            $('.slider-restropective[data-slide="0"]').removeClass('big').removeClass('small');
            $('.slider-restropective .texts').removeClass('zoomIn fadeIn pulse visible');

        });

        slider.noUiSlider.on('end', function (values, handle) { //end drag

            var w = $('body').width() + 4;
            valuesFloat = parseFloat(values[handle]);
            values = Math.round(valuesFloat);
            number = values - 1945;


            var val = -w * (number); //todo script ?

            $slide.css('transform', 'translate(' + val + 'px)');

            $('.slider-restropective .calc3').css('display', 'none');
            $('.slider-restropective .calc4').css('display', 'none');

            var slideElement = $('.slider-restropective[data-slide=' + number + ']');
            var slideElementText = $('.slider-restropective[data-slide=' + number + '] .texts');

            slideElement.removeClass('small').addClass('big');
            $('.big img').addClass('open');

            setTimeout(function () {

                slideElementText.addClass('animated zoomIn fadeIn visible');
                $('.slides-calc1').removeClass('animated fadeIn').addClass('animated fadeOut');

                setTimeout(function () {

                    slideElementText.removeClass('zoomIn fadeIn').addClass('pulse');
                    $('.slides-calc1').css('display', 'none');
                    initOpenAjax();
                }, 600);
            }, 900);

            $('.slider-restropective[data-slide="0"]').removeClass('big').removeClass('small');

        });

        var animation = function (event) {

            var date = $('.slides-calc1 .date').html();
            date = parseInt(date);

            if (event == "next") {
                date = date + 1;
                slider.noUiSlider.set([date]);
                stopAnimation();
            }

            if (event == "prev") {
                date = date - 1;
                slider.noUiSlider.set([date]);
                stopAnimation();
            }

            if (event == "next-open") {
                date = date + 1;
                slider.noUiSlider.set([date]);
                animationOpen();
            }

            if (event == "prev-open") {
                date = date - 1;
                slider.noUiSlider.set([date]);
                animationOpen();
            }

            return false;
        }

        var stopAnimation = function () {

            var w = $('body').width() + 4;
            values = $('.slides-calc1 .date').html();
            number = values - 1945;
            var val = -w * (values - 1945); //todo script ?


            $slide.css('transform', 'translate(' + val + 'px)');

            $('.slider-restropective .calc3').css('display', 'none');
            $('.slider-restropective .calc4').css('display', 'none');

            var slideElement = $('.slider-restropective[data-slide=' + number + ']');
            var slideElementText = $('.slider-restropective[data-slide=' + number + '] .texts');

            slideElement.removeClass('small').addClass('big');
            $('.big img').addClass('open');

            setTimeout(function () {

                slideElementText.addClass('animated zoomIn fadeIn visible');
                $('.slides-calc1').removeClass('animated fadeIn').addClass('animated fadeOut');

                setTimeout(function () {

                    slideElementText.removeClass('zoomIn fadeIn').addClass('pulse');
                    $('.slides-calc1').css('display', 'none');
                    initOpenAjax();

                }, 600);
            }, 900);

            $('.slider-restropective[data-slide="0"]').removeClass('big').removeClass('small');
        }

        var animationOpen = function () {
            var w = $('body').width() + 4;
            values = $('.slides-calc1 .date').html();
            number = values - 1945;
            var val = -w * (values - 1945) - 10; //todo script ?
            var slideElement = $('.slider-restropective[data-slide=' + number + ']');
            var slideElementText = $('.slider-restropective[data-slide=' + number + '] .texts');

            $('.slider-restropective .calc3').css('display', 'none');
            $('.slider-restropective .calc4').css('display', 'none');

            $slide.css('transform', 'translate(' + val + 'px)');
            $('.slides-calc1').css('display', 'none');
            slideElement.addClass('big');

            var imgurl = $('.block-push-top.big .container img').attr('src');
            $('.block-push-top.big .container img').css('display', 'none');
            $('.block-push-top.big').css('background-image', 'url(' + imgurl + ')');

            setTimeout(function () {

                slideElementText.addClass('animated zoomIn fadeIn visible');
                $('.slides-calc1').removeClass('animated fadeIn').addClass('animated fadeOut');

                setTimeout(function () {

                    slideElementText.removeClass('zoomIn fadeIn').addClass('pulse');
                    $('.slides-calc1').css('display', 'none');
                    initOpenAjax();

                }, 600);
            }, 900);
        }
        // ON CLICK

        $('.slides-calc2.next').on('click', function () {
            animation('next');
        });

        $('.slides-calc2.prev').on('click', function () {
            animation('prev');
        });


        $('.date-next').on('click', function () {
            animation('next-open');

            var $this = $(this);

            var url = $this.data('url');

            $.get(url, function (data) {
                var data = $(data).find('.contain-ajax');

                $('.ajax-section').html(data);
                owInitNavSticky(1);

                window.history.pushState('', '', url);
            });

        });

        $('.date-back').on('click', function () {


            var url = $(this).data('url');


            $.get(url, function (data) {
                var data = $(data).find('.contain-ajax');

                $('.ajax-section').html(data);
                owInitNavSticky(1);

                window.history.pushState('', '', url);
            });

            animation('prev-open');
        });

        if ($('.restrospective-init').length) {

            var w = $('body').width() + 4;
            values = $('.slides-calc1 .date').data('date');

            slider.noUiSlider.set([values]);

            number = values - 1945;
            var val = -w * (values - 1945) - 10; //todo script

            $slide.css('transform', 'translate(' + val + 'px)');

            animationOpen();
        }
    }
};

$(window).resize(function () {

    if ($('.retrospective').length) {

        var $slide = $('.slides');
        var $slideCalc1 = $('.slides-calc1');

        var w = $('body').width() + 4;
        var numberSlide = $('.slider-restropective').size() + 1;
        var sizeSlide = $('.slider-restropective').width();
        var finalSizeSlider = numberSlide * sizeSlide;

        $slide.css('width', finalSizeSlider); // change size slider
        /*$slideCalc1.css('width',finalSizeSlider); // change size slider*/

        values = $('.slides-calc1 .date').html();
        number = values - 1945;
        var val = -w * (values - 1945); //todo script ?


        $slide.css('transform', 'translate(' + val + 'px)');

    }
});

/**
 * Created by tatjac on 17/06/2016.
 */
var owinitSlideShow = function (slider, hash) {

    if (typeof hash != "undefined") {
        setTimeout(function () {
            openSlideShow(slider, hash);
        }, 100);
    }else{
        $('.block-diaporama .item').on('mousedown', function () {

            if ($(this).parent().hasClass('active center') && !$('.owl-stage').hasClass('owl-grab')) {
                openSlideShow(slider);
            }

        });


        if($('.slideshow-img').length > 0 ) {
            $('.images').on('click', function (e) {
                e.preventDefault();

                openSlideShow(slider);

                return false;
            });
        }

        if($('.medias').length > 0 ) {
            $('.item.photo').on('click', function (e) {
                e.preventDefault();

                openSlideShow(slider);

                return false;
            });
        }
    }
}


var openSlideShow = function (slider, hash) {

    $('body').addClass('slideshow-open');

    var images = [];
    var w = $(window).width();
    var centerElement = 0;
    var caption = "";


    console.log(slider);

    slider.find('.item, .img').each(function (index, value) {

        if(!$(value).hasClass('video') && !$(value).hasClass('audio')){
            if ($(value).parent().hasClass('active center')) {
                centerElement = index;
            }

            if ($('.img').length > 0 && $(value).hasClass('active')) {
                centerElement = index;
            }


            /*
             console.log($(value).find('.contain-txt a').html());
             */
            console.log($(value).hasClass('photo'));

            var src = ($(value).hasClass('photo')) ? $(value).find('.image-wrapper img').attr("src") : $(value).find('img').attr("src");
            var alt = ($(value).hasClass('photo')) ? $(value).find('.image-wrapper img').attr("alt") : $(value).find('img').attr("alt");
            var title = ($(value).hasClass('photo')) ? $(value).find('.info .contain-txt strong a').data('title') : $(value).find('img').attr("data-title");
            var label = ($(value).hasClass('photo')) ? $(value).find('.info .contain-txt a').html() : $(value).find('img').attr("data-label");
            var date = ($(value).hasClass('photo')) ? $(value).find('.info .contain-txt span.date').html() + ' . ' + $(value).find('.info .contain-txt span.hour').html() : $(value).find('img').attr("data-date");
            var caption = $(value).find('img').attr('data-credit');
            var id = $(value).find('img').attr('data-id');
            var facebookurl = $(value).find('img').attr('data-facebookurl');
            var twitterurl = $(value).find('img').attr('data-facebookurl');
            var url = $(value).find('img').attr('data-url');

            var image = {
                id: id,
                url: url,
                src: src,
                alt: alt,
                title: title,
                label: label,
                date: date,
                caption: caption,
                facebookurl: facebookurl,
                twitterurl: twitterurl
            };

            images.push(image);

        }


    });

    console.log(images);

    if(typeof hash == "undefined") {
        hash = images[centerElement].id;
        var hashPush = '#'+hash;
        history.pushState(null, null, hashPush);
    }

    $(window).resize(function () {
        w = $(window).width();
        translate = -(w + 1) * centerElement;
        $('.fullscreen-slider').css('transform', 'translateX(' + translate + 'px)');
    });

    var goToNextPrev = function (direction) {
        w = $(window).width();

        var place = centerElement+1;

        if (direction == 0 && place <= images.length) { //go next

            if (place === images.length) {
                centerElement = 0;
                goToSLide(centerElement);
            }else{
                centerElement += 1;
                goToSLide(centerElement);
            }
        }

        if (direction == 1 && place > 0 ) { //go prev

            if (centerElement == 0 ) {
                centerElement = images.length - 1;
                goToSLide(centerElement);
            }else{
                centerElement -= 1;
                goToSLide(centerElement);
            }
        }

        numberDiapo = centerElement + 1;
        var title = $('.c-fullscreen-slider').find('.title-slide');
        var pagination = $('.c-fullscreen-slider').find('.chocolat-pagination');
        var label = $('.c-fullscreen-slider').find('.category');
        var date = $('.c-fullscreen-slider').find('.date');
        var caption = $('.c-fullscreen-slider').find('.credit');
        var facebook = $('.c-fullscreen-slider').find('.rs-slideshow .facebook');
        var twitter = $('.c-fullscreen-slider').find('.rs-slideshow .twitter');
        var link = $('.c-fullscreen-slider').find('.rs-slideshow .link');

        title.html(images[centerElement].title);
        pagination.html(numberDiapo + '/' + images.length + ' <i class="icon icon-media"></i>');
        label.html(images[centerElement].label);
        date.html(images[centerElement].date);
        caption.html(images[centerElement].caption)

        facebook.attr('href', images[centerElement].facebookurl);
        twitter.attr('href', images[centerElement].twitter);
        link.attr('data-clipboard-text', images[centerElement].url);
    }

    var goToSLide = function(id) {
        w = $(window).width();

        centerElement = id;
        translate = -(w + 1) * centerElement;
        fullscreen.addClass('animated fadeOut');

        setTimeout(function () {
            fullscreen.css('transform', 'translateX(' + translate + 'px)');
            fullscreen.removeClass('fadeOut').addClass('animated fadeIn');
        }, 700);

        hash = "#"+images[id].id;

        history.pushState(null, null, hash);
    }

    /* Initiliasion du slideshow fullscreen*/
    $('body').prepend('<div class="c-fullscreen-slider"><div class="fullscreen-slider"> </div></div>');
    var fullscreen = $('body').find(".fullscreen-slider");

    var wSlide = w * images.length + 100;
    var wSlide = wSlide + "px";

    fullscreen.css('width', wSlide);

    if (typeof hash != "undefined") {

        for (var i = 0; i < images.length; i++) {

            if (images[i].id == hash) {
                centerElement = i;
                fullscreen.append("<img src='" + images[i].src + "' alt='" + images[i].data + "' class='center-item' />");
            } else {
                fullscreen.append("<img src='" + images[i].src + "' alt='" + images[i].data + "'/>");
            }
        }

    } else {
        for (var i = 0; i < images.length; i++) {

            if (i == centerElement) {
                fullscreen.append("<img src='" + images[i].src + "' alt='" + images[i].data + "' class='center-item' />");
            } else {
                fullscreen.append("<img src='" + images[i].src + "' alt='" + images[i].data + "'/>");
            }
        }
    }

    var translate = (w + 1) * centerElement;
    translate = -translate + "px";


    numberDiapo = centerElement + 1;

    fullscreen.css('transform', 'translateX(' + translate + ')');

    $('.c-fullscreen-slider').addClass('chocolat-wrapper');

    $('.c-fullscreen-slider').append('<div class="chocolat-top"><i class="icon icon-close chocolat-close"></i></div>');

    $('.c-fullscreen-slider').append('<div class="c-chocolat-bottom">' +
        '<div class="chocolat-bottom">' +
        '<span class="chocolat-fullscreen"></span>' +
        '<span class="chocolat-description"><span class="category">' + images[centerElement].label + '</span><span class="date">' + images[centerElement].date + '</span><h2 class="title-slide">' + images[centerElement].title + '</h2></span>' +
        '<span class="chocolat-pagination"> ' + numberDiapo + '/' + images.length + ' <i class="icon icon-media"></i></span>' +
        '<span class="chocolat-set-title"></span>' +
        '<div class="thumbnails owl-carousel owl-theme owl-loaded">' +
        '</div>' +
        '<div class="credit">' + images[centerElement].caption + '</div>' +
        '<a href="" class="share"><i class="icon icon-share"></i></a>' +
        '<div class="buttons square img-slideshow-share rs-slideshow">' +
        '<div class="texts-clipboard"></div>' +
        '<a href="'+images[centerElement].facebookurl+'" rel="nofollow" class="button facebook ajax">' +
        '<i class="icon icon-facebook"></i></a>' +
        '<a href="'+images[centerElement].twitterurl+'" class="button twitter">' +
        '<i class="icon icon-twitter"></i></a>' +
        '<a href="#" rel="nofollow" class="link self button" data-clipboard-text="'+images[centerElement].url+'"><i class="icon icon-link"></i></a>' +
        '<a href="#" class="button popin-mail-open"><i class="icon icon-letter"></i></a></div>' +
        '<div class="chocolat-left active"><i class="icon icon-arrow-left"></i></div>' +
        '<div class="chocolat-right active"><i class="icon icon-arrow-right"></i></div>' +
        '</div>' +
        '</div>');

    initRs();

    var thumbnails = $('.c-fullscreen-slider').find('.thumbnails');

    for (var i = 0; i < images.length; i++) {

        if(i == centerElement) {
            thumbnails.append("<div class='thumb active center'>" +
                "<img data-id='"+i+"' src='" + images[i].src + "' alt='" + images[i].data + "'/>" +
                "</div>");
        }else{

            thumbnails.append("<div class='thumb'>" +
                "<img  data-id='"+i+"' src='" + images[i].src + "' alt='" + images[i].data + "'/>" +
                "</div>");
        }
    }


    thumbnailsSlide = $('.chocolat-wrapper .thumbnails').owlCarousel({
        nav: false,
        dots: false,
        smartSpeed: 500,
        margin: 0,
        autoWidth: true,
        URLhashListener: false
    });

    thumbs = thumbnails.find(".thumb");

    $(thumbs).on('click', function () {

        if (!$('.c-fullscreen-slider .owl-stage').hasClass('owl-grab')) {

            $(thumbs).removeClass('active');
            $(this).addClass('active');

            id = $(this).find('img').attr('data-id');

            goToSLide(id);

            $('.chocolat-pagination').removeClass('active');
            $('.chocolat-wrapper .thumbnails').removeClass('open');
            $('.chocolat-content').removeClass('thumbsOpen');
            $('.fullscreen-slider img').css('opacity', '1');
        }
    });


    /*
     slider.addClass('fullscreen-slider');
     */

    $('.share').on('click', function(e){
        e.preventDefault();
        $('.rs-slideshow').toggleClass('show');
    });

    $('.chocolat-right').on('click', function () {
        goToNextPrev(0);
    })

    $('.chocolat-left').on('click', function () {
        goToNextPrev(1);
    })

    $('.chocolat-pagination').on('click', function () {
        $('.thumbnails').toggleClass('open');
        $(this).toggleClass('active');

        if ($('.thumbnails').hasClass('open')) {
            $('.fullscreen-slider img').css('transition', '.5s').css('opacity', '.5');
        } else {
            $('.fullscreen-slider img').css('opacity', '1');
        }
    })

    $('.chocolat-top').on('click', function(){
        $('.c-fullscreen-slider').addClass('animated fadeOut');

        setTimeout(function(){
            $('.c-fullscreen-slider').remove();
        }, 1000);
    });

    // mouseover img : close thumbs
    $('.fullscreen-slider').on('mouseover', function () {
        $('.chocolat-pagination').removeClass('active');
        $('.chocolat-wrapper .thumbnails').removeClass('open');
        $('.chocolat-content').removeClass('thumbsOpen');
        $('.fullscreen-slider img').css('opacity', '1');
    });
}




// Slideshow
// =========================
var slideshows = [],
    thumbnails = [];

function initSlideshows() {
    // create slider of thumbs
    var nbItems = $('.single-article').length != 0 ? 7 : 8;

    var sliderThumbs = $('.thumbnails').owlCarousel({
        nav          : false,
        dots         : false,
        smartSpeed   : 500,
        autoWidth    : true,
        margin       : 10,
        dragEndSpeed : 900,
        items        : nbItems
    });

    if(navigator.userAgent.indexOf("Edge")    > -1 ||
        navigator.userAgent.indexOf("MSIE")    > -1 ||
        navigator.userAgent.indexOf("Trident") > -1 ) {
        $('.thumbnails .thumb').each(function () {
            var $container = $(this),
                imgUrl     = $container.find('img').prop('src');

            if (imgUrl) {
                $container.css('backgroundImage', 'url('+imgUrl+')').addClass('compat-object-fit');
            }
        });
    }

    $('body').on('click', '.slideshow .thumbnails .owl-item', function(e) {
        sliderThumbs.trigger('to.owl.carousel', [$(this).index(), 400, true]);
    });

    // on click on thumbnail, change main picture
    $('.thumbnails .owl-item').on('click', function(e) {
        e.preventDefault();

        var i   = $(this).index(),
            cap = $(this).find('.thumb').data('caption');

        $(this).parents('.slideshow').find('.thumb').removeClass('active');
        $(this).parents('.slideshow').find('.images .img').removeClass('active');
        $(this).parents('.slideshow').find('.caption').html(cap);
        $(this).parents('.slideshow-img').find('.images .img').eq(i).addClass('active');
        $(this).find('.thumb').addClass('active');
    });

    // init slideshow
    /*  if($('.slideshow').length) {
     var slideshow = $('.slideshow .images').Chocolat({
     imageSize  : 'contain',
     fullScreen : false,
     loop       : true
     }).data('chocolat');

     slideshows.push(slideshow);
     }*/

    /*  if($('.all-photos').length) {
     var slideshow = $('#gridPhotos .images').Chocolat({
     imageSize     : 'contain',
     fullScreen    : false,
     imageSelector : '.item:not(.isotope-hidden) .chocolat-image'
     }).data('chocolat');

     slideshows.push(slideshow);
     }*/
}

// close slideshow on click
/*
 $('body').on('click', '.chocolat-close, .chocolat-overlay', function(e) {
 $('.chocolat-img').css('transition', 'all 0.9s ease').addClass('close');
 $('.chocolat-bottom').css('opacity', 0);
 $('.chocolat-bottom .img-slideshow-share .button.email').off('click');
 $('.chocolat-close').css('opacity', 0);

 setTimeout(function() {
 $('.chocolat-wrapper').removeClass('show');
 $('body').removeClass('fixed');

 if($('.slideshow').length) {
 if(window.location.hash) {
 var type = window.location.hash.substring(1).split('=')[0] || 'pid'
 pid  = window.location.hash.substring(1).split('=')[1] || 0;

 if($('[data-'+type+'='+pid+']').length > 0) {
 $('html, body').animate({
 scrollTop : $('[data-'+type+'='+pid+']').parents('.slideshow').offset().top - 300
 }, 0);
 }
 }
 }

 setTimeout(function() {
 for(var i=0; i<slideshows.length; i++) {
 // slideshows[i].api().close();
 slideshows[i].api().destroy();
 history.pushState("", document.title, window.location.pathname);
 }
 }, 1000);

 setTimeout(function() {
 slideshows = [];
 $('.chocolat-wrapper').remove();
 initSlideshows();
 }, 1400);
 }, 900);
 });
 */

/*
 // mouseover img : close thumbs
 $('body').on('mouseover', '.chocolat-img', function() {
 $('.chocolat-pagination').removeClass('active');
 $('.chocolat-wrapper .thumbnails').removeClass('open');
 $('.chocolat-content').removeClass('thumbsOpen');
 });

 // mouseover img : hide attribute title
 $('body').on('mouseover', '.chocolat-image', function() {
 $(this).attr('data-title', $(this).attr('title'));
 $(this).removeAttr('title');
 });

 // mouseout img : reset attribute title
 $('body').on('mouseout', '.chocolat-image', function() {
 $(this).attr('title', $(this).attr('data-title'));
 });

 // show thumbs
 $('body').on('click', '.chocolat-pagination', function() {
 $(this).toggleClass('active');
 $('.chocolat-wrapper .thumbnails').toggleClass('open');
 $('.chocolat-content').toggleClass('thumbsOpen');
 });

 $('body').on('click', '.chocolat-bottom .share', function() {
 $('.chocolat-bottom .buttons').toggleClass('show');
 });
 */

/*// zoom
 $('body').on('click', '.chocolat-image', function() {
 var $that = $(this);

 $('.chocolat-wrapper .chocolat-bottom').append('<div class="thumbnails"></div>');
 $('.chocolat-left, .chocolat-right').appendTo('.chocolat-bottom');
 $('.chocolat-left').html('<i class="icon icon_flecheGauche"></i>');
 $('.chocolat-right').html('<i class="icon icon_fleche-right"></i>');

 if($('.press-media').length || $('.downloading-press').length ){
 if($('.lock').length){
 $('<a href="#" class="share cadenas"><i class="icon icon_cadenas"></i></a>').insertBefore('.chocolat-wrapper .chocolat-left');
 }else{
 $('<a href="#" class="share download"><i class="icon icon_telecharger"></i></a>').insertBefore('.chocolat-wrapper .chocolat-left');
 }
 }else{
 $('<a href="#" class="share"><i class="icon icon_share"></i></a>').insertBefore('.chocolat-wrapper .chocolat-left');
 }
 $('<div class="buttons square img-slideshow-share"><a href="//www.facebook.com/sharer.php?u=html.festival-cannes-2016.com.ohwee.fr&t=le%20titre" rel="nofollow" class="button facebook ajax"><i class="icon icon_facebook"></i></a><a href="//twitter.com/intent/tweet?text=Enrages%20Polar%20Hybride" class="button twitter"><i class="icon icon_twitter"></i></a><a href="#" class="button link"><i class="icon icon_link"></i></a><a href="#" class="button email"><i class="icon icon_lettre"></i></a></div>').appendTo('.chocolat-bottom');
 $('<div class="zoomCursor"><i class="icon icon_loupePlus"></i></div>').appendTo('.chocolat-wrapper');
 $('<div class="credit">' + $that.data('credit') + '</div>').insertBefore('.chocolat-wrapper .share');

 linkPopinInit(0,'.img-slideshow-share .button.link');
 updatePhotoShare($that.data('pid'), $that.attr('title'));
 initPopinMail();

 var initPopinLock = function() {
 if($('.press.lock').length && !$('.connected').length) {

 if($('#popin-press').length) {

 $('.chocolat-wrapper .share.cadenas').on('click', function () {

 if($('#popin-press').hasClass('visible-popin')) {
 $('#popin-press').removeClass('visible-popin');
 $("#main").removeClass('overlay-popin');
 $('footer').removeClass('overlay');
 } else {
 $('#popin-press').addClass("visible-popin");
 $("#main").addClass('overlay-popin');
 }
 return false;
 });

 $(document).keyup(function (e) {
 if (e.keyCode == 27) {
 $('#popin-press').removeClass('visible-popin');
 $("#main").removeClass('overlay-popin');
 $('footer').removeClass('overlay');
 $('.overlay-div').remove();
 }
 });
 }

 $(document).on('touchstart click',function (e) {
 var $element = $(e.target);
 if (!$element.hasClass('visible-popin')) {
 var $isPopin = $element.closest('.visible-popin');
 var isButton = $element.hasClass('buttons');

 if ($isPopin.length || isButton) {
 } else {
 $('#popin-press').removeClass('visible-popin');
 $("#main").removeClass('overlay-popin');
 $('footer').removeClass('overlay');
 }
 }
 });
 }
 }

 initPopinLock();

 $('.chocolat-bottom .img-slideshow-share .button.email').on('click', function() {
 var parsed = $('<div/>').append($that.attr('title'));
 launchPopinMedia({}, '');
 });

 setTimeout(function() {
 $('.chocolat-wrapper').addClass('show');
 }, 200);

 setTimeout(function() {
 $('.chocolat-wrapper .chocolat-img').css('transition', 'all 900ms cubic-bezier(0.165, 0.435, 0.000, 0.935)');
 // change url hash
 window.location.hash = 'pid='+$that.data('pid');
 $('body').addClass('fixed');
 }, 2500);

 $(this).parents('.slideshow').find('.thumbnails .thumb').each(function() {
 $('.chocolat-wrapper .thumbnails').append($(this).clone());
 });

 if($(this).parents('#gridPhotos').length) {
 $('#gridPhotos .item').each(function() {
 if($(this).css('display') != 'none') {
 $('.chocolat-wrapper .thumbnails').append('<div data-pid="' + $(this).find('.chocolat-image').data('pid') + '" class="thumb"><img src="' + $(this).find('img').attr('src') + '" /></div>');
 }
 });
 }

 if ($('body').hasClass('mob')) {
 $('.chocolat-bottom').addClass('show');
 }

 thumbnails = $('.chocolat-wrapper .thumbnails').owlCarousel({
 nav             : false,
 dots            : false,
 smartSpeed      : 500,
 margin          : 0,
 autoWidth       : true,
 URLhashListener : false
 });
 });*/


// on click on thumb from the list : change pic and update hash
$('body').on('click', '.chocolat-wrapper .thumb', function() {
    var j = $(this).parent().index();

    $('.chocolat-wrapper .thumb').removeClass('active');
    $(this).addClass('active');

    if($('body').hasClass('chocolat-zoomed')) {
        $('.chocolat-content img.chocolat-img').trigger('click');
    }

    var slideshow = $('.slideshow .images').data('chocolat');
    for(var i=0; i<slideshows.length; i++) {
        slideshows[i].api().goto(j);
    }

    $('.chocolat-pagination').trigger('click');

    window.location.hash = 'pid='+$('#'+$(this).data('id')).data('pid');

    /*
     updatePhotoShare($('#'+$(this).data('id')).data('pid'), $('#'+$(this).data('id')).attr('title'));
     */
});

$(document).ready(function() {
    initSlideshows();

    // if url contains a hash : load pic
    if(window.location.hash) {
        if($('.chocolat-image').length) {
            var type = window.location.hash.substring(1).split('=')[0] || 'pid'
            pid  = window.location.hash.substring(1).split('=')[1] || 0;
            if($('[data-'+type+'='+pid+']').length) {
                $('[data-'+type+'='+pid+']').trigger('click');
                $('.chocolat-wrapper .thumb').removeClass('active');
                $('.chocolat-wrapper .thumb[data-pid="' +  pid + '"]').addClass('active');

                /*
                 updatePhotoShare(pid, $('[data-'+type+'='+pid+']').attr('title'));
                 */
            } else {
                history.pushState("", document.title, window.location.pathname);
            }
        }
    }
});

// update hash and active photo on nav click
/*$('body').on('click', '.chocolat-left', function(e){
 var type = window.location.hash.substring(1).split('=')[0] || 'pid'
 pid  = window.location.hash.substring(1).split('=')[1] || 0;

 if($('[data-'+type+'='+pid+']').parent().index() - 1 > 0) {
 window.location.hash = 'pid='+$('[data-'+type+'='+pid+']').parent().prev().find('a').data('pid');

 updatePhotoShare($('[data-'+type+'='+pid+']').parent().prev().find('a').data('pid'), $('[data-'+type+'='+pid+']').parent().prev().find('a').attr('title'));

 if(typeof thumbnails != 'undefined') {
 thumbnails.trigger('to.owl.carousel', [$('[data-'+type+'='+pid+']').parent().index() - 2, 400, true]);
 }

 $('.chocolat-wrapper .thumb').removeClass('active');
 $('.chocolat-wrapper .thumb[data-pid="' + $('[data-'+type+'='+pid+']').parent().prev().find('a').data('pid') + '"]').addClass('active');
 }
 });*/

/*// update hash and active photo on nav click
 $('body').on('click', '.chocolat-right', function(e) {
 var type = window.location.hash.substring(1).split('=')[0] || 'pid'
 pid  = window.location.hash.substring(1).split('=')[1] || 0;

 if($('[data-'+type+'='+pid+']').parent().index() + 1 < $('[data-'+type+']').length) {
 window.location.hash = 'pid='+$('[data-'+type+'='+pid+']').parent().next().find('a').data('pid');

 if(typeof thumbnails != 'undefined') {
 thumbnails.trigger('to.owl.carousel', [$('[data-'+type+'='+pid+']').parent().index() - 1, 400, true]);
 }

 $('.chocolat-wrapper .thumb').removeClass('active');
 $('.chocolat-wrapper .thumb[data-pid="' + $('[data-'+type+'='+pid+']').parent().next().find('a').data('pid') + '"]').addClass('active');

 updatePhotoShare($('[data-'+type+'='+pid+']').parent().next().find('a').data('pid'), $('[data-'+type+'='+pid+']').parent().next().find('a').attr('title'));
 }
 });

 // cursor close
 $('body').on('mouseout', '.chocolat-content', function() {
 $('.zoomCursor').addClass('hide');
 return false;
 });

 $('body').on('mouseenter', '.chocolat-content', function() {
 $('.zoomCursor').removeClass('hide');
 return false;
 });*/

var timeoutCursor;

/*

 $('body').on('mousemove', '.chocolat-content', function(e) {
 if($('body').hasClass('mob')) {
 return false;
 }

 if($('.chocolat-zoomed').length) {
 $('.zoomCursor .icon').removeClass('icon_loupePlus').addClass('icon_loupeMoins');
 } else {
 $('.zoomCursor .icon').removeClass('icon_loupeMoins').addClass('icon_loupePlus');
 }

 $('.zoomCursor').css('left', e.clientX + 10).css('top', e.clientY);
 $('.chocolat-bottom').addClass('show');

 clearTimeout(timeoutCursor);
 timeoutCursor = setTimeout(function() {
 $('.chocolat-bottom').removeClass('show');
 $('.chocolat-bottom .buttons').removeClass('show');
 }, 4000);
 });
 */

/*
 function updatePhotoShare(pid, title) {
 var pid      = pid || 0,
 title    = title || "",
 t0       = title.split('<h2>') || "",
 t1       = typeof t0[1] !== 'undefined' ? t0[1].split('</h2>') : "",
 shareUrl = GLOBALS.urls.photosUrl+'#pid='+pid;

 $('.chocolat-bottom .img-slideshow-share .button.facebook').off('click');
 $('.chocolat-bottom .img-slideshow-share .button.twitter').off('click');

 // CUSTOM LINK FACEBOOK
 var fbHref = 'http://www.facebook.com/dialog/feed?app_id=1198653673492784' +
 '&link=CUSTOM_URL' +
 '&picture=CUSTOM_IMAGE' +
 '&name=CUSTOM_NAME' +
 '&caption=' +
 '&description=CUSTOM_DESC' +
 '&redirect_uri=http://www.festival-cannes.com/fr/sharing' +
 '&display=popup';
 fbHref     = fbHref.replace('CUSTOM_URL', encodeURIComponent(shareUrl));
 fbHref       = fbHref.replace('CUSTOM_IMAGE', encodeURIComponent($('[data-pid='+pid+']').attr('href')));
 fbHref       = fbHref.replace('CUSTOM_NAME', encodeURIComponent(t1.slice(0, -1)));
 fbHref       = fbHref.replace('CUSTOM_DESC', encodeURIComponent('© ' + $('[data-pid='+pid+']').attr('data-credit')));
 $('.chocolat-bottom .img-slideshow-share .facebook').attr('href', fbHref);
 // CUSTOM LINK TWITTER
 var twHref = "//twitter.com/intent/tweet?text=CUSTOM_TEXT";
 twHref     = twHref.replace('CUSTOM_TEXT', encodeURIComponent(t1[0]+" "+shareUrl));
 $('.chocolat-bottom .img-slideshow-share .twitter').attr('href', twHref);
 // CUSTOM LINK COPY
 $('.chocolat-bottom .img-slideshow-share .button.link').attr('href', shareUrl);
 $('.chocolat-bottom .img-slideshow-share .button.link').attr('data-clipboard-text', shareUrl);

 $('.chocolat-bottom .img-slideshow-share .button.facebook').on('click',function() {
 $('.chocolat-bottom .buttons').removeClass('show');
 window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=700,height=500');
 return false;
 });
 $('.chocolat-bottom .img-slideshow-share .button.twitter').on('click', function() {
 $('.chocolat-bottom .buttons').removeClass('show');
 window.open(this.href,'','width=700,height=500');
 return false;
 });

 var parsed = $('<div/>').append(title);
 updatePopinMedia({
 'type'     : "photo",
 'category' : parsed.find('.category').text(),
 'date'     : parsed.find('.date').text(),
 'title'    : parsed.find('h2').text(),
 'url'      : shareUrl,
 });
 }*/

var owInitTab = function(id) {

    if(id == 'tab1') {

        var $tab = $('.tab1 td');


        $tab.on('click', function(e) {
            var $element = $(this);
            var dataTab = $element.data('tab');
            var $block = $('.block-contain-txt-register-movie[data-article='+dataTab+']');

            $tab.removeClass('active');
            $element.addClass('active');

            $('.block-contain-txt-register-movie').removeClass('active animated fadeInUp');

            $block.addClass('active animated fadeInUp');
        });

    }
};

var owInitValidateNewsletter = function() {

    var errorMsg = '';
    $('.newsletter #email').on('focus', function() {
        if($(this).val() == GLOBALS.texts.newsletter.errorsNotValide || $(this).val() == GLOBALS.texts.newsletter.errorsMailEmpty ||
            errorMsg != '') {
            $(this).val('');
            $(this).removeClass('error');
        }
    });

    // on submit : check if there are errors in the form
    $('.newsletter form').on('submit', function() {

        var input = $('.newsletter #email');
        var empty = false;

        if($('#email').val() == '') {
            empty = true;
            input.addClass("error").val(GLOBALS.texts.newsletter.errorsMailEmpty);
        } else {

            var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            var is_email=re.test(input.val());
            if(is_email){
                input.removeClass("error");
            }
            else {
                input.addClass("error").val(GLOBALS.texts.newsletter.errorsNotValide);
            }
        }

        if($('.newsletter .error').length || empty) {
            return false;
        } else {
            event.preventDefault();
            event.stopPropagation();

            $.ajax({
                type     : "POST",
                dataType : "json",
                cache    : false,
                url      : GLOBALS.urls.newsletterUrl,
                data     : $('form#newsletter').serialize(),
                success: function(data) {
                    if (data.success == false) {
                        input.addClass("error");
                        input.val(data.object);
                        errorMsg = data.object;
                    }
                    else {
                        $('.newsletter form').addClass('hide');
                        $('#confirmation span').html($('#email').val());
                        $('#confirmation').addClass('show');
                    }
                }
            });

            return false;
        }
    });
}
/*------------------------------------------------------------------------------
 JS Document (https://developer.mozilla.org/en/JavaScript)

 project:    Festival de Cannes
 Author:     OHWEE
 created:    2016-24-03

 summary:    CONSTANTES
 UTILITIES
 WINDOW.ONLOAD
 MENU
 VIDEOS
 PLAY
 ----------------------------------------------------------------------------- */

/*  =INIT
 ----------------------------------------------------------------------------- */

$(document).ready(function () {

    if (/MSIE 10/i.test(navigator.userAgent)) {
        $('body').addClass('ie');
        console.log('ici');
    }

    if (/MSIE 9/i.test(navigator.userAgent) || /rv:11.0/i.test(navigator.userAgent)) {
        $('body').addClass('ie');
    }

    initHeaderSticky();
    // owInitLinkChangeEffect(); add ??

    //gestion des cookie a faire ici

    owInitPopin('popin-landing-e');
    owInitPopin('popin-timer-banner');

    //fix scale zoom tablette

    var scale = function () {
        if (window.matchMedia("(orientation: portrait)").matches || window.matchMedia("(max-width: 769px)").matches) {
            var w = $('body').width();
            var scale = w / 1024;
            $('footer, #breadcrumb, .read-more, .who .navigation-sticky, .timelapse.block-drag, .block-02, .block-scale, .slider-home, .block-search, .block-movie-preview, .retrospective .isotope-01, .contain-title, .contain-titles, .block-social-network-all, .title-9, .retrospective .buttons-01').css('zoom', scale);
            $('body').addClass('portrait');

        } else {
            $('footer, #breadcrumb, .who .navigation-sticky, .read-more, .timelapse.block-drag, .block-02, .block-scale, .slider-home, .block-search, .block-movie-preview, .retrospective .isotope-01, .contain-title, .contain-titles, .block-social-network-all, .title-9, .retrospective .buttons-01').css('zoom', 0);
            $('body').removeClass('portrait');
        }
    }

    scale();

    window.addEventListener('orientationchange', scale);

    if ('ontouchstart' in window) {
        if (navigator.userAgent.indexOf("iPad") > -1 ||
            navigator.userAgent.indexOf("iPhone") > -1 ||
            navigator.userAgent.indexOf("Android") > -1) {
            $('body').addClass('mobile');
        } else {
            $('body').addClass('mobile');
        }
    } else {
        $('body').addClass('not-mobile');
    }

    if ($('body').hasClass('mobile') > 0) {
        var hideKeyboard = function () {
            document.activeElement.blur();
            $(".newsletter#email").blur();
        };

        $('.newsletter').focusin(function () {

            $('#breadcrumb, .all-contain, .social, .title, .subtitle, .footer-menu').on('click', function () {
                hideKeyboard();
            })
        });
    }

    if ($('#breadcrumb').length > 0) {
        owInitFooterScroll();
        owInitValidateNewsletter();
    }


    //fix link header
    $('header .hasSubNav .noLink').on("click", function (e) {
        e.preventDefault();
        //  return false;
    });

    if ($('body').hasClass('mobile')) {
        owFixMobile();
    }

    if ($('.video-player').length > 0) {
        initVideo();
    }

    if ($('.block-social-network ').length > 0) {
        initRs();
    }

    if ($('.block-diaporama').length > 0) {

        var hash = window.location.hash;
        hash = hash.substring(1, hash.length);

        verif = hash.slice(0, 3);

        if (hash.length > 0 && verif == "pid") {
            var slider = $('.block-diaporama .slider-01');
            owinitSlideShow(slider, hash);
        }
    }

    // owInitSearch();

    if ($('.home').length) {
        owInitSlider('home');
        owInitSlider('slider-01');
        owInitSlider('slider-02');
        owInitReadMore();
        var slider = $('.block-diaporama .slider-01');
        owinitSlideShow(slider);
    }


    if ($('.ajax-section').length) {
        owInitAjax();
    }

    if ($('.block-push-top').length) {
        onInitParallax();
    }


    if ($('.retrospective.poster').length) {
        owInitNavSticky(1);
    }

    if ($('.retrospective-home').length) {
        owInitSlider('timelapse-01');
        onInitParallax();
    }

    if ($('.medias').length > 0) {

        var hash = window.location.hash;
        hash = hash.substring(1, hash.length);

        verif = hash.slice(0, 3);
        number = hash.slice(4);

        if (hash.length > 0 && verif == "pid") {
            var slider = $('.grid-01');
            owinitSlideShow(slider, hash);
        } else {
            var slider = $('.grid-01');
            owinitSlideShow(slider);
        }

        if (hash.length > 0 && verif == "vid") {
            console.log(number);

            initVideo(number);
        } else {
            initVideo();
        }

        if (hash.length > 0 && verif == "aid") {
            initAudio(number);
        } else {
            initAudio();
        }
    }

    if ($('.retrospective.palmares').length) {
        owInitNavSticky(2);
    }

    if ($('.retrospective.selection').length) {
        owInitNavSticky(2);
        owInitGrid('isotope-01');
    }


    if ($('.single-movie').length) {
        var slider = $('.slideshow-img .images');
        owinitSlideShow(slider);
        owInitSlider('slider-03');
        scrollSingleMovie();
    }

    if ($('.jury').length) {
        owInitNavSticky(2);
        owInitGrid('isotope-01');
    }

    if ($('.article-single').length) {
        owInitNavSticky(1);
        owArrowDisplay();

        if (!$('.single-movie').length > 0) {
            var slider = $('.slideshow-img .images');
            owinitSlideShow(slider);
        }

        if ($('.artist-page').length > 0) {
            owInitSlider('slider-03');
        }
    }


    if ($('.articles-list').length) {

        var grid = owInitGrid('isotope-01');
        owsetGridBigImg(grid, $('.grid-01'), true);

        $(window).resize(function () {
            owsetGridBigImg(grid, $('.grid-01'), false);
        });
    }

    if ($('.articles-list-medias').length) {

        var grid = owInitGrid('isotope-01');

        owInitAleaGrid(grid, $('.grid-01'), true);
    }


    if ($('.edition-69.palm-gold').length) {
        owInitNavSticky(1);
    }

    if ($('.who').length) {
        owInitNavSticky(1);
    }

    if ($('.who-staff').length) {
        owInitGrid('isotope-02');
    }

    if ($('.who-identity-guidelines').length) {
        owInitAccordion("block-accordion");
    }

    if ($('.participate-accordion').length) {
        owInitAccordion("block-accordion");
    }

    if ($('.p-register').length) {
        owInitTab('tab1');
    }

    if ($('.media-library').length) {
        owInitSliderSelect('timelapse');
        owInitSliderSelect('tab-selection');

        var grid = owInitGrid('isotope-03');

        owInitAleaGrid(grid, $('.grid-01'), true);

        ajaxMedialib();
    }

    if ($('.search-page').length) {
        owInitSliderSelect('timelapse');
        owInitSliderSelect('tab-selection');
        owInitAccordion('more-search');
        owInitFilterSearch();
        owInitFilter(true);
    }

    if ($('.filters').length) {
        owInitFilter();
    }

    if ($('.filters-02').length) {
        owInitNavSticky(3);
        owRemoveElementListe();
        addNextFilters();
    }

    if ($('#share-article').length) {
        $('#share-article').on('click', function (e) {
            e.preventDefault();

            $('html, body').animate({
                scrollTop: $(".block-social-network").offset().top - $('header').height() - $('.block-social-network').height() - 300
            }, 500);
        });
    }

    setTimeout(function () {
        $('body').removeClass('loading');
    }, 1000);

});
