<?php
	include_once("web-config.php");
		
	$target_dir =  $SITE_URL."/uploads/";
	$target_file = $target_dir . basename($_FILES["userfile"]["name"]);
	
	$allowed =  array('csv');
	$filename = $_FILES['userfile']['name'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	
	if(!in_array($ext,$allowed) ) 
	{
		echo 'error';
	}
	else
	{
		
		
		if(move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file))
		{
			echo "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
			   //SampleCSVFile_2kb.csv 
			
			
		}else 
		{
			echo "Sorry, there was an error uploading your file.";
		}	
	}
die();
	
?>