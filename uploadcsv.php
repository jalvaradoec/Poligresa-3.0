<?php
	include_once("web-config.php");
	echo "<br>Rahul<br>";
	echo "<pre>";
	print_r($_FILES);
	echo "File name=".$_FILES["userfile"]["name"];
	//echo "File Type=".$_FILES["userfile"]["type"];
	
	//die();
	
	if (($_FILES["userfile"]["type"] == "text/csv"))
	{
		echo "File Type=".$_FILES["userfile"]["type"];
	}
	else
	{
		echo "Not .csv file";
	}
	die();
?>