var initContact = function () {
    $('.contact input[type="text"], textarea').on('input', function() {
        var input = $(this);
        var is_name = input.val();
        if(is_name){
            input.removeClass("invalid").addClass("valid");
            $('.errors .' + input.attr('name')).remove();
        }
        else{
            input.removeClass("valid").addClass("invalid");
            $('.errors .' + input.attr('name')).remove();
            $('.errors ul').append('<li class="' + input.attr('name') + '">' + input.data('error') + '</li>');
        }

        if($('.invalid').length) {
            $('.errors').addClass('show');
        } else {
            $('.errors').removeClass('show');
        }
    });

    $('#triggerSelect').on('click', function(e) {
        e.preventDefault();

        var h = '';

        $('.select option').not('.default').each(function() {
            h += '<span data-select="' + $(this).val() + '">' + $(this).html() + '</span>';
        });

        $('#filters').remove();
        $('body').append('<div id="filters" class="selectOptions"><div class="vCenter"><div class="vCenterKid"></div></div><div class="close-button"><i class="icon icon-close"></i></div></div>');
        $('#filters .vCenterKid').html(h);

        setTimeout(function() {
            $('#filters').addClass('show');
        }, 100);

        setTimeout(function() {
            $('#filters span').addClass('show');
        }, 400);
    });


    if($('.select option:selected').length){
        var textSelectValue = $('.select option:selected').text();
    }else{
        var textSelectValue = $('.select select option.default').text();
    }
    console.log(textSelectValue);
    
    //init value
    $('.select .select-value .val').html(textSelectValue);
    $('body').on('click', '.selectOptions span', function() {
        var i = parseInt($(this).index()) + 1;
        $('select option').eq(i).prop('selected', 'selected');
        $('.select .select-value .val').html($(this).text());
        $('.select').removeClass('invalid');
        $clamp($('.select .select-value .val').get(0), {clamp: 1});
    });

    // check valid email address
    $('.contact input[type="email"]').on('input', function() {
        var input=$(this);
        var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        var is_email=re.test(input.val());
        if(is_email){
            input.removeClass("invalid").addClass("valid");
            $('.errors .' + input.attr('name')).remove();
        }
        else{
            input.removeClass("valid").addClass("invalid");
            $('.errors .' + input.attr('name')).remove();
            $('.errors ul').append('<li class="' + input.attr('name') + '">' + input.data('error') + '</li>');
        }

        if($('.invalid').length) {
            $('.errors').addClass('show');
        } else {
            $('.errors').removeClass('show');
        }
    });

    // on submit : check if there are errors in the form
    $('.contact form').on('submit', function() {
        var empty = false;

        if($('select').val() == 'default') {
            $('.select').addClass('invalid');
        } else {
            $('.select').removeClass('invalid');
        }

        $('.contact input[type="text"], .contact input[type="email"], .contact textarea').each(function() {
            if($(this).val() == '') empty = true;
        });

        if(empty) {
            $('.contact input[type="email"], .contact input[type="text"], textarea').trigger('input');
        }

        if($('.invalid').length || empty) {
            return false;
        }
    });

    // filter data on page
    $('body').on('click', '#filters span', function() {
        var id = $('#filters').data('id'),
            f  = $(this).data('filter');

        $('#' + id + ' .select span').removeClass('active');
        $('#' + id + ' .select span[data-filter="'+f+'"]').addClass('active');

        filter();

    });

    // close filters
    $('body').on('click', '#filters', function() {
        $('#filters').removeClass('show');
        setTimeout(function() {
            $('#filters').remove();
        }, 700);
    });

    function filter() {
        var id = $('#filters').data('id');
        var filters = [];

        $('.filter').each(function() {
            var $that = $(this);
            var a = $that.find('.select span.active').data('filter');

            if(a == 'all') {
                $('.content-news .slideshow').show();
                return;
            }

            var obj = {'filter': $that.attr('id'), 'value': a};

            filters.push(obj);
        });

        var exp1 = '',
            exp2 = '';

        for(var i=0; i<filters.length; i++) {
            exp1 += '[data-' + filters[i].filter + ']';
            exp2 += '[data-' + filters[i].filter + '="' + filters[i].value + '"]';
        }

        if(filters.length != 0) {
            $('*' + exp1).hide();
            $('*' + exp2).show();

        } else {
            $('*[data-' + id + ']').show();
            if($('.articles').length != 0) {
                $('.filter .select span').removeClass('disabled');
            }
        }
    }
}