<!DOCTYPE html>
<html>

  <head>
    <?php include('head.html'); ?>
  </head>

  <body>
    <?php include('header.html'); ?>

    <div id="main" class="searchpage loading">
      <span id="addtext">Ajouter à ma sélection</span>
      <div class="wrapper">
        <div id="colSearch">
          <ul>
            <li><a href="#" class="active all">Tout<span>0</span></a></li>
            <li><a href="#" data-ajax="searchArtists.html" class="artists ajax">Artistes<span>0</span></a></li>
            <li><a href="#" data-ajax="searchFilms.html" class="films ajax">Films<span>0</span></a></li>
            <li><a href="#" data-ajax="searchNews.html" class="news ajax">Actualités<span>0</span></a></li>
            <li><a href="#" data-ajax="searchCommuniques.html" class="communiques ajax">Communiqués<span>0</span></a></li>
            <li><a href="#" data-ajax="searchMedias.html" class="medias ajax">Medias<span>0</span></a></li>
            <li><a href="#" data-ajax="searchEvents.html" class="events ajax">évènements<span>0</span></a></li>
            <li><a href="#" data-ajax="searchParticipate.html" class="participate ajax">Participer<span>0</span></a></li>
          </ul>
        </div>
        <ul id="suggest"></ul>
        <div id="searchContainer">
          <div class="container">
            <div id="count"><span>0</span> Résultats</div>
            <form action="search.php">
              <input id="inputSearch" class="suggestSearch" type="text" name="name" placeholder="Entrez votre recherche..." value="<?php if (isset($_GET['name'])): echo $_GET['name']; endif; ?>" />
              <input id="submitSearch" type="submit" value="" />
            </form>
            <div id="results">
              <div id="filtered">
                <div class="filters">
                  <div id="date" class="filter">
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
                <div id="filteredContent"></div>
              </div>
              <div id="wide" class="resultWrapper">
                <div class="resultsContainer">
                  <h2 class="titleSection">Actualités</h2>
                  <a href="#" data-class="news" data-ajax="searchNews.html" class="view-all ajax">Tout voir</a>
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
                  <a href="#" class="view-all ajax" data-ajax="searchCommuniques.html" data-class="communiques">Tout voir</a>
                  <div id="communiquesResults">
                    <article class="article" data-format="article" data-theme="competition">
                      <div class="image">
                        <div class="image-wrapper">
                          <img src="img/articles/03.jpg" alt="" />
                        </div>
                        <a href="article.php" class="linkImage"></a>
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
                  <a href="#" class="view-all ajax" data-ajax="searchMedias.html" data-class="medias">Tout voir</a>
                  <div id="mediasResults">
                    <article class="audio" data-format="article" data-theme="competition">
                      <div class="image">
                        <div class="image-wrapper">
                          <img src="img/articles/03.jpg" alt="" />
                        </div>
                        <a href="article.php" class="linkImage"></a>
                        <span class="picto"></span>
                      </div>
                      <div class="info">
                        <a href="#" class="category">Compétition</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                        <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
                      </div>
                    </article>
                    <article class="video" data-format="article" data-theme="competition">
                      <div class="image">
                        <div class="image-wrapper">
                          <img src="img/articles/03.jpg" alt="" />
                        </div>
                        <a href="article.php" class="linkImage"></a>
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
                  <a href="#" class="view-all ajax" data-ajax="searchEvents.html" data-class="events">Tout voir</a>
                  <div id="eventsResults">
                    <article class="" data-format="article" data-theme="competition">
                      <div class="image">
                        <div class="image-wrapper">
                          <img src="img/articles/03.jpg" alt="" />
                        </div>
                        <a href="article.php" class="linkImage"></a>
                      </div>
                      <div class="info">
                        <a href="#" class="category">Leçon de cinema</a>
                        <h2><a href="article.php">Marco Bellocchio</a></h2>
                      </div>
                    </article>
                    <article class="" data-format="article" data-theme="competition">
                      <div class="image">
                        <div class="image-wrapper">
                          <img src="img/articles/03.jpg" alt="" />
                        </div>
                        <a href="article.php" class="linkImage"></a>
                      </div>
                      <div class="info">
                        <a href="#" class="category">Leçon de cinema</a>
                        <h2><a href="article.php">Marco Bellocchio</a></h2>
                      </div>
                    </article>
                  </div>
                </div>
                <div class="resultsContainer">
                  <h2 class="titleSection">artists</h2>
                  <a href="#" class="view-all ajax" data-ajax="searchArtists.html" data-class="artists">Tout voir</a>
                  <div id="artistsResults">
                    <div class="person big">
                      <a href="#"><img src="http://dummyimage.com/136x185/000/fff" /></a>
                      <div class="info">
                        <div class="vCenter">
                          <div class="vCenterKid">
                            <h2><a href="#">Vincent Cassel</a></h2>
                            <span class="category">Comédien</span>
                            <span class="country">France</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="person big">
                      <a href="#"><img src="http://dummyimage.com/136x185/000/fff" /></a>
                      <div class="info">
                        <div class="vCenter">
                          <div class="vCenterKid">
                            <h2><a href="#">Vincent Cassel</a></h2>
                            <span class="category">Comédien</span>
                            <span class="country">France</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="person big">
                      <a href="#"><img src="http://dummyimage.com/136x185/000/fff" /></a>
                      <div class="info">
                        <div class="vCenter">
                          <div class="vCenterKid">
                            <h2><a href="#">Vincent Cassel</a></h2>
                            <span class="category">Comédien</span>
                            <span class="country">France</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="person big">
                      <a href="#"><img src="http://dummyimage.com/136x185/000/fff" /></a>
                      <div class="info">
                        <div class="vCenter">
                          <div class="vCenterKid">
                            <h2><a href="#">Vincent Cassel</a></h2>
                            <span class="category">Comédien</span>
                            <span class="country">France</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="person big">
                      <a href="#"><img src="http://dummyimage.com/136x185/000/fff" /></a>
                      <div class="info">
                        <div class="vCenter">
                          <div class="vCenterKid">
                            <h2><a href="#">Vincent Cassel</a></h2>
                            <span class="category">Comédien</span>
                            <span class="country">France</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="person big">
                      <a href="#"><img src="http://dummyimage.com/136x185/000/fff" /></a>
                      <div class="info">
                        <div class="vCenter">
                          <div class="vCenterKid">
                            <h2><a href="#">Vincent Cassel</a></h2>
                            <span class="category">Comédien</span>
                            <span class="country">France</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="resultsContainer noBorder">
                  <h2 class="titleSection">Participer</h2>
                  <a href="#" class="view-all ajax" data-ajax="searchParticipate.html" data-class="participate">Tout voir</a>
                  <div id="participateResults">
                    <article class="article" data-format="article" data-theme="competition">
                      <div class="image">
                        <div class="image-wrapper">
                          <img src="img/articles/03.jpg" alt="" />
                        </div>
                        <a href="article.php" class="linkImage"></a>
                      </div>
                      <div class="info">
                        <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
                      </div>
                    </article>
                    <article class="article" data-format="article" data-theme="competition">
                      <div class="image">
                        <div class="image-wrapper">
                          <img src="img/articles/03.jpg" alt="" />
                        </div>
                        <a href="article.php" class="linkImage"></a>
                      </div>
                      <div class="info">
                        <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
                      </div>
                    </article>
                  </div>
                </div>
              </div>
              <div id="short" class="resultWrapper">
                <div class="resultsContainer">
                  <h2 class="titleSection">Artistes</h2>
                  <a href="#" data-class="artists" data-ajax="searchArtists.html" class="view-all ajax">Tout voir</a>
                  <div id="artistsResults">
                    <div class="person small">
                      <a href="#"><img src="http://dummyimage.com/52x66/000/fff" /></a>
                      <div class="info">
                        <div class="vCenter">
                          <div class="vCenterKid">
                            <h2><a href="#">Vincent Cassel</a></h2>
                            <span class="category">Comédien</span>
                            <span class="country">France</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="person small">
                      <a href="#"><img src="http://dummyimage.com/52x66/000/fff" /></a>
                      <div class="info">
                        <div class="vCenter">
                          <div class="vCenterKid">
                            <h2><a href="#">Monica Bellucci</a></h2>
                            <span class="category">Comédienne</span>
                            <span class="country">Italie</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="person small">
                      <a href="#"><img src="http://dummyimage.com/52x66/000/fff" /></a>
                      <div class="info">
                        <div class="vCenter">
                          <div class="vCenterKid">
                            <h2><a href="#">Nathalie Portman</a></h2>
                            <span class="category">Comédienne, Réalisatrice</span>
                            <span class="country">états-unis</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="resultsContainer noBorder">
                  <h2 class="titleSection">Films</h2>
                  <a href="#" data-class="films" data-ajax="searchFilms.html" class="view-all ajax">Tout voir</a>
                  <div id="filmsResults">
                    <div class="film small">
                      <a href="#"><img src="http://dummyimage.com/52x66/000/fff" /></a>
                      <div class="info">
                        <div class="vCenter">
                          <div class="vCenterKid">
                            <h2><a href="#">La Haine</a></h2>
                            <span class="category">De <a href="#">Mathieu KASSOVITZ</a></span>
                            <span class="country">France</span>
                            <span class="date">2005</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="film small">
                      <a href="#"><img src="http://dummyimage.com/52x66/000/fff" /></a>
                      <div class="info">
                        <div class="vCenter">
                          <div class="vCenterKid">
                            <h2><a href="#">Black Swan</a></h2>
                            <span class="category">De <a href="#">Darren ARONOFSKY</a></span>
                            <span class="country">états-unis</span>
                            <span class="date">2005</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="film small">
                      <a href="#"><img src="http://dummyimage.com/52x66/000/fff" /></a>
                      <div class="info">
                        <div class="vCenter">
                          <div class="vCenterKid">
                            <h2><a href="#">Tale of Tales</a></h2>
                            <span class="category">De <a href="#">Matteo GARONNE</a></span>
                            <span class="country">italie</span>
                            <span class="date">2005</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="film small">
                      <a href="#"><img src="http://dummyimage.com/52x66/000/fff" /></a>
                      <div class="info">
                        <div class="vCenter">
                          <div class="vCenterKid">
                            <h2><a href="#">Irréversible</a></h2>
                            <span class="category">De <a href="#">Gaspar NOE</a></span>
                            <span class="country">france</span>
                            <span class="date">2005</span>
                          </div>
                        </div>
                      </div>
                    </div>
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
    </div>

    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>