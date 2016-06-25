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
		$target_dir =  $SITE_URL."uploads/";
		$target_file = $target_dir . basename($_FILES["userfile"]["name"]);
		
		echo "servere path=".$SITE_URL."uploads/";
		echo "<br>my path = ".$target_file;
		
		die();
		
		if(move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file))
		{
			echo "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
		}else 
		{
			echo "Sorry, there was an error uploading your file.";
		}	
	}
	
	die();
	
?>