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
        };
        var clickAllow = true;
        var $gridDom = $('.add-ajax-request');
        if(!$('.home').length){
            owsetGridBigImg(false, $('.grid-01'), false);
        }
        var $gridMore = $gridDom.imagesLoaded(function(){
            $gridMore.isotope({
                itemSelector: '.item',
                layoutMode: 'masonry',
                percentPosition : true,
                packery: {
                    columnWidth: '.grid-sizer'
                },
                getSortData: {
                    number: '[data-sort]'
                },
                // sort by color then number
                sortBy: ['number']
            });

            //hotfix isotope bugs : trigger layout to avoid messy cards
            var layoutInterval = window.setInterval(function(){
                $gridMore.isotope('layout');
            },500);

            //reset big imgs
            $gridMore.on('layoutComplete',function(event,laidOutItems){
                $('.grid-01').find('double').removeClass('double').removeClass('w2');
            });

            $('html').on('click','#filters span',function(){
                //wait layer fadeOut + arrangeComplete isotope animation
                var t = window.setTimeout(function(){
                    var i = window.setInterval(function(){
                        if($gridMore.find('.double.w2:visible').length){
                            $gridMore.isotope('layout');
                            window.clearInterval(i);
                        }
                    },200);
                    window.clearTimeout(t);
                },500);
            });

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
        var ajaxLock = false;
        if(!$('.home').length){

            $('.read-more.ajax-request').off('click').on('click', function(e){
                
                var $this = $(this);
                var url = $(this).attr('href');

                var postData = {};

                if($('#date.filter .select .active').length){
                    postData.date = $('#date.filter .select .active').data('filter');
                }
                if($('#theme.filter .select .active').length){
                    postData.theme = $('#theme.filter .select .active').data('filter');
                }
                if($('#format.filter .select .active').length){
                    postData.format = $('#format.filter .select .active').data('filter');
                }
                if($('#type.filter .select .active').length){
                    postData.type = $('#type.filter .select .active').data('filter');
                }

                console.log('data sent to GET',postData);

                if(!ajaxLock){
                    ajaxLock = true;
                    $.ajax({
                        type: 'GET',
                        url: url,
                        data: postData,
                        success: function(data) {
                            $data = $(data);
                            ajaxLock = false;
                            var moreBtn = $data.find('.ajax-request').attr('href');
                            var articles = $data.find('article');
                            var scroll = $(document).scrollTop();
                            var rawHtml = '';
                            articles.each(function(){
                                rawHtml += $(this).get(0).outerHTML;
                            });

                            $gridMore.isotope('insert',articles);
                            $gridMore.isotope('layout');
                            if(typeof moreBtn !== 'undefined'){
                                
                                $this.attr('href',moreBtn);
                            }else{
                                //$this.remove();
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

                            

                            $('.card.item').each(function(){
                                var $this = $(this);
                                var title = $this.find('.info strong a');
                                var cat = $this.find('.info .category');
                                var titleText;
                                var catText;

                                $clamp(title.get(0), {clamp: 2});
                                //$clamp(cat.get(0), {clamp: 1});
                            });
                            owsetGridBigImg(false, $('.grid-01'), false);
                            $('input[name="pg"]').val(parseInt($('input[name="pg"]').val())+1);
                            
                            //if no button ajax-request, then remove current button
                            owinitSlideShow($gridMore);
                            initVideo();
                            initAudio();
                        }
                    });
                }

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

                    $clamp(title.get(0), {clamp: 2});
                    //$clamp(cat.get(0), {clamp: 1});
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

                $clamp(title.get(0), {clamp: 2});
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
                filterType = '',
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

            if ($('.filters #type').length > 0) {
                filterType = $('.filters #type .select span.active').data('filter');
                filterType = "." + filterType;
            }

            var filters = filterDate + filterTheme + filterFormat + filterType;

            //fix infos & communiques : add empty grid + ajax call on filter change
            if($('.articles-list').length){
                var ajaxUrl = $('#stamp-ajax-filter-url').text();
                var ajaxData = {};
                $('.articles-list .filters .filter').each(function(){
                    var filterId = $(this).attr('id');
                    if(typeof filterId !== 'undefined'){
                        ajaxData[filterId] = $(this).find('.select .active').data('filter');
                    }
                });

                $.ajax({
                    type: 'GET',
                    url: ajaxUrl,
                    data: ajaxData,
                    success: function(data) {
                        $data = $(data);

                        var moreBtn = $data.find('.ajax-request').attr('href');
                        var articles = $data.find('article');
                        var scroll = $(document).scrollTop();
                        var rawHtml = '';
                        articles.each(function(){
                            rawHtml += $(this).get(0).outerHTML;
                        });

                        var $gridMore =  $('.isotope-01');
                        //empty isotope
                        var $currentItems = $gridMore.data('isotope').$element.find('article.item');
                        $gridMore
                            .isotope('remove', $currentItems)
                            .isotope('insert',articles);

                            var timeout = window.setTimeout(function(){
                                var bigInterval = window.setInterval(function(){
                                    console.log($('.isotope-01').children('.item').eq(1).hasClass('w2'));
                                    if($('.isotope-01').children('.item').eq(1).hasClass('w2')){
                                        window.clearInterval(bigInterval);
                                    }else{
                                        owsetGridBigImg($gridMore, $('.grid-01'), false);
                                    }
                                },500);
                                $gridMore.isotope('layout');
                            },300);
                        if(typeof moreBtn !== 'undefined'){
                            if($('.isotope-01').parent().find('.read-more').length){
                                $('.isotope-01').parent().find('.read-more').attr('href',moreBtn);
                            }
                        }else{
                            //$this.remove();
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
                        

                        $('.card.item').each(function(){
                            var $this = $(this);
                            var title = $this.find('.info strong a');
                            var cat = $this.find('.info .category');
                            var titleText;
                            var catText;

                            $clamp(title.get(0), {clamp: 2});
                            //$clamp(cat.get(0), {clamp: 1});
                        });

                        $('input[name="pg"]').val(parseInt($('input[name="pg"]').val())+1);
                        
                        //if no button ajax-request, then remove current button
                        owinitSlideShow($gridMore);
                        initVideo();
                        initAudio();
                    }
                });
            }

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
    console.log('bigging');
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
    if (window.matchMedia("(max-width: 1279px)").matches) {
        while (i < $img.length) {
        if (j < 15) {
          if (j == 1 || j == 5 || j == 11) {
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
          if (j == 1 || j == 3) {
            $($img[i]).closest('article.card').addClass('double w2');
          }
          j++;
        }
        if (j == 9) {
          j = 0;
        }
        i++;
      }
    } else if (window.matchMedia("(min-width: 1600px)").matches) {
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
    }

    if(grid){
        grid.isotope('layout');
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
