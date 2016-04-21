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
    window.location = link;
  });

  $('#inputSearch').on('input', function(e) {
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
    if (noWhitespaceCount % 3 === 0) {
      $suggest.empty();

      $.ajax({
        type: "GET",
        url: GLOBALS.urls.searchUrl,
        data: {
          "searchTerm": value 
        },
        success: function(data) {
          for (var i=0; i<data.length; i++) {
            var type = data[i].type,
                name = data[i].name,
                link = data[i].link;

            var txt = name.toLowerCase();
            txt = txt.replace(value.toLowerCase(), '<strong>' + value.toLowerCase() + '</strong>');
            $suggest.append('<li data-link="' + link + '"><span>' + type + '</span>' + txt + '</li>');
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

          var $activeEl = $('#colSearch a.active');

          if($activeEl.hasClass('artists') || $activeEl.hasClass('events') || $activeEl.hasClass('films') || $activeEl.hasClass('participate')) {
            $('.filters').hide();
          } else {
            $('.filters').show();
          }

          $('#filteredContent').empty();
          var url = $this.data('ajax');

          $.ajax({
            type: "GET",
            url: url,
            success: function(data) {
              $('#filteredContent').html(data);
              $('#filtered').fadeIn();

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
        }, 700);
      });
    });

    // test : remove once on server
    if($('.searchpage #inputSearch').val() == 'Léonardo Di Caprio') { //TODO a revoir//
      $('#noResult').show();
      $('#count span').text('0');
      return false;
    }

    $.ajax({
      type: "GET",
      url: 'results.json', //TODO  a revoir//
      success: function(data) {

        if(data.all.count == 0) {
          $('#noResult').show();
          return false;
        } else {
          $('.resultWrapper').show();
          $('#count span, #colSearch .all span').text(data.all.count);

          // ARTISTS
          var artists = data.persons;
          $('#colSearch .artists span').text(artists.count);

          // FILMS
          var films = data.films;
          $('#colSearch .films span').text(films.count);

          // FILMS
          var medias = data.medias;
          $('#colSearch .medias span').text(medias.count);

          // NEWS
          var news = data.news;
          $('#colSearch .news span').text(news.count);

          // COMMUNIQUES
          var communiques = data.communiques;
          $('#colSearch .communiques span').text(communiques.count);

          // EVENTS
          var events = data.events;
          $('#colSearch .events span').text(events.count);

          // PARTICIPATE
          var participate = data.participate;
          $('#colSearch .participate span').text(participate.count);
        }
      }
    });
  }
});