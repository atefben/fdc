$(document).ready(function () {
    $('.item-video').off('click').on('click',function(e) {
        e.preventDefault();
        var $this = $(this),
            sources = [],
            sourceAttrs = ['data-webmurl', 'data-mp4url'],
            $fullscreenplayer = $('.fullscreenplayer')
            ;

        setTimeout(function() {
            $fullscreenplayer.addClass('show');
            $('body').addClass('allow-landscape');
        }, 200);

        $.each(sourceAttrs, function (idx, name) {
            $this.attr(name) ? sources.push({ file: $this.attr(name) }) : null;
        });

        if($("#player1").length !== 0) {
            playerInstance = jwplayer("player1");
            playerInstance.setup({
                image        : $this.data('poster'),
                width        : "100%",
                aspectratio  : "16:9",
                displaytitle : false,
                mediaid      : '123456',
                skin         : {
                    name : "five"
                },
                sources: sources
            });
        }

        $fullscreenplayer.find('.category').html($(this).find('.category').html());
        $fullscreenplayer.find('.title-video').html($(this).find('.titleLink').html());
        $fullscreenplayer.find('.date').html($(this).find('.titleLink').attr('data-date'));
    });
});
