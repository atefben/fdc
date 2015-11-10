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
          <form action="">
            <input id="inputSearch" type="text" name="name" placeholder="Entrez votre recherche..." value="<?php if (isset($_GET['name'])): echo $_GET['name']; endif; ?>" />
            <input id="submitSearch" type="submit" value="" />
          </form>
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