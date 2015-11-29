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

    <div id="main" class="list-article palmares-list camerador loading">
      <div class="bandeau-list">
           <div class="bandeau-list-img" style="background-image:url(img/palmares/cover-bandeau-palmares.jpg);background-size: cover;">
               <h2 class="title title-list-header">Le Palmarès</h2>
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
       <div class="title-list-cat">
                <h2 class="titre-document">Fondée en 1978, la Caméra d’or consacre chaque année le meilleur premier film issu de la Sélection officielle,
de <strong>La Semaine de la Critique</strong> et de la <strong>Quinzaine des Réalisateurs</strong> . En 2015, ils sont 26 à concourir pour cette récompense qui sera remise lors de la soirée du Palmarès le dimanche 24 mai.
La Présidente est l'actrice française Sabine Azéma.</h2>
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
      <div class="bandeau-list">
           <div class="bandeau-list-img" style="background-image:url(img/films/cover-bandeau1.jpg);">
               <h2 class="title title-list-header">Cannes Classic</h2>
               <a href="#" class="bandeau-lien"> <img src="img/svg/arrow-right-gold.svg" alt="Découvrir la rubrique" class="svg-arrow"> Découvrir la rubrique</a>
           </div>

      </div>
    </div>
    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
