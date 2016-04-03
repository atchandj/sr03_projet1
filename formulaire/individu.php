<?php
	/**
	 * The form to make a research by individual.
	 */	
?>
<div role="tabpanel" class="tab-pane active" id="individu">
	<form method="post" action="result.php" onSubmit="return controlPeopleForm()">
		<div class="panel panel-default">
			<div class="panel-heading" id="panel-heading-custom">
				Personne recherchée
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="control-label" for="nom">Nom : </label>
					<input type="text" name="nom" placeholder="Nom" id="nom" class="form-control" value="<?php echo($surname); ?>" autofocus/>						
				</div>

				<div class="form-group">
					<label class="control-label" for="prenom">Prénom : </label>
					<input type="text" name="prenom" placeholder="Prénom" id="prenom" class="form-control" value="<?php echo($name); ?>" />
				</div>
				<button type="submit" class="btn btn-default ">Envoyer</button>
				<div id="errorMsg"></div>
			</div>
		</div>
	</form>
</div>
