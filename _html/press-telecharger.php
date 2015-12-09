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

    <div id="main" class="press loading downloading-press lock">
      <div class="header-press">
        <div class="head">
          <span>Espace presse</span>
        </div>
        <div class="container">
          <h2>À télécharger</h2>
          <p>
            <span class="vCenter">
              <span class="vCenterKid">Ces élements visuels sont à usage exclusif de la presse et des médias qui couvrent 
le Festival de Cannes. Aucune utilisation commerciale ou promotionnelle 
de ces visuels n’est autorisée.</span>
            </span>
          </p>
        </div>
      </div>
      <div class="downloading-nav">
        <ul>
         <!-- Don't change ID value --> 
          <li><a href="#affiche-officielle" class="ajax active">Affiche officielle</a></li>
          <li><a href="#signature" class="ajax">signatures</a></li>
          <li><a href="#animation" class="ajax">animation</a></li>
          <li><a href="#photos-institutionnelles" class="ajax">photos institutionnelles</a></li>
          <li><a href="#dossier-presse" class="ajax">dossier de presse</a></li>
        </ul>
      </div>
      <div class="wrapper">
        <div class="affiche" id="affiche-officielle">
          <div class="container">
            <h3 class="title-press">Affiche officielle</h3>
            <div class="portrait">
              <img src="img/press/press-portrait.jpg" alt="" />
              <span class="caption">© FDC / Lagency / Taste (Paris) / Ingrid Bergman © David Seymour / Estate of David Seymour - Magnum Photos</span>
              <p>Format portrait</p>
              <div class="buttons active-btn">
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
        <div class="signature block" id="signature">
          <div class="container">
            <h3 class="title-press">Signatures</h3>
            <div class="imgs-container first">
             <div class="container-img">
              <img src="img/press/downloading/img1.png" alt="">
             </div>
              <span class="caption">© FDC / Théophile Delange</span>
              <div class="infos">
                <h4>Signature blanche</h4>
                <ul>
                  <li>Bannière carrée 400x400 px</li>
                  <li>Bannière horizontale 728x90 px</li>
                  <li>Bannière verticale 160x600 px</li>
                  <li>Bannière verticale 120x600 px</li>
                </ul>
              </div>
              <div class="buttons">
                <a href="#" class=" button">Tout télécharger</a>
              </div>
            </div>
            <div class="imgs-container">
             <div class="container-img">
              <img src="img/press/downloading/image2.jpg" alt="">
            </div>
              <span class="caption">© FDC / Théophile Delange</span>
              <div class="infos">
                <h4>Signature bleu #00B6F1</h4>
                <ul>
                  <li>Bannière carrée 400x400 px</li>
                  <li>Bannière horizontale 728x90 px</li>
                  <li>Bannière verticale 160x600 px</li>
                </ul>
              </div>
              <div class="buttons">
                <a href="#" class=" button">Tout télécharger</a>
              </div>
            </div>
            <div class="imgs-container last">
             <div class="container-img">
              <img src="img/press/downloading/img3.jpg" alt="">
            </div>
              <span class="caption">© FDC / Théophile Delange</span>
              <div class="infos">
                <h4>Signature bleu #00427C</h4>
                <ul>
                  <li>Bannière carrée 400x400 px</li>
                  <li>Bannière horizontale 728x90 px</li>
                  <li>Bannière verticale 160x600 px</li>
                  <li>Bannière verticale 120x600 px</li>
                </ul>
              </div>
              <div class="buttons">
                <a href="#" class=" button">Tout télécharger</a>
              </div>
            </div>
          </div>
        </div>
        <div class="animation block" id='animation'>
          <div class="container">
          <h3 class="title-press">animation</h3>
          <div class="contain-player">
           <div class="player">
            <img src="img/press/downloading/player.jpg" alt="">
           </div>
            <span class="caption">© FDC / Lagency / Taste (Paris) / Ingrid Bergman © David Seymour / Estate of David Seymour - Magnum Photos<br>
Film d'animation avec la collaboration de Sonia Tout Court sur un remix du thème musical du Festival, Le Carnaval des animaux de Camille Saint-Saëns, avec un arrangement imaginé par deux musiciens suédois, Patrik Andersson et Andreas Söderström.</span>
             <div class="buttons">
                <a href="#" class=" mov extention button">.MOV</a>
                <a href="#" class=" gif extention button">.GIF</a>
              </div>
          </div>
          </div>
        </div>
        <div class="photos block slideshow"  id='photos-institutionnelles'>
          <div class="container">
          <div class="container-title">
            <h3 class="title-press">Photos institutionnelles <span class="number">(22)</span></h3>
          <div class="right-btn buttons"><a href="" class="alldl button">Tout télécharger</a></div>
          </div>
          <div class="gridPressDownload grid-wrapper images">
            <div class="grid-sizer"></div>
              <div class="item">
                <a href="img/press/downloading/img-large.jpg" class="chocolat-image ajax" title='<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.</h2><p>Crédit Image : VALERY HACHE / AFP</p>'>
                  <img src="img/press/downloading/im-grid.jpg"  title='<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.</h2><p>Crédit Image : VALERY HACHE / AFP</p>' alt="" class="chocolat-image ajax">
                </a>
              </div>
              <div class="item">
                <a href="img/press/downloading/img-large.jpg" class="chocolat-image ajax" title='<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.</h2><p>Crédit Image : VALERY HACHE / AFP</p>'>
                  <img src="img/press/downloading/im-grid2.png"  title='<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.</h2><p>Crédit Image : VALERY HACHE / AFP</p>' alt="" class="chocolat-image ajax">
                </a>
              </div>
              <div class="item">
                <a href="img/press/downloading/img-large.jpg" class="chocolat-image ajax" title='<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.</h2><p>Crédit Image : VALERY HACHE / AFP</p>'>
                  <img src="img/press/downloading/im-grid3.jpg"  title='<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.</h2><p>Crédit Image : VALERY HACHE / AFP</p>' alt="" class="chocolat-image ajax">
                </a>
              </div>
              <div class="item">
                <a href="img/press/downloading/img-large.jpg" class="chocolat-image ajax" title='<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.</h2><p>Crédit Image : VALERY HACHE / AFP</p>'>
                  <img src="img/press/downloading/im-grid4.jpg"  title='<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.</h2><p>Crédit Image : VALERY HACHE / AFP</p>' alt="" class="chocolat-image ajax">
                </a>
              </div>
              <div class="item">
                <a href="img/press/downloading/img-large.jpg" class="chocolat-image ajax" title='<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.</h2><p>Crédit Image : VALERY HACHE / AFP</p>'>
                  <img src="img/press/downloading/im-grid5.jpg"  title='<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.</h2><p>Crédit Image : VALERY HACHE / AFP</p>' alt="" class="chocolat-image ajax">
                </a>
              </div>
              <div class="item">
                <a href="img/press/downloading/img-large.jpg" class="chocolat-image ajax" title='<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.</h2><p>Crédit Image : VALERY HACHE / AFP</p>'>
                  <img src="img/press/downloading/im-grid6.jpg"  title='<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.</h2><p>Crédit Image : VALERY HACHE / AFP</p>' alt="" class="chocolat-image ajax">
                </a>
              </div>
              <div class="item">
                <a href="img/press/downloading/img-large.jpg" class="chocolat-image ajax" title='<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.</h2><p>Crédit Image : VALERY HACHE / AFP</p>'>
                  <img src="img/press/downloading/im-grid7.jpg"  title='<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.</h2><p>Crédit Image : VALERY HACHE / AFP</p>' alt="" class="chocolat-image ajax">
                </a>
              </div>
              <div class="item">
                <a href="img/press/downloading/img-large.jpg" class="chocolat-image ajax" title='<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.</h2><p>Crédit Image : VALERY HACHE / AFP</p>'>
                  <img src="img/press/downloading/im-grid8.jpg"  title='<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.</h2><p>Crédit Image : VALERY HACHE / AFP</p>' alt="" class="chocolat-image ajax">
                </a>
              </div>
              <div class="item">
                <a href="img/press/downloading/img-large.jpg" class="chocolat-image ajax" title='<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.</h2><p>Crédit Image : VALERY HACHE / AFP</p>'>
                  <img src="img/press/downloading/im-grid9.jpg"  title='<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.</h2><p>Crédit Image : VALERY HACHE / AFP</p>' alt="" class="chocolat-image ajax">
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="dossier block" id='dossier-presse'>
          <div class="container">
          <h3 class="title-press">Dossier de presse</h3>
          <div class="contain-dp">
            <div class="buttons">
              <a href="#" class="button">Dossier de presse</a>
            </div>
            <p class="infos"><strong>Mise à jour : </strong> 19.05.15 . 12:30</p>
          </div>
          <div class="contain-dp">
            <div class="buttons">
              <a href="#" class="button">Liste des attachés de presse</a>
            </div>
            <p class="infos"><strong>Mise à jour : </strong> 19.05.15 . 12:30</p>
          </div>
          <div class="contain-dp">
           <div class="buttons">
              <div class="button large">
                <a href="#" class="download ">Horaire des projections (presse)</a>
              </div>
              <div class="button large">
                <a href="#" class="download ">Horaire des projections (grand public)</a>
              </div>
           </div>
            <p class="infos"><strong>Mise à jour : </strong> 19.05.15 . 12:30</p>
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
    <!-- POPIN -->
    <?php include('popin-lock-press.html'); ?>
    <?php include('popin-download-press.html'); ?>
    <!-- fin POPIN -->
    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
