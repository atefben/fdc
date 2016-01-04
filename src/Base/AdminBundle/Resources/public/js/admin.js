var Admin = Admin || {};

// disable popover error messages
Admin.add_pretty_errors = function(){};

$(document).ready(function() {
    lockEvents();
});

// call the ajax method to handle lock
function lockEvents()
{
    // tooltip display
    $('.fdc-list-translation-type-square').tooltip({
        items: 'div[fdc-tooltip]',
        position: {
            my: 'right',
            at: 'left left'
        },
        // prevent close
        close: function (event, ui) {
            ui.tooltip.hover(function() {
                    $(this).stop(true).fadeTo(400, 1);
                }, function() {
                    $(this).fadeOut('400', function() {
                        $(this).remove();
                    });
                }
            );
        },
        content: function() { return $(this).attr('fdc-tooltip') }
    });

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
                'Confirmer': function() {
                    deleteLock(entity, id, locale, true);
                },
                'Annuler': function() {
                    $(this).dialog('close');
                }
            }
        });
    });

    // verify existing locks
    $('.fdc-check-lock').click(function(e) {
        e.preventDefault();
        // set vars
        var url = $(this).attr('href').split('/');
        var id = url[url.length - 2];
        var entity = url[url.length - 3];
        var locale = getQueryParams($(this).attr('href').split('?')[1], 'locale');
        var isLocked = ($(this).hasClass('fdc-is-locked'));
        var redirect = $(this).attr('href');

        hasLock(entity, id, locale, isLocked, redirect);
    });

    // check if our page has the mandatory class
    if ($('body').hasClass('fdc-lock')) {
        var url = window.location.href.split('/');
        // check if we are in the edition of an article
        if (url.length == 9 && url[url.length - 1].indexOf('edit') > -1) {
            // set vars
            var id = url[url.length - 2];
            var entity = url[url.length - 3];
            var locale = getQueryParams(window.location.search.substr(1), 'locale');

             // create lock on open
            createLock(entity, id, locale);

            // delete lock on close
            $(window).unload(function () {
                deleteLock(entity, id, locale);
            });
        }
    }
}

function getQueryParams(url, param) {
    var found;

    url.split("&").forEach(function(item) {
        if (param ==  item.split("=")[0]) {
            found = item.split("=")[1];
        }
    });

    return found;
};

function hasLock(entity, id, locale, isLocked, redirect)
{
    var request = $.ajax({
        url: Routing.generate('base_admin_lock_check', { id: id }),
        dataType: 'json',
        method: 'POST',
        data: {
            entity: entity,
            locale: locale
        }
    });

    request.success(function (xhr) {
        if (isLocked != xhr.locked) {
            var html = "Entre temps, un nouvel utilisateur a édité cet article.<br/>\
                <br/>\
                Rafraichissez la page pour voir le nouveau statut des articles.\
            ";
            $('#fdc-dialog-text').html(html);
            $('#fdc-dialog').dialog({
                width: 400,
                modal: true,
                title: 'Modifications en cours',
                autoOpen: true,
                buttons: {
                    'Recharger la page': function() {
                        window.location.reload(true);
                    },
                    'Annuler': function() {
                        $(this).dialog('close');
                    }
                }
            });

            $('.fdc-dialog-button.close').click(function() {

            });
        } else {
            window.location.href = redirect;
        }
    });

    request.fail(function (xhr) {
        $('#fdc-dialog-text').html(xhr.responseJSON.message);
        $('#fdc-dialog').dialog({
            autoOpen: true
        });
    });
}

function createLock(entity, id, locale)
{
    var request = $.ajax({
        url: Routing.generate('base_admin_lock_create', { id: id }),
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

function deleteLock(entity, id, locale, success)
{
    success = (typeof success === 'undefined') ? false : success;
    var request = $.ajax({
        url: Routing.generate('base_admin_lock_delete', { id: id }),
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