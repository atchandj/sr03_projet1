var $name = $('#nom'),
	$firstName = $('#prenom');

var errorMsg ='<div id="errorMsg" class="alert alert-danger" role="alert">' + 
'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>' + 
'<span class="sr-only">Error:</span>Veuillez entrez un nom ou un prénom valide' + 
'!</div>';

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

function controlForm(){
	if($name.val().length < 2 ){
		if($firstName.val().length < 2){
			$('#errorMsg').html(errorMsg);
			return false;
		}
		return true;
	}
	return true;
}