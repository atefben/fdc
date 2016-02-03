jQuery(document).ready(function($) {
    // translate event
    $('input[name$="[translate]"]').on('ifChecked', function() {
        $('.form-group[id$="priorityStatus"]').show();
    });

    $('input[name$="[translate]"]').on('ifUnchecked', function() {
        $('.form-group[id$="priorityStatus"]').hide();
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

    // Hide the status for french translation
    if ($('.status-hidden').length) {
        $('.status-hidden select').val(1).change();
        $('.status-hidden').hide();
    }
});