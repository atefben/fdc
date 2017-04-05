<!DOCTYPE html>
<html>

  <head>
    <?php include('head.html'); ?>
  </head>

  <body>
    <?php include('header.html'); ?>

    <div id="main" class="press loading fullcalendar">
      <div class="header-press">
        <div class="container">
          <h2>Mon agenda</h2>
          <div class="buttons">
            <a href="#" class="button create"><i class="icon icon_creer"></i>Créer un évènement</a>
            <a href="#" class="button export subnav"><i class="icon icon_telecharger"></i>Exporter mon agenda</a>
            <a href="#" class="button list"><i class="icon icon_telecharger"></i>
Télécharger au format .pdf</a>
            <a href="#" class="button list"><i class="icon icon_telecharger"></i>
Télécharger au format .ics</a>
          </div>
        </div>
      </div>
      <div id='calendar' class="fullwidth">
        <div id="mycalendar"></div>
      </div>
    <!-- POPIN CREATE EVENT -->
    <div id="create-event-pop">
       <div class="contain-btn">
         <span class="btn-close"><i class="icon icon_close"></i></span>
       </div>
      <div class="container">
        <h3>Créer un évènement</h3>
        <p>Complétez votre agenda interactif en ajoutant un évènement personnalisé.</p>
        <form action="#" id="form_data">
          <label for="title">Titre</label>
          <input type="text" name="title">
          <div class="time first">
            <label for="begin">Début</label>
            <input type="text" value="07/11/2015" id="datepickerBegin" name="datebegin"><span class="pictodate"><i class="icon icon_programmation"></i></span><input type="text" class="hours" value="15h30" name="hoursbegin">
          </div>
           <div class="time">
            <label for="end">Fin</label>
            <input type="text"  value="14/11/2015" id="datepickerEnd" name="dateend"><span class="pictodate"><i class="icon icon_programmation"></i></span><input type="text" value="15h30" class="hours" name="hoursend">
           </div>
          <label for="place">Lieu</label>
          <input type="text" name="place">
          <label for="description" class='description'>Description</label>
          <input type="text" name="description">
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
