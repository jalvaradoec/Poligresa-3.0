<?php 
	session_start();
	if(!empty($_SESSION["username_admin"]))
	{
		echo $_SESSION["username_admin"]; die();
	}
	else
	{
		echo "No user Login";
		echo "<script>window.location.href='login.php';</script>";
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