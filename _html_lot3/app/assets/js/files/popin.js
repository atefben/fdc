var owInitPopin = function(id) {


  if(id == 'popin-landing-e') {

    console.log('popin-1');

    var $popin = $('.popin-landing-e');

    var visiblePopin = function() {
      var dateFestival = $('.compteur').data("date");
      console.log(dateFestival);
      
      var dateToday = new Date();
      dateFestival = new Date(dateFestival);

      console.log(dateFestival);
      
      var timeLanding = (dateFestival - dateToday) / 1000; //en seconde

      var jours = Math.floor(timeLanding / (60 * 60 * 24));
      var heures = Math.floor((timeLanding - (jours * 60 * 60 * 24)) / (60 * 60));
      var minutes = Math.floor((timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60))) / 60);
      var secondes = Math.floor(timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60 + minutes * 60)));


      if(timeLanding < 0){
        //pas de compteur ?
        console.log('popin-2');

      }else if(timeLanding > 0){
        console.log('popin-3');


        var $day = $('.day').html(jours);
        var $hour = $('.hour').html(heures);
        var $minutes = $('.minutes').html(minutes);
        var $secondes = $('.secondes').html(secondes);

      }else{
        console.log('popin-4');

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
      console.log('popin-5');


      $('.popin-landing-e').on('click', function(){
        console.log('popin-6');


        $popin.addClass('animated fadeOut');
        Cookies.set('popin-landing-e','1', { expires: 365 });

        setTimeout(function(){   $popin.removeClass('visible'); }, 500);
      });
    }

    // Verifier si les cookies existent
    if(typeof Cookies.get('popin-landing-e') === "undefined") {
      Cookies.set('popin-landing-e','0', { expires: 365 });
      console.log('popin-7');

    }

    var closePopin = Cookies.get('popin-landing-e');

    if(closePopin == 0) {
      $popin.addClass('animated fadeIn').addClass('visible');
      visiblePopin();
      fClosePopin();
      console.log('popin-8');

    }else {
      console.log('popin-9');

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

    console.log(closePopin);

    if(closePopin == 0) {
      $popin.addClass('animated fadeIn').addClass('visible');
      visiblePopinB();
      fClosePopinB();

    }else {
      Cookies.set('popin-banner','1', { expires: 365 });
    }

  }

};
