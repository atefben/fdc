var Admin = Admin || {};

// disable popover error messages
Admin.add_pretty_errors = function(){};

$(document).ready(function() {
    lockEvents();
});

// call the ajax method to handle lock
function lockEvents()
{
    // verify existing locks
    $('.fdc-has-lock').click(function(e) {
        e.preventDefault();
        // set vars
        var url = $(this).attr('href').split('/');
        var id = url[url.length - 2];
        var entity = url[url.length - 3];
        var locale = getQueryParams($(this).attr('href').split('?')[1], 'locale');

        hasLock(entity, id, locale);
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
                console.log(entity);
                console.log(id);
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

function hasLock(entity, id, locale)
{
    var request = $.ajax({
        url: Routing.generate('base_admin_lock_createlock', { id: id }),
        dataType: 'json',
        method: 'POST',
        data: {
            entity: entity,
            locale: locale
        }
    });

    request.fail(function (xhr) {
        $('#fdc-dialog-text').text(xhr.responseJSON.message);
        $('#fdc-dialog').dialog({
            autoOpen: true
        });
    });
}

function createLock(entity, id, locale)
{
    var request = $.ajax({
        url: Routing.generate('base_admin_lock_createlock', { id: id }),
        dataType: 'json',
        method: 'POST',
        data: {
            entity: entity,
            locale: locale
        }
    });

    request.fail(function (xhr) {
        $('#fdc-dialog-text').text(xhr.responseJSON.message);
        $('#fdc-dialog').dialog({
            autoOpen: true
        });
    });
}

function deleteLock(entity, id, locale)
{
    var request = $.ajax({
        url: Routing.generate('base_admin_lock_deletelock', { id: id }),
        dataType: 'json',
        method: 'POST',
        data: {
            entity: entity,
            locale: locale
        },
        async: false
    });
}