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

    <div id="main" class="press press-programmation loading calendar-open">
      <div class="header-press">
        <div class="head">
          <span>Espace presse</span>
        </div>
        <div class="container">
          <h2>Programmation</h2>
          <div class="buttons">
            <a href="#" class="button">Télécharger l'horaire des projections presse</a>
          </div>
        </div>
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
          <div id="calendar-wrapper">
            <h2 class="title-calendar">mon agenda</h2>
            <div id="mycalendar" class="side"></div>
            <p class="link"><a href="#"><img src="img/svg/arrow-right-gold.svg" />tout mon agenda</a></p>
            <div class="drag">
              <h2>Préparez votre séjour au festival de cannes</h2>
              <img src="img/press/drag.png" alt="" />
              <p><strong>Cliquez - déposez</strong> les évènements dans votre agenda puis exportez votre programme</p>
              <a href="#">OK</a>
            </div>
          </div>
        </div>
        <div class="programmation">
          <div id="calendar-programmation">
            <div id="timeline">
              <a href="#" data-date="22" class="disabled">dim<span class="day">22</span></a>
              <a href="#" data-date="21" class="disabled">sam<span class="day">21</span></a>
              <a href="#" data-date="20" class="disabled">ven<span class="day">20</span></a>
              <a href="#" data-date="19" class="disabled">jeu<span class="day">19</span></a>
              <a href="#" data-date="18" class="disabled">mer<span class="day">18</span></a>
              <a href="#" data-date="17" class="disabled">mar<span class="day">17</span></a>
              <a href="#" data-date="16" class="disabled">lun<span class="day">16</span></a>
              <a href="#" data-date="15" class="disabled">dim<span class="day">15</span></a>
              <a href="#" data-date="14" class="disabled">sam<span class="day">14</span></a>
              <a href="#" data-date="13" class="disabled">ven<span class="day">13</span></a>
              <a href="#" data-date="12" class="active" data-date="2016-05-12">jeu<span class="day">12</span></a>
              <a href="#" data-date="11" class="" data-date="2016-05-11">mer<span class="day">11</span></a>
            </div>
            <div class="calendar">
              <div class="timeCol">
                <div class="empty"></div>
                <div class="time">08H</div>
                <div class="time">09H</div>
                <div class="time">10H</div>
                <div class="time">11H</div>
                <div class="time">12H</div>
                <div class="time">13H</div>
                <div class="time">14H</div>
                <div class="time">15H</div>
                <div class="time">16H</div>
                <div class="time">17H</div>
                <div class="time">18H</div>
              </div>
              <div class="venues">
                <a href="#" class="nav prev"></a>
                <a href="#" class="nav next"></a>
                <div class="v-wrapper">
                  <div class="venue">
                    <div class="v-head">Grand Théâtre Lumière</div>
                    <div class="v-container">
                      <div class="fc-event" data-url="eventPopin.html" data-id="3" data-picto='.pen' data-color='#000' data-start="2016-05-12T09:00:00" data-end="2016-05-12T11:00:00" data-time="9" data-duration="120">
                        <span class="category">séance de reprise</span>
                        <div class="info">
                          <img src="http://dummyimage.com/46x64/000/fff" />
                          <div class="txt"><span>orson welles, autopsie d’une légende</span><strong>Elisabet KAPNIST</strong></div>
                        </div>
                        <div class="bottom"><span class="duration">2H</span> - <span class="ven">GRAND THÉÂTRE LUMIÈRE</span><span class="competition">Hors compétition</span></div>
                      </div>
                    </div>
                  </div>
                  <div class="venue">
                    <div class="v-head">Salle Debussy</div>
                    <div class="v-container"></div>
                  </div>
                  <div class="venue">
                    <div class="v-head">Salle du 60e</div>
                    <div class="v-container"></div>
                  </div>
                  <div class="venue">
                    <div class="v-head">Salle Buñuel</div>
                    <div class="v-container">
                      <div class="fc-event" data-url="eventPopin.html" data-id="5" data-picto='.pen' data-color='#000' data-start="2016-05-12T15:00:00" data-end="2016-05-12T16:00:00" data-time="15" data-duration="60">
                        <span class="category">séance de reprise</span>
                        <div class="info">
                          <img src="http://dummyimage.com/46x64/000/fff" />
                          <div class="txt"><span>mad max, fury road</span><strong>Elisabet KAPNIST</strong></div>
                        </div>
                        <div class="bottom"><span class="duration">1H</span> - <span class="ven">GRAND THÉÂTRE LUMIÈRE</span><span class="competition">Hors compétition</span></div>
                      </div>
                    </div>
                  </div>
                  <div class="venue">
                    <div class="v-head">Salle Buñuel</div>
                    <div class="v-container"></div>
                  </div>
                  <div class="venue">
                    <div class="v-head">Salle Buñuel</div>
                    <div class="v-container"></div>
                  </div>
                  <div class="venue">
                    <div class="v-head">Salle Buñuel</div>
                    <div class="v-container"></div>
                  </div>
                </div>
              </div>
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
