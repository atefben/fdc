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

    <div id="main" class="webtv webtv-ba loading">
     <div class="bandeau">
				<div id="live" style="background-image:url(http://dummyimage.com/1920x450/cfcfcf/fff&text=+)">
					<div class="vCenter">
						<div class="vCenterKid">
							<a href="#" class="play"></a>
							<h2>Les bandes annonces et extraits</h2>
						</div>
					</div>
				</div>
				<ul class="sub-nav-list">
					<li><a href="webtv_trailer_competition.php" data-url="webtv_trailer_competition_detail.php" class="ajax">Compétition</a></li>
					<li><a href="webtv_trailer_uncertainregard.php" data-url="webtv_trailer_uncertainregard_detail.php" class="ajax">Un certain regard</a></li>
					<li><a href="webtv_trailer_horscompetition.php" data-url="webtv_trailer_horscompetition_detail.php" class="ajax">Hors compétition</a></li>
					<li><a href="webtv_trailer_seancespeciales.php" data-url="webtv_trailer_seancespeciales.php"  class="active ajax">Séances spéciales</a></li>
					<li><a href="webtv_trailer_cinefondation.php" data-url="webtv_trailer_cinefondation.php" class="ajax">Cinéfondation</a></li>
					<li><a href="webtv_trailer_courtmetrage.php" data-url="webtv_trailer_courtmetrage.php" class="ajax">Courts métrages</a></li>
					<li><a href="webtv_trailer_cannesclassics.php" data-url="webtv_trailer_cannesclassics.php" class="ajax">Cannes classics</a></li>
					<li><a href="webtv_trailer_cinemadelaplage.php" data-url="webtv_trailer_cinemadelaplage.php" class="ajax">Cinéma de la plage</a></li>
				</ul>
			</div>
			<div class="content-webtv">
						<?php include('webtv_trailer_seancespeciales_detail.php'); ?>
			</div>
    </div>

   
    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
