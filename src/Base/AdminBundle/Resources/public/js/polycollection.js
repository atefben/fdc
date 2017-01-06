jQuery(document).ready(function($) {
    // infinite collection construct
    $('[data-form-widget=collection]').each(function () {
        new window.infinite.Collection(this, $(this).siblings('[data-prototype]'));
    });

    var config = null;
   // infinite collection sortable

    if ($('body').hasClass('role_translator') == false) {
        $('div[class$="fdc-widgets"][data-form-widget="collection"]').sortable({
            axis: 'y',
            items: '> .base-widget',
            start: function (event, ui) {
                // ckeditor
                var textareaId = ui.item.find('textarea.ckeditor').attr('id');
                if (typeof textareaId != 'undefined') {
                    var editorInstance = CKEDITOR.instances[textareaId];
                    config = editorInstance.config;
                    editorInstance.destroy();
                    CKEDITOR.remove(textareaId);
                }
            },
            stop: function (event, ui) {
                // ckeditor
                var textareaId = ui.item.find('textarea.ckeditor').attr('id');
                if (typeof textareaId != 'undefined') {
                    CKEDITOR.replace(textareaId, config);
                }
            }
        });
    }

    // refresh input position value
    $('form[action*="news"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });

    $('form[action*="statement"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });

    $('form[action*="info"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="pressguide"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="fdcpageprepare"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="fdcpageparticipatesection"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="pressdownloadsection"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="fdcpagelaselectioncannesclassics"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="orange"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="event"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="corpowhoarewe"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="corpoteamdepartements"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="corpoteamteams"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="corpoteam"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="corpofestivalhistory"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="corpopalmeor"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });

    $('form[action*="filmfestival"]').submit(function() {
      var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });

    $('form[action*="service"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });

    $('form[action*="mdfeditionpresentation"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="accreditation"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="dispatchdeservice"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfeditionprojections"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfindustryprogramhome"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfwhoarewehistory"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
});
