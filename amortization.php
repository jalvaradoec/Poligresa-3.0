<?php
	session_start();
	include("header.php");
	include_once("utils.php");

	$amortizations = getAppAmortization();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	
        Amortization  dhiren
        <small>Supervisor</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="supervisor.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Amortization Supervisor</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

	    <section class="col-lg-12">
		
            <div class="box box-primary">
			 <div class="box-header">
              <h3 class="box-title tbl"><u>Tabla De Amortization-Banco Guayaqui</u></h3>
			  <div>
			    <table class="deb_info_tbl">
                <tbody>
				<tr>
                  <td class="deb_info_row">Number:</td>
                  <td class="deb_info_row1">Trancaso Ferrin Marcus Eusebio</td>          
                </tr>
				<tr>
                  <td class="deb_info_row">Cedula/RUC:</td>
                  <td class="deb_info_row1">09123654599</td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Operation:</td>
				  <td class="deb_info_row1">98645636</td>          
                </tr>
				
			 </tbody> 
		     </table>
			 </div>
            </div>
           <div class="box-body table-responsive no-padding">
          <table id="example2" class="table table-bordered table-responsive table-hover">
                <thead>
                <tr>
                 
				  <!--==-->
				 <th>Debtor ID</th>
                  <th>Bank Operation</th>
                  <th>Share</th>
                  <th>Capital</th>
                  <th>Interest</th>
                  <th>Fee</th>
                  <th>Fin Interest</th>
                  <th>Default Fee</th>
                  <th>Collect Expenses</th> 
				  <th>Share Total</th>
                  <th>Due Date</th> 
                </tr>
                </thead>
                <tbody>
				<?php

				if(empty($amortizations))
				{ ?>

					<tr><td colspan="11">No records found.</td></tr>
<?php
				}else{

					foreach($amortizations as $a_key=>$a_val){
						?>
<tr>
							<td><?php echo $a_val['App_Amortization_DebtorID']; ?></td>
							<td><?php echo $a_val['App_Amortization_BankOperation']; ?></td>
							<td><?php echo $a_val['App_Amortization_Share']; ?></td>
							<td><?php echo $a_val['App_Amortization_Capital']; ?></td>
							<td><?php echo $a_val['App_Amortization_Interest']; ?></td>
							<td><?php echo $a_val['App_Amortization_Fee']; ?></td>
							<td><?php echo $a_val['App_Amortization_FinInterest']; ?></td>
							<td><?php echo $a_val['App_Amortization_DefaultFee']; ?></td>
							<td><?php echo $a_val['App_Amortization_CollectExpenses']; ?></td>
							<td><?php echo $a_val['App_Amortization_ShareTotal']; ?></td>
							<td><?php echo $a_val['App_Amortization_DueDate']; ?></td>													
												</tr>
						<?php 

					}
					
				}

				?>
												
               
				  </tbody>
               
              </table>
             
            </div>
          <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-info btn-red">Volver</button>
 
            </div>
          </div>
        </section>
  </div>
    </section>
  </div>
  <?php include("footer.php");  ?>
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
            <a href="#">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="#">
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
            <a href="#">
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
            <a href="#">
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
            <a href="#">
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
            <a href="#">
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
              <a href="#" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
    </div>
  </aside>
  <div class="control-sidebar-bg"></div>
</div>
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="plugins/fastclick/fastclick.js"></script>
<script src="dist/js/app.min.js"></script>
</body>
</html>