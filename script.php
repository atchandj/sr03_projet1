<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page d'accueil du trobinoscope</title>
		<!-- Latest compiled and minified CSS --><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript --><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</head>
	<body>		
		<header>
			<h1>Trombinoscope</h1>
		</header>
		<section>
			<form method="post" action="result.php">
				<fieldset>
					<legend>Personne recherchée</legend>
						<div class="col-md-4">
							<div class="form-group">
								<label for="nom">Votre nom : </label>
								<input type="text" name="nom" placeholder="Nom" id="nom" class="form-control" required="required" autofocus/>
							</div>

							<div class="form-group">
								<label for="prenom">Votre prénom : </label>
								<input type="text" name="prenom" placeholder="Prénom" id="prenom" class="form-control" required="required"/>
							</div>

							<button type="submit" class="btn btn-default">Envoyer</button>
						</div>
				</fieldset>
			</form>
		</section>
		<footer>
			<br />
			<p>ARTCHOUNIN Daniel/ TCHANDJOU NGOKO Adrien</p>
		</footer>
	</body>
</html>
