/*------------------------------------------------------------------------------
    JS Document (https://developer.mozilla.org/en/JavaScript)

    project:    Festival de Cannes
    Author:     OHWEE
    created:    2016-24-03

    summary:    SLIDER HOME
----------------------------------------------------------------------------- */


var owInitSlider = function(sliderName) {
  /* SLIDER HOME
  ----------------------------------------------------------------------------- */
  if(sliderName == 'home') {

    var slide = $('.slider-carousel').owlCarousel({
      navigation          :  true,
      items               :  1,
      autoWidth           :  true,
      autoplay            :  true,
      autoplayTimeout     :  4000,
      autoplayHoverPause  :  true,
      loop                :  true,
      smartSpeed          :  700
    });

    slide.on('changed.owl.carousel', function(event) {
      setTimeout(function(){
        var $item   = $('.owl-item.active').find('.item');
        var number  = $item.data('item');
        var $active = $(".container-images .item.active");

        $active.removeClass("fadeInRight").addClass('fadeOut');

        setTimeout(function(){
          $(".container-images .item[data-item="+number+"]").removeClass('fadeOut').addClass('active fadeInRight');
          $active.removeClass('active');
        }, 500);
      }, 200);
    });
  }


  /* SLIDER 01
  ----------------------------------------------------------------------------- */
  if(sliderName == 'slider-01') {
    var slide01 = $('.slider-01').owlCarousel({
      navigation          : false,
      items               : 1,
      autoWidth           : true,
      smartSpeed          : 700,
      center              : true,
    });

    // Custom Navigation Events
    $(document).on('click', '.slider-01 .owl-item', function(){
      var number = $(this).index();

      $('.slider-01 .center').removeClass('center');
      $(this).addClass('center');
      slide01.trigger('to.owl.carousel', number);
    });
  }

  /* SLIDER 02
  ----------------------------------------------------------------------------- */
  if(sliderName == 'slider-02') {
    var slide01 = $('.slider-02').owlCarousel({
      navigation          : false,
      items               : 1,
      autoWidth           : true,
      smartSpeed          : 700,
      center              : true,
      margin              : 27.5
    }); 

    // Custom Navigation Events
    $(document).on('click', '.slider-02 .owl-item', function(){
      var number = $(this).index();

      $('.slider-02 .center').removeClass('center');
      $(this).addClass('center');
      slide01.trigger('to.owl.carousel', number);
    });
  }
};
