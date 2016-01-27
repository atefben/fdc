
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
        url: 'searchsuggest.json', 
        success: function(data) {

          for (var i=0; i<data.length; i++) {
            var name = data[i].name,
                link = data[i].link;

            var txt = name.toLowerCase();
            if (txt.indexOf(value.toLowerCase()) != -1){
              txt = txt.replace(value.toLowerCase(), '<strong>' + value.toLowerCase() + '</strong>');

              $suggest.append('<li data-link="' + link + '">' + txt + '</li>');
            }
            
          }
        }
      });
    }

    
  });



    // $('#horizontal-menu a').on('click',function(e){
    //   e.preventDefault();
    //   if($(this).is(':not(.active)')) {
    //     var urlPath = $(this).attr('data-url');
    //     $.get(urlPath, function(data){
    //       $( ".content-selection" ).html( $(data).find('.content-selection').html() );




    //        history.pushState('',GLOBALS.texts.url.title, urlPath);
          


    //     });

    //     $('#horizontal-menu a').removeClass('active');
    //     $(this).addClass('active');
    //   }
    // });

	
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
      var fromAll = false;
      var fromfiltered = false;
      if($('#horizontal-menu a.active').hasClass('all')){
        fromAll = true;
      }
      if($('#horizontal-menu a.active').hasClass('news') || $('#horizontal-menu a.active').hasClass('communiques') || $('#horizontal-menu a.active').hasClass('medias')) {
        fromfiltered = true;
      }
      var $this = $(this);
      if ($this.hasClass('active')){
        return false;
      }
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

      if($('#horizontal-menu a.active').hasClass('all')){
        $('#filtered').fadeOut(900,function(){
          $('.result').fadeIn(900);
        });
        
      }else{
        
          var url = $this.data('ajax');

          
          if (fromAll) {
              $.ajax({
                  type: "GET",
                  url: url,
                  success: function(data) {
                    $('#filteredContent').html(data);

                    if($this.hasClass('artists') || $this.hasClass('films')){
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
                      var sliderArticles = $(" #filteredContent .landscape-carousel").owlCarousel({ 
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
                    
                    $('.result').fadeOut(900,function(){
                      $('#filtered').fadeIn(900,function(){
                            if($this.hasClass('artists') || $this.hasClass('events') || $this.hasClass('films') || $this.hasClass('participate')) {
                          
                        } else {
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
                            filters.owlCarousel();
                          $('#filtered .filters-slider').fadeIn(900,function(){
                            
                          });
                          

                        }
                      });
                    });
                  }
                });
            }else{
                if(fromfiltered) {
                      $('#filtered .filters-slider').fadeOut(900);
                }
                $('#filteredContent').animate({'opacity':'0'},900,function(){
                  $.ajax({
                  type: "GET",
                  url: url,
                  success: function(data) {
                    $('#filteredContent').html(data);

                    if($this.hasClass('artists') || $this.hasClass('films')){
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
                      var sliderArticles = $(" #filteredContent .landscape-carousel").owlCarousel({ 
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
                    if($this.hasClass('artists') || $this.hasClass('events') || $this.hasClass('films') || $this.hasClass('participate')) {
                      
                    } else {
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
                            filters.owlCarousel();
                          $('#filtered .filters-slider').fadeIn(900,function(){
                            
                          });
                      

                    }
                    $('#filteredContent').animate({'opacity':'1'},900);
                    
                  }
                });

                });
            }
            
          

      
       
}
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
          $('.result').show();
          $('#horizontal-menu .all span').text(data.all.count);

          // ARTISTS
          var artists = data.persons;
          $('#horizontal-menu .artists span').text(artists.count);

          // FILMS
          var films = data.films;
          $('#horizontal-menu .films span').text(films.count);

          // FILMS
          var medias = data.medias;
          $('#horizontal-menu .medias span').text(medias.count);

          // NEWS
          var news = data.news;
          $('#horizontal-menu .news span').text(news.count);

          // COMMUNIQUES
          var communiques = data.communiques;
          $('#horizontal-menu .communiques span').text(communiques.count);

          // EVENTS
          var events = data.events;
          $('#horizontal-menu .events span').text(events.count);

          // PARTICIPATE
          var participate = data.participate;
          $('#horizontal-menu .participate span').text(participate.count);
        }
      }
    });
  }

});