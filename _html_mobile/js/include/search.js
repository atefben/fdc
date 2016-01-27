

$(document).ready(function() {

  var openedKeyboard = false;
function closeSearch() {
  $('html').removeClass('overlay');
    $('#searchContainer').removeClass('open');
  $('#search').removeClass('opened');
}

  function openSearch() {
    $(' html').addClass('overlay');
    $('#searchContainer').addClass('open');
    $('#inputSearch').focus();
  }  
  function iosfixedfix(){
    if ($(this).scrollTop()>90) {
      $("#searchContainer").css({
        'top':$(this).scrollTop()+90 +'px'
      });
      $("#header").css({
        'top':$(this).scrollTop() +'px'
      });
    }else{
      $("#searchContainer").css({
        'top':'180px'
      });
      $("#header").css({
        'top': '0px'
      });
    }
  }

  $('body').on('click', '#suggest li', function(e) {
    var link = $(this).data('link');

    window.location = link;
  });
  
    /* bind events */
    $("#inputSearch")
    .on('focus', function() {
        $("#searchContainer").addClass('fixfixed');
        $("#header").addClass('fixfixed');
        openedKeyboard = true;
        iosfixedfix();
        $(window).on({
            'scroll': function(e) { 
                if (openedKeyboard) {
                  iosfixedfix();
                }
                
            }
        });
    })
    .on('blur', function() {
        $("#searchContainer").removeClass('fixfixed');
        $("#header").removeClass('fixfixed');
        openedKeyboard = false;
        $("#searchContainer").css({
            'top':''
          });
          $("#header").css({
            'top':''
          });
    });

  $('.suggestSearch').on('input', function(e) {
    var value = $(this).val();
    var $suggest = $(this).parent().next();
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
        url: 'searchsuggest.json', //TODO a revoir//
        success: function(data) {

          for (var i=0; i<data.length; i++) {
            var name = data[i].name,
                link = data[i].link;

            var txt = name.toLowerCase();

            txt = txt.replace(value.toLowerCase(), '<strong>' + value.toLowerCase() + '</strong>');

            $suggest.append('<li data-link="' + link + '">' + txt + '</li>');
          }
        }
      });
    }

    
  });

  $('#search').on('click', function(e) {
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

    $('#search').toggleClass('opened');
  });



});