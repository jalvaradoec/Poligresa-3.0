<?php
	include_once("web-config.php");
	
	echo "<pre>";
	print_r($_FILES);
	echo "File name=".$_FILES["userfile"]["name"];
	
	$allowed =  array('csv');
	$filename = $_FILES['userfile']['name'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	
	if(!in_array($ext,$allowed) ) 
	{
		echo 'error';
	}
	else
	{
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["userfile"]["name"]);
		
		move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file);

	}
	
	die();
	
?>