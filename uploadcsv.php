<?php
	include_once("web-config.php");
	
	print_r($_FILES["file"]["type"]); die();
	
	if (($_FILES["file"]["type"] == "text/csv"))
	{

	}
	else
	{
	
	}

?>