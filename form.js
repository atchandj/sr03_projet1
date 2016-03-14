var $name = $('#nom'),
	$firstName = $('#prenom');

function controlForm(){
	if($name.val().length == 0 && $firstName.val().length == 0){
		alert("Veuillez entrez un nom ou un prénom.");
		return false;
	}
	return true;		
}




