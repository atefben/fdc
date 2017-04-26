function customFilter() {
  $('.filter').each(function() {
    var $that = $(this);
    var a = $that.find('.select span.active').data('filter');

    if(a !== 'all') {
      $(".list .item:not(."+a+")").css('display','none');
    }
  });

  var selectedDate = $('#dates').find('.select span.active').data('filter');
  if (selectedDate == 'all') {
      $('#theme .select span').addClass('do-display');
  } else {
      $('#theme .select span').removeClass('do-display');
      $(".list ." + selectedDate).each(function () {
          var news = $(this);
          $('#theme .select span').each(function () {
              var themeFilter = $(this);
              if (themeFilter.data('filter') == 'all' || news.hasClass(themeFilter.data('filter'))) {
                  themeFilter.addClass('do-display');
              }
          });
      });
  }

  var selectedTheme = $('#theme').find('.select span.active').data('filter');
  if (selectedTheme == 'all') {
    $('#dates .select span').addClass('do-display');
  } else {
      $('#dates .select span').removeClass('do-display');
      $(".list ."+selectedTheme).each(function() {
          var news = $(this);
        $('#dates .select span').each(function() {
            var dateFilter = $(this);
            if (dateFilter.data('filter') == 'all' || news.hasClass(dateFilter.data('filter'))) {
                dateFilter.addClass('do-display');
            }
        });
      });
  }

  if($('.grid').length !== 0) {
    $('.grid').isotope();
  }
}

$(document).ready(function() {

    $('#theme .select span').addClass('do-display');
    $('#dates .select span').addClass('do-display');

  // on click on a filter
  if ($('.filters').length) {
    $('.filters .select span').off('click').on('click', function() {
      var h = $(this).parent().html();

      $('body').addClass('no-scroll');

      $('#filters').remove();
      $('body').append('<div id="filters"><div class="vCenter"><div class="vCenterKid"></div></div><div class="close-button"><i class="icon icon_close"></i></div></div>');
      $('#filters .vCenterKid').html(h);
      $('#filters').attr('data-id', $(this).parents('.filter').attr('id'));

      setTimeout(function() {
        $('#filters').addClass('show');
      }, 100);

      setTimeout(function() {
        $('#filters span.do-display').addClass('show');
      }, 400);
    });
  }


  // filter data on page
  $('body').off('click', '#filters span').on('click', '#filters span', function() {
      var id = $('#filters').data('id'),
          i  = $(this).index();

      $('#' + id + ' .select span').removeClass('active');
      $('#' + id + ' .select span').eq(i).addClass('active');

      $(".list .item").css("display","block");
      customFilter();
  });
});