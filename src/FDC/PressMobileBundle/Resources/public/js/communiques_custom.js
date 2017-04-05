$(document).ready(function () {
    $('.read-more').off('click').on('click', function(e) {
        e.preventDefault();
        $(this).hide();

        $.ajax({
            type: "GET",
            dataType: "html",
            cache: false,
            data: {
                offset: $(this).attr('data-offset')
            },
            url: GLOBALS.urls.loadPressReleaseUrl,
            success: function(data) {
                $('#list-articles').append(data);
            }
        });
    });
});
