<style>
	.jumbotron{
	    background-color: #2d2d30;
	    color: #bdbdbd;
	}
</style>

<?php
	/**
	 * The function to display the header of the web site.
	 *
	 * The goal of this function is to display the header of the
	 * website using the subtitle given in parameter.
	 *
	 * @param string $subTitle The subtitle which should be displayed.
	 */	
	function displayHeader($subTitle){
		echo("<header class=\"jumbotron text-center\">");
		echo("<h1>Trombinoscope</h1>");
		echo("<p>".$subTitle."</p>");
		echo("</header>");
	}
?>