jQuery(document).ready(function($) {
    // translate event
    if ($('input[name$="[translate]"]').is(':checked')) {
        $('.form-group[id$="priorityStatus"]').show();
        $('ul[id$="translateOptions"]').show();
    } else {
        $('.form-group[id$="priorityStatus"]').hide();
        $('ul[id$="translateOptions"]').hide();
    }

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

    // add border on changing lang ta
    $('.a2lix_translationsLocales li').click(function() {
        $('.a2lix_translationsLocales li').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
    });

    // Hide the status for french translation
    if ($('.status-hidden').length) {
        $('.status-hidden select').val(1).change();
        $('.status-hidden').hide();
    }
});