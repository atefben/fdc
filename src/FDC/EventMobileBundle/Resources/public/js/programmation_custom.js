$(document).ready(function(){
    if ($('#timeline-calendar').length > 0) {
        var day = $('.timeline-container').find('.active').data('day');

        var dayEnd = GLOBALS.dateEnd;
        dayEnd = new Date(dayEnd);
        dayEnd = dayEnd.getDate();

        var dayStart = GLOBALS.dateStart;
        dayStart = new Date(dayStart);
        dayStart = dayStart.getDate();

        var $next = $('#timeline-calendar .next'),
            $prev = $('#timeline-calendar .prev')
        ;
        if(day >= dayEnd - 1) {
            $next.addClass('disabled');
        }else{
            $next.removeClass('disabled');
        }

        if(day <= dayStart + 1) {
            $prev.addClass('disabled');
        }else{
            $prev.removeClass('disabled');
        }

        // we get the original jQuery addClass function
        var originalAddClassMethod = jQuery.fn.addClass;

        // and modify it to trigger a custom event
        jQuery.fn.addClass = function(){
            // Execute the original method.
            var result = originalAddClassMethod.apply( this, arguments );

            // trigger a custom event
            jQuery(this).trigger('cssClassChanged');

            // return the original result
            return result;
        };

        $('#timeline a').on('cssClassChanged', function () {
            if ($(this).hasClass('active')) {
                var day =  $(this).data('day');

                if(day <= dayStart) {
                    $prev.addClass('disabled');
                }else{
                    $prev.removeClass('disabled');
                }

                if(day == dayEnd) {
                    $next.addClass('disabled');
                }else{
                    $next.removeClass('disabled');
                }
            }
        });
    }
});
