var waves = [];
var inter = null;
$.initAudioPlayers = function(autoplay) {

    var duration = null;

  $('.audio-player').each(function(i) {
    $(this).addClass('loading').find('.wave-container').attr('id', 'wave-' + i);
    var wave = Object.create(WaveSurfer);

    // initialize wave sound
    wave.init({
      container: document.querySelector('#' + 'wave-' + i),
      waveColor: 'rgba(90, 90, 90, 0.5)',
      progressColor: '#c8a461',
      cursorWidth: 0,
      height: 50
    });

    // load the url of the sound
    wave.load($(this).data('sound'));

    // once it's ready
    wave.on('ready', function() {
      $(wave.container).parents('.audio-player').removeClass('loading');
      if(autoplay){
        wave.play();
        // update current time
        inter = setInterval(function() {
          var curr = wave.getCurrentTime();

          var minutes = parseInt(Math.floor(curr / 60));
          var seconds = parseInt(curr - minutes * 60);

          if(seconds < 10) {
            seconds = '0' + seconds;
          }
          $('.audio-player').find('.duration .curr').text(minutes + ':' + seconds);
        }, 1000);
      }

    });

    wave.on('finish', function() {
    	$(wave.container).parents('.audio-player').find(".playpause .icon").toggleClass("icon_play");
    	wave.stop();
    });

    waves.push(wave);
    // on click on play/pause
    $(this).find('.playpause').on('click', function(e) {
      e.preventDefault();

    	if ($(this).find(".icon").hasClass('icon_audio')){
    		$(this).find(".icon").removeClass('icon_audio');
    		$(this).find(".icon").addClass('icon_pause');
    	}
    	else{
    		$(this).find(".icon").toggleClass("icon_play");
    	}
    	

      

      if(inter) {
        clearInterval(inter);
      }

      $audioplayer = $(e.currentTarget).parents('.audio-player');

      // get duration
      if(!$audioplayer.hasClass('on')) {
        $audioplayer.addClass('on');

        duration = wave.getDuration();
        var minutes = parseInt(Math.floor(duration / 60));
        var seconds = parseInt(duration - minutes * 60);

        if(seconds < 10) {
          seconds = '0' + seconds;
        }
        $audioplayer.find('.duration .total').text(minutes + ':' + seconds);
      }
      
      // update current time
      inter = setInterval(function() {
        var curr = wave.getCurrentTime();

        var minutes = parseInt(Math.floor(curr / 60));
        var seconds = parseInt(curr - minutes * 60);

        if(seconds < 10) {
          seconds = '0' + seconds;
        }
        $audioplayer.find('.duration .curr').text(minutes + ':' + seconds);
      }, 1000);

      
      if(!$audioplayer.hasClass('pause')) {
        for(var i = 0; i<waves.length; i++) {
          if(waves[i].isPlaying() && waves[i].container.id != wave.container.id) {
            waves[i].pause();
          }
        }
      }
      $('.audio-player').not($audioplayer).removeClass('pause');
      $('.audio-player').not($audioplayer).removeClass('on');
      $('.audio-player').not($audioplayer).find(".playpause .icon").addClass('icon_audio');
      $('.audio-player').not($audioplayer).find(".playpause .icon").removeClass('icon_pause icon_play');

      // set volume and play or pause
      wave.setVolume(0.75);
      wave.playPause();

      $audioplayer.toggleClass('pause');
    });
  });
}
$.stopSound = function(){
  if(waves[0].isPlaying()){
    waves[0].stop();
  }
  
}
$.loadSound = function(url){
  waves[0].load(url);

}
