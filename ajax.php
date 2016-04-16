<?php
session_start();
/**
 * Created by PhpStorm.
 * User: vision
 * Date: 12/04/2016
 * Time: 17:22
 */
include_once("web-config.php");
include_once("utils.php");

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : null;

if ($action == "retrieveOperators") {
    $sql = "SELECT * FROM `App_Users` WHERE App_Users_securitylevel =" . SECURITY_LEVEL_OPERATOR . " ";
    $appUsers = $objDb->get_results($sql);

    if (!empty($appUsers)) {
        $goalAssigned = $_POST["monthlyGoal"] / count($appUsers);
        $assignedPct = ($goalAssigned * 100) / $_POST["monthlyGoal"];
        $html = "";
        foreach ($appUsers as $key => $value) {
            $html .= "<tr class='meta_tr' data-userid='" . $value["App_Users_ID"] . "'>
                                <td>" . ++$key . "</td>
                                <td >" . $value["App_Users_username"] . "</td>
                                <td>" . $value["App_Users_fullname"] . "</td>
                                <td class='assignedPerc'>" . $assignedPct . "%</td>
                                <td class=\"red\"><span class='edit_inline label label-info'>" . $goalAssigned . "</span> <input style='display:none;' type='text' class='edit_inline' value='" . $goalAssigned . "'></td>

                            </tr>";

        }
        $html .= "<tr>
                                <td colspan='4' class='text-right'>Big Goal </td>
                                
                                <td id='total' class=\"red\" >" . $_POST["monthlyGoal"] . "</td>

                            </tr>";
        echo $html;
    }
} elseif ($action == "saveAppGoal") {
    $monthlyGoal = isset($_POST["monthlyGoal"]) ? $_POST["monthlyGoal"] : 0;
    $response = array();
    if (!empty($_POST["userInfo"])) {
        $last_insert_ids = array();
        foreach ($_POST["userInfo"] as $user) {
            $arr = array();
            $arr["App_Goals_Period"] = date("Ym");
            $arr["App_Goals_User"] = $user["userID"];
            $arr["App_Goals_Start"] = date("Y-m-01 H:i:s");
            $arr["App_Goals_End"] = date('Y-m-t H:i:s');
            $arr["App_Goals_Goal"] = $user["assignedGoal"];
            $arr["App_Goals_TotalGoal"] = $monthlyGoal;
            $arr["App_Goals_AsignedBy"] = $_SESSION['logged_in_user']["App_Users_ID"];
            $last_insert_ids[] = $objDb->insert("App_Goals", $arr);
        }
        if (count($last_insert_ids) > 0) {
            $response["status"] = 1;
            $response["message"] = "App Goals have been added successfully.";
            $response["data"] = $last_insert_ids;

        } else {
            $response["status"] = 0;
            $response["message"] = "Something went wrong while inserting app goals.";
            $response["data"] = array();
        }
    }
    echo json_encode($response);
} elseif ($action == "loadTasks") {
    $date = isset($_POST["date"]) ? date("Y-m-d", strtotime($_POST["date"])) : null;
    $condition = " WHERE App_Tasks_AssignedTo = ".$_SESSION["logged_in_user"]["App_Users_ID"]."";

    if(!empty($date))
        $condition .= " AND DATE(App_Task_CreationDateTime) = '".$date."'";

    $appTasks = getAppTasks($condition);
    $html = "";
    if (empty($appTasks)) {
        $html .= " <tr>";
        $html .= "<td colspan=\"5\">No tasks found.</td>";
        $html .= "</tr>";
    } else {
        foreach ($appTasks as $key => $value):
            $checked = "";
            if(	$value["App_Task_Status"] == 1)
                $checked = "checked='checked'";
            $html .= "<tr>";
            $html .= "<td><input id='".$value["App_Task_ID"]."' class='clsTaskStaus' type='checkbox' ".$checked." /> </td>";
            $html .= "<td>" . $value['App_Task_Description'] . "</td>";
            $html .= "<td>" . $value['App_Task_Operation'] . "</td>";
            $html .= "<td>" . date(DEFAULT_DATE_FORMAT, strtotime($value['App_Task_CreationDateTime'])) . "</td>";
            $html .= "</tr>";
        endforeach;
    }
    echo $html;
}elseif ($action == "updateTaskStatus") {
    $taskId = isset($_POST["taskId"]) ? $_POST["taskId"] : null;
    $status = isset($_POST["status"]) ? $_POST["status"] : null;
    $response = array();

    if($status != null)
    {
        if(updateTaskStatus($taskId,$status)){
            $response["status"] = 1;
            $response["message"] = "Task status has been updated to $status ";
        }else{
            $response["status"] = 0;
            $response["message"] = "Something went wrong while updating task status to $status ";
        }
    }
    echo json_encode($response);
} elseif ($action == "App_Aux_Active") {
    $App_Aux_ID = isset($_POST["App_Aux_ID"]) ? $_POST["App_Aux_ID"] : null;
    $App_Aux_active = isset($_POST["App_Aux_active"]) ? $_POST["App_Aux_active"] : 0;
    $response = array();

    if($App_Aux_active != null)
    {
        if(updateAuxStatus($App_Aux_ID,$App_Aux_active)){
            $response["status"] = 1;
            $response["message"] = "Successfully updated.";
        }else{
            $response["status"] = 0;
            $response["message"] = "Something went wrong while updating task status to $status ";
        }
    }
    echo json_encode($response);
}

