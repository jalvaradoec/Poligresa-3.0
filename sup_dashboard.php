<?php
session_start();
include("header.php");
include_once("utils.php");
$operators = getViewOperators();

if(!empty($_SESSION['username_admin']))
	{	
		if($_SESSION["logged_in_user"]["App_Users_SecurityLevel"] == 10 || $_SESSION["logged_in_user"]["App_Users_SecurityLevel"] == 5)
		{
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            &nbsp;
            <!-- Dashboard
            <small>Supervisor</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="./sup_dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Supervisor Dashboard</li>
        </ol>
    </section>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <section class="content">
        <div class="row">
            <section class="col-lg-9 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <!-- <li><select class="form-control select2">
                                 <option>Day</option>
                                 <option>Week</option>
                                 <option>Month</option>
                                 <option>Year</option>
                          </select></li> -->
                        <li class="pull-left header"><i class="fa fa-inbox"></i>Operators Metrics</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <div class="box box-primary">
                            <div class="box-body">
                                <?php if(empty($operators)) { ?>
                                <div class="panel panel-default" style="background: #dff0d8;">
                                    <div class="panel-body">
                                        <div class="col-lg-12">
                                            No records found.
                                        </div>
                                    </div>
                                </div>
                                <?php } else { ?>

                                    <script type="text/javascript">
                                        google.charts.load('current', {packages: ['corechart', 'bar']});
                                        </script>
                                    <?php
                                    foreach ($operators as $operator){ ?>
                                        <div class="panel panel-default" style="background: #dff0d8;">
                                            <div class="panel-body">
                                                <div class="col-lg-12">
                                                    <div class="col-lg-2">
                                                        <img src="dist/img/avatar5.png" class="img-circle op_img"
                                                             alt="operator1">
                                                        <h5 class="op_heading" style="text-align:center;"><?php echo $operator["App_Users_fullname"];?></h5>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <div id="chart_div<?php echo $operator["App_Users_ID"];?>"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <script type="text/javascript">
                                        google.charts.setOnLoadCallback(function(){
                                            var data = google.visualization.arrayToDataTable([
                                                ['Month', 'Objective',],
                                                //['Jan', 1500],
                                                //['Feb', 8000],
                                                //['March', 800],
                                                ['Actual', 3700],
                                                ['Goal', 8000]
                                            ]);

                                            var options = {
//        title: 'Population of Largest U.S. Cities',
                                                chartArea: {width: '50%'},
                                                legend: "none",
                                                hAxis: {
//          title: 'Total Population',
                                                    minValue: 0
                                                },
                                                vAxis: {
//          title: 'City'
                                                }
                                            };

                                            var chart = new google.visualization.BarChart(document.getElementById('chart_div<?php echo $operator["App_Users_ID"];?>'));
                                            chart.draw(data, options);
                                        });
                                    </script>

                                    <?php } ?>
                                <?php } ?>


                                <!--<div class="panel panel-default" style="background: #dff0d8;">
                                    <div class="panel-body">
                                        <div class="col-lg-12">
                                            <div class="col-lg-2">
                                                <img src="dist/img/avatar5.png" class="img-circle op_img"
                                                     alt="operator1">
                                                <h5 class="op_heading">Operator1</h5>
                                            </div>
                                            <div class="col-lg-10">
                                                <div id="chart_div1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-3 connectedSortable">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="header"><i class="fa fa-inbox"></i>General Metrics</li>
                    </ul>
                    <!-- Map box -->
                    <div class="box box-primary">

                        <div class="box-header">
                        </div>

                        <div class="piacharts">
                            <div class="pia">
                                <div id="piechart" class="chart"></div>
                            </div>
                        </div>

                        <h4 class="goal"><a href="./goals_assignations.php" style="font-size: 12px;"> Goals
                                Assignation </a></h4>
                        <h4 class="goal"><a href="./oper_assignations.php" style="font-size: 12px;"> Operations
                                Assignation </a></h4> <br>


                    </div>
                    <!-- /.box -->
                </div>


                <!-- solid sales graph -->
                <div class="box box-primary bar_box">
                    <div class="box-body">
                        <div class="col-lg-12">

                            <div class="small-box bg-green bar_percentage">
                                <div class="inner">
                                    <h3>76<sup style="font-size: 20px">%</sup></h3>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                            </div>


                            <div class="small-box bg-green bar_percentage">
                                <div class="inner">
                                    <h3>57<sup style="font-size: 20px">%</sup></h3>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>


            </section>
            <!-- right col -->
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
<script src="dist/js/canvasjs.min.js"></script>
<script src="dist/js/pages/piacharts.js"></script>
<!--<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBasic1);

    function drawBasic1() {

        var data = google.visualization.arrayToDataTable([
            ['Month', 'Objective',],
            ['Jan', 1500],
            ['Feb', 8000],
            ['March', 800],
            ['Apr', 2700],
            ['May', 6200]
        ]);

        var options = {
//        title: 'Population of Largest U.S. Cities',
            chartArea: {width: '50%'},
            legend: "none",
            hAxis: {
//          title: 'Total Population',
                minValue: 0
            },
            vAxis: {
//          title: 'City'
            }
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
    }
</script>-->
</body>
</html>
<?php 
		} 
	} 
?>