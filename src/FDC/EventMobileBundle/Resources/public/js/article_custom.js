$(document).ready(function(){
    if($('.players2').length !== 0) {

        $('.players2').each(function (i, e) {
            var $e = $(e),
                playerInstance = jwplayer($e.attr('id')),
                sources = [],
                sourceAttrs = ['data-webmurl', 'data-mp4url']
            ;
            $.each(sourceAttrs, function (idx, name) {
                if ($e.attr(name)) {
                    sources.push({
                        file: $e.attr(name)
                    });
                }
            });
            playerInstance.setup({
                image: $e.data('poster'),
                width: "100%",
                aspectratio: "16:9",
                displaytitle: false,
                skin: {
                    name: "five"
                },
                sources: sources
            });
        });
    }
    if($('.chocolat-image').length > 0) {
        

        $('.chocolat-image').on('click', function(e){
            e.preventDefault();

            var $this = $(this);

            var src = $this.attr('href');


            $('body').append('<div class="diapoFullscreen"></div>');

            var diapoFullscreen = $('body').find('.diapoFullscreen');

            $.each($(this).closest('.slideshow').find('.chocolat-image'), function (i, e) {
                src = $(e).attr('href');
                diapoFullscreen.append('<img src="' + src +
                    '" alt="photo" class="item">' +
                    '</div>' );
            });

            var diapo = diapoFullscreen.owlCarousel({
                nav: false,
                dots: false,
                smartSpeed: 500,
                margin: 0,
                loop: false,
                items: 1
            });

            var index = $this.parent().index(); // a revoir

            diapo.trigger('to.owl.carousel', [index, 2, true]);

            $('body').addClass('no-scroll');

            diapoFullscreen.append('<div class="close-button"><i class="icon icon_close"></i></div>');


            var btnClose = diapoFullscreen.find('.close-button');

            btnClose.on('click', function(e){
                diapoFullscreen.remove();
                $('body').removeClass('no-scroll');
            });


            return false;

        })
    }
});
