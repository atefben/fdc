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

    <div id="main" class="list-article">
      <div class="bandeau-list">
           <div class="bandeau-list-img" style="background-image:url(img/films/cover-bandeau1.jpg);background-size: cover;">
               <h2 class="title title-list-header">Cannes classics</h2>
           </div>
           <ul class="sub-nav-list">
               <li><a href="#">Invité d'honneur</a></li>
               <li><a href="films_hommage.php">Hommages</a></li>
               <li><a href="films_copiesrestaurees.php">Copies restaurées </a></li>
               <li><a href="#">World cinema project</a></li>
               <li><a href="films_documentaires.php" class="active">Documentaires</a></li>
           </ul> 
      </div>
      <div class="container container-list">
        <section class="categorie-items">
            <div class="title-list-cat">
                <h2 class="titre-document">Dans le cadre de Cannes Classics, seront projetés les documentaires sur le cinéma suivants :</h2>
            </div>
            <article style="background-image:url()">
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
            <article style="background-image:url(img/films/film-hover-documantaire2.jpg)">
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
        </section>
        <section class="categorie-items">
           <div class="title-list-cat">
                <h2 class="title">CELEBRATION DES SOIXANTE ANS DE LA 
CREATION DE LA PALME D’OR</h2>

           </div>
            <article style="background-image:url()">
            <div class="bck-hover">
                <div class="contain_item">
                    <img src="img/films/cover-film-documentaire3.jpg" alt="images films">
                    <div class="infos-item-list">
                        <h3 class="title-item">La légede de la palme d'or</h3>
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
      <div class="bandeau-list">
           <div class="bandeau-list-img" style="background-image:url(img/films/cover-bandeau-push.jpg);">
               <h2 class="title title-list-header">Caméra d'or</h2>
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
