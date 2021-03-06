// Filters
// =========================

var owInitFilter = function (isTabSelection) {

    isTabSelection = isTabSelection || false;

    // on click on a filter
    if (isTabSelection) {

        $('.tab-selection .selection').on('click', function(e){

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
                var selected = $('#'+block+' .select option[value="'+data+'"]');
                selected.attr('selected','selected');
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

        if(!$('.who-filter').length){

            $('.filters .select span').on('click', function () {

                $('.filter .select').each(function() {
                    $that = $(this);
                    $id   = $(this).closest('.filter').attr('id');

                    $that.find("span:not(.active):not([data-filter='all'])").each(function() {
                        $this = $(this);

                        var getVal = $this.data('filter');
                        var numItems = $('.item[data-'+$id+'="'+getVal+'"]:not([style*="display: none"]').length;

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

        }else{


            $('.filters .select span').off('click').on('click', function () {

                $('.filter .select').each(function() {
                    $that = $(this);
                    $id   = $(this).closest('.filter').attr('id');

                    $that.find(".pages:not([data-filter='all'])").each(function() {
                        $this = $(this);

                        console.log($this);

                        var getVal = $this.data('filter');
                        var numItems = $('.item[data-'+$id+'="'+getVal+'"]:not([style*="display: none"]').length;

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

                    $('.pages:not(.'+f+')').css('display','none');
                    $('.pages.'+f).css('display','block');
                    console.log(f);
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
        $(this).parent().remove();


        if (!$('.new-filter ul li').length) {
            $('.new-filter').parent().remove();
        }

    });
}

var addNextFilters = function () {
    $('.filters-02 li.more').on('click', function (e) {
        e.preventDefault();

        $(this).remove();

        var url = $(this).attr("data-url");

        $.get(url, function (data) {
            $('.c-filters').append(data);

            $('.filters-02 li.more').off('click');
            $('.filters-02 li .icon-close').off('click');

            owRemoveElementListe();
            addNextFilters();
            owInitNavSticky(3);
        });
    });
}


var owInitFilterSearch = function () {
    var block = $('.block-searh-more');

    $('.result-more').on('click', function (e) {
        e.preventDefault();

        block.toggleClass('visible');
    })
}