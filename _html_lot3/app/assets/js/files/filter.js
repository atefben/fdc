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
            console.log('scroll 1');
            $('html').addClass('noscroll');
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
                console.log('filter click, debug toggle items');
                var data = $(this).data('select');
                var selected = $('#' + block + ' .select option[value="' + data + '"]');
                selected.attr('selected', 'selected');
            });

        });

        // close filters
        $('body').off('click').on('click', '#filters', function () {
            console.log('scroll 2');
            $('html').removeClass('noscroll');
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
                    console.log('scroll 3');
                    $('html').addClass('noscroll');
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
                        $('#filters span').off('click').on('click', function(){
                            var id = $('#filters').data('id'),
                                f = $(this).data('filter');

                            $('#' + id + ' .select span').removeClass('active');
                            $('#' + id + ' .select span[data-filter="' + f + '"]').addClass('active');

                            owInitGrid('filter');
                            var grid;

                            /*var i = window.setTimeout(function(){
                                console.log('bigging');
                                owsetGridBigImg( grid, $('.grid-01'), false);
                            },1000);*/
                            

                            fnArraySortFilters();
                        });
                    }
                    fnArraySortFilters();

                    // close filters
                    $('body').off('click').on('click', '#filters', function () {
                        console.log('scroll 4');
                        $('html').removeClass('noscroll');
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
                    $('body').off('click').on('click', '#filters', function () {
                        console.log('scroll 5');
                        $('html').removeClass('noscroll');
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