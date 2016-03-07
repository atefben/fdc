// Filters
// =========================

function filter() {
  var id = $('#filters').data('id');
  var filters = [];

  $('.filter').each(function() {
    var $that = $(this);
    var a = $that.find('.select span.active').data('filter');

    if(a == 'all') {
      $('.content-news .slideshow').show();
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

  if($('#filteredArticles').length) {
    $('#filteredArticles').remove();
  }

  if(filters.length != 0) {
    $('*' + exp1).hide();
    $('*' + exp2).show();

    if($('.articles').length != 0) {
      $('#articles-wrapper').prepend('<div class="articles center" id="filteredArticles"></div>');

      $('.articles:not(.nextDay) article').each(function() {
        if($(this).css('display') == 'block') {
          $('#filteredArticles').append($(this).clone().removeClass('double'));
          $(this).hide();
        }
      });

      if($('#format .select .active').text() == "Photo") {
        $('.content-news .slideshow').show();
      } else {
        $('.content-news .slideshow').hide();
      }

      $('.articles.nextDay article').show();

      $('.filter .select').each(function() {
        var d = new Date();
        var n = d.getFullYear();

        $that = $(this);
        $id   = $(this).closest('.filter').attr('id');

        $that.find("span:not(.active):not([data-filter='all'],[data-filter='d"+n+"'])").each(function() {
          $this = $(this);

          var getVal = $this.data('filter');
          var numItems = $('#filteredArticles article[data-'+$id+'="'+getVal+'"]').length;
          if (numItems === 0) {
              $this.addClass('disabled');
          } else {
              $this.removeClass('disabled');
          }
        });
      });
    }
  } else {
    $('*[data-' + id + ']').show();
    
    if($('.articles').length != 0) {
      $('.filter .select span').removeClass('disabled');
    }
  }
}

$(document).ready(function() {

  // on click on a filter
  $('body').on('click', '.filters .select span', function() {
    var h = $(this).parent().html();

    $('#filters').remove();
    $('body').append('<div id="filters"><div class="vCenter"><div class="vCenterKid"></div></div><div class="close-button"><i class="icon icon_close"></i></div></div>');
    $('#filters .vCenterKid').html(h);
    $('#filters .vCenterKid').find(':not(span)').remove();
    $('#filters .vCenterKid').find('span.disabled').remove();
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
          f  = $(this).data('filter');

      $('#' + id + ' .select span').removeClass('active');
      $('#' + id + ' .select span[data-filter="'+f+'"]').addClass('active');

      filter();
  });

});