jQuery(document).ready(function($) {
    $('[data-form-widget=collection]').each(function () {
        new window.infinite.Collection(this, $(this).siblings('[data-prototype]'));
    });
    
    $('div[id$=_widgets]').sortable({
        axis: 'y'
    });
});