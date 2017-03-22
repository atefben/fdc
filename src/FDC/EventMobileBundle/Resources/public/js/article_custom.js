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
});
