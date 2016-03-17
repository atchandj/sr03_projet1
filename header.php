<style>
.jumbotron{
    background-color: #2d2d30;
    color: #bdbdbd;
}
</style>

<?php 
	function displayHeader($subTitle){
		/*
			The goal of this function is to display 
			the header.
			Parameters:
				- subTitle: the sub-title which
				should be displayed
		*/
		echo("<header class=\"jumbotron text-center\">");
		echo("<h1>Trombinoscope</h1>");
		echo("<p>".$subTitle."</p>");
		echo("</header>");
	}
?>