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
        data-playlist='[
          {
            "vid":1,
            "sources":[{"file":"./files/mov_bbb.mp4"}],
            "image":"//dummyimage.com/960x540/000/c8a461.png",
            "name":"Sils Maria",
            "category":"Photocall"
          },
          {
            "vid":2,
            "sources":[{"file":"https://www.youtube.com/watch?v=_eaIurlPB7w?t=1m2s"}],
            "image":"//img.youtube.com/vi/_eaIurlPB7w/maxresdefault.jpg",
            "name":"Interviews des réalisateurs",
            "category":"Montée des marches"
          },
          {
            "vid":3,
            "sources":[{"file":"https://www.youtube.com/watch?v=NtDG-Cnj-pw"}],
            "image":"img/slider-channels/03.jpg",
            "name":"Sils Maria",
            "category":"Conférence de presse"
          },
          {
            "vid":4,
            "sources":[{"file":"https://www.youtube.com/watch?v=4QmpYuVEwIU"}],
            "image":"img/slider-channels/01.jpg",
            "name":"Sils Maria",
            "category":"Photocall"
          },
          {
            "vid":5,
            "sources":[{"file":"https://www.youtube.com/watch?v=YvjBXpmwhmk"}],
            "image":"img/slider-channels/02.jpg",
            "name":"Sils Maria",
            "category":"Montée des marches"
          }
        ]'>
        <div id="video-player-pl" class="video-player v_<?php echo time();?>">
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
        data-facebook="//www.facebook.com"
        data-twitter="//www.twitter.com"
        data-link="//www.example.com"
        data-email="//www.gmail.com"
        data-name="test"
        data-file='[{"file":"./files/mov_bbb.webm"}]'
        data-img="//dummyimage.com/960x540/000/c8a461.png">
        <div id="v_<?php echo 1+time();?>" class="video-player">
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
