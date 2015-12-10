<!DOCTYPE html>
<html>

  <head>
    <?php include('head.html'); ?>
  </head>

  <body>
    <?php include('header.html'); ?>

    <div id="main" class="contact loading">
      <h2 class="title">Contact</h2>
      <div class="coords">
        <h3>Festival de Cannes</h3>
        <p>3, rue Amélie 75007 Paris - France</p>
        <p>Tel: +33 (0) 1 53 59 61 00  -  Fax : +33 (0)1 53 59 61 10</p>
      </div>
      <div class="success">
        <h3>Votre message a bien été envoyé.</h3>
        <p>L'équipe concernée va revenir vers vous très rapidement.</p>
      </div>
      <div class="container">
        <p>Précisez votre demande en complétant le formulaire ci-dessous.<br />
        Seules les demandes formulées en français ou en anglais <br />
        peuvent être prises en compte.</p>
        <div id="form">
          <form action="">
            <div class="select">
              <label for="select">Votre message concerne:</label>
              <select name="select">
                <option class="default" value="default">Séléctionnez un thème</option> 
                <option value="theme1">Theme 1</option>
                <option value="theme2">Theme 2</option>
              </select>
              <span id="triggerSelect"></span>
            </div>
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
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
