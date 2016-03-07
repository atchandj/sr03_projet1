<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page d'accueil du trobinoscope</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</head>
	<body>		
		<header>
			<h1>Trombinoscope</h1>
		</header>
		<section>
			<p>
				<?php
					$str = file_get_contents('https://webapplis.utc.fr/Trombi_ws/mytrombi/result?nom='.strtolower(htmlspecialchars($_POST['nom'])).'&prenom='.strtolower(htmlspecialchars($_POST['prenom']))); 
					$json = json_decode($str, true);
					echo('<pre>'.print_r($json, true).'</pre>');
				?>
			</p>
		</section>
		<footer>
			<br/>
			<p>ARTCHOUNIN Daniel/ TCHANDJOU NGOKO Adrien</p>
		</footer>
	</body>
</html>