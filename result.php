<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page d'accueil du trobinoscope</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>		
		<header>
			<h1>Trombinoscope</h1>
		</header>
		<section>
			<?php
				$surnameLower = strtolower(htmlspecialchars($_POST['nom']));
				$nameLower = strtolower(htmlspecialchars($_POST['prenom']));
				$str = file_get_contents('https://webapplis.utc.fr/Trombi_ws/mytrombi/result?nom='.$surnameLower.'&prenom='.$nameLower); 
				$json = json_decode($str, true);
				// echo('https://webapplis.utc.fr/Trombi_ws/mytrombi/result?nom='.$surnameLower.'&prenom='.$nameLower); // Test
				if(!$json || empty($json)){
					echo('<figure>');
					echo("<img src=\"./images/inconnu.jpg\" alt=\"Photo d'un inconnu\" title=\"Je suis inconnu\"/>");
					echo("<figcaption>Photo d'un inconnu</figcaption>");
					echo("</figure>");					
				}
				else{										
					// echo('<pre>'.print_r($json, true).'</pre>'); // Test
					echo('<figure>');
					foreach ($json  as $key => $value){						
						$login = $value['login'];	
						$nameAndSurname = $value['nom'];					
						echo("<img src=\"https://demeter.utc.fr/portal/pls/portal30/portal30.get_photo_utilisateur_mini?username=".$login."\" alt=\"Photo de ".$nameAndSurname. "\" title=\"Je m'appelle ".$nameAndSurname."\"/>");
					}
					echo("<figcaption>Photo des étudiants</figcaption>");
					echo('</figure>');
				}
				$link = "./index.php?name=".$nameLower."&surname=".$surnameLower;
				echo("<p><a href=\"".$link."\">Vers le formulaire du trombinosope</a></p>");
			?>
		</section>
		<footer>
			<br/>
			<p>ARTCHOUNIN Daniel/ TCHANDJOU NGOKO Adrien</p>
		</footer>
	</body>
</html>
