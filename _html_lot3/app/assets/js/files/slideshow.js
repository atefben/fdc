/**
 * Created by tatjac on 17/06/2016.
 */
var owinitSlideShow = function (slider) {

    $('.block-diaporama .item').on('mousedown', function(){

        if($(this).parent().hasClass('active center') && !$('.owl-stage').hasClass('owl-grab')){
            openSlideShow(slider);
        }
        
    });

}


var openSlideShow = function(slider) {

    var images = [];
    var w = $(window).width();
    var centerElement = 0;

    slider.find('.item').each(function(index,value){

        if($(value).parent().hasClass('active center')){
            centerElement = index;
            console.log("index"+index);
        }


        src = $(value).find('img').attr("src");
        alt =  $(value).find('img').attr("alt");

        var image = {
            src : src,
            alt : alt
        };

        images.push(image);

    });


    /* Initiliasion du slideshow fullscreen*/
    slider.append('<div class="fullscreen-slider"> </div>');
    var fullscreen = slider.find(".fullscreen-slider");

    var wSlide = w * images.length + 100;
    var wSlide = wSlide + "px";

    fullscreen.css('width', wSlide);

    for(var i=0; i<images.length; i++)  {

        if(i == centerElement){
            fullscreen.append("<img src='"+images[i].src+"' alt='"+images[i].data+"' class='center-item' />");
        }else{
            fullscreen.append("<img src='"+images[i].src+"' alt='"+images[i].data+"'/>");
        }
    }

    var translate = (w + 1) * centerElement;
    translate = - translate + "px";

    console.log(centerElement);
    console.log(translate);

    fullscreen.css('transform','translateX('+translate+')');
    /* les mettre dans une div en dessous qui ne sera pas un slideshow */
    /* afficher le nouveaux slide*/


/*
    slider.addClass('fullscreen-slider');
*/
}