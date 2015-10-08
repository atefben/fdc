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
    <link href='css/styles.css' rel="stylesheet">
  
  </head>

  <body>
    <?php include('header.html'); ?>

    <div id="main" class="single-article">
      <div class="container">
        <a href="#" class="nav prev"></a>
        <a href="#" class="nav next"></a>
        <div class="info">
          <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
        </div>
        <h2 class="title-article">The Lobster : Bande Annonce</h2>
        <div class="buttons">
          <a id="share-article" href="#" class="button">Partager</a>
          <a href="#" class="button print">Imprimer</a>
        </div>

        <div class="video-player video actu_article_video">
          <div class="image" style="background-image: url(img/article/004.jpg);"></div>
          <div class="picto"></div>
          <div class="info">
            <a href="#" class="category">Bande-annonce</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
            <p>The Lobster</p>
          </div>
        </div>

      </div>
      <div class="share">
        <p>Partagez l'article</p>
        <div class="buttons square">
          <a href="#" class="button facebook"></a>
          <a href="#" class="button twitter"></a>
          <a href="#" class="button link"></a>
          <a href="#" class="button email"></a>
          <a href="#" class="button print"></a>
        </div>
      </div>
      <div class="film">
        <div class="info-film">

        </div>
        <div class="programmation-film">

        </div>
      </div>
      <div class="container">
        <div class="focus">
          <h2 class="title">Focus</h2>
          <div class="articles">
            <article class="article" data-format="article" data-theme="competition">
              <div class="image" style="background-image: url('img/articles/03.jpg')">
                <a href="article.php"></a>
                <span class="picto"></span>
              </div>
              <div class="info">
                <a href="#" class="category">Compétition</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
              </div>
            </article>
            <article class="video" data-format="video" data-theme="photocall">
              <div class="image" style="background-image: url('img/articles/03.jpg')">
                <a href="article.php"></a>
                <span class="picto"></span>
              </div>
              <div class="info">
                <a href="#" class="category">Photocall</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <h2><a href="article.php">Z de Costa-Gravas</a></h2>
              </div>
            </article>
          </div>
        </div>
        <div class="same-day">
          <h2 class="title">Le même jour</h2>
          <div class="articles center">
            <article class="article" data-format="article" data-theme="competition">
              <div class="image" style="background-image: url('img/articles/03.jpg')">
                <a href="article.php"></a>
                <span class="picto"></span>
              </div>
              <div class="info">
                <a href="#" class="category">Compétition</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <h2><a href="article.php">Stéphane Brizé interroge la loi du marché</a></h2>
              </div>
            </article>
            <article class="video" data-format="video" data-theme="photocall">
              <div class="image" style="background-image: url('img/articles/03.jpg')">
                <a href="article.php"></a>
                <span class="picto"></span>
              </div>
              <div class="info">
                <a href="#" class="category">Photocall</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <h2><a href="article.php">Z de Costa-Gravas</a></h2>
              </div>
            </article>
            <article class="photo" data-format="photo" data-theme="photograph">
              <div class="image" style="background-image: url('img/articles/03.jpg')">
                <a href="article.php"></a>
                <span class="picto"></span>
              </div>
              <div class="info">
                <a href="#" class="category">L'oeil du photographe</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                <h2><a href="article.php">Renaud, réalisateur indépendant canadien © Balint Porneczi / supported by [NEUS]</a></h2>
              </div>
            </article>
          </div>
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
