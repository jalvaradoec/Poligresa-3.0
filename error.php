<?php 
session_start();
include("web-config.php");

$errorCode = isset($_GET["errorCode"]) ? $_GET["errorCode"] : null;
$errorMessage = "Something went wrong !!";
switch ($errorCode) {
  case 404:
    $errorMessage = "Page not found !";
    break;
    case 403:
    $errorMessage = "Access is denied !";
    break;
  
  default:
    # code...
    break;
}
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Poligresa 3.0 | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/style.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="col-lg-12">
<div class="login-logo">
    <!-- <a href="index2.html"><b>Frontline</b>ITS</a> -->
  </div>
<div class="col-lg-12">
<h1>Error occurred:</h1><br/>
<h2><?php echo $errorMessage;?></h2>
</div>
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
<?php
if(isset($_POST['signin'])){
	$username=$_POST['username'];
	$pwd=$_POST['pwd'];
	$sql="select * from View_Logins where App_Users_Username='".$username."' and App_Users_password='".$pwd."'";
	$result=mysql_query($sql);
	$num_row=mysql_num_rows($result);
	if($num_row>0)
	{
		$_SESSION["logged_in_user"] = mysql_fetch_assoc($result);
		$_SESSION['username_admin']=$username;
		$_SESSION['pwd_admin']=$pwd;
		echo "<script>window.location.href='supervisor.php';</script>";
	}
	else
	{
		?>
		<script>
		$('.login-box-msg').text('Please Enter Valid Username and Password!!');
		</script>
		<?php
	}
}
?>
