<?php 
session_start();
unset($_SESSION['username_admin']);
unset($_SESSION["logged_in_user"]["App_Users_SecurityLevel"]);
session_destroy();
header("Location: index.php");
exit;
?>