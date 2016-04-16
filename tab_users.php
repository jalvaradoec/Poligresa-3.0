<div class="box-header">
    <select class="form-control select2 ad_select2">
        <option selected="selected">All</option>
        <option>Active</option>
        <option>InActive</option>
    </select>
</div>
<!-- /.box-header -->
<div class="box-body table-responsive no-padding">

    <table id="example2" class="table table-bordered table-hover table-responsive">
        <thead>
        <tr>
            <th>User Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Security Level</th>
            <th>Supervisor</th>
            <th>Memo</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        //$sql="select * from App_Users";
        $sql = "select au.*,vs.App_Users_username,v.App_Aux_text from App_Users as au 
												left join View_Supervisors as vs on vs.	App_Users_ID=au.App_Users_ID
												left join View_SecurityLevels as v on v.App_Aux_value=au.App_Users_securitylevel";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_array($result, MYSQLI_BOTH)) {
            ?>
            <tr>
                <td><?php echo $row[1] ?></td>
                <td><?php echo $row[4] ?></td>
                <td><?php echo "<input type='password' value='$row[2]' style='border:none;background-color: white;' disabled/>"; ?></td>
                <td><?php echo $row[3] ?></td>
                <td><?php echo $row[5] ?></td>
                <td><?php echo $row[11] ?></td>
                <td><?php echo $row[10] ?></td>
                <td><?php echo $row[9] ?></td>
                <td><?php if ($row[8] == "1") {
                        echo "<input type='checkbox' name='u$row[0]' value='$row[8]' disabled onclick=UpdateData('$row[0]',this) checked/>";
                    } else {
                        echo "<input type='checkbox' onclick=UpdateData('$row[0]',this) value='$row[8]' disabled name='u$row[0]'/>";
                    } ?></td>
                <td><a href="?edit_id=<?php echo $row[0] ?>&tab=users">Edit</a>&nbsp;&nbsp;
                    <!--<a href="?del_id=<?php echo $row[0] ?>">Delete</a>--></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
        <tfoot>
        <tr>
            <th>User Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Security Level</th>
            <th>Supervisor</th>
            <th>Memo</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
</div>
<div class="box-footer">
    <a href='' class='click'><i class="fa fa-user-plus fa-5x" style="float: right;"></i></a>
</div>
