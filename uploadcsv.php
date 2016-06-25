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
		
		$html="<table border='1'>";
		for($i=0;$i<count($data->sheets);$i++) // Loop to get all sheets in a file.
		{	
			if(count($data->sheets[$i][cells])>0) // checking sheet not empty
			{
				echo "Sheet $i:<br /><br />Total rows in sheet $i  ".count($data->sheets[$i][cells])."<br />";
				for($j=1;$j<=count($data->sheets[$i][cells]);$j++) // loop used to get each row of the sheet
				{ 
					$html.="<tr>";
					for($k=1;$k<=count($data->sheets[$i][cells][$j]);$k++) // This loop is created to get data in a table format.
					{
						$html.="<td>";
						$html.=$data->sheets[$i][cells][$j][$k];
						$html.="</td>";
					}
					$eid = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][1]);
					$name = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][2]);
					$email = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][3]);
					$dob = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][4]);
					
					echo "<br>id =".$eid;
					echo "<br>name =".$name;
					echo "<br>email=".$email;
					echo "<br>bob =".$dob;
					die();
					$query = "insert into excel(eid,name,email,dob) values('".$eid."','".$name."','".$email."','".$dob."')";
		 
					mysqli_query($connection,$query);
					$html.="</tr>";
				}
			}
		 
		}
		 
		$html.="</table>";
		echo $html;
		echo "<br />Data Inserted in dababase";

	}
	
	die();
	
?>