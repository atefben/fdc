var owInitSliderSelect = function(id) {

  if(id == "timelapse"){
    var slider = document.getElementById('timelapse');
    var snapValues = [
    	document.getElementById('slider-snap-value-lower'),
    	document.getElementById('slider-snap-value-upper')
    ];

      ys = $('.s-yearstart').val();
      ye = $('.s-yearend').val();

      ys = parseInt(ys);
      ye = parseInt(ye);
    
    noUiSlider.create(slider, {
    	start: [ys, ye],//todo script
    	connect: true,
    	range: {
            'min': 1946,
            'max': GLOBALS.year
    	}
     });

    slider.noUiSlider.on('update', function( values, handle ) {

    	snapValues[handle].innerHTML = parseInt(values[handle]);

        var lower = parseInt(values[0]);
        var up = parseInt(values[1]);

        $('.s-yearstart').val(lower);
        $('.s-yearend').val(up);
        
    });
  }

  if(id == 'tab-selection') {
    var $tab = $('.icon-s');

    $tab.on('click', function(){
      var input = $(this).find('input');
      var classTab = $tab[0].className;

      console.log(classTab);

      //faire deux class différente
      //verifier la class et en fonction mettre en opacity 0 !

      if(input[0].checked){

        input[0].checked = false;
        $(this).removeClass('active');

      }else{

        $('.more-search').addClass('active');
        input[0].checked = true;
        $(this).addClass('active');
      }

      if(!$('.tabs-two .icon-s').hasClass('active')){
        $('.more-search').removeClass('active');
      }

    });
  }
}


var autoComplete = function() {

  $('.close-suggest').css("display","none");

  $('.country').on('input', function(){

    $('.close-suggest').css("display","block");

    var value = $(this).val();
    var $suggest = $(this).next().next().find('.suggest');
    var noWhitespaceValue = value.replace(/\s+/g, '');
    var noWhitespaceCount = noWhitespaceValue.length;

    if (GLOBALS.env == "html") {
      searchUrl = GLOBALS.urls.searchUrlCountry;
    } else {
      searchUrl = GLOBALS.urls.searchUrlCountry+'/'+encodeURIComponent(value);
    }

    $.ajax({
      type: "GET",
      url: searchUrl,
      success: function (data) {
        $suggest.empty();

        if (data.length > 0) {


          for (var i = 0; i < data.length; i++) {
            var name = data[i].name;
            var txt = name.toLowerCase();


            txt = txt.replace(value.toLowerCase(), '<strong>' + value.toLowerCase() + '</strong>');

            var valueTrunc = value.substring(0, 3)
            var chaine = txt.indexOf(valueTrunc);

            if(chaine > -1) {
              $suggest.append('<li data-country='+name+'><span>' + txt + '</span></li>');

              $('.sub-tab').css('opacity', '0.2');
              $suggest.addClass('open');
            }

          }

          $('.suggest li').off('click').on('click', function(){

            var data = $(this).data('country');
            console.log($(this).parent().prev().prev());
            $(this).parent().parent().parent().find('.country').val(data.toLowerCase());

            $('.sub-tab').css('opacity', '1');
            $('.suggest').empty();
            $('.suggest').removeClass('open');

            $('.close-suggest').css("display","none");

          });

        } else {
          $suggest.append('<li>' + GLOBALS.texts.search.noresult + '</li>')
        }
      },
      error: function () {
        $suggest.empty();
        $suggest.append('<li>' + GLOBALS.texts.search.noresult + '</li>')
      }
    });


  });

  $('.close-suggest').css("display","none");

  $('.searchBar').on('input', function(){

    $('.close-suggest').css("display","block");

    var value = $(this).val();
    var $suggest = $(this).next().next().find('.suggest');
    var noWhitespaceValue = value.replace(/\s+/g, '');
    var noWhitespaceCount = noWhitespaceValue.length;

    if (GLOBALS.env == "html") {
      searchUrl = GLOBALS.urls.searchUrl;
    } else {
      searchUrl = GLOBALS.urls.searchUrl+'/'+encodeURIComponent(value);
    }

    $.ajax({
      type: "GET",
      url: searchUrl,
      success: function (data) {
        $suggest.empty();

        if (data.length > 0) {


          for (var i = 0; i < data.length; i++) {
            var name = data[i].name;
            var txt = name.toLowerCase();


            txt = txt.replace(value.toLowerCase(), '<strong>' + value.toLowerCase() + '</strong>');

            var valueTrunc = value.substring(0, 3)
            var chaine = txt.indexOf(valueTrunc);

            if(chaine > -1) {
              $suggest.append('<li data-country="'+name+'"><span>' + txt + '</span></li>');

              $('.sub-tab').css('opacity', '0.2');
              $suggest.addClass('open');
            }

          }

          $('.suggest li').off('click').on('click', function(){

            var data = $(this).data('country');
            console.log($(this).parent().prev().prev());
            $(this).parent().parent().parent().find('.searchBar').val(data.toLowerCase());

            $('.sub-tab').css('opacity', '1');
            $('.suggest').empty();
            $('.suggest').removeClass('open');

            $('.close-suggest').css("display","none");

          });

        } else {
          $suggest.append('<li>' + GLOBALS.texts.search.noresult + '</li>')
        }
      },
      error: function () {
        $suggest.empty();
        $suggest.append('<li>' + GLOBALS.texts.search.noresult + '</li>')
      }
    });


  });


  $('.close-suggest').on('click', function(e){

     $('.sub-tab').css('opacity', '1');
     $('.suggest').empty();
     $('.suggest').removeClass('open');

    $('.close-suggest').css("display","none");

  });
}

var owFixImg = function(){

  if($('body').hasClass('ie')){
    $.each($('.contain-img.landscape'), function(i,e){
      var imgSrc = $(e).find('img').attr('src');

      $(e).css('background-image','url('+imgSrc+')');
    })
  }
}

var initFilterCheck = function() {
  var $form = $('.block-searh-more form');
  var $label = $form.find('.icon-s');

  $label.removeClass('active');

  $.each($label, function(i,e){

    if($(e).find("input[type=checkbox]").is(':checked')){

      var element = $(e).find("input[type=checkbox]");
      element.parent().addClass('active');

    }

  });
}

var truncTitleSearch = function() {


  $.each($('.medias .item'), function (i, e) {
    var title = $(e).find('.title-media');
    var titleCat = $(e).find('.title-type-media');

    if (!title.hasClass('init')) {
      var text = $(e).find('.title-media').text();
      title.addClass('init');
      title.attr('data-title', text);
    } else {
      var text = title.attr('data-title');
    }

    if (!titleCat.hasClass('init')) {
      var text2 = $(e).find('.title-type-media').text();
      titleCat.addClass('init');
      titleCat.attr('data-title', text2);
    } else {
      var text2 = titleCat.attr('data-title');
    }

    title.html(text.trunc(40, true));
    titleCat.html(text2.trunc(25, true));
  });

  $(window).resize(function () {
    truncTitleSearch();
  });

  var title = $('.info strong a').text();
}


