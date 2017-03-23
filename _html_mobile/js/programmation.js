$(document).ready(function () {
        if ($('.programmation-press').length || $('.press').length && !$('.calendar-press').length) {
            // init array of events
            var events = [];
            // get local storage
            var agenda = localStorage.getItem('agenda_press');
            // if local storage, get the events
            if (agenda != null) {
                events = JSON.parse(agenda);
            }

            var hW = $(window).height();



            // Events on scroll
            // =========================
            var lastScrollTop = 0,
                $header = $('header'),
                $timeline = $('#timeline'),
                $navMovie = $('#nav-movie'),
                $faqmenu = $(".faq-menu");

            var calTop = $('.venues').offset().top - 80;
            console.log(calTop);


            $(window).on('scroll', function () {
                var s = $(this).scrollTop();
                scrollTarget = s;

                if ($('#timeline-calendar').length > 0 && !$('.press-home').length > 0) {
                    if (!$('.programmation-press').length > 0) {

                        calTop = $('.venues').offset().top - 93;

                        if (s > calTop) {
                            var w = s - calTop;
                            w = w + "px";
                            $('.calendar .v-head').css('transform', 'translateY(' + w + ')');
                            $('.calendar .nav').css('transform', 'translateY(' + w + ')').css('z-index', 3);
                        } else {
                            $('.calendar .v-head').css('transform', 'translateY(' + 0 + ')');
                            $('.calendar .nav').css('transform', 'translateY(' + 0 + ')').css('z-index', 3);
                        }
                    } else {

                        if (s > calTop) {
                            var w = s - calTop;
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

            // STOP AGENDA PICTOS FIXED BEFORE NEWSLETTER BLOCK
            $(window).on('scroll', function () {
                var s = $(this).scrollTop();

                if (s + document.documentElement.clientHeight > $('#main').height() + 173) {
                    $('.agenda-access:not(.no-fixed)').css('position', 'absolute');
                    $('.agenda-access:not(.no-fixed)').css('bottom', '50px');
                } else {
                    $('.agenda-access:not(.no-fixed)').css('position', 'fixed');
                    $('.agenda-access:not(.no-fixed)').css('bottom', '40px');
                }
            });

            function displayProgrammationDay(day, isInit) {
                var url;
                if (GLOBALS.env == "html") {
                    if (day % 2 == 0) {
                        url = GLOBALS.urls.calendarDay2;
                    } else {
                        url = GLOBALS.urls.calendarDay1;
                    }
                } else {
                    url = GLOBALS.urls.calendarProgrammationUrl;
                }

                $.ajax({
                    type: "GET",
                    dataType: "html",
                    data: {'date': day},
                    cache: false,
                    url: url,
                    success: function (data) {
                        $('.v-wrapper').html(data);

                        var venues = $(".v-wrapper-content").owlCarousel({
                            nav: false,
                            dots: false,
                            smartSpeed: 500,
                            margin: 0,
                            autoWidth: true,
                            loop: false,
                            items: 2
                        });
                        venues.owlCarousel();


                        $('.calendar .v-container').each(function () {
                            var endDate = new Date("1900-01-01T00:00:00").getTime();

                            $(this).find(".fc-event").each(function () {
                                // allows to display two events at same hour (or overlap) in the same column
                                // it works only if element (fc-event) are added in chronologic order
                                var startDate = new Date($(this).data('start')).getTime();
                                /*if(startDate < endDate) {
                                 $(this).addClass('half');
                                 if(!$(this).prev('.fc-event').hasClass('half')) {
                                 $(this).prev('.fc-event').addClass('half');
                                 }
                                 }*/
                                endDate = new Date($(this).data('end')).getTime();

                                // based on time start and duration, calculate positions of event
                                var timeStart = $(this).data('time'),
                                    dur = Math.floor($(this).data('duration') / 60),
                                    minutes = $(this).data('duration') % 60,
                                    base = 8;
                                var mT = timeStart - base;

                                if (minutes == 0) {
                                    minutes = '';
                                }

                                // short event (less than 2 hours)
                                if (dur < 2) {
                                    $(this).addClass('one-hour');
                                    $(this).find('.txt span').prepend(dur + 'H' + minutes + ' - ');
                                }
                                //add color
                                $(this).find('.category').css('background-color', $(this).data('color'));
                                $(this).addClass($(this).data('picto').substr(1));
                                $(this).css('margin-top', mT * 170 + 10);

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

                                console.log(eventObject);

                                // store the Event Object in the DOM element so we can get to it later
                                $(this).data('eventObject', eventObject);

                                heigthEvent();

                            });
                        });

                        if ($('.programmation-press').length > 0 && !$('.press-home').length > 0) {
                            var init = true;

                            if (isInit == false) {

                                $(window).on('scroll', function () {
                                    var s = $(this).scrollTop();
                                    scrollTarget = s;

                                    var calTop = $('.venues').offset().top - 300;

                                    if (s > calTop && init) {
                                        init = false;

                                        setTimeout(function () {

                                            $.each($('.venues .owl-item'), function (i, e) {
                                                var n = $(e).find('.v-container .fc-event').length;

                                                if (n > 0) {

                                                    venues.trigger('to.owl.carousel', [i, 2, true])

                                                    var top = $(e).find('.v-container .fc-event').offset().top - 300;
                                                    $('html, body').animate({
                                                        scrollTop: top
                                                    }, 500);

                                                    return false;
                                                }
                                            })
                                        }, 500);
                                    }
                                });
                            } else {
                                setTimeout(function () {

                                    $.each($('.venues .owl-item'), function (i, e) {
                                        var n = $(e).find('.v-container .fc-event').length;

                                        if (n > 0) {

                                            venues.trigger('to.owl.carousel', [i, 2, true])

                                            var times = [];

                                            $.each($(e).find('.v-container .fc-event'), function (i, e) {
                                               times.push($(e).data('time'));
                                            });


                                            var val = 24;

                                            for(var o = 0; o<times.length; o++){
                                                if(times[o] < val){
                                                    val = times[o];
                                                }
                                            }

                                            $.each($(e).find('.v-container .fc-event'), function (i, e) {
                                                if($(e).data('time') == val) {
                                                    var time = $(e).data('time');

                                                    var top = $(e).offset().top - 300;
                                                    $('html, body').animate({
                                                        scrollTop: top
                                                    }, 500);

                                                    return false;
                                                }
                                            });


                                            return false;
                                        }
                                    })

                                }, 500);
                            }
                        }

                        $('.calendar').off('click', '.fc-event').on('click', '.fc-event', function (e) {
                            var url = $(this).data('url');
                            openPopinEvent(url);
                        });
                    }
                });
            }

            displayProgrammationDay($('.timeline-container .active').data('date'), false);

            function moveTimeline(element, day) {
                //console.log(element, day)
                var numDay = 0;
                if (day == 11) {
                    numDay = 0;
                } else if (day == 22) {
                    numDay = 9
                } else {
                    numDay = day - 12;
                }
                $('#timeline .timeline-container').css('left', -numDay * 130 + 'px');
                $('#timeline a').removeClass('active');
                element.addClass('active');
            }

            $('#timeline a').on('click', function (e) {
                e.preventDefault();

                if ($(this).hasClass('active') || $(this).hasClass('disabled')) {
                    return false;
                }

                $('#timeline a').removeClass('active');
                $(this).addClass('active');
                moveTimeline($(this), $(this).data('day'));
                displayProgrammationDay($('.timeline-container .active').data('date'), true);


            });

            $('#timeline-calendar .prev').on('click', function (e) {
                e.preventDefault();
                console.log($('.timeline-container').find('.active'));

                var day = $('.timeline-container').find('.active').data('day');
                console.log('click', day);
                if (day == 11) {
                    return false;
                } else {
                    moveTimeline($('.timeline-container').find("[data-day='" + (day - 1) + "']"), day - 1);
                    displayProgrammationDay($('.timeline-container .active').data('date'), true);
                }
            });

            $('#timeline-calendar .next').on('click', function (e) {
                e.preventDefault();
                var day = $('.timeline-container').find('.active').data('day'), numDay = 0;

                if (day == 22 || $('.timeline-container').find("[data-day='" + (day + 1) + "']").hasClass('disabled')) {
                    return false;
                } else {
                    moveTimeline($('.timeline-container').find("[data-day='" + (day + 1) + "']"), day + 1);
                    displayProgrammationDay($('.timeline-container .active').data('date'), true);
                }
            });

            // init timeline
            moveTimeline($('.timeline-container').find('.active'), $('.timeline-container').find('.active').data('day'));

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

            function heigthEvent() {
                $('.fc-event').each(function (index, value) {
                    var h = $(value).attr('data-duration');
                    h = h * 2.65;
                    $(value).css('height', h + 'px');
                })
            }

        }
    }
);
