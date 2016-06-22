<?php 
	if(!empty($_SESSION["username_admin"]))
	{
		echo $_SESSION["username_admin"];
	}
	else
	{
		echo "No user Login";
	}
	
	/*
session_start();

if(!empty($_SESSION["username_admin"]))
{
	echo "<script>window.location.href='login.php';</script>";
	
}else{
	echo "<script>window.location.href='login.php';</script>";
}
*/

?>