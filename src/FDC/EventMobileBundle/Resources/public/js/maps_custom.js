$(document).ready(function () {
    $('.popin-plan').click(function(e) {
        $('#popin-participate-' + $(this).attr('data-id')).show();
        $('.ov').addClass('show');
    });

    $('.ov').click(function() {
        $('.popin-plan-div').hide();
        $('.ov').removeClass('show');
    });
});
