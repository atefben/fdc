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
    <link href='css/styles.css' rel="stylesheet">
  <style type="text/css">
        
  </style>
  </head>

  <body>
    <?php include('header.html'); ?>

    <div id="main" class="list-article palmares-list">
      <div class="bandeau-list">
           <div class="bandeau-list-img" style="background-image:url(img/palmares/cover-bandeau-palmares.jpg);background-size: cover;">
               <h2 class="title title-list-header">Le Palmares</h2>
           </div>
           <ul class="sub-nav-list">
               <li><a href="palmares_competition.php" class="active">Compétition</a></li>
               <li><a href="palmares_uncertainregard.php" >Un certain regard</a></li>
               <li><a href="palmares_cinefondation.php">Cinéfondation</a></li>
               <li><a href="palmares_camerador.php">Caméra d'or</a></li>
               <li><a href="palmares_toutlepalmares.php">Tout le palmarès</a></li>
           </ul>  
      </div>
      <div class="container container-list">
        <section class="categorie-items">
            <div class="title-list-cat">
                <h2 class="title">Long métrages</h2>
            </div>
            <article style="background-image:url()">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/palmares/cover-film-compet1.jpg" alt="images films">
                <div class="infos-item-list">
                  <div class="logo-palme-dor-container">
                      <img src="img/palmares/palmedor-logo.png" alt="palme d or" class="palme-dor-img">
                      <strong class="palme-dor-text verticalline">Palme d'or</strong>
                  </div>
                    <h3 class="title-item">Dheepan</h3>
                    <span class="nom-item">Jacques AUDIARD</span>
                </div>
               </div>
            </div>
            </article>
            <article style="background-image:url()">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/films/cover-film-cdo.jpg" alt="images films">
                <div class="infos-item-list">
                  <div class="logo-palme-dor-container">
                      <img src="img/palmares/palmedor-logo.png" alt="palme d or" class="palme-dor-img">
                      <strong class="palme-dor-text verticalline">Grand prix</strong>
                  </div>
                    <h3 class="title-item">Saul Fia</h3>
                    <h4 class="sub-title-item">(Le fils de paul)</h4>
                    <span class="nom-item">László NEMES</span>
                </div>
               </div>
            </div>
            </article>
            <article style="background-image:url(img/palmares/hover-film-compet3.jpg)">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/palmares/cover-film-compet3.jpg" alt="images films">
                <div class="infos-item-list">
                  <div class="logo-palme-dor-container">
                      <img src="img/palmares/palmedor-logo.png" alt="palme d or" class="palme-dor-img">
                      <strong class="palme-dor-text verticalline">Prix de la mise en scène</strong>
                  </div>
                    <h3 class="title-item">Nie Yinniang</h3>
                    <span class="nom-item">HOU Hsiao-Hsien</span>
                </div>
               </div>
            </div>
            </article>
            <article style="background-image:url()">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/palmares/cover-film-compet4.jpg" alt="images films">
                <div class="infos-item-list lot-item">
                  <div class="logo-palme-dor-container">
                    <img src="img/palmares/palmedor-logo.png" alt="palme d or" class="palme-dor-img">
                    <strong class="palme-dor-text verticalline">Prix d'interprétation féminine ex-aequo</strong>
                    <img src="img/palmares/palmedor-compet-portait.jpg" alt="palme d or" class="palme-dor-portrait">
                    <h3 class="title-item">Emmanuelle bercot</h3>
                    <span class="nom-item verticalline">Actrice</span>
                    <h3 class="title-item">Chronique</h3>
                    <span class="nom-item">Maïwenn</span>
                  </div>
                </div>
               </div>
            </div>
            </article>
        </section>
        <section class="categorie-items">
            <div class="title-list-cat">
                <h2 class="title">Court métrages</h2>
            </div>
            <article style="background-image:url()">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/palmares/cover-film-compet5.jpg" alt="images films">
                <div class="infos-item-list">
                  <div class="logo-palme-dor-container">
                      <img src="img/palmares/palmedor-logo.png" alt="palme d or" class="palme-dor-img">
                      <strong class="palme-dor-text verticalline">Palme d'or du court métrage</strong>
                  </div>
                    <h3 class="title-item">Waves '98</h3>
                    <span class="nom-item">Ely DAGHER</span>
                </div>
               </div>
            </div>
            </article>
          </section>    
        </div>

      <div class="bandeau-list">
           <div class="bandeau-list-img" style="background-image:url(img/films/cover-bandeau1.jpg);">
               <h2 class="title title-list-header">Cannes classics</h2>
               <a href="#" class="bandeau-lien"> > Découvrir la rubrique</a>
           </div>

      </div>
    </div>
    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <script src="js/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="js/bower_components/owl.carousel/src/js/owl.carousel.js"></script>
    <script src="js/bower_components/chocolat/src/js/jquery.chocolat.js"></script>
    <script src="js/bower_components/wavesurfer.js/dist/wavesurfer.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
