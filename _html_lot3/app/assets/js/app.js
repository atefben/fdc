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

/* fix slideshow title width */
var computeSlideshowTitleWidth = function(){
    //check if slideshow exists
    if($('.c-fullscreen-slider').length){
        var globalWidth = $(window).width();
        var paginationWidth = $('.chocolat-pagination').outerWidth();
        var creditWidth = $('.c-fullscreen-slider .credit').outerWidth();
        var shareWidth = $('.c-fullscreen-slider .share').outerWidth();
        var leftArWidth = $('.c-fullscreen-slider .chocolat-left').outerWidth();
        var rightArWidth = $('.c-fullscreen-slider .chocolat-right').outerWidth();
        var totalItemWidth = paginationWidth + creditWidth + shareWidth + leftArWidth + rightArWidth;
        var remainingWidth = globalWidth - totalItemWidth;
        var titlePadding = 135;

        //padding left breakpoint
        if(globalWidth < 1600){
            titlePadding = 115;
        }
        var finalWith = remainingWidth - titlePadding;

        $('.c-fullscreen-slider').find('.chocolat-description').css('width',remainingWidth);
    }
}

$(window).resize(function(){
    computeSlideshowTitleWidth();
});

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

    computeSlideshowTitleWidth();

    //hotfix poster in block-movie-preview for ie
    if($('body').hasClass('ie') && !$('body').hasClass('story-palme') && $('.block-movie-preview').length){
        $('.block-movie-preview').each(function(){
            var img = $(this).find('.poster img');
            var wrapper = img.closest('.poster');
            var leftMargin = (img.width() - wrapper.width()) / 2;
            wrapper.css('position','relative');
            img.css({
                'width':'auto',
                'height':'100%',
                'max-width':'none',
                'min-height':0,
                'position':'absolute',
                'top': 0,
                'left': -leftMargin
            })
        });
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

    $('body').addClass('not-mobile');

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

        slider.imagesLoaded(function(){
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
                    var finalWidth = img.width() - 2;
                    $(this).css('width',finalWidth);
                    if($(this).find('figure').length){
                        $(this).find('figure').css('width',finalWidth);
                    }
                }
            });
            if (hash.length > 0 && verif == "pid") {
                owinitSlideShow(slider, hash);

            }
        });
    }


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
