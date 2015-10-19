$(document).ready(function() {

  if($('.home').length) {

  // News
  // =========================

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

      // todo: remove timeout
      setTimeout(function() {
        $.ajax({
          type: "GET",
          dataType: "html",
          cache: false,
          url: 'news.html' ,
          success: function(data) {
            $('#articles-wrapper').html(data);
            $('#articles-wrapper').removeClass('loading');

            $('.filter .select span').removeClass('active');
            $('.filter .select span[data-filter="all"]').addClass('active');

            initSlideshows();
          }
        });
      }, 1000);
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