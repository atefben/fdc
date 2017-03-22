
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
        var checkInt = window.setInterval(function(){
            $container.find('.jwplayer').removeClass('jw-skin-seven');
            if($container.find('.jwplayer').hasClass('jw-skin-seven')){
                window.clearInterval(checkInt);
            }
        },500);

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

        /*$topBar.find('.buttons .facebook').on('click',function() {
            window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=700,height=500');
            return false;
        });*/
        $topBar.find('.buttons .twitter').off('click').on('click', function() {
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
            sc    = secondaryContainer || 0;

            // CUSTOM LINK FACEBOOK
            if($('.container-webtv-ba-video').length > 0) {
                var shareUrl = $('.video .video-container').attr('data-link');
            } else {
                var shareUrl = document.location.href;
            }

            var fbHref   = facebookLink;
            fbHref       = fbHref.replace('CUSTOM_URL', encodeURIComponent(shareUrl));
            
            if(typeof index === 'undefined'){
                index = $('.activeVideo').index('.video');
            }

            if(typeof $playlist[index] !== 'undefined'){
                fbHref       = fbHref.replace('CUSTOM_IMAGE', encodeURIComponent($playlist[index].image));
                fbHref       = fbHref.replace('CUSTOM_NAME', encodeURIComponent($playlist[index].category));
                fbHref       = fbHref.replace('CUSTOM_DESC', encodeURIComponent($playlist[index].name));
            }


            $topBar.find('.buttons .facebook').attr('href', fbHref);

            // CUSTOM LINK TWITTER
            var twHref   = twitterLink;
            if(typeof $playlist[index] !== 'undefined'){
                twHref       = twHref.replace('CUSTOM_TEXT', encodeURIComponent($playlist[index].name+" "+shareUrl));
            }
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

            var updateHomeTextRight = function(data){
                $.each($('.text-infos'), function(i,e){
                    var $date = $(e).find('.title-3 .to-update');
                    var $title = $(e).find('.title-4');
                    var $who = $(e).find('.authors-container');
                    var $label = $(e).find('.title-6');
                    var $palm = $(e).find('.title-7');
                    var $isPalm = $(e).find('.ispalme');
                    var $palmDate = $(e).find('.date');
                    var $facebook = $(e).parent().find('.block-social-network .facebook');
                    var $twitter = $(e).parent().find('.block-social-network .twitter');
                    var $link = $(e).parent().find('.block-social-network .link');

                    $date.html(data.dateN);
                    $title.html(data.titleN).attr('href',data.url);

                    var dataAuthors = data.whoN;

                    if(Array.isArray(dataAuthors)){
                        var output = '';
                        for(var i = 0;i<dataAuthors.length;i++){
                            var item = dataAuthors[i];
                            output += '<a href="'+item.url+'" class="title-5">'+item.name+'</a>, ';
                        }
                        //formatting
                        output = $.trim(output);
                        output = output.substring(0, output.length - 1);
                        $who.empty().append(output);
                    }else{
                        var item = dataAuthors;
                        var output = '<a href="'+item.url+'" class="title-5">'+item.name+'</a>';
                        $who.empty().append(output);
                    }

                    $label.html(data.labelN);
                    $palm.html(data.palmN);

                    if(data.isPalm) {
                        $isPalm.addClass('icon-palme');
                    }else{
                        $isPalm.removeClass('icon-palme');
                    }


                    $palmDate.html(data.palmDateN);

                    updatePopinMedia({
                        'type': "video",
                        'category': data.labelN,
                        'date': data.dateN,
                        'who': data.whoN,
                        'email-content': data.emailContent,
                        'title': data.titleN,
                        'url': data.url
                    });

                    initRs();
                    if(!$facebook.length){
                        $facebook = $(e).closest('#sortiecanne').find('.block-social-network .facebook');
                    }
                    if(!$twitter.length){
                        $twitter = $(e).closest('#sortiecanne').find('.block-social-network .twitter');
                    }
                    if(!$link.length){
                        $link = $(e).closest('#sortiecanne').find('.block-social-network .link');
                    }
                    $facebook.attr('href', data.fbN);
                    $twitter.attr('href', data.twitterN);
                    $link.attr('data-clipboard-text', data.url);

                });
            }

            var loadInterval = window.setInterval(function(){
                if($('.slider-02 .owl-item.center').length){
                    var origData = {
                        dateN: $('.slider-02 .owl-item.center').find('.item').data('date'),
                        titleN: $('.slider-02 .owl-item.center').find('.item').data('title'),
                        whoN: $('.slider-02 .owl-item.center').find('.item').data('who'),
                        url: $('.slider-02 .owl-item.center').find('.item').data('url'),
                        labelN: $('.slider-02 .owl-item.center').find('.item').data('label'),
                        palmN: $('.slider-02 .owl-item.center').find('.item').data('palm'),
                        emailContent: $('.slider-02 .owl-item.center').find('.item').data('email-content'),
                        palmDateN: $('.slider-02 .owl-item.center').find('.item').data('palmdate'),
                        fbN: $('.slider-02 .owl-item.center').find('.item').data('facebook'),
                        twitterN: $('.slider-02 .owl-item.center').find('.item').data('twitter'),
                        linkN: $('.slider-02 .owl-item.center').find('.item').data('link'),
                        vidN: $('.slider-02 .owl-item.center').find('.item').data('vid'),
                        isPalm: $('.slider-02 .owl-item.center').find('.item').data('ispalm')
                    };

                    updateHomeTextRight(origData);
                    window.clearInterval(loadInterval);
                }
            },300);

            
            sliderChannelsVideo.on('translated.owl.carousel', function () {
                index = $('.slider-02 .center').index();
                changeVideo(index,playerInstance,$('.slider-02 .center'));
                
                $this = $('.slider-02 .center');

                var data = {
                    dateN: $this.find('.item').data('date'),
                    titleN: $this.find('.item').data('title'),
                    whoN: $this.find('.item').data('who'),
                    url: $this.find('.item').data('url'),
                    labelN: $this.find('.item').data('label'),
                    palmN: $this.find('.item').data('palm'),
                    emailContent: $this.find('.item').data('email-content'),
                    palmDateN: $this.find('.item').data('palmdate'),
                    fbN: $this.find('.item').data('facebook'),
                    twitterN: $this.find('.item').data('twitter'),
                    linkN: $this.find('.item').data('link'),
                    vidN: $this.find('.item').data('vid'),
                    isPalm: $this.find('.item').data('ispalm')
                }

                var hashPush = '#vid='+data.vidN;
                history.pushState(null, null, hashPush);

                updateHomeTextRight(data);

            });

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

        var videoFile =  $container.data('file');
        var videoImage =  $container.data('img');
        var controls = ($('body').hasClass('mobile')) ? true : false;
        var playerWidth = $(vid).closest('div').width();
        var playerHeight = $(vid).closest('div').height();

        if($('.activeVideo').length > 0) {
            var videoFile =  $('.activeVideo').data('file');
            var videoImage =  $('.activeVideo').data('img');
        }else{

        }

        
        if($('.home').length){
            playerHeight = 550;
        }

        if($(vid).is('#homepage-playlist-player')){
            playerHeight = 382;
            playerWidth = $('#homepage-playlist-player').outerWidth();
        }

        playerInstance.setup({
            sources: videoFile,
            image: videoImage,
            primary: 'html5',
            skin: 'seven',
            aspectratio: '16:9',
            width: playerWidth,
            height: playerHeight,
            controls: controls
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

                if(!$('.media-library').length){
                    playerInstance.load(playlist);
                }


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
        }).on('complete', function () {
            this.stop();
            $stateBtn.removeClass('icon-pause').addClass('icon-play');
            $container.addClass('state-complete');
            mouseMoving(false);
        }).on('firstFrame', function() {
            _duration = playerInstance.getDuration();
            duration_mins = Math.floor(_duration / 60);
            duration_secs = Math.floor(_duration - duration_mins * 60);
            console.log(duration_secs);
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
        var videoNews;
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
                if(typeof name === 'undefined'){
                    name = $(this).find('.contain-txt strong a').text();
                }

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
            console.log('email content',data['email-content']);
            if(typeof data['email-content'] !== 'undefined'){

                $('.popin-mail').find('.contain-popin #contact_message').html(data['email-content']);
            }
            console.log(data['who']);
            if(typeof data['who'] !== 'undefined'){
                var dataAuthors = data['who'];

                if(Array.isArray(dataAuthors)){
                    var output = '';
                    for(var i = 0;i<dataAuthors.length;i++){
                        var item = dataAuthors[i];
                        output += '<a href="'+item.url+'" class="title-5">'+item.name+'</a>, ';
                    }
                    //formatting
                    output = $.trim(output);
                    output = output.substring(0, output.length - 1);
                }else{
                    var item = dataAuthors;
                    var output = '<a href="'+item.url+'" class="title-5">'+item.name+'</a>';
                }
                $('.popin-mail').find('.contain-popin .article-authors').html(output);
            }
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
        if ($('.home #homepage-playlist-player').length > 0) {
            videoPlayer = playerInit('homepage-playlist-player',false , true);
        }else{
            videoPlayer = playerInit('video-playlist', 'video-playlist', true, false);
        }

    } else if ($('#video-player-ba').length > 0) {

        videoMovieBa = playerInit('video-player-ba', false, true)

    } else if($('.video-player').length > 0) {

        $.each($('.video-player'), function(i,e){
            var id = $(e).find('.jwplayer').attr('id');
            videoPlayer = playerInit(id, 'video-player', false, false);
        })
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
        $icon.removeClass('icon-minus').addClass('icon-more-square');

      }else{
        $parent.addClass('active');
        $icon.removeClass('icon-more-square').addClass('icon-minus');

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

  $('.ajax-section nav li:not(.active) a').on('click', function(e){
    e.preventDefault;

    var url = $(this).attr('href');

    $.get( url, function( data ) {
      $data = $(data);
      contain = $data.find('.contain-ajax')[0];

      test = $data.filter('#breadcrumb').children()[0];


      $( ".ajax-section" ).html(contain);

      $( "#breadcrumb" ).html(test);

      owInitFooterScroll(); 
      
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

      if($('#google-map').length) {
        google.maps.event.addDomListener(window, 'load', initMap);
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
/*

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
}*/


var owInitReadMore = function() {

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
            if (!$(audioPlayer).data('loaded') || $('.activeAudio').length > 0) {
                audioLoad($("#" + id)[0], audioPlayer, havePlaylist, function (aid) {
                    $(aid).data('loaded', true);
                    tmp = aid;console.log(name);
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

        var fileArray = $('.activeAudio').length > 0 ? audioFile : $container.data('file');
        var config = {
            //file: $container.data('file'),
            sources: fileArray,
            image: $('.activeAudio').length > 0 ? audioImage : $container.data('img'),
            primary: 'html5',
            aspectratio: '16:9',
            debug : true,
            width: $(aid).parent('div').width(),
            height: $(aid).parent('div').height(),
            controls: false
        };
        if(fileArray.length < 2){
            var tempArray = fileArray[0];

            if(typeof tempArray !== 'undefined'){
                console.log('tempArray',tempArray,tempArray.file);
                var finalFile = tempArray.file;
                config = {
                    file: finalFile,
                    image: $('.activeAudio').length > 0 ? audioImage : $container.data('img'),
                    primary: 'html5',
                    aspectratio: '16:9',
                    debug : true,
                    width: $(aid).parent('div').width(),
                    height: $(aid).parent('div').height(),
                    controls: false
                };
                
            }
        }

        console.log('audioplayer config',config);
        playerInstance.setup(config);

        playerInstance.on('ready', function () {
            updateShareLink();
            this.setVolume(100);
        }).on('play', function () {
            console.log('play');
            $container.removeClass('state-init').removeClass('state-complete');
            $stateBtn.find('i').removeClass('icon-play').addClass('icon-pause');
            $infoBar.find('.picto').addClass('hide');
            $controlBar.addClass('show');
        }).on('pause', function () {
            $stateBtn.find('i').removeClass('icon-pause').addClass('icon-play');
        }).on('buffer', function () {
        }).on('complete', function () {
            this.stop();
            $stateBtn.find('i').removeClass('icon-pause').addClass('icon-play');
            $container.addClass('state-complete');
        }).on('firstFrame', function () {
            _duration = playerInstance.getDuration();
            duration_mins = Math.floor(_duration / 60);
            duration_secs = Math.floor(_duration - duration_mins * 60);
            $durationTime.html(duration_mins + ":" + (duration_secs < 10 ? '0' + duration_secs : duration_secs));
        }).on('error',function(e){
            console.log(e);
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

        $stateBtn.off('click').on('click', function () {
            playerInstance.play();
        });

        $progressBar.off('click').on('click', function (e) {
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
    
    var audioPopin;

    if ($('#audio-player-popin').length > 0) {
        function updatePopinMedia(data) {
            data['url'] = data['url'] || document.location.href;

            if ($('.popin-mail').length) {
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


        if(hash != undefined) {

            $this = $('.item.audio[data-aid="' + hash + '"');

            $('.activeAudio').removeClass('activeAudio');
            $this.addClass('activeAudio');

            var $popinAudio = $('.popin-audio'),
                aid = $this.data('aid'),
                source = $this.data('file'),
                img = $this.data('img'),
                category = $this.find('.category').text(),
                date = $this.find('.date').text(),
                hour = $this.find('.hour').text(),
                name = $this.find('.contain-txt strong a').html();
                console.log(name);
            audioPopin = audioInit('audio-player-popin', false, false);
            audioPopin.playlistItem($this.index() - 1);

            $popinAudio.css('display','block');

            setTimeout(function(){
                var hashPush = '#aid='+aid;
                history.pushState(null, null, hashPush);

                audioPopin.play();
                audioPopin.play();
            }, 900);


            // CUSTOM LINK FACEBOOK
            var shareUrl = document.location.href;
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

                    e.preventDefault();

                    audioPopin.stop();
                    audioPopin.setMute(true);
                    audioPopin = 0;
                    history.pushState(null, null, '#');
                    $popinAudio.removeClass('video-player');
                    $popinAudio.removeClass('loading');
                    $popinAudio.css('display','none');
                    $popinAudio.removeClass('show');
                    $('#main').removeClass('overlay');
                    $('.activeAudio').removeClass('activeAudio');
                    $(audioPopin).data('loaded', false);

                    audioPopin = 0;

                    $('div.vFlexAlign, #main, footer, #logo-wrapper, #navigation').off('click');
                });

                initRs();

            }, 1000);



        }

        $('.item.audio').on('click', function (e) {

            e.preventDefault();


            $('.activeAudio').removeClass('activeAudio');
            $(this).addClass('activeAudio')

            var $popinAudio = $('.popin-audio'),
                aid = $(e.target).closest('.audio').data('aid'),
                source = $(e.target).closest('.audio').data('file'),
                img = $(e.target).closest('.audio').data('img'),
                category = $(e.target).closest('.audio').find('.category').text(),
                date = $(e.target).closest('.audio').find('.date').text(),
                hour = $(e.target).closest('.audio').find('.hour').text(),
                name = $(this).find('.contain-txt strong a').text();
            console.log(name);
            audioPopin = audioInit('audio-player-popin', false, false);
            audioPopin.playlistItem($(this).index() - 1);

            $popinAudio.css('display','block');

            setTimeout(function(){
                var hashPush = '#aid='+aid;
                history.pushState(null, null, hashPush);

                audioPopin.play();
                audioPopin.play();
            }, 900);

            // CUSTOM LINK FACEBOOK
            var shareUrl = document.location.href;
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

                    e.preventDefault();

                    audioPopin.stop();
                    audioPopin.setMute(true);
                    audioPopin = 0;

                    history.pushState(null, null, '#');
                    $popinAudio.removeClass('video-player');
                    $popinAudio.removeClass('loading');
                    $popinAudio.css('display','none');
                    $popinAudio.removeClass('show');
                    $('#main').removeClass('overlay');
                    $('.activeAudio').removeClass('activeAudio');
                    $(audioPopin).data('loaded', false);


                    $('div.vFlexAlign, #main, footer, #logo-wrapper, #navigation').off('click');


                    audioPopin = 0;
                });

                initRs();
            }, 1000);


        });
    }

    if ($('.audio-player-container').length > 0 && !$('.medias').length > 0) {
        audioPlayer = audioInit(false, 'audio-player-container', false);
    }
}
initAudio();
// var waves = [],
//     inter = null,
//     duration = null,
//     audioTop = 
//       '<div class="top">\
//         <a href="#" class="channels"><i class="icon icon_Micro"></i></a>\
//         <div class="info">\
//           <div class="vCenter">\
//             <div class="vCenterKid"></div>\
//           </div>\
//         </div>\
//       </div>',
//     audioShare =
//       '<div class="buttons square">\
//         <a href="//www.facebook.com/sharer.php?u=CUSTOM_URL" rel="nofollow" class="button facebook ajax"><i class="icon icon_facebook"></i></a>\
//         <a href="//twitter.com/intent/tweet?text=CUSTOM_TEXT" rel-"nofollow" class="button twitter"><i class="icon icon_twitter"></i></a>\
//         <a href="#" class="button link"><i class="icon icon_link"></i></a>\
//         <a href="#" class="button email"><i class="icon icon_lettre"></i></a>\
//       </div>',
//     audioSlider = '<div id="channels-audio"></div>';

// function redraw() {
//   for(var i=0; i<waves.length; i++) {
//     waves[i].drawBuffer();
//   }
// }

// function initAudioPlayers() {
//   $('.audio-player').each(function(i) {
//     var $that = $(this);

//     for(var i = 0; i < waves.length; i++) {
//       if(waves[i].isPlaying()) {
//         waves[i].stop();
//         wave[i].destroy();
//       }
//     }

//     if(typeof wave !== "undefined") {
//       wave.destroy();
//       wave = {};
//     }

//     $(this).addClass('loading').find('.wave-container').attr('id', 'wave-' + i);
//     var h = $(this).hasClass('bigger') ? 55 : 55;
//     var wave = WaveSurfer.create({
//       container     : document.querySelector('#' + 'wave-' + i),
//       backend       : 'MediaElement',
//       waveColor     : 'rgba(90, 90, 90, 0.5)',
//       progressColor : '#c8a461',
//       cursorWidth   : 0,
//       // cursorColor   : 'rgba(255,255,255,0.5)',
//       height        : h
//     });

//     // load the url of the sound
//     wave.load($(this).data('sound'));

//     // once it's ready
//     wave.on('ready', function() {
//       // $(wave.container).parents('.audio-player').removeClass('loading');
//       if($(wave.container).parents('.audio-player').hasClass('popin-audio')) {
//         $('.popin-audio .playpause').trigger('click');
//       }

//       var durr = wave.getDuration();
//       var minutes = parseInt(Math.floor(durr / 60));
//       var seconds = parseInt(durr - minutes * 60);

//       if(seconds < 10) {
//         seconds = '0' + seconds;
//       }
        
//       $(wave.container).parents('.audio-player').find('.duration .total').text(minutes + ':' + seconds);
//     });

//     wave.on('loading', function() {
//       $(wave.container).parents('audio-player').addClass('loading');
//     })

//     wave.on('decoded', function(e) {
//       $(wave.container).parents('.audio-player').removeClass('loading');
//     });

//     wave.on('finish', function() {
//       wave.stop();
//       $(wave.container).parents('.audio-player').removeClass('pause');
//       $(wave.container).parents('.audio-player').find('.playpause').html('<i class="icon icon_video"></i>');
//     });

//     waves.push(wave);

//     // on click on play/pause
//     var $playpause = $('.playpause');
//     var $fullscreen = $('.fullscreen');
//     var $volume = $('.volume');

//     $playpause.html('<i class="icon icon_video"></i>');
//     $fullscreen.html('<i class="icon icon_fullscreen"></i>');
//     if($volume.find('.icon_son').length == 0) $volume.append('<i class="icon icon_son"></i>');

//     $(this).find('.playpause').on('click', function(e) {
//       e.preventDefault();

//       $('.playpause').not($(this)).html('<i class="icon icon_video"></i>');
//       if($(this).find('i').hasClass('icon_video')) {
//         $(this).html('<i class="icon icon_pause"></i>');
//       } else {
//         $(this).html('<i class="icon icon_video"></i>');
//       }

//       if(inter) {
//         clearInterval(inter);
//       }

//       $audioplayer = $(e.currentTarget).parents('.audio-player');

//       // get duration
//       if(!$audioplayer.hasClass('on')) {
//         $audioplayer.addClass('on');

//         duration = wave.getDuration();
//         var minutes = parseInt(Math.floor(duration / 60));
//         var seconds = parseInt(duration - minutes * 60);

//         if(seconds < 10) {
//           seconds = '0' + seconds;
//         }
//         $audioplayer.find('.duration .total').text(minutes + ':' + seconds);
//       }

//       // update current time
//       inter = setInterval(function() {
//         var curr = wave.getCurrentTime();

//         var minutes = parseInt(Math.floor(curr / 60));
//         var seconds = parseInt(curr - minutes * 60);

//         if(seconds < 10) {
//           seconds = '0' + seconds;
//         }

//         $audioplayer.find('.duration .curr').text(minutes + ':' + seconds);
//       }, 1000);

//       if(!$audioplayer.hasClass('pause')) {
//         for(var i = 0; i<waves.length; i++) {
//           if(waves[i].isPlaying() && waves[i].container.id != wave.container.id) {
//             waves[i].pause();
//           }
//         }
//       }
//       $('.audio-player').not($audioplayer).removeClass('pause');

//       // set volume and play or pause
//       wave.setVolume(1);
//       wave.playPause();

//       $audioplayer.toggleClass('pause');
//     });
  
//     $(this).append(audioTop);
//     $(this).find('.top .info .vCenterKid').append($(this).find('.off .info').html());
//     $(this).find('.top').append(audioShare);
//     $(this).append(audioSlider);

//     var shareUrl = GLOBALS.urls.audiosUrl+'#aid='+$(this).data('aid');
//     // CUSTOM LINK FACEBOOK
//     var fbHref = $(this).find('.top .buttons .facebook').attr('href');
//     fbHref = fbHref.replace('CUSTOM_URL', encodeURIComponent(shareUrl));
//     $(this).find('.top .buttons .facebook').attr('href', fbHref);
//     // CUSTOM LINK TWITTER
//     var twHref = $(this).find('.top .buttons .twitter').attr('href');
//     twHref = twHref.replace('CUSTOM_TEXT', encodeURIComponent($(this).find('.top .info p').text()+" "+shareUrl));
//     $(this).find('.top .buttons .twitter').attr('href', twHref);
//     // CUSTOM LINK COPY
//     $(this).find('.top .buttons .link').attr('href', shareUrl);
//     $(this).find('.top .buttons .link').attr('data-clipboard-text', shareUrl);
//     linkPopinInit(shareUrl, '[data-aid="' + $(this).data('aid') + '"] .top .buttons .link');

//     $(this).find('.top .buttons .facebook').on('click',function(e) {
//         window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=700,height=500');
//         return false;
//     });
//     $(this).find('.top .buttons .twitter').on('click', function(e) {
//         window.open(this.href,'','width=700,height=500');
//         return false;
//     });
//     // CUSTOM LINK MAIL
//     $(this).find('.top .buttons .email').on('click', function(e) {
//         e.preventDefault();
//         launchPopinMedia({
//             'type'     : "audio",
//             'category' : $('[data-aid="' + $that.data('aid') + '"] .top .info .category').text(),
//             'date'     : $('[data-aid="' + $that.data('aid') + '"] .top .info .date').text(),
//             'title'    : $('[data-aid="' + $that.data('aid') + '"] .top .info p').text(),
//             'url'      : shareUrl
//         }, $that);
//     });
//   });
// }


// // Player Audio
// // =========================
// $(document).ready(function() {
//   function FShandler() {
//     setTimeout(function() {
//       redraw();
//     }, 200);

//     if (document.fullscreenEnabled && document.fullscreenElement == null) {
//       $('.audio-player').removeClass("full overlay-channels");
//       $('.audio-player .bottom').remove();
//     }
//     if (document.webkitFullscreenEnabled && document.webkitFullscreenElement == null) {
//       $('.audio-player').removeClass("full overlay-channels");
//       $('.audio-player .bottom').remove();
//     }
//     if (document.mozFullScreenEnabled && document.mozFullScreenElement == null) {
//       $('.audio-player').removeClass("full overlay-channels");
//       $('.audio-player .bottom').remove();
//     }
//     if (document.msFullscreenEnabled && document.msFullscreenElement == null) {
//       $('.audio-player').removeClass("full overlay-channels");
//       $('.audio-player .bottom').remove();
//     }
//   }

//   $('body').on('click', '.volume', function(e) {
//     if($(this).parents('.audio-player').hasClass('full')) {
//       if((e.offsetX/100) < 0.15) {
//         for(var i = 0; i < waves.length; i++) {
//           waves[i].toggleMute();
//         }

//         if(!$(this).hasClass('mute')) {
//           $('.audio-player .volume span').css('width',  '0%');
//         } else {
//           $('.audio-player .volume span').css('width',  '100%');
//         }

//         $(this).toggleClass('mute');
//       } else {
//         var newVolume = e.offsetX / 100;

//         $('.audio-player .volume span').css('width', newVolume * 100 + "%");

//         for(var i = 0; i < waves.length; i++) {
//           waves[i].setVolume(newVolume);
//         }
//       }
//     } else {
//       for(var i = 0; i < waves.length; i++) {
//         waves[i].toggleMute();
//       }

//       if(!$(this).hasClass('mute')) {
//         $(this).find('span').css('width',  '0%');
//       } else {
//         $(this).find('span').css('width',  '100%');
//       }

//       $(this).toggleClass('mute');
//     }
//   });

//   $('body').on('click', '.audio-player.full .channels', function(e) {
//     e.preventDefault();

//     $(this).toggleClass('active');

//     $('.audio-player.full').toggleClass('overlay-channels');
//     $('#channels-audio').toggleClass('active');
//   });

//   function closeChannels() {
//     $('.audio-player.full').removeClass('overlay-channels');
//     $('.audio-player.full .channels').removeClass('active');
//     $('#channels-audio').removeClass('active');
//   }

//   $('body').on('click', '.audio-player.full.overlay-channels', function(e) {
//     closeChannels();
//   });

//   if($('.audio-player').length) {
//     initAudioPlayers();
//   }

//   $('body').on('click', '#slider-channels-audio .channel .linkVid', function(e) {
//     closeChannels();
//     var ind = 0;

//     if($('.audio-player').length > 1) {
//       ind = $('.audio-player.full').index('.audio-player');
//     }

//     e.preventDefault();

//     var $audioPlayer = $('.audio-player.full'),
//         $newAudio = $(e.target).parent();

//     var s = $newAudio.data('sound'),
//         img = $newAudio.find('img').attr('src'),
//         info = $newAudio.find('.off .info').html();

//     $audioPlayer.find('.image').css('background-image', 'url(' + img + ')');
//     $audioPlayer.append('.top .info .vCenterKid').html(info);

//     waves[ind].load(s);

//     // update duration
//     waves[ind].on('ready', function() {
//       var duration = waves[ind].getDuration();
//       var minutes = parseInt(Math.floor(duration / 60));
//       var seconds = parseInt(duration - minutes * 60);

//       if(seconds < 10) {
//         seconds = '0' + seconds;
//       }
//       $audioPlayer.find('.duration .total').text(minutes + ':' + seconds);
//     });

//   });

//   // show audioplayer on fullscreen
//   $('body').on('click', '.audio-player .fullscreen', function(e) {
//     var i = $(this).parent().index('.audio-player'),
//         wave = waves[i];

//     e.preventDefault();
//     var audioPlayer = $(this).parents('.audio-player')[0];

//     $(audioPlayer).find('.fullscreen .icon').removeClass('icon_fullscreen').addClass('icon_reverseFullScreen');
//     if (document.fullscreenEnabled || 
//         document.webkitFullscreenEnabled || 
//         document.mozFullScreenEnabled || 
//         document.msFullscreenEnabled) {
//       if($(this).parents('.audio-player').hasClass('full')) {
//         AudioFullScreen(false, audioPlayer);
//       }
//       else {
//         $(audioPlayer).addClass('full');

//         if (audioPlayer.requestFullscreen) {
//           audioPlayer.requestFullscreen();
//         } else if (audioPlayer.webkitRequestFullscreen) {
//           audioPlayer.webkitRequestFullscreen();
//         } else if (audioPlayer.mozRequestFullScreen) {
//           audioPlayer.mozRequestFullScreen();
//         } else if (audioPlayer.msRequestFullscreen) {
//           audioPlayer.msRequestFullscreen();
//         }

//         $.ajax({
//           type: "GET",
//           dataType: "html",
//           cache: false,
//           url: 'channels.html' ,
//           success: function(data) {
//             $('#channels-audio').append(data);
//             var sliderChannelsAudio = $("#slider-channels-audio").owlCarousel({
//               nav: false,
//               dots: false,
//               smartSpeed: 500,
//               center: true,
//               loop: false,
//               margin: 80,
//               autoWidth: true,
//               onInitialized: function() {
//                 $('#slider-channels-audio .owl-stage').css({ 'margin-left': "-343px" });

//                 setTimeout(function() {
//                   redraw();
//                 }, 200);
//               }
//             });

//             sliderChannelsAudio.owlCarousel();

//           }
//         });

//         document.addEventListener("fullscreenchange", FShandler);
//         document.addEventListener("webkitfullscreenchange", FShandler);
//         document.addEventListener("mozfullscreenchange", FShandler);
//         document.addEventListener("MSFullscreenChange", FShandler);
//       }
//     }
//   });
// });

// function AudioFullScreen(toggle, audioInstance) {
//   if (!toggle) {
//     $(audioInstance).find('.fullscreen .icon').removeClass('icon_reverseFullScreen').addClass('icon_fullscreen');

//     setTimeout(function() {
//       redraw();
//     }, 200);

//     if (document.exitFullscreen) {
//       document.exitFullscreen();
//     } else if (document.webkitExitFullscreen) {
//       document.webkitExitFullscreen();
//     } else if (document.mozCancelFullScreen) {
//       document.mozCancelFullScreen();
//     } else if (document.msExitFullscreen) {
//       document.msExitFullscreen();
//     }
//   }
// }
var initContact = function () {
    $('.contact input[type="text"], textarea').on('input', function() {
        var input = $(this);
        var is_name = input.val();
        if(is_name){
            input.removeClass("invalid").addClass("valid");
            $('.errors .' + input.attr('name')).remove();
        }
        else{
            input.removeClass("valid").addClass("invalid");
            $('.errors .' + input.attr('name')).remove();
            $('.errors ul').append('<li class="' + input.attr('name') + '">' + input.data('error') + '</li>');
        }

        if($('.invalid').length) {
            $('.errors').addClass('show');
        } else {
            $('.errors').removeClass('show');
        }
    });

    $('#triggerSelect').on('click', function(e) {
        e.preventDefault();

        var h = '';

        $('.select option').not('.default').each(function() {
            h += '<span data-select="' + $(this).val() + '">' + $(this).html() + '</span>';
        });

        $('#filters').remove();
        $('body').append('<div id="filters" class="selectOptions"><div class="vCenter"><div class="vCenterKid"></div></div><div class="close-button"><i class="icon icon-close"></i></div></div>');
        $('#filters .vCenterKid').html(h);

        setTimeout(function() {
            $('#filters').addClass('show');
        }, 100);

        setTimeout(function() {
            $('#filters span').addClass('show');
        }, 400);
    });


    if($('.select option:selected').length){
        var textSelectValue = $('.select option:selected').text();
    }else{
        var textSelectValue = $('.select select option.default').text();
    }
    console.log(textSelectValue);
    
    //init value
    $('.select .select-value .val span').html(textSelectValue);
    $('body').on('click', '.selectOptions span', function() {
        var i = parseInt($(this).index()) + 1;
        $('select option').eq(i).prop('selected', 'selected');
        $('.select .select-value .val span').html($(this).text());
        $('.select').removeClass('invalid');
        $clamp($('.select .select-value .val span').get(0), {clamp: '50px'});
    });

    // check valid email address
    $('.contact input[type="email"]').on('input', function() {
        var input=$(this);
        var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        var is_email=re.test(input.val());
        if(is_email){
            input.removeClass("invalid").addClass("valid");
            $('.errors .' + input.attr('name')).remove();
        }
        else{
            input.removeClass("valid").addClass("invalid");
            $('.errors .' + input.attr('name')).remove();
            $('.errors ul').append('<li class="' + input.attr('name') + '">' + input.data('error') + '</li>');
        }

        if($('.invalid').length) {
            $('.errors').addClass('show');
        } else {
            $('.errors').removeClass('show');
        }
    });

    // on submit : check if there are errors in the form
    $('.contact form').on('submit', function() {
        var empty = false;

        if($('select').val() == 'default') {
            $('.select').addClass('invalid');
        } else {
            $('.select').removeClass('invalid');
        }

        $('.contact input[type="text"], .contact input[type="email"], .contact textarea').each(function() {
            if($(this).val() == '') empty = true;
        });

        if(empty) {
            $('.contact input[type="email"], .contact input[type="text"], textarea').trigger('input');
        }

        if($('.invalid').length || empty) {
            return false;
        }
    });

    // filter data on page
    $('body').on('click', '#filters span', function() {
        var id = $('#filters').data('id'),
            f  = $(this).data('filter');

        $('#' + id + ' .select span').removeClass('active');
        $('#' + id + ' .select span[data-filter="'+f+'"]').addClass('active');

        filter();

    });

    // close filters
    $('body').on('click', '#filters', function() {
        $('#filters').removeClass('show');
        setTimeout(function() {
            $('#filters').remove();
        }, 700);
    });

    function filter() {
        var id = $('#filters').data('id');
        var filters = [];

        $('.filter').each(function() {
            var $that = $(this);
            var a = $that.find('.select span.active').data('filter');

            if(a == 'all') {
                $('.content-news .slideshow').show();
                return;
            }

            var obj = {'filter': $that.attr('id'), 'value': a};

            filters.push(obj);
        });

        var exp1 = '',
            exp2 = '';

        for(var i=0; i<filters.length; i++) {
            exp1 += '[data-' + filters[i].filter + ']';
            exp2 += '[data-' + filters[i].filter + '="' + filters[i].value + '"]';
        }

        if(filters.length != 0) {
            $('*' + exp1).hide();
            $('*' + exp2).show();

        } else {
            $('*[data-' + id + ']').show();
            if($('.articles').length != 0) {
                $('.filter .select span').removeClass('disabled');
            }
        }
    }
}
var initFaq = function() {
    
    $(".faq-container article").click(function(){
        var i;
        i = $(this).find("i.icon");
        if($(this).hasClass("faq-article-active")){

            $(this).animate({maxHeight:"100px"},100,function(){
                $(this).removeClass("faq-article-active");
                i.removeClass("icon-minus").addClass("icon-more-square");
            });
        }else{
            $(this).addClass("faq-article-active");
            i.removeClass("icon-more-square").addClass("icon-minus");
            $(this).animate({maxHeight:"5000px"},300);
        }
    });
    //navigation
    $(".faq-menu li").click(function(){
        var $active;
        var nameActiveSection;
        var $activeSection;
        var $newActiveSection;
        var $newActiveNav;
        var nameNewActiveSection;
        //find active section and name data
        $active = $('.faq-menu').find("li.active");
        nameActiveSection = $active.data("name");
        $activeSection = $('section[data-name='+nameActiveSection+']');
        nameNewActiveSection= $(this).data("name");
        $newActiveSection = $('section[data-name='+nameNewActiveSection+']');
        $newActiveNav = $('li[data-name='+nameNewActiveSection+']');

        if(!$(this).hasClass("active")){
            //hide active section
            $activeSection.animate({
                top: "200px",
                opacity:0
            },500,function(){
                $activeSection.css({display:'none'});
                $newActiveSection.css({display:'inline-block'});
                $activeSection.removeClass("faq-active");
                $newActiveSection.addClass("faq-active");
                $('.faq-menu li').removeClass("active");
                $newActiveNav.addClass('active');
                $newActiveSection.animate({
                    top:0,
                    opacity:1
                },500);
            });
        }
    });
}
// Filters
// =========================


var isotopeHomepageItems = [];

var contains = function(needle) {
    // Per spec, the way to identify NaN is that it is not equal to itself
    var findNaN = needle !== needle;
    var indexOf;

    if(!findNaN && typeof Array.prototype.indexOf === 'function') {
        indexOf = Array.prototype.indexOf;
    } else {
        indexOf = function(needle) {
            var i = -1, index = -1;

            for(i = 0; i < this.length; i++) {
                var item = this[i];

                if((findNaN && item !== item) || item === needle) {
                    index = i;
                    break;
                }
            }

            return index;
        };
    }

    return indexOf.call(this, needle) > -1;
};

var owInitFilter = function (isTabSelection) {
    isTabSelection = isTabSelection || false;
    var homepageItemsFilled = false;

    // on click on a filter
    if (isTabSelection) {

        $('.tab-selection .selection').on('click', function (e) {

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
                var selected = $('#' + block + ' .select option[value="' + data + '"]');
                selected.attr('selected', 'selected');
            });

        });

        // close filters
        $('body').off('click').on('click', '#filters', function () {
            $('#filters').removeClass('show');
            setTimeout(function () {
                $('#filters').remove();
            }, 700);
        });

    } else {

        if(!$('.home').length) {
            if (!$('.who-filter').length) {
                $('.filters .select span').off('click').on('click', function () {
                    $('.filter .select').each(function () {
                        $that = $(this);
                        $id = $(this).closest('.filter').attr('id');

                        console.log($that.find("span:not(.active):not([data-filter='all'])"));
                        $that.find("span:not(.active):not([data-filter='all'])").each(function () {
                            $this = $(this);

                            var getVal = $this.data('filter');

                            if($('.articles-list').length){
                                var numItems = $('.item.' + getVal + ':not([style*="display: none"])').length;
                            }else{
                                var numItems = $('.item[data-' + $id + '="' + getVal + '"]:not([style*="display: none"])').length;
                            }

                            if (numItems === 0) {
                                $this.addClass('disabled');
                            } else {
                                $this.removeClass('disabled');
                            }
                        });
                    });

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

                    var fnArraySortFilters = function(){
                        $('#filters span').off('click').on('click', function () {
                            if($('.home').length){
                                var selectedClass = $(this).data('filter');
                                /* TODO 
                                    destroy all isotope
                                    stock html in js array
                                    repopulate first grid
                                    compute new height for last section
                                */

                                //fill array with homepage items if not set
                                if(!homepageItemsFilled){
                                    homepageItemsFilled = true;
                                    $('.contain-card article').each(function(index,value){
                                        isotopeHomepageItems.push(value);
                                    });

                                    $('.articles-wrapper article').each(function(index,value){
                                        isotopeHomepageItems.push(value);
                                    });
                                }

                                $('.contain-card .isotope-01').each(function(){
                                    $(this).isotope('destroy');
                                    $(this).find('article').each(function(){
                                        $(this).remove();
                                    });
                                });
                                $('.articles-wrapper .isotope-01').each(function(){
                                    $(this).isotope('destroy');
                                    $(this).find('article').each(function(){
                                        $(this).remove();
                                    });
                                });

                                //get accurate data
                                var innerIndex = 0;
                                var activeAppendedGridContainer = $('.contain-card');
                                $.each(isotopeHomepageItems,function(index,value){
                                    if($(value).hasClass(selectedClass)){


                                        //switch container
                                        if(innerIndex > 2 && innerIndex < 6){
                                            activeAppendedGridContainer = $('.articles-wrapper .articles:first-child');
                                        }else{
                                            if(activeAppendedGridContainer.find('article').size() > 2){
                                                activeAppendedGridContainer = activeAppendedGridContainer.next('.articles');
                                            }

                                        }
                                        
                                        //console.log('add card to',activeAppendedGridContainer);
                                        activeAppendedGridContainer.find('.grid-01').append(value);
                                        innerIndex++;
                                    }
                                });
                                
                                $('.contain-card .isotope-01').each(function(){
                                    $(this).isotope({
                                        itemSelector: '.item',
                                        layoutMode: 'packery',
                                        packery: {
                                            columnWidth: '.grid-sizer',
                                            gutter: 0
                                        }
                                    });
                                });

                                $('.articles-wrapper .isotope-01').each(function(){
                                    $(this).isotope({
                                        itemSelector: '.item',
                                        layoutMode: 'packery',
                                        packery: {
                                            columnWidth: '.grid-sizer',
                                            gutter: 0
                                        }
                                    });
                                });
                                var newSectionHeight = 0;
                                //recompute height
                                $('.articles-wrapper .articles').each(function(){
                                    newSectionHeight += $(this).outerHeight();
                                });
                                $('.articles-wrapper').css('height',newSectionHeight);
                            }
                            var id = $('#filters').data('id'),
                                f = $(this).data('filter');

                            $('#' + id + ' .select span').removeClass('active');
                            $('#' + id + ' .select span[data-filter="' + f + '"]').addClass('active');

                            owInitGrid('filter');
                            var t = window.setTimeout(function(){
                                //hotfix bug first card container empty
                                console.log($('.contain-card').find('article').size(),$('.contain-card').find('article').size() == 0);
                                if($('.contain-card').find('article').size() == 0){
                                    var firstFilledWrapper;
                                    $('.articles-wrapper .articles').each(function(){
                                        if($(this).find('article').size() == 3){
                                            firstFilledWrapper = $(this);
                                            return false;
                                        }
                                    })
                                    firstFilledWrapper.find('article').each(function(){
                                        $(this).removeAttr('style').detach().appendTo($('.contain-card .isotope-01'));

                                        //recompute heights
                                        $('.contain-card').css('height',650);
                                        var wrapperHeight = 0;
                                        $('.articles-wrapper .articles').each(function(){
                                            if($(this).find('article').size() == 0){
                                                $(this).css('height',0);
                                            }
                                            wrapperHeight += $(this).outerHeight();
                                            
                                        });
                                        $('.articles-wrapper').css('height',wrapperHeight);
                                        $('.isotope-01').each(function(){
                                            //$(this).isotope();
                                        });

                                    });
                                }
                                window.clearTimeout(t);
                            },200);
                            fnArraySortFilters();
                        });
                    }
                    fnArraySortFilters();

                    // close filters
                    $('body').on('click', '#filters', function () {
                        $('#filters').removeClass('show');
                        setTimeout(function () {
                            $('#filters').remove();
                        }, 700);
                    });
                });

            } else {


                $('.filters .select span').off('click').on('click', function () {

                    $('.filter .select').each(function () {
                        $that = $(this);
                        $id = $(this).closest('.filter').attr('id');

                        $that.find(".pages:not([data-filter='all'])").each(function () {
                            $this = $(this);

                            var getVal = $this.data('filter');
                            var numItems = $('.item[data-' + $id + '="' + getVal + '"]:not([style*="display: none"]').length;

                            if (numItems === 0) {
                                $this.addClass('disabled');
                            } else {
                                $this.removeClass('disabled');
                            }
                        });
                    });

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

                        $('.pages:not(.' + f + ')').css('display', 'none');
                        $('.pages.' + f).css('display', 'block');
                    });

                    // close filters
                    $('body').on('click', '#filters', function () {
                        $('#filters').removeClass('show');
                        setTimeout(function () {
                            $('#filters').remove();
                        }, 700);
                    });
                });
            }
        }
    }
};


var owRemoveElementListe = function () {
    $('.filters-02 li .icon-close').on('click', function () {
        var id = $(this).parent().data('id');

        $('input#' + id).val('');
        $('input#' + id).prop("checked", false);
        $('input#' + id).parent().removeClass('active');

        $(this).parent().remove();

        if (!$('.new-filter ul li').length) {
            $('.new-filter').parent().remove();
        }

        $.each($('.filters-02 li'), function(i,e){
            id = $(e).data('id');
            text = $(e).data('text');

            $('input#' + id).val(text);
            $('input#' + id).prop("checked", true);
            $('input#' + id).parent().addClass('active');
        })

        $('.button-submit-02').trigger('click');

        return false;
    });
}

var addNextFilters = function () {

    $('.filters-02 li.more').on('click', function (e) {
        e.preventDefault();

        $(this).remove();

        $('.filters-02.hidden').removeClass('hidden');

        $('.filters-02 li.more').off('click');
        $('.filters-02 li .icon-close').off('click');

        owRemoveElementListe();
        addNextFilters();
        owInitNavSticky(3);

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
    if (id == 'isotope-01') {
        var $grid = $('.isotope-01:not(.add-ajax-request):not(.noComputing)');
        $grid.imagesLoaded(function () {
            $grid.isotope({
                itemSelector: '.item',
                layoutMode: 'packery',
                packery: {
                    columnWidth: '.grid-sizer',
                    gutter: 0
                }
            });

            $grid.on( 'arrangeComplete', function( event, filteredItems ) {
                $('.item-inner').css({
                    'width':'100.5%',
                    'height':'100.5%'
                });

                $('.isotope-01 .item.video').on('click',function(){
                    $('.isotope-01 .item.video').removeClass('activeVideo');
                    $(this).addClass('activeVideo');
                });
            });


        });

        var $items = $('.item');

        //ratio calculation on media library
        if($('.media-library').length){
            //ratios token from eventbundle
            var landscapeRatio = 0.7921; //height / width
            var portraitRatio = 1.5842; //height / width
            $items.each(function(){
                var $this = $(this);
                var itemRatio = $this.outerHeight() / $this.outerWidth();

                if($this.outerWidth() > $this.outerHeight()){
                    //landscape
                    $this.addClass('landscape');
                    //compute height based on width & ratio
                    var newHeight = $this.outerWidth() * landscapeRatio;
                    if(itemRatio < landscapeRatio){
                        //less large than desired output, scale width
                        //$this.find('.image, .image-wrapper, img').css('width','100%');
                    }else{
                        //more large than desired output, scale height
                        //$this.find('img').css('height','100%');
                    }
                }else{
                    //portrait
                    $this.addClass('portrait');
                    //compute height based on width & ratio
                    var newHeight = $this.outerWidth() * portraitRatio;
                    if(itemRatio < portraitRatio){
                        //less large than desired output, scale width
                    }else{
                        //more large than desired output, scale width too (?)
                    }
                }
            });
        }
        var clickAllow = true;
        var $gridDom = $('.add-ajax-request');
        var $gridMore = $gridDom.imagesLoaded(function(){
            $gridMore.isotope({
                itemSelector: '.item',
                layoutMode: 'masonry',
                packery: {
                    columnWidth: '.grid-sizer'
                },
                getSortData: {
                    number: '[data-sort]'
                },
                // sort by color then number
                sortBy: ['number']
            });
            $gridMore.isotope();

            if($gridDom.parent().find('.ajax-request').length){
                if(!$gridDom.parent().find('.ajax-request').is(':visible')){
                    //hidden button, infinite load
                    var footerHeight = $('footer').outerHeight();
                    $(window).scroll(function(){
                        if(($(window).height() + $(document).scrollTop()) > ($(document).height() - footerHeight)){
                            if(clickAllow){
                                clickAllow = false;
                                $('.ajax-request').trigger('click');
                            }
                        }
                    });

                    var ticker = window.setInterval(function(){
                        clickAllow = true;
                    },2000);
                }
            }
        });

        var number = 0;

        if($('.home').length){
            //#home-news-statements-more
            /*var fnClickHome = function(){
                $('.read-more.ajax-request').on('click', function(e){
                    e.preventDefault();
                    var $this = $(this);
                    var url = $(this).attr('href');
                    var container = $(this).closest('.block-01');
                    var dateTime = $('.last-element').data('time');
                    var theme = $('.filter#theme .select span.active').data('filter');
                    var format = $('.filter#format .select span.active').data('filter');
                    //fake animation before the real computing
                    $('.articles-wrapper').css('height',$('.articles-wrapper').height()+600);

                    $.get( url, {date: dateTime, theme: theme, format: format}, function( data ) {
                        if(data == null){
                            return false;
                        }else{
                            $data = $(data);
                            //add new filters
                            if($(data).filter('.compute-filters').length){
                                $(data).filter('.compute-filters').find('span').each(function(){
                                    //test if filter exists
                                    if(!$('#theme .select span[data-filter="'+$(this).data('filter')+'"]').length){
                                        $('#theme .select .icon-arrow-down').before($(this));
                                    }
                                });
                                owInitFilter();
                            }

                            $('.articles-wrapper').append(data);
                            $('.articles-wrapper').find('.read-more').remove();
                            $('.articles-wrapper').find('.compute-filters').remove();
                            $('.articles-wrapper').find('img').imagesLoaded(function(){
                                $('.articles-wrapper').find('.to-init').isotope({
                                    itemSelector: '.item',
                                    layoutMode: 'packery',
                                    packery: {
                                        columnWidth: '.grid-sizer',
                                        gutter: 0
                                    }
                                }).removeClass('to-init');

                                $('.articles-wrapper .articles').css('opacity',1);

                                var h = 0;
                                $('.articles-wrapper .articles').each(function(){
                                    h += $(this).height();
                                });
                                $('.articles-wrapper').css('height',h);
                            });


                            //BUTTON BEHAVIOUR
                            var moreBtn = $data.find('.ajax-request').attr('href');
                            if(typeof moreBtn === 'undefined'){
                                moreBtn = $data.filter('.ajax-request').attr('href');
                            }

                            if(typeof moreBtn !== 'undefined'){
                                //ajax btn found, more content to come
                                $this.attr('href',moreBtn);
                                
                            }else{
                                //no more content but let's take read more link and wording
                                var allNewsButton = $data.filter('.read-more');
                                $('#home-news-statements-more').remove();
                                container.append(allNewsButton);
                            }
                        }
                    });
                });
            }
            fnClickHome();*/

        }else{

            $('.read-more.ajax-request').off('click').on('click', function(e){
                //e.preventDefault();
                var $this = $(this);
                var url = $(this).attr('href');

                var postData = {};
                if(typeof $('input[name="search"]').val() !== 'undefined'){
                    postData.search = $('input[name="search"]').val();
                }
                if(typeof $('input[name="photo"]').val() !== 'undefined'){
                    postData.photo = $('input[name="photo"]').val();
                }
                if(typeof $('input[name="video"]').val() !== 'undefined'){
                    postData.video = $('input[name="video"]').val();
                }
                if(typeof $('input[name="audio"]').val() !== 'undefined'){
                    postData.audio = $('input[name="audio"]').val();
                }
                if(typeof $('input[name="year-start"]').val() !== 'undefined'){
                    postData['year-start'] = $('input[name="year-start"]').val();
                }
                if(typeof $('input[name="year-end"]').val() !== 'undefined'){
                    postData['year-end'] = $('input[name="year-end"]').val();
                }
                if(typeof $('input[name="pg"]').val() !== 'undefined'){
                    postData.pg = parseInt($('input[name="pg"]').val())+1;
                }

                if($('#date.filter .select .active').length){
                    postData.date = $('#date.filter .select .active').data('filter');
                }
                if($('#theme.filter .select .active').length){
                    postData.theme = $('#theme.filter .select .active').data('filter');
                }
                if($('#format.filter .select .active').length){
                    postData.format = $('#format.filter .select .active').data('filter');
                }
                console.log('data sent to GET on ajax button click',postData);

                $.post({
                    type: 'GET',
                    url: url,
                    data: postData,
                    success: function(data) {
                        $data = $(data);
                        
                        var moreBtn = $data.find('.ajax-request').attr('href');
                        var articles = $data.find('article');
                        var scroll = $(document).scrollTop();
                        var rawHtml = '';
                        articles.each(function(){
                            rawHtml += $(this).get(0).outerHTML;
                        });
                        $gridMore.append(rawHtml);
                        $gridMore.isotope('destroy');
                        if(typeof moreBtn !== 'undefined'){
                            
                            $this.attr('href',moreBtn);
                        }else{
                            //visible buton = no infinite load & undefined button, let's remove it
                            $this.remove();
                        }

                        //manage filters
                        if($data.filter('.compute-filters').length){
                            $data.filter('.compute-filters').each(function(){
                                var slug = $(this).attr('class').replace('compute-filters ','');

                                console.log(slug);
                                $(this).find('span').each(function(){
                                    //test if filter exists
                                    if(!$('#'+slug+' .select span[data-filter="'+$(this).data('filter')+'"]').length){
                                        $('#'+slug+' .select .icon-arrow-down').before($(this));
                                    }
                                });
                            });
                        }

                        $('html,body').scrollTop(scroll);
                        $gridMore.imagesLoaded(function(){

                            //memorize scrolltop
                            $('html,body').scrollTop(scroll);
                            
                            $gridMore.isotope({
                                itemSelector: '.item',
                                layoutMode: 'masonry',
                                packery: {
                                    columnWidth: '.grid-sizer'
                                },
                                getSortData: {
                                    number: '[data-sort]'
                                },
                                // sort by color then number
                                sortBy: ['number']
                            });

                            $('html,body').scrollTop(scroll);

                            $('.card.item').each(function(){
                                var $this = $(this);
                                var title = $this.find('.info strong a');
                                var cat = $this.find('.info .category');
                                var titleText;
                                var catText;

                                $clamp(title.get(0), {clamp: 1});
                                $clamp(cat.get(0), {clamp: 1});
                            });

                            //reable available filters

                        });

                        $('input[name="pg"]').val(parseInt($('input[name="pg"]').val())+1);
                        
                        //if no button ajax-request, then remove current button
                        owinitSlideShow($gridMore);
                        initVideo();
                        initAudio();
                    }
                });

                return false;
            });
        }


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

        if(!$('#home').length > 0) {
            var trunTitle = function() {
                $.each($('.card.item'), function (i, e) {
                    var title = $(e).find('.info strong a');
                    var cat = $(e).find('.info .category');

                    $clamp(title.get(0), {clamp: 1});
                    $clamp(cat.get(0), {clamp: 1});
                });
            }
    
    
            trunTitle();
    
    
            $(window).resize(function () {
                trunTitle();
            });
    
            var title = $('.info strong a').text();
        }


        if($('.item.block-poster').length) {

            function selectionGridComputing(){
                var stop = false;
                var lineClassIndex = 0;
                var lineContentHeights = [];
                var previousItem;

                //get max heights
                $.each($('.item.block-poster'), function (i,e) {
                    var naturalIndex = i+1;
                    var ww = window.innerWidth;
                    var colNumber = 4;
                    if(ww > 1280){
                        colNumber = 5;
                    }

                    if(ww > 1600){
                        colNumber = 6;
                    }

                    if(ww >= 1920){
                        colNumber = 8;
                    }

                    if(i%colNumber == 0){
                        lineClassIndex += 1;
                    }

                    if(typeof lineContentHeights[lineClassIndex] !== 'undefined'){
                        if($(this).find('.contain-txts').removeAttr('style').outerHeight() > lineContentHeights[lineClassIndex]){
                            lineContentHeights[lineClassIndex] = $(this).find('.contain-txts').outerHeight();
                        }
                    }else{
                        lineContentHeights[lineClassIndex] = $(this).find('.contain-txts').outerHeight();
                    }

                    //ratio class
                    var img = $(this).find('img');
                    var imgClass = 'portrait';
                    if(img.width() > img.height()){
                        var imgClass = 'landscape';
                    }
                    img.addClass(imgClass);
                    $(this).attr('rel',lineClassIndex);
                    previousItem = $(this);
                });
                
                //apply heights
                $.each($('.item.block-poster'), function (i,e) {
                    var height = lineContentHeights[$(this).attr('rel')];
                    $(this).find('.contain-txts').css('height',height);
                });
            }

            selectionGridComputing();
            $(window).on('resize',function(){
                selectionGridComputing();
            });
        }

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


        if($('.who-filter').length) {
            var active = $('.filter .select span.active').data('filter');

            $('.pages:not(.'+active+')').css('display','none');
            $('.pages.'+active).css('display','block');

        }

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



        var trunTitle = function() {
            $.each($('.card.item'), function (i, e) {
                var title = $(e).find('.info strong a');
                var cat = $(e).find('.info .category');

                $clamp(title.get(0), {clamp: 1});
                $clamp(cat.get(0), {clamp: 1});
            });
        }


        trunTitle();


        $(window).resize(function () {
            trunTitle();
        });

        var title = $('.info strong a').text();

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
    console.log('owsetGridBigImg')
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
                if (j == 1 || j == 5) {
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
                if (j == 1 || j == 6) {
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
                if (j == 1 || j == 3 || j == 12 || j == 17 || j == 25) {
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
                if (j == 1 || j == 5 || j == 14) {
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

// Google map

//page participate

var initMap = function() {
    var myLatLng = new google.maps.LatLng(43.550404, 7.017419);
    var mapOptions = {
        center: myLatLng,
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.PLAN,
        scrollwheel: false,
        draggable: false,
        panControl: false,
        zoomControl: true,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: true,
        overviewMapControl: true,
        rotateControl: true
    }
    var map = new google.maps.Map(document.getElementById("google-map"), mapOptions);

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: GLOBALS.texts.googleMap.title
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

  // anchors menu
  $('#nav-movie ul a').on('click', function (e) {

    $('#nav-movie ul a').removeClass('active');
    $(this).addClass('active');

    var $el = $(this)
      , id = $el.attr('href').substr(1);

    var posT = $('*[data-section="' + id + '"]').offset().top - $('#nav-movie').height() - $('header').height();

    if(!$('#nav-movie').hasClass('sticky')) {
      posT -= 32;
    }

    console.log(posT);

    $('html, body').animate({
      scrollTop: posT
    }, 500);

    e.preventDefault();
  });

  /* thomon - tetiere height computing */
  if($('.tetiere-movie').length) {
    var tetiere = $('.tetiere-movie'),
    defaultHeight = 290, //magic number, booooh
    currentHeight = tetiere.outerHeight();
    
    if(tetiere.find('h2').outerHeight() > 35 ){ //2 lines & more
      tetiere.css({
        'height': defaultHeight,
        'position':'relative',
        'top':  (currentHeight > defaultHeight) ? 0 : - (parseInt(defaultHeight) - parseInt(currentHeight))
      });
    }else{
      tetiere.css('height',defaultHeight);
    }
  }
  /* end tetiere height computing */

  if($('.single-movie').length) {

        

    /*var cl = new CanvasLoader('canvasloader');
        cl.setColor('#ceb06e');
        cl.setDiameter(20);
        cl.setDensity(34);
        cl.setRange(0.8);
        cl.setSpeed(1);
        cl.setFPS(60);*/

    function setActiveMovieVideos() {
      $('#slider-movie-videos .owl-item').removeClass('center');
      $('#slider-movie-videos .owl-item.active').first().addClass('center');
    }

    function initSliders() {
      // slider competitions
      var sliderCompetition = new Sly( $(".competition"), {
          speed: 200,
          slidee: $('#slider-competition'),
          horizontal: 1,
          mouseDragging: 1,
          releaseSwing: 1
      } );
      
      sliderCompetition.init();
    }

    initSliders();

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

    if($('#video-movie-trailer').length > 0) {
      videoMovie = playerInit('video-movie-trailer');
      videoMovie.resize('100%','100%');
      // show and play trailer
      $('.poster .picto').on('click', function(e) {
        $('html, body').animate({
          scrollTop: 0
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
        e.preventDefault();
      });
    }

    //movie slider
    if($("#slider-movie-videos").length){
      var sliderMovieVideos = $("#slider-movie-videos").owlCarousel({
        nav: false,
        dots: false,
        smartSpeed: 500,
        loop: false,
        margin: 50,
        autoWidth: true,
        dragEndSpeed: 600,
        responsive:{
          0:{
            items: 3
          },
          1675: {
            items: 4
          }
        },
        onInitialized: function() {
          var m = ($(window).width() - $('.container').width()) / 2;
          $('#slider-movie-videos .owl-stage').css({ 'margin-left': m });
          //setActiveMovieVideos();
        },
        onResized: function() {
          var m = ($(window).width() - $('.container').width()) / 2;
          $('#slider-movie-videos .owl-stage').css({ 'margin-left': m });
        },
        onTranslated: function() {
          //setActiveMovieVideos();
        }
      });

      $('#slider-movie-videos .slide-video').on('click', function(e) {
        
        

        var number = $(this).closest('.owl-item').index();
        videoMovieBa.playlistItem(number);
        sliderMovieVideos.trigger('to.owl.carousel', [number, 400, true]);
      });
    }

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
    
    if(closePopin == 0) {
      $popin.addClass('animated fadeIn').addClass('visible');
      visiblePopinB();
      fClosePopinB();

    }else {
      Cookies.set('popin-banner','1', { expires: 365 });
    }

  }

};

/*  COOKIE BANNER
 ----------------------------------------------------------------------------- */
var owCookieBanner = function() {
  if(typeof Cookies.get('cooki_banner') === "undefined"){
    $('#cookies-banner').show();

    $('.cookie-accept').click(function () { //on click event
      days = 365; //number of days to keep the cookie
      myDate = new Date();
      myDate.setTime(myDate.getTime()+(days*24*60*60*1000));
      document.cookie = "cooki_banner = comply_yes; expires = " + myDate.toGMTString(); //creates the cookie: name|value|expiry
      $("#cookies-banner").slideUp("slow"); //jquery to slide it up
      $(".btnClose").hide();
    });
  } else {
    $('#cookies-banner').hide();
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
                if($('.slider-home').length){
                    $('.slider-home').addClass('stickystate');
                }
                $('body').css('margin-top', '91px');
            }
        } else {
            if (($('#prehome-container').length == 0 && s < 30)) {
                $header.removeClass('sticky');
                if($('.slider-home').length){
                    $('.slider-home').removeClass('stickystate');
                }
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

   if (!$('body').hasClass('mobile') && $('.retrospective').length) {
        $('.block-push').css('background-position', '0px -10px');
        $(window).on('scroll', function () {
            if ($('header.sticky').length) {
                var s = $(this).scrollTop() - 240;
                $('.block-push.big').css('background-position', '0px ' + s + 'px');
            } else {
                $('.block-push.big').css('background-position', '0px ' + '-240px');
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
    
    // SINGLE MOVIE
    $(window).on('scroll', function () {
        var s = $(this).scrollTop();
        scrollTarget = s;
        

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

            if(! $('div.press').length > 0) {
                $('.nav, .prevmovie, .nextmovie').addClass('black');
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

var owInitScrollFaq = function() {

    var lastScrollTop = 0,
        $header = $('header'),
        $timeline = $('#timeline'),
        $navMovie = $('#nav-movie'),
        $faqmenu = $(".faq-menu");

    // SINGLE MOVIE
    $(window).on('scroll', function () {
        var s = $(this).scrollTop();
        scrollTarget = s;

        if ($('.faq-container.faq-active').height() > 500) {
            if (s > $('.faq-container.faq-active').offset().top - 120 && s < ($('.faq-container.faq-active').height() - $('.faq-container.faq-active').offset().top - 70)) {
                $faqmenu.removeClass('bottom').addClass('stick');
            } else {
                if (s >= ($('.faq-container.faq-active').height() - $('.faq-container.faq-active').offset().top - 70)) {
                    $faqmenu.addClass('bottom');
                } else {
                    $faqmenu.removeClass('stick');
                }
            }
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

      ys = $('.s-yearstart').val();
      ye = $('.s-yearend').val();

      ys = parseInt(ys);
      ye = parseInt(ye);
    
    noUiSlider.create(slider, {
    	start: [ys, ye],//todo script
    	connect: true,
    	range: {
            'min': 1946,
            'max': GLOBALS.year
    	}
     });

    slider.noUiSlider.on('update', function( values, handle ) {

    	snapValues[handle].innerHTML = parseInt(values[handle]);

        var lower = parseInt(values[0]);
        var up = parseInt(values[1]);

        $('.s-yearstart').val(lower);
        $('.s-yearend').val(up);
        
    });
  }

  if(id == 'tab-selection') {
    var $tab = $('.icon-s');

    $tab.on('click', function(){
      var input = $(this).find('input');
      var classTab = $tab[0].className;

      //faire deux class différente
      //verifier la class et en fonction mettre en opacity 0 !

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


var autoComplete = function() {

  $('.close-suggest').css("display","none");

  $('.country').on('input', function(){

    $('.close-suggest').css("display","block");

    var value = $(this).val();
    var $suggest = $(this).next().next().find('.suggest');
    var noWhitespaceValue = value.replace(/\s+/g, '');
    var noWhitespaceCount = noWhitespaceValue.length;

    if (GLOBALS.env == "html") {
      searchUrl = GLOBALS.urls.searchUrlCountry;
    } else {
      searchUrl = GLOBALS.urls.searchUrlCountry+'/'+encodeURIComponent(value);
    }

    $.ajax({
      type: "GET",
      url: searchUrl,
      success: function (data) {
        $suggest.empty();

        if (data.length > 0) {


          for (var i = 0; i < data.length; i++) {
            var name = data[i].name;
            var txt = name.toLowerCase();


            txt = txt.replace(value.toLowerCase(), '<strong>' + value.toLowerCase() + '</strong>');

            var valueTrunc = value.substring(0, 3)
            var chaine = txt.indexOf(valueTrunc);

            if(chaine > -1) {
              $suggest.append('<li data-country='+name+'><span>' + txt + '</span></li>');

              $('.sub-tab').css('opacity', '0.2');
              $suggest.addClass('open');
            }

          }

          $('.suggest li').off('click').on('click', function(){

            var data = $(this).data('country');
            $(this).parent().parent().parent().find('.country').val(data.toLowerCase());

            $('.sub-tab').css('opacity', '1');
            $('.suggest').empty();
            $('.suggest').removeClass('open');

            $('.close-suggest').css("display","none");

          });

        } else {
          $suggest.append('<li>' + GLOBALS.texts.search.noresult + '</li>')
        }
      },
      error: function () {
        $suggest.empty();
        $suggest.append('<li>' + GLOBALS.texts.search.noresult + '</li>')
      }
    });


  });

  $('.close-suggest').css("display","none");

  $('.searchBar').on('input', function(){

    $('.close-suggest').css("display","block");

    var value = $(this).val();
    var $suggest = $(this).next().next().find('.suggest');
    var noWhitespaceValue = value.replace(/\s+/g, '');
    var noWhitespaceCount = noWhitespaceValue.length;

    if (GLOBALS.env == "html") {
      searchUrl = GLOBALS.urls.searchUrl;
    } else {
      searchUrl = GLOBALS.urls.searchUrl+'/'+encodeURIComponent(value);
    }

    $.ajax({
      type: "GET",
      url: searchUrl,
      success: function (data) {
        $suggest.empty();

        if (data.length > 0) {


          for (var i = 0; i < data.length; i++) {
            var name = data[i].name;
            var txt = name.toLowerCase();


            txt = txt.replace(value.toLowerCase(), '<strong>' + value.toLowerCase() + '</strong>');

            var valueTrunc = value.substring(0, 3)
            var chaine = txt.indexOf(valueTrunc);

            if(chaine > -1) {
              $suggest.append('<li data-country="'+name+'"><span>' + txt + '</span></li>');

              $('.sub-tab').css('opacity', '0.2');
              $suggest.addClass('open');
            }

          }

          $('.suggest li').off('click').on('click', function(){

            var data = $(this).data('country');
            $(this).parent().parent().parent().find('.searchBar').val(data.toLowerCase());

            $('.sub-tab').css('opacity', '1');
            $('.suggest').empty();
            $('.suggest').removeClass('open');

            $('.close-suggest').css("display","none");

          });

        } else {
          $suggest.append('<li>' + GLOBALS.texts.search.noresult + '</li>')
        }
      },
      error: function () {
        $suggest.empty();
        $suggest.append('<li>' + GLOBALS.texts.search.noresult + '</li>')
      }
    });


  });


  $('.close-suggest').on('click', function(e){

     $('.sub-tab').css('opacity', '1');
     $('.suggest').empty();
     $('.suggest').removeClass('open');

    $('.close-suggest').css("display","none");

  });
}

var owFixImg = function(){

  if($('body').hasClass('ie')){
    $.each($('.contain-img.landscape'), function(i,e){
      var imgSrc = $(e).find('img').attr('src');

      $(e).css('background-image','url('+imgSrc+')');
    })
  }
}

var initFilterCheck = function(form) {


  var $form = form.length ? form : $('.block-searh-more form');
  var $label = $form.find('.icon-s');
  
  $label.removeClass('active');

  $.each($label, function(i,e){

    if($(e).find("input[type=checkbox]").is(':checked')){

      var element = $(e).find("input[type=checkbox]");
      element.parent().addClass('active');

    }

  });
}


var truncTitleSearch = function() {


  $.each($('.medias .item'), function (i, e) {
    var title = $(e).find('.title-media');
    var titleCat = $(e).find('.title-type-media');

    if (!title.hasClass('init')) {
      var text = $(e).find('.title-media').text();
      title.addClass('init');
      title.attr('data-title', text);
    } else {
      var text = title.attr('data-title');
    }

    if (!titleCat.hasClass('init')) {
      var text2 = $(e).find('.title-type-media').text();
      titleCat.addClass('init');
      titleCat.attr('data-title', text2);
    } else {
      var text2 = titleCat.attr('data-title');
    }

    title.html(text.trunc(40, true));
    titleCat.html(text2.trunc(25, true));
  });

  $(window).resize(function () {
    truncTitleSearch();
  });

  var title = $('.info strong a').text();
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
    
    $('.print').on('click', function(e){
        e.preventDefault();
    })

    //POPIN facebook SHARE
    $('.block-social-network .facebook, .rs-slideshow .facebook, .button.facebook').off('click').on('click', function (e) {
        e.preventDefault();
        window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');
        return false;
    });


    $('.block-social-network .twitter, .rs-slideshow .twitter').off('click').on('click', function (e) {
        window.open(this.href, '', 'width=600,height=400');
        return false;
    });

    function initPopinMail(cls) {
        // check that fields are not empty
        $(cls).find('#form').css('display','block');
        $(cls).find('.info-popin').css('display','block');
        $(cls).find('#msg').html('');


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

        $('body').off('click').on('click', '.selectOptions span', function () {
            var i = parseInt($(this).index()) + 1;
            $('select option').eq(i).prop('selected', 'selected');
            $('.select').removeClass('invalid');
        });

        // check valid email address
        $(cls + ' input[type="email"]').off('input').on('input', function () {
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
        $('#contact_email').off('input').on('input', function () {
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
        $(cls + ' form').off('submit').on('submit', function (e) {
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
                    data: $(cls).find('form#form').serializeArray(),
                    success: function (data) {
                        if (data.success == false) {

                        }
                        else {
                            // TODO envoie du mail //
                            $(cls).find('#form').css('display','none');
                            $(cls).find('.info-popin').css('display','none');
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
    var linkPopinInit = function(link, cls) {
        var link = link || document.location.href;
        var cls = cls || '.link.self';


        clipboard = new Clipboard(cls);
        
        $(cls).attr('data-clipboard-text', link);

        $(cls).off('click touchstart').on('click touchstart', function (e) {

            e.preventDefault();

            $('#share-box').remove();

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

               setTimeout(function () {
                   $('#share-box').remove();
                   $('#share-box').remove();
                   //two time because first don't work...

                   linkPopinInit = 0;
               }, 1000);

            }, 3000);

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

function isMacintosh() {
    return navigator.platform.indexOf('Mac') > -1
}

function isWindows() {
    return navigator.platform.indexOf('Win') > -1
}

var isMac = isMacintosh();
var isPC = !isMacintosh();

var owInitSlider = function (sliderName) {
    /* SLIDER HOME
     ----------------------------------------------------------------------------- */
    if (sliderName == 'home') {
        var isFirefox = window.mozInnerScreenX ? true : false;
        var slide = $('.slider-carousel').owlCarousel({
            navigation: true,
            items: 1,
            autoWidth: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            loop: true,
            smartSpeed: 700,
            onInitialized: function(){
                var slides = $('.slider-home .owl-item');
                slides.each(function(){
                    var container = $(this).find('.text-trunc');
                    var desc = container.text();
                    desc = desc.replace(/(<p[^>]+?>|<p>|<\/p>)/img, "");
                    container.empty().html(desc);
                    $clamp(container.get(0), {clamp: 3});
                });

                if(isFirefox){
                    $('.container-images').addClass('ff');
                }
            }
        });

        slide.on('changed.owl.carousel', function (event) {
            setTimeout(function () {
                var $item = $('.owl-item.active').find('.item');
                var number = $item.data('item');
                var $active = $(".container-images .item.active");
                var $next = $(".container-images .item[data-item=" + number + "]");
                //$('.container-images .item').removeClass('fade-out');
                $active.removeClass("fade-in-right");
                $active.animate({
                    'opacity': 0
                },300);
                $next.animate({
                    'opacity': 0
                },300);
                setTimeout(function () {
                    $next.addClass('active fade-in-right');
                    $next.animate({
                        'opacity': 1
                    },300);
                    $active.removeClass('active');
                }, 800);
            }, 200);
        });

        $('.slider-home').on('click', function(e){
            if($(e.target).hasClass('owl-dots') || $(e.target).closest('.owl-dots').length){
                return false;
            }else{
                var href = $('.owl-item.active .coverLink').attr('href');
                window.location.href = href;
            }

        })


    }


    /* SLIDER 01
     ----------------------------------------------------------------------------- */
    if (sliderName == 'slider-01') {
        var sliderBlock = $('.slider-01');
        sliderBlock.find('img').imagesLoaded(function(){
            var slide01 = sliderBlock.owlCarousel({
                navigation: false,
                items: 1,
                autoWidth: true,
                smartSpeed: 700,
                center: $('.home').length ? false : true
            });

            if($('.home').length){
                //get offset to compensate;
                var itv = window.setInterval(function(){
                    if($('.block-diaporama .owl-stage').length && $('.block-diaporama .owl-stage').attr('style').length){
                        $('.block-diaporama .owl-item:first-child').addClass('center');
                    }
                },200);
            }

            slide01.on('initialize.owl.carousel', function(event) {

                console.log('init');
            })

            $(document).on('mousedown', '.slider-01 .owl-item', function () {
                $(this).siblings('.owl-item').removeClass('center');
                $(this).addClass('center');
            });
            
            // Custom Navigation Events
            $(document).on('click', '.slider-01 .owl-item', function () {
                var number = $(this).index();
                slide01.trigger('to.owl.carousel', number);
            });
        });
        
    }

    /* SLIDER 02
     ----------------------------------------------------------------------------- */
    if (sliderName == 'slider-02') {
        var slide01 = $('.slider-02').owlCarousel({
            navigation: false,
            items: 3,
            itemsDesktop:[1199,1],
            autoWidth: true,
            smartSpeed: 700,
            center: true,
            margin: 27.5
        });

        // Custom Navigation Events
        $('.slider-02 .slide-video').on('click', function () {
            var number = $(this).index();
            playerInstance.playlistItem(number);
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

        $('.discover').on('click', function (e) {
            $('body').addClass('fs-off');
        });
        var initOpenAjax = function () { //ajax
            $('.discover').on('click', function (e) {

                e.preventDefault();
                var url = $(this).data('url');
                
                $('.slider-restropective').addClass('isOpen block-push block-push-top background-effet');
                $('.timelapse').css('display', 'none');
                $('.discover').css('display', 'none');
                $('.slides-calc2').css('display', 'none');
                $('.title-big-date').addClass('title-2').removeClass('title-big-date');
                $('.title-edition').addClass('title-4').removeClass('title-edition');

                var imgurl = $('.block-push-top.big .container img').attr('src');
                $('.block-push-top.big .container img').css('display', 'none');

                $('.block-push').css('background-position', '0px -240px');
                $('.block-push-top.big').css('background-image', 'url(' + imgurl + ')');

                $.get(url, function (data) {
                    var data = $(data).find('.contain-ajax');
                    $('.ajax-section').html(data);
                    owInitNavSticky(1);
                    window.history.pushState('', '', url);

                    setTimeout(function () {
                        if ($('.isotope-01').length) {
                            owInitGrid('isotope-01');
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

            var nm = isMac ? 4 : 21;
            //drag
            var w = $(window).width() + nm;
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

            var nm = isMac ? 4 : 21;
            var w = $('body').width() + nm;
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

            var nm = isMac ? 4 : 21;
            var w = $('body').width() + nm;
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

            var nm = isMac ? 4 : 21;
            var w = $('body').width() + nm;
            values = $('.slides-calc1 .date').html();
            number = values - 1945;
            var val = -w * (values - 1945); //todo script ?
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

            setTimeout(function(){
                var nm = isMac ? 4 : 21;
                var w = $('body').width() + nm;
                values = $('.slides-calc1 .date').data('date');

                slider.noUiSlider.set([values]);

                number = values - 1945;
                var val = -w * (values - 1945); //todo script

                $slide.css('transform', 'translate(' + val + 'px)');

                animationOpen();

            }, 1000);

        }
    }
};


var rtime;
var timeoutVar = false;
var delta = 300;
$(window).resize(function() {
    $('.slides').removeClass('fadeIn').addClass('animated fadeOut');

    rtime = new Date();
    if (timeoutVar === false) {
        timeoutVar = true;
        setTimeout(resizeend, delta);
    }
});

function resizeend() {


    if (new Date() - rtime < delta) {
        setTimeout(resizeend, delta);
        var $slideCalc1 = $('.slides');


    } else {
        timeoutVar = false; 
        if ($('.retrospective').length) {
            
            $('.slides').removeClass('fadeOut').addClass('fadeIn');
            var $slide = $('.slides');
            var $slideCalc1 = $('.slides-calc1');

            var nm = isMac ? 4 : 21;
            var w = $('body').width() + nm;
            var numberSlide = $('.slider-restropective').size() + 1;
            var sizeSlide = $('.slider-restropective').width();
            var finalSizeSlider = numberSlide * sizeSlide;

            $slide.css('transition','0s');
            $slide.css('width', finalSizeSlider); // change size slider
            //$slideCalc1.css('width',finalSizeSlider); // change size slider*/

            values = $('.slides-calc1 .date').html();
            number = values - 1945;
            var val = -w * (values - 1945); //todo script ?


            $slide.css('transform', 'translate(' + val + 'px)');

        }
    }
}
/**
 * Created by tatjac on 17/06/2016.
 */
var owinitSlideShow = function (slider, hash) {

    if (typeof hash != "undefined") {
        setTimeout(function () {
            openSlideShow(slider, hash);
        }, 100);
    }else{

        if($('.affiche-fdc').length) {

            $('.poster').off('click').on('click', function(e){
                slider = $('.all-contain');
                $(this).parent().addClass('active center');
                var hash = typeof $(this).data('url') !== 'undefined' ? $(this).data('url') : '';
                openSlideShow(slider,hash, true);
            })

        } else if($('.article-single').length){

            $('.slideshow-img .images').on('click', function (e) {
                if(!$(e.target).is('.thumbnails') || !$(e.target).closest('.thumbnails').length){
                    e.preventDefault();

                    slider = $(this);

                    openSlideShow(slider);
                }
                return false;
            });

        }else{
            $('.block-diaporama .item').on('click', function () {

                if ($(this).parent().hasClass('center') && !$('.owl-stage').hasClass('owl-grab')) {
                    openSlideShow(slider);
                }
            });


            if($('.slideshow-img').length > 0 ) {
                $('.images').on('click', function (e) {
                    
                    if(!$(e.target).is('.thumbnails') || !$(e.target).closest('.thumbnails').length){
                        e.preventDefault();
                        openSlideShow(slider);
                    }
                    return false;
                });
            }

            if($('.medias').length > 0 || $('.media-library').length > 0) {
                $('.item.photo').off('click').on('click', function (e) {
                    e.preventDefault();
                    slider = $('.isotope-01');
                    $(this).addClass('photoActive');
                    openSlideShow(slider);


                    return false;
                });
            }
        }

    }
}


var openSlideShow = function (slider, hash, affiche) {
    $('html').addClass('slideshow-open');

    
    if($('.medias').length > 0 || $('.media-library').length > 0) {
        slider = $('.isotope-01');
    }

    var images = [];
    var w = $(window).width();
    var centerElement = 0;
    var caption = "";
    slider.find('.item, .img, .poster').each(function (index, value) {
        if(!$(value).hasClass('video') && !$(value).hasClass('audio')){


            if ($(value).parent().hasClass('active center')) {
                centerElement = index;

                if($('.affiche-fdc').length ) {
                    var hashPush = hash;


                    var CheminComplet = document.location.href;

                    hashPush = CheminComplet + "#" +hashPush;
                    
                    history.pushState(null, null, hashPush);
                }
            }

            if ($('.img').length > 0 && $(value).hasClass('active')) {
                centerElement = index;
            }

            if($('.affiche-fdc').length ) {

                var src = $(value).find('img').attr('src');
                var alt = $(value).find('img').attr('alt');
                var title = $(value).parent().find('.infos  .name-f').html();
                var label = $(value).parent().find('.infos .names-a').html();
                var date =  $(value).parent().data('date');
                var caption = $(value).parent().data('credit');
                var id = $(value).parent().data('pid');
                var facebookurl = $(value).parent().data('facebook');
                var twitterurl = $(value).parent().data('twitter');
                var url = $(value).parent().data('url');
                var isPortrait = $(value).hasClass('portrait') ? 'portrait' : 'landscape';

            } else if($('.photo-module').length ) {

                var src = $(value).find('img').attr('src');
                var alt = $(value).find('img').attr('alt');
                var title = $(value).find('a').attr('title');
                var label = $(value).find('a').data('label');
                var date = $(value).find('a').data('date');
                var caption = $(value).find('a').data('credit');
                var id = $(value).find('a').data('pid');
                var facebookurl = $(value).find('a').data('facebook');
                var twitterurl = $(value).find('a').data('twitter');
                var url = $(value).find('a').data('link');
                var isPortrait = $(value).hasClass('portrait') ? 'portrait' : 'landscape';

            }else{
                var getTitle = ($(value).hasClass('photo')) ? $(value).find('.info .contain-txt strong a').data('title') : $(value).find('img').attr("data-title");
                
                if(typeof getTitle === 'undefined'){
                    getTitle = $(value).find('img').attr("data-title");
                }

                if($('.medias').length > 0 || $('.media-library').length > 0) {
                    getTitle = $(value).find('.info .contain-txt').html();
                }

                var src = ($(value).hasClass('photo')) ? $(value).find('.image-wrapper img').attr("src") : $(value).find('img').attr("src");
                var alt = ($(value).hasClass('photo')) ? $(value).find('.image-wrapper img').attr("alt") : $(value).find('img').attr("alt");
                var title = getTitle;
                var label = ($(value).hasClass('photo')) ? $(value).find('.info .contain-txt a').html() : $(value).find('img').attr("data-label");
                var date = ($(value).hasClass('photo')) ? $(value).find('.info .contain-txt span.date').html() + ' . ' + $(value).find('.info .contain-txt span.hour').html() : $(value).find('img').attr("data-date");
                var caption = $(value).find('img').attr('data-credit');
                var id = $(value).find('img').attr('data-id');
                var facebookurl = $(value).find('img').attr('data-facebookurl');
                var twitterurl = $(value).find('img').attr('data-twitterurl');
                var url = $(value).find('img').attr('data-url');
                var isPortrait = $(value).hasClass('portrait') ? 'portrait' : 'landscape';
            }
            if(hash == id && centerElement == 0){
                centerElement = $(this).index('.photo');

                if(centerElement < 0){
                    centerElement = $(this).index();
                }
            }

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
                twitterurl: twitterurl,
                isPortrait: isPortrait
            };
            images.push(image);
        }
    });
    if($('.photoActive').length > 0) {
        var pid = $('.photoActive .image-wrapper img').data('id');
        for(var o = 0; o < images.length; o++){
            if(pid == images[o].id){
                var v = o;
                centerElement = v;
            }
        }
    }
    if(typeof hash == "undefined") {
        hash = images[centerElement].id;
        var hashPush = '#'+hash;
        history.pushState(null, null, hashPush);
    }

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

        thumbnailsSlide.trigger('to.owl.carousel', [centerElement, 400, true]);

        $(thumbs).removeClass('active');
        $(thumbs[centerElement]).addClass('active');

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

        $('.fullscreen-slider img').removeClass('isZoom');
        $('.fullscreen-slider img').css('transform', 'scale(1)');
        $('.zoomCursor .icon').addClass('icon-wen-more').removeClass('icon-wen-minus');

        if($('.popin-mail').length) {
            $('.popin-mail').find('.contain-popin .theme-article').text(images[centerElement].label);
            $('.popin-mail').find('.contain-popin .date-article').text(images[centerElement].date);
            $('.popin-mail').find('.contain-popin .title-article').text(images[centerElement].title);console.log('t3');
            $('.popin-mail').find('form #contact_section').val(images[centerElement].label);
            $('.popin-mail').find('form #contact_detail').val(images[centerElement].date);
            $('.popin-mail').find('form #contact_title').val(images[centerElement].title);
            $('.popin-mail').find('form #contact_url').val(images[centerElement].link);
            $('.popin-mail').find('.chap-article').html('');
        }
    }

    var goToSLide = function(id) {
        w = $(window).width();
        console.log('goToSLide')
        centerElement = parseInt(id);
        translate = -(w + 0) * centerElement;
        fullscreen.addClass('animated fadeOut');

        setTimeout(function () {
            fullscreen.css('transform', 'translateX(' + translate + 'px)');
            fullscreen.removeClass('fadeOut').addClass('animated fadeIn');
        }, 700);

        hash = "#"+images[id].id;

        history.pushState(null, null, hash);

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

        if($('.popin-mail').length) {
            $('.popin-mail').find('.contain-popin .theme-article').text(images[centerElement].label);
            $('.popin-mail').find('.contain-popin .date-article').text(images[centerElement].date);
            $('.popin-mail').find('.contain-popin .title-article').text(images[centerElement].title);console.log('t5');
            $('.popin-mail').find('form #contact_section').val(images[centerElement].label);
            $('.popin-mail').find('form #contact_detail').val(images[centerElement].date);
            $('.popin-mail').find('form #contact_title').val(images[centerElement].title);
            $('.popin-mail').find('form #contact_url').val(images[centerElement].link);
            $('.popin-mail').find('.chap-article').html('');
        }

    }

    /* Initiliasion du slideshow fullscreen*/
    $('body').prepend('<div class="c-fullscreen-slider animated fadeIn"><div class="fullscreen-slider"> </div></div>');
    var fullscreen = $('body').find(".fullscreen-slider");s

    var wSlide = w * images.length + 100;
    var wSlide = wSlide + "px";

    fullscreen.css('width', wSlide);

    $( window ).resize(function() {
        var w = $(window).width();
        var wSlide = w * images.length + 100;
        var wSlide = wSlide + "px";

        fullscreen.css('width', wSlide);
    });


    setTimeout(function(){
        if (typeof hash != "undefined") {

            for (var i = 0; i < images.length; i++) {

                if (images[i].id == hash) {
                    centerElement = i;
                    fullscreen.append("<div class='"+images[i].isPortrait+" dezoom'><img src='" + images[i].src + "' alt='" + images[i].data + "' class='center-item' /></div>");
                } else {
                    fullscreen.append("<div class='"+images[i].isPortrait+"'><img src='" + images[i].src + "' alt='" + images[i].data + "'/></div>");
                }
            }

        } else {
            for (var i = 0; i < images.length; i++) {

                if (i == centerElement) {
                    fullscreen.append("<div class='"+images[i].isPortrait+"'><img src='" + images[i].src + "' alt='" + images[i].data + "' class='center-item'  /></div>");
                } else {
                    fullscreen.append("<div class='"+images[i].isPortrait+"'><img src='" + images[i].src + "' alt='" + images[i].data + "' /></div>");
                }
            }
        }
    }, 1000);

    var translate = (w + 0) * centerElement;
    translate = -translate + "px";


    numberDiapo = centerElement + 1;

    fullscreen.css('transform', 'translateX(' + translate + ')');

    $('.c-fullscreen-slider').addClass('chocolat-wrapper');

    $('.c-fullscreen-slider').append('<div class="chocolat-top"><i class="icon icon-close chocolat-close"></i></div>');

    function isHTML(str) {
        var a = document.createElement('div');
        a.innerHTML = str;
        for (var c = a.childNodes, i = c.length; i--; ) {
            if (c[i].nodeType == 1) return true; 
        }
        return false;
    }

    var onelineclass = ' oneline';
    if(typeof images !== 'undefined'){
        if(typeof images[centerElement] !== 'undefined'){
            if(typeof images[centerElement].caption !== 'undefined'){
                if(images[centerElement].caption.toLowerCase().indexOf('dit image :') == -1){
                    images[centerElement].caption = 'Crédit Image : '+images[centerElement].caption;
                }
            }

            if(typeof images[centerElement].title !== 'undefined'){
                 var tempTitle = images[centerElement].title;
                 if(isHTML(tempTitle)){
                    if($(tempTitle).filter('*').size() > 0){
                        onelineclass = ''
                    }
                }
                console.log('check hmtl ok');
            }
        }
    }

    $('.c-fullscreen-slider').append('<div class="c-chocolat-bottom">' +
        '<div class="chocolat-bottom">' +
        '<span class="chocolat-fullscreen"></span>' +
        '<span class="chocolat-description'+onelineclass+'"><h2 class="title-slide">' + images[centerElement].title + '</h2></span>' +
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

    $('.c-fullscreen-slider').append("<div class='zoomCursor'><i class='icon icon-wen-more'></i></div>")

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

    if(images.length < 6){
        var carouselOpts = {
            nav: false,
            dots: false,
            smartSpeed: 500,
            mouseDrag: false,
            margin: 0,
            autoWidth: true,
            URLhashListener: false
        }
    }else{
        var carouselOpts = {
            nav: false,
            dots: false,
            smartSpeed: 500,
            margin: 0,
            autoWidth: true,
            URLhashListener: false
        }
    }

    thumbnailsSlide = $('.chocolat-wrapper .thumbnails').owlCarousel(carouselOpts);

    thumbs = thumbnails.find(".thumb");

    if(images.length > 6) {
        thumbnailsSlide.trigger('to.owl.carousel', [centerElement, 400, true]);
    }

    $(thumbs).removeClass('active');
    $(thumbs[centerElement]).addClass('active');

    $(thumbs).on('click', function () {

        if (!$('.c-fullscreen-slider .owl-stage').hasClass('owl-grab')) {

            $(thumbs).removeClass('active');
            $(this).addClass('active');

            id = $(this).find('img').attr('data-id');
            //thumbnailsSlide.trigger('to.owl.carousel', [$(this).parent().index(), 400, true]);

            goToSLide(id);

            $('.chocolat-pagination').removeClass('active');
            $('.chocolat-wrapper .thumbnails').removeClass('open');
            $('.chocolat-content').removeClass('thumbsOpen');
            $('.fullscreen-slider img').css('opacity', '1');
        }
    });



    if($('.popin-mail').length) {
        $('.popin-mail').find('.contain-popin .theme-article').text(images[centerElement].label);
        if(typeof images[centerElement].date !== 'undefined'){
            $('.popin-mail').find('.contain-popin .date-article').text(images[centerElement].date.replace('undefined',''));
        }
        
        function isHTML(str) {
            var a = document.createElement('div');
            a.innerHTML = str;
            for (var c = a.childNodes, i = c.length; i--; ) {
                if (c[i].nodeType == 1) return true; 
            }
            return false;
        }

        if(typeof images[centerElement].title !== 'undefined'){
            if(isHTML(images[centerElement].title)){
                if($(images[centerElement].title).filter('*').size()){
                    if($(images[centerElement].title).filter('strong').length){
                        images[centerElement].title = $(images[centerElement].title).filter('strong').text();
                    }else{
                        images[centerElement].title = $(images[centerElement].title).text();
                    }
                }
            }
        }
        $('.popin-mail').find('.contain-popin .title-article').text(images[centerElement].title);
        $('.popin-mail').find('form #contact_section').val(images[centerElement].label);
        $('.popin-mail').find('form #contact_detail').val(images[centerElement].date);
        $('.popin-mail').find('form #contact_title').val(images[centerElement].title);
        $('.popin-mail').find('form #contact_url').val(images[centerElement].link);
        $('.popin-mail').find('.chap-article').html('');
    }
    
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
            thumbnailsSlide.trigger('to.owl.carousel',[centerElement]);
        } else {
            $('.fullscreen-slider img').css('opacity', '1');
        }
    })

    $('.chocolat-top').on('click', function(){

        $('.c-fullscreen-slider img').addClass('anime-zoom');

        setTimeout(function(){
            $('.c-fullscreen-slider').addClass('animated fadeOut');
            $('.c-fullscreen-slider img').remove();

            setTimeout(function(){
                $('.c-fullscreen-slider').remove();
                $('.photoActive').removeClass('photoActive');
                history.pushState(null, null, '#');
                $('html').removeClass('slideshow-open');

                if($('.affiche-fdc').length) {
                     $('.wrapper-item').removeClass('active center');
                }
            }, 1600);
        }, 1000);


    });

    // mouseover img : close thumbs
    $('.fullscreen-slider').on('mouseover', function () {
        $('.chocolat-pagination').removeClass('active');
        $('.chocolat-wrapper .thumbnails').removeClass('open');
        $('.chocolat-content').removeClass('thumbsOpen');
        $('.fullscreen-slider img').css('opacity', '1');
    });

    $('.fullscreen-slider img').on('mousemove', function (e){

        $('.zoomCursor').css('display','block');
        $('.zoomCursor').css('z-index','100000');
        $('.zoomCursor').css('left', e.clientX + 10).css('top', e.clientY);

        var img = $(this);

        if(img.hasClass('isZoom')) {

            var pos = $('.chocolat-wrapper').offset();
            var height = $('.chocolat-wrapper').height();
            var width = $('.chocolat-wrapper').width();

            var currentImage = img[0];
            var imgWidth = currentImage.width * 2;
            var imgHeight = currentImage.height * 2;

            var coord = [e.pageX - width/2 - pos.left, e.pageY - height/2 - pos.top];

            var mvtX = 0;
            if (imgWidth > width) {
                mvtX = coord[0] / (width / 2);
                mvtX = ((imgWidth - width + 0)/ 2) * mvtX;
            }

            var mvtY = 0;
            if (imgHeight > height) {
                mvtY = coord[1] / (height / 2);
                mvtY = ((imgHeight - height + 0) / 2) * mvtY;
            }

            img.css('transform','translate3d(' + (-mvtX) + 'px' +',' + (-mvtY) + 'px' + ', 0) scale(2)');
        }
    })

    $('.fullscreen-slider img').on('click', function (e) {

        $(this).toggleClass('isZoom');

        if($(this).hasClass('isZoom')) {
            $(this).css('transform', 'scale(2)');
            $('.zoomCursor .icon').removeClass('icon-wen-more').addClass('icon-wen-minus');
        }else{
            $(this).css('transform', 'scale(1)');
            $('.zoomCursor .icon').addClass('icon-wen-more').removeClass('icon-wen-minus');
        }

    })

    $('.fullscreen-slider img').on('mouseout', function (e){
        $('.zoomCursor').css('display','none');
    });

    $(window).resize(function () {
        w = $(window).width();
        translate = -(w + 0) * centerElement;
        $('.fullscreen-slider').css('transform', 'translateX(' + translate + 'px)');
    });
}
// Slideshow
// =========================
var slideshows = [],
    thumbnails = [];

function initSlideshows() {

  $('.slideshow-img .images .img:first-child').addClass('active');
  var idPhoto = $('.slideshow-img .images .img:first-child a').attr('id');

  $('.thumbnails div[data-id='+idPhoto+']').addClass('active');


  // create slider of thumbs
  var nbItems = $('.single-article').length != 0 ? 7 : 8;

  var sliderThumbs = $('.thumbnails').owlCarousel({
    nav          : false,
    dots         : false,
    smartSpeed   : 500,
    autoWidth    : true,
    margin       : 10,
    dragEndSpeed : 900,
    items        : 5
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
  
}


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

});

$(document).ready(function() {
  initSlideshows();

});


var timeoutCursor;

// HELPERS ================ //
// parse URL in string
String.prototype.parseURL = function() {
  return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&~\?\/.=]+/g, function(url) {
    return url.link(url);
  });
};

// parse twitter username in String
String.prototype.parseUsername = function(twitter) {
  return this.replace(/[@]+[A-Za-z0-9-_]+/g, function(u) {
    var username = u.replace("@","")
    if(twitter == true) {
      return u.link("http://twitter.com/"+username);
    } else {
      return '<strong>' + username + '</strong>';
    }
  });
};

// parse Twitter hashtag in String
String.prototype.parseHashtag = function(twitter) {
  return this.replace(/[#]+[A-Za-z0-9-_]+/g, function(t) {
    var tag = t.replace("#","%23")
    if(twitter == true) {
      return t.link("http://search.twitter.com/search?q="+tag);
    } else {
      return '<strong>' + t + '</strong>';
    }

  });
};

// selection of points for the graph
var posts = [],
    s = null;

function convertToPath(points) {
  var maxPoint = Math.max.apply(null, points);
  var path = 'M4,' + (GLOBALS.socialWall.heightGraph - (160*points[0]) / maxPoint);
  
  for(var i=0; i<points.length; i++){
    var x = i*80 + 4;
    var y = -((160*points[i]) / maxPoint)+GLOBALS.socialWall.heightGraph;
    if(i===0) {
      path += 'L'+x+','+y+' ';
    } else if (i===points.length-1){
      path += x+','+y;
    } else {
      path += x+','+y+',';
    }
  }
  return path;
}

function makePath(data) {
  var pathString  = convertToPath(data),
      graphHeight = $('#graph').height(),
      maxPoint    = Math.max.apply(null, data);
  
  function getDefaultPath(){
    var defaultPathString = 'M4,'+ (graphHeight - 30) +' H';
  
    for(var i=0; i<data.length; i++) {
      if (i!==0){ 
        defaultPathString += i*80+4+' ';
      }
    }
    
    return defaultPathString;
  }
  
  var path = s.path(getDefaultPath()).attr({
    stroke: '#c8a461',
    strokeWidth: 1,
    fill: 'transparent'
  });
  
  path.animate({ path: pathString }, 2000, mina.easeInOutQuint);

  /* point radius */
  var radius = 2;
  
  /* iterate through points */
  setTimeout(function() {
    for (var i = 0, length = data.length; i < length; i++) {
      var xPos = i*80 + 4;
      var yPos = GLOBALS.socialWall.heightGraph - (160*data[i]) / maxPoint;      
      var circle = s.circle(xPos, yPos, radius);
      var circle2 = s.circle(xPos, yPos, 15);

      circle.attr({
        stroke: '#c8a461',
        strokeWidth: 2,
        fill: '#fff',
        opacity: 0
      });

      circle2.attr({
        strokeWidth: 2,
        opacity: 0,
        title: data[i]
      });

      circle.animate({opacity: 1}, 300);

      circle2.mouseover(function() {
        $('#tipGraph').text($(this)[0].attr('title'));
        $('#tipGraph').css({
          top: parseInt($(this)[0].attr('cy')) - 25 + "px",
          left: $('#hashtag').width() + parseInt($(this)[0].attr('cx') - 15) + "px"
        });
        $('#tipGraph').addClass('show');
      });

      if($('.mob').length) {
        var top =  parseInt(yPos) - 25;
        var left = $('#hashtag').width() + parseInt(xPos) - 15;
        $('#graph').append('<div id="tipGraph" class="show" style="top:' + top + 'px;left:' + left + 'px;">' + data[i] + '</div>');
      }

      circle2.mouseout(function() {
        $('#tipGraph').removeClass('show');
      });
    }

    var j = $('#graph ul li.active').index();
    $('#graph circle[stroke="#c8a461"]').eq(j).attr('r', 5).css('stroke-width', '3');
  }, 2000);

  graphRendered = true;
}

function makeGrid() {
  var dataLength = GLOBALS.socialWall.points.length;
  var maxValue = GLOBALS.socialWall.heightGraph;
  var minValue = 35;

  s = Snap('#graphSVG');

  // Creates the vertical lines in the graph
  for(var i = 0; i < dataLength; i++) {
    var x = 4 + i * 80;
    var xLine = s.line(x, minValue, x, maxValue).attr({
      stroke: "#000",
      strokeWidth: 0.25,
      strokeDasharray: '1 5'
    });
  }
}

function displayGrid() {
  $('.post').not('.big.right').each(function(i) {
    var $p = $(this);
    setTimeout(function() {
      $p.find('.side').addClass('flip');
    }, i*50);
  });

  setTimeout(function() {
    $('.big.right').find('.side').addClass('flip');
  }, 800);

  displayed = true;

  // randomly display new posts
  var p = $('.post .side-2');

  for(var i = 0; i < posts.length; ++i) {
    setTimeout(function() {
      var r = Math.floor(Math.random() * p.length);
      var c = p.splice(r, 1)[0];

      var random = Math.floor(Math.random() * posts.length);
      var item = posts.splice(random, 1)[0];

      $(c).prev().addClass(item.type).removeClass('hasimg');
      $(c).parent().find('.side-2').addClass('overlay');
      $(c).parent().find('.side').removeClass('flip');
      $(c).parent().find('.side-1').css('z-index', '5');
      
      if(item.img) {
        $(c).prev().addClass('hasimg').css('background-image', 'url(' + item.img + ')');
      }
      $(c).prev().append(item.text);
    }, (i+1) * 5000);
  }
}

$(document).ready(function() {
  if($('.home').length) {

    // Social Wall
    // =========================
    // GRAPH SVG
    if(GLOBALS.socialWall.points.length > 0 && $('#graph').length > 0) {
      makeGrid();
    }

    // INSTAGRAM
    // load Instagram pictures and build array
    function loadInstagram(callback) {
      if (GLOBALS.env == "html") {
        instagramDatatype = "json";
        instagramRequest  = {};
      } else {
        instagramDatatype = "json";
        instagramRequest  = {
          offset : 40
        }
      }

      $.ajax({
        url      : GLOBALS.api.instagramUrl,
        type     : "GET",
        data     : instagramRequest,
        dataType : instagramDatatype,
        success: function(data) {

          if (GLOBALS.env == "html") {
            var count = 15; 
            for (var i = 0; i < count; i++) {
              if (typeof data.data !== 'undefined' ) {
                if (typeof data.data[i] !== 'undefined' ) {
                  posts.push({'type': 'instagram', 'img': data.data[i].images.low_resolution.url, 'date' : data.data[i].created_time, 'text': '<div class="txt"><div class="vCenter"><div class="vCenterKid"><p>' + data.data[i].caption.text.substr(0, 140).parseURL().parseUsername().parseHashtag() + '</p></div></div></div>', 'user': data.data[i].user.username});
                }
              }
             
              if(i == count - 1) {
                callback();
              }
            }
          } else {
            var count = Math.min(data.length, 15);
            for (var i = 0; i < count; i++) {
              posts.push({'type': 'instagram', 'text': '<div class="txt"><div class="vCenter"><div class="vCenterKid"><p>' + data[i].message.substr(0, 140).parseURL().parseUsername(true).parseHashtag(true) + '</p></div></div></div>', 'img': data[i].content});

              if(i == count - 1) {
                callback();
              }
            }
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {

        }
      });
    }

    // TWITTER
    // load Twitter posts and pictures and build array
    function loadTweets(callback) {
      var twitterRequest, twitterUrl, twitterType;
      
      if (GLOBALS.env == "html") {
        twitterUrl     = "twitter.php";
        twitterType    = "POST";
        twitterRequest = {
          q     : "%23Cannes2016",
          count :  15,
          api   :  "search_tweets"
        };
      } else {
        twitterUrl     = GLOBALS.api.twitterUrl;
        twitterType    = "GET";
        twitterRequest = {
          offset : 40
        };
      }

      $.ajax({
        url  : twitterUrl,
        type : twitterType,
        data : twitterRequest,
        success: function(data, textStatus, xhr) {
          if (GLOBALS.env == "html") {
            data = JSON.parse(data)
            if (typeof data.statuses !== 'undefined') {
              data = data.statuses;
            }

            var img = '';

            for (var i = 0; i < data.length; i++) {
              img = '';
              url = 'http://twitter.com/' + data[i].user.screen_name + '/status/' + data[i].id_str;
              try {
                if (data[i].entities['media']) {
                  img = data[i].entities['media'][0].media_url;
                }
              } catch (e) {
                // no media
              }
        
              posts.push({'type': 'twitter', 'text': '<div class="txt"><div class="vCenter"><div class="vCenterKid"><p>' + data[i].text.parseURL().parseUsername(true).parseHashtag(true) + '</p></div></div></div>', 'name': data[i].user.screen_name, 'img': img, 'url': url, 'date': data[i].created_at})
              
              if(i == data.length - 1) {
                callback();
              }
            }
          } else {
            var img = '';

            for (var i = 0; i < data.length; i++) {
              img = '';
              try {
                if (data[i].content) {
                  img = data[i].content;
                }
              } catch (e) {
                // no media
              }
            
              posts.push({'type': 'twitter', 'text': '<div class="txt"><div class="vCenter"><div class="vCenterKid"><p>' + data[i].message.parseURL().parseUsername(true).parseHashtag(true) + '</p></div></div></div>', 'img': img})

              if(i == data.length - 1) {
                callback();
              }
            }
          }
        }
      });
    }

    loadInstagram(function() {
      loadTweets(function() {
        // once all data is loaded, build html and display the grid
        var p = $('.post:not(.empty) .side-2');
        var number = Math.min(posts.length, 12);
        for(var i = 0; i < number; ++i) {
          var random = Math.floor(Math.random() * posts.length);
          var item = posts.splice(random, 1)[0];
          var r = Math.floor(Math.random() * p.length);
          var c = p.splice(r, 1)[0];

          $(c).addClass(item.type);
          $(c).addClass('flip');
          if(item.img && item.img != '#') {
            $(c).addClass('hasimg').css('background-image', 'url(' + item.img + ')');
          }

          $(c).append(item.text);
          $(c).append('<span class="ov"></span>');
        }
      });
    });
  }
});
var owInitTab = function(id) {

  if(id == 'tab1') {

    var $tab = $('.tab1 td');

    var hash = window.location.hash;
    hash = hash.substring(5)

    if(hash != '') {

      var dataTab = hash;
      var $block = $('.block-contain-txt-register-movie[data-article='+dataTab+']');
      var $element = $('td[data-tab='+dataTab+']');

      console.log('td[data-tab='+dataTab+']');

      $tab.removeClass('active');
      $element.addClass('active');

      $('.block-contain-txt-register-movie').removeClass('active animated fadeInUp');

      $block.addClass('active animated fadeInUp');

      var hashPush = '#tab='+dataTab;
      history.pushState(null, null, hashPush);
    }

    $tab.on('click', function(e) {
      var $element = $(this);
      var dataTab = $element.data('tab');
      var $block = $('.block-contain-txt-register-movie[data-article='+dataTab+']');

      $tab.removeClass('active');
      $element.addClass('active');

      $('.block-contain-txt-register-movie').removeClass('active animated fadeInUp');

      $block.addClass('active animated fadeInUp');

      var hashPush = '#tab='+dataTab;
      history.pushState(null, null, hashPush);

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
    $('.newsletter form').on('submit', function(event) {

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
                <button class="icon icon-son"></button>\
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
            var videoPlayer = jwplayer(this.id);
            if (!$(videoPlayer).data('loaded')) {
                playerLoad(this, videoPlayer, havePlaylist, live, function (vid) {
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
    var $container = $("#" + vid.id).closest('.video-container');
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

    var playerHeight = $('.home').length ? 550 : $(vid).closest('div').height();

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
        // console.log("");
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

    $sound.on('click', '.icon_son', function () {
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
    if ($('#video-player-ba').length > 0) {
        videoMovieBa = playerInit('video-player-ba', false, true)
    }

    if ($('.video-player').length > 0) {
        var dataFile = $('.video-player').data('file');
        var isPlaylist = false;
        if(typeof dataFile !== 'undefined'){
            if(dataFile.length > 1){
                isPlaylist = true;
            }
        }


        videoPlayer = playerInit(false, 'video-player', isPlaylist);
    }

    if ($('.video-player-pl').length > 0) {
        videoPlayer = playerInit(false, 'video-player-pl', true);
    }
});
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

/* thomon - homepage ajax module rework */
var homepageCards = homepageCards || {};
homepageCards.config = {
    cards: [],
    cardsByFilter: [],
    filters: [],
    maxCardsContainersToDisplay: 2,
    cardsContainer: $('.ajax-filter-cards-container'),
    bottomCardsWrapper: $('.articles-wrapper'),
}

homepageCards.config.urlStamp;

homepageCards.init = function(){
    
    homepageCards.getCards();
    homepageCards.buildFilters();
    homepageCards.events();
    
            
}

homepageCards.events = function(){
    $('.filters .select span').off('click').on('click', function (){
        homepageCards.showFiltersOverlay($(this));
    });

    homepageCards.ajaxClickEvent($('.read-more.ajax-request'));
}

homepageCards.ajaxClickEvent = function(button){
    button.off('click').on('click', function(){
        var $this = $(this);
        var url = $(this).attr('href');
        var container = $(this).closest('.block-01');
        var dateTime = $('.articles-wrapper .articles:last-child article:last-child').data('time');
        if(typeof dateTime === 'undefined'){
            dateTime = $('.contain-card article:last-child').data('time');
        }

        var theme = $('.filter#theme .select span.active').data('filter');
        var format = $('.filter#format .select span.active').data('filter');
        //fake animation before the real computing
        $('.articles-wrapper').css('height',$('.articles-wrapper').height()+600);
        homepageCards.config.maxCardsContainersToDisplay = homepageCards.config.maxCardsContainersToDisplay + 2;
        homepageCards.renderAjaxResponse(url,dateTime,theme,format);

        return false;
    });
}

homepageCards.renderAjaxResponse = function(url,dateTime,theme,format){
    $.get( url, {date: dateTime, theme: theme, format: format}, function( data ) {
        if(data == null){
            return false;
        }else{
            $data = $(data);
            //add new filters
            if($(data).filter('.compute-filters').length){
                $(data).filter('.compute-filters').each(function(){
                    var slug = $(this).attr('class').replace('compute filters ','');

                    $(this).find('span').each(function(){
                        //test if filter exists
                        if(!$('#'+slug+' .select span[data-filter="'+$(this).data('filter')+'"]').length){
                            $('#'+slug+' .select .icon-arrow-down').before($(this));
                        }
                    });
                });
            }

            var newCards = [];
            $(data).find('article').each(function(){
                newCards.push($(this));
            });

            homepageCards.insertCards(newCards);
            var cardsToDisplay = homepageCards.getFilteredCollection(theme,format);

            homepageCards.emptyCards();
            homepageCards.populateCards(cardsToDisplay);
            homepageCards.config.bottomCardsWrapper.find('.read-more').remove();
            homepageCards.config.bottomCardsWrapper.find('.compute-filters').remove();

            if(cardsToDisplay.length < 4){
                $('.articles-wrapper').css('height',$('.articles-wrapper').height()+600);
            }

            if(!$('.articles-wrapper .articles article').length){
                //scrolltop
                var offset = $('.contain-card').offset().top - 250;
                $('html,body').animate({
                    scrollTop: offset
                });
            }

            //remove old button
            var oldButton = $('.articles-wrapper').siblings('#home-news-statements-more');
            var moreBtn;
            //get ajax response button & append it
            if($data.filter('#home-news-statements-more').length){
                var resetAjax = true;
                moreBtn = $data.filter('#home-news-statements-more');
            }else if($data.filter('#home-news-statements-more-end')){
                moreBtn = $data.filter('#home-news-statements-more-end');
                if(oldButton.length){
                    homepageCards.config.urlStamp = oldButton.attr('href');
                }
            }
            $('.articles-wrapper').siblings('.read-more').remove();
            $('.articles-wrapper').parent().append(moreBtn);

            if(resetAjax){
                homepageCards.ajaxClickEvent($('#home-news-statements-more'));
            }
        }
    });
}
homepageCards.showFiltersOverlay = function(element){
    $('.filter .select').each(function () {
        $that = $(this);
        $id = $(this).closest('.filter').attr('id');

        $that.find("span:not(.active):not([data-filter='all'])").each(function () {
            $this = $(this);

            var getVal = $this.data('filter');
            var numItems = $('.item[data-' + $id + '="' + getVal + '"]').length;

            if (numItems === 0) {
                $this.addClass('disabled');
            } else {
                $this.removeClass('disabled');
            }
        });
    });

    var h = element.parent().html();
    $('#filters').remove();
    $('body').append('<div id="filters"><div class="vCenter"><div class="vCenterKid"></div></div><div class="close-button"><i class="icon icon-close"></i></div></div>');
    $('#filters .vCenterKid').html(h);
    $('#filters .vCenterKid').find(':not(span)').remove();
    $('#filters .vCenterKid').find('span.disabled').remove();
    $('#filters').attr('data-id', $(this).parents('.filter').attr('id'));

    setTimeout(function () {
        $('#filters').addClass('show');
    }, 100);

    setTimeout(function(){
        $('#filters span').addClass('show');
    },400);

    $('#filters span').off('click').on('click', function () {
        var id = element.closest('.filter').attr('id'),
        f = $(this).data('filter');

        $('#' + id + ' .select span').removeClass('active');
        $('#' + id + ' .select span[data-filter="' + f + '"]').addClass('active');

        //get all active filters
        var theme = $('#theme .select span.active').data('filter');
        var format = $('#format .select span.active').data('filter');
        var newCards = homepageCards.getFilteredCollection(theme,format);
        homepageCards.emptyCards();
        homepageCards.populateCards(newCards);

        var $this = $('.articles-wrapper').siblings('.read-more');
        var url = $this.attr('href');
        
        if(typeof url === 'undefined' || $this.is('#home-news-statements-more-end')){
            url = homepageCards.config.urlStamp;
        }
        var container = $this.closest('.block-01');
        var dateTime = $('.articles-wrapper .articles:last-child article:last-child').data('time');
        if(typeof dateTime === 'undefined'){
            dateTime = $('.contain-card article:last-child').data('time');
        }

        var currentMoreBtn = $('#home-news-statements-more');
        //AJAX CALL + GET BUTTON + APPEND BUTON IF NO MORE NEWS
        $.get( url, {date: dateTime, theme: theme, format: format}, function( data ) {
            if(data == null){
                return false;
            }else{
                $data = $(data);

                var newCards = [];
                $data.find('article').each(function(){
                    newCards.push($(this));
                });

                homepageCards.insertCards(newCards);
                var cardsToDisplay = homepageCards.getFilteredCollection(theme,format);

                homepageCards.emptyCards();
                homepageCards.populateCards(cardsToDisplay);
                homepageCards.config.bottomCardsWrapper.find('.read-more').remove();
                homepageCards.config.bottomCardsWrapper.find('.compute-filters').remove();

                var oldButton = $('.articles-wrapper').siblings('#home-news-statements-more');
                var moreBtn;
                //get ajax response button & append it
                if($data.filter('#home-news-statements-more').length){
                    var resetAjax = true;
                    moreBtn = $data.filter('#home-news-statements-more');
                }else if($data.filter('#home-news-statements-more-end')){
                    moreBtn = $data.filter('#home-news-statements-more-end');
                    if(oldButton.length){
                        homepageCards.config.urlStamp = oldButton.attr('href');
                    }
                }
                $('.articles-wrapper').siblings('.read-more').remove();
                $('.articles-wrapper').parent().append(moreBtn);

                if(resetAjax){
                    homepageCards.ajaxClickEvent($('#home-news-statements-more'));
                }
            }
        });
    });


    // close filters
    $('body').off('click').on('click', '#filters', function () {
        $('#filters').removeClass('show');
        setTimeout(function () {
            $('#filters').remove();
        }, 700);
    });
}

homepageCards.getCards = function(){
    //populate cards array
    homepageCards.config.cardsContainer.each(function(index,value){
        var container = $(this);
        container.find('article').each(function(){
            homepageCards.config.cards.push($(this));
        });
    });
}

homepageCards.insertCards = function(cards){
    //merge cards array with new cards
    var output = homepageCards.config.cards.concat(cards.filter(function (item) {
        var $return = true;
        for(var i = 0;i<homepageCards.config.cards.length;i++){
            if(homepageCards.config.cards[i].find('.info strong a').attr('href') == item.find('.info strong a').attr('href')){
                //same url detected
                $return = false;
            }
        }
        return $return;
    }));
    homepageCards.config.cards = output;
}

homepageCards.emptyCards = function(){
    //remove all cards from dom
    homepageCards.config.cardsContainer.each(function(index,value){
        $(this).find('article').each(function(){
            $(this).remove();
        });
    });
}

homepageCards.populateCards = function(cards){
    //populate dom
    var tempCardsArray = cards;
    var bottomContainerHeight = 0;
    if((homepageCards.config.cardsContainer.size() * 3) < cards.length){
        var neededContainersNumber = ((parseInt(cards.length) - parseInt(homepageCards.config.cardsContainer.size() * 3)) / 3);
        
        //returns 1 for positive, 0 for neutral and -1 for negative
        var sign = neededContainersNumber > 0 ? 1 : neededContainersNumber == 0 ? 0 : -1; 
        if(sign > 0){
            for(var i = 0; i <= neededContainersNumber; i++){
                var revertClass = '';
                if(!homepageCards.config.bottomCardsWrapper.find('.articles').last().hasClass('article-inverse')){
                    revertClass = ' article-inverse';
                }
                homepageCards.config.bottomCardsWrapper.append('<div class="articles'+revertClass+'"><div class="cards grid-01 isotope-01 ajax-filter-cards-container"><div class="grid-sizer"></div></div></div>');
            };
        }
    }

    homepageCards.config.cardsContainer = $('.ajax-filter-cards-container');
    homepageCards.config.cardsContainer.each(function(index,value){
        //if(index < homepageCards.config.maxCardsContainersToDisplay){
            $(this).removeAttr('style');
            var container = $(this);
            if(container.find('article').size() <= 3){
                var cardSlice = tempCardsArray.splice(0,3);
                $.each(cardSlice,function(i,val){
                    if(i <= 3){
                        container.append($(this).removeAttr('style'));
                    }
                });
                if(container.closest('.articles-wrapper').length){
                    bottomContainerHeight = bottomContainerHeight + container.outerHeight();
                }
            }
            homepageCards.config.bottomCardsWrapper.css('height',bottomContainerHeight);
        //}
    });
    homepageCards.config.cardsContainer.find('.to-init').removeClass('to-init');
}

homepageCards.buildFilters = function(){
    $('#theme .select span').each(function(){
        homepageCards.config.filters.push($(this).data('filter'));
    });
}


//returns an array of HTML strings
homepageCards.getFilteredCollection = function(themeFilter,formatFilter){
    //default filters (no params)
    themeFilter = typeof themeFilter !== 'undefined' ? themeFilter : 'all';
    formatFilter = typeof formatFilter !== 'undefined' ? formatFilter : 'all';
    var output = [];
    $.each(homepageCards.config.cards, function(index,value){
        if($(this).is('.'+themeFilter+'.'+formatFilter)){
            output.push($(this));
        }
    });
    return output;
}
/* thomon - end homepage ajax module rework */

$(document).ready(function () {

    if (/MSIE 10/i.test(navigator.userAgent)) {
        $('body').addClass('ie');
    }

    if (/MSIE 9/i.test(navigator.userAgent) || /rv:11.0/i.test(navigator.userAgent)) {
        $('body').addClass('ie');
    }

    if($('.ajax-filter-cards-container').length){
        homepageCards.init();
    }

    //hotfix focus & sameday thumbs click
    if($('.focus').length){
        $('.focus .articles article')
        .css('cursor','pointer')
        .on('click',function(){
            if($(this).find('a').length){
                var href = $(this).find('.info a').attr('href');
                window.location.href = href;
            }
        });
    }
    if($('.same-day').length){
        $('.same-day .articles article')
        .css('cursor','pointer')
        .on('click',function(){
            if($(this).find('a').length){
                var href = $(this).find('.info a').attr('href');
                window.location.href = href;
            }
        });
    }
    

    initHeaderSticky();
    // owInitLinkChangeEffect();


    owInitPopin('popin-landing-e');
    owInitPopin('popin-timer-banner');
    owCookieBanner();

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

        var hash = window.location.hash;
        hash = hash.substring(1, hash.length);

        verif = hash.slice(0, 3);
        number = hash.slice(4);

        if (hash.length > 0 && verif == "vid") {
            initVideo(number);
        } else {
            initVideo();
        }
    }

    if ($('.block-social-network ').length > 0) {
        initRs();
    }

    if ($('.block-diaporama').length > 0) {
        var hash = window.location.hash;
        hash = hash.substring(1, hash.length);

        verif = hash.slice(0, 3);
        var slider = $('.block-diaporama .slider-01');

        slider.find('.item').each(function(){
            var img = $(this).find('img').css('height',428);
            var w = img.width();
            if(parseInt(w) == 0){
                var itv = window.setInterval(function(){
                    w = img.width();
                    if(w > 0){
                        window.clearInterval(itv);
                    }
                },200);
            }else{
                $(this).css('width',img.width());
            }
        });
        if (hash.length > 0 && verif == "pid") {
            

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

        owInitGrid('isotope-01');
    }


    if ($('.ajax-section').length) {
        owInitAjax();
    }

    if ($('.block-push-top').length) {
        onInitParallax();
    }
    
    if($('.contact').length ) {
        initContact();
    }

    if($('.faq').length > 0) {
        initFaq();
        owInitScrollFaq();
    }


    if ($('.retrospective.poster').length) {
        owInitNavSticky(1);
    }

    if ($('.retrospective-home').length && $('.slides').length) {
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

    if ($('.retrospective.selection').length) {
        owInitNavSticky(2);
        owInitGrid('isotope-01');
    }

    if ($('.retrospective.palmares').length) {
        owInitNavSticky(2);
    }

    if ($('.single-movie').length) {
        var slider = $('.slideshow-img .images');
        owinitSlideShow(slider);
        scrollSingleMovie();
    }
    if ($('.slider-03').length) {
        owInitSlider('slider-03');
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

            var hash = window.location.hash;
            hash = hash.substring(1, hash.length);

            verif = hash.slice(0, 3);
            number = hash.slice(4);

            if (hash.length > 0 && verif == "pid") {
                owinitSlideShow(slider, hash);
            } else {
                owinitSlideShow(slider);
            }

            if (hash.length > 0 && verif == "aid") {
                initAudio(number);
            } else {
                initAudio();
            }
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

        owInitNavSticky(1);


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
        owInitNavSticky(1);
    }

    if ($('.p-register').length) {
        owInitTab('tab1');
    }

    if ($('.media-library').length) {
        owInitSliderSelect('timelapse');
        owInitSliderSelect('tab-selection');

        var grid = owInitGrid('isotope-01');
        
        var hash = window.location.hash;
        hash = hash.substring(1, hash.length);

        verif = hash.slice(0, 3);
        number = hash.slice(4);

        if (hash.length > 0 && verif == "pid") {
            owinitSlideShow(grid, hash);
        } else {
            owinitSlideShow(grid);
        }

        if (hash.length > 0 && verif == "vid") {
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

    if ($('.search-page').length) {
        owInitSliderSelect('timelapse');
        owInitSliderSelect('tab-selection');
        owInitAccordion('more-search');
        owInitFilterSearch();
        owInitFilter(true);
        owFixImg();

        autoComplete();
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

    if($('#google-map').length) {
        google.maps.event.addDomListener(window, 'load', initMap);
    }


    if($('.search-page-result').length) {
        $form = $('.block-searh-more form');
        initFilterCheck($form);
        truncTitleSearch();
    }

    if($('.search-page').length){
        $form = $('.block-search form');
        initFilterCheck($form);
    }

    setTimeout(function () {
        $('body').removeClass('loading');
    }, 1000);


    if($('.affiche-fdc').length){

        var hash = window.location.hash;
        hash = hash.substring(1, hash.length);

        verif = hash.slice(0, 3);

        if (hash.length > 0 && verif == "pid") {
            var slider = $('.affiche-fdc');
            owinitSlideShow(slider, hash);

            $('.poster').on('click', function(e){
                slider = $('.all-contain');
                $(this).parent().addClass('active center');

                openSlideShow(slider, "undefined", true);
            })

        }else{
            owinitSlideShow();
        }
    }


    //FIX IE

    if($('body').hasClass('ie')){
        $.each($('.slide'),function (i, e) {
            var src = $(e).find('img').attr('src');
            $(e).find('.linkVid').css('background-image','url('+src+')');
            $(e).find('.linkVid').css('background-size','cover');
        })
    }
});
