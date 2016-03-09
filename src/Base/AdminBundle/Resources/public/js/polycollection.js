jQuery(document).ready(function($) {
    // infinite collection construct
    $('[data-form-widget=collection]').each(function () {
        new window.infinite.Collection(this, $(this).siblings('[data-prototype]'));
    });

    var config = null;
   // infinite collection sortable
   $('div[class$="fdc-widgets"][data-form-widget="collection"]').sortable({
        axis: 'y',
        items: '> .base-widget',
        start: function(event, ui) {
            // ckeditor
            var textareaId = ui.item.find('textarea.ckeditor').attr('id');
            if (typeof textareaId != 'undefined') {
                var editorInstance = CKEDITOR.instances[textareaId];
                config = editorInstance.config;
                editorInstance.destroy();
                CKEDITOR.remove( textareaId );
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

    // refresh input position value
    $('form[action*="news"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
});