
<div class="box-header">
    <form method="get">
        <select class="form-control select2 ad_select2" name="ux_field" onchange="this.form.submit()">
            <option selected="selected" value="">All</option>
            <?php
            $App_Aux_fields=mysql_query("SELECT App_Aux_field FROM `App_Aux` group by `App_Aux_field`");
            while($r=mysql_fetch_assoc($App_Aux_fields))
            {
                $selected = (isset($_GET['ux_field']) && $_GET['ux_field'] == $r['App_Aux_field']) ? 'selected="selected"' : '';
                echo "<option value='".$r['App_Aux_field']."' ".$selected."> ".$r['App_Aux_field']."</option>";
            }
            ?>
        </select>
    </form>
</div>
<!-- /.box-header -->
<div class="box-body table-responsive no-padding">

    <table id="example2" class="table table-bordered table-hover table-responsive">
        <thead>
        <tr>
            <th>App Aux ID</th>
            <th>App Aux Record Type</th>
            <th>App Aux Field</th>
            <th>App Aux Value</th>
            <th>App Aux Text</th>
            <th>App Aux Active</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php

        if(empty($appAux)) {
            ?>
            <td colspan="6">No records found.</td>
            <?php
        }else{

            foreach ($appAux as $key => $value) { ?>
                <tr>
                    <td><?php echo $value["App_Aux_ID"]; ?></td>
                    <td><?php echo $value["App_Aux_recordtype"]; ?></td>
                    <td><?php echo $value["App_Aux_field"]; ?></td>
                    <td><?php echo $value["App_Aux_value"]; ?></td>
                    <td><?php echo $value["App_Aux_text"]; ?></td>
                    <td>
                        <?php
                        $checked = ($value['App_Aux_active'] == 1) ? 'checked="checked' : '';
                        ?>
                        <input type="checkbox" <?php echo $checked; ?> value="1" class="chk_active" id="<?php echo $value['App_Aux_ID']; ?>" / >
                    </td>
                    <td><a href="?edit_aux=<?php echo $value['App_Aux_ID'] ?>&tab=aux_info">Edit</a>&nbsp;&nbsp;<!--<a href="?del_id=<?php echo $row[0] ?>">Delete</a>--></td>
                </tr>
                <?php
            }

        }
        ?>
        </tbody>
        <tfoot>
        <tr>
            <th>App Aux ID</th>
            <th>App Aux Record Type</th>
            <th>App Aux Field</th>
            <th>App Aux Value</th>
            <th>App Aux Text</th>
            <th>App Aux Active</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
</div>
<div class="box-footer">
    <a href='?insert_aux=1&tab=aux_info'><i class="fa fa-user-plus fa-5x" style="float: right;"></i></a>
</div>