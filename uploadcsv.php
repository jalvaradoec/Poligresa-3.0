<?php
	include_once("web-config.php");
	echo "<br>Rahul<br>";
	echo "<pre>";
	print_r($_FILES);
	echo "File name=".$_FILES["userfile"]["name"];
	echo "File Type=".$_FILES["userfile"]["type"];
	
	die();
	
	if (($_FILES["file"]["type"] == "text/csv"))
	{

	}
	else
	{
	
	}

?>