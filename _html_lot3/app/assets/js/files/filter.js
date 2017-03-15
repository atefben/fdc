// Filters
// =========================

var owInitFilter = function (isTabSelection) {

    isTabSelection = isTabSelection || false;
    var homepageItemsFilled = false;
    var isotopeHomepageItems = [];

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
        $('body').on('click', '#filters', function () {
            $('#filters').removeClass('show');
            setTimeout(function () {
                $('#filters').remove();
            }, 700);
        });

    } else {
        if($('.articles-wrapper').length){
            //populate isotope data array on change
            $('.articles-wrapper').bind("DOMSubtreeModified",function(){
                console.log('ajax load');
                $(this).find('.articles').each(function(){
                    var $this = $(this);
                    var grid = $this.find('.isotope-01');
                    $this.find('article').each(function(index,value){
                        console.log(isotopeHomepageItems.indexOf(value));
                        //isotopeHomepageItems.push(value);
                    });
                });
            });
        }
        
        if (!$('.who-filter').length) {


            $('.filters .select span').on('click', function () {

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

                $('#filters span').on('click', function () {
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
                        var activeAppendedGridContainer = $('.articles-wrapper .articles:first-child');
                        $.each(isotopeHomepageItems,function(index,value){
                            if($(value).hasClass(selectedClass) || selectedClass == 'all'){
                                //OK card
                                if(innerIndex < 3){
                                    $('.contain-card .isotope-01').append(value);
                                }else{
                                    if(innerIndex%3 == 0 && innerIndex != 3){
                                        activeAppendedGridContainer = activeAppendedGridContainer.next('.articles');
                                    }
                                    activeAppendedGridContainer.find('.isotope-01').append(value);
                                }
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
                    }
                    var id = $('#filters').data('id'),
                        f = $(this).data('filter');

                    $('#' + id + ' .select span').removeClass('active');
                    $('#' + id + ' .select span[data-filter="' + f + '"]').addClass('active');

                    owInitGrid('filter');
                });


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