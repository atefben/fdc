$(document).ready(function() {

  if($('.home').length) {

  // News
  // =========================

  var cl = new CanvasLoader('canvasloader');
    cl.setColor('#ceb06e');
    cl.setDiameter(20);
    cl.setDensity(34);
    cl.setRange(0.8);
    cl.setSpeed(1);
    cl.setFPS(60);

  // Change date

  $('#timeline a').on('click', function(e) {
    e.preventDefault();

    if($(this).hasClass('active') || $(this).hasClass('disabled')) {
      return false;
    }

    $('#timeline a').removeClass('active');
    $(this).addClass('active');

    $('#articles-wrapper').addClass('loading');

    $('html, body').animate({
      scrollTop: $("#news").offset().top - 50
    }, 500);

    setTimeout(function() {
      cl.show();
      $('.canvasloader').addClass('show');
    }, 800);

    // todo: remove timeout
    setTimeout(function() {
      $.ajax({
        type: "GET",
        dataType: "html",
        cache: false,
        url: 'news.html' ,
        success: function(data) {
          $('.canvasloader').removeClass('show');
          $('#articles-wrapper').html(data);

          setTimeout(function() {
            cl.hide();
            $('#articles-wrapper').removeClass('loading');
          }, 500);

          $('.filter .select span').removeClass('active');
          $('.filter .select span[data-filter="all"]').addClass('active');

          initSlideshows();
        }
      });
    }, 2200);
    
  });


  // load more
  $('.read-more').on('click', function(e) {
    e.preventDefault();

    // load previous day
    if($(this).hasClass('prevDay')) {
      $('#shd').removeClass('show');
      $('.read-more').html("Afficher <strong>plus d'actualités</strong>").removeClass('prevDay');
      $('#articles-wrapper').addClass('loading');
      
      $('html, body').animate({
        scrollTop: $("#news").offset().top - 50
      }, 1000);

      var i = $('#timeline a.active').index();
      $('#timeline a').removeClass('active');
      $('#timeline a').eq(i).next().addClass('active');

      setTimeout(function() {
        cl.show();
        $('.canvasloader').addClass('show');
      }, 800);

      // todo: remove timeout
      setTimeout(function() {
        $.ajax({
          type: "GET",
          dataType: "html",
          cache: false,
          url: 'news.html' ,
          success: function(data) {
            $('.canvasloader').removeClass('show');

            setTimeout(function() {
              cl.hide();
              $('#articles-wrapper').removeClass('loading');
            }, 500);

            $('#articles-wrapper').html(data);

            $('.filter .select span').removeClass('active');
            $('.filter .select span[data-filter="all"]').addClass('active');

            initSlideshows();
          }
        });
      }, 1200);
    } else {
      $.ajax({
        type: "GET",
        dataType: "html",
        cache: false,
        url: 'news_page2.html' ,
        success: function(data) {
          $('#articles-wrapper').css('max-height', $('#articles-wrapper').height()).append(data);
          $('#articles-wrapper').css('max-height', $('#articles-wrapper').prop('scrollHeight'));

          $('.read-more').html('Passer au <strong>jour précédent</strong>').addClass('prevDay');
          setTimeout(function() {
            $('#shd').addClass('show');
          }, 500);
        }
      });
    }
      
  });

  }

});