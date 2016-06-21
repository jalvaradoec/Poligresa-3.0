<?php
	session_start();
	include("header.php");
	include_once("utils.php");

	$searchText = null;
	if(isset($_POST["search"]) && !empty($_POST["searchText"]))
	$searchText = mysql_real_escape_string($_POST["searchText"]);
?>

<script>
	
	$(document).ready(function(){
		var pathname = window.location.search;
		//alert(pathname);
		//alert(pathname.charAt(1));
		var overlay = jQuery('<div id="overlay"></div>');
		if(pathname==""){}else if(pathname.charAt(1)=="u"){}else{
			if(pathname.charAt(1)=="d"){}else{
				overlay.show();
				overlay.appendTo(document.body);
				$('.popup').show();
				var content1=$( "div.box2" ).html();
				$('.contents').append(content1);
				$(".username").attr("disabled", "disabled");
				setInterval(function(){
					var password = document.getElementById("pwd");
					var confirm_password = document.getElementById("cpwd");
					if(password.value == confirm_password.value) {
						//alert('hello');
						confirm_password.setCustomValidity('');
						} else {
						//alert('hello1');
						confirm_password.setCustomValidity("Passwords Don't Match");
					}
					
					//alert("Hello");
				}, 1000);
			}
		}
		$('.close').click(function(){
			$('.popup').hide();
			overlay.appendTo(document.body).remove();
			return false;
		});
		
		$('.x').click(function(){
			//alert("hello");
			//var vid = document.getElementById("investigation_video"); 
			$('.popup').hide();
			overlay.appendTo(document.body).remove();
			//vid.pause(); 
			$('div.box2').remove();; 
			return false;
		});
		
		$('.click').click(function(){
			//var edit1=$(this).attr('href');
			//$('.hidden_val').val(edit1);
			//$('.edit_id').text(edit1);
			//$('span.edit_id').contents().unwrap();
			
			//if(edit1==""){
			
			overlay.show();
			overlay.appendTo(document.body);
			$('.popup').show();
			var content1=$( "div.box2" ).html();
			$('.contents').append(content1);
			$(".username").removeAttr("disabled");
			setInterval(function(){
				var password = document.getElementById("pwd");
				var confirm_password = document.getElementById("cpwd");
				if(password.value == confirm_password.value) {
					//alert('hello');
					confirm_password.setCustomValidity('');
					} else {
					//alert('hello1');
					confirm_password.setCustomValidity("Passwords Don't Match");
				}
				
				//alert("Hello");
			}, 1000);
			
			
			//}
			//else
			//{
			//window.location.href='index.php?editid=' + edit1;
			//	overlay.show();
			//overlay.appendTo(document.body);
			//$('.popup').show();
			//var content1=$( "div.box2" ).html();
			//$('.contents').append(content1);
			//	$(".username").attr("disabled", "disabled");
			//}
			
			return false;
		});
	});
</script>
<style type="text/css">
	#overlay {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: #000;
	filter:alpha(opacity=70);
	-moz-opacity:0.7;
	-khtml-opacity: 0.7;
	opacity: 0.7;
	z-index: 100;
	display: none;
	}
	.contents a{
	text-decoration: none;
	}
	.popup{
	width: 100%;
	margin: 0 auto;
	display: none;
	position: fixed;
	z-index: 101;
	}
	.contents{
	min-width: 600px;
	width: 600px;
	min-height: 450px;
	margin: 80px auto;
	background: #f3f3f3;
	position: relative;
	z-index: 103;
	padding: 10px;
	border-radius: 5px;
	box-shadow: 0 2px 5px #000;
	}
	.contents p{
	clear: both;
	color: #555555;
	font-size: 13px;
	text-align: justify;
	}
	.contents p a{
	color: #d91900;
	font-weight: bold;
	}
	.contents .x{
	float: right;
	height: 35px;
	left: 22px;
	position: relative;
	top: -25px;
	width: 34px;
	border-radius: 18px;
	}
	.contents .x:hover{
	cursor: pointer;
	}
	.form-group {
    margin-bottom: 0px;
	}
</style>


<div class='popup'style="margin-top: -62px;" >
	<div class='contents'>
		<img src='close.png' alt='quit' class='x' id='x' />
		<div id='player'></div>
		<p><a href='' class='close' style="display:none">Close</a></p>
	</div>
</div>
<div class="box-body box2"  style="display:none">
	<form role="form" style="margin-top: -33px;" action="" method="post">
		<!-- text input 
		<input type="hidden" name="editid" class="hidden_val">-->
		<?php 
			$sql1="select * from App_Users where App_Users_ID='".$_GET['edit_id']."'";
			$result=mysql_query($sql1);
			$row=mysql_fetch_array($result);
		?>
		<div class="form-group">
			<label>User Name : </label>
			<input type="text" name="uname" class="form-control username" value="<?php echo $row[1] ?>" required>
		</div>
		<div class="form-group">
			<label>Name : </label>
			<input type="text" name="name" class="form-control" value="<?php echo $row[3] ?>" required>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Email : </label>
			<input type="email" class="form-control" name="email" value="<?php echo $row[4] ?>" required>
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Password : </label>
			<input type="password" class="form-control" name="pwd" id="pwd" value="<?php echo $row[2] ?>" required>
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Confirm Password : </label>
			<input type="password" class="form-control" name="cpwd" id="cpwd" value="<?php echo $row[2] ?>" required>
		</div>
		<div class="form-group">
			<label>Phone : </label>
			<input type="text" name="phone" class="form-control" value="<?php echo $row[5] ?>" required>
		</div>
		<div class="form-group">
			<label>Security Level : </label>
			<select class="form-control" name="slevel">
				<option value=""> -----------ALL----------- </option> 
				<?php
					$ddl_secl=mysql_query("Select * from View_SecurityLevels");
					while($r=mysql_fetch_assoc($ddl_secl))
					{ 
						if($row[6]==$r[App_Aux_value])
						{
							echo "<option value='$r[App_Aux_value]' selected='selected'> $r[App_Aux_text] </option>";
						}
						else
						{
							echo "<option value='$r[App_Aux_value]'> $r[App_Aux_text] </option>";
						}
					}
				?>
			</select>
			<!--<input type="text" name="slevel" class="form-control" value="<?php echo $row[6] ?>" required>-->
		</div>
		<div class="form-group">
			<label>Supervisor : </label>
			<!--<input type="text" name="supervisor" class="form-control" value="<?php echo $row[7] ?>" required>-->
			<select class="form-control" name="supervisor" class="form-control">
				<option value=""> -----------ALL----------- </option> 
				<?php
					$ddl_users=mysql_query("Select * from View_Supervisors");
					while($r=mysql_fetch_assoc($ddl_users))
					{ 
						if($row[7]==$r[App_Users_ID])
						{
							echo "<option value='$r[App_Users_ID]' selected='selected'> $r[App_Users_username] </option>";
						}
						else
						{
							echo "<option value='$r[App_Users_ID]'> $r[App_Users_username] </option>";
						}
					}
				?>
			</select>
		</div>
		<div class="form-group">
			<label>Memo : </label>
			<textarea class="form-control" rows="3" name="memo" required><?php echo $row[9] ?></textarea>
		</div>
		<div class="form-group">
			<div class="checkbox">
				<label>
					<?php if($row[8]=="1"){ ?>
						<input type="checkbox" name="status" value="1" checked>
						<?php } else { ?>
					<input type="checkbox" name="status" value="1" ><?php } ?>
					Status
				</label>
			</div>
			
		</div>
		<?php 
			if(isset($_GET['edit_id'])){?>
			<button type="submit" class="btn btn-primary" name="update">Update</button>
			<?php } else {?>
			<button type="submit" class="btn btn-primary" name="submit">Submit</button>
		<?php } ?>
	</form>
</div>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Search
			<small>Supervisor</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="supervisor.php"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Supervisor Configuration</li>
		</ol>
	</section>
	
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-md-12">
				<h1>Search</h1>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="nav-tabs-custom">						
						<div class="tab-content">							
						
							<div class="tab-pane2" id="users2">
								
								<!--<div class="box-header">
									<select class="form-control select2 ad_select2">
										<option selected="selected">All</option>
										<option>Active</option>
										<option>InActive</option>
									</select>
								</div>-->
								<!-- /.box-header -->
								<div class="box-body table-responsive no-padding">
									<?php 
										$sqlCond = null;
										if(!empty($searchText))
										{
											$sqlCond .=" Where 
													ac.App_Credits_BankOperNumber like '%".$searchText."%'
													OR ac.App_Credits_DebtorId like '%".$searchText."%'
													OR acl.App_Clients_FullName like '%".$searchText."%'
													OR ac.App_Credits_BankDueDate like '%".$searchText."%'
													OR vos.App_Aux_text like '%".$searchText."%'
												";
										}
										$allCredits = getAppCredits($sqlCond);									
										?>
										<?php if(!empty($searchText)){ ?>
										<p class="help-block"> <?php echo $num_rows ." records found for \"".$searchText."\""; ?></p>
										<?php } ?>
									<table id="example2" class="table table-bordered table-hover table-responsive">
										<thead>
											<tr>
												<th>Bank Oper No</th>
												<th>DebtorId</th>
												<th>FullName</th>
												<th>PhoneNumber</th>
												<th>Capital</th>
												<th>Interests</th>
												<th>Collect Fees</th>
												<th>BankDueDate </th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php

												if(empty($allCredits))
												{
													?>
													<tr><td colspan="8"> No recounds found.</td></tr>
													<?php 
												}else{ 
												foreach($allCredits as $key =>$val){			
												?>
												<tr>
													<td><a href="http://sistema.poligresa.com/3.0_dev/operation.php?operno=<?php echo $val["App_Credits_BankOperNumber"] ?>"><?php echo $val["App_Credits_BankOperNumber"]; ?></a></td>
													<!--<td><?php //echo $val["App_Credits_BankOperNumber"]; ?></td>-->
													<td><?php echo $val["App_Credits_DebtorId"]; ?></td>
													<td><?php echo $val["App_Clients_FullName"]; ?></td>
													<td><?php echo $val["App_Contacts_PhoneNumber"]; ?></td>
													<td><?php echo $val["App_Credits_OriginalCapital"]; ?></td>
													<td><?php echo $val["App_Credits_OriginalInterest"]; ?></td>
													<td><?php echo $val["App_Credits_OriginalCollectFees"]; ?></td>
													<td><?php echo $val["App_Credits_BankDueDate"]; ?></td>
													<td><?php echo $val["StatusText"]; ?></td>													
												</tr>
												<?php
												}
											}
											?>
										</tbody>
										<tfoot>
											<tr>
											<th>Bank Oper No</th>
												<th>DebtorId</th>
												<th>FullName</th>
												<th>Capital</th>
												<th>Interests</th>
												<th>Collect Fees</th>
												<th>BankDueDate </th>
												<th>Status</th>
												</tr>
										</tfoot>
									</table>
								</div>
								<!--<div class="box-footer">
									<a href='' class='click'><i class="fa fa-user-plus fa-5x" style="float: right;"></i></a>
								</div>-->
								
							</div>						
							<!-- /.tab-pane -->
						</div>
						
						<!-- /.tab-pane -->
					</div>
					<!-- /.tab-content -->
				</div>
				<!-- /.nav-tabs-custom -->
			</div>
			
		</div>
		
	</section>
	
</div>


 <?php include("footer.php"); ?>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
		<li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
		<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
	</ul>
    <!-- Tab panes -->
    <div class="tab-content">
		<!-- Home tab content -->
		<div class="tab-pane" id="control-sidebar-home-tab">
			<h3 class="control-sidebar-heading">Recent Activity</h3>
			<ul class="control-sidebar-menu">
				<li>
					<a href="javascript::;">
						<i class="menu-icon fa fa-birthday-cake bg-red"></i>
						
						<div class="menu-info">
							<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
							
							<p>Will be 23 on April 24th</p>
						</div>
					</a>
				</li>
				<li>
					<a href="javascript::;">
						<i class="menu-icon fa fa-user bg-yellow"></i>
						
						<div class="menu-info">
							<h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
							
							<p>New phone +1(800)555-1234</p>
						</div>
					</a>
				</li>
				<li>
					<a href="javascript::;">
						<i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
						
						<div class="menu-info">
							<h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
							
							<p>nora@example.com</p>
						</div>
					</a>
				</li>
				<li>
					<a href="javascript::;">
						<i class="menu-icon fa fa-file-code-o bg-green"></i>
						
						<div class="menu-info">
							<h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
							
							<p>Execution time 5 seconds</p>
						</div>
					</a>
				</li>
			</ul>
			<!-- /.control-sidebar-menu -->
			
			<h3 class="control-sidebar-heading">Tasks Progress</h3>
			<ul class="control-sidebar-menu">
				<li>
					<a href="javascript::;">
						<h4 class="control-sidebar-subheading">
							Custom Template Design
							<span class="label label-danger pull-right">70%</span>
						</h4>
						
						<div class="progress progress-xxs">
							<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
						</div>
					</a>
				</li>
				<li>
					<a href="javascript::;">
						<h4 class="control-sidebar-subheading">
							Update Resume
							<span class="label label-success pull-right">95%</span>
						</h4>
						
						<div class="progress progress-xxs">
							<div class="progress-bar progress-bar-success" style="width: 95%"></div>
						</div>
					</a>
				</li>
				<li>
					<a href="javascript::;">
						<h4 class="control-sidebar-subheading">
							Laravel Integration
							<span class="label label-warning pull-right">50%</span>
						</h4>
						
						<div class="progress progress-xxs">
							<div class="progress-bar progress-bar-warning" style="width: 50%"></div>
						</div>
					</a>
				</li>
				<li>
					<a href="javascript::;">
						<h4 class="control-sidebar-subheading">
							Back End Framework
							<span class="label label-primary pull-right">68%</span>
						</h4>
						
						<div class="progress progress-xxs">
							<div class="progress-bar progress-bar-primary" style="width: 68%"></div>
						</div>
					</a>
				</li>
			</ul>
			<!-- /.control-sidebar-menu -->
			
		</div>
		<!-- /.tab-pane -->
		
		<!-- Settings tab content -->
		<div class="tab-pane" id="control-sidebar-settings-tab">
			<form method="post">
				<h3 class="control-sidebar-heading">General Settings</h3>
				
				<div class="form-group">
					<label class="control-sidebar-subheading">
						Report panel usage
						<input type="checkbox" class="pull-right" checked>
					</label>
					
					<p>
						Some information about this general settings option
					</p>
				</div>
				<!-- /.form-group -->
				
				<div class="form-group">
					<label class="control-sidebar-subheading">
						Allow mail redirect
						<input type="checkbox" class="pull-right" checked>
					</label>
					
					<p>
						Other sets of options are available
					</p>
				</div>
				<!-- /.form-group -->
				
				<div class="form-group">
					<label class="control-sidebar-subheading">
						Expose author name in posts
						<input type="checkbox" class="pull-right" checked>
					</label>
					
					<p>
						Allow the user to show his name in blog posts
					</p>
				</div>
				<!-- /.form-group -->
				
				<h3 class="control-sidebar-heading">Chat Settings</h3>
				
				<div class="form-group">
					<label class="control-sidebar-subheading">
						Show me as online
						<input type="checkbox" class="pull-right" checked>
					</label>
				</div>
				<!-- /.form-group -->
				
				<div class="form-group">
					<label class="control-sidebar-subheading">
						Turn off notifications
						<input type="checkbox" class="pull-right">
					</label>
				</div>
				<!-- /.form-group -->
				
				<div class="form-group">
					<label class="control-sidebar-subheading">
						Delete chat history
						<a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
					</label>
				</div>
				<!-- /.form-group -->
			</form>
		</div>
		<!-- /.tab-pane -->
	</div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>

<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>

<script type="text/javascript">
	function UpdateData(id,check)
	{
		if(check.checked)
		{
			window.location.href="index.php?uid="+id+"&status=1";
		}
		else
		{
			window.location.href="index.php?uid="+id+"&status=0";
		}
		
		//alert(id);
		//alert(check.checked);
		
	}
</script>

</body>
</html>
<?php
	if(isset($_GET["uid"]) && isset($_GET["status"]))
	{
		$sql="update App_Users set App_Users_status='".$_GET['status']."'where App_Users_ID='".$_GET['uid']."'";
		$result=mysql_query($sql);
		header('Location: index.php');		
	}
	if(isset($_POST['submit'])){
		$sql="insert into App_Users(App_Users_username,App_Users_password,App_Users_fullname,App_Users_email,App_Users_phone,App_Users_securitylevel,App_Users_supervisor,App_Users_status,App_Users_memo) values('".$_POST['uname']."','".$_POST['pwd']."','".$_POST['name']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['slevel']."','".$_POST['supervisor']."','".$_POST['status']."','".$_POST['memo']."')";
		mysql_query($sql);
		echo "<script>window.location.href='index.php';</script>";
	}
	if(isset($_POST['update'])){
		$sql4="update App_Users set App_Users_password='".$_POST['pwd']."',App_Users_fullname='".$_POST['name']."',App_Users_email='".$_POST['email']."',App_Users_phone='".$_POST['phone']."',App_Users_securitylevel='".$_POST['slevel']."',App_Users_supervisor='".$_POST['supervisor']."',App_Users_status='".$_POST['status']."',App_Users_memo='".$_POST['memo']."' where App_Users_ID='".$_GET['edit_id']."'";
		mysql_query($sql4);
		echo "<script>$('.contents').hide();
		$('#overlay').css('display','none');
		window.location.href='index.php';</script>";
		
	}
	if(isset($_GET['del_id'])){
		$sql2="delete from App_Users where App_Users_ID='".$_GET['del_id']."'";
		mysql_query($sql2);
		echo "<script>window.location.href='index.php';</script>";
	}
?>
