function initPopinMail(cls){
  // check that fields are not empty
  $(cls+' input[type="text"]', cls+' textarea').on('input', function() {
    var input = $(this);
    var is_name = input.val();

    if(typeof $(this).attr('required') != undefined && $(this).attr('required') && is_name.length > 0) {
      input.removeClass("invalid").addClass("valid");
      $('.errors .' + input.attr('name')).remove();
    } else {
      input.removeClass("valid").addClass("invalid");
      $('.errors .' + input.attr('name')).remove();
      $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + '</li>');
    }

    if($('.invalid').length) {
      $('.errors').addClass('show');
    } else {
      $('.errors').removeClass('show');
    }
  });

  $('body').on('click', '.selectOptions span', function() {
    var i = parseInt($(this).index()) + 1;
    $('select option').eq(i).prop('selected', 'selected');
    $('.select').removeClass('invalid');
  });

  // check valid email address
  $(cls+' input[type="email"]').on('input', function() {
    var input=$(this);
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    var is_email=re.test(input.val());
    var is_email_name=input.val();

    if(!is_email_name) {
      input.removeClass("valid").addClass("invalid");
      $('.errors .' + input.attr('name')).remove();
      $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.empty + '</li>');

    } else if(is_email) {
      input.removeClass("invalid").addClass("valid");
      $('.errors .' + input.attr('name')).remove();

    } else{
      input.removeClass("valid").addClass("invalid");
      $('.errors .' + input.attr('name')).remove();
      $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.error +'</li>');
      // TODO remove string //
    }

    if($('.invalid').length) {
      $('.errors').addClass('show');
    } else {
      $('.errors').removeClass('show');
    }
  });

  // check valid email address
  $('#contact_email').on('input', function() {
    var input=$(this);
    var re = /^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},?)+$/i;
    var is_email=re.test(input.val());
    var is_email_name=input.val();

    if(!is_email_name) {
      input.removeClass("valid").addClass("invalid");
      $('.errors .' + input.attr('name')).remove();
      $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.empty + '</li>');

    } else if(is_email) {
      input.removeClass("invalid").addClass("valid");
      $('.errors .' + input.attr('name')).remove();

    } else{
      input.removeClass("valid").addClass("invalid");
      $('.errors .' + input.attr('name')).remove();
      $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.error +'</li>');
      // TODO remove string //
    }

    if($('.invalid').length) {
      $('.errors').addClass('show');
    } else {
      $('.errors').removeClass('show');
    }
  });

  // on submit : check if there are errors in the form
  $(cls+' form').on('submit', function(e) {
    e.preventDefault();
    var $that = $(this);
    var empty = false;

    if($('select').val() == 'default') {
      $('.select').addClass('invalid');
    } else {
      $('.select').removeClass('invalid');
    }

    $(cls+' input[type="text"], '+cls+' input[type="email"], '+cls+' textarea').each(function() {
      if(typeof $(this).attr('required') != undefined && $(this).attr('required') == true && $(this).val() == '') {
        empty = true;
      }
    });

    if(empty) {
      $(cls+' input[type="email"], '+cls+' input[type="text"], '+cls+' textarea').trigger('input');
    }

    if($('.invalid').length || empty) {
      return false;
    } else {
      // TODO envoie du mail //
      var u = $(cls).hasClass('media') ? GLOBALS.urls.shareEmailMediaUrl : GLOBALS.urls.shareEmailUrl;
      $("#errorMsg").html("");

      $.ajax({
        type     : "POST",
        dataType : "json",
        cache    : false,
        url      : u,
        data     : $(cls).find('form#form').serialize(),
        success: function (data) {
          if (data.success == false) {
            $(cls).find('#errorMsg').append('<div>' + GLOBALS.texts.popin.formError + '</div>');
          }
          else {
            // TODO envoie du mail //
            $(cls).find('#form').remove();
            $(cls).find('.info-popin').remove();
            $(cls).find('#msg').append('<div class="valid">' + GLOBALS.texts.popin.valid + '</div>');
            $(cls).css('height', '31%');
            return false;
          }
        }
      });
    }
  });
}

$(document).ready(function() {
  if($('.popin-mail:not(.media)').length) {
    initPopinMail('.popin-mail:not(.media)');

    $('.button.email.self').on('click touchstart', function(e) {
      e.preventDefault();

      //var message = $('.tetiere-movie h2').html()+" - "+$('.title-original').next().find('a').html()+"\r\r";
      //message += $('.synopsis p').html().replace(/<br>/g,"\r")+"\r\r";
      //message += location.href;
      //$('#contact_message').val(message);

      $('.popin-mail:not(.media)').addClass('visible-popin');
      $("#main").addClass('overlay-popin');
      
      $(document).on('click touchstart', function (e) {
        var $element= $(e.target);
        if(!$element.hasClass('visible-popin')) {
          var $isPopin = $element.closest('.visible-popin');
          var isButton = $element.hasClass('button');

          if(!$isPopin.length && !isButton) {
            $('.popin-mail:not(.media)').removeClass('visible-popin');
            $("#main").removeClass('overlay-popin');
            $('footer').removeClass('overlay');

            $(document).off('click touchstart');
          }
        }
      });
    });
  } 
  if($('.popin-mail.media').length) {console.log('here');
    initPopinMail('.popin-mail.media');
  }

  linkPopinInit();
});

//LINK POPIN//
function linkPopinInit(link, cls) {
  var link = link || document.location.href;
  var cls  = cls || '.link.self';

  if($('.share').length || $('.square').length ) {
    new Clipboard(cls);

    $(cls).attr('data-clipboard-text',link);

    $(cls).on('click touchstart',function(e){
      var that = $(this);
      e.preventDefault();

      if($('.single-channel').length) {
        $('.button.email').css('border-right','1px solid #2C2C2C');
      }

      if($('.all-audios, .all-videos').length) {
        $('.button.email').css('border-right','1px solid #dfdfdf');
      }

      if(!$('#share-box').length) {
        if(that.closest('.share').length) {
          that.closest('.share').append('<div id="share-box"><div class="bubble"><a href="#">'+ GLOBALS.texts.popin.copy +'</a></div></div>');
        } else {
          that.closest('.square').append('<div id="share-box"><div class="bubble"><a href="#">'+ GLOBALS.texts.popin.copy +'</a></div></div>');
        }

        $('#share-box').animate({'opacity':'1'},400,function() {
          $('#share-box').addClass('show');
          setTimeout(function() {
            $('#share-box .bubble').html('<a href="#">'+that.attr('data-clipboard-text')+'</a>');
          }, 1000);
        });
      } else if($('#share-box').hasClass('show')) {
        $('#share-box').removeClass('show');
        $('#share-box').remove();
      }

      setTimeout(function() {
        $('#share-box').animate({'opacity':0},200,function() {
          $('#share-box').removeClass('show');
          $('#share-box').remove();
        });
      }, 3000);
    });
  }
}

function updatePopinMedia(data) {
  data['url'] = data['url'] || document.location.href;

  if($('.popin-mail.media').length) {
    $('.popin-mail.media').find('.contain-popin .theme-article').text(data['category']);
    $('.popin-mail.media').find('.contain-popin .date-article').text(data['date']);
    $('.popin-mail.media').find('.contain-popin .title-article').text(data['title']);
    $('.popin-mail.media').find('form #contact_section').val(data['category']);
    $('.popin-mail.media').find('form #contact_detail').val(data['date']);
    $('.popin-mail.media').find('form #contact_title').val(data['title']);
    $('.popin-mail.media').find('form #contact_url').val(data['url']);
  }
}

function launchPopinMedia(data, player) {
  if(!$.isEmptyObject(data)) {
    updatePopinMedia(data);
  }

  switch(data['type']) {
    case 'audio' :
      AudioFullScreen(false, player);
      break;
    case 'photo' :
      // $('.chocolat-close').trigger('click');
      break;
    case 'video' :
      player.removeFullscreen();
      break;
  }

  $('.popin-mail.media').addClass('visible-popin');
  $("#main").addClass('overlay-popin');
  
  $(document).on('click touchstart', function (e) {
    var $element= $(e.target);
    if(!$element.hasClass('visible-popin')) {
      var $isPopin = $element.closest('.visible-popin');
      var isButton = $element.hasClass('button');

      if(!$isPopin.length && !isButton) {
        $('.popin-mail.media').removeClass('visible-popin');
        $("#main").removeClass('overlay-popin');
        $('footer').removeClass('overlay');

        $(document).off('click touchstart');
      }
    }
  });
}