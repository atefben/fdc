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

$(document).ready(function () {

    if($('.slider-home').length) {
        owInitSlider('home');
    }

    if($('.filter').length) {
        owInitFilter();
    }

    if($('.block-diaporama').length) {
        owInitSlider('slider-01');
    }

    if($('.block-videos').length) {
        initVideo();
    }

    if ($('.retrospective-home').length) {
        owInitSlider('timelapse-01');
        onInitParallax();
    }

});
