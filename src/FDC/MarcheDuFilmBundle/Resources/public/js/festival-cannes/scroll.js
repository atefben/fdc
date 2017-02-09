// init parallax elements and push them into an array
var parallaxElements = {};

/*function initParallaxElements() {
    var $header = $('header');

    if ($('.home').length) {
        // home prefooter
        if (!isIE() && !isiPad()) {
            if ($('#prefooter .owl-item.center .imgSlide img').length) {
                parallaxElements['prefooter'] = ({
                    'el1': '#prefooter .owl-item.center .imgSlide img',
                    'positionTop': $('#slider-prefooter').offset().top,
                    'division': 2,
                    'mov': 1
                });
            }

            // slider movies home
            if ($('#slider-movies .owl-item.active .video').length) {
                parallaxElements['movies'] = ({
                    'el1': '#slider-movies .owl-item.active .video',
                    'positionTop': $('#slider-movies').offset().top,
                    'division': 8,
                    'mov': 4
                });
            }

            // slider home
            if ($('#slider .owl-item .img-container').length) {
                parallaxElements['slider'] = ({
                    'el1': '#slider .owl-item .img-container',
                    'positionTop': $('#slider').offset().top - $header.height(),
                    'division': 2,
                    'mov': 4
                });
            }
        }
    }

    // header webtv
    if ($('.webtv-live').length) {
        parallaxElements['webtv'] = ({
            'el1': '#live .img',
            'positionTop': $('#live').offset().top - $header.height(),
            'division': 0.3,
            'mov': 3,
            'direction': true
        });
    }

    // header single movie page
    if ($('.single-movie').length) {
        parallaxElements['movie'] = ({
            'el1': '.main-image .img',
            'positionTop': $('.main-image').offset().top - $header.height(),
            'division': 6,
            'mov': 15
        });
    }
}

// update
function update() {
    var hW = $(window).height();
    var el = ['prefooter', 'movies', 'slider', 'webtv', 'movie'];
    for (var i = 0; i < el.length; i++) {
        if (typeof parallaxElements[el[i]] !== 'undefined') {
            if (scrollTarget > (parallaxElements[el[i]].positionTop - hW) && scrollTarget < parallaxElements[el[i]].positionTop + hW) {
                $(parallaxElements[el[i]].el1).css('position', 'fixed');
                render(parallaxElements[el[i]].el1, parallaxElements[el[i]].positionTop, parallaxElements[el[i]].division, parallaxElements[el[i]].mov, parallaxElements[el[i]].direction);
            } else {
                $(parallaxElements[el[i]].el1).css('position', '');
            }
        }
    }
    window.requestAnimFrame(update);
}

// vars for parallax
var scrollTarget = 0,
    scrollPos = 0,
    scrollEase = 0.1;
scrollEaseLimit = 0.1;

function render(el1, start, division, mov, direction) {
    var hW = $(window).height();
    // process only if value is not reached
    var sc = scrollTarget - start;

    if (sc !== scrollPos && scrollTarget > (start - hW * 2)) {

        // limit easing
        if (Math.abs(scrollPos - sc) < scrollEaseLimit) {
            scrollPos = sc;
        }

        // increment pos with easing
        scrollPos += (sc - scrollPos) * scrollEase;

        // translate Element 2 with pos / 2 (half speed)
        var newPos = scrollPos / division;
        if (direction) {
            newPos = -(scrollPos * division);
        }
        transform1 = 'translate3d(0px, ' + newPos + 'px, 0px)';

        $(el1).css({
            '-webkit-transform': transform1,
            '-moz-transform': transform1,
            '-o-transform': transform1,
            '-ms-transform': transform1,
            'transform': transform1
        });

        // translate Element 2 with pos (plain speed)
        // transform2 = 'translate3d(0px, ' + (scrollPos/mov) + 'px, 0px)';
        // el2.style.webkitTransform = transform2;
        // el2.style.MozTransform = transform2;
        // el2.style.msTransform = transform2;
        // el2.style.OTransform = transform2;
        // el2.style.transform = transform2;
    }
}


$(document).ready(function () {
    var hW = $(window).height();

    // Events on scroll
    // =========================
    var lastScrollTop = 0,
        $header = $('header'),
        $timeline = $('#timeline'),
        $navMovie = $('#nav-movie'),
        $faqmenu = $(".faq-menu");

    $(window).on('scroll', function () {
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

        // SLIDER MOVIES : play or pause video on scroll
        if ($('#featured-movies').length) {
            if (s > $('#featured-movies').offset().top - $('#featured-movies').height() && s < $('#featured-movies').offset().top + $('#featured-movies').height()) {
                if ($('#featured-movies .active').length) {
                    $('#featured-movies .active').find('video')[0].play();
                }
                handleEndVideo();
            } else {
                if ($('#featured-movies .active').length) {
                    $('#featured-movies .active').find('video')[0].pause();
                }
            }
        }

        // Display social wall
        if ($('#social-wall').length) {
            if (s > $('#social-wall').offset().top - ($(window).height() / 2) && !displayed) {
                displayGrid();
            }
        }

        // Render the path of hashtag graph
        if (GLOBALS.socialWall.points.length > 0 && $('#graph').length > 0) {
            if (s > $('#graph').offset().top - ($(window).height() / 2) && !graphRendered) {
                makePath(GLOBALS.socialWall.points);
            }
        }

        // STICKY column on search page
        if ($('.searchpage').length) {
            var $colSearch = $('#colSearch');
            if (s > $('#results').offset().top - 85 && s < ($('#footerSearch').offset().top - $('#footerSearch').height() - $colSearch.height() + 155)) {
                $colSearch.removeClass('bottom').addClass('stick');
            } else {
                if (s >= ($('#footerSearch').offset().top - $('#footerSearch').height() - $colSearch.height() + 155)) {
                    $colSearch.removeClass('stick').addClass('bottom');
                } else {
                    $colSearch.removeClass('stick');
                }
            }
        }

        // STICKY Timeline on homepage on scroll
        if ($('#news').length) {
            if (s > $('#news').offset().top + 70 && s < ($('.read-more').offset().top + $('.read-more').height() - $timeline.height() - 123)) {
                $timeline.removeClass('bottom').addClass('stick').css('left', $('.content-news').offset().left + $('.content-news').width() + 57);
            } else {
                if (s >= ($('.read-more').offset().top + $('.read-more').height() - $timeline.height() - 123)) {
                    $timeline.addClass('bottom');
                } else {
                    $timeline.removeClass('stick').css('left', 'auto');
                }
            }
        }

        // STICKY Menu on FAQ page on scroll

        if ($('.faq').length) {
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
        }

        // NAV for single article
        if ($('.single-article').length) {
            if ($('.same-day').length) {
                if (s >= $('.same-day').offset().top - $('.same-day').height() / 2 - 100) {
                    $('a.nav').addClass('bottom');
                } else {
                    $('a.nav').removeClass('bottom');
                }
            } else {
                var elt = $('footer');

                if (s >= elt.offset().top - elt.height() - 400) {
                    $('a.nav').addClass('bottom').css('bottom', '155px');
                } else {
                    $('a.nav').removeClass('bottom').css('bottom', 'auto');
                }
            }
        }

        // NAV for single evenement
        if ($('.single-evenement').length) {
            if (s >= $('.share').offset().top - 300) {
                $('a.nav').addClass('bottom');
            } else {
                $('a.nav').removeClass('bottom');
            }
        }

        // PRESS
        // sticky calendar
        if ($('.press-home').length || $('.press-programmation').length) {
            var $myCalendar = $('#calendar-wrapper');
            if (s > $('#calendar').offset().top - 91 && s < ($('.contact-press').offset().top - $myCalendar.height() - 91)) {
                $myCalendar.removeClass('bottom').addClass('stick').css('left', $('#calendar').offset().left);
            } else {
                if (s >= ($('.contact-press').offset().top - $myCalendar.height() - 91)) {
                    $myCalendar.removeClass('stick').css('left', 'auto').addClass('bottom');
                }
                if (s <= ($('#calendar').offset().top - 91)) {
                    $myCalendar.removeClass('stick').css('left', 'auto');
                }
            }
        }

        // WEBTV
        if ($('.webtv-live').length) {
            var hght = $header.hasClass('sticky') ? 91 : 230;
            $('#live .textLive').css('top', hght + ($('#live').height() - $('#live .textLive').height()) / 2);
            $('.webtv #live .img').css('top', '');
            $('#main').css('padding-top', $header.hasClass('sticky') ? 91 : 0);


            if (!isIE() && s > 50 && $('#live').hasClass('on')) {
                $('#live').removeClass('on');
                $('#live').height($('#live').data('height'));

                setTimeout(function () {
                    if (videoWebtv.getState() != "paused" && videoWebtv.getState() != "idle") {
                        $('#live .trailer').removeClass('on');

                        if (isiPad) {
                            videoWebtv.stop();
                        } else {
                            videoWebtv.pause();
                        }

                        videoWebtv.updateMute(true);
                    }
                }, 300);

                if (isiPad) {
                    setTimeout(function () {
                        videoWebtv.stop();
                    }, 600);

                    setTimeout(function () {
                        videoWebtv.stop();
                    }, 900);
                }
            }
        }

        // SINGLE MOVIE
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

        if ($('#calendar-programmation').length > 0 && !$('.press-home').length > 0) {
            if (s > 291) {
                var w = s - 289 + 41;
                var y = w + 39 - 41;
                y = y + "px";
                w = w + "px";

                $('.filters').css('top', '' + w + '');
                $('#timeline').css('top', '' + w + '').css('z-index', 3);
                $('.calendar .v-head').css('transform', 'translateY(' + y + ')');
                $('.calendar .nav').css('transform', 'translateY(' + y + ')').css('z-index', 3);


            } else {

                $('.filters').css('top', '' + 0 + '');
                $('#timeline').css('top', '' + 0 + '').css('z-index', 3);

                $('.calendar .v-head').css('transform', 'translateY(' + 0 + ')');
                $('.calendar .nav').css('transform', 'translateY(' + 0 + ')').css('z-index', 3);
            }
        }

        if ($('#mycalendar').length > 0 && !$('.press-programmation').length) {

            $('#mycalendar .fc-button').on('click', function () {
                start();
            })


            var start = function () {
                if (s > 180) {
                    var w = s - 151;
                    w = w + "px";
                    $('.fc-head .fc-day-header').css('transform', 'translateY(' + w + ')');
                    $('#mycalendar .fc-button').css('transform', 'translateY(' + w + ')');

                } else {
                    $('.fc-head .fc-day-header').css('transform', 'translateY(' + 0 + ')');
                    $('#mycalendar .fc-button').css('transform', 'translateY(' + 0 + ')');
                }

                if (s > $('#mycalendar').height() + 95) {

                    var a = $('#mycalendar').height() - 42;
                    a = a + "px";
                    $('.fc-head .fc-day-header').css('transform', 'translateY(' + a + ')');
                    $('#mycalendar .fc-button').css('transform', 'translateY(' + a + ')');
                }
            }

            start();

        }

        lastScrollTop = s;
    });

    // ---------- PARALLAX ------------
    // on resize, update positionTop
    $(window).resize(function () {
        if ($('.home').length) {
            // home prefooter
            if ($("#slider-prefooter").length && typeof parallaxElements['prefooter'] !== 'undefined') {
                parallaxElements['prefooter'].positionTop = $('#slider-prefooter').offset().top;
            }
            if ($('#slider-movies .owl-item.active .video').length && typeof parallaxElements['movies'] !== 'undefined') {
                parallaxElements['movies'].positionTop = $('#slider-movies').offset().top;
            }
            if ($('#slider').length && typeof parallaxElements['slider'] !== 'undefined') {
                parallaxElements['slider'].positionTop = $('#slider').offset().top - $header.height();
            }
        }

        if ($('.webtv-live').length && typeof parallaxElements['webtv'] !== 'undefined') {
            parallaxElements['webtv'].positionTop = $('#live').offset().top - $header.height();
        }

        hW = $(window).height();
    });


//========== Scroll footer breadcrumb ==========/
    if ($('#breadcrumb').length) {
        $('#breadcrumb .goTop').on('click', function () {
            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
        });
    }
});
*/