$(document).ready(function() {
  if($('.grid').length > 0) {
    $('.grid').isotope({
      layoutMode: 'packery',
      itemSelector: '.grid-item'
    });
  }

  if($('.chocolat-image').length > 0) {

    console.log('init diapo');

    $('.chocolat-image').on('click', function(e){
      e.preventDefault();

      $this = $(this);

      src = $this.attr('href');


      $('body').append('<div class="diapoFullscreen"></div>');

      var diapoFullscreen = $('body').find('.diapoFullscreen');

      $.each($('.chocolat-image'), function (i, e) {
        src = $(e).attr('href');
        diapoFullscreen.append('<img src="' + src +
            '" alt="photo" class="item">' +
            '</div>' );
      });

      diapo = diapoFullscreen.owlCarousel({
        nav: false,
        dots: false,
        smartSpeed: 500,
        margin: 0,
        loop: false,
        items: 1
      });

      index = $this.parent().index(); // a revoir

      diapo.trigger('to.owl.carousel', [index, 2, true]);

      $('body').addClass('no-scroll');

      diapoFullscreen.append('<div class="close-button"><i class="icon icon_close"></i></div>');


      btnClose = diapoFullscreen.find('.close-button');

      btnClose.on('click', function(e){
        diapoFullscreen.remove();
        $('body').removeClass('no-scroll');
      });


      return false;

    })
  }

});