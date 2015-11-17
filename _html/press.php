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
    <link href='js/bower_components/fullcalendar/dist/fullcalendar.min.css' rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="http://fast.fonts.net/cssapi/47cc6bed-5912-4140-bc5c-4caa2425b61d.css"/>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic' rel='stylesheet' type='text/css'>
    <link href='css/styles.css' rel="stylesheet">
  
  </head>

  <body>
    <?php include('header-press.html'); ?>

    <div id="main" class="press loading calendar-open">
      <div class="header-press">
        <div class="head">
          <span>Espace presse</span>
        </div>
        <h2>Accueil</h2>
        <p>
          <span class="vCenter">
            <span class="vCenterKid">L'espace presse met également à la disposition du grand public des contenus en libre accès. Journalistes, pour visualiser les contenus et services qui vous sont exclusivement réservés, nous vous invitons à saisir le code qui vous a été délivré par le service de presse.</span>
          </span>
        </p>
      </div>
      <div class="locked">
        <div class="vCenter">
          <div class="vCenterKid">
            <h3 class="title-press">Contenu verrouillé</h3>
            <p>Journalistes, pour accéder à la programmation presse, veuillez saisir votre mot de passe.</p>
          </div>
        </div>
        <form action="">
          <input type="text" value="" placeholder="Mot de passe" />
          <input type="submit" value="valider" />
        </form>
      </div>
      <div class="wrapper">
        <div id='calendar'>
          <h2 class="title-calendar">mon agenda</h2>
          <div id="mycalendar" class="side"></div>
          <p class="link"><a href="#"><img src="img/svg/arrow-right-gold.svg" />tout mon agenda</a></p>
        </div>
        <div class="communiques">
          <div class="chap">
            <h3 class="title-press">Communiqués et infos</h3>
            <p class="link"><a href="#"><img src="img/svg/arrow-right-gold.svg" />tous les communiqués et infos</a></p>
          </div>
          <div class="grid-container">
            <article class="article" data-format="article" data-theme="press">
              <div class="image">
                <div class="image-wrapper">
                  <img src="img/articles/02.jpg" alt="" />
                </div>
                <a href="article.php" class="linkImage"></a>
                <span class="picto"></span>
              </div>
              <div class="info">
                <a href="#" class="category">Conférence de Presse</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <h2><a href="article.php">La Loi du Marché par Stéphane Brizé</a></h2>
              </div>
            </article>
            <article class="article" data-format="article" data-theme="press">
              <div class="image">
                <div class="image-wrapper">
                  <img src="img/articles/02.jpg" alt="" />
                </div>
                <a href="article.php" class="linkImage"></a>
                <span class="picto"></span>
              </div>
              <div class="info">
                <a href="#" class="category">Conférence de Presse</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <h2><a href="article.php">La Loi du Marché par Stéphane Brizé</a></h2>
              </div>
            </article>
            <article class="article" data-format="article" data-theme="press">
              <div class="image">
                <div class="image-wrapper">
                  <img src="img/articles/02.jpg" alt="" />
                </div>
                <a href="article.php" class="linkImage"></a>
                <span class="picto"></span>
              </div>
              <div class="info">
                <a href="#" class="category">Conférence de Presse</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <h2><a href="article.php">La Loi du Marché par Stéphane Brizé</a></h2>
              </div>
            </article>
            <article class="article" data-format="article" data-theme="press">
              <div class="image">
                <div class="image-wrapper">
                  <img src="img/articles/02.jpg" alt="" />
                </div>
                <a href="article.php" class="linkImage"></a>
                <span class="picto"></span>
              </div>
              <div class="info">
                <a href="#" class="category">Conférence de Presse</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <h2><a href="article.php">La Loi du Marché par Stéphane Brizé</a></h2>
              </div>
            </article>
            <article class="article" data-format="article" data-theme="press">
              <div class="image">
                <div class="image-wrapper">
                  <img src="img/articles/02.jpg" alt="" />
                </div>
                <a href="article.php" class="linkImage"></a>
                <span class="picto"></span>
              </div>
              <div class="info">
                <a href="#" class="category">Conférence de Presse</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <h2><a href="article.php">La Loi du Marché par Stéphane Brizé</a></h2>
              </div>
            </article>
            <article class="article" data-format="article" data-theme="press">
              <div class="image">
                <div class="image-wrapper">
                  <img src="img/articles/02.jpg" alt="" />
                </div>
                <a href="article.php" class="linkImage"></a>
                <span class="picto"></span>
              </div>
              <div class="info">
                <a href="#" class="category">Conférence de Presse</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <h2><a href="article.php">La Loi du Marché par Stéphane Brizé</a></h2>
              </div>
            </article>
          </div>
        </div>
        <div class="programmation">
          <div class="chap">
            <h3 class="title-press">Programme du 23 Juin 2016</h3>
            <p class="link"><a href="#"><img src="img/svg/arrow-right-gold.svg" />toute la programmation</a></p>
          </div>
        </div>
        <div class="mediatheque">
          <div class="chap">
            <h3 class="title-press">Médiathèque</h3>
            <p class="link"><a href="#"><img src="img/svg/arrow-right-gold.svg" />toute la médiathèque</a></p>
          </div>
          <div class="table">
            <div class="line">
              <div class="container">
                <div class="info">
                  <img src="http://dummyimage.com/55x75/000/fff" alt="" />
                  <div class="txt">
                    <div class="vCenter">
                      <div class="vCenterKid"><p>CAROL<a href="#" class="director">Todd HAYNES</a></p></div>
                    </div>
                  </div>
                </div>
                <div class="media">Dossiers de presse (2)</div>
                <div class="media">Bandes annonces (4)</div>
                <div class="media">Photos (9)</div>
                <a class="button" href="#">Découvrir</a>
              </div>
            </div>
            <div class="line">
              <div class="container">
                <div class="info">
                  <img src="http://dummyimage.com/55x75/000/fff" alt="" />
                  <div class="txt">
                    <div class="vCenter">
                      <div class="vCenterKid"><p>CAROL<a href="#" class="director">Todd HAYNES</a></p></div>
                    </div>
                  </div>
                </div>
                <div class="media">Dossiers de presse (2)</div>
                <div class="media">Bandes annonces (4)</div>
                <div class="media">Photos (9)</div>
                <a class="button" href="#">Découvrir</a>
              </div>
            </div>
            <div class="line">
              <div class="container">
                <div class="info">
                  <img src="http://dummyimage.com/55x75/000/fff" alt="" />
                  <div class="txt">
                    <div class="vCenter">
                      <div class="vCenterKid"><p>CAROL<a href="#" class="director">Todd HAYNES</a></p></div>
                    </div>
                  </div>
                </div>
                <div class="media">Dossiers de presse (2)</div>
                <div class="media">Bandes annonces (4)</div>
                <div class="media">Photos (9)</div>
                <a class="button" href="#">Découvrir</a>
              </div>
            </div>
            <div class="line">
              <div class="container">
                <div class="info">
                  <img src="http://dummyimage.com/55x75/000/fff" alt="" />
                  <div class="txt">
                    <div class="vCenter">
                      <div class="vCenterKid"><p>CAROL<a href="#" class="director">Todd HAYNES</a></p></div>
                    </div>
                  </div>
                </div>
                <div class="media">Dossiers de presse (2)</div>
                <div class="media">Bandes annonces (4)</div>
                <div class="media">Photos (9)</div>
                <a class="button" href="#">Découvrir</a>
              </div>
            </div>
          </div>
        </div>
        <div class="download">
          <div class="chap">
            <h3 class="title-press">à télécharger</h3>
            <p class="link"><a href="#"><img src="img/svg/arrow-right-gold.svg" />tous les téléchargements</a></p>
          </div>
        </div>
        <div class="affiche">
          <div class="container">
            <h3 class="title-press">Affiche officielle</h3>
            <div class="portrait">
              <img src="img/press/press-portrait.jpg" alt="" />
              <span class="caption">© FDC / Lagency / Taste (Paris) / Ingrid Bergman © David Seymour / Estate of David Seymour - Magnum Photos</span>
              <p>Format portrait</p>
              <div class="buttons">
                <a href="#" class="button">JPG 72 DPI</a>
                <a href="#" class="button">JPG 300 DPI</a>
              </div>
            </div>
            <div class="landscape">
              <img src="img/press/press-landscape.jpg" alt="" />
              <span class="caption">© FDC / Lagency / Taste (Paris) / Ingrid Bergman © David Seymour / Estate of David Seymour - Magnum Photos</span>
              <p>Format portrait</p>
              <div class="buttons">
                <a href="#" class="button">JPG 72 DPI</a>
                <a href="#" class="button">JPG 300 DPI</a>
              </div>
            </div>
          </div>
        </div>
        <div class="section participate">
          <div class="img"></div>
          <div class="txt vCenter">
            <div class="vCenterKid">
              <h2 class="title">Participer</h2>
              <p class="link"><a href="#"><img src="img/svg/arrow-right-gold.svg" />Accéder</a></p>
            </div>
          </div>
        </div>
        <div class="section accrediter">
          <div class="img"></div>
          <div class="txt vCenter">
            <div class="vCenterKid">
              <h2 class="title">S'accréditer</h2>
              <p class="link"><a href="#"><img src="img/svg/arrow-right-gold.svg" />Accéder</a></p>
            </div>
          </div>
        </div>
        <div class="stats">
          <div class="chap">
            <h3 class="title-press">statistiques</h3>
          </div>
          <div class="container">
            <h3>Lorem ipsum dolor sit amet</h3>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione.</p>
          </div>
        </div>
      </div>
      <div class="contact-press">
        <h2 class="title">Contactez-nous</h2>
        <div class="container">
          <div class="col">
            <h3>Festival de Cannes - Service de Presse</h3>
            <p>3, rue Amélie F-75007 Paris<br />Tel : +33 (0)1 53 59 61 85<br />Fax : +33 (0)1 53 59 61 84</p>
            <p><strong>Presse écrite et digitale - Agences de Presse</strong><br /><a class="mail" href="mailto:presse@festival-cannes.fr">presse@festival-cannes.fr</a></p>
            <p><strong>Médias Web</strong><br /><a class="mail" href="mailto:webmedia@festival-cannes.fr">webmedia@festival-cannes.fr</a></p>
          </div>
          <div class="col">
            <h3>Service de Presse Audiovisuelle</h3>
            <p>Tel : +33 (0)1 53 59 61 88 / 61 92<br />Fax : +33 (0)1 53 59 61 10</p>
            <p class="pressaudio"><strong>Télévision - Radio<br />Média Web (Image & son)<br />Agence de Presse Audiovisuelle & Vidéo<br />Agence Photo - Photographe :</strong><br /><a class="mail" href="mailto:presseaudio@festival-cannes.fr">presseaudio@festival-cannes.fr</a></p>
          </div>
          <div class="col">
            <h3>Vous avez une demande à formuler ou souhaitez faire une suggestion ?</h3>
            <p>Identifiez votre interlocuteur pour un meilleur traitement de votre demande</p>
            <a href="contact.php" class="button">formulaire de contact</a>
          </div>
        </div>
      </div>
    </div>

    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
