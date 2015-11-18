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
            $(element).append('<div class="info"><img src="' + event.img + '" /><div class="txt"><span>' + event.title + '</span><a href="' + event.linkDirector + '">' + event.director + '</a></div></div>');
            $(element).append('<div class="bottom"><span class="duration">' + event.duration + '</span> - <span class="ven">' + event.venue.toUpperCase() + '</span><span class="competition">' + event.competition + '</span></div>');
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
            eventAfterRender: function(event, element, view) {
              $(element).empty();
              $(element).append('<span class="category">' + event.category + '</span>');
              $(element).append('<div class="info"><img src="' + event.img + '" /><div class="txt"><span>' + event.title + '</span><a href="' + event.linkDirector + '">' + event.director + '</a></div></div>');
              $(element).append('<div class="bottom"><span class="duration">' + event.duration + '</span> - <span class="ven">' + event.venue.toUpperCase() + '</span><span class="competition">' + event.competition + '</span></div>');
            },
            viewRender: function(view){
              if (view.start > maxDate){
                $('#mycalendar').fullCalendar('gotoDate', maxDate);
              }
              if (view.start < minDate){
                $('#mycalendar').fullCalendar('gotoDate', minDate);
              }
            },
            drop: function() {
      
              // retrieve the dropped element's stored Event Object
              var originalEventObject = $(this).data('eventObject');
              
              // we need to copy it, so that multiple events don't have a reference to the same object
              var copiedEventObject = $.extend({}, originalEventObject);
              
              // assign it the date that was reported
              copiedEventObject.start = copiedEventObject.start;
              
              // render the event on the calendar
              $('#mycalendar').fullCalendar('renderEvent', copiedEventObject, true);
              
            }
          });

          if($('#calendar-programmation').length) {

            function initDraggable() {
              $('#calendar-programmation .fc-event').each(function() {

                var timeStart = $(this).data('time'),
                    dur = $(this).data('duration');

                var base = 8;

                var mT = timeStart - base;
                $(this).css('margin-top', (mT * 80) + 5);

                var eventObject = {
                  title: $(this).find('.txt span').text(),
                  start: $(this).data('start'),
                  end: $(this).data('end'),
                  category: $(this).find('.category').text(),
                  director: $(this).find('.txt a').text(),
                  linkDirector: $(this).find('.txt a').attr('href'),
                  img: $(this).find('img').attr('src'),
                  duration: $(this).find('.bottom .duration').text(),
                  venue: $(this).find('.bottom .ven').text(),
                  competition: $(this).find('.bottom .competition').text()
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
                if($v.next().next().next().next().length) {
                  var p = - ($v.width() * (ct+1));
                  $('.v-wrapper').css({
                    '-webkit-transform': 'translateX(' + p+ 'px)',
                    '-moz-transform': 'translateX(' + p+ 'px)',
                    '-o-transform': 'translateX(' + p+ 'px)',
                    '-ms-transform': 'translateX(' + p+ 'px)',
                    'transform': 'translateX(' + p+ 'px)'
                  });
                  ct++;
                }
              }
            });

            initDraggable();
          }
        }
      }

});