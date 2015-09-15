jQuery(document).ready(function($) {
    $('[data-form-widget=collection]').each(function () {
        new window.infinite.Collection(this, $(this).siblings('[data-prototype]'));
    });
    
    $('div[id$=_widgets][data-form-widget="collection"').sortable({
        axis: 'y',
        items: '> .fdc-widget',
        start: function(event, ui) {
            // ckeditor
            var textareaId = ui.item.find('textarea').attr('id');
            if (typeof textareaId != 'undefined') {
                var editorInstance = CKEDITOR.instances[textareaId];
                editorInstance.destroy();
                CKEDITOR.remove( textareaId );
            }
        },
        stop: function (event, ui) {
            // ckeditor
            var textareaId = ui.item.find('textarea').attr('id');
            if (typeof textareaId != 'undefined') {
                CKEDITOR.replace( textareaId );
            }
        }
    });
    
    $('form[action*="news"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
});