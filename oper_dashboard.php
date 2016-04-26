<?php 
include_once("header.php");
include_once("utils.php");

if(!isset($_SESSION["logged_in_user"]["App_Users_ID"]))
{
  echo "<script>window.location.href='login.php';</script>";
}

$appCreditsCond = " WHERE  ac.App_Credits_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"]."";
if(!empty($_POST["Operation_Status_ID"])) {
  $appCreditsCond .= " AND ac.App_Credits_Status = " . $_POST["Operation_Status_ID"] . "";
}

$appTasks = getAppTasks();
$appCredits = getAppCredits($appCreditsCond);
$operStatus = getViewOperStatus();

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
        <li><a href="./oper_dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-sm-4">
	    <section class="col-lg-12 connectedSortable" style="padding: 0;">
              <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="op_calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
        </section>
        </div>
        <div class="col-sm-8">
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-12 connectedSortable" style="padding: 0;">
        <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <!-- <div id="piechart" ></div> -->
      <!--<h4 class="goalpercentage">Goal%</h4>
      <h2 class="goalpercentage">37%</h2>-->
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <div id="chart_div" style="height:249px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
        </section>
        </div>
	  </div>
    <div class="clearfix"></div>
	  <div class="row">
    <div class="col-sm-4">
    <section class="col-lg-12 connectedSortable" style="padding: 0;">
  
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Task</h3>
            </div>
            <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover" id="example2">
                <tr>
                  <th></th>
                  <th>Task</th>
                  <th>Operation </th>
                  <th>Creation Date</th>
                </tr>
                <tbody id="tasksTbody">
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </section>
    </div>
    <div class="col-sm-8">

        <!-- right col -->
    <section class="col-lg-12 connectedSortable" style="padding: 0;">
          <div class="box box-primary">
            <div class="box-header">
              <form name="frmOperations" method="post">
              <?php
//              echo $appCreditsCond;
              ?>
              <h3 class="box-title">Assigned Operation</h3>
              <select class="form-control select2 op_filter" name="Operation_Status_ID" id="Operation_Status_ID" onchange="this.form.submit();">
                <option value="">Please Select Operation Status</option>
                <?php if(!empty($operStatus)) {
                  foreach ($operStatus as $key => $value) {
                    ?>
                    <option value="<?php echo $value['App_Aux_value']; ?>" <?php if(isset($_POST["Operation_Status_ID"]) && $_POST["Operation_Status_ID"] == $value['App_Aux_value']) echo "selected"; ?>><?php echo $value['App_Aux_text']; ?>
                    </option>
                    <?php
                  }
                  ?>
                <?php } ?>
         </select>
              </form>

            </div>
            <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th></th>
                  <th>Operation</th>
                  <th>Debtor ID</th>
                  <th>Bank Total Credit</th>
                  <th>Bank Interest Rate</th>
                  <th>Credit Date</th>
                  <th>Due Date</th>
                  <th>Bank State</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                 <?php if(empty($appCredits)) { ?>
                <tr>
                  <td colspan="7">No operations found.</td>                  
                </tr>
                <?php } else { ?>

                <?php foreach ($appCredits as $key => $value): ?>
                   <tr>
                  <td><input type="checkbox" /></td>
                  <td><?php echo $value["App_Credits_BankOperNumber"]; ?></td>
                  <td><?php echo $value["App_Credits_DebtorId"]; ?></td>
                  <td><?php echo $value["App_Credits_BankTotalCredit"]; ?></td>
                  <td><?php echo $value["App_Credits_BankInterestRate"]; ?></td>
                  <td ><?php echo date(DEFAULT_DATE_FORMAT,strtotime($value["App_Credits_BankCreditDate"])); ?></td>
                  <td ><?php echo date(DEFAULT_DATE_FORMAT,strtotime($value["App_Credits_BankDueDate"])); ?></td>
                  <td><?php echo getBankState($value["App_Credits_BankState"]);?></td>
                  <td><?php echo $value["StatusText"]; ?></td>
                  <td><a href="http://sistema.poligresa.com/3.0_dev/operation.php?operno=<?php echo $row['App_Credits_BankOperNumber'] ?>">Links</a></td>
                </tr>
                <?php endforeach ?>

                <?php } ?>               
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
    </div>
    </div>
        
        <!-- /.Left col -->
        
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
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
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<script src="dist/js/pages/piagoal.js"></script>

<script src="dist/js/canvasjs.min.js"></script>
<script src="plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="dist/js/utils.js"></script>
<script src="dist/js/pages/oper_dashboard.js"></script>
<!-- Page specific script -->

</body>
</html>
