<html>
<head>
	<meta charset="utf-8">
	<title>Ohwee - Intégration HTML TravelCab mobile</title>
	<link rel="stylesheet" href="//cdn.ohwee.fr/css/base.css" type="text/css">
	<style type="text/css">
		#ohwee-agence-digitale {font-size:14px;height:auto;border:none;}
		h1 {padding:50px 0 75px 0;}
		ul,ol {display:inline-block;margin-left:100px;margin-bottom:20px;}
		ul {list-style-type:circle;}
		p {font-size:18px;margin-bottom:10px;font-style:italic;font-family:monospace;}
		li {font-family:monospace;padding-bottom:2px;text-align:left;width:250px;}
		li a {text-decoration:none;color:#333;}
		li a:hover {text-decoration:underline;}
	</style>
</head>
<body id="ohwee-agence-digitale">
	<h1 id="top"><img src="http://cdn.ohwee.fr/img/skin/logo-ohwee-black.png" alt="Ohwee - Agence de Communication digitale"></h1>

	<?php
		$dir_nom = '.'; // dossier listé (pour lister le répertoir courant : $dir_nom = '.'  --> ('point')
		$dir = opendir($dir_nom) or die('Erreur de listage : le répertoire n\'existe pas'); // on ouvre le contenu du dossier courant
		$fichier= array(); // on déclare le tableau contenant le nom des fichiers
		$dossier= array(); // on déclare le tableau contenant le nom des dossiers

		$exclusion = '/(.gitignore$|.rb$|.ico$|.info$|.txt$|_index.php|header.html|footer.html|.js$|.json$|.png$|.jpg$)/';


		while($element = readdir($dir)) {

			//exclus les fichiers de la liste
			preg_match($exclusion, $element,$matches);
			if(count($matches))
					continue;

			if($element != '.' && $element != '..') {
				if (!is_dir($dir_nom.'/'.$element)) {$fichier[] = $element;}
				else {$dossier[] = $element;}
			}
		}

		closedir($dir);

		if(!empty($fichier)){
			sort($fichier);// pour le tri croissant, rsort() pour le tri décroissant
			echo "<p>Liste des templates :</p> \n\n";
			echo "\t\t<ol>\n";
				foreach($fichier as $lien) {
					echo "\t\t\t<li><a href=\"$dir_nom/$lien \" >$lien</a></li>\n";
				}
			echo "\t\t</ol>";
		}
	?>
</body>
