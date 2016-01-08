<!DOCTYPE html>
<html>

<head>
  <?php include('head.html'); ?>
</head>

<body>
  <?php include('header.html'); ?>

    <div id="main" class="list-article participate loading">
      <div class="bandeau-list vCenter">
        <div class="bandeau-list-img vCenterKid" style="background-image:url(img/participate/bandeau.jpg)">
          <h2 class="title title-list-header"> <i class="icon icon_palme"></i><br> Préparer son séjour</h2>
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
            <h3 class="title-participate"><i class="icon icon_se-rendre-a-cannes"></i>Se rendre à cannes</h3><i class="icon icon_moins accordion"></i>
            <div class="item large">
              <i class="icon icon_train"></i>
              <strong class="transport">Train</strong>
              <span class="time">5h de TGV depuis Paris</span>
              <a href="#" class="btn"><i class="icon icon_creer"></i>En savoir plus</a>
            </div>
            <div class="item large">
              <i class="icon icon_voiture"></i>
              <strong class="transport">Voiture</strong>
              <span class="time">8h30 de route depuis Paris</span>
              <a href="#" class="btn"><i class="icon icon_creer"></i>En savoir plus</a>
            </div>
            <div class="item">
              <i class="icon icon_avion"></i>
              <strong class="transport">AVION</strong>
              <span class="time">Départ de l'aéroport de Nice</span>
              <a href="#" class="btn"><i class="icon icon_creer"></i>En savoir plus</a>
            </div>
            <div class="item">
              <i class="icon icon_bus"></i>
              <strong class="transport">Bus</strong>
              <span class="info"><a href="#">La ligne express 210</a> (bus rapide Côte d'Azur) assure, en 50 minutes, la liaison entre l'Aéroport de Nice (Terminal 1) et l'Hôtel de Ville de Cannes.</span>
              <span class="info"><strong>Tarifs :</strong> Trajet simple: <span class="price">20€</span> | Aller-Retour : <span class="price">30€</span></span>
            </div>
            <div class="item">
              <i class="icon icon_taxi"></i>
              <strong class="transport">Taxi</strong>
              <span class="info"><a href="#">Taxi Cannes :</a> 33 (0) 4 93 99 27 27</span>
              <span class="info"><strong>Tarifs :</strong> Trajet simple: <span class="price">20€</span> | Aller-Retour : <span class="price">30€</span></span>
            </div>
          </div>
        </section>
        <section>
          <div class="contain-section">
            <h3 class="title-participate"><i class="icon icon_a-votre-service"></i>Plans</h3><i class="icon icon_case-plus accordion"></i>
            <h4 class="descrip-participate">Gardez le Cap ! Téléchargez ici les cartes et les plans pour vous repérer à Cannes et dans le périmètre du Festival.</h4>
            <div class="contain-map">
              <strong class="name">Le festival de cannes</strong>
              <img src="img/participate/map.png" alt="" class="map">
              <a href="" class="btn telecharger"><i class="icon icon_telecharger"></i>Télécharger</a>
              <div class="link"><i class="icon icon_a-votre-service"></i><a href="#">Se repérer sur Google Maps</a></div>
            </div>
            <div class="contain-map">
              <strong class="name">La zone festival</strong>
              <img src="img/participate/map2.png" alt="" class="map">
              <a href="" class="btn telecharger"><i class="icon icon_telecharger"></i>Télécharger</a>
              <div class="link"><i class="icon icon_a-votre-service"></i><a href="#">Se repérer sur Google Maps</a></div>
            </div>
            <div class="contain-map">
              <strong class="name">Le palais</strong>
              <img src="img/participate/map3.png" alt="" class="map">
              <a href="" class="btn telecharger"><i class="icon icon_telecharger"></i>Télécharger</a>
              <div class="link"><i class="icon icon_a-votre-service"></i><a href="#">Se repérer sur Google Maps</a></div>
            </div>
          </div>
        </section>
        <section>
          <div class="contain-section">
            <h3 class="title-participate"><i class="icon icon_hebergement"></i>Hébergement</h3><i class="icon icon_case-plus accordion"></i>
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
            <h3 class="title-participate part-plus-info"><i class="icon icon_informations"></i>
Pour plus d'informations</h3><i class="icon icon_case-plus accordion"></i>
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
