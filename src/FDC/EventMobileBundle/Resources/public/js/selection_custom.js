$(document).ready(function(){
    // INIT VIDEO PLAYERS

    if($('.players').length !== 0) {

        var btConsoleLog = function(log, txt) {
            console.log('------** '+txt+' **------');
            console.log(log);
            console.log('-------------------');
        }

        $('.players').each(function (i, e) {

            var id = $(e).attr('id');

            btConsoleLog(id, 'id');

            var playerInstance = jwplayer(id);

            btConsoleLog(playerInstance, 'playerInstance');

            btConsoleLog($(e).data('video'), '$(e).data("video")');

            playerInstance.setup({
                file: $(e).data('video'),
                image: $(e).data('poster'),
                width: "100%",
                aspectratio: "16:9",
                displaytitle: false,
                skin: {
                    name: "five"
                }
            });
        });
    }
})
