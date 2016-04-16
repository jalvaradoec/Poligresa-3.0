<?php 
session_start();
if(!empty($_SESSION["username_admin"]))
{
	echo "<script>window.location.href='supervisor.php';</script>";
	
}else{
	echo "<script>window.location.href='login.php';</script>";
}

?>