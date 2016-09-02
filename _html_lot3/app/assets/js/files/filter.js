// Filters
// =========================

var owInitFilter = function (isTabSelection) {

    isTabSelection = isTabSelection || false;

    // on click on a filter
    if (isTabSelection) {

        $('.tab-selection .selection').on('click', function(e){

            e.preventDefault();

            var block = $(this).parent().attr('id');
            console.log(block);
            var h = $(this).parent().find('.select-span').html();

            console.log(h);

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

                console.log(selected);

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
        $('body').on('click', '.filters .select span', function () {
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

        });

        // close filters
        $('body').on('click', '#filters', function () {
            $('#filters').removeClass('show');
            setTimeout(function () {
                $('#filters').remove();
            }, 700);
        });

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