/*------------------------------------------------------------------------------
    JS Document (https://developer.mozilla.org/en/JavaScript)

    project:    Festival de Cannes
    Author:     OHWEE
    created:    2016-24-03

    summary:    CONSTANTES
                UTILITIES
                WINDOW.ONLOAD
                MENU
                VIDEOS
                PLAY
----------------------------------------------------------------------------- */

/*  =INIT
----------------------------------------------------------------------------- */

$(document).ready(function() {

 initHeaderSticky();

  if($('.home').length){
    owInitSlider('home');
    owInitSlider('slider-01');
    owInitSlider('slider-02');
  }

});
