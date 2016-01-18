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
     
    // if(a == 'all') {
    //   $('.content-news .slideshow').show();
    //   return;
    // }

    // var obj = {'filter': $that.attr('id'), 'value': a};
    
    // filters.push(obj);
  });

  if($('.grid').length !== 0){
    $('.grid').isotope();
  }

  


  // var exp1 = '',
  //     exp2 = '';

  // for(var i=0; i<filters.length; i++) {
  //   exp1 += '[data-' + filters[i].filter + ']';
  //   exp2 += '[data-' + filters[i].filter + '="' + filters[i].value + '"]';
  // }

  // if($('#filteredArticles').length) {
  //   $('#filteredArticles').remove();
  // }

  // console.log("FILTERS AND EXP", filters, exp1, exp2);

  // if(filters.length !== 0) {
  //   $('*' + exp1).hide();
  //   $('*' + exp2).show();

  // }

  //   if($('.articles').length != 0) {
  //     $('#articles-wrapper').prepend('<div class="articles center" id="filteredArticles"></div>');

  //     $('.articles:not(.nextDay) article').each(function() {
  //       if($(this).css('display') == 'block') {
  //         $('#filteredArticles').append($(this).clone().removeClass('double'));
  //         $(this).hide();
  //       }
  //     });

  //     if($('#format .select .active').text() == "Photo") {
  //       $('.content-news .slideshow').show();
  //     } else {
  //       $('.content-news .slideshow').hide();
  //     }

  //     $('.articles.nextDay article').show();
  //   }
  // } else {
  //   $('*[data-' + id + ']').show();
  // }
}

$(document).ready(function() {

  // on click on a filter
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