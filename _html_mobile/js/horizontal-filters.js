$(document).ready(function() {

		var filters = $("#horizontal-filters").owlCarousel({
		  nav: false,
		  dots: false,
		  smartSpeed: 500,
		  margin: 0,
		  autoWidth: false,
		  loop: false,
		  items:2,
		  onInitialized: function() {
		    var m = ($(window).width() - $('.container').width()) / 2;
		    $('#horizontal-filters .owl-stage').css({ 'margin-left': m });
		  },
		  onResized: function() {
		    var m = ($(window).width() - $('.container').width()) / 2;
		    $('#horizontal-filters .owl-stage').css({ 'margin-left': m });
		  }
		});
		filters.owlCarousel();
});