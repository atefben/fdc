jQuery(document).ready(function ($) {
    editEvents();
    dataTranslation();
    applyChanges();

    $(document).on('change', function () {
        applyChanges();
    });

    //change link to original edit
    if ($('#associatedNews').length > 0) {
        $('#associatedNews table').on('change', function () {
            var timesRun = 0;
            var interval = window.setInterval(function () {
                $('#associatedNews div .field-short-description span a').each(function (index) {
                    var old = $(this).attr('href');
                    old = old.split('/');

                    var text = $(this).text();
                    text = text.split(' ')[0].toLowerCase();
                    $(this).text($(this).text().replace($(this).text().split(' ')[0], ''));

                    old[4] = text;

                    $(this).attr('href', old.join('/'));
                });
                timesRun += 1;
                if (timesRun == 10) {
                    clearInterval(interval);
                }
            }, 500);
        });
        $('#associatedNews div .field-short-description span a').each(function (index) {
            var old = $(this).attr('href');
            old = old.split('/');

            var text = $(this).text();
            text = text.split(' ')[0].toLowerCase();
            $(this).text($(this).text().replace($(this).text().split(' ')[0], ''));

            old[4] = text;

            $(this).attr('href', old.join('/'));

        });
    }

    $('.sonata-ba-collapsed-fields .form-group .item a').each(function () {
        $(this).attr('title', $(this).attr('href'));
    })
    // preview
    var url = window.location.href;
    var newsUrl = url.split("/");

    if (newsUrl[6] == 'newsarticle' || newsUrl[6] == 'newsvideo' || newsUrl[6] == 'newsimage' || newsUrl[6] == 'newsaudio') {
        var slug = $('.a2lix_translationsFields-fr #btn-preview').data('preview')

        switch (newsUrl[6]) {
            case 'newsarticle':
                var format = 'articles';
                break;
            case 'newsvideo':
                var format = 'videos';
                break;
            case 'newsimage':
                var format = 'photos';
                break;
            case 'newsaudio':
                var format = 'audios';
                break;
        }

        var route = Routing.generate('fdc_event_news_get', {_locale: 'fr', format: format, slug: slug});
        $('.well.well-small.form-actions').append('<a target="_blank" href="' + route + '" class="btn btn-info" id="prev"> <i class="fa fa-search"></i> Prévisualiser </a>');
    }
    else if (newsUrl[6] == 'statementarticle' || newsUrl[6] == 'statementvideo' ||
        newsUrl[6] == 'statementimage' || newsUrl[6] == 'statementaudio' ||
        newsUrl[6] == 'infoarticle' || newsUrl[6] == 'infovideo' ||
        newsUrl[6] == 'infoimage' || newsUrl[6] == 'infoaudio') {
        var slug = $('.a2lix_translationsFields-fr #btn-preview').data('preview')

        switch (newsUrl[6]) {
            case 'statementarticle':
                var format = 'articles';
                var type = 'communique';
                break;
            case 'statementvideo':
                var format = 'videos';
                var type = 'communique';
                break;
            case 'statementimage':
                var format = 'photos';
                var type = 'communique';
                break;
            case 'statementaudio':
                var format = 'audios';
                var type = 'communique';
                break;
            case 'infoarticle':
                var format = 'articles';
                var type = 'info';
                break;
            case 'infovideo':
                var format = 'videos';
                var type = 'info';
                break;
            case 'infoimage':
                var format = 'photos';
                var type = 'info';
                break;
            case 'infoaudio':
                var format = 'audios';
                var type = 'info';
                break;
        }
        var route = Routing.generate('fdc_press_news_get', {_locale: 'fr', format: format, slug: slug, type: type});
        $('.well.well-small.form-actions').append('<a target="_blank" href="' + route + '" class="btn btn-info" id="prev"> <i class="fa fa-search"></i> Prévisualiser </a>');
    }
    else if (newsUrl[4] == 'ccmnewsarticle' || newsUrl[4] == 'ccmnewsvideo' ||
        newsUrl[4] == 'ccmnewsimage' || newsUrl[4] == 'ccmnewsaudio') {
        var slug = $('.a2lix_translationsFields-fr #btn-preview').data('preview');


        var route = Routing.generate('fdc_court_metrage_news_detail', {_locale: 'fr', slug: slug});
        $('.well.well-small.form-actions').append('<a target="_blank" href="' + route + '" class="btn btn-info" id="prev"> <i class="fa fa-search"></i> Prévisualiser </a>');
    }
    // on modal add, reload function
    $(window).on('shown.bs.modal', function () {
        if ($('.modal[aria-hidden="false"]').find('form[action*="create"]').length) {
            editEvents();
            dataTranslation();
        }
    });
    $('a[data-toggle=tab]').on('click', function () {
        dataTranslation();
    });

    //preview footer
    var url = window.location.href;
    var footerUrl = url.split("/");
    if (footerUrl[6] == 'fdcpagefooter') {
        var slug = $('.a2lix_translationsFields-fr #btn-preview').data('preview')
        var route = Routing.generate('fdc_event_footer_pagelibres', {slug: slug});
        $('.well.well-small.form-actions').append('<a target="_blank" href="' + route + '" class="btn btn-info" id="prev"> <i class="fa fa-search"></i> Prévisualiser </a>');
    }

    $('input[name$="[instit]"]').on('ifChanged', function() {
        if (!$(this).is(':checked')) {
            $('#level-nav').hide();
        } else {
            $('#level-nav').show();
        }
    });
    $('input[name$="[displayedHomeCorpo]"]').on('ifChanged', function() {
        if (!$(this).is(':checked')) {
            $('#level-nav').hide();
        } else {
            $('#level-nav').show();
        }
    });
    if ($('input[name$="[instit]"]').is(':checked') || $('input[name$="[displayedHomeCorpo]"]').is(':checked')) {
        $('#level-nav').show();
    } else {
        $('#level-nav').hide();
    }

});

function dataTranslation() {
    setTimeout(function () {
        $('div[data-translation]').each(function () {
            var translation = '#' + $(this).attr('data-translation');
            if ($(translation).height()) {
                $(this).height($(translation).height());
                $(this).css('overflow', 'scroll')
            }
            else {
                $(this).height('auto');
            }
        });
    }, 2000);
}

function editEvents() {

    // translate event on load
    if ($('input[name$="[translate]"]').is(':checked')) {
        $('.form-group[id$="priorityStatus"]').show();
        $('ul[id$="translateOptions"]').show();
    } else {
        $('.form-group[id$="priorityStatus"]').hide();
        $('ul[id$="translateOptions"]').hide();
    }

    $('input[name$="[translate]"]').closest('.icheckbox_minimal').on('ifChanged', function (e) {
        if (!$(e.target).is(':checked')) {
            $('.form-group[id$="priorityStatus"]').hide();
            $('ul[id$="translateOptions"]').hide();
        } else {
            $('.form-group[id$="priorityStatus"]').show();
            $('ul[id$="translateOptions"]').show();
        }
    });

    // displayed home on load
    if ($('input[name$="[displayedHome]"]').is(':checked')) {
        $('.displayed-home').show();
    } else {
        $('.displayed-home').hide();
    }

    // displayed home on click
    $('input[name$="[displayedHome]"]').on('ifChanged', function () {
        if (!$(this).is(':checked')) {
            $('.displayed-home').hide();
        } else {
            $('.displayed-home').show();
        }
    });

    // remove select2 status option for each language
    $('select[name*="status"]').each(function (i, e) {
        var idArray = $(e).attr('id').split('_');
        var locale = idArray[idArray.length - 2];
        var status = ['0', '1', '4', '6'];

        if (locale != 'fr') {
            status = ['0', '2', '3', '5'];
        }

        if ($('select[name*="status"]').hasClass('translator')) {
            status = ['3'];
        }

        if ($('select[name*="status"]').hasClass('master_translator')) {
            status = ['0', '1', '4'];
            if (locale != 'fr') {
                status = ['0', '2', '3', '5'];
            }
        }

        if ($('select[name*="status"]').hasClass('journalist')) {
            status = ['0', '4'];
            if ($('select[name*="status"]').val() === "1" || $('select[name*="status"]').val() === "6") {
                status = [];
            }
            if (locale != 'fr') {
                status = ['0', '2', '3', '5'];
            }

            var url = window.location.href;
            url = url.split("/");
            if (url[6] == 'mediaimage' ||
                url[6] == 'mediaaudio' ||
                url[6] == 'mediaimagesimple' ||
                url[6] == 'mediavideo' ||
                url[6] == 'gallery') {

                status = ['0', '1', '4', '6'];
                if (locale != 'fr') {
                    status = ['0', '2', '3', '5'];
                }
            }
        }

        if ($('select[name*="status"]').hasClass('orange')) {
            status = ['0', '1', '4', '6'];
            if (locale != 'fr') {
                status = ['5'];
            }
        }

        $(e).find('option').each(function (i, e) {
            if ($.inArray($(e).val(), status) == -1 && !$(e).is(':selected')) {
                $(e).remove();
            }
        });

    });

    // add border and set locale in form action on tab change
    $('body').on('click', '.a2lix_translationsLocales li', function () {
        $(this).closest('.a2lix_translationsLocales').find('li').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');

        var action = $('.sonata-ba-form > form').attr('action');
        var locale = $('.a2lix_translationsLocales li.nav-tab-active').attr('data-locale');

        $('.sonata-ba-form > form').attr('action', action.slice(0, -2) + locale);

        //set height of widgets sidebar
        setTimeout(function () {
            if (!$('.a2lix_translationsFields .tab-pane.active').hasClass('a2lix_translationsFields-fr')) {
                $('.a2lix_translationsFields .tab-pane.active .row').eq(1).find('.col-md-8 .base-widget').each(function (key, widget) {
                    $('.a2lix_translationsFields .tab-pane.active .row').eq(1).find('.col-md-4 .base-widget').eq(key).height($(widget).height());
                });
            }
        }, 2000);
    });

    //set height of widgets sidebar on load
    if ($('.a2lix_translationsLocales li.active').attr('data-locale') != 'fr') {
        $('.a2lix_translationsFields .tab-pane.active .row').eq(1).find('.col-md-8 .base-widget').each(function (key, widget) {
            $('.a2lix_translationsFields .tab-pane.active .row').eq(1).find('.col-md-4 .base-widget').eq(key).height($(widget).height());
        });
    }

    // set locale in form action on load
    var action = $('.sonata-ba-form > form').attr('action');
    var locale = $('.a2lix_translationsLocales li.active').attr('data-locale');
    $('.sonata-ba-form > form').attr('action', action + '&locale=' + locale);


    // Hide the status for french translation and select publish only when no status where selected before
    if ($('.status-hidden').length && $.isNumeric($('.status-hidden select option:selected').val()) == false) {
        $('.status-hidden select').val(1).change();
        $('.status-hidden').hide();
    }

    if ($('.is-mobile-notification-form').length) {
        $('.form-actions').append('<button class="btn btn-warning" id="btn-send-test" type="button"><i class="fa fa-paper-plane-o"></i> Envoyer</button>')
    }
    $('#btn-send-test').click(function () {
        $('input[id*=sendTest]').val('1');
        if ($('button[name=btn_create_and_edit]').length) {
            $('button[name=btn_create_and_edit]').click();
        }
        else if ($('button[name=btn_update_and_edit]').length) {
            $('button[name=btn_update_and_edit]').click();
        }
    });

}

function applyChanges() {
    var languages = ['en', 'fr', 'es', 'zh'];
    $.each(languages, function (index, value) {
        if ($('.a2lix_translationsLocales.nav-tabs li[data-locale=' + value + ']').length == 0) {
            $('input[id$=_translations_' + value + '_applyChanges]').val(0);
        }
    })
}