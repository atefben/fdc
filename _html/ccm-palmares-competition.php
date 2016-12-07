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
           <div class="bandeau-list-img bandeau-head vCenter" style="background-image:url(img/palmares/cover-bandeau-palmares.jpg)">
              <div class="vCenterKid">
               <h2 class="title title-list-header ">Le Palmarès</h2>
              </div>
           </div>
           <ul class="sub-nav-list">
               <li><a href="palmares_competition.php" class="active ajax">Compétition</a></li>
               <li><a href="palmares_uncertainregard.php" class="ajax">Un certain regard</a></li>
               <li><a href="palmares_cinefondation.php" class="ajax">Cinéfondation</a></li>
               <li><a href="palmares_camerador.php" class="ajax">Caméra d'or</a></li>
               <li><a href="palmares_toutlepalmares.php" class="ajax">Tout le palmarès</a></li>
           </ul>
      </div>
      <div class="container container-list">
        <section class="categorie-items">
            <div class="title-list-cat">
                <h2 class="title">Courts métrages</h2>
            </div>
              <article style="background-image:url(img/palmares/cover-film-compet1.jpg)">
            <div class="bck-hover">
               <div class="contain_item">
                <a href=""><img src="img/palmares/cover-film-compet1.jpg" alt="images films"></a>
                
                <div class="infos-item-list">
                  <div class="logo-palme-dor-container">
                      <i class="icon icon_palme palme-dor-img"></i>
                      <strong class="palme-dor-text verticalline">Palme d'or</strong>
                  </div>
                  <a href="">
                    <h3 class="title-item">Dheepan</h3>
                    <h4 class="sub-title-item">(Le fils de paul)</h4>
                    <span class="nom-item">Jacques AUDIARD, Jacques AUDIARD, Jacques AUDIARD</span>
                   </a>
                </div>
               </div>
            </div>
            </article>
            <article style="background-image:url(img/films/cover-film-cdo.jpg)">
            <div class="bck-hover">
               <div class="contain_item">
                <a href=""><img src="img/films/cover-film-cdo.jpg" alt="images films"></a>
                <div class="infos-item-list">
                  <div class="logo-palme-dor-container">
                      <i class="icon icon_palme palme-dor-img"></i>
                      <strong class="palme-dor-text verticalline">Grand prix</strong>
                  </div>
                    <a href="">
                      <h3 class="title-item">Saul Fia</h3>
                      <h4 class="sub-title-item">(Le fils de paul)</h4>
                      <span class="nom-item">László NEMES</span>
                    </a>
                </div>
               </div>
            </div>
            </article>
            <article style="background-image:url(img/palmares/cover-film-compet3.jpg)">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/palmares/cover-film-compet3.jpg" alt="images films">
                <div class="infos-item-list">
                  <div class="logo-palme-dor-container">
                      <i class="icon icon_palme palme-dor-img"></i>
                      <strong class="palme-dor-text verticalline">Prix de la mise en scène</strong>
                  </div>
                    <h3 class="title-item">Nie Yinniang</h3>
                    <span class="nom-item">HOU Hsiao-Hsien</span>
                </div>
               </div>
            </div>
            </article>
            <article style="background-image:url(img/palmares/cover-film-compet4.jpg)">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/palmares/cover-film-compet4.jpg" alt="images films">
                <div class="infos-item-list lot-item">
                  <div class="logo-palme-dor-container">
                    <i class="icon icon_palme palme-dor-img"></i>
                    <strong class="palme-dor-text verticalline">Prix d'interprétation féminine ex-aequo</strong>
                    <!--<img src="img/palmares/palmedor-compet-portait.jpg" alt="palme d or" class="palme-dor-portrait">-->
                    <a href=""><h3 class="title-item verticalline">Emmanuelle bercot</h3></a>
                    <h3 class="title-item">Mon roi</h3>
                    <span class="nom-item">Maïwenn</span>
                  </div>
                </div>
               </div>
            </div>
            </article>
        </section>
        <section class="categorie-items">
            <!--<div class="title-list-cat">
                <h2 class="title">Courts métrages</h2>
            </div>-->
            <article style="background-image:url(img/palmares/cover-film-compet5.jpg)">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/palmares/cover-film-compet5.jpg" alt="images films">
                <div class="infos-item-list">
                  <div class="logo-palme-dor-container">
                      <i class="icon icon_palme palme-dor-img"></i>
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

      <div class="bandeau-list push-footer vCenter">
           <div class="bandeau-list-img bandeau-list-footer vCenterKid" style="background-image:url(img/films/cover-bandeau1.jpg);">
               <h2 class="title title-list-header">Cannes classics</h2>
               <a href="#" class="bandeau-lien"><i class="icon icon_fleche-right"></i>Découvrir la rubrique</a>
           </div>
      </div>
    </div>

    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
