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

        <div class="text-presentation team">
          <h3>Contact</h3>
        </div>
        <div class="teamBckg">
          <div class="bigContainer">
              <div class="contactInfo">
                <span class="customClass4">du 2 sept au 15 jan 2016</span>
                <h6>3, rue Amélie 75007 Paris - France</h6>
                <h6>Tel: +33 (0) 1 53 59 61 00</h6>
              </div>
              <div class="contactInfo">
                <span class="customClass4">du 26 juin au 6 fév 2016</span>
                <h6>3, rue Amélie 75007 Paris - France</h6>
                <h6>Tel: +33 (0) 1 53 59 61 00</h6></div>
              </div>
            </div>
        </div>
        <div class="bigContainer">

            <section id="contactForm">
            
            <h3>Précisez votre demande en complétant le formulaire ci-dessous.
              Seules les demandes formulées en français ou en anglais 
              peuvent être prises en compte.</h3>
              
              <div class="formContainer">

                <form name="" method="" action="">

                <div class="select">
                    <span>
                      <input placeholder="Votre Message concerne*" onclick="$(this).closest('div').find('select').slideToggle(110)">
                        <div class="selectArrow">
                          <i class="icon icon_flecheGauche"></i>
                        </div>
                        <br>

                      <select class="selection" size=8 onclick="$(this).hide().closest('div').find('input').val($(this).find('option:selected').text());">
                        <option value="Marché du film">Marché du film</option>
                        <option value="édition 2017">édition 2017</option>
                        <option value="Services - opportunités publicitaires">Services - opportunités publicitaires</option>
                        <option value="Industry Programs">Industry Programs</option>
                        <option value="Producers Workshop">Producers Workshop</option>
                        <option value="Producers Workshop">Producers Network</option>
                        <option value="Next">Next</option>
                        <option value="Doc Corner">Doc Corner</option>
                        <option value="Marché du film - Accréditations">Marché du film - Accréditations</option>
                        <option value="Presse - Charte Graphie">Presse - Charte Graphique</option>
                      </select>
                    </span>
                </div>

                <input type="text" name="name" placeholder="Votre Nom*" required>
                  
                <input class="redRequired" type="email" name="email" placeholder="Votre email*" required>
                  
                <textarea class="redRequired" name="objet" placeholder="Objet*" required ></textarea>

                <textarea class="bigHeight" name="message" placeholder="Votre Message*" required ></textarea>
                  
                <button name="send" type="submit" class="submit">ENVOYER</button>
                  
                </form>
                <p>*champs obligatoires</p>
              </div>
              <div class="errorMessage">
                  <div class="redMessage">• L’adresse email n’est pas valide</div>
              </div>
              

            </section>
        </div><!--CONTAINER-->
      </div>

    <?php include('footer.html'); ?>

     <!-- cookie banner -->
      <?php include('cookie-banner.php'); ?>
    <!-- //// SCRIPTS \\\\ -->

    <?php include('scripts.inc.php'); ?>
  </body>
</html>
