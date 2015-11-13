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

    <div id="main" class="list-article palmares-list loading">
      <div class="bandeau-list">
           <div class="bandeau-list-img" style="background-image:url(img/palmares/cover-bandeau-palmares.jpg);background-size: cover;">
               <h2 class="title title-list-header">Le Palmarès</h2>
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
                      <img src="img/palmares/palmedor-logo.png" alt="palme d or" class="palme-dor-img">
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
                      <img src="img/palmares/palmedor-logo.png" alt="palme d or" class="palme-dor-img">
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
                      <img src="img/palmares/palmedor-logo.png" alt="palme d or" class="palme-dor-img">
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

      <div class="bandeau-list">
           <div class="bandeau-list-img" style="background-image:url(img/films/cover-bandeau-push-cinemaplage.jpg);">
               <h2 class="title title-list-header">Cinéma de la plage</h2>
               <a href="#" class="bandeau-lien"> <img src="img/svg/arrow-right-gold.svg" alt="Découvrir la rubrique" class="svg-arrow"> Découvrir la rubrique</a>
           </div>

      </div>
    </div>
    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
