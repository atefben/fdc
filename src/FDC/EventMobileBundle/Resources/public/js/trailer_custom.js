$(document).ready(function(){
    if($('.ba').length || $('.channel').length) {
        var first = $(".thumbnails .thumb").first();
        first.parents('.slideshow').find('.time').text(first.attr('data-time'));
    }

    $('.thumbnails .owl-item').on('click', function(e) {
        e.preventDefault();

        $(this).parents('.slideshow').find('.time').text($(this).find('.thumb').attr('data-time'));
    });
});
