<?php
	include_once("web-config.php");
	echo "<br>Rahul<br>";
	print_r($_POST); 
	print_r($_FILES);
	die();
	
	if (($_FILES["file"]["type"] == "text/csv"))
	{

	}
	else
	{
	
	}

?>