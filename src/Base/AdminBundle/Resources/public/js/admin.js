var Admin = Admin || {};

// disable popover error messages
Admin.add_pretty_errors = function(){};


lockEvents();

function lockEvents() {
    if ($('body').hasClass('fdc-lock')) {
        // on open
        var request = $.ajax({
            url: Routing.generate('base_admin_lock_createlock', {id: 10}),
            dataType: 'json',
            method: 'POST'
        });

        request.done(function (msg) {
            $("#log").html(msg);
        });

        request.fail(function (jqXHR, textStatus) {
            console.log(jqXHR);
            alert("Request failed: " + textStatus);
        });

        // on close
        $(window).unload(function () {
            var request = $.ajax({
                url: Routing.generate('base_admin_lock_deletelock', {id: 10}),
                dataType: 'json',
                method: 'POST',
                async: false
            });

            request.done(function (msg) {
                $("#log").html(msg);
            });

            request.fail(function (jqXHR, textStatus) {
                console.log(jqXHR);
                alert("Request failed: " + textStatus);
            });
        });
    }
}