<!DOCTYPE html>
<html>

  <head>
    <?php include('head.html'); ?>
  </head>

  <body>
    <?php include('header.html'); ?>

    <div id="main" class="press loading seatingchart lock">
      <div class="header-press">
        <div class="head">
          <span>Espace presse</span>
        </div>
        <div class="container">
          <h2>Plan des salles</h2>
        </div>
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
              <img src="img/press/seating-chart/festival-map.png" alt="" data-image="theatre" class="visible first">
              <img src="img/press/seating-chart/festival-map.png" alt="" data-image="theatre-lumiere" class="">
              <img src="http://dummyimage.com/197x142/f5bc00/ffffff" alt="" data-image="salle-debussy">
              <img src="http://dummyimage.com/197x142/f4b350/ffffff" alt="" data-image="salle-60e">
              <img src="http://dummyimage.com/197x142/F39C12/ffffff" alt="" data-image="salle-bunuel">
              <img src="http://dummyimage.com/197x142/F5AB35/ffffff" alt="" data-image="salle-bazin">
              <img src="http://dummyimage.com/197x142/F39C12/ffffff" alt="" data-image="salle-presse">
              <img src="http://dummyimage.com/197x142/E67E22/ffffff" alt="" data-image="salle-mace">
            </li>
          </ul>
        </div>
        <div class="maps">
         <span id="default" class="first active"><img src="./img/press/seating-chart/default-map.jpg" alt=""></span>
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
