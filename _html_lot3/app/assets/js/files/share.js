//setup twitter

window.twttr = (function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
    if (d.getElementById(id)) return t;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js, fjs);

    t._e = [];
    t.ready = function (f) {
        t._e.push(f);
    };

    return t;
}(document, "script", "twitter-wjs"));


var initRs = function () {
    
    $('.print').on('click', function(e){
        e.preventDefault();
    });

    //POPIN facebook SHARE
    $('.block-social-network .facebook, .rs-slideshow .facebook, .button.facebook').off('click').on('click', function (e) {
        e.preventDefault();
        window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');
        return false;
    });


    $('.block-social-network .twitter, .rs-slideshow .twitter').off('click').on('click', function (e) {
        window.open(this.href, '', 'width=600,height=400');
        return false;
    });

    function initPopinMail(cls) {
        // check that fields are not empty
        $(cls).find('#form').css('display','block');
        $(cls).find('.info-popin').css('display','block');
        $(cls).find('#msg').html('');

        //add artist name to popin on artist page
        if($('.contentartist').length){
            var title = $('.contentartist').find('.title-15').text();
            $(cls).find('.contain-popin .title-article').text(title);
        } else if ($('.tetiere-movie').length){

            var title = $('.tetiere-movie').find('h2').text();
            var authors = $('.tetiere-movie').find('a').text();
            var synopsis = $('.synopsis').find('p').text().substring(0, 150);

            $(cls).find('.contain-popin .date-article').text(authors);
            $(cls).find('.contain-popin .chap-article').text(synopsis);
        }
        $(cls).find('.contain-popin .title-article').text(title);

        $(cls + ' input[type="text"]', cls + ' textarea').on('input', function () {
            var input = $(this);
            var is_name = input.val();

            if (typeof $(this).attr('required') != undefined && $(this).attr('required') && is_name.length > 0) {
                input.removeClass("invalid").addClass("valid");
                $('.errors .' + input.attr('name')).remove();
            } else {
                input.removeClass("valid").addClass("invalid");
                $('.errors .' + input.attr('name')).remove();
                $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + '</li>');
            }

            if ($('.invalid').length) {
                $('.errors').addClass('show');
            } else {
                $('.errors').removeClass('show');
            }
        });

        $('body').off('click').on('click', '.selectOptions span', function () {
            var i = parseInt($(this).index()) + 1;
            $('select option').eq(i).prop('selected', 'selected');
            $('.select').removeClass('invalid');
        });

        // check valid email address
        $(cls + ' input[type="email"]').off('input').on('input', function () {
            var input = $(this);
            var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            var is_email = re.test(input.val());
            var is_email_name = input.val();

            if (!is_email_name) {
                input.removeClass("valid").addClass("invalid");
                $('.errors .' + input.attr('name')).remove();
                $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.empty + '</li>');

            } else if (is_email) {
                input.removeClass("invalid").addClass("valid");
                $('.errors .' + input.attr('name')).remove();

            } else {
                input.removeClass("valid").addClass("invalid");
                $('.errors .' + input.attr('name')).remove();
                $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.error + '</li>');
                // TODO remove string //
            }

            if ($('.invalid').length) {
                $('.errors').addClass('show');
            } else {
                $('.errors').removeClass('show');
            }
        });

        // check valid email address
        $('#contact_email').off('input').on('input', function () {
            var input = $(this);
            var re = /^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},?)+$/i;
            var is_email = re.test(input.val());
            var is_email_name = input.val();

            if (!is_email_name) {
                input.removeClass("valid").addClass("invalid");
                $('.errors .' + input.attr('name')).remove();
                $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.empty + '</li>');

            } else if (is_email) {
                input.removeClass("invalid").addClass("valid");
                $('.errors .' + input.attr('name')).remove();

            } else {
                input.removeClass("valid").addClass("invalid");
                $('.errors .' + input.attr('name')).remove();
                $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.error + '</li>');
                // TODO remove string //
            }

            if ($('.invalid').length) {
                $('.errors').addClass('show');
            } else {
                $('.errors').removeClass('show');
            }
        });

        // on submit : check if there are errors in the form
        $(cls + ' form').off('submit').on('submit', function (e) {
            e.preventDefault();
            var $that = $(this);
            var empty = false;

            if ($('select').val() == 'default') {
                $('.select').addClass('invalid');
            } else {
                $('.select').removeClass('invalid');
            }

            $(cls + ' input[type="text"], ' + cls + ' input[type="email"], ' + cls + ' textarea').each(function () {
                if (typeof $(this).attr('required') != undefined && $(this).attr('required') == true && $(this).val() == '') {
                    empty = true;
                }
            });

            if (empty) {
                $(cls + ' input[type="email"], ' + cls + ' input[type="text"], ' + cls + ' textarea').trigger('input');
            }

            if ($('.invalid').length || empty) {
                return false;
            } else {
                // TODO envoie du mail //
                var u = $(cls).hasClass('media') ? GLOBALS.urls.shareEmailMediaUrl : GLOBALS.urls.shareEmailUrl;

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    cache: false,
                    url: u,
                    data: $(cls).find('form#form').serializeArray(),
                    success: function (data) {
                        if (data.success == false) {

                        }
                        else {
                            // TODO envoie du mail //
                            $(cls).find('#form').css('display','none');
                            $(cls).find('.info-popin').css('display','none');
                            $(cls).find('#msg').append('<div class="valid">' + GLOBALS.texts.popin.valid + '</div>');
                            $(cls).css('height', '31%');
                            return false;
                        }
                    }
                });
            }
        });
    }


    if ($('.popin-mail').length > 0) {
        if($('.popin-mail-open').hasClass('ismovie')){

        } else {
            initPopinMail('.popin-mail');
            $('.popin-mail-open').off('click touchstart').on('click touchstart', function (e) {
                e.preventDefault();
                $('.overlay-popin').addClass('visible-popin');

                var title = $('.overlay-popin').find('.contain-popin .title-article').html();
                if(title.length > 80){
                    var croptile = title.substring(0, 80) + "...";
                    $('.overlay-popin').find('.contain-popin .title-article').html(croptile);
                }
                $('.overlay-popin').on('click', function (e) {

                    if (!$(e.target).hasClass('popin')) {
                        $(this).removeClass('visible-popin');
                    }
                });
            });
        }

    }

    //LINK POPIN//
    var linkPopinInit = function(link, cls) {
        var link = link || document.location.href;
        var cls = cls || '.link';


        clipboard = new Clipboard(cls);
        
        $(cls).attr('data-clipboard-text', link);

        $(cls).off('click touchstart').on('click touchstart', function (e) {

            e.preventDefault();

            $('#share-box').remove();

            var that = $(this);


            if (!$('#share-box').length) {

                $('.texts-clipboard').append('<div id="share-box"><div class="bubble"><a href="#">' + GLOBALS.texts.popin.copy + '</a></div></div>');

                $('#share-box').animate({'opacity': '1'}, 400, function () {
                    $('#share-box').addClass('show');
                    setTimeout(function () {
                        $('#share-box .bubble').html('<a href="#">' + that.attr('data-clipboard-text') + '</a>');
                    }, 1000);
                });
            } else if ($('#share-box').hasClass('show')) {
                $('#share-box').removeClass('show');
                $('#share-box').remove();
            }

           setTimeout(function () {
                $('#share-box').remove();
                $('#share-box').remove();
               //two time because first don't work...

               setTimeout(function () {
                   $('#share-box').remove();
                   $('#share-box').remove();
                   //two time because first don't work...

                   linkPopinInit = 0;
               }, 1000);

            }, 3000);

        });

    }

    linkPopinInit();
}
