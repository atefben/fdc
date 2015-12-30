$(document).ready(function() {
  if($('.popin-mail').length){
    $('.button.email').click(function(e){
      e.preventDefault();
        $('.popin-mail').addClass('visible-popin');
        $("#main").addClass('overlay-popin');
    });
    $(document).on('click', function (e) {

      var $element= $(e.target);
      if($element.hasClass('visible-popin')){

      }else{
        var $isPopin = $element.closest('.visible-popin');
        var isButton = $element.hasClass('button');

        if($isPopin.length || isButton){

        }else{
            $('.popin-mail').removeClass('visible-popin');
            $("#main").removeClass('overlay-popin');
            $('footer').removeClass('overlay');

        }
      }
    });


  }

   if($('.popin-mail').length) {
    // check that fields are not empty
    $('.popin-mail input[type="text"], textarea').on('input', function() {
      var input = $(this);
      var is_name = input.val();
      if(is_name){
        input.removeClass("invalid").addClass("valid");
        $('.errors .' + input.attr('name')).remove();
      }
      else{
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
      if(!is_email_name){
        input.removeClass("valid").addClass("invalid");
        $('.errors .' + input.attr('name')).remove();
        $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.empty + '</li>');

      }else if(is_email){
        input.removeClass("invalid").addClass("valid");
        $('.errors .' + input.attr('name')).remove();

      }
      else{
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
        if($(this).val() == '') empty = true;
      });

      if(empty) {
        $('.popin-mail input[type="email"], .popin-mail input[type="text"], textarea').trigger('input');
      }

      if($('.invalid').length || empty){
        return false;
      }else{
        // TODO envoie du mail //
        $('#form').remove();
        $('.info-popin').remove();
        $('.contain-popin').append('<div class="valid">'+GLOBALS.texts.popin.valid+'</div>');
        $('.popin-mail').css('height','31%');
        return false;
      }
    });
  }


});

  // cookie banner

  $('.cookie-accept').click(function () { //on click event
    days = 365; //number of days to keep the cookie
    myDate = new Date();
    myDate.setTime(myDate.getTime()+(days*24*60*60*1000));
    document.cookie = "comply_cookie = comply_yes; expires = " + myDate.toGMTString(); //creates the cookie: name|value|expiry
    $("#cookies-banner").slideUp("slow"); //jquery to slide it up
  });


  //LINK POPIN//

  if($('.share').length){
    new Clipboard('.link');
    var link = document.location.href;
    $('.share .link').attr('data-clipboard-text',link);

    $('.share .link').on('click',function(e){
      e.preventDefault();
      if(!$('#share-box').length){
        $('.share').append('<div id="share-box"><div class="bubble"><a href="#">'+'Copied !'+'</a></div></div>');
        $('#share-box').animate({'opacity':'1'},400,function(){

           $('#share-box').addClass('show');
           setTimeout(function(){
                 $('#share-box .bubble').html('<a href="#">'+link+'</a>');
           }, 1000);
        });
      }else if($('#share-box').hasClass('show')){
        $('#share-box').removeClass('show');
        $('#share-box').remove();
      }

      if($('.single-movie').length){
        setTimeout(function(){
              $('#share-box').animate({'opacity':0},200,function(){
                $('#share-box').removeClass('show');
                $('#share-box').remove();
              });
        }, 3000);

      }

    });
  }
