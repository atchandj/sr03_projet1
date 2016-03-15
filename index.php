<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page d'accueil du trobinoscope</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="style.css" rel="stylesheet">
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>		
		<div class="container">	
			<?php include("./header.php"); ?>
			<section>
				<?php 
					$surname = empty($_GET['surname'])?"":htmlspecialchars($_GET['surname']); 
					$name = empty($_GET['name'])?"":htmlspecialchars($_GET['name']);
				?>
				<form method="post" action="result.php" onSubmit="return controlForm()">
					<div class="row">
						<div class="col-md-4 col-lg-offset-4 " >
							<div class="panel panel-default">
							  	<div class="panel-heading">Personne recherchée</div>
							  	<div class="panel-body">
									<div class="form-group">
										<label for="nom">Votre nom : </label>
										<input type="text" name="nom" placeholder="Nom" id="nom" class="form-control" value="<?php echo($surname); ?>" autofocus/>						
									</div>

									<div class="form-group">
										<label for="prenom">Votre prénom : </label>
										<input type="text" name="prenom" placeholder="Prénom" id="prenom" class="form-control" value="<?php echo($name); ?>" />
									</div>
									<button type="submit" class="btn btn-default ">Envoyer</button>
									<div id="errorMsg"></div>
							  	</div>
							</div>
						</div>
					</div>
				</form>				
			</section>
		<?php include("./footer.php"); ?>
		<script src="form.js"></script>
	</body>
</html>
