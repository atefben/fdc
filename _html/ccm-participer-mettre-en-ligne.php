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
    <div id="main" class="home loading noPadding whiteBckg">
      <div class="list-article"> 
        <div class="bandeau-list">
          <div class="bandeau-list-img bandeau-head vCenter subHeader eventsHeader" style="background-image:url('img/skyCam7.png')">
              <h3>Inscrire un film</h3>
          </div>
        </div>
            <!--<div class="subNavigation">
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
            </div>-->
       </div>
        <div class="wideWrapper onlineWrapper">
          <h1>COMMENT METTRE EN LIGNE VOTRE FILM ?</h1>
          <div class="onlinegoldBorders">
            <div class="specs">
             <h2><i class="icon icon_camera"></i> Spécifications vidéo</h2>
              <h3>Formats acceptés</h3>
                <span>.mp[e]g  -   .avi  -   .vob  -   .mov  - 
                .mp4  -   .m4v</span>
               <h3>Codecs recommandés</h3>
                <span>Apple ProRes H264 (bitrate si possible)
                > 2MBit/s et non compressé
                (très gros fichiers)</span>
                <h3>Résolution</h3>
                <span>PAL  -   NTSC (ou SECAM) de 720x400 pixels au format HD (1920x1080 pixels)</span>
            </div>
            <div class="specs">
              <h2><i class="icon icon_son"></i> Spécifications audio</h2>
                <h3>Formats acceptés</h3>
                <span>48kHz PCM (seulement non compressé) MP3 AAC (si possible > 160 kBit/s)</span>
            </div>
          </div>
        </div>       
        <div class="smallWrapper onlineWrapper">
          <h3>Caractéristiques du fichier :</h3>
          <p>Seuls les fichiers multiplexés seront acceptés (vidéo, audio et sous-titres dans un seul et même fichier). La taille maximum du fichier doit être de 8 GO pour chaque film. Plus la résolution est importante, meilleure sera la qualité de numérisation. Vous pouvez mettre en ligne des films avec une résolution allant jusqu’à 1920x1080 pixels (HD), tout en respectant le critère de taille évoqué plus haut.</p>
        </div>     
        <div class="smallWrapper onlineWrapper">
          <h3>Sous-titres :</h3>
          <p>Vous serez prévenu avant la conférence de presse officielle, qui a lieu vers la mi-avril.</p>
          <p>Les sous-titres doivent être incrustés dans l’image.</p>
        </div>   
        <div class="smallWrapper onlineWrapper">
          <h3>Préparation du film :</h3>
          <p>Assurez-vous que votre film ne comporte pas de barres de couleurs ou de séquence noire avant le début ou après la fin du film. Assurez-vous également que votre film ne soit pas entrelacé (c’est-à-dire avec des lignes horizontales striant l’image, particulièrement visibles lors des séquences avec du mouvement rapide).</p>
        </div>     
        <div class="smallWrapper onlineWrapper">
          <h3>Renseignement utile :</h3>
          <p>Vous trouverez ci-contre le manuel expliquant comment extraire votre film d’un DVD ou réencoder un fichier vidéo dans un format adapté au téléchargement sur notre site. Outre les logiciels professionnels type Final Cut ou Premiere, les logiciels que nous recommandons (gratuits et simples d’utilisation) sont <a href="#">HandBrake</a> et MPEG Streamclip.</p>

           <p>Navigateur et connexion Internet :</p>
        </div>         
        <!--<button class="modal-toggle">Update</button>-->
    </div>
      
    <?php include('footer.html'); ?>

     <!-- cookie banner -->
      <?php include('cookie-banner.php'); ?>
    <!-- //// SCRIPTS \\\\ -->

    <?php include('scripts.inc.php'); ?>
  </body>
</html>
