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

    <div id="main" class="list-article films-list loading cannes-classic selection-officielle">
      <div class="bandeau-list">
           <div class="bandeau-list-img bandeau-head" style="background-image:url(http://dummyimage.com/1920x450/d1800/fff&text=+);">
               <h2 class="title title-list-header">Selection officielle</h2>
           </div>
           <ul class="nav-list sub-nav-list">
             <li>
               <a href="selectionofficielle_competition.php" class="ajax">Compétition</a>
             </li>
             <li>
               <a href="selectionofficielle_uncertainregard.php" class="ajax">Un certain regard</a>
             </li>
             <li>
               <a href="selectionofficielle_horscompetition.php" class="ajax">Hors compétition</a>
             </li>
             <li>
               <a href="selectionofficielle_seancespeciales.php" class="ajax">Séances spéciales</a>
             </li>
             <li>
               <a href="selectionofficielle_cinefondation.php" class="ajax">Cinéfondation</a>
             </li>
             <li>
               <a href="selectionofficielle_courtsmetrages.php" class="ajax">Courts métrages</a>
             </li>
             <li>
               <a href="films_invitedhonneur.php" class='active ajax'>Cannes classics</a>
             </li>
             <li>
               <a href="films_cinemadelaplage.php" class="ajax">Cinéma de la plage</a>
             </li>
           </ul>
      </div>
      <div class="container container-list">
      <div class="bandeau-list">
        <ul class="sub-nav-list nav-movie">
          <li><a href="films_invitedhonneur.php" class="ajax">Invité d'honneur</a></li>
          <li><a href="films_hommage.php" class="ajax active">Hommages</a></li>
          <li><a href="films_copiesrestaurees.php" class="ajax">Copies restaurées </a></li>
          <li><a href="#" class="ajax">World cinema project</a></li>
          <li><a href="films_documentaires.php" class="ajax">Documentaires</a></li>
        </ul> 
      </div>
        <section class="categorie-items">
            <div class="title-list-cat">
                <h2 class="title">Centenaire orson welles</h2>
            </div>
            <article style="background-image:url(img/films/cover-film1.jpg)">
            <div class="bck-hover">
               <div class="contain_item">
                <img src="img/films/cover-film1.jpg" alt="images films">
                <div class="infos-item-list">
                    <h3 class="title-item">Citizen kane</h3>
                    <span class="nom-item">Orson Welles</span>
                    <span class="date-item">1941 - 1h59</span>
                    <p class="description-item">Une présentation de Warner Bros. Restauration 4k réalisé chez Warner Bros. Motion Picture Imagery par l'étalonneuse Janet Wilson, sous la supervision de Ned Price. Le négatif original n'existant plus, image reconstituée d'après trois interpositifs noirs et blancs à grain fin support nitrate.</p>
                    <p class="description-item">
                        Son optique " RCA squeeze duplex format. " 
                    </p>
                </div>
               </div>
            </div>
            </article>
            <article style="background-image:url(img/films/cover-film3.jpg)">
                <div class="bck-hover">
                <div class="contain_item">
                    <img src="img/films/cover-film3.jpg" alt="images films">
                    <div class="infos-item-list">
                        <h3 class="title-item">The third man</h3>
                        <span class="nom-item">Carol Reed</span>
                        <span class="date-item">1949 - 1h44</span>
                        <p class="description-item">Une présentation de Studiocanal. Marron élément nitrate de 2ème génération (négatif original inexistant), numérisé en 4K et restauré image par image en 4K par Deluxe en Angleterre</p>
                        <p class="description-item">
                           Restauration supervisée par Studiocanal. 
                        </p>
                    </div>
                </div>
                </div>
            </article>

           <div class="title-list-cat">
                <h2 class="title">Hommage a manoel de oliveira</h2>
                <p class="title-item">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente voluptatibus magnam culpa, ut quam est repellendus aliquam ipsum eos debitis. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus consequuntur esse doloremque qui sunt vel voluptatem repudiandae eaque aliquid architecto.</p>
           </div>
            <article style="background-image:url(img/films/cover-film2.jpg)">
            <div class="bck-hover">
                <div class="contain_item">
                    <img src="img/films/cover-film2.jpg" alt="images films">
                    <div class="infos-item-list">
                        <h3 class="title-item">Visita</h3>
                        <span class="nom-item">Manoel De Oliveira</span>
                        <span class="date-item">1982 - 1h08</span>
                        <p class="description-item">Grâce à la fille de Manoel de Oliveira, Adelaide Trepa, et à son petit-fils Manuel Casimiroqui l'ont permis, en lien avec José Manuel Costa, directeur, et Rui Machado, sous-directeur, de la Cinemateca Portuguesa, le Festival de Cannes projettera son film posthume <strong>Visita</strong> ou <strong>Memórias e Confissoões</strong> (1982, 1h08).</p>
                        <p class="description-item">
                            Totalement inédit, il n'aura été montré qu'à la Cinemateca Portuguesa de Lisbonne et Porto, ville natale de Manoel de Oliveira.
                        </p>
                    </div>
                </div> 
                </div>   
            </article>
        </section>
      </div>
      <div class="bandeau-list  bandeau-list-footer">
           <div class="bandeau-list-img" style="background-image:url(img/films/cover-bandeau-push.jpg);">
               <h2 class="title title-list-header">Copies restaurées</h2>
               <a href="films_copiesrestaurees.php" class="bandeau-lien"> <img src="img/svg/arrow-right-gold.svg" alt="Découvrir la rubrique" class="svg-arrow"> Découvrir la rubrique</a>
           </div>
      </div>
    </div>
    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
