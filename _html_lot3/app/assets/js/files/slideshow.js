/**
 * Created by tatjac on 17/06/2016.
 */
var owinitSlideShow = function (slider, hash) {

    if (typeof hash != "undefined") {
        setTimeout(function () {
            openSlideShow(slider, hash);
        }, 100);
    }else{
        $('.block-diaporama .item').on('mousedown', function () {

            if ($(this).parent().hasClass('active center') && !$('.owl-stage').hasClass('owl-grab')) {
                openSlideShow(slider);
            }

        });


        if($('.slideshow-img').length > 0 ) {
            $('.images').on('click', function (e) {
                e.preventDefault();

                openSlideShow(slider);

                return false;
            });
        }

        if($('.medias').length > 0 ) {
            $('.item.photo').on('click', function (e) {
                e.preventDefault();

                $(this).addClass('photoActive');
                openSlideShow(slider);


                return false;
            });
        }
    }
}


var openSlideShow = function (slider, hash) {

    $('body').addClass('slideshow-open');

    var images = [];
    var w = $(window).width();
    var centerElement = 0;
    var caption = "";

    slider.find('.item, .img').each(function (index, value) {

        if(!$(value).hasClass('video') && !$(value).hasClass('audio')){
            if ($(value).parent().hasClass('active center')) {
                centerElement = index;
            }

            if ($('.img').length > 0 && $(value).hasClass('active')) {
                centerElement = index;
            }

            var src = ($(value).hasClass('photo')) ? $(value).find('.image-wrapper img').attr("src") : $(value).find('img').attr("src");
            var alt = ($(value).hasClass('photo')) ? $(value).find('.image-wrapper img').attr("alt") : $(value).find('img').attr("alt");
            var title = ($(value).hasClass('photo')) ? $(value).find('.info .contain-txt strong a').data('title') : $(value).find('img').attr("data-title");
            var label = ($(value).hasClass('photo')) ? $(value).find('.info .contain-txt a').html() : $(value).find('img').attr("data-label");
            var date = ($(value).hasClass('photo')) ? $(value).find('.info .contain-txt span.date').html() + ' . ' + $(value).find('.info .contain-txt span.hour').html() : $(value).find('img').attr("data-date");
            var caption = $(value).find('img').attr('data-credit');
            var id = $(value).find('img').attr('data-id');
            var facebookurl = $(value).find('img').attr('data-facebookurl');
            var twitterurl = $(value).find('img').attr('data-twitterurl');
            var url = $(value).find('img').attr('data-url');

            var isPortrait = $(value).hasClass('portrait') ? 'portrait' : 'landscape';


            var image = {
                id: id,
                url: url,
                src: src,
                alt: alt,
                title: title,
                label: label,
                date: date,
                caption: caption,
                facebookurl: facebookurl,
                twitterurl: twitterurl,
                isPortrait: isPortrait
            };

            images.push(image);
        }
    });

    if($('.photoActive').length > 0) {
        var pid = $('.photoActive .image-wrapper img').data('id');
        for(var o = 0; o < images.length; o++){
            if(pid == images[o].id){
                var v = o;
                centerElement = v;
            }
        }
    }

    if(typeof hash == "undefined") {
        hash = images[centerElement].id;
        var hashPush = '#'+hash;
        history.pushState(null, null, hashPush);
    }

    $(window).resize(function () {
        w = $(window).width();
        translate = -(w + 1) * centerElement;
        $('.fullscreen-slider').css('transform', 'translateX(' + translate + 'px)');
    });

    var goToNextPrev = function (direction) {
        w = $(window).width();

        var place = centerElement+1;

        if (direction == 0 && place <= images.length) { //go next

            if (place === images.length) {
                centerElement = 0;
                goToSLide(centerElement);
            }else{
                centerElement += 1;
                goToSLide(centerElement);
            }
        }

        if (direction == 1 && place > 0 ) { //go prev

            if (centerElement == 0 ) {
                centerElement = images.length - 1;
                goToSLide(centerElement);
            }else{
                centerElement -= 1;
                goToSLide(centerElement);
            }
        }

        numberDiapo = centerElement + 1;
        var title = $('.c-fullscreen-slider').find('.title-slide');
        var pagination = $('.c-fullscreen-slider').find('.chocolat-pagination');
        var label = $('.c-fullscreen-slider').find('.category');
        var date = $('.c-fullscreen-slider').find('.date');
        var caption = $('.c-fullscreen-slider').find('.credit');
        var facebook = $('.c-fullscreen-slider').find('.rs-slideshow .facebook');
        var twitter = $('.c-fullscreen-slider').find('.rs-slideshow .twitter');
        var link = $('.c-fullscreen-slider').find('.rs-slideshow .link');

        title.html(images[centerElement].title);
        pagination.html(numberDiapo + '/' + images.length + ' <i class="icon icon-media"></i>');
        label.html(images[centerElement].label);
        date.html(images[centerElement].date);
        caption.html(images[centerElement].caption)

        facebook.attr('href', images[centerElement].facebookurl);
        twitter.attr('href', images[centerElement].twitter);
        link.attr('data-clipboard-text', images[centerElement].url);

        $('.fullscreen-slider img').removeClass('isZoom');
        $('.fullscreen-slider img').css('transform', 'scale(1)');
        $('.zoomCursor .icon').addClass('icon-wen-more').removeClass('icon-wen-minus');

        if($('.popin-mail').length) {
            $('.popin-mail').find('.contain-popin .theme-article').text(images[centerElement].label);
            $('.popin-mail').find('.contain-popin .date-article').text(images[centerElement].date);
            $('.popin-mail').find('.contain-popin .title-article').text(images[centerElement].title);
            $('.popin-mail').find('form #contact_section').val(images[centerElement].label);
            $('.popin-mail').find('form #contact_detail').val(images[centerElement].date);
            $('.popin-mail').find('form #contact_title').val(images[centerElement].title);
            $('.popin-mail').find('form #contact_url').val(images[centerElement].link);
            $('.popin-mail').find('.chap-article').html('');
        }
    }

    var goToSLide = function(id) {
        w = $(window).width();

        centerElement = parseInt(id);
        translate = -(w + 1) * centerElement;
        fullscreen.addClass('animated fadeOut');

        setTimeout(function () {
            fullscreen.css('transform', 'translateX(' + translate + 'px)');
            fullscreen.removeClass('fadeOut').addClass('animated fadeIn');
        }, 700);

        hash = "#"+images[id].id;

        history.pushState(null, null, hash);

        numberDiapo = centerElement + 1;
        var title = $('.c-fullscreen-slider').find('.title-slide');
        var pagination = $('.c-fullscreen-slider').find('.chocolat-pagination');
        var label = $('.c-fullscreen-slider').find('.category');
        var date = $('.c-fullscreen-slider').find('.date');
        var caption = $('.c-fullscreen-slider').find('.credit');
        var facebook = $('.c-fullscreen-slider').find('.rs-slideshow .facebook');
        var twitter = $('.c-fullscreen-slider').find('.rs-slideshow .twitter');
        var link = $('.c-fullscreen-slider').find('.rs-slideshow .link');

        title.html(images[centerElement].title);
        pagination.html(numberDiapo + '/' + images.length + ' <i class="icon icon-media"></i>');
        label.html(images[centerElement].label);
        date.html(images[centerElement].date);
        caption.html(images[centerElement].caption)

        facebook.attr('href', images[centerElement].facebookurl);
        twitter.attr('href', images[centerElement].twitter);
        link.attr('data-clipboard-text', images[centerElement].url);

        if($('.popin-mail').length) {
            $('.popin-mail').find('.contain-popin .theme-article').text(images[centerElement].label);
            $('.popin-mail').find('.contain-popin .date-article').text(images[centerElement].date);
            $('.popin-mail').find('.contain-popin .title-article').text(images[centerElement].title);
            $('.popin-mail').find('form #contact_section').val(images[centerElement].label);
            $('.popin-mail').find('form #contact_detail').val(images[centerElement].date);
            $('.popin-mail').find('form #contact_title').val(images[centerElement].title);
            $('.popin-mail').find('form #contact_url').val(images[centerElement].link);
            $('.popin-mail').find('.chap-article').html('');
        }

    }

    /* Initiliasion du slideshow fullscreen*/
    $('body').prepend('<div class="c-fullscreen-slider"><div class="fullscreen-slider"> </div></div>');
    var fullscreen = $('body').find(".fullscreen-slider");

    var wSlide = w * images.length + 100;
    var wSlide = wSlide + "px";

    fullscreen.css('width', wSlide);

    console.log(centerElement);

    if (typeof hash != "undefined") {

        for (var i = 0; i < images.length; i++) {

            if (images[i].id == hash) {
                centerElement = i;
                fullscreen.append("<div class='"+images[i].isPortrait+"'><img src='" + images[i].src + "' alt='" + images[i].data + "' class='center-item' /></div>");
            } else {
                fullscreen.append("<div class='"+images[i].isPortrait+"'><img src='" + images[i].src + "' alt='" + images[i].data + "'/></div>");
            }
        }

    } else {
        for (var i = 0; i < images.length; i++) {

            if (i == centerElement) {
                fullscreen.append("<div class='"+images[i].isPortrait+"'><img src='" + images[i].src + "' alt='" + images[i].data + "' class='center-item'  /></div>");
            } else {
                fullscreen.append("<div class='"+images[i].isPortrait+"'><img src='" + images[i].src + "' alt='" + images[i].data + "' /></div>");
            }
        }
    }

    var translate = (w + 1) * centerElement;
    translate = -translate + "px";


    numberDiapo = centerElement + 1;

    fullscreen.css('transform', 'translateX(' + translate + ')');

    $('.c-fullscreen-slider').addClass('chocolat-wrapper');

    $('.c-fullscreen-slider').append('<div class="chocolat-top"><i class="icon icon-close chocolat-close"></i></div>');

    $('.c-fullscreen-slider').append('<div class="c-chocolat-bottom">' +
        '<div class="chocolat-bottom">' +
        '<span class="chocolat-fullscreen"></span>' +
        '<span class="chocolat-description"><span class="category">' + images[centerElement].label + '</span><span class="date">' + images[centerElement].date + '</span><h2 class="title-slide">' + images[centerElement].title + '</h2></span>' +
        '<span class="chocolat-pagination"> ' + numberDiapo + '/' + images.length + ' <i class="icon icon-media"></i></span>' +
        '<span class="chocolat-set-title"></span>' +
        '<div class="thumbnails owl-carousel owl-theme owl-loaded">' +
        '</div>' +
        '<div class="credit">' + images[centerElement].caption + '</div>' +
        '<a href="" class="share"><i class="icon icon-share"></i></a>' +
            '<div class="buttons square img-slideshow-share rs-slideshow">' +
            '<div class="texts-clipboard"></div>' +
            '<a href="'+images[centerElement].facebookurl+'" rel="nofollow" class="button facebook ajax">' +
            '<i class="icon icon-facebook"></i></a>' +
            '<a href="'+images[centerElement].twitterurl+'" class="button twitter">' +
            '<i class="icon icon-twitter"></i></a>' +
            '<a href="#" rel="nofollow" class="link self button" data-clipboard-text="'+images[centerElement].url+'"><i class="icon icon-link"></i></a>' +
        '<a href="#" class="button popin-mail-open"><i class="icon icon-letter"></i></a></div>' +
        '<div class="chocolat-left active"><i class="icon icon-arrow-left"></i></div>' +
        '<div class="chocolat-right active"><i class="icon icon-arrow-right"></i></div>' +
        '</div>' +
        '</div>');

    $('.c-fullscreen-slider').append("<div class='zoomCursor'><i class='icon icon-wen-more'></i></div>")

    initRs();

    var thumbnails = $('.c-fullscreen-slider').find('.thumbnails');

    for (var i = 0; i < images.length; i++) {

        if(i == centerElement) {
            thumbnails.append("<div class='thumb active center'>" +
                "<img data-id='"+i+"' src='" + images[i].src + "' alt='" + images[i].data + "'/>" +
                "</div>");
        }else{

        thumbnails.append("<div class='thumb'>" +
            "<img  data-id='"+i+"' src='" + images[i].src + "' alt='" + images[i].data + "'/>" +
            "</div>");
        }
    }


    thumbnailsSlide = $('.chocolat-wrapper .thumbnails').owlCarousel({
        nav: false,
        dots: false,
        smartSpeed: 500,
        margin: 0,
        autoWidth: true,
        URLhashListener: false
    });

    thumbs = thumbnails.find(".thumb");

    $(thumbs).on('click', function () {

        if (!$('.c-fullscreen-slider .owl-stage').hasClass('owl-grab')) {

            $(thumbs).removeClass('active');
            $(this).addClass('active');

            id = $(this).find('img').attr('data-id');

            goToSLide(id);
            thumbnailsSlide.trigger('to.owl.carousel',[id]);

            $('.chocolat-pagination').removeClass('active');
            $('.chocolat-wrapper .thumbnails').removeClass('open');
            $('.chocolat-content').removeClass('thumbsOpen');
            $('.fullscreen-slider img').css('opacity', '1');
        }
    });



    if($('.popin-mail').length) {
        $('.popin-mail').find('.contain-popin .theme-article').text(images[centerElement].label);
        $('.popin-mail').find('.contain-popin .date-article').text(images[centerElement].date);
        $('.popin-mail').find('.contain-popin .title-article').text(images[centerElement].title);
        $('.popin-mail').find('form #contact_section').val(images[centerElement].label);
        $('.popin-mail').find('form #contact_detail').val(images[centerElement].date);
        $('.popin-mail').find('form #contact_title').val(images[centerElement].title);
        $('.popin-mail').find('form #contact_url').val(images[centerElement].link);
        $('.popin-mail').find('.chap-article').html('');
    }
    
    /*
     slider.addClass('fullscreen-slider');
     */

    $('.share').on('click', function(e){
        e.preventDefault();
        $('.rs-slideshow').toggleClass('show');
    });

    $('.chocolat-right').on('click', function () {
        goToNextPrev(0);
    })

    $('.chocolat-left').on('click', function () {
        goToNextPrev(1);
    })

    $('.chocolat-pagination').on('click', function () {
        $('.thumbnails').toggleClass('open');
        $(this).toggleClass('active');

        if ($('.thumbnails').hasClass('open')) {
            $('.fullscreen-slider img').css('transition', '.5s').css('opacity', '.5');
        } else {
            $('.fullscreen-slider img').css('opacity', '1');
        }
    })

    $('.chocolat-top').on('click', function(){
       $('.c-fullscreen-slider').addClass('animated fadeOut');

        setTimeout(function(){
            $('.c-fullscreen-slider').remove();
            $('.photoActive').removeClass('photoActive');
            window.location.hash = "";
        }, 1000);
    });

    // mouseover img : close thumbs
    $('.fullscreen-slider').on('mouseover', function () {
        $('.chocolat-pagination').removeClass('active');
        $('.chocolat-wrapper .thumbnails').removeClass('open');
        $('.chocolat-content').removeClass('thumbsOpen');
        $('.fullscreen-slider img').css('opacity', '1');
    });

    $('.fullscreen-slider img').on('mousemove', function (e){

        $('.zoomCursor').css('display','block');
        $('.zoomCursor').css('z-index','100000');
        $('.zoomCursor').css('left', e.clientX + 10).css('top', e.clientY);

        var img = $(this);

        if(img.hasClass('isZoom')) {

            var pos = $('.chocolat-wrapper').offset();
            var height = $('.chocolat-wrapper').height();
            var width = $('.chocolat-wrapper').width();

            var currentImage = img[0];
            var imgWidth = currentImage.width * 2;
            var imgHeight = currentImage.height * 2;

            var coord = [e.pageX - width/2 - pos.left, e.pageY - height/2 - pos.top];

            var mvtX = 0;
            if (imgWidth > width) {
                mvtX = coord[0] / (width / 2);
                mvtX = ((imgWidth - width + 0)/ 2) * mvtX;
            }

            var mvtY = 0;
            if (imgHeight > height) {
                mvtY = coord[1] / (height / 2);
                mvtY = ((imgHeight - height + 0) / 2) * mvtY;
            }

            img.css('transform','translate3d(' + (-mvtX) + 'px' +',' + (-mvtY) + 'px' + ', 0) scale(2)');
        }
    })

    $('.fullscreen-slider img').on('click', function (e) {

        $(this).toggleClass('isZoom');

        if($(this).hasClass('isZoom')) {
            $(this).css('transform', 'scale(2)');
            $('.zoomCursor .icon').removeClass('icon-wen-more').addClass('icon-wen-minus');
        }else{
            $(this).css('transform', 'scale(1)');
            $('.zoomCursor .icon').addClass('icon-wen-more').removeClass('icon-wen-minus');
        }

    })

    $('.fullscreen-slider img').on('mouseout', function (e){
        $('.zoomCursor').css('display','none');
    })
}



