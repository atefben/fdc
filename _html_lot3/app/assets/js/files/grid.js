var owInitGrid = function (id) {
    if (id == 'isotope-01') {
        var $grid = $('.isotope-01:not(.add-ajax-request):not(.noComputing)');
        $grid.imagesLoaded(function () {
            $grid.isotope({
                itemSelector: '.item',
                layoutMode: 'packery',
                packery: {
                    columnWidth: '.grid-sizer',
                    gutter: 0
                }
            });

            $grid.on( 'arrangeComplete', function( event, filteredItems ) {
                $('.item-inner').css({
                    'width':'100.5%',
                    'height':'100.5%'
                });

                $('.isotope-01 .item.video').on('click',function(){
                    $('.isotope-01 .item.video').removeClass('activeVideo');
                    $(this).addClass('activeVideo');
                });
            });


        });

        var $items = $('.item');

        //ratio calculation on media library
        if($('.media-library').length){
            //ratios token from eventbundle
            var landscapeRatio = 0.7921; //height / width
            var portraitRatio = 1.5842; //height / width
            $items.each(function(){
                var $this = $(this);
                var itemRatio = $this.outerHeight() / $this.outerWidth();

                if($this.outerWidth() > $this.outerHeight()){
                    //landscape
                    $this.addClass('landscape');
                    //compute height based on width & ratio
                    var newHeight = $this.outerWidth() * landscapeRatio;
                    if(itemRatio < landscapeRatio){
                        //less large than desired output, scale width
                        //$this.find('.image, .image-wrapper, img').css('width','100%');
                    }else{
                        //more large than desired output, scale height
                        //$this.find('img').css('height','100%');
                    }
                }else{
                    //portrait
                    $this.addClass('portrait');
                    //compute height based on width & ratio
                    var newHeight = $this.outerWidth() * portraitRatio;
                    if(itemRatio < portraitRatio){
                        //less large than desired output, scale width
                    }else{
                        //more large than desired output, scale width too (?)
                    }
                }
            });
        }
        var clickAllow = true;
        var $gridDom = $('.add-ajax-request');
        var $gridMore = $gridDom.imagesLoaded(function(){
            $gridMore.isotope({
                itemSelector: '.item',
                layoutMode: 'masonry',
                packery: {
                    columnWidth: '.grid-sizer'
                },
                getSortData: {
                    number: '[data-sort]'
                },
                // sort by color then number
                sortBy: ['number']
            });
            $gridMore.isotope();

            if($gridDom.parent().find('.ajax-request').length){
                if(!$gridDom.parent().find('.ajax-request').is(':visible')){
                    //hidden button, infinite load
                    var footerHeight = $('footer').outerHeight();
                    $(window).scroll(function(){
                        if(($(window).height() + $(document).scrollTop()) > ($(document).height() - footerHeight)){
                            if(clickAllow){
                                clickAllow = false;
                                $('.ajax-request').trigger('click');
                            }
                        }
                    });

                    var ticker = window.setInterval(function(){
                        clickAllow = true;
                    },2000);
                }
            }
        });

        var number = 0;

        if(!$('.home').length){

            $('.read-more.ajax-request').off('click').on('click', function(e){
                var $this = $(this);
                var url = $(this).attr('href');

                var postData = {};
                if(typeof $('input[name="search"]').val() !== 'undefined'){
                    postData.search = $('input[name="search"]').val();
                }
                if(typeof $('input[name="photo"]').val() !== 'undefined'){
                    postData.photo = $('input[name="photo"]').val();
                }
                if(typeof $('input[name="video"]').val() !== 'undefined'){
                    postData.video = $('input[name="video"]').val();
                }
                if(typeof $('input[name="audio"]').val() !== 'undefined'){
                    postData.audio = $('input[name="audio"]').val();
                }
                if(typeof $('input[name="year-start"]').val() !== 'undefined'){
                    postData['year-start'] = $('input[name="year-start"]').val();
                }
                if(typeof $('input[name="year-end"]').val() !== 'undefined'){
                    postData['year-end'] = $('input[name="year-end"]').val();
                }
                if(typeof $('input[name="pg"]').val() !== 'undefined'){
                    postData.pg = parseInt($('input[name="pg"]').val())+1;
                }

                if($('#date.filter .select .active').length){
                    postData.date = $('#date.filter .select .active').data('filter');
                }
                if($('#theme.filter .select .active').length){
                    postData.theme = $('#theme.filter .select .active').data('filter');
                }
                if($('#format.filter .select .active').length){
                    postData.format = $('#format.filter .select .active').data('filter');
                }
                console.log('data sent to GET on ajax button click',postData);

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: postData,
                    success: function(data) {
                        $data = $(data);
                        
                        var moreBtn = $data.find('.ajax-request').attr('href');
                        var articles = $data.find('article');
                        var scroll = $(document).scrollTop();
                        var rawHtml = '';
                        articles.each(function(){
                            rawHtml += $(this).get(0).outerHTML;
                        });

                        //$gridMore.append(rawHtml);
                        $gridMore.isotope('insert',articles);
                        //$gridMore.isotope('destroy');
                        if(typeof moreBtn !== 'undefined'){
                            
                            $this.attr('href',moreBtn);
                        }else{
                            //visible buton = no infinite load & undefined button, let's remove it
                            $this.remove();
                        }

                        //manage filters
                        if($data.filter('.compute-filters').length){
                            $data.filter('.compute-filters').each(function(){
                                var slug = $(this).attr('class').replace('compute-filters ','');

                                $(this).find('span').each(function(){
                                    //test if filter exists
                                    if(!$('#'+slug+' .select span[data-filter="'+$(this).data('filter')+'"]').length){
                                        $('#'+slug+' .select .icon-arrow-down').before($(this));
                                    }
                                });
                            });
                        }

                        //reset big imgs
                        $gridMore.on('layoutComplete',function(){
                            console.log('append complete');
                            $('.grid-01').find('double').removeClass('double').removeClass('w2');
                            owsetGridBigImg($gridMore, $('.grid-01'), false);
                        });

                        $gridMore.on('arrangeComplete',function(){
                            console.log('sort complete');
                            $('.grid-01').find('double').removeClass('double').removeClass('w2');
                            owsetGridBigImg($gridMore, $('.grid-01'), false);
                        });

                        $('.card.item').each(function(){
                            var $this = $(this);
                            var title = $this.find('.info strong a');
                            var cat = $this.find('.info .category');
                            var titleText;
                            var catText;

                            $clamp(title.get(0), {clamp: 1});
                            $clamp(cat.get(0), {clamp: 1});
                        });

                        /*$('html,body').scrollTop(scroll);
                        $gridMore.imagesLoaded(function(){

                            //memorize scrolltop
                            $('html,body').scrollTop(scroll);
                            
                            //rebuild grid depending on active filters
                            var filters = '.all';
                            if($('.filters .filter').length){
                                filters = '';
                                $('.filters .filter').each(function(){
                                    var thisFilter = $(this).find('.select span.active').data('filter');
                                    if(thisFilter !== 'all'){
                                        var filterSelector = '.'+$(this).find('.select span.active').data('filter');
                                        filters += filterSelector;
                                    }
                                });
                            }

                            console.log('applying filters to rebuilt grid',filters);
                            owsetGridBigImg($gridMore, $('.grid-01'), false);
                            $gridMore.isotope({
                                itemSelector: '.item',
                                layoutMode: 'masonry',
                                filter: filters,
                                packery: {
                                    columnWidth: '.grid-sizer'
                                },
                                getSortData: {
                                    number: '[data-sort]'
                                },
                                // sort by color then number
                                sortBy: ['number']
                            });

                            $('html,body').scrollTop(scroll);

                            $('.card.item').each(function(){
                                var $this = $(this);
                                var title = $this.find('.info strong a');
                                var cat = $this.find('.info .category');
                                var titleText;
                                var catText;

                                $clamp(title.get(0), {clamp: 1});
                                $clamp(cat.get(0), {clamp: 1});
                            });

                            //reable available filters

                        });*/

                        $('input[name="pg"]').val(parseInt($('input[name="pg"]').val())+1);
                        
                        //if no button ajax-request, then remove current button
                        owinitSlideShow($gridMore);
                        initVideo();
                        initAudio();
                    }
                });

                return false;
            });
        }


        if ($('.jury').length) {

            var resize = function () {
                var w = $('.isotope-01 .contain-img').first().width();
                $('.isotope-01 .contain-img').each(function () {
                    $(this).css('height', (w / 0.75));
                    var $container = $(this), imgUrl = $container.find('img').prop('src');
                    if (imgUrl) {
                        $container.css('backgroundImage', 'url(' + imgUrl + ')').addClass('compat-object-fit');
                        img = $container.find('img');
                        img.css('display', 'none');
                    }
                });
            }

            resize();

            $(window).resize(function () {
                resize();
            });

        }

        if(!$('#home').length > 0) {
            var trunTitle = function() {
                $.each($('.card.item'), function (i, e) {
                    var title = $(e).find('.info strong a');
                    var cat = $(e).find('.info .category');

                    $clamp(title.get(0), {clamp: 1});
                    $clamp(cat.get(0), {clamp: 1});
                });
            }
    
    
            trunTitle();
    
    
            $(window).resize(function () {
                trunTitle();
            });
    
            var title = $('.info strong a').text();
        }


        if($('.item.block-poster').length) {

            function selectionGridComputing(){
                var stop = false;
                var lineClassIndex = 0;
                var lineContentHeights = [];
                var previousItem;

                //get max heights
                $.each($('.item.block-poster'), function (i,e) {
                    var naturalIndex = i+1;
                    var ww = window.innerWidth;
                    var colNumber = 4;
                    if(ww > 1280){
                        colNumber = 5;
                    }

                    if(ww > 1600){
                        colNumber = 6;
                    }

                    if(ww >= 1920){
                        colNumber = 8;
                    }

                    if(i%colNumber == 0){
                        lineClassIndex += 1;
                    }

                    if(typeof lineContentHeights[lineClassIndex] !== 'undefined'){
                        if($(this).find('.contain-txts').removeAttr('style').outerHeight() > lineContentHeights[lineClassIndex]){
                            lineContentHeights[lineClassIndex] = $(this).find('.contain-txts').outerHeight();
                        }
                    }else{
                        lineContentHeights[lineClassIndex] = $(this).find('.contain-txts').outerHeight();
                    }

                    //ratio class
                    var img = $(this).find('img');
                    var imgClass = 'portrait';
                    if(img.width() > img.height()){
                        var imgClass = 'landscape';
                    }
                    img.addClass(imgClass);
                    $(this).attr('rel',lineClassIndex);
                    previousItem = $(this);
                });
                
                //apply heights
                $.each($('.item.block-poster'), function (i,e) {
                    var height = lineContentHeights[$(this).attr('rel')];
                    $(this).find('.contain-txts').css('height',height);
                });
            }

            selectionGridComputing();
            $(window).on('resize',function(){
                selectionGridComputing();
            });
        }

        return $grid;
    }

    if (id == 'isotope-02') {


        var $grid = $('.isotope-02').imagesLoaded(function () {
            $grid.isotope({
                itemSelector: '.item',
                percentPosition: true,
                sortBy: 'original-order',
                layoutMode: 'packery',
                packery: {
                    gutter: 39
                }
            });
        });


        if($('.who-filter').length) {
            var active = $('.filter .select span.active').data('filter');

            $('.pages:not(.'+active+')').css('display','none');
            $('.pages.'+active).css('display','block');

        }

        return $grid;
    }

    if (id == 'isotope-03') {

        var $grid = $('.isotope-03').imagesLoaded(function () {
            $grid.isotope({
                itemSelector: '.item',
                percentPosition: true,
                sortBy: 'original-order',
                layoutMode: 'packery',
                packery: {
                    columnWidth: '.grid-sizer'
                }
            });
        });



        var trunTitle = function() {
            $.each($('.card.item'), function (i, e) {
                var title = $(e).find('.info strong a');
                var cat = $(e).find('.info .category');

                $clamp(title.get(0), {clamp: 1});
                $clamp(cat.get(0), {clamp: 1});
            });
        }


        trunTitle();


        $(window).resize(function () {
            trunTitle();
        });

        var title = $('.info strong a').text();

        return $grid;
    }

    if (id == 'filter') {

        if ($('.isotope-01').length) {

            var filterDate = '',
                filterTheme = '',
                filterFormat = '';

            if ($('.filters #date').length > 0) {
                filterDate = $('.filters #date .select span.active').data('filter');
                filterDate = "." + filterDate;
            }

            if ($('.filters #theme').length > 0) {
                filterTheme = $('.filters #theme .select span.active').data('filter');
                filterTheme = "." + filterTheme;
            }

            if ($('.filters #format').length > 0) {
                filterFormat = $('.filters #format .select span.active').data('filter');
                filterFormat = "." + filterFormat;
            }

            var filters = filterDate + filterTheme + filterFormat;
            
            var $grid = $('.isotope-01').isotope({filter: filters});
        }

        if ($('.isotope-02').length) {

            var filterStaff = $('.filters #staff .select span.active').data('filter');
            filterStaff = "." + filterStaff;


            var $grid = $('.isotope-02').isotope({filter: filterStaff});
        }
    }
};


var owsetGridBigImg = function (grid, dom, init) {
    var $img = $(dom).find('.card:visible img'),
        pourcentage = 0.30,
        nbImgAAgrandir = $img.length * pourcentage,
        i = 0,
        nbRamdom = [],
        x = 1,
        j = 0,
        max = 0,
        min = 0,
        nbImage = $img.length;

    dom.find('article.card').removeClass('double w2');

    //console.log($(dom).find('.card:visible img'));
    //console.log($(dom).find('.card img'));
    if (window.matchMedia("(max-width: 1279px)").matches) {

        while (i < $img.length) {
            if (j < 15) {
                if (j == 1 || j == 5) {
                    $($img[i]).closest('article.card').addClass('double w2');
                }
                j++;
            }
            if (j == 14) {
                j = 0;
            }
            i++;
        }


    } else if (window.matchMedia("(max-width: 1599px)").matches) {

        while (i < $img.length) {
            if (j < 10) {
                if (j == 1 || j == 6) {
                    $($img[i]).closest('article.card').addClass('double w2');
                }
                j++;
            }
            if (j == 9) {
                j = 0;
            }
            i++;
        }


    } else if (window.matchMedia("(max-width: 1919px)").matches) {
        while (i < $img.length) {
            if (j < 30) {
                if (j == 1 || j == 3 || j == 12 || j == 17 || j == 25) {
                    $($img[i]).closest('article.card').addClass('double w2');
                }
                j++;
            }
            if (j == 29) {
                j = 0;
            }
            i++;
        }


    } else if (window.matchMedia("(min-width: 1920px)").matches) {
        while (i < $img.length) {
            if (j < 15) {
                if (j == 1 || j == 5 || j == 14) {
                    $($img[i]).closest('article.card').addClass('double w2');
                }
                j++;
            }
            if (j == 14) {
                j = 0;
            }
            i++;
        }
    }

};

var owInitAleaGrid = function (grid, dom, init) {
    var $img = $(dom).find('.item:not(.portrait) img'),
        pourcentage = 0.50,
        nbImgAAgrandir = $img.length * pourcentage,
        i = 0,
        nbRamdom = [],
        x = 1,
        max = 0,
        min = 0,
        nbImage = $img.length;

    while (x < nbImgAAgrandir) {
        while (nbImgAAgrandir > nbRamdom.length) {
            max = nbImage * pourcentage * x;
            min = nbImage * pourcentage * (x - 1);
            nbAlea = Math.floor(Math.random() * (max - min) + min);
            nbRamdom[i] = nbAlea;
            $($img[nbRamdom[i]]).closest('article.item').addClass('double w2');
            i++;
            x++;
        }
    }

    $('.item').addClass('visible');

    grid.isotope({
        itemSelector: '.item',
        percentPosition: true,
        sortBy: 'original-order',
        layoutMode: 'packery',
        packery: {
            columnWidth: '.grid-sizer'
        }
    });

    grid.isotope('layout');
};
