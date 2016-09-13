/**
 * Created by tatjac on 17/06/2016.
 */
var owinitSlideShow = function (slider, hash) {

    $('.block-diaporama .item').on('mousedown', function () {

        if ($(this).parent().hasClass('active center') && !$('.owl-stage').hasClass('owl-grab')) {
            openSlideShow(slider);
        }

    });


    if (typeof hash != "undefined") {
        setTimeout(function () {
            openSlideShow(slider, hash);
        }, 100);
    }

}


var openSlideShow = function (slider, hash) {

    $('body').addClass('slideshow-open');

    var images = [];
    var w = $(window).width();
    var centerElement = 0;
    var caption = "";


    slider.find('.item').each(function (index, value) {

        if ($(value).parent().hasClass('active center')) {
            centerElement = index;
        }

        var src = $(value).find('img').attr("src");
        var alt = $(value).find('img').attr("alt");
        var title = $(value).find('img').attr("data-title");
        var label = $(value).find('img').attr("data-label");
        var date = $(value).find('img').attr("data-date");
        caption = $(value).find('img').attr('data-credit');
        var id = $(value).find('img').attr('data-id');
        var facebookurl = $(value).find('img').attr('data-facebookurl');
        var twitterurl = $(value).find('img').attr('data-facebookurl');
        var url = $(value).find('img').attr('data-url');

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
            twitterurl: twitterurl
        };

        images.push(image);

    });

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
    }

    var goToSLide = function(id) {
        w = $(window).width();

        centerElement = id;
        translate = -(w + 1) * centerElement;
        fullscreen.addClass('animated fadeOut');

        setTimeout(function () {
            fullscreen.css('transform', 'translateX(' + translate + 'px)');
            fullscreen.removeClass('fadeOut').addClass('animated fadeIn');
        }, 700);

        hash = "#"+images[id].id;

        history.pushState(null, null, hash);
    }

    /* Initiliasion du slideshow fullscreen*/
    $('body').prepend('<div class="c-fullscreen-slider"><div class="fullscreen-slider"> </div></div>');
    var fullscreen = $('body').find(".fullscreen-slider");

    var wSlide = w * images.length + 100;
    var wSlide = wSlide + "px";

    fullscreen.css('width', wSlide);

    if (typeof hash != "undefined") {

        for (var i = 0; i < images.length; i++) {

            if (images[i].id == hash) {
                centerElement = i;
                fullscreen.append("<img src='" + images[i].src + "' alt='" + images[i].data + "' class='center-item' />");
            } else {
                fullscreen.append("<img src='" + images[i].src + "' alt='" + images[i].data + "'/>");
            }
        }

    } else {
        for (var i = 0; i < images.length; i++) {

            if (i == centerElement) {
                fullscreen.append("<img src='" + images[i].src + "' alt='" + images[i].data + "' class='center-item' />");
            } else {
                fullscreen.append("<img src='" + images[i].src + "' alt='" + images[i].data + "'/>");
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

            $('.chocolat-pagination').removeClass('active');
            $('.chocolat-wrapper .thumbnails').removeClass('open');
            $('.chocolat-content').removeClass('thumbsOpen');
            $('.fullscreen-slider img').css('opacity', '1');
        }
    });


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

    $('.chocolat-close').on('click', function(){
       $('.c-fullscreen-slider').addClass('animated fadeOut');

        setTimeout(function(){
            $('.c-fullscreen-slider').remove();
        }, 1000);
    });

    // mouseover img : close thumbs
    $('.fullscreen-slider').on('mouseover', function () {
        $('.chocolat-pagination').removeClass('active');
        $('.chocolat-wrapper .thumbnails').removeClass('open');
        $('.chocolat-content').removeClass('thumbsOpen');
        $('.fullscreen-slider img').css('opacity', '1');
    });
}



