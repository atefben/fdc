<!DOCTYPE html>
<html>

  <head>
    <?php include('head.html'); ?>
  </head>


  <body>
    <div id="prehome-container">
      <div id="prehome"></div>
    </div>
    <?php include('header.html'); ?>
    <div id="main" class="home loading">
      <span id="addtext">Ajouter à ma sélection</span>
      <div id="sliderWrapper">
        <div id="slider" class="owl-carousel">
          <div>
            <div class="img-container"><div class="img" style="background-image:url(/img/slider/slider01.jpg)"></div></div>
            <div class="info">
              <span class="category">Rencontre</span>
              <h2>Xavier DOLAN : « Tant qu’il y a encore un peu de spontanéité, il y a de l’art »</h2>
            </div>
            <a href="article.php" class="linkArticle"></a>
          </div>
          <div>
            <div class="img-container"><div class="img" style="background-image:url(/img/slider/slider02.jpg)"></div></div>
            <div class="info">
              <span class="category">Rencontre</span>
              <h2>test</h2>
            </div>
            <a href="article.php" class="linkArticle"></a>
          </div>
          <div>
            <div class="img-container"><div class="img" style="background-image:url(/img/slider/slider03.jpg)"></div></div>
            <div class="info">
              <span class="category">Test</span>
              <h2>test</h2>
            </div>
            <a href="article.php" class="linkArticle"></a>
          </div>
        </div>
      </div>
      <div id="news">
        <div id="canvasloader" class="canvasloader"></div>
        <h2 class="title">L'actualité à la une</h2>
        <div class="filters">
          <div id="theme" class="filter">
            <span class="label">Thèmes :</span>
            <span class="select">
              <span data-filter="all" class="active">Tous </span>
              <span data-filter="press">Conférence de Presse</span>
              <span data-filter="steps">Montée des marches</span>
              <i class="icon icon_fleche-down"></i>
            </span>
          </div>
          <div id="format" class="filter">
            <span class="label">Formats :</span>
            <span class="select">
              <span data-filter="all" class="active">Tous </span>
              <span data-filter="photo">Photo</span>
              <span data-filter="video">Vidéo</span>
              <span data-filter="audio">Audio</span>
              <span data-filter="article">Article</span>
              <i class="icon icon_fleche-down"></i>
            </span>
          </div>
        </div>
        <div class="container">
          <div class="content-news">
            <div id="articles-wrapper">
              <div class="articles left">
                <article class="article double" data-format="article" data-theme="cinema" data-time="1455909420" data-end="false">
                  <div class="image">
                    <div class="image-wrapper">
                      <img src="img/articles/01.jpg" alt="" />
                    </div>
                    <a href="article.php" class="linkImage"></a>
                    <a href="#" class="read-later"><i class="icon icon_lire-plus-tard"></i><span>Ajouter à ma sélection</span></a>
                    <span class="picto"><i class="icon icon_article"></i></span>
                  </div>
                  <div class="info">
                    <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                    <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
                  </div>
                </article>
                <article class="audio" data-format="audio" data-theme="press" data-time="1455909420" data-end="false">
                  <div class="image">
                    <div class="image-wrapper">
                      <img src="img/articles/02.jpg" alt="" />
                    </div>
                    <a href="article.php" class="linkImage"></a>
                    <a href="#" class="read-later"><i class="icon icon_lire-plus-tard"></i><span>Ajouter à ma sélection</span></a>
                    <span class="picto"><i class="icon icon_audio"></i></span>
                  </div>
                  <div class="info">
                    <a href="#" class="category">Conférence de Presse</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                    <h2><a href="article.php">La Loi du Marché par Stéphane Brizé</a></h2>
                  </div>
                </article>
                <article class="video" data-format="video" data-theme="steps" data-time="1455909420" data-end="false">
                  <div class="image">
                    <div class="image-wrapper">
                      <img src="img/articles/03.jpg" alt="" />
                    </div>
                    <a href="article.php" class="linkImage"></a>
                    <a href="#" class="read-later"><i class="icon icon_lire-plus-tard"></i><span>Ajouter à ma sélection</span></a>
                    <span class="picto"><i class="icon icon_video"></i></span>
                  </div>
                  <div class="info">
                    <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                    <h2><a href="article.php">O PISEU (Office) de HONG Won-Chan</a></h2>
                  </div>
                </article>
              </div>

              <div class="slideshow">
                <div class="slideshow-img">
                  <div class="images">
                    <div class="img active">
                      <a id="photo1" class="chocolat-image ajax" href="img/slide001.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP">
                        <img src="img/slide001.jpg" alt="" />
                      </a>
                    </div>
                    <div class="img">
                      <a id="photo2" class="chocolat-image ajax" href="http://cdn-parismatch.ladmedia.fr/var/news/storage/images/paris-match/culture/cinema/festival-de-cannes-2013-audrey-tautou-maitresse-de-ceremonie-508580/4577783-1-fre-FR/Festival-de-Cannes-2013-Audrey-Tautou-maitresse-de-ceremonie.jpg" title="test" data-credit="Crédit Image : ">
                        <img src="img/slide002.jpg" alt="" />
                      </a>
                    </div>
                    <div class="img">
                      <a id="photo3" class="chocolat-image ajax" href="img/slide001.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"><img src="img/slide002.jpg" alt="" /></a>
                    </div>
                    <div class="img">
                      <a id="photo4" class="chocolat-image ajax" href="img/slide001.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"><img src="img/slide002.jpg" alt="" /></a>
                    </div>
                    <div class="img">
                      <a id="photo5" class="chocolat-image ajax" href="img/slide001.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"><img src="img/slide002.jpg" alt="" /></a>
                    </div>
                    <div class="img">
                      <a id="photo6" class="chocolat-image ajax" href="img/slide001.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"><img src="img/slide002.jpg" alt="" /></a>
                    </div>
                    <div class="img">
                      <a id="photo7" class="chocolat-image ajax" href="img/slide001.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"><img src="img/slide002.jpg" alt="" /></a>
                    </div>
                    <div class="img">
                      <a id="photo8" class="chocolat-image ajax" href="img/slide001.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"><img src="img/slide002.jpg" alt="" /></a>
                    </div>
                    <div class="img">
                      <a id="photo9" class="chocolat-image ajax" href="img/slide001.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"><img src="img/slide002.jpg" alt="" /></a>
                    </div>
                  </div>
                  <div class="owl-carousel thumbnails">
                    <div data-id="photo1" class="thumb active" data-caption="<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange">
                      <img src="img/thumb01.jpg" />
                    </div>
                    <div data-id="photo2" class="thumb" data-caption="test">
                      <img src="img/thumb01.jpg" />
                    </div>
                    <div data-id="photo3" class="thumb">
                      <img src="img/thumb01.jpg" />
                    </div>
                    <div data-id="photo4" class="thumb">
                      <img src="img/thumb01.jpg" />
                    </div>
                    <div data-id="photo5" class="thumb">
                      <img src="img/thumb01.jpg" />
                    </div>
                    <div data-id="photo6" class="thumb">
                      <img src="img/thumb01.jpg" />
                    </div>
                    <div data-id="photo7" class="thumb">
                      <img src="img/thumb01.jpg" />
                    </div>
                    <div data-id="photo8" class="thumb">
                      <img src="img/thumb01.jpg" />
                    </div>
                    <div data-id="photo9" class="thumb">
                      <img src="img/thumb01.jpg" />
                    </div>
                  </div>
                </div>
                <h3>Portfolio du jour</h3>
                <p class="caption"><strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange</p>
              </div>

              <div class="articles center">
                <article class="article" data-format="article" data-theme="competition" data-time="1455909420" data-end="false">
                  <div class="image">
                    <div class="image-wrapper">
                      <img src="img/articles/03.jpg" alt="" />
                    </div>
                    <a href="article.php" class="linkImage"></a>
                    <a href="#" class="read-later"><i class="icon icon_lire-plus-tard"></i><span>Ajouter à ma sélection</span></a>
                    <span class="picto"><i class="icon icon_article"></i></span>
                  </div>
                  <div class="info">
                    <a href="#" class="category">Compétition</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                    <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
                  </div>
                </article>
                <article class="video" data-format="video" data-theme="photocall" data-time="1455909420" data-end="false">
                  <div class="image">
                    <div class="image-wrapper">
                      <img src="img/articles/03.jpg" alt="" />
                    </div>
                    <a href="article.php" class="linkImage"></a>
                    <a href="#" class="read-later"><i class="icon icon_lire-plus-tard"></i> <span>Ajouter à ma sélection</span></a>
                    <span class="picto"><i class="icon icon_video"></i></span>
                  </div>
                  <div class="info">
                    <a href="#" class="category">Photocall</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                    <h2><a href="article.php">Z de Costa-Gravas</a></h2>
                  </div>
                </article>
                <article class="photo" data-format="photo" data-theme="photograph" data-time="1455909420" data-end="false">
                  <div class="image">
                    <div class="image-wrapper">
                      <img src="img/articles/03.jpg" alt="" />
                    </div>
                    <a href="article.php" class="linkImage"></a>
                    <a href="#" class="read-later"><i class="icon icon_lire-plus-tard"></i> <span>Ajouter à ma sélection</span></a>
                    <span class="picto"><i class="icon icon_photo"></i></span>
                  </div>
                  <div class="info">
                    <a href="#" class="category">L'oeil du photographe</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                    <h2><a href="article.php">Renaud, réalisateur indépendant canadien © Balint Porneczi</a></h2>
                  </div>
                </article>
              </div>

            </div>

            <a href="#" class="read-more">Afficher <strong>plus d'actualités</strong></a>
          </div>

          <div id="timeline">
            <!-- <a href="#" data-date="22" class="disabled">dim<span class="day">22</span></a>
            <a href="#" data-date="21" class="disabled">sam<span class="day">21</span></a>
            <a href="#" data-date="20" class="disabled">ven<span class="day">20</span></a>
            <a href="#" data-date="19" class="active">jeu<span class="day">19</span></a>
            <a href="#" data-date="18" class="">mer<span class="day">18</span></a>
            <a href="#" data-date="17" class="">mar<span class="day">17</span></a>
            <a href="#" data-date="16" class="">lun<span class="day">16</span></a>
            <a href="#" data-date="15" class="">dim<span class="day">15</span></a>
            <a href="#" data-date="14" class="">sam<span class="day">14</span></a>
            <a href="#" data-date="13" class="">ven<span class="day">13</span></a>
            <a href="#" data-date="12" class="">jeu<span class="day">12</span></a>
            <a href="#" data-date="11" class="">mer<span class="day">11</span></a> -->

            <a href="#" data-timestamp="1456441199" data-date="25" class="disabled">jeu<span class="day">25</span></a>
            <a href="#" data-timestamp="1456354799" data-date="24" class="disabled">mer<span class="day">24</span></a>
            <a href="#" data-timestamp="1456268399" data-date="23" class="disabled">mar<span class="day">23</span></a>
            <a href="#" data-timestamp="1456181999" data-date="22" class="disabled">lun<span class="day">22</span></a>
            <a href="#" data-timestamp="1456095599" data-date="21" class="disabled">dim<span class="day">21</span></a>
            <a href="#" data-timestamp="1456009199" data-date="20" class="disabled">sam<span class="day">20</span></a>
            <a href="#" data-timestamp="1455922799" data-date="19" class="active">ven<span class="day">19</span></a>
            <a href="#" data-timestamp="1455836399" data-date="18" class="">jeu<span class="day">18</span></a>
            <a href="#" data-timestamp="1455749999" data-date="17" class="">mer<span class="day">17</span></a>
            <a href="#" data-timestamp="1455663599" data-date="16" class="">mar<span class="day">16</span></a>
            <a href="#" data-timestamp="1455577199" data-date="15" class="">lun<span class="day">15</span></a>
            <a href="#" data-timestamp="1455490799" data-date="14" class="">dim<span class="day">14</span></a>
          </div>
          <div id="shdMore" class="shadow-bottom"></div>
          <div id="shd" class="shadow-bottom"></div>
        </div>
      </div>

      <div id="social-wall">
        <div class="container">
          <div id="graph">
            <ul>
              <li>sam<span>14</span></li>
              <li>dim<span>15</span></li>
              <li>lun<span>16</span></li>
              <li>mar<span>17</span></li>
              <li>mer<span>18</span></li>
              <li>jeu<span>19</span></li>
              <li>ven<span>20</span></li>
              <li>sam<span>21</span></li>
              <li>dim<span>22</span></li>
              <li>lun<span>23</span></li>
              <li>mar<span>24</span></li>
              <li class="active">mer<span>25</span></li>
            </ul>
            <div id="hashtag">
              <div class="vCenter">
                <div class="vCenterKid"><i class="icon icon_palme"></i>#Cannes2016</div> <!-- TODO CSS-->
              </div>
            </div>
            <svg id="graphSVG" width="891" height="200"></svg>
            <div id="tipGraph"></div>
          </div>
          <div id="wall">
            <div class="post big">
              <div class="side side-1"></div>
              <div class="side side-2"></div>
            </div>
            <div class="post big">
              <div class="side side-1"></div>
              <div class="side side-2"></div>
            </div>
            <div class="post">
              <div class="side side-1"></div>
              <div class="side side-2"></div>
            </div>
            <div class="post">
              <div class="side side-1"></div>
              <div class="side side-2"></div>
            </div>
            <div class="post">
              <div class="side side-1"></div>
              <div class="side side-2"></div>
            </div>
            <div class="post">
              <div class="side side-1"></div>
              <div class="side side-2"></div>
            </div>
            <div class="post">
              <div class="side side-1"></div>
              <div class="side side-2"></div>
            </div>
            <div class="post">
              <div class="side side-1"></div>
              <div class="side side-2"></div>
            </div>
            <div class="post big right">
              <div class="side side-1"></div>
              <div class="side side-2"></div>
            </div>
            <div class="post">
              <div class="side side-1"></div>
              <div class="side side-2"></div>
            </div>
            <div class="post">
              <div class="side side-1"></div>
              <div class="side side-2"></div>
            </div>
            <div class="post">
              <div class="side side-1"></div>
              <div class="side side-2"></div>
            </div>
            <div class="post">
              <div class="side side-1"></div>
              <div class="side side-2"></div>
            </div>
            <div class="post">
              <div class="side side-1"></div>
              <div class="side side-2"></div>
            </div>
            <div class="post">
              <div class="side side-1"></div>
              <div class="side side-2"></div>
            </div>
          </div>
          <div id="networks">
            <p>Suivez le Festival de Cannes</p>
              <ul>
                <li><a class="facebook" href="http://www.facebook.com/pages/Festival-de-Cannes-PageOfficielle/197710070249937" target="_blank">Facebook<i class="icon icon_facebook"></i></a></li>
                <li><a class="twitter" href="https://twitter.com/Festival_Cannes" target="_blank">Twitter<i class="icon icon_twitter"></i></a></li>
                <li><a class="instagram" href="https://instagram.com/festivaldecannes" target="_blank">Instagram<i class="icon icon_instagram"></i></a></li>
                <li><a class="tumblr" href="http://festivaldecannesofficiel.tumblr.com/" target="_blank">Tumblr<i class="icon icon_tumblr"></i></a></li>
                <li><a class="youtube" href="https://www.youtube.com/user/TVFestivaldeCannes" target="_blank">Youtube<i class="icon icon_youtube"></i></a></li>
                <li><a class="dailymotion" href="http://www.dailymotion.com/CannesFestTV" target="_blank">Dailymotion<i class="icon icon_dailymotion"></i></a></li>
              </ul>
          </div>
        </div>
      </div>

      <div id="featured-videos">
        <h2 class="title">Les vidéos à la une</h2>
        <p class="link"><a href="webtv.php"><i class="icon icon_fleche-right"></i>Accédez à la web tv</a></p>
        <div id="slider-videos" class="owl-carousel sliderDrag">
          <div class="vid video"
            data-vid="1"
            data-file='[{"file":"./files/mov_bbb.mp4"}]'
            data-img="//dummyimage.com/960x540/000/c8a461.png">
            <div class="image-wrapper">
              <img src="img/slider-videos/001.jpg" alt="" />
            </div>
            <a class="linkVid" href="#"></a>
            <div class="info">
              <div class="picto"><i class="icon icon_video"></i></div>
              <div class="info-container">
                <div class="vCenter">
                  <div class="vCenterKid">
                    <span href="#" class="category">Conférence de presse</span>
                    <span class="date">18.05.15</span> . <span class="hour">09:00</span>
                    <p href="#" class="titleLink" data-title="Rencontre avec l'équipe de Carol">Rencontre avec l'équipe de Carol</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="vid video"
            data-vid="1"
            data-file='[{"file":"./files/mov_bbb.mp4"}]'
            data-img="//dummyimage.com/960x540/000/c8a461.png">
            <div class="image-wrapper">
              <img src="img/slider-videos/001.jpg" alt="" />
            </div>
            <a class="linkVid" href="#"></a>
            <div class="info">
              <div class="picto"><i class="icon icon_video"></i></div>
              <div class="info-container">
                <div class="vCenter">
                  <div class="vCenterKid">
                    <span href="#" class="category">Montée des marches</span>
                    <span class="date">18.05.15</span> . <span class="hour">09:00</span>
                    <p href="#" class="titleLink" data-title="Rencontre avec l'équipe de Carol">Rencontre avec l'équipe de Carol</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="vid">
            <div class="image-wrapper">
              <img src="img/slider-videos/001.jpg" alt="" />
            </div>
            <a class="linkVid" href="#"></a>
            <div class="info">
              <div class="picto"><i class="icon icon_video"></i></div>
              <div class="info-container">
                <div class="vCenter">
                  <div class="vCenterKid">
                    <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                    <a href="#" class="titleLink">Rencontre avec l'équipe de Carol</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="vid">
            <div class="image-wrapper">
              <img src="img/slider-videos/001.jpg" alt="" />
            </div>
            <a class="linkVid" href="#"></a>
            <div class="info">
              <div class="picto"><i class="icon icon_video"></i></div>
              <div class="info-container">
                <div class="vCenter">
                  <div class="vCenterKid">
                    <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                    <a href="#" class="titleLink">Rencontre avec l'équipe de Carol</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="channels">
        <h2 class="title">Les chaines</h2>
        <div id="slider-channels" class="owl-carousel sliderDrag">
          <div class="channel">
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
                    <span>103 vidéos</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="channel">
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
                    <span>282 vidéos</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="channel">
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
                    <span>47 vidéos</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="channel">
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
                    <span>103 vidéos</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="channel">
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
                    <span>282 vidéos</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="channel">
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
                    <span>47 vidéos</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="channel">
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
                    <span>47 vidéos</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="featured-movies">
        <div id="slider-movies" class="owl-carousel">
          <div>
            <div class="video">
              <video preload>
                <source src="img/featured-movies/sample.mp4">
                <source src="img/featured-movies/sample.webm" type="video/webm">
              </video>
              <div class="img" style="background-image:url(/img/slider/slider01.jpg)"></div>
            </div>
            <div class="textVideo">
              <div class="info">
                <div class="vCenter">
                  <div class="vCenterKid">
                    <span class="category">Compétition</span>
                    <h2>Sils Maria</h2>
                    <p class="director">de <a href="#">Olivier ASSAYAS</a></p>
                  </div>
                </div>
              </div>
              <div class="links">
                <a href="#" class="seances"><i class="icon icon_programmation"></i>Voir les séances</a>
                <a href="#" class="all"><i class="icon icon_fleche-right"></i>Tous les films</a>
              </div>
            </div>
          </div>
          <div>
            <div class="video">
              <video preload muted>
                <source src="https://broken-links.com/tests/media/BigBuck.m4v">
                <source src="https://broken-links.com/tests/media/BigBuck.webm" type="video/webm">
              </video>
              <div class="img" style="background-image:url(/img/slider/slider01.jpg)"></div>
            </div>
            <div class="textVideo">
              <div class="info">
                <div class="vCenter">
                  <div class="vCenterKid">
                    <span class="category">Compétition</span>
                    <h2>Sils Maria</h2>
                    <p class="director">de <a href="#">Olivier ASSAYAS</a></p>
                  </div>
                </div>
              </div>
              <div class="links">
                <a href="#" class="seances"><i class="icon icon_programmation"></i>Voir les séances</a>
                <a href="#" class="all"><i class="icon icon_fleche-right"></i>Tous les films</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="push-container">
        <div class="container">
          <div class="push">
            <div class="image-wrapper">
              <img src="img/push/push01.jpg" alt="" />
            </div>
            <div class="vCenter">
              <div class="vCenterKid">
                <h3>Le Jury</h3>
              </div>
            </div>
            <a href="#"></a>
          </div>
          <div class="push">
            <div class="image-wrapper">
              <img src="img/push/push02.jpg" alt="" />
            </div>
            <div class="vCenter">
              <div class="vCenterKid">
                <h3>Le palmarès</h3>
              </div>
            </div>
            <a href="#"></a>
          </div>
          <div class="push">
            <div class="image-wrapper">
              <img src="img/push/push03.jpg" alt="" />
            </div>
            <div class="vCenter">
              <div class="vCenterKid">
                <h3>La programmation</h3>
              </div>
            </div>
            <a href="#"></a>
          </div>
        </div>
      </div>
      <div class="push-container white">
        <div class="container">
          <div class="push">
            <div class="image-wrapper">
              <img src="img/push/push04.jpg" alt="" />
            </div>
            <div class="vCenter">
              <div class="vCenterKid">
                <h3>Espace presse</h3>
              </div>
            </div>
            <a href="#"></a>
          </div>
          <div class="push"></div>
          <div class="push">
            <div class="image-wrapper">
              <img src="img/push/push05.jpg" alt="" />
            </div>
            <div class="vCenter">
              <div class="vCenterKid">
                <h3>Participer<br />au festival</h3>
              </div>
            </div>
            <a href="#"></a>
          </div>
          <div class="push bigger">
            <div class="image-wrapper">
              <img src="img/push/push06.jpg" alt="" />
            </div>
            <div class="vCenter">
              <div class="vCenterKid">
                <h3>L'oeil du photographe</h3>
              </div>
            </div>
            <a href="#"></a>
          </div>
          <div class="push"></div>
          <div class="push"></div>
          <div class="push">
            <div class="image-wrapper">
              <img src="img/push/push07.jpg" alt="" />
            </div>
            <div class="vCenter">
              <div class="vCenterKid">
                <h3>Les évènements</h3>
              </div>
            </div>
            <a href="#"></a>
          </div>
          <div class="push">
            <div class="image-wrapper">
              <img src="img/push/push08.jpg" alt="" />
            </div>
            <div class="vCenter">
              <div class="vCenterKid">
                <h3>69 ans d'archives</h3>
              </div>
            </div>
            <a href="#"></a>
          </div>
        </div>
      </div>
      <div id="prefooter">
        <div class="container">
          <div class="textTop">
            <h2>Vivez le festival de Cannes</h2>
            <h3 class="subtitle">Suivez le Festival où que vous soyez</h3>
            <ul>
              <li><a href="https://www.youtube.com/user/TVFestivaldeCannes" class="active" target="_blank">TV Festival de Cannes</a></li>
              <li><a href="#">Applications Mobiles</a></li>
              <li><a href="http://www.boutiqueofficielle.festival-cannes.com/" target="_blank">Boutique officielle</a></li>
              <li><a href="#">Publications</a></li>
            </ul>
          </div>
          <div id="slider-prefooter" class="owl-carousel">
            <div class="imgSlide active bottom">
              <div class="vCenter">
                <div class="vCenterKidBottom">
                  <a href='https://www.youtube.com/user/TVFestivaldeCannes' target="_blank"><img src="img/prefooter/001.png" alt="" /></a>
                </div>
              </div>
            </div>
            <div class="imgSlide bottom">
              <div class="vCenter">
                <div class="vCenterKidBottom">
                  <a href='#'><img src="img/prefooter/002.png" alt="" /></a>
                </div>
              </div>
            </div>
            <div class="imgSlide">
              <div class="vCenter">
                <div class="vCenterKidBottom">
                  <a href='http://www.boutiqueofficielle.festival-cannes.com/' target="_blank"><img src="img/prefooter/003.png" alt="" /></a>
                </div>
              </div>
            </div>
            <div class="imgSlide top">
              <div class="vCenter">
                <div class="vCenterKidBottom">
                  <a href='#'><img src="img/prefooter/004.png" alt="" /></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="popin-video video loading">
      <div class="video-container state-init video"
        data-facebook="//www.facebook.com"
        data-twitter="//www.twitter.com"
        data-link="//www.example.com"
        data-email="//www.gmail.com">
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

    <?php include('footer.html'); ?>

     <!-- cookie banner -->
      <?php include('cookie-banner.php'); ?>
    <!-- //// SCRIPTS \\\\ -->

    <?php include('scripts.inc.php'); ?>
  </body>
</html>
