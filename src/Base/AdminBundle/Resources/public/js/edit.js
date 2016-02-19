jQuery(document).ready(function($) {
    editEvents();

    // on modal add, reload function
    $(window).on('shown.bs.modal', function() {
        if ($('.modal[aria-hidden="false"]').find('form[action*="create"]').length) {
            editEvents();
        }
    });
});

function editEvents() {
    // translate event on load
    if ($('input[name$="[translate]"]').is(':checked')) {
        $('.form-group[id$="priorityStatus"]').show();
        $('ul[id$="translateOptions"]').show();
    } else {
        $('.form-group[id$="priorityStatus"]').hide();
        $('ul[id$="translateOptions"]').hide();
    }

    // translate event on click
    $('input[name$="[translate]"]').on('ifChanged', function() {
        if (!$(this).is(':checked')) {
            $('.form-group[id$="priorityStatus"]').hide();
            $('ul[id$="translateOptions"]').hide();
        } else {
            $('.form-group[id$="priorityStatus"]').show();
            $('ul[id$="translateOptions"]').show();
        }
    });

    // remove select2 status option for each language
    $('select[name*="status"]').each(function(i, e) {
        var idArray = $(e).attr('id').split('_');
        var locale = idArray[idArray.length - 2];
        var status = ['0', '1', '4', '6'];

        if (locale != 'fr') {
            var status = ['0', '2', '3', '5'];
        }

        $(e).find('option').each(function(i, e) {
            if ($.inArray($(e).val(), status) == -1) {
                $(e).remove();
            }
        });
    });

    // add border on changing lang
    $('body').on('click', '.a2lix_translationsLocales li', function() {
        $('.a2lix_translationsLocales li').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
    });

    // Hide the status for french translation
    if ($('.status-hidden').length) {
        $('.status-hidden select').val(1).change();
        $('.status-hidden').hide();
    }
}