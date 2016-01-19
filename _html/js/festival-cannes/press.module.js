$(document).ready(function () {

  // init array of events
  var events = [];

  // get local storage
  var agenda = localStorage.getItem('agenda_press');

  // if local storage, get the events
  if (agenda != null) {
    events = JSON.parse(agenda);
  }

  // if cookie press
  if ($.cookie('press')) {
    $('.lock').removeClass('lock');
    $('.locked').remove();
    $('.icon_cadenas').removeClass('icon_cadenas').addClass('icon_telecharger');
  }

  function validateForm($this) {
    var v = $this.find('input[type="password"]').val();
    // todo on server : security check password.

    if (v == "test") {
      $.cookie('press', '1', {
        expires: 365
      });


      $('.lock').removeClass('lock').addClass('connected');
      $('.locked .vCenterKid').html('<p class="access">' + GLOBALS.texts.popin.acces + '</p>');
      $('.locked form').remove();

      $('#popin-press').removeClass('visible-popin');
      $("#main").removeClass('overlay-popin');
      $('footer').removeClass('overlay');

      $('.icon_cadenas').removeClass('icon_cadenas').addClass('icon_telecharger');

      popinInit();

    } else {
      $this.addClass('error');
    }
  }

  $('.locked form').on('submit', function (e) {
    e.preventDefault();
    $this = $(this);
    validateForm($this);
  });

  $('#popin-press form').on('submit', function (e) {
    e.preventDefault();
    $this = $(this);
    validateForm($this);
  });

  $('.service-presse').on('click', function (e) {
    e.preventDefault();

    $('html, body').animate({
      scrollTop: $('.contact-press').offset().top - 230
    }, 500);
  });

  var count = 0;

  $('#timeline .arrow').on('click', function (e) {
    e.preventDefault();

    $('#timeline .arrow').removeClass('hide');


    if ($(this).hasClass('left')) {
      if (count < $('#timeline a.active').index()) {
        $('#timeline a.active').addClass('hideB');
      } else {
        $('#timeline a.active').removeClass('hideB');
      }
      $('#timeline').removeClass('max');

      var $v = $('#timeline a').eq(count);
      if ($v.prev().length) {
        var p = -(($v.width() + 1) * (count - 1));
        $('.timeline-container').css({
          '-webkit-transform': 'translateX(' + p + 'px)',
          '-moz-transform': 'translateX(' + p + 'px)',
          '-o-transform': 'translateX(' + p + 'px)',
          '-ms-transform': 'translateX(' + p + 'px)',
          'transform': 'translateX(' + p + 'px)'
        });
        count--;
      }

      if ($v.prev().prev().length == 0) {
        $(this).addClass('hide');
      }
    } else {
      var $v = $('#timeline a').eq(count);
      var p = -(($v.width() + 1) * (count + 1));
      var max = 263;
      if (count >= $('#timeline a.active').index()) {
        $('#timeline a.active').addClass('hideB');
      } else {
        $('#timeline a.active').removeClass('hideB');
      }
      if (!$('#timeline').hasClass('max')) {
        count++;
      }

      if (-p > max) {
        p = -max;
        $('#timeline').addClass('max');
        $(this).addClass('hide');
      } else {
        $('#timeline').removeClass('max');
      }
      $('.timeline-container').css({
        '-webkit-transform': 'translateX(' + p + 'px)',
        '-moz-transform': 'translateX(' + p + 'px)',
        '-o-transform': 'translateX(' + p + 'px)',
        '-ms-transform': 'translateX(' + p + 'px)',
        'transform': 'translateX(' + p + 'px)'
      });
    }
  });

  function openPopinEvent(url) {
    $.ajax({
      type: "GET",
      dataType: "html",
      cache: false,
      url: url,
      success: function (data) {
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
          onInitialized: function () {
            $('<span class="pagination"><strong>1</strong>/' + $('.films .owl-item').length + '</span>').insertAfter($('.films .owl-prev'));
          },
          onTranslated: function () {
            var i = parseInt($('.films .center').index()) + 1;
            $('.pagination strong').text(i);
          }
        });

        // test if events are already store in local storage
        if (events.length != 0) {
          $('.events-container .fc-event').each(function () {
            var id = $(this).data('id'),
              $this = $(this);

            for (var i = 0; i < events.length; i++) {
              if (id == events[i].id) {
                $this.parent().addClass('delete');
                $this.parent().find('.button').removeClass('add').text(GLOBALS.texts.agenda.delete);
              }
            }
          });
        }

        $('html, body').animate({
          scrollTop: $(".press .programmation").offset().top - 91
        }, 500);

        // show popin
        setTimeout(function () {
          $('.popin-event').addClass('show');
        }, 100);

      }
    });
  }

  $('.subnav').hover(function () {
    $('.button.list').addClass('show');
  });

  $('.buttons').mouseout(function () {
    $('.button.list').removeClass('show');
  });

  $('.button.list').mouseover(function () {
    $('.button.list').addClass('show');
  });

  $('.subnav').on('click', function (e) {
    e.preventDefault();
  });

  if ($('#mycalendar').length) {

    var maxDate = '22';
    var minDate = '11';

    // full width calendar (page 'my calendar')
    if ($('#calendar').hasClass('fullwidth')) {
      var lang = GLOBALS.locale;
      $('#mycalendar').fullCalendar({
        lang: lang,
        defaultDate: '2016-05-11', // TODO A REVOIR //
        header: {
          left: 'prev',
          center: 'title',
          right: 'next'
        },
        views: {
          agendaFive: {
            type: 'agenda',
            duration: {
              days: 6
            },
            buttonText: '5 day',
          },
          agendaFour: {
            type: 'agenda',
            duration: {
              days: 5
            },
            buttonText: '4 day'
          },
          agendaThree: {
            type: 'agenda',
            duration: {
              days: 4
            },
            buttonText: '3 day'
          },
        },
        firstDay: 3,
        defaultView: 'agendaWeek',
        columnFormat: {
          week: 'dddd D MMM',
          agenda: 'dddd D MMM'
        },
        minTime: "08:00:00",
        maxTime: "28:00:00",
        allDaySlot: false,
        events: events,
        slotEventOverlap: false,
        slotLabelFormat: typeof GLOBALS.calendar.labelFormat[GLOBALS.locale] !== "undefined" ? GLOBALS.calendar.labelFormat[GLOBALS.locale] : GLOBALS.calendar.labelFormat.default,
        eventAfterRender: function (event, element, view) {
          if (event.duration / 60 < 2) {
            $(element).addClass('one-hour');
          }
          var dur = event.duration / 60 + 'H';
          var c = event.eventColor;
          $(element).css('width', '220px');
          $(element).empty();
          $(element).addClass(event.eventPictogram);
          $(element).attr('data-id', event.id);
          $(element).empty();

          if (c == '#000') {
            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_evt-seance-presse"></i>' + event.type + '<a href="#" class="del"></a></span>');
          } else if (c == "#9b9b9b") {
            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_evt-seance"></i>' + event.type + '<a href="#" class="del"></a></span>');
          } else if (c == "#a68851") {
            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_evt-conference"></i>' + event.type + '<a href="#" class="del"></a></span>');
          } else if (c == "#fff") {
            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_evt-personnel"></i>' + event.type + '<a href="#" class="del"></a></span>');
          } else {
            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_espace-presse"></i>' + event.type + '<a href="#" class="del"></a></span>');
          }

          $(element).append('<div class="info"><img src="' + event.picture + '" /><div class="txt"><span>' + event.title + '</span><strong>' + event.author + '</strong></div></div>');
          $(element).append('<div class="bottom"><span class="duration">' + dur + '</span> - <span class="ven">' + event.room.toUpperCase() + '</span><span class="competition">' + event.selection + '</span></div>');
        },
        viewRender: function (view) {
            // limit the min date and max date of the calendar, and change the programmation calendar date
            var moment = $('#mycalendar').fullCalendar('getDate');

            $('#mycalendar .fc-left, #mycalendar .fc-right').removeClass('hide');

            if (moment.format('DD') > maxDate) {
              $('#mycalendar').fullCalendar('gotoDate', '2016-05-22');
            }
            if (moment.format('DD') < minDate) {
              $('#mycalendar').fullCalendar('gotoDate', '2016-05-11');
            }

            if (parseInt(moment.format('DD')) + 4 >= maxDate) {
              $('#mycalendar .fc-right').addClass('hide');
            }
            if (moment.format('DD') < (parseInt(minDate) + 1)) {
              $('#mycalendar .fc-left').addClass('hide');
            }

            var m = $('#mycalendar').fullCalendar('getDate');
            $('#timeline a').each(function () {
              var d = $(this).data('date');
              if (d == m.format()) {
                $(this).trigger('click');
              }
            });
          }
          // dayRender: function(date, cell){
          //     if (date > maxDate){
          //         $(cell).addClass('disabled');
          //         console.log("ok");
          //     }
          // }
      });
    } else {
      // if cookie drag doesn't exist, add class to show message
      if (!$.cookie('drag') && events.length == 0) {
        $('#calendar-wrapper').addClass('drag');
      }

      // on click on "ok" button, remove class and add cookie
      $('#okDrag').on('click', function () {
        $('#calendar-wrapper').removeClass('drag');
        $.cookie('drag', '1', {
          expires: 365
        });
      });

      $(window).resize(function () {
        $('#calendar-wrapper').css('left', $('#calendar').offset().left);
      });

      // create the 'my calendar' module
      $('#mycalendar').fullCalendar({
        lang: GLOBALS.locale, // TODO a verifier
        defaultDate: GLOBALS.defaultDate, // TODO a supprimer
        header: {
          left: 'prev',
          center: 'title',
          right: 'next'
        },
        titleFormat: 'dddd DD MMMM',
        defaultView: 'agendaDay',
        minTime: "08:00:00",
        maxTime: "28:00:00",
        allDaySlot: false,
        droppable: true,
        selectOverlap: false,
        events: events,
        eventOverlap: false,
        slotEventOverlap: false,
        eventAfterRender: function (event, element, view) {
          // atfer render of each event : change html with all the info
          if (event.duration / 60 < 2) {
            $(element).addClass('one-hour');
          }
          var dur = event.duration / 60 + 'H';
          var c = event.eventColor;
          $(element).empty();
          $(element).addClass(event.eventPictogram).addClass('ajax');
          $(element).attr('data-id', event.id);

          if (c == '#000') {
            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_evt-seance-presse"></i>' + event.type + '<a href="#" class="del"></a></span>');
          } else if (c == "#9b9b9b") {
            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_evt-seance"></i>' + event.type + '<a href="#" class="del"></a></span>');
          } else if (c == "#a68851") {
            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_evt-conference"></i>' + event.type + '<a href="#" class="del"></a></span>');
          } else if (c == "#fff") {
            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_evt-personnel"></i>' + event.type + '<a href="#" class="del"></a></span>');
          } else {
            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_espace-presse"></i>' + event.type + '<a href="#" class="del"></a></span>');
          }

          $(element).append('<div class="info"><img src="' + event.picture + '" /><div class="txt"><span>' + event.title + '</span><strong>' + event.author + '</strong></div></div>');
          $(element).append('<div class="bottom"><span class="duration">' + dur + '</span> - <span class="ven">' + event.room.toUpperCase() + '</span><span class="competition">' + event.selection + '</span></div>');
        },
        eventClick: function (event, jsEvent, view) {
          if ($(jsEvent.target).hasClass('del')) {
            return;
          } else {
            openPopinEvent(event.url);
            return false;
          }
        },
        viewRender: function (view) {
          // limit the min date and max date of the calendar, and change the programmation calendar date
          var moment = $('#mycalendar').fullCalendar('getDate');

          $('#mycalendar .fc-left, #mycalendar .fc-right').removeClass('hide');

          if (moment.format('DD') > maxDate) {
            $('#mycalendar').fullCalendar('gotoDate', '2016-05-22');
          }
          if (moment.format('DD') < minDate) {
            $('#mycalendar').fullCalendar('gotoDate', '2016-05-11');
          }

          if (moment.format('DD') == maxDate) {
            $('#mycalendar .fc-right').addClass('hide');
          }
          if (moment.format('DD') == minDate) {
            $('#mycalendar .fc-left').addClass('hide');
          }

          var m = $('#mycalendar').fullCalendar('getDate');
          $('#dateProgram').text(m.format('DD MMMM YYYY'));
          $('#timeline a').each(function () {
            var d = $(this).data('date');
            if (d == m.format()) {
              $(this).trigger('click');
            }
          });
        },
        drop: function () {
          $.cookie('drag', '1', {
            expires: 365
          });
          // retrieve the dropped element's stored Event Object
          var originalEventObject = $(this).data('eventObject');

          // we need to copy it, so that multiple events don't have a reference to the same object
          var copiedEventObject = $.extend({}, originalEventObject);

          // assign it the date that was reported
          copiedEventObject.start = copiedEventObject.start;

          if (events.filter(function (e) {
              return e.id == copiedEventObject.id;
            }).length > 0) {
            return false;
          }

          // render the event on the calendar
          $('#mycalendar').fullCalendar('renderEvent', copiedEventObject, true);


          // get local storage
          var agenda = localStorage.getItem('agenda_press');

          if (agenda == null) {
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
          if ($('.events-container').length) {
            $('.events-container .fc-event').each(function () {
              var id = $(this).data('id'),
                $this = $(this);

              for (var i = 0; i < events.length; i++) {
                if (id == events[i].id) {
                  $this.parent().addClass('delete');
                  $this.parent().find('.button').removeClass('add').text(GLOBALS.texts.agenda.delete);
                }
              }
            });
          }

        }
      });

      if ($('.communiques').length) {
        function resizeGridNews() {
          var w = 0;

          $('.communiques article').each(function () {
            if ($(this).css('display') != 'none') {
              w += $(this).outerWidth();
            }
          });
          $('.communiques .grid-wrapper').width(w / 2);
        }

        resizeGridNews();
        $(window).resize(function () {
          resizeGridNews();
        });
      }

      if ($('#calendar-programmation').length) {

        $('#calendar-programmation .calendar').on('click', '.fc-event', function (e) {
          var url = $(this).data('url');

          // load the url of the event via ajax
          openPopinEvent(url);
        });

        // delete event
        $('#calendar-programmation').on('click', '.event.delete .button', function (e) {
          e.preventDefault();

          var id = parseInt($(this).parent().find('.fc-event').data('id'));

          $('#mycalendar').fullCalendar('removeEvents', id);

          var agenda = localStorage.getItem('agenda_press');
          events = JSON.parse(agenda);

          for (var i = 0; i < events.length; i++) {
            if (events[i].id == id) {
              events.splice(i, 1);
            }
          }

          localStorage.setItem('agenda_press', JSON.stringify(events));

          $(this).parent().removeClass('delete');
          $(this).text('Ajouter').addClass('add');
        });

        // add event
        $('#calendar-programmation').on('click', '.event .add', function (e) {
          e.preventDefault();
          var $ev = $(this).parent().find('.fc-event');

          $.cookie('drag', '1', {
            expires: 365
          });
          // retrieve the dropped element's stored Event Object
          var originalEventObject = $ev.data('eventObject');

          // we need to copy it, so that multiple events don't have a reference to the same object
          var copiedEventObject = $.extend({}, originalEventObject);

          // assign it the date that was reported
          copiedEventObject.start = copiedEventObject.start;

          if (events.filter(function (e) {
              return e.id == copiedEventObject.id;
            }).length > 0) {
            return false;
          }

          // render the event on the calendar
          $('#mycalendar').fullCalendar('renderEvent', copiedEventObject, true);


          // get local storage
          var agenda = localStorage.getItem('agenda_press');

          if (agenda == null) {
            events.push(copiedEventObject);

            localStorage.setItem('agenda_press', JSON.stringify(events));
          } else {
            events = JSON.parse(agenda);
            events.push(copiedEventObject);

            localStorage.setItem('agenda_press', JSON.stringify(events));
          }

          $(this).parent().addClass('delete');
          $(this).removeClass('add').text(GLOBALS.texts.agenda.delete);
        });

        // close popin
        $('#calendar-programmation').on('click', '.close-button', function (e) {
          e.preventDefault();

          $('.popin-event').removeClass('show');
          setTimeout(function () {
            $('.popin-event').remove();
          }, 600);
        });

        function initDraggable() {
          $('#calendar-programmation .fc-event').each(function () {

            // based on time start and duration, calculate positions of event
            var timeStart = $(this).data('time'),
              dur = Math.floor($(this).data('duration') / 60),
              minutes = $(this).data('duration') % 60;

            if (minutes == 0) {
              minutes = '';
            }

            if (dur < 2) {
              $(this).addClass('one-hour');
              $(this).find('.txt span').prepend(dur + 'H' + minutes + ' - ');
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
            if (!$(this).parent().hasClass('event')) {
              $(this).draggable({
                zIndex: 999,
                revert: true,
                revertDuration: 0,
                start: function () {
                  $('#calendar-wrapper').removeClass('drag');
                },
                stop: function (event, ui) {
                  setTimeout(function () {
                    if (!$.cookie('drag')) {
                      $('#calendar-wrapper').addClass('drag');
                    }
                  }, 300);
                }
              });
            }

          });
        }

        // on click on the timeline link, update calendar
        $('#timeline a').on('click', function (e) {
          e.preventDefault();

          if ($(this).hasClass('active') || $(this).hasClass('disabled')) {
            return false;
          }

          $('#timeline a').removeClass('active');
          $(this).addClass('active');

          $.ajax({
            type: "GET",
            dataType: "html",
            cache: false,
            url: GLOBALS.urls.calendarProgrammationUrl,
            success: function (data) {
              $('.v-wrapper').html(data);

              initDraggable();
            }
          });

          var date = $.fullCalendar.moment($(this).data('date'));

          $('#dateProgram').text(date.format('DD MMMM YYYY'));

          $('#mycalendar').fullCalendar('gotoDate', date);

        });

        var ct = 0;

        $('#calendar-programmation .nav.prev').addClass('hide');

        // slider calendar programmation
        $('#calendar-programmation .nav').on('click', function (e) {
          e.preventDefault();
          $('#calendar-programmation .nav').removeClass('hide');

          if ($(this).hasClass('prev')) {
            $('.v-wrapper').removeClass('max');

            var $v = $('.venue').eq(ct);
            if ($v.prev().length) {
              var p = -($v.width() * (ct - 1));
              $('.v-wrapper').css({
                '-webkit-transform': 'translateX(' + p + 'px)',
                '-moz-transform': 'translateX(' + p + 'px)',
                '-o-transform': 'translateX(' + p + 'px)',
                '-ms-transform': 'translateX(' + p + 'px)',
                'transform': 'translateX(' + p + 'px)'
              });
              ct--;
            }

            if ($v.prev().prev().length == 0) {
              $(this).addClass('hide');
            }
          } else {
            var $v = $('.venue').eq(ct);
            var p = -($v.width() * (ct + 1));
            var max = $('.venues').width() - ($('.wrapper').width() - $('.timeCol').width());
            if (!$('.v-wrapper').hasClass('max')) {
              ct++;
            }

            if (-p > max) {
              p = -max;
              $('.v-wrapper').addClass('max');
              $(this).addClass('hide');
            } else {
              $('.v-wrapper').removeClass('max');
            }
            $('.v-wrapper').css({
              '-webkit-transform': 'translateX(' + p + 'px)',
              '-moz-transform': 'translateX(' + p + 'px)',
              '-o-transform': 'translateX(' + p + 'px)',
              '-ms-transform': 'translateX(' + p + 'px)',
              'transform': 'translateX(' + p + 'px)'
            });
          }
        });

        initDraggable();
      }
    }
  }

  // delete event
  $('#mycalendar').on('click', '.fc-event .category a', function (e) {
    e.preventDefault();

    var id = $(this).parents('.fc-event').data('id');
    $('#mycalendar').fullCalendar('removeEvents', id);

    var agenda = localStorage.getItem('agenda_press');
    events = JSON.parse(agenda);

    for (var i = 0; i < events.length; i++) {
      if (events[i].id == id) {
        events.splice(i, 1);
      }
    }

    localStorage.setItem('agenda_press', JSON.stringify(events));

    if ($('.events-container').length) {

      $('.events-container .event').removeClass('delete');
      $('.events-container .event .button').addClass('add').text('Ajouter');

      $('.events-container .fc-event').each(function () {
        var id = $(this).data('id'),
          $this = $(this);

        for (var i = 0; i < events.length; i++) {
          if (id == events[i].id) {
            $this.parent().addClass('delete');
            $this.parent().find('.button').removeClass('add').text(GLOBALS.texts.agenda.delete);
          }
        }
      });
    }

  });


  // EVENT AJAX COMMUNIQUE AND INFORMATION //

  if ($('.press').length) {

    popinInit();

    var $container = $('#gridAudios'),
      $grid;

    $grid = $('#gridAudios').imagesLoaded(function () {
      // init Isotope after all images have loaded
      setGrid($grid, $('#gridAudios'), true);
      $grid.isotope({
        itemSelector: '.item',
        percentPosition: true,
        layoutMode: 'packery',
        packery: {
          columnWidth: '.grid-sizer'
        }
      });

      $grid.isotope('layout');
    });
    $('.press .read-more').on('click', function (e) {
      e.preventDefault();
      $(this).hide();
      $.ajax({
        type: "GET",
        dataType: "html",
        cache: false,
        url: GLOBALS.urls.loadPressRelease,
        success: function (data) {
          var $data = $(data).find('.gridelement');
          var $container = $('#gridAudios'),
            $grid;
          $grid = $container.imagesLoaded(function () {
            setGrid($grid, $data, false);
          });
        }
      });
    });
  }

  // POPIN LOCK //

  function popinInit() {

    if ($('.press.lock').length && !$('.connected').length) {

      if ($('#popin-press').length) {

        $('.buttons:not(".active-btn")').on('click', function () {

          console.log("1, on est ici");

          if ($('#popin-press').hasClass('visible-popin')) {
            $('#popin-press').removeClass('visible-popin');

            $("#main").removeClass('overlay-popin');
            $('footer').removeClass('overlay');
          } else {
            $('#popin-press').addClass("visible-popin");
            $("#main").addClass('overlay-popin');
          }
          return false;
        });

        $(document).keyup(function (e) {
          if (e.keyCode == 27) {
            $('#popin-press').removeClass('visible-popin');
            $("#main").removeClass('overlay-popin');
            $('footer').removeClass('overlay');
            $('.overlay-div').remove();
          }
        });
      }

      $(document).on('click', function (e) {

          console.log("2, on est ici");

        var $element = $(e.target);
        if ($element.hasClass('visible-popin')) {

        } else {
          var $isPopin = $element.closest('.visible-popin');
          var isButton = $element.hasClass('buttons');

          if ($isPopin.length || isButton) {

          } else {
            $('#popin-press').removeClass('visible-popin');
            $("#main").removeClass('overlay-popin');
            $('footer').removeClass('overlay');

          }
        }
      });

    }

    // POPIN DOWNLOAD //

    //ONLY FOR MEDIA//
    if ($('.press.lock').length && !$('.connected').length && $('.press-media').length ) {
      if ($('#popin-download-press').length) {
        $('.buttons.active-btn').on('click', function () {
            console.log("3, on est ici");
          if ($('#popin-download-press').hasClass('visible-popin')) {
            $('#popin-download-press').removeClass('visible-popin');

            $("#main").removeClass('overlay-popin');
            $('footer').removeClass('overlay');
          } else {

            $('#popin-download-press').addClass("visible-popin");
            $("#main").addClass('overlay-popin');

          }
          return false;

        });

        $(document).keyup(function (e) {
          //        if (e.keyCode == 13) $('.save').click();
          if (e.keyCode == 27) {
            $('#popin-download-press').removeClass('visible-popin');
            $("#main").removeClass('overlay-popin');
            $('footer').removeClass('overlay');
            $('.overlay-div').remove();
          }
        });

        $(document).on('click', function (e) {

            console.log("4, on est ici");
          var $element = $(e.target);
          if ($element.hasClass('visible-popin')) {

          } else {
            var $isPopin = $element.closest('.visible-popin');
            var isButton = $element.hasClass('buttons');

            if ($isPopin.length || isButton) {

            } else {
              $('#popin-download-press').removeClass('visible-popin');
              $("#main").removeClass('overlay-popin');
              $('footer').removeClass('overlay');
            }
          }
        });
      }
    }

    //FOR ALL PRESS PAGE//
    if (!$('.lock').length) {
      if ($('#popin-download-press').length) {
        $('.buttons').on('click', function () {

            console.log("6, on est ici");
          if ($('#popin-download-press').hasClass('visible-popin')) {
            $('#popin-download-press').removeClass('visible-popin');

            $("#main").removeClass('overlay-popin');
            $('footer').removeClass('overlay');
          } else {

            $('#popin-download-press').addClass("visible-popin");
            $("#main").addClass('overlay-popin');

          }
          return false;

        });

        $(document).keyup(function (e) {
          //        if (e.keyCode == 13) $('.save').click();
          if (e.keyCode == 27) {
            $('#popin-download-press').removeClass('visible-popin');
            $("#main").removeClass('overlay-popin');
            $('footer').removeClass('overlay');
            $('.overlay-div').remove();
          }
        });

        $(document).on('click', function (e) {

          var $element = $(e.target);
          if ($element.hasClass('visible-popin')) {
            //do nothing
          } else {
            var $isPopin = $element.closest('.visible-popin');
            var isButton = $element.hasClass('buttons');

            if ($isPopin.length || isButton) {
              //do nothing
            } else {
              $('#popin-download-press').removeClass('visible-popin');
              $("#main").removeClass('overlay-popin');
              $('footer').removeClass('overlay');
            }
          }
        });
      }
    }
  }

  // POPIN CALENDAR CREAT EVENT //

  if ($('#create-event-pop').length) {
    $('.create').on('click', function () {

      if ($('#create-event-pop').hasClass('visible-popin')) {
        $('#create-event-pop').removeClass('visible-popin');
      } else {
        $('#create-event-pop').addClass("visible-popin");
      }
    });

    $(document).keyup(function (e) {

      if (e.keyCode == 27) {
        $('#create-event-pop').removeClass('visible-popin');
      }
    });
    $('.btn-close').on('click', function () {
      $('#create-event-pop').removeClass('visible-popin');
    });
  }

  // POPIN Show event //

  if ($('.fullcalendar').length) {
    $('.fc-event-container').on('click', function (e) {
      var url = $(this).attr('src');

      // load the url of the event via ajax
      openPopinEvent(url);
    });
  }

  // Navigation tab press page (accreditation)

  if ($('#accreditation').length) {

    $('.nav-accre table td').click(function () {
      var $cat = $(this).data('cat');
      var sectionIsShow = $('#accreditation').find('.nav-container.active');
      var sectionShow = $('#accreditation').find('.nav-container[data-cat=' + $cat + ']');

      if (!$(this).hasClass('active')) {

        $('.nav-accre table').find('.active').removeClass('active');
        $(this).addClass('active');

        sectionIsShow.animate({
          opacity: 0
        }, 500, function () {
          sectionIsShow.css('display', 'none');
          sectionIsShow.removeClass('active');

          sectionShow.css('opacity', 0);
          sectionShow.css('display', 'block');

          sectionShow.animate({
            opacity: 1
          }, 500, function () {
            sectionShow.addClass('active');
          })
        });
      }
    });
  }

  //Mediatheque nav
  if ($('.press-media').length) {
    menuMedia();
    initSlideshows();
  }

  if ($('.downloading-press').length) {
    initSlideshows();
  }

  //mediatheque AJAX
  function ajaxEvent() {
    $('.press-media .nav-mediapress td').on('click', function (e) {
      e.preventDefault();
      if ($(this).is(':not(.active)')) {
        var urlPath = $(this).data('cat');
        $.get(urlPath, function (data) {
          $(".nav-container").html($(data).find('.nav-container'));
          history.pushState('', GLOBALS.texts.url.title, urlPath);
          ajaxEvent();
          menuMedia();
          initSlideshows();
          popinInit();
        });
        $('.press-media .nav-mediapress').find('td.active').removeClass('active');
        $(this).addClass('active');
      }
    });
  }

  function menuMedia() {
    var $info = $('.info, .media, .plus');
    $info.click(function () {
      var $active = $('.press-media .nav-container .table .line').find('.active');
      var $parent = $(this).closest(".container");
      if (!$parent.hasClass('active')) {
        $active.removeClass('active');
        $parent.addClass('active');
        $('.icon_moins').removeClass('icon_moins').addClass('icon_case-plus');
        $parent.find('.icon_case-plus').removeClass('icon_case-plus').addClass('icon_moins');
      } else {
        $active.removeClass('active');
        $parent.find('.icon_moins').removeClass('icon_moins').addClass('icon_case-plus');
      }
    });
  }

  ajaxEvent();

  //Grid
  if ($('.gridPressDownload').length) {
    $grid = $('.gridPressDownload').imagesLoaded(function () {
      $grid.isotope({
        layoutMode: 'packery',
        itemSelector: '.item',
        packery: {
          gutter: 20
        }
      });
    });
  }

  //downloding nav sticky
  if ($('.downloading-press').length) {
    //Scroll
    $(window).on('scroll', function () {

      var s = $(window).scrollTop(),
        h = $("#main").height() - 180,
        affiche = $('#affiche-officielle').offset().top - 180,
        signature = $('#signature').offset().top - 180,
        animation = $('#animation').offset().top - 180,
        photosInst = $('#photos-institutionnelles').offset().top - 180,
        dossierPress = $('#dossier-presse').offset().top - 180;

      if (s > 180) {
        $('.downloading-nav').addClass('sticky');
        $(".downloading-nav").css({
          position: "fixed",
          top: 90,
          width: "100%",
          zIndex: 5
        });
      } else if (s < 180) {
        $(".downloading-nav").css({
          position: "relative",
          top: 1,
          zIndex: 1
        });
      }

      if (s > affiche && s < signature) {
        $('.downloading-nav').find('.active').removeClass('active');
        $('a[href="#affiche-officielle"]').addClass('active');

      } else if (s > signature && s < animation) {
        $('.downloading-nav').find('.active').removeClass('active');
        $('a[href="#signature"]').addClass('active');

      } else if (s > animation && s < photosInst) {
        $('.downloading-nav').find('.active').removeClass('active');
        $('a[href="#animation"]').addClass('active');

      } else if (s > photosInst && s < dossierPress) {
        $('.downloading-nav').find('.active').removeClass('active');
        $('a[href="#photos-institutionnelles"]').addClass('active');
      } else if (s > dossierPress) {
        $('.downloading-nav').find('.active').removeClass('active');
        $('a[href="#dossier-presse"]').addClass('active');
      }

    });


    $('a[href^="#"]').click(function () {

      var is_sticky = $('.press').hasClass('sticky');
      var the_id = $(this).attr("href");

      if (!is_sticky) {

        $('html, body').animate({
          scrollTop: $(the_id).offset().top - 300
        }, 'slow');
        return false;

      } else {

        $('html, body').animate({
          scrollTop: $(the_id).offset().top - 130
        }, 'slow');
        return false;

      }
    });

  }

  if ($('.fullcalendar #mycalendar').length) {
    // Fonction exécutée au redimensionnement
    function resizeCalendar() {
      var result = document.getElementById('result');
      if ("matchMedia" in window) {
        if (window.matchMedia("(min-width:1650px)").matches) {
          // au dessus de 1650, calendrier à 6 jour
          $('#mycalendar').fullCalendar('changeView', 'agendaWeek');
        }
        if (window.matchMedia("(max-width:1650px)").matches && window.matchMedia("(min-width:1401px)").matches) {
          // calendrier de 5 jours
          $('#mycalendar').fullCalendar('changeView', 'agendaFive');
        }
        if (window.matchMedia("(max-width:1400px)").matches && window.matchMedia("(min-width:1181px)").matches) {
          // calendrier de 4 jours
          $('#mycalendar').fullCalendar('changeView', 'agendaFour');
        }
        if (window.matchMedia("(max-width:1180px)").matches) {
          // calendrier de 3 jours
          $('#mycalendar').fullCalendar('changeView', 'agendaThree');
        }
      }
    }
    // On lie l'événement resize à la fonction
    window.addEventListener('resize', resizeCalendar, false);

    //init
    if (window.matchMedia("(min-width:1650px)").matches) {
      // au dessus de 1650, calendrier à 6 jour
      $('#mycalendar').fullCalendar('changeView', 'agendaWeek');

    }
    if (window.matchMedia("(max-width:1650px)").matches && window.matchMedia("(min-width:1401px)").matches) {
      // calendrier de 5 jours
      $('#mycalendar').fullCalendar('changeView', 'agendaFive');

    }
    if (window.matchMedia("(max-width:1400px)").matches && window.matchMedia("(min-width:1181px)").matches) {
      // calendrier de 4 jours
      $('#mycalendar').fullCalendar('changeView', 'agendaFour');
    }
    if (window.matchMedia("(max-width:1180px)").matches) {
      // calendrier de 3 jours
      $('#mycalendar').fullCalendar('changeView', 'agendaThree');
    }

  }


  //Pikaday init//
  var minDatePicker = new Date(2016,04,11);
  var maxDatePicker = new Date(2016,04,22);

  var pickerBegin = new Pikaday({
      field: document.getElementById('datepickerBegin'),
      format: 'D/M/YYYY',
      minDate: minDatePicker,
      maxDate: maxDatePicker,
      i18n: {
          previousMonth : 'Previous Month',
          nextMonth     : 'Next Month',
          months        : ['January','February','March','April','May','June','July','August','September','October','November','December'],
          weekdays      : ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
          weekdaysShort : ['Sun','Mon','Tue','Wed','Thu','Fri','Sat']
      }
  });

  var pickerEnd = new Pikaday({
      field: document.getElementById('datepickerEnd'),
      format: 'D/M/YYYY',
      minDate: minDatePicker,
      maxDate: maxDatePicker,
      onSelect: function() {
          ;
      }
  });



});
