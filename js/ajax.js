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
	var updateSelectPere = function(data){
		for(i = 0, max = data.length; i < max; i++ ){
			$selectPere.append('<option value="'+data[i].structNomId+'">'+ data[i].structureLibelle +'</option>');
		}
	};
	
	//Charge valeur du selectPere
	ajaxRequest('structureRequest.php', updateSelectPere);
	
	//A chaque changement de valeur du selectPere
	$selectPere.on('change', function() {
		var updateSelectFils = function(data){
			$selectFils.empty();
			$selectFils.append('<option selected disabled>--</option>');
			for(i = 0, max = data.length; i < max; i++ ){
				$selectFils.append('<option value="'+data[i].structure.structId+'">'+ data[i].structureLibelle +'</option>');
			}
		};
		data = {
			lid: $(this).val()
		};
		//Charge Valeur du selectFils
		ajaxRequest('structureRequest.php', updateSelectFils, data);
	});
});