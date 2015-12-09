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

    <div id="main" class="press loading press-actu lock all-articles grid">
      <div class="header-press">
        <div class="head">
          <span>Espace presse</span>
        </div>
        <div class="container">
          <h2>Communiqués et infos</h2>
          <p>
            <span class="vCenter">
              <span class="vCenterKid">Communiqués, actualités, retrouvez toute l'information à ne pas manquer.</span>
            </span>
          </p>
        </div>
      </div>
      <div class="container-pressactu">
      <div class="filters">
          <div id="date" class="filter">
            <span class="label">Années :</span>
            <span class="select">
              <span class="active" data-filter="d2016">2016</span>
              <span data-filter="d2015">2015</span>
              <span data-filter="d2014">2014</span>
              <span data-filter="d2013">2013</span>
              <span data-filter="d2012">2012</span>
            </span>
          </div>
          <div id="type" class="filter">
            <span class="label">Types :</span>
            <span class="select">
              <span class="active" data-filter="all">Tous</span>
              <span data-filter="communique">Communiqués</span>
              <span data-filter="infos">Infos</span>
            </span>
          </div>
          <div id="theme" class="filter">
            <span class="label">Thèmes :</span>
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
              <span data-filter="article">Articles</span>
              <span data-filter="photos">Photos</span>
              <span data-filter="audios">Audios</span>
              <span data-filter="videos">Vidéos</span>
            </span>
          </div>
        </div>
      <div id="gridAudios" class="grid-wrapper" data-type="articles">
        <div class="grid-sizer"></div>
        <div class="item all communique">
          <article class="article">
            <div class="img"><span class="picto"></span><a href="article.php"><img src='img/press/actu01.jpg' /></a> </div>
            <div class="info">
              <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
              <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
            </div>
          </article>
        </div>
        <div class="item all d2015 communique photos press">
          <article class="article">
            <div class="img"><span class="picto"></span><a href="article.php"><img src='img/press/actu02.jpg' /></a> </div>
            <div class="info">
              <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
              <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
            </div>
          </article>
        </div>
        <div class="item all d2015 steps communique">
          <article class="article">
            <div class="img"><span class="picto"></span><a href="article.php"><img src='img/press/actu03.jpg' /></a> </div>
            <div class="info">
              <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
              <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
            </div>
          </article>
        </div>
        <div class="item all d2016 press communique">
          <article class="article">
            <div class="img"><span class="picto"></span><a href="article.php"><img src='img/press/actu05.jpg' /></a> </div>
            <div class="info">
              <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
              <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
            </div>
          </article>
        </div>
        <div class="item all d2013 press communique">
          <article class="article">
            <div class="img"><span class="picto"></span><a href="article.php"><img src='img/press/actu04.jpg' /></a> </div>
            <div class="info">
              <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
              <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
            </div>
          </article>
        </div>
        <div class="item all d2016 audios steps infos">
          <article class="article">
            <div class="img"><span class="picto"></span><a href="article.php"><img src='img/press/actu06.jpg' /></a> </div>
            <div class="info">
              <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
              <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
            </div>
          </article>
        </div>
        <div class="item all d2015 article press infos">
          <article class="article">
            <div class="img"><span class="picto"></span><a href="article.php"><img src='img/press/actu05.jpg' /></a> </div>
            <div class="info">
              <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
              <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
            </div>
          </article>
        </div>
        <div class="item all d2014 article steps infos">
          <article class="article">
            <div class="img"><span class="picto"></span><a href="article.php"><img src='img/press/actu05.jpg' /></a> </div>
            <div class="info">
              <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
              <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
            </div>
          </article>
        </div>
        <div class="item all d2016 audios infos steps">
          <article class="article">
            <div class="img"><span class="picto"></span><a href="article.php"><img src='img/press/actu05.jpg' /></a> </div>
            <div class="info">
              <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
              <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
            </div>
          </article>
        </div>
        <div class="item all d2015 article infos steps">
          <article class="article">
            <div class="img"><span class="picto"></span><a href="article.php"><img src='img/press/actu05.jpg' /></a> </div>
            <div class="info">
              <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
              <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
            </div>
          </article>
        </div>
        <div class="item all d2016 article infos steps">
          <article class="article">
            <div class="img"><span class="picto"></span><a href="article.php"><img src='img/press/actu05.jpg' /></a> </div>
            <div class="info">
              <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
              <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
            </div>
          </article>
        </div>
        <div class="item all d2016 article infos steps">
          <article class="article">
            <div class="img"><span class="picto"></span><a href="article.php"><img src='img/press/actu05.jpg' /></a> </div>
            <div class="info">
              <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
              <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
            </div>
          </article>
        </div>
        <div class="item all d2016 article infos steps">
          <article class="article">
            <div class="img"><span class="picto"></span><a href="article.php"><img src='img/press/actu05.jpg' /></a> </div>
            <div class="info">
              <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
              <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
            </div>
          </article>
        </div>
        <div class="item all d2016 videos infos steps">
          <article class="article">
            <div class="img"><span class="picto"></span><a href="article.php"><img src='img/press/actu05.jpg' /></a> </div>
            <div class="info">
              <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
              <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
            </div>
          </article>
        </div>
        <div class="item all d2016 videos infos steps">
          <article class="article">
            <div class="img"><span class="picto"></span><a href="article.php"><img src='img/press/actu05.jpg' /></a> </div>
            <div class="info">
              <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
              <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
            </div>
          </article>
        </div>
        <div class="item all d201 videos infos steps">
          <article class="article">
            <div class="img"><span class="picto"></span><a href="article.php"><img src='img/press/actu05.jpg' /></a> </div>
            <div class="info">
              <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
              <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
            </div>
          </article>
        </div>
        <div class="item all d2016 article infos steps">
          <article class="article">
           <div class="img"><span class="picto"></span><a href="article.php"><img src='img/press/actu05.jpg' /></a> </div>
            <div class="info">
              <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
              <h2><a href="article.php">Enragés, polar hybride d'Eric Hannezo</a></h2>
            </div>
          </article>
        </div>
      </div>
      <a href="#" class="read-more">Afficher <strong>plus d'articles</strong></a>
      <div class="section" style="background-image:url(img/press/pushactu.jpg)">
          <div class="img"></div>
          <div class="txt vCenter">
            <div class="vCenterKid">
              <h2 class="title">l'actualité à la une</h2>
              <p class="link"><a href="#"><img src="img/svg/arrow-right-gold.svg">suivEZ LA manifestation au jour le jour</a></p>
            </div>
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
