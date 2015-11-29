<!DOCTYPE html>
<html>

  <head>
    <!-- //// META \\\\ -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">    

    <!-- //// TITLE \\\\ -->
    <title>Festival de Cannes 2016 - HTML</title>

    <!-- //// CSS \\\\ -->
    <link href='js/bower_components/chocolat/src/css/chocolat.css' rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="http://fast.fonts.net/cssapi/47cc6bed-5912-4140-bc5c-4caa2425b61d.css"/>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic' rel='stylesheet' type='text/css'>
    <link href='css/styles.css' rel="stylesheet">
  <style type="text/css">
        
  </style>
  </head>

  <body>
    <?php include('header.html'); ?>

    <div id="main">
      <div id="video-container" class="state-init video-player video">
        <div id="video-player">
        </div>
        <div class="infos-bar">
        </div>
        <div class="video-overlay"></div>
        <div class="infos-bar">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Bande-annonce</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>The Lobster</p>
              </div>
            </div>
          </div>
        </div>
        <div class="control-bar">
          <div class="playstate">
            <button class="play-btn play"></button>
          </div>
          <div class="time">
            <p class="time-info">
              <span class="current-time">0:00</span> / <span class="duration-time">0:00</span>
            </p>
          </div>
          <div class="progress">
            <div class="progress-bar">
              <div class="buffer-bar"></div>
              <div class="current-bar"></div>
            </div>
          </div>
          <div class="sound">
            <button class="sound-btn"></button>
            <div class="sound-bar">
              <div class="sound-seek"></div>
              </div>
            </div>
          <div class="fs">
            <button class="fs-icon"></button>
          </div>
        </div>
      </div>
    </div>
    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
