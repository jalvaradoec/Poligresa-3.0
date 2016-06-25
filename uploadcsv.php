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
			//echo "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
			  			   
			   $readfile =  $SITE_URL."/uploads/".$_FILES["userfile"]["name"];	
			   
			 	
				
				if (($handle = fopen($readfile, "r")) !== FALSE) {
	
				   fgetcsv($handle);   
				   while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					   
						$num = count($data);
						
						for ($c=0; $c < $num; $c++) {
						  $col[$c] = $data[$c];
						}

						 $col1 = $col[0];
						 $col2 = $col[1];
						 $col3 = $col[2];
						 
						 echo "col1=".$col1;
						 echo "col2=".$col2;
						 echo "col3=".$col3;
						 echo "<br>";
				   
				   // SQL Query to insert data into DataBase
						// $query = "INSERT INTO csvtbl(ID,name,city) VALUES(".$col1.",'".$col2."','".$col3."')";
						 //$res   = mysql_query($query);
						 
						
					}
					fclose($handle);
				}

				
				
				
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