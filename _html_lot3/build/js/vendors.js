/*!
* Clamp.js 0.5.1
*
* Copyright 2011-2013, Joseph Schmitt http://joe.sh
* Released under the WTFPL license
* http://sam.zoy.org/wtfpl/
*/
(function(){window.$clamp=function(c,d){function s(a,b){n.getComputedStyle||(n.getComputedStyle=function(a,b){this.el=a;this.getPropertyValue=function(b){var c=/(\-([a-z]){1})/g;"float"==b&&(b="styleFloat");c.test(b)&&(b=b.replace(c,function(a,b,c){return c.toUpperCase()}));return a.currentStyle&&a.currentStyle[b]?a.currentStyle[b]:null};return this});return n.getComputedStyle(a,null).getPropertyValue(b)}function t(a){a=a||c.clientHeight;var b=u(c);return Math.max(Math.floor(a/b),0)}function x(a){return u(c)*
a}function u(a){var b=s(a,"line-height");"normal"==b&&(b=1.2*parseInt(s(a,"font-size")));return parseInt(b)}function l(a){if(a.lastChild.children&&0<a.lastChild.children.length)return l(Array.prototype.slice.call(a.children).pop());if(a.lastChild&&a.lastChild.nodeValue&&""!=a.lastChild.nodeValue&&a.lastChild.nodeValue!=b.truncationChar)return a.lastChild;a.lastChild.parentNode.removeChild(a.lastChild);return l(c)}function p(a,d){if(d){var e=a.nodeValue.replace(b.truncationChar,"");f||(h=0<k.length?
k.shift():"",f=e.split(h));1<f.length?(q=f.pop(),r(a,f.join(h))):f=null;m&&(a.nodeValue=a.nodeValue.replace(b.truncationChar,""),c.innerHTML=a.nodeValue+" "+m.innerHTML+b.truncationChar);if(f){if(c.clientHeight<=d)if(0<=k.length&&""!=h)r(a,f.join(h)+h+q),f=null;else return c.innerHTML}else""==h&&(r(a,""),a=l(c),k=b.splitOnChars.slice(0),h=k[0],q=f=null);if(b.animate)setTimeout(function(){p(a,d)},!0===b.animate?10:b.animate);else return p(a,d)}}function r(a,c){a.nodeValue=c+b.truncationChar}d=d||{};
var n=window,b={clamp:d.clamp||2,useNativeClamp:"undefined"!=typeof d.useNativeClamp?d.useNativeClamp:!0,splitOnChars:d.splitOnChars||[".","-","\u2013","\u2014"," "],animate:d.animate||!1,truncationChar:d.truncationChar||"\u2026",truncationHTML:d.truncationHTML},e=c.style,y=c.innerHTML,z="undefined"!=typeof c.style.webkitLineClamp,g=b.clamp,v=g.indexOf&&(-1<g.indexOf("px")||-1<g.indexOf("em")),m;b.truncationHTML&&(m=document.createElement("span"),m.innerHTML=b.truncationHTML);var k=b.splitOnChars.slice(0),
h=k[0],f,q;"auto"==g?g=t():v&&(g=t(parseInt(g)));var w;z&&b.useNativeClamp?(e.overflow="hidden",e.textOverflow="ellipsis",e.webkitBoxOrient="vertical",e.display="-webkit-box",e.webkitLineClamp=g,v&&(e.height=b.clamp+"px")):(e=x(g),e<=c.clientHeight&&(w=p(l(c),e)));return{original:y,clamped:w}}})();
/*!
 * clipboard.js v1.5.5
 * https://zenorocha.github.io/clipboard.js
 *
 * Licensed MIT © Zeno Rocha
 */
!function(t){if("object"==typeof exports&&"undefined"!=typeof module)module.exports=t();else if("function"==typeof define&&define.amd)define([],t);else{var e;e="undefined"!=typeof window?window:"undefined"!=typeof global?global:"undefined"!=typeof self?self:this,e.Clipboard=t()}}(function(){var t,e,n;return function t(e,n,r){function o(a,c){if(!n[a]){if(!e[a]){var s="function"==typeof require&&require;if(!c&&s)return s(a,!0);if(i)return i(a,!0);var u=new Error("Cannot find module '"+a+"'");throw u.code="MODULE_NOT_FOUND",u}var l=n[a]={exports:{}};e[a][0].call(l.exports,function(t){var n=e[a][1][t];return o(n?n:t)},l,l.exports,t,e,n,r)}return n[a].exports}for(var i="function"==typeof require&&require,a=0;a<r.length;a++)o(r[a]);return o}({1:[function(t,e,n){var r=t("matches-selector");e.exports=function(t,e,n){for(var o=n?t:t.parentNode;o&&o!==document;){if(r(o,e))return o;o=o.parentNode}}},{"matches-selector":2}],2:[function(t,e,n){function r(t,e){if(i)return i.call(t,e);for(var n=t.parentNode.querySelectorAll(e),r=0;r<n.length;++r)if(n[r]==t)return!0;return!1}var o=Element.prototype,i=o.matchesSelector||o.webkitMatchesSelector||o.mozMatchesSelector||o.msMatchesSelector||o.oMatchesSelector;e.exports=r},{}],3:[function(t,e,n){function r(t,e,n,r){var i=o.apply(this,arguments);return t.addEventListener(n,i),{destroy:function(){t.removeEventListener(n,i)}}}function o(t,e,n,r){return function(n){n.delegateTarget=i(n.target,e,!0),n.delegateTarget&&r.call(t,n)}}var i=t("closest");e.exports=r},{closest:1}],4:[function(t,e,n){n.node=function(t){return void 0!==t&&t instanceof HTMLElement&&1===t.nodeType},n.nodeList=function(t){var e=Object.prototype.toString.call(t);return void 0!==t&&("[object NodeList]"===e||"[object HTMLCollection]"===e)&&"length"in t&&(0===t.length||n.node(t[0]))},n.string=function(t){return"string"==typeof t||t instanceof String},n.function=function(t){var e=Object.prototype.toString.call(t);return"[object Function]"===e}},{}],5:[function(t,e,n){function r(t,e,n){if(!t&&!e&&!n)throw new Error("Missing required arguments");if(!c.string(e))throw new TypeError("Second argument must be a String");if(!c.function(n))throw new TypeError("Third argument must be a Function");if(c.node(t))return o(t,e,n);if(c.nodeList(t))return i(t,e,n);if(c.string(t))return a(t,e,n);throw new TypeError("First argument must be a String, HTMLElement, HTMLCollection, or NodeList")}function o(t,e,n){return t.addEventListener(e,n),{destroy:function(){t.removeEventListener(e,n)}}}function i(t,e,n){return Array.prototype.forEach.call(t,function(t){t.addEventListener(e,n)}),{destroy:function(){Array.prototype.forEach.call(t,function(t){t.removeEventListener(e,n)})}}}function a(t,e,n){return s(document.body,t,e,n)}var c=t("./is"),s=t("delegate");e.exports=r},{"./is":4,delegate:3}],6:[function(t,e,n){function r(t){var e;if("INPUT"===t.nodeName||"TEXTAREA"===t.nodeName)t.focus(),t.setSelectionRange(0,t.value.length),e=t.value;else{t.hasAttribute("contenteditable")&&t.focus();var n=window.getSelection(),r=document.createRange();r.selectNodeContents(t),n.removeAllRanges(),n.addRange(r),e=n.toString()}return e}e.exports=r},{}],7:[function(t,e,n){function r(){}r.prototype={on:function(t,e,n){var r=this.e||(this.e={});return(r[t]||(r[t]=[])).push({fn:e,ctx:n}),this},once:function(t,e,n){function r(){o.off(t,r),e.apply(n,arguments)}var o=this;return r._=e,this.on(t,r,n)},emit:function(t){var e=[].slice.call(arguments,1),n=((this.e||(this.e={}))[t]||[]).slice(),r=0,o=n.length;for(r;o>r;r++)n[r].fn.apply(n[r].ctx,e);return this},off:function(t,e){var n=this.e||(this.e={}),r=n[t],o=[];if(r&&e)for(var i=0,a=r.length;a>i;i++)r[i].fn!==e&&r[i].fn._!==e&&o.push(r[i]);return o.length?n[t]=o:delete n[t],this}},e.exports=r},{}],8:[function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{"default":t}}function o(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}n.__esModule=!0;var i=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),a=t("select"),c=r(a),s=function(){function t(e){o(this,t),this.resolveOptions(e),this.initSelection()}return t.prototype.resolveOptions=function t(){var e=arguments.length<=0||void 0===arguments[0]?{}:arguments[0];this.action=e.action,this.emitter=e.emitter,this.target=e.target,this.text=e.text,this.trigger=e.trigger,this.selectedText=""},t.prototype.initSelection=function t(){if(this.text&&this.target)throw new Error('Multiple attributes declared, use either "target" or "text"');if(this.text)this.selectFake();else{if(!this.target)throw new Error('Missing required attributes, use either "target" or "text"');this.selectTarget()}},t.prototype.selectFake=function t(){var e=this;this.removeFake(),this.fakeHandler=document.body.addEventListener("click",function(){return e.removeFake()}),this.fakeElem=document.createElement("textarea"),this.fakeElem.style.position="absolute",this.fakeElem.style.left="-9999px",this.fakeElem.style.top=(window.pageYOffset||document.documentElement.scrollTop)+"px",this.fakeElem.setAttribute("readonly",""),this.fakeElem.value=this.text,document.body.appendChild(this.fakeElem),this.selectedText=c.default(this.fakeElem),this.copyText()},t.prototype.removeFake=function t(){this.fakeHandler&&(document.body.removeEventListener("click"),this.fakeHandler=null),this.fakeElem&&(document.body.removeChild(this.fakeElem),this.fakeElem=null)},t.prototype.selectTarget=function t(){this.selectedText=c.default(this.target),this.copyText()},t.prototype.copyText=function t(){var e=void 0;try{e=document.execCommand(this.action)}catch(n){e=!1}this.handleResult(e)},t.prototype.handleResult=function t(e){e?this.emitter.emit("success",{action:this.action,text:this.selectedText,trigger:this.trigger,clearSelection:this.clearSelection.bind(this)}):this.emitter.emit("error",{action:this.action,trigger:this.trigger,clearSelection:this.clearSelection.bind(this)})},t.prototype.clearSelection=function t(){this.target&&this.target.blur(),window.getSelection().removeAllRanges()},t.prototype.destroy=function t(){this.removeFake()},i(t,[{key:"action",set:function t(){var e=arguments.length<=0||void 0===arguments[0]?"copy":arguments[0];if(this._action=e,"copy"!==this._action&&"cut"!==this._action)throw new Error('Invalid "action" value, use either "copy" or "cut"')},get:function t(){return this._action}},{key:"target",set:function t(e){if(void 0!==e){if(!e||"object"!=typeof e||1!==e.nodeType)throw new Error('Invalid "target" value, use a valid Element');this._target=e}},get:function t(){return this._target}}]),t}();n.default=s,e.exports=n.default},{select:6}],9:[function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{"default":t}}function o(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}function a(t,e){var n="data-clipboard-"+t;if(e.hasAttribute(n))return e.getAttribute(n)}n.__esModule=!0;var c=t("./clipboard-action"),s=r(c),u=t("tiny-emitter"),l=r(u),f=t("good-listener"),d=r(f),h=function(t){function e(n,r){o(this,e),t.call(this),this.resolveOptions(r),this.listenClick(n)}return i(e,t),e.prototype.resolveOptions=function t(){var e=arguments.length<=0||void 0===arguments[0]?{}:arguments[0];this.action="function"==typeof e.action?e.action:this.defaultAction,this.target="function"==typeof e.target?e.target:this.defaultTarget,this.text="function"==typeof e.text?e.text:this.defaultText},e.prototype.listenClick=function t(e){var n=this;this.listener=d.default(e,"click",function(t){return n.onClick(t)})},e.prototype.onClick=function t(e){var n=e.delegateTarget||e.currentTarget;this.clipboardAction&&(this.clipboardAction=null),this.clipboardAction=new s.default({action:this.action(n),target:this.target(n),text:this.text(n),trigger:n,emitter:this})},e.prototype.defaultAction=function t(e){return a("action",e)},e.prototype.defaultTarget=function t(e){var n=a("target",e);return n?document.querySelector(n):void 0},e.prototype.defaultText=function t(e){return a("text",e)},e.prototype.destroy=function t(){this.listener.destroy(),this.clipboardAction&&(this.clipboardAction.destroy(),this.clipboardAction=null)},e}(l.default);n.default=h,e.exports=n.default},{"./clipboard-action":8,"good-listener":5,"tiny-emitter":7}]},{},[9])(9)});
//nothing
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

!function(a,b){"object"==typeof exports&&"object"==typeof module?module.exports=b():"function"==typeof define&&define.amd?define([],b):"object"==typeof exports?exports.jwplayer=b():a.jwplayer=b()}(this,function(){return function(a){function b(c){if(d[c])return d[c].exports;var e=d[c]={exports:{},id:c,loaded:!1};return a[c].call(e.exports,e,e.exports,b),e.loaded=!0,e.exports}var c=window.webpackJsonpjwplayer;window.webpackJsonpjwplayer=function(d,f){for(var g,h,i=0,j=[];i<d.length;i++)h=d[i],e[h]&&j.push.apply(j,e[h]),e[h]=0;for(g in f)a[g]=f[g];for(c&&c(d,f);j.length;)j.shift().call(null,b)};var d={},e={0:0};return b.e=function(a,c){if(0===e[a])return c.call(null,b);if(void 0!==e[a])e[a].push(c);else{e[a]=[c];var d=document.getElementsByTagName("head")[0],f=document.createElement("script");f.type="text/javascript",f.charset="utf-8",f.async=!0,f.src=b.p+""+({2:"provider.youtube",3:"provider.dashjs",4:"provider.shaka",5:"provider.cast"}[a]||a)+".js",d.appendChild(f)}},b.m=a,b.c=d,b.p="",b(0)}([function(a,b,c){a.exports=c(38)},,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,function(a,b,c){var d,e;d=[c(39),c(171),c(47)],e=function(a,b,c){return window.jwplayer?window.jwplayer:c.extend(a,b)}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(40),c(45),c(165)],e=function(a,b){return c.p=b.loadFrom(),a.selectPlayer}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(41),c(93),c(47)],e=function(a,b,c){var d=a.selectPlayer,e=function(){var a=d.apply(this,arguments);return a?a:{registerPlugin:function(a,c,d){"jwpsrv"!==a&&b.registerPlugin(a,c,d)}}};return c.extend(a,{selectPlayer:e})}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(42),c(47),c(76),c(74),c(70),c(93)],e=function(a,b,c,d,e,f){function g(a){var f=a.getName().name;if(!b.find(e,b.matches({name:f}))){if(!b.isFunction(a.supports))throw{message:"Tried to register a provider with an invalid object"};e.unshift({name:f,supports:a.supports})}var g=function(){};g.prototype=c,a.prototype=new g,d[f]=a}var h=[],i=0,j=function(b){var c,d;return b?"string"==typeof b?(c=k(b),c||(d=document.getElementById(b))):"number"==typeof b?c=h[b]:b.nodeType&&(d=b,c=k(d.id)):c=h[0],c?c:d?l(new a(d,m)):{registerPlugin:f.registerPlugin}},k=function(a){for(var b=0;b<h.length;b++)if(h[b].id===a)return h[b];return null},l=function(a){return i++,a.uniqueId=i,h.push(a),a},m=function(a){for(var b=h.length;b--;)if(h[b].uniqueId===a.uniqueId){h.splice(b,1);break}},n={selectPlayer:j,registerProvider:g,availableProviders:e,registerPlugin:f.registerPlugin};return j.api=n,n}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(66),c(65),c(63),c(45),c(81),c(47),c(43),c(162),c(163),c(164),c(58)],e=function(a,b,c,d,e,f,g,h,i,j,k){function l(a){d.addClass(a,"jw-tab-focus")}function m(a){d.removeClass(a,"jw-tab-focus")}var n=function(n,o){var p,q=this,r=!1,s={};f.extend(this,c),this.utils=d,this._=f,this.Events=c,this.version=k,this.trigger=function(a,b){return b=f.isObject(b)?f.extend({},b):{},b.type=a,c.trigger.call(q,a,b)},this.on=function(a,b){if(f.isString(b))throw new TypeError("eval callbacks depricated");var e=function(){try{b.apply(this,arguments)}catch(c){d.log('There was an error calling back an event handler for "'+a+'". Error: '+c.message)}};return c.on.call(q,a,e)},this.dispatchEvent=this.trigger,this.removeEventListener=this.off.bind(this);var t=function(){p=new g(n),h(q,p),i(q,p),p.on(a.JWPLAYER_PLAYLIST_ITEM,function(){s={}}),p.on(a.JWPLAYER_MEDIA_META,function(a){f.extend(s,a.metadata)}),p.on(a.JWPLAYER_VIEW_TAB_FOCUS,function(a){a.hasFocus===!0?l(this.getContainer()):m(this.getContainer())}),p.on(a.JWPLAYER_READY,function(a){r=!0,u.tick("ready"),a.setupTime=u.between("setup","ready")}),p.on("all",q.trigger)};t(),j(this),this.id=n.id;var u=this._qoe=new e;u.tick("init");var v=function(){r=!1,s={},q.off(),p&&p.off(),p&&p.playerDestroy&&p.playerDestroy()},w=function(a){var b=q.plugins;return b&&b[a]};return this.setup=function(a){return u.tick("setup"),v(),t(),d.foreach(a.events,function(a,b){var c=q[a];"function"==typeof c&&c.call(q,b)}),a.id=q.id,p.setup(a,this),q},this.qoe=function(){var b=p.getItemQoe(),c=u.between("setup","ready"),d=b.between(a.JWPLAYER_MEDIA_PLAY_ATTEMPT,a.JWPLAYER_MEDIA_FIRST_FRAME);return{setupTime:c,firstFrame:d,player:u.dump(),item:b.dump()}},this.getContainer=function(){return p.getContainer?p.getContainer():n},this.getMeta=this.getItemMeta=function(){return s},this.getPlaylistItem=function(a){if(!d.exists(a))return p._model.get("playlistItem");var b=q.getPlaylist();return b?b[a]:null},this.getRenderingMode=function(){return"html5"},this.load=function(a){var b=w("vast")||w("googima");return b&&b.destroy(),p.load(a),q},this.play=function(a){if(a===!0)return p.play(),q;if(a===!1)return p.pause(),q;switch(a=q.getState()){case b.PLAYING:case b.BUFFERING:p.pause();break;default:p.play()}return q},this.pause=function(a){return f.isBoolean(a)?this.play(!a):this.play()},this.createInstream=function(){return p.createInstream()},this.castToggle=function(){p&&p.castToggle&&p.castToggle()},this.playAd=this.pauseAd=d.noop,this.remove=function(){return o(q),q.trigger("remove"),v(),q},this};return n}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(44),c(71)],e=function(a,b){var d=a.prototype.setup;return a.prototype.setup=function(){d.apply(this,arguments);var a=this._model.get("edition"),e=b(a),f=this._model.get("cast"),g=this;e("casting")&&f&&f.appid&&c.e(5,function(a){var b=c(156);g._castController=new b(g,g._model),g.castToggle=g._castController.castToggle.bind(g._castController)})},a}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(59),c(113),c(61),c(47),c(88),c(110),c(67),c(99),c(45),c(114),c(63),c(64),c(65),c(66),c(154)],e=function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o){function p(a){return function(){var b=Array.prototype.slice.call(arguments,0);this.eventsQueue.push([a,b])}}function q(a){return a===m.LOADING||a===m.STALLED?m.BUFFERING:a}var r=function(a){this.originalContainer=this.currentContainer=a,this.eventsQueue=[],d.extend(this,k),this._model=new g};return r.prototype={play:p("play"),pause:p("pause"),setVolume:p("setVolume"),setMute:p("setMute"),seek:p("seek"),stop:p("stop"),load:p("load"),playlistNext:p("playlistNext"),playlistPrev:p("playlistPrev"),playlistItem:p("playlistItem"),setFullscreen:p("setFullscreen"),setCurrentCaptions:p("setCurrentCaptions"),setCurrentQuality:p("setCurrentQuality"),setup:function(g,k){function o(){S.mediaModel.on("change:state",function(a,b){var c=q(b);S.set("state",c)})}function p(){V=null,S.on("change:state",l,this),S.on("change:castState",function(a,b){$.trigger(n.JWPLAYER_CAST_SESSION,b)}),S.on("change:fullscreen",function(a,b){$.trigger(n.JWPLAYER_FULLSCREEN,{fullscreen:b})}),S.on("change:playlistItem",function(a,b){$.trigger(n.JWPLAYER_PLAYLIST_ITEM,{index:a.get("item"),item:b})}),S.on("change:playlist",function(a,b){b.length&&$.trigger(n.JWPLAYER_PLAYLIST_LOADED,{playlist:b})}),S.on("change:volume",function(a,b){$.trigger(n.JWPLAYER_MEDIA_VOLUME,{volume:b})}),S.on("change:mute",function(a,b){$.trigger(n.JWPLAYER_MEDIA_MUTE,{mute:b})}),S.on("change:scrubbing",function(a,b){b?x():v()}),S.on("change:captionsList",function(a,b){$.trigger(n.JWPLAYER_CAPTIONS_LIST,{tracks:b,track:N()})}),S.mediaController.on("all",$.trigger.bind($)),T.on("all",$.trigger.bind($)),this.showView(T.element()),window.addEventListener("beforeunload",function(){Q()||w(!0)}),d.defer(r)}function r(){for($.trigger(n.JWPLAYER_READY,{setupTime:0}),$.trigger(n.JWPLAYER_PLAYLIST_LOADED,{playlist:S.get("playlist")}),$.trigger(n.JWPLAYER_PLAYLIST_ITEM,{index:S.get("item"),item:S.get("playlistItem")}),$.trigger(n.JWPLAYER_CAPTIONS_LIST,{tracks:S.get("captionsList"),track:S.get("captionsIndex")}),S.get("autostart")&&v();$.eventsQueue.length>0;){var a=$.eventsQueue.shift(),b=a[0],c=a[1]||[];$[b].apply($,c)}}function s(a){switch(w(!0),S.get("autostart")&&S.once("setItem",v),typeof a){case"string":t(a);break;case"object":S.setPlaylist(a),S.setItem(0);break;case"number":S.setItem(a)}}function t(a){var b=new h;b.on(n.JWPLAYER_PLAYLIST_LOADED,function(a){s(a.playlist)}),b.on(n.JWPLAYER_ERROR,function(a){S.set("state",m.ERROR),s([]),a.message="Could not load playlist: "+a.message,$.trigger.call($,a.type,a)}),b.load(a)}function u(){var a=$._instreamAdapter&&$._instreamAdapter.getState();return d.isString(a)?a:S.get("state")}function v(){var a;if(S.get("state")!==m.ERROR){var b=$._instreamAdapter&&$._instreamAdapter.getState();if(d.isString(b))return k.pauseAd(!1);if(S.get("state")===m.COMPLETE&&(w(!0),S.setItem(0)),!Y&&(Y=!0,$.trigger(n.JWPLAYER_MEDIA_BEFOREPLAY,{}),Y=!1,X))return X=!1,void(W=null);if(y()){if(0===S.get("playlist").length)return!1;a=i.tryCatch(function(){S.loadVideo()})}else S.get("state")===m.PAUSED&&(a=i.tryCatch(function(){S.playVideo()}));return a instanceof i.Error?($.trigger(n.JWPLAYER_ERROR,a),W=null,!1):!0}}function w(a){S.off("setItem",v);var b=!a;W=null;var c=i.tryCatch(function(){_().stop()},$);return c instanceof i.Error?($.trigger(n.JWPLAYER_ERROR,c),!1):(b&&(Z=!0),Y&&(X=!0),!0)}function x(){W=null;var a=$._instreamAdapter&&$._instreamAdapter.getState();if(d.isString(a))return k.pauseAd(!0);switch(S.get("state")){case m.ERROR:return!1;case m.PLAYING:case m.BUFFERING:var b=i.tryCatch(function(){_().pause()},this);if(b instanceof i.Error)return $.trigger(n.JWPLAYER_ERROR,b),!1;break;default:Y&&(X=!0)}return!0}function y(){var a=S.get("state");return a===m.IDLE||a===m.COMPLETE||a===m.ERROR}function z(a){S.get("state")!==m.ERROR&&(S.get("scrubbing")||S.get("state")===m.PLAYING||v(!0),_().seek(a))}function A(a){w(!0),S.setItem(a),v()}function B(){A(S.get("item")-1)}function C(){A(S.get("item")+1)}function D(){if(y()){if(Z)return void(Z=!1);W=D;var a=S.get("item");return a===S.get("playlist").length-1?void(S.get("repeat")?C():(S.set("state",m.COMPLETE),$.trigger(n.JWPLAYER_PLAYLIST_COMPLETE,{}))):void C()}}function E(a){_().setCurrentQuality(a)}function F(){return _()?_().getCurrentQuality():-1}function G(){return this._model?this._model.getConfiguration():void 0}function H(){if(this._model.mediaModel)return this._model.mediaModel.get("visualQuality");var a=I();if(a){var b=F(),c=a[b];if(c)return{level:d.extend({index:b},c),mode:"",reason:""}}return null}function I(){return _()?_().getQualityLevels():null}function J(a){_().setCurrentAudioTrack(a)}function K(){return _()?_().getCurrentAudioTrack():-1}function L(){return _()?_().getAudioTracks():null}function M(a){S.setVideoSubtitleTrack(a),$.trigger(n.JWPLAYER_CAPTIONS_CHANGED,{tracks:O(),track:a})}function N(){return U.getCurrentIndex()}function O(){return U.getCaptionsList()}function P(){var a=S.getVideo();if(a){var b=a.detachMedia();if(b instanceof HTMLVideoElement)return b}return null}function Q(){var a=S.getVideo();return a?a.isCaster:!1}function R(a){var b=i.tryCatch(function(){S.getVideo().attachMedia(a)});return b instanceof i.Error?void i.log("Error calling _attachMedia",b):void("function"==typeof W&&W())}var S,T,U,V,W,X,Y=!1,Z=!1,$=this,_=function(){return S.getVideo()},aa=new a(g);S=this._model.setup(aa),T=this._view=new j(k,S),U=new f(k,S),V=new e(k,S,T),V.on(n.JWPLAYER_READY,p,this),V.on(n.JWPLAYER_SETUP_ERROR,function(a){$.setupError(a.message)}),S.mediaController.on(n.JWPLAYER_MEDIA_COMPLETE,function(){d.defer(D)}),S.mediaController.on(n.JWPLAYER_MEDIA_ERROR,function(a){S.set("state",m.ERROR);var b=d.extend({},a);b.type=n.JWPLAYER_ERROR,this.trigger(b.type,b)},this),o(),S.on("change:mediaModel",o),this.play=v,this.pause=x,this.seek=z,this.stop=w,this.load=s,this.playlistNext=C,this.playlistPrev=B,this.playlistItem=A,this.setCurrentCaptions=M,this.setCurrentQuality=E,this.detachMedia=P,this.attachMedia=R,this.getCurrentQuality=F,this.getQualityLevels=I,this.setCurrentAudioTrack=J,this.getCurrentAudioTrack=K,this.getAudioTracks=L,this.getCurrentCaptions=N,this.getCaptionsList=O,this.getVisualQuality=H,this.getConfig=G,this.getState=u,this.setVolume=S.setVolume,this.setMute=S.setMute,this.getProvider=function(){return S.get("provider")},this.getWidth=function(){return S.get("containerWidth")},this.getHeight=function(){return S.get("containerHeight")},this.getContainer=function(){return this.currentContainer},this.resize=T.resize,this.getSafeRegion=T.getSafeRegion,this.setCues=T.addCues,this.setFullscreen=T.fullscreen,this.addButton=function(a,b,c,e){var f={img:a,tooltip:b,callback:c,id:e},g=S.get("dock");g=g?g.slice(0):[],g=d.reject(g,d.matches({id:f.id})),g.push(f),S.set("dock",g)},this.removeButton=function(a){var b=S.get("dock")||[];b=d.reject(b,d.matches({id:a})),S.set("dock",b)},this.checkBeforePlay=function(){return Y},this.getItemQoe=function(){return S._qoeItem},this.setControls=function(a){S.set("controls",a)},this.playerDestroy=function(){this.stop(),this.showView(this.originalContainer),T&&T.destroy(),S&&S.destroy(),V&&(V.destroy(),V=null)},this.isBeforePlay=this.checkBeforePlay,this.isBeforeComplete=function(){return S.getVideo().checkComplete()},this.createInstream=function(){return this.instreamDestroy(),this._instreamAdapter=new c(this,S,T),this._instreamAdapter},this.skipAd=function(){this._instreamAdapter&&this._instreamAdapter.skipAd()},this.instreamDestroy=function(){$._instreamAdapter&&$._instreamAdapter.destroy()},b(k,this),V.start()},showView:function(a){(document.documentElement.contains(this.currentContainer)||(this.currentContainer=document.getElementById(this._model.get("id")),this.currentContainer))&&(this.currentContainer.parentElement&&this.currentContainer.parentElement.replaceChild(a,this.currentContainer),this.currentContainer=a)},setupError:function(a){var b=i.createElement(o(this._model.get("id"),this._model.get("skin"),a)),c=this._model.get("width"),e=this._model.get("height");i.style(b,{width:c.toString().indexOf("%")>0?c:c+"px",height:e.toString().indexOf("%")>0?e:e+"px"}),this.showView(b);var f=this;d.defer(function(){f.trigger(n.JWPLAYER_SETUP_ERROR,{message:a})})}},r}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(50),c(47),c(51),c(52),c(54),c(46),c(55),c(48),c(56),c(49)],e=function(a,b,c,d,e,f,g,h,i,j){var k={};return k.log=function(){window.console&&("object"==typeof console.log?console.log(Array.prototype.slice.call(arguments,0)):console.log.apply(console,arguments))},k.between=function(a,b,c){return Math.max(Math.min(a,c),b)},k.foreach=function(a,b){var c,d;for(c in a)"function"===k.typeOf(a.hasOwnProperty)?a.hasOwnProperty(c)&&(d=a[c],b(c,d)):(d=a[c],b(c,d))},k.indexOf=b.indexOf,k.noop=function(){},k.seconds=a.seconds,k.prefix=a.prefix,k.suffix=a.suffix,b.extend(k,f,h,c,g,d,e,i,j),k}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(48),c(49)],e=function(a,b,c){function d(a){return/^(?:(?:https?|file)\:)?\/\//.test(a)}var e={};return e.getAbsolutePath=function(a,c){if(b.exists(c)||(c=document.location.href),b.exists(a)){if(d(a))return a;var e,f=c.substring(0,c.indexOf("://")+3),g=c.substring(f.length,c.indexOf("/",f.length+1));if(0===a.indexOf("/"))e=a.split("/");else{var h=c.split("?")[0];h=h.substring(f.length+g.length+1,h.lastIndexOf("/")),e=h.split("/").concat(a.split("/"))}for(var i=[],j=0;j<e.length;j++)e[j]&&b.exists(e[j])&&"."!==e[j]&&(".."===e[j]?i.pop():i.push(e[j]));return f+g+"/"+i.join("/")}},e.getScriptPath=a.memoize(function(a){for(var b=document.getElementsByTagName("script"),c=0;c<b.length;c++){var d=b[c].src;if(d&&d.indexOf(a)>=0)return d.substr(0,d.indexOf(a))}return""}),e.parseXML=function(a){var b=null;return c.tryCatch(function(){if(window.DOMParser){b=(new window.DOMParser).parseFromString(a,"text/xml");var c=b.childNodes;c&&c.length&&c[0].firstChild&&"parsererror"===c[0].firstChild.nodeName&&(b=null)}else b=new window.ActiveXObject("Microsoft.XMLDOM"),b.async="false",b.loadXML(a)}),b},e.serialize=function(a){if(void 0===a)return null;if("string"==typeof a&&a.length<6){var b=a.toLowerCase();if("true"===b)return!0;if("false"===b)return!1;if(!isNaN(Number(a))&&!isNaN(parseFloat(a)))return Number(a)}return a},e.parseDimension=function(a){return"string"==typeof a?""===a?0:a.lastIndexOf("%")>-1?a:parseInt(a.replace("px",""),10):a},e.timeFormat=function(a){if(a>0){var b=Math.floor(a/3600),c=Math.floor((a-3600*b)/60),d=Math.floor(a%60);return(b?b+":":"")+(10>c?"0":"")+c+":"+(10>d?"0":"")+d}return"00:00"},e.adaptiveType=function(a){if(-1!==a){var b=-120;if(b>=a)return"DVR";if(0>a||a===1/0)return"LIVE"}return"VOD"},e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){var a={},b=Array.prototype,c=Object.prototype,d=Function.prototype,e=b.slice,f=b.concat,g=c.toString,h=c.hasOwnProperty,i=b.map,j=b.forEach,k=b.filter,l=b.every,m=b.some,n=b.indexOf,o=Array.isArray,p=Object.keys,q=d.bind,r=function(a){return a instanceof r?a:this instanceof r?void 0:new r(a)},s=r.each=r.forEach=function(b,c,d){if(null==b)return b;if(j&&b.forEach===j)b.forEach(c,d);else if(b.length===+b.length){for(var e=0,f=b.length;f>e;e++)if(c.call(d,b[e],e,b)===a)return}else for(var g=r.keys(b),e=0,f=g.length;f>e;e++)if(c.call(d,b[g[e]],g[e],b)===a)return;return b};r.map=r.collect=function(a,b,c){var d=[];return null==a?d:i&&a.map===i?a.map(b,c):(s(a,function(a,e,f){d.push(b.call(c,a,e,f))}),d)},r.find=r.detect=function(a,b,c){var d;return t(a,function(a,e,f){return b.call(c,a,e,f)?(d=a,!0):void 0}),d},r.filter=r.select=function(a,b,c){var d=[];return null==a?d:k&&a.filter===k?a.filter(b,c):(s(a,function(a,e,f){b.call(c,a,e,f)&&d.push(a)}),d)},r.reject=function(a,b,c){return r.filter(a,function(a,d,e){return!b.call(c,a,d,e)},c)},r.compact=function(a){return r.filter(a,r.identity)},r.every=r.all=function(b,c,d){c||(c=r.identity);var e=!0;return null==b?e:l&&b.every===l?b.every(c,d):(s(b,function(b,f,g){return(e=e&&c.call(d,b,f,g))?void 0:a}),!!e)};var t=r.some=r.any=function(b,c,d){c||(c=r.identity);var e=!1;return null==b?e:m&&b.some===m?b.some(c,d):(s(b,function(b,f,g){return e||(e=c.call(d,b,f,g))?a:void 0}),!!e)};r.size=function(a){return null==a?0:a.length===+a.length?a.length:r.keys(a).length},r.after=function(a,b){return function(){return--a<1?b.apply(this,arguments):void 0}},r.before=function(a,b){var c;return function(){return--a>0&&(c=b.apply(this,arguments)),1>=a&&(b=null),c}};var u=function(a){return null==a?r.identity:r.isFunction(a)?a:r.property(a)};r.sortedIndex=function(a,b,c,d){c=u(c);for(var e=c.call(d,b),f=0,g=a.length;g>f;){var h=f+g>>>1;c.call(d,a[h])<e?f=h+1:g=h}return f};var t=r.some=r.any=function(b,c,d){c||(c=r.identity);var e=!1;return null==b?e:m&&b.some===m?b.some(c,d):(s(b,function(b,f,g){return e||(e=c.call(d,b,f,g))?a:void 0}),!!e)};r.contains=r.include=function(a,b){return null==a?!1:(a.length!==+a.length&&(a=r.values(a)),r.indexOf(a,b)>=0)},r.where=function(a,b){return r.filter(a,r.matches(b))},r.findWhere=function(a,b){return r.find(a,r.matches(b))},r.max=function(a,b,c){if(!b&&r.isArray(a)&&a[0]===+a[0]&&a.length<65535)return Math.max.apply(Math,a);var d=-(1/0),e=-(1/0);return s(a,function(a,f,g){var h=b?b.call(c,a,f,g):a;h>e&&(d=a,e=h)}),d},r.difference=function(a){var c=f.apply(b,e.call(arguments,1));return r.filter(a,function(a){return!r.contains(c,a)})},r.without=function(a){return r.difference(a,e.call(arguments,1))},r.indexOf=function(a,b,c){if(null==a)return-1;var d=0,e=a.length;if(c){if("number"!=typeof c)return d=r.sortedIndex(a,b),a[d]===b?d:-1;d=0>c?Math.max(0,e+c):c}if(n&&a.indexOf===n)return a.indexOf(b,c);for(;e>d;d++)if(a[d]===b)return d;return-1};var v=function(){};r.bind=function(a,b){var c,d;if(q&&a.bind===q)return q.apply(a,e.call(arguments,1));if(!r.isFunction(a))throw new TypeError;return c=e.call(arguments,2),d=function(){if(!(this instanceof d))return a.apply(b,c.concat(e.call(arguments)));v.prototype=a.prototype;var f=new v;v.prototype=null;var g=a.apply(f,c.concat(e.call(arguments)));return Object(g)===g?g:f}},r.partial=function(a){var b=e.call(arguments,1);return function(){for(var c=0,d=b.slice(),e=0,f=d.length;f>e;e++)d[e]===r&&(d[e]=arguments[c++]);for(;c<arguments.length;)d.push(arguments[c++]);return a.apply(this,d)}},r.once=r.partial(r.before,2),r.memoize=function(a,b){var c={};return b||(b=r.identity),function(){var d=b.apply(this,arguments);return r.has(c,d)?c[d]:c[d]=a.apply(this,arguments)}},r.delay=function(a,b){var c=e.call(arguments,2);return setTimeout(function(){return a.apply(null,c)},b)},r.defer=function(a){return r.delay.apply(r,[a,1].concat(e.call(arguments,1)))},r.throttle=function(a,b,c){var d,e,f,g=null,h=0;c||(c={});var i=function(){h=c.leading===!1?0:r.now(),g=null,f=a.apply(d,e),d=e=null};return function(){var j=r.now();h||c.leading!==!1||(h=j);var k=b-(j-h);return d=this,e=arguments,0>=k?(clearTimeout(g),g=null,h=j,f=a.apply(d,e),d=e=null):g||c.trailing===!1||(g=setTimeout(i,k)),f}},r.keys=function(a){if(!r.isObject(a))return[];if(p)return p(a);var b=[];for(var c in a)r.has(a,c)&&b.push(c);return b},r.invert=function(a){for(var b={},c=r.keys(a),d=0,e=c.length;e>d;d++)b[a[c[d]]]=c[d];return b},r.defaults=function(a){return s(e.call(arguments,1),function(b){if(b)for(var c in b)void 0===a[c]&&(a[c]=b[c])}),a},r.extend=function(a){return s(e.call(arguments,1),function(b){if(b)for(var c in b)a[c]=b[c]}),a},r.pick=function(a){var c={},d=f.apply(b,e.call(arguments,1));return s(d,function(b){b in a&&(c[b]=a[b])}),c},r.omit=function(a){var c={},d=f.apply(b,e.call(arguments,1));for(var g in a)r.contains(d,g)||(c[g]=a[g]);return c},r.clone=function(a){return r.isObject(a)?r.isArray(a)?a.slice():r.extend({},a):a},r.isArray=o||function(a){return"[object Array]"==g.call(a)},r.isObject=function(a){return a===Object(a)},s(["Arguments","Function","String","Number","Date","RegExp"],function(a){r["is"+a]=function(b){return g.call(b)=="[object "+a+"]"}}),r.isArguments(arguments)||(r.isArguments=function(a){return!(!a||!r.has(a,"callee"))}),r.isFunction=function(a){return"function"==typeof a},r.isFinite=function(a){return isFinite(a)&&!isNaN(parseFloat(a))},r.isNaN=function(a){return r.isNumber(a)&&a!=+a},r.isBoolean=function(a){return a===!0||a===!1||"[object Boolean]"==g.call(a)},r.isNull=function(a){return null===a},r.isUndefined=function(a){return void 0===a},r.has=function(a,b){return h.call(a,b)},r.identity=function(a){return a},r.constant=function(a){return function(){return a}},r.property=function(a){return function(b){return b[a]}},r.propertyOf=function(a){return null==a?function(){}:function(b){return a[b]}},r.matches=function(a){return function(b){if(b===a)return!0;for(var c in a)if(a[c]!==b[c])return!1;return!0}},r.now=Date.now||function(){return(new Date).getTime()},r.result=function(a,b){if(null==a)return void 0;var c=a[b];return r.isFunction(c)?c.call(a):c};var w=0;return r.uniqueId=function(a){var b=++w+"";return a?a+b:b},r}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(49)],e=function(a,b){var c={};return c.exists=function(a){switch(typeof a){case"string":return a.length>0;case"object":return null!==a;case"undefined":return!1}return!0},c.isHTTPS=function(){return 0===window.location.href.indexOf("https")},c.isRtmp=function(a,b){return 0===a.indexOf("rtmp")||"rtmp"===b},c.isYouTube=function(a,b){return"youtube"===b||/^(http|\/\/).*(youtube\.com|youtu\.be)\/.+/.test(a)},c.youTubeID=function(a){var c=b.tryCatch(function(){return/v[=\/]([^?&]*)|youtu\.be\/([^?]*)|^([\w-]*)$/i.exec(a).slice(1).join("").replace("?","")});return c instanceof b.Error?"":c},c.typeOf=function(b){if(null===b)return"null";var c=typeof b;return"object"===c&&a.isArray(b)?"array":c},c}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){var a=function(a,c,d){if(c=c||this,d=d||[],window.jwplayer&&window.jwplayer.debug)return a.apply(c,d);try{return a.apply(c,d)}catch(e){return new b(a.name,e)}},b=function(a,b){this.name=a,this.message=b};return{tryCatch:a,Error:b}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47)],e=function(a){function b(a){return a.indexOf("(format=m3u8-")>-1?"m3u8":!1}var c=function(a){return a.replace(/^\s+|\s+$/g,"")},d=function(a,b,c){for(a=""+a,c=c||"0";a.length<b;)a=c+a;return a},e=function(a,b){for(var c=0;c<a.attributes.length;c++)if(a.attributes[c].name&&a.attributes[c].name.toLowerCase()===b.toLowerCase())return a.attributes[c].value.toString();return""},f=function(a){if(!a||"rtmp"===a.substr(0,4))return"";var c=b(a);return c?c:(a=a.substring(a.lastIndexOf("/")+1,a.length).split("?")[0].split("#")[0],a.lastIndexOf(".")>-1?a.substr(a.lastIndexOf(".")+1,a.length).toLowerCase():void 0)},g=function(a){var b=parseInt(a/3600),c=parseInt(a/60)%60,e=a%60;return d(b,2)+":"+d(c,2)+":"+d(e.toFixed(3),6)},h=function(b){if(a.isNumber(b))return b;b=b.replace(",",".");var c=b.split(":"),d=0;return"s"===b.slice(-1)?d=parseFloat(b):"m"===b.slice(-1)?d=60*parseFloat(b):"h"===b.slice(-1)?d=3600*parseFloat(b):c.length>1?(d=parseFloat(c[c.length-1]),d+=60*parseFloat(c[c.length-2]),3===c.length&&(d+=3600*parseFloat(c[c.length-3]))):d=parseFloat(b),d},i=function(b,c){return a.map(b,function(a){return c+a})},j=function(b,c){return a.map(b,function(a){return a+c})};return{trim:c,pad:d,xmlAttribute:e,extension:f,hms:g,seconds:h,suffix:j,prefix:i}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(49)],e=function(a,b){function c(a){return function(){return e(a)}}var d={},e=a.memoize(function(a){var b=navigator.userAgent.toLowerCase();return null!==b.match(a)}),f=d.isInt=function(a){return parseFloat(a)%1===0};d.isFlashSupported=function(){var a=d.flashVersion();return a&&a>=11.2},d.isFF=c(/firefox/i),d.isChrome=c(/chrome/i),d.isIPod=c(/iP(hone|od)/i),d.isIPad=c(/iPad/i),d.isSafari602=c(/Macintosh.*Mac OS X 10_8.*6\.0\.\d* Safari/i);var g=d.isIETrident=function(a){return a?(a=parseFloat(a).toFixed(1),e(new RegExp("trident/.+rv:\\s*"+a,"i"))):e(/trident/i)},h=d.isMSIE=function(a){return a?(a=parseFloat(a).toFixed(1),e(new RegExp("msie\\s*"+a,"i"))):e(/msie/i)};d.isIE=function(a){return a?(a=parseFloat(a).toFixed(1),a>=11?g(a):h(a)):h()||g()},d.isSafari=function(){return e(/safari/i)&&!e(/chrome/i)&&!e(/chromium/i)&&!e(/android/i)};var i=d.isIOS=function(a){return e(a?new RegExp("iP(hone|ad|od).+\\sOS\\s"+a,"i"):/iP(hone|ad|od)/i)};d.isAndroidNative=function(a){return j(a,!0)};var j=d.isAndroid=function(a,b){return b&&e(/chrome\/[123456789]/i)&&!e(/chrome\/18/)?!1:a?(f(a)&&!/\./.test(a)&&(a=""+a+"."),e(new RegExp("Android\\s*"+a,"i"))):e(/Android/i)};return d.isMobile=function(){return i()||j()},d.isIframe=function(){return window.frameElement&&"IFRAME"===window.frameElement.nodeName},d.flashVersion=function(){if(d.isAndroid())return 0;var a,c=navigator.plugins;if(c&&(a=c["Shockwave Flash"],a&&a.description))return parseFloat(a.description.replace(/\D+(\d+\.?\d*).*/,"$1"));if("undefined"!=typeof window.ActiveXObject){var e=b.tryCatch(function(){return a=new window.ActiveXObject("ShockwaveFlash.ShockwaveFlash"),a?parseFloat(a.GetVariable("$version").split(" ")[1].replace(/\s*,\s*/,".")):void 0});return e instanceof b.Error?0:e}return 0},d}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(50),c(47),c(53)],e=function(a,b,c){var d={};return d.createElement=function(a){var b=document.createElement("div");return b.innerHTML=a,b.firstChild},d.styleDimension=function(a){return a+(a.toString().indexOf("%")>0?"":"px")},d.classList=function(a){return a.classList?a.classList:a.className.split(" ")},d.hasClass=c.hasClass,d.addClass=function(c,d){var e=b.isString(c.className)?c.className.split(" "):[],f=b.isArray(d)?d:d.split(" ");b.each(f,function(a){b.contains(e,a)||e.push(a)}),c.className=a.trim(e.join(" "))},d.removeClass=function(c,d){var e=b.isString(c.className)?c.className.split(" "):[],f=b.isArray(d)?d:d.split(" ");c.className=a.trim(b.difference(e,f).join(" "))},d.toggleClass=function(a,c,e){var f=d.hasClass(a,c);e=b.isBoolean(e)?e:!f,e!==f&&(e?d.addClass(a,c):d.removeClass(a,c))},d.emptyElement=function(a){for(;a.firstChild;)a.removeChild(a.firstChild)},d.addStyleSheet=function(a){var b=document.createElement("link");b.rel="stylesheet",b.href=a,document.getElementsByTagName("head")[0].appendChild(b)},d.empty=function(a){if(a)for(;a.childElementCount>0;)a.removeChild(a.children[0])},d.bounds=function(a){var b={left:0,right:0,width:0,height:0,top:0,bottom:0};if(!a||!document.body.contains(a))return b;if(a.getBoundingClientRect){var c=a.getBoundingClientRect(a),d=window.pageYOffset,e=window.pageXOffset;if(!(c.width||c.height||c.left||c.top))return b;b.left=c.left+e,b.right=c.right+e,b.top=c.top+d,b.bottom=c.bottom+d,b.width=c.right-c.left,b.height=c.bottom-c.top}else{b.width=0|a.offsetWidth,b.height=0|a.offsetHeight;do b.left+=0|a.offsetLeft,b.top+=0|a.offsetTop;while(a=a.offsetParent);b.right=b.left+b.width,b.bottom=b.top+b.height}return b},d}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){return{hasClass:function(a,b){var c=" "+b+" ";return 1===a.nodeType&&(" "+a.className+" ").replace(/[\t\r\n\f]/g," ").indexOf(c)>=0}}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(50)],e=function(a){function b(a){a=a.split("-");for(var b=1;b<a.length;b++)a[b]=a[b].charAt(0).toUpperCase()+a[b].slice(1);return a.join("")}function c(b,c,d){if(""===c||void 0===c||null===c)return"";var e=d?" !important":"";return"string"==typeof c&&isNaN(c)?/png|gif|jpe?g/i.test(c)&&c.indexOf("url")<0?"url("+c+")":c+e:0===c||"z-index"===b||"opacity"===b?""+c+e:/color/i.test(b)?"#"+a.pad(c.toString(16).replace(/^0x/i,""),6)+e:Math.ceil(c)+"px"+e}var d,e={},f=function(a,b){d||(d=document.createElement("style"),d.type="text/css",document.getElementsByTagName("head")[0].appendChild(d));var c=a+JSON.stringify(b).replace(/"/g,""),f=document.createTextNode(c);e[a]&&d.removeChild(e[a]),e[a]=f,d.appendChild(f)},g=function(a,d){if(void 0!==a&&null!==a){void 0===a.length&&(a=[a]);var e,f={};for(e in d)f[e]=c(e,d[e]);for(var g=0;g<a.length;g++){var h,i=a[g];if(void 0!==i&&null!==i)for(e in f)h=b(e),i.style[h]!==f[e]&&(i.style[h]=f[e])}}},h=function(a){for(var b in e)b.indexOf(a)>=0&&(d.removeChild(e[b]),delete e[b])},i=function(a,b){var c="transform",d={};b=b||"",d[c]=b,d["-webkit-"+c]=b,d["-ms-"+c]=b,d["-moz-"+c]=b,d["-o-"+c]=b,g(a,d)},j=function(a,b){var c="rgb";a?(a=String(a).replace("#",""),3===a.length&&(a=a[0]+a[0]+a[1]+a[1]+a[2]+a[2])):a="000000";var d=[parseInt(a.substr(0,2),16),parseInt(a.substr(2,2),16),parseInt(a.substr(4,2),16)];return void 0!==b&&100!==b&&(c+="a",d.push(b/100)),c+"("+d.join(",")+")"};return{css:f,style:g,clearCss:h,transform:i,hexToRgba:j}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(48),c(46),c(49)],e=function(a,b,c,d){function e(a){return a&&a.indexOf("://")>=0&&a.split("/")[2]!==window.location.href.split("/")[2]}function f(a,b,c){return function(){a("Error loading file",b,c)}}function g(a,b,c,d,e){return function(){if(4===a.readyState)switch(a.status){case 200:h(a,b,c,d,e)();break;case 404:d("File not found",b,a)}}}function h(b,d,e,f,g){return function(){var h,i;if(g)e(b);else{try{if(h=b.responseXML,h&&(i=h.firstChild,h.lastChild&&"parsererror"===h.lastChild.nodeName))return void(f&&f("Invalid XML",d,b))}catch(j){}if(h&&i)return e(b);var k=c.parseXML(b.responseText);if(!k||!k.firstChild)return void(f&&f(b.responseText?"Invalid XML":d,d,b));b=a.extend({},b,{responseXML:k}),e(b)}}}var i={};return i.ajax=function(a,c,i,j){var k,l=!1;if(a.indexOf("#")>0&&(a=a.replace(/#.*$/,"")),e(a)&&b.exists(window.XDomainRequest))k=new window.XDomainRequest,k.onload=h(k,a,c,i,j),k.ontimeout=k.onprogress=function(){},k.timeout=5e3;else{if(!b.exists(window.XMLHttpRequest))return i&&i("",a,k),k;k=new window.XMLHttpRequest,k.onreadystatechange=g(k,a,c,i,j)}k.overrideMimeType&&k.overrideMimeType("text/xml"),k.onerror=f(i,a,k);var m=d.tryCatch(function(){k.open("GET",a,!0)});return m instanceof d.Error&&(l=!0),setTimeout(function(){if(l)return void(i&&i(a,a,k));var b=d.tryCatch(function(){k.send()});b instanceof d.Error&&i&&i(a,a,k);
},0),k},i}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(57),c(47),c(48),c(46),c(58)],e=function(a,b,c,d,e){var f={};return f.repo=b.memoize(function(){var b=e.split("+")[0],d=a.repo+b+"/";return c.isHTTPS()?d.replace("http://","https://ssl."):d}),f.versionCheck=function(a){var b=("0"+a).split(/\W/),c=e.split(/\W/),d=parseFloat(b[0]),f=parseFloat(c[0]);return d>f?!1:d===f&&parseFloat("0"+b[1])>parseFloat(c[1])?!1:!0},f.loadFrom=function(){return f.repo()},f}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){return{repo:"http://p.jwpcdn.com/player/v/",SkinsIncluded:["seven"],SkinsLoadable:["beelden","bekle","five","glow","roundster","six","stormtrooper","vapor"]}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){return"7.1.5+commercial_v7-1-5.57.commercial.9fb008.jwplayer.742351.analytics.44220f.vast.3f7507.googima.3b8231.plugins.a856bc"}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(60),c(47)],e=function(a,b,d){function e(b){d.each(b,function(c,d){b[d]=a.serialize(c)})}function f(a){return a.slice&&"px"===a.slice(-2)&&(a=a.slice(0,-2)),a}function g(b,c){if(-1===c.toString().indexOf("%"))return 0;if("string"!=typeof b||!a.exists(b))return 0;var d=b.indexOf(":");if(-1===d)return 0;var e=parseFloat(b.substr(0,d)),f=parseFloat(b.substr(d+1));return 0>=e||0>=f?0:f/e*100+"%"}var h={autostart:!1,controls:!0,cookies:!0,displaytitle:!0,displaydescription:!0,mobilecontrols:!1,repeat:!1,castAvailable:!1,skin:"seven",stretching:b.UNIFORM,mute:!1,volume:90,width:480,height:270},i=function(b){var i=d.extend({},(window.jwplayer||{}).defaults,b);e(i);var j=d.extend({},h,i);return"."===j.base&&(j.base=a.getScriptPath("jwplayer.js")),j.base=(j.base||a.loadFrom()).replace(/\/?$/,"/"),c.p=j.base,j.width=f(j.width),j.height=f(j.height),j.flashplayer=j.flashplayer||a.getScriptPath("jwplayer.js")+"jwplayer.flash.swf","http:"===window.location.protocol&&(j.flashplayer=j.flashplayer.replace("https","http")),j.aspectratio=g(j.aspectratio,j.width),d.isObject(j.skin)&&(j.skinUrl=j.skin.url,j.skinColorInactive=j.skin.inactive,j.skinColorActive=j.skin.active,j.skinColorBackground=j.skin.background,j.skin=d.isString(j.skin.name)?j.skin.name:h.skin),d.isString(j.skin)&&j.skin.indexOf(".xml")>0&&(console.log("JW Player does not support XML skins, please update your config"),j.skin=j.skin.replace(".xml","")),j.aspectratio||delete j.aspectratio,j.playlist||(j.playlist=d.clone(j)),j};return i}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(45),c(54)],e=function(a,b,c){var d={NONE:"none",FILL:"fill",UNIFORM:"uniform",EXACTFIT:"exactfit"},e=function(a,b,d,e,f){var g="";b=b||1,d=d||1,e=0|e,f=0|f,(1!==b||1!==d)&&(g="scale("+b+", "+d+")"),(e||f)&&(g&&(g+=" "),g="translate("+e+"px, "+f+"px)"),c.transform(a,g)},f=e,g=function(e,g,h,i,j,k){if(!g)return!1;if(!(h&&i&&j&&k))return!1;e=e||d.UNIFORM;var l=2*Math.ceil(h/2)/j,m=2*Math.ceil(i/2)/k,n="video"===g.tagName.toLowerCase(),o=!1,p="jw-stretch-"+e.toLowerCase(),q=!1;switch(e.toLowerCase()){case d.FILL:l>m?m=l:l=m,o=!0;break;case d.NONE:l=m=1;case d.EXACTFIT:o=!0;break;case d.UNIFORM:default:l>m?(j*m/h>.95?(o=!0,p="jw-stretch-exactfit"):(j*=m,k*=m),q=!0):(k*l/i>.95?(o=!0,p="jw-stretch-exactfit"):(j*=l,k*=l),q=!1),o&&(l=2*Math.ceil(h/2)/j,m=2*Math.ceil(i/2)/k)}if(n){var r={left:"",right:"",width:"",height:""};if(o?(j>h&&(r.left=r.right=Math.ceil((h-j)/2)),k>i&&(r.top=r.bottom=Math.ceil((i-k)/2)),r.width=j,r.height=k,f(g,l,m,0,0)):(o=!1,c.transform(g)),b.isIOS(8)&&o===!1){var s={width:"auto",height:"auto"};e.toLowerCase()===d.UNIFORM&&(s[q===!1?"width":"height"]="100%"),a.extend(r,s)}c.style(g,r)}else g.className=g.className.replace(/\s*jw\-stretch\-(none|exactfit|uniform|fill)/g,"")+" "+p;return o};return{scale:e,stretching:d,stretch:g}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(62),c(87),c(66),c(65),c(45),c(63),c(47)],e=function(a,b,c,d,e,f,g){function h(c){var d=c.get("provider").name||"";return d.indexOf("flash")>=0?b:a}var i={skipoffset:null,tag:null},j=function(a,b,f){function j(a,b){b=b||{},u.tag&&!b.tag&&(b.tag=u.tag),this.trigger(a,b)}function k(a){s._adModel.set("duration",a.duration),s._adModel.set("position",a.position)}function l(a){if(m&&t+1<m.length){s._adModel.set("state","buffering"),b.set("skipButton",!1),t++;var d,e=m[t];n&&(d=n[t]),this.loadItem(e,d)}else a.type===c.JWPLAYER_MEDIA_COMPLETE&&(j.call(this,a.type,a),this.trigger(c.JWPLAYER_PLAYLIST_COMPLETE,{})),this.destroy()}var m,n,o,p,q,r=h(b),s=new r(a,b),t=0,u={},v=g.bind(function(a){a=a||{},a.hasControls=!!b.get("controls"),this.trigger(c.JWPLAYER_INSTREAM_CLICK,a),s&&s._adModel&&(s._adModel.get("state")===d.PAUSED?a.hasControls&&s.instreamPlay():s.instreamPause())},this),w=g.bind(function(){s&&s._adModel&&s._adModel.get("state")===d.PAUSED&&b.get("controls")&&(a.setFullscreen(),a.play())},this);this.type="instream",this.init=function(){o=b.getVideo(),p=b.get("position"),q=b.get("playlist")[b.get("item")],s.on("all",j,this),s.on(c.JWPLAYER_MEDIA_TIME,k,this),s.on(c.JWPLAYER_MEDIA_COMPLETE,l,this),s.init(),o.detachMedia(),b.mediaModel.set("state",d.BUFFERING),a.checkBeforePlay()||0===p&&!o.checkComplete()?(p=0,b.set("preInstreamState","instream-preroll")):o&&o.checkComplete()||b.get("state")===d.COMPLETE?b.set("preInstreamState","instream-postroll"):b.set("preInstreamState","instream-midroll");var g=b.get("state");return(g===d.PLAYING||g===d.BUFFERING)&&o.pause(),f.setupInstream(s._adModel),s._adModel.set("state",d.BUFFERING),f.clickHandler().setAlternateClickHandlers(e.noop,null),this.setText("Loading ad"),this},this.loadItem=function(a,d){return e.isAndroid(2.3)?void this.trigger({type:c.JWPLAYER_ERROR,message:"Error loading instream: Cannot play instream on Android 2.3"}):(g.isArray(a)&&(m=a,n=d,a=m[t],n&&(d=n[t])),this.trigger(c.JWPLAYER_PLAYLIST_ITEM,{index:t,item:a}),u=g.extend({},i,d),s.load(a),this.addClickHandler(),void(u.skipoffset&&(s._adModel.set("skipMessage",u.skipMessage),s._adModel.set("skipText",u.skipText),s._adModel.set("skipOffset",u.skipoffset),b.set("skipButton",!0))))},this.play=function(){s.instreamPlay()},this.pause=function(){s.instreamPause()},this.hide=function(){s.hide()},this.addClickHandler=function(){f.clickHandler().setAlternateClickHandlers(v,w),s.on(c.JWPLAYER_MEDIA_META,this.metaHandler,this)},this.skipAd=function(a){var b=c.JWPLAYER_AD_SKIPPED;this.trigger(b,a),l.call(this,{type:b})},this.metaHandler=function(a){a.width&&a.height&&f.resizeMedia()},this.destroy=function(){if(this.off(),b.set("skipButton",!1),s){f.clickHandler()&&f.clickHandler().revertAlternateClickHandlers(),s.instreamDestroy(),f.destroyInstream(),s=null,a.attachMedia();var c=b.get("preInstreamState");switch(c){case"instream-preroll":case"instream-midroll":var d=g.extend({},q);d.starttime=p,b.loadVideo(d),o.play();break;case"instream-postroll":case"instream-idle":o.stop()}}},this.getState=function(){return s&&s._adModel?s._adModel.get("state"):!1},this.setText=function(a){f.setAltText(a?a:"")},this.hide=function(){f.useExternalControls()}};return g.extend(j.prototype,f),j}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(63),c(64),c(66),c(65),c(67)],e=function(a,b,c,d,e,f){var g=function(g,h){function i(){var b=m.getVideo();if(n!==b){if(n=b,!b)return;b.off(),b.on("all",function(b,c){c=a.extend({},c,{type:b}),this.trigger(b,c)},o),b.on(d.JWPLAYER_MEDIA_BUFFER_FULL,l),b.on(d.JWPLAYER_PLAYER_STATE,j),b.attachMedia(),b.mute(h.get("mute")),b.volume(h.get("volume")),m.on("change:state",c,o)}}function j(a){switch(a.newstate){case e.PLAYING:m.set("state",a.newstate);break;case e.PAUSED:m.set("state",a.newstate)}}function k(a){h.trigger(a.type,a),o.trigger(d.JWPLAYER_FULLSCREEN,{fullscreen:a.jwstate})}function l(){m.getVideo().play()}var m,n,o=a.extend(this,b);return g.on(d.JWPLAYER_FULLSCREEN,function(a){this.trigger(d.JWPLAYER_FULLSCREEN,a)},o),this.init=function(){m=(new f).setup({id:h.get("id"),volume:h.get("volume"),fullscreen:h.get("fullscreen"),mute:h.get("mute")}),m.on("fullscreenchange",k),this._adModel=m},o.load=function(a){m.setPlaylist([a]),m.setItem(0),i(),m.off(d.JWPLAYER_ERROR),m.on(d.JWPLAYER_ERROR,function(a){this.trigger(d.JWPLAYER_ERROR,a)},o),m.loadVideo()},this.instreamDestroy=function(){m&&(m.off(),this.off(),n&&(n.detachMedia(),n.off(),n.destroy()),m=null,g.off(null,null,this),g=null)},o.instreamPlay=function(){m.getVideo()&&m.getVideo().play(!0)},o.instreamPause=function(){m.getVideo()&&m.getVideo().pause(!0)},o};return g}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47)],e=function(a){var b=[],c=b.slice,d={on:function(a,b,c){if(!f(this,"on",a,[b,c])||!b)return this;this._events||(this._events={});var d=this._events[a]||(this._events[a]=[]);return d.push({callback:b,context:c}),this},once:function(b,c,d){if(!f(this,"once",b,[c,d])||!c)return this;var e=this,g=a.once(function(){e.off(b,g),c.apply(this,arguments)});return g._callback=c,this.on(b,g,d)},off:function(b,c,d){var e,g,h,i,j,k,l,m;if(!this._events||!f(this,"off",b,[c,d]))return this;if(!b&&!c&&!d)return this._events=void 0,this;for(i=b?[b]:a.keys(this._events),j=0,k=i.length;k>j;j++)if(b=i[j],h=this._events[b]){if(this._events[b]=e=[],c||d)for(l=0,m=h.length;m>l;l++)g=h[l],(c&&c!==g.callback&&c!==g.callback._callback||d&&d!==g.context)&&e.push(g);e.length||delete this._events[b]}return this},trigger:function(a){if(!this._events)return this;var b=c.call(arguments,1);if(!f(this,"trigger",a,b))return this;var d=this._events[a],e=this._events.all;return d&&g(d,b,this),e&&g(e,arguments,this),this}},e=/\s+/,f=function(a,b,c,d){if(!c)return!0;if("object"==typeof c){for(var f in c)a[b].apply(a,[f,c[f]].concat(d));return!1}if(e.test(c)){for(var g=c.split(e),h=0,i=g.length;i>h;h++)a[b].apply(a,[g[h]].concat(d));return!1}return!0},g=function(a,b,c){var d,e=-1,f=a.length,g=b[0],h=b[1],i=b[2];switch(b.length){case 0:for(;++e<f;)(d=a[e]).callback.call(d.context||c);return;case 1:for(;++e<f;)(d=a[e]).callback.call(d.context||c,g);return;case 2:for(;++e<f;)(d=a[e]).callback.call(d.context||c,g,h);return;case 3:for(;++e<f;)(d=a[e]).callback.call(d.context||c,g,h,i);return;default:for(;++e<f;)(d=a[e]).callback.apply(d.context||c,b);return}};return d}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(65)],e=function(a){function b(b){return b===a.COMPLETE||b===a.ERROR?a.IDLE:b}return function(a,c,d){if(c=b(c),d=b(d),c!==d){var e=c.replace(/(?:ing|d)$/,""),f={type:e,newstate:c,oldstate:d,reason:a.mediaModel.get("state")};this.trigger(e,f)}}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){return{BUFFERING:"buffering",IDLE:"idle",COMPLETE:"complete",PAUSED:"paused",PLAYING:"playing",ERROR:"error",LOADING:"loading",STALLED:"stalled"}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){var a={DRAG:"drag",DRAG_START:"dragStart",DRAG_END:"dragEnd",CLICK:"click",DOUBLE_CLICK:"doubleClick",TAP:"tap",DOUBLE_TAP:"doubleTap",OVER:"over",OUT:"out"},b={COMPLETE:"complete",ERROR:"error",JWPLAYER_AD_CLICK:"adClick",JWPLAYER_AD_COMPANIONS:"adCompanions",JWPLAYER_AD_COMPLETE:"adComplete",JWPLAYER_AD_ERROR:"adError",JWPLAYER_AD_IMPRESSION:"adImpression",JWPLAYER_AD_META:"adMeta",JWPLAYER_AD_PAUSE:"adPause",JWPLAYER_AD_PLAY:"adPlay",JWPLAYER_AD_SKIPPED:"adSkipped",JWPLAYER_AD_TIME:"adTime",JWPLAYER_CAST_AD_CHANGED:"castAdChanged",JWPLAYER_MEDIA_COMPLETE:"complete",JWPLAYER_READY:"ready",JWPLAYER_MEDIA_SEEK:"seek",JWPLAYER_MEDIA_BEFOREPLAY:"beforePlay",JWPLAYER_MEDIA_BEFORECOMPLETE:"beforeComplete",JWPLAYER_MEDIA_BUFFER_FULL:"bufferFull",JWPLAYER_DISPLAY_CLICK:"displayClick",JWPLAYER_PLAYLIST_COMPLETE:"playlistComplete",JWPLAYER_CAST_SESSION:"cast",JWPLAYER_MEDIA_ERROR:"mediaError",JWPLAYER_MEDIA_FIRST_FRAME:"firstFrame",JWPLAYER_MEDIA_PLAY_ATTEMPT:"playAttempt",JWPLAYER_MEDIA_LOADED:"loaded",JWPLAYER_MEDIA_SEEKED:"seeked",JWPLAYER_SETUP_ERROR:"setupError",JWPLAYER_ERROR:"error",JWPLAYER_PLAYER_STATE:"state",JWPLAYER_CAST_AVAILABLE:"castAvailable",JWPLAYER_MEDIA_BUFFER:"bufferChange",JWPLAYER_MEDIA_TIME:"time",JWPLAYER_MEDIA_TYPE:"mediaType",JWPLAYER_MEDIA_VOLUME:"volume",JWPLAYER_MEDIA_MUTE:"mute",JWPLAYER_MEDIA_META:"meta",JWPLAYER_MEDIA_LEVELS:"levels",JWPLAYER_MEDIA_LEVEL_CHANGED:"levelsChanged",JWPLAYER_CONTROLS:"controls",JWPLAYER_FULLSCREEN:"fullscreen",JWPLAYER_RESIZE:"resize",JWPLAYER_PLAYLIST_ITEM:"playlistItem",JWPLAYER_PLAYLIST_LOADED:"playlist",JWPLAYER_AUDIO_TRACKS:"audioTracks",JWPLAYER_AUDIO_TRACK_CHANGED:"audioTrackChanged",JWPLAYER_LOGO_CLICK:"logoClick",JWPLAYER_CAPTIONS_LIST:"captionsList",JWPLAYER_CAPTIONS_CHANGED:"captionsChanged",JWPLAYER_PROVIDER_CHANGED:"providerChanged",JWPLAYER_PROVIDER_FIRST_FRAME:"providerFirstFrame",JWPLAYER_USER_ACTION:"userAction",JWPLAYER_PROVIDER_CLICK:"providerClick",JWPLAYER_VIEW_TAB_FOCUS:"tabFocus",JWPLAYER_CONTROLBAR_DRAGGING:"scrubbing",JWPLAYER_INSTREAM_CLICK:"instreamClick"};return b.touchEvents=a,b}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(82),c(68),c(79),c(80),c(47),c(63),c(86),c(66),c(65)],e=function(a,b,c,d,e,f,g,h,i,j){var k=function(){function h(a,b){switch(a){case"flashBlocked":return void this.set("flashBlocked",!0);case"flashUnblocked":return void this.set("flashBlocked",!1);case"volume":case"mute":return void this.set(a,b[a]);case i.JWPLAYER_MEDIA_TYPE:this.mediaModel.set("mediaType",b.mediaType);break;case i.JWPLAYER_PLAYER_STATE:return void this.mediaModel.set("state",b.newstate);case i.JWPLAYER_MEDIA_BUFFER:this.set("buffer",b.bufferPercent);break;case i.JWPLAYER_MEDIA_BUFFER_FULL:this.playVideo();break;case i.JWPLAYER_MEDIA_TIME:this.mediaModel.set("position",b.position),this.mediaModel.set("duration",b.duration),this.set("position",b.position),this.set("duration",b.duration);break;case i.JWPLAYER_PROVIDER_CHANGED:this.set("provider",m.getName());break;case i.JWPLAYER_MEDIA_LEVELS:this.setQualityLevel(b.currentQuality,b.levels),this.mediaModel.set("levels",b.levels);break;case i.JWPLAYER_MEDIA_LEVEL_CHANGED:this.setQualityLevel(b.currentQuality,b.levels);break;case i.JWPLAYER_AUDIO_TRACKS:this.setCurrentAudioTrack(b.currentTrack,b.tracks),this.mediaModel.set("audioTracks",b.tracks);break;case i.JWPLAYER_AUDIO_TRACK_CHANGED:this.setCurrentAudioTrack(b.currentTrack,b.tracks);break;case"visualQuality":var c=f.extend({},b);this.mediaModel.set("visualQuality",c)}var d=f.extend({},b,{type:a});this.mediaController.trigger(a,d)}var k,m,n=this,o={},p=a.noop;this.mediaController=f.extend({},g),this.mediaModel=new l,this.set("mediaModel",this.mediaModel),e.model(this),this.setup=function(b){return b.cookies&&(d.model(this),o=d.getAllItems()),f.extend(this.attributes,b,o,{state:j.IDLE,flashBlocked:!1,fullscreen:!1,compactUI:!1,scrubbing:!1,duration:0,position:0,buffer:0}),a.isMobile()&&this.set("autostart",!1),this.updateProviders(),this},this.getConfiguration=function(){return f.omit(this.clone(),["mediaModel"])},this.updateProviders=function(){k=new c(this.getConfiguration())},this.setQualityLevel=function(a,b){a>-1&&b.length>1&&"youtube"!==m.getName().name&&this.mediaModel.set("currentLevel",parseInt(a))},this.setCurrentAudioTrack=function(a,b){a>-1&&b.length>1&&this.mediaModel.set("currentAudioTrack",parseInt(a))},this.changeVideoProvider=function(a){var b;m&&(m.off(null,null,this),b=m.getContainer(),b&&m.remove()),p=new a(n.get("id"),n.getConfiguration()),b&&p.setContainer(b),this.set("provider",p.getName()),m=p,m.volume(n.get("volume")),m.mute(n.get("mute")),m.on("all",h,this)},this.destroy=function(){m&&(m.off(null,null,this),m.destroy())},this.getVideo=function(){return m},this.setFullscreen=function(a){a=!!a,a!==n.get("fullscreen")&&n.set("fullscreen",a)},this.setPlaylist=function(a){var c=b(a);return c=b.filterPlaylist(c,k,n.get("androidhls"),this.get("drm")),this.set("playlist",c),0===c.length?void this.mediaController.trigger(i.JWPLAYER_ERROR,{message:"Error loading playlist: No playable sources found"}):void 0},this.chooseProvider=function(a){return k.choose(a).provider},this.setItem=function(a){var b=n.get("playlist"),c=(a+b.length)%b.length;this.mediaModel.off(),this.mediaModel=new l,this.set("mediaModel",this.mediaModel),this.set("item",c);var d=this.get("playlist")[c];this.set("playlistItem",d);var e=d&&d.sources&&d.sources[0];if(void 0!==e){var f=this.chooseProvider(e);if(!f)throw new Error("No suitable provider found");p instanceof f||n.changeVideoProvider(f),p.init&&p.init(d),this.trigger("setItem")}},this.resetProvider=function(){p=null},this.setVolume=function(a){a=Math.round(a),n.set("volume",a),m&&m.volume(a);var b=0===a;b!==n.get("mute")&&n.setMute(b)},this.setMute=function(b){if(a.exists(b)||(b=!n.get("mute")),n.set("mute",b),m&&m.mute(b),!b){var c=Math.max(10,n.get("volume"));this.setVolume(c)}},this.loadVideo=function(a){if(this.mediaController.trigger(i.JWPLAYER_MEDIA_PLAY_ATTEMPT),!a){var b=this.get("item");a=this.get("playlist")[b]}this.set("position",a.starttime||0),this.set("duration",a.duration||0),m.load(a)},this.playVideo=function(){m.play()},this.setVideoSubtitleTrack=function(a){this.set("captionsIndex",a),m.setSubtitlesTrack&&m.setSubtitlesTrack(a)}},l=k.MediaModel=function(){this.set("state",j.IDLE)};return f.extend(k.prototype,h),f.extend(l.prototype,h),k}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(69)],e=function(a){return a.prototype.providerSupports=function(a,b){return a.supports(b,this.config.edition)},a}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(70),c(74),c(47)],e=function(a,b,c){function d(b){this.providers=a.slice(),this.config=b||{},"flash"===this.config.primary&&f(this.providers,"html5","flash")}function e(a,b){for(var c=0;c<a.length;c++)if(a[c].name===b)return c;return-1}function f(a,b,c){var d=e(a,b),f=e(a,c),g=a[d];a[d]=a[f],a[f]=g}return c.extend(d.prototype,{providerSupports:function(a,b){return a.supports(b)},choose:function(a){a=c.isObject(a)?a:{};for(var d=this.providers.length,e=0;d>e;e++){var f=this.providers[e];if(this.providerSupports(f,a)){var g=d-e-1;return{priority:g,name:f.name,type:a.type,provider:b[f.name]}}}return null}}),d}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(71),c(47),c(72)],e=function(a,b,c,d){var e=c.find(d,c.matches({name:"flash"})),f=e.supports;return e.supports=function(c,d){if(!a.isFlashSupported())return!1;var e=c&&c.type;if("hls"===e||"m3u8"===e){var g=b(d);return g("hls")}return f.apply(this,arguments)},d}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47)],e=function(a){var b={setup:["free","premium","enterprise","ads","trial"],"custom-rightclick":["premium","enterprise","ads","trial"],dash:["premium","enterprise","ads","trial"],drm:["enterprise","ads","trial"],hls:["premium","ads","enterprise","trial"],ads:["ads","trial"],casting:["premium","enterprise","ads","trial"]},c=function(c){return function(d){return a.contains(b[d],c)}};return c}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(47),c(73)],e=function(a,b,c){function d(b){if("hls"===b.type)if(b.androidhls!==!1){var c=a.isAndroidNative;if(c(2)||c(3)||c("4.0"))return!1;if(a.isAndroid())return!0}else if(a.isAndroid())return!1;return null}var e=[{name:"youtube",supports:function(b){return a.isYouTube(b.file,b.type)}},{name:"html5",supports:function(b){var e={aac:"audio/mp4",mp4:"video/mp4",f4v:"video/mp4",m4v:"video/mp4",mov:"video/mp4",mp3:"audio/mpeg",mpeg:"audio/mpeg",ogv:"video/ogg",ogg:"video/ogg",oga:"video/ogg",vorbis:"video/ogg",webm:"video/webm",f4a:"video/aac",m3u8:"application/vnd.apple.mpegurl",m3u:"application/vnd.apple.mpegurl",hls:"application/vnd.apple.mpegurl"},f=b.file,g=b.type,h=d(b);if(null!==h)return h;if(a.isRtmp(f,g))return!1;if(!e[g])return!1;if(c.canPlayType){var i=c.canPlayType(e[g]);return!!i}return!1}},{name:"flash",supports:function(c){var d={flv:"video",f4v:"video",mov:"video",m4a:"video",m4v:"video",mp4:"video",aac:"video",f4a:"video",mp3:"sound",mpeg:"sound",smil:"rtmp"},e=b.keys(d);if(!a.isFlashSupported())return!1;var f=c.file,g=c.type;return a.isRtmp(f,g)?!0:b.contains(e,g)}}];return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){return document.createElement("video")}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(75),c(77)],e=function(a,b){var c={html5:a,flash:b};return c}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(54),c(45),c(60),c(47),c(66),c(65),c(76),c(63)],e=function(a,b,c,d,e,f,g,h){function i(a,c){b.foreach(a,function(a,b){c.addEventListener(a,b,!1)})}function j(a,c){b.foreach(a,function(a,b){c.removeEventListener(a,b,!1)})}function k(a){if("hls"===a.type)if(a.androidhls!==!1){var c=b.isAndroidNative;if(c(2)||c(3)||c("4.0"))return!1;if(b.isAndroid())return!0}else if(b.isAndroid())return!1;return null}function l(g,l){function v(a){$.trigger("click",a)}function w(){if(fa){var a=la.duration;W!==a&&(W=a),s&&ba>0&&a>ba&&$.seek(ba),x()}}function x(a){B(a),fa&&($.state===f.PLAYING&&(ea=d.now(),X=la.currentTime,a&&(aa=!0),$.trigger(e.JWPLAYER_MEDIA_TIME,{position:X,duration:W})),$.state===f.STALLED&&$.setState(f.PLAYING))}function y(){$.trigger(e.JWPLAYER_MEDIA_META,{duration:la.duration,height:la.videoHeight,width:la.videoWidth})}function z(){fa&&(aa||(aa=!0,C()))}function A(){fa&&(z(),la.muted&&(la.muted=!1,la.muted=!0),y())}function B(){aa&&ba>0&&!s&&(p?setTimeout(function(){ba>0&&$.seek(ba)},200):$.seek(ba))}function C(){Y||(Y=!0,$.trigger(e.JWPLAYER_MEDIA_BUFFER_FULL))}function D(){fa&&(ea=d.now(),$.setState(f.PLAYING),$.trigger(e.JWPLAYER_PROVIDER_FIRST_FRAME,{}))}function E(){fa&&(ha||la.paused||la.ended||$.state!==f.LOADING&&($.seeking||$.setState(f.STALLED)))}function F(){fa&&(b.log("Error playing media: %o %s",la.error,la.src||V.file),$.trigger(e.JWPLAYER_MEDIA_ERROR,{message:"Error loading media: File could not be played"}))}function G(a){var c;return"array"===b.typeOf(a)&&a.length>0&&(c=d.map(a,function(a,b){return{label:a.label||b}})),c}function H(a){Z=a,ga=I(a);var b=G(a);b&&$.trigger(e.JWPLAYER_MEDIA_LEVELS,{levels:b,currentQuality:ga})}function I(a){var b=Math.max(0,ga),c=l.qualityLabel;if(a)for(var d=0;d<a.length;d++)if(a[d]["default"]&&(b=d),c&&a[d].label===c)return d;return b}function J(){return q||r}function K(a,c){V=Z[ga],m(ca),ca=setInterval(N,o),ba=0;var d=la.src!==V.file;d||J()?(q||$.setState(f.LOADING),aa=!1,Y=!1,W=c,ha=k(V),la.src=V.file,la.load()):(0===a&&(ba=-1,$.seek(a)),y(),la.play()),X=la.currentTime,q&&C(),b.isIOS()&&$.getFullScreen()&&(la.controls=!0),a>0&&$.seek(a)}function L(){$.seeking=!1,$.trigger(e.JWPLAYER_MEDIA_SEEKED)}function M(){$.trigger("volume",{volume:Math.round(100*la.volume)}),$.trigger("mute",{mute:la.muted})}function N(){if(fa){var a=O();a!==da&&(da=a,$.trigger(e.JWPLAYER_MEDIA_BUFFER,{bufferPercent:100*a}));var b=la.currentTime;b===X?d.now()-ea>n&&E():(ea=d.now(),X=b)}}function O(){var a=la.buffered,c=la.duration;return!a||0===a.length||0>=c||c===1/0?0:b.between(a.end(a.length-1)/c,0,1)}function P(){if(fa&&$.state!==f.IDLE&&$.state!==f.COMPLETE){if(m(ca),ga=-1,ia=!0,$.trigger(e.JWPLAYER_MEDIA_BEFORECOMPLETE),!fa)return;Q()}}function Q(){$.setState(f.COMPLETE),ia=!1,$.trigger(e.JWPLAYER_MEDIA_COMPLETE)}function R(a){ja=!0,T(a),b.isIOS()&&(la.controls=!1)}function S(a){ja=!1,T(a),b.isIOS()&&(la.controls=!1)}function T(a){$.trigger("fullscreenchange",{target:a.target,jwstate:ja})}this.state=f.IDLE,this.seeking=!1,d.extend(this,h),this.trigger=function(a,b){return fa?h.trigger.call(this,a,b):void 0};var U,V,W,X,Y,Z,$=this,_={click:v,durationchange:w,ended:P,error:F,loadedmetadata:A,canplay:z,playing:D,progress:B,seeked:L,timeupdate:x,volumechange:M,webkitbeginfullscreen:R,webkitendfullscreen:S},aa=!1,ba=0,ca=-1,da=-1,ea=-1,fa=!0,ga=-1,ha=null,ia=!1,ja=!1,ka=document.getElementById(g),la=ka?ka.querySelector("video"):void 0;la=la||document.createElement("video"),la.className="jw-video jw-reset",i(_,la),t||(la.controls=!0,la.controls=!1),la.setAttribute("x-webkit-airplay","allow"),la.setAttribute("webkit-playsinline",""),this.stop=function(){fa&&(m(ca),la.removeAttribute("src"),p||la.load(),ga=-1,this.setState(f.IDLE))},this.destroy=function(){j(_,la),this.remove(),this.off()},this.load=function(a){fa&&(H(a.sources),this.sendMediaType(a.sources),K(a.starttime||0,a.duration||0))},this.play=function(){return $.seeking?($.setState(f.LOADING),void $.once(e.JWPLAYER_MEDIA_SEEKED,$.play)):void la.play()},this.pause=function(){la.pause(),this.setState(f.PAUSED)},this.seek=function(a){if(fa)if(0===ba&&this.trigger(e.JWPLAYER_MEDIA_SEEK,{position:la.currentTime,offset:a}),aa){ba=0;var c=b.tryCatch(function(){$.seeking=!0,la.currentTime=a});c instanceof b.Error&&(ba=a)}else ba=a},this.volume=function(a){a=b.between(a/100,0,1),la.volume=a},this.mute=function(a){la.muted=!!a},this.checkComplete=function(){return ia},this.detachMedia=function(){return m(ca),fa=!1,la},this.attachMedia=function(a){fa=!0,a||(aa=!1),la.loop=!1,ia&&Q()},this.setContainer=function(a){U=a,a.appendChild(la)},this.getContainer=function(){return U},this.remove=function(){la&&(la.removeAttribute("src"),p||la.load()),m(ca),ga=-1,U===la.parentNode&&U.removeChild(la)},this.setVisibility=function(b){b=!!b,b||s?a.style(U,{visibility:"visible",opacity:1}):a.style(U,{visibility:"",opacity:0})},this.resize=function(a,b,d){return c.stretch(d,la,a,b,la.videoWidth,la.videoHeight)},this.setFullscreen=function(a){if(a=!!a){var c=b.tryCatch(function(){var a=la.webkitEnterFullscreen||la.webkitEnterFullScreen;a&&a.apply(la)});return c instanceof b.Error?!1:$.getFullScreen()}var d=la.webkitExitFullscreen||la.webkitExitFullScreen;return d&&d.apply(la),a},$.getFullScreen=function(){return ja||!!la.webkitDisplayingFullscreen},this.setCurrentQuality=function(a){if(ga!==a&&(a=parseInt(a,10),a>=0&&Z&&Z.length>a)){ga=a,this.trigger(e.JWPLAYER_MEDIA_LEVEL_CHANGED,{currentQuality:a,levels:G(Z)});var b=la.currentTime||0,c=la.duration;0>=c&&(c=W),K(b,c||0)}},this.getCurrentQuality=function(){return ga},this.getQualityLevels=function(){return G(Z)},this.getName=function(){return{name:u}}}var m=window.clearInterval,n=256,o=100,p=b.isMSIE(),q=b.isMobile(),r=b.isSafari(),s=b.isAndroidNative(),t=b.isIOS(7),u="html5",v=function(){};return v.prototype=g,l.prototype=new v,l}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(66),c(65),c(47)],e=function(a,b,c,d){var e=a.noop,f=d.constant(!1),g={supports:f,play:e,load:e,stop:e,volume:e,mute:e,seek:e,resize:e,remove:e,destroy:e,setVisibility:e,setFullscreen:f,getFullscreen:e,getContainer:e,setContainer:f,getName:e,getQualityLevels:e,getCurrentQuality:e,setCurrentQuality:e,getAudioTracks:e,getCurrentAudioTrack:e,setCurrentAudioTrack:e,checkComplete:e,setControls:e,attachMedia:e,detachMedia:e,setState:function(a){var d=this.state||c.IDLE;this.state=a,a!==d&&this.trigger(b.JWPLAYER_PLAYER_STATE,{newstate:a})},sendMediaType:function(a){var c=a[0].type,d="oga"===c||"aac"===c||"mp3"===c||"mpeg"===c||"vorbis"===c;this.trigger(b.JWPLAYER_MEDIA_TYPE,{mediaType:d?"audio":"video"})}};return g}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(47),c(66),c(65),c(78),c(76),c(63)],e=function(a,b,c,d,e,f,g){function h(a){return a+"_swf_"+j++}function i(i,j){function k(a){if(B)for(var b=0;b<a.length;b++){var c=a[b];if(c.bitrate){var d=Math.round(c.bitrate/1024);c.label=l(d)}}}function l(a){var b=B[a];if(!b){for(var c=1/0,d=B.bitrates.length;d--;){var e=Math.abs(B.bitrates[d]-a);if(e>c)break;c=e}b=B.labels[B.bitrates[d+1]],B[a]=b}return b}function m(){var a=j.hlslabels;if(!a)return null;var b={},c=[];for(var d in a){var e=parseFloat(d);if(!isNaN(e)){var f=Math.round(e);b[f]=a[d],c.push(f)}}return 0===c.length?null:(c.sort(function(a,b){return a-b}),{labels:b,bitrates:c})}var n,o,p,q=null,r=-1,s=!1,t=-1,u=null,v=-1,w=null,x=!0,y=!1,z=function(){return o&&o.__ready},A=function(){o&&o.triggerFlash.apply(o,arguments)},B=m();b.extend(this,g,{load:function(a){q=a,s=!1,this.setState(d.LOADING),A("load",a),this.sendMediaType(a.sources)},play:function(){A("play")},pause:function(){A("pause"),this.setState(d.PAUSED)},stop:function(){A("stop"),t=-1,q=null,this.setState(d.IDLE)},seek:function(a){A("seek",a)},volume:function(a){if(b.isNumber(a)){var c=Math.min(Math.max(0,a),100);z()&&A("volume",c)}},mute:function(a){z()&&A("mute",a)},setState:function(){return f.setState.apply(this,arguments)},checkComplete:function(){return s},attachMedia:function(){x=!0,s&&(this.setState(d.COMPLETE),this.trigger(c.JWPLAYER_MEDIA_COMPLETE),s=!1)},detachMedia:function(){return x=!1,null},getSwfObject:function(a){var b=a.getElementsByTagName("object")[0];return b?(b.off(null,null,this),b):e.embed(j.flashplayer,a,h(i))},getContainer:function(){return n},setContainer:function(e){function f(a){clearTimeout(r),"resume"===a.state?g.trigger.call(h,"flashUnblocked"):r=setTimeout(function(){g.trigger.call(h,"flashBlocked")},250)}if(n!==e){n=e,o=this.getSwfObject(e);var h=this;r=setTimeout(function(){g.trigger.call(h,"flashBlocked")},2e3),o.once("embedded",function(){clearTimeout(r),g.trigger.call(h,"flashUnblocked")},this),o.once("ready",function(){o.once("pluginsLoaded",function(){o.queueCommands=!1,A("setupCommandQueue",o.__commandQueue),o.__commandQueue=[]});var a=b.extend({},j);A("setup",a),o.__ready=!0},this);var i=[c.JWPLAYER_MEDIA_META,c.JWPLAYER_MEDIA_ERROR,"subtitlesTracks","subtitlesTrackChanged","subtitlesTrackData"],l=[c.JWPLAYER_MEDIA_BUFFER,c.JWPLAYER_MEDIA_TIME],m=[c.JWPLAYER_MEDIA_BUFFER_FULL];o.on(c.JWPLAYER_MEDIA_LEVELS,function(a){k(a.levels),t=a.currentQuality,u=a.levels,this.trigger(a.type,a)},this),o.on(c.JWPLAYER_MEDIA_LEVEL_CHANGED,function(a){k(a.levels),t=a.currentQuality,u=a.levels,this.trigger(a.type,a)},this),o.on(c.JWPLAYER_AUDIO_TRACKS,function(a){v=a.currentTrack,w=a.tracks,this.trigger(a.type,a)},this),o.on(c.JWPLAYER_AUDIO_TRACK_CHANGED,function(a){v=a.currentTrack,w=a.tracks,this.trigger(a.type,a)},this),o.on(c.JWPLAYER_PLAYER_STATE,function(a){var b=a.newstate;b!==d.IDLE&&this.setState(b)},this),o.on(l.join(" "),function(a){"Infinity"===a.duration&&(a.duration=1/0),this.trigger(a.type,a)},this),o.on(i.join(" "),function(a){this.trigger(a.type,a)},this),o.on(m.join(" "),function(a){this.trigger(a.type)},this),o.on(c.JWPLAYER_MEDIA_BEFORECOMPLETE,function(a){s=!0,this.trigger(a.type),x===!0&&(s=!1)},this),o.on(c.JWPLAYER_MEDIA_COMPLETE,function(a){s||(this.setState(d.COMPLETE),this.trigger(a.type))},this),o.on(c.JWPLAYER_MEDIA_SEEK,function(a){this.trigger(c.JWPLAYER_MEDIA_SEEK,a)},this),o.on("visualQuality",function(a){a.reason=a.reason||"api",this.trigger("visualQuality",a),this.trigger(c.JWPLAYER_PROVIDER_FIRST_FRAME,{})},this),o.on(c.JWPLAYER_PROVIDER_CHANGED,function(a){p=a.message,this.trigger(c.JWPLAYER_PROVIDER_CHANGED,a)},this),o.on(c.JWPLAYER_ERROR,function(b){a.log("Error playing media: %o %s",b.code,b.message,b),this.trigger(c.JWPLAYER_MEDIA_ERROR,b)},this),a.isChrome()&&o.on("throttle",f,this)}},remove:function(){t=-1,u=null,e.remove(o)},setVisibility:function(a){a=!!a,n.style.opacity=a?1:0},resize:function(a,b,c){c&&A("stretch",c)},setControls:function(a){A("setControls",a)},setFullscreen:function(a){y=a,A("fullscreen",a)},getFullScreen:function(){return y},setCurrentQuality:function(a){A("setCurrentQuality",a)},getCurrentQuality:function(){return t},setSubtitlesTrack:function(a){A("setSubtitlesTrack",a)},getName:function(){return p?{name:"flash_"+p}:{name:"flash"}},getQualityLevels:function(){return u||q.sources},getAudioTracks:function(){return w},getCurrentAudioTrack:function(){return v},setCurrentAudioTrack:function(a){A("setCurrentAudioTrack",a)},destroy:function(){this.remove(),o&&(o.off(),o=null),n=null,q=null,this.off()}}),this.trigger=function(a,b){return x?g.trigger.call(this,a,b):void 0}}var j=0,k=function(){};return k.prototype=f,i.prototype=new k,i}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){
var d,e;d=[c(45),c(63),c(47)],e=function(a,b,c){function d(a,b,c){var d=document.createElement("param");d.setAttribute("name",b),d.setAttribute("value",c),a.appendChild(d)}function e(e,f,h,i){var j;if(i=i||"opaque",a.isMSIE()){var k=document.createElement("div");f.appendChild(k),k.outerHTML='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%" id="'+h+'" name="'+h+'" tabindex="0"><param name="movie" value="'+e+'"><param name="allowfullscreen" value="true"><param name="allowscriptaccess" value="always"><param name="wmode" value="'+i+'"><param name="bgcolor" value="'+g+'"><param name="menu" value="false"></object>';for(var l=f.getElementsByTagName("object"),m=l.length;m--;)l[m].id===h&&(j=l[m])}else j=document.createElement("object"),j.setAttribute("type","application/x-shockwave-flash"),j.setAttribute("data",e),j.setAttribute("width","100%"),j.setAttribute("height","100%"),j.setAttribute("bgcolor",g),j.setAttribute("id",h),j.setAttribute("name",h),d(j,"allowfullscreen","true"),d(j,"allowscriptaccess","always"),d(j,"wmode",i),d(j,"menu","false"),f.appendChild(j,f);return j.className="jw-swf jw-reset",j.style.display="block",j.style.position="absolute",j.style.left=0,j.style.right=0,j.style.top=0,j.style.bottom=0,c.extend(j,b),j.queueCommands=!0,j.triggerFlash=function(b){var c=this;if("setup"!==b&&c.queueCommands||!c.__externalCall){for(var d=c.__commandQueue,e=d.length;e--;)d[e][0]===b&&d.splice(e,1);return d.push(Array.prototype.slice.call(arguments)),c}var f=Array.prototype.slice.call(arguments,1),g=a.tryCatch(function(){if(f.length){var a=JSON.stringify(f);c.__externalCall(b,a)}else c.__externalCall(b)});return g instanceof a.Error&&console.error({command:b,error:g}),c},j.__commandQueue=[],j}function f(a){a&&a.parentNode&&(a.style.display="none",a.parentNode.removeChild(a))}var g="#000000";return{embed:e,remove:f}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(45)],e=function(a,b){function c(){for(var a={},c=document.cookie.split("; "),d=0;d<c.length;d++){var e=c[d].split("=");if("jwplayer."===e[0].substr(0,9)){var f=e[0].substr(9);a[f]=b.serialize(e[1])}}return a}function d(a){return c()[a]}function e(a,b){document.cookie="jwplayer."+a+"="+b+"; path=/"}function f(a){e(a,"; expires=Thu, 01 Jan 1970 00:00:01 GMT")}function g(){var b=c();a.each(b,function(a,b){f(b)})}function h(b){a.each(i,function(a){b.on("change:"+a,function(b,c){e(a,c)})})}var i=["volume","mute","captionLabel","qualityLabel"];return{model:h,getAllItems:c,getItem:d,setItem:e,removeItem:f,clear:g}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(81),c(66),c(47)],e=function(a,b,c){function d(a){a.mediaController.off(b.JWPLAYER_MEDIA_PLAY_ATTEMPT,a._onPlayAttempt),a.mediaController.off(b.JWPLAYER_PROVIDER_FIRST_FRAME,a._triggerFirstFrame),a.mediaController.off(b.JWPLAYER_MEDIA_TIME,a._onTime)}function e(a){d(a),a._triggerFirstFrame=c.once(function(){var c=a._qoeItem;c.tick(b.JWPLAYER_MEDIA_FIRST_FRAME);var e=c.between(b.JWPLAYER_MEDIA_PLAY_ATTEMPT,b.JWPLAYER_MEDIA_FIRST_FRAME);a.mediaController.trigger(b.JWPLAYER_MEDIA_FIRST_FRAME,{loadTime:e}),d(a)}),a._onTime=g(a._triggerFirstFrame),a._onPlayAttempt=function(){a._qoeItem.tick(b.JWPLAYER_MEDIA_PLAY_ATTEMPT)},a.mediaController.once(b.JWPLAYER_MEDIA_PLAY_ATTEMPT,a._onPlayAttempt),a.mediaController.once(b.JWPLAYER_PROVIDER_FIRST_FRAME,a._triggerFirstFrame),a.mediaController.on(b.JWPLAYER_MEDIA_TIME,a._onTime)}function f(c){c.on("change:mediaModel",function(c,d,f){c._qoeItem&&c._qoeItem.end(f.get("state")),c._qoeItem=new a,c._qoeItem.tick(b.JWPLAYER_PLAYLIST_ITEM),c._qoeItem.start(d.get("state")),e(c),d.on("change:state",function(a,b,d){c._qoeItem.end(d),c._qoeItem.start(b)})})}var g=function(a){var b=Number.MIN_VALUE;return function(c){c.position>b&&a(),b=c.position}};return{model:f}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47)],e=function(a){var b=function(){var b={},c={},d={},e={};return{start:function(c){b[c]=a.now(),d[c]=d[c]+1||1},end:function(d){if(b[d]){var e=a.now()-b[d];c[d]=c[d]+e||e}},dump:function(){return{counts:d,sums:c,events:e}},tick:function(b,c){e[b]=c||a.now()},between:function(a,b){return e[b]&&e[a]?e[b]-e[a]:-1}}};return b}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(83),c(84),c(47),c(68)],e=function(a,b,c,d){function e(a,b){for(var c=0;c<a.length;c++){var d=a[c],e=b.choose(d);if(e)return d.type}return null}var f=function(b){return b=c.isArray(b)?b:[b],c.compact(c.map(b,a))};f.filterPlaylist=function(a,b,d,e){var f=[];return c.each(a,function(a){a=c.extend({},a),a.sources=g(a.sources,b,d,a.drm||e),a.sources.length&&(a.file=a.sources[0].file,f.push(a))}),f};var g=f.filterSources=function(a,f,g,h){f&&f.choose||(f=new d({primary:f?"flash":null})),a=c.compact(c.map(a,function(a){return c.isObject(a)?(g&&(a.androidhls=g),(a.drm||h)&&(a.drm=a.drm||h),b(a)):void 0}));var i=e(a,f);return c.where(a,{type:i})};return f}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(84),c(85)],e=function(a,b,c){var d={sources:[],tracks:[]},e=function(e){e=e||{},a.isArray(e.tracks)||delete e.tracks;var f=a.extend({},d,e);a.isObject(f.sources)&&!a.isArray(f.sources)&&(f.sources=[b(f.sources)]),a.isArray(f.sources)&&0!==f.sources.length||(e.levels?f.sources=e.levels:f.sources=[b(e)]);for(var g=0;g<f.sources.length;g++){var h=f.sources[g];if(h){var i=h["default"];i?h["default"]="true"===i.toString():h["default"]=!1,f.sources[g].label||(f.sources[g].label=g.toString()),f.sources[g]=b(f.sources[g])}}return f.sources=a.compact(f.sources),a.isArray(f.tracks)||(f.tracks=[]),a.isArray(f.captions)&&(f.tracks=f.tracks.concat(f.captions),delete f.captions),f.tracks=a.compact(a.map(f.tracks,c)),f};return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(50),c(47)],e=function(a,b,c){var d={"default":!1},e=function(e){if(e&&e.file){var f=c.extend({},d,e);f.file=b.trim(""+f.file);var g=/^[^\/]+\/(?:x-)?([^\/]+)$/;if(g.test(f.type)&&(f.type=f.type.replace(g,"$1")),!f.type)if(a.isYouTube(f.file))f.type="youtube";else if(a.isRtmp(f.file))f.type="rtmp";else{var h=b.extension(f.file);f.type=h}if(f.type)return"m3u8"===f.type&&(f.type="hls"),"smil"===f.type&&(f.type="rtmp"),"m4a"===f.type&&(f.type="aac"),c.each(f,function(a,b){""===a&&delete f[b]}),f}};return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47)],e=function(a){var b={kind:"captions","default":!1},c=function(c){return c&&c.file?a.extend({},b,c):void 0};return c}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(63)],e=function(a,b){var c=a.extend({get:function(a){return this.attributes=this.attributes||{},this.attributes[a]},set:function(a,b){if(this.attributes=this.attributes||{},this.attributes[a]!==b){var c=this.attributes[a];this.attributes[a]=b,this.trigger("change:"+a,this,b,c)}},clone:function(){return a.clone(this.attributes)}},b);return c}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(63),c(67),c(64),c(66),c(65),c(47)],e=function(a,b,c,d,e,f){var g=function(a,d){this.model=d,this._adModel=(new b).setup({id:d.get("id"),volume:d.get("volume"),fullscreen:d.get("fullscreen"),mute:d.get("mute")}),this._adModel.on("change:state",c,this);var e=a.getContainer();this.swf=e.querySelector("object")};return g.prototype=f.extend({init:function(){this.swf.on("instream:state",function(a){switch(a.newstate){case e.PLAYING:this._adModel.set("state",a.newstate);break;case e.PAUSED:this._adModel.set("state",a.newstate)}},this).on("instream:time",function(a){this._adModel.set("position",a.position),this._adModel.set("duration",a.duration),this.trigger(d.JWPLAYER_MEDIA_TIME,a)},this).on("instream:complete",function(a){this.trigger(d.JWPLAYER_MEDIA_COMPLETE,a)},this).on("instream:error",function(a){this.trigger(d.JWPLAYER_MEDIA_ERROR,a)},this),this.swf.triggerFlash("instream:init")},instreamDestroy:function(){this._adModel&&(this.off(),this.swf.off(null,null,this),this.swf.triggerFlash("instream:destroy"),this.swf=null,this._adModel.off(),this._adModel=null,this.model=null)},load:function(a){this.swf.triggerFlash("instream:load",a)},instreamPlay:function(){this.swf.triggerFlash("instream:play")},instreamPause:function(){this.swf.triggerFlash("instream:pause")}},a),g}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(89),c(63),c(47),c(66)],e=function(a,b,c,d){var e=function(b,e,f,g){function h(){m("Setup Timeout Error","Setup took longer than "+g+" seconds to complete.")}function i(){c.each(p,function(a){a.complete!==!0&&a.running!==!0&&null!==b&&k(a.depends)&&(a.running=!0,j(a))})}function j(a){var c=function(b){b=b||{},l(a,b)};a.method(c,e,b,f)}function k(a){return c.all(a,function(a){return p[a].complete})}function l(a,b){"error"===b.type?m(b.msg,b.reason):"complete"===b.type?(clearTimeout(n),o.trigger(d.JWPLAYER_READY)):(a.complete=!0,i())}function m(a,b){clearTimeout(n),o.trigger(d.JWPLAYER_SETUP_ERROR,{message:a+": "+b}),o.destroy()}var n,o=this,p=a.getQueue();g=g||10,this.start=function(){n=setTimeout(h,1e3*g),i()},this.destroy=function(){clearTimeout(n),this.off(),p.length=0,b=null,e=null,f=null}};return e.prototype=b,e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(90),c(71),c(47),c(45),c(92)],e=function(a,b,d,e,f){function g(a,b,c){if(b){var d=b.client;delete b.client,/\.(js|swf)$/.test(d||"")||(d=e.repo()+c),a[d]=b}}function h(a,c){var f=d.clone(c.get("plugins"))||{},h=c.get("edition"),i=b(h),j=/\.(js|swf)$/,k=e.repo(),l=c.get("advertising");i("ads")&&l&&(j.test(l.client)?f[l.client]=l:f[k+l.client+".js"]=l,delete l.client);var m=c.get("analytics");d.isObject(m)||(m={}),g(f,m,"jwpsrv.js"),g(f,c.get("ga"),"gapro.js"),g(f,c.get("sharing"),"sharing.js"),g(f,c.get("related"),"related.js"),c.set("plugins",f),a()}function i(b,c){var d=c.get("key")||window.jwplayer&&window.jwplayer.key,e=new a(d),g=e.edition();c.set("key",d),c.set("edition",g),c.updateProviders(),"invalid"===g?f.error(b,"Error setting up player",(void 0===d?"Missing":"Invalid")+" license key"):b()}function j(a,b){var d=b.get("dash");"dashjs"===d?c.e(3,function(d){var e=c(106);e.register(window.jwplayer),b.updateProviders(),a()}):d?c.e(4,function(d){var e=c(108);e.register(window.jwplayer),b.updateProviders(),a()}):a()}function k(){var a=f.getQueue();return a.LOAD_PLAYLIST.depends.push("LOAD_PROVIDERS"),a.LOAD_PROVIDERS={method:j,depends:[]},a.LOAD_PROVIDERS.depends.push("CHECK_KEY"),a.CHECK_KEY={method:i,depends:["LOAD_POLYFILLS"]},a.FILTER_PLUGINS={method:h,depends:["CHECK_KEY"]},a.LOAD_PLUGINS.depends.push("CHECK_KEY"),a.LOAD_PLUGINS.depends.push("FILTER_PLUGINS"),a}return{getQueue:k}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(91),c(71)],e=function(a,b,c){var d="invalid",e="RnXcsftYjWRDA^Uy",f=function(f){function g(f){a.exists(f)||(f="");try{f=b.decrypt(f,e);var g=f.split("/");h=g[0],"pro"===h&&(h="premium");var k=c(h);if(g.length>2&&k("setup")){i=g[1];var l=parseInt(g[2]);l>0&&(j=new Date,j.setTime(l))}else h=d}catch(m){h=d}}var h,i,j;this.edition=function(){return j&&j.getTime()<(new Date).getTime()?d:h},this.token=function(){return i},this.expiration=function(){return j},g(f)};return f}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){var a=function(a){return window.atob(a)},b=function(a){return unescape(encodeURIComponent(a))},c=function(a){try{return decodeURIComponent(escape(a))}catch(b){return a}},d=function(a){for(var b=new Array(Math.ceil(a.length/4)),c=0;c<b.length;c++)b[c]=a.charCodeAt(4*c)+(a.charCodeAt(4*c+1)<<8)+(a.charCodeAt(4*c+2)<<16)+(a.charCodeAt(4*c+3)<<24);return b},e=function(a){for(var b=new Array(a.length),c=0;c<a.length;c++)b[c]=String.fromCharCode(255&a[c],a[c]>>>8&255,a[c]>>>16&255,a[c]>>>24&255);return b.join("")};return{decrypt:function(f,g){if(f=String(f),g=String(g),0==f.length)return"";for(var h,i,j=d(a(f)),k=d(b(g).slice(0,16)),l=j.length,m=j[l-1],n=j[0],o=2654435769,p=Math.floor(6+52/l),q=p*o;0!=q;){i=q>>>2&3;for(var r=l-1;r>=0;r--)m=j[r>0?r-1:l-1],h=(m>>>5^n<<2)+(n>>>3^m<<4)^(q^n)+(k[3&r^i]^m),n=j[r]-=h;q-=o}var s=e(j);return s=s.replace(/\0+$/,""),c(s)}}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(93),c(99),c(96),c(57),c(47),c(45),c(66)],e=function(a,b,d,e,f,g,h){function i(){var a={LOAD_POLYFILLS:{method:j,depends:[]},LOAD_PLUGINS:{method:k,depends:["LOAD_POLYFILLS"]},LOAD_YOUTUBE:{method:u,depends:["LOAD_PLAYLIST"]},LOAD_SKIN:{method:t,depends:[]},LOAD_PLAYLIST:{method:o,depends:["LOAD_PLUGINS"]},SETUP_COMPONENTS:{method:v,depends:["LOAD_PLAYLIST","LOAD_SKIN","LOAD_YOUTUBE"]},SEND_READY:{method:w,depends:["LOAD_PLUGINS","SETUP_COMPONENTS"]}};return a}function j(a){window.btoa&&window.atob?a():c.e(1,function(b){c(104),a()})}function k(b,c,d){y=a.loadPlugins(c.get("id"),c.get("plugins")),y.on(h.COMPLETE,f.partial(l,b,c,d)),y.on(h.ERROR,f.partial(n,b)),y.load()}function l(a,b,c){y.setupPlugins(c,b,f.partial(m,c)),a()}function m(a,b,c,d){var e=a.id;return function(){var a=document.querySelector("#"+e+" .jw-overlays");a&&d&&a.appendChild(c),"function"==typeof b.resize&&(b.resize(a.clientWidth,a.clientHeight),setTimeout(function(){b.resize(a.clientWidth,a.clientHeight)},400)),a&&a.style&&(c.left=a.style.left,c.top=a.style.top)}}function n(a,b){x(a,"Could not load plugin",b.message)}function o(a,c){var d=c.get("playlist");f.isString(d)?(z=new b,z.on(h.JWPLAYER_PLAYLIST_LOADED,function(b){p(a,c,b.playlist)}),z.on(h.JWPLAYER_ERROR,f.partial(q,a)),z.load(d)):p(a,c,d)}function p(a,b,c){b.setPlaylist(c);var d=b.get("playlist");return f.isArray(d)&&0!==d.length?void a():void q(a,"Playlist type not supported")}function q(a,b){b&&b.message?x(a,"Error loading playlist",b.message):x(a,"Error loading player","No playable sources found")}function r(a,b){return f.contains(e.SkinsLoadable,a)?b+"skins/"+a+".css":void 0}function s(a){for(var b=document.styleSheets,c=0,d=b.length;d>c;c++)if(b[c].href===a)return!0;return!1}function t(a,b){var c=b.get("skin"),g=b.get("skinUrl");if(f.contains(e.SkinsIncluded,c))return void a();if(g||(g=r(c,b.get("base"))),f.isString(g)&&!s(g)){b.set("skin-loading",!0);var i=!0,j=new d(g,i);j.addEventListener(h.COMPLETE,function(){b.set("skin-loading",!1)}),j.addEventListener(h.ERROR,function(){console.log("The given skin failed to load : ",g),b.set("skin","seven"),b.set("skin-loading",!1)}),j.load()}f.defer(function(){a()})}function u(a,b){var d=b.get("playlist"),e=f.some(d,function(a){return g.isYouTube(a.file,a.type)});e?c.e(2,function(b){var d=c(105);d.register(window.jwplayer),a()}):a()}function v(a,b,c,d){b.setItem(0),d.setup(),a()}function w(a){a({type:"complete"})}function x(a,b,c){a({type:"error",msg:b,reason:c})}var y,z;return{getQueue:i,error:x}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(94),c(97),c(98),c(95)],e=function(a,b,c,d){var e={},f={},g=function(c,d){return f[c]=new a(new b(e),d),f[c]},h=function(a,b,f,g){var h=d.getPluginName(a);e[h]||(e[h]=new c(a)),e[h].registerPlugin(a,b,f,g)};return{loadPlugins:g,registerPlugin:h}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(95),c(45),c(66),c(63),c(47),c(96)],e=function(a,b,c,d,e,f){var g=function(g,h){function i(){o||(o=!0,n=f.loaderstatus.COMPLETE,m.trigger(c.COMPLETE))}function j(){if(!q&&(h&&0!==e.keys(h).length||i(),!o)){var d=g.getPlugins();l=e.after(p,i),e.each(h,function(e,g){var h=a.getPluginName(g),i=d[h],j=i.getJS(),k=i.getTarget(),n=i.getStatus();n!==f.loaderstatus.LOADING&&n!==f.loaderstatus.NEW&&(j&&!b.versionCheck(k)&&m.trigger(c.ERROR,{message:"Incompatible player version"}),l())})}}function k(a){if(!q){var d="File not found";a.url&&b.log(d,a.url),this.off(),this.trigger(c.ERROR,{message:d}),j()}}var l,m=e.extend(this,d),n=f.loaderstatus.NEW,o=!1,p=e.size(h),q=!1;this.setupPlugins=function(c,d,f){var h=[],i={},j=g.getPlugins(),k=d.get("plugins");e.each(k,function(d,g){var l=a.getPluginName(g),m=j[l],n=m.getFlashPath(),o=m.getJS(),p=m.getURL();if(n){var q=e.extend({name:l,swf:n,pluginmode:m.getPluginmode()},d);h.push(q)}var r=b.tryCatch(function(){if(o&&k[p]){var a=document.createElement("div");a.id=c.id+"_"+l,a.className="jw-plugin jw-reset",i[l]=m.getNewInstance(c,e.extend({},k[p]),a),c.onReady(f(i[l],a,!0)),c.onResize(f(i[l],a))}});r instanceof b.Error&&b.log("ERROR: Failed to load "+l+".")}),c.plugins=i,d.set("flashPlugins",h)},this.load=function(){if(b.exists(h)&&"object"!==b.typeOf(h))return void j();n=f.loaderstatus.LOADING,e.each(h,function(a,d){if(b.exists(d)){var e=g.addPlugin(d);e.on(c.COMPLETE,j),e.on(c.ERROR,k)}});var a=g.getPlugins();e.each(a,function(a){a.load()}),j()},this.destroy=function(){q=!0,this.off()},this.getStatus=function(){return n}};return g}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(50)],e=function(a){var b={},c=b.pluginPathType={ABSOLUTE:0,RELATIVE:1,CDN:2};return b.getPluginPathType=function(b){if("string"==typeof b){b=b.split("?")[0];var d=b.indexOf("://");if(d>0)return c.ABSOLUTE;var e=b.indexOf("/"),f=a.extension(b);return!(0>d&&0>e)||f&&isNaN(f)?c.RELATIVE:c.CDN}},b.getPluginName=function(a){return a.replace(/^(.*\/)?([^-]*)-?.*\.(swf|js)$/,"$2")},b.getPluginVersion=function(a){return a.replace(/[^-]*-?([^\.]*).*$/,"$1")},b}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(66),c(63),c(47)],e=function(a,b,c){var d={},e={NEW:0,LOADING:1,ERROR:2,COMPLETE:3},f=function(f,g){function h(b){k=e.ERROR,j.trigger(a.ERROR,b)}function i(b){k=e.COMPLETE,j.trigger(a.COMPLETE,b)}var j=c.extend(this,b),k=e.NEW;this.addEventListener=this.on,this.removeEventListener=this.off,this.makeStyleLink=function(a){var b=document.createElement("link");return b.type="text/css",b.rel="stylesheet",b.href=a,b},this.makeScriptTag=function(a){var b=document.createElement("script");return b.src=a,b},this.makeTag=g?this.makeStyleLink:this.makeScriptTag,this.load=function(){if(k===e.NEW){var b=d[f];if(b&&(k=b.getStatus(),2>k))return b.on(a.ERROR,h),void b.on(a.COMPLETE,i);var c=document.getElementsByTagName("head")[0]||document.documentElement,j=this.makeTag(f),l=!1;j.onload=j.onreadystatechange=function(a){l||this.readyState&&"loaded"!==this.readyState&&"complete"!==this.readyState||(l=!0,i(a),j.onload=j.onreadystatechange=null,c&&j.parentNode&&!g&&c.removeChild(j))},j.onerror=h,c.insertBefore(j,c.firstChild),k=e.LOADING,d[f]=this}},this.getStatus=function(){return k}};return f.loaderstatus=e,f}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(95),c(98)],e=function(a,b){var c=function(c){this.addPlugin=function(d){var e=a.getPluginName(d);return c[e]||(c[e]=new b(d)),c[e]},this.getPlugins=function(){return c}};return c}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(95),c(66),c(63),c(96),c(47)],e=function(a,b,c,d,e,f){var g={FLASH:0,JAVASCRIPT:1,HYBRID:2},h=function(h){function i(){switch(b.getPluginPathType(h)){case b.pluginPathType.ABSOLUTE:return h;case b.pluginPathType.RELATIVE:return a.getAbsolutePath(h,window.location.href)}}function j(){f.defer(function(){q=e.loaderstatus.COMPLETE,p.trigger(c.COMPLETE)})}function k(){q=e.loaderstatus.ERROR,p.trigger(c.ERROR,{url:h})}var l,m,n,o,p=f.extend(this,d),q=e.loaderstatus.NEW;this.load=function(){if(q===e.loaderstatus.NEW){if(h.lastIndexOf(".swf")>0)return l=h,q=e.loaderstatus.COMPLETE,void p.trigger(c.COMPLETE);if(b.getPluginPathType(h)===b.pluginPathType.CDN)return q=e.loaderstatus.COMPLETE,void p.trigger(c.COMPLETE);q=e.loaderstatus.LOADING;var a=new e(i());a.on(c.COMPLETE,j),a.on(c.ERROR,k),a.load()}},this.registerPlugin=function(a,b,d,f){o&&(clearTimeout(o),o=void 0),n=b,d&&f?(l=f,m=d):"string"==typeof d?l=d:"function"==typeof d?m=d:d||f||(l=a),q=e.loaderstatus.COMPLETE,p.trigger(c.COMPLETE)},this.getStatus=function(){return q},this.getPluginName=function(){return b.getPluginName(h)},this.getFlashPath=function(){if(l)switch(b.getPluginPathType(l)){case b.pluginPathType.ABSOLUTE:return l;case b.pluginPathType.RELATIVE:return h.lastIndexOf(".swf")>0?a.getAbsolutePath(l,window.location.href):a.getAbsolutePath(l,i())}return null},this.getJS=function(){return m},this.getTarget=function(){return n},this.getPluginmode=function(){return void 0!==typeof l&&void 0!==typeof m?g.HYBRID:void 0!==typeof l?g.FLASH:void 0!==typeof m?g.JAVASCRIPT:void 0},this.getNewInstance=function(a,b,c){return new m(a,b,c)},this.getURL=function(){return h}};return h}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(100),c(101),c(45),c(66),c(63),c(47)],e=function(a,b,c,d,e,f){var g=function(){function g(e){var f=c.tryCatch(function(){for(var c=e.responseXML.childNodes,f="",g=0;g<c.length&&(f=c[g],8===f.nodeType);g++);if("xml"===a.localName(f)&&(f=f.nextSibling),"rss"!==a.localName(f))return void i("Not a valid RSS feed");var h=b.parse(f);k.trigger(d.JWPLAYER_PLAYLIST_LOADED,{playlist:h})});f instanceof c.Error&&i()}function h(a){i(a.match(/invalid/i)?"Not a valid RSS feed":"")}function i(a){k.trigger(d.JWPLAYER_ERROR,{message:a?a:"Error loading file"})}var j,k=f.extend(this,e);this.load=function(a){j=c.ajax(a,g,h)},this.destroy=function(){this.off(),j=null}};return g}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(50)],e=function(a){return{localName:function(a){return a?a.localName?a.localName:a.baseName?a.baseName:"":""},textContent:function(b){return b?b.textContent?a.trim(b.textContent):b.text?a.trim(b.text):"":""},getChildNode:function(a,b){return a.childNodes[b]},numChildren:function(a){return a.childNodes?a.childNodes.length:0}}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(50),c(100),c(102),c(103),c(83)],e=function(a,b,c,d,e){function f(b){for(var f={},h=0;h<b.childNodes.length;h++){var i=b.childNodes[h],k=j(i);if(k)switch(k.toLowerCase()){case"enclosure":f.file=a.xmlAttribute(i,"url");break;case"title":f.title=g(i);break;case"guid":f.mediaid=g(i);break;case"pubdate":f.date=g(i);break;case"description":f.description=g(i);break;case"link":f.link=g(i);break;case"category":f.tags?f.tags+=g(i):f.tags=g(i)}}return f=d(b,f),f=c(b,f),new e(f)}var g=b.textContent,h=b.getChildNode,i=b.numChildren,j=b.localName,k={};return k.parse=function(a){for(var b=[],c=0;c<i(a);c++){var d=h(a,c),e=j(d).toLowerCase();if("channel"===e)for(var g=0;g<i(d);g++){var k=h(d,g);"item"===j(k).toLowerCase()&&b.push(f(k))}}return b},k}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(100),c(50),c(45)],e=function(a,b,c){var d="jwplayer",e=function(e,f){for(var g=[],h=[],i=b.xmlAttribute,j="default",k="label",l="file",m="type",n=0;n<e.childNodes.length;n++){var o=e.childNodes[n];if(o.prefix===d){var p=a.localName(o);"source"===p?(delete f.sources,g.push({file:i(o,l),"default":i(o,j),label:i(o,k),type:i(o,m)})):"track"===p?(delete f.tracks,h.push({file:i(o,l),"default":i(o,j),kind:i(o,"kind"),label:i(o,k)})):(f[p]=c.serialize(a.textContent(o)),"file"===p&&f.sources&&delete f.sources)}f[l]||(f[l]=f.link)}if(g.length)for(f.sources=[],n=0;n<g.length;n++)g[n].file.length>0&&(g[n][j]="true"===g[n][j]?!0:!1,g[n].label.length||delete g[n].label,f.sources.push(g[n]));if(h.length)for(f.tracks=[],n=0;n<h.length;n++)h[n].file.length>0&&(h[n][j]="true"===h[n][j]?!0:!1,h[n].kind=h[n].kind.length?h[n].kind:"captions",h[n].label.length||delete h[n].label,f.tracks.push(h[n]));return f};return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(100),c(50),c(45)],e=function(a,b,c){var d=b.xmlAttribute,e=a.localName,f=a.textContent,g=a.numChildren,h="media",i=function(a,b){function j(a){var b={zh:"Chinese",nl:"Dutch",en:"English",fr:"French",de:"German",it:"Italian",ja:"Japanese",pt:"Portuguese",ru:"Russian",es:"Spanish"};return b[a]?b[a]:a}var k,l,m="tracks",n=[];for(l=0;l<g(a);l++)if(k=a.childNodes[l],k.prefix===h){if(!e(k))continue;switch(e(k).toLowerCase()){case"content":d(k,"duration")&&(b.duration=c.seconds(d(k,"duration"))),g(k)>0&&(b=i(k,b)),d(k,"url")&&(b.sources||(b.sources=[]),b.sources.push({file:d(k,"url"),type:d(k,"type"),width:d(k,"width"),label:d(k,"label")}));break;case"title":b.title=f(k);break;case"description":b.description=f(k);break;case"guid":b.mediaid=f(k);break;case"thumbnail":b.image||(b.image=d(k,"url"));break;case"player":break;case"group":i(k,b);break;case"subtitle":var o={};o.file=d(k,"url"),o.kind="captions",d(k,"lang").length>0&&(o.label=j(d(k,"lang"))),n.push(o)}}for(b.hasOwnProperty(m)||(b[m]=[]),l=0;l<n.length;l++)b[m].push(n[l]);return b};return i}.apply(b,d),!(void 0!==e&&(a.exports=e))},,,,,,,function(a,b,c){var d,e;d=[c(100),c(111),c(112),c(45)],e=function(a,b,c,d){var e=function(e,f){function g(a){d.log("CAPTIONS("+a+")")}function h(a,b){q=[],r={},s={},t=0;var c,d,e,f=b.tracks;for(e=0;e<f.length;e++)c=f[e],d=c.kind.toLowerCase(),("captions"===d||"subtitles"===d)&&(c.file?(j(c),k(c)):c.data&&j(c));var g=o();this.setCaptionsList(g),p()}function i(a,b){return 0===b?void n(a,null):void n(a,q[b-1])}function j(a){"number"!=typeof a.id&&(a.id=a.name||a.file||"cc"+q.length),a.data=a.data||[],a.label||(a.label="Unknown CC",t++,t>1&&(a.label+=" ("+t+")")),q.push(a),r[a.id]=a}function k(a){d.ajax(a.file,function(b){l(b,a)},m,!0)}function l(e,f){var h,i=e.responseXML?e.responseXML.firstChild:null;if(i)for("xml"===a.localName(i)&&(i=i.nextSibling);i.nodeType===i.COMMENT_NODE;)i=i.nextSibling;h=i&&"tt"===a.localName(i)?d.tryCatch(function(){f.data=c(e.responseXML)}):d.tryCatch(function(){f.data=b(e.responseText)}),h instanceof d.Error&&g(h.message+": "+f.file)}function m(a){g(a)}function n(a,b){a.set("captionsTrack",b),b?a.set("captionLabel",b.label):a.set("captionLabel","Off")}function o(){for(var a=[{id:"off",label:"Off"}],b=0;b<q.length;b++)a.push({id:q[b].id,label:q[b].label});return a}function p(){for(var a=0,b=f.get("captionLabel"),c=0;c<q.length;c++){var d=q[c];if(b&&b===d.label){a=c+1;break}d["default"]||d.defaulttrack?a=c+1:d.autoselect}f.set("captionsIndex",a)}f.on("change:playlistItem",h,this),f.on("change:captionsIndex",i,this),f.mediaController.on("subtitlesTracks",function(a){if(a.tracks.length){f.mediaController.off("meta"),q=[],r={},s={},t=0;for(var b=a.tracks||[],c=0;c<b.length;c++){var d=b[c];d.id=d.name,d.label=d.name||d.language,j(d)}var e=o();this.setCaptionsList(e),p()}},this),f.mediaController.on("subtitlesTrackData",function(a){var b=r[a.name];if(b){for(var c=a.captions||[],d=!1,e=0;e<c.length;e++){var f=c[e],g=a.name+"_"+f.begin+"_"+f.end;s[g]||(s[g]=f,b.data.push(f),d=!0)}d&&b.data.sort(function(a,b){return a.begin-b.begin})}},this),f.mediaController.on("meta",function(a){var b=a.metadata;if(b&&"textdata"===b.type){var c=r[b.trackid];if(!c){c={kind:"captions",id:b.trackid,data:[]},j(c);var d=o();this.setCaptionsList(d)}var e=a.position||f.get("position"),g=""+Math.round(10*e)+"_"+b.text,h=s[g];h||(h={begin:e,text:b.text},s[g]=h,c.data.push(h))}},this);var q=[],r={},s={},t=0;this.getCurrentIndex=function(){return f.get("captionsIndex")},this.getCaptionsList=function(){return f.get("captionsList")},this.setCurrentIndex=function(a){e.setCurrentCaptions(a)},this.setCaptionsList=function(a){f.set("captionsList",a)}};return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(50)],e=function(a,b){function c(a){var b={},c=a.split("\r\n");1===c.length&&(c=a.split("\n"));var e=1;if(c[0].indexOf(" --> ")>0&&(e=0),c.length>e+1&&c[e+1]){var f=c[e],g=f.indexOf(" --> ");g>0&&(b.begin=d(f.substr(0,g)),b.end=d(f.substr(g+5)),b.text=c.slice(e+1).join("<br/>"))}return b}var d=a.seconds;return function(a){var d=[];a=b.trim(a);var e=a.split("\r\n\r\n");1===e.length&&(e=a.split("\n\n"));for(var f=0;f<e.length;f++)if("WEBVTT"!==e[f]){var g=c(e[f]);g.text&&d.push(g)}if(!d.length)throw new Error("Invalid SRT file");return d}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(50)],e=function(a){function b(a){a||c()}function c(){throw new Error("Invalid DFXP file")}var d=a.seconds;return function(e){b(e);var f=[],g=e.getElementsByTagName("p");b(g),g.length||(g=e.getElementsByTagName("tt:p"),g.length||(g=e.getElementsByTagName("tts:p")));for(var h=0;h<g.length;h++){var i=g[h],j=i.innerHTML||i.textContent||i.text||"",k=a.trim(j).replace(/>\s+</g,"><").replace(/tts?:/g,"");if(k){var l=i.getAttribute("begin"),m=i.getAttribute("dur"),n=i.getAttribute("end"),o={begin:d(l),text:k};n?o.end=d(n):m&&(o.end=o.begin+d(m)),f.push(o)}}return f.length||c(),f}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){return function(a,b){a.getPlaylistIndex=a.getItem;var c={jwPlay:b.play,jwPause:b.pause,jwSetMute:b.setMute,jwLoad:b.load,jwPlaylistItem:b.item,jwGetAudioTracks:b.getAudioTracks,jwDetachMedia:b.detachMedia,jwAttachMedia:b.attachMedia,jwAddEventListener:b.on,jwRemoveEventListener:b.off,jwStop:b.stop,jwSeek:b.seek,jwSetVolume:b.setVolume,jwPlaylistNext:b.next,jwPlaylistPrev:b.prev,jwSetFullscreen:b.setFullscreen,jwGetQualityLevels:b.getQualityLevels,jwGetCurrentQuality:b.getCurrentQuality,jwSetCurrentQuality:b.setCurrentQuality,jwSetCurrentAudioTrack:b.setCurrentAudioTrack,jwGetCurrentAudioTrack:b.getCurrentAudioTrack,jwGetCaptionsList:b.getCaptionsList,jwGetCurrentCaptions:b.getCurrentCaptions,jwSetCurrentCaptions:b.setCurrentCaptions,jwSetCues:b.setCues};a.callInternal=function(a){console.log("You are using the deprecated callInternal method for "+a);var d=Array.prototype.slice.call(arguments,1);c[a].apply(b,d)}}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(115),c(66),c(152)],e=function(a,b,c){var d=function(d,e){var f=new a(d,e),g=f.setup;return f.setup=function(){if(g.call(this),"trial"===e.get("edition")){var a=document.createElement("div");a.className="jw-icon jw-rightclick-logo jw-watermark",this.element().appendChild(a)}e.on("change:skipButton",this.onSkipButton,this),e.on("change:castActive change:playlistItem",this.showDisplayIconImage,this)},f.showDisplayIconImage=function(a){var b=a.get("castActive"),c=a.get("playlistItem"),d=f.controlsContainer().getElementsByClassName("jw-display-icon-container")[0];b?(d.style.backgroundImage="url("+c.image+")",d.style.backgroundSize="contain"):(d.style.backgroundImage="",d.style.backgroundSize="")},f.onSkipButton=function(a,b){b?this.addSkipButton():this._skipButton&&(this._skipButton.destroy(),this._skipButton=null)},f.addSkipButton=function(){this._skipButton=new c(this.instreamModel),this._skipButton.on(b.JWPLAYER_AD_SKIPPED,function(){this.api.skipAd()},this),this.controlsContainer().appendChild(this._skipButton.element())},f};return d}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(66),c(63),c(65),c(126),c(127),c(128),c(130),c(116),c(132),c(146),c(147),c(150),c(47),c(151)],e=function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o){var p=a.style,q=a.bounds,r=a.isMobile(),s=["fullscreenchange","webkitfullscreenchange","mozfullscreenchange","MSFullscreenChange"],t=function(t,u){function v(b){var c=a.between(u.get("position")+b,0,u.get("duration"));t.seek(c)}function w(b){var c=a.between(u.get("volume")+b,0,100);t.setVolume(c)}function x(a){return a.ctrlKey||a.metaKey?!1:u.get("controls")?!0:!1}function y(a){if(!x(a))return!0;switch(Ha||aa(),a.keyCode){case 27:t.setFullscreen(!1);break;case 13:case 32:t.play();break;case 37:Ha||v(-5);break;case 39:Ha||v(5);break;case 38:w(10);break;case 40:w(-10);break;case 77:t.setMute();break;case 70:t.setFullscreen();break;default:if(a.keyCode>=48&&a.keyCode<=59){var b=a.keyCode-48,c=b/10*u.get("duration");t.seek(c)}}return/13|32|37|38|39|40/.test(a.keyCode)?(a.preventDefault(),!1):void 0}function z(){Ma=!0,Na.trigger(b.JWPLAYER_VIEW_TAB_FOCUS,{hasFocus:!1})}function A(){var a=!Ma;Ma=!1,a&&Na.trigger(b.JWPLAYER_VIEW_TAB_FOCUS,{hasFocus:!0}),Ha||aa()}function B(){Ma=!1,Na.trigger(b.JWPLAYER_VIEW_TAB_FOCUS,{hasFocus:!1})}function C(){var a=q(ia),c=Math.round(a.width),d=Math.round(a.height);return document.body.contains(ia)?c&&d&&(c!==ma||d!==na)&&(ma=c,na=d,clearTimeout(Ka),Ka=setTimeout(W,50),u.set("containerWidth",c),
u.set("containerHeight",d),Na.trigger(b.JWPLAYER_RESIZE,{width:c,height:d})):(window.removeEventListener("resize",C),r&&window.removeEventListener("orientationchange",C)),a}function D(b,c){c=c||!1,a.toggleClass(ia,"jw-flag-casting",c)}function E(b,c){a.toggleClass(ia,"jw-flag-cast-available",c),a.toggleClass(ja,"jw-flag-cast-available",c)}function F(b,c,d){d&&a.removeClass(ia,"jw-stretch-"+d),a.addClass(ia,"jw-stretch-"+c)}function G(b,c){a.toggleClass(ia,"jw-flag-compact-player",c)}function H(a){a&&!r&&(a.element().addEventListener("mousemove",K,!1),a.element().addEventListener("mouseout",L,!1))}function I(){u.get("state")!==d.IDLE&&u.get("state")!==d.COMPLETE||!u.get("controls")||t.play(),Ja?_():aa()}function J(a){a.link?(t.pause(!0),t.setFullscreen(!1),window.open(a.link,a.linktarget)):t.play()}function K(){clearTimeout(Ea)}function L(){aa()}function M(a){Na.trigger(a.type,a)}function N(b,c){c?(za&&za.destroy(),a.addClass(ia,"jw-flag-flash-blocked")):(za&&za.setup(u,ia,ia),a.removeClass(ia,"jw-flag-flash-blocked"))}function O(){u.get("controls")&&t.setFullscreen()}function P(){ra=new f(u,ka),ra.on("click",function(){M({type:b.JWPLAYER_DISPLAY_CLICK}),u.get("controls")&&t.play()}),ra.on("tap",function(){M({type:b.JWPLAYER_DISPLAY_CLICK}),I()}),ra.on("doubleClick",O);var c=new g(u);c.on("click",function(){M({type:b.JWPLAYER_DISPLAY_CLICK}),t.play()}),c.on("tap",function(){M({type:b.JWPLAYER_DISPLAY_CLICK}),I()}),ja.appendChild(c.element()),ta=new h(u),ua=new i(u),ua.on(b.JWPLAYER_LOGO_CLICK,J);var d=document.createElement("div");d.className="jw-controls-right jw-reset",u.get("logo")&&d.appendChild(ua.element()),d.appendChild(ta.element()),ja.appendChild(d),wa=new e(u),wa.setup(u.get("captions")),ja.parentNode.insertBefore(wa.element(),va.element());var k=u.get("height");r&&("string"==typeof k||k>=1.5*Ga)?a.addClass(ia,"jw-flag-touch"):(za=new l,za.setup(u,ia,ia)),pa=new j(t,u),pa.on(b.JWPLAYER_USER_ACTION,aa),u.on("change:scrubbing",R),u.on("change:compactUI",G),ja.appendChild(pa.element()),ia.onfocusin=A,ia.onfocusout=B,ia.addEventListener("focus",A),ia.addEventListener("blur",B),ia.addEventListener("keydown",y),ia.onmousedown=z}function Q(b){return b.get("state")===d.PAUSED?void b.once("change:state",Q):void(b.get("scrubbing")===!1&&a.removeClass(ia,"jw-flag-dragging"))}function R(b,c){b.off("change:state",Q),c?a.addClass(ia,"jw-flag-dragging"):Q(b)}function S(b,c,d){var e,f=ia.className;d=!!d,d&&(f=f.replace(/\s*aspectMode/,""),ia.className!==f&&(ia.className=f),a.style(ia,{display:"block"},d)),a.exists(b)&&a.exists(c)&&(u.set("width",b),u.set("height",c)),e={width:b},a.hasClass(ia,"jw-flag-aspect-mode")||(e.height=c),p(ia,e,!0),ua&&ua.offset(pa&&ua.position().indexOf("bottom")>=0?pa.element().clientHeight:0),T(c),W(b,c)}function T(b){if(xa=U(b),pa&&!xa){var c=Ha?oa:u;ha(c.get("state"))}a.toggleClass(ia,"jw-flag-audio-player",xa)}function U(a){if(u.get("aspectratio"))return!1;if(n.isString(a)&&a.indexOf("%")>-1)return!1;var b=n.isNumber(a)?a:u.get("containerHeight");return V(b)}function V(a){return a&&Ga*(r?1.75:1)>=a}function W(b,c){if(!b||isNaN(Number(b))){if(!ka)return;b=ka.clientWidth}if(!c||isNaN(Number(c))){if(!ka)return;c=ka.clientHeight}a.isMSIE(9)&&document.all&&!window.atob&&(b=c="100%");var d=u.getVideo();if(d){var e=d.resize(b,c,u.get("stretching"));e&&(clearTimeout(Ka),Ka=setTimeout(W,250)),wa.resize(),pa.checkCompactMode(b)}}function X(){if(La){var a=document.fullscreenElement||document.webkitCurrentFullScreenElement||document.mozFullScreenElement||document.msFullscreenElement;return!(!a||a.id!==u.get("id"))}return Ha?oa.getVideo().getFullScreen():u.getVideo().getFullScreen()}function Y(a){var b=void 0!==a.jwstate?a.jwstate:X();La?Z(ia,b):$(b)}function Z(b,c){a.removeClass(b,"jw-flag-fullscreen"),c?(a.addClass(b,"jw-flag-fullscreen"),p(document.body,{"overflow-y":"hidden"}),aa()):p(document.body,{"overflow-y":""}),W(),$(c)}function $(a){u.setFullscreen(a),oa&&oa.setFullscreen(a),a&&(clearTimeout(Ka),Ka=setTimeout(W,200))}function _(){Ja=!1,clearTimeout(Ea),pa.hideComponents(),a.addClass(ia,"jw-flag-user-inactive")}function aa(){Ja||(a.removeClass(ia,"jw-flag-user-inactive"),pa.checkCompactMode(ka.clientWidth)),Ja=!0,clearTimeout(Ea),Ea=setTimeout(_,Fa)}function ba(){ya=!0,Ra(!1)}function ca(){sa&&sa.setState(u.get("state")),u.mediaModel.on("change:mediaType",function(b,c){var d="audio"===c;a.toggleClass(ia,"jw-flag-media-audio",d)})}function da(b,c){var d="LIVE"===a.adaptiveType(c);a.toggleClass(ia,"jw-flag-live",d),Na.setAltText(d?"Live Broadcast":"")}function ea(a,b){ya=!1,ha(b)}function fa(a){ea(u,d.ERROR),va.updateText(u,{title:a.message})}function ga(){var a=u.getVideo();return a?a.isCaster:!1}function ha(b){if(a.removeClass(ia,"jw-state-"+Aa),a.addClass(ia,"jw-state-"+b),Aa=b,ga())return void a.addClass(ka,"jw-media-show");switch(b){case d.PLAYING:W();break;case d.PAUSED:aa()}}var ia,ja,ka,la,ma,na,oa,pa,qa,ra,sa,ta,ua,va,wa,xa,ya,za,Aa,Ba,Ca,Da,Ea=-1,Fa=r?4e3:2e3,Ga=40,Ha=!1,Ia=!1,Ja=!1,Ka=-1,La=!1,Ma=!1,Na=n.extend(this,c);this.model=u,this.api=t,ia=a.createElement(o({id:u.get("id")}));var Oa=u.get("width"),Pa=u.get("height");p(ia,{width:Oa.toString().indexOf("%")>0?Oa:Oa+"px",height:Pa.toString().indexOf("%")>0?Pa:Pa+"px"}),Ca=ia.requestFullscreen||ia.webkitRequestFullscreen||ia.webkitRequestFullScreen||ia.mozRequestFullScreen||ia.msRequestFullscreen,Da=document.exitFullscreen||document.webkitExitFullscreen||document.webkitCancelFullScreen||document.mozCancelFullScreen||document.msExitFullscreen,La=Ca&&Da,this.onChangeSkin=function(b,c,d){d&&a.removeClass(ia,"jw-skin-"+d),c&&a.addClass(ia,"jw-skin-"+c)},this.handleColorOverrides=function(){function b(b,d,e){if(e){b=a.prefix(b,"#"+c+" ");var f={};f[d]=e,a.css(b.join(", "),f)}}var c=u.get("id"),d=u.get("skinColorActive"),e=u.get("skinColorInactive"),f=u.get("skinColorBackground");b([".jw-toggle",".jw-button-color:hover"],"color",d),b([".jw-active-option",".jw-progress",".jw-playlist-container .jw-option.jw-active-option",".jw-playlist-container .jw-option:hover"],"background",d),b([".jw-text",".jw-option",".jw-button-color",".jw-toggle.jw-off",".jw-tooltip-title",".jw-skip .jw-skip-icon",".jw-playlist-container .jw-icon"],"color",e),b([".jw-cue",".jw-knob"],"background",e),b([".jw-playlist-container .jw-option"],"border-bottom-color",e),b([".jw-background-color",".jw-tooltip-title",".jw-playlist",".jw-playlist-container .jw-option"],"background",f),b([".jw-playlist-container ::-webkit-scrollbar"],"border-color",f)},this.setup=function(){if(!Ia){this.handleColorOverrides(),u.get("skin-loading")===!0&&(a.addClass(ia,"jw-flag-skin-loading"),u.once("change:skin-loading",function(){a.removeClass(ia,"jw-flag-skin-loading")})),this.onChangeSkin(u,u.get("skin"),""),u.on("change:skin",this.onChangeSkin,this),ka=ia.getElementsByClassName("jw-media")[0],ja=ia.getElementsByClassName("jw-controls")[0],la=ia.getElementsByClassName("jw-aspect")[0];var c=ia.getElementsByClassName("jw-preview")[0];qa=new k(u),qa.setup(c);var e=ia.getElementsByClassName("jw-title")[0];va=new m(u),va.setup(e),P(),aa(),u.getVideo().setContainer(ka),u.mediaController.on("fullscreenchange",Y);for(var f=s.length;f--;)document.addEventListener(s[f],Y,!1);window.removeEventListener("resize",C),window.addEventListener("resize",C,!1),r&&(window.removeEventListener("orientationchange",C),window.addEventListener("orientationchange",C,!1)),u.on("change:controls",Qa),Qa(u,u.get("controls")),u.on("change:state",ea),u.on("change:duration",da,this),u.on("change:flashBlocked",N),N(u,u.get("flashBlocked")),u.mediaController.on(b.JWPLAYER_MEDIA_ERROR,fa),t.onPlaylistComplete(ba),t.onPlaylistItem(ca),u.on("change:castAvailable",E),E(u,u.get("castAvailable")),u.on("change:castActive",D),D(u,u.get("castActive")),u.get("stretching")&&F(u,u.get("stretching")),u.on("change:stretching",F),ea(null,d.IDLE),r||(ra.element().addEventListener("mouseout",aa,!1),ra.element().addEventListener("mousemove",aa,!1)),H(pa),H(ua),u.get("aspectratio")&&(a.addClass(ia,"jw-flag-aspect-mode"),a.style(la,{"padding-top":u.get("aspectratio")})),setTimeout(function(){C(),S(u.get("width"),u.get("height"))},0)}};var Qa=function(b,c){if(c){var d=Ha?oa.get("state"):u.get("state");ea(b,d)}c?a.removeClass(ia,"jw-flag-controls-disabled"):a.addClass(ia,"jw-flag-controls-disabled"),b.getVideo().setControls(c)},Ra=this.fullscreen=function(b){if(a.exists(b)||(b=!u.get("fullscreen")),b=!!b,b!==u.get("fullscreen")){var c=u.getVideo();La?(b?Ca.apply(ia):Da.apply(document),Z(ia,b)):a.isIE()?Z(ia,b):(oa&&oa.getVideo()&&oa.getVideo().setFullscreen(b),c.setFullscreen(b)),c&&0===c.getName().name.indexOf("flash")&&c.setFullscreen(b)}};this.resize=function(a,b){var c=!0;S(a,b,c),C()},this.resizeMedia=W,this.reset=function(){document.contains(ia)&&ia.parentNode.replaceChild(Ba,ia),a.emptyElement(ia)},this.setupInstream=function(b){this.instreamModel=oa=b,oa.on("change:controls",Qa,this),oa.on("change:state",ea,this),Ha=!0,a.addClass(ia,"jw-flag-ads"),aa()},this.setAltText=function(a){pa.setAltText(a)},this.useExternalControls=function(){a.addClass(ia,"jw-flag-ads-hide-controls")},this.destroyInstream=function(){if(Ha=!1,oa&&(oa.off(null,null,this),oa=null),this.setAltText(""),a.removeClass(ia,"jw-flag-ads"),a.removeClass(ia,"jw-flag-ads-hide-controls"),u.getVideo){var b=u.getVideo();b.setContainer(ka)}da(u,u.get("duration")),ra.revertAlternateClickHandlers()},this.addCues=function(a){pa&&pa.addCues(a)},this.clickHandler=function(){return ra},this.controlsContainer=function(){return ja},this.getContainer=this.element=function(){return ia},this.getSafeRegion=function(b){var c={x:0,y:0,width:u.get("containerWidth")||0,height:u.get("containerHeight")||0},d=u.get("dock");return d&&d.length&&u.get("controls")&&(c.y=ta.element().clientHeight,c.height-=c.y),b=b||!a.exists(b),b&&u.get("controls")&&(c.height-=pa.element().clientHeight),c},this.destroy=function(){window.removeEventListener("resize",C),window.removeEventListener("orientationchange",C);for(var b=s.length;b--;)document.removeEventListener(s[b],Y,!1);u.mediaController&&u.mediaController.off("fullscreenchange",Y),ia.removeEventListener("keydown",y,!1),za&&za.destroy(),sa&&(u.off("change:state",sa.statusDelegate),sa.destroy(),sa=null),ja&&(ra.element().removeEventListener("mousemove",aa),ra.element().removeEventListener("mouseout",aa)),Ha&&this.destroyInstream(),a.clearCss("#"+u.get("id"))}};return t}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(117),c(45),c(66),c(47),c(63),c(118)],e=function(a,b,c,d,e,f){var g=b.style,h={linktarget:"_blank",margin:8,hide:!1,position:"top-right"},i=function(i){function j(){n=d.extend({},h,p),n.hide="true"===n.hide.toString(),k()}function k(){if(m=b.createElement(f({file:n.file})),n.file){if(n.hide&&b.addClass(m,"jw-hide"),n.position!==h.position||n.margin!==h.margin){var c=/(\w+)-(\w+)/.exec(n.position),d={top:"auto",right:"auto",bottom:"auto",left:"auto"};3===c.length&&(d[c[1]]=n.margin,d[c[2]]=n.margin,g(m,d))}var e=new a(m);e.on("click tap",l)}}function l(a){b.exists(a)&&a.stopPropagation&&a.stopPropagation(),o.trigger(c.JWPLAYER_LOGO_CLICK,{link:n.link,linktarget:n.linktarget})}var m,n,o=this,p=d.extend({},i.get("logo"));return d.extend(this,e),this.element=function(){return m},this.offset=function(a){g(m,{marginBottom:a})},this.position=function(){return n.position},this.margin=function(){return parseInt(n.margin,10)},j(),this};return i}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(63),c(66),c(47),c(45)],e=function(a,b,c,d){function e(a,b){return/touch/.test(a.type)?(a.originalEvent||a).changedTouches[0]["page"+b]:a["page"+b]}function f(a){var b=a||window.event;return a instanceof MouseEvent?"which"in b?3===b.which:"button"in b?2===b.button:!1:!1}function g(a,b,c){var d;return d=b instanceof MouseEvent||!b.touches&&!b.changedTouches?b:b.touches&&b.touches.length?b.touches[0]:b.changedTouches[0],{type:a,target:b.target,currentTarget:c,pageX:d.pageX,pageY:d.pageY}}function h(a){(a instanceof MouseEvent||a instanceof window.TouchEvent)&&(a.preventManipulation&&a.preventManipulation(),a.cancelable&&a.preventDefault&&a.preventDefault())}var i=!c.isUndefined(window.PointerEvent),j=!i&&d.isMobile(),k=!i&&!j,l=function(a,d){function j(a){(k||i&&"touch"!==a.pointerType)&&p(b.touchEvents.OVER,a)}function l(c){(k||i&&"touch"!==c.pointerType&&!a.contains(document.elementFromPoint(c.x,c.y)))&&p(b.touchEvents.OUT,c)}function m(b){q=b.target,u=e(b,"X"),v=e(b,"Y"),f(b)||(i?b.isPrimary&&(d.preventScrolling&&(r=b.pointerId,a.setPointerCapture(r)),a.addEventListener("pointermove",n),a.addEventListener("pointerup",o),a.addEventListener("pointercancel",o)):k&&(document.addEventListener("mousemove",n),document.addEventListener("mouseup",o)),q.addEventListener("touchmove",n),q.addEventListener("touchend",o),q.addEventListener("touchcancel",o))}function n(a){var c=b.touchEvents,f=6;if(t)p(c.DRAG,a);else{var g=e(a,"X"),i=e(a,"Y"),j=g-u,k=i-v;j*j+k*k>f*f&&(p(c.DRAG_START,a),t=!0,p(c.DRAG,a))}d.preventScrolling&&h(a)}function o(c){var e=b.touchEvents;i?(d.preventScrolling&&a.releasePointerCapture(r),a.removeEventListener("pointermove",n),a.removeEventListener("pointercancel",o),a.removeEventListener("pointerup",o)):k&&(document.removeEventListener("mousemove",n),document.removeEventListener("mouseup",o)),q.removeEventListener("touchmove",n),q.removeEventListener("touchcancel",o),q.removeEventListener("touchend",o),t?p(e.DRAG_END,c):d.directSelect&&c.target!==a||(i&&c instanceof window.PointerEvent?"touch"===c.pointerType?p(e.TAP,c):p(e.CLICK,c):k?p(e.CLICK,c):(p(e.TAP,c),h(c))),q=null,t=!1}function p(a,e){var f;if(d.enableDoubleTap&&(a===b.touchEvents.CLICK||a===b.touchEvents.TAP))if(c.now()-w<x){var h=a===b.touchEvents.CLICK?b.touchEvents.DOUBLE_CLICK:b.touchEvents.DOUBLE_TAP;f=g(h,e,s),y.trigger(h,f),w=0}else w=c.now();f=g(a,e,s),y.trigger(a,f)}var q,r,s=a,t=!1,u=0,v=0,w=0,x=300;d=d||{},i?(a.addEventListener("pointerdown",m),d.useHover&&(a.addEventListener("pointerover",j),a.addEventListener("pointerout",l))):k&&(a.addEventListener("mousedown",m),d.useHover&&(a.addEventListener("mouseover",j),a.addEventListener("mouseout",l))),a.addEventListener("touchstart",m);var y=this;return this.triggerEvent=p,this.destroy=function(){a.removeEventListener("touchstart",m),a.removeEventListener("mousedown",m),q&&(q.removeEventListener("touchmove",n),q.removeEventListener("touchcancel",o),q.removeEventListener("touchend",o)),i&&(d.preventScrolling&&a.releasePointerCapture(r),a.removeEventListener("pointerdown",m),a.removeEventListener("pointermove",n),a.removeEventListener("pointercancel",o),a.removeEventListener("pointerup",o)),document.removeEventListener("mousemove",n),document.removeEventListener("mouseup",o)},this};return c.extend(l.prototype,a),l}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({1:function(a,b,c,d){var e,f="function",g=b.helperMissing,h=this.escapeExpression;return'src="'+h((e=null!=(e=b.file||(null!=a?a.file:a))?e:g,typeof e===f?e.call(a,{name:"file",hash:{},data:d}):e))+'"'},compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){var e,f='<div class="jw-logo jw-reset">\n    <img class="jw-logo-image" ';return e=b["if"].call(a,null!=a?a.file:a,{name:"if",hash:{},fn:this.program(1,d),inverse:this.noop,data:d}),null!=e&&(f+=e),f+">\n</div>"},useData:!0})},function(a,b,c){a.exports=c(120)},function(a,b,c){"use strict";var d=c(121),e=c(123)["default"],f=c(124)["default"],g=c(122),h=c(125),i=function(){var a=new d.HandlebarsEnvironment;return g.extend(a,d),a.SafeString=e,a.Exception=f,a.Utils=g,a.escapeExpression=g.escapeExpression,a.VM=h,a.template=function(b){return h.template(b,a)},a},j=i();j.create=i,j["default"]=j,b["default"]=j},function(a,b,c){"use strict";function d(a,b){this.helpers=a||{},this.partials=b||{},e(this)}function e(a){a.registerHelper("helperMissing",function(){if(1===arguments.length)return void 0;throw new g("Missing helper: '"+arguments[arguments.length-1].name+"'")}),a.registerHelper("blockHelperMissing",function(b,c){var d=c.inverse,e=c.fn;if(b===!0)return e(this);if(b===!1||null==b)return d(this);if(k(b))return b.length>0?(c.ids&&(c.ids=[c.name]),a.helpers.each(b,c)):d(this);if(c.data&&c.ids){var g=q(c.data);g.contextPath=f.appendContextPath(c.data.contextPath,c.name),c={data:g}}return e(b,c)}),a.registerHelper("each",function(a,b){if(!b)throw new g("Must pass iterator to #each");var c,d,e=b.fn,h=b.inverse,i=0,j="";if(b.data&&b.ids&&(d=f.appendContextPath(b.data.contextPath,b.ids[0])+"."),l(a)&&(a=a.call(this)),b.data&&(c=q(b.data)),a&&"object"==typeof a)if(k(a))for(var m=a.length;m>i;i++)c&&(c.index=i,c.first=0===i,c.last=i===a.length-1,d&&(c.contextPath=d+i)),j+=e(a[i],{data:c});else for(var n in a)a.hasOwnProperty(n)&&(c&&(c.key=n,c.index=i,c.first=0===i,d&&(c.contextPath=d+n)),j+=e(a[n],{data:c}),i++);return 0===i&&(j=h(this)),j}),a.registerHelper("if",function(a,b){return l(a)&&(a=a.call(this)),!b.hash.includeZero&&!a||f.isEmpty(a)?b.inverse(this):b.fn(this)}),a.registerHelper("unless",function(b,c){return a.helpers["if"].call(this,b,{fn:c.inverse,inverse:c.fn,hash:c.hash})}),a.registerHelper("with",function(a,b){l(a)&&(a=a.call(this));var c=b.fn;if(f.isEmpty(a))return b.inverse(this);if(b.data&&b.ids){var d=q(b.data);d.contextPath=f.appendContextPath(b.data.contextPath,b.ids[0]),b={data:d}}return c(a,b)}),a.registerHelper("log",function(b,c){var d=c.data&&null!=c.data.level?parseInt(c.data.level,10):1;a.log(d,b)}),a.registerHelper("lookup",function(a,b){return a&&a[b]})}var f=c(122),g=c(124)["default"],h="2.0.0";b.VERSION=h;var i=6;b.COMPILER_REVISION=i;var j={1:"<= 1.0.rc.2",2:"== 1.0.0-rc.3",3:"== 1.0.0-rc.4",4:"== 1.x.x",5:"== 2.0.0-alpha.x",6:">= 2.0.0-beta.1"};b.REVISION_CHANGES=j;var k=f.isArray,l=f.isFunction,m=f.toString,n="[object Object]";b.HandlebarsEnvironment=d,d.prototype={constructor:d,logger:o,log:p,registerHelper:function(a,b){if(m.call(a)===n){if(b)throw new g("Arg not supported with multiple helpers");f.extend(this.helpers,a)}else this.helpers[a]=b},unregisterHelper:function(a){delete this.helpers[a]},registerPartial:function(a,b){m.call(a)===n?f.extend(this.partials,a):this.partials[a]=b},unregisterPartial:function(a){delete this.partials[a]}};var o={methodMap:{0:"debug",1:"info",2:"warn",3:"error"},DEBUG:0,INFO:1,WARN:2,ERROR:3,level:3,log:function(a,b){if(o.level<=a){var c=o.methodMap[a];"undefined"!=typeof console&&console[c]&&console[c].call(console,b)}}};b.logger=o;var p=o.log;b.log=p;var q=function(a){var b=f.extend({},a);return b._parent=a,b};b.createFrame=q},function(a,b,c){"use strict";function d(a){return j[a]}function e(a){for(var b=1;b<arguments.length;b++)for(var c in arguments[b])Object.prototype.hasOwnProperty.call(arguments[b],c)&&(a[c]=arguments[b][c]);return a}function f(a){return a instanceof i?a.toString():null==a?"":a?(a=""+a,l.test(a)?a.replace(k,d):a):a+""}function g(a){return a||0===a?o(a)&&0===a.length?!0:!1:!0}function h(a,b){return(a?a+".":"")+b}var i=c(123)["default"],j={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#x27;","`":"&#x60;"},k=/[&<>"'`]/g,l=/[&<>"'`]/;b.extend=e;var m=Object.prototype.toString;b.toString=m;var n=function(a){return"function"==typeof a};n(/x/)&&(n=function(a){return"function"==typeof a&&"[object Function]"===m.call(a)});var n;b.isFunction=n;var o=Array.isArray||function(a){return a&&"object"==typeof a?"[object Array]"===m.call(a):!1};b.isArray=o,b.escapeExpression=f,b.isEmpty=g,b.appendContextPath=h},function(a,b){"use strict";function c(a){this.string=a}c.prototype.toString=function(){return""+this.string},b["default"]=c},function(a,b){"use strict";function c(a,b){var c;b&&b.firstLine&&(c=b.firstLine,a+=" - "+c+":"+b.firstColumn);for(var e=Error.prototype.constructor.call(this,a),f=0;f<d.length;f++)this[d[f]]=e[d[f]];c&&(this.lineNumber=c,this.column=b.firstColumn)}var d=["description","fileName","lineNumber","message","name","number","stack"];c.prototype=new Error,b["default"]=c},function(a,b,c){"use strict";function d(a){var b=a&&a[0]||1,c=l;if(b!==c){if(c>b){var d=m[c],e=m[b];throw new k("Template was precompiled with an older version of Handlebars than the current runtime. Please update your precompiler to a newer version ("+d+") or downgrade your runtime to an older version ("+e+").")}throw new k("Template was precompiled with a newer version of Handlebars than the current runtime. Please update your runtime to a newer version ("+a[1]+").")}}function e(a,b){if(!b)throw new k("No environment passed to template");if(!a||!a.main)throw new k("Unknown template object: "+typeof a);b.VM.checkRevision(a.compiler);var c=function(c,d,e,f,g,h,i,l,m){g&&(f=j.extend({},f,g));var n=b.VM.invokePartial.call(this,c,e,f,h,i,l,m);if(null==n&&b.compile){var o={helpers:h,partials:i,data:l,depths:m};i[e]=b.compile(c,{data:void 0!==l,compat:a.compat},b),n=i[e](f,o)}if(null!=n){if(d){for(var p=n.split("\n"),q=0,r=p.length;r>q&&(p[q]||q+1!==r);q++)p[q]=d+p[q];n=p.join("\n")}return n}throw new k("The partial "+e+" could not be compiled when running in runtime-only mode")},d={lookup:function(a,b){for(var c=a.length,d=0;c>d;d++)if(a[d]&&null!=a[d][b])return a[d][b]},lambda:function(a,b){return"function"==typeof a?a.call(b):a},escapeExpression:j.escapeExpression,invokePartial:c,fn:function(b){return a[b]},programs:[],program:function(a,b,c){var d=this.programs[a],e=this.fn(a);return b||c?d=f(this,a,e,b,c):d||(d=this.programs[a]=f(this,a,e)),d},data:function(a,b){for(;a&&b--;)a=a._parent;return a},merge:function(a,b){var c=a||b;return a&&b&&a!==b&&(c=j.extend({},b,a)),c},noop:b.VM.noop,compilerInfo:a.compiler},e=function(b,c){c=c||{};var f=c.data;e._setup(c),!c.partial&&a.useData&&(f=i(b,f));var g;return a.useDepths&&(g=c.depths?[b].concat(c.depths):[b]),a.main.call(d,b,d.helpers,d.partials,f,g)};return e.isTop=!0,e._setup=function(c){c.partial?(d.helpers=c.helpers,d.partials=c.partials):(d.helpers=d.merge(c.helpers,b.helpers),a.usePartial&&(d.partials=d.merge(c.partials,b.partials)))},e._child=function(b,c,e){if(a.useDepths&&!e)throw new k("must pass parent depths");return f(d,b,a[b],c,e)},e}function f(a,b,c,d,e){var f=function(b,f){return f=f||{},c.call(a,b,a.helpers,a.partials,f.data||d,e&&[b].concat(e))};return f.program=b,f.depth=e?e.length:0,f}function g(a,b,c,d,e,f,g){var h={partial:!0,helpers:d,partials:e,data:f,depths:g};if(void 0===a)throw new k("The partial "+b+" could not be found");return a instanceof Function?a(c,h):void 0}function h(){return""}function i(a,b){return b&&"root"in b||(b=b?n(b):{},b.root=a),b}var j=c(122),k=c(124)["default"],l=c(121).COMPILER_REVISION,m=c(121).REVISION_CHANGES,n=c(121).createFrame;b.checkRevision=d,b.template=e,b.program=f,b.invokePartial=g,b.noop=h},function(a,b,c){var d,e;d=[c(45),c(54),c(65),c(47)],e=function(a,b,c,d){var e=b.style,f={back:!0,fontSize:15,fontFamily:"Arial,sans-serif",fontOpacity:100,color:"#FFF",backgroundColor:"#000",backgroundOpacity:100,edgeStyle:null,windowColor:"#FFF",windowOpacity:0},g=function(g){function h(b){b=b||"";var c="jw-captions-window jw-reset";b?(r.innerHTML=b,q.className=c+" jw-captions-window-active"):(q.className=c,a.empty(r))}function i(a){o=a,m&&j(m.data,o)}function j(a,b){if(a&&b){var c=-1;if(!(n>=0&&k(a,b,n))){for(var d=0;d<a.length;d++)if(k(a,b,d)){c=d;break}-1===c?h(""):c!==n&&(n=c,h(a[n].text))}}}function k(a,b,c){var e=b.position;if(a[c].useMPEGTS){if(!b.metadata||!d.isNumber(b.metadata.mpegts))return!1;e=b.metadata.mpegts}return a[c].begin<=e&&(!a[c].end||a[c].end>=e)&&(c===a.length-1||a[c+1].begin>=e)}function l(a,c,d){var e=b.hexToRgba("#000000",d);"dropshadow"===a?c.textShadow="0 2px 1px "+e:"raised"===a?c.textShadow="0 0 5px "+e+", 0 1px 5px "+e+", 0 2px 5px "+e:"depressed"===a?c.textShadow="0 -2px 1px "+e:"uniform"===a&&(c.textShadow="-2px 0 1px "+e+",2px 0 1px "+e+",0 -2px 1px "+e+",0 2px 1px "+e+",-1px 1px 1px "+e+",1px 1px 1px "+e+",1px -1px 1px "+e+",1px 1px 1px "+e)}var m,n,o,p,q,r,s={};p=document.createElement("div"),p.className="jw-captions jw-reset",this.show=function(){p.className="jw-captions jw-captions-enabled jw-reset"},this.hide=function(){p.className="jw-captions jw-reset"},this.populate=function(a){return n=-1,m=a,a?void j(a.data,o):void h("")},this.resize=function(){var a=p.clientWidth,b=Math.pow(a/400,.6);if(b){var c=s.fontSize*b;e(p,{fontSize:Math.round(c)+"px"})}},this.setup=function(a){if(q=document.createElement("div"),r=document.createElement("span"),q.className="jw-captions-window jw-reset",r.className="jw-captions-text jw-reset",s=d.extend({},f,a),a){var c=s.fontOpacity,h=s.windowOpacity,i=s.edgeStyle,j=s.backgroundColor,k={},m={color:b.hexToRgba(s.color,c),fontFamily:s.fontFamily,fontStyle:s.fontStyle,fontWeight:s.fontWeight,textDecoration:s.textDecoration};h&&(k.backgroundColor=b.hexToRgba(s.windowColor,h)),l(i,m,c),s.back?m.backgroundColor=b.hexToRgba(j,s.backgroundOpacity):null===i&&l("uniform",m),e(q,k),e(r,m)}q.appendChild(r),p.appendChild(q),this.populate(g.get("captionsTrack"))},this.element=function(){return p},g.on("change:item",function(){o=null,n=-1,h("")},this),g.on("change:captionsTrack",function(a,b){this.populate(b)},this),g.mediaController.on("seek",function(){n=-1},this),g.mediaController.on("time seek",function(a){i(a)},this),g.mediaController.on("subtitlesTrackData",function(){m&&j(m.data,o)},this),g.on("change:state",function(a,b){switch(b){case c.IDLE:case c.ERROR:case c.COMPLETE:this.hide();break;default:this.show()}},this)};return g}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(117),c(66),c(63),c(47)],e=function(a,b,c,d){var e=function(e,f){function g(a){return e.get("flashBlocked")?void 0:j?void j(a):void m.trigger(a.type===b.touchEvents.CLICK?"click":"tap")}function h(){return k?void k():void m.trigger("doubleClick")}var i,j,k;d.extend(this,c),i=f,this.element=function(){return i};var l=new a(i,{enableDoubleTap:!0});l.on("click tap",g),l.on("doubleClick doubleTap",h),this.clickHandler=g;var m=this;this.setAlternateClickHandlers=function(a,b){j=a,k=b||null},this.revertAlternateClickHandlers=function(){j=null,k=null}};return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(63),c(117),c(129),c(47)],e=function(a,b,c,d,e){var f=function(f){e.extend(this,b),this.model=f,this.el=a.createElement(d({}));var g=this;this.iconUI=new c(this.el).on("click tap",function(a){g.trigger(a.type)})};return e.extend(f.prototype,{element:function(){return this.el}}),f}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){return'<div class="jw-display-icon-container jw-background-color jw-reset">\n    <div class="jw-icon jw-icon-display jw-button-color jw-reset"></div>\n</div>\n'},useData:!0})},function(a,b,c){var d,e;d=[c(131),c(45),c(47),c(117)],e=function(a,b,c,d){var e=function(a){this.model=a,this.setup(),this.model.on("change:dock",this.render,this)};return c.extend(e.prototype,{setup:function(){var c=this.model.get("dock"),e=this.click.bind(this),f=a(c);this.el=b.createElement(f),new d(this.el).on("click tap",e)},getDockButton:function(a){return b.hasClass(a.target,"jw-dock-button")?a.target:b.hasClass(a.target,"jw-dock-text")?a.target.parentElement.parentElement:a.target.parentElement},click:function(a){var b=this.getDockButton(a),d=b.getAttribute("button"),e=this.model.get("dock"),f=c.findWhere(e,{id:d});f&&f.callback&&f.callback()},render:function(){var c=this.model.get("dock"),d=a(c),e=b.createElement(d);this.el.innerHTML=e.innerHTML},element:function(){return this.el}}),e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({1:function(a,b,c,d){var e,f,g="function",h=b.helperMissing,i=this.escapeExpression,j='    <div class="jw-dock-button jw-background-color jw-reset" button="'+i((f=null!=(f=b.id||(null!=a?a.id:a))?f:h,typeof f===g?f.call(a,{name:"id",hash:{},data:d}):f))+'">\n        <div class="jw-icon jw-dock-image jw-reset" style="background-image: url('+i((f=null!=(f=b.img||(null!=a?a.img:a))?f:h,typeof f===g?f.call(a,{name:"img",hash:{},data:d}):f))+')"></div>\n        <div class="jw-arrow jw-reset"></div>\n';return e=b["if"].call(a,null!=a?a.tooltip:a,{name:"if",hash:{},fn:this.program(2,d),inverse:this.noop,data:d}),null!=e&&(j+=e),j+"    </div>\n"},2:function(a,b,c,d){var e,f="function",g=b.helperMissing,h=this.escapeExpression;return'        <div class="jw-overlay jw-background-color jw-reset">\n            <span class="jw-text jw-dock-text jw-reset">'+h((e=null!=(e=b.tooltip||(null!=a?a.tooltip:a))?e:g,typeof e===f?e.call(a,{name:"tooltip",hash:{},data:d}):e))+"</span>\n        </div>\n"},compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){var e,f='<div class="jw-dock jw-reset">\n';return e=b.each.call(a,a,{name:"each",hash:{},fn:this.program(1,d),inverse:this.noop,data:d}),null!=e&&(f+=e),f+"</div>"},useData:!0})},function(a,b,c){var d,e;d=[c(45),c(47),c(63),c(117),c(134),c(133),c(140),c(142),c(144),c(145)],e=function(a,b,c,d,e,f,g,h,i,j){function k(a,b){var c=document.createElement("div");return c.className="jw-icon jw-icon-inline jw-button-color jw-reset "+a,c.style.display="none",b&&new d(c).on("click tap",function(){b()}),{element:function(){return c},toggle:function(a){a?this.show():this.hide()},show:function(){c.style.display=""},hide:function(){c.style.display="none"}}}function l(a){var b=document.createElement("span");return b.className="jw-text jw-reset "+a,b}function m(a){var b=new g(a);return b}function n(a,c){var d=document.createElement("div");return d.className="jw-group jw-controlbar-"+a+"-group jw-reset",b.each(c,function(a){a.element&&(a=a.element()),d.appendChild(a)}),d}function o(b,c){this._api=b,this._model=c,this._isMobile=a.isMobile(),this._compactModeMaxSize=400,this._maxCompactWidth=-1,this.setup()}return b.extend(o.prototype,c,{setup:function(){this.build(),this.initialize()},build:function(){var a,c,d,g,o=new f(this._model,this._api),p=new j("jw-icon-more");this._model.get("visualplaylist")!==!1&&(a=new h("jw-icon-playlist")),this._isMobile||(g=k("jw-icon-volume",this._api.setMute),c=new e("jw-slider-volume","horizontal"),d=new i(this._model,"jw-icon-volume")),this.elements={alt:l("jw-text-alt"),play:k("jw-icon-playback",this._api.play),prev:k("jw-icon-prev",this._api.playlistPrev),next:k("jw-icon-next",this._api.playlistNext),playlist:a,elapsed:l("jw-text-elapsed"),time:o,duration:l("jw-text-duration"),drawer:p,hd:m("jw-icon-hd"),cc:m("jw-icon-cc"),audiotracks:m("jw-icon-audio-tracks"),mute:g,volume:c,volumetooltip:d,cast:k("jw-icon-cast jw-off",this._api.castToggle),fullscreen:k("jw-icon-fullscreen",this._api.setFullscreen)},this.layout={left:[this.elements.play,this.elements.prev,this.elements.playlist,this.elements.next,this.elements.elapsed],center:[this.elements.time,this.elements.alt],right:[this.elements.duration,this.elements.hd,this.elements.cc,this.elements.audiotracks,this.elements.drawer,this.elements.mute,this.elements.cast,this.elements.volume,this.elements.volumetooltip,this.elements.fullscreen],drawer:[this.elements.hd,this.elements.cc,this.elements.audiotracks]},this.menus=b.compact([this.elements.playlist,this.elements.hd,this.elements.cc,this.elements.audiotracks,this.elements.volumetooltip]),this.layout.left=b.compact(this.layout.left),this.layout.center=b.compact(this.layout.center),this.layout.right=b.compact(this.layout.right),this.layout.drawer=b.compact(this.layout.drawer),this.el=document.createElement("div"),this.el.className="jw-controlbar jw-background-color jw-reset",this.elements.left=n("left",this.layout.left),this.elements.center=n("center",this.layout.center),this.elements.right=n("right",this.layout.right),this.el.appendChild(this.elements.left),this.el.appendChild(this.elements.center),this.el.appendChild(this.elements.right)},initialize:function(){this.elements.play.show(),this.elements.fullscreen.show(),this.elements.mute&&this.elements.mute.show(),
this.onVolume(this._model,this._model.get("volume")),this.onPlaylist(this._model,this._model.get("playlist")),this.onPlaylistItem(this._model,this._model.get("playlistItem")),this.onCastAvailable(this._model,this._model.get("castAvailable")),this.onCaptionsList(this._model,this._model.get("captionsList")),this._model.on("change:volume",this.onVolume,this),this._model.on("change:mute",this.onMute,this),this._model.on("change:playlist",this.onPlaylist,this),this._model.on("change:playlistItem",this.onPlaylistItem,this),this._model.on("change:castAvailable",this.onCastAvailable,this),this._model.on("change:duration",this.onDuration,this),this._model.on("change:position",this.onElapsed,this),this._model.on("change:fullscreen",this.onFullscreen,this),this._model.on("change:captionsList",this.onCaptionsList,this),this._model.on("change:captionsIndex",this.onCaptionsIndex,this),this._model.on("change:compactUI",this.onCompactUI,this),this.elements.volume&&this.elements.volume.on("update",function(a){var b=a.percentage;this._api.setVolume(b)},this),this.elements.volumetooltip&&(this.elements.volumetooltip.on("update",function(a){var b=a.percentage;this._api.setVolume(b)},this),this.elements.volumetooltip.on("toggleValue",function(){this._api.setMute()},this)),this.elements.playlist&&this.elements.playlist.on("select",function(a){this._model.once("setItem",function(){this._api.play()},this),this._api.load(a)},this),this.elements.hd.on("select",function(a){this._model.getVideo().setCurrentQuality(a)},this),this.elements.hd.on("toggleValue",function(){this._model.getVideo().setCurrentQuality(0===this._model.getVideo().getCurrentQuality()?1:0)},this),this.elements.cc.on("select",function(a){this._api.setCurrentCaptions(a)},this),this.elements.cc.on("toggleValue",function(){var a=this._model.get("captionsIndex");this._api.setCurrentCaptions(a?0:1)},this),this.elements.audiotracks.on("select",function(a){this._model.getVideo().setCurrentAudioTrack(a)},this),new d(this.elements.duration).on("click tap",function(){"DVR"===a.adaptiveType(this._model.get("duration"))&&this._api.seek(-.1)},this),new d(this.el).on("click tap drag",function(){this.trigger("userAction")},this),this.elements.drawer.on("open-drawer close-drawer",function(b,c){a.toggleClass(this.el,"jw-drawer-expanded",c.isOpen),c.isOpen||this.closeMenus()},this),b.each(this.menus,function(a){a.on("open-tooltip",this.closeMenus,this)},this)},onCaptionsList:function(a,b){var c=a.get("captionsIndex");this.elements.cc.setup(b,c),this.clearCompactMode()},onCaptionsIndex:function(a,b){this.elements.cc.selectItem(b)},onPlaylist:function(a,b){var c=b.length>1;this.elements.next.toggle(c),this.elements.prev.toggle(c),this.elements.playlist&&this.elements.playlist.setup(b,a.get("item"))},onPlaylistItem:function(c){this.elements.time.updateBuffer(0),this.elements.time.render(0),this.elements.duration.innerHTML="00:00",this.elements.elapsed.innerHTML="00:00",this.clearCompactMode();var d=c.get("item");this.elements.playlist&&this.elements.playlist.selectItem(d),this.elements.audiotracks.setup(),this._model.mediaModel.on("change:levels",function(a,b){this.elements.hd.setup(b,a.get("currentLevel")),this.clearCompactMode()},this),this._model.mediaModel.on("change:currentLevel",function(a,b){this.elements.hd.selectItem(b)},this),this._model.mediaModel.on("change:audioTracks",function(a,c){var d=b.map(c,function(a){return{label:a.name}});this.elements.audiotracks.setup(d,a.get("currentAudioTrack"),{toggle:!1}),this.clearCompactMode()},this),this._model.mediaModel.on("change:currentAudioTrack",function(a,b){this.elements.audiotracks.selectItem(b)},this),this._model.mediaModel.on("change:state",function(b,c){"complete"===c&&(this.elements.drawer.closeTooltip(),a.removeClass(this.el,"jw-drawer-expanded"))},this)},onVolume:function(a,b){this.renderVolume(a.get("mute"),b)},onMute:function(a,b){this.renderVolume(b,a.get("volume"))},renderVolume:function(b,c){this.elements.mute&&a.toggleClass(this.elements.mute.element(),"jw-off",b),this.elements.volume&&this.elements.volume.render(b?0:c),this.elements.volumetooltip&&(this.elements.volumetooltip.volumeSlider.render(b?0:c),a.toggleClass(this.elements.volumetooltip.element(),"jw-off",b))},onCastAvailable:function(a,b){this.elements.cast.toggle(b),this.clearCompactMode()},onElapsed:function(b,c){var d,e=b.get("duration");d="DVR"===a.adaptiveType(e)?"-"+a.timeFormat(-e):a.timeFormat(c),this.elements.elapsed.innerHTML=d},onDuration:function(b,c){var d;"DVR"===a.adaptiveType(c)?(d="Live",this.clearCompactMode()):d=a.timeFormat(c),this.elements.duration.innerHTML=d},onFullscreen:function(b,c){a.toggleClass(this.elements.fullscreen.element(),"jw-off",c)},element:function(){return this.el},getVisibleBounds:function(){var b,c=this.el,d=getComputedStyle?getComputedStyle(c):c.currentStyle;return"table"===d.display?a.bounds(c):(c.style.visibility="hidden",c.style.display="table",b=a.bounds(c),c.style.visibility=c.style.display="",b)},setAltText:function(a){this.elements.alt.innerHTML=a},addCues:function(a){this.elements.time&&(b.each(a,function(a){this.elements.time.addCue(a)},this),this.elements.time.drawCues())},closeMenus:function(a){b.each(this.menus,function(b){a&&a.target===b.el||b.closeTooltip(a)})},hideComponents:function(){this.closeMenus(),this.elements.drawer.closeTooltip(),a.removeClass(this.el,"jw-drawer-expanded")},clearCompactMode:function(){this._maxCompactWidth=-1,this._model.set("compactUI",!1)},setCompactModeBounds:function(){if(this.element().offsetWidth>0){var b=this.elements.left.offsetWidth+this.elements.right.offsetWidth;if("LIVE"===a.adaptiveType(this._model.get("duration")))this._maxCompactWidth=b+this.elements.alt.offsetWidth;else{var c=b+(this.elements.center.offsetWidth-this.elements.time.el.offsetWidth),d=.25;this._maxCompactWidth=c/(1-d)}}},checkCompactMode:function(a){-1===this._maxCompactWidth&&this.setCompactModeBounds(),-1!==this._maxCompactWidth&&(this._model.get("compactUI")?a>this._compactModeMaxSize&&a>this._maxCompactWidth&&this._model.set("compactUI",!1):(a<=this._compactModeMaxSize||a<=this._maxCompactWidth)&&this._model.set("compactUI",!0))},onCompactUI:function(c,d){a.removeClass(this.el,"jw-drawer-expanded"),this.elements.drawer.setup(this.layout.drawer,d),(!d||this.elements.drawer.activeContents.length<2)&&b.each(this.layout.drawer,function(a){this.elements.right.insertBefore(a.el,this.elements.drawer.el)},this)}}),o}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(134),c(45),c(137),c(138),c(139)],e=function(a,b,c,d,e,f){var g=d.extend({setup:function(){this.text=document.createElement("span"),this.text.className="jw-text jw-reset",this.img=document.createElement("div"),this.img.className="jw-reset";var a=document.createElement("div");a.className="jw-time-tip jw-background-color jw-reset",a.appendChild(this.img),a.appendChild(this.text),c.removeClass(this.el,"jw-hidden"),this.addContent(a)},image:function(a){c.style(this.img,a)},update:function(a){this.text.innerHTML=a}}),h=b.extend({constructor:function(c,d){this._model=c,this._api=d,this.timeTip=new g("jw-tooltip-time"),this.timeTip.setup(),this.seekThrottled=a.throttle(this.performSeek,400),this._model.on("change:playlistItem",this.onPlaylistItem,this).on("change:position",this.onPosition,this).on("change:buffer",this.onBuffer,this),b.call(this,"jw-slider-time","horizontal")},setup:function(){b.prototype.setup.apply(this,arguments),this.onPlaylistItem(this._model,this._model.get("playlistItem")),this.elementRail.appendChild(this.timeTip.element()),this.elementRail.addEventListener("mousemove",this.showTimeTooltip.bind(this),!1),this.elementRail.addEventListener("mouseout",this.hideTimeTooltip.bind(this),!1)},update:function(c){this.activeCue&&a.isNumber(this.activeCue.pct)?this.seekTo=this.activeCue.pct:this.seekTo=c,this.seekThrottled(),b.prototype.update.apply(this,arguments)},dragStart:function(){this._model.set("scrubbing",!0),b.prototype.dragStart.apply(this,arguments)},dragEnd:function(){b.prototype.dragEnd.apply(this,arguments),this._model.set("scrubbing",!1)},onSeeked:function(){this._model.get("scrubbing")&&this.performSeek()},onBuffer:function(a,b){this.updateBuffer(b)},onPosition:function(a,b){var d=0,e=this._model.get("duration");if(e){var f=c.adaptiveType(e);"DVR"===f?d=(e-b)/e*100:"VOD"===f&&(d=b/e*100)}this.render(d)},onPlaylistItem:function(b,c){this.reset(),b.mediaModel.on("seeked",this.onSeeked,this);var d=c.tracks;a.each(d,function(a){a&&a.kind&&"thumbnails"===a.kind.toLowerCase()?this.loadThumbnails(a.file):a&&a.kind&&"chapters"===a.kind.toLowerCase()&&this.loadChapters(a.file)},this)},performSeek:function(){var a,b=this._model.get("duration"),d=c.adaptiveType(b);"LIVE"===d||0===b?this._api.play():"DVR"===d?(a=(1-this.seekTo/100)*b,this._api.seek(Math.min(a,-.25))):(a=this.seekTo/100*b,this._api.seek(Math.min(a,b-.25)))},showTimeTooltip:function(a){var b=this._model.get("duration");if(!(0>=b)){var d=c.bounds(this.elementRail),e=a.pageX?a.pageX-d.left:a.x;e=c.between(e,0,d.width);var f,g=e/d.width,h=b*g;f=this.activeCue?this.activeCue.text:c.timeFormat(h),this.timeTip.update(f),this.showThumbnail(h),c.addClass(this.timeTip.el,"jw-open"),this.timeTip.el.style.left=100*g+"%"}},hideTimeTooltip:function(){c.removeClass(this.timeTip.el,"jw-open")},reset:function(){this.resetChapters(),this.resetThumbnails()}});return a.extend(h.prototype,e,f),h}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(135),c(117),c(136),c(45)],e=function(a,b,c,d){var e=a.extend({constructor:function(a,b){this.className=a+" jw-background-color jw-reset",this.orientation=b,this.dragStartListener=this.dragStart.bind(this),this.dragMoveListener=this.dragMove.bind(this),this.dragEndListener=this.dragEnd.bind(this),this.tapListener=this.tap.bind(this),this.setup()},setup:function(){var a={"default":this["default"],className:this.className,orientation:"jw-slider-"+this.orientation};this.el=d.createElement(c(a)),this.elementRail=this.el.getElementsByClassName("jw-slider-container")[0],this.elementBuffer=this.el.getElementsByClassName("jw-buffer")[0],this.elementProgress=this.el.getElementsByClassName("jw-progress")[0],this.elementThumb=this.el.getElementsByClassName("jw-knob")[0],this.userInteract=new b(this.element(),{preventScrolling:!0}),this.userInteract.on("dragStart",this.dragStartListener),this.userInteract.on("drag",this.dragMoveListener),this.userInteract.on("dragEnd",this.dragEndListener),this.userInteract.on("tap click",this.tapListener)},dragStart:function(){this.trigger("dragStart"),this.railBounds=d.bounds(this.elementRail)},dragEnd:function(a){this.dragMove(a),this.trigger("dragEnd")},dragMove:function(a){var b,c,e=this.railBounds=this.railBounds?this.railBounds:d.bounds(this.elementRail);return"horizontal"===this.orientation?(b=a.pageX,c=b<e.left?0:b>e.right?100:100*d.between((b-e.left)/e.width,0,1)):(b=a.pageY,c=b>=e.bottom?0:b<=e.top?100:100*d.between((e.height-(b-e.top))/e.height,0,1)),this.render(c),this.update(c),!1},tap:function(a){this.railBounds=d.bounds(this.elementRail),this.dragMove(a)},update:function(a){this.trigger("update",{percentage:a})},render:function(a){a=Math.max(0,Math.min(a,100)),"horizontal"===this.orientation?(this.elementThumb.style.left=a+"%",this.elementProgress.style.width=a+"%"):(this.elementThumb.style.bottom=a+"%",this.elementProgress.style.height=a+"%")},updateBuffer:function(a){this.elementBuffer.style.width=a+"%"},element:function(){return this.el}});return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(63),c(47)],e=function(a,b){function c(){}var d=function(a,c){var d,e=this;d=a&&b.has(a,"constructor")?a.constructor:function(){return e.apply(this,arguments)},b.extend(d,e,c);var f=function(){this.constructor=d};return f.prototype=e.prototype,d.prototype=new f,a&&b.extend(d.prototype,a),d.__super__=e.prototype,d};return c.extend=d,b.extend(c.prototype,a),c}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){var e,f="function",g=b.helperMissing,h=this.escapeExpression;return'<div class="'+h((e=null!=(e=b.className||(null!=a?a.className:a))?e:g,typeof e===f?e.call(a,{name:"className",hash:{},data:d}):e))+" "+h((e=null!=(e=b.orientation||(null!=a?a.orientation:a))?e:g,typeof e===f?e.call(a,{name:"orientation",hash:{},data:d}):e))+' jw-reset">\n    <div class="jw-slider-container jw-reset">\n        <div class="jw-rail jw-reset"></div>\n        <div class="jw-buffer jw-reset"></div>\n        <div class="jw-progress jw-reset"></div>\n        <div class="jw-knob jw-reset"></div>\n    </div>\n</div>'},useData:!0})},function(a,b,c){var d,e;d=[c(135),c(45)],e=function(a,b){var c=a.extend({constructor:function(a){this.el=document.createElement("div"),this.el.className="jw-icon jw-icon-tooltip "+a+" jw-button-color jw-reset jw-hidden",this.container=document.createElement("div"),this.container.className="jw-overlay jw-reset",this.openClass="jw-open",this.componentType="tooltip",this.el.appendChild(this.container)},addContent:function(a){this.content&&this.removeContent(),this.content=a,this.container.appendChild(a)},removeContent:function(){this.content&&(this.container.removeChild(this.content),this.content=null)},hasContent:function(){return!!this.content},element:function(){return this.el},openTooltip:function(a){this.trigger("open-"+this.componentType,a,{isOpen:!0}),this.isOpen=!0,b.toggleClass(this.el,this.openClass,this.isOpen)},closeTooltip:function(a){this.trigger("close-"+this.componentType,a,{isOpen:!1}),this.isOpen=!1,b.toggleClass(this.el,this.openClass,this.isOpen)},toggleOpenState:function(a){this.isOpen?this.closeTooltip(a):this.openTooltip(a)}});return c}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(45),c(111)],e=function(a,b,c){function d(a,b){this.time=a,this.text=b,this.el=document.createElement("div"),this.el.className="jw-cue jw-reset"}a.extend(d.prototype,{align:function(a){"%"===this.time.toString().slice(-1)?this.pct=this.time:this.pct=this.time/a*100,this.el.style.left=this.pct+"%"}});var e={loadChapters:function(a){b.ajax(a,this.chaptersLoaded.bind(this),this.chaptersFailed,!0)},chaptersLoaded:function(b){var d=c(b.responseText);a.isArray(d)&&(a.each(d,this.addCue,this),this.drawCues())},chaptersFailed:function(){},addCue:function(a){this.cues.push(new d(a.begin,a.text))},drawCues:function(){var b=this._model.mediaModel.get("duration");if(!b||0>=b)return void this._model.mediaModel.once("change:duration",this.drawCues,this);var c=this;a.each(this.cues,function(a){a.align(b),a.el.addEventListener("mouseover",function(){c.activeCue=a}),a.el.addEventListener("mouseout",function(){c.activeCue=null}),c.elementRail.appendChild(a.el)})},resetChapters:function(){a.each(this.cues,function(a){a.el.parentNode&&a.el.parentNode.removeChild(a.el)},this),this.cues=[]}};return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(45),c(111)],e=function(a,b,c){function d(a){this.begin=a.begin,this.end=a.end,this.img=a.text}var e={loadThumbnails:function(a){a&&(this.vttPath=a.split("?")[0].split("/").slice(0,-1).join("/"),this.individualImage=null,b.ajax(a,this.thumbnailsLoaded.bind(this),this.thumbnailsFailed.bind(this),!0))},thumbnailsLoaded:function(b){var e=c(b.responseText);a.isArray(e)&&(a.each(e,function(a){this.thumbnails.push(new d(a))},this),this.drawCues())},thumbnailsFailed:function(){},chooseThumbnail:function(b){var c=a.sortedIndex(this.thumbnails,{end:b},a.property("end"));c>=this.thumbnails.length&&(c=this.thumbnails.length-1);var d=this.thumbnails[c].img;return d.indexOf("://")<0&&(d=this.vttPath?this.vttPath+"/"+d:d),d},loadThumbnail:function(b){var c=this.chooseThumbnail(b),d={display:"block",margin:"0 auto",backgroundPosition:"0 0"},e=c.indexOf("#xywh");if(e>0)try{var f=/(.+)\#xywh=(\d+),(\d+),(\d+),(\d+)/.exec(c);c=f[1],d.backgroundPosition=-1*f[2]+"px "+-1*f[3]+"px",d.width=f[4],d.height=f[5]}catch(g){return}else this.individualImage||(this.individualImage=new Image,this.individualImage.onload=a.bind(function(){this.individualImage.onload=null,this.timeTip.image({width:this.individualImage.width,height:this.individualImage.height})},this),this.individualImage.src=c);return d.backgroundImage=c,d},showThumbnail:function(a){this.thumbnails.length<1||this.timeTip.image(this.loadThumbnail(a))},resetThumbnails:function(){this.timeTip.image({backgroundImage:"",width:0,height:0}),this.thumbnails=[]}};return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(137),c(45),c(47),c(117),c(141)],e=function(a,b,c,d,e){var f=a.extend({setup:function(a,f,g){this.iconUI||(this.iconUI=new d(this.el,{useHover:!0,directSelect:!0}),this.toggleValueListener=this.toggleValue.bind(this),this.toggleOpenStateListener=this.toggleOpenState.bind(this),this.openTooltipListener=this.openTooltip.bind(this),this.closeTooltipListener=this.closeTooltip.bind(this),this.selectListener=this.select.bind(this)),this.reset(),a=c.isArray(a)?a:[],b.toggleClass(this.el,"jw-hidden",a.length<2);var h=a.length>2||2===a.length&&g&&g.toggle===!1,i=!h&&2===a.length;if(b.toggleClass(this.el,"jw-toggle",i),b.toggleClass(this.el,"jw-button-color",!i),this.isActive=h||i,h){b.removeClass(this.el,"jw-off"),this.iconUI.on("tap",this.toggleOpenStateListener).on("over",this.openTooltipListener).on("out",this.closeTooltipListener);var j=e(a),k=b.createElement(j);this.addContent(k),this.contentUI=new d(this.content).on("click tap",this.selectListener)}else i&&this.iconUI.on("click tap",this.toggleValueListener);this.selectItem(f)},toggleValue:function(){this.trigger("toggleValue")},select:function(a){if(a.target.parentElement===this.content){var d=b.classList(a.target),e=c.find(d,function(a){return 0===a.indexOf("jw-item")});e&&(this.trigger("select",parseInt(e.split("-")[2])),this.closeTooltipListener())}},selectItem:function(a){if(this.content)for(var c=0;c<this.content.children.length;c++)b.toggleClass(this.content.children[c],"jw-active-option",a===c);else b.toggleClass(this.el,"jw-off",0===a)},reset:function(){b.addClass(this.el,"jw-off"),this.iconUI.off(),this.contentUI&&this.contentUI.off().destroy(),this.removeContent()}});return f}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({1:function(a,b,c,d){var e=this.lambda,f=this.escapeExpression;return"        <li class='jw-text jw-option jw-item-"+f(e(d&&d.index,a))+" jw-reset'>"+f(e(null!=a?a.label:a,a))+"</li>\n"},compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){var e,f='<ul class="jw-menu jw-background-color jw-reset">\n';return e=b.each.call(a,a,{name:"each",hash:{},fn:this.program(1,d),inverse:this.noop,data:d}),null!=e&&(f+=e),f+"</ul>"},useData:!0})},function(a,b,c){var d,e;d=[c(45),c(47),c(137),c(117),c(143)],e=function(a,b,c,d,e){var f=c.extend({setup:function(c,e){if(this.iconUI||(this.iconUI=new d(this.el,{useHover:!0}),this.toggleOpenStateListener=this.toggleOpenState.bind(this),this.openTooltipListener=this.openTooltip.bind(this),this.closeTooltipListener=this.closeTooltip.bind(this),this.selectListener=this.onSelect.bind(this)),this.reset(),c=b.isArray(c)?c:[],a.toggleClass(this.el,"jw-hidden",c.length<2),c.length>=2){this.iconUI=new d(this.el,{useHover:!0}).on("tap",this.toggleOpenStateListener).on("over",this.openTooltipListener).on("out",this.closeTooltipListener);var f=this.menuTemplate(c,e),g=a.createElement(f);this.addContent(g),this.contentUI=new d(this.content),this.contentUI.on("click tap",this.selectListener)}this.originalList=c},menuTemplate:function(a,c){var d=b.map(a,function(a,b){return{active:b===c,label:b+1+".",title:a.title}});return e(d)},onSelect:function(c){var d=c.target;if("UL"!==d.tagName){"LI"!==d.tagName&&(d=d.parentElement);var e=a.classList(d),f=b.find(e,function(a){return 0===a.indexOf("jw-item")});f&&(this.trigger("select",parseInt(f.split("-")[2])),this.closeTooltip())}},selectItem:function(a){this.setup(this.originalList,a)},reset:function(){this.iconUI.off(),this.contentUI&&this.contentUI.off().destroy(),this.removeContent()}});return f}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({1:function(a,b,c,d){var e,f="";return e=b["if"].call(a,null!=a?a.active:a,{name:"if",hash:{},fn:this.program(2,d),inverse:this.program(4,d),data:d}),null!=e&&(f+=e),f},2:function(a,b,c,d){var e=this.lambda,f=this.escapeExpression;return"                <li class='jw-option jw-text jw-active-option jw-item-"+f(e(d&&d.index,a))+' jw-reset\'>\n                    <span class="jw-label jw-reset"><span class="jw-icon jw-icon-play jw-reset"></span></span>\n                    <span class="jw-name jw-reset">'+f(e(null!=a?a.title:a,a))+"</span>\n                </li>\n"},4:function(a,b,c,d){var e=this.lambda,f=this.escapeExpression;return"                <li class='jw-option jw-text jw-item-"+f(e(d&&d.index,a))+' jw-reset\'>\n                    <span class="jw-label jw-reset">'+f(e(null!=a?a.label:a,a))+'</span>\n                    <span class="jw-name jw-reset">'+f(e(null!=a?a.title:a,a))+"</span>\n                </li>\n"},compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){var e,f='<div class="jw-menu jw-playlist-container jw-background-color jw-reset">\n\n    <div class="jw-tooltip-title jw-reset">\n        <span class="jw-icon jw-icon-inline jw-icon-playlist jw-reset"></span>\n        <span class="jw-text jw-reset">PLAYLIST</span>\n    </div>\n\n    <ul class="jw-playlist jw-reset">\n';return e=b.each.call(a,a,{name:"each",hash:{},fn:this.program(1,d),inverse:this.noop,data:d}),null!=e&&(f+=e),f+"    </ul>\n</div>"},useData:!0})},function(a,b,c){var d,e;d=[c(137),c(134),c(117),c(45)],e=function(a,b,c,d){var e=a.extend({constructor:function(e,f){this._model=e,a.call(this,f),this.volumeSlider=new b("jw-slider-volume jw-volume-tip","vertical"),this.addContent(this.volumeSlider.element()),this.volumeSlider.on("update",function(a){this.trigger("update",a)},this),d.removeClass(this.el,"jw-hidden"),new c(this.el,{useHover:!0,directSelect:!0}).on("click",this.toggleValue,this).on("tap",this.toggleOpenState,this).on("over",this.openTooltip,this).on("out",this.closeTooltip,this),this._model.on("change:volume",this.onVolume,this)},toggleValue:function(){this.trigger("toggleValue")}});return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(137),c(45),c(47),c(117)],e=function(a,b,c,d){var e=a.extend({constructor:function(b){a.call(this,b),this.container.className="jw-overlay-horizontal jw-reset",this.openClass="jw-open-drawer",this.componentType="drawer"},setup:function(a,e){this.iconUI||(this.iconUI=new d(this.el,{useHover:!0,directSelect:!0}),this.toggleOpenStateListener=this.toggleOpenState.bind(this),this.openTooltipListener=this.openTooltip.bind(this),this.closeTooltipListener=this.closeTooltip.bind(this)),this.reset(),a=c.isArray(a)?a:[],this.activeContents=c.filter(a,function(a){return a.isActive}),b.toggleClass(this.el,"jw-hidden",!e||this.activeContents.length<2),e&&this.activeContents.length>1&&(b.removeClass(this.el,"jw-off"),this.iconUI.on("tap",this.toggleOpenStateListener).on("over",this.openTooltipListener).on("out",this.closeTooltipListener),c.each(a,function(a){this.container.appendChild(a.el)},this))},reset:function(){b.addClass(this.el,"jw-off"),this.iconUI.off(),this.contentUI&&this.contentUI.off().destroy(),this.removeContent()}});return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47)],e=function(a){var b=function(a){this.model=a,this.model.on("change:playlistItem",this.loadImage,this)};return a.extend(b.prototype,{setup:function(a){this.el=a,this.loadImage(this.model,this.model.get("playlistItem"))},loadImage:function(b,c){var d=c.image;a.isString(d)?(d=encodeURI(d),this.el.style.backgroundImage='url("'+d+'")'):this.el.style.backgroundImage=""},element:function(){return this.el}}),b}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(71),c(148),c(47),c(58)],e=function(a,b,c,d){function e(a){return a.charAt(0).toUpperCase()+a.slice(1)}function f(a){return"pro"===a?"p":"premium"===a?"r":"enterprise"===a?"e":"ads"===a?"a":"f"}var g=function(){};return c.extend(g.prototype,b.prototype,{buildArray:function(){var c=b.prototype.buildArray.apply(this,arguments),g=this.model.get("edition"),h=d.split("+")[0],i="//jwplayer.com/learn-more/?m=h&e="+f(g)+"&v="+d;c.items[0].link=i,c.items[0].title="About JW Player "+e(g)+" "+h;var j=a(g);if(!j("custom-rightclick"))return c;if(this.model.get("abouttext")){var k={title:this.model.get("abouttext"),link:this.model.get("aboutlink")||i};c.items.splice(1,0,k)}return c}}),g}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(149),c(47),c(58)],e=function(a,b,c,d){var e=function(){};return c.extend(e.prototype,{buildArray:function(){var b=d.split("+"),c=b[0],e={items:[{title:"About JW Player "+c,featured:!0,link:"//jwplayer.com/learn-more/?m=h&e=o&v="+d}]},f=c.indexOf("-")>0,g=b[1];if(f&&g){var h=g.split(".");e.items.push({title:"build: ("+h[0]+"."+h[1]+")",link:"#"})}var i=this.model.get("provider").name;if(i.indexOf("flash")>=0){var j="Flash Version "+a.flashVersion();e.items.push({title:j,link:"http://www.adobe.com/software/flash/about/"})}return e},buildMenu:function(){var c=this.buildArray();return a.createElement(b(c))},updateHtml:function(){this.el.innerHTML=this.buildMenu().innerHTML},rightClick:function(a){return this.lazySetup(),this.mouseOverContext?!1:(this.hideMenu(),this.showMenu(a),!1)},getOffset:function(a){for(var b=a.target,c=a.offsetX||a.layerX,d=a.offsetY||a.layerY;b!==this.playerElement;)c+=b.offsetLeft,d+=b.offsetTop,b=b.parentNode;return{x:c,y:d}},showMenu:function(b){var c=this.getOffset(b);return this.el.style.left=c.x+"px",this.el.style.top=c.y+"px",a.addClass(this.playerElement,"jw-flag-rightclick-open"),a.addClass(this.el,"jw-open"),!1},hideMenu:function(){this.mouseOverContext||(a.removeClass(this.playerElement,"jw-flag-rightclick-open"),a.removeClass(this.el,"jw-open"))},lazySetup:function(){this.el||(this.el=this.buildMenu(),this.layer.appendChild(this.el),this.hideMenuCallback=this.hideMenu.bind(this),this.playerElement.onclick=this.hideMenuCallback,document.addEventListener("mousedown",this.hideMenuCallback,!1),this.model.on("change:provider",this.updateHtml,this),this.el.onmouseover=function(){this.mouseOverContext=!0}.bind(this),this.el.onmouseout=function(){this.mouseOverContext=!1}.bind(this))},setup:function(a,b,c){this.playerElement=b,this.model=a,this.mouseOverContext=!1,this.layer=c,b.oncontextmenu=this.rightClick.bind(this)},destroy:function(){this.el&&this.hideMenu(),this.playerElement&&(this.playerElement.oncontextmenu=null),this.model&&(this.model.off("change:provider",this.updateHtml),this.model=null)}}),e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({1:function(a,b,c,d){var e,f,g="function",h=b.helperMissing,i=this.escapeExpression,j='        <li class="jw-reset';return e=b["if"].call(a,null!=a?a.featured:a,{name:"if",hash:{},fn:this.program(2,d),inverse:this.noop,data:d}),null!=e&&(j+=e),j+='">\n            <a href="'+i((f=null!=(f=b.link||(null!=a?a.link:a))?f:h,typeof f===g?f.call(a,{name:"link",hash:{},data:d}):f))+'" class="jw-reset" target="_top">\n',e=b["if"].call(a,null!=a?a.featured:a,{name:"if",hash:{},fn:this.program(4,d),inverse:this.noop,data:d}),null!=e&&(j+=e),j+"                "+i((f=null!=(f=b.title||(null!=a?a.title:a))?f:h,typeof f===g?f.call(a,{name:"title",hash:{},data:d}):f))+"\n            </a>\n        </li>\n"},2:function(a,b,c,d){return" jw-featured"},4:function(a,b,c,d){return'                <span class="jw-icon jw-rightclick-logo jw-reset"></span>\n'},compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){var e,f='<div class="jw-rightclick jw-reset">\n    <ul class="jw-reset">\n';return e=b.each.call(a,null!=a?a.items:a,{name:"each",hash:{},fn:this.program(1,d),inverse:this.noop,data:d}),null!=e&&(f+=e),f+"    </ul>\n</div>"},useData:!0})},function(a,b,c){var d,e;d=[c(47)],e=function(a){var b=function(a){this.model=a};return a.extend(b.prototype,{hide:function(){this.el.style.display="none"},show:function(){this.el.style.display=""},setup:function(a){this.el=a;var b=this.el.getElementsByTagName("div");this.title=b[0],this.description=b[1],this.model.on("change:playlistItem",this.playlistItem,this),this.playlistItem(this.model,this.model.get("playlistItem"))},playlistItem:function(a,b){a.get("displaytitle")||a.get("displaydescription")?this.updateText(a,b):this.hide()},updateText:function(a,b){this.title.innerHTML=b.title&&a.get("displaytitle")?b.title:"",this.description.innerHTML=b.description&&a.get("displaydescription")?b.description:"",this.title.firstChild||this.description.firstChild?this.show():this.hide()},element:function(){return this.el}}),b}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){var e,f="function",g=b.helperMissing,h=this.escapeExpression;return'<div id="'+h((e=null!=(e=b.id||(null!=a?a.id:a))?e:g,typeof e===f?e.call(a,{name:"id",hash:{},data:d}):e))+'" class="jwplayer jw-reset" tabindex="0">\n    <div class="jw-aspect jw-reset"></div>\n    <div class="jw-media jw-reset"></div>\n    <div class="jw-preview jw-reset"></div>\n    <div class="jw-title jw-reset">\n        <div class="jw-title-primary jw-reset"></div>\n        <div class="jw-title-secondary jw-reset"></div>\n    </div>\n    <div class="jw-overlays jw-reset"></div>\n    <div class="jw-controls jw-reset"></div>\n</div>'},useData:!0})},function(a,b,c){var d,e;d=[c(45),c(66),c(117),c(63),c(47),c(153)],e=function(a,b,c,d,e,f){var g=function(a){this.model=a,this.setup()};return e.extend(g.prototype,d,{setup:function(){this.destroy(),this.skipMessage=this.model.get("skipText"),this.skipMessageCountdown=this.model.get("skipMessage"),this.setWaitTime(this.model.get("skipOffset"));var b=f();this.el=a.createElement(b),this.skiptext=this.el.getElementsByClassName("jw-skiptext")[0],this.skipAdOnce=e.once(this.skipAd.bind(this)),new c(this.el).on("click tap",e.bind(function(){this.skippable&&this.skipAdOnce()},this)),this.model.on("change:duration",this.onChangeDuration,this),this.model.on("change:position",this.onChangePosition,this),this.onChangeDuration(this.model,this.model.get("duration")),this.onChangePosition(this.model,this.model.get("position"))},updateMessage:function(a){this.skiptext.innerHTML=a},updateCountdown:function(a){this.updateMessage(this.skipMessageCountdown.replace(/xx/gi,Math.ceil(this.waitTime-a)))},onChangeDuration:function(b,c){if(c){if(this.waitPercentage){if(!c)return;this.itemDuration=c,this.setWaitTime(this.waitPercentage),delete this.waitPercentage}a.removeClass(this.el,"jw-hidden")}},onChangePosition:function(b,c){this.waitTime-c>0?this.updateCountdown(c):(this.updateMessage(this.skipMessage),this.skippable=!0,a.addClass(this.el,"jw-skippable"))},element:function(){return this.el},setWaitTime:function(b){if(e.isString(b)&&"%"===b.slice(-1)){var c=parseFloat(b);return void(this.itemDuration&&!isNaN(c)?this.waitTime=this.itemDuration*c/100:this.waitPercentage=b)}e.isNumber(b)?this.waitTime=b:"string"===a.typeOf(b)?this.waitTime=a.seconds(b):isNaN(Number(b))?this.waitTime=0:this.waitTime=Number(b)},skipAd:function(){this.trigger(b.JWPLAYER_AD_SKIPPED)},destroy:function(){this.el&&(this.el.removeEventListener("click",this.skipAdOnce),this.el.parentElement&&this.el.parentElement.removeChild(this.el)),delete this.skippable,delete this.itemDuration,delete this.waitPercentage}}),g}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){return'<div class="jw-skip jw-background-color jw-hidden jw-reset">\n    <span class="jw-text jw-skiptext jw-reset"></span>\n    <span class="jw-icon-inline jw-skip-icon jw-reset"></span>\n</div>';
},useData:!0})},function(a,b,c){var d,e;d=[c(155)],e=function(a){function b(b,c,d,e){return a({id:b,skin:c,title:d,body:e})}return b}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){var e,f="function",g=b.helperMissing,h=this.escapeExpression;return'<div id="'+h((e=null!=(e=b.id||(null!=a?a.id:a))?e:g,typeof e===f?e.call(a,{name:"id",hash:{},data:d}):e))+'"class="jw-skin-'+h((e=null!=(e=b.skin||(null!=a?a.skin:a))?e:g,typeof e===f?e.call(a,{name:"skin",hash:{},data:d}):e))+' jw-error jw-reset">\n    <div class="jw-title jw-reset">\n        <div class="jw-title-primary jw-reset">'+h((e=null!=(e=b.title||(null!=a?a.title:a))?e:g,typeof e===f?e.call(a,{name:"title",hash:{},data:d}):e))+'</div>\n        <div class="jw-title-secondary jw-reset">'+h((e=null!=(e=b.body||(null!=a?a.body:a))?e:g,typeof e===f?e.call(a,{name:"body",hash:{},data:d}):e))+'</div>\n    </div>\n\n    <div class="jw-icon-container jw-reset">\n        <div class="jw-display-icon-container jw-background-color jw-reset">\n            <div class="jw-icon jw-icon-display jw-reset"></div>\n        </div>\n    </div>\n</div>\n'},useData:!0})},,,,function(a,b,c){var d,e;d=[],e=function(){var a=window.chrome,b={};return b.NS="urn:x-cast:com.longtailvideo.jwplayer",b.debug=!1,b.availability=null,b.available=function(c){c=c||b.availability;var d="available";return a&&a.cast&&a.cast.ReceiverAvailability&&(d=a.cast.ReceiverAvailability.AVAILABLE),c===d},b.log=function(){if(b.debug){var a=Array.prototype.slice.call(arguments,0);console.log.apply(console,a)}},b.error=function(){var a=Array.prototype.slice.call(arguments,0);console.error.apply(console,a)},b}.apply(b,d),!(void 0!==e&&(a.exports=e))},,,function(a,b,c){var d,e;d=[c(93),c(47)],e=function(a,b){return function(c,d){var e=["seek","skipAd","stop","playlistNext","playlistPrev","playlistItem","resize","addButton","removeButton","registerPlugin","attachMedia"];b.each(e,function(a){c[a]=function(){return d[a].apply(d,arguments),c}}),c.registerPlugin=a.registerPlugin}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47)],e=function(a){return function(b,c){var d=["buffer","controls","position","duration","fullscreen","volume","mute","item","stretching","playlist"];a.each(d,function(a){var d=a.slice(0,1).toUpperCase()+a.slice(1);b["get"+d]=function(){return c._model.get(a)}});var e=["getAudioTracks","getCaptionsList","getWidth","getHeight","getCurrentAudioTrack","setCurrentAudioTrack","getCurrentCaptions","setCurrentCaptions","getCurrentQuality","setCurrentQuality","getQualityLevels","getVisualQuality","getConfig","getState","getSafeRegion","isBeforeComplete","isBeforePlay","getProvider","detachMedia"],f=["setControls","setFullscreen","setVolume","setMute","setCues"];a.each(e,function(a){b[a]=function(){return c[a]?c[a].apply(c,arguments):null}}),a.each(f,function(a){b[a]=function(){return c[a].apply(c,arguments),b}})}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(66)],e=function(a,b){return function(c){var d={onBufferChange:b.JWPLAYER_MEDIA_BUFFER,onBufferFull:b.JWPLAYER_MEDIA_BUFFER_FULL,onError:b.JWPLAYER_ERROR,onSetupError:b.JWPLAYER_SETUP_ERROR,onFullscreen:b.JWPLAYER_FULLSCREEN,onMeta:b.JWPLAYER_MEDIA_META,onMute:b.JWPLAYER_MEDIA_MUTE,onPlaylist:b.JWPLAYER_PLAYLIST_LOADED,onPlaylistItem:b.JWPLAYER_PLAYLIST_ITEM,onPlaylistComplete:b.JWPLAYER_PLAYLIST_COMPLETE,onReady:b.JWPLAYER_READY,onResize:b.JWPLAYER_RESIZE,onComplete:b.JWPLAYER_MEDIA_COMPLETE,onSeek:b.JWPLAYER_MEDIA_SEEK,onTime:b.JWPLAYER_MEDIA_TIME,onVolume:b.JWPLAYER_MEDIA_VOLUME,onBeforePlay:b.JWPLAYER_MEDIA_BEFOREPLAY,onBeforeComplete:b.JWPLAYER_MEDIA_BEFORECOMPLETE,onDisplayClick:b.JWPLAYER_DISPLAY_CLICK,onControls:b.JWPLAYER_CONTROLS,onQualityLevels:b.JWPLAYER_MEDIA_LEVELS,onQualityChange:b.JWPLAYER_MEDIA_LEVEL_CHANGED,onCaptionsList:b.JWPLAYER_CAPTIONS_LIST,onCaptionsChange:b.JWPLAYER_CAPTIONS_CHANGED,onAdError:b.JWPLAYER_AD_ERROR,onAdClick:b.JWPLAYER_AD_CLICK,onAdImpression:b.JWPLAYER_AD_IMPRESSION,onAdTime:b.JWPLAYER_AD_TIME,onAdComplete:b.JWPLAYER_AD_COMPLETE,onAdCompanions:b.JWPLAYER_AD_COMPANIONS,onAdSkipped:b.JWPLAYER_AD_SKIPPED,onAdPlay:b.JWPLAYER_AD_PLAY,onAdPause:b.JWPLAYER_AD_PAUSE,onAdMeta:b.JWPLAYER_AD_META,onCast:b.JWPLAYER_CAST_SESSION,onAudioTrackChange:b.JWPLAYER_AUDIO_TRACK_CHANGED,onAudioTracks:b.JWPLAYER_AUDIO_TRACKS},e={onBuffer:"buffer",onPause:"pause",onPlay:"play",onIdle:"idle"};a.each(e,function(b,d){c[d]=a.partial(c.on,b,a)}),a.each(d,function(b,d){c[d]=a.partial(c.on,b,a)})}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(166);"string"==typeof d&&(d=[[a.id,d,""]]);c(170)(d,{});d.locals&&(a.exports=d.locals)},function(a,b,c){b=a.exports=c(167)(),b.push([a.id,".jw-reset{color:inherit;background-color:transparent;padding:0;margin:0;float:none;font-family:Arial,Helvetica,sans-serif;font-size:1em;line-height:1em;list-style:none;text-align:left;text-transform:none;vertical-align:baseline;border:0;direction:ltr;font-variant:inherit;font-stretch:inherit;-webkit-tap-highlight-color:rgba(255,255,255,0)}@font-face{font-family:'jw-icons';src:url("+c(168)+") format('woff'),url("+c(169)+') format(\'truetype\');font-weight:normal;font-style:normal}.jw-icon-inline,.jw-icon-tooltip,.jw-icon-display,.jw-controlbar .jw-menu .jw-option:before{font-family:\'jw-icons\';-webkit-font-smoothing:antialiased;font-style:normal;font-weight:normal;text-transform:none;background-color:transparent;font-variant:normal;-webkit-font-feature-settings:"liga";-ms-font-feature-settings:"liga" 1;-o-font-feature-settings:"liga";font-feature-settings:"liga";-moz-osx-font-smoothing:grayscale}.jw-icon-audio-tracks:before{content:"\\E600"}.jw-icon-buffer:before{content:"\\E601"}.jw-icon-cast:before{content:"\\E603"}.jw-icon-cast.jw-off:before{content:"\\E602"}.jw-icon-cc:before{content:"\\E605"}.jw-icon-cue:before{content:"\\E606"}.jw-icon-menu-bullet:before{content:"\\E606"}.jw-icon-error:before{content:"\\E607"}.jw-icon-fullscreen:before{content:"\\E608"}.jw-icon-fullscreen.jw-off:before{content:"\\E613"}.jw-icon-hd:before{content:"\\E60A"}.jw-rightclick-logo:before{content:"\\E60B"}.jw-icon-next:before{content:"\\E60C"}.jw-icon-pause:before{content:"\\E60D"}.jw-icon-play:before{content:"\\E60E"}.jw-icon-prev:before{content:"\\E60F"}.jw-icon-replay:before{content:"\\E610"}.jw-icon-volume:before{content:"\\E612"}.jw-icon-volume.jw-off:before{content:"\\E611"}.jw-icon-more:before{content:"\\E614"}.jw-icon-close:before{content:"\\E615"}.jw-icon-playlist:before{content:"\\E616"}.jwplayer{width:100%;font-size:16px;position:relative;display:block;min-height:0;overflow:hidden;box-sizing:border-box;font-family:Arial,Helvetica,sans-serif;background-color:#000;-webkit-touch-callout:none;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.jwplayer *{box-sizing:inherit}.jwplayer.jw-flag-aspect-mode{height:auto !important}.jwplayer.jw-flag-aspect-mode .jw-aspect{display:block}.jwplayer .jw-aspect{display:none}.jwplayer:focus,.jwplayer .jw-swf{outline:none}.jwplayer:hover .jw-display-icon-container{background-color:#333;background:#333;background-size:#333}.jw-media,.jw-preview,.jw-overlays,.jw-controls{position:absolute;width:100%;height:100%;top:0;left:0;bottom:0;right:0}.jw-media{overflow:hidden;cursor:pointer}.jw-media.jw-media-show{visibility:visible;opacity:1}.jw-media video{position:absolute;top:0;right:0;bottom:0;left:0;width:100%;height:100%;margin:auto;background:transparent}.jw-media video::-webkit-media-controls-start-playback-button{display:none}.jw-controls.jw-controls-disabled{display:none}.jw-controls .jw-controls-right{position:absolute;top:0;right:0}.jw-text{height:1em;font-family:Arial,Helvetica,sans-serif;font-size:.75em;font-style:normal;font-weight:normal;color:white;text-align:center;font-variant:normal;font-stretch:normal}.jw-plugin{position:absolute}.jw-cast-screen{width:100%;height:100%}.jw-instream{position:absolute;top:0;right:0;bottom:0;left:0;display:none}.jw-icon-playback:before{content:"\\E60E"}.jw-tab-focus:focus{outline:solid 2px #0b7ef4}.jw-preview,.jw-captions,.jw-title,.jw-overlays,.jw-controls{pointer-events:none}.jw-overlays>div,.jw-media,.jw-controlbar,.jw-dock,.jw-logo,.jw-skip,.jw-display-icon-container{pointer-events:all}.jw-click{position:absolute;width:100%;height:100%}.jw-preview{position:absolute;display:none;opacity:1;visibility:visible;width:100%;height:100%;background:#000 no-repeat 50% 50%}.jwplayer .jw-preview,.jw-error .jw-preview,.jw-stretch-uniform .jw-preview{background-size:contain}.jw-stretch-none .jw-preview{background-size:auto auto}.jw-stretch-fill .jw-preview{background-size:cover}.jw-stretch-exactfit .jw-preview{background-size:100% 100%}.jw-display-icon-container{position:relative;top:50%;display:table;height:3.5em;width:3.5em;margin:-1.75em auto 0;cursor:pointer}.jw-display-icon-container .jw-icon-display{position:relative;display:table-cell;text-align:center;vertical-align:middle !important;background-position:50% 50%;background-repeat:no-repeat;font-size:2em}.jw-flag-audio-player .jw-display-icon-container,.jw-flag-dragging .jw-display-icon-container{display:none}.jw-icon{font-family:\'jw-icons\';-webkit-font-smoothing:antialiased;font-style:normal;font-weight:normal;text-transform:none;background-color:transparent;font-variant:normal;-webkit-font-feature-settings:"liga";-ms-font-feature-settings:"liga" 1;-o-font-feature-settings:"liga";font-feature-settings:"liga";-moz-osx-font-smoothing:grayscale}.jw-controlbar{display:table;position:absolute;right:0;left:0;bottom:0;height:2em;padding:0 .25em}.jw-controlbar .jw-hidden{display:none}.jw-controlbar.jw-drawer-expanded .jw-controlbar-left-group,.jw-controlbar.jw-drawer-expanded .jw-controlbar-center-group{opacity:0}.jw-background-color{background-color:#414040}.jw-group{display:table-cell}.jw-controlbar-center-group{width:100%;padding:0 .25em}.jw-controlbar-center-group .jw-slider-time,.jw-controlbar-center-group .jw-text-alt{padding:0}.jw-controlbar-center-group .jw-text-alt{display:none}.jw-controlbar-left-group,.jw-controlbar-right-group{white-space:nowrap}.jw-knob:hover,.jw-icon-inline:hover,.jw-icon-tooltip:hover,.jw-icon-display:hover,.jw-option:before:hover{color:#eee}.jw-icon-inline,.jw-icon-tooltip,.jw-slider-horizontal,.jw-text-elapsed,.jw-text-duration{display:inline-block;height:2em;position:relative;line-height:2em;vertical-align:middle;cursor:pointer}.jw-icon-inline,.jw-icon-tooltip{min-width:1.25em;text-align:center}.jw-icon-playback{min-width:2.25em}.jw-icon-volume{min-width:1.75em;text-align:left}.jw-time-tip{line-height:1em}.jw-icon-inline:after,.jw-icon-tooltip:after{width:100%;height:100%;font-size:1em}.jw-icon-cast{display:none}.jw-slider-volume.jw-slider-horizontal,.jw-icon-inline.jw-icon-volume{display:none}.jw-dock{margin:.75em;display:block;opacity:1;clear:right}.jw-dock:after{content:\'\';clear:both;display:block}.jw-dock-button{cursor:pointer;float:right;position:relative;width:2.5em;height:2.5em;margin:.5em}.jw-dock-button .jw-arrow{display:none;position:absolute;bottom:-0.2em;width:.5em;height:.2em;left:50%;margin-left:-0.25em}.jw-dock-button .jw-overlay{display:none;position:absolute;top:2.5em;right:0;margin-top:.25em;padding:.5em;white-space:nowrap}.jw-dock-button:hover .jw-overlay,.jw-dock-button:hover .jw-arrow{display:block}.jw-dock-image{width:100%;height:100%;background-position:50% 50%;background-repeat:no-repeat;opacity:.75}.jw-title{display:none;position:absolute;top:0;width:100%;font-size:.875em;height:8em;background:-webkit-linear-gradient(top, #000 0, #000 18%, rgba(0,0,0,0) 100%);background:linear-gradient(to bottom, #000 0, #000 18%, rgba(0,0,0,0) 100%)}.jw-title-primary,.jw-title-secondary{padding:.75em 1.5em;min-height:2.5em;width:75%;color:white;white-space:nowrap;text-overflow:ellipsis;overflow-x:hidden}.jw-title-primary{font-weight:bold}.jw-title-secondary{margin-top:-0.5em}.jw-slider-container{display:inline-block;height:1em;position:relative;-ms-touch-action:none;touch-action:none}.jw-rail,.jw-buffer,.jw-progress{position:absolute;cursor:pointer}.jw-progress{background-color:#fff}.jw-rail{background-color:#aaa}.jw-buffer{background-color:#202020}.jw-cue,.jw-knob{position:absolute;cursor:pointer}.jw-cue{background-color:#fff;width:.1em;height:.4em}.jw-knob{background-color:#aaa;width:.4em;height:.4em}.jw-slider-horizontal{width:4em;height:1em}.jw-slider-horizontal.jw-slider-volume{margin-right:5px}.jw-slider-horizontal .jw-rail,.jw-slider-horizontal .jw-buffer,.jw-slider-horizontal .jw-progress{width:100%;height:.4em}.jw-slider-horizontal .jw-progress,.jw-slider-horizontal .jw-buffer{width:0}.jw-slider-horizontal .jw-rail,.jw-slider-horizontal .jw-progress,.jw-slider-horizontal .jw-slider-container{width:100%}.jw-slider-horizontal .jw-knob{left:0;margin-left:-0.325em}.jw-slider-vertical{width:.75em;height:4em;bottom:0;position:absolute;padding:1em}.jw-slider-vertical .jw-rail,.jw-slider-vertical .jw-buffer,.jw-slider-vertical .jw-progress{bottom:0;height:100%}.jw-slider-vertical .jw-progress,.jw-slider-vertical .jw-buffer{height:0}.jw-slider-vertical .jw-slider-container,.jw-slider-vertical .jw-rail,.jw-slider-vertical .jw-progress{bottom:0;width:.75em;height:100%;left:0;right:0;margin:0 auto}.jw-slider-vertical .jw-slider-container{height:4em;position:relative}.jw-slider-vertical .jw-knob{bottom:0;left:0;right:0;margin:0 auto}.jw-slider-time{right:0;left:0;width:100%}.jw-tooltip-time{position:absolute}.jw-slider-volume .jw-buffer{display:none}.jw-captions{position:absolute;display:none;margin:0 auto;width:100%;left:0;bottom:1.75em;right:0;max-width:90%;text-align:center}.jw-captions.jw-captions-enabled{display:block}.jw-captions-window{display:none;padding:.25em;border-radius:.25em}.jw-captions-window.jw-captions-window-active{display:inline-block}.jw-captions-text{display:inline-block;color:white;background-color:black;word-wrap:break-word;white-space:pre-line;font-style:normal;font-weight:normal;text-align:center;text-decoration:none;line-height:1.3em;padding:.1em .8em}.jw-rightclick{display:none}.jw-rightclick.jw-open{display:block}.jw-rightclick{position:absolute;white-space:nowrap}.jw-rightclick ul{list-style:none;font-weight:bold;border-radius:.15em;margin:0;border:1px solid #d9dde6;padding-left:0}.jw-rightclick .jw-rightclick-logo{font-size:2em;color:#ff0147;vertical-align:middle;padding-right:.3em;margin-right:.3em;border-right:1px solid #d9dde6}.jw-rightclick a{color:#000;text-decoration:none;padding:1em;display:block;font-size:.6875em}.jw-rightclick li{background-color:#f2f3f6;border-bottom:1px solid #d9dde6}.jw-rightclick li:last-child{border-bottom:none}.jw-rightclick li:hover a,.jw-rightclick li.jw-featured:hover{background-color:#e4e6ed;cursor:pointer;color:#ff0046}.jw-rightclick li.jw-featured{background-color:#fff;vertical-align:middle}.jw-rightclick li.jw-featured a{color:#aab4c8}.jw-logo{float:right;padding:.75em;cursor:pointer;pointer-events:all}.jw-logo .jw-flag-audio-player{display:none}.jw-watermark{position:relative;top:45%;height:100%;width:100%;text-align:center;font-size:14em;color:#eee;opacity:.33;pointer-events:none}.jw-icon-tooltip.jw-open .jw-overlay{opacity:1;visibility:visible}.jw-icon-tooltip.jw-hidden{display:none}.jw-overlay-horizontal{display:none}.jw-icon-tooltip.jw-open-drawer:before{display:none}.jw-icon-tooltip.jw-open-drawer .jw-overlay-horizontal{opacity:1;display:inline-block;vertical-align:top}.jw-overlay:before{position:absolute;top:0;bottom:0;left:-50%;width:100%;background-color:rgba(0,0,0,0);content:" "}.jw-time-tip,.jw-volume-tip,.jw-menu{position:relative;left:-50%;border:solid 1px #000;margin:0}.jw-volume-tip{width:100%;height:100%;display:block}.jw-time-tip{text-align:center;font-family:inherit;color:#aaa;bottom:1em;border:solid 4px #000}.jw-time-tip .jw-text{line-height:1em}.jw-controlbar .jw-overlay{margin:0;position:absolute;bottom:2em;left:50%;opacity:0;visibility:hidden}.jw-controlbar .jw-overlay .jw-contents{position:relative}.jw-controlbar .jw-option{position:relative;white-space:nowrap;cursor:pointer;list-style:none;height:1.5em;font-family:inherit;line-height:1.5em;color:#aaa;padding:0 .5em;font-size:.8em}.jw-controlbar .jw-option:hover,.jw-controlbar .jw-option:before:hover{color:#eee}.jw-controlbar .jw-option:before{padding-right:.125em}.jw-playlist-container ::-webkit-scrollbar-track{background-color:#333;border-radius:10px}.jw-playlist-container ::-webkit-scrollbar{width:5px;border:10px solid black;border-bottom:0;border-top:0}.jw-playlist-container ::-webkit-scrollbar-thumb{background-color:white;border-radius:5px}.jw-tooltip-title{border-bottom:1px solid #444;text-align:left;padding-left:.7em}.jw-playlist{max-height:11em;min-height:4.5em;overflow-x:hidden;overflow-y:scroll;width:calc(100% - 4px)}.jw-playlist .jw-option{height:3em;margin-right:5px;color:white;padding-left:1em;font-size:.8em}.jw-playlist .jw-label,.jw-playlist .jw-name{display:inline-block;line-height:3em;text-align:left;overflow:hidden;white-space:nowrap}.jw-playlist .jw-label{width:1em}.jw-playlist .jw-name{width:11em}.jw-skip{cursor:default;position:absolute;float:right;display:inline-block;right:.75em;bottom:3em}.jw-skip.jw-skippable{cursor:pointer}.jw-skip.jw-hidden{visibility:hidden}.jw-skip .jw-skip-icon{display:none;margin-left:-0.75em}.jw-skip .jw-skip-icon:before{content:"\\E60C"}.jw-skip .jw-text,.jw-skip .jw-skip-icon{color:#aaa;vertical-align:middle;line-height:1.5em;font-size:.7em}.jw-skip.jw-skippable:hover{cursor:pointer}.jw-skip.jw-skippable:hover .jw-text,.jw-skip.jw-skippable:hover .jw-skip-icon{color:#eee}.jw-skip.jw-skippable .jw-skip-icon{display:inline;margin:0}.jwplayer.jw-state-playing.jw-flag-casting .jw-display-icon-container,.jwplayer.jw-state-paused.jw-flag-casting .jw-display-icon-container{display:table}.jwplayer.jw-flag-casting .jw-display-icon-container{border-radius:0;top:8em;padding:2em 5em;border:1px solid white}.jwplayer.jw-flag-casting .jw-display-icon-container .jw-icon{font-size:3em}.jw-cast{position:absolute;width:100%;height:100%;background-repeat:no-repeat;background-size:auto;background-position:50% 50%}.jw-cast-label{position:absolute;left:10px;right:10px;bottom:50%;margin-bottom:100px;text-align:center}.jw-cast-name{color:#ccc}.jwplayer.jw-state-idle .jw-preview{display:block}.jwplayer.jw-state-idle .jw-icon-display:before{content:"\\E60E"}.jwplayer.jw-state-idle .jw-controlbar{display:none}.jwplayer.jw-state-idle .jw-captions{display:none}.jwplayer.jw-state-idle .jw-title{display:block}.jwplayer.jw-state-playing .jw-display-icon-container{display:none}.jwplayer.jw-state-playing .jw-display-icon-container .jw-icon-display:before{content:"\\E60D"}.jwplayer.jw-state-playing .jw-icon-playback:before{content:"\\E60D"}.jwplayer.jw-state-paused .jw-display-icon-container{display:none}.jwplayer.jw-state-paused .jw-display-icon-container .jw-icon-display:before{content:"\\E60E"}.jwplayer.jw-state-paused .jw-icon-playback:before{content:"\\E60E"}.jwplayer.jw-state-buffering .jw-display-icon-container .jw-icon-display{-webkit-animation:spin 2s linear infinite;animation:spin 2s linear infinite}.jwplayer.jw-state-buffering .jw-display-icon-container .jw-icon-display:before{content:"\\E601"}@-webkit-keyframes spin{100%{-webkit-transform:rotate(360deg)}}@keyframes spin{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}.jwplayer.jw-state-buffering .jw-display-icon-container .jw-text{display:none}.jwplayer.jw-state-buffering .jw-icon-playback:before{content:"\\E60D"}.jwplayer.jw-state-complete .jw-preview{display:block}.jwplayer.jw-state-complete .jw-display-icon-container .jw-icon-display:before{content:"\\E610"}.jwplayer.jw-state-complete .jw-display-icon-container .jw-text{display:none}.jwplayer.jw-state-complete .jw-icon-playback:before{content:"\\E60E"}.jwplayer.jw-state-complete .jw-captions{display:none}body .jw-error .jw-title,.jwplayer.jw-state-error .jw-title{display:block}body .jw-error .jw-title .jw-title-primary,.jwplayer.jw-state-error .jw-title .jw-title-primary{white-space:normal}body .jw-error .jw-preview,.jwplayer.jw-state-error .jw-preview{display:block}body .jw-error .jw-controlbar,.jwplayer.jw-state-error .jw-controlbar{display:none}body .jw-error .jw-captions,.jwplayer.jw-state-error .jw-captions{display:none}body .jw-error:hover .jw-display-icon-container,.jwplayer.jw-state-error:hover .jw-display-icon-container{cursor:default;color:#fff;background:#000}body .jw-error .jw-icon-display,.jwplayer.jw-state-error .jw-icon-display{cursor:default;font-family:\'jw-icons\';-webkit-font-smoothing:antialiased;font-style:normal;font-weight:normal;text-transform:none;background-color:transparent;font-variant:normal;-webkit-font-feature-settings:"liga";-ms-font-feature-settings:"liga" 1;-o-font-feature-settings:"liga";font-feature-settings:"liga";-moz-osx-font-smoothing:grayscale}body .jw-error .jw-icon-display:before,.jwplayer.jw-state-error .jw-icon-display:before{content:"\\E607"}body .jw-error .jw-icon-display:hover,.jwplayer.jw-state-error .jw-icon-display:hover{color:#fff}body .jw-error{font-size:16px;background-color:#000;color:#eee;width:100%;height:100%;display:table;opacity:1;position:relative}body .jw-error .jw-icon-container{position:absolute;width:100%;height:100%;top:0;left:0;bottom:0;right:0}.jwplayer.jw-flag-cast-available .jw-controlbar{display:table}.jwplayer.jw-flag-cast-available .jw-icon-cast{display:inline-block}.jwplayer.jw-flag-skin-loading .jw-captions,.jwplayer.jw-flag-skin-loading .jw-controls,.jwplayer.jw-flag-skin-loading .jw-title{display:none}.jwplayer.jw-flag-fullscreen{width:100% !important;height:100% !important;top:0;right:0;bottom:0;left:0;z-index:1000;margin:0;position:fixed}.jwplayer.jw-flag-fullscreen.jw-flag-user-inactive{cursor:none;-webkit-cursor-visibility:auto-hide}.jwplayer.jw-flag-live .jw-controlbar .jw-text-elapsed,.jwplayer.jw-flag-live .jw-controlbar .jw-text-duration,.jwplayer.jw-flag-live .jw-controlbar .jw-slider-time{display:none}.jwplayer.jw-flag-live .jw-controlbar .jw-text-alt{display:inline}.jw-flag-user-inactive.jw-state-playing .jw-controlbar,.jw-flag-user-inactive.jw-state-playing .jw-dock{display:none}.jw-flag-user-inactive.jw-state-playing .jw-logo.jw-hide{display:none}.jw-flag-audio-player{background-color:transparent}.jw-flag-audio-player .jw-media{visibility:hidden}.jw-flag-audio-player .jw-controlbar{display:table;bottom:0;margin:0;width:100%;min-width:100%;opacity:1}.jw-flag-audio-player .jw-controlbar .jw-icon-fullscreen{display:none}.jw-flag-audio-player .jw-controlbar .jw-icon-tooltip{display:none}.jw-flag-audio-player .jw-controlbar .jw-slider-volume.jw-slider-horizontal,.jw-flag-audio-player .jw-controlbar .jw-icon-inline.jw-icon-volume{display:inline-block}.jw-flag-audio-player .jw-controlbar .jw-icon-tooltip.jw-icon-volume{display:none}.jwplayer.jw-flag-audio-player .jw-controlbar{display:table;left:0}.jwplayer.jw-flag-audio-player .jw-controlbar{height:auto}.jwplayer.jw-flag-audio-player .jw-preview{display:none}.jwplayer.jw-flag-media-audio .jw-controlbar{display:table}.jw-flag-media-audio .jw-preview{display:block}.jwplayer.jw-flag-ads .jw-preview,.jwplayer.jw-flag-ads .jw-dock{display:none}.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-inline,.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-tooltip,.jwplayer.jw-flag-ads .jw-controlbar .jw-text,.jwplayer.jw-flag-ads .jw-controlbar .jw-slider-horizontal{display:none}.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-playback,.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-volume,.jwplayer.jw-flag-ads .jw-controlbar .jw-slider-volume,.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-fullscreen{display:inline-block}.jwplayer.jw-flag-ads .jw-controlbar .jw-text-alt{display:inline}.jwplayer.jw-flag-ads .jw-controlbar .jw-slider-volume.jw-slider-horizontal,.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-inline.jw-icon-volume{display:inline-block}.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-tooltip.jw-icon-volume{display:none}.jwplayer.jw-flag-ads .jw-logo{display:none}.jwplayer.jw-flag-ads-hide-controls .jw-controls{display:none !important}.jwplayer.jw-flag-ads.jw-flag-touch .jw-controlbar{display:table}.jwplayer.jw-flag-rightclick-open{overflow:visible}.jwplayer.jw-flag-rightclick-open .jw-rightclick{z-index:16777215}.jw-flag-controls-disabled .jw-controls{display:none}.jw-flag-controls-disabled .jw-media{cursor:auto}body .jwplayer.jw-flag-flash-blocked .jw-controls{display:none}body .jwplayer.jw-flag-flash-blocked .jw-overlays{display:none}body .jwplayer.jw-flag-flash-blocked .jw-preview{display:none}.jw-flag-touch .jw-controlbar{font-size:1.5em}.jw-flag-touch .jw-icon-tooltip.jw-open-drawer:before{display:inline}.jw-flag-touch .jw-icon-tooltip.jw-open-drawer:before{content:"\\E615"}.jw-flag-touch .jw-display-icon-container{pointer-events:none}.jw-flag-compact-player .jw-icon-playlist,.jw-flag-compact-player .jw-icon-next,.jw-flag-compact-player .jw-icon-prev,.jw-flag-compact-player .jw-text-elapsed,.jw-flag-compact-player .jw-text-duration{display:none}.jw-skin-seven .jw-background-color{background:#000}.jw-skin-seven .jw-controlbar{border-top:#333 1px solid;height:2.5em}.jw-skin-seven .jw-group{vertical-align:middle}.jw-skin-seven .jw-playlist{background-color:rgba(0,0,0,0.5)}.jw-skin-seven .jw-playlist-container{left:-43%;background-color:rgba(0,0,0,0.5)}.jw-skin-seven .jw-playlist-container .jw-option{border-bottom:1px solid #444}.jw-skin-seven .jw-playlist-container .jw-option:hover,.jw-skin-seven .jw-playlist-container .jw-option.jw-active-option{background-color:black}.jw-skin-seven .jw-playlist-container .jw-option:hover .jw-label{color:#FF0046}.jw-skin-seven .jw-playlist-container .jw-icon-playlist{margin-left:0}.jw-skin-seven .jw-playlist-container .jw-label .jw-icon-play{color:#FF0046}.jw-skin-seven .jw-playlist-container .jw-label .jw-icon-play:before{padding-left:0}.jw-skin-seven .jw-tooltip-title{background-color:#000;color:#fff}.jw-skin-seven .jw-text{color:#fff}.jw-skin-seven .jw-button-color{color:#fff}.jw-skin-seven .jw-button-color:hover{color:#FF0046}.jw-skin-seven .jw-toggle{color:#FF0046}.jw-skin-seven .jw-toggle.jw-off{color:#fff}.jw-skin-seven .jw-controlbar .jw-icon:before,.jw-skin-seven .jw-text-elapsed,.jw-skin-seven .jw-text-duration{padding:0 .7em}.jw-skin-seven .jw-controlbar .jw-icon-prev:before{padding-right:.25em}.jw-skin-seven .jw-controlbar .jw-icon-playlist:before{padding:0 .45em}.jw-skin-seven .jw-controlbar .jw-icon-next:before{padding-left:.25em}.jw-skin-seven .jw-icon-prev,.jw-skin-seven .jw-icon-next{font-size:.7em}.jw-skin-seven .jw-icon-prev:before{border-left:1px solid #666}.jw-skin-seven .jw-icon-next:before{border-right:1px solid #666}.jw-skin-seven .jw-icon-display{color:#fff}.jw-skin-seven .jw-icon-display:before{padding-left:0}.jw-skin-seven .jw-display-icon-container{border-radius:50%;border:1px solid #333}.jw-skin-seven .jw-rail{background-color:#384154;box-shadow:none}.jw-skin-seven .jw-buffer{background-color:#666F82}.jw-skin-seven .jw-progress{background:#FF0046}.jw-skin-seven .jw-knob{width:.6em;height:.6em;background-color:#fff;box-shadow:0 0 0 1px #000;border-radius:1em}.jw-skin-seven .jw-slider-horizontal .jw-slider-container{height:.95em}.jw-skin-seven .jw-slider-horizontal .jw-rail,.jw-skin-seven .jw-slider-horizontal .jw-buffer,.jw-skin-seven .jw-slider-horizontal .jw-progress{height:.2em;border-radius:0}.jw-skin-seven .jw-slider-horizontal .jw-knob{top:-0.2em}.jw-skin-seven .jw-slider-horizontal .jw-cue{top:-0.05em;width:.3em;height:.3em;background-color:#fff;border-radius:50%}.jw-skin-seven .jw-slider-vertical .jw-rail,.jw-skin-seven .jw-slider-vertical .jw-buffer,.jw-skin-seven .jw-slider-vertical .jw-progress{width:.2em}.jw-skin-seven .jw-volume-tip{width:100%;left:-45%;padding-bottom:.7em}.jw-skin-seven .jw-text-duration{color:#666F82}.jw-skin-seven .jw-controlbar-right-group .jw-icon-tooltip:before,.jw-skin-seven .jw-controlbar-right-group .jw-icon-inline:before{border-left:1px solid #666}.jw-skin-seven .jw-controlbar-right-group .jw-icon-inline:first-child:before{border:none}.jw-skin-seven .jw-dock .jw-dock-button{border-radius:50%;border:1px solid #333}.jw-skin-seven .jw-dock .jw-overlay{border-radius:2.5em}.jw-skin-seven .jw-icon-tooltip .jw-active-option{background-color:#FF0046;color:#fff}.jw-skin-seven .jw-icon-volume{min-width:2.6em}.jw-skin-seven .jw-time-tip,.jw-skin-seven .jw-menu,.jw-skin-seven .jw-volume-tip,.jw-skin-seven .jw-skip{border:1px solid #333}.jw-skin-seven .jw-time-tip{padding:.2em;bottom:1.3em}.jw-skin-seven .jw-menu,.jw-skin-seven .jw-volume-tip{bottom:.24em}.jw-skin-seven .jw-skip{padding:.4em;border-radius:1.75em}.jw-skin-seven .jw-skip .jw-text,.jw-skin-seven .jw-skip .jw-icon-inline{color:#fff;line-height:1.75em}.jw-skin-seven .jw-skip.jw-skippable:hover .jw-text,.jw-skin-seven .jw-skip.jw-skippable:hover .jw-icon-inline{color:#FF0046}.jw-skin-seven.jw-flag-touch .jw-controlbar .jw-icon:before,.jw-skin-seven.jw-flag-touch .jw-text-elapsed,.jw-skin-seven.jw-flag-touch .jw-text-duration{padding:0 .35em}.jw-skin-seven.jw-flag-touch .jw-controlbar .jw-icon-prev:before{padding:0 .125em 0 .7em}.jw-skin-seven.jw-flag-touch .jw-controlbar .jw-icon-next:before{padding:0 .7em 0 .125em}.jw-skin-seven.jw-flag-touch .jw-controlbar .jw-icon-playlist:before{padding:0 .225em}',""])},function(a,b){a.exports=function(){var a=[];return a.toString=function(){for(var a=[],b=0;b<this.length;b++){var c=this[b];c[2]?a.push("@media "+c[2]+"{"+c[1]+"}"):a.push(c[1])}return a.join("")},a.i=function(b,c){"string"==typeof b&&(b=[[null,b,""]]);for(var d={},e=0;e<this.length;e++){var f=this[e][0];"number"==typeof f&&(d[f]=!0)}for(e=0;e<b.length;e++){var g=b[e];"number"==typeof g[0]&&d[g[0]]||(c&&!g[2]?g[2]=c:c&&(g[2]="("+g[2]+") and ("+c+")"),a.push(g))}},a}},function(a,b){a.exports="data:application/font-woff;base64,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";
},function(a,b){a.exports="data:application/octet-stream;base64,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"},function(a,b,c){function d(a,b){for(var c=0;c<a.length;c++){var d=a[c],e=l[d.id];if(e){e.refs++;for(var f=0;f<e.parts.length;f++)e.parts[f](d.parts[f]);for(;f<d.parts.length;f++)e.parts.push(h(d.parts[f],b))}else{for(var g=[],f=0;f<d.parts.length;f++)g.push(h(d.parts[f],b));l[d.id]={id:d.id,refs:1,parts:g}}}}function e(a){for(var b=[],c={},d=0;d<a.length;d++){var e=a[d],f=e[0],g=e[1],h=e[2],i=e[3],j={css:g,media:h,sourceMap:i};c[f]?c[f].parts.push(j):b.push(c[f]={id:f,parts:[j]})}return b}function f(){var a=document.createElement("style"),b=o();return a.type="text/css",b.appendChild(a),a}function g(){var a=document.createElement("link"),b=o();return a.rel="stylesheet",b.appendChild(a),a}function h(a,b){var c,d,e;if(b.singleton){var h=q++;c=p||(p=f()),d=i.bind(null,c,h,!1),e=i.bind(null,c,h,!0)}else a.sourceMap&&"function"==typeof URL&&"function"==typeof URL.createObjectURL&&"function"==typeof URL.revokeObjectURL&&"function"==typeof Blob&&"function"==typeof btoa?(c=g(),d=k.bind(null,c),e=function(){c.parentNode.removeChild(c),c.href&&URL.revokeObjectURL(c.href)}):(c=f(),d=j.bind(null,c),e=function(){c.parentNode.removeChild(c)});return d(a),function(b){if(b){if(b.css===a.css&&b.media===a.media&&b.sourceMap===a.sourceMap)return;d(a=b)}else e()}}function i(a,b,c,d){var e=c?"":d.css;if(a.styleSheet)a.styleSheet.cssText=r(b,e);else{var f=document.createTextNode(e),g=a.childNodes;g[b]&&a.removeChild(g[b]),g.length?a.insertBefore(f,g[b]):a.appendChild(f)}}function j(a,b){var c=b.css,d=b.media;b.sourceMap;if(d&&a.setAttribute("media",d),a.styleSheet)a.styleSheet.cssText=c;else{for(;a.firstChild;)a.removeChild(a.firstChild);a.appendChild(document.createTextNode(c))}}function k(a,b){var c=b.css,d=(b.media,b.sourceMap);d&&(c+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(d))))+" */");var e=new Blob([c],{type:"text/css"}),f=a.href;a.href=URL.createObjectURL(e),f&&URL.revokeObjectURL(f)}var l={},m=function(a){var b;return function(){return"undefined"==typeof b&&(b=a.apply(this,arguments)),b}},n=m(function(){return/msie [6-9]\b/.test(window.navigator.userAgent.toLowerCase())}),o=m(function(){return document.head||document.getElementsByTagName("head")[0]}),p=null,q=0;a.exports=function(a,b){b=b||{},"undefined"==typeof b.singleton&&(b.singleton=n());var c=e(a);return d(c,b),function(a){for(var f=[],g=0;g<c.length;g++){var h=c[g],i=l[h.id];i.refs--,f.push(i)}if(a){var j=e(a);d(j,b)}for(var g=0;g<f.length;g++){var i=f[g];if(0===i.refs){for(var k=0;k<i.parts.length;k++)i.parts[k]();delete l[i.id]}}}};var r=function(){var a=[];return function(b,c){return a[b]=c,a.filter(Boolean).join("\n")}}()},function(a,b,c){var d,e;d=[c(40),c(47),c(58),c(45),c(79),c(50),c(117),c(90),c(96),c(91),c(73),c(66),c(65),c(82),c(83),c(159),c(101),c(93)],e=function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r){var s={};return s.api=a,s._=b,s.version=c,s.utils=b.extend(d,f,{canCast:p.available,getCookies:e.getAllItems,saveCookie:e.setItem,key:h,extend:b.extend,scriptloader:i,rssparser:q,tea:j,UI:g}),s.utils.css.style=s.utils.style,s.vid=k,s.events=b.extend({},l,{state:m}),s.playlist=b.extend({},n,{item:o}),s.plugins=r,s.cast=p,s}.apply(b,d),!(void 0!==e&&(a.exports=e))}])});
/*! object-fit-polyfill - 2015-11-04 */!function(window,document){"use strict";var supports=function(){var div=document.createElement("div"),vendors="Khtml Ms O Moz Webkit".split(" "),len=vendors.length;return function(prop){if(prop in div.style)return!0;for(prop=prop.replace(/^[a-z]/,function(val){return val.toUpperCase()});len--;)if(vendors[len]+prop in div.style)return!0;return!1}}(),copyComputedStyle=function(from,to){var computed_style_object=!1;if(computed_style_object=from.currentStyle||document.defaultView.getComputedStyle(from,null),!computed_style_object)return null;var stylePropertyValid=function(name,value){return"undefined"!=typeof value&&"object"!=typeof value&&"function"!=typeof value&&value.length>0&&value!=parseInt(value)};for(var property in computed_style_object)stylePropertyValid(property,computed_style_object[property])&&(to.style[property]=computed_style_object[property])};if(supports("object-fit")===!1)for(var oDiv,sSource,oImages=document.querySelectorAll("[data-object-fit]"),nKey=0;nKey<oImages.length;nKey++){switch(oDiv=document.createElement("div"),sSource=oImages[nKey].getAttribute("data-src-retina")?oImages[nKey].getAttribute("data-src-retina"):oImages[nKey].getAttribute("data-src")?oImages[nKey].getAttribute("data-src"):oImages[nKey].src,copyComputedStyle(oImages[nKey],oDiv),oDiv.style.display="block",oDiv.style.backgroundImage="url("+sSource+")",oDiv.style.backgroundPosition="center center",oDiv.style.className=oImages[nKey].className,oDiv.style.backgroundRepeat="no-repeat",oImages[nKey].getAttribute("data-object-fit")){case"cover":oDiv.style.backgroundSize="cover";break;case"contain":oDiv.style.backgroundSize="contain";break;case"fill":oDiv.style.backgroundSize="100% 100%";break;case"none":oDiv.style.backgroundSize="auto"}oImages[nKey].parentNode.replaceChild(oDiv,oImages[nKey])}}(window,document);

/**
 * Owl carousel
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 * @todo Lazy Load Icon
 * @todo prevent animationend bubling
 * @todo itemsScaleUp
 * @todo Test Zepto
 * @todo stagePadding calculate wrong active classes
 */
;(function($, window, document, undefined) {

	var drag, state, e;

	/**
	 * Template for status information about drag and touch events.
	 * @private
	 */
	drag = {
		start: 0,
		startX: 0,
		startY: 0,
		current: 0,
		currentX: 0,
		currentY: 0,
		offsetX: 0,
		offsetY: 0,
		distance: null,
		startTime: 0,
		endTime: 0,
		updatedX: 0,
		targetEl: null
	};

	/**
	 * Template for some status informations.
	 * @private
	 */
	state = {
		isTouch: false,
		isScrolling: false,
		isSwiping: false,
		direction: false,
		inMotion: false
	};

	/**
	 * Event functions references.
	 * @private
	 */
	e = {
		_onDragStart: null,
		_onDragMove: null,
		_onDragEnd: null,
		_transitionEnd: null,
		_resizer: null,
		_responsiveCall: null,
		_goToLoop: null,
		_checkVisibile: null
	};

	/**
	 * Creates a carousel.
	 * @class The Owl Carousel.
	 * @public
	 * @param {HTMLElement|jQuery} element - The element to create the carousel for.
	 * @param {Object} [options] - The options
	 */
	function Owl(element, options) {

		/**
		 * Current settings for the carousel.
		 * @public
		 */
		this.settings = null;

		/**
		 * Current options set by the caller including defaults.
		 * @public
		 */
		this.options = $.extend({}, Owl.Defaults, options);

		/**
		 * Plugin element.
		 * @public
		 */
		this.$element = $(element);

		/**
		 * Caches informations about drag and touch events.
		 */
		this.drag = $.extend({}, drag);

		/**
		 * Caches some status informations.
		 * @protected
		 */
		this.state = $.extend({}, state);

		/**
		 * @protected
		 * @todo Must be documented
		 */
		this.e = $.extend({}, e);

		/**
		 * References to the running plugins of this carousel.
		 * @protected
		 */
		this._plugins = {};

		/**
		 * Currently suppressed events to prevent them from beeing retriggered.
		 * @protected
		 */
		this._supress = {};

		/**
		 * Absolute current position.
		 * @protected
		 */
		this._current = null;

		/**
		 * Animation speed in milliseconds.
		 * @protected
		 */
		this._speed = null;

		/**
		 * Coordinates of all items in pixel.
		 * @todo The name of this member is missleading.
		 * @protected
		 */
		this._coordinates = [];

		/**
		 * Current breakpoint.
		 * @todo Real media queries would be nice.
		 * @protected
		 */
		this._breakpoint = null;

		/**
		 * Current width of the plugin element.
		 */
		this._width = null;

		/**
		 * All real items.
		 * @protected
		 */
		this._items = [];

		/**
		 * All cloned items.
		 * @protected
		 */
		this._clones = [];

		/**
		 * Merge values of all items.
		 * @todo Maybe this could be part of a plugin.
		 * @protected
		 */
		this._mergers = [];

		/**
		 * Invalidated parts within the update process.
		 * @protected
		 */
		this._invalidated = {};

		/**
		 * Ordered list of workers for the update process.
		 * @protected
		 */
		this._pipe = [];

		$.each(Owl.Plugins, $.proxy(function(key, plugin) {
			this._plugins[key[0].toLowerCase() + key.slice(1)]
				= new plugin(this);
		}, this));

		$.each(Owl.Pipe, $.proxy(function(priority, worker) {
			this._pipe.push({
				'filter': worker.filter,
				'run': $.proxy(worker.run, this)
			});
		}, this));

		this.setup();
		this.initialize();
	}

	/**
	 * Default options for the carousel.
	 * @public
	 */
	Owl.Defaults = {
		items: 3,
		loop: false,
		center: false,

		mouseDrag: true,
		touchDrag: true,
		pullDrag: true,
		freeDrag: false,

		margin: 0,
		stagePadding: 0,

		merge: false,
		mergeFit: true,
		autoWidth: false,

		startPosition: 0,
		rtl: false,

		smartSpeed: 250,
		fluidSpeed: false,
		dragEndSpeed: false,

		responsive: {},
		responsiveRefreshRate: 200,
		responsiveBaseElement: window,
		responsiveClass: false,

		fallbackEasing: 'swing',

		info: false,

		nestedItemSelector: false,
		itemElement: 'div',
		stageElement: 'div',

		// Classes and Names
		themeClass: 'owl-theme',
		baseClass: 'owl-carousel',
		itemClass: 'owl-item',
		centerClass: 'center',
		activeClass: 'active'
	};

	/**
	 * Enumeration for width.
	 * @public
	 * @readonly
	 * @enum {String}
	 */
	Owl.Width = {
		Default: 'default',
		Inner: 'inner',
		Outer: 'outer'
	};

	/**
	 * Contains all registered plugins.
	 * @public
	 */
	Owl.Plugins = {};

	/**
	 * Update pipe.
	 */
	Owl.Pipe = [ {
		filter: [ 'width', 'items', 'settings' ],
		run: function(cache) {
			cache.current = this._items && this._items[this.relative(this._current)];
		}
	}, {
		filter: [ 'items', 'settings' ],
		run: function() {
			var cached = this._clones,
				clones = this.$stage.children('.cloned');

			if (clones.length !== cached.length || (!this.settings.loop && cached.length > 0)) {
				this.$stage.children('.cloned').remove();
				this._clones = [];
			}
		}
	}, {
		filter: [ 'items', 'settings' ],
		run: function() {
			var i, n,
				clones = this._clones,
				items = this._items,
				delta = this.settings.loop ? clones.length - Math.max(this.settings.items * 2, 4) : 0;

			for (i = 0, n = Math.abs(delta / 2); i < n; i++) {
				if (delta > 0) {
					this.$stage.children().eq(items.length + clones.length - 1).remove();
					clones.pop();
					this.$stage.children().eq(0).remove();
					clones.pop();
				} else {
					clones.push(clones.length / 2);
					this.$stage.append(items[clones[clones.length - 1]].clone().addClass('cloned'));
					clones.push(items.length - 1 - (clones.length - 1) / 2);
					this.$stage.prepend(items[clones[clones.length - 1]].clone().addClass('cloned'));
				}
			}
		}
	}, {
		filter: [ 'width', 'items', 'settings' ],
		run: function() {
			var rtl = (this.settings.rtl ? 1 : -1),
				width = (this.width() / this.settings.items).toFixed(3),
				coordinate = 0, merge, i, n;

			this._coordinates = [];
			for (i = 0, n = this._clones.length + this._items.length; i < n; i++) {
				merge = this._mergers[this.relative(i)];
				merge = (this.settings.mergeFit && Math.min(merge, this.settings.items)) || merge;
				coordinate += (this.settings.autoWidth ? this._items[this.relative(i)].width() + this.settings.margin : width * merge) * rtl;

				this._coordinates.push(coordinate);
			}
		}
	}, {
		filter: [ 'width', 'items', 'settings' ],
		run: function() {
			var i, n, width = (this.width() / this.settings.items).toFixed(3), css = {
				'width': Math.abs(this._coordinates[this._coordinates.length - 1]) + this.settings.stagePadding * 2,
				'padding-left': this.settings.stagePadding || '',
				'padding-right': this.settings.stagePadding || ''
			};

			this.$stage.css(css);

			css = { 'width': this.settings.autoWidth ? 'auto' : width - this.settings.margin };
			css[this.settings.rtl ? 'margin-left' : 'margin-right'] = this.settings.margin;

			if (!this.settings.autoWidth && $.grep(this._mergers, function(v) { return v > 1 }).length > 0) {
				for (i = 0, n = this._coordinates.length; i < n; i++) {
					css.width = Math.abs(this._coordinates[i]) - Math.abs(this._coordinates[i - 1] || 0) - this.settings.margin;
					this.$stage.children().eq(i).css(css);
				}
			} else {
				this.$stage.children().css(css);
			}
		}
	}, {
		filter: [ 'width', 'items', 'settings' ],
		run: function(cache) {
			cache.current && this.reset(this.$stage.children().index(cache.current));
		}
	}, {
		filter: [ 'position' ],
		run: function() {
			this.animate(this.coordinates(this._current));
		}
	}, {
		filter: [ 'width', 'position', 'items', 'settings' ],
		run: function() {
			var rtl = this.settings.rtl ? 1 : -1,
				padding = this.settings.stagePadding * 2,
				begin = this.coordinates(this.current()) + padding,
				end = begin + this.width() * rtl,
				inner, outer, matches = [], i, n;

			for (i = 0, n = this._coordinates.length; i < n; i++) {
				inner = this._coordinates[i - 1] || 0;
				outer = Math.abs(this._coordinates[i]) + padding * rtl;

				if ((this.op(inner, '<=', begin) && (this.op(inner, '>', end)))
					|| (this.op(outer, '<', begin) && this.op(outer, '>', end))) {
					matches.push(i);
				}
			}

			this.$stage.children('.' + this.settings.activeClass).removeClass(this.settings.activeClass);
			this.$stage.children(':eq(' + matches.join('), :eq(') + ')').addClass(this.settings.activeClass);

			if (this.settings.center) {
				this.$stage.children('.' + this.settings.centerClass).removeClass(this.settings.centerClass);
				this.$stage.children().eq(this.current()).addClass(this.settings.centerClass);
			}
		}
	} ];

	/**
	 * Initializes the carousel.
	 * @protected
	 */
	Owl.prototype.initialize = function() {
		this.trigger('initialize');

		this.$element
			.addClass(this.settings.baseClass)
			.addClass(this.settings.themeClass)
			.toggleClass('owl-rtl', this.settings.rtl);

		// check support
		this.browserSupport();

		if (this.settings.autoWidth && this.state.imagesLoaded !== true) {
			var imgs, nestedSelector, width;
			imgs = this.$element.find('img');
			nestedSelector = this.settings.nestedItemSelector ? '.' + this.settings.nestedItemSelector : undefined;
			width = this.$element.children(nestedSelector).width();

			if (imgs.length && width <= 0) {
				this.preloadAutoWidthImages(imgs);
				return false;
			}
		}

		this.$element.addClass('owl-loading');

		// create stage
		this.$stage = $('<' + this.settings.stageElement + ' class="owl-stage"/>')
			.wrap('<div class="owl-stage-outer">');

		// append stage
		this.$element.append(this.$stage.parent());

		// append content
		this.replace(this.$element.children().not(this.$stage.parent()));

		// set view width
		this._width = this.$element.width();

		// update view
		this.refresh();

		this.$element.removeClass('owl-loading').addClass('owl-loaded');

		// attach generic events
		this.eventsCall();

		// attach generic events
		this.internalEvents();

		// attach custom control events
		this.addTriggerableEvents();

		this.trigger('initialized');
	};

	/**
	 * Setups the current settings.
	 * @todo Remove responsive classes. Why should adaptive designs be brought into IE8?
	 * @todo Support for media queries by using `matchMedia` would be nice.
	 * @public
	 */
	Owl.prototype.setup = function() {
		var viewport = this.viewport(),
			overwrites = this.options.responsive,
			match = -1,
			settings = null;

		if (!overwrites) {
			settings = $.extend({}, this.options);
		} else {
			$.each(overwrites, function(breakpoint) {
				if (breakpoint <= viewport && breakpoint > match) {
					match = Number(breakpoint);
				}
			});

			settings = $.extend({}, this.options, overwrites[match]);
			delete settings.responsive;

			// responsive class
			if (settings.responsiveClass) {
				this.$element.attr('class', function(i, c) {
					return c.replace(/\b owl-responsive-\S+/g, '');
				}).addClass('owl-responsive-' + match);
			}
		}

		if (this.settings === null || this._breakpoint !== match) {
			this.trigger('change', { property: { name: 'settings', value: settings } });
			this._breakpoint = match;
			this.settings = settings;
			this.invalidate('settings');
			this.trigger('changed', { property: { name: 'settings', value: this.settings } });
		}
	};

	/**
	 * Updates option logic if necessery.
	 * @protected
	 */
	Owl.prototype.optionsLogic = function() {
		// Toggle Center class
		this.$element.toggleClass('owl-center', this.settings.center);

		// if items number is less than in body
		if (this.settings.loop && this._items.length < this.settings.items) {
			this.settings.loop = false;
		}

		if (this.settings.autoWidth) {
			this.settings.stagePadding = false;
			this.settings.merge = false;
		}
	};

	/**
	 * Prepares an item before add.
	 * @todo Rename event parameter `content` to `item`.
	 * @protected
	 * @returns {jQuery|HTMLElement} - The item container.
	 */
	Owl.prototype.prepare = function(item) {
		var event = this.trigger('prepare', { content: item });

		if (!event.data) {
			event.data = $('<' + this.settings.itemElement + '/>')
				.addClass(this.settings.itemClass).append(item)
		}

		this.trigger('prepared', { content: event.data });

		return event.data;
	};

	/**
	 * Updates the view.
	 * @public
	 */
	Owl.prototype.update = function() {
		var i = 0,
			n = this._pipe.length,
			filter = $.proxy(function(p) { return this[p] }, this._invalidated),
			cache = {};

		while (i < n) {
			if (this._invalidated.all || $.grep(this._pipe[i].filter, filter).length > 0) {
				this._pipe[i].run(cache);
			}
			i++;
		}

		this._invalidated = {};
	};

	/**
	 * Gets the width of the view.
	 * @public
	 * @param {Owl.Width} [dimension=Owl.Width.Default] - The dimension to return.
	 * @returns {Number} - The width of the view in pixel.
	 */
	Owl.prototype.width = function(dimension) {
		dimension = dimension || Owl.Width.Default;
		switch (dimension) {
			case Owl.Width.Inner:
			case Owl.Width.Outer:
				return this._width;
			default:
				return this._width - this.settings.stagePadding * 2 + this.settings.margin;
		}
	};

	/**
	 * Refreshes the carousel primarily for adaptive purposes.
	 * @public
	 */
	Owl.prototype.refresh = function() {
		if (this._items.length === 0) {
			return false;
		}

		var start = new Date().getTime();

		this.trigger('refresh');

		this.setup();

		this.optionsLogic();

		// hide and show methods helps here to set a proper widths,
		// this prevents scrollbar to be calculated in stage width
		this.$stage.addClass('owl-refresh');

		this.update();

		this.$stage.removeClass('owl-refresh');

		this.state.orientation = window.orientation;

		this.watchVisibility();

		this.trigger('refreshed');
	};

	/**
	 * Save internal event references and add event based functions.
	 * @protected
	 */
	Owl.prototype.eventsCall = function() {
		// Save events references
		this.e._onDragStart = $.proxy(function(e) {
			this.onDragStart(e);
		}, this);
		this.e._onDragMove = $.proxy(function(e) {
			this.onDragMove(e);
		}, this);
		this.e._onDragEnd = $.proxy(function(e) {
			this.onDragEnd(e);
		}, this);
		this.e._onResize = $.proxy(function(e) {
			this.onResize(e);
		}, this);
		this.e._transitionEnd = $.proxy(function(e) {
			this.transitionEnd(e);
		}, this);
		this.e._preventClick = $.proxy(function(e) {
			this.preventClick(e);
		}, this);
	};

	/**
	 * Checks window `resize` event.
	 * @protected
	 */
	Owl.prototype.onThrottledResize = function() {
		window.clearTimeout(this.resizeTimer);
		this.resizeTimer = window.setTimeout(this.e._onResize, this.settings.responsiveRefreshRate);
	};

	/**
	 * Checks window `resize` event.
	 * @protected
	 */
	Owl.prototype.onResize = function() {
		if (!this._items.length) {
			return false;
		}

		if (this._width === this.$element.width()) {
			return false;
		}

		if (this.trigger('resize').isDefaultPrevented()) {
			return false;
		}

		this._width = this.$element.width();

		this.invalidate('width');

		this.refresh();

		this.trigger('resized');
	};

	/**
	 * Checks for touch/mouse drag event type and add run event handlers.
	 * @protected
	 */
	Owl.prototype.eventsRouter = function(event) {
		var type = event.type;

		if (type === "mousedown" || type === "touchstart") {
			this.onDragStart(event);
		} else if (type === "mousemove" || type === "touchmove") {
			this.onDragMove(event);
		} else if (type === "mouseup" || type === "touchend") {
			this.onDragEnd(event);
		} else if (type === "touchcancel") {
			this.onDragEnd(event);
		}
	};

	/**
	 * Checks for touch/mouse drag options and add necessery event handlers.
	 * @protected
	 */
	Owl.prototype.internalEvents = function() {
		var isTouch = isTouchSupport(),
			isTouchIE = isTouchSupportIE();

		if (this.settings.mouseDrag){
			this.$stage.on('mousedown', $.proxy(function(event) { this.eventsRouter(event) }, this));
			this.$stage.on('dragstart', function() { return false });
			this.$stage.get(0).onselectstart = function() { return false };
		} else {
			this.$element.addClass('owl-text-select-on');
		}

		if (this.settings.touchDrag && !isTouchIE){
			this.$stage.on('touchstart touchcancel', $.proxy(function(event) { this.eventsRouter(event) }, this));
		}

		// catch transitionEnd event
		if (this.transitionEndVendor) {
			this.on(this.$stage.get(0), this.transitionEndVendor, this.e._transitionEnd, false);
		}

		// responsive
		if (this.settings.responsive !== false) {
			this.on(window, 'resize', $.proxy(this.onThrottledResize, this));
		}
	};

	/**
	 * Handles touchstart/mousedown event.
	 * @protected
	 * @param {Event} event - The event arguments.
	 */
	Owl.prototype.onDragStart = function(event) {
		var ev, isTouchEvent, pageX, pageY, animatedPos;

		ev = event.originalEvent || event || window.event;

		// prevent right click
		if (ev.which === 3 || this.state.isTouch) {
			return false;
		}

		if (ev.type === 'mousedown') {
			this.$stage.addClass('owl-grab');
		}

		this.trigger('drag');
		this.drag.startTime = new Date().getTime();
		this.speed(0);
		this.state.isTouch = true;
		this.state.isScrolling = false;
		this.state.isSwiping = false;
		this.drag.distance = 0;

		pageX = getTouches(ev).x;
		pageY = getTouches(ev).y;

		// get stage position left
		this.drag.offsetX = this.$stage.position().left;
		this.drag.offsetY = this.$stage.position().top;

		if (this.settings.rtl) {
			this.drag.offsetX = this.$stage.position().left + this.$stage.width() - this.width()
				+ this.settings.margin;
		}

		// catch position // ie to fix
		if (this.state.inMotion && this.support3d) {
			animatedPos = this.getTransformProperty();
			this.drag.offsetX = animatedPos;
			this.animate(animatedPos);
			this.state.inMotion = true;
		} else if (this.state.inMotion && !this.support3d) {
			this.state.inMotion = false;
			return false;
		}

		this.drag.startX = pageX - this.drag.offsetX;
		this.drag.startY = pageY - this.drag.offsetY;

		this.drag.start = pageX - this.drag.startX;
		this.drag.targetEl = ev.target || ev.srcElement;
		this.drag.updatedX = this.drag.start;

		// to do/check
		// prevent links and images dragging;
		if (this.drag.targetEl.tagName === "IMG" || this.drag.targetEl.tagName === "A") {
			this.drag.targetEl.draggable = false;
		}

		$(document).on('mousemove.owl.dragEvents mouseup.owl.dragEvents touchmove.owl.dragEvents touchend.owl.dragEvents', $.proxy(function(event) {this.eventsRouter(event)},this));
	};

	/**
	 * Handles the touchmove/mousemove events.
	 * @todo Simplify
	 * @protected
	 * @param {Event} event - The event arguments.
	 */
	Owl.prototype.onDragMove = function(event) {
		var ev, isTouchEvent, pageX, pageY, minValue, maxValue, pull;

		if (!this.state.isTouch) {
			return;
		}

		if (this.state.isScrolling) {
			return;
		}

		ev = event.originalEvent || event || window.event;

		pageX = getTouches(ev).x;
		pageY = getTouches(ev).y;

		// Drag Direction
		this.drag.currentX = pageX - this.drag.startX;
		this.drag.currentY = pageY - this.drag.startY;
		this.drag.distance = this.drag.currentX - this.drag.offsetX;

		// Check move direction
		if (this.drag.distance < 0) {
			this.state.direction = this.settings.rtl ? 'right' : 'left';
		} else if (this.drag.distance > 0) {
			this.state.direction = this.settings.rtl ? 'left' : 'right';
		}
		// Loop
		if (this.settings.loop) {
			if (this.op(this.drag.currentX, '>', this.coordinates(this.minimum())) && this.state.direction === 'right') {
				this.drag.currentX -= (this.settings.center && this.coordinates(0)) - this.coordinates(this._items.length);
			} else if (this.op(this.drag.currentX, '<', this.coordinates(this.maximum())) && this.state.direction === 'left') {
				this.drag.currentX += (this.settings.center && this.coordinates(0)) - this.coordinates(this._items.length);
			}
		} else {
			// pull
			minValue = this.settings.rtl ? this.coordinates(this.maximum()) : this.coordinates(this.minimum());
			maxValue = this.settings.rtl ? this.coordinates(this.minimum()) : this.coordinates(this.maximum());
			pull = this.settings.pullDrag ? this.drag.distance / 5 : 0;
			this.drag.currentX = Math.max(Math.min(this.drag.currentX, minValue + pull), maxValue + pull);
		}

		// Lock browser if swiping horizontal

		if ((this.drag.distance > 8 || this.drag.distance < -8)) {
			if (ev.preventDefault !== undefined) {
				ev.preventDefault();
			} else {
				ev.returnValue = false;
			}
			this.state.isSwiping = true;
		}

		this.drag.updatedX = this.drag.currentX;

		// Lock Owl if scrolling
		if ((this.drag.currentY > 16 || this.drag.currentY < -16) && this.state.isSwiping === false) {
			this.state.isScrolling = true;
			this.drag.updatedX = this.drag.start;
		}

		this.animate(this.drag.updatedX);
	};

	/**
	 * Handles the touchend/mouseup events.
	 * @protected
	 */
	Owl.prototype.onDragEnd = function(event) {
		var compareTimes, distanceAbs, closest;

		if (!this.state.isTouch) {
			return;
		}

		if (event.type === 'mouseup') {
			this.$stage.removeClass('owl-grab');
		}

		this.trigger('dragged');

		// prevent links and images dragging;
		this.drag.targetEl.removeAttribute("draggable");

		// remove drag event listeners

		this.state.isTouch = false;
		this.state.isScrolling = false;
		this.state.isSwiping = false;

		// to check
		if (this.drag.distance === 0 && this.state.inMotion !== true) {
			this.state.inMotion = false;
			return false;
		}

		// prevent clicks while scrolling

		this.drag.endTime = new Date().getTime();
		compareTimes = this.drag.endTime - this.drag.startTime;
		distanceAbs = Math.abs(this.drag.distance);

		// to test
		if (distanceAbs > 3 || compareTimes > 300) {
			this.removeClick(this.drag.targetEl);
		}

		closest = this.closest(this.drag.updatedX);

		this.speed(this.settings.dragEndSpeed || this.settings.smartSpeed);
		this.current(closest);
		this.invalidate('position');
		this.update();

		// if pullDrag is off then fire transitionEnd event manually when stick
		// to border
		if (!this.settings.pullDrag && this.drag.updatedX === this.coordinates(closest)) {
			this.transitionEnd();
		}

		this.drag.distance = 0;

		$(document).off('.owl.dragEvents');
	};

	/**
	 * Attaches `preventClick` to disable link while swipping.
	 * @protected
	 * @param {HTMLElement} [target] - The target of the `click` event.
	 */
	Owl.prototype.removeClick = function(target) {
		this.drag.targetEl = target;
		$(target).on('click.preventClick', this.e._preventClick);
		// to make sure click is removed:
		window.setTimeout(function() {
			$(target).off('click.preventClick');
		}, 300);
	};

	/**
	 * Suppresses click event.
	 * @protected
	 * @param {Event} ev - The event arguments.
	 */
	Owl.prototype.preventClick = function(ev) {
		if (ev.preventDefault) {
			ev.preventDefault();
		} else {
			ev.returnValue = false;
		}
		if (ev.stopPropagation) {
			ev.stopPropagation();
		}
		$(ev.target).off('click.preventClick');
	};

	/**
	 * Catches stage position while animate (only CSS3).
	 * @protected
	 * @returns
	 */
	Owl.prototype.getTransformProperty = function() {
		var transform, matrix3d;

		transform = window.getComputedStyle(this.$stage.get(0), null).getPropertyValue(this.vendorName + 'transform');
		// var transform = this.$stage.css(this.vendorName + 'transform')
		transform = transform.replace(/matrix(3d)?\(|\)/g, '').split(',');
		matrix3d = transform.length === 16;

		return matrix3d !== true ? transform[4] : transform[12];
	};

	/**
	 * Gets absolute position of the closest item for a coordinate.
	 * @todo Setting `freeDrag` makes `closest` not reusable. See #165.
	 * @protected
	 * @param {Number} coordinate - The coordinate in pixel.
	 * @return {Number} - The absolute position of the closest item.
	 */
	Owl.prototype.closest = function(coordinate) {
		var position = -1, pull = 30, width = this.width(), coordinates = this.coordinates();

		if (!this.settings.freeDrag) {
			// check closest item
			$.each(coordinates, $.proxy(function(index, value) {
				if (coordinate > value - pull && coordinate < value + pull) {
					position = index;
				} else if (this.op(coordinate, '<', value)
					&& this.op(coordinate, '>', coordinates[index + 1] || value - width)) {
					position = this.state.direction === 'left' ? index + 1 : index;
				}
				return position === -1;
			}, this));
		}

		if (!this.settings.loop) {
			// non loop boundries
			if (this.op(coordinate, '>', coordinates[this.minimum()])) {
				position = coordinate = this.minimum();
			} else if (this.op(coordinate, '<', coordinates[this.maximum()])) {
				position = coordinate = this.maximum();
			}
		}

		return position;
	};

	/**
	 * Animates the stage.
	 * @public
	 * @param {Number} coordinate - The coordinate in pixels.
	 */
	Owl.prototype.animate = function(coordinate) {
		this.trigger('translate');
		this.state.inMotion = this.speed() > 0;

		if (this.support3d) {
			this.$stage.css({
				transform: 'translate3d(' + coordinate + 'px' + ',0px, 0px)',
				transition: (this.speed() / 1000) + 's'
			});
		} else if (this.state.isTouch) {
			this.$stage.css({
				left: coordinate + 'px'
			});
		} else {
			this.$stage.animate({
				left: coordinate
			}, this.speed() / 1000, this.settings.fallbackEasing, $.proxy(function() {
				if (this.state.inMotion) {
					this.transitionEnd();
				}
			}, this));
		}
	};

	/**
	 * Sets the absolute position of the current item.
	 * @public
	 * @param {Number} [position] - The new absolute position or nothing to leave it unchanged.
	 * @returns {Number} - The absolute position of the current item.
	 */
	Owl.prototype.current = function(position) {
		if (position === undefined) {
			return this._current;
		}

		if (this._items.length === 0) {
			return undefined;
		}

		position = this.normalize(position);

		if (this._current !== position) {
			var event = this.trigger('change', { property: { name: 'position', value: position } });

			if (event.data !== undefined) {
				position = this.normalize(event.data);
			}

			this._current = position;

			this.invalidate('position');

			this.trigger('changed', { property: { name: 'position', value: this._current } });
		}

		return this._current;
	};

	/**
	 * Invalidates the given part of the update routine.
	 * @param {String} part - The part to invalidate.
	 */
	Owl.prototype.invalidate = function(part) {
		this._invalidated[part] = true;
	}

	/**
	 * Resets the absolute position of the current item.
	 * @public
	 * @param {Number} position - The absolute position of the new item.
	 */
	Owl.prototype.reset = function(position) {
		position = this.normalize(position);

		if (position === undefined) {
			return;
		}

		this._speed = 0;
		this._current = position;

		this.suppress([ 'translate', 'translated' ]);

		this.animate(this.coordinates(position));

		this.release([ 'translate', 'translated' ]);
	};

	/**
	 * Normalizes an absolute or a relative position for an item.
	 * @public
	 * @param {Number} position - The absolute or relative position to normalize.
	 * @param {Boolean} [relative=false] - Whether the given position is relative or not.
	 * @returns {Number} - The normalized position.
	 */
	Owl.prototype.normalize = function(position, relative) {
		var n = (relative ? this._items.length : this._items.length + this._clones.length);

		if (!$.isNumeric(position) || n < 1) {
			return undefined;
		}

		if (this._clones.length) {
			position = ((position % n) + n) % n;
		} else {
			position = Math.max(this.minimum(relative), Math.min(this.maximum(relative), position));
		}

		return position;
	};

	/**
	 * Converts an absolute position for an item into a relative position.
	 * @public
	 * @param {Number} position - The absolute position to convert.
	 * @returns {Number} - The converted position.
	 */
	Owl.prototype.relative = function(position) {
		position = this.normalize(position);
		position = position - this._clones.length / 2;
		return this.normalize(position, true);
	};

	/**
	 * Gets the maximum position for an item.
	 * @public
	 * @param {Boolean} [relative=false] - Whether to return an absolute position or a relative position.
	 * @returns {Number}
	 */
	Owl.prototype.maximum = function(relative) {
		var maximum, width, i = 0, coordinate,
			settings = this.settings;

		if (relative) {
			return this._items.length - 1;
		}

		if (!settings.loop && settings.center) {
			maximum = this._items.length - 1;
		} else if (!settings.loop && !settings.center) {
			maximum = this._items.length - settings.items;
		} else if (settings.loop || settings.center) {
			maximum = this._items.length + settings.items;
		} else if (settings.autoWidth || settings.merge) {
			revert = settings.rtl ? 1 : -1;
			width = this.$stage.width() - this.$element.width();
			while (coordinate = this.coordinates(i)) {
				if (coordinate * revert >= width) {
					break;
				}
				maximum = ++i;
			}
		} else {
			throw 'Can not detect maximum absolute position.'
		}

		return maximum;
	};

	/**
	 * Gets the minimum position for an item.
	 * @public
	 * @param {Boolean} [relative=false] - Whether to return an absolute position or a relative position.
	 * @returns {Number}
	 */
	Owl.prototype.minimum = function(relative) {
		if (relative) {
			return 0;
		}

		return this._clones.length / 2;
	};

	/**
	 * Gets an item at the specified relative position.
	 * @public
	 * @param {Number} [position] - The relative position of the item.
	 * @return {jQuery|Array.<jQuery>} - The item at the given position or all items if no position was given.
	 */
	Owl.prototype.items = function(position) {
		if (position === undefined) {
			return this._items.slice();
		}

		position = this.normalize(position, true);
		return this._items[position];
	};

	/**
	 * Gets an item at the specified relative position.
	 * @public
	 * @param {Number} [position] - The relative position of the item.
	 * @return {jQuery|Array.<jQuery>} - The item at the given position or all items if no position was given.
	 */
	Owl.prototype.mergers = function(position) {
		if (position === undefined) {
			return this._mergers.slice();
		}

		position = this.normalize(position, true);
		return this._mergers[position];
	};

	/**
	 * Gets the absolute positions of clones for an item.
	 * @public
	 * @param {Number} [position] - The relative position of the item.
	 * @returns {Array.<Number>} - The absolute positions of clones for the item or all if no position was given.
	 */
	Owl.prototype.clones = function(position) {
		var odd = this._clones.length / 2,
			even = odd + this._items.length,
			map = function(index) { return index % 2 === 0 ? even + index / 2 : odd - (index + 1) / 2 };

		if (position === undefined) {
			return $.map(this._clones, function(v, i) { return map(i) });
		}

		return $.map(this._clones, function(v, i) { return v === position ? map(i) : null });
	};

	/**
	 * Sets the current animation speed.
	 * @public
	 * @param {Number} [speed] - The animation speed in milliseconds or nothing to leave it unchanged.
	 * @returns {Number} - The current animation speed in milliseconds.
	 */
	Owl.prototype.speed = function(speed) {
		if (speed !== undefined) {
			this._speed = speed;
		}

		return this._speed;
	};

	/**
	 * Gets the coordinate of an item.
	 * @todo The name of this method is missleanding.
	 * @public
	 * @param {Number} position - The absolute position of the item within `minimum()` and `maximum()`.
	 * @returns {Number|Array.<Number>} - The coordinate of the item in pixel or all coordinates.
	 */
	Owl.prototype.coordinates = function(position) {
		var coordinate = null;

		if (position === undefined) {
			return $.map(this._coordinates, $.proxy(function(coordinate, index) {
				return this.coordinates(index);
			}, this));
		}

		if (this.settings.center) {
			coordinate = this._coordinates[position];
			coordinate += (this.width() - coordinate + (this._coordinates[position - 1] || 0)) / 2 * (this.settings.rtl ? -1 : 1);
		} else {
			coordinate = this._coordinates[position - 1] || 0;
		}

		return coordinate;
	};

	/**
	 * Calculates the speed for a translation.
	 * @protected
	 * @param {Number} from - The absolute position of the start item.
	 * @param {Number} to - The absolute position of the target item.
	 * @param {Number} [factor=undefined] - The time factor in milliseconds.
	 * @returns {Number} - The time in milliseconds for the translation.
	 */
	Owl.prototype.duration = function(from, to, factor) {
		return Math.min(Math.max(Math.abs(to - from), 1), 6) * Math.abs((factor || this.settings.smartSpeed));
	};

	/**
	 * Slides to the specified item.
	 * @public
	 * @param {Number} position - The position of the item.
	 * @param {Number} [speed] - The time in milliseconds for the transition.
	 */
	Owl.prototype.to = function(position, speed) {
		if (this.settings.loop) {
			var distance = position - this.relative(this.current()),
				revert = this.current(),
				before = this.current(),
				after = this.current() + distance,
				direction = before - after < 0 ? true : false,
				items = this._clones.length + this._items.length;

			if (after < this.settings.items && direction === false) {
				revert = before + this._items.length;
				this.reset(revert);
			} else if (after >= items - this.settings.items && direction === true) {
				revert = before - this._items.length;
				this.reset(revert);
			}
			window.clearTimeout(this.e._goToLoop);
			this.e._goToLoop = window.setTimeout($.proxy(function() {
				this.speed(this.duration(this.current(), revert + distance, speed));
				this.current(revert + distance);
				this.update();
			}, this), 30);
		} else {
			this.speed(this.duration(this.current(), position, speed));
			this.current(position);
			this.update();
		}
	};

	/**
	 * Slides to the next item.
	 * @public
	 * @param {Number} [speed] - The time in milliseconds for the transition.
	 */
	Owl.prototype.next = function(speed) {
		speed = speed || false;
		this.to(this.relative(this.current()) + 1, speed);
	};

	/**
	 * Slides to the previous item.
	 * @public
	 * @param {Number} [speed] - The time in milliseconds for the transition.
	 */
	Owl.prototype.prev = function(speed) {
		speed = speed || false;
		this.to(this.relative(this.current()) - 1, speed);
	};

	/**
	 * Handles the end of an animation.
	 * @protected
	 * @param {Event} event - The event arguments.
	 */
	Owl.prototype.transitionEnd = function(event) {

		// if css2 animation then event object is undefined
		if (event !== undefined) {
			event.stopPropagation();

			// Catch only owl-stage transitionEnd event
			if ((event.target || event.srcElement || event.originalTarget) !== this.$stage.get(0)) {
				return false;
			}
		}

		this.state.inMotion = false;
		this.trigger('translated');
	};

	/**
	 * Gets viewport width.
	 * @protected
	 * @return {Number} - The width in pixel.
	 */
	Owl.prototype.viewport = function() {
		var width;
		if (this.options.responsiveBaseElement !== window) {
			width = $(this.options.responsiveBaseElement).width();
		} else if (window.innerWidth) {
			width = window.innerWidth;
		} else if (document.documentElement && document.documentElement.clientWidth) {
			width = document.documentElement.clientWidth;
		} else {
			throw 'Can not detect viewport width.';
		}
		return width;
	};

	/**
	 * Replaces the current content.
	 * @public
	 * @param {HTMLElement|jQuery|String} content - The new content.
	 */
	Owl.prototype.replace = function(content) {
		this.$stage.empty();
		this._items = [];

		if (content) {
			content = (content instanceof jQuery) ? content : $(content);
		}

		if (this.settings.nestedItemSelector) {
			content = content.find('.' + this.settings.nestedItemSelector);
		}

		content.filter(function() {
			return this.nodeType === 1;
		}).each($.proxy(function(index, item) {
			item = this.prepare(item);
			this.$stage.append(item);
			this._items.push(item);
			this._mergers.push(item.find('[data-merge]').andSelf('[data-merge]').attr('data-merge') * 1 || 1);
		}, this));

		this.reset($.isNumeric(this.settings.startPosition) ? this.settings.startPosition : 0);

		this.invalidate('items');
	};

	/**
	 * Adds an item.
	 * @todo Use `item` instead of `content` for the event arguments.
	 * @public
	 * @param {HTMLElement|jQuery|String} content - The item content to add.
	 * @param {Number} [position] - The relative position at which to insert the item otherwise the item will be added to the end.
	 */
	Owl.prototype.add = function(content, position) {
		position = position === undefined ? this._items.length : this.normalize(position, true);

		this.trigger('add', { content: content, position: position });

		if (this._items.length === 0 || position === this._items.length) {
			this.$stage.append(content);
			this._items.push(content);
			this._mergers.push(content.find('[data-merge]').andSelf('[data-merge]').attr('data-merge') * 1 || 1);
		} else {
			this._items[position].before(content);
			this._items.splice(position, 0, content);
			this._mergers.splice(position, 0, content.find('[data-merge]').andSelf('[data-merge]').attr('data-merge') * 1 || 1);
		}

		this.invalidate('items');

		this.trigger('added', { content: content, position: position });
	};

	/**
	 * Removes an item by its position.
	 * @todo Use `item` instead of `content` for the event arguments.
	 * @public
	 * @param {Number} position - The relative position of the item to remove.
	 */
	Owl.prototype.remove = function(position) {
		position = this.normalize(position, true);

		if (position === undefined) {
			return;
		}

		this.trigger('remove', { content: this._items[position], position: position });

		this._items[position].remove();
		this._items.splice(position, 1);
		this._mergers.splice(position, 1);

		this.invalidate('items');

		this.trigger('removed', { content: null, position: position });
	};

	/**
	 * Adds triggerable events.
	 * @protected
	 */
	Owl.prototype.addTriggerableEvents = function() {
		var handler = $.proxy(function(callback, event) {
			return $.proxy(function(e) {
				if (e.relatedTarget !== this) {
					this.suppress([ event ]);
					callback.apply(this, [].slice.call(arguments, 1));
					this.release([ event ]);
				}
			}, this);
		}, this);

		$.each({
			'next': this.next,
			'prev': this.prev,
			'to': this.to,
			'destroy': this.destroy,
			'refresh': this.refresh,
			'replace': this.replace,
			'add': this.add,
			'remove': this.remove
		}, $.proxy(function(event, callback) {
			this.$element.on(event + '.owl.carousel', handler(callback, event + '.owl.carousel'));
		}, this));

	};

	/**
	 * Watches the visibility of the carousel element.
	 * @protected
	 */
	Owl.prototype.watchVisibility = function() {

		// test on zepto
		if (!isElVisible(this.$element.get(0))) {
			this.$element.addClass('owl-hidden');
			window.clearInterval(this.e._checkVisibile);
			this.e._checkVisibile = window.setInterval($.proxy(checkVisible, this), 500);
		}

		function isElVisible(el) {
			return el.offsetWidth > 0 && el.offsetHeight > 0;
		}

		function checkVisible() {
			if (isElVisible(this.$element.get(0))) {
				this.$element.removeClass('owl-hidden');
				this.refresh();
				window.clearInterval(this.e._checkVisibile);
			}
		}
	};

	/**
	 * Preloads images with auto width.
	 * @protected
	 * @todo Still to test
	 */
	Owl.prototype.preloadAutoWidthImages = function(imgs) {
		var loaded, that, $el, img;

		loaded = 0;
		that = this;
		imgs.each(function(i, el) {
			$el = $(el);
			img = new Image();

			img.onload = function() {
				loaded++;
				$el.attr('src', img.src);
				$el.css('opacity', 1);
				if (loaded >= imgs.length) {
					that.state.imagesLoaded = true;
					that.initialize();
				}
			};

			img.src = $el.attr('src') || $el.attr('data-src') || $el.attr('data-src-retina');
		});
	};

	/**
	 * Destroys the carousel.
	 * @public
	 */
	Owl.prototype.destroy = function() {

		if (this.$element.hasClass(this.settings.themeClass)) {
			this.$element.removeClass(this.settings.themeClass);
		}

		if (this.settings.responsive !== false) {
			$(window).off('resize.owl.carousel');
		}

		if (this.transitionEndVendor) {
			this.off(this.$stage.get(0), this.transitionEndVendor, this.e._transitionEnd);
		}

		for ( var i in this._plugins) {
			this._plugins[i].destroy();
		}

		if (this.settings.mouseDrag || this.settings.touchDrag) {
			this.$stage.off('mousedown touchstart touchcancel');
			$(document).off('.owl.dragEvents');
			this.$stage.get(0).onselectstart = function() {};
			this.$stage.off('dragstart', function() { return false });
		}

		// remove event handlers in the ".owl.carousel" namespace
		this.$element.off('.owl');

		this.$stage.children('.cloned').remove();
		this.e = null;
		this.$element.removeData('owlCarousel');

		this.$stage.children().contents().unwrap();
		this.$stage.children().unwrap();
		this.$stage.unwrap();
	};

	/**
	 * Operators to calculate right-to-left and left-to-right.
	 * @protected
	 * @param {Number} [a] - The left side operand.
	 * @param {String} [o] - The operator.
	 * @param {Number} [b] - The right side operand.
	 */
	Owl.prototype.op = function(a, o, b) {
		var rtl = this.settings.rtl;
		switch (o) {
			case '<':
				return rtl ? a > b : a < b;
			case '>':
				return rtl ? a < b : a > b;
			case '>=':
				return rtl ? a <= b : a >= b;
			case '<=':
				return rtl ? a >= b : a <= b;
			default:
				break;
		}
	};

	/**
	 * Attaches to an internal event.
	 * @protected
	 * @param {HTMLElement} element - The event source.
	 * @param {String} event - The event name.
	 * @param {Function} listener - The event handler to attach.
	 * @param {Boolean} capture - Wether the event should be handled at the capturing phase or not.
	 */
	Owl.prototype.on = function(element, event, listener, capture) {
		if (element.addEventListener) {
			element.addEventListener(event, listener, capture);
		} else if (element.attachEvent) {
			element.attachEvent('on' + event, listener);
		}
	};

	/**
	 * Detaches from an internal event.
	 * @protected
	 * @param {HTMLElement} element - The event source.
	 * @param {String} event - The event name.
	 * @param {Function} listener - The attached event handler to detach.
	 * @param {Boolean} capture - Wether the attached event handler was registered as a capturing listener or not.
	 */
	Owl.prototype.off = function(element, event, listener, capture) {
		if (element.removeEventListener) {
			element.removeEventListener(event, listener, capture);
		} else if (element.detachEvent) {
			element.detachEvent('on' + event, listener);
		}
	};

	/**
	 * Triggers an public event.
	 * @protected
	 * @param {String} name - The event name.
	 * @param {*} [data=null] - The event data.
	 * @param {String} [namespace=.owl.carousel] - The event namespace.
	 * @returns {Event} - The event arguments.
	 */
	Owl.prototype.trigger = function(name, data, namespace) {
		var status = {
			item: { count: this._items.length, index: this.current() }
		}, handler = $.camelCase(
			$.grep([ 'on', name, namespace ], function(v) { return v })
				.join('-').toLowerCase()
		), event = $.Event(
			[ name, 'owl', namespace || 'carousel' ].join('.').toLowerCase(),
			$.extend({ relatedTarget: this }, status, data)
		);

		if (!this._supress[name]) {
			$.each(this._plugins, function(name, plugin) {
				if (plugin.onTrigger) {
					plugin.onTrigger(event);
				}
			});

			this.$element.trigger(event);

			if (this.settings && typeof this.settings[handler] === 'function') {
				this.settings[handler].apply(this, event);
			}
		}

		return event;
	};

	/**
	 * Suppresses events.
	 * @protected
	 * @param {Array.<String>} events - The events to suppress.
	 */
	Owl.prototype.suppress = function(events) {
		$.each(events, $.proxy(function(index, event) {
			this._supress[event] = true;
		}, this));
	}

	/**
	 * Releases suppressed events.
	 * @protected
	 * @param {Array.<String>} events - The events to release.
	 */
	Owl.prototype.release = function(events) {
		$.each(events, $.proxy(function(index, event) {
			delete this._supress[event];
		}, this));
	}

	/**
	 * Checks the availability of some browser features.
	 * @protected
	 */
	Owl.prototype.browserSupport = function() {
		this.support3d = isPerspective();

		if (this.support3d) {
			this.transformVendor = isTransform();

			// take transitionend event name by detecting transition
			var endVendors = [ 'transitionend', 'webkitTransitionEnd', 'transitionend', 'oTransitionEnd' ];
			this.transitionEndVendor = endVendors[isTransition()];

			// take vendor name from transform name
			this.vendorName = this.transformVendor.replace(/Transform/i, '');
			this.vendorName = this.vendorName !== '' ? '-' + this.vendorName.toLowerCase() + '-' : '';
		}

		this.state.orientation = window.orientation;
	};

	/**
	 * Get touch/drag coordinats.
	 * @private
	 * @param {event} - mousedown/touchstart event
	 * @returns {object} - Contains X and Y of current mouse/touch position
	 */

	function getTouches(event) {
		if (event.touches !== undefined) {
			return {
				x: event.touches[0].pageX,
				y: event.touches[0].pageY
			};
		}

		if (event.touches === undefined) {
			if (event.pageX !== undefined) {
				return {
					x: event.pageX,
					y: event.pageY
				};
			}

		if (event.pageX === undefined) {
			return {
					x: event.clientX,
					y: event.clientY
				};
			}
		}
	}

	/**
	 * Checks for CSS support.
	 * @private
	 * @param {Array} array - The CSS properties to check for.
	 * @returns {Array} - Contains the supported CSS property name and its index or `false`.
	 */
	function isStyleSupported(array) {
		var p, s, fake = document.createElement('div'), list = array;
		for (p in list) {
			s = list[p];
			if (typeof fake.style[s] !== 'undefined') {
				fake = null;
				return [ s, p ];
			}
		}
		return [ false ];
	}

	/**
	 * Checks for CSS transition support.
	 * @private
	 * @todo Realy bad design
	 * @returns {Number}
	 */
	function isTransition() {
		return isStyleSupported([ 'transition', 'WebkitTransition', 'MozTransition', 'OTransition' ])[1];
	}

	/**
	 * Checks for CSS transform support.
	 * @private
	 * @returns {String} The supported property name or false.
	 */
	function isTransform() {
		return isStyleSupported([ 'transform', 'WebkitTransform', 'MozTransform', 'OTransform', 'msTransform' ])[0];
	}

	/**
	 * Checks for CSS perspective support.
	 * @private
	 * @returns {String} The supported property name or false.
	 */
	function isPerspective() {
		return isStyleSupported([ 'perspective', 'webkitPerspective', 'MozPerspective', 'OPerspective', 'MsPerspective' ])[0];
	}

	/**
	 * Checks wether touch is supported or not.
	 * @private
	 * @returns {Boolean}
	 */
	function isTouchSupport() {
		return 'ontouchstart' in window || !!(navigator.msMaxTouchPoints);
	}

	/**
	 * Checks wether touch is supported or not for IE.
	 * @private
	 * @returns {Boolean}
	 */
	function isTouchSupportIE() {
		return window.navigator.msPointerEnabled;
	}

	/**
	 * The jQuery Plugin for the Owl Carousel
	 * @public
	 */
	$.fn.owlCarousel = function(options) {
		return this.each(function() {
			if (!$(this).data('owlCarousel')) {
				$(this).data('owlCarousel', new Owl(this, options));
			}
		});
	};

	/**
	 * The constructor for the jQuery Plugin
	 * @public
	 */
	$.fn.owlCarousel.Constructor = Owl;

})(window.Zepto || window.jQuery, window, document);

/**
 * Lazy Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

	/**
	 * Creates the lazy plugin.
	 * @class The Lazy Plugin
	 * @param {Owl} carousel - The Owl Carousel
	 */
	var Lazy = function(carousel) {

		/**
		 * Reference to the core.
		 * @protected
		 * @type {Owl}
		 */
		this._core = carousel;

		/**
		 * Already loaded items.
		 * @protected
		 * @type {Array.<jQuery>}
		 */
		this._loaded = [];

		/**
		 * Event handlers.
		 * @protected
		 * @type {Object}
		 */
		this._handlers = {
			'initialized.owl.carousel change.owl.carousel': $.proxy(function(e) {
				if (!e.namespace) {
					return;
				}

				if (!this._core.settings || !this._core.settings.lazyLoad) {
					return;
				}

				if ((e.property && e.property.name == 'position') || e.type == 'initialized') {
					var settings = this._core.settings,
						n = (settings.center && Math.ceil(settings.items / 2) || settings.items),
						i = ((settings.center && n * -1) || 0),
						position = ((e.property && e.property.value) || this._core.current()) + i,
						clones = this._core.clones().length,
						load = $.proxy(function(i, v) { this.load(v) }, this);

					while (i++ < n) {
						this.load(clones / 2 + this._core.relative(position));
						clones && $.each(this._core.clones(this._core.relative(position++)), load);
					}
				}
			}, this)
		};

		// set the default options
		this._core.options = $.extend({}, Lazy.Defaults, this._core.options);

		// register event handler
		this._core.$element.on(this._handlers);
	}

	/**
	 * Default options.
	 * @public
	 */
	Lazy.Defaults = {
		lazyLoad: false
	}

	/**
	 * Loads all resources of an item at the specified position.
	 * @param {Number} position - The absolute position of the item.
	 * @protected
	 */
	Lazy.prototype.load = function(position) {
		var $item = this._core.$stage.children().eq(position),
			$elements = $item && $item.find('.owl-lazy');

		if (!$elements || $.inArray($item.get(0), this._loaded) > -1) {
			return;
		}

		$elements.each($.proxy(function(index, element) {
			var $element = $(element), image,
				url = (window.devicePixelRatio > 1 && $element.attr('data-src-retina')) || $element.attr('data-src');

			this._core.trigger('load', { element: $element, url: url }, 'lazy');

			if ($element.is('img')) {
				$element.one('load.owl.lazy', $.proxy(function() {
					$element.css('opacity', 1);
					this._core.trigger('loaded', { element: $element, url: url }, 'lazy');
				}, this)).attr('src', url);
			} else {
				image = new Image();
				image.onload = $.proxy(function() {
					$element.css({
						'background-image': 'url(' + url + ')',
						'opacity': '1'
					});
					this._core.trigger('loaded', { element: $element, url: url }, 'lazy');
				}, this);
				image.src = url;
			}
		}, this));

		this._loaded.push($item.get(0));
	}

	/**
	 * Destroys the plugin.
	 * @public
	 */
	Lazy.prototype.destroy = function() {
		var handler, property;

		for (handler in this.handlers) {
			this._core.$element.off(handler, this.handlers[handler]);
		}
		for (property in Object.getOwnPropertyNames(this)) {
			typeof this[property] != 'function' && (this[property] = null);
		}
	}

	$.fn.owlCarousel.Constructor.Plugins.Lazy = Lazy;

})(window.Zepto || window.jQuery, window, document);

/**
 * AutoHeight Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

	/**
	 * Creates the auto height plugin.
	 * @class The Auto Height Plugin
	 * @param {Owl} carousel - The Owl Carousel
	 */
	var AutoHeight = function(carousel) {
		/**
		 * Reference to the core.
		 * @protected
		 * @type {Owl}
		 */
		this._core = carousel;

		/**
		 * All event handlers.
		 * @protected
		 * @type {Object}
		 */
		this._handlers = {
			'initialized.owl.carousel': $.proxy(function() {
				if (this._core.settings.autoHeight) {
					this.update();
				}
			}, this),
			'changed.owl.carousel': $.proxy(function(e) {
				if (this._core.settings.autoHeight && e.property.name == 'position'){
					this.update();
				}
			}, this),
			'loaded.owl.lazy': $.proxy(function(e) {
				if (this._core.settings.autoHeight && e.element.closest('.' + this._core.settings.itemClass)
					=== this._core.$stage.children().eq(this._core.current())) {
					this.update();
				}
			}, this)
		};

		// set default options
		this._core.options = $.extend({}, AutoHeight.Defaults, this._core.options);

		// register event handlers
		this._core.$element.on(this._handlers);
	};

	/**
	 * Default options.
	 * @public
	 */
	AutoHeight.Defaults = {
		autoHeight: false,
		autoHeightClass: 'owl-height'
	};

	/**
	 * Updates the view.
	 */
	AutoHeight.prototype.update = function() {
		this._core.$stage.parent()
			.height(this._core.$stage.children().eq(this._core.current()).height())
			.addClass(this._core.settings.autoHeightClass);
	};

	AutoHeight.prototype.destroy = function() {
		var handler, property;

		for (handler in this._handlers) {
			this._core.$element.off(handler, this._handlers[handler]);
		}
		for (property in Object.getOwnPropertyNames(this)) {
			typeof this[property] != 'function' && (this[property] = null);
		}
	};

	$.fn.owlCarousel.Constructor.Plugins.AutoHeight = AutoHeight;

})(window.Zepto || window.jQuery, window, document);

/**
 * Video Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

	/**
	 * Creates the video plugin.
	 * @class The Video Plugin
	 * @param {Owl} carousel - The Owl Carousel
	 */
	var Video = function(carousel) {
		/**
		 * Reference to the core.
		 * @protected
		 * @type {Owl}
		 */
		this._core = carousel;

		/**
		 * Cache all video URLs.
		 * @protected
		 * @type {Object}
		 */
		this._videos = {};

		/**
		 * Current playing item.
		 * @protected
		 * @type {jQuery}
		 */
		this._playing = null;

		/**
		 * Whether this is in fullscreen or not.
		 * @protected
		 * @type {Boolean}
		 */
		this._fullscreen = false;

		/**
		 * All event handlers.
		 * @protected
		 * @type {Object}
		 */
		this._handlers = {
			'resize.owl.carousel': $.proxy(function(e) {
				if (this._core.settings.video && !this.isInFullScreen()) {
					e.preventDefault();
				}
			}, this),
			'refresh.owl.carousel changed.owl.carousel': $.proxy(function(e) {
				if (this._playing) {
					this.stop();
				}
			}, this),
			'prepared.owl.carousel': $.proxy(function(e) {
				var $element = $(e.content).find('.owl-video');
				if ($element.length) {
					$element.css('display', 'none');
					this.fetch($element, $(e.content));
				}
			}, this)
		};

		// set default options
		this._core.options = $.extend({}, Video.Defaults, this._core.options);

		// register event handlers
		this._core.$element.on(this._handlers);

		this._core.$element.on('click.owl.video', '.owl-video-play-icon', $.proxy(function(e) {
			this.play(e);
		}, this));
	};

	/**
	 * Default options.
	 * @public
	 */
	Video.Defaults = {
		video: false,
		videoHeight: false,
		videoWidth: false
	};

	/**
	 * Gets the video ID and the type (YouTube/Vimeo only).
	 * @protected
	 * @param {jQuery} target - The target containing the video data.
	 * @param {jQuery} item - The item containing the video.
	 */
	Video.prototype.fetch = function(target, item) {

		var type = target.attr('data-vimeo-id') ? 'vimeo' : 'youtube',
			id = target.attr('data-vimeo-id') || target.attr('data-youtube-id'),
			width = target.attr('data-width') || this._core.settings.videoWidth,
			height = target.attr('data-height') || this._core.settings.videoHeight,
			url = target.attr('href');

		if (url) {
			id = url.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);

			if (id[3].indexOf('youtu') > -1) {
				type = 'youtube';
			} else if (id[3].indexOf('vimeo') > -1) {
				type = 'vimeo';
			} else {
				throw new Error('Video URL not supported.');
			}
			id = id[6];
		} else {
			throw new Error('Missing video URL.');
		}

		this._videos[url] = {
			type: type,
			id: id,
			width: width,
			height: height
		};

		item.attr('data-video', url);

		this.thumbnail(target, this._videos[url]);
	};

	/**
	 * Creates video thumbnail.
	 * @protected
	 * @param {jQuery} target - The target containing the video data.
	 * @param {Object} info - The video info object.
	 * @see `fetch`
	 */
	Video.prototype.thumbnail = function(target, video) {

		var tnLink,
			icon,
			path,
			dimensions = video.width && video.height ? 'style="width:' + video.width + 'px;height:' + video.height + 'px;"' : '',
			customTn = target.find('img'),
			srcType = 'src',
			lazyClass = '',
			settings = this._core.settings,
			create = function(path) {
				icon = '<div class="owl-video-play-icon"></div>';

				if (settings.lazyLoad) {
					tnLink = '<div class="owl-video-tn ' + lazyClass + '" ' + srcType + '="' + path + '"></div>';
				} else {
					tnLink = '<div class="owl-video-tn" style="opacity:1;background-image:url(' + path + ')"></div>';
				}
				target.after(tnLink);
				target.after(icon);
			};

		// wrap video content into owl-video-wrapper div
		target.wrap('<div class="owl-video-wrapper"' + dimensions + '></div>');

		if (this._core.settings.lazyLoad) {
			srcType = 'data-src';
			lazyClass = 'owl-lazy';
		}

		// custom thumbnail
		if (customTn.length) {
			create(customTn.attr(srcType));
			customTn.remove();
			return false;
		}

		if (video.type === 'youtube') {
			path = "http://img.youtube.com/vi/" + video.id + "/hqdefault.jpg";
			create(path);
		} else if (video.type === 'vimeo') {
			$.ajax({
				type: 'GET',
				url: 'http://vimeo.com/api/v2/video/' + video.id + '.json',
				jsonp: 'callback',
				dataType: 'jsonp',
				success: function(data) {
					path = data[0].thumbnail_large;
					create(path);
				}
			});
		}
	};

	/**
	 * Stops the current video.
	 * @public
	 */
	Video.prototype.stop = function() {
		this._core.trigger('stop', null, 'video');
		this._playing.find('.owl-video-frame').remove();
		this._playing.removeClass('owl-video-playing');
		this._playing = null;
	};

	/**
	 * Starts the current video.
	 * @public
	 * @param {Event} ev - The event arguments.
	 */
	Video.prototype.play = function(ev) {
		this._core.trigger('play', null, 'video');

		if (this._playing) {
			this.stop();
		}

		var target = $(ev.target || ev.srcElement),
			item = target.closest('.' + this._core.settings.itemClass),
			video = this._videos[item.attr('data-video')],
			width = video.width || '100%',
			height = video.height || this._core.$stage.height(),
			html, wrap;

		if (video.type === 'youtube') {
			html = '<iframe width="' + width + '" height="' + height + '" src="http://www.youtube.com/embed/'
				+ video.id + '?autoplay=1&v=' + video.id + '" frameborder="0" allowfullscreen></iframe>';
		} else if (video.type === 'vimeo') {
			html = '<iframe src="http://player.vimeo.com/video/' + video.id + '?autoplay=1" width="' + width
				+ '" height="' + height
				+ '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
		}

		item.addClass('owl-video-playing');
		this._playing = item;

		wrap = $('<div style="height:' + height + 'px; width:' + width + 'px" class="owl-video-frame">'
			+ html + '</div>');
		target.after(wrap);
	};

	/**
	 * Checks whether an video is currently in full screen mode or not.
	 * @todo Bad style because looks like a readonly method but changes members.
	 * @protected
	 * @returns {Boolean}
	 */
	Video.prototype.isInFullScreen = function() {

		// if Vimeo Fullscreen mode
		var element = document.fullscreenElement || document.mozFullScreenElement
			|| document.webkitFullscreenElement;

		if (element && $(element).parent().hasClass('owl-video-frame')) {
			this._core.speed(0);
			this._fullscreen = true;
		}

		if (element && this._fullscreen && this._playing) {
			return false;
		}

		// comming back from fullscreen
		if (this._fullscreen) {
			this._fullscreen = false;
			return false;
		}

		// check full screen mode and window orientation
		if (this._playing) {
			if (this._core.state.orientation !== window.orientation) {
				this._core.state.orientation = window.orientation;
				return false;
			}
		}

		return true;
	};

	/**
	 * Destroys the plugin.
	 */
	Video.prototype.destroy = function() {
		var handler, property;

		this._core.$element.off('click.owl.video');

		for (handler in this._handlers) {
			this._core.$element.off(handler, this._handlers[handler]);
		}
		for (property in Object.getOwnPropertyNames(this)) {
			typeof this[property] != 'function' && (this[property] = null);
		}
	};

	$.fn.owlCarousel.Constructor.Plugins.Video = Video;

})(window.Zepto || window.jQuery, window, document);

/**
 * Animate Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

	/**
	 * Creates the animate plugin.
	 * @class The Navigation Plugin
	 * @param {Owl} scope - The Owl Carousel
	 */
	var Animate = function(scope) {
		this.core = scope;
		this.core.options = $.extend({}, Animate.Defaults, this.core.options);
		this.swapping = true;
		this.previous = undefined;
		this.next = undefined;

		this.handlers = {
			'change.owl.carousel': $.proxy(function(e) {
				if (e.property.name == 'position') {
					this.previous = this.core.current();
					this.next = e.property.value;
				}
			}, this),
			'drag.owl.carousel dragged.owl.carousel translated.owl.carousel': $.proxy(function(e) {
				this.swapping = e.type == 'translated';
			}, this),
			'translate.owl.carousel': $.proxy(function(e) {
				if (this.swapping && (this.core.options.animateOut || this.core.options.animateIn)) {
					this.swap();
				}
			}, this)
		};

		this.core.$element.on(this.handlers);
	};

	/**
	 * Default options.
	 * @public
	 */
	Animate.Defaults = {
		animateOut: false,
		animateIn: false
	};

	/**
	 * Toggles the animation classes whenever an translations starts.
	 * @protected
	 * @returns {Boolean|undefined}
	 */
	Animate.prototype.swap = function() {

		if (this.core.settings.items !== 1 || !this.core.support3d) {
			return;
		}

		this.core.speed(0);

		var left,
			clear = $.proxy(this.clear, this),
			previous = this.core.$stage.children().eq(this.previous),
			next = this.core.$stage.children().eq(this.next),
			incoming = this.core.settings.animateIn,
			outgoing = this.core.settings.animateOut;

		if (this.core.current() === this.previous) {
			return;
		}

		if (outgoing) {
			left = this.core.coordinates(this.previous) - this.core.coordinates(this.next);
			previous.css( { 'left': left + 'px' } )
				.addClass('animated owl-animated-out')
				.addClass(outgoing)
				.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', clear);
		}

		if (incoming) {
			next.addClass('animated owl-animated-in')
				.addClass(incoming)
				.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', clear);
		}
	};

	Animate.prototype.clear = function(e) {
		$(e.target).css( { 'left': '' } )
			.removeClass('animated owl-animated-out owl-animated-in')
			.removeClass(this.core.settings.animateIn)
			.removeClass(this.core.settings.animateOut);
		this.core.transitionEnd();
	}

	/**
	 * Destroys the plugin.
	 * @public
	 */
	Animate.prototype.destroy = function() {
		var handler, property;

		for (handler in this.handlers) {
			this.core.$element.off(handler, this.handlers[handler]);
		}
		for (property in Object.getOwnPropertyNames(this)) {
			typeof this[property] != 'function' && (this[property] = null);
		}
	};

	$.fn.owlCarousel.Constructor.Plugins.Animate = Animate;

})(window.Zepto || window.jQuery, window, document);

/**
 * Autoplay Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

	/**
	 * Creates the autoplay plugin.
	 * @class The Autoplay Plugin
	 * @param {Owl} scope - The Owl Carousel
	 */
	var Autoplay = function(scope) {
		this.core = scope;
		this.core.options = $.extend({}, Autoplay.Defaults, this.core.options);

		this.handlers = {
			'translated.owl.carousel refreshed.owl.carousel': $.proxy(function() {
				this.autoplay();
			}, this),
			'play.owl.autoplay': $.proxy(function(e, t, s) {
				this.play(t, s);
			}, this),
			'stop.owl.autoplay': $.proxy(function() {
				this.stop();
			}, this),
			'mouseover.owl.autoplay': $.proxy(function() {
				if (this.core.settings.autoplayHoverPause) {
					this.pause();
				}
			}, this),
			'mouseleave.owl.autoplay': $.proxy(function() {
				if (this.core.settings.autoplayHoverPause) {
					this.autoplay();
				}
			}, this)
		};

		this.core.$element.on(this.handlers);
	};

	/**
	 * Default options.
	 * @public
	 */
	Autoplay.Defaults = {
		autoplay: false,
		autoplayTimeout: 5000,
		autoplayHoverPause: false,
		autoplaySpeed: false
	};

	/**
	 * @protected
	 * @todo Must be documented.
	 */
	Autoplay.prototype.autoplay = function() {
		if (this.core.settings.autoplay && !this.core.state.videoPlay) {
			window.clearInterval(this.interval);

			this.interval = window.setInterval($.proxy(function() {
				this.play();
			}, this), this.core.settings.autoplayTimeout);
		} else {
			window.clearInterval(this.interval);
		}
	};

	/**
	 * Starts the autoplay.
	 * @public
	 * @param {Number} [timeout] - ...
	 * @param {Number} [speed] - ...
	 * @returns {Boolean|undefined} - ...
	 * @todo Must be documented.
	 */
	Autoplay.prototype.play = function(timeout, speed) {
		// if tab is inactive - doesnt work in <IE10
		if (document.hidden === true) {
			return;
		}

		if (this.core.state.isTouch || this.core.state.isScrolling
			|| this.core.state.isSwiping || this.core.state.inMotion) {
			return;
		}

		if (this.core.settings.autoplay === false) {
			window.clearInterval(this.interval);
			return;
		}

		this.core.next(this.core.settings.autoplaySpeed);
	};

	/**
	 * Stops the autoplay.
	 * @public
	 */
	Autoplay.prototype.stop = function() {
		window.clearInterval(this.interval);
	};

	/**
	 * Pauses the autoplay.
	 * @public
	 */
	Autoplay.prototype.pause = function() {
		window.clearInterval(this.interval);
	};

	/**
	 * Destroys the plugin.
	 */
	Autoplay.prototype.destroy = function() {
		var handler, property;

		window.clearInterval(this.interval);

		for (handler in this.handlers) {
			this.core.$element.off(handler, this.handlers[handler]);
		}
		for (property in Object.getOwnPropertyNames(this)) {
			typeof this[property] != 'function' && (this[property] = null);
		}
	};

	$.fn.owlCarousel.Constructor.Plugins.autoplay = Autoplay;

})(window.Zepto || window.jQuery, window, document);

/**
 * Navigation Plugin
 * @version 2.0.0
 * @author Artus Kolanowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {
	'use strict';

	/**
	 * Creates the navigation plugin.
	 * @class The Navigation Plugin
	 * @param {Owl} carousel - The Owl Carousel.
	 */
	var Navigation = function(carousel) {
		/**
		 * Reference to the core.
		 * @protected
		 * @type {Owl}
		 */
		this._core = carousel;

		/**
		 * Indicates whether the plugin is initialized or not.
		 * @protected
		 * @type {Boolean}
		 */
		this._initialized = false;

		/**
		 * The current paging indexes.
		 * @protected
		 * @type {Array}
		 */
		this._pages = [];

		/**
		 * All DOM elements of the user interface.
		 * @protected
		 * @type {Object}
		 */
		this._controls = {};

		/**
		 * Markup for an indicator.
		 * @protected
		 * @type {Array.<String>}
		 */
		this._templates = [];

		/**
		 * The carousel element.
		 * @type {jQuery}
		 */
		this.$element = this._core.$element;

		/**
		 * Overridden methods of the carousel.
		 * @protected
		 * @type {Object}
		 */
		this._overrides = {
			next: this._core.next,
			prev: this._core.prev,
			to: this._core.to
		};

		/**
		 * All event handlers.
		 * @protected
		 * @type {Object}
		 */
		this._handlers = {
			'prepared.owl.carousel': $.proxy(function(e) {
				if (this._core.settings.dotsData) {
					this._templates.push($(e.content).find('[data-dot]').andSelf('[data-dot]').attr('data-dot'));
				}
			}, this),
			'add.owl.carousel': $.proxy(function(e) {
				if (this._core.settings.dotsData) {
					this._templates.splice(e.position, 0, $(e.content).find('[data-dot]').andSelf('[data-dot]').attr('data-dot'));
				}
			}, this),
			'remove.owl.carousel prepared.owl.carousel': $.proxy(function(e) {
				if (this._core.settings.dotsData) {
					this._templates.splice(e.position, 1);
				}
			}, this),
			'change.owl.carousel': $.proxy(function(e) {
				if (e.property.name == 'position') {
					if (!this._core.state.revert && !this._core.settings.loop && this._core.settings.navRewind) {
						var current = this._core.current(),
							maximum = this._core.maximum(),
							minimum = this._core.minimum();
						e.data = e.property.value > maximum
							? current >= maximum ? minimum : maximum
							: e.property.value < minimum ? maximum : e.property.value;
					}
				}
			}, this),
			'changed.owl.carousel': $.proxy(function(e) {
				if (e.property.name == 'position') {
					this.draw();
				}
			}, this),
			'refreshed.owl.carousel': $.proxy(function() {
				if (!this._initialized) {
					this.initialize();
					this._initialized = true;
				}
				this._core.trigger('refresh', null, 'navigation');
				this.update();
				this.draw();
				this._core.trigger('refreshed', null, 'navigation');
			}, this)
		};

		// set default options
		this._core.options = $.extend({}, Navigation.Defaults, this._core.options);

		// register event handlers
		this.$element.on(this._handlers);
	}

	/**
	 * Default options.
	 * @public
	 * @todo Rename `slideBy` to `navBy`
	 */
	Navigation.Defaults = {
		nav: false,
		navRewind: true,
		navText: [ 'prev', 'next' ],
		navSpeed: false,
		navElement: 'div',
		navContainer: false,
		navContainerClass: 'owl-nav',
		navClass: [ 'owl-prev', 'owl-next' ],
		slideBy: 1,
		dotClass: 'owl-dot',
		dotsClass: 'owl-dots',
		dots: true,
		dotsEach: false,
		dotData: false,
		dotsSpeed: false,
		dotsContainer: false,
		controlsClass: 'owl-controls'
	}

	/**
	 * Initializes the layout of the plugin and extends the carousel.
	 * @protected
	 */
	Navigation.prototype.initialize = function() {
		var $container, override,
			options = this._core.settings;

		// create the indicator template
		if (!options.dotsData) {
			this._templates = [ $('<div>')
				.addClass(options.dotClass)
				.append($('<span>'))
				.prop('outerHTML') ];
		}

		// create controls container if needed
		if (!options.navContainer || !options.dotsContainer) {
			this._controls.$container = $('<div>')
				.addClass(options.controlsClass)
				.appendTo(this.$element);
		}

		// create DOM structure for absolute navigation
		this._controls.$indicators = options.dotsContainer ? $(options.dotsContainer)
			: $('<div>').hide().addClass(options.dotsClass).appendTo(this._controls.$container);

		this._controls.$indicators.on('click', 'div', $.proxy(function(e) {
			var index = $(e.target).parent().is(this._controls.$indicators)
				? $(e.target).index() : $(e.target).parent().index();

			e.preventDefault();

			this.to(index, options.dotsSpeed);
		}, this));

		// create DOM structure for relative navigation
		$container = options.navContainer ? $(options.navContainer)
			: $('<div>').addClass(options.navContainerClass).prependTo(this._controls.$container);

		this._controls.$next = $('<' + options.navElement + '>');
		this._controls.$previous = this._controls.$next.clone();

		this._controls.$previous
			.addClass(options.navClass[0])
			.html(options.navText[0])
			.hide()
			.prependTo($container)
			.on('click', $.proxy(function(e) {
				this.prev(options.navSpeed);
			}, this));
		this._controls.$next
			.addClass(options.navClass[1])
			.html(options.navText[1])
			.hide()
			.appendTo($container)
			.on('click', $.proxy(function(e) {
				this.next(options.navSpeed);
			}, this));

		// override public methods of the carousel
		for (override in this._overrides) {
			this._core[override] = $.proxy(this[override], this);
		}
	}

	/**
	 * Destroys the plugin.
	 * @protected
	 */
	Navigation.prototype.destroy = function() {
		var handler, control, property, override;

		for (handler in this._handlers) {
			this.$element.off(handler, this._handlers[handler]);
		}
		for (control in this._controls) {
			this._controls[control].remove();
		}
		for (override in this.overides) {
			this._core[override] = this._overrides[override];
		}
		for (property in Object.getOwnPropertyNames(this)) {
			typeof this[property] != 'function' && (this[property] = null);
		}
	}

	/**
	 * Updates the internal state.
	 * @protected
	 */
	Navigation.prototype.update = function() {
		var i, j, k,
			options = this._core.settings,
			lower = this._core.clones().length / 2,
			upper = lower + this._core.items().length,
			size = options.center || options.autoWidth || options.dotData
				? 1 : options.dotsEach || options.items;

		if (options.slideBy !== 'page') {
			options.slideBy = Math.min(options.slideBy, options.items);
		}

		if (options.dots || options.slideBy == 'page') {
			this._pages = [];

			for (i = lower, j = 0, k = 0; i < upper; i++) {
				if (j >= size || j === 0) {
					this._pages.push({
						start: i - lower,
						end: i - lower + size - 1
					});
					j = 0, ++k;
				}
				j += this._core.mergers(this._core.relative(i));
			}
		}
	}

	/**
	 * Draws the user interface.
	 * @todo The option `dotData` wont work.
	 * @protected
	 */
	Navigation.prototype.draw = function() {
		var difference, i, html = '',
			options = this._core.settings,
			$items = this._core.$stage.children(),
			index = this._core.relative(this._core.current());

		if (options.nav && !options.loop && !options.navRewind) {
			this._controls.$previous.toggleClass('disabled', index <= 0);
			this._controls.$next.toggleClass('disabled', index >= this._core.maximum());
		}

		this._controls.$previous.toggle(options.nav);
		this._controls.$next.toggle(options.nav);

		if (options.dots) {
			difference = this._pages.length - this._controls.$indicators.children().length;

			if (options.dotData && difference !== 0) {
				for (i = 0; i < this._controls.$indicators.children().length; i++) {
					html += this._templates[this._core.relative(i)];
				}
				this._controls.$indicators.html(html);
			} else if (difference > 0) {
				html = new Array(difference + 1).join(this._templates[0]);
				this._controls.$indicators.append(html);
			} else if (difference < 0) {
				this._controls.$indicators.children().slice(difference).remove();
			}

			this._controls.$indicators.find('.active').removeClass('active');
			this._controls.$indicators.children().eq($.inArray(this.current(), this._pages)).addClass('active');
		}

		this._controls.$indicators.toggle(options.dots);
	}

	/**
	 * Extends event data.
	 * @protected
	 * @param {Event} event - The event object which gets thrown.
	 */
	Navigation.prototype.onTrigger = function(event) {
		var settings = this._core.settings;

		event.page = {
			index: $.inArray(this.current(), this._pages),
			count: this._pages.length,
			size: settings && (settings.center || settings.autoWidth || settings.dotData
				? 1 : settings.dotsEach || settings.items)
		};
	}

	/**
	 * Gets the current page position of the carousel.
	 * @protected
	 * @returns {Number}
	 */
	Navigation.prototype.current = function() {
		var index = this._core.relative(this._core.current());
		return $.grep(this._pages, function(o) {
			return o.start <= index && o.end >= index;
		}).pop();
	}

	/**
	 * Gets the current succesor/predecessor position.
	 * @protected
	 * @returns {Number}
	 */
	Navigation.prototype.getPosition = function(successor) {
		var position, length,
			options = this._core.settings;

		if (options.slideBy == 'page') {
			position = $.inArray(this.current(), this._pages);
			length = this._pages.length;
			successor ? ++position : --position;
			position = this._pages[((position % length) + length) % length].start;
		} else {
			position = this._core.relative(this._core.current());
			length = this._core.items().length;
			successor ? position += options.slideBy : position -= options.slideBy;
		}
		return position;
	}

	/**
	 * Slides to the next item or page.
	 * @public
	 * @param {Number} [speed=false] - The time in milliseconds for the transition.
	 */
	Navigation.prototype.next = function(speed) {
		$.proxy(this._overrides.to, this._core)(this.getPosition(true), speed);
	}

	/**
	 * Slides to the previous item or page.
	 * @public
	 * @param {Number} [speed=false] - The time in milliseconds for the transition.
	 */
	Navigation.prototype.prev = function(speed) {
		$.proxy(this._overrides.to, this._core)(this.getPosition(false), speed);
	}

	/**
	 * Slides to the specified item or page.
	 * @public
	 * @param {Number} position - The position of the item or page.
	 * @param {Number} [speed] - The time in milliseconds for the transition.
	 * @param {Boolean} [standard=false] - Whether to use the standard behaviour or not.
	 */
	Navigation.prototype.to = function(position, speed, standard) {
		var length;

		if (!standard) {
			length = this._pages.length;
			$.proxy(this._overrides.to, this._core)(this._pages[((position % length) + length) % length].start, speed);
		} else {
			$.proxy(this._overrides.to, this._core)(position, speed);
		}
	}

	$.fn.owlCarousel.Constructor.Plugins.Navigation = Navigation;

})(window.Zepto || window.jQuery, window, document);

/**
 * Hash Plugin
 * @version 2.0.0
 * @author Artus Kolanowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {
	'use strict';

	/**
	 * Creates the hash plugin.
	 * @class The Hash Plugin
	 * @param {Owl} carousel - The Owl Carousel
	 */
	var Hash = function(carousel) {
		/**
		 * Reference to the core.
		 * @protected
		 * @type {Owl}
		 */
		this._core = carousel;

		/**
		 * Hash table for the hashes.
		 * @protected
		 * @type {Object}
		 */
		this._hashes = {};

		/**
		 * The carousel element.
		 * @type {jQuery}
		 */
		this.$element = this._core.$element;

		/**
		 * All event handlers.
		 * @protected
		 * @type {Object}
		 */
		this._handlers = {
			'initialized.owl.carousel': $.proxy(function() {
				if (this._core.settings.startPosition == 'URLHash') {
					$(window).trigger('hashchange.owl.navigation');
				}
			}, this),
			'prepared.owl.carousel': $.proxy(function(e) {
				var hash = $(e.content).find('[data-hash]').andSelf('[data-hash]').attr('data-hash');
				this._hashes[hash] = e.content;
			}, this)
		};

		// set default options
		this._core.options = $.extend({}, Hash.Defaults, this._core.options);

		// register the event handlers
		this.$element.on(this._handlers);

		// register event listener for hash navigation
		$(window).on('hashchange.owl.navigation', $.proxy(function() {
			var hash = window.location.hash.substring(1),
				items = this._core.$stage.children(),
				position = this._hashes[hash] && items.index(this._hashes[hash]) || 0;

			if (!hash) {
				return false;
			}

			this._core.to(position, false, true);
		}, this));
	}

	/**
	 * Default options.
	 * @public
	 */
	Hash.Defaults = {
		URLhashListener: false
	}

	/**
	 * Destroys the plugin.
	 * @public
	 */
	Hash.prototype.destroy = function() {
		var handler, property;

		$(window).off('hashchange.owl.navigation');

		for (handler in this._handlers) {
			this._core.$element.off(handler, this._handlers[handler]);
		}
		for (property in Object.getOwnPropertyNames(this)) {
			typeof this[property] != 'function' && (this[property] = null);
		}
	}

	$.fn.owlCarousel.Constructor.Plugins.Hash = Hash;

})(window.Zepto || window.jQuery, window, document);

/*! sly 1.6.1 - 8th Aug 2015 | https://github.com/darsain/sly */
!function(a,b,c){"use strict";function d(b,p,q){function K(c){var d=0,e=Gb.length;if(yb.old=a.extend({},yb),wb=tb?0:ub[rb.horizontal?"width":"height"](),Bb=zb[rb.horizontal?"width":"height"](),xb=tb?b:vb[rb.horizontal?"outerWidth":"outerHeight"](),Gb.length=0,yb.start=0,yb.end=H(xb-wb,0),Rb){d=Ib.length,Hb=vb.children(rb.itemSelector),Ib.length=0;var f,g=j(vb,rb.horizontal?"paddingLeft":"paddingTop"),h=j(vb,rb.horizontal?"paddingRight":"paddingBottom"),i="border-box"===a(Hb).css("boxSizing"),l="none"!==Hb.css("float"),m=0,n=Hb.length-1;xb=0,Hb.each(function(b,c){var d=a(c),e=c.getBoundingClientRect(),i=G(rb.horizontal?e.width||e.right-e.left:e.height||e.bottom-e.top),k=j(d,rb.horizontal?"marginLeft":"marginTop"),o=j(d,rb.horizontal?"marginRight":"marginBottom"),p=i+k+o,q=!k||!o,r={};r.el=c,r.size=q?i:p,r.half=r.size/2,r.start=xb+(q?k:0),r.center=r.start-G(wb/2-r.size/2),r.end=r.start-wb+r.size,b||(xb+=g),xb+=p,rb.horizontal||l||o&&k&&b>0&&(xb-=I(k,o)),b===n&&(r.end+=h,xb+=h,m=q?o:0),Ib.push(r),f=r}),vb[0].style[rb.horizontal?"width":"height"]=(i?xb:xb-g-h)+"px",xb-=m,Ib.length?(yb.start=Ib[0][Pb?"center":"start"],yb.end=Pb?f.center:xb>wb?f.end:yb.start):yb.start=yb.end=0}if(yb.center=G(yb.end/2+yb.start/2),V(),Ab.length&&Bb>0&&(rb.dynamicHandle?(Cb=yb.start===yb.end?Bb:G(Bb*wb/xb),Cb=k(Cb,rb.minHandleSize,Bb),Ab[0].style[rb.horizontal?"width":"height"]=Cb+"px"):Cb=Ab[rb.horizontal?"outerWidth":"outerHeight"](),Db.end=Bb-Cb,ec||N()),!tb&&wb>0){var o=yb.start,p="";if(Rb)a.each(Ib,function(a,b){Pb?Gb.push(b.center):b.start+b.size>o&&o<=yb.end&&(o=b.start,Gb.push(o),o+=wb,o>yb.end&&o<yb.end+wb&&Gb.push(yb.end))});else for(;o-wb<yb.end;)Gb.push(o),o+=wb;if(Eb[0]&&e!==Gb.length){for(var q=0;q<Gb.length;q++)p+=rb.pageBuilder.call(sb,q);Fb=Eb.html(p).children(),Fb.eq(Jb.activePage).addClass(rb.activeClass)}}if(Jb.slideeSize=xb,Jb.frameSize=wb,Jb.sbSize=Bb,Jb.handleSize=Cb,Rb){c&&null!=rb.startAt&&(T(rb.startAt),sb[Qb?"toCenter":"toStart"](rb.startAt));var r=Ib[Jb.activeItem];L(Qb&&r?r.center:k(yb.dest,yb.start,yb.end))}else c?null!=rb.startAt&&L(rb.startAt,1):L(k(yb.dest,yb.start,yb.end));ob("load")}function L(a,b,c){if(Rb&&cc.released&&!c){var d=U(a),e=a>yb.start&&a<yb.end;Qb?(e&&(a=Ib[d.centerItem].center),Pb&&rb.activateMiddle&&T(d.centerItem)):e&&(a=Ib[d.firstItem].start)}cc.init&&cc.slidee&&rb.elasticBounds?a>yb.end?a=yb.end+(a-yb.end)/6:a<yb.start&&(a=yb.start+(a-yb.start)/6):a=k(a,yb.start,yb.end),ac.start=+new Date,ac.time=0,ac.from=yb.cur,ac.to=a,ac.delta=a-yb.cur,ac.tweesing=cc.tweese||cc.init&&!cc.slidee,ac.immediate=!ac.tweesing&&(b||cc.init&&cc.slidee||!rb.speed),cc.tweese=0,a!==yb.dest&&(yb.dest=a,ob("change"),ec||M()),Z(),V(),W(),O()}function M(){if(sb.initialized){if(!ec)return ec=t(M),void(cc.released&&ob("moveStart"));ac.immediate?yb.cur=ac.to:ac.tweesing?(ac.tweeseDelta=ac.to-yb.cur,D(ac.tweeseDelta)<.1?yb.cur=ac.to:yb.cur+=ac.tweeseDelta*(cc.released?rb.swingSpeed:rb.syncSpeed)):(ac.time=I(+new Date-ac.start,rb.speed),yb.cur=ac.from+ac.delta*a.easing[rb.easing](ac.time/rb.speed,ac.time,0,1,rb.speed)),ac.to===yb.cur?(yb.cur=ac.to,cc.tweese=ec=0):ec=t(M),ob("move"),tb||(m?vb[0].style[m]=n+(rb.horizontal?"translateX":"translateY")+"("+-yb.cur+"px)":vb[0].style[rb.horizontal?"left":"top"]=-G(yb.cur)+"px"),!ec&&cc.released&&ob("moveEnd"),N()}}function N(){Ab.length&&(Db.cur=yb.start===yb.end?0:((cc.init&&!cc.slidee?yb.dest:yb.cur)-yb.start)/(yb.end-yb.start)*Db.end,Db.cur=k(G(Db.cur),Db.start,Db.end),_b.hPos!==Db.cur&&(_b.hPos=Db.cur,m?Ab[0].style[m]=n+(rb.horizontal?"translateX":"translateY")+"("+Db.cur+"px)":Ab[0].style[rb.horizontal?"left":"top"]=Db.cur+"px"))}function O(){Fb[0]&&_b.page!==Jb.activePage&&(_b.page=Jb.activePage,Fb.removeClass(rb.activeClass).eq(Jb.activePage).addClass(rb.activeClass),ob("activePage",_b.page))}function P(){bc.speed&&yb.cur!==(bc.speed>0?yb.end:yb.start)||sb.stop(),hc=cc.init?t(P):0,bc.now=+new Date,bc.pos=yb.cur+(bc.now-bc.lastTime)/1e3*bc.speed,L(cc.init?bc.pos:G(bc.pos)),cc.init||yb.cur!==yb.dest||ob("moveEnd"),bc.lastTime=bc.now}function Q(a,b,d){if("boolean"===e(b)&&(d=b,b=c),b===c)L(yb[a],d);else{if(Qb&&"center"!==a)return;var f=sb.getPos(b);f&&L(f[a],d,!Qb)}}function R(a){return null!=a?i(a)?a>=0&&a<Ib.length?a:-1:Hb.index(a):-1}function S(a){return R(i(a)&&0>a?a+Ib.length:a)}function T(a,b){var c=R(a);return!Rb||0>c?!1:((_b.active!==c||b)&&(Hb.eq(Jb.activeItem).removeClass(rb.activeClass),Hb.eq(c).addClass(rb.activeClass),_b.active=Jb.activeItem=c,W(),ob("active",c)),c)}function U(a){a=k(i(a)?a:yb.dest,yb.start,yb.end);var b={},c=Pb?0:wb/2;if(!tb)for(var d=0,e=Gb.length;e>d;d++){if(a>=yb.end||d===Gb.length-1){b.activePage=Gb.length-1;break}if(a<=Gb[d]+c){b.activePage=d;break}}if(Rb){for(var f=!1,g=!1,h=!1,j=0,l=Ib.length;l>j;j++)if(f===!1&&a<=Ib[j].start+Ib[j].half&&(f=j),h===!1&&a<=Ib[j].center+Ib[j].half&&(h=j),j===l-1||a<=Ib[j].end+Ib[j].half){g=j;break}b.firstItem=i(f)?f:0,b.centerItem=i(h)?h:b.firstItem,b.lastItem=i(g)?g:b.centerItem}return b}function V(b){a.extend(Jb,U(b))}function W(){var a=yb.dest<=yb.start,b=yb.dest>=yb.end,c=(a?1:0)|(b?2:0);if(_b.slideePosState!==c&&(_b.slideePosState=c,Yb.is("button,input")&&Yb.prop("disabled",a),Zb.is("button,input")&&Zb.prop("disabled",b),Yb.add(Vb)[a?"addClass":"removeClass"](rb.disabledClass),Zb.add(Ub)[b?"addClass":"removeClass"](rb.disabledClass)),_b.fwdbwdState!==c&&cc.released&&(_b.fwdbwdState=c,Vb.is("button,input")&&Vb.prop("disabled",a),Ub.is("button,input")&&Ub.prop("disabled",b)),Rb&&null!=Jb.activeItem){var d=0===Jb.activeItem,e=Jb.activeItem>=Ib.length-1,f=(d?1:0)|(e?2:0);_b.itemsButtonState!==f&&(_b.itemsButtonState=f,Wb.is("button,input")&&Wb.prop("disabled",d),Xb.is("button,input")&&Xb.prop("disabled",e),Wb[d?"addClass":"removeClass"](rb.disabledClass),Xb[e?"addClass":"removeClass"](rb.disabledClass))}}function X(a,b,c){if(a=S(a),b=S(b),a>-1&&b>-1&&a!==b&&(!c||b!==a-1)&&(c||b!==a+1)){Hb.eq(a)[c?"insertAfter":"insertBefore"](Ib[b].el);var d=b>a?a:c?b:b-1,e=a>b?a:c?b+1:b,f=a>b;null!=Jb.activeItem&&(a===Jb.activeItem?_b.active=Jb.activeItem=c?f?b+1:b:f?b:b-1:Jb.activeItem>d&&Jb.activeItem<e&&(_b.active=Jb.activeItem+=f?1:-1)),K()}}function Y(a,b){for(var c=0,d=$b[a].length;d>c;c++)if($b[a][c]===b)return c;return-1}function Z(){cc.released&&!sb.isPaused&&sb.resume()}function $(a){return G(k(a,Db.start,Db.end)/Db.end*(yb.end-yb.start))+yb.start}function _(){cc.history[0]=cc.history[1],cc.history[1]=cc.history[2],cc.history[2]=cc.history[3],cc.history[3]=cc.delta}function ab(a){cc.released=0,cc.source=a,cc.slidee="slidee"===a}function bb(b){var c="touchstart"===b.type,d=b.data.source,e="slidee"===d;cc.init||!c&&eb(b.target)||("handle"!==d||rb.dragHandle&&Db.start!==Db.end)&&(!e||(c?rb.touchDragging:rb.mouseDragging&&b.which<2))&&(c||f(b),ab(d),cc.init=0,cc.$source=a(b.target),cc.touch=c,cc.pointer=c?b.originalEvent.touches[0]:b,cc.initX=cc.pointer.pageX,cc.initY=cc.pointer.pageY,cc.initPos=e?yb.cur:Db.cur,cc.start=+new Date,cc.time=0,cc.path=0,cc.delta=0,cc.locked=0,cc.history=[0,0,0,0],cc.pathToLock=e?c?30:10:0,u.on(c?x:w,cb),sb.pause(1),(e?vb:Ab).addClass(rb.draggedClass),ob("moveStart"),e&&(fc=setInterval(_,10)))}function cb(a){if(cc.released="mouseup"===a.type||"touchend"===a.type,cc.pointer=cc.touch?a.originalEvent[cc.released?"changedTouches":"touches"][0]:a,cc.pathX=cc.pointer.pageX-cc.initX,cc.pathY=cc.pointer.pageY-cc.initY,cc.path=E(F(cc.pathX,2)+F(cc.pathY,2)),cc.delta=rb.horizontal?cc.pathX:cc.pathY,cc.released||!(cc.path<1)){if(!cc.init){if(cc.path<rb.dragThreshold)return cc.released?db():c;if(!(rb.horizontal?D(cc.pathX)>D(cc.pathY):D(cc.pathX)<D(cc.pathY)))return db();cc.init=1}f(a),!cc.locked&&cc.path>cc.pathToLock&&cc.slidee&&(cc.locked=1,cc.$source.on(z,g)),cc.released&&(db(),rb.releaseSwing&&cc.slidee&&(cc.swing=(cc.delta-cc.history[0])/40*300,cc.delta+=cc.swing,cc.tweese=D(cc.swing)>10)),L(cc.slidee?G(cc.initPos-cc.delta):$(cc.initPos+cc.delta))}}function db(){clearInterval(fc),cc.released=!0,u.off(cc.touch?x:w,cb),(cc.slidee?vb:Ab).removeClass(rb.draggedClass),setTimeout(function(){cc.$source.off(z,g)}),yb.cur===yb.dest&&cc.init&&ob("moveEnd"),sb.resume(1),cc.init=0}function eb(b){return~a.inArray(b.nodeName,B)||a(b).is(rb.interactive)}function fb(){sb.stop(),u.off("mouseup",fb)}function gb(a){switch(f(a),this){case Ub[0]:case Vb[0]:sb.moveBy(Ub.is(this)?rb.moveBy:-rb.moveBy),u.on("mouseup",fb);break;case Wb[0]:sb.prev();break;case Xb[0]:sb.next();break;case Yb[0]:sb.prevPage();break;case Zb[0]:sb.nextPage()}}function hb(a){return dc.curDelta=(rb.horizontal?a.deltaY||a.deltaX:a.deltaY)||-a.wheelDelta,dc.curDelta/=1===a.deltaMode?3:100,Rb?(o=+new Date,dc.last<o-dc.resetTime&&(dc.delta=0),dc.last=o,dc.delta+=dc.curDelta,D(dc.delta)<1?dc.finalDelta=0:(dc.finalDelta=G(dc.delta/1),dc.delta%=1),dc.finalDelta):dc.curDelta}function ib(a){a.originalEvent[r]=sb;var b=+new Date;if(J+rb.scrollHijack>b&&Sb[0]!==document&&Sb[0]!==window)return void(J=b);if(rb.scrollBy&&yb.start!==yb.end){var c=hb(a.originalEvent);(rb.scrollTrap||c>0&&yb.dest<yb.end||0>c&&yb.dest>yb.start)&&f(a,1),sb.slideBy(rb.scrollBy*c)}}function jb(a){rb.clickBar&&a.target===zb[0]&&(f(a),L($((rb.horizontal?a.pageX-zb.offset().left:a.pageY-zb.offset().top)-Cb/2)))}function kb(a){if(rb.keyboardNavBy)switch(a.which){case rb.horizontal?37:38:f(a),sb["pages"===rb.keyboardNavBy?"prevPage":"prev"]();break;case rb.horizontal?39:40:f(a),sb["pages"===rb.keyboardNavBy?"nextPage":"next"]()}}function lb(a){return eb(this)?void(a.originalEvent[r+"ignore"]=!0):void(this.parentNode!==vb[0]||a.originalEvent[r+"ignore"]||sb.activate(this))}function mb(){this.parentNode===Eb[0]&&sb.activatePage(Fb.index(this))}function nb(a){rb.pauseOnHover&&sb["mouseenter"===a.type?"pause":"resume"](2)}function ob(a,b){if($b[a]){for(qb=$b[a].length,C.length=0,pb=0;qb>pb;pb++)C.push($b[a][pb]);for(pb=0;qb>pb;pb++)C[pb].call(sb,a,b)}}if(!(this instanceof d))return new d(b,p,q);var pb,qb,rb=a.extend({},d.defaults,p),sb=this,tb=i(b),ub=a(b),vb=rb.slidee?a(rb.slidee).eq(0):ub.children().eq(0),wb=0,xb=0,yb={start:0,center:0,end:0,cur:0,dest:0},zb=a(rb.scrollBar).eq(0),Ab=zb.children().eq(0),Bb=0,Cb=0,Db={start:0,end:0,cur:0},Eb=a(rb.pagesBar),Fb=0,Gb=[],Hb=0,Ib=[],Jb={firstItem:0,lastItem:0,centerItem:0,activeItem:null,activePage:0},Kb=new l(ub[0]),Lb=new l(vb[0]),Mb=new l(zb[0]),Nb=new l(Ab[0]),Ob="basic"===rb.itemNav,Pb="forceCentered"===rb.itemNav,Qb="centered"===rb.itemNav||Pb,Rb=!tb&&(Ob||Qb||Pb),Sb=rb.scrollSource?a(rb.scrollSource):ub,Tb=rb.dragSource?a(rb.dragSource):ub,Ub=a(rb.forward),Vb=a(rb.backward),Wb=a(rb.prev),Xb=a(rb.next),Yb=a(rb.prevPage),Zb=a(rb.nextPage),$b={},_b={},ac={},bc={},cc={released:1},dc={last:0,delta:0,resetTime:200},ec=0,fc=0,gc=0,hc=0;tb||(b=ub[0]),sb.initialized=0,sb.frame=b,sb.slidee=vb[0],sb.pos=yb,sb.rel=Jb,sb.items=Ib,sb.pages=Gb,sb.isPaused=0,sb.options=rb,sb.dragging=cc,sb.reload=function(){K()},sb.getPos=function(a){if(Rb){var b=R(a);return-1!==b?Ib[b]:!1}var c=vb.find(a).eq(0);if(c[0]){var d=rb.horizontal?c.offset().left-vb.offset().left:c.offset().top-vb.offset().top,e=c[rb.horizontal?"outerWidth":"outerHeight"]();return{start:d,center:d-wb/2+e/2,end:d-wb+e,size:e}}return!1},sb.moveBy=function(a){bc.speed=a,!cc.init&&bc.speed&&yb.cur!==(bc.speed>0?yb.end:yb.start)&&(bc.lastTime=+new Date,bc.startPos=yb.cur,ab("button"),cc.init=1,ob("moveStart"),s(hc),P())},sb.stop=function(){"button"===cc.source&&(cc.init=0,cc.released=1)},sb.prev=function(){sb.activate(null==Jb.activeItem?0:Jb.activeItem-1)},sb.next=function(){sb.activate(null==Jb.activeItem?0:Jb.activeItem+1)},sb.prevPage=function(){sb.activatePage(Jb.activePage-1)},sb.nextPage=function(){sb.activatePage(Jb.activePage+1)},sb.slideBy=function(a,b){a&&(Rb?sb[Qb?"toCenter":"toStart"](k((Qb?Jb.centerItem:Jb.firstItem)+rb.scrollBy*a,0,Ib.length)):L(yb.dest+a,b))},sb.slideTo=function(a,b){L(a,b)},sb.toStart=function(a,b){Q("start",a,b)},sb.toEnd=function(a,b){Q("end",a,b)},sb.toCenter=function(a,b){Q("center",a,b)},sb.getIndex=R,sb.activate=function(a,b){var c=T(a);rb.smart&&c!==!1&&(Qb?sb.toCenter(c,b):c>=Jb.lastItem?sb.toStart(c,b):c<=Jb.firstItem?sb.toEnd(c,b):Z())},sb.activatePage=function(a,b){i(a)&&L(Gb[k(a,0,Gb.length-1)],b)},sb.resume=function(a){rb.cycleBy&&rb.cycleInterval&&("items"!==rb.cycleBy||Ib[0]&&null!=Jb.activeItem)&&!(a<sb.isPaused)&&(sb.isPaused=0,gc?gc=clearTimeout(gc):ob("resume"),gc=setTimeout(function(){switch(ob("cycle"),rb.cycleBy){case"items":sb.activate(Jb.activeItem>=Ib.length-1?0:Jb.activeItem+1);break;case"pages":sb.activatePage(Jb.activePage>=Gb.length-1?0:Jb.activePage+1)}},rb.cycleInterval))},sb.pause=function(a){a<sb.isPaused||(sb.isPaused=a||100,gc&&(gc=clearTimeout(gc),ob("pause")))},sb.toggle=function(){sb[gc?"pause":"resume"]()},sb.set=function(b,c){a.isPlainObject(b)?a.extend(rb,b):rb.hasOwnProperty(b)&&(rb[b]=c)},sb.add=function(b,c){var d=a(b);Rb?(null==c||!Ib[0]||c>=Ib.length?d.appendTo(vb):Ib.length&&d.insertBefore(Ib[c].el),null!=Jb.activeItem&&c<=Jb.activeItem&&(_b.active=Jb.activeItem+=d.length)):vb.append(d),K()},sb.remove=function(b){if(Rb){var c=S(b);if(c>-1){Hb.eq(c).remove();var d=c===Jb.activeItem;null!=Jb.activeItem&&c<Jb.activeItem&&(_b.active=--Jb.activeItem),K(),d&&(_b.active=null,sb.activate(Jb.activeItem))}}else a(b).remove(),K()},sb.moveAfter=function(a,b){X(a,b,1)},sb.moveBefore=function(a,b){X(a,b)},sb.on=function(a,b){if("object"===e(a))for(var c in a)a.hasOwnProperty(c)&&sb.on(c,a[c]);else if("function"===e(b))for(var d=a.split(" "),f=0,g=d.length;g>f;f++)$b[d[f]]=$b[d[f]]||[],-1===Y(d[f],b)&&$b[d[f]].push(b);else if("array"===e(b))for(var h=0,i=b.length;i>h;h++)sb.on(a,b[h])},sb.one=function(a,b){function c(){b.apply(sb,arguments),sb.off(a,c)}sb.on(a,c)},sb.off=function(a,b){if(b instanceof Array)for(var c=0,d=b.length;d>c;c++)sb.off(a,b[c]);else for(var e=a.split(" "),f=0,g=e.length;g>f;f++)if($b[e[f]]=$b[e[f]]||[],null==b)$b[e[f]].length=0;else{var h=Y(e[f],b);-1!==h&&$b[e[f]].splice(h,1)}},sb.destroy=function(){return d.removeInstance(b),Sb.add(Ab).add(zb).add(Eb).add(Ub).add(Vb).add(Wb).add(Xb).add(Yb).add(Zb).off("."+r),u.off("keydown",kb),Wb.add(Xb).add(Yb).add(Zb).removeClass(rb.disabledClass),Hb&&null!=Jb.activeItem&&Hb.eq(Jb.activeItem).removeClass(rb.activeClass),Eb.empty(),tb||(ub.off("."+r),Kb.restore(),Lb.restore(),Mb.restore(),Nb.restore(),a.removeData(b,r)),Ib.length=Gb.length=0,_b={},sb.initialized=0,sb},sb.init=function(){if(!sb.initialized){if(d.getInstance(b))throw new Error("There is already a Sly instance on this element");d.storeInstance(b,sb),sb.on(q);var a=["overflow","position"],c=["position","webkitTransform","msTransform","transform","left","top","width","height"];Kb.save.apply(Kb,a),Mb.save.apply(Mb,a),Lb.save.apply(Lb,c),Nb.save.apply(Nb,c);var e=Ab;return tb||(e=e.add(vb),ub.css("overflow","hidden"),m||"static"!==ub.css("position")||ub.css("position","relative")),m?n&&e.css(m,n):("static"===zb.css("position")&&zb.css("position","relative"),e.css({position:"absolute"})),rb.forward&&Ub.on(A,gb),rb.backward&&Vb.on(A,gb),rb.prev&&Wb.on(z,gb),rb.next&&Xb.on(z,gb),rb.prevPage&&Yb.on(z,gb),rb.nextPage&&Zb.on(z,gb),Sb.on(y,ib),zb[0]&&zb.on(z,jb),Rb&&rb.activateOn&&ub.on(rb.activateOn+"."+r,"*",lb),Eb[0]&&rb.activatePageOn&&Eb.on(rb.activatePageOn+"."+r,"*",mb),Tb.on(v,{source:"slidee"},bb),Ab&&Ab.on(v,{source:"handle"},bb),u.on("keydown",kb),tb||(ub.on("mouseenter."+r+" mouseleave."+r,nb),ub.on("scroll."+r,h)),sb.initialized=1,K(!0),rb.cycleBy&&!tb&&sb[rb.startPaused?"pause":"resume"](),sb}}}function e(a){return null==a?String(a):"object"==typeof a||"function"==typeof a?Object.prototype.toString.call(a).match(/\s([a-z]+)/i)[1].toLowerCase()||"object":typeof a}function f(a,b){a.preventDefault(),b&&a.stopPropagation()}function g(b){f(b,1),a(this).off(b.type,g)}function h(){this.scrollLeft=0,this.scrollTop=0}function i(a){return!isNaN(parseFloat(a))&&isFinite(a)}function j(a,b){return 0|G(String(a.css(b)).replace(/[^\-0-9.]/g,""))}function k(a,b,c){return b>a?b:a>c?c:a}function l(a){var b={};return b.style={},b.save=function(){if(a&&a.nodeType){for(var c=0;c<arguments.length;c++)b.style[arguments[c]]=a.style[arguments[c]];return b}},b.restore=function(){if(a&&a.nodeType){for(var c in b.style)b.style.hasOwnProperty(c)&&(a.style[c]=b.style[c]);return b}},b}var m,n,o,p="sly",q="Sly",r=p,s=b.cancelAnimationFrame||b.cancelRequestAnimationFrame,t=b.requestAnimationFrame,u=a(document),v="touchstart."+r+" mousedown."+r,w="mousemove."+r+" mouseup."+r,x="touchmove."+r+" touchend."+r,y=(document.implementation.hasFeature("Event.wheel","3.0")?"wheel.":"mousewheel.")+r,z="click."+r,A="mousedown."+r,B=["INPUT","SELECT","BUTTON","TEXTAREA"],C=[],D=Math.abs,E=Math.sqrt,F=Math.pow,G=Math.round,H=Math.max,I=Math.min,J=0;u.on(y,function(a){var b=a.originalEvent[r],c=+new Date;(!b||b.options.scrollHijack<c-J)&&(J=c)}),d.getInstance=function(b){return a.data(b,r)},d.storeInstance=function(b,c){return a.data(b,r,c)},d.removeInstance=function(b){return a.removeData(b,r)},function(a){function b(a){var b=(new Date).getTime(),d=Math.max(0,16-(b-c)),e=setTimeout(a,d);return c=b,e}t=a.requestAnimationFrame||a.webkitRequestAnimationFrame||b;var c=(new Date).getTime(),d=a.cancelAnimationFrame||a.webkitCancelAnimationFrame||a.clearTimeout;s=function(b){d.call(a,b)}}(window),function(){function a(a){for(var d=0,e=b.length;e>d;d++){var f=b[d]?b[d]+a.charAt(0).toUpperCase()+a.slice(1):a;if(null!=c.style[f])return f}}var b=["","Webkit","Moz","ms","O"],c=document.createElement("div");m=a("transform"),n=a("perspective")?"translateZ(0) ":""}(),b[q]=d,a.fn[p]=function(b,c){var f,g;return a.isPlainObject(b)||(("string"===e(b)||b===!1)&&(f=b===!1?"destroy":b,g=Array.prototype.slice.call(arguments,1)),b={}),this.each(function(a,e){var h=d.getInstance(e);h||f?h&&f&&h[f]&&h[f].apply(h,g):h=new d(e,b,c).init()})},d.defaults={slidee:null,horizontal:!1,itemNav:null,itemSelector:null,smart:!1,activateOn:null,activateMiddle:!1,scrollSource:null,scrollBy:0,scrollHijack:300,scrollTrap:!1,dragSource:null,mouseDragging:!1,touchDragging:!1,releaseSwing:!1,swingSpeed:.2,elasticBounds:!1,dragThreshold:3,interactive:null,scrollBar:null,dragHandle:!1,dynamicHandle:!1,minHandleSize:50,clickBar:!1,syncSpeed:.5,pagesBar:null,activatePageOn:null,pageBuilder:function(a){return"<li>"+(a+1)+"</li>"},forward:null,backward:null,prev:null,next:null,prevPage:null,nextPage:null,cycleBy:null,cycleInterval:5e3,pauseOnHover:!1,startPaused:!1,moveBy:300,speed:0,easing:"swing",startAt:null,keyboardNavBy:null,draggedClass:"dragged",activeClass:"active",disabledClass:"disabled"}}(jQuery,window);