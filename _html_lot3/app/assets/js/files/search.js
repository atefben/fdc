var owInitSliderSelect = function(id) {

  if(id == "timelapse"){
    var slider = document.getElementById('timelapse');
    var snapValues = [
    	document.getElementById('slider-snap-value-lower'),
    	document.getElementById('slider-snap-value-upper')
    ];


      ys = $('#s-yearstart').val();
      ye = $('#s-yearend').val();

      ys = parseInt(ys);
      ye = parseInt(ye);

      console.log(ys+' , '+ye);

    noUiSlider.create(slider, {
    	start: [ys, ye],//todo script
    	connect: true,
    	range: {
            'min': 1946,
            'max': GLOBALS.year
    	}
     });

    slider.noUiSlider.on('update', function( values, handle ) {

    	snapValues[handle].innerHTML = parseInt(values[handle]);

        var lower = parseInt(values[0]);
        var up = parseInt(values[1]);

        $('#s-yearstart').val(lower);
        $('#s-yearend').val(up);
        
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
