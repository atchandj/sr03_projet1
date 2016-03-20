<?php
	
	
	if (is_ajax()) {
		if (isset($_GET["lid"]) && !empty($_GET["lid"])) { //Checks if action value exists
			$str = file_get_contents('https://webapplis.utc.fr/Trombi_ws/mytrombi/structfils?lid='.$_GET["lid"]); 
			$json = json_decode($str, true);
			echo json_encode($json);
		}
		else{
			$str = file_get_contents('https://webapplis.utc.fr/Trombi_ws/mytrombi/structpere'); 
			$json = json_decode($str, true);
			echo json_encode($json);
		}
	}
	//Function to check if the request is an AJAX request
	function is_ajax() {
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}
?>