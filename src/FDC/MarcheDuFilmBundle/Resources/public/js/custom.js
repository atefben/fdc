$(document).ready(function() {
    initNewsPage();
    initNews();
    initPagination();
    setNews();
    initGlobalEvents();
    loadRetombeesPress();
    loadConferenceNewsArticles();

    $("#owl-demo").owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true

        // "singleItem:true" is a shortcut for:
        // items : 1,
        // itemsDesktop : false,
        // itemsDesktopSmall : false,
        // itemsTablet: false,
        // itemsMobile : false

    });
});

var el = [];
var filtersData = ['all'];
var pageLimit = 9;
var paginationLimit = 4;
var pageIndex = 0;

function initNews() {
    pageIndex = 0;
    getNews();
}

function setNews() {
    $('.marketnewsBtn').click(function() {

    var identification = $(this).attr('id');
    var attr = $(this).attr("rel");


    if($(this).hasClass('purpleBtn')) {

        $(this).removeClass('purpleBtn');

        var index = el.indexOf(identification);
        if (index > -1) {
            el.splice(index, 1);
        }
        var indexRel = el.indexOf(attr);
        if (indexRel > -1) {
            el.splice(indexRel, 1);
        }
        var indexFilterRel = filtersData.indexOf(identification);
        if (indexFilterRel > -1) {
            filtersData.splice(indexFilterRel, 1);
        }

        $.ajax({
            url: Routing.generate('fdc_marche_du_film_get_news'),
            type: "POST",
            cache: false,
            data: {
              filtersData: JSON.stringify(filtersData)
            },
            success: function(data, textStatus, xhr) {
                $('#news-html').html($(data).find("#news-html").html());
                $('.paginationContainer').html($(data).find(".paginationContainer").html());
                initNews();
                initPagination();

                $('#' + attr).hide();

                if (this.id == 'all' || el.length < 1 ) {
                    $('.parent > div').fadeOut(200);
                    $('#empty-news-list').hide();
                    $('#no-filter-news').show();
                    $('.selectText').hide();

                } else if (this.id == 'all') {
                    $('.selectText').hide();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
              console.log(errorThrown);
            }
        });
    } else {
        $(this).addClass('purpleBtn');
        el.push(identification);
        el.push(attr);
        filtersData.push(identification);

        if (this.id == 'all') {
            $.ajax({
                url: Routing.generate('fdc_marche_du_film_get_news'),
                type: "POST",
                cache: false,
                data: {
                    filtersData: JSON.stringify(['all'])
                },
                    success: function(data, textStatus, xhr) {
                    $('#news-html').html($(data).find("#news-html").html());
                    $('.paginationContainer').html($(data).find(".paginationContainer").html());
                    initNews();
                    initPagination();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });

            $('.parent > div').fadeIn(200);
            $('.selectText').hide();
            $('.selectText').addClass('hideAll');
            $('#showAll').show();
            $('.message').empty();
            $(this).addClass('purpleBtn');
            $(this).siblings().removeClass('purpleBtn');
            $('.events').removeClass('hideContent');
            el = [];
            filtersData = [];
            filtersData.push('all');
        } else if (el){
            var indexFilter = filtersData.indexOf('all');
            if (indexFilter > -1) {
                filtersData.splice(indexFilter, 1);
            }

            $.ajax({
                url: Routing.generate('fdc_marche_du_film_get_news'),
                type: "POST",
                cache: false,
                data: {
                    filtersData: JSON.stringify(filtersData)
                },
                success: function(data, textStatus, xhr) {
                    $('#news-html').html($(data).find("#news-html").html());
                    $('.paginationContainer').html($(data).find(".paginationContainer").html());
                    initNews();
                    initPagination();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });

            $('.selectText').hide();
            $.each(el, function(i, val) {
                $('.' + val).show();
                $('.' + val).removeClass('hideContent');
                $('#all').removeClass('purpleBtn');
                $('#' + val).show();
                if ($(identification) != val) {
                $("." + identification).addClass('hideContent');
                }
            });
            $('#' + attr).show();
        }
    }
    });

    $(document).on('click', '.fifth',function() {
        $(".fifth").each(function (index, element) {
          $(this).removeClass('pagination-active');
        });
        $("html, body").animate({ scrollTop: $('.marketTitle').offset().top });
        $(this).addClass('pagination-active');
        pageIndex = parseInt($(this).attr('id'));
        setPaginationTabs();
        getNews();
    });

    $(document).on('click', '#paginationNavLeft',function() {
        if (pageIndex != 0) {
            $(".fifth").each(function (index, element) {
                $(this).removeClass('pagination-active');
                if (parseInt($(this).attr('id')) == pageIndex - 1) {
                  $("html, body").animate({ scrollTop: $('.marketTitle').offset().top });
                  $(this).removeClass('pagination-active');
                  $(this).addClass('pagination-active');
                }
            });
            pageIndex = pageIndex - 1;
            setPaginationTabs();
            getNews();
        }
    });

    $(document).on('click', '#paginationNavRight',function() {
        var pagesLength = $('div.fifth').length;

        if (pageIndex < pagesLength - 1) {
            $(".fifth").each(function (index, element) {
            $(this).removeClass('pagination-active');
            if (parseInt($(this).attr('id')) == pageIndex + 1) {
              $("html, body").animate({ scrollTop: $('.marketTitle').offset().top });
              $(this).removeClass('pagination-active');
              $(this).addClass('pagination-active');
            }
            })
            pageIndex = pageIndex + 1;
            setPaginationTabs();
            getNews();
        }
    });
}

function initPagination() {
    $(".fifth").each(function (index, element) {
        if ($(this).attr('id') > paginationLimit - 1) {
            $(this).hide();
        }
        if ($(this).attr('id') == 0) {
            $(this).addClass('pagination-active');
            $('#paginationNavLeft').addClass('arrow-inactive');
        }
    });
}

function initNewsPage() {
    $('.dropdown').children().click(function() {
        $('.dropArrow').toggleClass('dropArrowOpen');
        $('#eventSelector').toggleClass("showeventSelector");
        $('.marketnewsSelector').toggleClass("showmarketnewsSelector");
    });
}

function getNews() {
    $(".global-news").each(function(index, element) {
        if (!($(this).data('index') >= pageIndex * pageLimit && $(this).data('index') < (pageIndex * pageLimit) + pageLimit)) {
            $(this).hide();
        } else {
            $(this).show();
        }
    });
}

function setPaginationTabs() {
    var pagesLength = $('div.fifth').length;
    $('#paginationNavLeft').removeClass('arrow-inactive');
    $('#paginationNavRight').removeClass('arrow-inactive');

    $(".fifth").each(function (index, element) {
        console.log(pagesLength - 1 ,pageIndex)

        if (pageIndex == 0) {
            $('#paginationNavLeft').addClass('arrow-inactive');
            if (($(this).attr('id') > pageIndex + 3)) {
                $(this).hide();
            } else {
                $(this).show();
            }
        } else if (pageIndex == pagesLength - 1) {
            $('#paginationNavRight').addClass('arrow-inactive');
            if (($(this).attr('id') > pageIndex + 1 || $(this).attr('id') < pageIndex - 3)) {
                $(this).hide();
            } else {
                $(this).show();
            }
        } else if (pageIndex == 2) {
            if (($(this).attr('id') > pageIndex + 1 || $(this).attr('id') < pageIndex - 2)) {
                $(this).hide();
            } else {
                $(this).show();
            }
        } else if (pageIndex == 1) {
            if (($(this).attr('id') > pageIndex + 2 || $(this).attr('id') < pageIndex - 2)) {
                $(this).hide();
            } else {
                $(this).show();
            }
        } else {
            if (($(this).attr('id') > pageIndex + 1 || $(this).attr('id') < pageIndex - 2)) {
                $(this).hide();
            } else {
                $(this).show();
            }
        }

        $(this).addClass('fifth-inactive-border');
        $(this).removeClass('fifth-active-border');
    });

    $('.fifth:visible:first').removeClass('fifth-inactive-border');
    $('.fifth:visible:first').addClass('fifth-active-border');
}

/** Open accordion depending on day **/
function initGlobalEvents() {
    var currentDay = new Date($.now());
    var currentDayString = currentDay.getDate() + '-' + (((currentDay.getMonth().length+1) === 1) ? (currentDay.getMonth()+1) : '0' + (currentDay.getMonth()+1)) + '-' + currentDay.getFullYear();

    if (typeof $("div[data-date='" + currentDayString + "']") != 'undefined') {
        $("div[data-date='" + currentDayString + "']").trigger('click');
    }
}

/** Load press articles **/
function loadRetombeesPress() {
    $('#load-more-retombee-articles').on('click', function (e){
        var currentArticles = $('.articles').length;

        var me = $(this);
        e.preventDefault();
        if ( me.data('requestRunning') ) {
            return;
        }
        me.data('requestRunning', true);

        $.ajax({
            url: Routing.generate('fdc_marche_du_film_press_coverage'),
            type: "POST",
            cache: false,
            data: {
                numberOfArticles: currentArticles
            },
            success: function(data, textStatus, xhr) {
                me.data('requestRunning', false);

                $(data).insertAfter($('.articles').last());

                var nrOfDisplayedArticles = $('.articles').length;
                var totalNrOfArticles = parseInt($('.nrOfArticles').text());

                if(nrOfDisplayedArticles == totalNrOfArticles) {
                    $('#load-more-retombee-articles').remove();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    })
}

function loadConferenceNewsArticles() {
    $('#load-more-conference-articles').on('click', function (){
        var currentArticles = $('.articles').length;
        var that = $(this);

        $.ajax({
            url: Routing.generate('fdc_marche_du_film_conference_news', { slug: that.data('slug')}),
            type: "POST",
            cache: false,
            data: {
                numberOfArticles: currentArticles,
                slug: that.data('slug'),
            },
            success: function(data, textStatus, xhr) {
                if ($(data).find('.articles').length < 9) {
                    $('#load-more-conference-articles').remove();
                }
                $(data).insertAfter($('.articles').last().parent());
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    })
}
