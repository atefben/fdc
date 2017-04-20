$(document).ready(function() {

  // Events on scroll
  // =========================
  var lastScrollTop = 0,
      $header = $('header'),
      $timeline = $('#timeline'),
      $navMovie = $('#nav-movie');

  var calTop = $('.venues').offset().top - 80;
  console.log(calTop);

  // when comming from /programmation calendar display the day the user was on see #3589
  if (localStorage.getItem('calendar_day')) {
    var calendar_day = $('.timeline-container').find('[data-date="' + parseInt(localStorage.getItem('calendar_day')) + '"]');
    if (calendar_day.length == 1) {
      $('.timeline-container').find('.active').removeClass()
      calendar_day.addClass('active');
      localStorage.removeItem('calendar_day');
    }
  }

  $(window).on('scroll', function () {
    var s = $(this).scrollTop();
    scrollTarget = s;

    if ($('#timeline-calendar').length > 0 && !$('.press-home').length > 0) {
      if (!$('.programmation-press').length > 0) {

        calTop = $('.venues').offset().top - 93;

        if (s > calTop) {
          var w = s - calTop + 120;
          w = w + "px";
          $('#timeline-calendar').css('transform', 'translateY(' + w + ')').css('z-index', 3);
          /*
           $('.calendar .nav').css('transform', 'translateY(' + w + ')').css('z-index', 3);
           */
        } else {
          $('#timeline-calendar').css('transform', 'translateY(' + 0 + ')');
          /*
           $('.calendar .nav').css('transform', 'translateY(' + 0 + ')').css('z-index', 3);
           */
        }
      } else {

        if (s > calTop) {
          var w = s - calTop
          w = w + "px";

          $('.calendar .v-head').css('transform', 'translateY(' + w + ')');
          $('.calendar .nav').css('transform', 'translateY(' + w + ')').css('z-index', 3);

        } else {

          $('.calendar .v-head').css('transform', 'translateY(' + 0 + ')');
          $('.calendar .nav').css('transform', 'translateY(' + 0 + ')').css('z-index', 3);
        }
      }

    }
  });

  // Renvoie un UID unique
  function guid() {
    return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
    function s4() {
      return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
    }
  }

  // init array of events
  var events = [];
  // get local storage
  var agenda = localStorage.getItem('agenda_press');
  // if local storage, get the events
  if (agenda != null) {
     events = JSON.parse(agenda);
  }

  addEventsInCalendar();

  function displayProgrammationDay(day) {
    var startDayDate = new Date("2016-05-"+day+"T08:00:00").getTime();
    var endDayDate = new Date("2016-05-"+(day+1)+"T03:00:00").getTime();

    $(".fc-event").each(function () {
      var startDate = new Date($(this).data('start')).getTime();
      if(startDate >= startDayDate && startDate <= endDayDate) {
        $(this).css('display','block');
      } else {
        $(this).css('display','none');
      }
    });
  }

  function heigthEvent() {
    $('.fc-event').each(function (index, value) {
      var h = $(value).attr('data-duration');
      h = h * 2.65;
      $(value).css('height', h + 'px');
    })
  }

  function addEventsInCalendar() {
    events.sort(function(a, b) {
      if (new Date(a.start) > new Date(b.start)) return 1;
      if (new Date(a.start) < new Date(b.start)) return -1;
      return 0;
    });

    $.each(events, function(index, evt){
      if (evt.type != 'custom') {
        $('.v-container').append('<div class="fc-event" data-category="reprise" data-type="reprise" data-url="' + evt.url + '" data-id="' + evt.id + '" data-color="' + evt.eventColor + '" data-start="' + evt.start + '" data-end="' + evt.end + '" data-time="' + evt.time + '" data-duration="' + evt.duration + '"><p class="remove-evt"><i class="icon icon_close"></p></i><span class="category"><i class="icon ' + evt.eventPictogram + '"></i><span class="cat-title">' + evt.type + '</span></span><div class="info"><img src="' + evt.picture + '"><div class="txt"><span>' + evt.title + '</span><strong>' + evt.author + '</strong></div></div><div class="bottom"><span class="duration">' + Math.floor(evt.duration / 60) + 'H' + (evt.duration % 60 < 10 ? '0' : '') + (evt.duration % 60) + '</span> <span class="dash">-</span> <span class="ven">' + evt.room + '</span><span class="competition">' + evt.selection + '</span></div></div>');
      } else {
        $('.v-container').append('<div class="fc-event" data-category="reprise" data-type="reprise" data-id="'+evt.id+'" data-color="'+evt.eventColor+'" data-start="'+evt.start+'" data-end="'+evt.end+'" data-time="'+evt.time+'" data-duration="'+evt.duration+'"><p class="remove-evt"><i class="icon icon_close"></p></i><span class="category"><i class="icon '+evt.eventPictogram+'"></i><span class="cat-title">'+evt.type+'</span></span><div class="info"><div class="txt"><span>'+evt.title+'</span></div></div><div class="bottom"><span class="duration">' + Math.floor(evt.duration / 60) + 'H' + (evt.duration % 60 < 10 ? '0' : '') + (evt.duration % 60) + '</span> <span class="dash">-</span> <span class="ven">'+evt.room+'</span></div></div>');
      }
    });

    var endDate = new Date("1900-01-01T00:00:00").getTime();

    $(".fc-event").each(function () {
      // allows to display two events at same hour (or overlap) in the same column
      // it works only if element (fc-event) are added in chronologic order
      var startDate = new Date($(this).data('start')).getTime();

      if(startDate < endDate) {
        $(this).addClass('half');
        if(!$(this).prev('.fc-event').hasClass('half')) {
          $(this).prev('.fc-event').addClass('half');
        }
      }

      endDate = new Date($(this).data('end')).getTime();
      // short event (less than 2 hours)
      // based on time start and duration, calculate positions of event
      var timeStart = $(this).data('time'),
          dur = Math.floor($(this).data('duration') / 60),
          minutes = $(this).data('duration') % 60,
          base = 8;
      var mT = timeStart - base;

      if (minutes == 0) {
        minutes = '';
      }
      if (dur < 2) {
        $(this).addClass('one-hour');
        $(this).find('.txt span').prepend(dur + 'H' + minutes + ' - ');
      }

      //add color
      $(this).find('.category').css('background-color', $(this).data('color'));
      $(this).css('margin-top', mT*170+10);
    });

    $('.calendar').on('click', '.fc-event', function (e) {
      var url = $(this).data('url');
      openPopinEvent(url);
    });

    // delete event from localStorage
    $('.fc-event').on('click', '.remove-evt', function (e) {
      e.preventDefault();

      var id = parseInt($(this).parent().data('id'));
      var agenda = localStorage.getItem('agenda_press');
      events = JSON.parse(agenda);

      for (var i = 0; i < events.length; i++) {
        if (events[i].id == id) {
          events.splice(i, 1);
        }
      }

      localStorage.setItem('agenda_press', JSON.stringify(events));
      $(this).parent().remove();
    });

    displayProgrammationDay($('.timeline-container .active').data('date'));
    heigthEvent();
  };

  function moveTimeline(element, day) {
    var numDay = 0;
    if(day == 11) {
      numDay = 0;
    } else if(day == 22) {
      numDay = 9
    } else {
      numDay = day - 12;
    }

    $('#timeline .timeline-container').css('left', - numDay * 130 + 'px');
    $('#timeline a').removeClass('active');
    element.addClass('active');
  }

  $('#timeline a').on('click', function(e) {
    e.preventDefault();

    if($(this).hasClass('active') || $(this).hasClass('disabled')) {
      return false;
    }

    $('#timeline a').removeClass('active');
    $(this).addClass('active');

    moveTimeline($(this), $(this).data('date'));
    displayProgrammationDay($('.timeline-container .active').data('date'));
  });

  $('#timeline-calendar .prev').on('click',function(e) {
    e.preventDefault();
    var day = $('.timeline-container').find('.active').data('date');

    if(day == 11) {
      return false;
    } else {
      moveTimeline($('.timeline-container').find("[data-date='" + (day - 1) + "']"),day-1);
      displayProgrammationDay($('.timeline-container .active').data('date'));
    }
  });

  $('#timeline-calendar .next').on('click',function(e) {
    e.preventDefault();
    var day = $('.timeline-container').find('.active').data('date'), numDay = 0;

    if(day == 22 || $('.timeline-container').find("[data-date='" + (day + 1) + "']").hasClass('disabled')) {
      return false;
    } else {
      moveTimeline($('.timeline-container').find("[data-date='" + (day + 1) + "']"),day+1);
      displayProgrammationDay($('.timeline-container .active').data('date'));
    }
  });

  // init timeline
  moveTimeline($('.timeline-container').find('.active'),$('.timeline-container').find('.active').data('date'));


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

    $('.create').on('click', function (e) {

      e.preventDefault();
      
      $('#create-event-pop').addClass("visible-popin");

      $('#form_data').on('submit',function(e) {
        e.preventDefault();

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

        console.log('ici');

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

            var titleEvent = (data.title.length > 17) ? jQuery.trim(data.title).substring(0, 15).split(" ").slice(0, -1).join(" ") + "..." : data.title;
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

            console.log(myEvent);

/*
            $('#mycalendar').fullCalendar( 'renderEvent', myEvent );
*/
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

    $('.btn-close').on('click', function () {
      $('#create-event-pop').removeClass('visible-popin');
    });
  }

  function openPopinEvent(url) {
    $.ajax({
      type: "GET",
      dataType: "html",
      cache: false,
      url: url,
      success: function (data) {
        $('.popin-event').remove();
        // display the html
        $('.calendar').append(data);

        // $('.popin-event').css('top', $(document).scrollTop());
        $('.popin-event .fc-event').each(function () {
          $(this).find('.category').css('background-color', $(this).data('color'));
          $(this).addClass($(this).data('picto').substr(1));
        });

        $('.events-container .fc-event').each(function () {
          var $this = $(this),
              id = $(this).data('id');

          for (var i = 0; i < events.length; i++) {
            if (id == events[i].id) {
              $this.parent().addClass('agenda');
              $this.parent().find('.button').removeClass('add').text(GLOBALS.texts.agenda.delete);
            }
          }

          // init all the data of the event
          var eventObject = {
            title: $(this).find('.txt span').text(),
            eventColor: $(this).data('color'),
            start: $(this).data('start'),
            end: $(this).data('end'),
            time: $(this).data('time'),
            type: $(this).find('.category').text(),
            author: $(this).find('.txt strong').text(),
            picture: $(this).find('img').attr('src'),
            duration: $(this).data('duration'),
            room: $(this).find('.bottom .ven').text(),
            selection: $(this).find('.bottom .competition').text(),
            eventPictogram: $(this).find('.category .icon').attr('class').split(' ')[1],
            id: $(this).data('id'),
            url: $(this).data('url')
          };

          // store the Event Object in the DOM element so we can get to it later
          $(this).data('eventObject', eventObject);

          var films = $(".owl-carousel-film").owlCarousel({
            nav: false,
            dots: false,
            smartSpeed: 500,
            margin: 20,
            autoWidth: true,
            loop: false,
            items: 1,
          });
          films.owlCarousel();

          $('body').addClass('no-scroll');
        });

        // show popin
        setTimeout(function () {
          $('.popin-event').addClass('show');
          // $('#main').addClass('event-open');
          $('body').addClass('overlay');
        }, 100);

        // close popin
        $('.calendar').on('click', '.close-button', function (e) {
          e.preventDefault();

          $('.popin-event').removeClass('show');
          $('body').removeClass('overlay');
          setTimeout(function () {
            $('.popin-event').remove();
          }, 600);
        });

        // add event
        $('.calendar').on('click', '.event .add', function (e) {
          e.preventDefault();

          var $ev = $(this).parent().find('.fc-event');
          var originalEventObject = $ev.data('eventObject');
          var copiedEventObject = $.extend({}, originalEventObject);

          if (events.filter(function (e) {
                return e.id == copiedEventObject.id;
              }).length > 0) {
            return false;
          }

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

          $(this).parent().addClass('agenda');
          $(this).removeClass('add').text(GLOBALS.texts.agenda.delete);
        });

        // delete event
        $('.calendar').on('click', '.event.agenda .button', function (e) {
          e.preventDefault();

          var id = parseInt($(this).parent().find('.fc-event').data('id'));
          var agenda = localStorage.getItem('agenda_press');
          events = JSON.parse(agenda);

          for (var i = 0; i < events.length; i++) {
            if (events[i].id == id) {
              events.splice(i, 1);
            }
          }

          localStorage.setItem('agenda_press', JSON.stringify(events));

          $(this).parent().removeClass('agenda');
          $(this).text('Ajouter').addClass('add');
        });
      }
    });
  }
  

  //swipe


  function swipedetect(el, callback){

    var touchsurface = el,
        swipedir,
        startX,
        startY,
        distX,
        distY,
        threshold = 150, //required min distance traveled to be considered swipe
        restraint = 100, // maximum distance allowed at the same time in perpendicular direction
        allowedTime = 300, // maximum time allowed to travel that distance
        elapsedTime,
        startTime,
        handleswipe = callback || function(swipedir){}

    touchsurface.addEventListener('touchstart', function(e){
      var touchobj = e.changedTouches[0]
      swipedir = 'none'
      dist = 0
      startX = touchobj.pageX
      startY = touchobj.pageY
      startTime = new Date().getTime() // record time when finger first makes contact with surface
/*
      e.preventDefault()
*/
    }, false)

    touchsurface.addEventListener('touchmove', function(e){
/*
      e.preventDefault() // prevent scrolling when inside DIV
*/

    }, false)

    touchsurface.addEventListener('touchend', function(e){
      var touchobj = e.changedTouches[0]
      distX = touchobj.pageX - startX // get horizontal dist traveled by finger while in contact with surface
      distY = touchobj.pageY - startY // get vertical dist traveled by finger while in contact with surface
      elapsedTime = new Date().getTime() - startTime // get time elapsed
      if (elapsedTime <= allowedTime){ // first condition for awipe met
        if (Math.abs(distX) >= threshold && Math.abs(distY) <= restraint){ // 2nd condition for horizontal swipe met
          swipedir = (distX < 0)? 'left' : 'right' // if dist traveled is negative, it indicates left swipe
          e.preventDefault()
        }
        else if (Math.abs(distY) >= threshold && Math.abs(distX) <= restraint){ // 2nd condition for vertical swipe met
          swipedir = (distY < 0)? 'up' : 'down' // if dist traveled is negative, it indicates up swipe
        }
      }
      handleswipe(swipedir)
    }, false)
  }

//USAGE:

   var el = document.getElementById('touchsurface');

  if (!el) return;

  swipedetect(el, function(swipedir){

     if (swipedir =='left'){
       var day = $('.timeline-container').find('.active').data('date'), numDay = 0;

       if(day == 22 || $('.timeline-container').find("[data-date='" + (day + 1) + "']").hasClass('disabled')) {
         return false;
       } else {
         moveTimeline($('.timeline-container').find("[data-date='" + (day + 1) + "']"),day+1);
         displayProgrammationDay($('.timeline-container .active').data('date'));
       }
     }

     if (swipedir =='right'){
       var day = $('.timeline-container').find('.active').data('date');

       if(day == 11) {
         return false;
       } else {
         moveTimeline($('.timeline-container').find("[data-date='" + (day - 1) + "']"),day-1);
         displayProgrammationDay($('.timeline-container .active').data('date'));
       }
     }
   })


});
