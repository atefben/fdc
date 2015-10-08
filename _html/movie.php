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
    <link href='css/styles.css' rel="stylesheet">
  
  </head>

  <body>
    <?php include('header.html'); ?>

    <div id="main" class="single-movie">
      <div class="main-image" style="background-image: url('img/movie/001.jpg')">
        <a href="#" class="nav prev"></a>
        <a href="#" class="nav next"></a>
        <div class="links">
          <div class="container">
            <a class="movies" href="#">Tous les films</a>
            <a class="programmation" href="#">Voir la programmation</a>
          </div>
        </div>
        <div class="trailer"></div>
      </div>
      <div class="container container-top">
        <div class="poster video">
          <img src="img/movie/002.jpg" alt="" />
          <a href="#" class="picto"></a>
        </div>
        <div class="info-film">
          <div class="categories"><span>En compétition</span><span>longs métrages</span><span>Film d'ouverture</span></div>
          <h2>Adieu au langage</h2>
          <div class="title-original">(Adieu au langage)</div>
          <p>Réalisé par : <a href="#">Jean-Luc GODARD</a></p>
          <p>Année : <span>2014</span> Pays : <span>FRANCE</span> Durée : <span>70 minutes</span> Date de sortie : <span>21 Mai 2014</span></p>

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
            <li><a href="#casting">casting & credits</a></li>
            <li><a href="#photos">photos</a></li>
            <li><a href="#news">actualites</a></li>
            <li><a href="#audios">audios</a></li>
            <li><a href="#press">infos presse</a></li>
          </ul>
          <div class="buttons square">
            <a href="#" class="button facebook"></a>
            <a href="#" class="button twitter"></a>
            <a href="#" class="button link"></a>
            <a href="#" class="button email"></a>
            <a href="#" class="button print"></a>
          </div>
        </div>
      </div>
      <div class="videos" data-section="videos">
        <div class="container">
          <div class="video-player video">
            <div class="image" style="background-image: url(img/movie/003.jpg);"></div>
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
        </div>
        <div id="slider-movie-videos" class="owl-carousel sliderDrag">
          <div class="slide-video shadow-bottom">
            <img src="http://dummyimage.com/293x185/000/fff" alt="" />
            <a class="linkVid" href="#"></a>
            <div class="info">
              <div class="picto"></div>
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
              <div class="picto"></div>
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
              <div class="picto"></div>
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
              <div class="picto"></div>
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
              <img src="img/movie/004.jpg" alt="" class="active" />
              <img src="img/movie/004.jpg" alt="" />
              <img src="img/movie/004.jpg" alt="" />
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
                <p><a href="#">Jean-Luc Godard</a> - Réalisation</p>
                <p><a href="#">Jean-Luc Godard</a> - Scénario / Dialogues</p>
                <p><a href="#">Fabrice ARAGNO</a> - Directeur de la photographie</p>
                <p><a href="#">Jean-Luc Godard</a> - Montage</p>
                <div class="actors">
                  <h3 class="title-section">Acteurs</h3>
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
                  <a class="chocolat-image" href="img/slide001.jpg" title='<h2>Sur le tournage de "Deephan" de Jacques Audiard</h2><p>Crédit Image : VALERY HACHE / AFP</p>'>
                    <img src="img/slide001.jpg" alt="" />
                  </a>
                </div>
                <div class="img">
                  <a class="chocolat-image" href="http://cdn-parismatch.ladmedia.fr/var/news/storage/images/paris-match/culture/cinema/festival-de-cannes-2013-audrey-tautou-maitresse-de-ceremonie-508580/4577783-1-fre-FR/Festival-de-Cannes-2013-Audrey-Tautou-maitresse-de-ceremonie.jpg"><img src="img/slide002.jpg" alt="" /></a>
                </div>
                <div class="img"><img src="img/slide001.jpg" alt="" /></div>
                <div class="img"><img src="img/slide001.jpg" alt="" /></div>
                <div class="img"><img src="img/slide001.jpg" alt="" /></div>
                <div class="img"><img src="img/slide001.jpg" alt="" /></div>
                <div class="img"><img src="img/slide001.jpg" alt="" /></div>
                <div class="img"><img src="img/slide001.jpg" alt="" /></div>
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
        <div class="news" data-section="news">
          <div class="articles center">
            <article class="article" data-format="article" data-theme="competition">
              <div class="image" style="background-image: url('img/articles/03.jpg')">
                <a href="article.php"></a>
                <span class="picto"></span>
              </div>
              <div class="info">
                <a href="#" class="category">Compétition</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
              </div>
            </article>
            <article class="video" data-format="video" data-theme="photocall">
              <div class="image" style="background-image: url('img/articles/03.jpg')">
                <a href="article.php"></a>
                <span class="picto"></span>
              </div>
              <div class="info">
                <a href="#" class="category">Photocall</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <h2><a href="article.php">Z de Costa-Gravas</a></h2>
              </div>
            </article>
          </div>
        </div>
        <div class="audios" data-section="audios">
          <div class="audio-player audio bigger" data-sound="img/article/sound.mp3">
            <div class="image" style="background-image: url(img/slide001.jpg);"></div>
            <div class="picto"></div>
            <div class="info">
              <a href="#" class="category">Conférence de presse</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
              <p>The Lobster de Yoros Lanthinos</p>
            </div>
            <div class="wave-container"></div>
          </div>
        </div>
      </div>
      <div class="press" data-section="press">
        <div class="info-press">
          <div class="wrapper">
            <div class="vCenter">
              <div class="vCenterKid">
                <h3 class="gold">Infos presse</h3>
                <div class="folder">
                  <div class="vCenter">
                    <div class="vCenterKid">
                      <img src="img/movie/006.jpg" alt="" />
                      <h3>Dossier de presse</h3>
                      <a href="#">Français PDF</a>
                      <a href="#">English PDF</a>
                      <a href="#">Bilingue PDF</a>
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
              <div class="vCenterKid">
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
        <h2 class="title">En compétition</h2>
        <div id="slider-competition" class="owl-carousel sliderDrag">
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

    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <script src="js/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="js/bower_components/owl.carousel/src/js/owl.carousel.js"></script>
    <script src="js/bower_components/chocolat/src/js/jquery.chocolat.js"></script>
    <script src="js/bower_components/wavesurfer.js/dist/wavesurfer.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
