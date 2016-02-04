
$(document).ready(function() {

    function initSelection(){
        $('.medias_movie').find('.active').animate({'opacity':1},400);
        $.removeSlideshow();
        $.initSlideshow();
        var sliderMediatheque = $(".film-slider").owlCarousel({ 
          nav: false,
          dots: false,
          smartSpeed: 500,
          fluidSpeed: 500,
          loop: false,
          margin: 70,
          autoWidth: true,
          dragEndSpeed: 600,
          items:1,
          center:true
        });

        sliderMediatheque.owlCarousel();
        $('.film-slider .thumb').on('click', function(e) {
                e.preventDefault();

                var $this = $(this);
                if ($this.hasClass('active')) {
                    return false;
                }
                $('.film-slider .thumb').removeClass('active');
                $this.addClass('active');
                $('.medias_movie').find('.active').animate({'opacity':0},400,function(){
                    $('.medias_movie div').removeClass('active');
                    $('.medias_movie').find('#'+$this.data('media')).addClass('active');
                    $('.medias_movie').find('#'+$this.data('media')).animate({'opacity':1},400);
                    $.removeSlideshow();
                    $.initSlideshow();
                });
                
        });
    }

	var menu = $("#horizontal-menu").owlCarousel({
        nav: false,
        dots: false,
        smartSpeed: 500,
        margin: 40,
        autoWidth: true,
        loop: false,
        items: 2
    });
    menu.owlCarousel();
    
 //    $('#horizontal-menu a').on('click', function(e) {
 //            e.preventDefault();

 //            var $this = $(this);
 //            if ($this.hasClass('active')) {
 //                return false;
 //            }
 //            $('#horizontal-menu a').removeClass('active');
 //            $this.addClass('active');
 //            $('.medias').find('.active').animate({'opacity':0},400,function(){
 //            	$('.medias div').removeClass('active');
 //            	$('.medias').find('#'+$this.data('media')).addClass('active');
 //            	$('.medias').find('#'+$this.data('media')).animate({'opacity':1},400);
 //            });
            
	// });

    $('#horizontal-menu a').on('click',function(e){
          e.preventDefault();


          if($(this).is(':not(.active)')) {

              $( ".selections" ).removeClass('show');

            var urlPath = $(this).attr('data-url');
            $.get(urlPath, function(data){
              $( ".selections" ).html( $(data).find('.selections').html() );

               setTimeout(function() {
                    $( ".selections" ).addClass('show');
                }, 300);

               initSelection();


               history.pushState('',GLOBALS.texts.url.title, urlPath);
              


            });

            $('#horizontal-menu a').removeClass('active');
            $(this).addClass('active');
          }
    });


    initSelection();



});