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
 // owInitLinkChangeEffect(); add ??

 //gestion des cookie a faire ici

 owInitPopin('popin-landing-e');
    owInitPopin('popin-timer-banner');


 if('ontouchstart' in window) {
   if (navigator.userAgent.indexOf("iPad") > -1 ||
       navigator.userAgent.indexOf("iPhone") > -1 ||
       navigator.userAgent.indexOf("Android") > -1) {
         $('body').addClass('mobile');
   } else {
     $('body').addClass('mobile');
   }
 }else {
   $('body').addClass('not-mobile');
 }


 //fix link header
 $('header .hasSubNav .noLink').on("click", function(e){
   e.preventDefault();
  //  return false;
 });

if($('body').hasClass('mobile')){
  owFixMobile();
}

 // owInitSearch();

  if($('.home').length) {
    owInitSlider('home');
    owInitSlider('slider-01');
    owInitSlider('slider-02');
      var slider = $('.block-diaporama .slider-01');
      owinitSlideShow(slider);
  }

  if($('.retrospective.poster').length) {
    owInitNavSticky(1);
  }

  if($('.retrospective-home').length) {
    owInitSlider('timelapse-01');
    onInitParallax();
  }

  if($('.ajax-section').length) {
    owInitAjax();
  }

  if($('.block-push-top').length) {
    onInitParallax();
  }

  if($('.jury').length) {
    owInitNavSticky(2);
    owInitGrid('isotope-01');
  }

  if($('.article-single').length) {
    owInitNavSticky(1);
    owArrowDisplay();
  }

  if($('.articles-list').length) {

    var grid = owInitGrid('isotope-01');
    owsetGridBigImg(grid, $('.grid-01'), true);

    $( window ).resize(function() {
        owsetGridBigImg(grid, $('.grid-01'), false);
    });
  }

  if($('.articles-list-medias').length) {

    var grid = owInitGrid('isotope-01');

    owInitAleaGrid(grid, $('.grid-01'), true);
  }

  if($('.retrospective.palmares').length) {
    owInitNavSticky(2);
  }

  if($('.edition-69.palm-gold').length) {
    owInitNavSticky(1);
  }

  if($('.retrospective.selection').length) {
    owInitNavSticky(2);
    owInitGrid('isotope-01');
  }

  if($('.who').length) {
    owInitNavSticky(1);
  }

  if($('.who-staff').length ){
    owInitGrid('isotope-02');
  }

  if($('.who-identity-guidelines').length) {
    owInitAccordion("block-accordion");
  }

  if($('.participate-accordion').length) {
    owInitAccordion("block-accordion");
  }

  if($('.p-register').length) {
    owInitTab('tab1');
  }

  if($('.media-library').length) {
    owInitSliderSelect('timelapse');
    owInitSliderSelect('tab-selection');

    var grid = owInitGrid('isotope-03');

    owInitAleaGrid(grid, $('.grid-01'), true);
  }

  if($('.search-page').length) {
    owInitSliderSelect('timelapse');
    owInitSliderSelect('tab-selection');
    owInitAccordion('more-search');
  }

  if($('.filters').length) {
    owInitFilter();
  }

  if($('.filters-02').length) {
    owInitNavSticky(3);
    owRemoveElementListe();
  }

});
