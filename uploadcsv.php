<?php
	include_once("web-config.php");
	echo "<br>Rahul<br>";
	
	echo "<pre>";
	print_r($_FILES); 
	//print_r($_FILES['file']['name']);
	die();
	
	if (($_FILES["file"]["type"] == "text/csv"))
	{

	}
	else
	{
	
	}

?>