<?php
	include_once("web-config.php");
	echo "<br>Rahul<br>";
	print_r($_FILES);
	echo $_FILES["userfile"]["name"];
	echo $_FILES["file"]["type"];
	
	
	//print_r($_FILES['file']['name']);
	die();
	
	if (($_FILES["file"]["type"] == "text/csv"))
	{

	}
	else
	{
	
	}

?>