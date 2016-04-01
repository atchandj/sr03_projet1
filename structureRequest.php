<?php	
	if (is_ajax()) {
		if (!empty($_GET["lid"])) { //Checks if action value exists
			$lid = htmlspecialchars($_GET["lid"]);
			$str = file_get_contents('https://webapplis.utc.fr/Trombi_ws/mytrombi/structfils?lid='.$lid); 
			echo $str;
		}
		else{
			$str = file_get_contents('https://webapplis.utc.fr/Trombi_ws/mytrombi/structpere'); 
			echo $str;
		}
	}
	//Function to check if the request is an AJAX request
	function is_ajax() {
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}
?>