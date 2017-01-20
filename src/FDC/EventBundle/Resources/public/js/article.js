/*
 * Namespace
 */
var ow = ow || {};

(function(){
	'use strict';

	ow.contentSlider = function(){
		var $frame  = $('.Article-slider');
		var $slides = $('.Article-slider-item');
		var $wrap   = $('.Article-slider-wrapper');

		var Slider = new Sly($wrap, {
			horizontal: 1,
			itemNav: 'basic',
			slidee: $frame,
			smart: 1,
			activateOn: 'click',
			mouseDragging: 1,
			touchDragging: 1,
			releaseSwing: 1,
			scrollBy: 0,
			activatePageOn: 'click',
			speed: 300,
			elasticBounds: 1,
			dragHandle: 1,
			dynamicHandle: 1,
			clickBar: 1,
			prev: $wrap.find('.Article-slider-prev'),
			next: $wrap.find('.Article-slider-next')
		});

		Slider.on('moveStart moveEnd', function (a,b,c) {
			var increment = Slider.rel.firstItem + 1;
			$('.Article-slider-count strong').html(increment);
		});

		Slider.init();
	}

	ow.relatedSlider = function(){
		var $frame  = $('.Article-related-slider');
		var $slides = $('.Article-related-slider-item');
		var $wrap   = $('.Article-related-slider-wrapper');

		var Slider = new Sly($wrap, {
			horizontal: 1,
			itemNav: 'basic',
			slidee: $frame,
			smart: 1,
			activateOn: 'click',
			mouseDragging: 1,
			touchDragging: 1,
			releaseSwing: 1,
			scrollBy: 0,
			activatePageOn: 'click',
			speed: 300,
			elasticBounds: 1,
			dragHandle: 1,
			dynamicHandle: 1,
			clickBar: 1,
			prev: $wrap.find('.Article-slider-prev'),
			next: $wrap.find('.Article-slider-next')
		});

		Slider.on('moveStart moveEnd', function (a,b,c) {
			var increment = Slider.rel.firstItem + 1;
			$('.Article-slider-count strong').html(increment);
		});

		Slider.init();
	}

	ow.audioPlayer = function(){
		$('.Article-audioPlayer').each(function(){
			var player = $(this);
			jwplayer(player.get(0)).setup({
				"file": player.data('file-mp3'),
				"height": 90,
				"title": player.data('title'),
				"description": player.data('date'),
				"width": '100%',
				'skin': {
					'name': 'fdc'
				}
			});
		});
		

	}

	ow.playVideo = function(event){
		var $this = $(event.target).is('a') ? $(event.target) : $(event.target).closest('a');
		var video = $this.parent().find('video').get(0);
		video.setAttribute("controls","controls");
		video.play();
		$this.remove();
	}

	ow.domEvents = function(){
		$('.Article-video-play').on('click',function(e){ow.playVideo(e)});
	}

	$(document).ready(function(){
		ow.contentSlider();
		ow.relatedSlider();
		ow.audioPlayer();
		ow.domEvents();
	});
})();