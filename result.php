<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page d'accueil du trobinoscope</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</head>
	<body>		
		<header>
			<h1>Trombinoscope</h1>
		</header>
		<section>
			<?php
				$surnameLower = strtolower(htmlspecialchars($_POST['nom']));
				$nameLower = strtolower(htmlspecialchars($_POST['prenom']));
				$surnameUpper = strtoupper(htmlspecialchars($_POST['nom']));
				$nameCapitalize = ucfirst(htmlspecialchars($_POST['nom']));
				$str = file_get_contents('https://webapplis.utc.fr/Trombi_ws/mytrombi/result?nom='.$surnameLower.'&prenom='.$nameLower); 
				echo('https://webapplis.utc.fr/Trombi_ws/mytrombi/result?nom='.$surnameLower.'&prenom='.$nameLower);
				if(!$str){
					echo('<figure>');
					echo("<img src=\"./images/inconnu.jpg\" alt=\"Photo d'un inconnu\" title=\"Je suis inconnu\"/>");
					echo("<figcaption>Photo de ".$nameCapitalize." ".$surnameUpper."</figcaption>");
					echo('</figure>');					
				}
				else{
					$json = json_decode($str, true);					
					// echo('<pre>'.print_r($json, true).'</pre>'); // test
					echo('<figure>');
					foreach ($json  as $key => $value){						
						$login = $value['login'];	
						$nameAndSurname = $value['nom'];					
						echo("<img src=\"https://demeter.utc.fr/portal/pls/portal30/portal30.get_photo_utilisateur_mini?username=".$login."\" alt=\"Photo de ".$nameAndSurname. "\" title=\"Je m'appelle ".$nameAndSurname."\"/>");
					}
					echo("<figcaption>Photo des étudiants</figcaption>");
					echo('</figure>');
				}
			?>
		</section>
		<footer>
			<br/>
			<p>ARTCHOUNIN Daniel/ TCHANDJOU NGOKO Adrien</p>
		</footer>
	</body>
</html>