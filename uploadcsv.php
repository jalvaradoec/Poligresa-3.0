<?php
	include_once("web-config.php");
	
	print_r($_FILES);
	echo $_FILES["userfile"]["name"];
	
	echo $_FILES["userfile"]["type"];
	
	die();
	
	if (($_FILES["userfile"]["type"] == "text/csv"))
	{
		echo $_FILES["userfile"]["name"];
	}
	else
	{
		echo "error";
	}

?>