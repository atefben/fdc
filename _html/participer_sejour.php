<!DOCTYPE html>
<html>

<head>
  <?php include('head.html'); ?>
  <style type="text/css">

  </style>
</head>

<body>
  <?php include('header.html'); ?>

    <div id="main" class="list-article participate loading">
      <div class="bandeau-list vCenter">
        <div class="bandeau-list-img vCenterKid" style="background-image:url(img/participate/bandeau.jpg)">
          <h2 class="title title-list-header"> <img src="img/svg/palme-white.svg" alt="" class="logo palm"> <br> Préparer son séjour</h2>
        </div>
      </div>
      <div class="contain-participate ">
        <div class="contain-descript">
          <p class="descrip">
            Toute l’équipe du Festival de Cannes est heureuse de vous accueillir pour cette 68e édition. Pour que votre séjour se passe dans les meilleures conditions, voici quelques informations utiles.
          </p>
        </div>
        <section>
          <div class="contain-section participate-active">
            <h3 class="title-participate"> <img src="img/participate/se-rendre-a-cannes.svg" alt="" class="svg">Se rendre à cannes</h3><i class="fa fa-minus svg"></i>
            <div class="item large">
              <img src="img/participate/train.svg" alt="" class="svg-item">
              <strong class="transport">Train</strong>
              <span class="time">5h de TGV depuis Paris</span>
              <a href="#" class="btn"><img src="img/participate/plus.svg" alt="" class="svg">En savoir plus</a>
            </div>
            <div class="item large">
              <img src="img/participate/voiture.svg" alt="" class="svg-item">
              <strong class="transport">Voiture</strong>
              <span class="time">8h30 de route depuis Paris</span>
              <a href="#" class="btn"><img src="img/participate/plus.svg" alt="" class="svg">En savoir plus</a>
            </div>
            <div class="item">
              <img src="img/participate/avion.svg" alt="" class="svg-item">
              <strong class="transport">AVION</strong>
              <span class="time">Départ de l'aéroport de Nice</span>
              <a href="#" class="btn"><img src="img/participate/plus.svg" alt="" class="svg">En savoir plus</a>
            </div>
            <div class="item">
              <img src="img/participate/bus.svg" alt="" class="svg-item">
              <strong class="transport">Bus</strong>
              <span class="info"><a href="#">La ligne express 210</a> (bus rapide Côte d'Azur) assure, en 50 minutes, la liaison entre l'Aéroport de Nice (Terminal 1) et l'Hôtel de Ville de Cannes.</span>
              <span class="info"><strong>Tarifs :</strong> Trajet simple: <span class="price">20€</span> | Aller-Retour : <span class="price">30€</span></span>
            </div>
            <div class="item">
              <img src="img/participate/taxi.svg" alt="" class="svg-item">
              <strong class="transport">Taxi</strong>
              <span class="info"><a href="#">Taxi Cannes :</a> 33 (0) 4 93 99 27 27</span>
              <span class="info"><strong>Tarifs :</strong> Trajet simple: <span class="price">20€</span> | Aller-Retour : <span class="price">30€</span></span>
            </div>
          </div>
        </section>
        <section>
          <div class="contain-section">
            <h3 class="title-participate"> <img src="img/participate/plan.svg" alt="" class="svg">Plans</h3><i class="fa fa-plus"></i>
            <h4 class="descrip-participate">Gardez le Cap ! Téléchargez ici les cartes et les plans pour vous repérer à Cannes et dans le périmètre du Festival.</h4>
            <div class="contain-map">
              <strong class="name">Le festival de cannes</strong>
              <img src="img/participate/map.png" alt="" class="map">
              <a href="" class="btn telecharger"><img src="img/participate/telecharger.svg" alt="" class="svg">Télécharger</a>
              <div class="link"><img src="img/participate/plan.svg" alt="" class="svg"><a href="#">Se repérer sur Google Maps</a></div>
            </div>
            <div class="contain-map">
              <strong class="name">La zone festival</strong>
              <img src="img/participate/map2.png" alt="" class="map">
              <a href="" class="btn telecharger"><img src="img/participate/telecharger.svg" alt="" class="svg">Télécharger</a>
              <div class="link"><img src="img/participate/plan.svg" alt="" class="svg"><a href="#">Se repérer sur Google Maps</a></div>
            </div>
            <div class="contain-map">
              <strong class="name">Le palais</strong>
              <img src="img/participate/map3.png" alt="" class="map">
              <a href="" class="btn telecharger"><img src="img/participate/telecharger.svg" alt="" class="svg">Télécharger</a>
              <div class="link"><img src="img/participate/plan.svg" alt="" class="svg"><a href="#">Se repérer sur Google Maps</a></div>
            </div>
          </div>
        </section>
        <section>
          <div class="contain-section">
            <h3 class="title-participate"> <img src="img/participate/hebergement.svg" alt="" class="svg">Hébergement</h3><i class="fa fa-plus"></i>
            <div class="descrip-section">
              <p class="ask">Vous êtes à la recherche d'un hébergement ?</p>
              <a href="#">Consultez la liste des Hôtels Partenaires du Festival de Cannes</a>
            </div>
            <div id="google-map">
            </div>
          </div>
        </section>
        <section>
          <div class="contain-section">
            <h3 class="title-participate part-plus-info"> <img src="img/participate/informations.svg" alt="" class="svg plus-info">Pour plus d'informations</h3><i class="fa fa-plus"></i>
            <div class="descrip-section">
              <p class="text">Si vous souhaitez des information complémentaires sur la ville de Cannes, nous vous invitons à consulter
                <br> les pages de <a href="#">l'office du tourisme de la ville de Cannes</a> et de <a href="#">la mairie de la ville de Cannes.</a></p>
            </div>
          </div> 
        </section>
      </div>
  </div>
      <?php include('footer.html'); ?>

        <!-- //// SCRIPTS \\\\ -->

        <?php include('scripts.inc.php'); ?>
          <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
</body>

</html>