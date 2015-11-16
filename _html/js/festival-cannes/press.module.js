$(document).ready(function() {

    if($('#mycalendar').length) {

      var maxDate = '2016-05-22';
      var minDate = '2016-05-11';

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

});