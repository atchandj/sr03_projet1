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
		<div class="fluid-container">	
			<?php 
				include("./header.php"); 
				displayHeader("Résultats");
			?>
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
								echo("<div class=\"row\">"); // Beginning of the row
							}
							echo("<div class=\"col-md-3\">"); // Beginning of the column
							$login = $value['login'];	
							$nameAndSurname = $value['nom'];
							echo("<div class=\"panel panel-default text-center\">"); // Beginning of the panel
					      	echo("<div class=\"panel-heading panel-heading-custom\">"); // Beginning of the panel heading    
        					echo("<h1>".$nameAndSurname."</h1>");
          					echo("</div>"); // End of the panel heading
          					echo("<div class=\"panel-body\">"); // Beginning of the panel body
							if($value['autorisation'] == "N"){
								echo("<img class=\"img-responsive\" src=\"/images/inconnu.jpg\" alt=\"Photo d'un inconnu\" title=\"".$nameAndSurname."\"/>");						
							}
							else{
								echo("<img class=\"img-responsive\" src=\"https://demeter.utc.fr/portal/pls/portal30/portal30.get_photo_utilisateur_mini?username=".$login."\" alt=\"Photo de ".$nameAndSurname. "\" title=\"".$nameAndSurname."\"/>");
							}
							echo("</div>"); // End of the panel body
							echo("<div class=\"panel-footer panel-footer-custom\">"); // Beginning of the panel footer
							echo("<p>Here, we should put some data...</p>");
							echo("</div>"); // End of the panel footer
							echo("</div>"); // End of the panel
							echo("</div>"); // End of the column
							$currentNumberOfImagesPerRow++;
							$numberOfDisplayedImages++;
							if(($currentNumberOfImagesPerRow == $maxNumberOfImagesPerRow) || ($numberOfDisplayedImages == $totalNumberOfImages)){
								echo("</div>"); // End of the row
								$currentNumberOfImagesPerRow = 0;
							}							
						}
						// echo("<figcaption class=\"text-center\">Photo des étudiants</figcaption>"); // Test
						echo('</figure>');
					}
					$link = "./index.php?name=".$nameLower."&surname=".$surnameLower;
					echo("<div id=\"centered\"><a class=\"text-center btn btn-default\" href=\"".$link."\">Vers le formulaire du trombinosope <span class=\"glyphicon glyphicon-search\"></span></a></div>");
				?>				
			</section>
			<?php include("./footer.php"); ?>
		</div>
	</body>
</html>
