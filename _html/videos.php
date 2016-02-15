<!DOCTYPE html>
<html>

  <head>
   <?php include('head.html'); ?>
  </head>

  <body>
    <?php include('header.html'); ?>

    <div id="main" class="all-videos grid loading">
      <h2 class="title">Toutes les vidéos</h2>
      <div class="filters">
        <div id="theme" class="filter">
          <span class="label">Dates :</span>
          <span class="select">
            <span class="active" data-filter="all">Toutes</span><i class="icon icon_fleche-down"></i>
            <span data-filter="date">Date 1</span>
            <span data-filter="date1">Date 2</span>
          </span>
        </div>
        <div id="format" class="filter">
          <span class="label">Thèmes :</span>
          <span class="select">
            <span class="active" data-filter="all">Tous</span><i class="icon icon_fleche-down"></i>
            <span data-filter="theme1">Thème 1</span>
            <span data-filter="theme2">Thème 2</span>
          </span>
        </div>
      </div>
      <div id="gridVideos" class="grid-wrapper" data-type="videos">
        <div class="grid-sizer"></div>
        <div class="item theme1 date1 date theme shadow-bottom video"
          data-vid="1"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/000/fff.png 1x, http://dummyimage.com/1280x808/000/fff.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 date theme shadow-bottom video"
          data-vid="2"
          data-file='[{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/c8a461/000.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/000/fff.png 1x, http://dummyimage.com/1280x808/000/fff.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 date theme shadow-bottom video"
          data-vid="3"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 date theme shadow-bottom video"
          data-vid="4"
          data-file='[{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/c8a461/000.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/000/fff.png 1x, http://dummyimage.com/1280x808/000/fff.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 date theme shadow-bottom video"
          data-vid="5"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 date theme shadow-bottom video"
          data-vid="6"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme1 date2 date theme shadow-bottom video"
          data-vid="7"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/000/fff.png 1x, http://dummyimage.com/1280x808/000/fff.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 date theme shadow-bottom video"
          data-vid="8"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 date theme shadow-bottom video"
          data-vid="9"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/000/fff.png 1x, http://dummyimage.com/1280x808/000/fff.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 date theme shadow-bottom video"
          data-vid="10"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 date theme shadow-bottom video"
          data-vid="11"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme1 date2 date theme shadow-bottom video"
          data-vid="12"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/000/fff.png 1x, http://dummyimage.com/1280x808/000/fff.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 date theme shadow-bottom video"
          data-vid="13"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 date theme shadow-bottom video"
          data-vid="14"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme1 date1 date theme shadow-bottom video"
          data-vid="15"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/000/fff.png 1x, http://dummyimage.com/1280x808/000/fff.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 date theme shadow-bottom video"
          data-vid="16"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 date theme shadow-bottom video"
          data-vid="17"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 date theme shadow-bottom video"
          data-vid="18"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 date theme shadow-bottom video"
          data-vid="19"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 date theme shadow-bottom video"
          data-vid="20"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 date theme shadow-bottom video"
          data-vid="21"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/000/fff.png 1x, http://dummyimage.com/1280x808/000/fff.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 date theme shadow-bottom video"
          data-vid="22"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 date theme shadow-bottom video"
          data-vid="23"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 date theme shadow-bottom video"
          data-vid="24"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 date theme shadow-bottom video"
          data-vid="25"
          data-file='[{"file":"./files/mov_bbb.webm"},{"file":"./files/mov_bbb.mp4"}]'
          data-img="//dummyimage.com/960x540/000/c8a461.png">
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_video"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <a id="next" href="videos2.html"></a>
      <div class="popin-video video loading" data-sound="">
        <div class="video-container state-init video"
          data-facebook="//www.facebook.com"
          data-twitter="//www.twitter.com"
          data-link="//www.example.com"
          data-email="//www.gmail.com"
          data-file=''
          data-img="">
          <div id="video-player-popin" class="">
          </div>
          <div class="video-overlay"></div>
          <div class="infos-bar">
            <div class="picto"><i class="icon icon_video"></i></div>
            <div class="info">
              <div class="vCenter">
                <div class="vCenterKid">
                  <a href="#" class="category"></a><span class="date"></span> . <span class="hour"></span>
                  <p></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="popin-info info">
          <a href="#" class="category"></a><span class="date"></span> . <span class="hour"></span>
          <p></p>
        </div>
        <div class="popin-buttons buttons square">
          <a href="//www.facebook.com/sharer.php?u=html.festival-cannes-2016.com.ohwee.fr&t=le%20titre"   rel="nofollow" class="button facebook ajax"><i class="icon icon_facebook"></i></a>
          <a href="//twitter.com/intent/tweet?text=Enrages%20Polar%20Hybride" class="button twitter"><i class="icon icon_twitter"></i></a>
          <a href="#" class="button link"><i class="icon icon_link"></i></a>
          <a href="#" class="button email"><i class="icon icon_lettre"></i></a>
        </div>
      </div>
      <div class="ov"></div>
    </div>

    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
