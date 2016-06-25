<?php
	include_once("web-config.php");
	
	print_r($_FILES['file']['name']); die();
	
	if (($_FILES["file"]["type"] == "text/csv"))
	{

	}
	else
	{
	
	}

?>