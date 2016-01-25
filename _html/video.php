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
      <div class="video-container state-init video"
        data-facebook="//www.facebook.com/sharer.php?u=html.festival-cannes-2016.com.ohwee.fr&t=le%20titre"
        data-twitter="//www.twitter.com"
        data-link="//www.example.com"
        data-email="//www.gmail.com"
        data-playlist='
        [
          {
            "file":"./files/mov_bbb.mp4",
            "image":"//dummyimage.com/960x540/000/c8a461.png",
            "name":"Sils Maria",
            "category":"Photocall"
          },
          {
            "file":"https://www.youtube.com/watch?v=_eaIurlPB7w?t=1m2s",
            "image":"//img.youtube.com/vi/_eaIurlPB7w/maxresdefault.jpg",
            "name":"Interviews des réalisateurs",
            "category":"Montée des marches"
          },
          {
            "file":"https://www.youtube.com/watch?v=NtDG-Cnj-pw",
            "image":"img/slider-channels/03.jpg",
            "name":"Sils Maria",
            "category":"Conférence de presse"
          },
          {
            "file":"https://www.youtube.com/watch?v=4QmpYuVEwIU",
            "image":"img/slider-channels/01.jpg",
            "name":"Sils Maria",
            "category":"Photocall"
          },
          {
            "file":"https://www.youtube.com/watch?v=YvjBXpmwhmk",
            "image":"img/slider-channels/02.jpg",
            "name":"Sils Maria",
            "category":"Montée des marches"
          }
        ]'
        data-live="false">
        <div id="video-player" class="video-player v_<?php echo time();?>">
        </div>
        <!--<div class="channels-video">
          <div class="slider-channels-video owl-carousel sliderDrag">
            <div class="channel video shadow-bottom">
              <div class="image-wrapper">
                <img src="//dummyimage.com/960x540/000/c8a461.png" alt="" width="293" height="185">
              </div>
              <a class="linkVid" href="#"></a>
              <div class="info">
                <div class="picto"><i class="icon icon_playlist"></i></div>
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
                <img src="//img.youtube.com/vi/_eaIurlPB7w/maxresdefault.jpg" alt="" width="293" height="185">
              </div>
              <a class="linkVid" href="#"></a>
              <div class="info">
                <div class="picto"><i class="icon icon_playlist"></i></div>
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
                <div class="picto"><i class="icon icon_playlist"></i></div>
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
                <div class="picto"><i class="icon icon_playlist"></i></div>
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
                <div class="picto"><i class="icon icon_playlist"></i></div>
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
        </div>-->
        <div class="video-overlay"></div>
        <div class="infos-bar">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Bande-annonce</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>The Lobster</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="video-container state-init video"
        data-facebook="//www.facebook.com"
        data-twitter="//www.twitter.com"
        data-link="//www.example.com"
        data-email="//www.gmail.com">
        <div id="v_<?php echo 1+time();?>" class="video-player">
        </div>
        <div class="channels-video">
          <div class="slider-channels-video owl-carousel sliderDrag">
            <div class="channel video shadow-bottom">
              <div class="image-wrapper">
                <img src="//dummyimage.com/960x540/000/c8a461.png" alt="" width="293" height="185">
              </div>
              <a class="linkVid" href="#"></a>
              <div class="info">
                <div class="picto"><i class="icon icon_video"></i></div>
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
                <img src="//img.youtube.com/vi/_eaIurlPB7w/maxresdefault.jpg" alt="" width="293" height="185">
              </div>
              <a class="linkVid" href="#"></a>
              <div class="info">
                <div class="picto"><i class="icon icon_video"></i></div>
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
                <div class="picto"><i class="icon icon_video"></i></div>
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
                <div class="picto"><i class="icon icon_video"></i></div>
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
                <div class="picto"><i class="icon icon_video"></i></div>
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
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Bande-annonce</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>The Lobster</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="video-container state-init video"
        data-video="https://www.youtube.com/watch?v=p7t_GWXmgFk"
        data-facebook="//www.facebook.com"
        data-twitter="//www.twitter.com"
        data-link="//www.example.com"
        data-email="//www.gmail.com">
        <div id="v_<?php echo 2+time();?>" class="video-live">
        </div>
        <div class="video-overlay"></div>
        <div class="infos-bar">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Bande-annonce</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>The Lobster</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
