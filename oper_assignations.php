<?php 
include("header.php");
include_once("utils.php");

$appCreditsCond = null;
if(isset($_POST["Operater_ID"]) || $_POST["Operation_Status_ID"])
{
  if(!empty($_POST["Operater_ID"])){   
	if($_POST["Operater_ID"]=='Please Select Operator'){}else{
    $appCreditsCond = " WHERE ac.App_Credits_AssignedTo = ".$_POST["Operater_ID"].""; }
  }

  if(!empty($_POST["Operation_Status_ID"])){ 
	if($_POST["Operation_Status_ID"]=='Please Select Operation Status'){}else{
    $appCreditsCond = " WHERE ac.App_Credits_Status = ".$_POST["Operation_Status_ID"].""; }
  }
}
//echo $appCreditsCond;
$operators = getViewOperators();
$operStatus = getViewOperStatus();
$appCredits = getAppCredits($appCreditsCond);
// pr($appCredits);
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      &nbsp;
        <!-- Dashboard
        <small>Control panel</small> -->
      </h1>      
       <ol class="breadcrumb">
            <li>
            <a href="./sup_dashboard.php"><i class="fa fa-dashboard"></i> Home</a>
            </li>           
            <li class="active">Operations Assignations</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

	    <section class="col-lg-12">
		
            <div class="box box-primary">
		
			 <div class="box-header act1_head" >
			 <div class="col-lg-3 act1_d">
              <h3 class="box-title"><u><strong>Assigned Operations</strong></u></h3>
			  <div>
			    <table>
                <tbody>
				<tr>
                  <td>Assigned Debt:</td>
                  <td>7000.00</td>          
                </tr>
				<tr>
                  <td>Number of Operation:</td>
                  <td>18</td>          
                </tr>
			     <tr>
                  <td>Operations average :</td>
				  <td>$388,88</td>          
                </tr>
				
			 </tbody> 
		     </table>
			 </div>
            </div>
			<div class="col-lg-5 act1_d">
			<h3 class="box-title act1_bx"><u><strong>Filters</strong></u></h3>
			<div class="col-lg-12 act1_main">
      <form id="frmFilterArea" method="post">
      <div class="col-lg-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Assigned To</label>
        <select class="form-control select2 act1_sl filterDropDown" name="Operater_ID" id="Operater_ID">
                  <option selected="selected">Please Select Operator</option>
                  <?php if(!empty($operators)) {
                            foreach ($operators as $key => $value) {
                              ?>
                                  <option value="<?php echo $value['App_Users_ID']; ?>"><?php echo $value['App_Users_fullname']; ?>
                                  </option>            
                              <?php 
                            }
                    ?>

                  <?php } ?>
             </select>
      </div>
      </div>
      <div class="col-lg-6">
      <div class="form-group">
      <label for="exampleInputEmail1">Operation Status</label>
      <select class="form-control select2 act1_sl filterDropDown" name="Operation_Status_ID" id="Operation_Status_ID">
                  <option selected="selected">Please Select Operation Status</option>
                  <?php if(!empty($operStatus)) { 
                            foreach ($operStatus as $key => $value) {
                              ?>
                                  <option value="<?php echo $value['App_Aux_value']; ?>"><?php echo $value['App_Aux_text']; ?>
                                  </option>            
                              <?php 
                            }
                    ?>

                  <?php } ?>
             </select>
      </div>
      </div>	
      </form>	
			</div>
            </div>
		    <div class="col-lg-4 act1_d1 ">
			<h3 class="box-title act1_bx"><u><strong>Assign To User</strong></u></h3>      
			<div class="col-lg-12 act1_main">
      			<div class="col-lg-6">
            <div class="form-group">
          <label for="exampleInputEmail1">Assigned To</label>
        <select class="form-control select2 act1_sl filterDropDown" name="Operater_ID" id="Operater_ID">
                  <option selected="selected">Please Select Operator</option>
                  <?php if(!empty($operators)) {
                            foreach ($operators as $key => $value) {
                              ?>
                                  <option value="<?php echo $value['App_Users_ID']; ?>"><?php echo $value['App_Users_fullname']; ?>
                                  </option>            
                              <?php 
                            }
                    ?>

                  <?php } ?>
             </select>
             </div>
             </div>
             <div class="col-lg-6">  
			<div class="form-group"> 
      <label for="exampleInputEmail1">&nbsp;</label>  
			<button class="btn btn-info btn-sm">Assign Selected Operations</button>
      </div> 
      </div>
			
			</div>
            </div>
            </div>
		  
           <div class="box-body table-responsive no-padding">
		   	<h3 class="box-title op_tl"><u>Operations</u></h3>
            <table id="example2" class="table table-bordered table-responsive table-hover">
                <thead>
                <tr>
                  <th></th>
                  <th>DebtorID</th>
                  <th>Debtor Name</th>
                  <th>BankOperation</th>
                  <th>Capital</th>
                  <th>+ Interests</th>
                  <th>- Payments</th>
                  <th>= Debt to date</th>
                  <th>Next Due Date</th>
				  <th>Assigned To</th>				  
                  <th>Status</th> 
                  <th>Operator</th> 
                  <th>More</th> 
                </tr>
                </thead>
                <tbody>
                <?php 
if(empty($appCredits)) { ?>
 <tr><td></td><td colspan="11"> No Records Found.</td></tr>
<?php } else { ?>

<?php foreach ($appCredits as $key => $value): 
$date=$value["App_Credits_BankDueDate"];
$createDate = new DateTime($date);

$App_Credits_BankDueDate = $createDate->format('Y-m-d');
 
?>
  <tr>
                  <td><input type="checkbox"/></td>
                  <td><?php echo $value["App_Credits_DebtorId"]; ?></td>
                  <td>Debtor Name</td>
                  <td><?php echo $value["App_Credits_BankOperNumber"]; ?></td>
                  <td><?php echo $value["App_Credits_OriginalCapital"]; ?></td>
                  <td><?php echo $value["App_Credits_OriginalInterest"]; ?></td>
                  <td>Payments</td>
                  <td>Debt to date</td>
                  <td><?php echo $App_Credits_BankDueDate; ?></td>
				  <td><?php echo $value["App_Credits_AssignedTo"]; ?></td>
                  <td><?php echo $value["StatusText"]; ?></td>
                  <td>Operator</td>
                  <td><a href="#">More links</a></td>
                </tr>
<?php endforeach; ?>
<?php }  ?>
				  </tbody>
               
              </table>
             
            </div>
          </div>
        </section>
  </div>
    </section>
  </div>
<!-- /.content-wrapper -->
<?php include_once("footer.php"); ?>

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
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
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
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<script type="text/javascript">
  $(document).on("change",".filterDropDown",function(event){
$("#frmFilterArea").submit();
  });
</script>
</body>
</html>
