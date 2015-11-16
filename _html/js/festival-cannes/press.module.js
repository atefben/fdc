$(document).ready(function() {

    if($('#mycalendar').length) {

      var maxDate = '2016-05-22';
      var minDate = '2016-05-11';

      if($('#calendar').hasClass('fullwidth')) {
        $('#mycalendar').fullCalendar({
          lang: 'fr',
          defaultDate: '2016-05-11',
          header: {
            left: 'prev',
            center: 'title',
            right: 'next'
          },
          firstDay: 3,
          defaultView: 'agendaWeek',
          minTime: "08:00:00",
          allDaySlot: false,
          events: [
            {
              title: 'orson welles, autopsie d’une légende',
              start: '2016-05-11T08:00:00',
              end: '2016-05-11T10:00:00',
              category: 'séance de reprise',
              director: 'Elisabet KAPNIST',
              linkDirector: '#',
              img: 'http://dummyimage.com/46x64/000/fff',
              duration: '2H',
              venue: 'Grand Théâtre Lumière',
              competition: 'Hors compétition'
            }
          ],
          eventAfterRender: function(event, element, view) {
            $(element).empty();
            $(element).append('<span class="category">' + event.category + '</span>');
            $(element).append('<div class="info"><img src="' + event.img + '" /><div class="txt">' + event.title + '<a href="' + event.linkDirector + '">' + event.director + '</a></div></div>');
          },
          viewRender: function(view){
            if (view.start > maxDate){
              $('#mycalendar').fullCalendar('gotoDate', maxDate);
            }
            if (view.start < minDate){
              $('#mycalendar').fullCalendar('gotoDate', minDate);
            }
          }
        });
      } else {
        $('#mycalendar').fullCalendar({
            lang: 'fr',
            defaultDate: '2016-05-11',
            header: {
              left: 'prev',
              center: 'title',
              right: 'next'
            },
            defaultView: 'agendaDay',
            minTime: "08:00:00",
            allDaySlot: false,
            events: [
              {
                title: 'test',
                start: '2016-05-11T10:30:00',
                end: '2016-05-11T12:30:00'
              }
            ],
            viewRender: function(view){
              if (view.start > maxDate){
                $('#mycalendar').fullCalendar('gotoDate', maxDate);
              }
              if (view.start < minDate){
                $('#mycalendar').fullCalendar('gotoDate', minDate);
              }
            }
          });
        }
      }

});