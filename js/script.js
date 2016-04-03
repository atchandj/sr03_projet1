var $name = $('#nom'),
	$firstName = $('#prenom'),
	$selectPere = $('#selectPere'),
	$selectFils = $('#selectFils');

var errorMsg ='<div id="subErrorMsg" class="alert alert-danger" role="alert">' + 
'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>' + 
'<span class="sr-only">Error:</span>Veuillez entrez un nom ou un prénom valide' + 
'!</div>';

var errorMsgStruct ='<div id="subErrorMsgStruct" class="alert alert-danger" role="alert">' + 
'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>' + 
'<span class="sr-only">Error:</span>Vous devez sélctionner une structure' + 
'!</div>';

/**
 * The function to check the conformity of the "search by individual" form.  
 * 
 * In case of non conformity, this function adds an error message and returns 
 * false. Otherwise, it returns true.
 *
 * @return boolean
 */	
function controlPeopleForm(){
	verificationFormElement();
	if($name.parent().hasClass('has-error') || $name.parent().hasClass('has-error')){
		$('#errorMsg').html(errorMsg);
		return false;
	}
	return true;
}

/**
 * The function to check the conformity of the "search by structure" form.  
 * 
 * In case of non conformity, this function adds some error messages and returns 
 * false. Otherwise, it returns true.
 *
 * @return boolean
 */	
function controlStructForm(){
	if($selectPere.val() == null){
		$selectPere.parent().addClass("has-error");
		$('#errorMsgStruct').html(errorMsgStruct);
		return false;
	}
	return true;
}

/**
 * The function checks if at least one of the elements of the "search by individual" form is complete.  
 * 
 * In case of non conformity, this function adds some error messages. Otherwise, it removes the added
 * error messages.
 */	
function verificationFormElement(){
	if($firstName.val().length < 2 && $name.val().length < 2){
		$firstName.parent().addClass("has-error");
		$name.parent().addClass("has-error");
	}
	else{
		$firstName.parent().removeClass("has-error");
		$name.parent().removeClass("has-error");
		$('#errorMsg').html("");	
	}
}

// Listeners
$name.keyup(function(){
	verificationFormElement();
});

$firstName.keyup(function(){
	verificationFormElement();
});

$(document).ready(function(){
    verificationFormElement();
});