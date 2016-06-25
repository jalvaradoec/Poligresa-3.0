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
		echo "<br>"."Upload file";
	 
		$data = new Spreadsheet_Excel_Reader($filename);
 
		echo "<br>Total Sheets in this xls file: ".count($data->sheets)."<br /><br />";

	}
	
	die();
	
?>