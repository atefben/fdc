jQuery(document).ready(function($) {
    // translate event
    jQuery('input[name$="[translate]"]').on('ifChecked', function() {
        jQuery('.form-group[id$="priorityStatus"]').show();
    });

    jQuery('input[name$="[translate]"]').on('ifUnchecked', function() {
        jQuery('.form-group[id$="priorityStatus"]').hide();
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
});