<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page d'accueil du trobinoscope</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/style.css" rel="stylesheet">
		<script src="js/jquery-2.2.2.min.js"></script>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>		
		<div class="fluid-container">	
			<?php 
				include("./header.php"); 
				displayHeader("Recherche");
			?>
			<section>
				<?php 
					$surname = empty($_GET['surname'])?"":htmlspecialchars($_GET['surname']); 
					$name = empty($_GET['name'])?"":htmlspecialchars($_GET['name']);
				?>				
				<div class="row">
					<div class="col-md-4 col-lg-offset-4 " >
						<nav>
							<ul class="nav nav-pills" role="tablist">
							  <li role="presentation" class="active"><a href="#individu" aria-controls="individu" role="tab" data-toggle="tab"><strong>Recherche par individu</strong></a></li>
							  <li role="presentation"><a href="#structure" aria-controls="structure" role="tab" data-toggle="tab"><strong>Recherche par structure</strong></a></li>
							</ul>
						</nav>
							<div class="tab-content">
								<?php 
									include("formulaire/individu.php"); 
									include("formulaire/structure.php"); 
								?>
							</div>
					</div>
				</div>							
			</section>
		<?php include("./footer.php"); ?>
		</div>
		<script src="js/script.js"></script>
		<script src="js/ajax.js"></script>
	</body>
</html>
