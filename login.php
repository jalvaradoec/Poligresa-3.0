<?php 
	session_start();
	include("web-config.php");	
	
	if(!empty($_SESSION["logged_in_user"]["App_Users_SecurityLevel"]))
	{	
		if($_SESSION["logged_in_user"]["App_Users_SecurityLevel"] >= 9)
		{
		  $page = "sup_dashboard.php";
		  echo "<script>window.location.href='".$page."';</script>";
		}
		else if($_SESSION["logged_in_user"]["App_Users_SecurityLevel"] >= 5)
		{
			$page = "sup_dashboard.php";
			echo "<script>window.location.href='".$page."';</script>";
		}
		else if($_SESSION["logged_in_user"]["App_Users_SecurityLevel"] == 1)
		{
			$page = "oper_dashboard.php";
			echo "<script>window.location.href='".$page."';</script>";
			
		} 
    }
	else
	{
		if(isset($_POST['signin']))
		{
			$username=$_POST['username'];
			$pwd=$_POST['pwd'];
			$sql="select vl.*,au.App_Users_fullname,au.App_Users_email,au.App_Users_phone,au.App_Users_status,au.App_Users_memo from View_Logins vl LEFT JOIN App_Users au ON vl.App_Users_ID = au.App_Users_ID WHERE vl. App_Users_Username='".$username."' and vl.App_Users_password='".$pwd."'";
		  
			$result=mysql_query($sql);
			$num_row=mysql_num_rows($result);
			if($num_row>0)
			{
				$_SESSION["logged_in_user"] = mysql_fetch_assoc($result);
				$_SESSION['username_admin']=$username;
				$_SESSION['pwd_admin']=$pwd;
				$page = "";

				if($_SESSION["logged_in_user"]["App_Users_SecurityLevel"] >= 9)
				{
				  $page = "sup_dashboard.php";
				}
				else if($_SESSION["logged_in_user"]["App_Users_SecurityLevel"] >= 5)
				{
				  $page = "sup_dashboard.php";
				}
				else if($_SESSION["logged_in_user"]["App_Users_SecurityLevel"] >= 1)
				{
				  $page = "oper_dashboard.php";
				}
					echo "<script>window.location.href='".$page."';</script>";
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
	}

	
?>
<!DOCTYPE html>
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
<div class="col-lg-6">
	<div class="login_image">
	<img src="dist/img/Paralax-Logo.png" class="img img1">
	</div>
</div>
<div class="col-lg-6">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg" style="color:red"></p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="username" class="form-control" placeholder="username" name="username" id="username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="pwd" id="pwd">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="signin" id="signin">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

   <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

  <!--  <a href="#">I forgot my password</a><br>
  <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  
  <!-- /.login-box-body -->
</div>
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
	/*
	
	if(isset($_POST['signin']))
	{
		$username=$_POST['username'];
		$pwd=$_POST['pwd'];
		$sql="select vl.*,au.App_Users_fullname,au.App_Users_email,au.App_Users_phone,au.App_Users_status,au.App_Users_memo from View_Logins vl LEFT JOIN App_Users au ON vl.App_Users_ID = au.App_Users_ID WHERE vl. App_Users_Username='".$username."' and vl.App_Users_password='".$pwd."'";
	  
		$result=mysql_query($sql);
		$num_row=mysql_num_rows($result);
		if($num_row>0)
		{
			$_SESSION["logged_in_user"] = mysql_fetch_assoc($result);
			$_SESSION['username_admin']=$username;
			$_SESSION['pwd_admin']=$pwd;
			$page = "";

			if($_SESSION["logged_in_user"]["App_Users_SecurityLevel"] >= 9)
			{
			  $page = "sup_dashboard.php";
			}
			else if($_SESSION["logged_in_user"]["App_Users_SecurityLevel"] >= 5)
			{
			  $page = "sup_dashboard.php";
			}
			else if($_SESSION["logged_in_user"]["App_Users_SecurityLevel"] >= 1)
			{
			  $page = "oper_dashboard.php";
			}
				echo "<script>window.location.href='".$page."';</script>";
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
	*/


?>
