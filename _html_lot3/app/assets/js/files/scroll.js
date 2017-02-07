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

   if (!$('body').hasClass('mobile') && $('.retrospective').length) {
       $('.block-push').css('background-position', '0px -10px');

        $(window).on('scroll', function () {

            if ($('header.sticky').length) {
                var s = $(this).scrollTop() - 240;
                $('.block-push').css('background-position', '0px ' + s + 'px');
            } else {
                $('.block-push').css('background-position', '0px ' + '-240px');
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