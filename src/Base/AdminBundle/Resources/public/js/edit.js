jQuery(document).ready(function($) {
    editEvents();
    //change link to original edit
    if( $('#associatedNews').length > 0) {
        $('#associatedNews table').on('change', function() {
            var timesRun = 0;
            var interval = window.setInterval(function(){
                $('#associatedNews div .field-short-description span a').each(function(index){
                    var old = $( this ).attr('href');
                    old = old.split('/');

                    var text = $( this ).text();
                    text = text.split(' ')[0].toLowerCase();

                    old[4] = text;

                    $( this ).attr('href', old.join('/'));
                });
                timesRun += 1;
                if(timesRun == 10){
                    clearInterval(interval);
                }
            },500);
        });
        $('#associatedNews div .field-short-description span a').each(function(index){
            var old = $( this ).attr('href');
            old = old.split('/');

            var text = $( this ).text();
            text = text.split(' ')[0].toLowerCase();

            old[4] = text;

            $( this ).attr('href', old.join('/'));

        });
    }

    // preview
    var url = window.location.href;
    var newsUrl = url.split("/");

    if (newsUrl[6]== 'newsarticle' || newsUrl[6]== 'newsvideo' || newsUrl[6]== 'newsimage' || newsUrl[6]== 'newsaudio') {
        var slug = $('.a2lix_translationsFields-fr #btn-preview').data('preview')

        switch(newsUrl[6]) {
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

        var route = Routing.generate('fdc_event_news_get', { _locale: 'fr', format: format, slug: slug });
        $('.well.well-small.form-actions').append('<a target="_blank" href="'+route+'" class="btn btn-info" id="prev"> <i class="fa fa-search"></i> Prévisualiser </a>');
    }
    else if (newsUrl[6]== 'statementarticle' || newsUrl[6]== 'statementvideo' || newsUrl[6]== 'statementimage' || newsUrl[6]== 'statementaudio' || newsUrl[6]== 'infoarticle' || newsUrl[6]== 'infovideo' || newsUrl[6]== 'infoimage' || newsUrl[6]== 'infoaudio') {
        var slug = $('.a2lix_translationsFields-fr #btn-preview').data('preview')

        switch(newsUrl[6]) {
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
        var route = Routing.generate('fdc_press_news_get', { _locale: 'fr', format: format, slug: slug, type: type });
        $('.well.well-small.form-actions').append('<a target="_blank" href="'+route+'" class="btn btn-info" id="prev"> <i class="fa fa-search"></i> Prévisualiser </a>');
    }
    // on modal add, reload function
    $(window).on('shown.bs.modal', function() {
        if ($('.modal[aria-hidden="false"]').find('form[action*="create"]').length) {
            editEvents();
        }
    });

});

function editEvents() {

    // translate event on load
    if ($('input[name$="[translate]"]').is(':checked')) {
        $('.form-group[id$="priorityStatus"]').show();
        $('ul[id$="translateOptions"]').show();
    } else {
        $('.form-group[id$="priorityStatus"]').hide();
        $('ul[id$="translateOptions"]').hide();
    }

    $('input[name$="[translate]"]').closest('.icheckbox_minimal').on('ifChanged', function(e) {
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
    $('input[name$="[displayedHome]"]').on('ifChanged', function() {
        if (!$(this).is(':checked')) {
            $('.displayed-home').hide();
        } else {
            $('.displayed-home').show();
        }
    });

    // remove select2 status option for each language
    $('select[name*="status"]').each(function(i, e) {
        console.log(e);
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
            if(locale != 'fr') {
                status = ['0', '2', '3', '5'];
            }
        }

        if ($('select[name*="status"]').hasClass('journalist')) {
            status = ['0', '4'];
            if(locale != 'fr') {
                status = ['0', '2', '3', '5'];
            }
        }

        if ($('select[name*="status"]').hasClass('orange')) {
            status = ['0', '1', '4', '6'];
            if(locale != 'fr') {
                status = ['5'];
            }
        }

        $(e).find('option').each(function(i, e) {
            if ($.inArray($(e).val(), status) == -1) {
                $(e).remove();
            }
        });

    });

    // add border on changing lang
    $('body').on('click', '.a2lix_translationsLocales li', function() {
        $(this).closest('.a2lix_translationsLocales').find('li').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
    });

    // Hide the status for french translation
    if ($('.status-hidden').length) {
        $('.status-hidden select').val(1).change();
        $('.status-hidden').hide();
    }

    if ($('.is-mobile-notification-form').length) {
        $('.form-actions').append('<button class="btn btn-warning" id="btn-send-test" type="button"><i class="fa fa-paper-plane-o"></i> Envoyer un test</button>')
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