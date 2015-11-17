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
            $(element).append('<div class="bottom">' + event.duration + ' - ' + event.venue.toUpperCase() + '<span>' + event.competition + '</span></div>');
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
            droppable: true,
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
              $(element).append('<div class="bottom">' + event.duration + ' - ' + event.venue.toUpperCase() + '<span>' + event.competition + '</span></div>');
            },
            viewRender: function(view){
              if (view.start > maxDate){
                $('#mycalendar').fullCalendar('gotoDate', maxDate);
              }
              if (view.start < minDate){
                $('#mycalendar').fullCalendar('gotoDate', minDate);
              }
            },
            drop: function(date) {
      
              // retrieve the dropped element's stored Event Object
              var originalEventObject = $(this).data('eventObject');
              
              // we need to copy it, so that multiple events don't have a reference to the same object
              var copiedEventObject = $.extend({}, originalEventObject);
              
              // assign it the date that was reported
              copiedEventObject.start = date;
              
              // render the event on the calendar
              // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
              $('#mycalendar').fullCalendar('renderEvent', copiedEventObject, true);
              
              // is the "remove after drop" checkbox checked?
              // if ($('#drop-remove').is(':checked')) {
              //   // if so, remove the element from the "Draggable Events" list
              //   $(this).remove();
              // }
              
            }
          });

          if($('#calendar-programmation').length) {
            $('#calendar-programmation .fc-event').each(function() {
    
            var eventObject = {
              title: $.trim($(this).text())
            };
            
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            
            // make the event draggable using jQuery UI
            $(this).draggable({
              zIndex: 999,
              revert: true,      // will cause the event to go back to its
              revertDuration: 0  //  original position after the drag
            });
            
          });
          }
        }
      }

});