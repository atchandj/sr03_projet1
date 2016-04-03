<?php
	/**
	 * The function to get some data using a GET HTTP request.  
	 * 
	 * This function makes a GET HTTP request to the URL given in
	 * parameter. It's done using the PHP/cURL library.
	 *
	 * @param string $url The URL from which the data should be get.
	 * 
	 * @return array
	 */	
	function getDataFromUrl($url){
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
		$result = array('data' => curl_exec($curl), 'curl_errno' => curl_errno($curl), 'curl_error' => curl_error($curl), 'curl_info' => curl_getinfo($curl));
		curl_close($curl);
		return $result;
	}
	
	/**
	 * The function to display the "Go to the index" button.  
	 *
	 * @param string $link The link to the index.
	 */	
	function displayGoToIndexButton($link){
		echo("<div id=\"centered\"><a class=\"text-center btn btn-default\" href=\"".$link."\">Vers le formulaire du trombinosope <span class=\"glyphicon glyphicon-search\"></span></a></div>");
	}

	/**
	 * The function to display a person.  
	 * 
	 * This function displays a person (his/her picture and his/her 
	 * data) using the $data array given in parameter.
	 *
	 * @param array $data It contains some data of a person which should be displayed.
	 */	
	function displayPerson($data){
		echo("<div class=\"col-md-3\">"); // Beginning of the column
		$login = $data['login'];	
		$nameAndSurname = $data['nom'];
		$tel1 = $data["tel"];
		$tel2 = $data["tel2"];
		$office = $data["bureau"];
		$structure = $data["structure"];
		$subStructure = $data["sousStructure"];
		$post = $data["poste"];
		$mail = $data["mail"];
		$authorization = $data["autorisation"];
		$telephoneNumber = "";
		echo("<div class=\"panel panel-default text-center\">"); // Beginning of the panel
		echo("<div class=\"panel-heading panel-heading-custom\">"); // Beginning of the panel heading    
		echo("<h1>".$nameAndSurname."</h1>");
		echo("</div>"); // End of the panel heading
		
		echo("<div class=\"panel-body\">"); // Beginning of the panel body
		displayPhoto($authorization, $nameAndSurname, $login);
		echo("</div>"); // End of the panel body
		
		echo("<div class=\"panel-footer panel-footer-custom\">"); // Beginning of the panel footer
		displayData($tel1, $tel2, $office, $structure, $subStructure, $post, $mail);
		echo("</div>"); // End of the panel footer
		
		echo("</div>"); // End of the panel
		echo("</div>"); // End of the column
	}

	
	/**
	 * The function to display the picture of a person.  
	 * 
	 * This function displays the picture of a person
	 * using some parameters.
	 *
	 * @param string $authorization It is used to know whether we are allowed to display the picture ("O" || "N").
	 * @param string $nameAndSurname The name and the surname of the person.
	 * @param string $login The login of the person.
	 */	
	function displayPhoto($authorization, $nameAndSurname, $login){
		// Management of the display of the image and of the potential problems
		if($authorization == "N"){
			echo("<a href=\"./images/inconnu.jpg\"><img class=\"img-responsive\" src=\"./images/inconnu.jpg\" alt=\"Photo d'un inconnu\" title=\"".$nameAndSurname."\"/></a>");
		}
		else{
			$imageURL = "https://demeter.utc.fr/portal/pls/portal30/portal30.get_photo_utilisateur_mini?username=".$login;
			$result = getDataFromUrl($imageURL);
			$imageContent = $result['data'];
			if(substr($imageContent, 0, strlen("PHOTO NON DISPONIBLE")) === "PHOTO NON DISPONIBLE"){
				echo("<a href=\"./images/inconnu.jpg\"><img class=\"img-responsive\" src=\"./images/inconnu.jpg\" alt=\"Photo d'un inconnu\" title=\"".$nameAndSurname."\"/></a>");
			}
			else{
				// If we are here, it means that everything is ok.
				$bigImageURL = "https://demeter.utc.fr/portal/pls/portal30/portal30.get_photo_utilisateur?username=".$login;
				echo("<a href=\"".$bigImageURL."\"><img class=\"img-responsive\" src=\"".$imageURL."\" alt=\"Photo de ".$nameAndSurname. "\" title=\"".$nameAndSurname."\"/></a>");
			}							
		}		
	}
	
	/**
	 * The function to display some data of a person.  
	 * 
	 * This function displays some data of a person using
	 * some parameters.
	 *
	 * @param string $tel1 The first phone number of the person.
	 * @param string $tel2 The second phone number of the person.
	 * @param string $office The office of the person.
	 * @param string $structure The structure of the person. 
	 * @param string $subStructure The sub structure of the person.
	 * @param string $post The post of the person.
	 * @param string $mail The mail of the person.
	 */	
	function displayData($tel1, $tel2, $office, $structure, $subStructure, $post, $mail){
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
	}
?>