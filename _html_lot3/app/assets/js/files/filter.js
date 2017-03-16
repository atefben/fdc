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
        if($('.articles-wrapper').length){
            var lock = false;
            //populate isotope data array on change
            $('.articles-wrapper').bind("DOMSubtreeModified",function(){
                if(!lock){
                    lock = true;
                    $(this).find('.articles').each(function(){
                        var $this = $(this);
                        var grid = $this.find('.isotope-01');
                        $this.find('article').each(function(index,value){
                            if(!$.inArray(value,isotopeHomepageItems)){
                                isotopeHomepageItems.push(value);
                            }
                            console.log($.inArray(value,isotopeHomepageItems));
                        });
                    });
                }

            });
            var lockInterval = window.setInterval(function(){
                lock = false;
            },1000);
        }
        
        if (!$('.who-filter').length) {

            $('.filters .select span').off('click').on('click', function () {
                $('.filter .select').each(function () {
                    $that = $(this);
                    $id = $(this).closest('.filter').attr('id');

                    $that.find("span:not(.active):not([data-filter='all'])").each(function () {
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
                                console.log(isotopeHomepageItems);
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
                                        console.log(activeAppendedGridContainer);

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