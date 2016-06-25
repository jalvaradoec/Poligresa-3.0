<?php
	include_once("web-config.php");
	echo "<br>Rahul<br>";
	
	echo "<pre>";
	print_r($_FILES);
	echo "<br>".$_FILES['userfile']['name'];
	echo "<br>".$_FILES["userfile"]["type"];
	echo "<br>".$_FILES["userfile"]["tmp_name"];
	echo "<br>".$_FILES["userfile"]["size"];
	
	//print_r($_FILES['file']['name']);
	die();
	
	if (($_FILES["file"]["type"] == "text/csv"))
	{

	}
	else
	{
	
	}

?>