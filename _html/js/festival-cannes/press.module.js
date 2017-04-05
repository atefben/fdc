$(document).ready(function () {
  // init array of events
  var events = [];

  // get local storage
  try {
    var agenda = localStorage.getItem('agenda_press');
  } catch(e) {
    var agenda = null;
  }

  // if local storage, get the events
  if (agenda != null && Object.size(agenda)) {
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

  // $('.locked form').on('submit', function (e) {
  //   e.preventDefault();
  //   $this = $(this);
  //   validateForm($this);
  // });

  // $('#popin-press form').on('submit', function (e) {
  //   e.preventDefault();
  //   $this = $(this);
  //   validateForm($this);
  // });

  $('.service-presse').on('click', function (e) {
    e.preventDefault();

    $('html, body').animate({
      scrollTop: $('.contact-press').offset().top - 230
    }, 500);
  });

  var count = 0;

  if($('#timeline').length > 0) {
    updateFilterCalendar();
  }

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
        if($('#calendar-programmation').length) {
          $('#calendar-programmation').append(data);
        }

        if($('#mycalendar').length) {
          $('.popin').append(data);
        }

        // init the events
        // initDraggable();

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
            if($('.films .owl-item').length > 1) {
              $('<span class="pagination"><strong>1</strong>/' + $('.films .owl-item').length + '</span>').insertAfter($('.films .owl-prev'));
            } else {
              $('.owl-controls').hide();
            }
          },
          onTranslated: function () {
            var i = parseInt($('.films .center').index()) + 1;
            $('.pagination strong').text(i);
          }
        });

        // test if events are already store in local storage
        $('.events-container .fc-event').each(function () {
          $(this).find('.category').css('background-color', $(this).data('color'));

          if (events.length != 0) {
            for (var i = 0; i < events.length; i++) {
              if ($(this).data('id') == events[i].id) {
                $(this).parent().addClass('delete');
                $(this).parent().find('.button').removeClass('add').text(GLOBALS.texts.agenda.delete);
              }
            }
          }
        });

        if($('.press .programmation').length > 0) {
          $('html, body').animate({
            scrollTop: $('.press .programmation').offset().top - 91
          }, 500);
        } else if($('#mycalendar').length) {
          $('html, body').animate({
            scrollTop: $('#mycalendar').offset().top - 91
          }, 500);
        }

        // show popin
        setTimeout(function () {
          $('.popin-event').addClass('show');
        }, 100);
      }
    });
  }

  if($('#calendar').length > 0) {
    if(isiPad()) {
      $('.export.subnav, .button.list.pdf, .button.list.ics').remove();
    } else {
      if ($('.button.list.pdf').length > 0 && $('.button.list.pdf').attr('href').indexOf('#') != -1) {
        $('.button.list.pdf').remove();
      }

      $('.subnav, .subnav icon').hover(function () {
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

      $('.button.list').on('click', function(e) {
        if($(this).hasClass('ics')) {
          try {
            var agenda_data = localStorage.getItem('agenda_press');
          } catch(e) {
            var agenda_data = null;
          }

          if (agenda_data == null) {
            e.preventDefault();
          } else {
            agenda_data = JSON.parse(agenda_data);

            var cal = ics();
            for (var i = 0; i < agenda_data.length; i++) {
              var s = agenda_data[i].start;
                  s = s.replace('.000Z', '');
              var e = agenda_data[i].end;
                  e = e.replace('.000Z', '');

              var d = new Date(agenda_data[i].start);
              var m = (d.getUTCMonth() + 1) < 10 ? '0'+(d.getUTCMonth()+1) : (d.getUTCMonth()+1);
              cal.addEvent(
                agenda_data[i].title,
                (agenda_data[i].type === 'custom' ? agenda_data[i].description : GLOBALS.urls.programmationUrl+'?data='+d.getUTCFullYear()+'-'+m+'-'+d.getUTCDate()),
                (agenda_data[i].type === 'custom' ? agenda_data[i].room : agenda_data[i].room+' – Palais des festivals / Cannes'),
                s,
                e
              );
            }
            cal.download();
          }
        }
      });
    }
  }

  if ($('#mycalendar').length) {
    var minDate = typeof GLOBALS.dateStart !== "undefined" ? GLOBALS.dateStart.slice(-2) : '11';
    var maxDate = typeof GLOBALS.dateEnd !== "undefined" ? GLOBALS.dateEnd.slice(-2) : '22';

    // full width calendar (page 'my calendar')
    if ($('#calendar').hasClass('fullwidth')) {
      var lang = GLOBALS.locale;
      $('#mycalendar').fullCalendar({
        lang: lang,
        defaultDate: typeof GLOBALS.defaultDate !== "undefined" ? GLOBALS.defaultDate : '2016-05-11',
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
            buttonText: '5 day'
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
          }
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
          if (event.duration / 60 < 1 || (event.duration / 60 < 2 && event.duration % 60 < 45)) {
            $(element).addClass('one-hour');
          }

          var minutes = (event.duration % 60) < 10 ? '0'+(event.duration % 60) : (event.duration % 60),
              heures  = Math.floor(event.duration / 60);
          switch(GLOBALS.locale) {
            case 'fr': var dur     = heures + 'H' + minutes; break
            case 'en': var dur     = heures + ':' + minutes; break
            case 'es': var dur     = heures + 'H' + minutes; break
            case 'zh': var dur     = heures + '点' + minutes; break
          }

          var c       = event.eventColor;
          var e = event.type;

          // $(element).css('width', 'auto');
          $(element).css('height', event.duration/60 < 1 ? '80px' : (event.duration/60)*80 + 'px' );
          $(element).empty();
          $(element).addClass(event.eventPictogram);
          $(element).attr('data-id', event.id);
          $(element).attr('data-url',event.url);
          $(element).empty();

          if ( e == "événement" || e == "Event"){
            $(element).append('<span class="category" style="background-color:' + c + ';color:#fff;"><i class="icon icon_speacker"></i>' + event.type + '<a href="#" class="del"><i class="icon icon_close" style="color:#fff;"></i></a></span>');
          }else if (c == '#000') {
            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_evt-seance-presse"></i>' + event.type + '<a href="#" class="del"><i class="icon icon_close"></i></a></span>');
          } else if (c == "#9b9b9b") {
            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_evt-seance"></i>' + event.type + '<a href="#" class="del"><i class="icon icon_close"></i></a></span>');
          } else if (c == "#a68851") {
            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_evt-conference"></i>' + event.type + '<a href="#" class="del"><i class="icon icon_close"></i></a></span>');
          } else if (c == "#fff") {
            $(element).append('<span class="category" style="background-color:' + c + ';color:#000;"><i class="icon icon_evt-personnel"></i>' + event.title + '<a href="#" class="del"><i class="icon icon_close" style="color:#000;"></i></a></span>');
          } else {
            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_espace-presse"></i>' + event.type + '<a href="#" class="del"><i class="icon icon_close"></i></a></span>');
          }

          if (c == "#fff") {
            $(element).append('<div class="info"><div class="txt" style="margin-left:10px"><span>' + event.description + '</span></div></div>');
          } else {
            $(element).append('<div class="info"><img src="' + event.picture + '" width="45" height="60" /><div class="txt"><span>' + event.title + '</span><strong>' + event.author + '</strong></div></div>');
          }

          if (c == "#fff") {
            $(element).append('<div class="bottom"><span class="duration">' + dur + '</span> - <span class="ven">' + event.room.toUpperCase() + '</span></div>');
          } else {
            $(element).append('<div class="bottom"><span class="duration">' + dur + '</span> - <span class="ven">' + event.room.toUpperCase() + '</span><span class="competition">' + event.selection + '</span></div>');
          }

          if ( e == "événement" ){
            $(element).append('<span class="category" style="background-color:' + c + ';color:#000;"><i class="icon icon_speacker"></i>' + event.title + '<a href="#" class="del"><i class="icon icon_close" style="color:#000;"></i></a></span>');
          }
        },
        eventClick: function (event, jsEvent, view) {
          if ($(jsEvent.target).hasClass('del') || $(jsEvent.target).hasClass('icon_close')) {
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
              $('#mycalendar').fullCalendar('gotoDate', GLOBALS.dateEnd);
            }
            if (moment.format('DD') < minDate) {
              $('#mycalendar').fullCalendar('gotoDate', GLOBALS.dateStart);
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
      });

      $('.popin').on('click', '.close-button', function (e) {
        $(this).off('click');
        e.preventDefault();

        $('.popin-event').removeClass('show');
        setTimeout(function () {
          $('.popin-event').remove();
        }, 600);
      });

      $('.popin').on('click', '.event.delete .button', function (e) {
        e.preventDefault();

        var id = parseInt($(this).parent().find('.fc-event').data('id'));

        $('#mycalendar').fullCalendar('removeEvents', id);

        try {
          var agenda = localStorage.getItem('agenda_press');
        } catch(e) {
          var agenda = null;
        }

        if(agenda !== null) {
          events = JSON.parse(agenda);

          for (var i = 0; i < events.length; i++) {
            if (events[i].id == id) {
              events.splice(i, 1);
            }
          }

          try {
            localStorage.setItem('agenda_press', JSON.stringify(events));
          } catch(e) {}
        }

        $(this).parent().removeClass('delete');
        $(this).text('Ajouter').addClass('add');
      });

      $('.popin').on('click', '.event .add', function (e) {
        e.preventDefault();

        var $ev = $(this).parent().find('.fc-event');

        //recuperation des données
        var eventObject = {
          title          : $ev.find('.txt span').text(),
          eventColor     : $ev.data('color'),
          start          : $ev.data('start'),
          end            : $ev.data('end'),
          type           : $ev.find('.category').text(),
          author         : $ev.find('.txt strong').text(),
          picture        : $ev.find('img').attr('src'),
          duration       : $ev.data('duration'),
          room           : $ev.find('.bottom .ven').text(),
          selection      : $ev.find('.bottom .competition').text(),
          eventPictogram : $ev.data('picto').substr(1),
          id             : $ev.data('id'),
          url            : $ev.data('url')
        };

        $ev.parent().addClass('delete');
        $ev.parent().find('.button').removeClass('add').text(GLOBALS.texts.agenda.delete);

        $('#mycalendar').fullCalendar( 'renderEvent', eventObject );

        //Stockage de l'évènement dans le storage
        // get local storage
        try {
          var agenda = localStorage.getItem('agenda_press');
        } catch(e) {
          var agenda = null;
        }

        if (agenda == null) {
          // add the event and store
          events.push(eventObject);
          try {
            localStorage.setItem('agenda_press', JSON.stringify(events));
          } catch(e) {}
        } else {
          // get events, add the event and store
          events = JSON.parse(agenda);
          events.push(eventObject);
          try {
            localStorage.setItem('agenda_press', JSON.stringify(events));
          } catch(e) {}
        }

        eventObject = {};
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
        lang: GLOBALS.locale,
        defaultDate: typeof GLOBALS.defaultDate !== "undefined" ? GLOBALS.defaultDate : '2016-05-11',
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
          if (event.duration / 60 < 1 || (event.duration / 60 < 2 && event.duration % 60 < 45)) {
            $(element).addClass('one-hour');
          }

          var minutes = (event.duration % 60) < 10 ? '0'+(event.duration % 60) : (event.duration % 60),
              heures  = Math.floor(event.duration / 60);
          switch(GLOBALS.locale) {
            case 'fr': var dur     = heures + 'H' + minutes; break
            case 'en': var dur     = heures + ':' + minutes; break
            case 'es': var dur     = heures + 'H' + minutes; break
            case 'zh': var dur     = heures + '点' + minutes; break
          }

          var c = event.eventColor;
          var e = event.type;

          console.log(e);

          $(element).css('height', event.duration/60 < 1 ? '80px' : (event.duration/60)*80 + 'px' );
          $(element).empty();
          $(element).addClass(event.eventPictogram).addClass('ajax');
          $(element).attr('data-id', event.id);

          if ( e == "événement" || e == "Event"){
            $(element).append('<span class="category" style="background-color:' + c + ';color:#fff;"><i class="icon icon_speacker"></i>' + event.type + '<a href="#" class="del"><i class="icon icon_close" style="color:#fff;"></i></a></span>');
          }else if (c == '#000') {
            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_evt-seance-presse"></i>' + event.type + '<a href="#" class="del"><i class="icon icon_close"></i></a></span>');
          } else if (c == "#9b9b9b") {
            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_evt-seance"></i>' + event.type + '<a href="#" class="del"><i class="icon icon_close"></i></a></span>');
          } else if (c == "#a68851") {
            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_evt-conference"></i>' + event.type + '<a href="#" class="del"><i class="icon icon_close"></i></a></span>');
          } else if (c == "#fff") {
            $(element).append('<span class="category" style="background-color:' + c + ';color:#000;"><i class="icon icon_evt-personnel"></i>' + event.title + '<a href="#" class="del"><i class="icon icon_close" style="color:#000;"></i></a></span>');
          } else{
            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_espace-presse"></i>' + event.type + '<a href="#" class="del"><i class="icon icon_close"></i></a></span>');
          }

          if (c == "#fff") {
            $(element).append('<div class="info"><div class="txt" style="margin-left:10px"><span>' + event.description + '</span></div></div>');
          } else {
            $(element).append('<div class="info"><img src="' + event.picture + '" width="45" height="60" /><div class="txt"><span>' + event.title + '</span><strong>' + event.author + '</strong></div></div>');
          }

          if (c == "#fff") {
            $(element).append('<div class="bottom"><span class="duration">' + dur + '</span> - <span class="ven">' + event.room.toUpperCase() + '</span></div>');
          } else {
            $(element).append('<div class="bottom"><span class="duration">' + dur + '</span> - <span class="ven">' + event.room.toUpperCase() + '</span><span class="competition">' + event.selection + '</span></div>');
          }





        },
        eventClick: function (event, jsEvent, view) {
          if ($(jsEvent.target).hasClass('del') || $(jsEvent.target).hasClass('icon_close')) {
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
            $('#mycalendar').fullCalendar('gotoDate', GLOBALS.dateEnd);
          }
          if (moment.format('DD') < minDate) {
            $('#mycalendar').fullCalendar('gotoDate', GLOBALS.dateStart);
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
          try {
            var agenda = localStorage.getItem('agenda_press');
          } catch(e) {
            var agenda = null;
          }

          if (agenda == null) {
            // add the event and store
            events.push(copiedEventObject);
            try {
              localStorage.setItem('agenda_press', JSON.stringify(events));
            } catch(e) {}
          } else {
            // get events, add the event and store
            events = JSON.parse(agenda);
            events.push(copiedEventObject);
            try {
              localStorage.setItem('agenda_press', JSON.stringify(events));
            } catch(e) {}
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

          if (typeof url !== 'undefined') {
            // load the url of the event via ajax
            openPopinEvent(url);
          }
        });

        // delete event
        $('#calendar-programmation, .press.fullcalendar, .popin').on('touchstart click', '.event.delete .button', function(e) {
          e.stopPropagation();
          e.preventDefault();

          var id = parseInt($(this).parent().find('.fc-event').data('id'));

          $('#mycalendar').fullCalendar('removeEvents', id);

          try {
            var agenda = localStorage.getItem('agenda_press');
          } catch(e) {
            var agenda = null;
          }

          if(agenda != null) {
            events = JSON.parse(agenda);

            for (var i = 0; i < events.length; i++) {
              if (events[i].id == id) {
                events.splice(i, 1);
              }
            }

            try {
              localStorage.setItem('agenda_press', JSON.stringify(events));
            } catch(e) {}
          }

          $(this).parent().removeClass('delete');
          $(this).text('Ajouter').addClass('add');
        }).on('touchstart click', '.event .add', function(e) {
          e.stopPropagation();
          e.preventDefault();

          var $ev = $(this).parent().find('.fc-event');

          $('#calendar-wrapper').removeClass('drag');
          $.cookie('drag', '1', {
            expires: 365
          });

          var eventObject = {
            title          : $ev.find('.txt span').text(),
            eventColor     : $ev.data('color'),
            start          : $ev.data('start'),
            end            : $ev.data('end'),
            type           : $ev.find('.category').text(),
            author         : $ev.find('.txt strong').text(),
            picture        : $ev.find('img').attr('src'),
            duration       : $ev.data('duration'),
            room           : $ev.find('.bottom .ven').text(),
            selection      : $ev.find('.bottom .competition').text(),
            eventPictogram : $ev.data('picto').substr(1),
            id             : $ev.data('id'),
            url            : $ev.data('url')
          };

          $ev.parent().addClass('delete');
          $ev.parent().find('.button').removeClass('add').text(GLOBALS.texts.agenda.delete);

          // render the event on the calendar
          $('#mycalendar').fullCalendar('renderEvent', eventObject);

          // get local storage
          try {
            var agenda = localStorage.getItem('agenda_press');
          } catch(e) {
            var agenda = null;
          }

          if (agenda == null) {
            events.push(eventObject);
            try {
              localStorage.setItem('agenda_press', JSON.stringify(events));
            } catch(e) {}
          } else {
            events = JSON.parse(agenda);
            events.push(eventObject);
            try {
              localStorage.setItem('agenda_press', JSON.stringify(events));
            } catch(e) {}
          }

          eventObject = {};
        });

        // close popin
        $('#calendar-programmation, .popin').on('click', '.close-button', function (e) {
          e.preventDefault();
          $('.popin-event').removeClass('show');
          setTimeout(function () {
            $('.popin-event').remove();
          }, 600);
        });

        function initDraggable() {
          $('#calendar-programmation .fc-event').each(function () {
            // based on time start and duration, calculate positions of event
            // var timeStart = $(this).data('time'),
            var timeStart = new Date($(this).data('start')),
                minutes   = $(this).data('duration') % 60,
                dur       = Math.floor($(this).data('duration') / 60),
                base      = 8;

            if (minutes == 0) {
              minutes = '';
            }

            if ((dur < 1 || (dur < 2 && minutes < 45)) && $(this).data('popin') != true) {
              $(this).addClass('one-hour');
              switch(GLOBALS.locale) {
                case 'fr': $(this).find('.txt span').prepend(dur + 'H' + minutes + ' - '); break
                case 'en': $(this).find('.txt span').prepend(dur + ':' + minutes + ' - '); break
                case 'es': $(this).find('.txt span').prepend(dur + 'H' + minutes + ' - '); break
                case 'zh': $(this).find('.txt span').prepend(dur + '点' + minutes + ' - '); break
              }

            }

            $(this).find('.category').css('background-color', $(this).data('color'));
            $(this).addClass($(this).data('picto').substr(1));

            var mT = $(this).data('time') - base;
            $(this).css('margin-top', (mT * 80) + ((timeStart.getMinutes() / 60) * 80) + 5);
            $(this).css('height', dur < 1 ? '80px' : ($(this).data('duration')/60)*80 + 'px');

            // init all the data of the event
            var eventObject = {
              title          : $(this).find('.txt span').text(),
              eventColor     : $(this).data('color'),
              start          : $(this).data('start'),
              end            : $(this).data('end'),
              type           : $(this).find('.category').text(),
              author         : $(this).find('.txt strong').text(),
              picture        : $(this).find('img').attr('src'),
              duration       : $(this).data('duration'),
              room           : $(this).find('.bottom .ven').text(),
              selection      : $(this).find('.bottom .competition').text(),
              eventPictogram : $(this).data('picto').substr(1),
              id             : $(this).data('id'),
              url            : $(this).data('url')
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
          date = $(this).data('date');

          $.ajax({
            type: "GET",
            dataType: "html",
            cache: false,
            data:{'date':date},
            url: GLOBALS.urls.calendarProgrammationUrl,
            success: function (data) {
              $('.v-wrapper').html(data);
              initDraggable();

              filter();

              /*updateFilterCalendar();*/
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

    try {
      var agenda = localStorage.getItem('agenda_press');
    } catch(e) {
      var agenda = null;
    }

    if(agenda != null) {
      events = JSON.parse(agenda);

      for (var i = 0; i < events.length; i++) {
        if (events[i].id == id) {
          events.splice(i, 1);
        }
      }

      try {
        localStorage.setItem('agenda_press', JSON.stringify(events));
      } catch(e) {}
    }

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
      var value = jQuery(this).attr('data-offset');
      $.ajax({
        type: "GET",
        dataType: "html",
        cache: false,
        url: GLOBALS.urls.loadPressReleaseUrl + "?offset=" + value,
        success: function (data) {
          var $data = data;
          var $container = $('#gridAudios');
          var  $grid;
          $grid = $container.imagesLoaded(function () {
            setGrid($grid, $data, false);
          });
          setTimeout(function() {
            $('.item').addClass('visible');
            $grid.isotope('layout');
          },1000);

        }
      });
    });
  }

  // POPIN LOCK //
  function popinInit() {
    if($('.press.lock').length && !$('.connected').length) {
      if($('#popin-press').length) {
        $('.buttons:not(".active-btn")').on('click', function () {

          if($('#popin-press').hasClass('visible-popin')) {
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

      $(document).on('touchstart click',function (e) {
        var $element = $(e.target);
        if (!$element.hasClass('visible-popin')) {
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
      if ($('.popin-download-press').length) {

        $('.buttons.active-btn button').on('touchstart click', function (e) {
          e.stopPropagation();
          e.preventDefault();

          var target = $(this).data('target');

          if(typeof target != 'undefined' && target != "" && $('.popin-download-press[data-popin="' + target + '"]').length) {
            if ($('.popin-download-press[data-popin="'+target+'"]').hasClass('visible-popin')) {
              $('.popin-download-press[data-popin="'+target+'"]').removeClass('visible-popin');
              $("#main").removeClass('overlay-popin');
              $('footer').removeClass('overlay');
            } else {
              $('.popin-download-press[data-popin="'+target+'"]').addClass("visible-popin");
              $("#main").addClass('overlay-popin');
            }
          }
        });

        $(document).keyup(function (e) {
          // if (e.keyCode == 13) $('.save').click();
          if (e.keyCode == 27) {
            $('.popin-download-press').removeClass('visible-popin');
            $("#main").removeClass('overlay-popin');
            $('footer').removeClass('overlay');
            $('.overlay-div').remove();
          }
        });

        $(document).on('touchstart click', function (e) {
          var $element = $(e.target);
          if (!$element.hasClass('visible-popin')) {
            var $isPopin = $element.closest('.visible-popin');
            var isButton = $element.hasClass('buttons');

            if ($isPopin.length || isButton) {
            } else {
              $('.popin-download-press').removeClass('visible-popin');
              $("#main").removeClass('overlay-popin');
              $('footer').removeClass('overlay');
            }
          }
        });
      }
    }

    //FOR ALL PRESS PAGE//
    if (!$('.lock').length) {
      if ($('.popin-download-press').length) {

        $('.buttons button[data-target]').on('touchstart click', function (e) {
          e.stopPropagation();
          e.preventDefault();

          var target = $(this).data('target');

          if(typeof target != 'undefined' && target != "" && $('.popin-download-press[data-popin="' + target + '"]').length) {
            if ($('.popin-download-press[data-popin="'+target+'"]').hasClass('visible-popin')) {
              $('.popin-download-press[data-popin="'+target+'"]').removeClass('visible-popin');
              $("#main").removeClass('overlay-popin');
              $('footer').removeClass('overlay');
            } else {
              $('.popin-download-press[data-popin="'+target+'"]').addClass("visible-popin");
              $("#main").addClass('overlay-popin');
            }
          }
          return false;
        });

        $(document).keyup(function (e) {
          // if (e.keyCode == 13) $('.save').click();
          if (e.keyCode == 27) {
            $('.popin-download-press').removeClass('visible-popin');
            $("#main").removeClass('overlay-popin');
            $('footer').removeClass('overlay');
            $('.overlay-div').remove();
          }
        });

        $(document).on('touchstart click', function (e) {
          var $element = $(e.target);
          if (!$element.hasClass('visible-popin')) {
            var $isPopin = $element.closest('.visible-popin');
            var isButton = $element.hasClass('buttons');

            if ($isPopin.length || isButton) {
              //do nothing
            } else {
              $('.popin-download-press').removeClass('visible-popin');
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
    function getFormData($form) {
      var unindexed_array = $form.serializeArray();
      var indexed_array = {};

      $.map(unindexed_array, function(n, i) {
        indexed_array[n['name']] = n['value'];
      });

      return indexed_array;
    }

    $('.create').on('click', function () {
      $('#create-event-pop').addClass("visible-popin");

      $('#form_data').on('submit',function(e) {
        e.preventDefault;

        //vérification des données reçues//
        $('#create-event-pop input[type=text]').each(function(index,value) {
          if($(this).val() == "" && $(this).attr("name") != 'description' && $(this).attr("name") != 'place') {
            $(this).addClass('error');
          } else {
            if($(this).hasClass('error')) {
              $(this).removeClass('error');
            }
          }
        });

        if(!$('#create-event-pop input[type=text]').hasClass('error')) {
          //récupération des données sous forme de JSON//
          var $form = $(this);
          var data = getFormData($form);


          date1 = data.datebegin;
          date1 = date1.replace(/\//g,'-');
          hour1 = data.hoursbegin;
          hour1 = hour1.replace('h',':');
          date1 = date1+"T"+hour1;
          date2 = data.dateend;
          date2 = date2.replace(/\//g,'-');
          hour2 = data.hoursend;
          hour2 = hour2.replace('h',':');
          date2 = date2+"T"+hour2;

          var dateBegin = new Date(date1);
          var dateEnd = new Date(date2);
          var _userOffset = dateBegin.getTimezoneOffset()*60000;

          if(dateEnd < dateBegin) {
            $('#create-event-pop input[name="datebegin"], \
               #create-event-pop input[name="hoursbegin"], \
               #create-event-pop input[name="dateend"], \
               #create-event-pop input[name="hoursend"]').addClass('error');
            return false;
          } else {
            $('#create-event-pop input[name="datebegin"], \
               #create-event-pop input[name="hoursbegin"], \
               #create-event-pop input[name="dateend"], \
               #create-event-pop input[name="hoursend"]').removeClass('error');
            $('#create-event-pop').removeClass("visible-popin");

            id = guid();
            var titleEvent = (data.title.length > 17) ? jQuery.trim(data.title).substring(0, 40).split(" ").slice(0, -1).join(" ") + "..." : data.title;
             //Création de l'évènement et affichage sur le calendrier
            var myEvent = {
                 "title": titleEvent,
                 "eventColor": "#fff",
                 "start": new Date(dateBegin.getTime()+_userOffset),
                 "end": new Date(dateEnd.getTime()+_userOffset),
                 "type": 'custom',
                 "description" : data.description,
                 "duration": (dateEnd-dateBegin)/60000,
                 "room": data.place,
                 "eventPictogram": "pen",
                 "id": id,
                 "url": "eventPopin.html"
            };
            $('#mycalendar').fullCalendar( 'renderEvent', myEvent );
            $(this)[0].reset();

            myEvent['start'] = dateBegin;
            myEvent['end']   = dateEnd;

            try {
              var agenda = localStorage.getItem('agenda_press');
            } catch(e) {
              var agenda = null;
            }

            if (agenda == null) {
              events.push(myEvent);
              try {
                localStorage.setItem('agenda_press', JSON.stringify(events));
              } catch(e) {}
            } else {
              // get events, add the event and store
              events = JSON.parse(agenda);
              events.push(myEvent);
              try {
                localStorage.setItem('agenda_press', JSON.stringify(events));
              } catch(e) {}
            }
          }
        }
        return false;
      });
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
  // if ($('.fullcalendar').length) {
  //   $('.fc-event-container').on('click', function (e) {
  //     var url = $(this).attr('src');
  //
  //     // load the url of the event via ajax
  //     openPopinEvent(url);
  //   });
  // }

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
  if($('.press-media').length) {
    menuMedia();
    initSlideshows();
  }

  if($('.downloading-press').length) {
    initSlideshows();
  }

  //mediatheque AJAX
  function ajaxEvent() {
    $('.press-media .nav-mediapress td').on('click', function (e) {
      e.preventDefault();

      if ($(this).is(':not(.active)')) {
        var urlPath = $(this).data('cat');

        $.ajax({
          type:'GET',
          url: urlPath,

          success:function(data){


            var matches = data.match(/<title>(.*?)<\/title>/);
            var spUrlTitle = matches[1];
            document.title = spUrlTitle;

            setTimeout(function(){
              $('.nav-container').removeClass('load');
            }, 800);

            setTimeout(function(){
              $('.loader').remove();
              $('.nav-container').remove();
              $('.nav-popin').remove();
              $('.nav-mediapress').after($(data).find('.nav-container'));
              $('.nav-container').after($(data).find('.nav-popin'));

            }, 1000);


            history.pushState('', GLOBALS.texts.url.title, urlPath);
            ajaxEvent();
            menuMedia();
            initSlideshows();
            popinInit();


          },
          beforeSend: function(){
            $('.nav-container').addClass('load');
            $('.nav-container').append('<img class="loader" src="'+GLOBALS.urls.loadingImg+'" alt="">');
          }
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
      var s            = $(window).scrollTop(),
          h            = $("#main").height() - 180,
          affiche      = $('#affiche-officielle').length ? $('#affiche-officielle').offset().top - 180 : 0,
          signature    = $('#signature').length ? $('#signature').offset().top - 180 : 0,
          animation    = $('#animation').length ? $('#animation').offset().top - 180 : 0,
          photosInst   = $('#photos-institutionnelles').length ? $('#photos-institutionnelles').offset().top - 180 : 0,
          dossierPress = $('#dossier-presse').length ? $('#dossier-presse').offset().top - 180 : 0;

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
        if($(the_id).length > 0) {
          $('html, body').animate({
            scrollTop: $(the_id).offset().top - 300
          }, 'slow');
        }

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
  var dateStart = typeof GLOBALS.dateStart !== "undefined" ? GLOBALS.dateStart : '2016-05-11';
  var dateEnd = typeof GLOBALS.dateEnd !== "undefined" ? GLOBALS.dateEnd : '2016-05-22';
  var dateStartArray = dateStart.split('-');
  var dateEndArray = dateEnd.split('-');

  dateStartArray[0] = parseInt(dateStartArray[0]);
  dateStartArray[1] = parseInt(dateStartArray[1]) - 1;
  dateStartArray[2] = parseInt(dateStartArray[2]);

  dateEndArray[0] = parseInt(dateEndArray[0]);
  dateEndArray[1] = parseInt(dateEndArray[1]) - 1;
  dateEndArray[2] = parseInt(dateEndArray[2]);

  var minDatePicker = new Date(dateStartArray[0], dateStartArray[1], dateStartArray[2]);
  var maxDatePicker = new Date(dateEndArray[0], dateEndArray[1], dateEndArray[2]);
  var pickerBegin = new Pikaday({
      field        : document.getElementById('datepickerBegin'),
      format       : 'YYYY/MM/D',
      formatSubmit : 'yyyy-mm-dd',
      hiddenSuffix : '',
      minDate      : minDatePicker,
      firstDay     : 1,
      maxDate      : maxDatePicker,
      i18n         : {
        previousMonth : 'Previous Month',
        nextMonth     : 'Next Month',
        months        : GLOBALS.calendar.i18n.months,
        weekdays      : GLOBALS.calendar.i18n.weekdays,
        weekdaysShort : GLOBALS.calendar.i18n.weekdaysShort
      }
  });

  var pickerEnd = new Pikaday({
      field    : document.getElementById('datepickerEnd'),
      format   : 'YYYY/MM/D',
      minDate  : minDatePicker,
      maxDate  : maxDatePicker,
      firstDay : 1,
      i18n     : {
        previousMonth : 'Previous Month',
        nextMonth     : 'Next Month',
        months        : GLOBALS.calendar.i18n.months,
        weekdays      : GLOBALS.calendar.i18n.weekdays,
        weekdaysShort : GLOBALS.calendar.i18n.weekdaysShort
      }
  });

  var time = $('.hours').timepicker({
    timeFormat: typeof GLOBALS.calendar.i18n.labelFormat[GLOBALS.locale] !== "undefined" ? GLOBALS.calendar.i18n.labelFormat[GLOBALS.locale] : GLOBALS.calendar.i18n.labelFormat.default,
    minTime: '8:00am',
    maxTime: '3:00am',
  });

  // DEV OVERRIDE
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

  function updateFilterCalendar() {
    $('#type .select span').each(function() {
      var filterselect = $(this).attr('data-filter');
      if(filterselect == 'all') {
        $(this).addClass('active');
      } else {
        $(this).removeClass('active');
      }
      if($('.v-container [data-type="' + filterselect + '"]').length > 0 || filterselect == 'all') {
        $(this).removeClass('disabled');
      } else {
        $(this).addClass('disabled');
      }
    });

    $('#category .select span').each(function() {
      var filterselect = $(this).attr('data-filter');
      if(filterselect == 'all') {
        $(this).addClass('active');
      } else {
        $(this).removeClass('active');
      }
      if($('.v-container [data-category="' + filterselect + '"]').length > 0 || filterselect == 'all') {
        $(this).removeClass('disabled');
      } else {
        $(this).addClass('disabled');
      }
    });
  }
});