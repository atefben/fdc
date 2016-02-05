
$(document).ready(function() {
	var menu = $("#horizontal-menu").owlCarousel({
        nav: false,
        dots: false,
        smartSpeed: 500,
        margin: 60,
        autoWidth: true,
        loop: false,
        items: 2
    });
    menu.owlCarousel();

    $('.downloads').find('.section-active').css('display','block');
    $('.downloads').find('.section-active').animate({'opacity':1},400);

    $('#horizontal-menu a').on('click', function(e) {
            e.preventDefault();

            var $this = $(this);
            if ($this.hasClass('active')) {
                return false;
            }
            $('#horizontal-menu a').removeClass('active');
            $this.addClass('active');

            $('.downloads').find('.section-active').animate({'opacity':0},400,function(){
                $('.downloads').find('.section-active').css('display','none');
            	$('.downloads section').removeClass('section-active');
            	$('.downloads').find('.'+$this.data('filter')).addClass('section-active');
                $('.downloads').find('.'+$this.data('filter')).css('display','block');
            	$('.downloads').find('.'+$this.data('filter')).animate({'opacity':1},400);
            });

	});


});