<!DOCTYPE html>
<html>

  <head>
    <?php include('head.html'); ?>
  </head>

  <body>
    <?php include('header.html'); ?>

    <div id="main" class="press loading seatingchart lock">
      <div class="header-press">
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
    </div>

    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
