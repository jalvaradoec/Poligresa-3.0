<?php 
// print array with format
function pr($data = null, $exit = 1, $append_text = null)
{

    if ($append_text != null)
        echo $append_text;

    if (is_string($data)) {
        echo $data;
    } else {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
    if ($exit == 1)
        exit;
}

/* 
Usage : oper_dashboard.php.php
Developer : Ashish Narola
Created On : 14th Apr 2016
*/

## =================== oper_dashboard.php - start =================
function getAppCredits($appCreditsCond = null){
    global $objDb;
    $appCredits = array();

    $appCreditsSql = "SELECT ac.*,vos.App_Aux_text StatusText,acl.App_Clients_FullName,acl.App_Clients_FirstName,act.App_Contacts_PhoneNumber,acp.App_Phones_PhoneNumber FROM `App_Credits` ac 
    LEFT JOIN `View_OperStatus` vos ON ac.App_Credits_Status=vos.App_Aux_value 
    LEFT JOIN `App_Clients` acl ON ac.App_Credits_DebtorId=acl.App_Clients_DebtorIdNumber
	LEFT JOIN App_Contacts act ON ac.App_Credits_DebtorId=act.App_Contacts_DebtorId
	LEFT JOIN App_Phones acp ON ac.App_Credits_DebtorId=acp.App_Phones_DebtorID
	";
	
    if(!empty($appCreditsCond))
        $appCreditsSql .= " $appCreditsCond";	
    $appCredits = $objDb->get_results($appCreditsSql);
    return $appCredits;
}

function getAppTasks($conditions = null){
    global $objDb;
    $appTasks = array();
    $appTaskSql = "SELECT * FROM `App_Tasks` ";
    if(!empty($conditions))
        $appTaskSql .= $conditions;

//    echo $appTaskSql;
    $appTasks = $objDb->get_results($appTaskSql);
    return $appTasks;
}

function updateTaskStatus($taskId = null, $taskStatus = null){

    global $objDb;
    $update_data= array();
    $update_data["App_Task_Status"] = $taskStatus;
    $condition = " App_Task_ID = $taskId ";
    return  $objDb->update("App_Tasks",$update_data,$condition);
}
function updateAuxStatus($App_Aux_ID = null, $App_Aux_active = null){

    global $objDb;
    $update_data= array();
    $update_data["App_Aux_active"] = $App_Aux_active;
    $condition = " App_Aux_ID = $App_Aux_ID ";
    return  $objDb->update("App_Aux",$update_data,$condition);
}
function getAppCreditStatus($status){

    $statusStr = "";
    switch ($status) {
      case 1:
        $statusStr = "Done";
        break;

      case 2:
        $statusStr = "In Process";
        break;  
      
      default:
        $statusStr = "Pending";
        break;
    }

    return $statusStr;
}

function getBankState($bankState){
    $bankStateStr = "";
    switch ($bankState) {
      case 1:
        $bankStateStr = "Step 1";
        break;

      case 2:
        $bankStateStr = "Step 2";
        break;  
      
      default:
        $bankStateStr = "Default";
        break;
    }

    return $bankStateStr;
}
## =================== oper_dashboard.php - end =================



## =================== oper_assignations.php - start =================
function getViewOperators(){
    global $objDb;
    $operators = array();
    $sql = "SELECT * FROM `View_Operators` ";
    $operators = $objDb->get_results($sql);
    return $operators;
}

function getViewOperStatus(){
    global $objDb;
    $operStatus = array();
    $sql2 = "SELECT * FROM `View_OperStatus`";
    $operStatus = $objDb->get_results($sql2);
    return $operStatus;
}
## =================== oper_assignations.php - end =================

## =================== amortization.php - start =================
function getAppAmortization($amortizationCond = null){
    global $objDb;
    $amortizations = array();
    $amortizationsSql = "SELECT * FROM App_Amortization";
    if(!empty($amortizationCond))
        $amortizationsSql .= " $amortizationCond";

    $amortizations = $objDb->get_results($amortizationsSql);
    return $amortizations;
}
## =================== app_config.php - end =================
function getAppAux($appAuxCond = null){
    global $objDb;
    $appAux = array();
    $appAuxSql = "SELECT * FROM App_Aux ";
    if(isset($_GET['ux_field']) && $_GET['ux_field']) {
        $appAuxSql .= "where App_Aux_field = '".$_GET['ux_field']."'";
    }
    if(!empty($appAuxCond))
        $appAuxSql .= " $appAuxCond";

    $appAux = $objDb->get_results($appAuxSql);
    return $appAux;
}

## =================== app_config.php - start =================


?>