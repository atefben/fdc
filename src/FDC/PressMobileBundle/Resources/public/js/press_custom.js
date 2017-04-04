$(document).ready(function() {
    $(".service-presse").on("click", function (a) {
        a.preventDefault(),
            $("html, body").animate({
                scrollTop: $(".contact").offset().top - 230
            }, 500)
    });
});