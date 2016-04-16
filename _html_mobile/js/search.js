$(document).ready(function() {
  $('body').on('click', '#suggest li', function(e) {
    var link = $(this).data('link');
    window.location = link;
  });

  $('.suggestSearch').on('input', function(e) {
    var value             = $(this).val();
    var $suggest          = $(this).parent().next();
    var noWhitespaceValue = value.replace(/\s+/g, '');
    var noWhitespaceCount = noWhitespaceValue.length;

    if($('.searchpage').length) {
      $suggest = $('#main #suggest');
    }

    if(value == '') {
      $suggest.empty();
      return false;
    }

    if (noWhitespaceCount >= 3) {
      $suggest.empty();

      $.ajax({
        type: "GET",
        url : 'searchsuggest.json', 
        success: function(data) {
          for (var i=0; i<data.length; i++) {
            var name = data[i].name,
                link = data[i].link;
            var txt = name.toLowerCase();

            if (txt.indexOf(value.toLowerCase()) != -1) {
              txt = txt.replace(value.toLowerCase(), '<strong>' + value.toLowerCase() + '</strong>');
              $suggest.append('<li data-link="' + link + '">' + txt + '</li>');
            }
          }
        }
      });
    }
  });

  $('#search').on('click', function(e) {
    // e.preventDefault();
    // if($('.searchpage').length) {
    //   return false;
    // }

    // if($(this).hasClass('opened')) {
    //   closeSearch();
    //   return false;
    // } else {
    //   openSearch();
    // }

    // $('#search').toggleClass('opened');
  });
});