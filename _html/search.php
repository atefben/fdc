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
            <div id="filtered">
              <div class="filters">
                <div id="format" class="filter">
                  <span class="label">Date :</span>
                  <span class="select">
                    <span class="active" data-filter="all">Toutes</span>
                    <span data-filter="18052015">18 Mai 2015</span>
                  </span>
                </div>
                <div id="format" class="filter">
                  <span class="label">Format :</span>
                  <span class="select">
                    <span class="active" data-filter="all">Tous</span>
                    <span data-filter="photo">Photo</span>
                    <span data-filter="video">Vidéo</span>
                    <span data-filter="audio">Audio</span>
                    <span data-filter="article">Article</span>
                  </span>
                </div>
                <div id="theme" class="filter">
                  <span class="label">Thème :</span>
                  <span class="select">
                    <span class="active" data-filter="all">Tous</span>
                    <span data-filter="press">Conférence de Presse</span>
                    <span data-filter="steps">Montée des marches</span>
                  </span>
                </div>
              </div>
            </div>
            <div id="wide" class="resultWrapper">
              <div class="resultsContainer">
                <h2 class="titleSection">Actualités</h2>
                <a href="#" class="view-all">Tout voir</a>
                <div id="newsResults">
                  <article class="article" data-format="article" data-theme="competition">
                    <div class="image">
                      <div class="image-wrapper">
                        <img src="img/articles/03.jpg" alt="" />
                      </div>
                      <a href="article.php" class="linkImage"></a>
                      <a href="#" class="read-later"><span>Ajouter à ma sélection</span></a>
                      <span class="picto"></span>
                    </div>
                    <div class="info">
                      <a href="#" class="category">Compétition</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                      <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
                    </div>
                  </article>
                  <article class="article" data-format="article" data-theme="competition">
                    <div class="image">
                      <div class="image-wrapper">
                        <img src="img/articles/03.jpg" alt="" />
                      </div>
                      <a href="article.php" class="linkImage"></a>
                      <a href="#" class="read-later"><span>Ajouter à ma sélection</span></a>
                      <span class="picto"></span>
                    </div>
                    <div class="info">
                      <a href="#" class="category">Compétition</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                      <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
                    </div>
                  </article>
                  <article class="article" data-format="article" data-theme="competition">
                    <div class="image">
                      <div class="image-wrapper">
                        <img src="img/articles/03.jpg" alt="" />
                      </div>
                      <a href="article.php" class="linkImage"></a>
                      <a href="#" class="read-later"><span>Ajouter à ma sélection</span></a>
                      <span class="picto"></span>
                    </div>
                    <div class="info">
                      <a href="#" class="category">Compétition</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                      <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
                    </div>
                  </article>
                  <article class="article" data-format="article" data-theme="competition">
                    <div class="image">
                      <div class="image-wrapper">
                        <img src="img/articles/03.jpg" alt="" />
                      </div>
                      <a href="article.php" class="linkImage"></a>
                      <a href="#" class="read-later"><span>Ajouter à ma sélection</span></a>
                      <span class="picto"></span>
                    </div>
                    <div class="info">
                      <a href="#" class="category">Compétition</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                      <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
                    </div>
                  </article>
                </div>
              </div>
              <div class="resultsContainer">
                <h2 class="titleSection">Communiqués/Infos</h2>
                <a href="#" class="view-all">Tout voir</a>
                <div id="communiquesResults">
                  <article class="article" data-format="article" data-theme="competition">
                    <div class="image">
                      <div class="image-wrapper">
                        <img src="img/articles/03.jpg" alt="" />
                      </div>
                      <a href="article.php" class="linkImage"></a>
                      <a href="#" class="read-later"><span>Ajouter à ma sélection</span></a>
                      <span class="picto"></span>
                    </div>
                    <div class="info">
                      <a href="#" class="category">Compétition</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                      <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
                    </div>
                  </article>
                  <article class="article" data-format="article" data-theme="competition">
                    <div class="image">
                      <div class="image-wrapper">
                        <img src="img/articles/03.jpg" alt="" />
                      </div>
                      <a href="article.php" class="linkImage"></a>
                      <a href="#" class="read-later"><span>Ajouter à ma sélection</span></a>
                      <span class="picto"></span>
                    </div>
                    <div class="info">
                      <a href="#" class="category">Compétition</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                      <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
                    </div>
                  </article>
                </div>
              </div>
              <div class="resultsContainer">
                <h2 class="titleSection">Medias</h2>
                <a href="#" class="view-all">Tout voir</a>
                <div id="mediasResults">
                  <article class="article" data-format="article" data-theme="competition">
                    <div class="image">
                      <div class="image-wrapper">
                        <img src="img/articles/03.jpg" alt="" />
                      </div>
                      <a href="article.php" class="linkImage"></a>
                      <a href="#" class="read-later"><span>Ajouter à ma sélection</span></a>
                      <span class="picto"></span>
                    </div>
                    <div class="info">
                      <a href="#" class="category">Compétition</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                      <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
                    </div>
                  </article>
                  <article class="article" data-format="article" data-theme="competition">
                    <div class="image">
                      <div class="image-wrapper">
                        <img src="img/articles/03.jpg" alt="" />
                      </div>
                      <a href="article.php" class="linkImage"></a>
                      <a href="#" class="read-later"><span>Ajouter à ma sélection</span></a>
                      <span class="picto"></span>
                    </div>
                    <div class="info">
                      <a href="#" class="category">Compétition</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                      <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
                    </div>
                  </article>
                </div>
              </div>
              <div class="resultsContainer">
                <h2 class="titleSection">évènements</h2>
                <a href="#" class="view-all">Tout voir</a>
                <div id="eventsResults">
                  <article class="article" data-format="article" data-theme="competition">
                    <div class="image">
                      <div class="image-wrapper">
                        <img src="img/articles/03.jpg" alt="" />
                      </div>
                      <a href="article.php" class="linkImage"></a>
                      <a href="#" class="read-later"><span>Ajouter à ma sélection</span></a>
                      <span class="picto"></span>
                    </div>
                    <div class="info">
                      <a href="#" class="category">Compétition</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                      <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
                    </div>
                  </article>
                  <article class="article" data-format="article" data-theme="competition">
                    <div class="image">
                      <div class="image-wrapper">
                        <img src="img/articles/03.jpg" alt="" />
                      </div>
                      <a href="article.php" class="linkImage"></a>
                      <a href="#" class="read-later"><span>Ajouter à ma sélection</span></a>
                      <span class="picto"></span>
                    </div>
                    <div class="info">
                      <a href="#" class="category">Compétition</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                      <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
                    </div>
                  </article>
                </div>
              </div>
              <div class="resultsContainer noBorder">
                <h2 class="titleSection">Participer</h2>
                <a href="#" class="view-all">Tout voir</a>
                <div id="participateResults">
                  <article class="article" data-format="article" data-theme="competition">
                    <div class="image">
                      <div class="image-wrapper">
                        <img src="img/articles/03.jpg" alt="" />
                      </div>
                      <a href="article.php" class="linkImage"></a>
                      <a href="#" class="read-later"><span>Ajouter à ma sélection</span></a>
                      <span class="picto"></span>
                    </div>
                    <div class="info">
                      <a href="#" class="category">Compétition</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                      <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
                    </div>
                  </article>
                  <article class="article" data-format="article" data-theme="competition">
                    <div class="image">
                      <div class="image-wrapper">
                        <img src="img/articles/03.jpg" alt="" />
                      </div>
                      <a href="article.php" class="linkImage"></a>
                      <a href="#" class="read-later"><span>Ajouter à ma sélection</span></a>
                      <span class="picto"></span>
                    </div>
                    <div class="info">
                      <a href="#" class="category">Compétition</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                      <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
                    </div>
                  </article>
                </div>
              </div>
            </div>
            <div id="short" class="resultWrapper">
              <div class="resultsContainer">
                <h2 class="titleSection">Artistes</h2>
                <a href="#" class="view-all">Tout voir</a>
                <div id="artistsResults">

                </div>
              </div>
              <div class="resultsContainer">
                <h2 class="titleSection">Films</h2>
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