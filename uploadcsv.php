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
			$readfile =  $SITE_URL."/uploads/".$_FILES["userfile"]["name"];	
				
				$CSVfp = fopen($readfile, "r");
				if($CSVfp !== FALSE) {
					while(! feof($CSVfp)) {
						$data = fgetcsv($CSVfp, 1000, ",");
						echo "<pre>";
						print_r($data);
												
					}
				}
				/*
				$row = 1;
				if (($handle = fopen($readfile, 'r')) !== FALSE)
				{
					while (($data = fgetcsv($handle, 1000, ","," ")) !== FALSE) 
					{
						$num = count($data);
						
						$row++;
						for ($c=0; $c < $num; $c++) 
						{
														
							if($c==6)
							{
								echo $data[$c] . "<br />\n";
								break;
							}
							else{
								echo $data[$c] . "<br />\n";
							}
							
						}						
						
					}
					fclose($handle);
				}
				*/
				
			   /*
			   if (($handle = fopen($readfile, 'r')) !== FALSE)
				{
								
					while (($row = fgetcsv($handle, 4096, ",")) !== FALSE) 
					{
						$array[]=$row;
				
					}	
					echo "<pre>";
					   print_r($array);
				}
				*/
				
				
				/*															  
			   $file_handle = fopen($readfile, "r");

				while (!feof($file_handle) ) {
				
					
					$line_of_text = fgetcsv($file_handle, 1024);
	
					print $line_of_text[0] . $line_of_text[1]. $line_of_text[2] . $line_of_text[3] .$line_of_text[4] .$line_of_text[5] .$line_of_text[6] . "<BR>";
	
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