<?php	
	include("./functions.php"); // There are some functions in this file.
	$result = NULL;
	if(is_ajax()){ // If it's an AJAX request.
		if (!empty($_GET["lid"])) { // If we should get the data for a sub structure.
			$lid = htmlspecialchars($_GET["lid"]);
			$result = getDataFromUrl('https://webapplis.utc.fr/Trombi_ws/mytrombi/structfils?lid='.$lid);
		}
		else{ // If we should get the data for the main structure.
			$result = getDataFromUrl('https://webapplis.utc.fr/Trombi_ws/mytrombi/structpere'); 
		}
		if(!$result['data'] || $result['curl_info']['http_code'] != 200){
			echo "[]";
		}
		else{
			echo $result['data'];
		}	
	}
	/**
	 * Function to check if the request is an AJAX request.  
	 * 
	 * This function checks if the request is an AJAX request.
	 * If it's the case, it returns true. Otherwise, it returns
	 * false.
	 *
	 * @return boolean
	 */	
	function is_ajax() {
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}
?>