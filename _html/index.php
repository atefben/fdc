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
  
  </head>

  <body>
    <div id="prehome-container">
      <div id="prehome"></div>
    </div>
    <?php include('header.html'); ?>
    <div id="main" class="home loading">
      <div id="sliderWrapper">
        <div id="slider" class="owl-carousel">
          <div>
            <div class="img" style="background-image:url(img/slider/slider01.jpg)"></div>
            <div class="info">
              <span class="category">Rencontre</span>
              <h2>Xavier Dolan : « Tant qu’il y a encore un peu de spontanéité, il y a de l’art »</h2>
            </div>
            <a href="article.php" class="linkArticle"></a>
          </div>
          <div>
            <div class="img" style="background-image:url(img/slider/slider02.jpg)"></div>
            <div class="info">
              <span class="category">Rencontre</span>
              <h2>test</h2>
            </div>
            <a href="article.php" class="linkArticle"></a>
          </div>
          <div>
            <div class="img" style="background-image:url(img/articles/01.jpg)"></div>
            <div class="info">
              <span class="category">Test</span>
              <h2>test</h2>
            </div>
            <a href="article.php" class="linkArticle"></a>
          </div>
          <div>
            <div class="img" style="background-image:url(img/articles/02.jpg)"></div>
            <div class="info">
              <span class="category">Lorem ipsum</span>
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
            <span class="label">Thêmes :</span>
            <span class="select">
              <span class="active" data-filter="all">Tous</span>
              <span data-filter="press">Conférence de Presse</span>
              <span data-filter="steps">Montée des marches</span>
            </span>
          </div>
          <div id="format" class="filter">
            <span class="label">Formats :</span>
            <span class="select">
              <span class="active" data-filter="all">Tous</span>
              <span data-filter="photo">Photo</span>
              <span data-filter="video">Vidéo</span>
              <span data-filter="audio">Audio</span>
              <span data-filter="article">Article</span>
            </span>
          </div>
        </div>
        <div class="container">
          <div class="content-news">
            <div id="articles-wrapper">
              <div class="articles left">
                <article class="article double" data-format="article" data-theme="cinema">
                  <div class="image">
                    <div class="image-wrapper">
                      <img src="img/articles/01.jpg" alt="" />
                    </div>
                    <a href="article.php" class="linkImage"></a>
                    <a href="#" class="read-later"><span>Ajouter à ma sélection</span></a>
                    <span class="picto"></span>
                  </div>
                  <div class="info">
                    <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                    <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
                  </div>
                </article>
                <article class="audio" data-format="audio" data-theme="press">
                  <div class="image">
                    <div class="image-wrapper">
                      <img src="img/articles/02.jpg" alt="" />
                    </div>
                    <a href="article.php" class="linkImage"></a>
                    <a href="#" class="read-later"><span>Ajouter à ma sélection</span></a>
                    <span class="picto"></span>
                  </div>
                  <div class="info">
                    <a href="#" class="category">Conférence de Presse</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                    <h2><a href="article.php">La Loi du Marché par Stéphane Brizé</a></h2>
                  </div>
                </article>
                <article class="video" data-format="video" data-theme="steps">
                  <div class="image">
                    <div class="image-wrapper">
                      <img src="img/articles/03.jpg" alt="" />
                    </div>
                    <a href="article.php" class="linkImage"></a>
                    <a href="#" class="read-later"><span>Ajouter à ma sélection</span></a>
                    <span class="picto"></span>
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
                <article class="article" data-format="article" data-theme="competition">
                  <div class="image">
                    <div class="image-wrapper">
                      <img src="img/articles/03.jpg" alt="" />
                    </div>
                    <a href="article.php" class="linkImage"></a>
                    <a href="#" class="read-later"><span>Ajouter à ma sélection</span></a>
                    <span class="picto"></span>
                  </div>
                  <div class="info">
                    <a href="#" class="category">Compétition</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                    <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
                  </div>
                </article>
                <article class="video" data-format="video" data-theme="photocall">
                  <div class="image">
                    <div class="image-wrapper">
                      <img src="img/articles/03.jpg" alt="" />
                    </div>
                    <a href="article.php" class="linkImage"></a>
                    <a href="#" class="read-later"><span>Ajouter à ma sélection</span></a>
                    <span class="picto"></span>
                  </div>
                  <div class="info">
                    <a href="#" class="category">Photocall</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                    <h2><a href="article.php">Z de Costa-Gravas</a></h2>
                  </div>
                </article>
                <article class="photo" data-format="photo" data-theme="photograph">
                  <div class="image">
                    <div class="image-wrapper">
                      <img src="img/articles/03.jpg" alt="" />
                    </div>
                    <a href="article.php" class="linkImage"></a>
                    <a href="#" class="read-later"><span>Ajouter à ma sélection</span></a>
                    <span class="picto"></span>
                  </div>
                  <div class="info">
                    <a href="#" class="category">L'oeil du photographe</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                    <h2><a href="article.php">Renaud, réalisateur indépendant canadien © Balint Porneczi / supported by [NEUS]</a></h2>
                  </div>
                </article>
              </div>

            </div>

            <a href="#" class="read-more">Afficher <strong>plus d'actualités</strong></a>
          </div>

          <div id="timeline">
            <a href="#" data-date="21" class="disabled">sam<span class="day">21</span></a>
            <a href="#" data-date="20" class="disabled">ven<span class="day">20</span></a>
            <a href="#" data-date="19" class="disabled">jeu<span class="day">19</span></a>
            <a href="#" data-date="18" class="active">mer<span class="day">18</span></a>
            <a href="#" data-date="17" class="">mar<span class="day">17</span></a>
            <a href="#" data-date="16" class="">lun<span class="day">16</span></a>
            <a href="#" data-date="15" class="">dim<span class="day">15</span></a>
            <a href="#" data-date="14" class="">sam<span class="day">14</span></a>
            <a href="#" data-date="13" class="">ven<span class="day">13</span></a>
            <a href="#" data-date="12" class="">jeu<span class="day">12</span></a>
            <a href="#" data-date="11" class="">mer<span class="day">11</span></a>
            <a href="#" data-date="10" class="">mar<span class="day">10</span></a>
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
                <div class="vCenterKid"><img src="img/svg/palme.svg" width="70" />#Cannes2016</div>
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
                <li><a class="facebook" href="http://www.facebook.com/pages/Festival-de-Cannes-PageOfficielle/197710070249937" target="_blank">Facebook</a></li>
                <li><a class="twitter" href="https://twitter.com/Festival_Cannes" target="_blank">Twitter</a></li>
                <li><a class="instagram" href="https://instagram.com/festivaldecannes" target="_blank">Instagram</a></li>
                <li><a class="tumblr" href="http://festivaldecannesofficiel.tumblr.com/" target="_blank">Tumblr</a></li>
                <li><a class="youtube" href="https://www.youtube.com/user/TVFestivaldeCannes" target="_blank">Youtube</a></li>
                <li><a class="dailymotion" href="http://www.dailymotion.com/CannesFestTV" target="_blank">Dailymotion</a></li>
              </ul>
          </div>
        </div>
      </div>

      <div id="featured-videos">
        <h2 class="title">Les vidéos à la une</h2>
        <p class="link"><a href="#"><img src="img/svg/arrow-right-gold.svg" />Accédez à la web tv</a></p>
        <div id="slider-videos" class="owl-carousel sliderDrag">
          <div class="vid">
            <div class="image-wrapper">
              <img src="img/slider-videos/001.jpg" alt="" />
            </div>
            <a class="linkVid" href="#"></a>
            <div class="info">
              <div class="picto"></div>
              <div class="info-container">
                <div class="vCenter">
                  <div class="vCenterKid">
                    <a href="#" class="category">Conférence de presse</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
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
              <div class="picto"></div>
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
              <div class="picto"></div>
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
              <div class="picto"></div>
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
              <div class="picto"></div>
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
              <div class="picto"></div>
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
              <div class="picto"></div>
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
              <div class="picto"></div>
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
              <div class="picto"></div>
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
            <video preload>
              <source src="img/featured-movies/sample.webm" type="video/webm">
              <source src="img/featured-movies/sample.mp4" type="video/mp4">
            </video>
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
              <a href="#" class="seances">Voir les séances</a>
              <a href="#" class="all">Tous les films</a>
            </div>
          </div>
          <div>
            <video preload>
              <source src="img/featured-movies/sample.webm" type="video/webm">
              <source src="img/featured-movies/sample.mp4" type="video/mp4">
            </video>
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
              <a href="#" class="seances">Voir les séances</a>
              <a href="#" class="all">Tous les films</a>
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
                <h3>Le palmares</h3>
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
          <div class="push right">
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
          <div class="push center">
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
          <h2>Vivez le festival de Cannes</h2>
          <h3 class="subtitle">Suivez le Festival où que vous soyez</h3>
          <ul>
            <li><a href="https://www.youtube.com/user/TVFestivaldeCannes" class="active" target="_blank">TV Festival de Cannes</a></li>
            <li><a href="#">Applications Mobiles</a></li>
            <li><a href="http://www.boutiqueofficielle.festival-cannes.com/" target="_blank">Boutique officielle</a></li>
            <li><a href="#">Publications</a></li>
          </ul>
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

    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
