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

    <div id="main" class="list-article palmares-list loading ">
      <div class="bandeau-list">
           <div class="bandeau-list-img bandeau-head vCenter" style="background-image:url(http://dummyimage.com/1920x450/cfcfcf/fff&text=+)">
              <div class="vCenterKid">
               <h2 class="title title-list-header">Le Palmarès</h2>
              </div>
           </div>
           <ul class="sub-nav-list">
               <li><a href="palmares_competition.php" class="ajax">Compétition</a></li>
               <li><a href="palmares_uncertainregard.php" class="active ajax" >Un certain regard</a></li>
               <li><a href="palmares_cinefondation.php" class="ajax">Cinéfondation</a></li>
               <li><a href="palmares_camerador.php" class="ajax">Caméra d'or</a></li>
               <li><a href="palmares_toutlepalmares.php" class="ajax">Tout le palmarès</a></li>
           </ul> 
      </div>
      <div class="container container-list">
        <section class="categorie-items">
            <article style="background-image:url(img/palmares/cover-film-uncertainregard1.jpg)">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/palmares/cover-film-uncertainregard1.jpg" alt="images films">
                <div class="infos-item-list">
                  <div class="logo-palme-dor-container">
                      <img src="img/palmares/palmedor-logo.png" alt="palme d or" class="palme-dor-img">
                      <strong class="palme-dor-text verticalline">Prix un certain regard</strong>
                  </div>
                    <h3 class="title-item">HRÚTAR</h3>
                    <h4 class="sub-title-item">(béliers)</h4>
                    <span class="nom-item">Grímur HAKONARSON</span>
                </div>
               </div>
            </div>
            </article>
            <article style="background-image:url(img/palmares/cover-film-uncertainregard3.jpg)">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/palmares/cover-film-uncertainregard3.jpg" alt="images films">
                <div class="infos-item-list">
                  <div class="logo-palme-dor-container">
                      <img src="img/palmares/palmedor-logo.png" alt="palme d or" class="palme-dor-img">
                      <strong class="palme-dor-text verticalline">Prix de la mise en scène un certain regard</strong>
                  </div>
                    <h3 class="title-item">KISHIBE NO TABI</h3>
                    <h4 class="sub-title-item">(vers l’autre rive)</h4>
                    <span class="nom-item">Kiyoshi KUROSAWA </span>
                </div>
               </div>
            </div>
            </article>
            <article style="background-image:url(img/palmares/cover-film-uncertainregard3.jpg)">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/palmares/cover-film-uncertainregard3.jpg" alt="images films">
                <div class="infos-item-list">
                  <div class="logo-palme-dor-container">
                      <img src="img/palmares/palmedor-logo.png" alt="palme d or" class="palme-dor-img">
                      <strong class="palme-dor-text verticalline">Prix de la mise en scène un certain regard</strong>
                  </div>
                    <h3 class="title-item">KISHIBE NO TABI</h3>
                    <h4 class="sub-title-item">(vers l’autre rive)</h4>
                    <span class="nom-item">Kiyoshi KUROSAWA </span>
                </div>
               </div>
            </div>
            </article>
            <article style="background-image:url(img/palmares/cover-film-uncertainregard3.jpg)">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/palmares/cover-film-uncertainregard3.jpg" alt="images films">
                <div class="infos-item-list">
                  <div class="logo-palme-dor-container">
                      <img src="img/palmares/palmedor-logo.png" alt="palme d or" class="palme-dor-img">
                      <strong class="palme-dor-text verticalline">Prix de la mise en scène un certain regard</strong>
                  </div>
                    <h3 class="title-item">KISHIBE NO TABI</h3>
                    <h4 class="sub-title-item">(vers l’autre rive)</h4>
                    <span class="nom-item">Kiyoshi KUROSAWA </span>
                </div>
               </div>
            </div>
            </article>
        </section>
        </div>
      <div class="bandeau-list push-footer vCenter">
           <div class="bandeau-list-img bandeau-list-footer vCenterKid" style="background-image:url(img/films/cover-bandeau-push.jpg);">
               <h2 class="title title-list-header">Camera d'or</h2>
               <a href="#" class="bandeau-lien"> <img src="img/svg/arrow-right-gold.svg" alt="Découvrir la rubrique" class="svg-arrow"> Découvrir la rubrique</a>
           </div>
      </div>
    </div>
    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
