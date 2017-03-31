var owInitPopin = function(id) {


  if(id == 'popin-landing-e') {


    var $popin = $('.popin-landing-e');

    var visiblePopin = function() {
      var dateFestival = $('.compteur').data("date");

      var dateToday = new Date();
      dateFestival = new Date(dateFestival);


      var timeLanding = (dateFestival - dateToday) / 1000; //en seconde

      var jours = Math.floor(timeLanding / (60 * 60 * 24));
      var heures = Math.floor((timeLanding - (jours * 60 * 60 * 24)) / (60 * 60));
      var minutes = Math.floor((timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60))) / 60);
      var secondes = Math.floor(timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60 + minutes * 60)));


      if(timeLanding < 0){
        //pas de compteur ?

      }else if(timeLanding > 0){


        var $day = $('.day').html(jours);
        var $hour = $('.hour').html(heures);
        var $minutes = $('.minutes').html(minutes);
        var $secondes = $('.secondes').html(secondes);

      }else{

        //compteur terminé ! on ferme la popin
        $popin.addClass('animated fadeOut').removeClass('visible');
      }

      actualisation = setInterval(function() {

        var dateToday = new Date();
        dateFestival = new Date(dateFestival);

        var timeLanding = (dateFestival - dateToday) / 1000; //en seconde

        var jours = Math.floor(timeLanding / (60 * 60 * 24));
        var heures = Math.floor((timeLanding - (jours * 60 * 60 * 24)) / (60 * 60));
        var minutes = Math.floor((timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60))) / 60);
        var secondes = Math.floor(timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60 + minutes * 60)));

        if(timeLanding < 0){
          //pas de compteur ?
          Cookies.set('popin-landing-e','1', { expires: 365 });

        }else if(timeLanding > 0){

          var $day = $('.day').html(jours);
          var $hour = $('.hour').html(heures);
          var $minutes = $('.minutes').html(minutes);
          var $secondes = $('.secondes').html(secondes);

        }else{
          //compteur terminé ! on ferme la popin
          $popin.addClass('animated fadeOut').removeClass('visible');
          Cookies.set('popin-landing-e','1', { expires: 365 });
        }
      }, 1000);

    };

    var fClosePopin = function() {


      $('.popin-landing-e').on('click', function(){


        $popin.addClass('animated fadeOut');
        Cookies.set('popin-landing-e','1', { expires: 365 });

        setTimeout(function(){   $popin.removeClass('visible'); }, 500);
      });
    }

    // Verifier si les cookies existent
    if(typeof Cookies.get('popin-landing-e') === "undefined") {
      Cookies.set('popin-landing-e','0', { expires: 365 });
    }

    var closePopin = Cookies.get('popin-landing-e');

    if(closePopin == 0) {
      $popin.addClass('animated fadeIn').addClass('visible');
      visiblePopin();
      fClosePopin();
    }else {
      Cookies.set('popin-landing-e','1', { expires: 365 });
    }
  }

  if(id == 'popin-timer-banner') {

    var $popin = $('.b-timer');

    var visiblePopinB = function() {
      var dateFestival = $('.time').data("date");

      var dateToday = new Date();
      dateFestival = new Date(dateFestival);

      var timeLanding = (dateFestival - dateToday) / 1000; //en seconde

      var jours = Math.floor(timeLanding / (60 * 60 * 24));
      var heures = Math.floor((timeLanding - (jours * 60 * 60 * 24)) / (60 * 60));
      var minutes = Math.floor((timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60))) / 60);
      var secondes = Math.floor(timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60 + minutes * 60)));

      if(timeLanding < 0){
        //pas de compteur ?
      }else if(timeLanding > 0){

        var $day = $('.day').html(jours);
        var $hour = $('.hour').html(heures);
        var $minutes = $('.minutes').html(minutes);
        var $secondes = $('.secondes').html(secondes);

      }else{
        //compteur terminé ! on ferme la popin
        $popin.addClass('animated fadeOut').removeClass('visible');
      }

      actualisation = setInterval(function() {

        var dateToday = new Date();
        dateFestival = new Date(dateFestival);

        var timeLanding = (dateFestival - dateToday) / 1000; //en seconde

        var jours = Math.floor(timeLanding / (60 * 60 * 24));
        var heures = Math.floor((timeLanding - (jours * 60 * 60 * 24)) / (60 * 60));
        var minutes = Math.floor((timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60))) / 60);
        var secondes = Math.floor(timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60 + minutes * 60)));

        if(timeLanding < 0){
          //pas de compteur ?
          Cookies.set('popin-banner','1', { expires: 365 });

        }else if(timeLanding > 0){

          var $timer = $('.time').html(jours+' : '+heures+' : '+minutes+' : '+secondes);

        }else{
          //compteur terminé ! on ferme la popin
          $popin.addClass('animated fadeOut').removeClass('visible');
          Cookies.set('popin-banner','1', { expires: 365 });
        }
      }, 1000);

      setTimeout(function(){
/*
        fClosePopinB('force'); 
*/
      }, 5000);

    };

    var fClosePopinB = function(force) {

      if(force == 'force'){
        $popin.addClass('animated fadeOut');

        setTimeout(function(){   $popin.removeClass('visible'); }, 500);

      }

      $('.c-icon').on('click', function(){
        $popin.addClass('animated fadeOut');
        Cookies.set('popin-banner','1', { expires: 365 });

        setTimeout(function(){   $popin.removeClass('visible'); }, 500);
      });
    }

    // Verifier si les cookies existent
    if(typeof Cookies.get('popin-banner') === "undefined") {
      Cookies.set('popin-banner','0', { expires: 365 });
    }

    var closePopin = Cookies.get('popin-banner');
    
    if(closePopin == 0) {
      $popin.addClass('animated fadeIn').addClass('visible');
      visiblePopinB();
      fClosePopinB();

    }else {
      Cookies.set('popin-banner','1', { expires: 365 });
    }

  }

};

/*  COOKIE BANNER
 ----------------------------------------------------------------------------- */
var owCookieBanner = function() {
  if(typeof Cookies.get('cooki_banner') === "undefined"){
    $('#cookies-banner').show();

    $('.cookie-accept').click(function () { //on click event
      days = 365; //number of days to keep the cookie
      myDate = new Date();
      myDate.setTime(myDate.getTime()+(days*24*60*60*1000));
      document.cookie = "cooki_banner = comply_yes; expires = " + myDate.toGMTString(); //creates the cookie: name|value|expiry
      $("#cookies-banner").slideUp("slow"); //jquery to slide it up
      $(".btnClose").hide();
    });
  } else {
    $('#cookies-banner').hide();
  }
};
