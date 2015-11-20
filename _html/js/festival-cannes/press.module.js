$(document).ready(function() {

  // init array of events
  var events = [];

  // get local storage
  var agenda = localStorage.getItem('agenda_press');

  // if local storage, get the events
  if(agenda != null) {
    events = JSON.parse(agenda);
  }

  // if cookie press
  if($.cookie('press')) {
    $('.press').removeClass('lock');
    $('.locked').remove();
  }

  $('.locked form').on('submit', function(e) {
    e.preventDefault();

    var v = $(this).find('input[type="text"]').val();
    
    // todo on server : security check password.

    if(v == "test") {
      $.cookie('press', '1', { expires: 365 });
      $('.press').removeClass('lock');
      $('.locked').remove();
    } else {
      $(this).addClass('error');
    }

  });

  $('.service-presse').on('click', function(e) {
    e.preventDefault();

    $('html, body').animate({
      scrollTop: $('.contact-press').offset().top - 230
    }, 500);
  });

  function openPopinEvent(url) {
    $.ajax({
      type: "GET",
      dataType: "html",
      cache: false,
      url: url,
      success: function(data) {
        $('.popin-event').remove();
        // display the html
        $('#calendar-programmation').append(data);

        // init the events
        initDraggable();

        // init the slider of movies
        var sliderFilms = $(".films").owlCarousel({ 
          nav: true,
          dots: false,
          smartSpeed: 500,
          fluidSpeed: 500,
          center: true,
          loop: false,
          margin: 20,
          autoWidth: true,
          mouseDrag: false,
          onInitialized: function() {
            $('<span class="pagination"><strong>1</strong>/' + $('.films .owl-item').length + '</span>').insertAfter($('.films .owl-prev'));
          },
          onTranslated: function() {
            var i = parseInt($('.films .center').index()) + 1;
            $('.pagination strong').text(i);
          }
        });

        // test if events are already store in local storage
        if(events.length != 0) {
          $('.events-container .fc-event').each(function() {
            var id = $(this).data('id'),
                $this = $(this);

            for(var i=0; i<events.length; i++) {
              if(id == events[i].id) {
                $this.parent().addClass('delete');
                $this.parent().find('.button').removeClass('add').text('Supprimer de votre agenda');
              }
            }
          });
        }

        $('html, body').animate({
          scrollTop: $(".press .programmation").offset().top - 91
        }, 500);

        // show popin
        setTimeout(function() {
          $('.popin-event').addClass('show');
        }, 100);
        
      }
    });
  }

  $('.subnav').hover(function() {
    $('.button.list').addClass('show');
  });

  $('.buttons').mouseout(function() {
    $('.button.list').removeClass('show');
  });

  $('.button.list').mouseover(function() {
    $('.button.list').addClass('show');
  });

  $('.subnav').on('click', function(e) {
    e.preventDefault();
  });

  if($('#mycalendar').length) {

      var maxDate = '22';
      var minDate = '11';

      // full width calendar (page 'my calendar')
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
          slotEventOverlap:false,
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
            $(element).append('<span class="category" style="background-color:' + c + '">' + event.type + '<a href="#" class="del"></a></span>');
            $(element).append('<div class="info"><img src="' + event.picture + '" /><div class="txt"><span>' + event.title + '</span><strong>' + event.author + '</strong></div></div>');
            $(element).append('<div class="bottom"><span class="duration">' + dur + '</span> - <span class="ven">' + event.room.toUpperCase() + '</span><span class="competition">' + event.selection + '</span></div>');
          },
          viewRender: function(view){
            
          }
        });
      } else {
        // if cookie drag doesn't exist, add class to show message
        if(!$.cookie('drag') && events.length == 0) {
          $('#calendar-wrapper').addClass('drag');
        }

        // on click on "ok" button, remove class and add cookie
        $('#okDrag').on('click', function() {
          $('#calendar-wrapper').removeClass('drag');
          $.cookie('drag', '1', { expires: 365 });
        });

        // create the 'my calendar' module
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
            maxTime: "19:00:00",
            allDaySlot: false,
            droppable: true,
            selectOverlap: false,
            events: events,
            eventOverlap: false,
            slotEventOverlap:false,
            eventAfterRender: function(event, element, view) {
              // atfer render of each event : change html with all the info
              if(event.duration/60 == 1) {
                $(element).addClass('one-hour');
              }
              var dur = event.duration/60 + 'H';
              var c = event.eventColor;
              $(element).empty();
              $(element).addClass(event.eventPictogram).addClass('ajax');
              $(element).attr('data-id', event.id);
              $(element).append('<span class="category" style="background-color:' + c + '">' + event.type + '<a href="#" class="del"></a></span>');
              $(element).append('<div class="info"><img src="' + event.picture + '" /><div class="txt"><span>' + event.title + '</span><strong>' + event.author + '</strong></div></div>');
              $(element).append('<div class="bottom"><span class="duration">' + dur + '</span> - <span class="ven">' + event.room.toUpperCase() + '</span><span class="competition">' + event.selection + '</span></div>');
            },
            eventClick: function( event, jsEvent, view ) {
              if($(jsEvent.target).hasClass('del')) {
                return;
              } else {
                openPopinEvent(event.url);
                return false;
              }
            },
            viewRender: function(view){
              // limit the min date and max date of the calendar, and change the programmation calendar date
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
                // add the event and store
                events.push(copiedEventObject);

                localStorage.setItem('agenda_press', JSON.stringify(events));
              } else {
                // get events, add the event and store
                events = JSON.parse(agenda);
                events.push(copiedEventObject);

                localStorage.setItem('agenda_press', JSON.stringify(events));
              }

              // update popin-event if needed
              if($('.events-container').length) {
                $('.events-container .fc-event').each(function() {
                  var id = $(this).data('id'),
                      $this = $(this);

                  for(var i=0; i<events.length; i++) {
                    if(id == events[i].id) {
                      $this.parent().addClass('delete');
                      $this.parent().find('.button').removeClass('add').text('Supprimer de votre agenda');
                    }
                  }
                });
              }
              
            }
          });

          if($('#calendar-programmation').length) {

            $('#calendar-programmation .calendar').on('click', '.fc-event', function(e) {
              var url = $(this).data('url');

              // load the url of the event via ajax
              openPopinEvent(url);
            });

            // delete event
            $('#calendar-programmation').on('click', '.event.delete .button', function(e) {
              e.preventDefault();

              var id = parseInt($(this).parent().find('.fc-event').data('id'));

              $('#mycalendar').fullCalendar('removeEvents', id);

              var agenda = localStorage.getItem('agenda_press');
              events = JSON.parse(agenda);

              for(var i=0; i<events.length; i++) {
                if(events[i].id == id) {
                  events.splice(i,1);
                }
              }

              localStorage.setItem('agenda_press', JSON.stringify(events));

              $(this).parent().removeClass('delete');
              $(this).text('Ajouter').addClass('add');
            });

            // add event
            $('#calendar-programmation').on('click', '.event .add', function(e) {
              e.preventDefault();
              var $ev = $(this).parent().find('.fc-event');

              $.cookie('drag', '1', { expires: 365 });
              // retrieve the dropped element's stored Event Object
              var originalEventObject = $ev.data('eventObject');
              
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

              $(this).parent().addClass('delete');
              $(this).removeClass('add').text('Supprimer de votre agenda');
            });

            // close popin
            $('#calendar-programmation').on('click', '.close-button', function(e) {
              e.preventDefault();

              $('.popin-event').removeClass('show');
              setTimeout(function() {
                $('.popin-event').remove();
              }, 600);
            });

            function initDraggable() {
              $('#calendar-programmation .fc-event').each(function() {

                // based on time start and duration, calculate positions of event
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

                // init all the data of the event
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
                  id: $(this).data('id'),
                  url: $(this).data('url')
                };
                
                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                if(!$(this).parent().hasClass('event')) {
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
                }
                
              });
            }

            // on click on the timeline link, update calendar
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

            // slider calendar programmation
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

  // delete event
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

    if($('.events-container').length) {

      $('.events-container .event').removeClass('delete');
      $('.events-container .event .button').addClass('add').text('Ajouter');

      $('.events-container .fc-event').each(function() {
        var id = $(this).data('id'),
            $this = $(this);

        for(var i=0; i<events.length; i++) {
          if(id == events[i].id) {
            $this.parent().addClass('delete');
            $this.parent().find('.button').removeClass('add').text('Supprimer de votre agenda');
          }
        }
      });
    }

  });

  
  // Navigation tab press page (accreditation)
  
  if($('#accreditation').length){

    $('.nav-accre table td').click(function(){
     var $cat = $(this).data('cat');
     var sectionIsShow = $('#accreditation').find('.nav-container.active');
     var sectionShow = $('#accreditation').find('.nav-container[data-cat='+$cat+']');
    
    if(!$(this).hasClass('active')){
        
        $('.nav-accre table').find('.active').removeClass('active');
        $(this).addClass('active');
             
        sectionIsShow.animate({opacity:0},500,function(){
          sectionIsShow.css('display','none');
          sectionIsShow.removeClass('active');

          sectionShow.css('opacity',0);
          sectionShow.css('display','block');

          sectionShow.animate({opacity:1},500,function(){
            sectionShow.addClass('active');
          })
      });
    }
    });
  }
  
  //Grid
      if($('.gridPressDownload').length){
        $grid = $('.gridPressDownload').imagesLoaded(function() {
          $grid.isotope({
            layoutMode: 'packery',
            itemSelector: '.item',
            packery: {
              gutter: 20
            }
          });
        });
    }
  
});