<?php
session_start();

if(empty($_SESSION["logged_in_user"]["App_Users_SecurityLevel"]) ||

    $_SESSION["logged_in_user"]["App_Users_SecurityLevel"] < 5)  { 
    echo "<script>window.location.href='./error.php?errorCode=403';</script>";
}
include("header.php");

$last_monthyear_and_month = date('Ym', strtotime('-1 month'));
$month_before_year_and_month = date('Ym', strtotime('-2 months'));
$sql1 = "select * from App_Goals where App_Goals_User='" . $_SESSION['username_admin'] . "' AND App_Goals_Period IN ('" . $last_monthyear_and_month . "','" . $month_before_year_and_month . "')";
$result = mysql_query($sql1);
$rows = array();

while ($r = mysql_fetch_assoc($result)) {
    $rows[$r["App_Goals_Period"]] = $r;
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        &nbsp;
           <!--  Dashboard
            <small>Control panel</small> -->
        </h1>
        <ol class="breadcrumb">
            <li>
            <a href="./sup_dashboard.php"><i class="fa fa-dashboard"></i> Home</a>
            </li>           
            <li class="active">Goals Assignations</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <section class="col-lg-12">
                <style>
                    .bdr-right {
                        border-right: 2px solid #CCC;
                        height: 150px;
                    }
                </style>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3><u>Goal Information</u></h3>
                        <div class="row">
                            <div class="col-sm-3 bdr-right">
                                <h2>Current</h2>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-6 control-label">Monthly Goal</label>
                                    <div class="col-sm-6">
                                        <input id="txtMonthlyGoal" type="text" class="form-control" id="inputEmail3"
                                               placeholder="Monthly Goal">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-6 control-label">Increament</label>
                                    <div class="col-sm-6 pull-right"> 0 %</div>
                                </div>
                            </div>
                            <div class="col-sm-3 bdr-right">
                                <h2>Last Month</h2>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-6 control-label">Monthly Goal</label>
                                    <div class="col-sm-6 pull-right">
                                        <?php $last_month_goal = isset($rows[$last_monthyear_and_month]) ? $rows[$last_monthyear_and_month]["App_Goals_Goal"] : 0.00; ?>
                                        <?php $month_before_goal = isset($rows[$month_before_year_and_month]) ? $rows[$month_before_year_and_month]["App_Goals_Goal"] : 0.00; ?>
                                        $ <?php echo $last_month_goal; ?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-6 control-label">Increament</label>
                                    <div class="col-sm-6 pull-right">
                                        <?php
                                        $diff = $last_month_goal - $month_before_goal;
                                        $percentage = $diff * 100 / $last_month_goal;
                                        echo number_format($percentage, 2) . "%";
                                        ?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-6 control-label">Reached</label>
                                    <div class="col-sm-6 pull-right"> 99%</div>
                                </div>
                            </div>
                            <div class="col-sm-3 bdr-right">
                                <h2>Month Before</h2>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-6 control-label">Monthly Goal</label>
                                    <div class="col-sm-6 pull-right">

                                        $ <?php echo $month_before_goal; ?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-6 control-label">Increament</label>
                                    <div class="col-sm-6 pull-right">
                                        0%

                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-6 control-label">Reached</label>
                                    <div class="col-sm-6 pull-right"> 97%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Metas</h3>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table id="example2" class="table table-bordered table-responsive table-hover">
                            <thead>
                            <tr>
                                <th width="8%">No.</th>
                                <th> Username </th>
                                <th> Full Name </th>
                                <th width="15%">% Assigned</th>
                                <th width="15%">Goal Assigned</th>
                            </tr>
                            </thead>
                            <tbody id="metaTbody">
                            <tr>
                                <td colspan="5"> Please enter monthly goal.</td>
                            </tr>
                            </tbody>

                        </table>

                    </div>
                    <div class="box-footer clearfix no-border">
                        <button id="btnAssignGoals" type="button" class="btn btn-info btn-red pull-right">Assign Goals
                        </button>
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->
<!-- <footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.2
    </div>
    <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
</footer> -->
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
    $(document).on("blur", "#txtMonthlyGoal", function () {
        var txtMonthlyGoal = parseFloat($(this).val());
        console.log(txtMonthlyGoal);
        if (!isNaN(txtMonthlyGoal)) {
            $("#metaTbody").html("<tr><td colspan='4'> Loading ...</td></tr>")
            $.ajax({
                    method: "POST",
                    url: "ajax.php",
                    data: {monthlyGoal: txtMonthlyGoal, action: "retrieveOperators"},
                })
                .done(function (response) {
                    $("#metaTbody").html(response);
                });
        }
    });

    $(document).on("click", "span.edit_inline", function () {
        $("span.edit_inline").show();
        $("input.edit_inline").hide();
        $(this).hide();
        var curVal = parseFloat($(this).siblings("input.edit_inline").val());
        //$(this).siblings("input.edit_inline").val(curVal.toFixed(2));
        $(this).siblings("input.edit_inline").val(curVal);
        $(this).siblings("input.edit_inline").show();
        setTotal();
    });
    $(document).on("blur", "input.edit_inline", function () {
        var currentInputValue = parseFloat($(this).val());        
        $(this).siblings("span.edit_inline").text($(this).val());
        $(this).siblings("input.edit_inline").val($(this).val());
        var txtMonthlyGoal = parseFloat($("#txtMonthlyGoal").val());        
        var userCount = getUsersCount();
        var assignedPct = (currentInputValue * 100) / txtMonthlyGoal;
        $(this).parent().siblings(".assignedPerc").text(Math.ceil(assignedPct)+"%");
        $("span.edit_inline").show();
        $(this).hide();
        setTotal();
    });

    function getUsersCount(){
        var usersCount = 0;
        $("#metaTbody tr").each(function(){
        usersCount++;
        });
        return usersCount-1;
    }
    function setTotal(flag) {
        var total = 0.00;
        var numberOfUsers = 0;
        var iv;
        $("input.edit_inline").each(function () {
            iv = $(this).val();
            //iv = parseFloat(iv.replace(/,/g,''))
            total += parseFloat(iv);
            numberOfUsers++;
        })
        if (flag == 1)
            return total;
        else
            $("#total").html(total);
    }

    $(document).on("click", "#btnAssignGoals", function () {
        var txtMonthlyGoal = parseFloat($("#txtMonthlyGoal").val());        

        var t = setTotal(1);
        if (t != txtMonthlyGoal) {
            alert("Big goal must equal to monthly goal");
            return false;
        }
        var objUsersInfo = [];
        $(".meta_tr").each(function(){
            var singleUser = {};
            singleUser.userID = $(this).data("userid");
            singleUser.assignedPerc = parseFloat($(this).find("td:nth-child(4)").text())
            singleUser.assignedGoal =  parseFloat($(this).find("td:nth-child(5)").text());
            objUsersInfo.push(singleUser);
        });
                
        if (!isNaN(txtMonthlyGoal)) {
            $.ajax({
                    method: "POST",
                    url: "ajax.php",
                    data: {
                        monthlyGoal: txtMonthlyGoal,
                        userInfo:objUsersInfo,
                        action: "saveAppGoal"
                    },
                })
                .done(function (response) {
                    alert("App Goal has been added successfully.");
                });
        }

    });

</script>
</body>
</html>
