var $name = $('#nom'),
	$firstName = $('#prenom'),
	$selectPere = $('#selectPere'),
	$selectFils = $('#selectFils');

var errorMsg ='<div id="errorMsg" class="alert alert-danger" role="alert">' + 
'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>' + 
'<span class="sr-only">Error:</span>Veuillez entrez un nom ou un prénom valide' + 
'!</div>';

var errorMsgStruct ='<div id="errorMsgStruct" class="alert alert-danger" role="alert">' + 
'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>' + 
'<span class="sr-only">Error:</span>Vous devez sélctionner une structure' + 
'!</div>';

function controlPeopleForm(){
	if($name.val().length < 2 ){
		if($firstName.val().length < 2){
			$('#errorMsg').html(errorMsg);
			return false;
		}
		return true;
	}
	return true;
}

function controlStructForm(){
	if($selectPere.val() == null){
		$selectPere.parent().addClass("has-error");
		$('#errorMsgStruct').html(errorMsgStruct);
		return false;
	}
	return true;
	//else if($selectFils == u)$selectFils == u
}

function ajaxRequest(url, callback, data){
	$.ajax({
       url : url,
       type : 'GET',
       dataType : 'JSON',
	   data : data,
       success : function(data, statut){ // success est toujours en place, bien sûr !
           callback(data);
       },

       error : function(resultat, statut, erreur){

       }

    });
}

//function nameVer

//==============================================================================
window.onload = function() { //Au chargement de la page
	
	$name.keydown(function(){
		if($name.val().length < 1){
			$name.parent().addClass("has-error");
		}
		else{
			$name.parent().removeClass("has-error");
			$firstName.parent().removeClass("has-error");
			$('#errorMsg').html("");	
		}
	});

	$firstName.keydown(function(){
		if($firstName.val().length < 1){
			$firstName.parent().addClass("has-error");
		}
		else{
			$firstName.parent().removeClass("has-error");
			$name.parent().removeClass("has-error");
			$('#errorMsg').html("");	
		}
	});
	
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
};

