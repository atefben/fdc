
$(document).ready(function() {
 
var menu = $("#horizontal-menu").owlCarousel({
		  nav: false,
		  dots: false,
		  smartSpeed: 500,
		  margin: 40,
		  autoWidth: true,
		  loop: false,
		  items:2,
		  onInitialized: function() {
		    var m = ($(window).width() - $('.container').width()) / 2;
		    $('#horizontal-menu .owl-stage').css({ 'margin-left': m });
		  },
		  onResized: function() {
		    var m = ($(window).width() - $('.container').width()) / 2;
		    $('#horizontal-menu .owl-stage').css({ 'margin-left': m });
		  }
		});
		menu.owlCarousel();

		



    $('#horizontal-menu a').on('click',function(e){
      e.preventDefault();
      if($(this).is(':not(.active)')) {
        var urlPath = $(this).attr('data-url');
        $.get(urlPath, function(data){
          $( ".content-selection" ).html( $(data).find('.content-selection').html() );




           history.pushState('',GLOBALS.texts.url.title, urlPath);
          


        });

        $('#horizontal-menu a').removeClass('active');
        $(this).addClass('active');
      }
    });

	
	var slider = $(".portrait-slider").owlCarousel({ 
	      nav: false,
	      dots: false,
	      smartSpeed: 500,
	      fluidSpeed: 500,
	      loop: false,
	      margin: 60,
	      autoWidth: true,
	      dragEndSpeed: 600,
	      items:1,
	      center:true
	    });

	    slider.owlCarousel();

	var sliderArticles = $(".landscape-carousel").owlCarousel({ 
	      nav: false,
	      dots: false,
	      smartSpeed: 500,
	      fluidSpeed: 500,
	      loop: false,
	      margin: 20,
	      autoWidth: true,
	      dragEndSpeed: 600,
	      items:1
	    });

	    sliderArticles.owlCarousel();


if($('.searchpage').length) {

      
    $('.view-all, #horizontal-menu a').on('click', function(e) {
      e.preventDefault();

      var $this = $(this);

      $('#horizontal-menu a').removeClass('active');

      if($this.parents('#horizontal-menu').length != 0) {
        $this.addClass('active');
      } else {
        var cl = $this.data('class');
        $('#horizontal-menu a').each(function() {
          if($(this).hasClass(cl)) {
            $(this).addClass('active');
          }
        });
      }


      $('.resultWrapper, #filtered').fadeOut(500, function() {

        setTimeout(function() {

          if($this.hasClass('all')) {
            $('.result').fadeIn();
            return false;
          }

          var $activeEl = $('#horizontal-menu a.active');

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

              if($activeEl.hasClass('artists') || $activeEl.hasClass('films')){
                var slider = $("#filteredContent .portrait-slider").owlCarousel({ 
      			      nav: false,
      			      dots: false,
      			      smartSpeed: 500,
      			      fluidSpeed: 500,
      			      loop: false,
      			      margin: 60,
      			      autoWidth: true,
      			      dragEndSpeed: 600,
      			      items:1,
      			      center:true
      			    });

      			    slider.owlCarousel();
              }else{
              	var sliderArticles = $(" #filteredContent.landscape-carousel").owlCarousel({ 
        			      nav: false,
        			      dots: false,
        			      smartSpeed: 500,
        			      fluidSpeed: 500,
        			      loop: false,
        			      margin: 20,
        			      autoWidth: true,
        			      dragEndSpeed: 600,
        			      items:1
        			    });

	               sliderArticles.owlCarousel();
              }
                $('#filtered').fadeIn();
                  var filters = $(".filters-slider").owlCarousel({
            			  nav: false,
            			  dots: false,
            			  smartSpeed: 500,
            			  stagePadding: 40,
            			  autoWidth: false,
            			  loop: false,
            			  items:2,
            			  onInitialized: function() {
            			    
            			    $('#filters-menu .owl-stage').css({ 'padding-left': '0' });
            			  },
            			  onResized: function() {
            			    $('#filters-menu .owl-stage').css({ 'padding-left': '0' });
            			  }
            			});
                  $('.result').addClass('hidden');
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