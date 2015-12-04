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

    <div id="main" class="list-article films-list loading cannes-classic selection-officielle">
      <div class="bandeau-list">
           <div class="bandeau-list-img bandeau-head vCenter" style="background-image:url(http://dummyimage.com/1920x450/d19514/fff&text=+);">
              <div class="vCenterKid">
               <h2 class="title title-list-header">Sélection officielle</h2>
              </div>
           </div>
          <ul class="nav-list sub-nav-list">
             <li>
               <a href="selectionofficielle_competition.php" class="ajax">Compétition</a>
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
               <a href="films_invitedhonneur.php" class='ajax active'>Cannes classics</a>
             </li>
             <li>
               <a href="films_cinemadelaplage.php" class="ajax">Cinéma de la plage</a>
             </li>
           </ul>
      </div>
      <div class="container container-list">
      <div class="bandeau-list">
        <ul class="sub-nav-list nav-movie">
          <li><a href="films_invitedhonneur.php" class="ajax">Invité d'honneur</a></li>
          <li><a href="films_hommage.php" class="ajax">Hommages</a></li>
          <li><a href="films_copiesrestaurees.php" class="ajax">Copies restaurées </a></li>
          <li><a href="#" class="ajax">World cinema project</a></li>
          <li><a href="films_documentaires.php" class="ajax active">Documentaires</a></li>
        </ul> 
      </div>
        <section class="categorie-items">
            <div class="title-list-cat">
                <h2 class="titre-document">Dans le cadre de Cannes Classics, seront projetés les documentaires sur le cinéma suivants :</h2>
            </div>
            <article style="background-image:url(img/films/cover-film-documentaire1.jpg)" contenteditable="">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/films/cover-film-documentaire1.jpg" alt="images films">
                <div class="infos-item-list">
                    <h3 class="title-item">Hitchcock / Truffaut</h3>
                    <span class="nom-item">Kent JONES</span>
                    <span class="date-item">2015 - 1h28</span>
                    <p class="description-item">Co-écrit par Kent Jones et Serge Toubiana. Produit par Artline Films,  Cohen Media Group et Arte France. </p>

                </div>
               </div>
            </div>
            </article>
            <article style="background-image:url(img/films/cover-film-documentaire2.jpg)">
                <div class="bck-hover">
                <div class="contain_item">
                    <img src="img/films/cover-film-documentaire2.jpg" alt="images films">
                    <div class="infos-item-list">
                        <h3 class="title-item">Depardieu grandeur nature</h3>
                        <span class="nom-item">Richard Melloul</span>
                        <span class="date-item">2014 - 1h</span>
                        <p class="description-item">Produit par Richard Melloul Productions et Productions Tony Comiti.</p>
                    </div>
                </div>
                </div>
            </article>
           <div class="title-list-cat">
                <h2 class="title">CELEBRATION DES SOIXANTE ANS DE LA 
CREATION DE LA PALME D’OR</h2>

           </div>
            <article style="background-image:url(img/films/cover-film-documentaire3.jpg)">
            <div class="bck-hover">
                <div class="contain_item">
                    <img src="img/films/cover-film-documentaire3.jpg" alt="images films">
                    <div class="infos-item-list">
                        <h3 class="title-item">La légende de la palme d'or</h3>
                        <span class="nom-item">Alexis Veller</span>
                        <span class="date-item">2015 - 1h10</span>
                        <p class="description-item">Produit par AV productions.
                        </p>
                    </div>
                </div> 
                </div>   
            </article>
        </section>
      </div>
      <div class="bandeau-list  bandeau-list-footer push-footer vCenter">
           <div class="bandeau-list-img vCenterKid" style="background-image:url(img/films/cover-bandeau-push.jpg);">
               <h2 class="title title-list-header">Invité d'honneur</h2>
               <a href="films_invitedhonneur.php" class="bandeau-lien"> <img src="img/svg/arrow-right-gold.svg" alt="Découvrir la rubrique" class="svg-arrow"> Découvrir la rubrique</a>
           </div>
      </div>
    </div>
    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
