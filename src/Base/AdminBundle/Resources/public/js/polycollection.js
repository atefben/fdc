jQuery(document).ready(function($) {
    $('[data-form-widget=collection]').each(function () {
        new window.infinite.Collection(this, $(this).siblings('[data-prototype]'));
    });
    
    $('div[id$="fdc-widgets"][data-form-widget="collection"]').sortable({
        axis: 'y',
        items: '> .base-widget',
        start: function(event, ui) {
            // ckeditor
            var textareaId = ui.item.find('textarea.ckeditor').attr('id');
            console.log(textareaId);
            if (typeof textareaId != 'undefined') {
                var editorInstance = CKEDITOR.instances[textareaId];
                editorInstance.destroy();
                CKEDITOR.remove( textareaId );
            }
        },
        stop: function (event, ui) {
            // ckeditor
            var textareaId = ui.item.find('textarea.ckeditor').attr('id');
            if (typeof textareaId != 'undefined') {
                console.log('c');
                CKEDITOR.replace( textareaId );
            }
        }
    });
    
    $('form[action*="news"]').submit(function(e) {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
});