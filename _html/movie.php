<!DOCTYPE html>
<html>

  <head>
    <?php include('head.html'); ?>
  </head>

  <body>
    <?php include('header.html'); ?>

    <div id="main" class="single-movie loading">
      <span id="addtext">Ajouter à ma sélection</span>
      <div id="canvasloader" class="canvasloader"></div>
      <div class="content-movie">
        <div class="prevmovie">
          <div class="img">
            <img src="img/movie/002.jpg" alt="" />
          </div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <h2>IL RACCONTO DEI RACCONTI</h2>
                <a href="#">Paolo SORRENTINO</a>
                <p>Pays : Italie</p>
              </div>
            </div>
          </div>
        </div>
        <div class="nextmovie">
          <div class="img">
            <img src="img/movie/002.jpg" alt="" />
          </div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <h2>Youth</h2>
                <a href="#">Paolo SORRENTINO</a>
                <p>Pays : Italie</p>
              </div>
            </div>
          </div>
        </div>
        <a href="movie2.php" class="nav prev ajax"><i class="icon icon_flecheGauche"></i></a>
        <a href="movie3.php" class="nav next ajax"><i class="icon icon_fleche-right"></i></i></a>
        <span id="plx"></span>
        <div class="main-image">
          <div class="img" style="background-image: url('img/movie/001.jpg')"></div>
          <div class="links">
            <div class="container">
              <a class="movies" href="#"><i class="icon icon-arrow-left"></i>Tous les films</a>
              <a class="programmation" href="#"><i class="icon icon_programmation"></i>Voir la programmation</a>
            </div>
          </div>
          <div class="trailer">
            <div class="video-container state-init video"
              data-facebook="//www.facebook.com/sharer.php?u=html.festival-cannes-2016.com.ohwee.fr&t=le%20titre"
              data-twitter="//www.twitter.com"
              data-link="//www.example.com"
              data-email="//www.gmail.com"
              data-file='[{"file":"./files/mov_bbb.mp4"}]'
              data-img="//dummyimage.com/960x540/c8a461/000.png">
              <div id="video-movie-trailer" class="video-player">
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
        </div>
        <div class="container container-top">
          <div class="poster video">
            <a href="#" class="picto"><i class="icon icon_video"></i></a>
            <img src="img/movie/002.jpg" alt="" data-object-fit="cover">
          </div>
          <div class="info-film tetiere-movie">
            <div class="categories"><span>En compétition</span><span>longs métrages</span><span>Film d'ouverture</span></div>
            <h2>Adieu au langage</h2>
            <div class="title-original">(Adieu au langage)</div>
            <p>Réalisé par : <a href="#">Jean-Luc GODARD</a></p>
            <p>Année de production : <span>2014</span> Pays : <span>FRANCE</span> Durée : <span>70 minutes</span> Date de sortie : <span>21 Mai 2014</span></p>
          </div>
          <div class="palmares">
            <i class="icon icon_palme"></i>
            <p>Prix Un Certain Regard - Fondation Groupama Gan pour le Cinéma , 2010</p>
          </div>
          <div class="info-film">
            <div  class="synopsis">
              <h3 class="title-section">Synopsis</h3>
              <p>Le propos est simple<br />
              Une femme mariée et un homme libre se rencontrent<br />
              Ils s’aiment, se disputent, les coups pleuvent<br />
              Un chien erre entre ville et campagne<br />
              Les saisons passent<br />
              L’homme et la femme se retrouvent<br />
              Le chien se trouve entre eux<br />
              L’autre est dans l’un<br />
              L’un est dans l’autre<br />
              Et ce sont les trois personnes<br />
              L’ancien mari fait tout exploser<br />
              Un deuxième film commence<br />
              Le même que le premier<br />
              Et pourtant pas<br />
              De l’espèce humaine on passe à la métaphore<br />
              Ça finira par des aboiements<br />
              Et des cris de bébé</p>
            </div>
          </div>
        </div>
        <div id="nav-movie">
          <div class="container">
            <ul>
              <li><a href="#videos">videos</a></li>
              <li><a href="#casting">crédits & casting</a></li>
              <li><a href="#photos">photos</a></li>
              <li><a href="#news">actualites</a></li>
              <li><a href="#audios">audios</a></li>
              <li><a href="#press">infos presse</a></li>
            </ul>
            <div class="buttons square">
              <a href="//www.facebook.com/sharer.php?u=html.festival-cannes-2016.com.ohwee.fr&t=le%20titre" rel="nofollow" class="button facebook ajax"><i class="icon icon_facebook"></i></a>
              <a  href="//twitter.com/intent/tweet?text=Enrages%20Polar%20Hybride" class="button twitter"><i class="icon icon_twitter"></i></a>
              <a href="#" class="button self"><i class="icon icon_link"></i></a>
              <a href="#" class="button email self"><i class="icon icon_lettre"></i></a>
              <a href="#" class="button print" onclick="window.print()"><i class="icon icon_print"></i></a>
            </div>
          </div>
        </div>
        <div class="videos" data-section="videos">
          <div class="container">
            <div class="video-container state-init video"
              data-facebook="//www.facebook.com/sharer.php?u=html.festival-cannes-2016.com.ohwee.fr&t=le%20titre"
              data-twitter="//www.twitter.com"
              data-link="//www.example.com"
              data-email="//www.gmail.com"
              data-playlist='[
                {
                  "sources":[{"file":"./files/mov_bbb.mp4"}],
                  "image":"//dummyimage.com/960x540/000/c8a461.png",
                  "name":"Sils Maria",
                  "category":"Photocall"
                },
                {
                  "sources":[{"file":"https://www.youtube.com/watch?v=_eaIurlPB7w?t=1m2s"}],
                  "image":"//img.youtube.com/vi/_eaIurlPB7w/maxresdefault.jpg",
                  "name":"Interviews des réalisateurs",
                  "category":"Montée des marches"
                },
                {
                  "sources":[{"file":"https://www.youtube.com/watch?v=NtDG-Cnj-pw"}],
                  "image":"img/slider-channels/03.jpg",
                  "name":"Sils Maria",
                  "category":"Conférence de presse"
                },
                {
                  "sources":[{"file":"https://www.youtube.com/watch?v=4QmpYuVEwIU"}],
                  "image":"img/slider-channels/01.jpg",
                  "name":"Sils Maria",
                  "category":"Photocall"
                },
                {
                  "sources":[{"file":"https://www.youtube.com/watch?v=YvjBXpmwhmk"}],
                  "image":"img/slider-channels/02.jpg",
                  "name":"Sils Maria",
                  "category":"Montée des marches"
                }
              ]'>
              <div id="video-player-ba"></div>
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
          <div id="slider-movie-videos" class="owl-carousel sliderDrag">
            <div class="slide-video shadow-bottom">
              <img src="http://dummyimage.com/293x185/000/fff" alt="" />
              <a class="linkVid" href="#"></a>
              <div class="info">
                <div class="picto"><i class="icon icon_video"></i></div>
                <div class="info-container">
                  <div class="vCenter">
                    <div class="vCenterKid">
                      <a href="#" class="category">Photocall</a>
                      <p>Lorem ipsum dolor sit amet sit amet</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="slide-video shadow-bottom">
              <img src="http://dummyimage.com/293x185/000/fff" alt="" />
              <a class="linkVid" href="#"></a>
              <div class="info">
                <div class="picto"><i class="icon icon_video"></i></div>
                <div class="info-container">
                  <div class="vCenter">
                    <div class="vCenterKid">
                      <a href="#" class="category">Montée des marches</a>
                      <p>Lorem ipsum dolor sit</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="slide-video shadow-bottom">
              <img src="http://dummyimage.com/293x185/000/fff" alt="" />
              <a class="linkVid" href="#"></a>
              <div class="info">
                <div class="picto"><i class="icon icon_video"></i></div>
                <div class="info-container">
                  <div class="vCenter">
                    <div class="vCenterKid">
                      <a href="#" class="category">Conférence de presse</a>
                      <p>Lorem ipsum dolor sit</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="slide-video shadow-bottom">
              <img src="http://dummyimage.com/293x185/000/fff" alt="" />
              <a class="linkVid" href="#"></a>
              <div class="info">
                <div class="picto"><i class="icon icon_video"></i></div>
                <div class="info-container">
                  <div class="vCenter">
                    <div class="vCenterKid">
                      <a href="#" class="category">Photocall</a>
                      <p>Lorem ipsum dolor sit</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="slide-video shadow-bottom">
              <img src="http://dummyimage.com/293x185/000/fff" alt="" />
              <a class="linkVid" href="#"></a>
              <div class="info">
                <div class="picto"><i class="icon icon_video"></i></div>
                <div class="info-container">
                  <div class="vCenter">
                    <div class="vCenterKid">
                      <a href="#" class="category">Photocall</a>
                      <p>Lorem ipsum dolor sit</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="casting" data-section="casting">
            <div class="gallery">
              <div class="img shadow-bottom">
                <img src="//dummyimage.com/600x400/000/fff.jpg" alt="" class="active" />
                <img src="//dummyimage.com/400x400/000/fff.jpg" alt="" />
                <img src="//dummyimage.com/500x800/000/fff.jpg" alt="" />
                <span class="caption">© FDC / Jean-Luc GODARD</span>
              </div>
              <div class="thumbs">
                <a href="#" class="active" data-caption="© FDC / Jean-Luc GODARD"><img src="img/movie/005.jpg" alt=""  /></a>
                <a href="#" data-caption="© FDC / GODARD"><img src="img/movie/005.jpg" alt="" /></a>
                <a href="#" data-caption="© FDC / Jean-Luc GODARD"><img src="img/movie/005.jpg" alt="" /></a>
              </div>
            </div>
            <div class="content">
              <div class="vCenter">
                <div class="vCenterKid">
                  <h3 class="title-section">Crédits</h3>
                  <p><a href="#">Jean-Luc GODARD</a> - Réalisation</p>
                  <p><a href="#">Jean-Luc GODARD</a> - Scénario / Dialogues</p>
                  <p><a href="#">Fabrice ARAGNO</a> - Directeur de la photographie</p>
                  <p><a href="#">Jean-Luc GODARD</a> - Montage</p>
                  <div class="actors">
                    <h3 class="title-section">Casting</h3>
                    <p><a href="#">Héloïse GODET</a> - Josette</p><p><a href="#">Zoé BRUNEAU</a> -  Ivitch</p>
                    <p><a href="#">Kamel ABDELLI</a> - Gédéon</p><p><a href="#">Christian GREGORI</a> - Davidson</p>
                    <p><a href="#">Richard CHEVALLIER</a> - Marcus</p><p><a href="#">Jessica ERICKSON</a> - Mary Shelley</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="photos" data-section="photos">
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
                  <div class="thumb active" data-caption="<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange">
                    <img src="img/thumb01.jpg" />
                  </div>
                  <div class="thumb" data-caption="test">
                    <img src="img/thumb01.jpg" />
                  </div>
                  <div class="thumb" data-caption="test">
                    <img src="img/thumb01.jpg" />
                  </div>
                  <div class="thumb" data-caption="test">
                    <img src="img/thumb01.jpg" />
                  </div>
                  <div class="thumb" data-caption="test">
                    <img src="img/thumb01.jpg" />
                  </div>
                  <div class="thumb" data-caption="test">
                    <img src="img/thumb01.jpg" />
                  </div>
                  <div class="thumb" data-caption="<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange">
                    <img src="img/thumb01.jpg" />
                  </div>
                  <div class="thumb" data-caption="test">
                    <img src="img/thumb01.jpg" />
                  </div>
                  <div class="thumb" data-caption="test">
                    <img src="img/thumb01.jpg" />
                  </div>
                  <div class="thumb" data-caption="test">
                    <img src="img/thumb01.jpg" />
                  </div>
                </div>
              </div>
              <p class="caption"><strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange</p>
            </div>
          </div>
        </div>
          <div class="news" data-section="news">
            <div class="articles center">
              <div id="slider-news" class="owl-carousel">
                <div class="item">
                  <article class="article" data-format="article" data-theme="competition">
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
                </div>
                <div class="item">
                  <article class="article" data-format="article" data-theme="competition">
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
                </div>
                <div class="item">
                  <article class="article" data-format="article" data-theme="competition">
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
                </div>
                <div class="item">
                  <article class="article" data-format="article" data-theme="competition">
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
                </div>
                <div class="item">
                  <article class="article" data-format="article" data-theme="competition">
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
                </div>
                <div class="item">
                  <article class="article" data-format="article" data-theme="competition">
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
                </div>
                <div class="item">
                  <article class="article" data-format="article" data-theme="competition">
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
                </div>
              </div>
            </div>
          </div>
        <div class="container">
          <div class="audios single-article" data-section="audios">
            <div class="audio-container"
                 data-file='[{"file":"./img/article/test.mp3"}]'
                 data-img="./img/slide001.jpg"
                 data-aid="2142">
              <div class="audio-player">
                <div id="audio-player-<?php echo time().'1'; ?>" class="audio-player-container"></div>
                <div class="image" style="background-image: url(img/slide001.jpg);"></div>
                <button class="play-btn play"><i class="icon icon_play"></i></button>
                <div class="off">
                  <div class="vCenter">
                    <div class="vCenterKid">
                      <div class="picto"><i class="icon icon_audio"></i></div>
                      <div class="info">
                        <a href="#" class="category">Conférence de test</a><span class="date">11.03.15</span> . <span class="hour">09:00</span>
                        <p>The Lobster de Yoros Lanthinos</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="on"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="press" data-section="press">
          <div class="info-press">
            <div class="wrapper">
              <div class="vCenter">
                <div class="vCenterKidTop">
                  <h3 class="gold">Infos presse</h3>
                  <div class="folder">
                    <div class="vCenter">
                      <div class="vCenterKid">
                        <img src="img/movie/006.jpg" alt="" />
                        <h3>Dossier de presse</h3>
                        <a href="#">Français PDF</a>
                        <a href="#">English PDF</a>
                      </div>
                    </div>
                  </div>
                  <div class="links">
                    <p class="sub">Liens</p>
                    <a href="#" target="_blank">Site internet</a><a href="#" target="_blank">Facebook</a><a href="#" target="_blank">Twitter</a>
                  </div>
                  <div class="buttons">
                    <p class="sub">Plus d'informations</p>
                    <a href="#" class="button">Espace presse</a>
                    <a href="#" class="button">Voir la programmation</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="contacts">
            <div class="wrapper">
              <div class="vCenter">
                <div class="vCenterKidTop">
                  <h3>Contacts</h3>
                  <div class="prod">
                    <p class="sub">Production</p>
                    <p>CG CINÉMA - 54 rue du Faubourg-Saint-Honoré 75008 Paris FRANCET: 0184173508 - <a href="#">production@cgcinema.eu</a></p>
                  </div>
                  <div>
                    <p class="sub">Distribution</p>
                    <p>LES FILMS DU LOSANGE - T: 01 44 43 87 10<br />
                    <a href="#">r.vial@filmsdulosange.fr</a>  <a href="#">www.filmsdulosange.fr</a></p>
                  </div>
                  <div>
                    <p class="sub">Presse française</p>
                    <p>MONICA DONATI - T: +33 (0)1 43 07 55 22<br />
                    <a href="#">monica.donati@mk2.com</a></p>
                  </div>
                  <div>
                    <p class="sub">Presse internationale</p>
                    <p>MANLIN STERNER - <a href="#">manlin@manlin.se</a></p>
                  </div>
                  <div>
                    <p class="sub">Ventes à l'étranger</p>
                    <p>MK2 - T: +33 (0)1 44 67 30 30</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="competition">
          <h2 class="title">En compétition 2016</h2>
          <div id="slider-competition" class="owl-carousel sliderDrag">
            <div class="slide">
              <img src="http://dummyimage.com/210x84/000/fff" alt="" />
              <a class="linkVid" href="#"></a>
              <div class="info-movie">
                <p>Carol</p>
                <a class="director" href="#">Todd HAYNES</a>
              </div>
            </div>
            <div class="slide">
              <img src="http://dummyimage.com/210x284/000/fff" alt="" />
              <a class="linkVid" href="#"></a>
              <div class="info-movie">
                <p>Carol</p>
                <a class="director" href="#">Todd HAYNES</a>
              </div>
            </div>
            <div class="slide">
              <img src="http://dummyimage.com/210x284/000/fff" alt="" />
              <a class="linkVid" href="#"></a>
              <div class="info-movie">
                <p>Carol</p>
                <a class="director" href="#">Todd HAYNES</a>
              </div>
            </div>
            <div class="slide">
              <img src="http://dummyimage.com/210x284/000/fff" alt="" />
              <a class="linkVid" href="#"></a>
              <div class="info-movie">
                <p>Carol</p>
                <a class="director" href="#">Todd HAYNES</a>
              </div>
            </div>
            <div class="slide">
              <img src="http://dummyimage.com/210x284/000/fff" alt="" />
              <a class="linkVid" href="#"></a>
              <div class="info-movie">
                <p>Carol</p>
                <a class="director" href="#">Todd HAYNES</a>
              </div>
            </div>
            <div class="slide">
              <img src="http://dummyimage.com/210x284/000/fff" alt="" />
              <a class="linkVid" href="#"></a>
              <div class="info-movie">
                <p>Carol</p>
                <a class="director" href="#">Todd HAYNES</a>
              </div>
            </div>
            <div class="slide">
              <img src="http://dummyimage.com/210x284/000/fff" alt="" />
              <a class="linkVid" href="#"></a>
              <div class="info-movie">
                <p>Carol</p>
                <a class="director" href="#">Todd HAYNES</a>
              </div>
            </div>
            <div class="slide">
              <img src="http://dummyimage.com/210x284/000/fff" alt="" />
              <a class="linkVid" href="#"></a>
              <div class="info-movie">
                <p>Carol</p>
                <a class="director" href="#">Todd HAYNES</a>
              </div>
            </div>
            <div class="slide">
              <img src="http://dummyimage.com/210x284/000/fff" alt="" />
              <a class="linkVid" href="#"></a>
              <div class="info-movie">
                <p>Carol</p>
                <a class="director" href="#">Todd HAYNES</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <span class="anim"></span>
    </div>
    <!-- POPIN MAIL SHARE -->
        <div class="popin-mail popin">
          <div class="contain-popin popin">
            <strong class="theme-article popin">Cinéma de la plage</strong><span class="date-article popin">18.05.15 . 09:00</span>
            <h2 class="title-article popin">Enragés, polar hybride d'Éric Hannezo</h2>
            <div class="chap-article popin">Ancien journaliste devenu producteur et cinéastre, Éric Hannezo s'aventure pour son premier film sur les routes nord-américaines et signe un polar hybride à l'affiche duquel on retrouve Lambert Wilson et Franck Gastambide.</div>
          </div>
          <form action="" id="form" class="popin">
            <input class="popin" type="text" placeholder="Email des destinataires*" name="email-dest" data-error="L'adresse email du destinataire n'est pas valide" required><span class="complet-infos popin">Séparez les adresses par des virgules</span>
            <input type="email" placeholder="Votre adresse email*" class="popin" name="email-user" data-error="Votre adresse email n'est pas valide" required>
            <span class="complet-infos popin">
              <input type="checkbox" class="popin" id="mail-copy" name='mail-copy'>
              <label for="mail-copy" class="popin">M'envoyez une copie par email</label>
            </span>
            <textarea placeholder="Votre message" name="message" class="popin"></textarea>
            <span class="complet-infos newsletter popin">
              <input type="checkbox" class="popin" id="newsletter-mail" name='newsletter-mail'>
              <label class="popin" for="newsletter-mail">Je souhaite recevoir la newsletter du Festival de Cannes</label>
            </span>
            <span class="detail popin">* Champs obligatoires</span>
            <input type="submit" value='envoyer' class='popin'>
            <div class="errors popin">
              <ul class="popin">
              </ul>
            </div>
          </form>
          <div class="info-popin popin">
            <p class="popin">
              En application de la loi n° 78-17 du 6 janvier 1978 modifiée relative à l'informatique, aux fichiers et aux libertés, l’internaute dispose des droits d'opposition (art. 38 de la loi), d'accès (art. 39 de la loi), de rectification et de suppression (art. 40 de la loi) des données le concernant. Pour exercer ces droits, l’internaute doit s’adresser à : Direction juridique OGF, 31 rue de Cambrai 75946 PARIS cedex 19, ou à l’adresse électronique suivante informatiqueetlibertes.dj@ogf.fr, accompagné d’une copie d’un titre d’identité.
              <br> OGF a déclaré les fichiers décrits ci-dessus à la CNIL et enregistrée sous le n° 1607719.
            </p>
          </div>
        </div>
        <!-- END POPIN MAIL SHARE -->

        <!-- POPIN MAIL SHARE -->
            <div class="popin-mail media popin">
              <div class="contain-popin popin">
                <strong class="theme-article popin">Cinéma de la plage</strong><span class="date-article popin">18.05.15 . 09:00</span>
                <h2 class="title-article popin">Enragés, polar hybride d'Éric Hannezo</h2>
              </div>
              <form action="" id="form" class="popin">
                <input class="popin" type="text" placeholder="Email des destinataires*" name="email-dest" data-error="L'adresse email du destinataire n'est pas " required><span class="complet-infos popin">Séparez les adresses par des virgules</span>
                <input type="email" placeholder="Votre adresse email*" class="popin" name="email-user" data-error="Votre adresse email n'est pas" required>
                <span class="complet-infos popin"><input type="checkbox" class="popin" id="mail-copy" name='mail-copy'><label for="mail-copy" class="popin">M'envoyez une copie par email</label></span>
                <textarea placeholder="Votre message*" name="message" data-error="Votre message n'est pas renseigné" class="popin"></textarea>
                <span class="complet-infos newsletter popin"><input type="checkbox" class="popin" id="newsletter-mail" name='newsletter-mail'><label class="popin" for="newsletter-mail">Je souhaite recevoir la newsletter du Festival de Cannes</label></span>
                <span class="detail popin">* Champs obligatoires</span>
                <input type="submit" value='envoyer' class='popin'>
                <div class="errors popin">
                  <ul class="popin">
                  </ul>
                </div>
              </form>
              <div class="info-popin popin">
                <p class="popin">
                  En application de la loi n° 78-17 du 6 janvier 1978 modifiée relative à l'informatique, aux fichiers et aux libertés, l’internaute dispose des droits d'opposition (art. 38 de la loi), d'accès (art. 39 de la loi), de rectification et de suppression (art. 40 de la loi) des données le concernant. Pour exercer ces droits, l’internaute doit s’adresser à : Direction juridique OGF, 31 rue de Cambrai 75946 PARIS cedex 19, ou à l’adresse électronique suivante informatiqueetlibertes.dj@ogf.fr, accompagné d’une copie d’un titre d’identité.
                  <br> OGF a déclaré les fichiers décrits ci-dessus à la CNIL et enregistrée sous le n° 1607719.
                </p>
              </div>
            </div>
        <!-- END POPIN MAIL SHARE -->
    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
