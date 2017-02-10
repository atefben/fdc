var videoNews;

String.prototype.trunc = function (n, useWordBoundary) {
    var isTooLong = this.length > n,
        s_ = isTooLong ? this.substr(0, n - 1) : this;
    s_ = (useWordBoundary && isTooLong) ? s_.substr(0, s_.lastIndexOf(' ')) : s_;
    return isTooLong ? s_ + '...' : s_;
};

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
            '<div class="channel video item shadow-bottom">\
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
                                <span class="date"></span>\
                                <p class="text"></p>\
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

        var $infoBar      = $container.find('.info'),
            $stateBtn     = $container.find('.play-btn'),
            $durationTime = $container.find('.duration-time'),
            $current      = $container.find('.current-time'),
            $progressBar  = $container.find('.progress-bar'),
            $fullscreen   = $container.find('.icon-fullscreen'),
            $sound        = $container.find('.sound'),
            $topBar       = $container.find('.top-bar'),
            $playlist     = [];

         setTimeout(function(){
            var infos = {
                'all': $container.parent().find('.info'),
                "category": $container.parent().find('.info .category').html(),
                "date": $container.parent().find('.info .date').html(),
                "hour": $container.parent().find('.info .hour').html(),
                "name": $container.parent().find('.info p').html()
            }

            $topBar.find('.info').html($container.closest('.popin-video').find('.popin-info').html());


        }, 700);

        if($('.container-webtv-ba-video').length > 0) {
            var shareUrl = $('.video .video-container').attr('data-link');
        } else {
            var shareUrl = document.location.href;
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
                var shareUrl = document.location.href;
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

            if (sc) {
                $(sc).find('.buttons .facebook').attr('data-href', fbHref);
                $(sc).find('.buttons .facebook').attr('href', fbHref);
                $(sc).find('.buttons .twitter').attr('href', twHref);
                $(sc).find('.buttons .link').attr('href', shareUrl);
                $(sc).find('.buttons .link').attr('data-clipboard-text', shareUrl);
            }
        }

        function initChannel() {

            sliderChannelsVideo = $('.slider-02').owlCarousel({
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

                $this = $(this);

                vidN = $this.find('.item').data('vid');

                var hashPush = '#vid='+vidN;
                history.pushState(null, null, hashPush);

            });

            sliderChannelsVideo.on('translated.owl.carousel', function () {
                index = $('.slider-02 .center').index();
                changeVideo(index,playerInstance,$('.slider-02 .center'));
                
                $this = $('.slider-02 .center');

                dateN = $this.find('.item').data('date');
                titleN = $this.find('.item').data('title');
                whoN = $this.find('.item').data('who');
                labelN = $this.find('.item').data('label');
                palmN = $this.find('.item').data('palm');
                palmDateN = $this.find('.item').data('palmdate');
                fbN = $this.find('.item').data('facebook');
                twitterN = $this.find('.item').data('twitter');
                linkN = $this.find('.item').data('link');
                vidN = $this.find('.item').data('vid');
                isPalm = $this.find('.item').data('ispalm');

                var hashPush = '#vid='+vidN;
                history.pushState(null, null, hashPush);

                $.each($('.text-infos'), function(i,e){
                    var $date = $(e).find('.title-3');
                    var $title = $(e).find('.title-4');
                    var $who = $(e).find('.title-5');
                    var $label = $(e).find('.title-6');
                    var $palm = $(e).find('.title-7');
                    var $isPalm = $(e).find('.ispalme');
                    var $palmDate = $(e).find('.date');
                    var $facebook = $(e).parent().find('.block-social-network .facebook');
                    var $twitter = $(e).parent().find('.block-social-network .twitter');
                    var $link = $(e).parent().find('.block-social-network .link');

                    $date.html('sortie le '+dateN);
                    $title.html(titleN);
                    $who.html(whoN);
                    $label.html(labelN);
                    $palm.html(palmN);

                    if(isPalm) {
                        $isPalm.addClass('icon-palme');
                    }else{
                        $isPalm.removeClass('icon-palme');
                    }

                    $palmDate.html(palmDateN);
                    $facebook.attr('href', fbN);
                    $twitter.attr('href', twitterN);
                    $link.attr('data-clipboard-text', linkN);

                    updatePopinMedia({
                        'type': "video",
                        'category': labelN,
                        'date': dateN,
                        'title': titleN,
                        'url': linkN
                    });

                    initRs();

                });

            })

            var changeVideo = function (index, playerInstance, exThis) {

                sliderChannelsVideo.trigger('to.owl.carousel', index);
                playerInstance.playlistItem(index);
                sliderChannelsVideo.trigger('to.owl.carousel',[index,1,true]);
                
            }


            if(hash > 0){

                setTimeout(function(){

                    if($('#sortiecanne').length > 0){
                        var test =  $('#sortiecanne').offset().top - 200;

                        test = parseInt(test);

                        $('html, body').animate({
                            scrollTop: test
                        }, 'slow');
                    }


                    $('.slider-02 .center').removeClass('center');

                    $.each($('.s-video-playlist .item'), function(i,e){
                        var tVid = $(e).data('vid');

                        if(tVid == hash) {
                            $(e).parent().addClass('center');
                            index = $(e).parent().index();
                        }
                    });

                    if(!$('.media-library').length && !$('.medias').length){
                        sliderChannelsVideo.trigger('to.owl.carousel', index);
                    }


                }, 1000);


            }
        }

        function initChannelTopBar() {

            sliderChannelsVideoTop = $container.find(".slider-channels-video").owlCarousel({
                nav: false,
                dots: false,
                smartSpeed: 500,
                center: true,
                loop: false,
                margin: 81
            });

            sliderChannelsVideoTop.on('click', '.owl-item', function () {
                var index = $(this).index();
                index = parseInt(index)
                console.log(index);
                console.log(index)
                playerInstance.playlistItem(index);

                var infos = $.parseJSON($(this).find('.channel.video').data('json'));

                $topBar.find('.info .category').text(infos.category);
                $topBar.find('.info .date').text(infos.date);
                $topBar.find('.info .hour').text(infos.hour);
                $topBar.find('.info p').text(infos.name);

                $container.find('.channels-video').removeClass('active');
                $container.find('.jwplayer').removeClass('overlay-channels');
                $container.find('.jwplayer').removeClass('overlay-channels over');

                sliderChannelsVideoTop.trigger('to.owl.carousel', [index, 1, true])

                updateShareLink(index)

                var item = $('.grid-01 .item.video')[index];
                var vid = $(item).data('vid');
                var newURL = window.location.href.split('#')[0] + '#vid=' + vid;
                history.replaceState('', document.title, newURL);

                updatePopinMedia({
                    'type': "video",
                    'category': infos.category,
                    'date': infos.date,
                    'title': infos.name,
                    'url': newURL
                });

                initRs();

            });


        }
        
        if($('.activeVideo').length > 0) {
            var videoFile =  $('.activeVideo').data('file');
            var videoImage =  $('.activeVideo').data('img');
        }
        
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
                        "date"     : $(p).find('.date').html(),
                        "hour"     : $(p).find('.hour').html(),
                        "category" : $(p).find('.info .category').html(),
                        "name"     : $(p).find('.info .contain-txt strong a').html()
                    }

                    playlist.push(tempList);
                });

                console.log(playlist)
                playerInstance.load(playlist);


            } else if (typeof $container.data('playlist') != "undefined") {

                playlist = $container.data('playlist');
                playerInstance.load(playlist);
            }

            $.each(playlist, function(i,p) {
                var tempSlide = $(slide);

                var catTrunc = p.category;
                catTrunc = catTrunc.trunc(15, true);

                tempSlide.find('.image-wrapper img').attr('src',p.image);
                tempSlide.find('.info-container .category').html(catTrunc);
                tempSlide.find('.info-container .date').html(p.date+' '+p.hour);
                tempSlide.find('.info-container .text').html(p.name);
                tempSlide.data('json', JSON.stringify(p));
                tempSlider.find('.slider-channels-video').append(tempSlide);
            });

            $playlist = playlist;

            tempSlider.insertAfter($topBar);

            var chan =  $('.channels');

            chan.on('click', function () {
                if(!$('.channels-video').hasClass('active')){
                    $container.find('.jwplayer').addClass('overlay-channels over');
                    $container.find('.channels-video').addClass('active');
                }else{
                    $container.find('.jwplayer').removeClass('overlay-channels over');
                    $container.find('.channels-video').removeClass('active');
                }
            });

            if($('.medias').length || $('.media-library').length){
                initChannelTopBar();
            }else{
                initChannel();
                initChannelTopBar();
            }




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

        $stateBtn.off('click').on('click', function() {
            playerInstance.play();
        });

        $progressBar.off('click').on('click', function(e) {
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
                name = $this.find('.contain-txt strong a').html();

            videoNews = playerInit('video-player-popin', 'video-playlist', 'grid', false);

            var hashPush = '#vid='+vid;
            history.pushState(null, null, hashPush);

            setTimeout(function(){
                videoNews.play();
            }, 800);


            // CUSTOM LINK FACEBOOK
            if ($('.container-webtv-ba-video').length > 0) {
                var shareUrl = $('.video .video-container').attr('data-link');
            } else {
                var shareUrl = document.location.href;
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

                    history.pushState(null, null, '#');

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
                name = $(this).find('.contain-txt strong a').data('title');

            videoNews = playerInit('video-player-popin', 'video-playlist', 'grid', false);

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
                var shareUrl = document.location.href;
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
                    history.pushState(null, null, '#');

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

        if($('.popin-mail').length) {
            $('.popin-mail').find('.contain-popin .theme-article').text(data['category']);
            $('.popin-mail').find('.contain-popin .date-article').text(data['date']);
            $('.popin-mail').find('.contain-popin .title-article').text(data['title']);
            $('.popin-mail').find('form #contact_section').val(data['category']);
            $('.popin-mail').find('form #contact_detail').val(data['date']);
            $('.popin-mail').find('form #contact_title').val(data['title']);
            $('.popin-mail').find('form #contact_url').val(data['url']);
            $('.popin-mail').find('.chap-article').html('');
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
    } else if($('.medias').length > 0 || $('.media-library').length > 0) {

        initPopinVideo(hash);

    } else if($('.video-playlist').length > 0) {

        videoPlayer = playerInit('video-playlist', 'video-playlist', true, false);

    } else if ($('#video-player-ba').length > 0) {

        videoMovieBa = playerInit('video-player-ba', false, true)

    } else if($('.video-player').length > 0) {

        $.each($('.video-player'), function(i,e){
            var id = $(e).find('.jwplayer').attr('id');
            videoPlayer = playerInit(id, 'video-player', false, false);
        })
    }
    

}
