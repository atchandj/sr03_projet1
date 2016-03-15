<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page d'accueil du trobinoscope</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<link href="style.css" rel="stylesheet">
	</head>
	<body>	
		<div class="container">	
			<?php include("./header.php"); ?>
			<section>
				<?php
					$surnameLower = strtolower(htmlspecialchars($_POST['nom']));
					$nameLower = strtolower(htmlspecialchars($_POST['prenom']));
					$str = file_get_contents('https://webapplis.utc.fr/Trombi_ws/mytrombi/result?nom='.$surnameLower.'&prenom='.$nameLower); 
					$json = json_decode($str, true);
					$currentNumberOfImagesPerRow = 0;
					$maxNumberOfImagesPerRow = 4;
					$totalNumberOfImages = 0;
					$numberOfDisplayedImages = 0;
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
						$totalNumberOfImages = count($json);
						foreach ($json  as $key => $value){	
							if($currentNumberOfImagesPerRow == 0){
								echo("<div class=\"row\">");
							}
							echo("<div class=\"col-md-3\">");
							$login = $value['login'];	
							$nameAndSurname = $value['nom'];							
							if($value['autorisation'] == "N"){
								echo("<img class=\"thumbnail img-responsive\" src=\"./images/inconnu.jpg\" alt=\"Photo d'un inconnu\" title=\"".$nameAndSurname."\"/>");						
							}
							else{
								echo("<img class=\"thumbnail img-responsive\" src=\"https://demeter.utc.fr/portal/pls/portal30/portal30.get_photo_utilisateur_mini?username=".$login."\" alt=\"Photo de ".$nameAndSurname. "\" title=\"".$nameAndSurname."\"/>");
							}
							echo("<p>Here, we should put some data...</p>");
							echo("</div>");
							$currentNumberOfImagesPerRow++;
							$numberOfDisplayedImages++;

							if(($currentNumberOfImagesPerRow == $maxNumberOfImagesPerRow) || ($numberOfDisplayedImages == $totalNumberOfImages)){
								echo("</div>");
								$currentNumberOfImagesPerRow = 0;
							}							
						}
						echo("<figcaption class=\"text-center\">Photo des étudiants</figcaption>");
						echo('</figure>');
					}
					$link = "./index.php?name=".$nameLower."&surname=".$surnameLower;
					echo("<p class=\"text-center\"><a href=\"".$link."\">Vers le formulaire du trombinosope</a></p>");
				?>				
			</section>
			<?php include("./footer.php"); ?>
		</div>
	</body>
</html>
