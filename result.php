<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page d'accueil du trobinoscope</title>
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
					$normalAccess = false; // Variable to know if the user should be here or not
					if(!empty($_POST['selectPere'])){
						// The user searches people using their structure
						$normalAccess = true;
						$selectPere = htmlspecialchars($_POST['selectPere']);
						// We set the value of child node
						if(!empty($_POST['selectFils'])){
							$selectFils = htmlspecialchars($_POST['selectFils']);
						}
						else{
							$selectFils = 0;
						}
						// We get the data
						$str = file_get_contents('https://webapplis.utc.fr/Trombi_ws/mytrombi/resultstruct?pere='.$selectPere.'&fils='.$selectFils);					
					}
					elseif(isset($_POST['nom']) and isset($_POST['prenom'])){
						// The user searches people using their name
						$normalAccess = true;
						$surnameLower = strtolower(htmlspecialchars($_POST['nom']));
						$nameLower = strtolower(htmlspecialchars($_POST['prenom']));
						// We get the data
						$str = file_get_contents('https://webapplis.utc.fr/Trombi_ws/mytrombi/result?nom='.$surnameLower.'&prenom='.$nameLower); 
					}
					else{
						// The user should not be here.
						echo("<p>Bien essayé.</p>");
					}
					if($normalAccess){
						// The user should be here.
						// echo("<pre>".print_r($http_response_header, true)."</pre>"); // Test
						// Management of the potential problems
						if(!strpos($http_response_header[0], "200")){
							echo("<p>Echec d'accès aux résultats, veuillez réessayer.</p>");
						}
						else{		
							$json = json_decode($str, true);			
							$currentNumberOfImagesPerRow = 0;
							$maxNumberOfImagesPerRow = 4;
							$totalNumberOfImages = 0;
							$numberOfDisplayedImages = 0;
							if(!$json || empty($json)){
								echo("<p class=\"text-center\">Aucun résultat ne correspond à votre recherche.</p>");				
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
									$tel1 = $value["tel"];
									$tel2 = $value["tel2"];
									$office = $value["bureau"];
									$structure = $value["structure"];
									$subStructure = $value["sousStructure"];
									$post = $value["poste"];
									$mail = $value["mail"];
									$authorization = $value["autorisation"];
									$telephoneNumber = "";
									echo("<div class=\"panel panel-default text-center\">"); // Beginning of the panel
							      	echo("<div class=\"panel-heading panel-heading-custom\">"); // Beginning of the panel heading    
		        					echo("<h1>".$nameAndSurname."</h1>");
		          					echo("</div>"); // End of the panel heading
		          					echo("<div class=\"panel-body\">"); // Beginning of the panel body
		          					// Management of the display of the image and of the potential problems
									if($authorization == "N"){
										echo("<a href=\"./images/inconnu.jpg\"><img class=\"img-responsive\" src=\"./images/inconnu.jpg\" alt=\"Photo d'un inconnu\" title=\"".$nameAndSurname."\"/></a>");
									}
									else{
										$imageURL = "https://demeter.utc.fr/portal/pls/portal30/portal30.get_photo_utilisateur_mini?username=".$login;
										$imageContent = file_get_contents($imageURL);
										if(substr($imageContent, 0, strlen("PHOTO NON DISPONIBLE")) === "PHOTO NON DISPONIBLE"){
											echo("<a href=\"./images/inconnu.jpg\"><img class=\"img-responsive\" src=\"./images/inconnu.jpg\" alt=\"Photo d'un inconnu\" title=\"".$nameAndSurname."\"/></a>");
										}
										else{
											// If we are here, it means that everything is ok.
											$bigImageURL = "https://demeter.utc.fr/portal/pls/portal30/portal30.get_photo_utilisateur?username=".$login;
											echo("<a href=\"".$bigImageURL."\"><img class=\"img-responsive\" src=\"".$imageURL."\" alt=\"Photo de ".$nameAndSurname. "\" title=\"".$nameAndSurname."\"/></a>");
										}							
									}
									echo("</div>"); // End of the panel body
									echo("<div class=\"panel-footer panel-footer-custom\">"); // Beginning of the panel footer
									if(!empty($tel1)){
										$telephoneNumber = $tel1;
										if(!empty($tel2)){
											$telephoneNumber = $telephoneNumber.' ou '.$tel2;
										}
										echo('<p><span class="glyphicon glyphicon-phone-alt"></span> '.$telephoneNumber.'</p>');
									}
									if(!empty($office)){
										echo('<p><span class="glyphicon glyphicon-briefcase"></span> '.$office.'</p>');
									}
									if(!empty($structure)){

										echo('<p><span class="glyphicon glyphicon-th-large"></span> '.$structure.'</p>');
									}
									if(!empty($subStructure)){
										echo('<p><span class="glyphicon glyphicon-th"></span> '.$subStructure.'</p>');
									}
									if(!empty($post)){
										echo('<p><span class="glyphicon glyphicon-user"></span> '.$post.'</p>');
									}
									if(!empty($mail)){
										echo('<p><a href="mailto:'.$mail.'"><span class="glyphicon glyphicon-envelope"></span> '.$mail.'</a></p>');
									}
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
						}
					}
					if(!empty($nameLower) and !empty($surnameLower)){
						$link = "./index.php?name=".$nameLower."&surname=".$surnameLower;
					}else{
						$link = "./index.php";			
					}
					echo("<div id=\"centered\"><a class=\"text-center btn btn-default\" href=\"".$link."\">Vers le formulaire du trombinosope <span class=\"glyphicon glyphicon-search\"></span></a></div>");
				?>				
			</section>
			<?php include("./footer.php"); ?>
		</div>
	</body>
</html>