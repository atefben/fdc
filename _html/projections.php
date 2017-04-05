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
    <div id="main" class="home loading">
      <div class="bigContainer">
              
          <div class="text-presentation projection">
            <h3>Vos projections<br>au Marché du Film</h3>
            <h5>Avant de commencer votre demande de projection en ligne, merci de lire notre GUIDE DES PROJECTIONS et notre GUIDE TECHNIQUE qui vous donneront toutes les informations nécessaires.<h5>
            <h5>Les demandes de projection peuvent être faites par les sociétés inscrites au Marché à partir de début février. L’accès aux demandes se fait sur le site dans le compte de la société, accessible avec adresse email et mot de passe. Les demandes sont traitées par ordre d’arrivée. Les films produits avant le 1er janvier 2014 et ceux ayant déjà été projetés à un précédent Marché du Film ne sont pas acceptés. Les courts-métrages de moins de 35 minutes doivent être inscrits au Short Film Corner sur <a href="#" class="customClass1">www.cannescourtmetrage.com</a>.</h5> 
              <div class="programme">
                <div>
                  <img src="img/trombonne.png">
                </div>
                <div>
                  <h6 class="customClass1">Le programme des projections</h6>
                </div>
                <div class="customClass1">
                  <a href="">
                    <img src="img/boutonDLRond.png">
                  </a>
                </div>
              </div> 
          </div>

      </div><!--CONTAINER-->
    
    </div>

      <div class="floatingButtonLeft">
          <div class="arrow showLeft">
            <i class='icon icon_flecheGauche'></i>
          </div>
          <a href="pavillons.php">
            <div class="floatingButtonText showLeft">pavillons</div>
          </a>
      </div>
      <div class="floatingButtonRight">
          <div class="arrow showRight">
            <i class='icon icon_flecheGauche reverse'></i>
          </div> 
          <a href="equipements-et-services.php">
            <div class="floatingButtonText showRight">equipements et services</div>
          </a>   
      </div>


    <?php include('box-projections.php'); ?>
    <?php include('box-contact.php'); ?>
    <?php include('footer.html'); ?>

     <!-- cookie banner -->
      <?php include('cookie-banner.php'); ?>
    <!-- //// SCRIPTS \\\\ -->

    <?php include('scripts.inc.php'); ?>
  </body>
</html>
