function closeSearch() {
  $('#main, footer').removeClass('overlay');
  $('#searchContainer').css({
    minHeight : 0,
    maxHeight: 0
  });
  $('.search').removeClass('opened');
}

$(document).ready(function() {
  function openSearch() {
    $('#main, footer').addClass('overlay');
    $('#searchContainer').css({
      minHeight : $(window).height() - 91,
      maxHeight: '8000px'
    });
    $('#inputSearch').focus();
  }  

  $('body').on('click', '#suggest li', function(e) {
    var link = $(this).data('link');
    if (typeof link !== "undefined" && link != "") {
      window.location = link;
    } else {
      e.preventDefault();
    }
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

    if (GLOBALS.env == "html") {
      searchUrl = GLOBALS.urls.searchUrl;
    } else {
      searchUrl = GLOBALS.urls.searchUrl+'/'+encodeURIComponent(value);
    }

    if (noWhitespaceCount >= 3) {
      $.ajax({
        type: "GET",
        url: searchUrl,
        success: function(data) {
          $suggest.empty();

          if(data.length > 0) {
            for (var i=0; i<data.length; i++) {
              var type = data[i].type,
                  name = data[i].name,
                  link = data[i].link;

              var txt = name.toLowerCase();
              txt = txt.replace(value.toLowerCase(), '<strong>' + value.toLowerCase() + '</strong>');
              $suggest.append('<li data-link="' + link + '"><span>' + type + '</span>' + txt + '</li>');
            }
          } else {
            $suggest.append('<li>' + GLOBALS.texts.search.noresult + '</li>')
          }
        },
        error: function() {
          $suggest.empty();
          $suggest.append('<li>' + GLOBALS.texts.search.noresult + '</li>')
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
    $('#colSearch').css('left', ($(window).width() - 977) / 2);
    
    $( window ).resize( function(){
      $('#colSearch').css('left', ($(window).width() - 977) / 2);
    });

    $('#colSearch a, .view-all').on('click', function(e) {
      e.preventDefault();

      var $this = $(this);
      $('#colSearch a').removeClass('active');
      
      if($this.parents('#colSearch').length != 0) {
        $this.addClass('active');
      } else {
        var cl = $this.data('class');
        $('#colSearch a').each(function() {
          if($(this).hasClass(cl)) {
            $(this).addClass('active');
          }
        });
      }

      $('html, body').animate({
        scrollTop: 0
      }, 500);

      $('.resultWrapper, #filtered').fadeOut(500, function() {
        setTimeout(function() {
          if($this.hasClass('all')) {
            $('.resultWrapper').fadeIn();
            return false;
          }

          var url = $this.data('ajax');

          $.ajax({
            type: "GET",
            url: url,
            success: function(data) {
              $('#filtered').empty();
              $('#filtered').html(data);
              
              // if($('#colSearch a.active').hasClass('artists') || 
              //    $('#colSearch a.active').hasClass('events')  || 
              //    $('#colSearch a.active').hasClass('films')   || 
              //    $('#colSearch a.active').hasClass('participate')) {
              //   $('.filters').hide();
              // } else {
              //   $('.filters').show();
              // }

              setTimeout(function() {
                $('#filtered').fadeIn(500);
              }, 200)

              $('#filteredContent').infinitescroll({
                navSelector: ".next:last",
                nextSelector: ".next:last",
                itemSelector: ".infinite",
                debug: false,
                dataType: 'html',
                path: function(index) {
                  if($('.next:last').attr('href') == '#') {
                    return false;
                  }
                  return $('.next:last').attr('href');
                }
              });
            }
          });
        }, 1000);
      });
    });

    if (GLOBALS.env == "html") {
      resultUrl = GLOBALS.urls.resultUrl;
    } else {
      resultUrl = GLOBALS.urls.resultUrl+'/'+encodeURIComponent($('.searchpage #inputSearch').val());
    }

    if (parseInt($('#colSearch .all span').text()) > 0) {
      $('.resultWrapper').show();
    } else {
      $('#noResult').show();
    }
  }
});