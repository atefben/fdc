function closeSearch() {
  $('#main, footer').removeClass('overlay');
  $('#searchContainer').css({
    minHeight : 0,
    maxHeight: 0
  });
  $('.search').removeClass('opened');
}

$(document).ready(function() {

  // Search
  // =========================

  function openSearch() {
    $('#main, footer').addClass('overlay');
    $('#searchContainer').css({
      minHeight : $(window).height() - 91,
      maxHeight: '8000px'
    });
    $('#inputSearch').focus();
  }  

  $('body').on('click', '#suggest li', function(e) {
    var n = $(this).data('search');

    window.location = 'search.php?name=' + n;
  });

  $('#inputSearch').on('input', function(e) {
    var value = $(this).val();
    var noWhitespaceValue = value.replace(/\s+/g, '');
    var noWhitespaceCount = noWhitespaceValue.length;
    if (noWhitespaceCount % 3 === 0) {

      $('#suggest').empty();

      $.ajax({
        type: "GET",
        url: 'searchsuggest.json',
        success: function(data) {
          console.log(data);
          for (var i=0; i<data.length; i++) {
            var type = data[i].type,
                name = data[i].name;

            var txt = name.toLowerCase();

            txt = txt.replace(value.toLowerCase(), '<strong>' + value.toLowerCase() + '</strong>');

            $('#suggest').append('<li data-search="' + name + '"><span>' + type + '</span>' + txt + '</li>');
          }
        }
      });
    }

    
  });

  $('.search').on('click', function(e) {
    e.preventDefault();
    if($('.searchpage').length) {
      return false;
    }

    if($(this).hasClass('opened')) {
      closeSearch();
      return false;
    } else {
      openSearch();
    }

    $('.search').toggleClass('opened');
  });

  if($('.searchpage').length) {
    
  }

});