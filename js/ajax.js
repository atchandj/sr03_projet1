/**
 * The function to make a HTTP request using AJAX. 
 * 
 * This function makes a HTTP GET request using AJAX.
 * In case of success, the function "callback" given 
 * in parameter is called with the data in JSON format.
 *
 * @param string url The URL from which the data should be get.
 * @param function callback The function to call in case of success.
 * @param object data Specifies data to be sent to the server.
 */	
function ajaxRequest(url, callback, data){
	$.ajax({
		url : url,
		type : 'GET',
		dataType : 'JSON',
		data : data,
		success : function(data, statut){
			callback(data);
		},
		error : function(resultat, statut, erreur){

		}
    });
}

$(window).load(function(){
	/**
	 * The function to update $selectPere. 
	 * 
	 * This function updates $selectPere
	 * using the data given in parameter.
	 *
	 * @param object data The data which should be used to update $selectPere.
	 */	
	var updateSelectPere = function(data){
		for(i = 0, max = data.length; i < max; i++ ){
			$selectPere.append('<option value="'+data[i].structNomId+'">'+ data[i].structureLibelle +'</option>');
		}
	};
	
	// Loads the value of $selectPere.
	ajaxRequest('structureRequest.php', updateSelectPere);
	
	// At each modification of the value of $selectPere.
	$selectPere.on('change', function(){
		/**
		 * The function to update $selectFils. 
		 * 
		 * This function updates $selectFils
		 * using the data given in parameter.
		 *
		 * @param object data The data which should be used to update $selectFils.
		 */	
		var updateSelectFils = function(data){
			$selectFils.empty();
			$selectFils.append('<option selected disabled>--</option>');
			for(i = 0, max = data.length; i < max; i++ ){
				$selectFils.append('<option value="'+data[i].structure.structId+'">'+ data[i].structureLibelle +'</option>');
			}
		};
		// Specifies data to be sent to the server.
		data = {
			lid: $(this).val()
		};
		// Loads the value of $selectFils.
		ajaxRequest('structureRequest.php', updateSelectFils, data);
	});
});