function initPopinMail(){
  $('.button.email').on('click touchstart', function(e) {
    e.preventDefault();
      $('.popin-mail').addClass('visible-popin');
      $("#main").addClass('overlay-popin');
  });

  $(document).on('click', function (e) {
    var $element= $(e.target);
    if($element.hasClass('visible-popin')) {

    } else {
      var $isPopin = $element.closest('.visible-popin');
      var isButton = $element.hasClass('button');

      if($isPopin.length || isButton) {

      } else {
          $('.popin-mail').removeClass('visible-popin');
          $("#main").removeClass('overlay-popin');
          $('footer').removeClass('overlay');
      }
    }
  });

  // check that fields are not empty
  $('.popin-mail input[type="text"], textarea').on('input', function() {
    var input = $(this);
    var is_name = input.val();

    if(is_name) {
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
  $('.popin-mail input[type="email"]').on('input', function() {
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

  // on submit : check if there are errors in the form
  $('.popin-mail form').on('submit', function() {
    var empty = false;

    if($('select').val() == 'default') {
      $('.select').addClass('invalid');
    } else {
      $('.select').removeClass('invalid');
    }

    $('.popin-mail input[type="text"], .popin-mail input[type="email"], .popin-mail textarea').each(function() {
      if($(this).val() == '') {
        empty = true;
      }
    });

    if(empty) {
      $('.popin-mail input[type="email"], .popin-mail input[type="text"], textarea').trigger('input');
    }

    if($('.invalid').length || empty) {
      return false;
    } else {
      // TODO envoie du mail //
      $('#form').remove();
      $('.info-popin').remove();
      $('.contain-popin').append('<div class="valid">'+GLOBALS.texts.popin.valid+'</div>');
      $('.popin-mail').css('height','31%');

      return false;
    }
  });
}

$(document).ready(function() {
  if($('.popin-mail').length) {
      initPopinMail();
  }

  linkPopinInit();
});

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}

if(getCookie('comply_cookie') == 'comply_yes'){
  $("#cookies-banner").hide();
}

// cookie banner
$('.cookie-accept').click(function () {
  days = 365; //number of days to keep the cookie
  myDate = new Date();
  myDate.setTime(myDate.getTime()+(days*24*60*60*1000));
  document.cookie = "comply_cookie = comply_yes; expires = " + myDate.toGMTString(); //creates the cookie: name|value|expiry
  $("#cookies-banner").slideUp("slow"); //jquery to slide it up
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
