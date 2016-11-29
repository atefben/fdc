<!DOCTYPE html>
<html>

  <head>
    <?php include('head.html'); ?>
  </head>


  <body>
    <div id="prehome-container">
      <div id="prehome"></div>
    </div>
    <?php include('header.html'); ?>
    <div id="main" class="home single-article loading noPadding">
      <div class="list-article">
        <div class="bandeau-list">
          <div class="bandeau-list-img bandeau-head vCenter subHeader eventsHeader" style="background-image:url('img/skyCam7.png')">
              <h3>événements</h3>
          </div>
        </div>
        <div class="subNavigation">
            <nav>
              <ul class="main">
                <li>
                  <a href="stands.php">screening</a>
                </li>
                <li>
                  <a href="#">ateliers</a>
                </li>
                <li>
                  <a href="projections.php">projections</a>
                </li>
                <li>
                  <a href="equipements-services.php">petits dejeuners</a>
                </li>
                <li>
                  <a href="opportunites-pub.php" class="active">conférences</a>
                </li>
              </ul>
             </nav>
        </div>
       </div>
      <!--<div class="wideWrapper centerWrapper">
        <h2>Screening</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate</p>
      </div>-->
      <div class="content-article">
        <div class="container small-container">
          <div class="info">
            <a href="#" class="category">Cinéma de la plage</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
            <span class="update">Mise à jour :</span><span class="date">18.05.15</span> . <span class="hour">10:00</span>
          </div>
          <h2 class="title-article">Enragés, polar hybride d'Eric Hannezo</h2>
          <div class="buttons">
            <a id="share-article" href="#" class="button"><i class="icon icon_share"></i>Partager</a>
            <a href="#" class="button print" onclick="window.print()"><i class="icon icon_print"></i>Imprimer</a>
          </div>
          <div class="slideshow eventSlideshow">
            <div class="slideshow-img">
              <div class="images">
                <div class="img active">
                  <a data-pid="1" id="photo1" class="chocolat-image ajax" href="img/slide001.jpg" title='<span class="category">test de presse</span><span class="date">20.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP">
                    <img src="img/slide001.jpg" alt="" />
                  </a>
                </div>
                <div class="img">
                  <a data-pid="2" id="photo2" class="chocolat-image ajax" href="img/slide001.jpg" title='<span class="category">test</span><span class="date">20.05.2012</span><h2>test</h2>' data-credit="Crédit Image : ">
                    <img src="img/slide002.jpg" alt="" />
                  </a>
                </div>
                <div class="img">
                  <a data-pid="3" id="photo3" class="chocolat-image ajax" href="img/slide001.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"><img src="img/slide002.jpg" alt="" /></a>
                </div>
                <div class="img">
                  <a data-pid="4" id="photo4" class="chocolat-image ajax" href="img/slide001.jpg" title='<span class="category">lol de presse</span><span class="date">20.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"><img src="img/slide002.jpg" alt="" /></a>
                </div>
                <div class="img">
                  <a data-pid="5" id="photo5" class="chocolat-image ajax" href="img/slide001.jpg" title='<span class="category">new de presse</span><span class="date">21.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"><img src="img/slide002.jpg" alt="" /></a>
                </div>
                <div class="img">
                  <a data-pid="6" id="photo6" class="chocolat-image ajax" href="img/slide001.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"><img src="img/slide002.jpg" alt="" /></a>
                </div>
                <div class="img">
                  <a data-pid="7" id="photo7" class="chocolat-image ajax" href="img/slide001.jpg" title='<span class="category">Conférence de presse</span><span class="date">22.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"><img src="img/slide002.jpg" alt="" /></a>
                </div>
                <div class="img">
                  <a data-pid="8" id="photo8" class="chocolat-image ajax" href="img/slide001.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"><img src="img/slide002.jpg" alt="" /></a>
                </div>
                <div class="img">
                  <a data-pid="9" id="photo9" class="chocolat-image ajax" href="img/slide001.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"><img src="img/slide002.jpg" alt="" /></a>
                </div>
              </div>
              <div class="owl-carousel thumbnails">
                <div data-id="photo1" class="thumb active" data-caption="Riviera - © Fleurantin - 2015">
                  <img src="img/slide001.jpg" />
                </div>
                <div data-id="photo2" class="thumb" data-caption="Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange">
                  <img src="img/slide001.jpg" />
                </div>
                <div data-id="photo3" class="thumb" data-caption="Riviera Alexandra- © Fleurantin - 2015">
                  <img src="img/thumb01.jpg" />
                </div>
                <div class="thumb" data-caption="Riviera - © Fleurantin - 2015">
                  <img src="img/thumb01.jpg" />
                </div>
                <div class="thumb" data-caption="Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange">
                  <img src="img/thumb01.jpg" />
                </div>
                <div class="thumb" data-caption="© Fleurantin - 2015">
                  <img src="img/thumb01.jpg" />
                </div>
                <div class="thumb" data-caption="Riviera - © Fleurantin - 2015">
                  <img src="img/thumb01.jpg" />
                </div>
                <div class="thumb" data-caption="© Fleurantin - 2015">
                  <img src="img/thumb01.jpg" />
                </div>
                <div class="thumb" data-caption="Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange">
                  <img src="img/thumb01.jpg" />
                </div>
              </div>
            </div>
            <p class="caption"><strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange</p>
          </div>
          <div class="minPadding">   
              <div class="wideWrapper wysiwygBlocks">
                <h2>Workshops et networking pour une formation ciblée</h2>
                <p>En plus de tous les avantages d'un badge Marché du Film, vous bénéficiez, durant les premiers jours du Festival de Cannes et du Marché du Film, d’un accès au Producers Workshop: un programme ciblé, mené par des experts de l’industrie, destiné à soutenir les producteurs dans leurs démarches à l’international et à rendre plus efficace leur participation au Marché du Film et au Festival de Cannes.</p><br>
                <p>Un cocktail de networking inaugure le programme en toute convivialité ! Abordez le marché international avec confiance grâce à nos ateliers et séminaires sur le rôle de producteur, les techniques de pitch, la coproduction et le financement international, les stratégies marketing,  la distribution et les ventes internationales du mercredi 11 au samedi 14 mai 2016. Le dimanche</p><br>
                <p>Pour plus de renseignements, merci de contacter Lisa Kermabon – Manager Producers Workshop / Industry Programs: <a href="mailto:lkermabon@festival-cannes.fr">lkermabon@festival-cannes.fr</a></p><br>
                <p>Visitez notre FAQ où vous trouverez les réponses aux questions les plus fréquentes concernant ce programme.</p>
              </div>     
          </div>

          <div class="wideWrapper wysiwygBlocks">
            <h3>- renvoi</h3>
            <p>Presse écrite et multimédia – Agences de presse : presse@festival-cannes.fr<br>
                Média web : <a href="">webmedia@festival-cannes.fr</a><br>
                Télévision – Radio – Agences de presse audiovisuelle : <a href="">presseaudio@festival-cannes.fr</a><br>
                Photographes de presse – Agences photo : <a href="">presseaudio@festival-cannes.fr</a></p>
          </div>

          <div class="wideWrapper wysiwygBlocks">
              <h3>-  par courrier :</h3>
              <p>Festival de Cannes - Service de Presse<br>
              3, rue Amélie, 75007 Paris, France<br>
              En février, à réception des pièces demandées, le service de presse vous communiquera<br>
              l'adresse Internet d’un portail de pré-inscription ainsi qu'une référence personnalisée<br>
              donnant accès à un formulaire d'accréditation en ligne que vous devez compléter et valider.<br>
              Ce portail vous permettra également de suivre le traitement de votre inscription en ligne.</p>
          </div>
          <div class="wideWrapper wysiwygBlocks">
          <h3 class="goldTitle">comment déposer votre demande ?</h3>
          <p>Dès janvier, vous pouvez faire votre demande d'accréditation en envoyant au service de<br>
          presse les pièces justificatives listées dans la rubrique vous concernant : Presse écrite et<br>
          multimédia, Média web, Agence de presse, Agence de presse audiovisuelle, Agence Photo,<br>
          Photographe de presse, Télévision, Radio.<br>
          Les documents peuvent être adressés :</p>
          </div>

          <div class="wideWrapper wysiwygBlocks goldwysiwygBlocks">
            <div class="goldBorders">
              <h3>La date limite pour déposer votre demande d’accréditation est fixée au 31 mars.</h3>
              <p>Pour préserver votre confort et vos conditions de travail le nombre d'accréditations est
                  limité. Nous insistons donc sur la nécessité de nous adresser votre demande avant la date
                  limite.</p>
            </div>
          </div>

          <!-- EXEMPLE ARTICLE-->
          <div class="content-article">
            <div class="container small-container">
              <div class="single-photo">
                <div class="photo-container">
                  <img src="img/article/001.jpg" alt="" />
                  <p class="caption">Maïwenn - Photocall © FDC / Théophile Delange</p>
                </div>
              </div>
              <div class="chapeau">Ancien journaliste devenu producteur et cinéaste, Éric Hannezo s'aventure pour son premier film sur les routes nord-américaines et signe un polar hybride à l'affiche duquel on retrouve <a href="#">Lambert Wilson</a> et Franck Gastambide.</div>
            </div>
          </div>

          <!-- EXEMPLE PLAYER VIDEO -->
          <div class="video-container state-init video"
            data-file='[{"file":"./files/mov_bbb.webm"},
            {"file":"./files/mov_bbb.mp4"}]'
            data-img="/img/article/004.jpg">
            <div id="video-player" class="video-player v_<?php echo time();?>">
            </div>
            <div class="video-overlay"></div>
            <div class="infos-bar">
              <div class="picto"><i class="icon icon_video"></i></div>
              <div class="info">
                <div class="vCenter">
                  <div class="vCenterKid">
                    <a href="#" class="category">Bande-annonce</a><span class="date">18.05.15</span> . <span class="hour">09:00</span>
                    <p>The Lobster</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="text">
            <p><strong>Enragés est l’adaptation d’un film de Mario Bava intitulé Rabid Dogs. Pourquoi l’avoir choisi comme base de votre scénario ?</strong></p>
            <p>Je suis tombé dessus par hasard dans ma boulimie de cinéma et je me suis aperçu qu’il y avait énormément de choses dans sa structure qui me séduisaient. C’est un film considéré comme culte car il a été censuré plus de vingt ans avant d'être visible. Puis, je suis rentré en travail d’écriture pour prendre la tangente par rapport à l’original.</p>
          </div>

      <!-- EXEMPLE PLAYER AUDIO -->
        <div class="audio-container"
            data-file='[{"file":"./img/article/test.mp3"}]'
            data-img="./img/slide001.jpg"
            data-aid="2142">
            <div class="audio-player">
              <div id="audio-player-<?php echo time().'1'; ?>" class="audio-player-container"></div>
              <div class="image" style="background-image: url(img/slide001.jpg);"></div>
              <button class="play-btn play"><i class="icon icon_play"></i></button>
              <div class="off">
                <div class="vCenter">
                  <div class="vCenterKid">
                    <div class="picto"><i class="icon icon_audio"></i></div>
                    <div class="info">
                      <a href="#" class="category">Conférence de test</a><span class="date">11.03.15</span> . <span class="hour">09:00</span>
                      <p>The Lobster de Yoros Lanthinos</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="on"></div>
            </div>
          </div>   
        </div>
        <div class="quote">
          <blockquote>
            “J’ai découvert que Lambert avait une passion pour le film de genre”
          </blockquote>
        </div>

          <div class="categorie-items blackBcgk">
           <div class="title-list-cat">
              <h2 class="title">Hommage a manoel de oliveira</h2>
              <p class="title-item">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente voluptatibus magnam culpa, ut quam est repellendus aliquam ipsum eos debitis. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus consequuntur esse doloremque qui sunt vel voluptatem repudiandae eaque aliquid architecto.</p>
            </div>
          </div>        

        <div class="single-photo">
            <div class="photo-container">
              <img src="img/article/003.jpg" alt="" />
              <p class="caption">Équipe du film - Photocall - The Lobster © FDC / Théophile Delange</p>
            </div>
          </div>
          <div class="half-div">
            <div class="half-photo">
              <div class="photo-container">
                <img src="img/article/005.jpg" alt="" />
                <p class="caption">© FDC / Théophile Delange</p>
              </div>
            </div>
            <div class="half-photo">
              <div class="photo-container">
                <img src="img/article/006.jpg" alt="" />
                <p class="caption">© FDC / Théophile Delange</p>
              </div>
            </div>
            <div class="author">Rédigé par Morgane Urbain</div>
          </div>
          <section class="categorie-items honneur-invit">
            <div class="contain-article-invit">
               <article style="background-image:url('http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/film_main/0001/02/thumb_1319_film_main_976x535.jpeg')">
                  <div class="bck-hover">
                      <div class="contain_item">
                          <div class="image">
                              <a href="/fr/films/close-encounters-with-vilmos-zsigmond">
                                  <img src="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/film_poster/0001/02/thumb_1981_film_poster_259x352.jpeg" alt="CLOSE ENCOUNTERS WITH VILMOS ZSIGMOND" data-object-fit="cover">                </a>
                          </div>
                            <div class="infos-item-list">
                                <h3 class="title-item">
                                    <a href="/fr/films/close-encounters-with-vilmos-zsigmond">
                                        CLOSE ENCOUNTERS WITH VILMOS ZSIGMOND
                                    </a>
                                </h3>
                                  <a href="/fr/artiste/pierre-filmon-1"><span class="nom-item">Pierre FILMON</span></a><br>
                                    <span class="date-item">2016 - 01:20</span>
                                <p class="description-item">
                                    CLOSE ENCOUNTERS WITH VILMOS ZSIGMOND est une rencontre d’un autre type. Une rencontre entre le dernier des Mohicans, Vilmos Zsigmond 83 ans, un chef opérateur américain légendaire et un jeune réalisateur français, Pierre Filmon qui voulait tourner avec lui son premier long métrage de fiction. En attendant le financement, au gré de leurs rencontres, un autre film va voir le jour. Un film, où le cameraman passe cette fois devant l’objectif. <br>
                                    Tourné à Paris, en Californie et dans son pays d’origine, la Hongrie, de mai 2014 à mars 2016, CLOSE ENCOUNTERS WITH VILMOS ZSIGMOND est un documentaire sur un chef opérateur. Un voyage avec le plus brillant homme de l’ombre et en compagnie de ses amis réalisateurs, acteurs et chefs opérateurs.<br></p>
                            </div>
                        </div>
                    </div>
              </article>                                                                                                                            
            </div>
          </section>
        </div>

        <?php include('box-catalogue.php'); ?>  
        <?php include('box-social.php'); ?>  
        <?php include('box-news.php'); ?>
        <?php include('box-contact.php'); ?>  

  <!-- END MAIN-->
    </div>

    <?php include('footer.html'); ?>

     <!-- cookie banner -->
      <?php include('cookie-banner.php'); ?>
    <!-- //// SCRIPTS \\\\ -->

    <?php include('scripts.inc.php'); ?>
  </body>
</html>
