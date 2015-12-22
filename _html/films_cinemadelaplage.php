<!DOCTYPE html>
<html>

  <head>
    <?php include('head.html'); ?>
    <style type="text/css">

    </style>
  </head>

  <body>
    <?php include('header.html'); ?>

    <div id="main" class="list-article loading films-list selection-officielle">
      <div class="bandeau-list">
           <div class="bandeau-list-img bandeau-head vCenter" style="background-image:url(http://dummyimage.com/1920x450/d1800/fff&text=+);">
              <div class="vCenterKid">
               <h2 class="title title-list-header">Sélection officielle</h2>
              </div>
           </div>
           <div class="bandeau-list">
            <ul class="sub-nav-list nav-list">
             <li>
               <a href="selectionofficielle_competition.php" class='ajax'>Compétition</a>
             </li>
             <li>
               <a href="selectionofficielle_uncertainregard.php" class="ajax">Un certain regard</a>
             </li>
             <li>
               <a href="selectionofficielle_horscompetition.php" class="ajax">Hors compétition</a>
             </li>
             <li>
               <a href="selectionofficielle_seancespeciales.php" class="ajax">Séances spéciales</a>
             </li>
             <li>
               <a href="selectionofficielle_cinefondation.php" class="ajax">Cinéfondation</a>
             </li>
             <li>
               <a href="selectionofficielle_courtsmetrages.php" class="ajax">Courts métrages</a>
             </li>
             <li>
               <a href="films_invitedhonneur.php" class="ajax">Cannes classics</a>
             </li>
             <li>
               <a href="films_cinemadelaplage.php" class="ajax active">Cinéma de la plage</a>
             </li>
           </ul>
      </div>
      </div>
      <div class="container container-list">
        <section class="categorie-items">
            <div class="title-list-cat">
                <h2 class="titre-document">Les projections du Cinéma de la Plage, qui se jouent chaque soir sous les étoiles, sont ouvertes au public.</h2>
            </div>
            <article style="background-image:url(img/films/cover-film_cdp1.jpg)">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/films/cover-film_cdp1.jpg" alt="images films">
                <div class="infos-item-list">
                    <span class="date-pres-item">Jeudi 14 mai </span><span class="heure-pres-item"> 21h30 </span> 
                    <h3 class="title-item">Le grand blond avec une chaussure noire</h3>
                    <span class="nom-item">Yves ROBERT</span>
                    <span class="date-item">1972 - 1h30</span>
                    <p class="description-item">Restauration 2K présentée par Gaumont. Travaux image effectués par Eclair, son restauré par Diapason en partenariat avec Eclair.</p>
                </div>
               </div>
            </div>
            </article>
            <article style="background-image:url(img/films/cover-film_cdp2.jpg)">
                <div class="bck-hover">
                   <div class="contain_item">
                     <img src="img/films/cover-film_cdp2.jpg" alt="images films">
                    <div class="infos-item-list">
                        <span class="date-pres-item">Vendredi 15 mai </span><span class="heure-pres-item"> 21h30 </span> 
                        <h3 class="title-item">Ran</h3>
                        <span class="nom-item">Akira KUROSAMA</span>
                        <span class="date-item">1985 - 2h42</span>
                        <p class="description-item">Négatif original numérisé en 4K et restauré image par image en 4K par Eclair. Restauration image, étalonnage et restauration son supervisés par STUDIOCANAL en collaboration avec Kadokawa (co-producteur japonais).</p>
                        <p class="description-item">Etalonnage validé par M. Ueda (chef opérateur), collaborateur de Akira Kurosawa sur le tournage du film. </p>
                    </div>
                   </div>
                </div>
            </article>
            <article style="background-image:url(img/films/cover-film_cdp2.jpg)">
                <div class="bck-hover">
                   <div class="contain_item">
                    <img src="img/films/cover-film_cdp3.jpg" alt="images films">
                    <div class="infos-item-list">
                        <span class="date-pres-item">Samedi 16 mai </span><span class="heure-pres-item"> 21h30 </span> 
                        <h3 class="title-item">Hôtel du nord</h3>
                        <span class="nom-item">Marcel CARNÉ</span>
                        <span class="date-item">1938 - 1h35</span>
                        <p class="description-item">Une restauration présentée par MK2 avec le soutien du CNC. Restauration image 2K (d’après un scan 4K du négatif image nitrate) 
faite par Digimage Classics.</p>
                    </div>
                   </div>
                </div>
            </article>
        </section>
      </div>
      <div class="bandeau-list bandeau-list-footer push-footer vCenter">
           <div class="bandeau-list-img vCenterKid" style="background-image:url(img/films/cover-bandeau-push.jpg);">
               <h2 class="title title-list-header">Compétition</h2>
               <a href="selectionofficielle_competition.php" class="bandeau-lien"> <img src="img/svg/arrow-right-gold.svg" alt="Découvrir la rubrique" class="svg-arrow"> Découvrir la rubrique</a>
           </div>
      </div>
    </div>
    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
