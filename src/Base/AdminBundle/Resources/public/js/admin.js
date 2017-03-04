var Admin = Admin || {};

// disable popover error messages
Admin.add_pretty_errors = function () {
};

$(document).ready(function () {
    for (var i in CKEDITOR.instances) {
        CKEDITOR.instances[i].on('change', function () {
            console.log('log instance ckeditor');
            $('.cke div.info').each(function () {
                if ($(this).find('p').length) {
                    console.log('log div info');
                    $(this).html('<p>' + $(this).html + '</p>');
                }
            });
        });
    }

    if ($('#homepageSlideArea').length > 0) {
        var timesRun = 0;
        var countTopVideos = $('#homepageSlideArea a[onclick$="_homepageSlide(this);"]').closest('div').find('tbody').find('tr').size();
        if (countTopVideos > 5) {
            $('#homepageSlideArea a[onclick$="_homepageSlide(this);"]').hide();
        }

        $(document).on('click', '#homepageSlideArea a[onclick$="_homepageSlide(this);"]', function () {
            var countTopVideos = $('#homepageSlideArea a[onclick$="_homepageSlide(this);"]').closest('div').find('tbody').find('tr').size();
            if (countTopVideos >= 5) {
                window.setInterval(function () {
                    $('#homepageSlideArea a[onclick$="_homepageSlide(this);"]').hide();
                    timesRun += 1;
                    if (timesRun == 10) {
                        clearInterval(interval);
                    }
                }, 100);
            }
        });
    }

    if ($('#topVideosAssociatedArea').length > 0) {
        var timesRun = 0;
        var countTopVideos = $('#topVideosAssociatedArea a[onclick$="_topVideosAssociated(this);"]').closest('div').find('tbody').find('tr').size();
        if (countTopVideos > 4) {
            $('#topVideosAssociatedArea a[onclick$="_topVideosAssociated(this);"]').hide();
        }

        $(document).on('click', '#topVideosAssociatedArea a[onclick$="_topVideosAssociated(this);"]', function () {
            var countTopVideos = $('#topVideosAssociatedArea a[onclick$="_topVideosAssociated(this);"]').closest('div').find('tbody').find('tr').size();
            if (countTopVideos >= 4) {
                window.setInterval(function () {
                    $('#topVideosAssociatedArea a[onclick$="_topVideosAssociated(this);"]').hide();
                    timesRun += 1;
                    if (timesRun == 10) {
                        clearInterval(interval);
                    }
                }, 100);
            }
        });
    }

    if ($('#topWebTvsAssociatedArea').length > 0) {
        var timesRun = 0;
        var countTopVideos = $('#topWebTvsAssociatedArea a[onclick$="_topWebTvsAssociated(this);"]').closest('div').find('tbody').find('tr').size();
        if (countTopVideos > 9) {
            $('#topWebTvsAssociatedArea a[onclick$="_topWebTvsAssociated(this);"]').hide();
        }

        $(document).on('click', '#topWebTvsAssociatedArea a[onclick$="_topWebTvsAssociated(this);"]', function () {
            var countTopVideos = $('#topWebTvsAssociatedArea a[onclick$="_topWebTvsAssociated(this);"]').closest('div').find('tbody').find('tr').size();
            if (countTopVideos >= 9) {
                window.setInterval(function () {
                    $('#topWebTvsAssociatedArea a[onclick$="_topWebTvsAssociated(this);"]').hide();
                    timesRun += 1;
                    if (timesRun == 10) {
                        clearInterval(interval);
                    }
                }, 100);
            }
        });
    }

    if ($('#filmsAssociatedArea').length > 0) {
        var timesRun = 0;
        var countTopVideos = $('#filmsAssociatedArea a[onclick$="_filmsAssociated(this);"]').closest('div').find('tbody').find('tr').size();
        if (countTopVideos > 4) {
            $('#filmsAssociatedArea a[onclick$="_filmsAssociated(this);"]').hide();
        }

        $(document).on('click', '#filmsAssociatedArea a[onclick$="_filmsAssociated(this);"]', function () {
            var countTopVideos = $('#filmsAssociatedArea a[onclick$="_filmsAssociated(this);"]').closest('div').find('tbody').find('tr').size();
            if (countTopVideos >= 4) {
                window.setInterval(function () {
                    $('#filmsAssociatedArea a[onclick$="_filmsAssociated(this);"]').hide();
                    timesRun += 1;
                    if (timesRun == 10) {
                        clearInterval(interval);
                    }
                }, 100);
            }
        });
    }

    if ($('input[name$="[displayedWebTv]"]').is(':checked')) {
        $('.form-group[id$="webTv"]').show();
    } else {
        $('.form-group[id$="webTv"]').hide();
    }

    $('input[name$="[displayedWebTv]"]').on('ifChanged', function () {
        if (!$(this).is(':checked')) {
            $('.form-group[id$="webTv"]').hide();
        } else {
            $('.form-group[id$="webTv"]').show();
        }
    });

    if ($('.displayed-home-info').length || $('.displayed-home-statement').length) {
        function checkDisplayHomeInfoStatementCheckbox() {
            var $displayedHomeLabel = $('.form-group[id$="displayedHomepageLabel"]');
            var $displayedOnCorpoHomeLabel = $('.form-group[id$="displayedOnCorpoHomeLabel"]');
            if ($("input[id*='sites_1']").is(':checked')) {
                $displayedHomeLabel.show();
            } else {
                $displayedHomeLabel.hide();
            }
            if ($("input[id*='sites_3']").is(':checked')) {
                $displayedOnCorpoHomeLabel.show();
            } else {
                $displayedOnCorpoHomeLabel.hide();
            }
        }

        checkDisplayHomeInfoStatementCheckbox();
        $("input[id*='sites_1'], input[id*='sites_3']").on('ifChanged', function () {
            checkDisplayHomeInfoStatementCheckbox()
        });
    }
    else {
        function checkDisplayHomeNewsCheckbox() {
            var $displayedHomeLabel = $('.form-group[id$="displayedHomepageLabel"]');
            if ($("input[id*='sites_1']").is(':checked')) {
                $displayedHomeLabel.show();
            } else {
                $displayedHomeLabel.hide();
            }
        }

        checkDisplayHomeNewsCheckbox();
        $("input[id*='sites_1']").on('ifChanged', function () {
            checkDisplayHomeNewsCheckbox()
        });
    }

    //change link to original edit for home
    if ($('#homepageSlide').length > 0) {
        $(document).on('change', '#homepageSlide table', function () {
            var timesRun = 0;
            var interval = window.setInterval(function () {
                $('#homepageSlide div .field-short-description span a').each(function (index) {
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

        $('#homepageSlide div .field-short-description span a').each(function (index) {
            var old = $(this).attr('href');
            old = old.split('/');

            var text = $(this).text();
            text = text.split(' ')[0].toLowerCase();
            $(this).text($(this).text().replace($(this).text().split(' ')[0], ''));

            old[4] = text;

            $(this).attr('href', old.join('/'));

        });
    }

    lockEvents();
    dashboardTranslator();
});


// call the ajax method to handle lock
function lockEvents() {

    // tooltip display
    $('.fdc-list-translation-type-square').tooltip({
        items: 'div[fdc-tooltip]',
        position: {
            my: 'right',
            at: 'left left'
        },
        // prevent close
        close: function (event, ui) {
            ui.tooltip.hover(function () {
                    $(this).stop(true).fadeTo(400, 1);
                }, function () {
                    $(this).fadeOut('400', function () {
                        $(this).remove();
                    });
                }
            );
        },
        content: function () {
            return $(this).attr('fdc-tooltip')
        }
    });

    $('a.fdc-is-locked').click(function (e) {
        e.preventDefault();
    })

    // unlock article
    $('body').on('click', '.fdc-translation-unlock', function (e) {
        e.preventDefault();
        // set params
        var url = $(this).attr('href').split('/');
        var id = url[url.length - 2];
        var entity = url[url.length - 3];
        var locale = getQueryParams($(this).attr('href').split('?')[1], 'locale');
        var html = "Vous êtes sur le point de débloquer l'article.<br/>\
                <br/>\
                Le contributeur en cours d'édition de l'article perdra l'ensemble de ses modifications.<br/>\
                <br/>\
                La page sera rechargée après confirmation.\
        ";
        // display dialog
        $('#fdc-dialog-text').html(html);
        $('#fdc-dialog').dialog({
            width: 400,
            modal: true,
            title: 'Attention',
            autoOpen: true,
            buttons: {
                'Confirmer': function () {
                    deleteLock(entity, id, locale, true);
                },
                'Annuler': function () {
                    $(this).dialog('close');
                }
            }
        });
    });

    // verify existing locks on click list
    $('.fdc-check-lock-list:not(".fdc-is-locked")').click(function (e) {
        e.preventDefault();
        // set vars
        var url = $(this).attr('href').split('/');
        var id = url[url.length - 2];
        var entity = url[url.length - 3];
        var redirect = $(this).attr('href');
        var target = false;

        if ($(this).attr('href').split('?').length >= 2) {
            var locale = getQueryParams($(this).attr('href').split('?')[1], 'locale');
        } else {
            var locale = 'fr';
        }

        var isLocked = ($(this).hasClass('fdc-is-locked'));
        if ($(this).attr('data-target') && $(this).attr('data-target') == '_blank') {
            var target = '_blank';
        } else if ($(this).attr('data-edit') && $(this).attr('data-edit') == 'true') {
            var target = 'edit';
        }

        hasLockList(entity, id, locale, isLocked, redirect, target);
    });

    // verify locks on submit
    $('.fdc-lock button[type="submit"].btn-success').click(function (e) {
        e.preventDefault();

        // add a get parameter when clicking on submit button btn_create_and_list / btn_update_and_list
        if ($(this).attr('name') == 'btn_create_and_list' ||
            $(this).attr('name') == 'btn_update_and_list') {
            var action = $(this).closest('form').attr('action') + '&list=true';
            $(this).closest('form').attr('action', action)
        }
        // set vars
        var url = window.location.href.split('/');
        var id = url[url.length - 2];
        var entity = url[url.length - 3];
        var locale = $('.a2lix_translationsLocales').find('li.active').attr('data-locale');
        var redirect = $(this).attr('href');

        hasLockEntity(entity, id, locale, $(this));
    });

    // check if our page has the mandatory class
    if ($('body').hasClass('fdc-lock')) {
        var url = window.location.href.split('/');
        // check if we are in the edition of an article
        if (url[url.length - 1].indexOf('edit') > -1) {
            // set vars
            var id = url[url.length - 2];
            var entity = url[url.length - 3];
            var locale = $('.a2lix_translationsLocales').find('li.active').attr('data-locale');

            // create lock on open
            createLock(entity, id, locale);

            // delete lock on click on list
            $('a[href$="/list"]').click(function () {
                deleteLock(entity, id, locale);
            });

            // delete lock on close
            $(window).unload(function () {
                deleteLock(entity, id, locale);
            });
        }
    }

    // add border on changing lang
    $('body').on('click', '.a2lix_translationsLocales li', function () {
        $(this).closest('.a2lix_translationsLocales').find('li').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
    });


}

function getQueryParams(url, param) {
    var found = '';

    if (url.split("&") !== 'undefined') {
        url.split("&").forEach(function (item) {
            if (param == item.split("=")[0]) {
                found = item.split("=")[1];
            }
        });
    }

    return found;
};

function hasLockEntity(entity, id, locale, button) {
    var request = $.ajax({
        url: Routing.generate('base_admin_lock_checkentity', {id: id}),
        dataType: 'json',
        method: 'POST',
        data: {
            entity: entity,
            locale: locale
        }
    });

    request.success(function (xhr) {
        if (xhr.error == 0) {
            var html = "Un utilisateur a modifié l'actualité entre temps.<br/>\
                Vous ne pourrez pas enregistrer vos modifications.<br/>\
                <br/>\
                Veuilez tout d'abord à copier dans un fichier texte toutes les modifications que vous avez effectuées puis à recharger la page pour réinsérer vos modifications et les enregistrer.\
            ";
            $('#fdc-dialog-text').html(html);
            $('#fdc-dialog').dialog({
                width: 400,
                modal: true,
                title: 'Modifications entre temps',
                autoOpen: true,
                buttons: {
                    'OK': function () {
                        $(this).dialog('close');
                    }
                }
            });
        } else if (xhr.error == 1) {
            var html = "Un utilisateur est en cours d'édition de cette actualité.<br/>\
                Vous ne pourrez pas enregistrer vos modifications.<br/>\
                <br/>\
                Veuilez tout d'abord à copier dans un fichier texte toutes les modifications que vous avez effectuées puis à réimpacter ces modifications lorsque l'actualité sera de nouveau disponible.\
            ";
            $('#fdc-dialog-text').html(html);
            $('#fdc-dialog').dialog({
                width: 400,
                modal: true,
                title: 'Modifications en cours',
                autoOpen: true,
                buttons: {
                    'OK': function () {
                        $(this).dialog('close');
                    }
                }
            });
        } else if (xhr.success == true) {
            deleteLock(entity, id, locale);
            button.closest('form').submit();
        }
    });

    request.fail(function (xhr) {
        $('#fdc-dialog-text').html(xhr.responseJSON.message);
        $('#fdc-dialog').dialog({
            autoOpen: true
        });
    });
}

function hasLockList(entity, id, locale, isLocked, redirect, target) {
    target = typeof target !== 'undefined' ? target : false;

    var request = $.ajax({
        url: Routing.generate('base_admin_lock_check', {id: id}),
        dataType: 'json',
        method: 'POST',
        data: {
            entity: entity,
            locale: locale
        }
    });

    request.success(function (xhr) {
        if (isLocked != xhr.locked) {
            if (target === false) {
                var html = "Entre temps, un nouvel utilisateur a édité cet article.<br/>\
                <br/>\
                Rafraichissez la page pour voir le nouveau statut des articles.";
                var buttons = {
                    'Recharger la page': function () {
                        window.location.reload(true);
                    },
                    'Annuler': function () {
                        $(this).dialog('close');
                    }
                };
            } else if (target == 'edit') {
                if ($('body').hasClass('role_translator')) {
                    var html = "En cours de modification par " + xhr.lockedBy;
                    var buttons = {
                        'Fermer': function () {
                            $(this).dialog('close');
                        }
                    };
                } else {
                    var html = "Vous êtes sur le point de débloquer l'article.<br/>\
                    <br/>\
                    Le contributeur " + xhr.lockedBy + " est en cours d'édition de l'article et perdra l'ensemble de ses modifications.<br/>\
                    <br/>\
                    La page sera rechargée après confirmation.\
                    ";
                    var buttons = {
                        'Confirmer': function () {
                            deleteLock(entity, id, locale, true);
                        },
                        'Annuler': function () {
                            $(this).dialog('close');
                        }
                    };
                }
            } else {
                var html = "Cet élément est en cours d'édition par " + xhr.lockedBy + ".<br/>\
                <br/>";
                var buttons = {
                    'Fermer': function () {
                        $(this).dialog('close');
                    }
                };
            }

            $('#fdc-dialog-text').html(html);
            $('#fdc-dialog').dialog({
                width: 400,
                modal: true,
                title: 'Modifications en cours',
                autoOpen: true,
                buttons: buttons
            });

            $('.fdc-dialog-button.close').click(function () {

            });
        } else {
            if (target === false || target === 'edit') {
                window.location.href = redirect;
            } else {
                window.open(redirect, target);
            }
        }
    });

    request.fail(function (xhr) {
        $('#fdc-dialog-text').html(xhr.responseJSON.message);
        $('#fdc-dialog').dialog({
            autoOpen: true
        });
    });
}

function createLock(entity, id, locale) {
    var request = $.ajax({
        url: Routing.generate('base_admin_lock_create', {id: id}),
        dataType: 'json',
        method: 'POST',
        data: {
            entity: entity,
            locale: locale
        }
    });

    request.fail(function (xhr) {
        $('#fdc-dialog-text').html(xhr.responseJSON.message);
        $('#fdc-dialog').dialog({
            autoOpen: true
        });
    });
}

function deleteLock(entity, id, locale, success) {
    success = (typeof success === 'undefined') ? false : success;

    var request = $.ajax({
        url: Routing.generate('base_admin_lock_delete', {id: id}),
        dataType: 'json',
        method: 'POST',
        data: {
            entity: entity,
            locale: locale
        },
        async: success
    });


    if (success) {
        request.success(function () {
            window.location.reload(true);
        });
    }

    request.fail(function (xhr) {
        $('#fdc-dialog-text').html(xhr.responseJSON.message);
        $('#fdc-dialog').dialog({
            autoOpen: true
        });
    });
}

function dashboardTranslator() {
    // on click clear dashboard filter
    $('#dashboard-search button[type="submit"].btn-default').click(function () {
        $('#dashboard_search_type_reset').val(1);
    });

    // submit form on value change of status
    $('#dashboard_search_type_status').on('change', function () {
        $(this).closest('form').submit();
    });

    // submit form on select filter of search
    $('.dashboard-search-filter').click(function () {
        $('input[name$="[sortField]"]').val($(this).attr('data-field'));
        $('input[name$="[sortValue]"]').val($(this).attr('data-val'));
        $('form[action="/admin/dashboard"]').submit();
    });
}