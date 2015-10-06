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

    <div id="main" class="contact">
      <h2 class="title">Contact</h2>
      <div class="coords">
        <h3>Festival de Cannes</h3>
        <p>3, rue Amélie 75007 Paris - France</p>
        <p>Tel: +33 (0) 1 53 59 61 00  -  Fax : +33 (0)1 53 59 61 10</p>
      </div>
      <div class="container">
        <p>Précisez votre demande en complétant le formulaire ci-dessous.<br />
        Seules les demandes formulées en français ou en anglais <br />
        peuvent être prises en compte.</p>
        <div id="form">
          <form action="">
            <input type="text" placeholder="Votre nom*" />
            <input type="email" placeholder="Votre adresse email*" />
            <input type="text" placeholder="Objet*" />
            <textarea placeholder="Votre message*"></textarea>
            <span class="required">* Champs obligatoires</span>
            <input type="submit" value="Envoyer" />
          </form>
        </div>
      </div>
    </div>

    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <script src="js/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="js/bower_components/owl.carousel/src/js/owl.carousel.js"></script>
    <script src="js/bower_components/chocolat/src/js/jquery.chocolat.js"></script>
    <script src="js/bower_components/Snap.svg/dist/snap.svg-min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
