<?php 
session_start();
unset($_SESSION['username_admin']);
session_destroy();
header("Location: indx.php");
exit;
?>