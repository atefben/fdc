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
                $this.parent().find('.button').removeClass('add').text(GLOBALS.texts.agenda.delete); //TODO traduction, enlever la string // 
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
            if(event.duration/60 < 2) {
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
            lang: GLOBALS.locale , // TODO a verifier
            defaultDate: GLOBALS.defaultDate,
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
              if(event.duration/60 < 2) {
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
                      $this.parent().find('.button').removeClass('add').text(GLOBALS.texts.agenda.delete);
                    }
                  }
                });
              }
              
            }
          });

          if($('.communiques').length) {
            function resizeGridNews() {
              var w = 0;

              $('.communiques article').each(function() {
                if($(this).css('display') != 'none') {
                  w += $(this).outerWidth();
                }
              });
              $('.communiques .grid-wrapper').width(w/2);
            }

            resizeGridNews();
            $(window).resize(function() {
              resizeGridNews();
            });
          }

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
              $(this).removeClass('add').text(GLOBALS.texts.agenda.delete);
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
                    dur = Math.floor($(this).data('duration') / 60),
                    minutes = $(this).data('duration') % 60;

                if(minutes == 0) {
                  minutes = '';
                }

                if(dur < 2) {
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
                url: GLOBALS.urls.calendarProgrammationUrl,
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
    $('.read-more').on('click', function (e) {
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
  
  function popinInit(){
    
    if ($('.press.lock').length) {
      if ($('#popin-press').length) {
        $('.buttons:not(".active-btn")').on('click',function () {
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

        var $element= $(e.target);
        if($element.hasClass('visible-popin')){
   
        }else{
          var $isPopin = $element.closest('.visible-popin');
          var isButton = $element.hasClass('buttons');
         
          if($isPopin.length || isButton){
           
          }else{
              $('#popin-press').removeClass('visible-popin');
              $("#main").removeClass('overlay-popin');
              $('footer').removeClass('overlay');

          }
        }
      });

    }

    // POPIN DOWNLOAD //

    //ONLY FOR MEDIA//
      if ($('.press.lock').length) {
        if ($('#popin-download-press').length) {
          $('.buttons.active-btn').on('click',function () {
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

            var $element= $(e.target);
            if($element.hasClass('visible-popin')){

          }else{
            var $isPopin = $element.closest('.visible-popin');
            var isButton = $element.hasClass('buttons');

          if($isPopin.length || isButton){

          }else{
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
          $('.buttons').on('click',function () {
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

            var $element= $(e.target);
            if($element.hasClass('visible-popin')){

          }else{
            var $isPopin = $element.closest('.visible-popin');
            var isButton = $element.hasClass('buttons');

          if($isPopin.length || isButton){

          }else{
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

  if($('#create-event-pop').length){
        $('.create').on('click',function () {
            if ($('#create-event-pop').hasClass('visible-popin')) {
              $('#create-event-pop').removeClass('visible-popin');
//              $("#main").removeClass('overlay-popin');
//              $('footer').removeClass('overlay');
            } else {
              $('#create-event-pop').addClass("visible-popin");
//              $("#main").addClass('overlay-popin');
            }
          });

          $(document).keyup(function (e) {
            //        if (e.keyCode == 13) $('.save').click();
            if (e.keyCode == 27) {
              $('#create-event-pop').removeClass('visible-popin');
//              $("#main").removeClass('overlay-popin');
//              $('footer').removeClass('overlay');
            }
          });
           $('.btn-close').on('click',function (){
             $('#create-event-pop').removeClass('visible-popin');
           });
  }
  
  // POPIN Show event //
  
  if($('.fullcalendar').length){
    $('.fc-event-container').on('click', function(e) {
      var url = $(this).attr('src');
      console.log(e);
      // load the url of the event via ajax
      openPopinEvent(url);

    });
  }
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
  
  //Mediatheque nav 
      if($('.press-media').length){
        menuMedia();
        initSlideshows();
        if($('.connected').length){ //TODO add class .connected for change picto lock if connected // 
          var imgs = $('.connected').find('img[src="img/svg/cadenas.svg"]');
          console.log(imgs);
          imgs.attr('src','img/press/svg/telecharger.svg');
          //change img if connected 
          imgs.each(function(){
            $(this).attr('src','img/press/svg/telecharger.svg');
          })
        }
        svgImg();
      }
  
  if($('.downloading-press').length){
    initSlideshows();
  }
  
  //mediatheque AJAX
      function ajaxEvent(){
      $('.press-media .nav-mediapress td').on('click',function(e){
        e.preventDefault();
        if($(this).is(':not(.active)')) {
          var urlPath = $(this).data('cat');
          $.get(urlPath, function(data){
            $( ".nav-container" ).html( $(data).find('.nav-container') );
            history.pushState('',GLOBALS.texts.url.title, urlPath);
            ajaxEvent();
            menuMedia();
            svgImg();
            initSlideshows();
            popinInit();
          });
          $('.press-media .nav-mediapress').find('td.active').removeClass('active');
          $(this).addClass('active');
        }
      });
    }
  
  //fin chocolat js 
    function menuMedia(){
      var $info = $('.info, .media, .plus');
      $info.click(function(){
      var $active = $('.press-media .nav-container .table .line').find('.active');
      var $parent = $(this).closest(".container");
        if(!$parent.hasClass('active')){
            $active.removeClass('active');
            $parent.addClass('active');
        }else{
            $active.removeClass('active');
        }
      });
    }
  
    function svgImg(){
                jQuery('img.svg').each(function(){
          var $img = jQuery(this);
          var imgID = $img.attr('id');
          var imgClass = $img.attr('class');
          var imgURL = $img.attr('src');

          jQuery.get(imgURL, function(data) {
              // Get the SVG tag, ignore the rest
              var $svg = jQuery(data).find('svg');

              // Add replaced image's ID to the new SVG
              if(typeof imgID !== 'undefined') {
                  $svg = $svg.attr('id', imgID);
              }
              // Add replaced image's classes to the new SVG
              if(typeof imgClass !== 'undefined') {
                  $svg = $svg.attr('class', imgClass+' replaced-svg');
              }

              // Remove any invalid XML tags as per http://validator.w3.org
              $svg = $svg.removeAttr('xmlns:a');

              // Replace image with new SVG
              $img.replaceWith($svg);

          }, 'xml');

      });
    }
    ajaxEvent();
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
  
  //downloding nav sticky 
  if($('.downloading-press').length){
        //Scroll
      $(window).on('scroll', function() {
        
        var s            = $(window).scrollTop(),
            h            = $("#main").height()-180,
            affiche      = $('#affiche-officielle').offset().top-180,
            signature    = $('#signature').offset().top-180,
            animation    = $('#animation').offset().top-180,
            photosInst   = $('#photos-institutionnelles').offset().top-180,
            dossierPress = $('#dossier-presse').offset().top-180;
          
        if(s > 180 ){
          $('.downloading-nav').addClass('sticky');
          $(".downloading-nav").css({position: "fixed",top:90, width: "100%", zIndex:5});
        } else if (s < 180){
          $(".downloading-nav").css({position: "relative",top:1, zIndex:1});
        }
        
        if( s > affiche && s < signature){
          $('.downloading-nav').find('.active').removeClass('active');
          $('a[href="#affiche-officielle"]').addClass('active');

        }else if( s > signature && s< animation){
          $('.downloading-nav').find('.active').removeClass('active');
          $('a[href="#signature"]').addClass('active');

        }else if( s > animation && s< photosInst){
          $('.downloading-nav').find('.active').removeClass('active');
          $('a[href="#animation"]').addClass('active');

        }else if( s > photosInst && s< dossierPress){
          $('.downloading-nav').find('.active').removeClass('active');
          $('a[href="#photos-institutionnelles"]').addClass('active');
        }else if( s > dossierPress){
          $('.downloading-nav').find('.active').removeClass('active');
          $('a[href="#dossier-presse"]').addClass('active');
        }
        
      });
    
    
    $('a[href^="#"]').click(function(){
      
      var is_sticky = $('.press').hasClass('sticky');
      var the_id = $(this).attr("href");
      
      if(!is_sticky){

        $('html, body').animate({
          scrollTop:$(the_id).offset().top-300
        }, 'slow');
        return false;
        
      }else{

        $('html, body').animate({
          scrollTop:$(the_id).offset().top-130
        }, 'slow');
        return false;
        
      }
    });
  
  }
  
  
  
});