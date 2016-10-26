<script>
var GLOBALS = {
  "env" : "html",
  "locale" : "fr",
  "defaultDate" : "2016-05-12",
  "dateStart": "2016-05-12",
  "dateEnd": "2016-05-24",
  "api" : {
    "instagramUrl" : "https://api.instagram.com/v1/tags/Cannes2016/media/recent/?access_token=2480568612.1677ed0.e6bd83eae8a74220ad07059c7b3ab5bc",
    "twitterUrl" : "./json/twitter.json"
  },
  "baseUrl" : "http://html.festival-cannes-2016.com.ohwee.fr",
  "urls" : {
    "programmationUrl" : "programmation.php",
    "calendarProgrammationUrl" : "calendarprogrammation.html",
    "eventUrl" : "load-evenements.php",
    "newsUrl" : "news.html",
    "newsUrlNext" : "news_page2.html",
    "loadPressReleaseUrl" : "load-communique.php",
    "selectionUrl" : "selection.html",
    "audiosUrl": "audios.php",
    "photosUrl": "photos.php",
    "videosUrl": "videos.php",
    "searchUrl": "searchsuggest.json",
    "resultUrl": "results.json",
  },
  "texts" : {
    "url" : {
      "title" : "titre test"
    },
    "search" : {
      "noresult" : "Aucun résultat"
    },
    "popin" : {
      "error" : "valide",
      "empty" : "renseignée",
      "valid" : "Votre email a bien été envoyé !",
      "copy"  :  "lien copié ! ",
      "acces" :  "les contenus qui vous sont réservés sont à présents accessibles."
    },
    "googleMap" : {
      "title" : "Festival de Cannes"
    },
    "readMore" : {
      "more" : "Afficher <strong>plus d'actualités</strong>",
      "nextDay" : "Passer au <strong>jour précédent</strong>"
    },
    "newsletter" : {
      "errorsNotValide" : "L'adresse e-mail n'est pas valide",
      "errorsMailEmpty" : "Veuillez saisir une adresse e-mail valide"
    },
    'agenda' : {
      'delete' : "Supprimer de votre agenda"
    }
  },
  "player": {
    "file" : "./files/mov_bbb.mp4",
    "image" : "//dummyimage.com/960x540/c8a461/000.png",
    "title" : "Video 1"
  },
  "calendar": {
    "labelFormat": {
      "fr" : "H [H]",
      "default" : "h A"
    },
    "i18n": {
      "months" : ["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"],
      "weekdays" : ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
      "weekdaysShort" : ["Dim","Lun","Mar","Mer","Jeu","Ven","Sam"],
      "labelFormat": {
        "fr" : "H\\hi",
        "default" : "g:ia"
      }
    }
  },
  "socialWall": {
    "points" : [50,60,50,450,70,50,100,320,70,0,900,70],
    "heightGraph" : 200
  }
}
</script>


<!-- build:js js/vendor.min.js -->
<script src="js/bower_components/jquery/dist/jquery.min.js"></script>
<script src="js/bower_components/moment/min/moment.min.js"></script>
<script src="js/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="js/bower_components/fullcalendar/dist/lang-all.js"></script>
<script src="js/bower_components/chocolat/src/js/jquery.chocolat.js"></script>
<script src="js/bower_components/Snap.svg/dist/snap.svg-min.js"></script>
<script src="js/bower_components/jquery-cookie/jquery.cookie.js"></script>
<script src="js/bower_components/wavesurfer.js/dist/wavesurfer.min.js"></script>
<script src="js/bower_components/isotope/dist/isotope.pkgd.min.js"></script>
<script src="js/bower_components/isotope-packery/packery-mode.pkgd.js"></script>
<script src="js/bower_components/imagesloaded-packaged/imagesloaded.pkgd.min.js"></script>
<script src="js/bower_components/infinite-scroll/jquery.infinitescroll.min.js"></script>
<script src="js/bower_components/canvasloader/js/heartcode-canvasloader-min.js"></script>
<script src="js/components/snap.svg.easing.js"></script>
<script src="js/components/FileSaver.min.js"></script>
<script src="js/components/ics.min.js"></script>
<script src="js/components/fullscreenjs.js"></script>
<script src="js/components/object-fit-polyfill.js"></script>
<script src="js/components/jwplayer.js"></script>
<script src="js/components/clipboard.min.js"></script>
<script src="js/components/pikaday.js"></script>
<script src="js/components/jquery.timepicker.min.js"></script>
<script src="js/components/jquery-ui.min.js"></script>
<script src="js/components/jquery.lazyload.min.js"></script>
<script src="js/bower_components/jqueryui-touch-punch/jquery.ui.touch-punch.min.js"></script>
<!-- endbuild -->

<!-- build:js js/app.min.js -->
<!-- festival-cannes tags start -->
<script src="js/festival-cannes/helpers.js"></script>
<script src="js/festival-cannes/article.module.js"></script>
<script src="js/festival-cannes/audio.module.js"></script>
<script src="js/festival-cannes/contact.module.js"></script>
<script src="js/festival-cannes/faq.module.js"></script>
<script src="js/festival-cannes/films.module.js"></script>
<script src="js/festival-cannes/filters.module.js"></script>
<script src="js/festival-cannes/google-map.module.js"></script>
<script src="js/festival-cannes/grids.module.js"></script>
<script src="js/festival-cannes/jurys.module.js"></script>
<script src="js/festival-cannes/menu.module.js"></script>
<script src="js/festival-cannes/movie.module.js"></script>
<script src="js/festival-cannes/news.module.js"></script>
<script src="js/festival-cannes/newsletter.module.js"></script>
<script src="js/festival-cannes/palmares.module.js"></script>
<script src="js/festival-cannes/participate.module.js"></script>
<script src="js/festival-cannes/playeraudio.module.js"></script>
<script src="js/festival-cannes/practicialguide.module.js"></script>
<script src="js/festival-cannes/prefooter.module.js"></script>
<script src="js/festival-cannes/prehome.module.js"></script>
<script src="js/festival-cannes/press.module.js"></script>
<script src="js/festival-cannes/resize.module.js"></script>
<script src="js/festival-cannes/search.module.js"></script>
<script src="js/festival-cannes/seating-chart.module.js"></script>
<script src="js/festival-cannes/selection.module.js"></script>
<script src="js/festival-cannes/share.module.js"></script>
<script src="js/festival-cannes/sliderartist.module.js"></script>
<script src="js/festival-cannes/sliderchannels.module.js"></script>
<script src="js/festival-cannes/sliderhome.module.js"></script>
<script src="js/festival-cannes/slidermovies.module.js"></script>
<script src="js/festival-cannes/slidervideos.module.js"></script>
<script src="js/festival-cannes/slideshows.module.js"></script>
<script src="js/festival-cannes/socialwall.module.js"></script>
<script src="js/festival-cannes/transitions.module.js"></script>
<script src="js/festival-cannes/video.module.js"></script>
<script src="js/festival-cannes/webtv.module.js"></script>
<script src="js/festival-cannes/popin.js"></script>
<script src="js/festival-cannes/scroll.js"></script>
<script src="js/festival-cannes/owl.carousel.min.js"></script>
<script src="js/festival-cannes/custom.js"></script>
<!-- festival-cannes tags end -->
<!-- endbuild -->
<script>jwplayer.key="DDlGCb2Z6Hc44IZsRCireCJGh+dhUmBcgQzM1Q==";</script>
