<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Résultats</title>
		<script src="js/jquery-2.2.2.min.js"></script>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body>	
		<div class="fluid-container">	
			<?php 
				include("./header.php"); 
				displayHeader("Résultats");
			?>
			<section>
				<?php
					include("./functions.php"); // There are some functions in this file.
					set_time_limit(0);
					$url = 'https://webapplis.utc.fr/Trombi_ws/mytrombi/result';
					$normalAccess = false; // Variable to know if the user should be here or not.
					if(!empty($_POST['selectPere'])){ // The user searches people using their structure.
						$normalAccess = true;
						$selectPere = htmlspecialchars($_POST['selectPere']);
						// We set the value of the child node.
						$selectFils = (!empty($_POST['selectFils'])) ? htmlspecialchars($_POST['selectFils']) : 0;
						// We get the data from URL.
						$result = getDataFromUrl($url.'struct?pere='.$selectPere.'&fils='.$selectFils);
					}
					elseif(isset($_POST['nom']) and isset($_POST['prenom'])){ // The user searches people using their name.
						$normalAccess = true;
						$surnameLower = strtolower(htmlspecialchars($_POST['nom']));
						$nameLower = strtolower(htmlspecialchars($_POST['prenom']));
						// We get the data from URL.
						$result = getDataFromUrl($url.'?nom='.$surnameLower.'&prenom='.$nameLower);
					}
					else{ // The user should not be here.
						echo("<p>Bien essayé.</p>");
					}
					if(!empty($nameLower) || !empty($surnameLower)){
						$link = "./index.php?name=".$nameLower."&surname=".$surnameLower;
					}else{
						$link = "./index.php";			
					}
					if($normalAccess){ // If the user is allowed to be here.
						if(!$result['data'] || $result['curl_info']['http_code'] != 200){
							echo("<p>Echec d'accès aux résultats, veuillez réessayer.</p>");
						}
						else{		
							$json = json_decode($result['data'], true);
							$currentNumberOfImagesPerRow = 0;
							$maxNumberOfImagesPerRow = 4;
							$totalNumberOfImages = 0;
							$numberOfDisplayedImages = 0;
							if(!$json || empty($json)){ // There is no result.
								echo("<p class=\"text-center\">Aucun résultat ne correspond à votre recherche.</p>");				
							}
							else{ // Here, we display the result(s).
								$totalNumberOfImages = count($json);
								if($totalNumberOfImages > $maxNumberOfImagesPerRow){ // For ergonomy.
									displayGoToIndexButton($link);
								}
								echo('<figure>');								
								foreach ($json  as $key => $value){	
									if($currentNumberOfImagesPerRow == 0){
										echo("<div class=\"row\">"); // Beginning of the row
									}
									displayPerson($value);
									$currentNumberOfImagesPerRow++;
									$numberOfDisplayedImages++;
									if(($currentNumberOfImagesPerRow == $maxNumberOfImagesPerRow) || ($numberOfDisplayedImages == $totalNumberOfImages)){
										echo("</div>"); // End of the row
										$currentNumberOfImagesPerRow = 0;
									}							
								}
								echo('</figure>');
							}
						}
					}
					displayGoToIndexButton($link);
				?>				
			</section>
			<?php include("./footer.php"); ?>
		</div>
	</body>
</html>