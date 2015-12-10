<!DOCTYPE html>
<html>

  <head>
    <?php include('head.html'); ?>
    <style type="text/css">

    </style>
  </head>

  <body>
    <?php include('header.html'); ?>

    <div id="main">
      <div id="video-container" class="state-init video-player video">
        <div id="video-player">
        </div>
        <div class="top-bar">
          <a href="#" class="channels"></a>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
              </div>
            </div>
          </div>
          <div class="buttons square">
            <a href="#" class="button facebook"></a>
            <a href="#" class="button twitter"></a>
            <a href="#" class="button link"></a>
            <a href="#" class="button email"></a>
          </div>
        </div>
        <div class="channels-video">
          <div class="slider-channels-video owl-carousel sliderDrag">
            <div class="channel video shadow-bottom">
              <div class="image-wrapper">
                <img src="//img.youtube.com/vi/_eaIurlPB7w/maxresdefault.jpg" alt="" width="293" height="185">
                <!-- <img src="img/slider-channels/01.jpg" alt=""> -->
                <!-- <img src="//dummyimage.com/393x185/fff/000.png" alt=""> -->
              </div>
              <a class="linkVid" href="#"></a>
              <div class="info">
                <div class="picto"></div>
                <div class="info-container">
                  <div class="vCenter">
                    <div class="vCenterKid">
                      <a href="#" class="category">Photocall</a>
                      <span></span>
                      <p>Sils Maria</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="channel video shadow-bottom">
              <div class="image-wrapper">
                <img src="img/slider-channels/02.jpg" alt="" />
              </div>
              <a class="linkVid" href="#"></a>
              <div class="info">
                <div class="picto"></div>
                <div class="info-container">
                  <div class="vCenter">
                    <div class="vCenterKid">
                      <a href="#" class="category">Montée des marches</a>
                      <span></span>
                      <p>Interviews des réalisateurs</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="channel video shadow-bottom">
              <div class="image-wrapper">
                <img src="img/slider-channels/03.jpg" alt="" />
              </div>
              <a class="linkVid" href="#"></a>
              <div class="info">
                <div class="picto"></div>
                <div class="info-container">
                  <div class="vCenter">
                    <div class="vCenterKid">
                      <a href="#" class="category">Conférence de presse</a>
                      <span></span>
                      <p>Sils Maria</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="channel video shadow-bottom">
              <div class="image-wrapper">
                <img src="img/slider-channels/01.jpg" alt="" />
              </div>
              <a class="linkVid" href="#"></a>
              <div class="info">
                <div class="picto"></div>
                <div class="info-container">
                  <div class="vCenter">
                    <div class="vCenterKid">
                      <a href="#" class="category">Photocall</a>
                      <span></span>
                      <p>Sils Maria</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="channel video shadow-bottom">
              <div class="image-wrapper">
                <img src="img/slider-channels/02.jpg" alt="" />
              </div>
              <a class="linkVid" href="#"></a>
              <div class="info">
                <div class="picto"></div>
                <div class="info-container">
                  <div class="vCenter">
                    <div class="vCenterKid">
                      <a href="#" class="category">Montée des marches</a>
                      <span></span>
                      <p>Sils Maria</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
