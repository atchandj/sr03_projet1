/*var nom = document.getElementById('nom'),
	prénom = document.getElementById("prenom");
var alertNom = document.createElement('p');*/
//alertNom.className = "text-danger";
/*
nom.addEventListener('onChange', function(e) {
		if()
        //if(e.)
    });


*/


var $name = $('#nom'),
	$firstName = $('#prenom');

var isNameCorrect = false,
	isFirstNameCorrect = false;

$name.change(function(){
	if($name.val().length >= 2)
		isNameCorrect = true;
	else
		isNameCorrect = false;

	if(!isNameCorrect && !isFirstNameCorrect)
		alert("Error");
});

$firstName.change(function(){
	if($firstName.val().length >= 2)
		isFirstNameCorrect = true;
	else
		isFirstNameCorrect = false;

	if(!isNameCorrect && !isFirstNameCorrect)
		alert("Error");
});


