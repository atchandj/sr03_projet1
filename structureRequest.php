<?php	
	include("./functions.php"); 
	$result = NULL;
	if (is_ajax()) {
		if (!empty($_GET["lid"])) { //Checks if action value exists
			$lid = htmlspecialchars($_GET["lid"]);
			$result = getDataFromUrl('https://webapplis.utc.fr/Trombi_ws/mytrombi/structfils?lid='.$lid);
		}
		else{
			$result = getDataFromUrl('https://webapplis.utc.fr/Trombi_ws/mytrombi/structpere'); 
		}
		if(!$result['data'] || $result['curl_info']['http_code'] != 200){
			echo "[]";
		}
		else{
			echo $result['data'];
		}	
	}
	//Function to check if the request is an AJAX request
	function is_ajax() {
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}
?>