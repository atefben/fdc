// Filters
// =========================

function filter() {

  // var filters = [];

  $('.filter').each(function() {
    var $that = $(this);
    var a = $that.find('.select span.active').data('filter');

    if(a !== 'all'){
      $(".list .item:not(."+a+")").css('display','none');
    }
     
  });

  if($('.grid').length !== 0){
    $('.grid').isotope();
  }
  if($('#filteredContent').length){
    console.log('refreshed');
      
    var $owl = $(" #filteredContent .landscape-carousel").owlCarousel({ 
                          nav: false,
                          dots: false,
                          smartSpeed: 500,
                          fluidSpeed: 500,
                          loop: false,
                          margin: 20,
                          autoWidth: true,
                          dragEndSpeed: 600,
                          items:1
                        });
    $owl.trigger('destroy.owl.carousel');
    $owl.html($owl.find('.owl-stage-outer').html()).removeClass('owl-loaded');
    $owl = $(" #filteredContent .landscape-carousel").owlCarousel({ 
                          nav: false,
                          dots: false,
                          smartSpeed: 500,
                          fluidSpeed: 500,
                          loop: false,
                          margin: 20,
                          autoWidth: true,
                          dragEndSpeed: 600,
                          items:1
                        });
    $owl.owlCarousel();
  }
  

}

$(document).ready(function() {

  // on click on a filter
  if ($('.filters').length) {
  $('.filters .select span').on('click', function() {
    var h = $(this).parent().html();

    $('#filters').remove();
    $('body').append('<div id="filters"><div class="vCenter"><div class="vCenterKid"></div></div><div class="close-button"><i class="icon icon_close"></i></div></div>');
    $('#filters .vCenterKid').html(h);
    $('#filters').attr('data-id', $(this).parents('.filter').attr('id'));

    setTimeout(function() {
      $('#filters').addClass('show');
    }, 100);

    setTimeout(function() {
      $('#filters span').addClass('show');
    }, 400);
  });
}
  if ($('.filters-slider').length) {
    $('.filters-slider .select span').on('click', function() {
    var h = $(this).parent().html();

    $('#filters').remove();
    $('body').append('<div id="filters"><div class="vCenter"><div class="vCenterKid"></div></div><div class="close-button"><i class="icon icon_close"></i></div></div>');
    $('#filters .vCenterKid').html(h);
    $('#filters').attr('data-id', $(this).parents('.filter').attr('id'));

    setTimeout(function() {
      $('#filters').addClass('show');
    }, 100);

    setTimeout(function() {
      $('#filters span').addClass('show');
    }, 400);
  });
  }

  // close filters
  $('body').on('click', '#filters', function() {
    $('#filters').removeClass('show');
    setTimeout(function() {
      $('#filters').remove();
    }, 700);
  });

  // filter data on page
  $('body').on('click', '#filters span', function() {

      var id = $('#filters').data('id'),
          i = $(this).index();

      $('#' + id + ' .select span').removeClass('active');
      $('#' + id + ' .select span').eq(i).addClass('active');



      // $(".list .item:not(."+$(this).data('filter')+")").css('display','none');
      // $(".list .item."+$(this).data('filter')).css('display','block');


      $(".list .item").css("display","block");
      filter();
  });

});