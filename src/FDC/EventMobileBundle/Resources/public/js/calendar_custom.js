$(document).ready(function () {
    // Renvoie un UID unique
    function guid() { // must be integer so it passes parseInt validation from remove event
        return parseInt((Math.floor(Math.random() * (999999 - 999 + 1)) + 999) + '' + new Date().getTime());
    }

    // POPIN CALENDAR CREAT EVENT //
    if ($('#create-event-pop').length) {

        function getFormData($form) {
            var unindexed_array = $form.serializeArray();
            var indexed_array = {};

            $.map(unindexed_array, function (n, i) {
                indexed_array[n['name']] = n['value'];
            });

            return indexed_array;
        }

        $('.create').off('click').on('click', function (e) {

            e.preventDefault();

            $('#create-event-pop').addClass("visible-popin");

            $('#form_data').off('submit').on('submit', function (e) {
                e.preventDefault();

                //vérification des données reçues//
                $('#create-event-pop input[type=text]').each(function (index, value) {
                    if ($(this).val() == "" && $(this).attr("name") != 'description' && $(this).attr("name") != 'place') {
                        $(this).addClass('error');
                    } else {
                        if ($(this).hasClass('error')) {
                            $(this).removeClass('error');
                        }
                    }
                });

                if (!$('#create-event-pop input[type=text]').hasClass('error')) {
                    //récupération des données sous forme de JSON//
                    var $form = $(this);
                    var data = getFormData($form);

                    date1 = data.datebegin;
                    date1 = date1.replace(/\//g, '-');
                    hour1 = data.hoursbegin;
                    hour1 = hour1.replace('h', ':');
                    date1 = date1 + "T" + hour1;
                    date2 = data.dateend;
                    date2 = date2.replace(/\//g, '-');
                    hour2 = data.hoursend;
                    hour2 = hour2.replace('h', ':');
                    date2 = date2 + "T" + hour2;

                    var dateBegin = new Date(date1);
                    var dateEnd = new Date(date2);
                    var _userOffset = dateBegin.getTimezoneOffset() * 60000;


                    if (dateEnd < dateBegin || !(dateEnd instanceof Date) || !(dateBegin instanceof Date)) {
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
                        var dateBeginTimezoned = new Date(dateBegin.getTime() + _userOffset);
                        var dateEndTimezoned = new Date(dateEnd.getTime() + _userOffset);
                        var myEvent = {
                            "title": titleEvent,
                            "eventColor": "#fff",
                            "start": dateBeginTimezoned,
                            "end": dateEndTimezoned,
                            "type": 'custom',
                            "description": data.description,
                            "time": dateBeginTimezoned.getHours(),
                            "duration": (dateEnd - dateBegin) / 60000,
                            "room": data.place,
                            "eventPictogram": "pen",
                            "id": id,
                            "url": "eventPopin.html"
                        };

                        /*
                         $('#mycalendar').fullCalendar( 'renderEvent', myEvent );
                         */
                        $(this)[0].reset();

                        myEvent['start'] = dateBegin;
                        myEvent['end'] = dateEnd;

                        try {
                            var agenda = localStorage.getItem('agenda_press');
                        } catch (e) {
                            var agenda = null;
                        }
                        var error = false;
                        if (agenda == null) {
                            var events = [];
                            events.push(myEvent);
                            try {
                                localStorage.setItem('agenda_press', JSON.stringify(events));
                            } catch (e) {
                                error = true;
                            }
                        } else {
                            // get events, add the event and store
                            events = JSON.parse(agenda);
                            events.push(myEvent);
                            try {
                                localStorage.setItem('agenda_press', JSON.stringify(events));
                            } catch (e) {
                                error = true;
                            }
                        }

                        if (!error) {
                            $('.v-container').append('<div class="fc-event fc-event-custom" data-category="reprise" data-type="reprise" data-id="'+myEvent.id+'" data-color="'+myEvent.eventColor+'" data-start="'+myEvent.start+'" data-end="'+myEvent.end+'" data-time="'+myEvent.time+'" data-duration="'+myEvent.duration+'"><p class="remove-evt remove-myEvent"><i class="icon icon_close"></p></i><span class="category"><i class="icon '+myEvent.eventPictogram+'"></i><span class="cat-title">'+myEvent.title+'</span></span><div class="info"><div class="txt"><span>'+myEvent.description+'</span></div></div><div class="bottom"><span class="duration">' + Math.floor(myEvent.duration / 60) + 'H' + (myEvent.duration % 60 < 10 ? '0' : '') + (myEvent.duration % 60) + '</span> <span class="dash">-</span> <span class="ven">'+myEvent.room+'</span></div></div>');

                            $(".fc-event").each(function () {
                                if ($(this).data('id') == myEvent.id) {
                                    // short event (less than 2 hours)
                                    // based on time start and duration, calculate positions of event
                                    var dur = Math.floor($(this).data('duration') / 60),
                                        minutes = $(this).data('duration') % 60;

                                    if (minutes == 0) {
                                        minutes = '';
                                    }
                                    if (dur < 2) {
                                        $(this).addClass('one-hour');
                                        $(this).find('.txt span').prepend(dur + 'H' + minutes + ' - ');
                                    }

                                    //add color
                                    $(this).find('.category').css('background-color', $(this).data('color'));


                                    var startDate = new Date($(this).data("start"))
                                        , duration = $(this).data("duration")
                                        , time = $(this).data("time");

                                    var h = duration * 2.7;
                                    $(this).css('height', h + 'px');

                                    $(this).css("margin-top", (time - 8) * 170 + startDate.getMinutes() / 60 * 170 + 5);

                                    var day = $('.timeline-container .active').data('date');
                                    var startDayDate = new Date("2016-05-"+day+"T00:00:00").getTime();
                                    var endDayDate = new Date("2016-05-"+day+"T23:59:59").getTime();
                                    if(startDate >= startDayDate && startDate <= endDayDate) {
                                        $(this).css('display','block');
                                    } else {
                                        $(this).css('display','none');
                                    }
                                    // delete event from localStorage
                                    $(this).on('click', '.remove-evt', function (e) {
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
                                }
                            });
                        }
                    }
                }
                return false;
            });
        });
    }
});
