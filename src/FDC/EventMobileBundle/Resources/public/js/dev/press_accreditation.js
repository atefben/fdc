
$(document).ready(function() {
	var menu = $("#horizontal-menu").owlCarousel({
        nav: false,
        dots: false,
        smartSpeed: 500,
        margin: 40,
        autoWidth: true,
        loop: false,
        items: 2,
        onInitialized: function() {
            
        },
        onResized: function() {
            
        }
    });
    menu.owlCarousel();
    $('.medias').find('.active').animate({'opacity':1},400);
    $('#horizontal-menu a').on('click', function(e) {
            e.preventDefault();

            var $this = $(this);
            if ($this.hasClass('active')) {
                return false;
            }
            $('#horizontal-menu a').removeClass('active');
            $this.addClass('active');
            $('.medias').find('.active').animate({'opacity':0},400,function(){
            	$('.medias div').removeClass('active');
            	$('.medias').find('#'+$this.data('media')).addClass('active');
            	$('.medias').find('#'+$this.data('media')).animate({'opacity':1},400);
            });
            
	});


});