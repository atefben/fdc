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
  
  </head>

  <body>
    <?php include('header.html'); ?>

    <div id="main" class="searchpage loading">
      <div id="searchContainer">
        <div class="container">
          <div id="count"><span>0</span> Résultats</div>
          <form action="">
            <input id="inputSearch" type="text" name="name" placeholder="Entrez votre recherche..." value="<?php if (isset($_GET['name'])): echo $_GET['name']; endif; ?>" />
            <input id="submitSearch" type="submit" value="" />
          </form>
          <div id="colSearch">
            <ul>
              <li><a href="#" class="active all">Tout<span>0</span></a></li>
              <li><a href="#" class="artists">Artistes<span>0</span></a></li>
              <li><a href="#" class="films">Films<span>0</span></a></li>
              <li><a href="#" class="medias">Medias<span>0</span></a></li>
              <li><a href="#" class="news">Actualités<span>0</span></a></li>
              <li><a href="#" class="communiques">Communiqués<span>0</span></a></li>
              <li><a href="#" class="events">évènements<span>0</span></a></li>
              <li><a href="#" class="participate">Participer<span>0</span></a></li>
            </ul>
          </div>
          <div id="results">
            <div id="wide" class="resultWrapper">
              <div class="resultsContainer">
                <h2>Actualités</h2>
                <a href="#" class="view-all">Tout voir</a>
                <div id="newsResults">

                </div>
              </div>
              <div class="resultsContainer">
                <h2>Communiqués/Infos</h2>
                <a href="#" class="view-all">Tout voir</a>
                <div id="communiquesResults">

                </div>
              </div>
              <div class="resultsContainer">
                <h2>Medias</h2>
                <a href="#" class="view-all">Tout voir</a>
                <div id="mediasResults">

                </div>
              </div>
              <div class="resultsContainer">
                <h2>évènements</h2>
                <a href="#" class="view-all">Tout voir</a>
                <div id="eventsResults">

                </div>
              </div>
              <div class="resultsContainer">
                <h2>Participer</h2>
                <a href="#" class="view-all">Tout voir</a>
                <div id="participateResults">

                </div>
              </div>
            </div>
            <div id="short" class="resultWrapper">
              <div class="resultsContainer">
                <h2>Artistes</h2>
                <a href="#" class="view-all">Tout voir</a>
                <div id="artistsResults">

                </div>
              </div>
              <div class="resultsContainer">
                <h2>Films</h2>
                <a href="#" class="view-all">Tout voir</a>
                <div id="filmsResults">

                </div>
              </div>
            </div>
            <div id="noResult">
              <h3>Aucun résultat pour l'année en cours</h3>
              <p class="link"><a href="#"><img src="img/svg/arrow-right-gold.svg" />Découvrez 68 ans d'archives</a></p>
            </div>
          </div>
        </div>
        <div id="footerSearch">
          <div class="img"></div>
          <div class="txtFooter vCenter">
            <div class="vCenterKid">
              <h3>Retrouvez d'autres résultats pour les éditions précédentes dans</h3>
              <h2 class="title">L'encyclopédie du festival</h2>
              <p class="link"><a href="#"><img src="img/svg/arrow-right-gold.svg" />Rechercher</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>