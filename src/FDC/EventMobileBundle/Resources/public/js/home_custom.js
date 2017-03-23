$(document).ready(function () {

    var dayEnd = GLOBALS.dateEnd;
    dayEnd = new Date(dayEnd);
    dayEnd = dayEnd.getDate();

    var dayStart = GLOBALS.dateStart;
    dayStart = new Date(dayStart);
    dayStart = dayStart.getDate();

    $('#news #calendar .next').off('click').on('click', function(e) {
        e.preventDefault();

        var day    = $('.timeline-container').find('.active').data('date'),
            numDay = 0;

        $('#calendar .prev').removeClass('disabled');

        if(day >= dayEnd - 1) {
            $('#calendar .next').addClass('disabled');
        }else{
            $('#calendar .next').removeClass('disabled');
        }

        if(day == dayEnd || $('.timeline-container').find("[data-date='" + (day + 1) + "']").hasClass('disabled')) {
            return false;

        } else {
            moveTimeline($('.timeline-container').find("[data-date='" + (day + 1) + "']"),day+1);
        }
    });
    $('#timeline a').off('click').on('click', function(e) {
        e.preventDefault();

        var day =  $(this).data('date');

        if($(this).hasClass('active') || $(this).hasClass('disabled')) {
            return false;
        }

        if(day <= dayStart) {
            $('#calendar .prev').addClass('disabled');
        }else{
            $('#calendar .prev').removeClass('disabled');
        }

        if(day == dayEnd) {
            $('#calendar .next').addClass('disabled');
        }else{
            $('#calendar .next').removeClass('disabled');
        }

        $('.nd').html(day);

        moveTimeline($(this), $(this).data('date'));
    });
});
