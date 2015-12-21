jQuery(document).ready(function($) {
    // translate event
    jQuery('input[name$="[translate]"]').on('ifChecked', function() {
        jQuery('.form-group[id$="priorityStatus"]').show();
    });

    jQuery('input[name$="[translate]"]').on('ifUnchecked', function() {
        jQuery('.form-group[id$="priorityStatus"]').hide();
    });
});