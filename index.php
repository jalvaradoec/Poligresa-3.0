<?php 
session_start();

    if($_SESSION["logged_in_user"]["App_Users_SecurityLevel"] >= 9)
    {
		echo "<script>window.location.href='sup_dashboard.php';</script>";
		//$page = "sup_dashboard.php";
    }
    else if($_SESSION["logged_in_user"]["App_Users_SecurityLevel"] >= 5)
    {
		echo "<script>window.location.href='sup_dashboard.php';</script>";
		//$page = "sup_dashboard.php";
    }
    else if($_SESSION["logged_in_user"]["App_Users_SecurityLevel"] >= 1)
    {
		echo "<script>window.location.href='oper_dashboard.php';</script>";
		//$page = "oper_dashboard.php";
    }
	
	else
	{
		echo "<script>window.location.href='login.php';</script>";
	}
	
	//echo "<script>window.location.href='".$page."';</script>";

/*
if(!empty($_SESSION["username_admin"]))
{
	echo "<script>window.location.href='login.php';</script>";
	
}else{
	echo "<script>window.location.href='login.php';</script>";
}
*/

?>