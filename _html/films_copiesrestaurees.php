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

    <div id="main" class="list-article films-list loading">
      <div class="bandeau-list">
           <div class="bandeau-list-img" style="background-image:url(img/films/cover-bandeau1.jpg);background-size: cover;">
               <h2 class="title title-list-header">Cannes classics</h2>
           </div>
           <ul class="sub-nav-list">
               <li><a href="films_invitedhonneur.php" class="ajax">Invité d'honneur</a></li>
               <li><a href="films_hommage.php" class="ajax">Hommages</a></li>
               <li><a href="films_copiesrestaurees.php" class="active ajax">Copies restaurées </a></li>
               <li><a href="#" class="ajax">World cinema project</a></li>
               <li><a href="films_documentaires.php" class="ajax">Documentaires</a></li>
           </ul> 
      </div>
      <div class="container container-list">
        <section class="categorie-items">

            <article style="background-image:url(img/films/film-hover-copie2.jpg)">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/films/cover-film-copie1.jpg" alt="images films">
                <div class="infos-item-list">
                    <h3 class="title-item">Rocco e i suoi fratelli</h3>
                    <h4 class="sub-title-item">(rocco et ses frères)</h4>
                    <span class="nom-item">Luchino VISCONTI</span>
                    <span class="date-item">1960 - 2h59</span>
                    <p class="description-item">Une présentation de la Film Foundation. Une restauration de la Cineteca di Bologna à l'Immagine Ritrovata laboratory en association avec Titanus, TF1, Drtois Audiovisuels et The Film Foundation.</p>
                    <p class="description-item">
                        Restauration financée par Gucci et The Film Foundation.
                    </p>
                </div>
               </div>
            </div>
            </article>
            <article style="background-image:url(img/films/film-hover-copie2.jpg)">
                <div class="bck-hover">
                <div class="contain_item">
                    <img src="img/films/cover-film-copie2.jpg" alt="images films">
                    <div class="infos-item-list">
                        <h3 class="title-item">Les yeux brûlés</h3>
                        <span class="nom-item">Laurent ROTH</span>
                        <span class="date-item">1986 - 58 min</span>
                        <p class="description-item">Une présentation du CNC et de l’ECPAD en présence de Laurent Roth. Restauration numérique effectuée à partir de la numérisation en 2K des négatifs 35 mm et la numérisation des éléments originaux s’ils existaient encore pour les images d’archives. </p>
                        <p class="description-item">
                           Restauration réalisée par le laboratoire du CNC à Bois d'Arcy.
                        </p>
                    </div>
                </div>
                </div>
            </article>
            <article style="background-image:url(img/films/film-hover-copie2.jpg)">
                <div class="bck-hover">
                <div class="contain_item">
                    <img src="img/films/cover-film-copie3.jpg" alt="images films">
                    <div class="infos-item-list">
                        <h3 class="title-item">Dobro Pozhalovat, <br/> Ili Postoronnim Vkhod Vospreshchen</h3>
                        <h4 class="sub-title-item">(Welcome or No Trespassing)</h4>
                        <span class="nom-item">Elem klimov</span>
                        <span class="date-item">1964 - 1h14</span>
                        <p class="description-item">Une présentation de la Open World Foundation et de Mosfilm. Numérisation en 2K, restauration son et image de Mosfilm et Krupny Plan.</p>
                    </div>
                </div>
                </div>
            </article>
                        <article style="background-image:url(img/films/film-hover-copie2.jpg)">
                <div class="bck-hover">
                <div class="contain_item">
                    <img src="img/films/cover-film-copie4.jpg" alt="images films">
                    <div class="infos-item-list">
                        <h3 class="title-item">La historia oficial</h3>
                        <h4 class="sub-title-item">(L'histoire officiel)</h4>
                        <span class="nom-item">Luis PUENZO</span>
                        <span class="date-item">1984 - 1h50</span>
                        <p class="description-item">Une présentation de Historias Cinematográficas. Prix d'interprétation féminine ex-aequo au Festival de Cannes 1985 pour Norma Aleandro et Oscar du meilleur film en langue étrangère en 1986. Restauration en 4K à partir du négatif original. Réétalonnage mené par le réalisateur et le directeur 
de la photographie. 
Son numérisé à partir d’une restauration du support magnétique puis remixé en 5.1 avec de nouveaux effets et orchestrations additionnelles. 
Financement par le National Film Institute argentin (INCAA) et travail exécuté à Cinecolor Lab sous la supervision du réalisateur/producteur Luis Puenzo.</p>
                    </div>
                </div>
                </div>
            </article>
        </section>
      </div>
      <div class="bandeau-list">
           <div class="bandeau-list-img" style="background-image:url(img/films/cover-bandeau-push-cinemaplage.jpg);">
               <h2 class="title title-list-header">Cinema de la plage</h2>
               <a href="#" class="bandeau-lien"> > Découvrir la rubrique</a>
           </div>

      </div>
    </div>
    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
