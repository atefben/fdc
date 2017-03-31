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
