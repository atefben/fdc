$(document).ready(function () {
    // Renvoie un UID unique
    function guid() {
        return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
        }
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

                        if (agenda == null) {
                            var events = [];
                            events.push(myEvent);
                            try {
                                localStorage.setItem('agenda_press', JSON.stringify(events));
                            } catch (e) {
                            }
                        } else {
                            // get events, add the event and store
                            events = JSON.parse(agenda);
                            events.push(myEvent);
                            try {
                                localStorage.setItem('agenda_press', JSON.stringify(events));
                            } catch (e) {
                            }
                        }
                    }
                }
                return false;
            });
        });
    }
});
