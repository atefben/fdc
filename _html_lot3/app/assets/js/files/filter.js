// Filters
// =========================

var owInitFilter = function(){
  // on click on a filter
  $('body').on('click', '.filters .select span', function() {
    var h = $(this).parent().html();

    $('#filters').remove();
    $('body').append('<div id="filters"><div class="vCenter"><div class="vCenterKid"></div></div><div class="close-button"><i class="icon icon-close"></i></div></div>');
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

    owInitGrid('filter');
  });
};
