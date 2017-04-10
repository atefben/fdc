$(document).ready(function () {
    $(".download-ics").on("click", function (a) {
        try {
            var b = localStorage.getItem("agenda_press")
        } catch (a) {
            var b = null
        }
        if (null == b)
            a.preventDefault();
        else {
            b = JSON.parse(b);
            for (var c = ics(), d = 0; d < b.length; d++) {
                var e = b[d].start;
                e = e.replace(".000Z", "");
                var a = b[d].end;
                a = a.replace(".000Z", "");
                var f = new Date(b[d].start)
                    , g = f.getUTCMonth() + 1 < 10 ? "0" + (f.getUTCMonth() + 1) : f.getUTCMonth() + 1;
                c.addEvent(b[d].title, "custom" === b[d].type ? b[d].description : GLOBALS.urls.programmationUrl + "?data=" + f.getUTCFullYear() + "-" + g + "-" + f.getUTCDate(), "custom" === b[d].type ? b[d].room : b[d].room + " – Palais des festivals / Cannes", e, a)
            }
            c.download()
        }
    });

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

var ics = function () {
    "use strict";
    if (navigator.userAgent.indexOf("MSIE") > -1 && navigator.userAgent.indexOf("MSIE 10") == -1)
        return void console.log("Unsupported Browser");
    var a = navigator.appVersion.indexOf("Win") !== -1 ? "\r\n" : "\n"
        , b = []
        , c = ["BEGIN:VCALENDAR", "VERSION:2.0", "X-WR-TIMEZONE:Europe/Paris", "BEGIN:VTIMEZONE", "TZID:Europe/Paris", "X-LIC-LOCATION:Europe/Paris", "BEGIN:DAYLIGHT", "TZOFFSETFROM:+0100", "TZOFFSETTO:+0200", "TZNAME:CEST", "DTSTART:19700329T020000", "RRULE:FREQ=YEARLY;BYMONTH=3;BYDAY=-1SU", "END:DAYLIGHT", "BEGIN:STANDARD", "TZOFFSETFROM:+0200", "TZOFFSETTO:+0100", "TZNAME:CET", "DTSTART:19701025T030000", "RRULE:FREQ=YEARLY;BYMONTH=10;BYDAY=-1SU", "END:STANDARD", "END:VTIMEZONE"].join(a)
        , d = a + "END:VCALENDAR";
    return {
        events: function () {
            return b
        },
        calendar: function () {
            return c + a + b.join(a) + d
        },
        addEvent: function (c, d, e, f, g) {
            if ("undefined" == typeof c || "undefined" == typeof d || "undefined" == typeof e || "undefined" == typeof f || "undefined" == typeof g)
                return !1;
            var h = new Date(f)
                , i = new Date(g)
                , j = new Date(h.getTime())
                , k = new Date(i.getTime())
                , l = ("0000" + j.getUTCFullYear().toString()).slice(-4)
                , m = ("00" + (j.getUTCMonth() + 1).toString()).slice(-2)
                , n = ("00" + j.getUTCDate().toString()).slice(-2)
                , o = ("00" + j.getUTCHours().toString()).slice(-2)
                , p = ("00" + j.getUTCMinutes().toString()).slice(-2)
                , q = ("00" + j.getUTCSeconds().toString()).slice(-2)
                , r = ("0000" + k.getUTCFullYear().toString()).slice(-4)
                , s = ("00" + (k.getUTCMonth() + 1).toString()).slice(-2)
                , t = ("00" + k.getUTCDate().toString()).slice(-2)
                , u = ("00" + k.getUTCHours().toString()).slice(-2)
                , v = ("00" + k.getUTCMinutes().toString()).slice(-2)
                , w = ("00" + k.getUTCSeconds().toString()).slice(-2)
                , x = ""
                , y = "";
            p + q + v + w !== 0 && (x = "T" + o + p + "00",
                y = "T" + u + v + "00");
            var z = l + m + n + x
                , A = r + s + t + y
                , B = ["BEGIN:VEVENT", "CLASS:PUBLIC", "DESCRIPTION:" + d, "DTSTART;TZID=Europe/Paris:" + z, "DTEND;TZID=Europe/Paris:" + A, "LOCATION:" + e, "SUMMARY;LANGUAGE=en-us:" + c, "TRANSP:TRANSPARENT", "END:VEVENT"].join(a);
            return b.push(B),
                B
        },
        download: function (e, f) {
            if (b.length < 1)
                return !1;
            f = "undefined" != typeof f ? f : ".ics",
                e = "undefined" != typeof e ? e : "calendar";
            var g, h = c + a + b.join(a) + d;
            if (navigator.userAgent.indexOf("MSIE 10") === -1)
                g = new Blob([h]);
            else {
                var i = new BlobBuilder;
                i.append(h),
                    g = i.getBlob("text/x-vCalendar;charset=" + document.characterSet)
            }
            return saveAs(g, e + f),
                h
        }
    }
};

var saveAs = saveAs || function (a) {
        "use strict";
        if ("undefined" == typeof navigator || !/MSIE [1-9]\./.test(navigator.userAgent)) {
            var b = a.document
                , c = function () {
                return a.URL || a.webkitURL || a
            }
                , d = b.createElementNS("http://www.w3.org/1999/xhtml", "a")
                , e = "download" in d
                , f = function (a) {
                var b = new MouseEvent("click");
                a.dispatchEvent(b)
            }
                , g = /Version\/[\d\.]+.*Safari/.test(navigator.userAgent)
                , h = a.webkitRequestFileSystem
                , i = a.requestFileSystem || h || a.mozRequestFileSystem
                , j = function (b) {
                (a.setImmediate || a.setTimeout)(function () {
                    throw b
                }, 0)
            }
                , k = "application/octet-stream"
                , l = 0
                , m = 4e4
                , n = function (a) {
                var b = function () {
                    "string" == typeof a ? c().revokeObjectURL(a) : a.remove()
                };
                setTimeout(b, m)
            }
                , o = function (a, b, c) {
                b = [].concat(b);
                for (var d = b.length; d--;) {
                    var e = a["on" + b[d]];
                    if ("function" == typeof e)
                        try {
                            e.call(a, c || a)
                        } catch (f) {
                            j(f)
                        }
                }
            }
                , p = function (a) {
                return /^\s*(?:text\/\S*|application\/xml|\S*\/\S*\+xml)\s*;.*charset\s*=\s*utf-8/i.test(a.type) ? new Blob(["\ufeff", a], {
                        type: a.type
                    }) : a
            }
                , q = function (b, j, m) {
                m || (b = p(b));
                var q, r, s, t = this, u = b.type, v = !1, w = function () {
                    o(t, "writestart progress write writeend".split(" "))
                }, x = function () {
                    if (r && g && "undefined" != typeof FileReader) {
                        var d = new FileReader;
                        return d.onloadend = function () {
                            var a = d.result;
                            r.location.href = "data:attachment/file" + a.slice(a.search(/[,;]/)),
                                t.readyState = t.DONE,
                                w()
                        }
                            ,
                            d.readAsDataURL(b),
                            void (t.readyState = t.INIT)
                    }
                    if ((v || !q) && (q = c().createObjectURL(b)),
                            r)
                        r.location.href = q;
                    else {
                        var e = a.open(q, "_blank");
                        void 0 === e && g && (a.location.href = q)
                    }
                    t.readyState = t.DONE,
                        w(),
                        n(q)
                }, y = function (a) {
                    return function () {
                        return t.readyState !== t.DONE ? a.apply(this, arguments) : void 0
                    }
                }, z = {
                    create: !0,
                    exclusive: !1
                };
                return t.readyState = t.INIT,
                j || (j = "download"),
                    e ? (q = c().createObjectURL(b),
                            void setTimeout(function () {
                                d.href = q,
                                    d.download = j,
                                    f(d),
                                    w(),
                                    n(q),
                                    t.readyState = t.DONE
                            })) : (a.chrome && u && u !== k && (s = b.slice || b.webkitSlice,
                            b = s.call(b, 0, b.size, k),
                            v = !0),
                        h && "download" !== j && (j += ".download"),
                        (u === k || h) && (r = a),
                            i ? (l += b.size,
                                    void i(a.TEMPORARY, l, y(function (a) {
                                        a.root.getDirectory("saved", z, y(function (a) {
                                            var c = function () {
                                                a.getFile(j, z, y(function (a) {
                                                    a.createWriter(y(function (c) {
                                                        c.onwriteend = function (b) {
                                                            r.location.href = a.toURL(),
                                                                t.readyState = t.DONE,
                                                                o(t, "writeend", b),
                                                                n(a)
                                                        }
                                                            ,
                                                            c.onerror = function () {
                                                                var a = c.error;
                                                                a.code !== a.ABORT_ERR && x()
                                                            }
                                                            ,
                                                            "writestart progress write abort".split(" ").forEach(function (a) {
                                                                c["on" + a] = t["on" + a]
                                                            }),
                                                            c.write(b),
                                                            t.abort = function () {
                                                                c.abort(),
                                                                    t.readyState = t.DONE
                                                            }
                                                            ,
                                                            t.readyState = t.WRITING
                                                    }), x)
                                                }), x)
                                            };
                                            a.getFile(j, {
                                                create: !1
                                            }, y(function (a) {
                                                a.remove(),
                                                    c()
                                            }), y(function (a) {
                                                a.code === a.NOT_FOUND_ERR ? c() : x()
                                            }))
                                        }), x)
                                    }), x)) : void x())
            }
                , r = q.prototype
                , s = function (a, b, c) {
                return new q(a, b, c)
            };
            return "undefined" != typeof navigator && navigator.msSaveOrOpenBlob ? function (a, b, c) {
                    return c || (a = p(a)),
                        navigator.msSaveOrOpenBlob(a, b || "download")
                }
                : (r.abort = function () {
                    var a = this;
                    a.readyState = a.DONE,
                        o(a, "abort")
                }
                    ,
                    r.readyState = r.INIT = 0,
                    r.WRITING = 1,
                    r.DONE = 2,
                    r.error = r.onwritestart = r.onprogress = r.onwrite = r.onabort = r.onerror = r.onwriteend = null,
                    s)
        }
    }("undefined" != typeof self && self || "undefined" != typeof window && window || this.content);
"undefined" != typeof module && module.exports ? module.exports.saveAs = saveAs : "undefined" != typeof define && null !== define && null !== define.amd && define([], function () {
        return saveAs
    });