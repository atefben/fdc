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

    <div id="main" class="press loading seatingchart">
      <div class="header-press">
        <div class="head">
          <span>Espace presse</span>
        </div>
        <h2>Plan des salles</h2>
      </div>
      <div id='seatingchart'>
        <div class="nav-map">
          <ul>
            <li data-maps="theatre-lumiere">Grand théatre lumière</li>
            <li data-maps="salle-debussy">Salle debussy</li>
            <li data-maps="salle-60e">Salle du 60E</li>
            <li data-maps="salle-bunuel">Salle buñuel</li>
            <li data-maps="salle-bazin">Salle bazin</li>
            <li data-maps="salle-presse">Salle de presse</li>
            <li data-maps="salle-mace">Place macé</li>
            <li data-maps="zone-festival" id='more-map'>
              <strong>La zone festival</strong>
              <img src="img/press/seating-chart/festival-map.png" alt="">
            </li>
          </ul>
        </div>
        <div class="maps">
         <span id="default" class="active"><img src="./img/press/seating-chart/default-map.jpg" alt=""></span>
          <span id='theatre-lumiere'><img src="./img/press/seating-chart/theatre-lumiere.jpg" alt=""></span>
          <span id='salle-debussy'><img src="./img/press/seating-chart/theatre-lumiere.jpg" alt=""></span>
          <span id='salle-60e'><img src="./img/press/seating-chart/theatre-lumiere.jpg" alt=""></span>
          <span id='salle-bunuel'><img src="./img/press/seating-chart/theatre-lumiere.jpg" alt=""></span>
          <span id='salle-bazin'><img src="./img/press/seating-chart/theatre-lumiere.jpg" alt=""></span>
          <span id='salle-presse'><img src="./img/press/seating-chart/theatre-lumiere.jpg" alt=""></span>
          <span id='salle-mace'><img src="./img/press/seating-chart/theatre-lumiere.jpg" alt=""></span>
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
