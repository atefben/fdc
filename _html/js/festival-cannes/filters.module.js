// Filters
// =========================

$(document).ready(function() {

  // on click on a filter
  $('.filters .select span').on('click', function() {
    var h = $(this).parent().html();

    $('#filters').remove();
    $('body').append('<div id="filters"><div class="vCenter"><div class="vCenterKid"></div></div><div class="close-button"></div></div>');
    $('#filters .vCenterKid').html(h);
    $('#filters').addClass('show').attr('data-id', $(this).parents('.filter').attr('id'));

    setTimeout(function() {
      $('#filters span').addClass('show');
    }, 400);
  });

  // close filters
  $('body').on('click', '#filters', function() {
    $('#filters').removeClass('show');
  });

  // filter data on page
  $('body').on('click', '#filters span', function() {
    var id = $('#filters').data('id'),
        i = $(this).index();

    $('#' + id + ' .select span').removeClass('active');
    $('#' + id + ' .select span').eq(i).addClass('active');

    var filters = [];

    $('.filter').each(function() {
      var $that = $(this);
      var a = $that.find('.select span.active').data('filter');
      
      if(a == 'all') {
        return;
      }

      var obj = {'filter': $that.attr('id'), 'value': a};
      
      filters.push(obj);
    });

    var exp1 = '',
        exp2 = '';

    for(var i=0; i<filters.length; i++) {
      exp1 += '[data-' + filters[i].filter + ']';
      exp2 += '[data-' + filters[i].filter + '="' + filters[i].value + '"]';
    }

    if(filters.length != 0) {
      $('*' + exp1).hide();
      $('*' + exp2).show();

      if($('.articles').length != 0) {
        $('.articles').removeClass('left right').addClass('center');
        $('.articles article').removeClass('double');
      }
    } else {
      $('*[data-' + id + ']').show();
    }
  });

});