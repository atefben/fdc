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
        owInitNavSticky(1);
    }

    if ($('.p-register').length) {
        owInitTab('tab1');
    }

    if ($('.media-library').length) {
        owInitSliderSelect('timelapse');
        owInitSliderSelect('tab-selection');

        var grid = owInitGrid('isotope-03');

        owInitAleaGrid(grid, $('.grid-01'), true);

/*
        ajaxMedialib();
*/
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

    if($('#google-map').length) {
        google.maps.event.addDomListener(window, 'load', initMap);
    }

    setTimeout(function () {
        $('body').removeClass('loading');
    }, 1000);

});
