$(document).ready(function(){
    // add both webm and mp4 sources for butter iOS support
    $('.thumbnails .owl-item').off('click').on('click', function(e) {
        e.preventDefault();
        $(this).parents('.slideshow').find('.thumb').removeClass('active');

        var i = $(this).index(),
            image = $(this).find('.thumb').data('poster'),
            sources = [],
            $this = $(this),
            sourceAttrs = ['data-webmurl', 'data-mp4url'];
        $.each(sourceAttrs, function (idx, name) {
            if ($this.find('.thumb').attr(name)) {
                sources.push({
                    file: $this.find('.thumb').attr(name)
                });
            }
        });

        jwplayer('player').load({
            image: (typeof image != 'undefined') ? image : "",
            sources: sources
        });

        $this.find('.thumb').addClass('active');
        $this.parents('.slideshow').find('.title-video').html($this.find('.thumb').find('.category').html());
        $this.parents('.slideshow').find('.caption').html($this.find('.thumb').find('.titleLink').html());
        $this.parents('.slideshow-img').find('.images .img').eq(i).addClass('active');
    });
});
