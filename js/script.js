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
	nameVerification();
	firstNameVerification();
	if($name.parent().hasClass('has-error') || $name.parent().hasClass('has-error')){
		$('#errorMsg').html(errorMsg);
		return false;
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
}

//Vérifis que le nom est bien rempli
function nameVerification(){
	if($name.val().length < 1){
		$name.parent().addClass("has-error");
	}
	else{
		$name.parent().removeClass("has-error");
		$firstName.parent().removeClass("has-error");
		$('#errorMsg').html("");	
	}
}

//Vérifis que le prénom est bien rempli
function firstNameVerification(){
	if($firstName.val().length < 1){
		$firstName.parent().addClass("has-error");
	}
	else{
		$firstName.parent().removeClass("has-error");
		$name.parent().removeClass("has-error");
		$('#errorMsg').html("");	
	}
}

//Listeners
$name.keydown(nameVerification);
$firstName.keydown(firstNameVerification);

