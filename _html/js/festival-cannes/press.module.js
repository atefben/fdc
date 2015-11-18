$(document).ready(function() {

  var events = [];

  // get local storage
  var agenda = localStorage.getItem('agenda_press');

  if(agenda != null) {
    events = JSON.parse(agenda);
  }

    if($('#mycalendar').length) {

      var maxDate = '22';
      var minDate = '11';

      if($('#calendar').hasClass('fullwidth')) {
        $('#mycalendar').fullCalendar({
          lang: 'fr',
          defaultDate: '2016-05-12',
          header: {
            left: 'prev',
            center: 'title',
            right: 'next'
          },
          firstDay: 3,
          defaultView: 'agendaWeek',
          minTime: "08:00:00",
          allDaySlot: false,
          events: events,
          eventAfterRender: function(event, element, view) {
            if(event.duration/60 == 1) {
              $(element).addClass('one-hour');
            }
            var dur = event.duration/60 + 'H';
            var c = event.eventColor;
            $(element).empty();
            $(element).addClass(event.eventPictogram);
            $(element).attr('data-id', event.id);
            $(element).empty();
            $(element).append('<span class="category" style="background-color:' + c + '">' + event.type + '<a href="#"></a></span>');
            $(element).append('<div class="info"><img src="' + event.picture + '" /><div class="txt"><span>' + event.title + '</span><strong>' + event.author + '</strong></div></div>');
            $(element).append('<div class="bottom"><span class="duration">' + dur + '</span> - <span class="ven">' + event.room.toUpperCase() + '</span><span class="competition">' + event.selection + '</span></div>');
          },
          viewRender: function(view){
            
          }
        });
      } else {
        if(!$.cookie('drag')) {
          $('#calendar-wrapper').addClass('drag');
        }

        $('.drag a').on('click', function() {
          $('#calendar-wrapper').removeClass('drag');
          $.cookie('drag', '1', { expires: 365 });
        });

        $('#mycalendar').fullCalendar({
            lang: 'fr',
            defaultDate: '2016-05-12',
            header: {
              left: 'prev',
              center: 'title',
              right: 'next'
            },
            defaultView: 'agendaDay',
            minTime: "08:00:00",
            allDaySlot: false,
            droppable: true,
            selectOverlap: false,
            events: events,
            eventAfterRender: function(event, element, view) {
              if(event.duration/60 == 1) {
                $(element).addClass('one-hour');
              }
              var dur = event.duration/60 + 'H';
              var c = event.eventColor;
              $(element).empty();
              $(element).addClass(event.eventPictogram);
              $(element).attr('data-id', event.id);
              $(element).append('<span class="category" style="background-color:' + c + '">' + event.type + '<a href="#"></a></span>');
              $(element).append('<div class="info"><img src="' + event.picture + '" /><div class="txt"><span>' + event.title + '</span><strong>' + event.author + '</strong></div></div>');
              $(element).append('<div class="bottom"><span class="duration">' + dur + '</span> - <span class="ven">' + event.room.toUpperCase() + '</span><span class="competition">' + event.selection + '</span></div>');
            },
            viewRender: function(view){
              var moment = $('#mycalendar').fullCalendar('getDate');
              if (moment.format('DD') > maxDate){
                $('#mycalendar').fullCalendar('gotoDate', '2016-05-22');
              }
              if (moment.format('DD') < minDate){
                $('#mycalendar').fullCalendar('gotoDate', '2016-05-11');
              }
              var m = $('#mycalendar').fullCalendar('getDate');
              $('#timeline a').each(function() {
                var d = $(this).data('date');
                if(d == m.format()) {
                  $(this).trigger('click');
                }
              });
            },
            drop: function() {
              $.cookie('drag', '1', { expires: 365 });
              // retrieve the dropped element's stored Event Object
              var originalEventObject = $(this).data('eventObject');
              
              // we need to copy it, so that multiple events don't have a reference to the same object
              var copiedEventObject = $.extend({}, originalEventObject);
              
              // assign it the date that was reported
              copiedEventObject.start = copiedEventObject.start;
              
              if(events.filter(function(e) { return e.id == copiedEventObject.id; }).length > 0) {
                return false;
              }

              // render the event on the calendar
              $('#mycalendar').fullCalendar('renderEvent', copiedEventObject, true);


              // get local storage
              var agenda = localStorage.getItem('agenda_press');

              if(agenda == null) {
                events.push(copiedEventObject);

                localStorage.setItem('agenda_press', JSON.stringify(events));
              } else {
                events = JSON.parse(agenda);
                events.push(copiedEventObject);

                localStorage.setItem('agenda_press', JSON.stringify(events));
              }
              
            }
          });

          if($('#calendar-programmation').length) {

            function initDraggable() {
              $('#calendar-programmation .fc-event').each(function() {

                var timeStart = $(this).data('time'),
                    dur = $(this).data('duration') / 60;

                if(dur == 1) {
                  $(this).addClass('one-hour');
                }

                var base = 8;
                $(this).find('.category').css('background-color', $(this).data('color'));
                $(this).addClass($(this).data('picto').substr(1));

                var mT = timeStart - base;
                $(this).css('margin-top', (mT * 80) + 5);

                var eventObject = {
                  title: $(this).find('.txt span').text(),
                  eventColor: $(this).data('color'),
                  start: $(this).data('start'),
                  end: $(this).data('end'),
                  type: $(this).find('.category').text(),
                  author: $(this).find('.txt strong').text(),
                  picture: $(this).find('img').attr('src'),
                  duration: parseInt($(this).find('.bottom .duration').text().substr(0, 2)) * 60,
                  room: $(this).find('.bottom .ven').text(),
                  selection: $(this).find('.bottom .competition').text(),
                  eventPictogram: $(this).data('picto').substr(1),
                  id: $(this).data('id')
                };
                
                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);
                
                // make the event draggable using jQuery UI
                $(this).draggable({
                  zIndex: 999,
                  revert: true,
                  revertDuration: 0,
                  start: function() {
                    $('#calendar-wrapper').removeClass('drag');
                  },
                  stop: function(event, ui){
                    setTimeout(function() {
                      if(!$.cookie('drag')) {
                        $('#calendar-wrapper').addClass('drag');
                      }
                    }, 300);
                  }
                });
                
              });
            }

            $('#timeline a').on('click', function(e) {
              e.preventDefault();

              if($(this).hasClass('active') || $(this).hasClass('disabled')) {
                return false;
              }

              $('#timeline a').removeClass('active');
              $(this).addClass('active');

              $.ajax({
                type: "GET",
                dataType: "html",
                cache: false,
                url: 'calendarprogrammation.html',
                success: function(data) {
                  $('.v-wrapper').html(data);

                  initDraggable();
                }
              });

              var date = $.fullCalendar.moment($(this).data('date'));
              $('#mycalendar').fullCalendar('gotoDate', date);
              
            });

            var ct = 0;

            $('#calendar-programmation .nav').on('click', function(e) {
              e.preventDefault();

              if($(this).hasClass('prev')) {
                $('.v-wrapper').removeClass('max');

                var $v = $('.venue').eq(ct);
                if($v.prev().length) {
                  var p = - ($v.width() * (ct-1));
                  $('.v-wrapper').css({
                    '-webkit-transform': 'translateX(' + p+ 'px)',
                    '-moz-transform': 'translateX(' + p+ 'px)',
                    '-o-transform': 'translateX(' + p+ 'px)',
                    '-ms-transform': 'translateX(' + p+ 'px)',
                    'transform': 'translateX(' + p+ 'px)'
                  });
                  ct--;
                }
              } else {
                var $v = $('.venue').eq(ct);
                var p = - ($v.width() * (ct+1));
                var max = $('.venues').width() - ($('.wrapper').width() - $('.timeCol').width());
                if(!$('.v-wrapper').hasClass('max')) {
                  ct++;
                }

                if(-p > max) {
                  p = -max;
                  $('.v-wrapper').addClass('max');
                } else {
                  $('.v-wrapper').removeClass('max');
                }
                $('.v-wrapper').css({
                  '-webkit-transform': 'translateX(' + p+ 'px)',
                  '-moz-transform': 'translateX(' + p+ 'px)',
                  '-o-transform': 'translateX(' + p+ 'px)',
                  '-ms-transform': 'translateX(' + p+ 'px)',
                  'transform': 'translateX(' + p+ 'px)'
                });
              }
            });

            initDraggable();
          }
        }
      }

  $('#mycalendar').on('click', '.fc-event .category a', function(e) {
    e.preventDefault();

    var id = $(this).parents('.fc-event').data('id');
    $('#mycalendar').fullCalendar('removeEvents', id);

    var agenda = localStorage.getItem('agenda_press');
    events = JSON.parse(agenda);

    for(var i=0; i<events.length; i++) {
      if(events[i].id == id) {
        events.splice(i,1);
      }
    }

    localStorage.setItem('agenda_press', JSON.stringify(events));

  });

});