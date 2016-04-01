var selectionOpen = false,
    filters;

function openSelection() {
  $('#main').addClass('st-effect st-selection-open');  
  selectionOpen = true;

  $('.selection-main-container .thumb').remove();

  filters = $("#myselection-filters").owlCarousel({
    nav: false,
    dots: false,
    smartSpeed: 500,
    margin: 0,
    autoWidth: false,
    loop: false,
    items:3,
    stagePadding:40,
    onInitialized: function() {
      var m = ($(window).width() - $('.container').width()) / 2;
      $('#horizontal-filters .owl-stage').css({ 'margin-left': m });
    },
    onResized: function() {
      var m = ($(window).width() - $('.container').width()) / 2;
      $('#horizontal-filters .owl-stage').css({ 'margin-left': m });
    }
  });
  filters.owlCarousel();

  $("#myselection-filters a").on('click',function(e) {
    e.preventDefault();
    $("#myselection-filters a").removeClass('active');
    $(this).addClass('active');

    var filter = $(this).data('filter')

    if($(this).data('filter') == 'suggestion') {
      $('.suggestion').css('display','block');
      $('.my-selection-container').css('display','none');
      $('.thumb').css('display','block');
    } else {
      $('.my-selection-container').css('display','block');
      $('.suggestion').css('display','none');

      if($(this).data('filter') == 'all') {
        $('.thumb').css('display','block');
      } else{
        $( ".thumb" ).each(function() {
          if ($(this).find('.icon_'+filter+'').length == 0) {
            $(this).css('display','none');
          } else {
            $(this).css('display','block');
          }
        });
      }
    }
  });

  $.ajax({
    type     : "GET",
    dataType : "html",
    cache    : false,
    url      : GLOBALS.urls.selectionUrl ,
    success: function(data) {
      $('.suggestion').append(data);
    }
  });

  if (JSON.parse(localStorage.getItem('mySelection')) && JSON.parse(localStorage.getItem('mySelection')).length > 0) {
    displaySelection();
  } else {
    $('.count span').html(0);
    displaySuggestions();
  }
}

$(document).ready(function() {
  $('#selection-btn').on('click', function() {
    openSelection();
  });
  
  $('#main').on('click', function(e) {
    if(
      !$(e.target).parents('.selection-main-container').length && 
      !$(e.target).parents('#selection-btn').length && 
      !$(e.target).hasClass('delete') && 
      !$(e.target).hasClass('icon_close')
    ) {
      if(selectionOpen) {
        $('#main').removeClass('st-effect st-selection-open');  
        selectionOpen = false;
      }
    }
  });

  var displaySelection = function() {
    $('.count span').html(JSON.parse(localStorage.getItem('mySelection')).length);

    for(var i = 0 ; i < JSON.parse(localStorage.getItem('mySelection')).length ; i++) {
      var thumb = $("<div class='thumb'></div>")
      thumb.html(JSON.parse(localStorage.getItem('mySelection'))[i])
      thumb.find('.picto-my-selection').remove();
      thumb.append('<span class="delete"><i class="icon icon_close"></i></span>');
      $('.my-selection-container').prepend(thumb);
    }

    $('.delete').on('click',function() {
      var index = $(this).parent().index();
      var items = JSON.parse(localStorage.getItem('mySelection'));
      items.splice(index,1);
      localStorage.setItem('mySelection', JSON.stringify(items));
      $(this).parent().remove();
      $('.count span').html(JSON.parse(localStorage.getItem('mySelection')).length);
    });

    $("#myselection-filters a[data-filter='all']").trigger("click");
    filters.trigger("to.owl.carousel", [0, 2, true]);
  }

  var displaySuggestions = function() {
    filters.trigger("to.owl.carousel", [3, 2, true]);
    $("#myselection-filters a[data-filter='suggestion']").trigger("click");
  }
});