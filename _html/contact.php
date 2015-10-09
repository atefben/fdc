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
            <input type="text" name="name" placeholder="Votre nom*" data-error="Votre nom n'est pas renseigné" />
            <input type="email" name="email" placeholder="Votre adresse email*"  data-error="L'adresse email n'est pas valide" />
            <input type="text" name="object" placeholder="Objet*" data-error="L'objet de votre message n'est pas renseigné" />
            <textarea placeholder="Votre message*" name="message" data-error="Votre message n'est pas renseigné"></textarea>
            <span class="required">* Champs obligatoires</span>
            <input type="submit" value="Envoyer" />
          </form>
          <div class="errors">
            <ul></ul>
          </div>
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
