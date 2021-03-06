<!DOCTYPE html>
<html>

  <head>
    <?php include('head.html'); ?>
    <style type="text/css">

    </style>
  </head>

  <body>
    <?php include('header.html'); ?>

    <div id="main" class="list-article palmares-list loading ">
      <div class="bandeau-list">
           <div class="bandeau-list-img bandeau-head vCenter" style="background-image:url(http://dummyimage.com/1920x450/616161/fff&text=+);">
              <div class="vCenterKid">
               <h2 class="title title-list-header">Le Palmarès</h2>
              </div>
           </div>
           <ul class="sub-nav-list">
               <li><a href="palmares_competition.php" class="ajax">Compétition</a></li>
               <li><a href="palmares_uncertainregard.php" class="ajax">Un certain regard</a></li>
               <li><a href="palmares_cinefondation.php" class="active ajax">Cinéfondation</a></li>
               <li><a href="palmares_camerador.php" class="ajax">Caméra d'or</a></li>
               <li><a href="palmares_toutlepalmares.php" class="ajax">Tout le palmarès</a></li>
           </ul>
      </div>
      <div class="container container-list">
        <section class="categorie-items">
            <article style="background-image:url(img/palmares/cover-film-cinefondation1.jpg)">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/palmares/cover-film-cinefondation1.jpg" alt="images films">
                <div class="infos-item-list">
                  <div class="logo-palme-dor-container">
                      <i class="icon icon_palme palme-dor-img"></i>
                      <strong class="palme-dor-text verticalline">Premier prix de la cinéfondation</strong>
                  </div>
                    <h3 class="title-item">Share</h3>
                    <span class="nom-item">Pippa BIANCO</span>
                </div>
               </div>
            </div>
            </article>
            <article style="background-image:url(img/palmares/cover-film-cinefondation2.jpg)">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/palmares/cover-film-cinefondation2.jpg" alt="images films">
                <div class="infos-item-list">
                  <div class="logo-palme-dor-container">
                      <i class="icon icon_palme palme-dor-img"></i>
                      <strong class="palme-dor-text verticalline">Deuxième prix de la cinéfondation</strong>
                  </div>
                    <h3 class="title-item">Locas Perdinas</h3>
                    <span class="nom-item">Ignacio JURICIC MERILLÁN</span>
                </div>
               </div>
            </div>
            </article>
            <article style="background-image:url(img/palmares/hover-film-cinefondation3.jpg)">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/palmares/cover-film-cinefondation3.jpg" alt="images films">
                <div class="infos-item-list">
                  <div class="logo-palme-dor-container">
                      <i class="icon icon_palme palme-dor-img"></i>
                      <strong class="palme-dor-text verticalline">Troisème prix de la cinéfondation</strong>
                  </div>
                    <h3 class="title-item">victor xx</h3>
                    <span class="nom-item">Ian GARRIDO LÓPEZ</span>
                </div>
               </div>
            </div>
            </article>
        </section>
        </div>

      <div class="bandeau-list push-footer vCenter">
           <div class="bandeau-list-img bandeau-list-footer vCenterKid" style="background-image:url(img/films/cover-bandeau-push-cinemaplage.jpg);">
               <h2 class="title title-list-header">Cinéma de la plage</h2>
               <a href="#" class="bandeau-lien"><i class="icon icon_fleche-right"></i>Découvrir la rubrique</a>
           </div>
      </div>
    </div>
    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
