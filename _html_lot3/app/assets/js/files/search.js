var owInitSliderSelect = function(id) {

  if(id == "timelapse"){
    var slider = document.getElementById('timelapse');
    var snapValues = [
    	document.getElementById('slider-snap-value-lower'),
    	document.getElementById('slider-snap-value-upper')
    ];


    noUiSlider.create(slider, {
    	start: [1960, 2000],//todo script
    	connect: true,
    	range: {
    		'min': 1946,
    		'max': 2016
    	}
     });

    slider.noUiSlider.on('update', function( values, handle ) {

    	snapValues[handle].innerHTML = parseInt(values[handle]);
    });
  }

  if(id == "timelapse-01") {
    var slider = document.getElementById('timelapse-01');
    var $slide = $('.slides');

    noUiSlider.create(slider, {
      start: [1946],//todo script
      range: {
        'min': 1946,
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
          number = values - 1946;

          if(initDrag) {
            initDrag = 0;
          }

          if(number > 0.7 && initDrag == 0){
            $('.slider-restropective[data-slide="0"]').removeClass('animated fadeIn').addClass('animated fadeOut');
          }else if(number < 0.9){
            $('.slider-restropective[data-slide="0"]').removeClass('animated fadeOut').addClass('animated fadeIn');
          }

          var val = - w * (valuesFloat - 1946); //todo script ?
          $slide.css('transform','translate('+val+'px)');

          $('.slider-restropective').removeClass('big').addClass('small');
          $('.slider-restropective[data-slide="0"]').removeClass('big').removeClass('small');

     });

     slider.noUiSlider.on('end', function(values, handle){ //end drag
       var w = $('body').width();

       valuesFloat = parseFloat(values[handle]);

       values = Math.round(valuesFloat);
       number = values - 1946;
       var val = - w * (values - 1946); //todo script ?
       $slide.css('transform','translate('+val+'px)');

       var slideElement = $('.slider-restropective[data-slide='+number+']');

       slideElement.removeClass('small').addClass('big');

       $('.slider-restropective[data-slide="0"]').removeClass('big').removeClass('small');

     });
  }

  if(id == 'tab-selection') {
    var $tab = $('.icon-s');

    $tab.on('click', function(){
      var input = $(this).find('input');

      if(input[0].checked){
        input[0].checked = false;
        $(this).removeClass('active');
      }else{
        $('.more-search').addClass('active');
        input[0].checked = true;
        $(this).addClass('active');
      }

      if(!$('.tabs-two .icon-s').hasClass('active')){
        $('.more-search').removeClass('active');
      }

    });
  }
}
