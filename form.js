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



