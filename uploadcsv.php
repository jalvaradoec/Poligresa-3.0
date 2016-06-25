<?php
	include_once("web-config.php");
	
	echo "<pre>";
	print_r($_FILES);
	echo "File name=".$_FILES["userfile"]["name"];
	
	$allowed =  array('csv');
	$filename = $_FILES['userfile']['name'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	if(!in_array($ext,$allowed) ) {
		echo 'error';
	}
	else
	{
	 echo "<br>"."Upload file";
	}
	
	die();
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