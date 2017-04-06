<!DOCTYPE html>
<html>

  <head>
    <?php include('head.html'); ?>
    <style type="text/css">

    </style>
  </head>

  <body>
    <?php include('header.html'); ?>

    <div id="main" class="list-article palmares-list  loading">
      <div class="bandeau-list">
           <div class="bandeau-list-img bandeau-head vCenter" style="background-image:url(http://dummyimage.com/1920x450/c2c2c2/fff&text=+)">
              <div class="vCenterKid">
               <h2 class="title title-list-header">Le Palmarès</h2>
              </div>
           </div>
           <ul class="sub-nav-list">
               <li><a href="palmares_competition.php" class="ajax">Compétition</a></li>
               <li><a href="palmares_uncertainregard.php" class="ajax">Un certain regard</a></li>
               <li><a href="palmares_cinefondation.php" class="ajax">Cinéfondation</a></li>
               <li><a href="palmares_camerador.php" class="ajax active">Caméra d'or</a></li>
               <li><a href="palmares_toutlepalmares.php" class="ajax">Tout le palmarès</a></li>
           </ul>
      </div>
      <div class="container container-list">
      <div class="camerador">
         <div class="title-list-cat">
                  <h2 class="titre-document">Fondée en 1978, la Caméra d’or consacre chaque année le meilleur premier film issu de la Sélection officielle,
  de <strong>La Semaine de la Critique</strong> et de la <strong>Quinzaine des Réalisateurs</strong> . En 2015, ils sont 26 à concourir pour cette récompense qui sera remise lors de la soirée du Palmarès le dimanche 24 mai.
  La Présidente est l'actrice française Sabine Azéma.</h2>
          </div>
        <div class="contain-winner container-list">
          <section class="categorie-items ">
            <article style="background-image:url(img/palmares/cover-film-camerador.jpg)">
              <div class="bck-hover">
                <div class="contain_item">
                  <img src="img/palmares/cover-film-camerador.jpg" alt="images films">
                  <div class="infos-item-list">
                    <div class="logo-palme-dor-container">
                      <i class="icon icon_palme palme-dor-img"></i>
                      <strong class="palme-dor-text verticalline">Caméra d'or</strong>
                    </div>
                    <h4 class="sub-title-item">En compétition</h4>
                    <h3 class="title-item">La tierra y sombra </h3>
                    <span class="nom-item">César Augusto ACEVEDO</span>
                  </div>
                </div>
              </div>
            </article>
          </section>
        </div>
          <div class="title-list-cat">
              <h2 class="title"> Les films en lice dans la Sélection officielle</h2>
          </div>
          <section class="categorie-items">
          <h3 class="sub-cat-title">En compétition</h3>
             <article style="background-image:url(img/films/cover-film-cdo.jpg)">
              <div class="bck-hover">
                 <div class="contain_item">
                  <img src="img/films/cover-film-cdo.jpg" alt="images films">
                  <div class="infos-item-list">
                      <h3 class="title-item">Saul Fia</h3>
                      <h4 class="sub-title-item">(Le fils de paul)</h4>
                      <span class="nom-item">László NEMES</span>
                      <span class="time-item">1h47</span>
                  </div>
                 </div>
              </div>
              </article>
          </section>
          <section class="categorie-items">
          <h3 class="sub-cat-title">Un certain regard</h3>
             <article style="background-image:url(img/films/cover-film-cdo.jpg)">
              <div class="bck-hover">
                 <div class="contain_item">
                  <img src="img/films/cover-film-cdo1.jpg" alt="images films">
                  <div class="infos-item-list">

                      <h3 class="title-item">Maasan</h3>
                      <span class="nom-item">Neeraj GHAYWAN</span>
                      <span class="time-item">1h43</span>
                  </div>
                 </div>
              </div>
              </article>
          </section>
          <div class="title-list-cat">
                  <h2 class="title"> les films en Lice<br>dans les autres sélections</h2>
          </div>
          <section class='categorie-items-columns'>
            <ul>
              <li><a href="http://www.quinzaine-realisateurs.com/" target="_blank"><img src="./img/palmares/quinzaine.jpg" alt=""></a></li>
              <li><a href="http://www.semainedelacritique.com/" target="_blank"><img src="./img/palmares/semaine-critique.jpg" alt=""></a></li>
            </ul>
          </section>
      </div>
        </div>
      <div class="bandeau-list push-footer vCenter">
           <div class="bandeau-list-img bandeau-list-footer vCenterKid" style="background-image:url(img/films/cover-bandeau1.jpg);">
               <h2 class="title title-list-header">Cannes Classic</h2>
               <a href="#" class="bandeau-lien"><i class="icon icon_fleche-right"></i> Découvrir la rubrique</a>
           </div>
      </div>
    </div>
    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
