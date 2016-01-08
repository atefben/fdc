<!DOCTYPE html>
<html>

  <head>
    <?php include('head.html'); ?>
  </head>

  <body>
    <?php include('header-press.html'); ?>

    <div id="main" class="press loading fullcalendar">
      <div class="header-press">
        <div class="head">
          <span><i class="icon icon_espace-presse"></i> Espace presse</span>
        </div>
        <div class="container">
          <h2>Mon agenda</h2>
          <div class="buttons">
            <a href="#" class="button create"><i class="icon icon_creer"></i>Créer un évènement</a>
            <a href="#" class="button export"><i class="icon icon_telecharger"></i>Exporter mon agenda</a>
          </div>
        </div>
      </div>
      <div id='calendar' class="fullwidth">
        <div id="mycalendar"></div>
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
    <!-- POPIN CREATE EVENT -->
    <div id="create-event-pop">
       <div class="contain-btn">
         <span class="btn-close"></span>
       </div>
      <div class="container">
        <h3>Créer un évènement</h3>
        <p>Complétez votre agenda interactif en ajoutant un évènement personnalisé.</p>
        <form action="#">
          <label for="title">Titre</label>
          <input type="text">
          <div class="time first">
            <label for="begin">Début</label>
            <input type="text" value="07/11/2015"><span class="pictodate"></span><input type="text" class="hours" value="15h30">
          </div>
           <div class="time">
            <label for="end">Fin</label>
            <input type="text"  value="14/11/2015"><span class="pictodate"></span><input type="text" value="15h30" class="hours">
           </div>
          <label for="place">Lieu</label>
          <input type="text">
          <label for="description" class='description'>Description</label>
          <input type="text">
          <input type="submit" value="créer un évènement" class="button">
        </form>
      </div>
    </div>
    <!-- FIN POPIN -->
    </div>

    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
