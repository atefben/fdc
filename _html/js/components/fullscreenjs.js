/* 
Native FullScreen JavaScript API
https://gist.github.com/rzg/2947434
CopyRight: Johndyer, http://johndyer.name/native-fullscreen-javascript-api-plus-jquery-plugin/
-------------
Assumes Mozilla naming conventions instead of W3C for now
*/

// msExitFullscreen

(function() {
    var
        fullScreenApi = {
            supportsFullScreen: false,
            isFullScreen: function() { return false; },
            requestFullScreen: function() {},
            cancelFullScreen: function() {},
            fullScreenEventName: '',
            prefix: ''
        },
        browserPrefixes = 'webkit moz o ms khtml'.split(' ');

    // check for native support
    if (typeof document.cancelFullScreen != 'undefined') {
        fullScreenApi.supportsFullScreen = true;
    } else {
        // check for fullscreen support by vendor prefix
        for (var i = 0, il = browserPrefixes.length; i < il; i++ ) {
            fullScreenApi.prefix = browserPrefixes[i];

            if (typeof document[fullScreenApi.prefix + 'CancelFullScreen' ] != 'undefined' ||
                typeof document[fullScreenApi.prefix + 'ExitFullscreen' ] != 'undefined' 
                ) {
                fullScreenApi.supportsFullScreen = true;

                break;
            }
        }
    }

    // update methods to do something useful
    if (fullScreenApi.supportsFullScreen) {
        if(navigator.userAgent.indexOf("Edge") > -1) {
            fullScreenApi.fullScreenEventName = 'fullscreenchange';
        } else if (fullScreenApi.prefix == 'ms') {
            fullScreenApi.fullScreenEventName = 'MSFullscreenChange';
        } else {
            fullScreenApi.fullScreenEventName = fullScreenApi.prefix + 'fullscreenchange';
        }

        fullScreenApi.isFullScreen = function() {
            switch (this.prefix) {
                case '':
                    return document.fullScreen;
                case 'ms':
                    return document.msFullscreenElement;
                case 'webkit':
                    return document.webkitIsFullScreen;
                default:
                    return document[this.prefix + 'FullScreen'];
            }
        }
        fullScreenApi.requestFullScreen = function(el) {
            switch (this.prefix) {
                case '':
                    return el.requestFullScreen();
                case 'ms':
                    return el[this.prefix + 'RequestFullscreen']();
                default:
                    return el[this.prefix + 'RequestFullScreen']();
            }
        }
        fullScreenApi.cancelFullScreen = function(el) {
            switch (this.prefix) {
                case '':
                    return document.cancelFullScreen();
                case 'ms':
                    return document[this.prefix + 'ExitFullscreen']();
                default:
                    return document[this.prefix + 'CancelFullScreen']();
            }
        }
    }

    // jQuery plugin
    if (typeof jQuery != 'undefined') {
        jQuery.fn.requestFullScreen = function() {

            return this.each(function() {
                if (fullScreenApi.supportsFullScreen) {
                    fullScreenApi.requestFullScreen(this);
                }
            });
        };
    }

    // export api
    window.fullScreenApi = fullScreenApi;
})();