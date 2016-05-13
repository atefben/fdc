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

  if(sliderName == "timelapse-01") {

    //Init var
    var slider = document.getElementById('timelapse-01');
    var $slide = $('.slides');
    var $slideCalc1 = $('.slides-calc1');
    var $slideCalc1Slide = $('.slides-calc1 .slide');
    var $slideCalc2 = $('.slides-calc2');

    var numberSlide = $('.slider-restropective').size();
    var sizeSlide = $('.slider-restropective').width();
    var finalSizeSlider = numberSlide * sizeSlide + 100;

    var initOpenAjax = function() { //ajax
      $('.discover').on('click', function(e){

        e.preventDefault();
        var url = $(this).data('url');

        $.get(url, function(data) {

          $('.slider-restropective').addClass('isOpen block-push block-push-top background-effet');
          $('.timelapse').css('display','none');
          $('.discover').css('display','none');
          $('.slides-calc2').css('display','none');
          $('.title-big-date').addClass('title-2').removeClass('title-big-date');
          $('.title-edition').addClass('title-4').removeClass('title-edition');

          var imgurl = $('.block-push-top.big .container img').attr('src');
          $('.block-push-top.big .container img').css('display','none');

          $('.block-push-top.big').css('background-image','url('+imgurl+')');

          var data = $(data).find('.contain-ajax');

          $('.ajax-section').html(data);
          owInitNavSticky(1);

          window.history.pushState('','',url);
         });

         return false;
      });
    }

    // init slider
    $slide.css('width',finalSizeSlider); // change size slider
    $slideCalc1.css('width',finalSizeSlider); // change size slider

    //init width of slide
    noUiSlider.create(slider, {
      start: [1945],//todo script
      range: {
        'min': 1945,
        'max': 2015
      }
     });

    var initDrag = 1;

   slider.noUiSlider.on('update', function( values, handle ) {

      //drag
      var w = $('body').width();
      var number = 0;

      valuesFloat = parseFloat(values[handle]);
      valuesInt = parseInt(values[handle]);
      values = Math.round(valuesFloat);
      number = values - 1945;

      $('.slides-calc1 .date').html(valuesInt);

      $('.big img').removeClass('open');

      if(initDrag) {
        initDrag = 0;
      }

      if(valuesInt > 1945){
        $('.slides-calc1').css('display','block');
        $('.slides-calc2.navigation').removeClass('begin');
      }else {
        $('.slides-calc1').css('display','none');
        $('.slides-calc2.navigation').addClass('begin');
      }


      if(number > 0.7 && initDrag == 0){
        $('.slider-restropective[data-slide="0"]').removeClass('animated fadeIn').addClass('animated fadeOut');
        $('.slides-calc1').removeClass('animated fadeOut').addClass('animated fadeIn');

      }else if(number < 0.9){

        $('.slider-restropective[data-slide="0"]').removeClass('animated fadeOut').addClass('animated fadeIn');
        $('.slides-calc1').removeClass('animated fadeIn').addClass('animated fadeOut');
      }

      var val = - w * (valuesFloat - 1945) * .8; //todo script ?
      // var valCalc1 = - w * (valuesFloat - 1946) * .4; //todo script ?
      var valPos = w * (valuesFloat - 1945) * .8; //todo script ?

      $slide.css('transform','translate('+val+'px)');
      // $slideCalc1Slide.css('left',valPos+'px');

      $('.slider-restropective').removeClass('big').addClass('small');
      $('.slider-restropective[data-slide="0"]').removeClass('big').removeClass('small');
      $('.slider-restropective .texts').removeClass('zoomIn fadeIn pulse visible');

     });

     slider.noUiSlider.on('end', function(values, handle){ //end drag

       var w = $('body').width();
       valuesFloat = parseFloat(values[handle]);
       values = Math.round(valuesFloat);
       number = values - 1945;
       var val = - w * (values - 1945); //todo script ?

       $slide.css('transform','translate('+val+'px)');

       var slideElement = $('.slider-restropective[data-slide='+number+']');
       var slideElementText = $('.slider-restropective[data-slide='+number+'] .texts');

       slideElement.removeClass('small').addClass('big');
       $('.big img').addClass('open');

       setTimeout(function(){

         slideElementText.addClass('animated zoomIn fadeIn visible');
         $('.slides-calc1').removeClass('animated fadeIn').addClass('animated fadeOut');

         setTimeout(function(){

           slideElementText.removeClass('zoomIn fadeIn').addClass('pulse');
           $('.slides-calc1').css('display','none');
           initOpenAjax();
         }, 600);
       }, 900);

       $('.slider-restropective[data-slide="0"]').removeClass('big').removeClass('small');

     });

     var animation = function(event) {

       var date = $('.slides-calc1 .date').html();
       date = parseInt(date);

       if(event == "prev"){
         date = date -1;
         slider.noUiSlider.set([date]);
         stopAnimtaion();
       }

       if(event == "next"){
         date = date +1;
         slider.noUiSlider.set([date]);
         stopAnimtaion();
       }
     }

     var stopAnimtaion = function() {

       var w = $('body').width();
       values = $('.slides-calc1 .date').html();
       number = values - 1945;
       var val = - w * (values - 1945); //todo script ?


       $slide.css('transform','translate('+val+'px)');

       var slideElement = $('.slider-restropective[data-slide='+number+']');
       var slideElementText = $('.slider-restropective[data-slide='+number+'] .texts');

       slideElement.removeClass('small').addClass('big');
       $('.big img').addClass('open');

       setTimeout(function(){

         slideElementText.addClass('animated zoomIn fadeIn visible');
         $('.slides-calc1').removeClass('animated fadeIn').addClass('animated fadeOut');

         setTimeout(function(){


           slideElementText.removeClass('zoomIn fadeIn').addClass('pulse');
           $('.slides-calc1').css('display','none');
           initOpenAjax();

         }, 600);
       }, 900);

       $('.slider-restropective[data-slide="0"]').removeClass('big').removeClass('small');
     }

     // ON CLICK

     $('.slides-calc2.next').on('click', function(){
       animation('next');
     });

     $('.slides-calc2.prev').on('click', function(){
       animation('prev');
     });
  }
};

  $(window).resize(function() {

    if($('.retrospective').length) {

      var $slide = $('.slides');
      var $slideCalc1 = $('.slides-calc1');

      var w = $('body').width();
      var numberSlide = $('.slider-restropective').size();
      var sizeSlide = $('.slider-restropective').width();
      var finalSizeSlider = numberSlide * sizeSlide + 100;

      $slide.css('width',finalSizeSlider); // change size slider
      $slideCalc1.css('width',finalSizeSlider); // change size slider

      values = $('.slides-calc1 .date').html();
      number = values - 1945;
      var val = - w * (values - 1945); //todo script ?

      $slide.css('transform','translate('+val+'px)');
    }
  });
