<?php
	include_once("web-config.php");	
	require_once 'excel_reader2.php';
	
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
			//echo "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
			  			   
				$readfile =  $SITE_URL."/uploads/".$_FILES["userfile"]["name"];	
				
				$data = new Spreadsheet_Excel_Reader($_FILES["userfile"]["name"]);

				echo "Total Sheets in this xls file: ".count($data->sheets)."<br /><br />";

				die();
				
				
			   /*
			   if (($handle = fopen($readfile, 'r')) !== FALSE)
				{
					while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) 
					{
						echo "<pre>";
					   print_r($row);
					 }
				}*/
														
				/*			   
			   $file_handle = fopen($readfile, "r");

				while (!feof($file_handle) ) {
				
					print_r($file_handle);
	
					//$line_of_text = fgetcsv($file_handle, 1024);
	
					//print $line_of_text[0] . $line_of_text[1]. $line_of_text[2] . "<BR>";
	
				}
				*/

				fclose($file_handle);					
		}else 
		{
			echo "Sorry, there was an error uploading your file.";
		}	
	}
die();
	
?>