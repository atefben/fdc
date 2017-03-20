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
                console.log('tempArray',tempArray);
                if(typeof tempArray[0] !== 'undefined'){
                    console.log('tempArray0',tempArray[0]);
                    var finalFile = tempArray[0].file;
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