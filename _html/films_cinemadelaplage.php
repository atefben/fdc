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
    <link type="text/css" rel="stylesheet" href="http://fast.fonts.net/cssapi/47cc6bed-5912-4140-bc5c-4caa2425b61d.css"/>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic' rel='stylesheet' type='text/css'>
    <link href='css/styles.css' rel="stylesheet">
  <style type="text/css">
        
  </style>
  </head>

  <body>
    <?php include('header.html'); ?>

    <div id="main" class="list-article loading films-list selection-officielle">
      <div class="bandeau-list">
           <div class="bandeau-list-img" style="background-image:url(img/films/selection-officielle/selection-bandeau.jpg);">
               <h2 class="title title-list-header">Selection officielle</h2>
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
                    <span class="nom-item">Yves Robert</span>
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
                        <span class="nom-item">Akira Kurosama</span>
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
                        <span class="nom-item">Marcel Carné</span>
                        <span class="date-item">1938 - 1h35</span>
                        <p class="description-item">Une restauration présentée par MK2 avec le soutien du CNC. Restauration image 2K (d’après un scan 4K du négatif image nitrate) 
faite par Digimage Classics.</p>
                    </div>
                   </div>
                </div>
            </article>
        </section>
      </div>
      <div class="bandeau-list bandeau-list-footer">
           <div class="bandeau-list-img" style="background-image:url(img/films/cover-bandeau-push.jpg);">
               <h2 class="title title-list-header">Compétition</h2>
               <a href="selectionofficielle_competition.php" class="bandeau-lien"> > Découvrir la rubrique</a>
           </div>

      </div>
    </div>
    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
