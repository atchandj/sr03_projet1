<?php
	/**
	 * The form to make a research by structure.
	 */	
?>
<div role="tabpanel" class="tab-pane" id="structure">
	<form method="post" action="result.php" onSubmit="return controlStructForm()"> <!--Ajouter methode et fonction de validation-->
		<div class="panel panel-default">
			<div class="panel-heading" id="panel-heading-custom">
				Recherche par structure
			</div>
			<div class="panel-body">
				<div class="form-group">
					<select class="form-control" id="selectPere" name="selectPere">
					  <option selected disabled>Sélectionner la structure</option>
					</select>					
				</div>

				<div class="form-group">
					<select class="form-control" id="selectFils" name="selectFils">
					  <option selected disabled>--</option>
					</select>
				</div>
				<button type="submit" class="btn btn-default ">Envoyer</button>
				<div id="errorMsgStruct"></div>
			</div>
		</div>
	</form>
</div>
